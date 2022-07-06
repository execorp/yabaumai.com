<?php /* Smarty version 2.6.25, created on 2022-07-06 16:17:58
         compiled from shopAddChange.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: <?php echo @domain; ?>
 :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
<?php echo $this->_tpl_vars['form']['javascript']; ?>

</head>
<body id="adminBase">
<div id="outline">
<?php echo $this->_tpl_vars['menu']; ?>

    <div id="contents">
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;<?php echo $this->_tpl_vars['pageTitle']; ?>
</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>
<?php if ($this->_tpl_vars['errorStr']): ?><div class="massage"><?php echo $this->_tpl_vars['errorStr']; ?>
</div><?php endif; ?>
<table class="t1">
<form<?php echo $this->_tpl_vars['form']['attributes']; ?>
>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['shopName']['label']; ?>
 <span class="cap">※必<?php echo '須'; ?>
</span></th><td><?php echo $this->_tpl_vars['form']['shopName']['html']; ?>
 <span class="cap">（* 全角）</span></td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['shopNameKana']['label']; ?>
 <span class="cap">※必<?php echo '須'; ?>
</span></th><td><?php echo $this->_tpl_vars['form']['shopNameKana']['html']; ?>
 <span class="cap">（* 全角ひらがな）</span></td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['tel']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['tel']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['URL']['label']; ?>
 </th><td>http://<?php echo $this->_tpl_vars['form']['URL']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['RSS']['label']; ?>
 </th><td>http://<?php echo $this->_tpl_vars['form']['RSS']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['mail']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['mail']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['areaId']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['areaId']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['prefectureId']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['prefectureId']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['genreId']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['genreId']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['jobCategory']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['jobCategory']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['jobBack']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['jobBack']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['workComment']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['workComment']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['license']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['license']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['employ']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['employ']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['place']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['place']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['traffic']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['traffic']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['workTime']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['workTime']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['salary']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['salary']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['treatment']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['treatment']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['holiday']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['holiday']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['educatetrain']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['educatetrain']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['establish']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['establish']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['represent']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['represent']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['companyMoney']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['companyMoney']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['employee']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['employee']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['business']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['business']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['officePlace']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['officePlace']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['selection']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['selection']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['application']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['application']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['interviewPlace']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['interviewPlace']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['contactAddress']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['contactAddress']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['shopComment']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['shopComment']['html']; ?>
</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['loginId']['label']; ?>
 <span class="cap">※必<?php echo '須'; ?>
</span></th><td><?php echo $this->_tpl_vars['form']['loginId']['html']; ?>
</td></tr>
    <tr><th class="addGal" nowrap="nowrap"><?php echo $this->_tpl_vars['form']['loginPass']['label']; ?>
 <span class="cap">※必<?php echo '須'; ?>
</span></th><td><?php echo $this->_tpl_vars['form']['loginPass']['html']; ?>
</td></tr>
    
    <tr>
	<th class="addGal">アイコン </th>
	<td>
<?php $_from = $this->_tpl_vars['form']['iconList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
	<?php echo $this->_tpl_vars['row']['html']; ?>

<?php endforeach; endif; unset($_from); ?>
	</td>
    </tr>
    
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['userfile0']['label']; ?>
<br /><span class="cap">(横150 x 縦40)</span></th><td><?php echo $this->_tpl_vars['form']['userfile0']['html']; ?>
<?php if ($this->_tpl_vars['imgId0']): ?><br /><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['imgId0']; ?>
&t=image&rs=1" /><input name="imageBanaDelChk" type="checkbox" value="<?php echo $this->_tpl_vars['imgId0']; ?>
" /><font color="#ff0000">削除ﾁｪｯｸ</font><?php endif; ?></td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['userfile1']['label']; ?>
<br /><span class="cap">(横320 x 縦240)</span></th><td><?php echo $this->_tpl_vars['form']['userfile1']['html']; ?>
<?php if ($this->_tpl_vars['imgId1']): ?><br /><img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['imgId1']; ?>
&t=image&rs=1" /><input name="imageShopDelChk" type="checkbox" value="<?php echo $this->_tpl_vars['imgId1']; ?>
" /><font color="#ff0000">削除ﾁｪｯｸ</font><?php endif; ?></td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['priority']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['priority']['html']; ?>
位</td></tr>
    <tr><th class="addGal"><?php echo $this->_tpl_vars['form']['regDateTime']['label']; ?>
 </th><td><?php echo $this->_tpl_vars['form']['regDateTime']['html']; ?>
</td></tr>
</table>
    <div class="submit">
    <?php echo $this->_tpl_vars['form']['submitReg']['html']; ?>

    </div>
    </div>
    <!-- div style="position:absolute;left:780px;top:80px;">
        <iframe name="preview" src="../top.php?s=1" height="550" width="270"> 
            この部分は iframe 対応のブラウザで見てください。
        </iframe>
    </div -->
</div>
<?php echo $this->_tpl_vars['form']['hidden']; ?>

</form>
</body>
</html>