<?php /* Smarty version 2.6.25, created on 2010-07-02 16:24:09
         compiled from index.tpl */ ?>
﻿<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>jQtouch cheet UI</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />  
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <link type="text/css" rel="stylesheet" media="screen" href="../jqtouch/jqtouch.css" />
        <link type="text/css" rel="stylesheet" media="screen" href="../themes/jqt/theme.css" />
        <link type="text/css" rel="stylesheet" media="screen" href="../css/base.css">
        <script type="text/javascript" src="../jqtouch/jquery.1.3.2.min.js"></script>
        <script type="text/javascript" src="../jqtouch/jqtouch.js"></script>
        <script type="text/javascript" charset="utf-8">
            $.jQTouch();
        </script>
    </head>
    <body>
        <div id="home">
                <div class="toolbar">
                <h1>女の子一覧</h1>
                </div>
                
                <?php $_from = $this->_tpl_vars['prtData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
                <div class="info">
                    <h1><?php echo $this->_tpl_vars['value']['img']; ?>
</h1>
                    <h2><?php echo $this->_tpl_vars['value']['name']; ?>
</a>( <?php echo $this->_tpl_vars['value']['age']; ?>
 )</h2>
                </div>
                <?php endforeach; endif; unset($_from); ?>
        </div>
    </body>
</html>