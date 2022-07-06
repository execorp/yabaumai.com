<?
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
require_once("../inc/.ht_Config.php");
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

mb_language("Japanese");
mb_internal_encoding("SJIS");

$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

/*---------------------------------------------------------------------
/* INIT
----------------------------------------------------------------------*/
$limit = 30;

$ls    = 0;
if( @$_REQUEST["ls"] ) $ls = @$_REQUEST["ls"] * $limit - $limit;


if(  @isset( $_POST["imgId"] ) AND @$_POST["delChk"] == @$_POST["imgId"] ){
    $db->query( "DELETE FROM `coverImage` WHERE `imgId` = ?", array( $_POST["imgId"] ));
}

if(  @isset( $_POST["imgId"] ) AND @$_POST["changed"] ){
    $db->query( "UPDATE `coverImage` SET `prtFlg` = ? WHERE `imgId` = ?", array($_POST['prtFlg'], $_POST['imgId']) );
}

if( isset( $_GET["t"] ) AND isset( $_GET["imgId"] ) ){
    switch( $_GET["t"] ){
        case 'u':
            $targetPriority = $_GET["p"] - 1;
            //—Dæ‡ˆÊ‚ð +1
            $db -> query( "UPDATE `coverImage` SET `priority` = `priority` + 1 WHERE `priority` >= ? ", array($targetPriority) );
        break;

        case 'd':
            $targetPriority = $_GET["p"] + 1;
            //—Dæ‡ˆÊ‚ð -1
            $db -> query( "UPDATE `coverImage` SET `priority` = `priority` - 1 WHERE `priority` <= ? ", array($targetPriority) );
        break;
    }

    $db->query( "UPDATE `coverImage` SET `priority` = ? WHERE `imgId` = ?", array($targetPriority, @$_GET[imgId]) );
    $MyResult = $db->query( "SELECT `imgId`, `priority` FROM `coverImage` ORDER BY `priority`", array());

    $i = 1;
    while( $row = $MyResult->fetchRow() ){
        $sortArray[$i] = $row["imgId"];
        $i++;
    }

    foreach( $sortArray AS $key => $value ){
        $db -> query( "UPDATE `coverImage` SET `priority` = ? WHERE `imgId` = ?", array($key, $value));
    }
}

	$shopArray = $db->getAssoc('SELECT `shopId`, `shopName` FROM `shopMaster`');
    $MyCount = $db->getOne( "SELECT count( `imgId` ) FROM `coverImage` " );
    $prtMySQLResult = $db->getAll( "SELECT `imgId`, `galName`, `areaId`, `shopId`, `priority`, `prtFlg`, `file` FROM `coverImage` ORDER BY `priority`", array() );
	foreach($prtMySQLResult AS $key => $row){
		$prtMySQLResult[$key]['areaName'] = $areaArray[$row['areaId']];
		$prtMySQLResult[$key]['shopName'] = $shopArray[$row['shopId']];
	}

$smarty = new Smarty;
$smarty->assign( 'prtData', @$prtData );
$smarty->assign( 'prtMySQLResult', $prtMySQLResult );
$smarty->assign( 'MyCount', $MyCount );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'contName', 'ƒJƒo[ƒK[ƒ‹' );
$smarty->assign( 'funcName', '“o˜^' );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtTitle', @$prtTitle );
if( @$imgId ) $smarty->assign( 'imgId', $imgId );
if( @$file ) $smarty->assign( 'file', $file );

$smarty->display( 'coverList.tpl' );
?>