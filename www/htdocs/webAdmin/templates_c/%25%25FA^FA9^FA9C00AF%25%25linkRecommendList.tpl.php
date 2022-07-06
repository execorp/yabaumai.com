<?php /* Smarty version 2.6.25, created on 2022-06-28 18:22:21
         compiled from linkRecommendList.tpl */ ?>
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
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<?php echo '
<script type="text/javascript">
	window.onload = function()
	{
		var oFCKeditor = new FCKeditor( \'comment\' ) ;
		oFCKeditor.ReplaceTextarea() ;
	}
</script>
'; ?>

<?php echo $this->_tpl_vars['form']['javascript']; ?>

</head>
<body id="adminBase">
<div id="outline">
<?php echo $this->_tpl_vars['menu']; ?>


    <div id="contents">
    <h3 id="pageTitle">管理システム&nbsp;&gt;&nbsp;<a href="./">トップ</a>&nbsp;&gt;&nbsp;相互リンク</h3>
    <div class="topUrl"><a href="../" target="_blank">ホームページ</a>｜<a href="./">管理画面TOP</a></div>

<?php if ($this->_tpl_vars['r'] == 1): ?><div class="massage">登録完了しました。</div><?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 2): ?><div class="massage">修正完了しました。</div><?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 3): ?><div class="massage">削除完了しました。</div><?php endif; ?>
<?php if (! $this->_tpl_vars['r']): ?><div class="massage">修正したいデータ欄右の「修正」をクリックするか、削除したいデータ欄右の<br/>チェックを入れて「削除」をクリックしてください。</div><?php endif; ?>

        <!-- table class="t1">
        <tr>
        	<th style="text-align:center;font-size:16px;height:28px;" width="100%">
        	<b><?php echo $this->_tpl_vars['listAreaId'][$this->_tpl_vars['areaId']]; ?>
</b>
        	</td>
        	<td align="right" nowrap="nowrap">　
<?php $_from = $this->_tpl_vars['listAreaId']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
<a href="<?php echo $this->_tpl_vars['contId']; ?>
List.php?areaId=<?php echo $this->_tpl_vars['key']; ?>
&imgFlg=<?php echo $this->_tpl_vars['imgFlg']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</a> | 
<?php endforeach; endif; unset($_from); ?><br/>
			画像表示： <?php if (! $this->_tpl_vars['imgFlg']): ?><a href="<?php echo $this->_tpl_vars['contId']; ?>
List.php?areaId=<?php echo $this->_tpl_vars['areaId']; ?>
&imgFlg=1"><?php else: ?><b><?php endif; ?>ON</b></a> | <?php if ($this->_tpl_vars['imgFlg']): ?><a href="<?php echo $this->_tpl_vars['contId']; ?>
List.php?areaId=<?php echo $this->_tpl_vars['areaId']; ?>
&imgFlg=0"><?php else: ?><b><?php endif; ?>OFF</b></a>&nbsp;
        	</td>
        </tr>
        </table -->
        
        <table class="t1">
			<tr>
                <!-- th class="center" nowrap="nowrap">エリア</th -->
                <th class="center" nowrap="nowrap">順位</th>
                <th class="center" nowrap="nowrap" width="100%">タイトル / URL</th>
                <?php if ($this->_tpl_vars['imgFlg']): ?><th class="center" nowrap="nowrap">画像</th><?php endif; ?>
                <th class="center" nowrap="nowrap">修正</th>
                <th class="center" nowrap="nowrap">削除</th>
			</tr>
	<?php $_from = $this->_tpl_vars['prtMySQLResult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
	<?php if ($this->_tpl_vars['value']['areaId'] == $this->_tpl_vars['areaId']): ?>
            <tr>
                <!-- td class="center" nowrap="nowrap"><b><?php echo $this->_tpl_vars['value']['areaIdStr']; ?>
</b></td -->
                <td><?php echo $this->_tpl_vars['value']['priority']; ?>
位</td>
                <td><b><?php echo $this->_tpl_vars['value']['name']; ?>
</b><br/>http://<?php echo $this->_tpl_vars['value']['url']; ?>
</td>
                <?php if ($this->_tpl_vars['imgFlg']): ?><td>
                <?php if ($this->_tpl_vars['value']['file']): ?>
                <a href="http://<?php echo $this->_tpl_vars['value']['url']; ?>
" target="_blank">
                <img src="../inc/picR.php?imgId=<?php echo $this->_tpl_vars['value']['imgId']; ?>
&t=<?php echo $this->_tpl_vars['tableName']; ?>
&mh=31" border="0"></a>
                <?php else: ?>&nbsp;<?php endif; ?>
                </td><?php endif; ?>
                <td><form action="./<?php echo $this->_tpl_vars['contId']; ?>
AddChange.php" method="post"><input type="submit" name="change" value="修正"><input type="hidden" name="imgId" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
"><input type="hidden" name="genre" value="<?php echo $this->_tpl_vars['value']['genre']; ?>
"><input type="hidden" name="imgFlg" value="<?php echo $this->_tpl_vars['imgFlg']; ?>
"></form></td>
                <td nowrap="nowrap"><form action="./<?php echo $this->_tpl_vars['contId']; ?>
List.php" method="post"><input type="checkbox" name="delChk" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
"><input type="submit" name="del" value="削除"><input type="hidden" name="imgId" value="<?php echo $this->_tpl_vars['value']['imgId']; ?>
"><input type="hidden" name="genre" value="<?php echo $this->_tpl_vars['value']['genre']; ?>
"><input type="hidden" name="imgFlg" value="<?php echo $this->_tpl_vars['imgFlg']; ?>
"></form></td>
            </tr>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['pagerLinks']['all']): ?>
            <tr>
                <td align="center" colSpan="5"><?php echo $this->_tpl_vars['pagerLinks']['all']; ?>
</td>
            </tr>
<?php endif; ?>
        </table>
    </div>
    
</body>
</html>