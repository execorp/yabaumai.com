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
    <h3 id="pageTitle">�Ǘ��V�X�e���b{$contName}</h3>
    <div class="topUrl"><a href="../" target="_blank">�z�[���y�[�W</a>�b<a href="./">�Ǘ����TOP</a></div>

<div class="massage">
{$contName}��{$funcName}���܂��B�摜�t�@�C����I����A��ʉ��́u�o�^�v���N���b�N���Ă��������B <br />
���摜�T�C�Y�́y��510px �c370px�z�ŕ\������܂��B<br />
���o�^����Ă���摜�̒����烉���_����ENTER�y�[�W�ɕ\������܂��B<br />
</div>

{if $now!=change}
{if $form.errors}<div class="massage">
{foreach from=$form.errors item=error}{$error}<br/>{/foreach}
</div>{/if}
{/if}

{if $NameMessage}
<div class="massage" style="border-color:#ff0000;">
{$NameMessage}
</div>
{/if}

<table class="t1">
<form{$form.attributes}>
    <tr><th>{$form.galName.label} </th><td>{$form.galName.html}</td></tr>
    <tr><th>{$form.areaShop.label} </th><td>{$form.areaShop.html}</td></tr>
    <tr><th>{$form.userfile.label} </th><td>{$form.userfile.html}{if $file}<br /><a href="../inc/thumb.php?imgId={$imgId}&t=coverImage&mh=140&mw=190" target="_blank"><img src="../inc/thumb.php?imgId={$imgId}&t=coverImage&mh=70&mw=95" border="0" /></a>{/if}</td></tr>
    <tr><th>{$form.prtFlg.label} </th><td>{$form.prtFlg.html}</td></tr>
</table>
    <div class="submit">
    {$form.submit.html}
    </div>
    </div>
</div>
{$form.hidden}
</form>
</body>
</html>