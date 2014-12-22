<?php

namespace GeorgRinger\Logging\Tests\Unit\Domain\Model;

use GeorgRinger\Logging\Domain\Model\LogEntry;

class LogEntryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/** @var LogEntry */
	protected $instance;

	public function setup() {
		$this->instance = new LogEntry();
	}

	/**
	 * @test
	 */
	public function channelCanBeSet() {
		$value = 'channel1';
		$this->instance->setChannel($value);
		$this->assertEquals($value, $this->instance->getChannel());
	}

	/**
	 * @test
	 */
	public function levelCanBeSet() {
		$value = 123;
		$this->instance->setLevel($value);
		$this->assertEquals($value, $this->instance->getLevel());
	}

	/**
	 * @test
	 */
	public function levelNameCanBeSet() {
		$value = 'name3';
		$this->instance->setLevelName($value);
		$this->assertEquals($value, $this->instance->getLevelName());
	}

	/**
	 * @test
	 */
	public function contextCanBeSet() {
		$value = array('context');
		$this->instance->setContext(json_encode($value));
		$this->assertEquals($value, $this->instance->getContext());
	}

	/**
	 * @test
	 */
	public function noContextReturnsNull() {
		$value = NULL;
		$this->instance->setContext($value);
		$this->assertEquals($value, $this->instance->getContext());
	}

	/**
	 * @test
	 */
	public function extraCanBeSet() {
		$value = array('extra');
		$this->instance->setExtra(json_encode($value));
		$this->assertEquals(array('extra'), $this->instance->getExtra());
	}

	/**
	 * @test
	 */
	public function noExtraReturnsNull() {
		$value = NULL;
		$this->instance->setExtra($value);
		$this->assertEquals($value, $this->instance->getExtra());
	}

	/**
	 * @test
	 */
	public function messageCanBeSet() {
		$value = 'message 89';
		$this->instance->setMessage($value);
		$this->assertEquals($value, $this->instance->getMessage());
	}

	/**
	 * @test
	 */
	public function dateTimeCanBeSet() {
		$value = new \DateTime('2014-12-21 22:34');
		$this->instance->setDatetime($value);
		$this->assertEquals($value, $this->instance->getDatetime());
	}

	/**
	 * @test
	 */
	public function modeCanBeSet() {
		$value = 'mode 67';
		$this->instance->setMode($value);
		$this->assertEquals($value, $this->instance->getMode());
	}

	/**
	 * @test
	 */
	public function userIdCanBeSet() {
		$value = 1234;
		$this->instance->setUserId($value);
		$this->assertEquals($value, $this->instance->getUserId());
	}

	/**
	 * @test
	 */
	public function recordIdCanBeSet() {
		$value = 456;
		$this->instance->setRecordId($value);
		$this->assertEquals($value, $this->instance->getRecordId());
	}

	/**
	 * @test
	 */
	public function tableNameCanBeSet() {
		$value = 'tt_content';
		$this->instance->setTablename($value);
		$this->assertEquals($value, $this->instance->getTablename());
	}

}