<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);
//ini_set( "allow_url_fopen",true );

require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
//require_once( "emojilib/lib/mobile_class_8.php" );
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );
require_once( "Pager/Pager.php" );
require_once("HTTP/Request.php");

$pageName = "トップ";

$ls    = 0;
($_GET['areaId'])?$areaId = $_GET['areaId']:$areaId = 0;
($_GET['prefectureId'])?$prefectureId = $_GET['prefectureId']:$prefectureId = 0;
($_GET['newsId'])?$newsId = $_GET['newsId']:$newsId = 0;

/* --- 新着情報の取得 --- */
( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' )?$newsLimit = 20:$newsLimit = 3;

if( $newsId ){
    //新着情報詳細表示
    $news = $db->getRow( "SELECT `imgId`, `title`, `dateTime`, `areaId`, `comment`, `file`, `filePath`, `shopId` FROM `whatsNew` WHERE `imgId` = ? ", array( $newsId ) );
    $news['title'] = htmlspecialchars( $news['title'] );
    $news['comment'] = strip_tags($news['comment']);

    //画像ファイルが存在するかどうかチェック
    if( $news['filePath'] ){
        $url = $news['filePath'];
        $contents = file_get_contents($url, NULL, NULL, 0, 10);
        if (!$contents) unset( $news['filePath'] );
    }
    if( isset( $news['shopId'] ) AND $news['shopId'] > 0 ){
        $selectDataArray     = array( $news['shopId'] );
        $news = array_merge( $news, $db->getRow( "SELECT `shopName`, `tel`, `URL`, `prefectureId` FROM `shopMaster` WHERE `shopId` = ? ", $selectDataArray ) );
    }
/*
}elseif($areaId){
    //エリア新着情報一覧表示
    $news = $db->getAll( "SELECT `imgId`, `title`, `dateTime` FROM `whatsNew` WHERE `areaId` = ? ORDER BY `dateTime` DESC LIMIT !", array( $areaId, $newsLimit ) );
*/
}else{
    //トップ・エリア新着情報一覧表示
    //エリアの場合
    if($areaId){
        $selectDataArray = array( $areaId );
        $result  = $db->limitQuery( "SELECT `imgId`, `title`, `dateTime`, `areaId`, `comment`, `file`, `filePath`, `shopId` FROM `whatsNew` WHERE `areaId` = ? ORDER BY `dateTime` DESC ", 0, $newsLimit, $selectDataArray );
    }else{
        $result  = $db->limitQuery( "SELECT `imgId`, `title`, `dateTime`, `areaId`, `comment`, `file`, `filePath`, `shopId` FROM `whatsNew` ORDER BY `dateTime` DESC ", 0, $newsLimit );
    }
    $i = 1;

    while( $row = $result -> fetchRow() ){
        $news[$i]['imgId']    = $row['imgId'];
        $news[$i]['title']    = htmlspecialchars( $row['title'] );
        $news[$i]['dateTime'] = $row['dateTime'];
        $news[$i]['shopId']     = $row['shopId'];
        $news[$i]['comment'] = $row['comment'];
        $news[$i]['file'] = $row['file'];
        $news[$i]['filePath'] = $row['filePath'];

        $selectDataArray = array( $row["shopId"] );
        $shopData = $db->getRow( "SELECT `shopName`, `tel`, `URL` FROM `shopMaster` WHERE `shopId` = ? ", $selectDataArray );
        $news[$i]['shopName']     = $shopData['shopName'];
        $news[$i]['tel']     = $shopData['tel'];
        $news[$i]['URL']     = $shopData['URL'];

        $i++;
    }

}

/* --- サイドバナーの取得 --- */
if( $emoji_obj->PHONE_DATA['career'] == "PC" AND $_GET['s'] != '1' ){
    $recommendBannerCount = $db->getOne( "SELECT count( `imgId` ) FROM `recommendBanner` " );
    $recommendBannerLimit = 20;
    $ls    = 0;
    $result = $db->limitQuery( "SELECT `imgId`, `name`, `URL`, `file` FROM `recommendBanner` ORDER BY priority", $ls, $recommendBannerLimit );
    $i = 1;
    while( $row = $result -> fetchRow() ){
        $banner[$i]["imgId"] = $row["imgId"];
        $banner[$i]['name']  = $row['name'];
        $banner[$i]['URL']   = $row['URL'];
        $banner[$i]['file']  = $row['file'];
        $i++;
    }
    //余り
    $recommendBannerOther = $recommendBannerLimit - $recommendBannerCount;
}

/* --- 店舗情報の取得 --- */
$limit = 1000;
//if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
//    $limit = 8;
//}else{
//    $limit = 1000;
//}
if( $_REQUEST['ls'] ) $ls = $_REQUEST['ls'] * $limit - $limit;

// フリーワードで探す
if(!empty($_GET['searchKeyWord'])){

    // 検索対象のカラム セット
    $likeColumnsArray = array('shopName', 'shopNameKana', 'tel', 'mail', 'jobCategory', 'jobBack', 'workComment', 'license', 'activityaction', 'employ', 'place', 'traffic', 'workTime', 'salary', 'treatment', 'holiday', 'educatetrain', 'represent', 'business', 'officePlace', 'selection', 'application', 'interviewPlace', 'contactAddress', 'shopComment' );
    $columns = '';
    foreach($likeColumnsArray AS $value){
        $columns .= '`' . $value . '` LIKE ? OR';
        $placeholders[] = '%' . addcslashes($_GET['searchKeyWord'], '\_%') . '%';
    }
    $columns = rtrim($columns, ' OR');
//    print_r( $placeholders );

    $MyCount = $db->getOne( 'SELECT count(`shopId`) FROM `shopMaster` WHERE ' . $columns, $placeholders );
    $shop = $db->getAll( 'SELECT `shopId`, `shopName`, `tel`, `URL`, `RSS`, `mail`, `jobCategory`, `salary`, `license`, `place`, `traffic`, `workTime`, `treatment`, `workComment`, `shopComment`, `areaId`, `prefectureId`, `genreId`, `iconList` FROM `shopMaster` WHERE ' . $columns . ' ORDER BY `whatsNewTime` DESC, `priority`', $placeholders );
    //echo ( $db->last_query . "<hr />" );

}else{
    if( $areaId ){
        if( $prefectureId ){
            //都道府県店舗情報一覧表示(新着書込順.whatsNewTime→表示順位.priorityにソート)
            $MyCount = $db->getOne( "SELECT count(`shopId`) FROM `shopMaster` WHERE `prefectureId` = ?", array( $prefectureId ) );
            $shop = $db->getAll( "SELECT `shopId`, `shopName`, `tel`, `URL`, `RSS`, `mail`, `jobCategory`, `salary`, `license`, `place`, `traffic`, `workTime`, `treatment`, `workComment`, `shopComment`, `areaId`, `prefectureId`, `genreId`, `iconList` FROM `shopMaster` WHERE `prefectureId` = ? ORDER BY `whatsNewTime` DESC, `priority` LIMIT !,!", array($prefectureId, $ls, $limit) );
        }else{
            //エリア店舗情報一覧表示(新着書込順.whatsNewTime→表示順位.priorityにソート)
            $MyCount = $db->getOne( "SELECT count(`shopId`) FROM `shopMaster` WHERE `areaId` = ?", array( $areaId ) );
            $shop = $db->getAll( "SELECT `shopId`, `shopName`, `tel`, `URL`, `RSS`, `mail`, `jobCategory`, `salary`, `license`, `place`, `traffic`, `workTime`, `treatment`, `workComment`, `areaId`, `prefectureId`, `genreId`, `iconList` FROM `shopMaster` WHERE `areaId` = ? ORDER BY `whatsNewTime` DESC, `priority` LIMIT !,!", array($areaId, $ls, $limit) );
        }

        // セッション破棄
        $_SESSION = array();
        //セッションクッキー削除
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/') ;
        }
        session_destroy();

    }else{
        //ランダム表示でもNEXT BACKした際に重複しない為、SESSINOでRAND()する
        session_start();
        if( !$_SESSION["selectNum"] ) $_SESSION["selectNum"] = mb_ereg_replace('[^0-9]', '', uniqid());

        $MyCount = $db->getOne( "SELECT count(`shopId`) FROM `shopMaster` ORDER BY RAND(!)", array( $_SESSION["selectNum"] ) );
        $shop = $db->getAll( "SELECT `shopId`, `shopName`, `tel`, `URL`, `RSS`, `mail`, `salary`, `areaId`, `prefectureId`, `genreId`, `iconList` FROM `shopMaster` ORDER BY RAND(!) LIMIT !,!", array( $_SESSION["selectNum"], $ls, $limit ) );
//echo ( $db->last_query . "<hr />" );
        //$shop = $db->getAll( "SELECT `shopId`, `shopName`, `tel`, `URL`, `RSS`, `price`, `openTime`, `areaId`, `prefectureId`, `genreId`, `iconList`, `comment`, `discount` FROM `shopMaster` WHERE `shopId` = '239'" );
    }
}
//echo count($shop);
foreach($shop AS $key => $row){
    $shop[$key]['imgIdBan'] = $db->getOne("SELECT `imgId` FROM `image` WHERE `model` = ? AND `shopId` = ?", array( 0, $row['shopId'] ) );
    $shop[$key]['imgIdGal'] = $db->getOne("SELECT `imgId` FROM `image` WHERE `model` = ? AND `shopId` = ?", array( 1, $row['shopId'] ) );
    $shop[$key]['areaName'] = $areaArray[$row['areaId']];
    $shop[$key]['prefectureName'] = $prefectureArray[$row['prefectureId']];
    $shop[$key]['genreName'] = $genreArray[$row['genreId']];
    $shop[$key]['areaName'] = $areaArray[$row['areaId']];
    if(strlen($shop[$key]['URL']) > 25){
        $shop[$key]['URLStr'] = subStr($shop[$key]['URL'],0 ,25) . '<br />' . subStr($shop[$key]['URL'],25 ,80 );
    }else{
        $shop[$key]['URLStr'] = $shop[$key]['URL'];
    }
    $shop[$key]['goodChk'] = $db->getOne( "SELECT * FROM `log` WHERE `shop_id` = ? AND `user_id` = ? AND `good` = ?", array( $row['shopId'], USER_ID, 1 ) );
    $shop[$key]['goodCount'] = count($db->getAll( "SELECT `user_id` FROM `log` WHERE `shop_id` > ?  AND `user_id` = ? AND `good` = ?", array( 0, USER_ID, 1 )));

    /*
    //画像取得(PC)
    if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
        $imgIdGal = $db->query("SELECT `imgId`, `name`, `age` FROM `galImage` WHERE `shopId` = ? ORDER BY `priority`", array( $row['shopId'] ));
        //var_dump( $db );
            $i = 1;
            while( $img = $imgIdGal->fetchRow() ){
                $shop[$key]['imgIdGal'][$i] = $img["imgId"];
                $shop[$key]['imgIdGalName'][$i] = $img["name"];
                $shop[$key]['imgIdGalAge'][$i] = $img["age"];
                $i++;
            }
    //画像取得(携帯)
    }else{
        $mobileGalImage = $db->getOne("SELECT `imgId` FROM `galImage` WHERE `shopId` = ? ORDER BY `priority`", array( $row['shopId'] ));
        $shop[$key]['mobileGalImage'] = $mobileGalImage;
    }
    */

//    //アイコンリスト取得
//    $iconListArray = split ( "\|", trim( $row['iconList'], "|" ) );
//    foreach( $iconArray AS $key2 => $value ){
//        $shop[$key][$key2]["icon"] = $key2;
//        if( in_array( $key2, $iconListArray ) ) $shop[$key]["icon"][$key2]["iconList"] = 1;
//    };

    //アイコンリスト取得
    $iconListArray = explode('|', $row['iconList']);
    foreach( $iconListArray AS $key2 => $value ){
        if(!empty($value)){
            $shop[$key][$value]["icon"] = $value;
            if( in_array( $value, $iconListArray ) ) $shop[$key]["icon"][$value]["iconList"] = 1;
        }
    };


    /*
    //新着情報の日付を取得
    $timestamp = $db->getOne("SELECT UNIX_TIMESTAMP(`dateTime`) FROM `whatsNew` WHERE `shopId` = ? ORDER BY `dateTime` DESC LIMIT !", array($row['shopId'], 1));
    if($timestamp){
        if($timestamp > strtotime('-1 day')){
            $shop[$key]['iconNew'] = 1;
        }
    }
    */
}

