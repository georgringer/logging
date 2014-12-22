<?php

namespace GeorgRinger\Logging\Tests\Unit\Log\Monolog\Processor;

class Typo3ProcessorTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/** @var \GeorgRinger\Logging\Log\Monolog\Processor\Typo3Processor */
	protected $instance;

	public function setup() {
		$this->instance = new \GeorgRinger\Logging\Log\Monolog\Processor\Typo3Processor();
	}

	/**
	 * @test
	 */
	public function additionalInformationIsAdded() {
		$record = [
			'fo' => 'bar'
		];

		$processId = \TYPO3\CMS\Core\Core\Bootstrap::getInstance()->getRequestId();
		$expected = [
			'fo' => 'bar',
			'extra' => [
				'process_id' => $processId,
				'mode' => 'BE',
				'ip' => ''
			]
		];

		$this->assertEquals($expected, $this->instance->__invoke($record));
	}
}