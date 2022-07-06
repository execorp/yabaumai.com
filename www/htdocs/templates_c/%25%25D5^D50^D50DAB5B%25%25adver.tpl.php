<?php /* Smarty version 2.6.26, created on 2022-06-30 18:23:48
         compiled from adver.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @headerPath, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="main">
	<section class="contBg" id="application">
		<h2>掲載申し込み</h2>

		<?php if ($this->_tpl_vars['pageChk']): ?>
			<span style="font-size: large;color: red;">メールの送信が完了しました。<br />スタッフからのご連絡をお待ちください。</span>
		<?php else: ?>
			<?php if ($this->_tpl_vars['errors']): ?>
				<span style="font-size: large;color: red;">認証用画像の文字列を正しく入力してください。</span>
			<?php endif; ?>
			<form<?php echo $this->_tpl_vars['form']['attributes']; ?>
>
				<?php echo $this->_tpl_vars['form']['javascript']; ?>

				<div>
					<ul class="jobDetailCont jobList">
						<li><h3><?php echo $this->_tpl_vars['form']['area']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['area']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['shopName']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['shopName']['html']; ?>
<br />※ご記入の無い申込みは受付致しません。</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['shopNameKana']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['shopNameKana']['html']; ?>
<br />※ご記入の無い申込みは受付致しません。</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['masterName']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['masterName']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['industry']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['industry']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['shopAddress']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['shopPref']['html']; ?>
<?php echo $this->_tpl_vars['form']['shopAddress']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['tel']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['tel']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['workTime']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['workTime']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['holiday']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['holiday']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['eMail']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['eMail']['html']; ?>
<br />※ご記入の無い申込みは受付致しません。</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['pcURL']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['pcURL']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['mobileURL']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['mobileURL']['html']; ?>
</p></li>
						<li><h3><?php echo $this->_tpl_vars['form']['comment']['label']; ?>
</h3><p><?php echo $this->_tpl_vars['form']['comment']['html']; ?>
</p></li>
						<li><h3>画像の文字列を入力してください</h3><p><img id="captcha" src="/securimage/securimage_show.php"><br /><input type="text" name="captcha_code"></p></li>
					</ul>
				</div>
				<div class='btnBox clearfix'>
					<button type="submit" name="doCheck" class="btn-square" style="display:inline-block;">送　信</button>
				</div>
			</form>
		<?php endif; ?>

	</section>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footerPath, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>