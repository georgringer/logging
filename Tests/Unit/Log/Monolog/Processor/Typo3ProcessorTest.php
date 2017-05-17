<?php

namespace GeorgRinger\Logging\Tests\Unit\Log\Monolog\Processor;

use GeorgRinger\Logging\Log\Monolog\Processor\Typo3Processor;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class Typo3ProcessorTest extends UnitTestCase
{

    /** @var Typo3Processor */
    protected $instance;

    public function setup()
    {
        $this->instance = new Typo3Processor();
    }

    /**
     * @test
     */
    public function additionalInformationIsAdded()
    {
        $record = [
            'fo' => 'bar'
        ];

        $processId = Bootstrap::getInstance()->getRequestId();
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
