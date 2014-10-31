# TYPO3 Extension "logging"

This extension is just a proof of concept how logging could be implemented in TYPO3.CMS.

Plans are to use monolog as logging API and a DatabaseHandler to log to the same database. A backend module will then display those entries.

## Requirements

* TYPO3.CMS latest master
* patch https://review.typo3.org/#/c/33539/ applied
* composer update to add monolog
* require the monolog files, e.g. by using ```require_once(__DIR__ . '/../Packages/Libraries/autoload.php');``` in the AdditionalConfiguration.php file

Configuration, e.g. in the AdditionalConfiguration.php: ::

	$GLOBALS['TYPO3_CONF_VARS']['MONOLOG']['authentication'] = array(
		'processorConfiguration' => array(
			'TYPO3\\CMS\\Core\\Log\\Monolog\\Processor\\Typo3Processor' => array()
		),
		'handlerConfiguration' => array(
			'name' => 'Authentication',
			'handlers' => array(
				'TYPO3\CMS\Core\Log\Monolog\Handler\DatabaseHandler' => array()
			)
		)
	);
	$GLOBALS['TYPO3_CONF_VARS']['MONOLOG']['DataHandler'] = array(
		'processorConfiguration' => array(
			'TYPO3\\CMS\\Core\\Log\\Monolog\\Processor\\Typo3Processor' => array()
		),
		'handlerConfiguration' => array(
			'name' => 'DataHandler',
			'handlers' => array(
				'TYPO3\CMS\Core\Log\Monolog\Handler\DatabaseHandler' => array()
			)
		)
	);
	
