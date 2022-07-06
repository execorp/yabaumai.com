<?
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
require_once( "emojilib/lib/mobile_class_8.php" );
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );

$smarty = new Smarty;
$smarty->assign ( "emjArray", $emjArray );
$smarty->assign ( "prtData", $prtData );
$smarty->assign ( "areaArray", $areaArray );

if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
    $smarty->display( '404.tpl' );
}elseif(GetMobileCareer(0) == "smartPhone"){
    $smarty->display( '404SP.tpl' );
}else{
    $smarty->assign ( "areaIdSelect", $_GET['areaId'] );
    mb_convert_variables("SJIS-WIN", "UTF-8", $smarty);
    $smarty->assign ( "emjArray", $emjArray );
    $template = $smarty->display("404M.tpl");
}
?>