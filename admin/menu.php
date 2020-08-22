<?
IncludeModuleLangFile(__FILE__);

if($APPLICATION->GetGroupRight("kreativ.abook")>"D")
{

  $aMenu = array(
    "parent_menu" => "global_menu_services", 
    "sort"        => 100,
    "url"         => "kreativ.abook_admin_list.php?lang=".LANGUAGE_ID,
    "text"        => getMessage("menu_text"),
    "title"       => getMessage("menu_title"),
    "icon"        => "", 
    "page_icon"   => "",
    "items_id"    => "menu_kreativ_abook",
    "items"       => array(),
  );


  return $aMenu;
}

return false;
?>