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
    <h3 id="pageTitle">店舗別管理システム｜{$prtTitle}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">店舗別管理画面TOP</a>｜<a href="./logOut.php">ログアウト</a></div>
<form{$form.attributes}>
        <table class="t1">
            <tr>
{foreach from=$form.userfile item=value name=name key=key}
{if $key % 2 == 1 }</tr>{/if}
{if $key % 2 == 1 }<tr>{/if}
                <td>

{if $imgArray[$key]}<img src="/inc/picR.php?imgId={$imgArray[$key]}&t=galImage" /><br />{$form.delChk[$key].html}<br />{/if}
{$form.userfile[$key].html}<br />
{$form.shopId[$key].html}<br />
                </td>
{/foreach}
            </tr>
            <tr>
                <td align="center" colSpan="2">{$form.submit.html}</td>
            </tr>
        </table>
    </div>
    </div>
</form>
</div>
</body>
</html>
