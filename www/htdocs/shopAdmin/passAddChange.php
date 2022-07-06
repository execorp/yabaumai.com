<?php
/*
2010/03/13  1.02   セッティングエラー処理追加
2010/03/13  1.01   スーパーユーザー処理 BUG修正
2010/03/12  1.00   代理店処理追加
2010/03/12  0.99   IPリストにより exe管理制限

Auther kouji@execute.jp


**** 必須項目
** ファイル
/webAdmin/passAddChange.php ( 本体 )
/webAdmin/templates/passAddChange.tpl ( 変更用テンプレート )
/webAdmin/templates/passAddChangeFalt.tpl ( 変更不可用テンプレート )

** 変数
$ipArrowListArray ( 許可IP )

** SQL
CREATE TABLE `loginMaster` (
  `userId` int(3) NOT NULL auto_increment,
  `loginId` varchar(20) NOT NULL,
  `passWord` varchar(20) NOT NULL,
  `userName` varchar(100) default NULL,
  `userLevel` int(1) default NULL,
  `useFlg` int(1) default '0',
  `lastLogin` datetime default NULL,
  PRIMARY KEY  (`userId`),
  KEY `userName` (`userName`),
  KEY `userLevel` (`userLevel`),
  KEY `lastLogin` (`lastLogin`),
  KEY `loginId` (`loginId`),
  KEY `passWord` (`passWord`)
) ENGINE=MyISAM  DEFAULT CHARSET=sjis;

INSERT INTO `loginMaster` ( `userId`, `loginId`, `passWord`, `userName`, `userLevel`, `useFlg`, `lastLogin`) VALUES(1, 'kouji', '!462', NULL, 0, 1, NULL );
INSERT INTO `loginMaster` ( `userId`, `loginId`, `passWord`, `userName`, `userLevel`, `useFlg`, `lastLogin`) VALUES(2, 'execute', '!1188', NULL, 0, 1, NULL );
*/

$version = "1.02";

$prtCategory = "setting";
$prtTitle    = "設定管理";
$prtPage     = "ログイン設定";


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
if( !is_array( $ipArrowListArray ) )                                   $settingError[] = "許可IP配列が見つかりません";
if( !file_exists( "./templates/passAddChange.tpl" ) )                  $settingError[] = "passAddChange.tplが見つかりません";
if( !file_exists( "./templates/passAddChangeFalt.tpl" ) )              $settingError[] = "passAddChangeFalt.tplが見つかりません";
if( !$db->getOne( "SHOW TABLES FROM `" . $MySQLDatabase . "` LIKE 'loginMaster'" ) ) $settingError[] = "loginMasterテーブルが見つかりません";

if( $settingError ){
    echo $_SERVER['PHP_SELF'] . " ファイル でのセッティングエラー<hr />\n";
    foreach( $settingError AS $key => $value ){
        echo $value . "<br />\n";
    }
    exit;
}
/* --- セッティング確認/ --- */

/* exe 以外のログイン時 exe 削除 */
if( $_SESSION['_authsession']['data']['userLevel'] != 0 ) unset( $levelArray[0] );

/* --- 指定IP以外 exe 管理非表示 --- */
if( !in_array( $_SERVER['REMOTE_ADDR'], $ipArrowListArray ) ){
    unset( $levelArray[0] );
    unset( $levelArray[1] );
    $sql = " AND `userLevel` > '1'";
}

if( $_SESSION['_authsession']['data']['userLevel'] > 1 ) unset( $levelArray[1] );

if( $_SESSION['_authsession']['data']['userLevel'] > 2 ){
    $prtPage     = "×権限不足";

    /* --- パスワード管理使用不可 --- */
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

    $smarty->assign( 'errorMessage', $levelArray[$_SESSION['_authsession']['data']['userLevel']] );
    $smarty->display( 'passAddChangeFalt.tpl' );
    exit;
}

