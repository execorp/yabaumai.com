<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=shift_jis" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$smarty.const.domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
{literal}
<script type="text/javascript">
	window.onload = function()
	{
		var oFCKeditor = new FCKeditor( 'comment' ) ;
		oFCKeditor.ReplaceTextarea() ;
	}
</script>
{/literal}
{$form.javascript}
</head>
<body id="adminBase">
<div id="outline">
{$menu}

    <div id="contents">
    <h3 id="pageTitle">�Ǘ��V�X�e��&nbsp;&gt;&nbsp;<a href="./">�g�b�v</a>&nbsp;&gt;&nbsp;���݃����N</h3>
    <div class="topUrl"><a href="../" target="_blank">�z�[���y�[�W</a>�b<a href="./">�Ǘ����TOP</a></div>

    <div class="massage">
    �e���ڂ���͌�A��ʉ��́u�o�^�v���N���b�N���Ă��������B<br/>
    ���摜�T�C�Y�F�� 468 px / ���� 60 px
    </div>

<form {$form.attributes}>
<table class="t1">
<form{$form.attributes}>
    <tr><th class="addGal">{$form.name.label} <span class="cap">���K{literal}�{{/literal}</span></th><td>{$form.name.html}</td></tr>
    <tr><th class="addGal">{$form.alt.label}</th><td>{$form.alt.html}</td></tr>
    <tr><th class="addGal">{$form.url.label} <span class="cap">���K{literal}�{{/literal}</span></th><td>http://{$form.url.html}</td></tr>
    <tr><th class="addGal">{$form.userfile.label}</th><td>{if $file}<img src="../inc/picR.php?imgId={$imgId}&t={$tableName}&mw=468" border="0"><br />{/if}{$form.userfile.html}&nbsp;<span class="cap">�i *�ő� ��468�~�c60 �j</span></td></tr>
</table>
{$form.submit.html}
{$form.hidden}
</form>

</body>
</html>

