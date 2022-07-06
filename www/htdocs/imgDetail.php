<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

require_once( "Smarty/Smarty.class.php" );
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );

if( !isset( $_GET['imgId'] ) AND !$_GET['imgId'] ) exit;

$selectDataArray = array( $_GET['imgId'] );
$prtData = $db->getRow( "SELECT `name`, `age`, `shopId`, `priority` FROM `galImage` WHERE `imgId` = ? ", $selectDataArray );

$prtData['nextImgId']   = 0;
$prtData['beforeImgId'] = 0;

$nextNum = $_GET['num'] + 1;
$beforeNum = $_GET['num'] - 1;

if( $prtData['priority'] < 8 ){
    $selectDataArray = array( $prtData['priority'], $prtData['shopId'] );
    $prtData['nextImgId'] = $db->getOne( "SELECT `imgId` FROM `galImage` WHERE `priority` > ? AND `shopId` = ? ORDER BY `priority` LIMIT 1 ", $selectDataArray );
}

if( $prtData['priority'] > 1 ){
    $selectDataArray = array( $prtData['priority'], $prtData['shopId'] );
    $prtData['beforeImgId'] = $db->getOne( "SELECT `imgId` FROM `galImage` WHERE `priority` < ? AND `shopId` = ? ORDER BY `priority` DESC LIMIT 1 ", $selectDataArray );
}

//Shopデータ
    $selectShopDataArray = array( $prtData['shopId'] );
    $shop = $db->getAll( "SELECT `shopId`, `shopName`, `tel`, `URL`, `RSS`, `price`, `openTime`, `areaId`, `prefectureId`, `genreId`, `iconList`, `comment` FROM `shopMaster` WHERE `shopId` = ? ", $selectShopDataArray );
    
    foreach($shop AS $key => $row){
        $shop[$key]['imgIdBan'] = $db->getOne("SELECT `imgId` FROM `image` WHERE `model` = ? AND `shopId` = ?", array( 0, $row['shopId'] ) );
        $shop[$key]['areaName'] = $areaArray[$row['areaId']];
        $shop[$key]['prefectureName'] = $prefectureArray[$row['prefectureId']];
        $shop[$key]['genreName'] = $genreArray[$row['genreId']];
    }

$pageName = "詳細画像";

$smarty = new Smarty;
$smarty->assign ( "imgId", $_GET['imgId'] );
$smarty->assign ( "num", $_GET['num'] );
$smarty->assign ( "nextNum", $nextNum );
$smarty->assign ( "beforeNum", $beforeNum );
$smarty->assign ( "prtData", $prtData );
$smarty->assign ( "shop", $shop );

$smarty->display( 'imgDetail.tpl' );

//if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
//   $smarty->display( 'imgDetail.tpl' );
//}else{
//    echo $emoji_obj->replace_emoji( $smarty->fetch( "imgDetailM.tpl" ) );
//}

?>