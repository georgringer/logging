<?php
namespace GeorgRinger\Logging\Controller;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;
use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Logging\Domain\Repository\LogEntryRepository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

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
				100 => 'debug',
				200 => 'info',
				250 => 'notice',
				300 => 'warning',
				400 => 'error',
				500 => 'critical',
				550 => 'alert',
				600 => 'emergency'
			),
			'channels' => $this->logEntryRepository->getAllChannels()
		));
		$this->loadJsForDatepicker();
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

}