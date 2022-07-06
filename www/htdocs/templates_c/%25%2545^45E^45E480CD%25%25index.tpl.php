<?php /* Smarty version 2.6.26, created on 2022-07-06 12:20:29
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'index.tpl', 10, false),array('modifier', 'date_format', 'index.tpl', 121, false),array('modifier', 'nl2br', 'index.tpl', 122, false),)), $this); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="index,follow,noodp">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<meta name="description" content="<?php echo @description; ?>
" />
	<meta name="keywords" content="<?php echo @keywords; ?>
" />
	<meta name="generator" content="<?php echo @generator; ?>
" />
	<?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)) == '/gaiyou.php'): ?>
		<meta name="robots" content="noindex,nofollow,noarchive,noodp,noydir">
	<?php endif; ?>
	<title><?php echo @pagePrintTitle; ?>
</title>
	<link rel="canonical" href="http://yabaumai.com/">
	<link rel="stylesheet" href="/css/top_before.css?v=1628068627" media="all">
	<link rel="preload" href="/css/top_after.css?v=1628068627" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
	<noscript><link rel="stylesheet" href="/css/top_after.css?v=1628068627"></noscript>

	<?php echo '
	<script type="text/javascript">
		!function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(a){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.addEventListener?t.removeEventListener("load",e):t.attachEvent&&t.detachEvent("onload",e),t.setAttribute("onload",null),t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
	</script>
	'; ?>

	<script src="/js/common_before.js?v=1628068627"></script>
																												</head>

<body>

<header id="pageTop">
	<div class="clearfix">
		<p class="logo"><a href="/">yabaumai</a></p>
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
					<input class="form_control tokusyu js-toggleBtnFlag" type="text" id="top_input" name="searchKeyWord" value="<?php if ($_GET['searchKeyWord']): ?><?php echo $_GET['searchKeyWord']; ?>
<?php endif; ?>" maxlength="30" placeholder="">
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
			<?php $_from = $this->_tpl_vars['prtData']['areaPref']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
				<li class="btn0<?php echo $this->_tpl_vars['key']; ?>
 region" data-region="0<?php echo $this->_tpl_vars['key']; ?>
">
					<a><?php echo $this->_tpl_vars['areaArray'][$this->_tpl_vars['key']]; ?>
</a>
				</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>

		<div class="pref_select_box_container">
		<?php $_from = $this->_tpl_vars['prtData']['areaPref']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
			<div class="pref_select_box" data-region="0<?php echo $this->_tpl_vars['key']; ?>
">
				<div class="pref_select_box_header">
					<span class="btn-back no-border">戻る</span>
					<strong class="pref_select_box_title white">
						<span class="pref_select_box_title_region"><?php echo $this->_tpl_vars['areaArray'][$this->_tpl_vars['key']]; ?>
</span>
						<span class="small">の</span>エリア<span class="small">から探す</span>
					</strong>
				</div>
				<ul class="pref_select_box_list">
					<?php $_from = $this->_tpl_vars['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['value2']):
?>
						<li class="pref_select_box_list_item"><a href="/index<?php echo $this->_tpl_vars['key']; ?>
-<?php echo $this->_tpl_vars['key2']; ?>
.html#real_wrap" class="no-border"><?php echo $this->_tpl_vars['value2']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
		<?php endforeach; endif; unset($_from); ?>
		</div>
	</nav>
</section>
</div>
<section class="contBg" id="popular">
	<h2><i class="fa-solid fa-circle-info fontawesome"></i>最新情報</h2>
	<ul class="contents contBtn clearfix">
		<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
			<li>
				<?php if ($this->_tpl_vars['row']['URL']): ?><a href="http://<?php echo $this->_tpl_vars['row']['URL']; ?>
" target="blank"><?php endif; ?>
					<?php if ($this->_tpl_vars['row']['filePath'] || $this->_tpl_vars['row']['file']): ?>
						<div class="img_box">
							<?php if ($this->_tpl_vars['row']['filePath']): ?><img src="<?php echo $this->_tpl_vars['row']['filePath']; ?>
&amp;mw=320&amp;mh=240" alt="<?php echo $this->_tpl_vars['row']['title']; ?>
" style="padding:3px;" /><br /><?php endif; ?>
							<?php if ($this->_tpl_vars['row']['file']): ?><img src="./inc/picR.php?imgId=<?php echo $this->_tpl_vars['row']['imgId']; ?>
&amp;t=whatsNew&amp;mw=320&amp;mh=240" alt="<?php echo $this->_tpl_vars['row']['title']; ?>
" style="padding:3px;" /><br /><?php endif; ?>
						</div>
					<?php endif; ?>
					<dl>
						<dt><?php echo $this->_tpl_vars['row']['title']; ?>
</dt>
						<dd>
							<span><?php if ($this->_tpl_vars['row']['shopName']): ?><?php echo $this->_tpl_vars['row']['shopName']; ?>
<?php endif; ?></span>
							【<?php echo ((is_array($_tmp=$this->_tpl_vars['row']['dateTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y/%m/%d %H:%M")); ?>
】<br />
							<?php echo ((is_array($_tmp=$this->_tpl_vars['row']['comment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br />
							<?php if ($this->_tpl_vars['row']['tel']): ?><br /><b><i class="fa fa-mobile" aria-hidden="true"></i> <a href="tel:<?php echo $this->_tpl_vars['row']['tel']; ?>
"><?php echo $this->_tpl_vars['row']['tel']; ?>
</a></b><br /><?php endif; ?>
						</dd>
					</dl>
				<?php if ($this->_tpl_vars['row']['URL']): ?></a><?php endif; ?>
			</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</section>

<section class="contBg" id="pickupBox">
	<h2 id="real_wrap">カフェ一覧</h2>
	<ul class="contents" id="pickupList">
		<?php $_from = $this->_tpl_vars['shop']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
		<li class="pickupItem">
				<h2>
					<a class="card_jobInfo_title" href="http://<?php echo $this->_tpl_vars['row']['URL']; ?>
" style="text-decoration:none;padding: 0;" target="_blank">
						<?php if ($this->_tpl_vars['row']['imgIdGal']): ?><img src="/userImg/image/<?php echo $this->_tpl_vars['row']['imgIdGal']; ?>
/w243-h183.jpg" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['row']['shopName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" width="125" height="100" style="margin:5px;" /><?php endif; ?>
						<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['shopName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

					</a>
				</h2>
				<div class="pickupItemBox">
					<?php $_from = $this->_tpl_vars['iconArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
						<span class="icon_s_<?php if ($this->_tpl_vars['row']['icon'][$this->_tpl_vars['key2']]['iconList']): ?>strong<?php else: ?>term<?php endif; ?>"><?php echo $this->_tpl_vars['value']; ?>
</span>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				<div class="pickupItemBox">
					<span class="pickupItem_linktext">エリア：<?php echo $this->_tpl_vars['row']['areaName']; ?>
 <?php echo $this->_tpl_vars['row']['prefectureName']; ?>
</span>
					<span class="pickupItem_lede">
						<a href="mailto:<?php echo $this->_tpl_vars['row']['mail']; ?>
?subject=『<?php echo @siteNamePrint; ?>
』から問い合わせ" class="btn-square-little-rich btn-mail">
							<i class="fa fa-envelope-o" aria-hidden="true"></i> メールを送る
						</a>
						<a href="/shop<?php echo $this->_tpl_vars['row']['areaId']; ?>
-<?php echo $this->_tpl_vars['row']['prefectureId']; ?>
-<?php echo $this->_tpl_vars['row']['shopId']; ?>
.html" class="btn-square-little-rich btn-detail">
							<i class="fa fa-file-text-o" aria-hidden="true"></i> 詳細を見る
						</a>
					</span>
				</div>
		</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</section>

<section class="contBg" id="usefulCont">
	<h2><i class="fa-solid fa-bell fontawesome"></i>注目企業ピックアップ</h2>
	<ul class="contents icon clearfix">
		<?php $_from = $this->_tpl_vars['banner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
			<?php if ($this->_tpl_vars['value']['imgId']): ?>
				<li>
					<a href="http://<?php echo $this->_tpl_vars['value']['URL']; ?>
" target="_blank" rel="noopener"><img src="/userImg/recommendBanner/<?php echo $this->_tpl_vars['value']['imgId']; ?>
/<?php echo $this->_tpl_vars['value']['imgId']; ?>
.jpg" alt="<?php echo $this->_tpl_vars['value']['name']; ?>
" loading="lazy"></a>
				</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</section>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footerPath, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>