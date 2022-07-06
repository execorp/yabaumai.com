<?php /* Smarty version 2.6.25, created on 2014-04-04 18:16:39
         compiled from newList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'newList.tpl', 16, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @header_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div align="right"><font color="#cccccc">ver <?php echo $this->_tpl_vars['version']; ?>
</font></div>
<table class="t1">
    <tr>
        <th style="text-align:center;" nowrap="nowrap">No</th>
        <th style="text-align:center;" nowrap="nowrap">画像</th>
        <th style="text-align:center;" nowrap="nowrap">投稿日時</th>
        <th style="text-align:center;" nowrap="nowrap">タイトル</th>
        <th style="text-align:center;" nowrap="nowrap">修正</th>
        <th style="text-align:center;" nowrap="nowrap">削除</th>
    </tr>
<?php $_from = $this->_tpl_vars['prtMySQLResult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
    <tr>
        <td nowrap="nowrap"><?php echo $this->_foreach['result']['iteration']; ?>
</td>
        <td nowrap="nowrap" align="center"><?php if ($this->_tpl_vars['value']['file']): ?><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['value']['imgId']; ?>
&t=whatsNew&mh=80"><?php endif; ?></td>
        <td nowrap="nowrap" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['dateTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y/%m/%d %H:%M")); ?>
</td>
        <td width="100%" align="center"><?php echo $this->_tpl_vars['value']['title']; ?>
[<?php echo $this->_tpl_vars['value']['areaName']; ?>
]</td>
        <td nowrap="nowrap">
            <form action="./newAddChange.php" method="post">
            <input type="submit" name="change" value="修正">
            <input type="hidden" name="imgId" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
">
            </form>
        </td>
        <td nowrap="nowrap">
            <form action="./newList.php" method="post">
            <input type="checkbox" name="delChk" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
">
            <input type="submit" name="del" value="削除">
            <input type="hidden" name="imgId" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
">
            </form>
        </td>
    </tr>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['pagerLinks']['all']): ?>
    <tr>
        <td align="center" colSpan="6"><?php echo $this->_tpl_vars['pagerLinks']['all']; ?>
</td>
    </tr>
<?php endif; ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footer_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>