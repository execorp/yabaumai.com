<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

// SQLインジェクション対策
foreach($_REQUEST AS $key => $value){
    if(strstr(strtoupper($value), 'UNION'))
    die('不正なアクセスです。');
} 

define ( "ROOT_PATH", "/var/www/yabaumai.com/www/htdocs/" );
define ( "emjArray", $emjArray );

$domain        = "yabaumai.com";
$shopMail      = 'info@' . $domain;
// $siteNamePrint = "求人MART";
// $siteName      = "全国求人サイト " . $siteNamePrint;

$siteNamePrint = "YABAUMAI";
$siteName      = "カフェ 飲食店-" . $siteNamePrint . "-";
define ( "domain", $domain );
define ( "shopMail", $shopMail );
define ( "siteNamePrint", $siteNamePrint );
define ( "siteName", $siteName );


require_once( ROOT_PATH ."inc/.ht_DBConnect.inc" );
require_once( "DB.php" );
require_once( "emojilib/lib/mobile_class_8.php" );

mb_language("Japanese");
mb_internal_encoding("SJIS");

$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

$paramsClient = array(
    "dsn"         => "mysql://yabaumai:ZZDWccSvH4zsruhQ@localhost/yabaumai",
    "table"       => "shopMaster",
    "usernamecol" => "loginId",
    "passwordcol" => "loginPass",
    "cryptType"   => "none" ,
    "db_fields"   => array( "shopId", "shopName", "areaId" )
);

//session_start();
//
//// 30日前以上のレコードを削除する
//$db->query( "DELETE FROM `log` WHERE `created_date` <= ? ", array( date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m")-1, date("d"), date("Y"))) )  );
//
//// user_id セット
//if (!empty($_SESSION['user_id'])) {
//    $user_id = $db->getOne( "SELECT `user_id` FROM `log` WHERE `user_id` = ?", array( $_SESSION['user_id'] ) );
//    if(!empty($user_id)){
//        // お気に入りの総数を表示
//        $goodCount = count($db->getAll( "SELECT `user_id` FROM `log` WHERE `shop_id` > ? AND `user_id` = ? AND `good` = ?", array( 0, $_SESSION['user_id'], 1 ) ) );
////        echo $_SESSION['user_id'];
//        define ( 'goodCount', $goodCount);
//        // 閲覧履歴の総数を表示
//        $historyCount = count($db->getAll( "SELECT `user_id` FROM `log` WHERE `shop_id` > ? AND `user_id` = ? AND `history` = ?", array( 0, $_SESSION['user_id'], 1 ) ) );
//        define ( 'historyCount', $historyCount);
//        define ( 'USER_ID', $user_id );
//    }else{
//        // DB に保存
//        $db->query( "INSERT `log` ( `user_id`,`created_date` ) VALUES ( ?, ? ) ", array( $_SESSION['user_id'], date('Y-m-d H:i:s') ) );
//        define ( 'USER_ID', $_SESSION['user_id'] );
//    }
////    if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo '登録済み => ' . $_SESSION['user_id'] . ' / ' . $user_id;
//} else {
//    // ランダム数値 生成
//    $sha1 = sha1( uniqid( mt_rand() , true ) );
//    // DB に保存
//    $db->query( "INSERT `log` ( `user_id`,`created_date` ) VALUES ( ?, ? ) ", array( $sha1, date('Y-m-d H:i:s') ) );
//    // SESSIONに保存
//    $_SESSION['user_id'] = $sha1;
//    define ( 'USER_ID', $_SESSION['user_id'] );
////    if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo '新規登録 => ' . $_SESSION['user_id'];
//}

// SESSION 削除
//session_destroy();
//session_write_close();

//echo USER_ID;

// 掲載件数
define ( 'shopMasterCount', count($db->getAll( "SELECT `shopId` FROM `shopMaster` " )) );

$adverTypeArray = array(
//    1 => "有料 5,000円" ,
//    2 => "無料（相互リンク必須）" ,
    2 => "月額5,250円"
);

$reserveCompArray = array(
    0 => "未確認" ,
    1 => "確認済" ,
);

//exe専用変更可のIP
$ipArrowListArray = array(
    "211.132.41.217" ,
    "59.190.117.210" ,
);

/* --- 相互リンク --- */
$linkGenreArray = array(
     1 => "相互リンク" ,
     2 => "ランキングサイト" ,
     3 => "おすすめサイト" ,
     4 => "求人サイト"
);

$iconArray = array(
    //0 => "送迎有り" ,
    1 => "Wifi有" ,
    //2 => "日払いOK" ,
    3 => "グッズ有り" ,
    4 => "予約制" ,
    5 => "テラス席有り" ,
    //6 => "託児所有り" ,
    //7 => "給料保証" ,
    //8 => "アリバイ対策" ,
    //9 => "昇級ボーナス" ,
    //10 => "人妻・熟女" ,
    //11 => "個室待機" ,
    12 => "NEWオープン" ,
    13 => "キッズOK" ,
);

$genreArray = array(
    1 => "営業" ,
    2 => "事務" ,
    3 => "プログラマー" ,
    4 => "店舗スタッフ" ,
    5 => "飲食スタッフ" ,
    6 => "テレコールスタッフ" ,
);

//サイドバナー用
$areaRecommendBannerArray = array(
    0 => "トップ" ,
    1 => "北海道" ,
    2 => "東北" ,
    3 => "関東" ,
    4 => "信越・北陸" ,
    5 => "東海" ,
    6 => "関西" ,
    7 => "中国" ,
    8 => "四国" ,
    9 => "九州・沖縄"
);

