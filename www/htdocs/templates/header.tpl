<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta name="description" content="{$smarty.const.description}" />
  <meta name="keywords" content="{$smarty.const.keywords}" />
  <meta name="generator" content="{$smarty.const.generator}" />
  {if $smarty.server.PHP_SELF|escape == '/gaiyou.php'}
    <meta name="robots" content="noindex,nofollow,noarchive,noodp,noydir">
  {/if}
  <title>{$smarty.const.pagePrintTitle}</title>
  <link rel="canonical" href="http://yabaumai.com" />

  <link rel="preload" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></noscript>
  {literal}
  <script type="text/javascript">
    !function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(a){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.addEventListener?t.removeEventListener("load",e):t.attachEvent&&t.detachEvent("onload",e),t.setAttribute("onload",null),t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
  </script>
  {/literal}
  <script src="/js/common_before.js?v=1628068627"></script>
  <link rel="stylesheet" href="/css/detail_before.css?v=1628068627" media="all">
  <link rel="preload" href="/css/detail_after.css?v=1628068627" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
  <noscript><link rel="stylesheet" href="/css/detail_after.css?v=1628068627"></noscript>
  {literal}
  <script type="text/javascript">
    !function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(a){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.addEventListener?t.removeEventListener("load",e):t.attachEvent&&t.detachEvent("onload",e),t.setAttribute("onload",null),t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
  </script>
  {/literal}


  {*<!-- jobpostingマークアップ -->*}
  {*<script type="application/ld+json">*}
  {*</script>*}
  {*<!-- end jobpostingマークアップ -->*}
  {*<!-- faqマークアップ -->*}
  {*<script type="application/ld+json">*}
  {*</script>*}
  {*<!-- end faqマークアップ -->*}
  {*<script type='text/javascript'>*}
    {*var hellowork_api_domain = "https://www.e-aidem.net";*}
  {*</script>*}
</head>
<body>

<style media="screen">

</style>
<header id="pageTop">
  <div class="clearfix">
    <p class="logo" id="area-name" data-area="02">
      <a href="/">yabaumai</a>
    </p>
    <p class="menuBtn"><img src="/img/hamburger_menu.png" width="40" height="40" alt="menu"></p>
    <input type="hidden" id="actualExamCnt" />
  </div>
</header>

{$smarty.const.pagePrint}

<section id="modalMenu">
  <div class="menuInner">
    <div class="menuWrap">
      <dl class="loginBefore">
        <dt>メニュー</dt>
        <dd><a href="adver.html">掲載申し込み</a></dd>
        <dd><a href="inquiry.html">お問い合わせ</a></dd>
        <dd><a href="gaiyou.html">会社概要</a></dd>
      </dl>
      <p class="btn-topPage"><a href="/">全国TOPへ</a></p>
      <p class="btn-close"><img src="/img/batsu_thin_white_40_shadow.png" alt="閉じる"></p>
    </div>
  </div>
</section>