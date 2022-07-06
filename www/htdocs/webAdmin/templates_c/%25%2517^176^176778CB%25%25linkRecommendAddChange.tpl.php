<?php /* Smarty version 2.6.25, created on 2022-06-28 18:22:19
         compiled from linkRecommendAddChange.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: <?php echo @domain; ?>
 :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<?php echo '
<script type="text/javascript">
	window.onload = function()
	{
		var oFCKeditor = new FCKeditor( \'comment\' ) ;
		oFCKeditor.ReplaceTextarea() ;
	}
</script>
'; ?>

<?php echo $this->_tpl_vars['form']['javascript']; ?>

</head>
<body id="adminBase">
<div id="outline">
<?php echo $this->_tpl_vars['menu']; ?>


    <div id="contents">
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;相互リンク</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>

    <div class="massage">
    各項目を入力後、画面下の「登録」をクリックしてください。<br/>
    ※画像サイズ：幅 <?php echo $this->_tpl_vars['imgMaxWidth']; ?>
 px / 高さ <?php echo $this->_tpl_vars['imgMaxHeight']; ?>
 px
    </div>

<form <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
<table class="t1">
<form<?php echo $this->_tpl_vars['form']['attributes']; ?>
>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['name']['label']; ?>
 <span class="cap">※必<?php echo '須'; ?>
</span></th><td><?php echo $this->_tpl_vars['form']['name']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['url']['label']; ?>
 <span class="cap">※必<?php echo '須'; ?>
</span></th><td>http://<?php echo $this->_tpl_vars['form']['url']['html']; ?>
</td></tr>
    <!-- tr><th class="addGal"><?php echo $this->_tpl_vars['form']['areaId']['label']; ?>
 <span class="cap">※必<?php echo '須'; ?>
</span></th><td><?php echo $this->_tpl_vars['form']['areaId']['html']; ?>
</td></tr -->
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['userfile']['label']; ?>
</th><td><?php echo $this->_tpl_vars['form']['userfile']['html']; ?>
&nbsp;<span class="cap">（ *最大 横<?php echo $this->_tpl_vars['imgMaxWidth']; ?>
×縦<?php echo $this->_tpl_vars['imgMaxHeight']; ?>
 ）</span><?php if ($this->_tpl_vars['file']): ?><a href="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['imgId']; ?>
&t=<?php echo $this->_tpl_vars['tableName']; ?>
" target="_blank"><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['imgId']; ?>
&t=<?php echo $this->_tpl_vars['tableName']; ?>
" border="0"><?php endif; ?></td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['priority']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['priority']['html']; ?>
位</td></tr>
</table>
<?php echo $this->_tpl_vars['form']['submit']['html']; ?>

<?php echo $this->_tpl_vars['form']['hidden']; ?>

</form>

</body>
</html>