$areaArray = array(
    1 => "北海道" ,
    2 => "東北" ,
    3 => "関東" ,
    4 => "信越・北陸" ,
    5 => "東海" ,
    6 => "関西" ,
    7 => "中国" ,
    8 => "四国" ,
    9 => "九州・沖縄"
);

$areaClassArray = array(
    1 => "hokkaido" ,
    2 => "tohoku" ,
    3 => "kanto" ,
    4 => "hokuriku" ,
    5 => "tokai" ,
    6 => "kansai" ,
    7 => "chugoku" ,
    8 => "shikoku" ,
    9 => "kyushu"
);

$areaArray1 = array( 1 => "北海道" );
$areaArray2 = array( 2 => "青森", 3 => "岩手", 4 => "宮城", 5 => "秋田", 6 => "山形", 7 => "福島" );
$areaArray3 = array( 8 => "茨城", 9 => "栃木", 10 => "群馬", 11 => "埼玉", 12 => "千葉", 13 => "東京", 14 => "神奈川" , 19 => "山梨" );
$areaArray4 = array( 15 => "新潟", 16 => "富山", 17 => "石川", 18 => "福井", 20 => "長野" );
$areaArray5 = array( 21 => "岐阜", 22 => "静岡", 23 => "愛知", 24 => "三重" );
$areaArray6 = array( 27 => "大阪", 26 => "京都", 25 => "滋賀", 28 => "兵庫", 29 => "奈良", 30 => "和歌山" );
$areaArray7 = array( 31 => "鳥取", 32 => "島根", 33 => "岡山", 34 => "広島", 35 => "山口" );
$areaArray8 = array( 36 => "徳島", 37 => "香川", 38 => "愛媛", 39 => "高知" );
$areaArray9 = array( 40 => "福岡", 41 => "佐賀", 42 => "長崎", 43 => "熊本", 44 => "大分", 45 => "宮崎", 46 => "鹿児島", 47 => "沖縄" );

