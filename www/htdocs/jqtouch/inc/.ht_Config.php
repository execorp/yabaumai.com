<?
/* -------------------------------------------------------------------------------------- */
//  設定を変更しないといけない箇所
//  /webAdmin/mm/errorMailChecker.php の php パス
//  /webAdmin/mm/errorMailChecker.php の config.php パス
//
//  下記インクルードパス
/* -------------------------------------------------------------------------------------- */

//更新時差を設定
define ("JET_LAG", 6 );

define ("FILE_PATH", "/home/hakui-angel/www/files/" );
define ("ROOT_PATH", "/home/hakui-angel/www/htdocs/" );
define ("PUBLIC_HTML", "http://www.hakui-angel.com/" );
require_once( ROOT_PATH ."inc/.ht_DBConnect.inc" );
require_once( "DB.php" );
require_once( '/usr/local/lib/php/Smarty/Smarty.class.php' );

//忍者アクセス解析用タグ読込
require_once( "ninjaTag.php" );

$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

//右クリック禁止設定取得
$rightClick = $db->getOne("SELECT `settingValue` FROM `setting` WHERE `settingName` = ?", array('rightClickFlg'));
define ( 'RIGHT_CLICK_BAN', $rightClick );

/* --- ログイン用 --- */
$cookieLimit = 3600 * 24 * 30;

$levelArray = array(
     0 => 'exe専用' , 
     1 => '代理店' , 
     2 => 'スーパーユーザー' , 
     3 => '幹部' , 
     4 => '通常' 
);

//exe専用変更可のIP
$ipArrowListArray = array(
    "211.132.41.217" , 
    "59.190.117.210" , 
);

$domain   = "hakui-angel.com";
define ( domain, $domain );
$siteName = "広島 白衣の天使のアルバイト";
define ( siteName, $siteName );

$shopTenpo1 = "広島 白衣の天使のアルバイト";
define ( shopTenpo1, $shopTenpo1 );
$shopTel1 = "082-504-6669";
define ( shopTel1, $shopTel1 );

/*
$shopTenpo2 = "名古屋";
define ( shopTenpo2, $shopTenpo2 );
$shopTel2 = "052-981-4441";
define ( shopTel2, $shopTel2 );

$shopTenpo3 = "津・松坂";
define ( shopTenpo3, $shopTenpo3 );
$shopTel3 = "059-235-2552";
define ( shopTel3, $shopTel3 );

$shopTenpo4 = "岐阜";
define ( shopTenpo4, $shopTenpo4 );
$shopTel4 = "058-268-8585";
define ( shopTel4, $shopTel4 );
*/

define ( 'shopTenpo', shopTenpo1 );
define ( 'shopTel', shopTel1 );

$shopMail = "info@" . $domain;
define ( shopMail, $shopMail );

/* --- keywords・description用 --- */
$title   = "広島 風俗 デリバリーヘルス " . $siteName . "";
define ( title, $title );
$titleM   = "広島 風俗 ﾃﾞﾘﾊﾞﾘｰﾍﾙｽ " . $siteName;
define ( titleM, $titleM );

$keywords   = "広島 風俗 デリバリーヘルス," . $siteName . ",素人専門,デリヘル,デリバリーヘルス";
define ( keywords, $keywords );
$description   = "広島 デリバリーヘルス風俗の" . $siteName . "をご利用ください。";
define ( description, $description );
$Author   = "広島 デリバリーヘルス 風俗｜" . $siteName . "";
define ( Author, $Author );
$owner   = "広島 デリバリーヘルス  風俗｜" . $siteName . "";
define ( owner, $owner );
$classification   = "広島 デリバリーヘルス 風俗｜" . $siteName . "";
define ( classification, $classification );

/* --- copyright用 --- */
$copyright   = "Copyright2010(C) HAKUI-ANGEL.COM All Right Reserved.";
define ( copyright, $copyright );

/* --- header・footer用(PC) --- */
$header_pc = ROOT_PATH . 'templates/header.tpl';
define ( header_pc, $header_pc );
$footer_pc = ROOT_PATH . 'templates/footer.tpl';
define ( footer_pc, $footer_pc );
$ninja_pc = ROOT_PATH . 'templates/ninja.tpl';
define ( ninja_pc, $ninja_pc );

/* --- header・footer用(携帯) --- */
$header_mobile = ROOT_PATH . 'templates/headerM.tpl';
define ( header_mobile, $header_mobile );
$footer_mobile = ROOT_PATH . 'templates/footerM.tpl';
define ( footer_mobile, $footer_mobile );
$ninja_mobile = ROOT_PATH . 'templates/ninjaM.tpl';
define ( ninja_mobile, $ninja_mobile );

