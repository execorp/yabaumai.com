<?php /* Smarty version 2.6.25, created on 2010-03-10 14:02:08
         compiled from dispMail.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=shift_jis" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: <?php echo $this->_tpl_vars['domain']; ?>
 :::</title>
<link href="../../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
<?php echo '
<SCRIPT LANGUAGE="JavaScript">
</SCRIPT>
'; ?>


</head>
<body id="adminBase">
<div style="border: 1px">
<table width="240">
<tr>
<td <?php if ($this->_tpl_vars['bgColor'] != ""): ?>style="background:<?php echo $this->_tpl_vars['bgColor']; ?>
"<?php endif; ?>>
<?php echo $this->_tpl_vars['disp_mail']; ?>

</td>
</tr>
<tr>
<td>
<center>
<input type=button name=back value="　閉　じ　る　" onclick="window.close(this)">
</center>
</td>
</tr>
</table>
</div>
</body>
</html>