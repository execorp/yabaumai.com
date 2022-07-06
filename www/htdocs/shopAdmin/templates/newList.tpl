{include file=$smarty.const.header_admin}
<div align="right"><font color="#cccccc">ver {$version}</font></div>
<table class="t1">
    <tr>
        <th style="text-align:center;" nowrap="nowrap">No</th>
        <th style="text-align:center;" nowrap="nowrap">画像</th>
        <th style="text-align:center;" nowrap="nowrap">投稿日時</th>
        <th style="text-align:center;" nowrap="nowrap">タイトル</th>
        <th style="text-align:center;" nowrap="nowrap">修正</th>
        <th style="text-align:center;" nowrap="nowrap">削除</th>
    </tr>
{foreach from=$prtMySQLResult item=value name=result}
    <tr>
        <td nowrap="nowrap">{$smarty.foreach.result.iteration}</td>
        <td nowrap="nowrap" align="center">{if $value.file}<img src="../inc/picR.php?imgId={$value.imgId}&t=whatsNew&mh=80">{/if}</td>
        <td nowrap="nowrap" align="center">{$value.dateTime|date_format:"%Y/%m/%d %H:%M"}</td>
        <td width="100%" align="center">{$value.title}[{$value.areaName}]</td>
        <td nowrap="nowrap">
            <form action="./newAddChange.php" method="post">
            <input type="submit" name="change" value="修正">
            <input type="hidden" name="imgId" value="{$value.imgId}">
            </form>
        </td>
        <td nowrap="nowrap">
            <form action="./newList.php" method="post">
            <input type="checkbox" name="delChk" value="{$value.imgId}">
            <input type="submit" name="del" value="削除">
            <input type="hidden" name="imgId" value="{$value.imgId}">
            </form>
        </td>
    </tr>
{/foreach}
{if $pagerLinks.all}
    <tr>
        <td align="center" colSpan="6">{$pagerLinks.all}</td>
    </tr>
{/if}
</table>
{include file=$smarty.const.footer_admin}