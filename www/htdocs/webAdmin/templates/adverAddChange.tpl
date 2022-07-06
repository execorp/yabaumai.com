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
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">No.</th><td style="padding-left:6px;">{$prtData.adver.adverId}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">掲載エリア</th><td style="padding-left:6px;">{$prtData.adver.area}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">法人名もしくは組織名</th><td style="padding-left:6px;">{$prtData.adver.shopName}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">法人名もしくは組織名(フリガナ)</th><td style="padding-left:6px;">{$prtData.adver.shopNameKana}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">担当者名</th><td style="padding-left:6px;">{$prtData.adver.masterName}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">業種</th><td style="padding-left:6px;">{$prtData.adver.industry}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">組織所在地</th><td style="padding-left:6px;">{$prtData.adver.shopPref}{$prtData.adver.shopAddress}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">電話番号</th><td style="padding-left:6px;">{$prtData.adver.tel}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">営業時間</th><td style="padding-left:6px;">{$prtData.adver.workTime}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">定休日</th><td style="padding-left:6px;">{$prtData.adver.holiday}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">メールアドレス</th><td style="padding-left:6px;"><a href="mailto:{$prtData.adver.eMail}">{$prtData.adver.eMail}</a></td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">ホームページアドレス</th><td style="padding-left:6px;"><a href="{$prtData.adver.pcURL}" target="_blank">{$prtData.adver.pcURL}</a></td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">携帯ホームページアドレス</th><td style="padding-left:6px;"><a href="{$prtData.adver.mobileURL}" target="_blank">{$prtData.adver.mobileURL}</a></td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">担当者コメント</th><td style="padding-left:6px;">{$prtData.adver.comment}</td></tr>
    <tr><th class="addGal" style="text-align:right;padding-right:6px;">送信日時</th><td style="padding-left:6px;">{$prtData.adver.regDateTime}</td></tr>
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
