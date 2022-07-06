{include file=$smarty.const.header_admin}
<div align="right"><font color="#cccccc">ver 1.00</font></div>
    <form{$form.attributes}>
    <table>
    <tr><th>{$form.regDateTime.label}</th><td>{$form.regDateTime.html} {$form.iconList.html}</td></tr>
    <tr><th>{$form.title.label}</th><td>{$form.title.html}</td></tr>
    <tr><th>{$form.message.label}</th><td>{$form.message.html}</td></tr>
{if $smarty.session._authsession.data.userLevel == 0 AND $smarty.session._authsession.data.userLevel != NULL}
    <tr><th>{$form.money.label}</th><td>{$form.money.html}{$form.moneyFlg.html}</td></tr>
{/if}
    <tr><th>{$form.progressFlg.label}</th><td>{$form.progressFlg.html}</td></tr>
    <tr><td class="submit" colspan="2">
    {$form.hidden}
    {$form.submitReg.html}
    {$form.submitChange.html}
    </td></tr>
    </table>
</form>
<div id="homeIcon"><img src="./img/pc.gif" alt="PCサイト" border="0" />PCサイト　|　<img src="./img/mobile.gif" alt="モバイルサイト" border="0" />モバイルサイト　|　<img src="./img/admin.gif" alt="管理システム" />管理システム</div>
<form action="./request.php" method="get">
<div id="homeIcon">{$form.progress.html}{$form.submit.html}</div>
</form>
<div id="homeBox">
    <div id="homeComment">
    {foreach from=$prtData item=value name=result key=key}
    <div class="homeCommentBox">
        <div class="dayText">
            <p class="day">
                {if $value.moneyFlg == 1}<img src="./img/money.gif" border="0" />{/if}[{$progressArray[$value.progressFlg]}] {$value.regDateTime|date_format:"%Y.%m.%d %H:%M"}　{foreach from=$prtData.$key.iconList item=valueIcon name=resultIcon key=keyIcon}<img src="./img/{$adminIconArray[$keyIcon][1]}" alt="{$adminIconArray[$keyIcon][0]}" border="0" />{/foreach}
            </p>
            <p class="text">{$value.title}</p>
            <p class="text">{$value.message|nl2br}</p>
        </div>
        <div class="formSubmit">
            <form action="./request.php" method="post">
            <input type="submit" name="submit" value="修正">
            <input type="hidden" name="requestId" value="{$value.requestId}">
            </form>
        </div>
    </div>
    {/foreach}
    <div id="homePager">{$pagerLinks.back|default:"&lt;&lt;"}{$pagerLinks.next|default:"&gt;&gt;"}</div>
    </div>
</div>
{include file=$smarty.const.footer_admin}