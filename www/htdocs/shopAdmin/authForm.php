<?
$siteNamePrint = siteNamePrint;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="content-language" content="ja" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-Type" content="text/javascript" />
<link href="./css/base.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
<title>::: <? echo $siteNamePrint; ?> 店舗別管理システム ログイン :::</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
</head>
<body>
<!--  ログイン  -->
    <div id="login">
        <div class="loginBana">- <? echo $siteNamePrint; ?> 店舗別管理ログイン -<br /><img src="../img/bana/88_31.gif" /></div>
<form action="./logIn.php" method="post">
        <div class="loginBox"><p class="title"><img src="./img/id.gif" alt="ID" />ID</p><p class="text"><input type="text" name="username" style="width:120px;"/></p></div>
        <div class="loginBox"><p class="title"><img src="./img/pass.gif" alt="PASS" />PASS</p><p class="text"><input type="password" name="password" style="width:120px;"/></p></div>
        <div class="loginBana"><input type="submit" name="submit" value="認証" /></div>
</form>
    </div>
<!--  /ログイン  -->
</body>
</html>