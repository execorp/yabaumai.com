<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=shift_jis" />
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
    <h3 id="pageTitle">管理システム｜{$contName}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
    
{if !$r}<div class="massage">
{$contName}を順位変更・表示変更・削除します。処理したい画像データ欄右から任意の操作を行って下さい。<br />
※画像サイズは【横510px 縦370px】で表示されます。<br />
※登録されている画像の中からランダムでENTERページに表示されます。<br />
</div>{/if}
{if $r == 1}<div class="massage">{$contName}の登録が完了しました。</div>{/if}
{if $r == 2}<div class="massage">{$contName}の修正が完了しました。</div>{/if}
{if $r == 3}<div class="massage">{$contName}の削除が完了しました。</div>{/if}
        <table class="t1">
            <tr>
                <th style="text-align:center;" nowrap="nowrap">No</th>
                <th style="text-align:center;" width="100%">エリア名 / 店舗名 / 女の子名</th>
                <th style="text-align:center;" nowrap="nowrap">画像</th>
<!--
                <th style="text-align:center;" nowrap="nowrap">順位</th>
-->
                <th style="text-align:center;" nowrap="nowrap">表示</th>
                <th style="text-align:center;" nowrap="nowrap">修正</th>
                <th style="text-align:center;" nowrap="nowrap">削除</th>
            </tr>
{foreach from=$prtMySQLResult item=value name=result}
            <tr>
                <td{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>{if $value.prtFlg == 1}予備{else}{$smarty.foreach.result.iteration}{/if}</td>
                <td{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if} align="center" valign="middle"><font color="#ff0000">[{$value.areaName}]</font><br /><font color="#0000ff"><i>{$value.shopName}</i></font><br /><b>{$value.galName}</b></td>
				<td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>{if $value.file}<a href="../inc/thumb.php?imgId={$value.imgId}&t=coverImage&mh=140&mw=190" target="_blank"><img src="../inc/thumb.php?imgId={$value.imgId}&t=coverImage&mh=70&mw=95" border="0" /></a>{/if}</td>
<!--
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>{if $value.priority != $MyCount }<a href="./coverList.php?t=d&p={$value.priority}&imgId={$value.imgId}&ls={$ls}">▽</a>{/if}{if $value.priority > 1 }<a href="./coverList.php?t=u&p={$value.priority}&imgId={$value.imgId}&ls={$ls}">△</a>{/if}</td>
-->
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>
                	<form action="./coverList.php" method="post">
	                    <input type="radio" name="prtFlg" value="0"{if $value.prtFlg == 0} checked{/if}>表示<br />
	                    <input type="radio" name="prtFlg" value="1"{if $value.prtFlg == 1} checked{/if}>非表示<br />
	                    <input type="submit" name="changed" value="変更">
                        <input type="hidden" name="imgId" value="{$value.imgId}">
                    </form>
                </td>

                
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>
                	<form action="./coverAddChange.php" method="post">
	                    <input type="submit" name="changed" value="修正">
                        <input type="hidden" name="imgId" value="{$value.imgId}">
                    </form>
                </td>
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>
                    <form action="./coverList.php" method="post">
                        <input type="checkbox" name="delChk" value="{$value.imgId}"><br />
                        <input type="submit" name="del" value="削除">
                        <input type="hidden" name="imgId" value="{$value.imgId}">
                    </form>
                </td>
            </tr>
{/foreach}
{if $pagerLinks.all}
            <tr>
                <td align="center" colSpan="9">{$pagerLinks.all}</td>
            </tr>
{/if}
        </table>
    </div>
    </div>
</div>
</body>
</html>