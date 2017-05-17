<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TCA']['sys_log2'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:logging/Resources/Private/Language/locallang_db.xlf:tx_logging_domain_model_log',
        'label' => 'uid',
        'searchFields' => '',
        'hideTable' => true,
    ],
    'interface' => [
        'showRecordFieldList' => '',
    ],
    'types' => [
        '1' => ['showitem' => 'channel,level,level_name,message,datetime,extra,context,mode,request_id,user_id,record_id,tablename'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'channel' => [
            'exclude' => 1,
            'label' => 'Channel',
            'config' => [
                'type' => 'input',
            ],
        ],
        'level' => [
            'exclude' => 1,
            'label' => 'level',
            'config' => [
                'type' => 'input',
            ],
        ],
        'level_name' => [
            'exclude' => 1,
            'label' => 'level name',
            'config' => [
                'type' => 'input',
            ],
        ],
        'message' => [
            'exclude' => 1,
            'label' => 'message',
            'config' => [
                'type' => 'input',
            ],
        ],
        'datetime' => [
            'exclude' => 1,
            'label' => 'datetime',
            'config' => [
                'eval' => 'datetime,required',
                'dbType' => 'datetime',
                'xtype' => 'date',
                'type' => 'input',
            ],
        ],
        'extra' => [
            'exclude' => 1,
            'label' => 'extra',
            'config' => [
                'type' => 'text',
            ],
        ],
        'context' => [
            'exclude' => 1,
            'label' => 'context',
            'config' => [
                'type' => 'input',
            ],
        ],
        'mode' => [
            'exclude' => 1,
            'label' => 'mode',
            'config' => [
                'type' => 'input',
            ],
        ],
        'request_id' => [
            'exclude' => 1,
            'label' => 'request id',
            'config' => [
                'type' => 'input',
            ],
        ],
        'user_id' => [
            'exclude' => 1,
            'label' => 'user_id',
            'config' => [
                'type' => 'input',
            ],
        ],
        'record_id' => [
            'exclude' => 1,
            'label' => 'record_id',
            'config' => [
                'type' => 'input',
            ],
        ],
        'tablename' => [
            'exclude' => 1,
            'label' => 'tablename',
            'config' => [
                'type' => 'input',
            ],
        ],
    ],
];
