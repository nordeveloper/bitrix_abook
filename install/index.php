<?
global $MESS;
$PathInstall = str_replace('\\', '/', __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen('/index.php'));
IncludeModuleLangFile($PathInstall.'/install.php');

Class kreativ_abook extends CModule
{
	var $MODULE_ID = "kreativ.abook";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $PARTNER_NAME;
	var $PARTNER_URI;
	

	function __construct()
	{		
		include(__DIR__.'/version.php');		
		
		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}

		$this->MODULE_NAME = GetMessage("AB_INSTALL_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("AB_INSTALL_MODULE_DESCRIPTION");
		$this->PARTNER_NAME = GetMessage("AB_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("AB_PARTNER_URI");		
	}
	
	
	function InstallFiles()
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/admin'))
		{
			$adminPage = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/admin';
			CopyDirFiles($adminPage, $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/');
		}

		return true;
	}	
	
	
	function UnInstallFiles()
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/admin'))
		{
			unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/kreativ.abook_admin_list.php');
			unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/kreativ.abook_admin_edit.php');
		}
		
		return true;
	}	

	
	function InstallDB()
	{
		global $DB, $APPLICATION;
		
		if (!$DB->Query("SELECT * FROM b_kreativ_abook WHERE 1", true)):
			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/db/".strtolower($DB->type)."/install.sql");
		endif;

		if ($this->errors !== false)
		{
			$APPLICATION->ThrowException(implode("", $this->errors));
			return false;
		}
		
		return true;
	}	
	
	
	function UnInstallDB()
	{	
		global $DB, $APPLICATION;
		$this->errors = false;
			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/db/".strtolower($DB->type)."/uninstall.sql");
			if($this->errors !== false)
			{
				$APPLICATION->ThrowException(implode('', $this->errors));
				return false;
			}
		return true;
	}
	

	function DoInstall()
	{
		global $APPLICATION;		
		$this->InstallDB();
		$this->InstallFiles();
		RegisterModule($this->MODULE_ID);
		$APPLICATION->IncludeAdminFile(GetMessage("AB_INSTALL_TITLE").$this->MODULE_NAME, $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/step.php");
	}
	

	function DoUninstall()
	{
		global $APPLICATION;
		$this->UnInstallDB();
		$this->UnInstallFiles();
		UnRegisterModule($this->MODULE_ID);
		$APPLICATION->IncludeAdminFile(GetMessage("AB_UNINSTALL_TITLE").$this->MODULE_NAME, $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/unstep.php");
	}	

}
?>