{include file=$smarty.const.header_mobile}

<div align="center"><br />
  <a href="./detail.php?id={$listDetail.id}{if $smarty.get.s==1}&s=1{/if}">{$listDetail.img}</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">{$listDetail.name}</font><font size="1">{$listDetail.age}歳</font><br />
  <br />
  {$emojiArray.F95E}出勤予定&nbsp;
  <font color="{$smarty.const.COLOR_TEXT_H3}">{if $listDetail.schFlg}{literal}本{/literal}日出勤{else}要確認{/if}</font><br /><br />
</div>

  <font color="{$smarty.const.COLOR_TEXT_H3}">{$emojiArray.F95E}</font><a href="../schedule/{if $smarty.get.s==1}?s=1{/if}" accesskey="1">出勤情報</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}"></font><a href="./detail.php?id={$listDetail.id}{if $smarty.get.s==1}&s=1{/if}" ACCESSKEY="2">女性詳細ページ</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}"></font><a href="tel:{$smarty.const.shopTel}" accesskey="3">予約/{$smarty.const.shopTel}</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">{$emojiArray.F9BA}</font><a href="../system/{if $smarty.get.s==1}?s=1{/if}" accesskey="5">料金ｼｽﾃﾑ</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}"></font><a href="../magazine/{if $smarty.get.s==1}?s=1{/if}" accesskey="6">ﾒｰﾙﾏｶﾞｼﾞﾝ</a><br />
  <br />
  <br />
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">

&nbsp;<a href="../girls/{if $smarty.get.s==1}?s=1{/if}">一覧へ戻る</a> <br />
&nbsp;<a href="../top/{if $smarty.get.s==1}?s=1{/if}">TOPﾍﾟｰｼﾞへ </a>

{include file=$smarty.const.footer_mobile}