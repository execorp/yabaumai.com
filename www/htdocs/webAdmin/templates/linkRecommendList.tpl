<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$smarty.const.domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
{literal}
<script type="text/javascript">
	window.onload = function()
	{
		var oFCKeditor = new FCKeditor( 'comment' ) ;
		oFCKeditor.ReplaceTextarea() ;
	}
</script>
{/literal}
{$form.javascript}
</head>
<body id="adminBase">
<div id="outline">
{$menu}

    <div id="contents">
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;相互リンク</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>

{if $r == 1}<div class="massage">登録完了しました。</div>{/if}
{if $r == 2}<div class="massage">修正完了しました。</div>{/if}
{if $r == 3}<div class="massage">削除完了しました。</div>{/if}
{if !$r}<div class="massage">修正したいデータ欄右の「修正」をクリックするか、削除したいデータ欄右の<br/>チェックを入れて「削除」をクリックしてください。</div>{/if}

        <!-- table class="t1">
        <tr>
        	<th style="text-align:center;font-size:16px;height:28px;" width="100%">
        	<b>{$listAreaId.$areaId}</b>
        	</td>
        	<td align="right" nowrap="nowrap">　
{foreach from=$listAreaId key=key item=value}
<a href="{$contId}List.php?areaId={$key}&imgFlg={$imgFlg}">{$value}</a> | 
{/foreach}<br/>
			画像表示： {if !$imgFlg}<a href="{$contId}List.php?areaId={$areaId}&imgFlg=1">{else}<b>{/if}ON</b></a> | {if $imgFlg}<a href="{$contId}List.php?areaId={$areaId}&imgFlg=0">{else}<b>{/if}OFF</b></a>&nbsp;
        	</td>
        </tr>
        </table -->
        
        <table class="t1">
			<tr>
                <!-- th class="center" nowrap="nowrap">エリア</th -->
                <th class="center" nowrap="nowrap">順位</th>
                <th class="center" nowrap="nowrap" width="100%">タイトル / URL</th>
                {if $imgFlg}<th class="center" nowrap="nowrap">画像</th>{/if}
                <th class="center" nowrap="nowrap">修正</th>
                <th class="center" nowrap="nowrap">削除</th>
			</tr>
	{foreach from=$prtMySQLResult item=value name=result}
	{if $value.areaId == $areaId}
            <tr>
                <!-- td class="center" nowrap="nowrap"><b>{$value.areaIdStr}</b></td -->
                <td>{$value.priority}位</td>
                <td><b>{$value.name}</b><br/>http://{$value.url}</td>
                {if $imgFlg}<td>
                {if $value.file}
                <a href="http://{$value.url}" target="_blank">
                <img src="../inc/picR.php?imgId={$value.imgId}&t={$tableName}&mh=31" border="0"></a>
                {else}&nbsp;{/if}
                </td>{/if}
                <td><form action="./{$contId}AddChange.php" method="post"><input type="submit" name="change" value="修正"><input type="hidden" name="imgId" value="{$value.imgId}"><input type="hidden" name="genre" value="{$value.genre}"><input type="hidden" name="imgFlg" value="{$imgFlg}"></form></td>
                <td nowrap="nowrap"><form action="./{$contId}List.php" method="post"><input type="checkbox" name="delChk" value="{$value.imgId}"><input type="submit" name="del" value="削除"><input type="hidden" name="imgId" value="{$value.imgId}"><input type="hidden" name="genre" value="{$value.genre}"><input type="hidden" name="imgFlg" value="{$imgFlg}"></form></td>
            </tr>
	{/if}
	{/foreach}

{if $pagerLinks.all}
            <tr>
                <td align="center" colSpan="5">{$pagerLinks.all}</td>
            </tr>
{/if}
        </table>
    </div>
    
</body>
</html>
