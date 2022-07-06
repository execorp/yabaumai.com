{include file=$smarty.const.header_mobile}

<div align="center"> <img src="../img_i/mobile-logo03.gif" alt="logo">
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  <font color="{$smarty.const.COLOR_TEXT_H2}"><b>女の子紹介</b></font>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  <form action="./" method="get">
    <div class="Soat-Area">
      <input type="radio" name="q" value="1"{if $smarty.get.q == 1 }checked{/if} id="q_1" />
      <label for="q_1">年齢順&nbsp;</label>
      <input type="radio" name="q" value="2"{if $smarty.get.q == 2 }checked{/if} id="q_2" />
      <label for="q_2">名前順&nbsp;</label>
      <input type="submit" name="submitSort" value="並べ替え">
    </div>
    {if $smarty.get.date}
    <input type="hidden" name="date" value="{$smarty.get.date}">
    {/if}
  </form>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  <!--女の子ｴﾘｱｽﾀｰﾄ-->
  {foreach from=$prtData item=value name=result} <a href="./?id={$value.id}{if $smarty.get.s==1}&s=1{/if}">{$value.img}</a><br>
  <font size="1"><a href="./detail.php?id={$value.id}{if $smarty.get.s == 1}&s=1{/if}">{$value.name}</a> {$value.age}歳<br>
  T.{$value.t}/B.{$value.b}({$value.c})/W.{$value.w}/H.{$value.h}</font><br>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  {/foreach}
  <!--女の子ｴﾘｱｴﾝﾄﾞ-->
  <font size="1">体調不良等による変更がある場合があります｡お手数ですが､ご来店前にお電話で確認して下さい｡</font>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  {$pagerLinks.back|default:"&lt;&lt;BACK"}・{$pagerLinks.next|default:"NEXT&gt;&gt;"}
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
</div>
&nbsp;<a href="../top/{if $smarty.get.s==1}?s=1{/if}">TOPﾍﾟｰｼﾞへ </a>

{include file=$smarty.const.footer_mobile}