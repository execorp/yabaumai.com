<?
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
//require_once( "emojilib/lib/mobile_class_8.php" );
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );

$pageName = "会社概要";
($_GET['genre'])? $genre = $_GET['genre']:$genre = 1;

$smarty = new Smarty;
$smarty->assign ( "emjArray", $emjArray );
$smarty->assign ( "banner", $banner );
$smarty->assign ( "link", $link );
$smarty->assign ( "areaArray", $areaArray );
$smarty->assign ( "banner", $banner );
$smarty->assign ( "pageName", $pageName );
$smarty->assign( 'genre', $genre );

$smarty->assign( 'other_page', 1 );

$smarty->display( 'gaiyou.tpl' );

//if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
//    $smarty->display( 'gaiyou.tpl' );
//}elseif(GetMobileCareer(0) == "smartPhone"){
//   $smarty->display( 'gaiyouSP.tpl' );
//}else{
//    $smarty->assign ( "areaIdSelect", $_GET['areaId'] );
//    mb_convert_variables("SJIS-WIN", "UTF-8", $smarty);
//    $smarty->assign ( "emjArray", $emjArray );
//    $template = $smarty->display("gaiyouM.tpl");
//}
