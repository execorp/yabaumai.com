{include file=$smarty.const.header_admin}
{$jsInclude}
<div class="massage">
�e�X�g���M�Ƀ`�F�b�N������� �e�X�g���[���ɐݒ肵���A�h���X�����ɓ͂��܂��B<br>
�ʏ탁�[���̓f�R���[���ɑΉ����Ă��Ȃ��L�����A(PC���[���܂�)�����̓��e�ɂȂ�܂��B<br>
{if $galsArray}{literal}���̎q�Q�ƃ{�^���̓f�R���[���Ƀ����N��}�����邽�߂̃{�^���ł��B{/literal}<br>{/if}
{if $decoMailOnly}{else}�f�R���[�����M�̃`�F�b�N���O���� �S�Ă̈���ɒʏ탁�[�����͂��܂��B<br>{/if}
{if $sendForm.errors}
    {foreach from=$sendForm.errors item=error}
    {$error}<br/>
    {/foreach}
{/if}
{if $r == 1}*�o�^���������܂����B{/if}
{if $r == 2}*���M���J�n���܂����B���M�����܂Ő����K�v�ł��B<br>�������܂ŉ摜�͕ύX���Ȃ��ł��������B{/if}
{if $r == 3}*�摜�̃A�b�v���[�h���������܂����B{/if}
{if $r == 4}*�摜�̍폜���������܂����B{/if}
{if $r == 5}*���M�����ƌ������m�F������A�o�^���đ��M�������ĉ������B{/if}
{if $r == 6}*�ʏ탁�[�� �� �f�R���[�� �̍��v���������܂��B{/if}
{if $r == 7}*�Y�t�摜�ꗗ�ȊO�̉摜���}������Ă��܂��B{/if}
{if $r == 8}*�ʏ탁�[�� �� �f�R���[�� �̂����ꂩ��͓��͂��ĉ������B{/if}
{if $r == 9}*���M���⌏���͕K�����͂��ĉ������B{/if}
</div>

    <table class="t1">
        <form{$sendForm.attributes}>
{if $r != 5}
            <tr>
                <th colspan="2" style="font-size:12px;text-align:center;">�o�^[{$chk}]</th>
            </tr>
            <tr>
                <td colspan="2" align="center" >
{section name=cnt start=1 loop=$listMax}
                    <a href="{$php_self}?chk={$smarty.section.cnt.index}">�o�^[{$smarty.section.cnt.index}]</a>�@
{/section} 
                </td>
            </tr>
{/if}
            <tr>
                <th>{$sendForm.from.label}{if $sendFromData == ""}�@<span class="cap">��Finfo@{$domain}</span>{/if}
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
                <th>{$sendForm.subject.label}&nbsp;<span class="cap">���K{literal}�{{/literal}</span></th>
                <td >
                {if $r == 5}
                {$subject_str}
                {else}
                {$sendForm.subject.html}
                {/if}
                </td>
            </tr>
            <tr>
                <th colspan="2">{literal}�{��{/literal}</th>
            </tr>
                {if $r == 5}
            <tr>
                <th>{literal}��Ή��g�ь����{��{/literal}</th>
                <th>{literal}�f�R���[���Ή��@������{��{/literal}</th>
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
                �w�i�F�F
{if $colorArray}
<select onchange="selectbgcolor(this)" id="fckbgcolor" name="fckbgcolor">
{foreach from=$colorArray key=key item=row}
<option style="background:{$key};color:{$row};" value="{$key}"{if $key == $fck_bgc }selected=selected{/if}>{$key}</option>
{/foreach}
                </select><br />
{else}
                <input type="button" onclick="simplePicker.run('fckbgcolor');" value="�w�i�F�I��" />
                <input type="text" name="colorBox" id="colorBox">
                <input type="button" onclick="window.document.getElementById('fckbgcolor').value = window.document.getElementById('colorBox').value;" value="�F�ύX" />
{/if}
                {$sendForm.htmlComment.html}
                {/if}
                </td>
            </tr>
{if $r != 5 && $galsArray}
            <tr>
                <th>���̎q�Q�Ɓ@<span class="cap">�f�R���[���ɑ}�����܂��B�@�}��������</span></th>
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
                <th>HTML���͗��@<span class="cap">�f�R���[���ɑ}�����܂��B�@�}��������</span></th>
            </tr>
            <tr>
                <td>
                <textarea rows="6" cols="51" name="baseTextArea" id="baseTextArea"></textarea>
                <input type="button" value="�X�V" onclick="fckHtmlChange(window.document.getElementById('baseTextArea').value)">
                </td>
            </tr>
{/if}
{/if}
            <tr>
                <th colspan="2">�z�M����</th>
            </tr>
            <tr>
                <td  colspan="2">
{if $r == 5}
                    <b>{$contentsList}</b>
{if $dateList}
                    �@<input type="checkbox" name="reserve" value="1">�\��z�M
                        <select name="reserveDate">
{foreach from=$dateList key=key item=row}
                        <option value="{$row}">{$row}
{/foreach}

                        </select>
                        <select name="reserveTime">
{section name=cnt start=0 loop=24}
                        <option value="{$smarty.section.cnt.index}">{$smarty.section.cnt.index}
{/section}

                        </select>��
                    <input type="hidden" name="testSend" value="{$test_flg}"><input type="hidden" name="decoMail" value="{$only_flg}">
{/if}
{else}
{foreach from=$contentsArray key=label item=contentsName}
                    <input type="checkbox" name="contents[]" value="{$label}" />{$contentsName}
{/foreach}
                    <input type="checkbox" name="testSend" value="1" checked="checked">�e�X�g���M
                    {if $decoMailOnly}<input type="hidden" name="decoMail" value="1">{else}<input type="checkbox" name="decoMail" value="1" checked="checked">�f�R���[�����M{/if}
                {/if}
                </td>
            </tr>
            <tr>
                <th colspan="2" style="text-align:center;">
                {if $r != 5}
                {$sendForm.seted.html}
                {else}
                <input type=button name=back value="�@�߁@��@" onclick="history.back(); return false;">
                {/if}
                {$sendForm.sended.html}�@
                </th>
            </tr>
            {$sendForm.hidden}
        </form>
    </table>
{if $r != 5}
<table>
        <form{$uploadForm.attributes}>
            <tr>
                <th colspan="4" style="font-size:16px;padding:6px;">�Y�t�摜�ꗗ
                <span class="cap">�ő�T�C�Y�͉�240�c320�ł��B������Ək������܂��B</span><br>
{if $historyDisplay}<span class="cap">�z�M�����ŕ\�������摜�͍ŐV�̂��̂ɂȂ�܂����A���łɑ��M�ς݂̃��[���̓��e�͕ς��܂���B</span><br>{/if}
                <span class="cap">�ꖇ�̉摜�T�C�Y��10,000byte�ȏゾ�ƈꕔ�̌g�ѓd�b�ɑ��M�ł��܂���B���� 10,000byte�ȉ�</span>
                </th>
            </tr>
{foreach from=$imgList key=key item=row}
            <tr>
                <th{if $ddUpdTag[$key]}{else} colspan="2"{/if}>{$key}</th>
                <td align="center"{if $key > 5}  style="background-color:#ff8844;"{/if}>
                {if $imgArray[$key].name}<a href="/{$incFolder}/pic.php?t={$tableName}&imgId={$imgArray[$key].imageId}" target="_blank"><img src="/{$incFolder}/pic.php?t={$tableName}&imgId={$imgArray[$key].imageId}&mh=80&mw=120" border="0"><br />image_{$domain}{if $shop_id > 0}-{$shop_id}{/if}-{$chk}-{$key}{$imgArray[$key].ext}<br />({$imgArray[$key].size|number_format} byte)</a>{else}���o�^{/if}
                </td>
                {if $ddUpdTag[$key]}
                <td align="center"{if $key > 5}  style="background-color:#ff8844;"{/if}>
                    {$ddUpdTag[$key]}
                </td>
                {/if}
                <td{if $key > 5}  style="background-color:#ff8844;"{/if}>
                {if $imgArray[$key].name}
	                {if $imgArray[$key].size > 10000}<span class="cap">�摜�T�C�Y�������l�𒴂��Ă��܂��B<br />���̉摜��Y�t�����ꍇ�ꕔ�̌g�ѓd�b��<br />�f�R���[������M���鎖���ł��܂���B</span><br />{/if}
                    <input onclick='fckins("<img src=\"/{$incFolder}/pic.php?t={$tableName}&imgId={$imgArray[$key].imageId}&mh=80&mw=120\" alt=\"image_{$domain}{if $shop_id > 0}-{$shop_id}{/if}-{$chk}-{$key}{$imgArray[$key].ext}\"/>")' type="button" value="���̉摜��}��"><br />
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
                <td colspan="4"><span class="cap">���v102,400byte�ȏ�͈ꕔ�̌g�ѓd�b�ɑ��M�ł��܂���B���� 102,400byte�ȉ�</span><br />���v{$imgAmountSize|number_format}byte{if $imgAmountSize >= 102400 }<br><span class="cap">���v�T�C�Y�������l�𒴂��Ă��܂��B�ꕔ�̌g�ѓd�b�͂��̃f�R���[������M���鎖���ł��܂���B</span>{/if}</td>
            </tr>
            <tr>
                <th colspan="4" style="text-align:center;">{$uploadForm.uploaded.html}{$uploadForm.deleted.html}</th>
            </tr>
            {$uploadForm.hidden}

        </form>
    </table>


    <table class="t1">
        <tr>
            <th colspan="5" style="font-size:16px;padding:6px;">���M����</th>
        </tr>
        <tr>
            <th nowrap="nowrap">�z�M����</th>
            <td width="100%">�薼</td>
            <td nowrap="nowrap">���[�h</td>
            <td nowrap="nowrap">�z�M��</td>
            <td nowrap="nowrap">���</td>
        </tr>
        {foreach from=$historyList key=key item=row}
        <tr>
            <th nowrap="nowrap">{$row.startDateTime|date_format:"%m/%d %H:%M"}�@</th>
            <td width="100%">
            {if $historyDisplay}
            <a href="#" onclick="window.open('/webAdmin/decoMail/dispMail.php?chk={$key}')">{$row.mailSubject}</a>
            {else}
            {$row.mailSubject}
            {/if}
            </td>
            <td nowrap="nowrap">{if !$row.decoMail}�f�R���[��{else}�ʏ탁�[��{/if}</td>
            <td nowrap="nowrap">{if !$row.testSend}�ʏ푗�M{else}�e�X�g���M{/if}</td>
            <td nowrap="nowrap">{if !$row.state}���M��{else}{$stateList[$row.state]}{/if}</td>
        </tr>
        {/foreach}
        <tr>
            <td colspan="5" style="font-size:16px;padding:6px;">{$pageHtml}</td>
        </tr>
    </table>
    

    

{/if}
{include file=$smarty.const.footer_admin}