/* --- 削除処理 --- */
if( isset( $_POST['submitReg'] ) ){
    foreach( $_POST['loginId'] AS $key => $value ){
        $selectDataArray = array( $key );
        $userId = $db->getOne( "SELECT `userId` FROM `loginMaster` WHERE `userId` = ? ", $selectDataArray );

        if( $_POST['loginId'][$key] AND $_POST['passWord'][$key] ){
            if( $userId ){
                $updateDataArray = array( $_POST['loginId'][$key], $_POST['passWord'][$key], $_POST['userName'][$key], $_POST['userLevel'][$key], $_POST['useFlg'][$key], $key );
                $db->query( "UPDATE `loginMaster` SET `loginId` = ?, `passWord` = ?, `userName` = ?, `userLevel` = ?, `useFlg` = ? WHERE `userId` = ? ", $updateDataArray );
            }else{
                $insertDataArray = array( $_POST['loginId'][$key], $_POST['passWord'][$key], $_POST['userName'][$key], $_POST['userLevel'][$key], $_POST['useFlg'][$key] );
                $db->query( "INSERT INTO `loginMaster` ( `loginId`, `passWord`, `userName`, `userLevel`, `useFlg` ) VALUES ( ?, ?, ?, ?, ? ) ", $insertDataArray );
            }
       }else{
           $deldeDataArray = array( $key );
           $db->query( "DELETE FROM `loginMaster` WHERE `userId` = ? LIMIT 1 ", $deldeDataArray );
       }
    }

    header( "Location: ./passAddChange.php" );
    exit;
}

/* --- パスワード ID 取得 --- */
$mkPassWordForm = new HTML_QuickForm( 'mkPassWord', 'post' );
$selectDataArray = array( $_SESSION['_authsession']['data']['userLevel'] );
$MyResult = $db->query( "SELECT `userId`, `loginId`, `passWord`, `userLevel`, `useFlg` FROM `loginMaster` WHERE `userLevel` >= ?" . $sql ." ORDER BY `userLevel` ", $selectDataArray );
while( $row = $MyResult->fetchRow() ){
    if( $_SESSION['_authsession']['data']['userLevel'] == 0 OR ( $_SESSION['_authsession']['data']['userLevel'] == 1 AND ( $row['userId'] == $_SESSION['_authsession']['data']['userId'] OR $row['userLevel'] > 1 ) ) OR ( $_SESSION['_authsession']['data']['userLevel'] == 2 AND $row['userLevel'] >= 2 ) ){
        $mkPassWordForm->addElement( 'text', "loginId[$row[userId]]", 'ログインID', array( "size" => 25, "maxlength" => 30, "style" => "padding: 1px 2px 1px;" ) );
        $mkPassWordForm->addElement( 'text', "passWord[$row[userId]]", 'ログインPASS', array( "size" => 25, "maxlength" => 30, "style" => "padding: 1px 2px 1px;" ) );
        $mkPassWordForm->addElement( 'select', "userLevel[$row[userId]]", '権限', $levelArray );
        $mkPassWordForm->addElement( 'advcheckbox', "useFlg[$row[userId]]", '使用', null, null, array( 0, 1 ) );

        $defaultValue['loginId'][$row['userId']]   = $row['loginId'];
        $defaultValue['passWord'][$row['userId']]  = $row['passWord'];
        $defaultValue['userLevel'][$row['userId']] = $row['userLevel'];
        $defaultValue['useFlg'][$row['userId']]    = $row['useFlg'];
    }
}


$mkPassWordForm->setDefaults( $defaultValue );

$mkPassWordForm->addElement( 'text', "loginId[0]", 'ログインID', array( "size" => 25, "maxlength" => 30, "style" => "padding: 1px 2px 1px;" ) );
$mkPassWordForm->addElement( 'text', "passWord[0]", 'ログインPASS', array( "size" => 25, "maxlength" => 30, "style" => "padding: 1px 2px 1px;" ) );
$mkPassWordForm->addElement( 'select', "userLevel[0]", '権限', $levelArray );
$mkPassWordForm->addElement( 'advcheckbox', "useFlg[0]", '使用', null, null, array( 0, 1 ) );
$mkPassWordForm->addElement( 'submit', 'submitReg', '登録');

$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$mkPassWordForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );

$smarty->assign( 'version', $version );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'category', $_GET["category"] );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtCategory', $prtCategory );
$smarty->assign( 'prtTitle', $prtTitle );
$smarty->assign( 'prtPage', $prtPage );
$smarty->assign( 'prtFooter', $prtFooter );

$smarty->display( 'passAddChange.tpl' );
?>
