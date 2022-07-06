<?php /* Smarty version 2.6.26, created on 2014-04-04 18:14:43
         compiled from home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'home.tpl', 23, false),array('modifier', 'nl2br', 'home.tpl', 25, false),array('modifier', 'default', 'home.tpl', 37, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @header_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div align="right"><font color="#cccccc">ver 1.00</font></div>
<?php if ($_SESSION['_authsession']['data']['userLevel'] == 0 && $_SESSION['_authsession']['data']['userLevel'] != NULL): ?>
    <form<?php echo $this->_tpl_vars['form']['attributes']; ?>
>
    <table>
    <tr><th><?php echo $this->_tpl_vars['form']['regDateTime']['label']; ?>
</th><td><?php echo $this->_tpl_vars['form']['regDateTime']['html']; ?>
 <?php echo $this->_tpl_vars['form']['iconList']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['message']['label']; ?>
</th><td><?php echo $this->_tpl_vars['form']['message']['html']; ?>
</td></tr>
    <tr><td class="submit" colspan="2">
    <?php echo $this->_tpl_vars['form']['hidden']; ?>

    <?php echo $this->_tpl_vars['form']['submitReg']['html']; ?>

    <?php echo $this->_tpl_vars['form']['submitChange']['html']; ?>

    </td></tr>
    </table>
    </form>
<?php endif; ?>
<div id="homeIcon"><img src="./img/pc.gif" alt="PCサイト" border="0" />PCサイト　|　<img src="./img/mobile.gif" alt="モバイルサイト" border="0" />モバイルサイト　|　<img src="./img/admin.gif" alt="管理システム" />管理システム</div>
<div id="homeBox">
    <div id="homeComment">
    <?php $_from = $this->_tpl_vars['prtData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
    <div class="homeCommentBox">
        <div class="dayText">
            <p class="day">
                <?php echo ((is_array($_tmp=$this->_tpl_vars['value']['regDateTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y.%m.%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y.%m.%d %H:%M")); ?>
　<?php $_from = $this->_tpl_vars['prtData'][$this->_tpl_vars['key']]['iconList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['resultIcon'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['resultIcon']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['keyIcon'] => $this->_tpl_vars['valueIcon']):
        $this->_foreach['resultIcon']['iteration']++;
?><img src="./img/<?php echo $this->_tpl_vars['adminIconArray'][$this->_tpl_vars['keyIcon']][1]; ?>
" alt="<?php echo $this->_tpl_vars['adminIconArray'][$this->_tpl_vars['keyIcon']][0]; ?>
" border="0" /><?php endforeach; endif; unset($_from); ?>
            </p>
            <p class="text"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['message'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>
        </div>
        <?php if ($_SESSION['_authsession']['data']['userLevel'] == 0 && $_SESSION['_authsession']['data']['userLevel'] != NULL): ?>
        <div class="formSubmit">
            <form action="./home.php" method="post">
            <input type="submit" name="submit" value="修正">
            <input type="hidden" name="adminInfoId" value="<?php echo $this->_tpl_vars['value']['adminInfoId']; ?>
">
            </form>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; endif; unset($_from); ?>
    <div id="homePager"><?php echo ((is_array($_tmp=@$this->_tpl_vars['pagerLinks']['back'])) ? $this->_run_mod_handler('default', true, $_tmp, "&lt;&lt;") : smarty_modifier_default($_tmp, "&lt;&lt;")); ?>
<?php echo ((is_array($_tmp=@$this->_tpl_vars['pagerLinks']['next'])) ? $this->_run_mod_handler('default', true, $_tmp, "&gt;&gt;") : smarty_modifier_default($_tmp, "&gt;&gt;")); ?>
</div>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footer_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>