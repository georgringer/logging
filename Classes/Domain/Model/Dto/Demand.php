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

namespace GeorgRinger\Logging\Domain\Model\Dto;

class Demand {

	/**
	 * @var string
	 */
	protected $dateStart;

	/**
	 * @var string
	 */
	protected $dateEnd;

	/**
	 * @var array
	 */
	protected $levels;


	/**
	 * @var array
	 */
	protected $modes;

	/**
	 * @var string
	 */
	protected $requestId;

	/**
	 * @var array
	 */
	protected $channels;

	/**
	 * @return string
	 */
	public function getDateStart() {
		return $this->dateStart;
	}

	/**
	 * @param string $dateStart
	 */
	public function setDateStart($dateStart) {
		$this->dateStart = $dateStart;
	}

	/**
	 * @return string
	 */
	public function getDateEnd() {
		return $this->dateEnd;
	}

	/**
	 * @param string $dateEnd
	 */
	public function setDateEnd($dateEnd) {
		$this->dateEnd = $dateEnd;
	}

	/**
	 * @return array
	 */
	public function getLevels() {
		return $this->levels;
	}

	/**
	 * @param array $levelStart
	 */
	public function setLevels($levelStart) {
		$this->levels = $levelStart;
	}

	/**
	 * @return array
	 */
	public function getModes() {
		return $this->modes;
	}

	/**
	 * @param array $mode
	 */
	public function setModes($mode) {
		$this->modes = $mode;
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
	 * @return array
	 */
	public function getChannels() {
		return $this->channels;
	}

	/**
	 * @param array $channels
	 */
	public function setChannels($channels) {
		$this->channels = $channels;
	}



}