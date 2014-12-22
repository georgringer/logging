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

namespace GeorgRinger\Logging\Log\Monolog\Handler;

use Monolog\Logger;

class DatabaseHandler extends \Monolog\Handler\AbstractProcessingHandler {

	const TABLE = 'sys_log2';

	/**
	 * {@inheritDoc}
	 */
	protected function write(array $record) {
		$recordCopy = $record;

		unset($recordCopy['formatted']['extra']['process_id']);
		unset($recordCopy['formatted']['extra']['context']);
		unset($recordCopy['formatted']['extra']['user_id']);
		unset($recordCopy['formatted']['extra']['record_id']);
		unset($recordCopy['formatted']['extra']['tablename']);
		unset($recordCopy['formatted']['extra']['mode']);

		$insert = array(
			'channel' => $record['formatted']['channel'],
			'level' => $record['formatted']['level'],
			'level_name' => $record['formatted']['level_name'],
			'request_id' => $record['formatted']['extra']['process_id'],
			'context' => !empty($record['formatted']['context']) ? json_encode($recordCopy['formatted']['context']) : '',
			'message' => $record['formatted']['message'],
			'datetime' => $record['formatted']['datetime'],
			'extra' => !empty($recordCopy['formatted']['extra']) ? json_encode($recordCopy['formatted']['extra']) : '',
			'mode' => $record['formatted']['extra']['mode'],
			'user_id' => $record['formatted']['extra']['user_id'],
			'tablename' => (string)$record['formatted']['context']['tablename'],
			'record_id' => (string)$record['formatted']['context']['record_id'],
		);

		if ($GLOBALS['TYPO3_DB']->exec_INSERTquery(self::TABLE, $insert) === FALSE) {
			throw new \RuntimeException('Could not write log record to database', 1345036334);
		}
	}


	/**
	 * @return \Monolog\Formatter\NormalizerFormatter
	 */
	protected function getDefaultFormatter() {
		return new \Monolog\Formatter\NormalizerFormatter();
	}
}