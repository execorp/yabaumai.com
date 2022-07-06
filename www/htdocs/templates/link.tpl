{include file=$smarty.const.headerPath}

<div class="otherTitle"><img src="./img/titleLink.jpg" alt="{$smarty.const.siteName} 相互リンク" /></div>

<div id="linkBana">
    <div id="title">下記のバナーをダウンロードし、リンク完了後<a href="./inquiry.html" title="お問い合わせ">こちら</a>よりご連絡下さい。</div>
    <p>
        <img src="./img/bana/468_60.gif" alt="{$smarty.const.siteName} 468×60サイズ" /><br />
        <span>{$smarty.const.siteName} 468×60サイズ</span><br />
        <form name="form"><textarea name="" rows="4" cols="64" wrap="soft"><a href="http://www.{$smarty.const.domain}" title="{$smarty.const.siteName}"><img src="http://www.{$smarty.const.domain}/img/bana/468_60.gif" alt="{$smarty.const.siteName} 468×60サイズ" /></a></textarea></form>
    </p>
    <p>
        <img src="./img/bana/300_60.gif" alt="{$smarty.const.siteName} 300×60サイズ" /><br />
        <span>{$smarty.const.siteName} 300×60サイズ</span><br />
        <form name="form"><textarea name="" rows="4" cols="64" wrap="soft"><a href="http://www.{$smarty.const.domain}" title="{$smarty.const.siteName}"><img src="http://www.{$smarty.const.domain}/img/bana/300_60.gif" alt="{$smarty.const.siteName} 300×60サイズ" /></a></textarea></form>
    </p>
    <p>
        <img src="./img/bana/200_90.gif" alt="{$smarty.const.siteName} 200×90サイズ" /><br />
        <span>{$smarty.const.siteName} 200×90サイズ</span><br />
        <form name="form"><textarea name="" rows="4" cols="64" wrap="soft"><a href="http://www.{$smarty.const.domain} title="{$smarty.const.siteName}"><img src="http://www.{$smarty.const.domain}/img/bana/200_90.gif" alt="{$smarty.const.siteName} 200×90サイズ" /></a></textarea></form>
    </p>
    <p>
        <img src="./img/bana/200_40.gif" alt="{$smarty.const.siteName} 200×40サイズ" /><br />
        <span>{$smarty.const.siteName} 200×40サイズ</span><br />
        <form name="form"><textarea name="" rows="4" cols="64" wrap="soft"><a href="http://www.{$smarty.const.domain}" title="{$smarty.const.siteName}"><img src="http://www.{$smarty.const.domain}/img/bana/200_40.gif" alt="{$smarty.const.siteName} 200×40サイズ" /></a></textarea></form>
    </p>
    <p>
        <img src="./img/bana/88_31.gif" alt="{$smarty.const.siteName} 88×31サイズ" /><br />
        <span>{$smarty.const.siteName} 88×31サイズ</span><br />
        <form name="form"><textarea name="" rows="4" cols="64" wrap="soft"><a href="http://www.{$smarty.const.domain}" title="{$smarty.const.siteName}"><img src="http://www.{$smarty.const.domain}/img/bana/88_31.gif" alt="{$smarty.const.siteName} 88×31サイズ" /></a></textarea></form>
    </p>
</div>

<div id="linkBotan">
{foreach from=$listGenre key=key item=value}
    <p class="link{$key}"><a href="link{$key}.html" title="{$value}" class="{if $genre == $key}this{else}other{/if}">{$value}</a></p>
{/foreach}
</div>

{foreach from=$link item=value name=result}
    <div class="linkBox">
    {if $value.file}<a href="http://{$value.URL}" target="_blank"><img src="./inc/picR.php?imgId={$value.imgId}&amp;t=linkBanner&amp;mh=60" border="0" alt="{$value.name},{$value.URL}" /></a>{/if}<br />
    <a href="http://{$value.URL}" target="_blank">{$value.name}</a><br />
    </div>
{/foreach}

{include file=$smarty.const.footerPath}