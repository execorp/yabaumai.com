{include file=$smarty.const.header_admin}
<div id="contents">
<table>
<form action="{$url_self}" method="post" name="search">
    <tr>
      <th rowspan="2" width="80">検索</td>
      <td align="">メールアドレス</td>
      <td rowspan="2" width="80"><input name="search" value="検索" type="submit" /></td>
    </tr>
    <tr>
      <td><input name="mailAddress" type="text" size="60" value="{$search.mailAddress}" /></td>
    </tr>
</form>
</table>
</div>
<div>
<table>
<form action="{$url_self}" method="post" name="send">
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
{$pageHtml}
</td>
{foreach from=$memberList key=id item=value name=mailList}
    <tr bgColor="{if $value.errorMailFlg}{$errorMailColor}{else}{$mailStateAray[$value.stateFlg][1]}{/if}">
      <td>{$smarty.foreach.mailList.iteration}</td>
      <td style="text-align:left;">{$value.mailAddress}</td>
      <td style="text-align:center;">{if $value.stateFlg == 0}<font color="#FF0000">仮登録</font>{else}{literal}本{/literal}登録{/if}</td>
      <td width="100">
{if $value.errorMailFlg >= 1}
            <form action="{$url_self}" method="post" name="decrement">
                {$value.errorMailFlg}件 不達
                <input type="submit" name="decrementSubmit" value="-1">
                <input type="hidden" name="decMemberId" value="{$id}">
            </form>
{else}
                
{/if}
      </td>
{if $value.testFlg != 0}
      <td width="120"><form action="{$url_self}" method="post" name="testDelMail"><input type="checkbox" name="testDelChk" value="{$id}"><input type="submit" name="testDelSubmit" value="テストメール解除"><input type="hidden" name="memberId" value="{$id}"></form></td>
{else}
      <td width="120"><form action="{$url_self}" method="post" name="testMail"><input type="checkbox" name="testChk" value="{$id}"><input type="submit" name="testSubmit" value="テストメール"><input type="hidden" name="memberId" value="{$id}"></form></td>
{/if}
      <td width="60"><form action="{$url_self}" method="post" name="delMail"><input type="checkbox" name="delChk" value="{$id}"><input type="submit" name="delSubmit" value="削除"><input type="hidden" name="memberId" value="{$id}"></form></td>
    </tr>
{/foreach}
<td colspan=6>
{$pageHtml}
</td>
</table>
</div>
{include file=$smarty.const.footer_admin}
