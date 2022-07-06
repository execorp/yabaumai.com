<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="index,follow,noodp">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<meta name="description" content="{$smarty.const.description}" />
	<meta name="keywords" content="{$smarty.const.keywords}" />
	<meta name="generator" content="{$smarty.const.generator}" />
	{if $smarty.server.PHP_SELF|escape == '/gaiyou.php'}
		<meta name="robots" content="noindex,nofollow,noarchive,noodp,noydir">
	{/if}
	<title>{$smarty.const.pagePrintTitle}</title>
	<link rel="canonical" href="http://yabaumai.com/">
	<link rel="stylesheet" href="/css/top_before.css?v=1628068627" media="all">
	<link rel="preload" href="/css/top_after.css?v=1628068627" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
	<noscript><link rel="stylesheet" href="/css/top_after.css?v=1628068627"></noscript>

	{literal}
	<script type="text/javascript">
		!function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(a){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.addEventListener?t.removeEventListener("load",e):t.attachEvent&&t.detachEvent("onload",e),t.setAttribute("onload",null),t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
	</script>
	{/literal}
	<script src="/js/common_before.js?v=1628068627"></script>
	{*{literal}*}
	{*<script>*}
		{*// Velocity Parameter*}
		{*vp = {*}
			{*ac        : "01",*}
			{*ecd       : "01",*}
			{*originUrl : "/index.htm?WIC=1&show=1",*}
			{*domain_ssl: "https://www.e-aidem.com",*}
			{*domain    : "https://www.e-aidem.com",*}
			{*rootPath  : "https://www.e-aidem.com"*}
		{*};*}
	{*</script>*}
	{*{/literal}*}
</head>

<body>

<header id="pageTop">
	<div class="clearfix">
		<p class="logo"><a href="/">yabaumai</a></p>
{*		<h1>CAFE INFO</h1>*}
	</div>
</header>

<section id="workInfo">
	<p>CAFE FOOD INFO</p>
</section>
<div class="mainImg">
	<img src="/img/ogasuta458A7873_TP_V.jpg">
</div>
<div class="img-index-back">
<section id="freewordS">
	<div class="formbox">
		<div class="text">
			<p>フリーワードで探す</p>
		</div>
		<form class="form_inline" name="formKeyWord" action="/#real_wrap" method="get" accept-charset="utf-8">
			<div class="Sform">
				<div class="Sform_inner">
					<input class="form_control tokusyu js-toggleBtnFlag" type="text" id="top_input" name="searchKeyWord" value="{if $smarty.get.searchKeyWord}{$smarty.get.searchKeyWord}{/if}" maxlength="30" placeholder="">
					<button type="submit" id="searchbotton"><i class="fa fa-search fa-flip-horizontal" aria-hidden="true"></i></button>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="areaSearchContainer" >
	<nav id="areaSearch">
		<h2>ご希望のエリアからカフェを探す</h2>
		<ul class="area_list">
			{foreach from=$prtData.areaPref item=value key=key}
				<li class="btn0{$key} region" data-region="0{$key}">
					<a>{$areaArray.$key}</a>
				</li>
			{/foreach}
		</ul>

		<div class="pref_select_box_container">
		{foreach from=$prtData.areaPref item=value key=key}
			<div class="pref_select_box" data-region="0{$key}">
				<div class="pref_select_box_header">
					<span class="btn-back no-border">戻る</span>
					<strong class="pref_select_box_title white">
						<span class="pref_select_box_title_region">{$areaArray.$key}</span>
						<span class="small">の</span>エリア<span class="small">から探す</span>
					</strong>
				</div>
				<ul class="pref_select_box_list">
					{foreach from=$value item=value2 key=key2}
						<li class="pref_select_box_list_item"><a href="/index{$key}-{$key2}.html#real_wrap" class="no-border">{$value2}</a></li>
					{/foreach}
				</ul>
			</div>
		{/foreach}
		</div>
	</nav>
</section>
</div>
<section class="contBg" id="popular">
	<h2><i class="fa-solid fa-circle-info fontawesome"></i>最新情報</h2>
	<ul class="contents contBtn clearfix">
		{foreach from=$news key=key item=row}
			<li>
				{if $row.URL}<a href="http://{$row.URL}" target="blank">{/if}
					{if $row.filePath or $row.file}
						<div class="img_box">
							{if $row.filePath}<img src="{$row.filePath}&amp;mw=320&amp;mh=240" alt="{$row.title}" style="padding:3px;" /><br />{/if}
							{if $row.file}<img src="./inc/picR.php?imgId={$row.imgId}&amp;t=whatsNew&amp;mw=320&amp;mh=240" alt="{$row.title}" style="padding:3px;" /><br />{/if}
						</div>
					{/if}
					<dl>
						<dt>{$row.title}</dt>
						<dd>
							<span>{if $row.shopName}{$row.shopName}{/if}</span>
							【{$row.dateTime|date_format:"%Y/%m/%d %H:%M"}】<br />
							{$row.comment|nl2br}<br />
							{if $row.tel}<br /><b><i class="fa fa-mobile" aria-hidden="true"></i> <a href="tel:{$row.tel}">{$row.tel}</a></b><br />{/if}
						</dd>
					</dl>
				{if $row.URL}</a>{/if}
			</li>
		{/foreach}
	</ul>
</section>

<section class="contBg" id="pickupBox">
	<h2 id="real_wrap">カフェ一覧</h2>
	<ul class="contents" id="pickupList">
		{foreach from=$shop key=key item=row}
		<li class="pickupItem">
				<h2>
					<a class="card_jobInfo_title" href="http://{$row.URL}" style="text-decoration:none;padding: 0;" target="_blank">
						{if $row.imgIdGal}<img src="/userImg/image/{$row.imgIdGal}/w243-h183.jpg" alt="{$row.shopName|escape:'html'}" width="125" height="100" style="margin:5px;" />{/if}
						<br />{$row.shopName|escape:'html'}
					</a>
				</h2>
				<div class="pickupItemBox">
					{foreach from=$iconArray item=value name=result key=key2}
						<span class="icon_s_{if $row.icon.$key2.iconList}strong{else}term{/if}">{$value}</span>
					{/foreach}
				</div>
				<div class="pickupItemBox">
{*					<span class="pickupItem_linktext">職種：{$row.genreName}</span>*}
					<span class="pickupItem_linktext">エリア：{$row.areaName} {$row.prefectureName}</span>
					<span class="pickupItem_lede">
						<a href="mailto:{$row.mail}?subject=『{$smarty.const.siteNamePrint}』から問い合わせ" class="btn-square-little-rich btn-mail">
							<i class="fa fa-envelope-o" aria-hidden="true"></i> メールを送る
						</a>
						<a href="/shop{$row.areaId}-{$row.prefectureId}-{$row.shopId}.html" class="btn-square-little-rich btn-detail">
							<i class="fa fa-file-text-o" aria-hidden="true"></i> 詳細を見る
						</a>
					</span>
				</div>
		</li>
		{/foreach}
	</ul>
</section>

<section class="contBg" id="usefulCont">
	<h2><i class="fa-solid fa-bell fontawesome"></i>注目企業ピックアップ</h2>
	<ul class="contents icon clearfix">
		{foreach from=$banner item=value name=result key=key}
			{if $value.imgId}
				<li>
					<a href="http://{$value.URL}" target="_blank" rel="noopener"><img src="/userImg/recommendBanner/{$value.imgId}/{$value.imgId}.jpg" alt="{$value.name}" loading="lazy"></a>
				</li>
			{/if}
		{/foreach}
	</ul>
</section>

{include file=$smarty.const.footerPath}
