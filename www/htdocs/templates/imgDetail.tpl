<?xml version="1.0" encoding="shift_jis"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<meta name="description" content="全国デリヘル店 厳選8人 出勤情報 デリヘル8のトップページ。全国の風俗嬢の出勤・新着・イベントがひと目でわかります。" />
<meta name="keywords" content="デリヘル,デリバリーヘルス,出勤,新着,イベント" />
<meta name="generator" content="全国デリヘル店 厳選8人 出勤情報 デリヘル8のトップページ。全国の風俗嬢の出勤・新着・イベントがひと目でわかります。" />
<title>全国デリヘル店 厳選8人 出勤情報 デリヘル8</title>
<link href="css/base.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="../js/script.js"></script>
<script src="../js/AC_RunActiveContent.js" language="javascript"></script>
</head>
<body>

{foreach from=$shop key=key item=row}
<div id="imgDetailBox">
    <div class="detailData">
        <div class="detailDataBox">
            <div class="detailBana"><a href="http://{$row.URL}" title="{$row.shopName|escape:'html'}" target="_blank"><img src="./inc/picR.php?imgId={$row.imgIdBan}&amp;t=image&amp;mw=150&amp;mh=40" alt="{$row.shopName|escape:'html'}" /></a></div>
            <div class="detailName">
                <p class="detailArea">{$row.genreName} {$row.areaName} {$row.prefectureName}</p>
                <p class="detailName">{$row.shopName|escape:'html'}</p>
                <p class="detailTel">TEL {$row.tel}</p>
            </div>
        </div>
    </div>
    <div class="detailText">TEL受付時に<span>{$smarty.const.siteNamePrint}</span>見たよと伝えて頂くと受付がｽﾑｰｽﾞになります。</div>
    <div class="detailImg"><img src="/inc/picR.php?imgId={$imgId}&t=galImage&amp;mw=300&amp;mh=400" /><br />{$prtData.name|default:"---"}（{$prtData.age|default:"18"}）</div>
    <div class="detailNextBack">
        <p>{if $prtData.beforeImgId}<a href="./imgDetail.php?imgId={$prtData.beforeImgId}&num={$beforeNum}"><img src="./img/imgDetailBack.jpg" alt="前の女の子へ" /></a>{/if}</p>
        <p class="no"><img src="img/no{$num}.gif" alt="no{$num}" /></p>
        <p>{if $prtData.nextImgId}<a href="./imgDetail.php?imgId={$prtData.nextImgId}&num={$nextNum}"><img src="./img/imgDetailNext.jpg" alt="次の女の子へ" /></a>{/if}</p>
    </div>
</div>
{/foreach}

</body>
</html>