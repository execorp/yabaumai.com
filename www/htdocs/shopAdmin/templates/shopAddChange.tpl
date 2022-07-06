{include file=$smarty.const.header_admin}

{if $errorStr}<div class="massage">{$errorStr}</div>{/if}
<table>
<form{$form.attributes}>
{if $smarty.get.q == 1}
    <tr><th colspan="2" class="title"><font color="#ff0000">修正いたしました</font></th></tr>
{/if}
    <tr><th>{$form.mail.label}</th><td class="left">{$form.mail.html}</td></tr>
    <tr><th>{$form.jobCategory.label} </th><td class="left">{$form.jobCategory.html}</td></tr>
    <tr><th>{$form.jobBack.label} </th><td class="left">{$form.jobBack.html}</td></tr>
    <tr><th>{$form.workComment.label} </th><td class="left">{$form.workComment.html}</td></tr>
    <tr><th>{$form.license.label} </th><td class="left">{$form.license.html}</td></tr>
    <tr><th>{$form.activityaction.label} </th><td class="left">{$form.activityaction.html}</td></tr>
    <tr><th>{$form.employ.label} </th><td class="left">{$form.employ.html}</td></tr>
    <tr><th>{$form.place.label} </th><td class="left">{$form.place.html}</td></tr>
    <tr><th>{$form.traffic.label} </th><td class="left">{$form.traffic.html}</td></tr>
    <tr><th>{$form.workTime.label} </th><td class="left">{$form.workTime.html}</td></tr>
    <tr><th>{$form.salary.label} </th><td class="left">{$form.salary.html}</td></tr>
    <tr><th>{$form.treatment.label} </th><td class="left">{$form.treatment.html}</td></tr>
    <tr><th>{$form.holiday.label} </th><td class="left">{$form.holiday.html}</td></tr>
    <tr><th>{$form.educatetrain.label} </th><td class="left">{$form.educatetrain.html}</td></tr>
    <tr><th>{$form.establish.label} </th><td class="left">{$form.establish.html}</td></tr>
    <tr><th>{$form.represent.label} </th><td class="left">{$form.represent.html}</td></tr>
    <tr><th>{$form.companyMoney.label} </th><td class="left">{$form.companyMoney.html}</td></tr>
    <tr><th>{$form.employee.label} </th><td class="left">{$form.employee.html}</td></tr>
    <tr><th>{$form.business.label} </th><td class="left">{$form.business.html}</td></tr>
    <tr><th>{$form.officePlace.label} </th><td class="left">{$form.officePlace.html}</td></tr>
    <tr><th>{$form.selection.label} </th><td class="left">{$form.selection.html}</td></tr>
    <tr><th>{$form.application.label} </th><td class="left">{$form.application.html}</td></tr>
    <tr><th>{$form.interviewPlace.label} </th><td class="left">{$form.interviewPlace.html}</td></tr>
    <tr><th>{$form.contactAddress.label} </th><td class="left">{$form.contactAddress.html}</td></tr>
    <tr><th>{$form.shopComment.label}</th><td class="left">{$form.shopComment.html}</td></tr>
    <tr><th>{$form.loginPass.label}</th><td class="left">{$form.loginPass.html}<span class="cap">※必{literal}須{/literal}</span></td></tr>
    <tr>
        <th>アイコン</th>
        <td class="left">
{foreach from=$form.iconList key=key item=row}
{$row.html}
{/foreach}
        </td>
    </tr>
    <!-- tr>
        <th>{$form.comment.label}</th>
        <td class="left">{$form.comment.html}</td>
    </tr -->
    <tr>
        <th>{$form.userfile0.label}</th>
        <td class="left">{$form.userfile0.html}<span class="cap">(横150 x 縦40)</span>{if $imgId0}<br /><img src="../inc/picR.php?imgId={$imgId0}&t=image&rs=1" />{/if}</td>
    </tr>
    <tr>
        <th>{$form.userfile1.label}</th>
        <td class="left">{$form.userfile1.html}<span class="cap">(横270 x 縦200)</span>{if $imgId1}<br /><img src="../inc/picR.php?imgId={$imgId1}&t=image&rs=1" />{/if}</td>
    </tr>
</table>

<table>
    <tr>
        <td colspan="2" height="20" align="center" valign="middle" colspan="8" class="submit">{$form.submitReg.html}</td>
    </tr>
</table>
{$form.hidden}
</form>
{include file=$smarty.const.footer_admin}
