{include file=$smarty.const.header_admin}

<div align="right"><font color="#cccccc">ver {$version}</font></div>

<table class="t1" style="width:850px;margin-left:30px;">
  <tr>
    <td>PC 携帯共通URL (PNG)<br />http://www.{$smarty.const.domain}/</td>
    <td><img src="../qrCode/prtQr.php?url=http://www.{$smarty.const.domain}/" alt="qrコード" border="0" /></td>

  </tr>



{include file=$smarty.const.footer_admin}