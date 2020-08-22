<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

global $DB;
$strDBType = strtolower($DB->type);

Loader::registerAutoLoadClasses(
	'kreativ.abook',
	array(
		'Kreativ\Abook\AbookTable' => 'lib/abook.php'	
	)
);
?>