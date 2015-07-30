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
	'createDirs' => '1.0.0',
	'clearCacheOnLoad' => 0,
	'version' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.10-7.9.99',
		),
		'conflicts' => array(),
		'suggests' => array(),
	),
);