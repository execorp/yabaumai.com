<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=shift_jis" />
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
<form{$form.attributes}>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">希望の女の子</th><td style="padding-left:6px;">{$prtData.galType}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">電話番号</th><td style="padding-left:6px;">{$prtData.tel}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">e-Mailアドレス</th><td style="padding-left:6px;"><a href="mailto:{$prtData.eMail}">{$prtData.eMail}</a></td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">面接希望日</th><td style="padding-left:6px;">{$prtData.comment|nl2br}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">{$form.wantDate.label}</th><td style="padding-left:6px;">{$form.wantDate.html}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">{$form.chk.label}</th><td style="padding-left:6px; {if $prtData.chk == 1}background-color:#b0ffff;{/if}">{$form.chk.html}</td></tr>
</table>
    <div class="submit">
    {$form.submit.html}
    </div>
    </div>
</div>
{$form.hidden}
</form>

    <div style="position:absolute;left:860px;top:80px;">
	    <iframe name="preview" src="../recruit/?s=1" height="550" width="270"> 
			この部分は iframe 対応のブラウザで見てください。
		</iframe>
	</div>

</body>
</html>
