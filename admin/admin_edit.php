<? 
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_admin_before.php");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$iModuleID = "kreativ.abook";

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$iModuleID."/include.php");

use Bitrix\Main;
use Kreativ\Abook\AbookTable;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$CONS_RIGHT = $APPLICATION->GetGroupRight($iModuleID);   
if($CONS_RIGHT != "W")
{
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

$errorMessage = '';
$message = null;

if($_REQUEST['ID']>0){
	$ID = $_REQUEST['ID'];
}

if($ID > 0)
	$APPLICATION->SetTitle(str_replace("#ID#", $ID, Loc::getMessage("kreativ.abook_TITLE_EDIT")));
else
	$APPLICATION->SetTitle(Loc::getMessage("kreativ.abook_TITLE_ADD"));

$aMenu = array(
	array(
		"TEXT" => Loc::getMessage("kreativ.abook_BTN_LIST"),
		"LINK" => "/bitrix/admin/kreativ.abook_admin_list.php?lang=".LANGUAGE_ID,
		"ICON" => "btn_list"
	)
);

$context = new CAdminContextMenu($aMenu);
$context->Show();

$return_url = '/bitrix/admin/kreativ.abook_admin_list.php?lang='.LANGUAGE_ID;

	if($ID>0){
		$result = AbookTable::getById($ID);
		$row = $result->fetch();
		
		if($_REQUEST['UPDATE']=="Y"){
			$res = \Kreativ\Abook\AbookTable::update($ID,
					array(
						"ACTIVE"=>strip_tags($_REQUEST['ACTIVE']),
						"SORT"=>intval($_REQUEST['SORT']),
						"FIO"=>strip_tags($_REQUEST['FIO']),
						"EMAIL"=>strip_tags($_REQUEST['EMAIL']),
						"PHONE"=>strip_tags($_REQUEST['PHONE']),
						"COMPANY"=>strip_tags($_REQUEST['COMPANY']),
						"POSITION"=>strip_tags($_REQUEST['POSITION']),
						"SPECIALIZATION"=>strip_tags($_REQUEST['SPECIALIZATION']),
						"COUNTRY"=>strip_tags($_REQUEST['COUNTRY']),
						"CITY"=>strip_tags($_REQUEST['CITY']),
						"ADDRESS"=>strip_tags($_REQUEST['ADDRESS'])
					)
				);
			
			if($res->isSuccess()){
				LocalRedirect($return_url);				
			}
		}
		
		
	}else{
		
		if($_REQUEST['UPDATE']=="Y"){
			$res = \Kreativ\Abook\AbookTable::add(
				array(
					"ACTIVE"=>strip_tags($_REQUEST['ACTIVE']),
					"SORT"=>intval($_REQUEST['SORT']),
					"FIO"=>strip_tags($_REQUEST['FIO']),
					"EMAIL"=>strip_tags($_REQUEST['EMAIL']),
					"PHONE"=>strip_tags($_REQUEST['PHONE']),
					"COMPANY"=>strip_tags($_REQUEST['COMPANY']),
					"POSITION"=>strip_tags($_REQUEST['POSITION']),
					"SPECIALIZATION"=>strip_tags($_REQUEST['SPECIALIZATION']),
					"COUNTRY"=>strip_tags($_REQUEST['COUNTRY']),
					"CITY"=>strip_tags($_REQUEST['CITY']),
					"ADDRESS"=>strip_tags($_REQUEST['ADDRESS']),
				)
			);
			
			if($res->isSuccess()){
				LocalRedirect($return_url);				
			}			
			
		}
		
	}

?>

<form method="POST" Action="<?echo $APPLICATION->GetCurPage()?>" ENCTYPE="multipart/form-data" name="post_form">
<?
$aTabs = array(
	array(
	"DIV" => "edit1",
	"TAB" => Loc::getMessage("kreativ.abook_TAB_1"),
	"ICON" => "sale", 
	"TITLE" => Loc::getMessage("kreativ.abook_TAB_1_TITLE")
	),
);

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$tabControl->Begin();
$tabControl->BeginNextTab();
?>

   <?echo bitrix_sessid_post();?>
   
   <input type="hidden" name="UPDATE" value="Y">
   <input type="hidden" name="from" value="">
   <input type="hidden" name="return_url" value="<?=$return_url?>">
   <input type="hidden" name="lang" value="<?=LANG?>">
   <? if($ID>0):?>
   <input type="hidden" name="ID" value="<?=$ID?>">
   <? endif?>
   
   <? if($ID>0):?>
   <? foreach($row as $key=>$val): ?>
       <? if($key=='ID') continue ?>   
      <? $label = 'LABEL_'.$key ?>   
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage($label)?></td>
			<td class="adm-detail-content-cell-r">
			<? if($key=="ACTIVE"){
				$input_type = "checkbox";
			  }else{$input_type = 'text';}
			  if($val=='Y'){$checked = 'checked=checked';}
			  else{$checked = '';}
			?>
			<input type="<?=$input_type ?>" name="<?=$key?>" <?=$checked?> value="<?=$val?>">
			</td>
		</tr>   
   <? endforeach ?>
   <? else: ?>
   
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_ACTIVE')?></td>
			<td class="adm-detail-content-cell-r"><input type="checkbox" name="ACTIVE" checked value="Y"></td>
		</tr>
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_SORT')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="SORT" value="500"></td>
		</tr>		
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_FIO')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="FIO" value=""></td>
		</tr>
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_EMAIL')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="EMAIL" value=""></td>
		</tr>
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_PHONE')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="PHONE" value=""></td>
		</tr> 
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_COMPANY')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="COMPANY" value=""></td>
		</tr>
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_POSITION')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="POSITION" value=""></td>
		</tr>
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_SPECIALIZATION')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="SPECIALIZATION" value=""></td>
		</tr>		
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_COUNTRY')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="COUNTRY" value=""></td>
		</tr>
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_CITY')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="CITY" value=""></td>
		</tr>
		<tr>
			<td class="adm-detail-content-cell-l"><?=Loc::getMessage('LABEL_ADDRESS')?></td>
			<td class="adm-detail-content-cell-r"><input type="text" name="ADDRESS" value=""></td>
		</tr>		
   
   <? endif ?>

<?
$tabControl->Buttons(
	array(
		"disabled" => ($CONS_RIGHT < "W"),
		"back_url" => "/bitrix/admin/kreativ.abook_admin_list.php?lang=".LANGUAGE_ID
	)
);
?>

<?
$tabControl->EndTab();
$tabControl->End();
?>
</form>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>