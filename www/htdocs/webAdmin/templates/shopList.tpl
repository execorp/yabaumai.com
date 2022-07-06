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
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;{$pageTitle}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
        <table class="t1">
<form action="./shopList.php" method="post">
            <tr>
                <td><input type="text" name="search" size="30" /><input type="submit" value="店名 or 電話番号で検索"></td>
            </tr>
</form>
        </table>
{if $smarty.post.sendMail}
<font size="+2" color="#ff0000">{$sendShopName}に送信しました</font>
{/if}

        <table class="t1">
{foreach from=$prtData.shopMaster item=value name=result}
            <tr>
                <td>{$smarty.foreach.result.iteration}</td>
                <td><form action="./shopList.php" method="post"><input type="checkbox" name="sendMail" value="{$value.shopId}"><input type="submit" name="sendMail" value="メール"><input type="hidden" name="shopId" value="{$value.shopId}"></form></td>
                <td><form action="../shopAdmin/logIn.php" method="post" target="new"><input type="submit" name="submit" value="ログイン"><input type="hidden" name="username" value="{$value.username}"><input type="hidden" name="password" value="{$value.password}"></form></td>
                <td>{if $value.URL}<a href="http://{$value.URL}" target="_blank">{/if}{$value.shopName}{if $value.URL}</a>{/if}</td>
                <td>{$value.areaId}</td>
                <td>{$value.prefectureId}</td>
                <td>{if $value.priority != $MyCount }<a href="./shopList.php?t=d&p={$value.priority}&shopId={$value.shopId}&ls={$ls}">▽</a>{/if}{if $value.priority > 1 }<a href="./shopList.php?t=u&p={$value.priority}&shopId={$value.shopId}&ls={$ls}">△</a>{/if}</td>
                <td><form action="./shopAddChange.php" method="post"><input type="submit" name="change" value="修正"><input type="hidden" name="shopId" value="{$value.shopId}"></form></td>
                <td><form action="./shopList.php" method="post"><input type="checkbox" name="delChk" value="{$value.shopId}"><input type="submit" name="del" value="削除"><input type="hidden" name="shopId" value="{$value.shopId}"></form></td>
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
    
    <!-- div style="position:absolute;left:780px;top:80px;">
        <iframe name="preview" src="../top.php?s=1" height="550" width="270"> 
            この部分は iframe 対応のブラウザで見てください。
        </iframe>
    </div -->
</div>
</body>
</html>
