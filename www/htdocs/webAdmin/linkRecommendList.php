<?
/*---------------------------------------------------------------------
/* INCLUDE（外部CLASS・CONFIG読込処理）
----------------------------------------------------------------------*/
//CONFIG読込
require_once( "../inc/.ht_Config.php" );
//PEAR:QuickForm読込
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
//PEAR:DB読込
require_once( "DB.php" );
require_once( "./menu.php" );

/*---------------------------------------------------------------------
/* INIT（変数設定・初期化）
----------------------------------------------------------------------*/
$contId = 'linkRecommend'; //コンテンツID
$contName = 'サイドリンク'; //コンテンツ名
$tableName = 'recommendBanner'; //テーブル名
//機能名
if( !$_POST["mode"]){
    $funcName = '新規登録';
}else{
    $funcName = '情報修正';
}
$selectDataArray = array( $_POST["imgId"] );
if( !$_REQUEST["areaId"] ) $_REQUEST["areaId"] = 0;
/*---------------------------------------------------------------------
/* DAO（DB処理 ⇒ 外部CLASS化推奨）
----------------------------------------------------------------------*/
$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

if( isset( $_POST["delChk"] ) AND isset( $_POST["imgId"] ) AND ( $_POST["delChk"] == $_POST["imgId"] ) ){
    $selectDataArray = array( $_POST["imgId"] );
    $areaId = $db->getOne( "SELECT `areaId` FROM `" . $tableName . "` WHERE `imgId` = ? ", $selectDataArray );

    $deleteDataArray = array( $_POST["imgId"] );
    $db->query( "DELETE FROM `" . $tableName . "` WHERE `imgId` = ? ", $deleteDataArray );

    $selectDataArray = array( $areaId );
    $MyResult = $db->query( "SELECT `imgId` FROM `" . $tableName . "` WHERE `areaId` = ? ORDER BY `priority`", $selectDataArray );
        $i = "1";
        while( $row = $MyResult->fetchRow() ){
            $sortArray[$i] = $row["imgId"];
            $i++;
        }

    for( $i=1; $i <= count( $sortArray ); $i++ ){
        $updateDataArray = array( $i, $sortArray[$i] );
        $db->query( "UPDATE `" . $tableName . "` SET `priority` = ? WHERE `imgId` = ? ", $updateDataArray );
    }
}

$MyCount = $db->getOne( "SELECT count( `imgId` ) FROM `" . $tableName . "` " );
$MyResult = $db->query( "SELECT `imgId`, `name`, `url`, `areaId` , `priority` , `file` FROM `" . $tableName . "` ORDER BY `areaId`, `priority` " );
//var_dump( $db );
    $i = 1;
    while( $row = $MyResult->fetchRow() ){
        $prtMySQLResult[$i]["imgId"] = $row["imgId"];
        $prtMySQLResult[$i]["name"]  = $row["name"];
        $prtMySQLResult[$i]["url"]   = $row["url"];
        $prtMySQLResult[$i]["file"] = $row["file"];
        $prtMySQLResult[$i]["areaId"] = $row["areaId"];
        $prtMySQLResult[$i]["priority"] = $row["priority"];
        $prtMySQLResult[$i]["areaIdStr"] = $areaRecommendBannerArray[$row["areaId"]];
        $i++;
    }

for($i=0;$i<=count($areaRecommendBannerArray);$i++){
	$listAreaId[$i] = $areaRecommendBannerArray[$i];
}

/*---------------------------------------------------------------------
/* VIEW（表示準備処理）
----------------------------------------------------------------------*/
$smarty = new Smarty;
$smarty->assign( 'prtMySQLResult', $prtMySQLResult );
$smarty->assign( 'MyCount', $MyCount );
$smarty->assign( 'menu', $menu );

//ページ内容表示パス定義
$smarty->assign( 'domain', $DOMAIN ); //ドメイン名
$smarty->assign( 'siteName', $SITE_NAME ); //サイト名
$smarty->assign( 'contName', $contName ); //コンテンツ名
$smarty->assign( 'contId', $contId ); //コンテンツID
$smarty->assign( 'tableName', $tableName ); //テーブル名
$smarty->assign( 'funcName', $funcName ); //機能名
$smarty->assign( 'listAreaId', $listAreaId ); //リストエリア
$smarty->assign( 'areaId', $_REQUEST["areaId"] ); //現在の表示エリア
$smarty->assign( 'imgFlg', $_GET["imgFlg"] ); //現在の表示エリア
	
//共通テンプレートパス定義
$smarty->assign( 'headerPath', $ADMIN_HEAD_PATH ); //ヘッダパス
$smarty->assign( 'menuPath', $ADMIN_MENU_PATH ); //メニューパス
$smarty->assign( 'footerPath', $ADMIN_FOOT_PATH ); //フッタパス
$smarty->assign( 'incDir', $INC_DIR ); //INCフォルダパス

//テンプレートを表示
$smarty->display( $contId . 'List.tpl' );

?>