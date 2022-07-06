<?
ini_set('error_reporting', E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
ini_set( "allow_url_fopen",true );

require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
//require_once( "emojilib/lib/mobile_class_8.php" );
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );
require_once( "Pager/Pager.php" );
require_once("HTTP/Request.php");

$pageName = "お店詳細";

$ls    = 0;
($_GET['areaId'])?$areaId = $_GET['areaId']:$areaId = 0;
($_GET['prefectureId'])?$prefectureId = $_GET['prefectureId']:$prefectureId = 0;
($_GET['shopId'])?$shopId = $_GET['shopId']:$shopId = 0;
($_GET['newsId'])?$newsId = $_GET['newsId']:$newsId = 0;


// お気に入り と 閲覧履歴
if (!empty($_SESSION['user_id'])) {

    // お気に入り
    $good = $db->getOne( "SELECT `user_id` FROM `log` WHERE `shop_id` = ? AND `user_id` = ? AND `good` = ?", array( $_GET['shopId'], $_SESSION['user_id'], 1 ) );

    // 閲覧履歴
    $user_id = $db->getOne( "SELECT `user_id` FROM `log` WHERE `shop_id` = ? AND `user_id` = ?", array( $_GET['shopId'], $_SESSION['user_id'] ) );
    if(!empty($user_id)){
        $db->query( "UPDATE `log` SET `history` = ? WHERE `shop_id` = ? AND `user_id` = ?", array( 1, $_GET['shopId'], $_SESSION['user_id'] ) );
    }else{
        $db->query( "INSERT `log` ( `shop_id`,`user_id`,`history`,`created_date` ) VALUES ( ?, ?, ?, ? ) ", array( $_GET['shopId'], $_SESSION['user_id'], 1, date('Y-m-d H:i:s') ) );
    }
}


$selectDataArray = array( $_GET['shopId'] );

/* --- 店舗情報の取得 --- */
$shopData = $db->getRow( "SELECT * FROM `shopMaster` WHERE `shopId` = ? ", $selectDataArray );

    $shopData['imgIdBan'] = $db->getOne("SELECT `imgId` FROM `image` WHERE `model` = ? AND `shopId` = ?", array( 0, $shopData['shopId'] ) );
    $shopData['imgIdGal'] = $db->getOne("SELECT `imgId` FROM `image` WHERE `model` = ? AND `shopId` = ?", array( 1, $shopData['shopId'] ) );
    $shopData['areaName'] = $areaArray[$shopData['areaId']];
    $shopData['prefectureName'] = $prefectureArray[$shopData['prefectureId']];
    $shopData['genreName'] = $genreArray[$shopData['genreId']];
    $shopData['areaName'] = $areaArray[$shopData['areaId']];
    if(strlen($shopData['URL']) > 25){
        $shopData['URLStr'] = subStr($shopData['URL'],0 ,25) . '<br />' . subStr($shopData['URL'],25 ,80 );
    }else{
        $shopData['URLStr'] = $shopData['URL'];
    }

    //アイコンリスト取得
    $iconListArray = explode('|', $shopData['iconList']);
    foreach( $iconListArray AS $key => $value ){
        if(!empty($value)){
            $shopData[$value]["icon"] = $value;
            if( in_array( $value, $iconListArray ) ) $shopData["icon"][$value]["iconList"] = 1;
        }
    };

    //新着情報の日付を取得
    $timestamp = $db->getOne("SELECT UNIX_TIMESTAMP(`dateTime`) FROM `whatsNew` WHERE `shopId` = ? ORDER BY `dateTime` DESC LIMIT !", array($shopData['shopId'], 1));
    if($timestamp){
        if($timestamp > strtotime('-1 day')){
            $shopData['iconNew'] = 1;
        }
    }


/* --- 新着情報の取得 --- */
if( $newsId ){
    $result = $db->query( "SELECT `imgId`, `title`, `dateTime`, `areaId`, `comment`, `file`, `filePath` FROM `whatsNew` WHERE `imgId` = ? ", array( $newsId ) );
}else{
    $result = $db->query( "SELECT `imgId`, `title`, `dateTime`, `areaId`, `comment`, `file`, `filePath` FROM `whatsNew` WHERE `shopId` = ? ORDER BY `dateTime` DESC LIMIT 10", $selectDataArray );
}
$i = 1;
while( $row = $result -> fetchRow() ){
    $news[$i]['imgId']    = $row['imgId'];
    $news[$i]['title']    = htmlspecialchars( $row['title'] );
    $news[$i]['comment'] = strip_tags($row['comment']);
    $news[$i]['dateTime'] = $row['dateTime'];
    $news[$i]['file'] = $row['file'];

    //画像ファイルが存在するかどうかチェック
    if( $row['filePath'] ){
        $url = $row['filePath'];
        $contents = file_get_contents($url, NULL, NULL, 0, 10);
        if (!$contents) unset( $news[$i]['filePath'] );
    }

    $i++;
}

$smarty = new Smarty;

$smarty->assign ( "shopData", $shopData );
$smarty->assign ( "news", $news );
$smarty->assign ( "banner", $banner );
$smarty->assign ( "recommendBannerOther", $recommendBannerOther );
$smarty->assign ( "iconArray", $iconArray );
$smarty->assign ( "emjArray", $emjArray );
$smarty->assign ( "prtData", $prtData );
$smarty->assign ( "areaArray", $areaArray );
$smarty->assign ( "areaId", $areaId );
$smarty->assign ( "prefectureId", $prefectureId );
$smarty->assign ( "shopId", $shopId );
$smarty->assign ( "pageName", $pageName );
$smarty->assign ( "prefectureArray", $prefectureArray );
$smarty->assign ( "newsId", $newsId );

if(!empty($good)) $smarty->assign ( "good", $good );

$smarty->assign ( "areaIdSelect", $_GET['areaId'] );
$smarty->display( 'shop.tpl' );


//if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
//   $smarty->assign ( "areaIdSelect", $_GET['areaId'] );
//   $smarty->display( 'shop.tpl' );
//}elseif(GetMobileCareer(0) == "smartPhone"){
//   $smarty->display( 'shopSP.tpl' );
//}else{
//    $smarty->assign ( "areaIdSelect", $_GET['areaId'] );
//    mb_convert_variables("SJIS-WIN", "UTF-8", $smarty);
//    $smarty->assign ( "emjArray", $emjArray );
//    $template = $smarty->display("shopM.tpl");
//}

?>