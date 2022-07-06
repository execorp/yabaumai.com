{include file=$smarty.const.header_admin}
{$jsInclude}
<div class="massage">
テスト送信にチェックを入れると テストメールに設定したアドレスだけに届きます。<br>
通常メールはデコメールに対応していないキャリア(PCメール含む)向けの内容になります。<br>
{if $galsArray}{literal}女の子参照ボタンはデコメールにリンクを挿入するためのボタンです。{/literal}<br>{/if}
{if $decoMailOnly}{else}デコメール送信のチェックを外すと 全ての宛先に通常メールが届きます。<br>{/if}
{if $sendForm.errors}
    {foreach from=$sendForm.errors item=error}
    {$error}<br/>
    {/foreach}
{/if}
{if $r == 1}*登録が完了しました。{/if}
{if $r == 2}*送信を開始しました。送信完了まで数分必要です。<br>※完了まで画像は変更しないでください。{/if}
{if $r == 3}*画像のアップロードが完了しました。{/if}
{if $r == 4}*画像の削除が完了しました。{/if}
{if $r == 5}*送信条件と件数を確認した後、登録して送信を押して下さい。{/if}
{if $r == 6}*通常メール と デコメール の合計が長すぎます。{/if}
{if $r == 7}*添付画像一覧以外の画像が挿入されています。{/if}
{if $r == 8}*通常メール か デコメール のいずれか一つは入力して下さい。{/if}
{if $r == 9}*送信元や件名は必ず入力して下さい。{/if}
</div>

    <table class="t1">
        <form{$sendForm.attributes}>
{if $r != 5}
            <tr>
                <th colspan="2" style="font-size:12px;text-align:center;">登録[{$chk}]</th>
            </tr>
            <tr>
                <td colspan="2" align="center" >
{section name=cnt start=1 loop=$listMax}
                    <a href="{$php_self}?chk={$smarty.section.cnt.index}">登録[{$smarty.section.cnt.index}]</a>　
{/section} 
                </td>
            </tr>
{/if}
            <tr>
                <th>{$sendForm.from.label}{if $sendFromData == ""}　<span class="cap">例：info@{$domain}</span>{/if}
                </th>
                <td >
{if $sendFromData != ""}
                {$sendFromData}
{else}
                {$sendForm.from.html}
{/if}
                </td>
            </tr>
            <tr>
                <th>{$sendForm.subject.label}&nbsp;<span class="cap">※必{literal}須{/literal}</span></th>
                <td >
                {if $r == 5}
                {$subject_str}
                {else}
                {$sendForm.subject.html}
                {/if}
                </td>
            </tr>
            <tr>
                <th colspan="2">{literal}本文{/literal}</th>
            </tr>
                {if $r == 5}
            <tr>
                <th>{literal}非対応携帯向け本文{/literal}</th>
                <th>{literal}デコメール対応機種向け本文{/literal}</th>
            </tr>
                {/if}
            <tr>
                <td>
                {if $r == 5}
                {$plainComment_str}
                {else}
                <b>{$sendForm.plainComment.label} >></b><br />{$sendForm.plainComment.html}
                {/if}
                </td>
                {if $r == 5}
                <td width="240" style="background:{$fck_bgc}">
                {$htmlComment_str}
                {else}
                {if $galsArray || $baseTextArea}
                <td style="text-align:center;" rowspan="3">
                {else}
                <td style="text-align:center;">
                {/if}
                <b>{$sendForm.htmlComment.label} >></b><br />
                背景色：
{if $colorArray}
<select onchange="selectbgcolor(this)" id="fckbgcolor" name="fckbgcolor">
{foreach from=$colorArray key=key item=row}
<option style="background:{$key};color:{$row};" value="{$key}"{if $key == $fck_bgc }selected=selected{/if}>{$key}</option>
{/foreach}
                </select><br />
{else}
                <input type="button" onclick="simplePicker.run('fckbgcolor');" value="背景色選択" />
                <input type="text" name="colorBox" id="colorBox">
                <input type="button" onclick="window.document.getElementById('fckbgcolor').value = window.document.getElementById('colorBox').value;" value="色変更" />
{/if}
                {$sendForm.htmlComment.html}
                {/if}
                </td>
            </tr>
{if $r != 5 && $galsArray}
            <tr>
                <th>女の子参照　<span class="cap">デコメールに挿入します。　挿入方向→</span></th>
            </tr>
            <tr>
                <td>
                    <div style="height:108px;width:100%;overflow:auto;">
                    {foreach from=$galsArray key=key item=gals}
                    {if $gals.name != ""}
                    <input type="button" value="{$gals.name}" style=width:100px;overflow:hidden!important; onclick='fckins("<a href=\"http://www.{$domain}/shop/girlDetail{$key}.html\">{$gals.name}</a>\n")'>
                    {/if}
                    {/foreach}
                    </div>
                </td>
            </tr>
{else}
{if $baseTextArea}
            <tr>
                <th>HTML入力欄　<span class="cap">デコメールに挿入します。　挿入方向→</span></th>
            </tr>
            <tr>
                <td>
                <textarea rows="6" cols="51" name="baseTextArea" id="baseTextArea"></textarea>
                <input type="button" value="更新" onclick="fckHtmlChange(window.document.getElementById('baseTextArea').value)">
                </td>
            </tr>
{/if}
{/if}
            <tr>
                <th colspan="2">配信条件</th>
            </tr>
            <tr>
                <td  colspan="2">
{if $r == 5}
                    <b>{$contentsList}</b>
{if $dateList}
                    　<input type="checkbox" name="reserve" value="1">予約配信
                        <select name="reserveDate">
{foreach from=$dateList key=key item=row}
                        <option value="{$row}">{$row}
{/foreach}

                        </select>
                        <select name="reserveTime">
{section name=cnt start=0 loop=24}
                        <option value="{$smarty.section.cnt.index}">{$smarty.section.cnt.index}
{/section}

                        </select>時
                    <input type="hidden" name="testSend" value="{$test_flg}"><input type="hidden" name="decoMail" value="{$only_flg}">
{/if}
{else}
{foreach from=$contentsArray key=label item=contentsName}
                    <input type="checkbox" name="contents[]" value="{$label}" />{$contentsName}
{/foreach}
                    <input type="checkbox" name="testSend" value="1" checked="checked">テスト送信
                    {if $decoMailOnly}<input type="hidden" name="decoMail" value="1">{else}<input type="checkbox" name="decoMail" value="1" checked="checked">デコメール送信{/if}
                {/if}
                </td>
            </tr>
            <tr>
                <th colspan="2" style="text-align:center;">
                {if $r != 5}
                {$sendForm.seted.html}
                {else}
                <input type=button name=back value="　戻　る　" onclick="history.back(); return false;">
                {/if}
                {$sendForm.sended.html}　
                </th>
            </tr>
            {$sendForm.hidden}
        </form>
    </table>
{if $r != 5}
<table>
        <form{$uploadForm.attributes}>
            <tr>
                <th colspan="4" style="font-size:16px;padding:6px;">添付画像一覧
                <span class="cap">最大サイズは横240縦320です。超えると縮小されます。</span><br>
{if $historyDisplay}<span class="cap">配信履歴で表示される画像は最新のものになりますが、すでに送信済みのメールの内容は変わりません。</span><br>{/if}
                <span class="cap">一枚の画像サイズが10,000byte以上だと一部の携帯電話に送信できません。推奨 10,000byte以下</span>
                </th>
            </tr>
{foreach from=$imgList key=key item=row}
            <tr>
                <th{if $ddUpdTag[$key]}{else} colspan="2"{/if}>{$key}</th>
                <td align="center"{if $key > 5}  style="background-color:#ff8844;"{/if}>
                {if $imgArray[$key].name}<a href="/{$incFolder}/pic.php?t={$tableName}&imgId={$imgArray[$key].imageId}" target="_blank"><img src="/{$incFolder}/pic.php?t={$tableName}&imgId={$imgArray[$key].imageId}&mh=80&mw=120" border="0"><br />image_{$domain}{if $shop_id > 0}-{$shop_id}{/if}-{$chk}-{$key}{$imgArray[$key].ext}<br />({$imgArray[$key].size|number_format} byte)</a>{else}未登録{/if}
                </td>
                {if $ddUpdTag[$key]}
                <td align="center"{if $key > 5}  style="background-color:#ff8844;"{/if}>
                    {$ddUpdTag[$key]}
                </td>
                {/if}
                <td{if $key > 5}  style="background-color:#ff8844;"{/if}>
                {if $imgArray[$key].name}
	                {if $imgArray[$key].size > 10000}<span class="cap">画像サイズが推奨値を超えています。<br />この画像を添付した場合一部の携帯電話は<br />デコメールを受信する事ができません。</span><br />{/if}
                    <input onclick='fckins("<img src=\"/{$incFolder}/pic.php?t={$tableName}&imgId={$imgArray[$key].imageId}&mh=80&mw=120\" alt=\"image_{$domain}{if $shop_id > 0}-{$shop_id}{/if}-{$chk}-{$key}{$imgArray[$key].ext}\"/>")' type="button" value="この画像を挿入"><br />
                    {$uploadForm[$row.del].html}{$uploadForm[$row.del].label}<br />
                {/if}
                {$uploadForm[$row.file].html}
                {if $imgArray[$key].name}
                    <input name="imgId[{$key}]" type="hidden" value="{$imgArray[$key].imageId}" />
                {/if}
                </td>
            </tr>
{/foreach}
            <tr>
                <td colspan="4"><span class="cap">合計102,400byte以上は一部の携帯電話に送信できません。推奨 102,400byte以下</span><br />合計{$imgAmountSize|number_format}byte{if $imgAmountSize >= 102400 }<br><span class="cap">合計サイズが推奨値を超えています。一部の携帯電話はこのデコメールを受信する事ができません。</span>{/if}</td>
            </tr>
            <tr>
                <th colspan="4" style="text-align:center;">{$uploadForm.uploaded.html}{$uploadForm.deleted.html}</th>
            </tr>
            {$uploadForm.hidden}

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
        {foreach from=$historyList key=key item=row}
        <tr>
            <th nowrap="nowrap">{$row.startDateTime|date_format:"%m/%d %H:%M"}　</th>
            <td width="100%">
            {if $historyDisplay}
            <a href="#" onclick="window.open('/webAdmin/decoMail/dispMail.php?chk={$key}')">{$row.mailSubject}</a>
            {else}
            {$row.mailSubject}
            {/if}
            </td>
            <td nowrap="nowrap">{if !$row.decoMail}デコメール{else}通常メール{/if}</td>
            <td nowrap="nowrap">{if !$row.testSend}通常送信{else}テスト送信{/if}</td>
            <td nowrap="nowrap">{if !$row.state}送信待{else}{$stateList[$row.state]}{/if}</td>
        </tr>
        {/foreach}
        <tr>
            <td colspan="5" style="font-size:16px;padding:6px;">{$pageHtml}</td>
        </tr>
    </table>
    

    

{/if}
{include file=$smarty.const.footer_admin}
