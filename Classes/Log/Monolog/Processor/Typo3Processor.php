<?php
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

namespace GeorgRinger\Logging\Log\Monolog\Processor;

class Typo3Processor {
	/**
	 * @param  array $record
	 * @return array
	 */
	public function __invoke(array $record) {

		$record['extra']['process_id'] = \TYPO3\CMS\Core\Core\Bootstrap::getInstance()->getRequestId();
		$record['extra']['mode'] = TYPO3_MODE;
		$record['extra']['ip'] = (string)\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR');

		if (TYPO3_MODE === 'BE') {
			if (is_object($GLOBALS['BE_USER'])) {
				$record['extra']['user_id'] = $GLOBALS['BE_USER']->user['uid'];
			}
		} elseif (TYPO3_MODE === 'FE') {
			if (is_object($GLOBALS['TSFE'])) {
				$record['extra']['user_id'] = $GLOBALS['TSFE']->fe_user->user['uid'];
			}
		}
		return $record;
	}
}
