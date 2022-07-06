<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
{literal}
<script type="text/javascript">
	window.onload = function()
	{
		var oFCKeditor = new FCKeditor( 'comment' ) ;
		oFCKeditor.ReplaceTextarea() ;
	}
</script>
{/literal}
{$form.javascript}
</head>
<body id="adminBase">
<div id="outline">
{$menu}
    <div id="contents">
    <h3 id="pageTitle">管理システム｜{$prtTitle}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
<table class="t1">
<form{$form.attributes}>
    <tr><th class="addGal">{$form.dateTime.label} </th><td>{$form.dateTime.html} <span class="cap">※半角英数字の書式[{$form.dateTime.value}]で入力してください。</span></td></tr>
    <tr><th class="addGal">{$form.title.label} </th><td>{$form.title.html} <span class="cap">※30文字以内</span></td></tr>
    <tr><th class="addGal">{$form.areaShop.label} </th><td>{$form.areaShop.html}</td></tr>
    <tr><th class="addGal">{$form.userfile.label} </th><td>{$form.userfile.html}{if $file}<img src="../inc/picR.php?imgId={$imgId}&t=whatsNew&mw=80">{/if}</td></tr>
    <tr><th class="addGal" colspan="2">{$form.comment.label} </th></tr>
    <tr><td colspan="2"><span class="cap">※600文字以内</span><br /> {$form.comment.html}</td></tr>
</table>
    <div class="submit">
    {$form.submit.html}
    </div>
    </div>
</div>
{$form.hidden}
</form>
</body>
</html>
