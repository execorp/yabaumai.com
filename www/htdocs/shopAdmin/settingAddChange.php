<?
require_once( "../inc/auth.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
require_once( "DB.php" );

require_once( "./adminConfig.php" );

$prtCategory = "setting";
$prtTitle = "設定管理";
$prtPage = "登録・修正";

$smarty = new Smarty;
$smarty->assign( 'domain', $domain );
$smarty->assign( 'category', $_GET["category"] );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtCategory', $prtCategory );
$smarty->assign( 'prtTitle', $prtTitle );
$smarty->assign( 'prtPage', $prtPage );
$smarty->assign( 'prtFooter', $prtFooter );
$smarty->display( 'settingAddChange.tpl' );

?>
