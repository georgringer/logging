# TYPO3 Extension "logging"

This extension is just a proof of concept how logging could be implemented in TYPO3.CMS.

Plans are to use monolog as logging API and a DatabaseHandler to log to the same database. A backend module will then display those entries.

## Requirements

* TYPO3.CMS latest master
* composer update to add monolog
* require the monolog files, e.g. by using ```require_once(__DIR__ . '/../Packages/Libraries/autoload.php');``` in the AdditionalConfiguration.php file

Configuration, e.g. in the AdditionalConfiguration.php: ::

	$GLOBALS['TYPO3_CONF_VARS']['MONOLOG'] = array(
		'processorConfiguration' => array(
			\GeorgRinger\Logging\Log\Monolog\Processor\Typo3Processor::class => array()
		),
		'handlerConfiguration' => array(
			'name' => 'General',
			'handlers' => array(
				'Monolog\\Handler\\SyslogHandler' => array('syslogXXX'),
				'Monolog\\Handler\\StreamHandler' => array(
					PATH_site . 'typo3temp/out.log'
				),
				\GeorgRinger\Logging\Log\Monolog\Handler\DatabaseHandler::class => array()
			)
		)
	);
	
	
Note: this config works with PHP 5.5 only, if using PHP 5.4, replace ``::class`` constructs with the direct string of class. 

## How to log

Logging is then very simple and similar to the used logging framework: ::

	/** @var \Monolog\Logger $logger */
	$logger = GeneralUtility::makeInstance(\GeorgRinger\Logging\Log\MonologManager::class)->getLogger(__CLASS__);
	$logger->info('Some text', array('additional information' => 123));
	
