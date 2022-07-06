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
    <h3 id="pageTitle">管理システム｜{$title}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
<table class="t1">
            <tr>
            	<th>送信日時</th>
                <th>お名前</th>
                <th>メールアドレス</th>
                <th>詳細</th>
                <th>削除</th>
                <th>確認</th>
            </tr>
{foreach from=$prtData.inquiry item=value name=result}
            <tr>
                <td vAlign="middle" nowrap="nowrap">{$value.regDateTime|date_format:"%Y/%m/%d %H:%M:%S"}</td>
                <td vAlign="middle" nowrap="nowrap">{$value.name}</td>
                <td vAlign="middle" width="100%"><a href="mailto:{$value.eMail}">{$value.eMail}</a></td>
                <td nowrap="nowrap"><form action="./inquiryAddChange.php" method="post"><input type="submit" name="change" value="詳細"><input type="hidden" name="inquiryId" value="{$value.inquiryId}"></form></td>
                <td nowrap="nowrap"><form action="./inquiryList.php" method="post"><input type="checkbox" name="delChk" value="{$value.inquiryId}"><input type="submit" name="del" value="削除"><input type="hidden" name="inquiryId" value="{$value.inquiryId}"></form></td>
                {if $value.chk == 1}<td nowrap="nowrap" style="background-color:#b0ffff;" >確認済</td>{else}<td nowrap="nowrap" width="10%" >未確認</td>{/if}
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
