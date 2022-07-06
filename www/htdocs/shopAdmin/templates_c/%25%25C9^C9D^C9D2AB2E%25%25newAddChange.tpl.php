<?php /* Smarty version 2.6.25, created on 2014-04-04 18:16:43
         compiled from newAddChange.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @header_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table>
<form<?php echo $this->_tpl_vars['form']['attributes']; ?>
>
    <tr>
        <th><?php echo $this->_tpl_vars['form']['dateTime']['label']; ?>
</th>
        <td class="left"><?php echo $this->_tpl_vars['form']['dateTime']['html']; ?>
<span class="cap">※半角英数字の書式[<?php echo $this->_tpl_vars['form']['dateTime']['value']; ?>
]で入力してください。</span></td>
    </tr>
    <tr>
        <th><?php echo $this->_tpl_vars['form']['title']['label']; ?>
</th>
        <td class="left"><?php echo $this->_tpl_vars['form']['title']['html']; ?>
 <span class="cap">※30文字以内</span></td>
    </tr>
    <tr>
        <th><?php echo $this->_tpl_vars['form']['areaShop']['label']; ?>
</th>
        <td class="left"><?php echo $this->_tpl_vars['form']['areaShop']['html']; ?>
</td>
    </tr>
    <tr>
        <th><?php echo $this->_tpl_vars['form']['userfile']['label']; ?>
</th>
        <td class="left"><?php echo $this->_tpl_vars['form']['userfile']['html']; ?>
<?php if ($this->_tpl_vars['file']): ?><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['imgId']; ?>
&t=whatsNew&mw=80"><?php endif; ?></td>
    </tr>
    <tr>
        <th><?php echo $this->_tpl_vars['form']['comment']['label']; ?>
</th>
        <td class="left"><span class="cap">※600文字以内</span><br /> <?php echo $this->_tpl_vars['form']['comment']['html']; ?>
</td>
    </tr>
</table>

<table>
    <tr>
        <td colspan="2" height="20" align="center" valign="middle" colspan="8" class="submit"><?php echo $this->_tpl_vars['form']['submit']['html']; ?>
</td>
    </tr>
</table>
<?php echo $this->_tpl_vars['form']['hidden']; ?>

</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footer_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>