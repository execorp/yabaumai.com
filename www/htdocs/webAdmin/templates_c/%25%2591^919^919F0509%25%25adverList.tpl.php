<?php /* Smarty version 2.6.25, created on 2022-06-28 18:21:26
         compiled from adverList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'adverList.tpl', 28, false),)), $this); ?>
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
</head>
<body id="adminBase">
<div id="outline">
<?php echo $this->_tpl_vars['menu']; ?>

    <div id="contents">
    <h3 id="pageTitle">管理システム｜<?php echo $this->_tpl_vars['title']; ?>
</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
<table class="t1">
            <tr>
            	<th>送信日時</th>
                <th>店舗名</th>
                <th>メールアドレス</th>
                <th>詳細</th>
                <th>削除</th>
                <th>確認</th>
            </tr>
<?php $_from = $this->_tpl_vars['prtData']['adver']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
            <tr>
                <td vAlign="middle" nowrap="nowrap"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['regDateTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y/%m/%d %H:%M:%S")); ?>
</td>
                <td vAlign="middle" nowrap="nowrap"><?php echo $this->_tpl_vars['value']['shopName']; ?>
</td>
                <td vAlign="middle" width="100%"><a href="mailto:<?php echo $this->_tpl_vars['value']['eMail']; ?>
"><?php echo $this->_tpl_vars['value']['eMail']; ?>
</a></td>
                <td nowrap="nowrap"><form action="./adverAddChange.php" method="post"><input type="submit" name="change" value="詳細"><input type="hidden" name="adverId" value="<?php echo $this->_tpl_vars['value']['adverId']; ?>
"></form></td>
                <td nowrap="nowrap"><form action="./adverList.php" method="post"><input type="checkbox" name="delChk" value="<?php echo $this->_tpl_vars['value']['adverId']; ?>
"><input type="submit" name="del" value="削除"><input type="hidden" name="adverId" value="<?php echo $this->_tpl_vars['value']['adverId']; ?>
"></form></td>
                <?php if ($this->_tpl_vars['value']['chk'] == 1): ?><td nowrap="nowrap" style="background-color:#b0ffff;" >確認済</td><?php else: ?><td nowrap="nowrap" width="10%" >未確認</td><?php endif; ?>
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