/* --- カラーコード用(携帯) --- */
define ("COLOR_BG_BASE", '#ffffff' ); //基本背景色
define ("COLOR_TEXT_BASE", '#CF0002' ); //基本文字色
define ("COLOR_LINK_BASE", '#F590A3' ); //基本リンク文字色
define ("COLOR_LINK_DARK", '#9d000c' ); //背景が濃いとき用リンク文字色
define ("COLOR_VLINK_BASE", COLOR_LINK_BASE ); //訪問済リンク文字色
	
define ("COLOR_BG_H1", '#e60012' ); //大見出し背景色
define ("COLOR_BG_H2", '#e4e4e4' ); //中見出し背景色
define ("COLOR_BG_H3", '#575757' ); //小見出し背景色
define ("COLOR_BG_COMMENT", '#e6e0d4' ); //コメント背景色
define ("COLOR_BG_MENU1", '#DDE6F7' ); //メニュー背景色①
define ("COLOR_BG_MENU2", '#F7DEFE' ); //メニュー背景色②
	
define ("COLOR_TEXT_H1", '#ffffff' ); //大見出し文字色
define ("COLOR_TEXT_H2", '#FF99CC' ); //中見出し文字色
define ("COLOR_TEXT_H3", '#FF99CC' ); //小見出し文字色
define ("COLOR_TEXT_COMMENT", '#f2c861' ); //コメント文字色
define ("COLOR_TEXT_MENU1", '#ff0000' ); //メニュー文字色①
define ("COLOR_TEXT_MENU2", '#ff0000' ); //メニュー文字色②

define ("COLOR_FONT_H1", COLOR_TEXT_H1 ); //大見出し文字色
define ("COLOR_FONT_H2", COLOR_TEXT_H2 ); //中見出し文字色
define ("COLOR_FONT_H3", COLOR_TEXT_H3 ); //小見出し文字色
define ("COLOR_FONT_COMMENT", COLOR_TEXT_COMMENT ); //コメント文字色
define ("COLOR_FONT_MENU1", COLOR_TEXT_MENU1 ); //メニュー文字色①
define ("COLOR_FONT_MENU2", COLOR_TEXT_MENU2 ); //メニュー文字色②

define ("COLOR_LINE_BASE", '#e60012' ); //ライン色①
define ("COLOR_LINE_COMMENT", '#9d000c' ); //ライン色②

/* --- profile用(ポップアップの幅・高さ) --- */
$profileWidth = 910;
define ( profileWidth, $profileWidth );
$profileHeight = 810;
define ( profileHeight, $profileHeight );

/* --- メニュー用(PC) --- */
$here = $_SERVER["PHP_SELF"];
//メニューリスト
$_menuAry = array( 
    "top"         => "トップページ" , 
    "schedule"    => "出勤情報" , 
    "girls"       => "女の子紹介" , 
    "system"      => "料金システム" , 
    "card"        => "カード決済" , 
    "reserve"     => "オンライン予約" ,
    "diary"       => "女の子＆スタッフ日記" , 
    "recruit"     => "求人案内" , 
    "link"        => "相互リンク" , 
);
//メニュー生成
foreach( $_menuAry as $key => $value ){
    $menu .= "<li id=\"" . $key . "\"><a href=\"../" . $key . "/\" title=\"" . $value . "\" class=\"";
        if( strstr( $here , $key ) ){
            $menu .= "this";
        }else{
            $menu .= "other";
        }
    $menu .= "\">" . $value . "</a></li>\n";
    
    //フッターリンク
    $footerManu .= "｜<a href=\"../" . $key . "/\" title=\"" . $value . "\">" . $value . "</a>\n";
}
define ( menu, $menu );
define ( footerManu, $footerManu );


/* --- 日記用 --- */
$masterDiaryAddress = "masterdiary@" . $domain ; //管理者用
$galDiaryAddress    = "galdiary@" . $domain ;    //女の子用

/* --- QR作成(メルマガ一発登録用) --- */
$qre = "M";	//エラー
$qrt = "J";	//JPG出力
$qrs = "6";	//サイズ
//$qr_img = "http://www." . $domain . "/qr/qr_img.php?d=reg@" . $domain . "&e=" . $qre . "&t=" . $qrt . "&s=" . $qrs;
$qr_img = "http://www." . $domain . "/qr/qr_img.php?d=reg@" . $domain . "&e=" . $qre . "&t=" . $qrt . "&s=" . $qrs;
define ( qr_img, $qr_img );

