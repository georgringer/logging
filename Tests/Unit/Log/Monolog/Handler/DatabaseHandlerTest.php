<?php

namespace GeorgRinger\Logging\Tests\Unit\Log\Monolog\Handler;

use TYPO3\CMS\Core\Tests\UnitTestCase;

class DatabaseHandlerTest extends UnitTestCase
{

    /**
     * @test
     * @dataProvider generatedCacheFileNameIsCorrectDataProvider
     */
    public function logEntryIsCorrectlyTransformed($given, $expected)
    {
        $databaseHandler = $this->getAccessibleMock(\GeorgRinger\Logging\Log\Monolog\Handler\DatabaseHandler::class, ['dummy']);

        $this->assertEquals($expected, $databaseHandler->_call('transformEntry', $given));
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function generatedCacheFileNameIsCorrectDataProvider()
    {
        return [
            'simpleExample' => [
                [
                    'formatted' => [
                        'channel' => 'Channel',
                        'level' => '1',
                        'level_name' => '',
                        'message' => 'lipsum',
                        'datetime' => '',
                    ]
                ],
                [
                    'channel' => 'Channel',
                    'level' => '1',
                    'level_name' => '',
                    'request_id' => '',
                    'context' => '',
                    'message' => 'lipsum',
                    'datetime' => '',
                    'extra' => '',
                    'mode' => '',
                    'user_id' => '',
                    'tablename' => '',
                    'record_id' => '',
                ],
            ],
            'additionalExtraFields' => [
                [
                    'formatted' => [
                        'channel' => '',
                        'level' => '',
                        'level_name' => '',
                        'message' => '',
                        'datetime' => '',
                        'extra' => [
                            'context' => ['fo', 'bar'],
                            'process_id' => '1234',
                            'mode' => 'BE',
                            'user_id' => '78',
                            'additional1' => 'info',
                            'additional2' => 'message'
                        ],
                        'context' => [
                            'tablename' => 'tt_content',
                            'record_id' => '90',
                        ]
                    ]
                ],
                [
                    'channel' => '',
                    'level' => '',
                    'level_name' => '',
                    'request_id' => '1234',
                    'context' => '{"tablename":"tt_content","record_id":"90"}',
                    'message' => '',
                    'datetime' => '',
                    'extra' => '{"additional1":"info","additional2":"message"}',
                    'mode' => 'BE',
                    'user_id' => '78',
                    'tablename' => 'tt_content',
                    'record_id' => '90',
                ],
            ],
        ];
    }
}
