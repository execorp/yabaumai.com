<?php /* Smarty version 2.6.25, created on 2022-06-28 18:16:01
         compiled from newList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'newList.tpl', 22, false),array('modifier', 'nl2br', 'newList.tpl', 22, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: <?php echo $this->_tpl_vars['domain']; ?>
 :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
<?php echo $this->_tpl_vars['form']['javascript']; ?>

</head>
<body id="adminBase">
<div id="outline">
<?php echo $this->_tpl_vars['menu']; ?>

    <div id="contents">
    <h3 id="pageTitle">管理システム｜<?php echo $this->_tpl_vars['prtTitle']; ?>
</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
        <table class="t1">
<?php $_from = $this->_tpl_vars['prtMySQLResult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
            <tr>
                <td nowrap="nowrap"><?php echo $this->_foreach['result']['iteration']; ?>
</td>
                <td vAlign="top" width="100%"><font color="blue"><b><?php echo $this->_tpl_vars['value']['title']; ?>
</b></font>　<font size="2" color="red">[<?php echo $this->_tpl_vars['value']['areaName']; ?>
]</font>　<font size="1" color="gray"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['dateTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y/%m/%d %H:%M")); ?>
</font><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['comment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
                <td vAlign="top" nowrap="nowrap"><?php if ($this->_tpl_vars['value']['file']): ?><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['value']['imgId']; ?>
&t=whatsNew&mh=80"><?php endif; ?></td>
                <td width="40"><form action="./newAddChange.php" method="post"><input type="submit" name="change" value="修正"><input type="hidden" name="imgId" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
"></form></td>
                <td width="40"><form action="./newList.php" method="post"><input type="checkbox" name="delChk" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
"><input type="submit" name="del" value="削除"><input type="hidden" name="imgId" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
"></form></td>
            </tr>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['pagerLinks']['all']): ?>
            <tr>
                <td align="center" colSpan="6"><?php echo $this->_tpl_vars['pagerLinks']['all']; ?>
</td>
            </tr>
<?php endif; ?>
        </table>
    </div>
    </div>
</div>
</body>
</html>