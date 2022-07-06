<?php
/*
2010/03/12  1.00   QRコード表示

Auther kouji@execute.jp


**** 必須項目
** ファイル
/webAdmin/qrCode.php ( 本体 )
/webAdmin/templates/qrCode.tpl ( 表示用テンプレート )

**ライブラリー
qrCode/qrcode.php
qrCode/qrcode_img.php
qrCode/qrcode_data
*/

$version = "1.00";

$prtCategory = "setting";
$prtTitle    = "設定管理";
$prtPage     = "QRコード表示";


require_once( "../inc/auth.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
require_once( "emojilib/lib/mobile_class_8.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "../inc/exe.php" );
require_once( "./adminConfig.php" );


/* --- セッティング確認 --- */
unset( $settingError  );
if( !file_exists( "/usr/share/pear/qrCode/qrcode_img.php" ) ) $settingError[] = "qrCode/qrcode_img.php が見つかりません";
if( !file_exists( "/usr/share/pear/qrCode/qrcode.php" ) )     $settingError[] = "qrCode/qrcode.php が見つかりません";
if( !file_exists( "/usr/share/pear/qrCode/qrcode_data" ) )    $settingError[] = "qrCode/qrcode_data フォルダが見つかりません";
if( !file_exists( "./templates/qrCode.tpl" ) )                $settingError[] = "qrCode.tpl が見つかりません";

if( $settingError ){
    echo $_SERVER['PHP_SELF'] . " ファイル でのセッティングエラー<hr />\n";
    foreach( $settingError AS $key => $value ){
        echo $value . "<br />\n";
    }
    exit;
}
/* --- セッティング確認/ --- */


$smarty = new Smarty;

$smarty->assign( 'version', $version );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'category', $_GET["category"] );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtCategory', $prtCategory );
$smarty->assign( 'prtTitle', $prtTitle );
$smarty->assign( 'prtPage', $prtPage );
$smarty->assign( 'prtFooter', $prtFooter );

$smarty->display( 'qrCode.tpl' );
?>
