<?php
namespace GeorgRinger\Logging\Log;

	/**
	 * This file is part of the TYPO3 CMS project.
	 *
	 * It is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License, either version 2
	 * of the License, or any later version.
	 *
	 * For the full copyright and license information, please read the
	 * LICENSE.txt file that was distributed with this source code.
	 *
	 * The TYPO3 project - inspiring people to share!
	 */
use Monolog\Logger;
use TYPO3\CMS\Core\Log\LogManagerInterface;
use TYPO3\CMS\Core\SingletonInterface;

/**
 * Global LogManager that keeps track of global logging information.
 *
 * Inspired by java.util.logging
 */
class MonologManager implements SingletonInterface, LogManagerInterface {

	/**
	 * @var string
	 */
	const CONFIGURATION_TYPE_HANDLER = 'handler';
	/**
	 * @var string
	 */
	const CONFIGURATION_TYPE_PROCESSOR = 'processor';
	/**
	 * Loggers to retrieve them for repeated use.
	 *
	 * @var array
	 */
	protected $loggers = array();

	/**
	 * For use in unit test context only. Resets the internal logger registry.
	 *
	 * @return void
	 */
	public function reset() {
		$this->loggers = array();
	}

	/**
	 * @param string $name
	 * @return Logger
	 */
	public function getLogger($name = '') {
		/** @var $logger Logger */
		$logger = NULL;

		// Transform namespaces and underscore class names to the dot-name style
		$separators = array('_', '\\');
		$name = str_replace($separators, '.', $name);
		if (isset($this->loggers[$name])) {
			$logger = $this->loggers[$name];
		} else {
			$configuration = $this->getConfigurationForLogger('handler', $name);
			$readableName = $name;
			if (isset($configuration['name'])) {
				$readableName = $configuration['name'];
			}
			// Lazy instantiation
			/** @var $logger Logger */
			$logger = new Logger($readableName);
			$this->setHandlers($logger, $name);
			$this->setProcessorsForLogger($logger, $name);
			$this->loggers[$name] = $logger;
		}
		return $logger;
	}

	/**
	 * @param Logger $logger
	 * @param $name
	 */
	protected function setHandlers(Logger $logger, $name) {
		$configuration = $this->getConfigurationForLogger(self::CONFIGURATION_TYPE_HANDLER, $name);

		if (isset($configuration['handlers'] )) {
			foreach ($configuration['handlers'] as $handlerClassName => $options) {
				try {
					if (!empty($options)) {
						array_unshift($options, ' ');
					}
					/** @var \Monolog\Handler\HandlerInterface $handler */
					$handler = $this->instantiateClass($handlerClassName, $options);
					$logger->pushHandler($handler);
				} catch (\RangeException $e) {
					die('x' . $e->getMessage());
				}
			}
		}
	}

	/**
	 * @param Logger $logger
	 * @param $name
	 */
	protected function setProcessorsForLogger(Logger $logger, $name) {
		$configuration = $this->getConfigurationForLogger(self::CONFIGURATION_TYPE_PROCESSOR, $name);

		foreach ($configuration as $processorClassName => $options) {
			try {
				if (!empty($options)) {
					array_unshift($options, ' ');
				}
				$processor = $this->instantiateClass($processorClassName, $options);
				$logger->pushProcessor($processor);
			} catch (\RangeException $e) {
				die('x' . $e->getMessage());
			}
		}
	}

	/**
	 * Speed optimized alternative to ReflectionClass::newInstanceArgs()
	 *
	 * @param string $className Name of the class to instantiate
	 * @param array $arguments Arguments passed to self::makeInstance() thus the first one with index 0 holds the requested class name
	 * @return mixed
	 */
	protected function instantiateClass($className, $arguments) {
		switch (count($arguments)) {
			case 1:
				$instance = new $className();
				break;
			case 2:
				$instance = new $className($arguments[1]);
				break;
			case 3:
				$instance = new $className($arguments[1], $arguments[2]);
				break;
			case 4:
				$instance = new $className($arguments[1], $arguments[2], $arguments[3]);
				break;
			case 5:
				$instance = new $className($arguments[1], $arguments[2], $arguments[3], $arguments[4]);
				break;
			case 6:
				$instance = new $className($arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5]);
				break;
			case 7:
				$instance = new $className($arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5], $arguments[6]);
				break;
			case 8:
				$instance = new $className($arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5], $arguments[6], $arguments[7]);
				break;
			case 9:
				$instance = new $className($arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5], $arguments[6], $arguments[7], $arguments[8]);
				break;
			default:
				// The default case for classes with constructors that have more than 8 arguments.
				// This will fail when one of the arguments shall be passed by reference.
				// In case we really need to support this edge case, we can implement the solution from here: https://review.typo3.org/26344
				$class = new \ReflectionClass($className);
				array_shift($arguments);
				$instance = $class->newInstanceArgs($arguments);
				return $instance;
		}
		return $instance;
	}

	/**
	 * For use in unit test context only.
	 *
	 * @param string $name
	 * @return void
	 */
	public function registerLogger($name) {
		$this->loggers[$name] = NULL;
	}

	/**
	 * For use in unit test context only.
	 *
	 * @return array
	 */
	public function getLoggerNames() {
		return array_keys($this->loggers);
	}

	/**
	 * Returns the configuration from $TYPO3_CONF_VARS['LOG'] as
	 * hierarchical array for different components of the class hierarchy.
	 *
	 * @param string $configurationType Type of config to return (writer, processor)
	 * @param string $loggerName Logger name
	 * @throws \RangeException
	 * @return array
	 */
	protected function getConfigurationForLogger($configurationType, $loggerName) {
		// Split up the logger name (dot-separated) into its parts
		$explodedName = explode('.', $loggerName);
		// Search in the $TYPO3_CONF_VARS['LOG'] array
		// for these keys, for example "writerConfiguration"
		$configurationKey = $configurationType . 'Configuration';
		$configuration = $GLOBALS['TYPO3_CONF_VARS']['MONOLOG'];
		$result = $configuration[$configurationKey] ?: array();
		// Walk from general to special (t3lib, t3lib.db, t3lib.db.foo)
		// and search for the most specific configuration
		foreach ($explodedName as $partOfClassName) {
			if (!empty($configuration[$partOfClassName][$configurationKey])) {
				$result = $configuration[$partOfClassName][$configurationKey];
			}
			$configuration = $configuration[$partOfClassName];
		}
		return $result;
	}

}