if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
	$pageParam = array(
	    "itemData"   => $dates,
	    "totalItems" => $MyCount,
	    "delta"      => 4,
	    "perPage"    => $limit,
	    "mode"       => "Sliding",
	    "httpMethod" => "GET",
	    "altFirst"   => "First",
	    "altPrev"    => "PrevPage",
	    "prevImg"    => "<img src=\"./img/back.jpg\" alt=\"前のページへ\" />",
	    "altNext"    => "NextPage",
	    "nextImg"    => "<img src=\"./img/next.jpg\" alt=\"次のページへ\" />",
	    "altLast"    => "Last",
	    "altPage"    => "",
	    "separator"  => " ＞ ",
	    "append"     => 1,
	    "urlVar"     => "ls",
	);
}elseif(GetMobileCareer(0) == "smartPhone"){
	$pageParam = array(
	    "itemData"   => $dates,
	    "totalItems" => $MyCount,
	    "delta"      => 4,
	    "perPage"    => $limit,
	    "mode"       => "Sliding",
	    "httpMethod" => "GET",
	    "altFirst"   => "First",
	    "altPrev"    => "PrevPage",
	    "prevImg"    => "<img src=\"./img/back-sp.png\" width=\"150\" alt=\"前のページへ\" />",
	    "altNext"    => "NextPage",
	    "nextImg"    => "<img src=\"./img/next-sp.png\" width=\"150\" alt=\"次のページへ\" />",
	    "altLast"    => "Last",
	    "altPage"    => "",
	    "separator"  => " ＞ ",
	    "append"     => 1,
	    "urlVar"     => "ls",
	);
}else{
	$pageParam = array(
	    "itemData"   => $dates,
	    "totalItems" => $MyCount,
	    "delta"      => 4,
	    "perPage"    => $limit,
	    "mode"       => "Sliding",
	    "httpMethod" => "GET",
	    "altFirst"   => "First",
	    "altPrev"    => "PrevPage",
	    "prevImg"    => "&lt;&lt; BACK",
	    "altNext"    => "NextPage",
	    "nextImg"    => "NEXT &gt;&gt;",
	    "altLast"    => "Last",
	    "altPage"    => "",
	    "separator"  => " ＞ ",
	    "append"     => 1,
	    "urlVar"     => "ls",
	);
}

