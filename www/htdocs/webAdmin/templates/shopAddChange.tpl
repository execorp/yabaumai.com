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
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;{$pageTitle}</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
{if $errorStr}<div class="massage">{$errorStr}</div>{/if}
<table class="t1">
<form{$form.attributes}>
    <tr><th class="addGal">{$form.shopName.label} <span class="cap">※必{literal}須{/literal}</span></th><td>{$form.shopName.html} <span class="cap">（* 全角）</span></td></tr>
    <tr><th class="addGal">{$form.shopNameKana.label} <span class="cap">※必{literal}須{/literal}</span></th><td>{$form.shopNameKana.html} <span class="cap">（* 全角ひらがな）</span></td></tr>
    <tr><th class="addGal">{$form.tel.label} </th><td>{$form.tel.html}</td></tr>
    <tr><th class="addGal">{$form.URL.label} </th><td>http://{$form.URL.html}</td></tr>
    <tr><th class="addGal">{$form.RSS.label} </th><td>http://{$form.RSS.html}</td></tr>
    <tr><th class="addGal">{$form.mail.label} </th><td>{$form.mail.html}</td></tr>
    <tr><th class="addGal">{$form.areaId.label} </th><td>{$form.areaId.html}</td></tr>
    <tr><th class="addGal">{$form.prefectureId.label} </th><td>{$form.prefectureId.html}</td></tr>
    <tr><th class="addGal">{$form.genreId.label} </th><td>{$form.genreId.html}</td></tr>
    <tr><th class="addGal">{$form.jobCategory.label} </th><td>{$form.jobCategory.html}</td></tr>
    <tr><th class="addGal">{$form.jobBack.label} </th><td>{$form.jobBack.html}</td></tr>
    <tr><th class="addGal">{$form.workComment.label} </th><td>{$form.workComment.html}</td></tr>
    <tr><th class="addGal">{$form.license.label} </th><td>{$form.license.html}</td></tr>
    <tr><th class="addGal">{$form.employ.label} </th><td>{$form.employ.html}</td></tr>
    <tr><th class="addGal">{$form.place.label} </th><td>{$form.place.html}</td></tr>
    <tr><th class="addGal">{$form.traffic.label} </th><td>{$form.traffic.html}</td></tr>
    <tr><th class="addGal">{$form.workTime.label} </th><td>{$form.workTime.html}</td></tr>
    <tr><th class="addGal">{$form.salary.label} </th><td>{$form.salary.html}</td></tr>
    <tr><th class="addGal">{$form.treatment.label} </th><td>{$form.treatment.html}</td></tr>
    <tr><th class="addGal">{$form.holiday.label} </th><td>{$form.holiday.html}</td></tr>
    <tr><th class="addGal">{$form.educatetrain.label} </th><td>{$form.educatetrain.html}</td></tr>
    <tr><th class="addGal">{$form.establish.label} </th><td>{$form.establish.html}</td></tr>
    <tr><th class="addGal">{$form.represent.label} </th><td>{$form.represent.html}</td></tr>
    <tr><th class="addGal">{$form.companyMoney.label} </th><td>{$form.companyMoney.html}</td></tr>
    <tr><th class="addGal">{$form.employee.label} </th><td>{$form.employee.html}</td></tr>
    <tr><th class="addGal">{$form.business.label} </th><td>{$form.business.html}</td></tr>
    <tr><th class="addGal">{$form.officePlace.label} </th><td>{$form.officePlace.html}</td></tr>
    <tr><th class="addGal">{$form.selection.label} </th><td>{$form.selection.html}</td></tr>
    <tr><th class="addGal">{$form.application.label} </th><td>{$form.application.html}</td></tr>
    <tr><th class="addGal">{$form.interviewPlace.label} </th><td>{$form.interviewPlace.html}</td></tr>
    <tr><th class="addGal">{$form.contactAddress.label} </th><td>{$form.contactAddress.html}</td></tr>
    <tr><th class="addGal">{$form.shopComment.label} </th><td>{$form.shopComment.html}</td></tr>
    <tr><th class="addGal">{$form.loginId.label} <span class="cap">※必{literal}須{/literal}</span></th><td>{$form.loginId.html}</td></tr>
    <tr><th class="addGal" nowrap="nowrap">{$form.loginPass.label} <span class="cap">※必{literal}須{/literal}</span></th><td>{$form.loginPass.html}</td></tr>
    
    <tr>
	<th class="addGal">アイコン </th>
	<td>
{foreach from=$form.iconList key=key item=row}
	{$row.html}
{/foreach}
	</td>
    </tr>
    
    <tr><th class="addGal">{$form.userfile0.label}<br /><span class="cap">(横150 x 縦40)</span></th><td>{$form.userfile0.html}{if $imgId0}<br /><img src="../inc/picR.php?imgId={$imgId0}&t=image&rs=1" /><input name="imageBanaDelChk" type="checkbox" value="{$imgId0}" /><font color="#ff0000">削除ﾁｪｯｸ</font>{/if}</td></tr>
    <tr><th class="addGal">{$form.userfile1.label}<br /><span class="cap">(横320 x 縦240)</span></th><td>{$form.userfile1.html}{if $imgId1}<br /><img src="../inc/picR.php?imgId={$imgId1}&t=image&rs=1" /><input name="imageShopDelChk" type="checkbox" value="{$imgId1}" /><font color="#ff0000">削除ﾁｪｯｸ</font>{/if}</td></tr>
    <tr><th class="addGal">{$form.priority.label} </th><td>{$form.priority.html}位</td></tr>
    <tr><th class="addGal">{$form.regDateTime.label} </th><td>{$form.regDateTime.html}</td></tr>
</table>
    <div class="submit">
    {$form.submitReg.html}
    </div>
    </div>
    <!-- div style="position:absolute;left:780px;top:80px;">
        <iframe name="preview" src="../top.php?s=1" height="550" width="270"> 
            この部分は iframe 対応のブラウザで見てください。
        </iframe>
    </div -->
</div>
{$form.hidden}
</form>
</body>
</html>
