<?
//require_once( "../inc/auth.php" );
require_once( "../inc/authClient.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "./adminConfig.php" );

//home用
if( $_GET[category] == "home" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">ホーム</p>
    <ul>
    <li><a href="home.php" target="mainframe" title="おしらせ">　おしらせ</a></li>
    </ul>

EOF;

/*
<p class="title"><img src="./img/ya.gif">要望</p>
    <ul>
    <li><a href="request.php" target="mainframe" title="変更・要望">　変更・要望</a></li>
    </ul>
</div>
*/

//news用
}elseif( $_GET[category] == "news" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">新着管理</p>
    <ul>
    <li><a href="newAddChange.php" target="mainframe" title="新着管理 新規登録">　新規登録</a></li>
    <li><a href="newList.php" target="mainframe" title="新着管理 一覧">　一覧</a></li>
    </ul>
</div>
EOF;

//cover用
}elseif( $_GET[category] == "cover" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">PC画像管理</p>
    <ul>
    <li><a href="coverList.php" target="mainframe" title="PC画像管理 登録・修正">　登録・修正</a></li>
    </ul>
</div>
EOF;

//girls用
}elseif( $_GET[category] == "girls" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">インタビュー管理</p>
    <ul>
    <li><a href="interviewAddChange.php" target="mainframe" title="インタビュー管理 新規登録">　新規登録</a></li>
    <li><a href="interviewList.php" target="mainframe" title="インタビュー管理 一覧">　一覧</a></li>
    </ul>
</div>
EOF;

//schedule用
}elseif( $_GET[category] == "schedule" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">出勤管理</p>
    <ul>
    <li><a href="scheduleAddChange.php" target="mainframe" title="登録・修正">　登録・修正</a></li>
    </ul>
</div>
EOF;

//realtime用
}elseif( $_GET[category] == "realtime" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">リアルタイム管理</p>
    <ul>
    <li><a href="realtimeAddChange.php" target="mainframe" title="リアルタイム管理 新規登録">　新規登録</a></li>
    <li><a href="realtimeList.php" target="mainframe" title="リアルタイム管理 一覧">　一覧</a></li>
    </ul>
</div>
EOF;

//diary用
}elseif( $_GET[category] == "diary" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">スタッフ日記管理</p>
    <ul>
    <li><a href="diaryAddChange.php" target="mainframe" title="スタッフ日記管理 登録・修正">　登録・修正</a></li>
    </ul>
EOF;

//maga用
}elseif( $_GET[category] == "maga" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">メルマガ管理</p>
    <ul>
    <li><a href="magaAddChange.php" target="mainframe" title="メルマガ管理 送信">　メルマガ送信</a></li>
    <li><a href="magaList.php" target="mainframe" title="メルマガ管理 一覧">　会員一覧</a></li>
    </ul>
</div>
EOF;

//link用
}elseif( $_GET[category] == "link" ){
$menuList = <<<EOF
<div class="menu">

<p class="title"><img src="./img/ya.gif">認証リンク管理</p>
    <li><a href="./linkBAddChange.php" target="mainframe" title="リンク管理 認証リンク新規登録">　新規登録</a></li>
    <li><a href="./linkBList.php" target="mainframe" title="リンク管理 認証リンク一覧">　一覧</a></li>
    </ul>
</div>
	
EOF;
/*
<p class="title"><img src="./img/ya.gif">相互リンク管理</p>
    <ul>
    <li><a href="./linkAddChange.php" target="mainframe" title="リンク管理 相互リンク新規登録">　新規登録</a></li>
    <li><a href="./linkList.php" target="mainframe" title="リンク管理 相互リンク一覧">　一覧</a></li>
*/


//mobile用
}elseif( $_GET[category] == "mobile" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">携帯画像管理</p>
    <ul>
    <li><a href="coverMobileList.php" target="mainframe" title="携帯画像管理 登録・修正">　登録・修正</a></li>
    </ul>
</div>
EOF;

//setting用
}elseif( $_GET[category] == "setting" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">設定管理</p>
    <ul>
    <li><a href="passAddChange.php" target="mainframe" title="設定管理 ログイン設定">　ログイン設定</a></li>
    <li><a href="qrCode.php" target="mainframe" title="設定管理 QRコード表示">　QRコード表示</a></li>
    <li><a href="http://www.execute.jp/mailSetUp/?d={$domain}&s={$shopName_enocoded}&m=info" target="_blank" title="設定管理 Becky!メール設定">　Becky!メール設定</a></li>

    <li><a href="fileview.php?file=siteSetting.pdf" target="_blank" title="設定管理 サイト設定書類">　サイト設定書類</a></li>
<p class="title"><img src="./img/ya.gif">アップローダー</p>
    <ul>
    <li><a href="uploaderAddChange.php" target="mainframe" title="アップローダー 新規登録">　新規登録</a></li>
    <li><a href="uploaderList.php" target="mainframe" title="アップローダー 一覧">　一覧</a></li>
    <li><a href="uploaderGenre.php" target="mainframe" title="アップローダー 利用区分">　利用区分</a></li>
    </ul>
    </ul>
</div>
EOF;
	/*
    <li><a href="access.php" target="mainframe" title="設定管理 アクセス解析">　アクセス解析</a></li>
    */
//telop用
}elseif( $_GET[category] == "telop" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">テロップ管理</p>
    <ul>
    <li><a href="telopAddChange.php" target="mainframe" title="テロップ管理 登録・修正">　登録・修正</a></li>
    </ul>
</div>
EOF;


//reserve用
}elseif( $_GET[category] == "reserve" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">オンライン予約管理</p>
    <ul>
    <li><a href="reserveList.php" target="mainframe" title="オンライン予約管理 一覧">　一覧</a></li>
    </ul>
</div>
EOF;


//recruit用
}elseif( $_GET[category] == "recruit" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">求人応募管理</p>
    <ul>
    <li><a href="recruitList.php" target="mainframe" title="求人応募管理 一覧">　一覧</a></li>
    </ul>
</div>
EOF;

}elseif( $_GET[category] == "qanda" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">よくある質問管理</p>
    <ul>
    <li><a href="qandaAddChange.php" target="mainframe" title="よくある質問管理 新規登録">　新規登録</a></li>
    <li><a href="qandaList.php" target="mainframe" title="よくある質問管理 一覧">　一覧</a></li>
    </ul>
</div>
EOF;

}elseif( $_GET[category] == "hotelList" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">ホテル管理</p>
    <ul>
    <li><a href="hotelAddChange.php" target="mainframe" title="ホテルリスト管理 新規登録">　新規登録</a></li>
    <li><a href="hotelList.php" target="mainframe" title="ホテルリスト管理 一覧">　一覧</a></li>
    </ul>
<p class="title"><img src="./img/ya.gif">区市町村管理</p>
    <ul>
    <li><a href="hotelTownAddChange.php" target="mainframe" title="ホテル所在地管理 新規登録">　新規登録</a></li>
    <li><a href="hotelTownList.php" target="mainframe" title="ホテル所在地管理 一覧">　一覧</a></li>
    </ul>
</div>
	
EOF;

}elseif( $_GET[category] == "shop" ){
$menuList = <<<EOF
<div class="menu">
<p class="title"><img src="./img/ya.gif">店舗管理</p>
    <ul>
    <li><a href="shopAddChange.php" target="mainframe" title="店舗管理 修正">　修正</a></li>
    </ul>
</div>
	
EOF;

}

//HTML書き出し
$html = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: $siteName 管理システム :::</title>
<link href="./css/base.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/category.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body id="menu">
    <div id="menuBox">
    $menuList
    </div>
</body>
</html>
EOF;

//HTML書き出し
print $html;

?>