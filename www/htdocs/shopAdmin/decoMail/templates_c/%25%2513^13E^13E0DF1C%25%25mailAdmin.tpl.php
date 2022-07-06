<?php /* Smarty version 2.6.25, created on 2010-03-10 17:57:04
         compiled from mailAdmin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'mailAdmin.tpl', 189, false),array('modifier', 'date_format', 'mailAdmin.tpl', 234, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @header_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo $this->_tpl_vars['jsInclude']; ?>

<div class="massage">
テスト送信にチェックを入れると テストメールに設定したアドレスだけに届きます。<br>
通常メールはデコメールに対応していないキャリア(PCメール含む)向けの内容になります。<br>
<?php if ($this->_tpl_vars['galsArray']): ?><?php echo '女の子参照ボタンはデコメールにリンクを挿入するためのボタンです。'; ?>
<br><?php endif; ?>
<?php if ($this->_tpl_vars['decoMailOnly']): ?><?php else: ?>デコメール送信のチェックを外すと 全ての宛先に通常メールが届きます。<br><?php endif; ?>
<?php if ($this->_tpl_vars['sendForm']['errors']): ?>
    <?php $_from = $this->_tpl_vars['sendForm']['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
    <?php echo $this->_tpl_vars['error']; ?>
<br/>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 1): ?>*登録が完了しました。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 2): ?>*送信を開始しました。送信完了まで数分必要です。<br>※完了まで画像は変更しないでください。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 3): ?>*画像のアップロードが完了しました。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 4): ?>*画像の削除が完了しました。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 5): ?>*送信条件と件数を確認した後、登録して送信を押して下さい。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 6): ?>*通常メール と デコメール の合計が長すぎます。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 7): ?>*添付画像一覧以外の画像が挿入されています。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 8): ?>*通常メール か デコメール のいずれか一つは入力して下さい。<?php endif; ?>
<?php if ($this->_tpl_vars['r'] == 9): ?>*送信元や件名は必ず入力して下さい。<?php endif; ?>
</div>

    <table class="t1">
        <form<?php echo $this->_tpl_vars['sendForm']['attributes']; ?>
>
<?php if ($this->_tpl_vars['r'] != 5): ?>
            <tr>
                <th colspan="2" style="font-size:12px;text-align:center;">登録[<?php echo $this->_tpl_vars['chk']; ?>
]</th>
            </tr>
            <tr>
                <td colspan="2" align="center" >
<?php unset($this->_sections['cnt']);
$this->_sections['cnt']['name'] = 'cnt';
$this->_sections['cnt']['start'] = (int)1;
$this->_sections['cnt']['loop'] = is_array($_loop=$this->_tpl_vars['listMax']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cnt']['show'] = true;
$this->_sections['cnt']['max'] = $this->_sections['cnt']['loop'];
$this->_sections['cnt']['step'] = 1;
if ($this->_sections['cnt']['start'] < 0)
    $this->_sections['cnt']['start'] = max($this->_sections['cnt']['step'] > 0 ? 0 : -1, $this->_sections['cnt']['loop'] + $this->_sections['cnt']['start']);
else
    $this->_sections['cnt']['start'] = min($this->_sections['cnt']['start'], $this->_sections['cnt']['step'] > 0 ? $this->_sections['cnt']['loop'] : $this->_sections['cnt']['loop']-1);
if ($this->_sections['cnt']['show']) {
    $this->_sections['cnt']['total'] = min(ceil(($this->_sections['cnt']['step'] > 0 ? $this->_sections['cnt']['loop'] - $this->_sections['cnt']['start'] : $this->_sections['cnt']['start']+1)/abs($this->_sections['cnt']['step'])), $this->_sections['cnt']['max']);
    if ($this->_sections['cnt']['total'] == 0)
        $this->_sections['cnt']['show'] = false;
} else
    $this->_sections['cnt']['total'] = 0;
if ($this->_sections['cnt']['show']):

            for ($this->_sections['cnt']['index'] = $this->_sections['cnt']['start'], $this->_sections['cnt']['iteration'] = 1;
                 $this->_sections['cnt']['iteration'] <= $this->_sections['cnt']['total'];
                 $this->_sections['cnt']['index'] += $this->_sections['cnt']['step'], $this->_sections['cnt']['iteration']++):
$this->_sections['cnt']['rownum'] = $this->_sections['cnt']['iteration'];
$this->_sections['cnt']['index_prev'] = $this->_sections['cnt']['index'] - $this->_sections['cnt']['step'];
$this->_sections['cnt']['index_next'] = $this->_sections['cnt']['index'] + $this->_sections['cnt']['step'];
$this->_sections['cnt']['first']      = ($this->_sections['cnt']['iteration'] == 1);
$this->_sections['cnt']['last']       = ($this->_sections['cnt']['iteration'] == $this->_sections['cnt']['total']);
?>
                    <a href="<?php echo $this->_tpl_vars['php_self']; ?>
?chk=<?php echo $this->_sections['cnt']['index']; ?>
">登録[<?php echo $this->_sections['cnt']['index']; ?>
]</a>　
<?php endfor; endif; ?> 
                </td>
            </tr>
<?php endif; ?>
            <tr>
                <th><?php echo $this->_tpl_vars['sendForm']['from']['label']; ?>
<?php if ($this->_tpl_vars['sendFromData'] == ""): ?>　<span class="cap">例：info@<?php echo $this->_tpl_vars['domain']; ?>
</span><?php endif; ?>
                </th>
                <td >
<?php if ($this->_tpl_vars['sendFromData'] != ""): ?>
                <?php echo $this->_tpl_vars['sendFromData']; ?>

<?php else: ?>
                <?php echo $this->_tpl_vars['sendForm']['from']['html']; ?>

<?php endif; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->_tpl_vars['sendForm']['subject']['label']; ?>
&nbsp;<span class="cap">※必<?php echo '須'; ?>
</span></th>
                <td >
                <?php if ($this->_tpl_vars['r'] == 5): ?>
                <?php echo $this->_tpl_vars['subject_str']; ?>

                <?php else: ?>
                <?php echo $this->_tpl_vars['sendForm']['subject']['html']; ?>

                <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th colspan="2"><?php echo '本文'; ?>
</th>
            </tr>
                <?php if ($this->_tpl_vars['r'] == 5): ?>
            <tr>
                <th><?php echo '非対応携帯向け本文'; ?>
</th>
                <th><?php echo 'デコメール対応機種向け本文'; ?>
</th>
            </tr>
                <?php endif; ?>
            <tr>
                <td>
                <?php if ($this->_tpl_vars['r'] == 5): ?>
                <?php echo $this->_tpl_vars['plainComment_str']; ?>

                <?php else: ?>
                <b><?php echo $this->_tpl_vars['sendForm']['plainComment']['label']; ?>
 >></b><br /><?php echo $this->_tpl_vars['sendForm']['plainComment']['html']; ?>

                <?php endif; ?>
                </td>
                <?php if ($this->_tpl_vars['r'] == 5): ?>
                <td width="240" style="background:<?php echo $this->_tpl_vars['fck_bgc']; ?>
">
                <?php echo $this->_tpl_vars['htmlComment_str']; ?>

                <?php else: ?>
                <?php if ($this->_tpl_vars['galsArray'] || $this->_tpl_vars['baseTextArea']): ?>
                <td style="text-align:center;" rowspan="3">
                <?php else: ?>
                <td style="text-align:center;">
                <?php endif; ?>
                <b><?php echo $this->_tpl_vars['sendForm']['htmlComment']['label']; ?>
 >></b><br />
                背景色：
<?php if ($this->_tpl_vars['colorArray']): ?>
<select onchange="selectbgcolor(this)" id="fckbgcolor" name="fckbgcolor">
<?php $_from = $this->_tpl_vars['colorArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
<option style="background:<?php echo $this->_tpl_vars['key']; ?>
;color:<?php echo $this->_tpl_vars['row']; ?>
;" value="<?php echo $this->_tpl_vars['key']; ?>
"<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['fck_bgc']): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['key']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
                </select><br />
<?php else: ?>
                <input type="button" onclick="simplePicker.run('fckbgcolor');" value="背景色選択" />
                <input type="text" name="colorBox" id="colorBox">
                <input type="button" onclick="window.document.getElementById('fckbgcolor').value = window.document.getElementById('colorBox').value;" value="色変更" />
<?php endif; ?>
                <?php echo $this->_tpl_vars['sendForm']['htmlComment']['html']; ?>

                <?php endif; ?>
                </td>
            </tr>
<?php if ($this->_tpl_vars['r'] != 5 && $this->_tpl_vars['galsArray']): ?>
            <tr>
                <th>女の子参照　<span class="cap">デコメールに挿入します。　挿入方向→</span></th>
            </tr>
            <tr>
                <td>
                    <div style="height:108px;width:100%;overflow:auto;">
                    <?php $_from = $this->_tpl_vars['galsArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['gals']):
?>
                    <?php if ($this->_tpl_vars['gals']['name'] != ""): ?>
                    <input type="button" value="<?php echo $this->_tpl_vars['gals']['name']; ?>
" style=width:100px;overflow:hidden!important; onclick='fckins("<a href=\"http://www.<?php echo $this->_tpl_vars['domain']; ?>
/shop/girlDetail<?php echo $this->_tpl_vars['key']; ?>
.html\"><?php echo $this->_tpl_vars['gals']['name']; ?>
</a>\n")'>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    </div>
                </td>
            </tr>
<?php else: ?>
<?php if ($this->_tpl_vars['baseTextArea']): ?>
            <tr>
                <th>HTML入力欄　<span class="cap">デコメールに挿入します。　挿入方向→</span></th>
            </tr>
            <tr>
                <td>
                <textarea rows="6" cols="51" name="baseTextArea" id="baseTextArea"></textarea>
                <input type="button" value="更新" onclick="fckHtmlChange(window.document.getElementById('baseTextArea').value)">
                </td>
            </tr>
<?php endif; ?>
<?php endif; ?>
            <tr>
                <th colspan="2">配信条件</th>
            </tr>
            <tr>
                <td  colspan="2">
<?php if ($this->_tpl_vars['r'] == 5): ?>
                    <b><?php echo $this->_tpl_vars['contentsList']; ?>
</b>
<?php if ($this->_tpl_vars['dateList']): ?>
                    　<input type="checkbox" name="reserve" value="1">予約配信
                        <select name="reserveDate">
<?php $_from = $this->_tpl_vars['dateList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
                        <option value="<?php echo $this->_tpl_vars['row']; ?>
"><?php echo $this->_tpl_vars['row']; ?>

<?php endforeach; endif; unset($_from); ?>

                        </select>
                        <select name="reserveTime">
<?php unset($this->_sections['cnt']);
$this->_sections['cnt']['name'] = 'cnt';
$this->_sections['cnt']['start'] = (int)0;
$this->_sections['cnt']['loop'] = is_array($_loop=24) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cnt']['show'] = true;
$this->_sections['cnt']['max'] = $this->_sections['cnt']['loop'];
$this->_sections['cnt']['step'] = 1;
if ($this->_sections['cnt']['start'] < 0)
    $this->_sections['cnt']['start'] = max($this->_sections['cnt']['step'] > 0 ? 0 : -1, $this->_sections['cnt']['loop'] + $this->_sections['cnt']['start']);
else
    $this->_sections['cnt']['start'] = min($this->_sections['cnt']['start'], $this->_sections['cnt']['step'] > 0 ? $this->_sections['cnt']['loop'] : $this->_sections['cnt']['loop']-1);
if ($this->_sections['cnt']['show']) {
    $this->_sections['cnt']['total'] = min(ceil(($this->_sections['cnt']['step'] > 0 ? $this->_sections['cnt']['loop'] - $this->_sections['cnt']['start'] : $this->_sections['cnt']['start']+1)/abs($this->_sections['cnt']['step'])), $this->_sections['cnt']['max']);
    if ($this->_sections['cnt']['total'] == 0)
        $this->_sections['cnt']['show'] = false;
} else
    $this->_sections['cnt']['total'] = 0;
if ($this->_sections['cnt']['show']):

            for ($this->_sections['cnt']['index'] = $this->_sections['cnt']['start'], $this->_sections['cnt']['iteration'] = 1;
                 $this->_sections['cnt']['iteration'] <= $this->_sections['cnt']['total'];
                 $this->_sections['cnt']['index'] += $this->_sections['cnt']['step'], $this->_sections['cnt']['iteration']++):
$this->_sections['cnt']['rownum'] = $this->_sections['cnt']['iteration'];
$this->_sections['cnt']['index_prev'] = $this->_sections['cnt']['index'] - $this->_sections['cnt']['step'];
$this->_sections['cnt']['index_next'] = $this->_sections['cnt']['index'] + $this->_sections['cnt']['step'];
$this->_sections['cnt']['first']      = ($this->_sections['cnt']['iteration'] == 1);
$this->_sections['cnt']['last']       = ($this->_sections['cnt']['iteration'] == $this->_sections['cnt']['total']);
?>
                        <option value="<?php echo $this->_sections['cnt']['index']; ?>
"><?php echo $this->_sections['cnt']['index']; ?>

<?php endfor; endif; ?>

                        </select>時
                    <input type="hidden" name="testSend" value="<?php echo $this->_tpl_vars['test_flg']; ?>
"><input type="hidden" name="decoMail" value="<?php echo $this->_tpl_vars['only_flg']; ?>
">
<?php endif; ?>
<?php else: ?>
<?php $_from = $this->_tpl_vars['contentsArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['contentsName']):
?>
                    <input type="checkbox" name="contents[]" value="<?php echo $this->_tpl_vars['label']; ?>
" /><?php echo $this->_tpl_vars['contentsName']; ?>

<?php endforeach; endif; unset($_from); ?>
                    <input type="checkbox" name="testSend" value="1" checked="checked">テスト送信
                    <?php if ($this->_tpl_vars['decoMailOnly']): ?><input type="hidden" name="decoMail" value="1"><?php else: ?><input type="checkbox" name="decoMail" value="1" checked="checked">デコメール送信<?php endif; ?>
                <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th colspan="2" style="text-align:center;">
                <?php if ($this->_tpl_vars['r'] != 5): ?>
                <?php echo $this->_tpl_vars['sendForm']['seted']['html']; ?>

                <?php else: ?>
                <input type=button name=back value="　戻　る　" onclick="history.back(); return false;">
                <?php endif; ?>
                <?php echo $this->_tpl_vars['sendForm']['sended']['html']; ?>
　
                </th>
            </tr>
            <?php echo $this->_tpl_vars['sendForm']['hidden']; ?>

        </form>
    </table>
<?php if ($this->_tpl_vars['r'] != 5): ?>
<table>
        <form<?php echo $this->_tpl_vars['uploadForm']['attributes']; ?>
>
            <tr>
                <th colspan="4" style="font-size:16px;padding:6px;">添付画像一覧
                <span class="cap">最大サイズは横240縦320です。超えると縮小されます。</span><br>
<?php if ($this->_tpl_vars['historyDisplay']): ?><span class="cap">配信履歴で表示される画像は最新のものになりますが、すでに送信済みのメールの内容は変わりません。</span><br><?php endif; ?>
                <span class="cap">一枚の画像サイズが10,000byte以上だと一部の携帯電話に送信できません。推奨 10,000byte以下</span>
                </th>
            </tr>
<?php $_from = $this->_tpl_vars['imgList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
            <tr>
                <th<?php if ($this->_tpl_vars['ddUpdTag'][$this->_tpl_vars['key']]): ?><?php else: ?> colspan="2"<?php endif; ?>><?php echo $this->_tpl_vars['key']; ?>
</th>
                <td align="center"<?php if ($this->_tpl_vars['key'] > 5): ?>  style="background-color:#ff8844;"<?php endif; ?>>
                <?php if ($this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['name']): ?><a href="/<?php echo $this->_tpl_vars['incFolder']; ?>
/pic.php?t=<?php echo $this->_tpl_vars['tableName']; ?>
&imgId=<?php echo $this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['imageId']; ?>
" target="_blank"><img src="/<?php echo $this->_tpl_vars['incFolder']; ?>
/pic.php?t=<?php echo $this->_tpl_vars['tableName']; ?>
&imgId=<?php echo $this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['imageId']; ?>
&mh=80&mw=120" border="0"><br />image_<?php echo $this->_tpl_vars['domain']; ?>
<?php if ($this->_tpl_vars['shop_id'] > 0): ?>-<?php echo $this->_tpl_vars['shop_id']; ?>
<?php endif; ?>-<?php echo $this->_tpl_vars['chk']; ?>
-<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['ext']; ?>
<br />(<?php echo ((is_array($_tmp=$this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['size'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 byte)</a><?php else: ?>未登録<?php endif; ?>
                </td>
                <?php if ($this->_tpl_vars['ddUpdTag'][$this->_tpl_vars['key']]): ?>
                <td align="center"<?php if ($this->_tpl_vars['key'] > 5): ?>  style="background-color:#ff8844;"<?php endif; ?>>
                    <?php echo $this->_tpl_vars['ddUpdTag'][$this->_tpl_vars['key']]; ?>

                </td>
                <?php endif; ?>
                <td<?php if ($this->_tpl_vars['key'] > 5): ?>  style="background-color:#ff8844;"<?php endif; ?>>
                <?php if ($this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['name']): ?>
	                <?php if ($this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['size'] > 10000): ?><span class="cap">画像サイズが推奨値を超えています。<br />この画像を添付した場合一部の携帯電話は<br />デコメールを受信する事ができません。</span><br /><?php endif; ?>
                    <input onclick='fckins("<img src=\"/<?php echo $this->_tpl_vars['incFolder']; ?>
/pic.php?t=<?php echo $this->_tpl_vars['tableName']; ?>
&imgId=<?php echo $this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['imageId']; ?>
&mh=80&mw=120\" alt=\"image_<?php echo $this->_tpl_vars['domain']; ?>
<?php if ($this->_tpl_vars['shop_id'] > 0): ?>-<?php echo $this->_tpl_vars['shop_id']; ?>
<?php endif; ?>-<?php echo $this->_tpl_vars['chk']; ?>
-<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['ext']; ?>
\"/>")' type="button" value="この画像を挿入"><br />
                    <?php echo $this->_tpl_vars['uploadForm'][$this->_tpl_vars['row']['del']]['html']; ?>
<?php echo $this->_tpl_vars['uploadForm'][$this->_tpl_vars['row']['del']]['label']; ?>
<br />
                <?php endif; ?>
                <?php echo $this->_tpl_vars['uploadForm'][$this->_tpl_vars['row']['file']]['html']; ?>

                <?php if ($this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['name']): ?>
                    <input name="imgId[<?php echo $this->_tpl_vars['key']; ?>
]" type="hidden" value="<?php echo $this->_tpl_vars['imgArray'][$this->_tpl_vars['key']]['imageId']; ?>
" />
                <?php endif; ?>
                </td>
            </tr>
<?php endforeach; endif; unset($_from); ?>
            <tr>
                <td colspan="4"><span class="cap">合計102,400byte以上は一部の携帯電話に送信できません。推奨 102,400byte以下</span><br />合計<?php echo ((is_array($_tmp=$this->_tpl_vars['imgAmountSize'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
byte<?php if ($this->_tpl_vars['imgAmountSize'] >= 102400): ?><br><span class="cap">合計サイズが推奨値を超えています。一部の携帯電話はこのデコメールを受信する事ができません。</span><?php endif; ?></td>
            </tr>
            <tr>
                <th colspan="4" style="text-align:center;"><?php echo $this->_tpl_vars['uploadForm']['uploaded']['html']; ?>
<?php echo $this->_tpl_vars['uploadForm']['deleted']['html']; ?>
</th>
            </tr>
            <?php echo $this->_tpl_vars['uploadForm']['hidden']; ?>


        </form>
    </table>


    <table class="t1">
        <tr>
            <th colspan="5" style="font-size:16px;padding:6px;">送信履歴</th>
        </tr>
        <tr>
            <th nowrap="nowrap">配信日時</th>
            <td width="100%">題名</td>
            <td nowrap="nowrap">モード</td>
            <td nowrap="nowrap">配信先</td>
            <td nowrap="nowrap">状態</td>
        </tr>
        <?php $_from = $this->_tpl_vars['historyList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
        <tr>
            <th nowrap="nowrap"><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['startDateTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d %H:%M") : smarty_modifier_date_format($_tmp, "%m/%d %H:%M")); ?>
　</th>
            <td width="100%">
            <?php if ($this->_tpl_vars['historyDisplay']): ?>
            <a href="#" onclick="window.open('/webAdmin/decoMail/dispMail.php?chk=<?php echo $this->_tpl_vars['key']; ?>
')"><?php echo $this->_tpl_vars['row']['mailSubject']; ?>
</a>
            <?php else: ?>
            <?php echo $this->_tpl_vars['row']['mailSubject']; ?>

            <?php endif; ?>
            </td>
            <td nowrap="nowrap"><?php if (! $this->_tpl_vars['row']['decoMail']): ?>デコメール<?php else: ?>通常メール<?php endif; ?></td>
            <td nowrap="nowrap"><?php if (! $this->_tpl_vars['row']['testSend']): ?>通常送信<?php else: ?>テスト送信<?php endif; ?></td>
            <td nowrap="nowrap"><?php if (! $this->_tpl_vars['row']['state']): ?>送信待<?php else: ?><?php echo $this->_tpl_vars['stateList'][$this->_tpl_vars['row']['state']]; ?>
<?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td colspan="5" style="font-size:16px;padding:6px;"><?php echo $this->_tpl_vars['pageHtml']; ?>
</td>
        </tr>
    </table>
    

    

<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footer_admin, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>