{include file=$smarty.const.header_mobile}

<div align="center"><br />
  <a href="./detail.php?id={$listDetail.id}{if $smarty.get.s==1}&s=1{/if}">{$listDetail.img}</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">{$listDetail.name}</font><font size="1">{$listDetail.age}��</font><br />
  <br />
  {$emojiArray.F95E}�o�Η\��&nbsp;
  <font color="{$smarty.const.COLOR_TEXT_H3}">{if $listDetail.schFlg}{literal}�{{/literal}���o����{else}�r�v�m�F{/if}</font><br /><br />
</div>

  <font color="{$smarty.const.COLOR_TEXT_H3}">{$emojiArray.F95E}</font><a href="../schedule/{if $smarty.get.s==1}?s=1{/if}" accesskey="1">�o�Ώ��</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">��</font><a href="./detail.php?id={$listDetail.id}{if $smarty.get.s==1}&s=1{/if}" ACCESSKEY="2">�����ڍ׃y�[�W</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">��</font><a href="tel:{$smarty.const.shopTel}" accesskey="3">�\��/{$smarty.const.shopTel}</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">{$emojiArray.F9BA}</font><a href="../system/{if $smarty.get.s==1}?s=1{/if}" accesskey="5">���༽��</a><br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">�w</font><a href="../magazine/{if $smarty.get.s==1}?s=1{/if}" accesskey="6">Ұ�϶޼��</a><br />
  <br />
  <br />
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">

�~&nbsp;<a href="../girls/{if $smarty.get.s==1}?s=1{/if}">�ꗗ�֖߂�</a> <br />
��&nbsp;<a href="../top/{if $smarty.get.s==1}?s=1{/if}">TOP�߰�ނ� </a>

{include file=$smarty.const.footer_mobile}