<?php
namespace GeorgRinger\Logging\Controller;

/*
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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * LogController
 */
class LogController extends ActionController {

	/**
	 * @param \GeorgRinger\Logging\Domain\Model\Dto\ListDemand $demand
	 * @return void
	 */
	public function listAction(\GeorgRinger\Logging\Domain\Model\Dto\ListDemand $demand = NULL) {
		$this->view->assignMultiple(array(
			'demand' => $demand,
			'logs' => $this->logEntryRepository->findByDemand($demand),
			'users' => $this->logEntryRepository->getAllUsers(),
			'channels' => $this->logEntryRepository->getAllChannels()
		));
		$this->loadJsForDatePicker();
	}

	/**
	 * Clear the logs
	 *
	 * @param \GeorgRinger\Logging\Domain\Model\Dto\ClearDemand $clear
	 * @return void
	 */
	public function clearAction(\GeorgRinger\Logging\Domain\Model\Dto\ClearDemand $clear = NULL) {
		$this->view->assign('clear', $clear);

		if (!is_null($clear)) {
			$processed = $this->logEntryRepository->clearByDemand($clear);
			$this->view->assign('processed', $processed);
		}
	}

	/**
	 * @param \GeorgRinger\Logging\Domain\Model\Dto\DemoEntryDemand $demo
	 */
	public function demoAction(\GeorgRinger\Logging\Domain\Model\Dto\DemoEntryDemand $demo = NULL) {
		$this->view->assign('demo', $demo);

		if (!is_null($demo)) {
			/** @var \Monolog\Logger $logger */
			$logger = GeneralUtility::makeInstance('GeorgRinger\\Logging\\Log\\MonologManager')->getLogger(__CLASS__);
			$logger->addRecord($demo->getLevel(), $demo->getMessage());
			$this->view->assign('added', TRUE);
		}
	}

	/**
	 * Display the configuration
	 *
	 * @return void
	 */
	public function configurationAction() {
		$configuration = var_export($GLOBALS['TYPO3_CONF_VARS']['MONOLOG'], TRUE);
		$this->view->assign('configuration', $configuration);
	}

	/**
	 * @param ViewInterface $view
	 * @return void
	 */
	protected function initializeView(ViewInterface $view) {
		$view->assignMultiple(array(
			'levels' => array(
				100 => $this->translate('level.100'),
				200 => $this->translate('level.200'),
				250 => $this->translate('level.250'),
				300 => $this->translate('level.300'),
				400 => $this->translate('level.400'),
				500 => $this->translate('level.500'),
				550 => $this->translate('level.550'),
				600 => $this->translate('level.600')
			),
			'dateRanges' => array(
				0 => '',
				1 => $this->translate('dateRange.thisWeek'),
				2 => $this->translate('dateRange.lastWeek'),
				3 => $this->translate('dateRange.last7Days'),
				4 => $this->translate('dateRange.thisMonth'),
				5 => $this->translate('dateRange.lastMonth'),
				6 => $this->translate('dateRange.last31Days'),
				7 => $this->translate('dateRange.userDefined'),
			)
		));
	}

	/**
	 * Load some JS for the datePicker
	 *
	 * @return void
	 */
	protected function loadJsForDatePicker() {
		/** @var \TYPO3\CMS\Backend\Template\DocumentTemplate $documentTemplate */
		$documentTemplate = GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Template\\DocumentTemplate');
		$pageRenderer = $documentTemplate->getPageRenderer();
		$dateFormat = ($GLOBALS['TYPO3_CONF_VARS']['SYS']['USdateFormat'] ? array('MM-DD-YYYY', 'HH:mm MM-DD-YYYY') : array('DD-MM-YYYY', 'HH:mm DD-MM-YYYY'));
		$pageRenderer->addInlineSetting('DateTimePicker', 'DateFormat', $dateFormat);
	}

	/**
	 * Translate a message
	 *
	 * @param string $key
	 * @param array $arguments
	 * @return string
	 */
	protected function translate($key, $arguments = array()) {
		return LocalizationUtility::translate($key, 'logging', $arguments);
	}

	/**
	 * @var \GeorgRinger\Logging\Domain\Repository\LogEntryRepository
	 */
	protected $logEntryRepository;

	/**
	 * @param \GeorgRinger\Logging\Domain\Repository\LogEntryRepository $logEntryRepository
	 * @return void
	 */
	public function injectLogEntryRepository(\GeorgRinger\Logging\Domain\Repository\LogEntryRepository $logEntryRepository) {
		$this->logEntryRepository = $logEntryRepository;
	}
}