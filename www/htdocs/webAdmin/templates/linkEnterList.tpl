<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$smarty.const.domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body id="adminBase">
<div id="outline">
{$menu}
    <div id="contents">
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;認証リンク</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
<table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#000000">
    <tr>
        <td width="500" height="20" align="center" valign="middle" colspan="6" class="f_10_w">認証リンク</td>
    </tr>
{foreach from=$prtData.linkEnterBanner item=value name=result}
    <tr>
        <td>{$smarty.foreach.result.iteration}</td>
        <td>{$value.name}</td>
        <td>{$value.URL}</td>
        <td><form action="./linkEnterAddChange.php" method="post"><input type="submit" name="change" value="修正"><input type="hidden" name="imgId" value="{$value.imgId}"></form></td>
        <td><form action="./linkEnterList.php" method="post"><input type="checkbox" name="delChk" value="{$value.imgId}"><input type="submit" name="del" value="削除"><input type="hidden" name="imgId" value="{$value.imgId}"></form></td>
     </tr>
{/foreach}
{if $pagerLinks.all}
     <tr>
          <td align="center" colSpan="6">{$pagerLinks.all}</td>
     </tr>
{/if}
</table>
</body>
</html>
