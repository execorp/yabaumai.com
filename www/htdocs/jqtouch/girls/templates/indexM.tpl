{include file=$smarty.const.header_mobile}

<div align="center"> <img src="../img_i/mobile-logo03.gif" alt="logo">
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  <font color="{$smarty.const.COLOR_TEXT_H2}"><b>ω ΜqΠξω </b></font>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  <form action="./" method="get">
    <div class="Soat-Area">
      <input type="radio" name="q" value="1"{if $smarty.get.q == 1 }checked{/if} id="q_1" />
      <label for="q_1">Nξ&nbsp;</label>
      <input type="radio" name="q" value="2"{if $smarty.get.q == 2 }checked{/if} id="q_2" />
      <label for="q_2">ΌO&nbsp;</label>
      <input type="submit" name="submitSort" value="ΐΧΦ¦">
    </div>
    {if $smarty.get.date}
    <input type="hidden" name="date" value="{$smarty.get.date}">
    {/if}
  </form>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  <!--Μq΄Ψ±½ΐ°Δ-->
  {foreach from=$prtData item=value name=result} <a href="./?id={$value.id}{if $smarty.get.s==1}&s=1{/if}">{$value.img}</a><br>
  <font size="1"><a href="./detail.php?id={$value.id}{if $smarty.get.s == 1}&s=1{/if}">{$value.name}</a> {$value.age}Ξ<br>
  T.{$value.t}/B.{$value.b}({$value.c})/W.{$value.w}/H.{$value.h}</font><br>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  {/foreach}
  <!--Μq΄Ψ±΄έΔή-->
  <font size="1">Μ²sΗΙζιΟXͺ ικͺ θά·‘¨θΕ·ͺ€²XOΙ¨dbΕmF΅ΔΊ³’‘</font>
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
  {$pagerLinks.back|default:"&lt;&lt;BACK"}E{$pagerLinks.next|default:"NEXT&gt;&gt;"}
  <hr size="1" color="{$smarty.const.COLOR_LINE_COMMENT}">
</div>
ψΔ&nbsp;<a href="../top/{if $smarty.get.s==1}?s=1{/if}">TOPΝί°ΌήΦ </a>

{include file=$smarty.const.footer_mobile}