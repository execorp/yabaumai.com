<?
//require_once( "../inc/auth.php" );
require_once( "../inc/authClient.php" );
require_once( "../inc/.ht_Config.php" );

/* --- カテゴリー管理 --- */
/*array( "カテゴリー名", "css・画像名", "最初に表示するファイル" );*/
$categoryAry[] = array( "ホーム", "home", "home" );
$categoryAry[] = array( "新着", "news", "newList" );
$categoryAry[] = array( "店舗情報", "shop", "shopAddChange" );
//$categoryAry[] = array( "PC画像管理", "cover", "coverList" );
//$categoryAry[] = array( "携帯画像管理", "mobile", "coverMobileList" );
//$categoryAry[] = array( "テロップ", "telop", "telopAddChange" );
//$categoryAry[] = array( "女の子", "girls", "interviewList" );
//$categoryAry[] = array( "出勤", "schedule", "scheduleAddChange" );
//$categoryAry[] = array( "リアルタイム", "realtime", "realtimeList" );
//$categoryAry[] = array( "日記", "diary", "diaryList" );
//$categoryAry[] = array( "メルマガ", "maga", "magaList" );
//$categoryAry[] = array( "リンク", "link", "linkBList" );
//$categoryAry[] = array( "オンライン予約", "reserve", "reserveList" );
//$categoryAry[] = array( "求人フォーム", "recruit", "recruitList" );
//$categoryAry[] = array( "よくある質問", "qanda", "qandaList" );
//$categoryAry[] = array( "設定", "setting", "passAddChange" );

//カテゴリー生成
foreach( $categoryAry as $key => $value ){
    $categoryList .= "<li id=\"" . $categoryAry[$key][1] . "\">";
    $categoryList .= "<a href=\"./index.php?category=" . $categoryAry[$key][1] . "&page=" . $categoryAry[$key][2] . "\" target=\"_parent\" title=\"" . $categoryAry[$key][0] . "\" class=\"";
        if( strstr( $_GET["category"] , $categoryAry[$key][1] ) ){
            $categoryList .= "this";
        }else{
            $categoryList .= "other";
        }
    $categoryList .= "\">" . $categoryAry[$key][0] . "</a></li>\n";
}


/* --- mainframe用 header・footer管理 --- */
$header_admin = ROOT_PATH . 'shopAdmin/templates/header.tpl';
define ( header_admin, $header_admin );
$footer_admin = ROOT_PATH . 'shopAdmin/templates/footer.tpl';
define ( footer_admin, $footer_admin );

?>