$pager      = pager::factory( $pageParam );
$pagerLinks = $pager->getLinks();


$smarty = new Smarty;
$smarty->assign ( 'pagerLinks', $pagerLinks );
$smarty->assign ( "cover", $cover );
$smarty->assign ( "news", $news );
$smarty->assign ( "shop", $shop );
$smarty->assign ( "banner", $banner );
$smarty->assign ( "recommendBannerOther", $recommendBannerOther );
$smarty->assign ( "iconArray", $iconArray );
$smarty->assign ( "prtData", $prtData );
$smarty->assign ( "areaArray", $areaArray );
$smarty->assign ( "areaClassArray", $areaClassArray );
$smarty->assign ( "areaId", $areaId );
$smarty->assign ( "pageName", $pageName );
$smarty->assign ( "prefectureArray", $prefectureArray );
if( $_GET['newsId'] ) $smarty->assign ( "newsId", $_GET['newsId'] );

$smarty->assign ( "areaIdSelect", $_GET['areaId'] );
$smarty->display( 'index.tpl' );

//if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
//   $smarty->assign ( "areaIdSelect", $_GET['areaId'] );
//   $smarty->display( 'index.tpl' );
//}elseif(GetMobileCareer(0) == "smartPhone"){
//   $smarty->display( 'indexSP.tpl' );
//}else{
//    $smarty->assign ( "areaIdSelect", $_GET['areaId'] );
//    mb_convert_variables("SJIS-WIN", "UTF-8", $smarty);
//    $smarty->assign ( "emjArray", $emjArray );
//    $template = $smarty->display("indexM.tpl");
//}
