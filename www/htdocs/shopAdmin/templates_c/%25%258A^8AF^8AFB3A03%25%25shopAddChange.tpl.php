<?php /* Smarty version 2.6.25, created on 2017-09-15 09:37:52
         compiled from shopAddChange.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @header_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['errorStr']): ?><div class="massage"><?php echo $this->_tpl_vars['errorStr']; ?>
</div><?php endif; ?>
<table>
<form<?php echo $this->_tpl_vars['form']['attributes']; ?>
>
<?php if ($this->_supers['get']['q'] == 1): ?>
    <tr><th colspan="2" class="title"><font color="#ff0000">修正いたしました</font></th></tr>
<?php endif; ?>
    <tr><th><?php echo $this->_tpl_vars['form']['mail']['label']; ?>
</th><td class="left"><?php echo $this->_tpl_vars['form']['mail']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['jobCategory']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['jobCategory']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['jobBack']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['jobBack']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['workComment']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['workComment']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['license']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['license']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['activityaction']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['activityaction']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['employ']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['employ']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['place']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['place']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['traffic']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['traffic']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['workTime']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['workTime']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['salary']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['salary']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['treatment']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['treatment']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['holiday']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['holiday']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['educatetrain']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['educatetrain']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['establish']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['establish']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['represent']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['represent']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['companyMoney']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['companyMoney']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['employee']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['employee']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['business']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['business']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['officePlace']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['officePlace']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['selection']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['selection']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['application']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['application']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['interviewPlace']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['interviewPlace']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['contactAddress']['label']; ?>
 </th><td class="left"><?php echo $this->_tpl_vars['form']['contactAddress']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['shopComment']['label']; ?>
</th><td class="left"><?php echo $this->_tpl_vars['form']['shopComment']['html']; ?>
</td></tr>
    <tr><th><?php echo $this->_tpl_vars['form']['loginPass']['label']; ?>
</th><td class="left"><?php echo $this->_tpl_vars['form']['loginPass']['html']; ?>
<span class="cap">※必<?php echo '須'; ?>
</span></td></tr>
    <tr>
        <th>アイコン</th>
        <td class="left">
<?php $_from = $this->_tpl_vars['form']['iconList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
<?php echo $this->_tpl_vars['row']['html']; ?>

<?php endforeach; endif; unset($_from); ?>
        </td>
    </tr>
    <!-- tr>
        <th><?php echo $this->_tpl_vars['form']['comment']['label']; ?>
</th>
        <td class="left"><?php echo $this->_tpl_vars['form']['comment']['html']; ?>
</td>
    </tr -->
    <tr>
        <th><?php echo $this->_tpl_vars['form']['userfile0']['label']; ?>
</th>
        <td class="left"><?php echo $this->_tpl_vars['form']['userfile0']['html']; ?>
<span class="cap">(横150 x 縦40)</span><?php if ($this->_tpl_vars['imgId0']): ?><br /><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['imgId0']; ?>
&t=image&rs=1" /><?php endif; ?></td>
    </tr>
    <tr>
        <th><?php echo $this->_tpl_vars['form']['userfile1']['label']; ?>
</th>
        <td class="left"><?php echo $this->_tpl_vars['form']['userfile1']['html']; ?>
<span class="cap">(横270 x 縦200)</span><?php if ($this->_tpl_vars['imgId1']): ?><br /><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['imgId1']; ?>
&t=image&rs=1" /><?php endif; ?></td>
    </tr>
</table>

<table>
    <tr>
        <td colspan="2" height="20" align="center" valign="middle" colspan="8" class="submit"><?php echo $this->_tpl_vars['form']['submitReg']['html']; ?>
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