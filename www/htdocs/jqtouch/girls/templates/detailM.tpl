{include file=$smarty.const.header_mobile}

<div align="center"><br />
  {$prtData.mainImg}<br />
  <font color="{$smarty.const.COLOR_TEXT_H3}"> {$prtData.name} </font>{$prtData.age}��<br />
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  {foreach from=$prtData.sumImg item=value name=result key=key} <a href="./detail.php?id={$smarty.get.id}&ls={$key}{if $smarty.get.s==1}&s=1{/if}"><img src="../inc/picR.php?imgId={$value}&mw=24" border="0" alt="image"/></a>
  {/foreach}
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  {$prtData.iconList}
</div>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  <font color="{$smarty.const.COLOR_TEXT_H3}">������</font><br />
  ��<font size="1">T{$prtData.t}/B{$prtData.b}({$prtData.c})/W{$prtData.w}/H{$prtData.h}<br /></font>
  <font color="{$smarty.const.COLOR_TEXT_H3}">�����̌�</font><br />
  ��<font size="1">{$prtData.firstContact}<br /></font>
  <font color="{$smarty.const.COLOR_TEXT_H3}">�����ӋZ</font><br />
  ��<font size="1">{$prtData.play}<br /></font>
  <font color="{$smarty.const.COLOR_TEXT_H3}">����E���Z</font><br />
  ��<font size="1">{$prtData.hobby}<br /></font>
  <font color="{$smarty.const.COLOR_TEXT_H3}">���D��������</font><br />
  ��<font size="1">{$prtData.typeLike}<br /></font>
  <font color="{$smarty.const.COLOR_TEXT_H3}">��ϲ�ް�</font><br />
  ��<font size="1">{$prtData.myBoom}<br /></font>
  <font color="{$smarty.const.COLOR_TEXT_H3}">�����̎q�����ү����</font><br />
  ��<font size="1">{$prtData.galComment|nl2br}<br /></font>
  <font color="{$smarty.const.COLOR_TEXT_H3}">�����X�����ү����</font><br />
  ��<font size="1">{$prtData.staffComment|nl2br}<br /></font>
  <br />
  <font color="{$smarty.const.COLOR_TEXT_H3}">�k�\��߼�݁l</font><br />
<font size="1">
  {foreach from=$optionArray item=value name=result key=key}
  {if $prtData.option[$key]}{$value}<br />
  {/if}
  {/foreach}
</font>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
�~&nbsp;<a href="../girls/{if $smarty.get.s==1}?s=1{/if}">�ꗗ�֖߂�</a> <br />
��&nbsp;<a href="../top/{if $smarty.get.s==1}?s=1{/if}">TOP�߰�ނ� </a>

{include file=$smarty.const.footer_mobile}