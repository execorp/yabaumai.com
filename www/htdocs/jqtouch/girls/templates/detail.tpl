<? xml version="1.0" encoding="Shift_JIS" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=shift_jis">
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-Type" content="text/javascript" />
<title>�b{$pageTitle} {$prtData.name}�b{$smarty.const.title}</title>
<meta name="keywords" content="{$smarty.const.keywords}" />
<meta name="description" content="{$smarty.const.description},���̎q�Љ�,{$prtData.name}" />
<meta name="Author" content="{$smarty.const.Author}" />
<meta name="owner" content="{$smarty.const.owner}" />
<meta name="classification" content="{$smarty.const.classification}" />
<meta name="copyright" content="http://www.{$smarty.const.domain}/" />
<meta name="robots" content="index,follow" />
<link href="../css/base.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/menu.css" rel="stylesheet" type="text/css" />
<link href="../css/{$pageFile}.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="../js/script.js"></script>
<script src="AC_RunActiveContent.js" language="javascript"></script>
</head>
<body{if $smarty.const.RIGHT_CLICK_BAN} oncontextmenu="return false"{/if}>
<div id="profile">
    
    <!-- ����  -->
    <div id="profileLeft">
        <p id="title">{$pageTitle}</p>
        <p id="icon">{$prtData.iconList}</p>
        <p id="marquee"><marquee behavior="scroll" direction="left" scrollamount="1" truespeed scrolldelay="15" loop="infinity">{$prtData.marquee}</marquee></p>
        <div id="data">
            {$prtData.name}<br />
            {$prtData.age}��/T.{$prtData.t}/B.{$prtData.b}�i{$prtData.c}�j/W.{$prtData.w}/H.{$prtData.h}/<br />
            <span>�����̌�/</span>{$prtData.firstContact}<br />
            <span>�����ӋZ/</span>{$prtData.play}<br />
            <span>����E���Z/</span>{$prtData.hobby}<br />
            <span>���D���ȃ^�C�v/</span>{$prtData.typeLike}<br />
            <span>���}�C�u�[��/</span>{$prtData.myBoom}<br />
            <span>�����̎q����̃��b�Z�[�W/</span><br />
            <p class="comment">{$prtData.galComment|nl2br}</p>
            <span>�����X����̃��b�Z�[�W/</span><br />
            <p class="comment">{$prtData.staffComment|nl2br}</p>
        </div>
        <p id="option">���\�I�v�V����/</p>
            <table class="option">
            {foreach from=$optionArray item=value name=result key=key}
                {if $key % 4 == 1}
                <tr>{/if}
                {if $prtData.option[$key]}
                <td width="25%" bgcolor="#ff0000">{$value}</td>
                {else}
                <td width="25%" bgcolor="#e4e4e4"><span>{$value}</span></td>
                {/if}
                {if $key % 4 == 0}
                <tr>{/if}
            {/foreach}
            </table>
    </div>
    <!-- /����  -->
    
    <!-- �E��  -->
    <div id="profileRight">
        <div id="thumbnailBox">
            {foreach from=$prtData.sumImg item=value name=result key=key}
                <p><a href="#" onMouseOver="image.src='../inc/pic.php?imgId={$value}'"><img src="../inc/picR.php?imgId={$value}&mw=50&mh=60" /></a></p>
            {/foreach}
        </div>
        <div id="image">{$prtData.mainImg}</div>
    </div>
    <!-- /�E��  -->
    
    <!-- �\��  -->
    <div id="reserve">
        <script language="javascript">
                AC_FL_RunContent(
                'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
                'width', '744',
                'height', '136',
                'src', 'adv',
                'quality', 'high',
                'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
                'align', 'middle',
                'play', 'true',
                'loop', 'true',
                'scale', 'showall',
                'wmode', 'window',
                'devicefont', 'false',
                'id', 'adv',
                'bgcolor', '#ffffff',
                'name', 'adv',
                'menu', 'true',
                'allowFullScreen', 'false',
                'allowScriptAccess','sameDomain',
                'movie', 'adv',
                'salign', '',
                'wmode', 'transparent',
                'FlashVars', 'calArray={$prtData.sch}<>{$prtData.reserve}<>29<>{$smarty.get.id}<>{$prtData.nameKana}<>{$smarty.const.JET_LAG}<>333333<>999999<>eeeeee<>cccccc<>eeeeee<>ffffff<>bbbbbb<>50'
                ); //end AC code
        </script>
    </div>
    <!-- /�\��  -->
    
    <!-- ����  -->
    <div id="close"><a href="javascript:window.close()"><img src="../img/close.gif" alt="����" /></a></div>
    <!-- /����  -->
    
</div>
</body>
</html>