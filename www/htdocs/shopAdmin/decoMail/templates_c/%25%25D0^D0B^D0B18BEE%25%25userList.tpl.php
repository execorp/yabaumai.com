<?php /* Smarty version 2.6.25, created on 2010-04-09 14:05:06
         compiled from userList.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @header_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="contents">
<table>
<form action="<?php echo $this->_tpl_vars['url_self']; ?>
" method="post" name="search">
    <tr>
      <th rowspan="2" width="80">検索</td>
      <td align="">メールアドレス</td>
      <td rowspan="2" width="80"><input name="search" value="検索" type="submit" /></td>
    </tr>
    <tr>
      <td><input name="mailAddress" type="text" size="60" value="<?php echo $this->_tpl_vars['search']['mailAddress']; ?>
" /></td>
    </tr>
</form>
</table>
</div>
<div>
<table>
<form action="<?php echo $this->_tpl_vars['url_self']; ?>
" method="post" name="send">
    <tr>
      <th rowspan="2" width="80">登録</td>
      <td>メールアドレス</td>
      <td>テストメール</td>
      <td rowspan="2" width="80"><input name="add" value="登録" type="submit"></td>
    </tr>
    <tr>
      <td><input name="mailAddress" type="text" size="60" /></td>
      <td><input name="testFlg" type="checkbox" value="1" /></td>
    </tr>
</form>
</table>
</div>
<table>


<td colspan="6">
<?php echo $this->_tpl_vars['pageHtml']; ?>

</td>
<?php $_from = $this->_tpl_vars['memberList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mailList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mailList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['value']):
        $this->_foreach['mailList']['iteration']++;
?>
    <tr bgColor="<?php if ($this->_tpl_vars['value']['errorMailFlg']): ?><?php echo $this->_tpl_vars['errorMailColor']; ?>
<?php else: ?><?php echo $this->_tpl_vars['mailStateAray'][$this->_tpl_vars['value']['stateFlg']][1]; ?>
<?php endif; ?>">
      <td><?php echo $this->_foreach['mailList']['iteration']; ?>
</td>
      <td style="text-align:left;"><?php echo $this->_tpl_vars['value']['mailAddress']; ?>
</td>
      <td style="text-align:center;"><?php if ($this->_tpl_vars['value']['stateFlg'] == 0): ?><font color="#FF0000">仮登録</font><?php else: ?><?php echo '本'; ?>
登録<?php endif; ?></td>
      <td width="100">
<?php if ($this->_tpl_vars['value']['errorMailFlg'] >= 1): ?>
            <form action="<?php echo $this->_tpl_vars['url_self']; ?>
" method="post" name="decrement">
                <?php echo $this->_tpl_vars['value']['errorMailFlg']; ?>
件 不達
                <input type="submit" name="decrementSubmit" value="-1">
                <input type="hidden" name="decMemberId" value="<?php echo $this->_tpl_vars['id']; ?>
">
            </form>
<?php else: ?>
                
<?php endif; ?>
      </td>
<?php if ($this->_tpl_vars['value']['testFlg'] != 0): ?>
      <td width="120"><form action="<?php echo $this->_tpl_vars['url_self']; ?>
" method="post" name="testDelMail"><input type="checkbox" name="testDelChk" value="<?php echo $this->_tpl_vars['id']; ?>
"><input type="submit" name="testDelSubmit" value="テストメール解除"><input type="hidden" name="memberId" value="<?php echo $this->_tpl_vars['id']; ?>
"></form></td>
<?php else: ?>
      <td width="120"><form action="<?php echo $this->_tpl_vars['url_self']; ?>
" method="post" name="testMail"><input type="checkbox" name="testChk" value="<?php echo $this->_tpl_vars['id']; ?>
"><input type="submit" name="testSubmit" value="テストメール"><input type="hidden" name="memberId" value="<?php echo $this->_tpl_vars['id']; ?>
"></form></td>
<?php endif; ?>
      <td width="60"><form action="<?php echo $this->_tpl_vars['url_self']; ?>
" method="post" name="delMail"><input type="checkbox" name="delChk" value="<?php echo $this->_tpl_vars['id']; ?>
"><input type="submit" name="delSubmit" value="削除"><input type="hidden" name="memberId" value="<?php echo $this->_tpl_vars['id']; ?>
"></form></td>
    </tr>
<?php endforeach; endif; unset($_from); ?>
<td colspan=6>
<?php echo $this->_tpl_vars['pageHtml']; ?>

</td>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footer_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>