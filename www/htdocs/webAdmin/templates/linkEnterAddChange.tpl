<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$smarty.const.domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
{$form.javascript}
</head>
<body id="adminBase">
<div id="outline">
{$menu}
    <div id="contents">
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;認証リンク</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
<form {$form.attributes}>
<table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#000000">
    <tr>
        <td width="500" height="20" align="center" valign="middle" colspan="2" class="f_10_w">認証リンク</td>
    </tr>
    <tr>
        <td width="100" align="left" bgcolor="#ff6699" class="td_style">サイト名</td>
        <td width="400" align="left" bgcolor="#ffffff" class="f_10_bk">{$form.name.html}</td>
    </tr>
    <tr>
        <td width="100" align="left" bgcolor="#ff6699" class="td_style">URL</td>
        <td width="400" align="left" bgcolor="#ffffff" class="f_10_bk">http://{$form.URL.html}</td>
    </tr>
    <tr>
        <td width="100" align="left" bgcolor="#ff6699" class="td_style">バナー画像</td>
        <td width="400" align="left" bgcolor="#ffffff" class="f_10_bk">{$form.userfile.html}{if $file}<img src="../inc/picR.php?imgId={$imgId}&t=linkEnterBanner" border="0" />{/if}</td>
    </tr>
    <tr>
        <td width="100" align="left" bgcolor="#ff6699" class="td_style">優先順位</td>
        <td width="400" align="left" bgcolor="#ffffff" class="f_10_bk">{$form.priority.html}</td>
    </tr>
    <tr>
        <td width="500" height="30" align="center" valign="middle" colspan="2" bgcolor="#000000" class="f_10_w">
{$form.regSubmit.html}
{$form.hidden}
        </td>
    </tr>
</table>
</form>
</body>
</html>
