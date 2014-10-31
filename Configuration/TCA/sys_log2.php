<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['sys_log2'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:logging/Resources/Private/Language/locallang_db.xlf:tx_logging_domain_model_log',
		'label' => 'uid',
		'dividers2tabs' => TRUE,
		'searchFields' => '',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('logging') . 'Resources/Public/Icons/tx_logging_domain_model_log.gif'
	),
	'interface' => array(
		'showRecordFieldList' => '',
	),
	'types' => array(
		'1' => array('showitem' => 'channel,level,level_name,message,datetime,extra,context,mode,request_id,user_id,record_id,tablename'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'channel' => array(
			'exclude' => 1,
			'label' => 'Channel',
			'config' => array(
				'type' => 'input',
			),
		),
		'level' => array(
			'exclude' => 1,
			'label' => 'level',
			'config' => array(
				'type' => 'input',
			),
		),
		'level_name' => array(
			'exclude' => 1,
			'label' => 'level name',
			'config' => array(
				'type' => 'input',
			),
		),
		'message' => array(
			'exclude' => 1,
			'label' => 'message',
			'config' => array(
				'type' => 'input',
			),
		),
		'datetime' => array(
			'exclude' => 1,
			'label' => 'datetime',
			'config' => array(
				'xtype'    => 'date',
				'type' => 'input',
			),
		),
		'extra' => array(
			'exclude' => 1,
			'label' => 'extra',
			'config' => array(
				'type' => 'text',
			),
		),
		'context' => array(
			'exclude' => 1,
			'label' => 'context',
			'config' => array(
				'type' => 'input',
			),
		),
		'mode' => array(
			'exclude' => 1,
			'label' => 'mode',
			'config' => array(
				'type' => 'input',
			),
		),
		'request_id' => array(
			'exclude' => 1,
			'label' => 'request id',
			'config' => array(
				'type' => 'input',
			),
		),
		'user_id' => array(
			'exclude' => 1,
			'label' => 'user_id',
			'config' => array(
				'type' => 'input',
			),
		),
		'record_id' => array(
			'exclude' => 1,
			'label' => 'record_id',
			'config' => array(
				'type' => 'input',
			),
		),
		'tablename' => array(
			'exclude' => 1,
			'label' => 'tablename',
			'config' => array(
				'type' => 'input',
			),
		),
	),
);
