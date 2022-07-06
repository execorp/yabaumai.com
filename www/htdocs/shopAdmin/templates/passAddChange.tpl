{include file=$smarty.const.header_admin}

<div align="right"><font color="#cccccc">ver {$version}</font></div>
<form{$form.attributes}>

<table class="t1" style="width:600px;margin-left:30px;">
  <tr>
    <th>ID</th>
    <th>パスワード</th>
    <th>権限選択</th>
    <th>使用する</th>
  </tr>

{foreach from=$form.loginId item=value name=mailList key=key}
  <tr>
    <td>{$value.html}</td>
    <td>{$form.passWord.$key.html}</td>
    <td>{$form.userLevel.$key.html}</td>
    <td>{$form.useFlg.$key.html}</td>
  </tr>
{/foreach}

  <tr>
    <td colspan="4">{$form.submitReg.html}</td>
  </tr>
</table>


{include file=$smarty.const.footer_admin}