foreach ($areaArray as $key => $value) {
     if($key == 1){
         foreach ($areaArray1 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 2){
         foreach ($areaArray2 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 3){
         foreach ($areaArray3 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 4){
         foreach ($areaArray4 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 5){
         foreach ($areaArray5 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 6){
         foreach ($areaArray6 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 7){
         foreach ($areaArray7 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 8){
         foreach ($areaArray8 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }elseif($key == 9){
         foreach ($areaArray9 as $key2 => $value2) {
              $areaPrefArray[$key][$key2] = $value2;
          }
     }
}

$prtData["areaPref"] = $areaPrefArray;


$prefectureArray = array(
     1 => "北海道" ,
     2 => "青森" ,
     3 => "岩手" ,
     4 => "宮城" ,
     5 => "秋田" ,
     6 => "山形" ,
     7 => "福島" ,
     8 => "茨城" ,
     9 => "栃木" ,
    10 => "群馬" ,
    11 => "埼玉" ,
    12 => "千葉" ,
    13 => "東京" ,
    14 => "神奈川" ,
    15 => "新潟" ,
    16 => "富山" ,
    17 => "石川" ,
    18 => "福井" ,
    19 => "山梨" ,
    20 => "長野" ,
    21 => "岐阜" ,
    22 => "静岡" ,
    23 => "愛知" ,
    24 => "三重" ,
    25 => "滋賀" ,
    26 => "京都" ,
    27 => "大阪" ,
    28 => "兵庫" ,
    29 => "奈良" ,
    30 => "和歌山" ,
    31 => "鳥取" ,
    32 => "島根" ,
    33 => "岡山" ,
    34 => "広島" ,
    35 => "山口" ,
    36 => "徳島" ,
    37 => "香川" ,
    38 => "愛媛" ,
    39 => "高知" ,
    40 => "福岡" ,
    41 => "佐賀" ,
    42 => "長崎" ,
    43 => "熊本" ,
    44 => "大分" ,
    45 => "宮崎" ,
    46 => "鹿児島" ,
    47 => "沖縄"
);

/*
[北海道] ・北海道
[東北] ・青森 ・岩手 ・宮城 ・秋田 ・山形 ・福島
[関東] ・山梨 ・茨城 ・栃木 ・群馬 ・埼玉 ・千葉 ・東京 ・神奈川
[信越・北陸] ・新潟 ・富山 ・石川 ・福井 ・長野
[東海] ・岐阜 ・静岡 ・愛知 ・三重
[関西] ・大阪 ・京都 ・滋賀 ・兵庫 ・奈良 ・和歌山
[中国] ・鳥取 ・島根 ・岡山 ・広島 ・山口
[四国] ・徳島 ・香川 ・愛媛 ・高知
[九州・沖縄] ・福岡 ・佐賀 ・長崎 ・熊本 ・大分 ・宮崎 ・鹿児島 ・沖縄
*/

/*その他のページ*/
$pageArray = array(
	"index"      => "" ,
    "top"        => "トップ" ,
    "adver"      => "掲載申し込み" ,
    "link"       => "相互リンク" ,
    "inquiry"    => "お問い合わせ" ,
    "use"        => "利用規約" ,
    "escape"     => "免責規約" ,
    "privacy"    => "プライバシーポリシー" ,
    "gaiyou"     => "会社概要" ,
);
//-------------------------------------------------------------------------------------------------------------------------HTML関係

//$prtDescription  = siteName;
//$prtKeywords     = "デリヘル,デリバリーヘルス,風俗情報,全国,北海道,東北,関東,信越・北陸,東海,関西・近畿,中国,四国,九州・沖縄";

/*
$prtPageTitle   = "";
$prtDescription = "";
$prtKeywords    = "";
		<meta name="keywords" content="デリヘル嬢検索,大阪,デリヘル,風俗" />
$prtGenerator   = "";
*/


//ページ階層
if( !$_GET['areaId'] ){ //その他のページ
    if( strstr( $_SERVER['PHP_SELF'] , "top" ) ){
//        $_pagePrint  = "<a href=\"./index.html\">トップ</a>";

        $_pagePrint  = '<section class="breadcrumb">';
        $_pagePrint .= '<div class="slider-container breadcrumb_inner initialized">';
        $_pagePrint .= '<ol class="js-slide-breadcrumb breadcrumb_items slick-initialized slick-slider">';
        $_pagePrint .= '<div aria-live="polite" class="slick-list draggable">';
        $_pagePrint .= '<div class="slick-track" role="listbox" style="opacity: 1; width: 20000px; transform: translate3d(0px, 0px, 0px);">';
        $_pagePrint .= '<li class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">';
        $_pagePrint .= '<a href="./index.html" class="breadcrumb_item" tabindex="0"><span>トップ</span></a>';
        $_pagePrint .= '<meta content="1">';
        $_pagePrint .= '</li>';
        $_pagePrint .= '</div>';
        $_pagePrint .= '</div>';
        $_pagePrint .= '</ol>';
        $_pagePrint .= '</div>';
        $_pagePrint .= '</section>';



        $prtPageTitle   = $siteName;
        // $prtDescription = $siteName . "のトップページ。全国の会社がひと目でわかります。";
        $prtDescription = "カフェ検索サイト-yabaumai-(やばうまい)は、日本全国のカフェ情報を掲載しております。";
        // $prtKeywords    = "全国";
        $prtKeywords    = "飲食店,カフェ,フード,求人,";
    }else{
        foreach( $pageArray as $key => $value ){
            if( strstr( $_SERVER['PHP_SELF'] , $key ) ){
//                $_pagePrint  = "<a href=\"./index.html\">トップ2</a>";
//                $_pagePrint .= "&nbsp;&gt;&nbsp;<a href=\"./" . $key . ".html\">" . $value . "</a>";


                $_pagePrint  = '<section class="breadcrumb">';
                $_pagePrint .= '<div class="slider-container breadcrumb_inner initialized">';
                $_pagePrint .= '<ol class="js-slide-breadcrumb breadcrumb_items slick-initialized slick-slider">';
                $_pagePrint .= '<div aria-live="polite" class="slick-list draggable">';
                $_pagePrint .= '<div class="slick-track" role="listbox" style="opacity: 1; width: 20000px; transform: translate3d(0px, 0px, 0px);">';
                $_pagePrint .= '<li class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">';
                $_pagePrint .= '<a href="./index.html" class="breadcrumb_item" tabindex="0"><span>トップ</span></a>';
                $_pagePrint .= '<meta content="1">';
                $_pagePrint .= '</li>';
                $_pagePrint .= '<li class="slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide01">';
                $_pagePrint .= '<span class="breadcrumb_item">' . $value . '</span>';
                $_pagePrint .= '<meta content="2">';
                $_pagePrint .= '</li>';
                $_pagePrint .= '</div>';
                $_pagePrint .= '</div>';
                $_pagePrint .= '</ol>';
                $_pagePrint .= '</div>';
                $_pagePrint .= '</section>';



                $prtPageTitle   = $value . " | " . $siteName;
                // $prtDescription = $value . " 全国 会社 企業";
                $prtDescription = "カフェ検索サイト-yabaumai-(やばうまい)は、日本全国のカフェ情報を掲載しております。";
                // $prtKeywords    = "全国,会社,企業," . $value;
                $prtKeywords    = "飲食店,カフェ,フード,求人," . $value;
            }
        }
    }
}else{ //エリアバナー
    $areaId = $_GET['areaId'];
    foreach( ${"areaArray$areaId"} AS $key => $value ){
//        $prefectureList .= "|<a href=\"./index" . $areaId . "-" . $key . ".html\">" . $value . "</a>";

        if( $_GET['prefectureId'] ){
            if( $_GET['prefectureId'] == $key ){
                $prefectureList4Title = " " . $value;

                $prtPageTitle   = $value . " | " . $siteName;
                // $prtDescription = $value . "の" . $siteName . "の会社・企業が詳しくわかります。";
                $prtDescription = "カフェ検索サイト-yabaumai-(やばうまい)は、日本全国のカフェ情報を掲載しております。";
                // $prtKeywords    = "会社,企業," . $value;
                $prtKeywords    = "飲食店,カフェ,フード,求人," . $value;
            }
        }else{
            $prefectureList4Title .= " " . $value . "";

            $prtPageTitle   = $areaArray[$_GET['areaId']] . $prefectureList4Title . " | " . $siteName;
            // $prtDescription = $areaArray[$_GET['areaId']] . "の" . $siteName . "の会社・企業が丸ごとわかります。";
            $prtDescription = "カフェ検索サイト-yabaumai-(やばうまい)は、日本全国のカフェ情報を掲載しております。";
            // $prtKeywords    = "会社,企業," . $areaArray[$_GET['areaId']];
            $prtKeywords    = "飲食店,カフェ,フード,求人," . $areaArray[$_GET['areaId']];
        }
    }

//    $_pagePrint  = "<a href=\"./index.html\">トップ</a>";
//    $_pagePrint .= "&nbsp;&gt;&nbsp;<a href=\"./index" . $_GET['areaId'] . ".html\">" . $areaArray[$_GET['areaId']] . "</a>&nbsp;";
//    $_pagePrint .= $prefectureList4Title . "|";

    $_pagePrint  = '<section class="breadcrumb">';
    $_pagePrint .= '<div class="slider-container breadcrumb_inner initialized">';
    $_pagePrint .= '<ol class="js-slide-breadcrumb breadcrumb_items slick-initialized slick-slider">';
    $_pagePrint .= '<div aria-live="polite" class="slick-list draggable">';
    $_pagePrint .= '<div class="slick-track" role="listbox" style="opacity: 1; width: 20000px; transform: translate3d(0px, 0px, 0px);">';
    $_pagePrint .= '<li class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">';
    $_pagePrint .= '<a href="./index.html" class="breadcrumb_item" tabindex="0"><span>トップ</span></a>';
    $_pagePrint .= '<meta content="1">';
    $_pagePrint .= '</li><li class="slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide01">';
    $_pagePrint .= '<a href="./index' . $_GET['areaId'] . '.html" class="breadcrumb_item" tabindex="-1"> <span>' . $areaArray[$_GET['areaId']] . '</span></a>';
    $_pagePrint .= '<meta content="2">';
    $_pagePrint .= '</li><li class="slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide02">';
    $_pagePrint .= '<span class="breadcrumb_item">' . $prefectureList4Title . '</span>';
    $_pagePrint .= '</li>';
    $_pagePrint .= '</div>';
    $_pagePrint .= '</div>';
    $_pagePrint .= '</ol>';
    $_pagePrint .= '</div>';
    $_pagePrint .= '</section>';

}

//パンくず右メニュー
//$_menuPrint = '<a href="./adver.html">掲載申し込み</a>　<a href="./inquiry.html">お問い合わせ</a>　<a href="./link.html">相互リンク</a>';

//パンくず
$pagePrint = "<div id=\"pagePrint\">" . $_pagePrint . "</div>\n";

//メニュー生成
$_contens  = "<ul>\n";
$_contens .= "<li id=\"top\"><a href=\"index.html\" title=\"トップ," . siteName . "\" class=\"";
    if( !$_GET['areaId'] ){
        $_contens .= "this";
    }else{
        $_contens .= "other";
    }
$_contens .= "\">トップ</a></li>\n";
foreach( $areaArray as $key => $value ){
    $_contens .= "<li id=\"top" . $key . "\"><a href=\"index";
    $_contens .= $key . ".html\" ";
    $_contens .= "title=\"" . $value . "," . siteName . "\" class=\"";
        if( $_GET['areaId'] == $key ){
            $_contens .= "this";
        }else{
            $_contens .= "other";
        }
    $_contens .= "\">" . $value . "</a></li>\n";
}
$_contens .= "</ul>\n";


//エリアセレクト
foreach( $areaArray as $key => $value ){
    $_elia_select .= "<a href=\"index";
    $_elia_select .= $key . ".html\" ";
    $_elia_select .= "title=\"" . $value . ",デリヘル," . siteName . "\" class=\"aaa";
    $_elia_select .= "\">" . $value . "</a><br />\n";
}

//ヘッダーバナー
//$headerBannerArray = $db->getRow( "SELECT `imgId`, `name`, `alt`, `url` FROM `headerBanner` WHERE `imgId` = '1' " );
//$headerBanner      = "<a href=\"http://" . $headerBannerArray['url'] . "\" title=\"" . $headerBannerArray['alt'] . "\" target=\"blank\"><img src=\"./inc/picR.php?imgId=" . $headerBannerArray['imgId'] . "&t=headerBanner&mw=468\" alt=\"" . $headerBannerArray['alt'] . "\" /></a>\n";

//フッター
foreach( $pageArray as $key => $value ){
    $_footer .= "<a href=\"" . $key . ".html\" title=\"" . $value . "\">" . $value . "</a> | "; //PC用
    $_footerM .= "<a href=\"" . $key . ".php?s=1\" title=\"" . $value . "\"><font size=\"1\" color=\"#ffffff\">" . $value . "</font></a> | "; //携帯用
}





/* --- サイドバナーの取得 --- */
/*
if( $emoji_obj->PHONE_DATA['career'] == "PC" AND $_GET['s'] != '1' ){
    $recommendBannerCount = $db->getOne( "SELECT count( `imgId` ) FROM `recommendBanner` WHERE `areaId` = '" . $_GET['areaId'] . "'" );
    $recommendBannerLimit = 20;
    $ls    = 0;
    $result = $db->limitQuery( "SELECT `imgId`, `name`, `URL`, `file` FROM `recommendBanner` WHERE `areaId` = '" . $_GET['areaId'] . "' ORDER BY priority", $ls, $recommendBannerLimit );
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
*/

//copyright
$_copyright = "copyright(c)2014 " . $domain . ".All Rights Reserved";

$PC_HEAD_PATH = ROOT_PATH . "templates/header.tpl"; //PCヘッダ
$PC_FOOT_PATH = ROOT_PATH . "templates/footer.tpl"; //PCフッタ

//$MOBILE_HEAD_PATH = ROOT_PATH . "templates/headerM.tpl"; //携帯ヘッダ
//$MOBILE_FOOT_PATH = ROOT_PATH . "templates/footerM.tpl"; //携帯フッタ
//
//$SMART_HEAD_PATH = ROOT_PATH . "templates/headerSP.tpl"; //スマートフォンヘッダ
//$SMART_FOOT_PATH = ROOT_PATH . "templates/footerSP.tpl"; //スマートフォンフッタ
//


define ( "description", $prtDescription ); //description
define ( "keywords", $prtKeywords ); //keywords
define ( "generator", $prtDescription ); //description
define ( "headerPath", $PC_HEAD_PATH ); //PCヘッダパス
define ( "footerPath", $PC_FOOT_PATH ); //PCフッタパス
define ( "headerPathM", $MOBILE_HEAD_PATH ); //携帯ヘッダパス
define ( "footerPathM", $MOBILE_FOOT_PATH ); //携帯フッタパス
define ( "headerPathSP", $SMART_HEAD_PATH ); //スマートフォンヘッダパス
define ( "footerPathSP", $SMART_FOOT_PATH ); //スマートフォンフッタパス
define ( "header", $_header ); //ヘッダ
define ( "headerBanner", $headerBanner ); //ヘッダーバナー
define ( "pagePrint", $pagePrint ); //パンくず
define ( "elia_select", $_elia_select ); //エリアセレクト
define ( "contens", $_contens ); //メニュー
define ( "footer", $_footer ); //フッター(PC用)
define ( "footerM", $_footerM ); //フッター(携帯用)
define ( "pagePrint", $_pagePrint ); //ページ階層
define ( "pagePrintTitle", $prtPageTitle ); //ページ階層タイトル
define ( "copyright", $_copyright ); //copyright

//-------------------------------------------------------------------------------------------------------------------------HTML関係//

//JSON型文字列に変換
//$FlashVars = '<>';
$FlashVars = '&lt;&gt;';
foreach($areaArray AS $key => $value){
	$FlashVars .= $value . ':,';
	foreach(${'areaArray' . $key} AS $num => $item){
			$FlashVars .= $num . '-' . $item . ',';
	}
	$FlashVars = rtrim($FlashVars, ',');
	//$FlashVars .= '<>';
	$FlashVars .= '&lt;&gt;';
}
$FlashVars = rtrim($FlashVars, ',');

//地図Flash
//$mapFlash = "地図Flash 500px×320px";

$areaId = $_GET['areaId'];
$prefectureId = $_GET['prefectureId'];

//$mapFlash = "<img src=\"img/flash.jpg\">";
/*
$mapFlash = <<<EOF
<script language="javascript" type="text/javascript">
	if (AC_FL_RunContent == 0) {
		alert("このページでは \"AC_RunActiveContent.js\" が必要です。");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '500',
			'height', '320',
			'src', 'menu',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'transparent',
			'devicefont', 'false',
			'id', 'menu',
			'bgcolor', '#ffffff',
			'name', 'menu',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', './swf/menu',
			'salign', '',
			'FlashVars','AREA_ID={$areaId}&amp;PREF_ID={$prefectureId}&amp;AREA_DATA={$FlashVars}'
			);
	}
</script>
EOF;
*/


$emjArray = array(
         0 => "\xF9\x90" ,
         1 => "\xF9\x87" ,
         2 => "\xF9\x88" ,
         3 => "\xF9\x89" ,
         4 => "\xF9\x8A" ,
         5 => "\xF9\x8B" ,
         6 => "\xF9\x8C" ,
         7 => "\xF9\x8D" ,
         8 => "\xF9\x8E" ,
         9 => "\xF9\x8F" ,

    "F89F" => "\xF8\x9F" , //晴れ 太陽
    "F8A0" => "\xF8\xA0" , //曇り 雲
    "F8A1" => "\xF8\xA1" , //雨 傘
    "F8A2" => "\xF8\xA2" , //雪 雪だるま
    "F8A3" => "\xF8\xA3" , //雷 雷マーク
    "F8A4" => "\xF8\xA4" , //台風 ぐるぐるマーク
    "F8A5" => "\xF8\xA5" , //霧 点々五段
    "F8A6" => "\xF8\xA6" , //小雨 傘閉じてる
    "F8A7" => "\xF8\xA7" , //牡羊座 星座マーク（羊）
    "F8A8" => "\xF8\xA8" , //牡牛座 星座マーク（牛）
    "F8A9" => "\xF8\xA9" , //双子座 星座マーク（双子）
    "F8AA" => "\xF8\xAA" , //蟹座 星座マーク（蟹）
    "F8AB" => "\xF8\xAB" , //獅子座 星座マーク（獅子）
    "F8AC" => "\xF8\xAC" , //乙女座 星座マーク（乙女）
    "F8AD" => "\xF8\xAD" , //天秤座 星座マーク（天秤）
    "F8AE" => "\xF8\xAE" , //蠍座 星座マーク（蠍）
    "F8AF" => "\xF8\xAF" , //射手座 星座マーク（射手）
    "F8B0" => "\xF8\xB0" , //山羊座 星座マーク（山羊）
    "F8B1" => "\xF8\xB1" , //水瓶座 星座マーク（水瓶）
    "F8B2" => "\xF8\xB2" , //魚座 星座マーク（魚）
    "F8B3" => "\xF8\xB3" , //スポーツ ランニングシャツ斜線
    "F8B4" => "\xF8\xB4" , //野球 ボール
    "F8B5" => "\xF8\xB5" , //ゴルフ ゴルフクラブ（ドライバー）
    "F8B6" => "\xF8\xB6" , //テニス テニスラケット＆ボール
    "F8B7" => "\xF8\xB7" , //サッカー サッカーボール
    "F8B8" => "\xF8\xB8" , //スキー スキーの板と靴
    "F8B9" => "\xF8\xB9" , //バスケットボール ボール＆バスケットゴール
    "F8BA" => "\xF8\xBA" , //モータースポーツ チェッカーフラッグ
    "F8BB" => "\xF8\xBB" , //ポケットベル ポケベルの絵
    "F8BC" => "\xF8\xBC" , //電車 電車＆線路
    "F8BD" => "\xF8\xBD" , //地下鉄 ローマ字の"Ｍ"のマーク
    "F8BE" => "\xF8\xBE" , //新幹線 新幹線を横から見た絵
    "F8BF" => "\xF8\xBF" , //車（セダン） 車横からセダンの形
    "F8C0" => "\xF8\xC0" , //車（ＲＶ） 車横からＲＶの形
    "F8C1" => "\xF8\xC1" , //バス バス正面から
    "F8C2" => "\xF8\xC2" , //船 船正面から上から煙
    "F8C3" => "\xF8\xC3" , //飛行機 飛行機上から見た形
    "F8C4" => "\xF8\xC4" , //家 ■の上に▲足した単純な形 □窓二つ
    "F8C5" => "\xF8\xC5" , //ビル 縦長長方形 □窓いっぱい
    "F8C6" => "\xF8\xC6" , //郵便局 □の上に凸マーク 中に〒マーク
    "F8C7" => "\xF8\xC7" , //病院 □の上に凸マーク 中に＋マーク
    "F8C8" => "\xF8\xC8" , //銀行 ＢＫ
    "F8C9" => "\xF8\xC9" , //ＡＴＭ ＡＴＭ
    "F8CA" => "\xF8\xCA" , //ホテル □の上に▲ □の中にＨのマーク
    "F8CB" => "\xF8\xCB" , //コンビニ ＣＶＳ
    "F8CC" => "\xF8\xCC" , //ガソリンスタンド ＧＳ
    "F8CD" => "\xF8\xCD" , //駐車場 ○の中にＰ
    "F8CE" => "\xF8\xCE" , //信号 信号機
    "F8CF" => "\xF8\xCF" , //トイレ 男＆女のシルエット
    "F8D0" => "\xF8\xD0" , //レストラン フォーク＆ナイフ
    "F8D1" => "\xF8\xD1" , //喫茶店 コーヒーカップ
    "F8D2" => "\xF8\xD2" , //バー カクテルグラス
    "F8D3" => "\xF8\xD3" , //ビール ビールジョッキ
    "F8D4" => "\xF8\xD4" , //ファーストフード ハンバーガー
    "F8D5" => "\xF8\xD5" , //ブティック ハイヒール
    "F8D6" => "\xF8\xD6" , //美容院 はさみ
    "F8D7" => "\xF8\xD7" , //カラオケ マイク
    "F8D8" => "\xF8\xD8" , //映画 ビデオカメラ
    "F8D9" => "\xF8\xD9" , //右斜め上 →右斜め上
    "F8DA" => "\xF8\xDA" , //遊園地 メリーゴーランド？
    "F8DB" => "\xF8\xDB" , //音楽 ヘッドホン
    "F8DC" => "\xF8\xDC" , //アート 丸いパレット？
    "F8DD" => "\xF8\xDD" , //演劇 役者のシルエット？
    "F8DE" => "\xF8\xDE" , //イベント テントの上に旗
    "F8DF" => "\xF8\xDF" , //チケット 横長長方形 右側に縦の点線
    "F8E0" => "\xF8\xE0" , //喫煙 タバコ
    "F8E1" => "\xF8\xE1" , //禁煙 ○の中にタバコ 斜線
    "F8E2" => "\xF8\xE2" , //カメラ カメラ
    "F8E3" => "\xF8\xE3" , //カバン ハンドバック
    "F8E4" => "\xF8\xE4" , //本 本開いてる
    "F8E5" => "\xF8\xE5" , //リボン　リボン
    "F8E6" => "\xF8\xE6" , //プレゼント 箱リボン
    "F8E7" => "\xF8\xE7" , //バースデイ ロウソク３本
    "F8E8" => "\xF8\xE8" , //電話 電話
    "F8E9" => "\xF8\xE9" , //携帯電話 携帯電話
    "F8EA" => "\xF8\xEA" , //メモ メモ帳右上折れ
    "F8EB" => "\xF8\xEB" , //テレビ テレビ
    "F8EC" => "\xF8\xEC" , //ゲーム コントローラー
    "F8ED" => "\xF8\xED" , //ＣＤ ＣＤ
    "F8EE" => "\xF8\xEE" , //ハート ハートマーク
    "F8EF" => "\xF8\xEF" , //スペード スペードマーク
    "F8F0" => "\xF8\xF0" , //ダイヤ ダイヤマーク
    "F8F1" => "\xF8\xF1" , //クラブ クラブマーク
    "F8F2" => "\xF8\xF2" , //目 目
    "F8F3" => "\xF8\xF3" , //耳 耳
    "F8F4" => "\xF8\xF4" , //手（グー）
    "F8F5" => "\xF8\xF5" , //手（チョキ）
    "F8F6" => "\xF8\xF6" , //手（パー）
    "F8F7" => "\xF8\xF7" , //右斜め下 →右斜め下
    "F8F8" => "\xF8\xF8" , //左斜め上 ←左斜め上
    "F8F9" => "\xF8\xF9" , //足 足あと
    "F8FA" => "\xF8\xFA" , //靴 靴横から斜線２本
    "F8FB" => "\xF8\xFB" , //眼鏡 眼鏡
    "F8FC" => "\xF8\xFC" , //車椅子 人の座った車椅子横から
    "F940" => "\xF9\x40" , //新月 ●
    "F941" => "\xF9\x41" , //やや欠け月 ○左斜め上１／３黒
    "F942" => "\xF9\x42" , //半月 ○左斜め上１／２黒
    "F943" => "\xF9\x43" , //三日月 ●右斜め下白く三日月
    "F944" => "\xF9\x44" , //満月 ○
    "F945" => "\xF9\x45" , //犬 犬の顔
    "F946" => "\xF9\x46" , //猫 猫の顔
    "F947" => "\xF9\x47" , //リゾート ヨット
    "F948" => "\xF9\x48" , //クリスマス クリスマスツリー
    "F949" => "\xF9\x49" , //左斜め下 ←左斜め下
    "F972" => "\xF9\x72" , //phone to →携帯電話
    "F973" => "\xF9\x73" , //male to ↓メール絵文字
    "F974" => "\xF9\x74" , //fax to ↓ＦＡＸ
    "F975" => "\xF9\x75" , //ｉモード ｉマーク
    "F976" => "\xF9\x76" , //ｉモード（枠つき） ｉマーク枠つき
    "F977" => "\xF9\x77" , //メール メール絵文字
    "F978" => "\xF9\x78" , //ドコモ提供 ローマ字のＤに？
    "F979" => "\xF9\x79" , //ドコモポイント ○右側影の中にＤ
    "F97A" => "\xF9\x7A" , //有料 ￥マーク枠つき
    "F97B" => "\xF9\x7B" , //無料 ＦＲＥＥ
    "F97C" => "\xF9\x7C" , //ＩＤ ＩＤ
    "F97D" => "\xF9\x7D" , //パスワード カギマーク
    "F97E" => "\xF9\x7E" , //次項有 戻るマーク
    "F980" => "\xF9\x80" , //クリア ＣＬ
    "F981" => "\xF9\x81" , //サーチ 虫眼鏡
    "F982" => "\xF9\x82" , //ＮＥＷ ＮＥＷ
    "F983" => "\xF9\x83" , //位置情報 旗
    "F984" => "\xF9\x84" , //フリーダイヤル フリーダイヤルのマーク
    "F985" => "\xF9\x85" , //シャープダイヤル ＃
    "F986" => "\xF9\x86" , //モバＱ ○中にＱ
    "F987" => "\xF9\x87" , //１ １枠つき
    "F988" => "\xF9\x88" , //２ ２枠つき
    "F989" => "\xF9\x89" , //３ ３枠つき
    "F98A" => "\xF9\x8A" , //４ ４枠つき
    "F98B" => "\xF9\x8B" , //５ ５枠つき
    "F98C" => "\xF9\x8C" , //６ ６枠つき
    "F98D" => "\xF9\x8D" , //７ ７枠つき
    "F98E" => "\xF9\x8E" , //８ ８枠つき
    "F98F" => "\xF9\x8F" , //９ ９枠つき
    "F990" => "\xF9\x90" , //０ ０枠つき
    "F9B0" => "\xF9\xB0" , //決定 ＯＫ
    "F991" => "\xF9\x91" , //黒ハート ハートマーク
    "F992" => "\xF9\x92" , //揺れるハート 揺れるハートマーク
    "F993" => "\xF9\x93" , //失恋 割れたハート
    "F994" => "\xF9\x94" , //ハートたち（複数ハート） ハート２つ
    "F995" => "\xF9\x95" , //わーい（うれしい顔）
    "F996" => "\xF9\x96" , //ちっ（怒った顔）
    "F997" => "\xF9\x97" , //がく～（落胆した顔）
    "F998" => "\xF9\x98" , //もうやだ～（悲しい顔）
    "F999" => "\xF9\x99" , //ふらふら 目が× くちが○
    "F99A" => "\xF9\x9A" , //グッド（上向き矢印）
    "F99B" => "\xF9\x9B" , //るんるん 音符
    "F99C" => "\xF9\x9C" , //いい気分 （温泉）
    "F99D" => "\xF9\x9D" , //かわいい ひし形
    "F99E" => "\xF9\x9E" , //キスマーク 唇
    "F99F" => "\xF9\x9F" , //ぴかぴか（新しい） ひかってる？
    "F9A0" => "\xF9\xA0" , //ひらめき 電球
    "F9A1" => "\xF9\xA1" , //むかっ（怒り）
    "F9A2" => "\xF9\xA2" , //パンチ こぶし
    "F9A3" => "\xF9\xA3" , //爆弾 ダイナマイト
    "F9A4" => "\xF9\xA4" , //ムード 音符三つ
    "F9A5" => "\xF9\xA5" , //バッド （下向き矢印）
    "F9A6" => "\xF9\xA6" , //眠い（睡眠） ｚｚｚ
    "F9A7" => "\xF9\xA7" , //exclamation ！マーク
    "F9A8" => "\xF9\xA8" , //exclamation&question ！？
    "F9A9" => "\xF9\xA9" , //exclamation×２ !!
    "F9AA" => "\xF9\xAA" , //どんっ（衝突）∑とこれのミラー
    "F9AB" => "\xF9\xAB" , //あせあせ（飛び散る汗）
    "F9AC" => "\xF9\xAC" , //たらーっ（汗）
    "F9AD" => "\xF9\xAD" , //ダッシュ（走り出すさま）
    "F9AE" => "\xF9\xAE" , //ー（長音記号１）
    "F9AF" => "\xF9\xAF" , //ー（長音記号２）
    "F950" => "\xF9\x50" , //カチンコ 映画のカチンコ
    "F951" => "\xF9\x51" , //ふくろ　
    "F952" => "\xF9\x52" , //ペン 万年筆の先
    "F955" => "\xF9\x55" , //人影
    "F956" => "\xF9\x56" , //いす 人が横向きにすわってる？
    "F957" => "\xF9\x57" , //夜 三日月と星枠つき
    "F95B" => "\xF9\x5B" , //soon →の下にsoon
    "F95C" => "\xF9\x5C" , //on ⇔の下にon!
    "F95D" => "\xF9\x5D" , //end ←の下にend
    "F95E" => "\xF9\x5E" , //時計　時計

    /* --- 拡張 --- */
    "F9B1" => "\xF9\xB1" , //iアプリ α
    "F9B2" => "\xF9\xB2" , //iアプリ（枠つき） α枠つき
    "F9B3" => "\xF9\xB3" , //Ｔシャツ（ボーダー）
    "F9B4" => "\xF9\xB4" , //がま口財布
    "F9B5" => "\xF9\xB5" , //化粧 口紅
    "F9B6" => "\xF9\xB6" , //ジーンズ
    "F9B7" => "\xF9\xB7" , //スノボ
    "F9B8" => "\xF9\xB8" , //チャペル ベル
    "F9B9" => "\xF9\xB9" , //ドア
    "F9BA" => "\xF9\xBA" , //ドル袋 袋の中に＄マーク
    "F9BB" => "\xF9\xBB" , //パソコン
    "F9BC" => "\xF9\xBC" , //ラブレター ハートとメール
    "F9BD" => "\xF9\xBD" , //レンチ スパナ
    "F9BE" => "\xF9\xBE" , //鉛筆
    "F9BF" => "\xF9\xBF" , //王冠
    "F9C0" => "\xF9\xC0" , //指輪
    "F9C1" => "\xF9\xC1" , //砂時計
    "F9C2" => "\xF9\xC2" , //自転車
    "F9C3" => "\xF9\xC3" , //湯のみ
    "F9C4" => "\xF9\xC4" , //腕時計
    "F9C5" => "\xF9\xC5" , //考えてる顔
    "F9C6" => "\xF9\xC6" , //ほっとした顔
    "F9C7" => "\xF9\xC7" , //冷や汗
    "F9C8" => "\xF9\xC8" , //冷や汗２
    "F9C9" => "\xF9\xC9" , //ぷっくっくな顔
    "F9CA" => "\xF9\xCA" , //ボケーとした顔
    "F9CB" => "\xF9\xCB" , //目がハート（顔）
    "F9CC" => "\xF9\xCC" , //指でＯＫ
    "F9CD" => "\xF9\xCD" , //あっかんベー（顔）
    "F9CE" => "\xF9\xCE" , //ウィンク（顔）
    "F9CF" => "\xF9\xCF" , //うれしい顔
    "F9D0" => "\xF9\xD0" , //がまん顔
    "F9D1" => "\xF9\xD1" , //猫２
    "F9D2" => "\xF9\xD2" , //泣き顔
    "F9D3" => "\xF9\xD3" , //涙（顔）
    "F9D4" => "\xF9\xD4" , //ＮＧ ＮＧ
    "F9D5" => "\xF9\xD5" , //クリップ
    "F9D6" => "\xF9\xD6" , //コピーライト ○のなかにＣ
    "F9D7" => "\xF9\xD7" , //トレードマーク ＴＭ
    "F9D8" => "\xF9\xD8" , //走る人
    "F9D9" => "\xF9\xD9" , //マル秘 "秘"枠つき
    "F9DA" => "\xF9\xDA" , //リサイクル
    "F9DB" => "\xF9\xDB" , //レジスタードトレードマーク ○の中にＲ
    "F9DC" => "\xF9\xDC" , //危険・警告 △の中に！
    "F9DD" => "\xF9\xDD" , //禁止 "禁"枠つき
    "F9DE" => "\xF9\xDE" , //空室・空席・空車 "空"枠つき
    "F9DF" => "\xF9\xDF" , //合格マーク "合"枠つき
    "F9E0" => "\xF9\xE0" , //満室・満席・満車 "満"枠つき
    "F9E1" => "\xF9\xE1" , //矢印左右 ⇔
    "F9E2" => "\xF9\xE2" , //矢印上下 ⇔の縦バージョン
    "F9E3" => "\xF9\xE3" , //学校
    "F9E4" => "\xF9\xE4" , //波
    "F9E5" => "\xF9\xE5" , //富士山
    "F9E6" => "\xF9\xE6" , //クローバー
    "F9E7" => "\xF9\xE7" , //さくらんぼ
    "F9E8" => "\xF9\xE8" , //チューリップ
    "F9E9" => "\xF9\xE9" , //バナナ
    "F9EA" => "\xF9\xEA" , //リンゴ
    "F9EB" => "\xF9\xEB" , //芽　花の新芽
    "F9EC" => "\xF9\xEC" , //もみじ
    "F9ED" => "\xF9\xED" , //桜
    "F9EE" => "\xF9\xEE" , //おにぎり
    "F9EF" => "\xF9\xEF" , //ショートケーキ
    "F9F0" => "\xF9\xF0" , //とっくり（おちょこ付）
    "F9F1" => "\xF9\xF1" , //どんぶり
    "F9F2" => "\xF9\xF2" , //パン
    "F9F3" => "\xF9\xF3" , //かたつむり
    "F9F4" => "\xF9\xF4" , //ひよこ
    "F9F5" => "\xF9\xF5" , //ペンギン
    "F9F6" => "\xF9\xF6" , //魚
    "F9F7" => "\xF9\xF7" , //うまい！ （顔）
    "F9F8" => "\xF9\xF8" , //ウッシッシ（顔）
    "F9F9" => "\xF9\xF9" , //ウマ
    "F9FA" => "\xF9\xFA" , //ブタ
    "F9FB" => "\xF9\xFB" , //ワイングラス
    "F9FC" => "\xF9\xFC" , //げっそり（顔）
);
