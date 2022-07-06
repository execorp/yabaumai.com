{include file=$smarty.const.header_admin}

<table>
<form{$form.attributes}>
    <tr>
        <th>{$form.dateTime.label}</th>
        <td class="left">{$form.dateTime.html}<span class="cap">※半角英数字の書式[{$form.dateTime.value}]で入力してください。</span></td>
    </tr>
    <tr>
        <th>{$form.title.label}</th>
        <td class="left">{$form.title.html} <span class="cap">※30文字以内</span></td>
    </tr>
    <tr>
        <th>{$form.areaShop.label}</th>
        <td class="left">{$form.areaShop.html}</td>
    </tr>
    <tr>
        <th>{$form.userfile.label}</th>
        <td class="left">{$form.userfile.html}{if $file}<img src="../inc/picR.php?imgId={$imgId}&t=whatsNew&mw=80">{/if}</td>
    </tr>
    <tr>
        <th>{$form.comment.label}</th>
        <td class="left"><span class="cap">※600文字以内</span><br /> {$form.comment.html}</td>
    </tr>
</table>

<table>
    <tr>
        <td colspan="2" height="20" align="center" valign="middle" colspan="8" class="submit">{$form.submit.html}</td>
    </tr>
</table>
{$form.hidden}
</form>
{include file=$smarty.const.footer_admin}
