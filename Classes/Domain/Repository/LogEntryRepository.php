<?php
namespace GeorgRinger\Logging\Domain\Repository;

use GeorgRinger\Logging\Domain\Model\Dto\Demand;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

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
class LogEntryRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var array Default order is by datetime descending
	 */
	protected $defaultOrderings = array(
		'datetime' => QueryInterface::ORDER_DESCENDING
	);

	/**
	 * @param Demand $demand
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByDemand(Demand $demand = NULL) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);

		if (!is_null($demand)) {
			$constraints = $this->createConstraintsFromDemand($query, $demand);
			if (!empty($constraints)) {
				$query->matching(
					$query->logicalAnd($constraints)
				);
			}
		}

		return $query->execute();
	}

	/**
	 * @return array
	 */
	public function getAllChannels() {
		$out = array();
		$rows = $this->getDb()->exec_SELECTgetRows('channel', 'sys_log2', '', 'channel', 'channel ASC');
		foreach ($rows as $row) {
			$out[$row['channel']] = $row['channel'];;
		}
		return $out;
	}

	/**
	 * @param QueryInterface $query
	 * @param Demand $demand
	 * @return array
	 */
	protected function createConstraintsFromDemand(QueryInterface $query, Demand $demand) {
		$constraints = array();

		if ($demand->getLevels()) {
			$constraints[] = $query->in('level', $demand->getLevels());
		}
		if ($demand->getModes()) {
			$constraints[] = $query->in('mode', $demand->getModes());
		}
		if ($demand->getChannels()) {
			$constraints[] = $query->in('channel', $demand->getChannels());
		}
		if ($demand->getDateStart()) {
			$time = strtotime($demand->getDateStart());
			$constraints[] = $query->greaterThanOrEqual('datetime', $this->getTime($time));
		}
		if ($demand->getDateEnd()) {
			$time = strtotime($demand->getDateEnd());
			$constraints[] = $query->lessThanOrEqual('datetime', $this->getTime($time));
		}
		if ($demand->getRequestId()) {
			$constraints[] = $query->equals('requestId', $demand->getRequestId());
		}

		return $constraints;
	}

	/**
	 * @param int $time
	 * @return string
	 */
	protected function getTime($time) {
		$time = strftime('%Y-%m-%d %H:%M:%S', $time);
		return $time;
	}

	/**
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDb() {
		return $GLOBALS['TYPO3_DB'];
	}
}