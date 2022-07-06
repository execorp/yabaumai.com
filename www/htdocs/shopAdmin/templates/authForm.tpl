<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="content-language" content="ja" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-Type" content="text/javascript" />
<link href="./css/base.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
<title>::: {$smarty.const.siteName} 管理システム ログイン :::</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
</head>
<body>
<!--  ログイン  -->
    <div id="login">
<form{$form.attributes}>
        <div class="loginBana">- 管理ログイン -<br /><img src="http://www.{$smarty.const.domain}/img/bana/88_31.gif" /><br />{$smarty.const.domain}<br /></div>
        <div class="loginBox"><p class="title"><img src="./img/id.gif" alt="ID" />ID</p><p class="text">{$form.username.html}</p></div>
        <div class="loginBox"><p class="title"><img src="./img/pass.gif" alt="PASS" />PASS</p><p class="text">{$form.password.html}</p></div>
        <div class="loginBana">
        {$form.rememberChk.html}<br />
        {$form.autoLoginChk.html}<br />
        {$form.submitLogin.html}<br />
Ver {$version}
        {if $smarty.get.p}<input type="hidden" name="p" value="{$smarty.get.p}">{/if}
        </div>
</form>

    </div>
<!--  /ログイン  -->
</body>
</html>
