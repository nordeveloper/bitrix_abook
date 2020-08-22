<?
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_admin_before.php");

$iModuleID = "kreativ.abook";
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$iModuleID."/include.php");

$CONS_RIGHT = $APPLICATION->GetGroupRight($iModuleID);   
if($CONS_RIGHT != "W")
{
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

use Bitrix\Main;
use Kreativ\Abook\AbookTable;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

if($_REQUEST['ID']>0 and $_REQUEST['action_button']=='delete'){
	\Kreativ\Abook\AbookTable::delete($_REQUEST['ID']);	
}

$APPLICATION->SetTitle(Loc::getMessage("kreativ.abook_TITLE"));

$sTableID = "tbl_abook_list";
$oSort = new CAdminSorting($sTableID, "ID", "asc");
$adminList = new CAdminList($sTableID, $oSort);

$arFilterFields = Array(
	"find_id",
	"find_fio",
	"find_email",
	"find_phone",
);

$adminList->InitFilter($arFilterFields);

$arFilter = array();

$itemsList = AbookTable::getList(array(
	'order' => array($by => $order),
));

$rsData = new CAdminResult($itemsList, $tableID);
$rsData->NavStart();

$adminList->NavText($rsData->GetNavPrint(Loc::getMessage("PAGES")));

$arHeaders = Array(
      array(
        "id" => "ID",
        "content" => 'ID',
        "sort" => "ID",
        "default" => true
      ),
	  array("id" =>"FIO",
		"content"  =>Loc::getMessage("FIO"),
		"sort"     =>"FIO",
		"default"  =>true,
	  ),
	  array("id"   =>"EMAIL",
		"content"  =>Loc::getMessage("EMAIL"),
		"sort"     =>"EMAIL",
		"default"  =>true,
	  ),
	  array("id"    =>"PHONE",
		"content"  =>Loc::getMessage("PHONE"),
		"sort"     =>"PHONE",
		"default"  =>true,
	  ),
	  array("id"    =>"COMPANY",
		"content"  =>Loc::getMessage("COMPANY"),
		"sort"     =>"COMPANY",
		"default"  =>true,
	  ),
	  array("id"    =>"POSITION",
		"content"  =>Loc::getMessage("POSITION"),
		"sort"     =>"POSITION",
		"default"  =>true,
	  ),
	  array("id"    =>"SPECIALIZATION",
		"content"  =>Loc::getMessage("SPECIALIZATION"),
		"sort"     =>"SPECIALIZATION",
		"default"  =>true,
	  ),
	  array("id"    =>"COUNTRY",
		"content"  =>Loc::getMessage("COUNTRY"),
		"sort"     =>"COUNTRY",
		"default"  =>true,
	  ),	  
	  array("id"    =>"CITY",
		"content"  =>Loc::getMessage("CITY"),
		"sort"     =>"CITY",
		"default"  =>true,
	  ),
	  array("id"    =>"ADDRESS",
		"content"  =>Loc::getMessage("ADDRESS"),
		"sort"     =>"ADDRESS",
		"default"  =>true,
	  ),	  
	  
    );

$adminList->AddHeaders($arHeaders);

while($item = $rsData->NavNext())
{
	$id = intval($item['ID']);	

	$row = &$adminList->AddRow($item["ID"], $item);
	
	$arActions = array();
	$arActions[] = array(
		"ICON" => "edit",
		"TEXT" => GetMessage("kreativ.abook_UPDATE_ALT"),
		"ACTION" => $adminList->ActionRedirect("kreativ.abook_admin_edit.php?lang=".LANGUAGE_ID."&ID=".$item["ID"]),
		"DEFAULT" => true
	);
	
	$arActions[] = array(
		"SEPARATOR" => true
	);	
	
	if ($CONS_RIGHT>="W")
	$arActions[] = array(
		"ICON" => "delete",
		"TEXT" => GetMessage("kreativ.abook_DELETE_ALT"),
		"ACTION" => "if(confirm('".GetMessageJS('kreativ.abook_DELETE_JS')."')) ".$adminList->ActionDoGroup($item["ID"], "delete")
	);	
	$row->AddCheckField("VISIBLE");
	$row->AddActions($arActions);	
};

if(isset($row))
	unset($row);
	

// резюме таблицы
$adminList->AddFooter(
  array(
    array("title"=>GetMessage("MAIN_ADMIN_LIST_SELECTED"), "value"=>$rsData->SelectedRowsCount()), // кол-во элементов
    array("counter"=>true, "title"=>GetMessage("MAIN_ADMIN_LIST_CHECKED"), "value"=>"0"), // счетчик выбранных элементов
));

// групповые действия
$adminList->AddGroupActionTable(Array(
  "delete"=>GetMessage("MAIN_ADMIN_LIST_DELETE"), // удалить выбранные элементы
  "activate"=>GetMessage("MAIN_ADMIN_LIST_ACTIVATE"), // активировать выбранные элементы
  "deactivate"=>GetMessage("MAIN_ADMIN_LIST_DEACTIVATE"), // деактивировать выбранные элементы
));

$aContext = array(	
	array(
		"TEXT" => Loc::getMessage("kreativ.abook_CONTACT_ADD"),
		"ICON" => "btn_new",
		"LINK" => "kreativ.abook_admin_edit.php?lang=".LANGUAGE_ID,
		"TITLE" => Loc::getMessage("kreativ.abook_CONTACT_ADD_TITLE")
	),
);

$adminList->AddAdminContextMenu($aContext);

$adminList->CheckListMode();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$adminList->DisplayList();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>