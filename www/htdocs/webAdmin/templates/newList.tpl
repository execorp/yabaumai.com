<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
{$form.javascript}
</head>
<body id="adminBase">
<div id="outline">
{$menu}
    <div id="contents">
    <h3 id="pageTitle">管理システム｜{$prtTitle}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
        <table class="t1">
{foreach from=$prtMySQLResult item=value name=result}
            <tr>
                <td nowrap="nowrap">{$smarty.foreach.result.iteration}</td>
                <td vAlign="top" width="100%"><font color="blue"><b>{$value.title}</b></font>　<font size="2" color="red">[{$value.areaName}]</font>　<font size="1" color="gray">{$value.dateTime|date_format:"%Y/%m/%d %H:%M"}</font><br />{$value.comment|nl2br}</td>
                <td vAlign="top" nowrap="nowrap">{if $value.file}<img src="../inc/picR.php?imgId={$value.imgId}&t=whatsNew&mh=80">{/if}</td>
                <td width="40"><form action="./newAddChange.php" method="post"><input type="submit" name="change" value="修正"><input type="hidden" name="imgId" value="{$value.imgId}"></form></td>
                <td width="40"><form action="./newList.php" method="post"><input type="checkbox" name="delChk" value="{$value.imgId}"><input type="submit" name="del" value="削除"><input type="hidden" name="imgId" value="{$value.imgId}"></form></td>
            </tr>
{/foreach}
{if $pagerLinks.all}
            <tr>
                <td align="center" colSpan="6">{$pagerLinks.all}</td>
            </tr>
{/if}
        </table>
    </div>
    </div>
</div>
</body>
</html>
