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

use Monolog\Formatter\NormalizerFormatter;
use Monolog\Handler\AbstractProcessingHandler;

class DatabaseHandler extends AbstractProcessingHandler {

	const TABLE = 'sys_log2';

	/** @var \TYPO3\CMS\Core\Database\DatabaseConnection */
	protected $databaseConnection = NULL;

	/**
	 * Write the given log entry to the database
	 *
	 * @param array $record
	 * @return void
	 */
	protected function write(array $record) {
		$insert = $this->transformEntry($record);
		if ($this->getDataBaseConnection()->exec_INSERTquery(self::TABLE, $insert) === FALSE) {
			throw new \RuntimeException('Could not write log record to database', 1345036334);
		}
	}

	protected function transformEntry(array $record) {
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

		return $insert;
	}

	/**
	 * @return NormalizerFormatter
	 */
	protected function getDefaultFormatter() {
		return new NormalizerFormatter();
	}

	/**
	 * Wrapper method to get the database connection
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDataBaseConnection() {
		if (is_null($this->databaseConnection)) {
			$this->databaseConnection = $GLOBALS['TYPO3_DB'];
		}

		return $this->databaseConnection;
	}

}