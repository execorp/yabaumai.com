{include file=$smarty.const.header_admin}
<div align="right"><font color="#cccccc">ver 1.00</font></div>
{if $smarty.session._authsession.data.userLevel == 0 AND $smarty.session._authsession.data.userLevel != NULL}
    <form{$form.attributes}>
    <table>
    <tr><th>{$form.regDateTime.label}</th><td>{$form.regDateTime.html} {$form.iconList.html}</td></tr>
    <tr><th>{$form.message.label}</th><td>{$form.message.html}</td></tr>
    <tr><td class="submit" colspan="2">
    {$form.hidden}
    {$form.submitReg.html}
    {$form.submitChange.html}
    </td></tr>
    </table>
    </form>
{/if}
<div id="homeIcon"><img src="./img/pc.gif" alt="PCサイト" border="0" />PCサイト　|　<img src="./img/mobile.gif" alt="モバイルサイト" border="0" />モバイルサイト　|　<img src="./img/admin.gif" alt="管理システム" />管理システム</div>
<div id="homeBox">
    <div id="homeComment">
    {foreach from=$prtData item=value name=result key=key}
    <div class="homeCommentBox">
        <div class="dayText">
            <p class="day">
                {$value.regDateTime|date_format:"%Y.%m.%d %H:%M"}　{foreach from=$prtData.$key.iconList item=valueIcon name=resultIcon key=keyIcon}<img src="./img/{$adminIconArray[$keyIcon][1]}" alt="{$adminIconArray[$keyIcon][0]}" border="0" />{/foreach}
            </p>
            <p class="text">{$value.message|nl2br}</p>
        </div>
        {if $smarty.session._authsession.data.userLevel == 0 AND $smarty.session._authsession.data.userLevel != NULL}
        <div class="formSubmit">
            <form action="./home.php" method="post">
            <input type="submit" name="submit" value="修正">
            <input type="hidden" name="adminInfoId" value="{$value.adminInfoId}">
            </form>
        </div>
        {/if}
    </div>
    {/foreach}
    <div id="homePager">{$pagerLinks.back|default:"&lt;&lt;"}{$pagerLinks.next|default:"&gt;&gt;"}</div>
    </div>
</div>
{include file=$smarty.const.footer_admin}