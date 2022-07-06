<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body id="adminBase">
<div id="outline">
{$menu}
    <div id="contents">
    <h3 id="pageTitle">管理システム｜{$prtTitle}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
<table class="t1">
<form{$form.attributes}>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;" width="120">送信日時</th><td style="padding-left:6px;">{$prtData.regDateTime|date_format:"%Y/%m/%d %H:%M:%S"}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">お名前</th><td style="padding-left:6px;">{$prtData.name}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">E-Mailアドレス</th><td style="padding-left:6px;"><a href="mailto:{$prtData.eMail}">{$prtData.eMail}</a></td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">お問合わせ内容</th><td style="padding-left:6px;">{$prtData.comment|nl2br}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">{$form.chk.label}</th><td style="padding-left:6px; {if $prtData.chk == 1}background-color:#b0ffff;{/if}">{$form.chk.html}</td></tr>
</table>
    <div>
    {$form.submit.html}
    </div>
    </div>
</div>
{$form.hidden}
</form>

</body>
</html>
