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

/**
 * LogController
 */
class LogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \GeorgRinger\Logging\Domain\Repository\LogEntryRepository
	 */
	protected $logEntryRepository;

	public function injectLogEntryRepository(\GeorgRinger\Logging\Domain\Repository\LogEntryRepository $logEntryRepository) {
		$this->logEntryRepository = $logEntryRepository;
	}

	/**
	 * @param \GeorgRinger\Logging\Domain\Model\Dto\Demand $demand
	 * @return void
	 */
	public function listAction(\GeorgRinger\Logging\Domain\Model\Dto\Demand $demand = NULL) {
		$logs = $this->logEntryRepository->findByDemand($demand);

		$this->view->assignMultiple(array(
			'logs' => $logs,
			'demand' => $demand,
			'levels' => array(
				100 => $this->translate('level.debug'),
				200 => $this->translate('level.info'),
				250 => $this->translate('level.notice'),
				300 => $this->translate('level.warning'),
				400 => $this->translate('level.error'),
				500 => $this->translate('level.critical'),
				550 => $this->translate('level.alert'),
				600 => $this->translate('level.emergency')
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
			),
			'users' => $this->logEntryRepository->getAllUsers(),
			'channels' => $this->logEntryRepository->getAllChannels()
		));
		$this->loadJsForDatepicker();
	}

	/**
	 * Clear the logs
	 *
	 * @return void
	 */
	public function clearAction() {

	}

	/**
	 * Load some JS for the datepicker
	 *
	 * @return void
	 */
	protected function loadJsForDatepicker() {
		/** @var \TYPO3\CMS\Backend\Template\DocumentTemplate $documentTemplate */
		$documentTemplate = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Template\\DocumentTemplate');
		$pageRenderer = $documentTemplate->getPageRenderer();
		$pageRenderer->loadExtJS();
		$pageRenderer->addJsFile($GLOBALS['BACK_PATH'] . 'sysext/backend/Resources/Public/JavaScript/tceforms.js');
		$pageRenderer->addJsFile($GLOBALS['BACK_PATH'] . 'js/extjs/ux/Ext.ux.DateTimePicker.js');
		$typo3Settings = array(
			'datePickerUSmode' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['USdateFormat'] ? 1 : 0,
			'dateFormat' => array('j-n-Y', 'G:i j-n-Y'),
			'dateFormatUS' => array('n-j-Y', 'G:i n-j-Y')
		);
		$pageRenderer->addInlineSettingArray('', $typo3Settings);
	}

	/**
	 * Translate a message
	 *
	 * @param string $key
	 * @param array $arguments
	 * @return string
	 */
	protected function translate($key, $arguments = array()) {
		return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, 'logging', $arguments);
	}
}