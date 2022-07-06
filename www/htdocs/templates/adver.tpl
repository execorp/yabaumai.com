{include file=$smarty.const.headerPath}

<div class="main">
	<section class="contBg" id="application">
		<h2>掲載申し込み</h2>

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
						<li><h3>{$form.area.label}</h3><p>{$form.area.html}</p></li>
						<li><h3>{$form.shopName.label}</h3><p>{$form.shopName.html}<br />※ご記入の無い申込みは受付致しません。</p></li>
						<li><h3>{$form.shopNameKana.label}</h3><p>{$form.shopNameKana.html}<br />※ご記入の無い申込みは受付致しません。</p></li>
						<li><h3>{$form.masterName.label}</h3><p>{$form.masterName.html}</p></li>
						<li><h3>{$form.industry.label}</h3><p>{$form.industry.html}</p></li>
						<li><h3>{$form.shopAddress.label}</h3><p>{$form.shopPref.html}{$form.shopAddress.html}</p></li>
						<li><h3>{$form.tel.label}</h3><p>{$form.tel.html}</p></li>
						<li><h3>{$form.workTime.label}</h3><p>{$form.workTime.html}</p></li>
						<li><h3>{$form.holiday.label}</h3><p>{$form.holiday.html}</p></li>
						<li><h3>{$form.eMail.label}</h3><p>{$form.eMail.html}<br />※ご記入の無い申込みは受付致しません。</p></li>
						<li><h3>{$form.pcURL.label}</h3><p>{$form.pcURL.html}</p></li>
						<li><h3>{$form.mobileURL.label}</h3><p>{$form.mobileURL.html}</p></li>
						<li><h3>{$form.comment.label}</h3><p>{$form.comment.html}</p></li>
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