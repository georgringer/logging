<?php

namespace GeorgRinger\Logging\Tests\Unit\Domain\Model\Dto;

use GeorgRinger\Logging\Domain\Model\Dto\Demand;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class DemandTest extends UnitTestCase {

	/** @var Demand */
	protected $instance;

	public function setup() {
		$this->instance = new Demand();
	}

	/**
	 * @test
	 */
	public function dateStartCanBeSet() {
		$value = '2014-12-29';
		$this->instance->setDateStart($value);
		$this->assertEquals($value, $this->instance->getDateStart());
	}

	/**
	 * @test
	 */
	public function dateEndCanBeSet() {
		$value = '2014-12-21';
		$this->instance->setDateEnd($value);
		$this->assertEquals($value, $this->instance->getDateEnd());
	}

	/**
	 * @test
	 */
	public function levelsCanBeSet() {
		$value = array('12', '34');
		$this->instance->setLevels($value);
		$this->assertEquals($value, $this->instance->getLevels());
	}

	/**
	 * @test
	 */
	public function modesCanBeSet() {
		$value = array('45', '56');
		$this->instance->setModes($value);
		$this->assertEquals($value, $this->instance->getModes());
	}

	/**
	 * @test
	 */
	public function channelsCanBeSet() {
		$value = array('78', '90');
		$this->instance->setChannels($value);
		$this->assertEquals($value, $this->instance->getChannels());
	}

	/**
	 * @test
	 */
	public function requestIdCanBeSet() {
		$value = '81812012ß09127981732138';
		$this->instance->setRequestId($value);
		$this->assertEquals($value, $this->instance->getRequestId());
	}

	/**
	 * @test
	 */
	public function userCanBeSet() {
		$value = 'be_123';
		$this->instance->setUser($value);
		$this->assertEquals($value, $this->instance->getUser());
	}

	/**
	 * @test
	 */
	public function dateRangeCanBeSet() {
		$value = 8;
		$this->instance->setDateRange($value);
		$this->assertEquals($value, $this->instance->getDateRange());
	}
}