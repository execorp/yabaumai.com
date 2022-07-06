{include file=$smarty.const.header_admin}

<div align="right"><font color="#cccccc">ver {$version}</font></div>
<p style="text-align:center;">
パスワードの変更は スーパーユーザ 以上しかできません<br />
現在のログインユーザーは<strong>{$errorMessage}</strong>です<br />
</p>
{include file=$smarty.const.footer_admin}
