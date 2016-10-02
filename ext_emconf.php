<?php

$EM_CONF[$_EXTKEY] = array(
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
	'constraints' => array(
		'depends' => array(
			'typo3' => '7-6-0-8.9.99',
		),
		'conflicts' => array(),
		'suggests' => array(),
	),
);