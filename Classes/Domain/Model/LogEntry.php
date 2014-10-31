<?php
namespace GeorgRinger\Logging\Domain\Model;


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
 * Log
 */
class LogEntry extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/** @var string */
	protected $channel;

	/** @var string */
	protected $levelName;

	/** @var int */
	protected $level;

	/** @var string */
	protected $requestId;

	/** @var string */
	protected $context;

	/** @var string */
	protected $extra;

	/** @var string */
	protected $message;

	/** @var \DateTime */
	protected $datetime;

	/** @var string */
	protected $mode;

	/** @var int */
	protected $userId;

	/** @var int */
	protected $recordId;

	/** @var string */
	protected $tablename;

	/**
	 * @return string
	 */
	public function getChannel() {
		return $this->channel;
	}

	/**
	 * @param string $channel
	 */
	public function setChannel($channel) {
		$this->channel = $channel;
	}

	/**
	 * @return string
	 */
	public function getLevelName() {
		return $this->levelName;
	}

	/**
	 * @param string $levelName
	 */
	public function setLevelName($levelName) {
		$this->levelName = $levelName;
	}

	/**
	 * @return int
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @param int $level
	 */
	public function setLevel($level) {
		$this->level = $level;
	}

	/**
	 * @return string
	 */
	public function getRequestId() {
		return $this->requestId;
	}

	/**
	 * @param string $requestId
	 */
	public function setRequestId($requestId) {
		$this->requestId = $requestId;
	}

	/**
	 * @return string
	 */
	public function getContext() {
		return ($this->context ? json_decode($this->context, TRUE) : '');
	}

	/**
	 * @param string $context
	 */
	public function setContext($context) {
		$this->context = $context;
	}

	/**
	 * @return string
	 */
	public function getExtra() {
		return ($this->extra ? json_decode($this->extra, TRUE) : '');
	}

	/**
	 * @param string $extra
	 */
	public function setExtra($extra) {
		$this->extra = $extra;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $message
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @return \DateTime
	 */
	public function getDatetime() {
		return $this->datetime;
	}

	/**
	 * @param \DateTime $datetime
	 */
	public function setDatetime($datetime) {
		$this->datetime = $datetime;
	}

	/**
	 * @return string
	 */
	public function getMode() {
		return $this->mode;
	}

	/**
	 * @param string $mode
	 */
	public function setMode($mode) {
		$this->mode = $mode;
	}

	/**
	 * @return int
	 */
	public function getUserId() {
		return $this->userId;
	}

	/**
	 * @param int $userId
	 */
	public function setUserId($userId) {
		$this->userId = $userId;
	}

	/**
	 * @return string
	 */
	public function getTablename() {
		return $this->tablename;
	}

	/**
	 * @param string $tablename
	 */
	public function setTablename($tablename) {
		$this->tablename = $tablename;
	}

	/**
	 * @return int
	 */
	public function getRecordId() {
		return $this->recordId;
	}

	/**
	 * @param int $recordId
	 */
	public function setRecordId($recordId) {
		$this->recordId = $recordId;
	}
}