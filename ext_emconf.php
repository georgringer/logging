<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Logging',
    'description' => 'Logging in TYPO3 by using monolog',
    'category' => 'backend',
    'author' => 'Georg Ringer',
    'author_email' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '7-6-0-8.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
