<?php /* Smarty version 2.6.25, created on 2022-06-28 14:41:02
         compiled from shopList.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: <?php echo $this->_tpl_vars['domain']; ?>
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
        <table class="t1">
<form action="./shopList.php" method="post">
            <tr>
                <td><input type="text" name="search" size="30" /><input type="submit" value="店名 or 電話番号で検索"></td>
            </tr>
</form>
        </table>
<?php if ($this->_supers['post']['sendMail']): ?>
<font size="+2" color="#ff0000"><?php echo $this->_tpl_vars['sendShopName']; ?>
に送信しました</font>
<?php endif; ?>

        <table class="t1">
<?php $_from = $this->_tpl_vars['prtData']['shopMaster']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
            <tr>
                <td><?php echo $this->_foreach['result']['iteration']; ?>
</td>
                <td><form action="./shopList.php" method="post"><input type="checkbox" name="sendMail" value="<?php echo $this->_tpl_vars['value']['shopId']; ?>
"><input type="submit" name="sendMail" value="メール"><input type="hidden" name="shopId" value="<?php echo $this->_tpl_vars['value']['shopId']; ?>
"></form></td>
                <td><form action="../shopAdmin/logIn.php" method="post" target="new"><input type="submit" name="submit" value="ログイン"><input type="hidden" name="username" value="<?php echo $this->_tpl_vars['value']['username']; ?>
"><input type="hidden" name="password" value="<?php echo $this->_tpl_vars['value']['password']; ?>
"></form></td>
                <td><?php if ($this->_tpl_vars['value']['URL']): ?><a href="http://<?php echo $this->_tpl_vars['value']['URL']; ?>
" target="_blank"><?php endif; ?><?php echo $this->_tpl_vars['value']['shopName']; ?>
<?php if ($this->_tpl_vars['value']['URL']): ?></a><?php endif; ?></td>
                <td><?php echo $this->_tpl_vars['value']['areaId']; ?>
</td>
                <td><?php echo $this->_tpl_vars['value']['prefectureId']; ?>
</td>
                <td><?php if ($this->_tpl_vars['value']['priority'] != $this->_tpl_vars['MyCount']): ?><a href="./shopList.php?t=d&p=<?php echo $this->_tpl_vars['value']['priority']; ?>
&shopId=<?php echo $this->_tpl_vars['value']['shopId']; ?>
&ls=<?php echo $this->_tpl_vars['ls']; ?>
">▽</a><?php endif; ?><?php if ($this->_tpl_vars['value']['priority'] > 1): ?><a href="./shopList.php?t=u&p=<?php echo $this->_tpl_vars['value']['priority']; ?>
&shopId=<?php echo $this->_tpl_vars['value']['shopId']; ?>
&ls=<?php echo $this->_tpl_vars['ls']; ?>
">△</a><?php endif; ?></td>
                <td><form action="./shopAddChange.php" method="post"><input type="submit" name="change" value="修正"><input type="hidden" name="shopId" value="<?php echo $this->_tpl_vars['value']['shopId']; ?>
"></form></td>
                <td><form action="./shopList.php" method="post"><input type="checkbox" name="delChk" value="<?php echo $this->_tpl_vars['value']['shopId']; ?>
"><input type="submit" name="del" value="削除"><input type="hidden" name="shopId" value="<?php echo $this->_tpl_vars['value']['shopId']; ?>
"></form></td>
            </tr>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['pagerLinks']['all']): ?>
            <tr>
                <td align="center" colSpan="9"><?php echo $this->_tpl_vars['pagerLinks']['all']; ?>
</td>
            </tr>
<?php endif; ?>
        </table>
    </div>
    </div>
    
    <!-- div style="position:absolute;left:780px;top:80px;">
        <iframe name="preview" src="../top.php?s=1" height="550" width="270"> 
            この部分は iframe 対応のブラウザで見てください。
        </iframe>
    </div -->
</div>
</body>
</html>