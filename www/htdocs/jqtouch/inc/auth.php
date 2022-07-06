<?
/*
2010/03/12  1.00   認証処理完成

**** 必須項目
** ファイル
Auth.php ( pear/Auth )
/inc/auth.php ( 本体 )

** 使用方法
アクセス制限したいファイルの先頭で require( '/inc/auth.php' ) する

** 変数
$params ( pear/Auth 設定変数 )

** 依存ファイル
/webAdmin/logIn.php ( 認証CMS )
/webAdmin/passAddChange.php ( ID PASS 設定用CMS )

Auther kouji@execute.jp
*/

$version = "1.00";

require_once( "Auth.php" );
require_once( "/home/hakui-angel/www/htdocs/inc/.ht_Config.php" );

/* --- セッティング確認 --- */
unset( $settingError  );
if( !is_array( $params ) )                                   $settingError[] = "認証用配列が見つかりません";

if( $settingError ){
//    echo $_SERVER['PHP_SELF'] . " ファイル でのセッティングエラー<hr />\n";
    echo "/inc/auth.php ( " . $_SERVER['PHP_SELF'] . " ) ファイル でのセッティングエラー<hr />\n";  //require前提のファイルなので
    foreach( $settingError AS $key => $value ){
        echo $value . "<br />\n";
    }
    exit;
}
/* --- セッティング確認/ --- */


$authObj = new Auth( "DB", $params, "loginFunction" );

/* --- useFlg が使用 (useFlg == 1 OK )になっていない場合強制ログアウト ---  */
if( isset( $_SESSION['_authsession']['data']['useFlg'] ) AND $_SESSION['_authsession']['data']['useFlg'] != 1 ){
    $authObj -> logout();
    ob_end_clean();

    header("Location: ./logIn.php");
    exit;
}

$updateDataArray = array( date ( "Y-m-d H:i:s", mktime ( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) ), $_SESSION['_authsession']['data']['userId'] );
$db->query( "UPDATE `loginMaster` SET `lastLogin` = ? WHERE `userId` = ? ", $updateDataArray );


if ( !$authObj->getAuth() ){
    unset( $_SESSION );
    unset( $REFERER );

    if( $_SERVER['REQUEST_URI'] != "/webAdmin/" ) $REFERER = "?p=" . base64_encode( rtrim( ereg_replace( "/webAdmin/", "", $_SERVER['REQUEST_URI'] ), "/" ) );

    Header( "Location: ./logIn.php" . $REFERER );
    exit;
}
?>