/* --- クレジットカード決済用 --- */
$shopId4card = "";
$shopName = siteName;
$shopTel4Card = shopTel1;
define('shopId4card', $shopId4card);
define('shopName', $shopName);
define('shopTel4Card', $shopTel4Card);

/* --- メールマガジン --- */
$returnMail = "errormail@" . $domain ;
$testEmail  = "info@" . $domain;

/* --- メールマガジン登録 --- */
$mailFrom          = "mm@" . $domain;
$returnMailAddress = "errormail@" . $domain ;
$mailSubject       = "仮登録が完了しました";

$mailBody    = $siteName . "です仮登録が完了しました\n";
$mailBody   .= "本登録を完了させるために下記URLをクリックしてください\n";

$mailBody2   = "よろしくお願いします。\n";

$sleepTime   = 10000;
$ezSleepTime = 200000;
/* --- メールマガジン/ --- */


$today    = date ( "Y-m-d", mktime ( 0, 0, 0, date( "m" ), date( "d" ), date( "Y" ) ) );
$dateTime = date ( "Y-m-d H:i:s", mktime ( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) );
if( date( "H" ) < 7 ) $ajust = 1;
$workDate = date ( "Y-m-d", mktime ( 0, 0, 0, date( "m" ), date( "d" ) - $ajust, date( "Y" ) ) );

/* --- 女の子画像 --- */
$imgMaxWidth  = 305;
$imgMaxHeight = 420;
$prtMd5       = md5( time() );
$quality      = 100;

/* --- 出勤管理 --- */
$schTypeArray = array( '休み', '出勤' );

/* --- 相互リンク --- */
$linkGenreArray = array(
     1 => "ランキングサイト" , 
     2 => "求人サイト" , 
     3 => "おすすめサイト" , 
     4 => "相互リンクサイト" , 
);


/* --- ホテルリスト --- */
$hotelGenreArray = array(
    "0" => "ビジネスホテル" , 
    "1" => "ラブホテル" 
);

/* --- 予約用 --- */
$payTypeArray = array(
    1 => "現金" , 
    2 => "クレジットカード" , 
);

$customerTypeArray = array(
    1 => "初めてのお客様" , 
    2 => "リピーターのお客様" , 
);

$reserveCompArray = array(
    0 => "未確認" , 
    1 => "確認済" , 
);


$cArray = array(
    "0" => "A" ,
    "1" => "B" ,
    "2" => "C" ,
    "3" => "D" ,
    "4" => "E" ,
    "5" => "F" ,
    "6" => "G" ,
    "7" => "H" ,
    "8" => "I" ,
    "9" => "J" 
);

$typeArray = array(
    "0" => "巨乳" , 
    "1" => "清楚" , 
    "2" => "ロリ" , 
);


$iconArray = array(
    1 => "NEW" , 
//	2 => "本日出勤" , 
    3 => "巨乳" , 
    4 => "未経験" , 
    5 => "人気者" , 
    6 => "内容重視" , 
    7 => "スタイル抜群" , 
    8 => "ルックス抜群" , 
    9 => "レア出勤" , 
   10 => "責め好き" , 
   11 => "受身好き" , 
   12 => "人気急上昇" , 
   13 => "ロリ系" , 
   14 => "お姉系" , 
   15 => "ギャル系" , 
   16 => "清楚系" , 
   17 => "テクニシャン"
);

$optionArray = array(
    1 => "パンティー" , 
    2 => "パンスト" , 
    3 => "網タイツ" , 
    4 => "ピンクローター" , 
    5 => "アロママッサージ" , 
    6 => "ローション風呂" , 
    7 => "オナニー鑑賞" , 
    8 => "聖水" , 
    9 => "即尺" , 
   10 => "顔射" , 
   11 => "イマラチオ" , 
   12 => "ごっくん" , 
   13 => "逆聖水" , 
   14 => "AF" , 
   15 => "オリジナル" , 
);


$prtArray = array(
    0 => "表示" , 
    1 => "非表示"
	/*
    0 => "HP表示・顧客管理表示" , 
    1 => "HP非表示・顧客管理表示" , 
    2 => "HP表示・顧客管理非表示" , 
    3 => "非表示"
    */
);


/* --- メールマガジン詳細 --- */
$mailStateAray = array(
    "0" => array (
        "0" => "仮登録" , 
        "1" => "#cccccc" 
    ), 

    "1" => array (
        "0" => "本登録" , 
        "1" => "#ffffff" 
    ), 

    "2" => array (
        "0" => "削除中" , 
        "1" => "#999999" 
    )
);

$errorMailColor = "#ff0000";

/* --- メールマガジン詳細/ --- */

//絵文字配列
$emojiArray = array(
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
?>
