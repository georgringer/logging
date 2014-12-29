<?php

namespace GeorgRinger\Logging\Tests\Unit\Domain\Model\Dto;

use GeorgRinger\Logging\Domain\Model\Dto\Demo;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class DemoTest extends UnitTestCase {

	/** @var Demo */
	protected $instance;

	public function setup() {
		$this->instance = new Demo();
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
	public function messageCanBeSet() {
		$value = 'Lorem ipsum';
		$this->instance->setMessage($value);
		$this->assertEquals($value, $this->instance->getMessage());
	}

	/**
	 * @test
	 */
	public function contextCanBeSet() {
		$value = 'Some context';
		$this->instance->setContext($value);
		$this->assertEquals($value, $this->instance->getContext());
	}


}