<?
//require_once( "../inc/auth.php" );
require_once( "../inc/authClient.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "./adminConfig.php" );

//セッション定数格納
//define('CLIENT_SHOP_ID', $_SESSION["_authsession"]["data"]["shopId"]);
//define('CLIENT_SHOP_NAME', $_SESSION["_authsession"]["data"]["shopName"]);
//define('CLIENT_AREA_ID', $_SESSION["_authsession"]["data"]["areaId"]);

$siteNamePrint   = siteNamePrint;
$domain   = domain;
$siteName = CLIENT_SHOP_NAME;
$shopId = CLIENT_SHOP_ID;

$imgId = $db->getOne("SELECT `imgId` FROM `image` WHERE `model` = ? AND `shopId` = ?", array( 0, $shopId ) );

//HTML書き出し
$html = <<<EOF
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: $siteNamePrint 管理システム :::</title>
<link href="./css/base.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/category.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body id="header">
<!-- ヘッダー  -->
<div id="header">
    <div id="rogo">
        <img src="../inc/picR.php?imgId=$imgId&amp;t=image&amp;mw=88&amp;mh=31" width="88" height="31" alt="$siteName" />
    </div>
    <div id="categoryBox">
        <div id="text">
            <p id="title">管理システム $userLevel</p>
            <p id="name">$siteName</p>
            <p id="icon">{$levelArray[$_SESSION['_authsession']['data']['userLevel']]}<a href="/" target="blank"><img src="./img/pc.gif" alt="PCサイト" border="0" /></a><a href="/?s=1" target="blank"><img src="./img/mobile.gif" alt="モバイルサイト" border="0" /></a></p>
            <p id="logout"><a href="./logOut.php" title="$siteName 管理システムログアウト" target="_top"><img src="./img/logout.jpg" /></a></p>
        </div>
        <div id="category">
            <ul>
            $categoryList
            </ul>
        </div>
    </div>
</div>
<!-- /ヘッダー  -->
</body>
</html>
EOF;

//HTML書き出し
print $html;

?>