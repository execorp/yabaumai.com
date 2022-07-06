{include file=$smarty.const.headerPath}

<div class="main">
	<section class="contBg" id="application">
		<h2>お問い合わせ</h2>

		{if $pageChk}
			<span style="font-size: large;color: red;">メールの送信が完了しました。<br />スタッフからのご連絡をお待ちください。</span>
		{else}
			{if $errors}
				<span style="font-size: large;color: red;">認証用画像の文字列を正しく入力してください。</span>
			{/if}
			<form{$form.attributes}>
				{$form.javascript}
				<div>
					<ul class="jobDetailCont jobList">
						<li><h3>{$form.eMail.label}</h3><p>※{literal}必須{/literal}<br />{$form.eMail.html}</p></li>
						<li><h3>{$form.name.label}</h3><p>{$form.name.html}</p></li>
						<li><h3>{$form.comment.label}</h3><p>※{literal}必須{/literal}<br />{$form.comment.html}</p></li>
						<li><h3>画像の文字列を入力してください</h3><p><img id="captcha" src="/securimage/securimage_show.php"><br /><input type="text" name="captcha_code"></p></li>
					</ul>
				</div>
				<div class='btnBox clearfix'>
					<button type="submit" name="doCheck" class="btn-square" style="display:inline-block;">送　信</button>
				</div>
			</form>
		{/if}

	</section>
</div>

{include file=$smarty.const.footerPath}
