<?php

namespace GeorgRinger\Logging\Domain\Model\Dto;

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
 * Class Demo
 */
class DemoEntryDemand {

	/** @var string */
	protected $level;

	/** @var string */
	protected $message;

	/** @var string */
	protected $context;

	/**
	 * @return string
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @param string $level
	 */
	public function setLevel($level) {
		$this->level = $level;
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
	 * @return string
	 */
	public function getContext() {
		return $this->context;
	}

	/**
	 * @param string $context
	 */
	public function setContext($context) {
		$this->context = $context;
	}

}