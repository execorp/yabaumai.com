<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=shift_jis" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: {$domain} :::</title>
<link href="../css/adminStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/comDeco.css" rel="stylesheet" type="text/css" media="all" />
{$form.javascript}
</head>
<body id="adminBase">
<div id="outline">
{$menu}
    <div id="contents">
    <h3 id="pageTitle">�Ǘ��V�X�e���b{$contName}</h3>
    <div class="topUrl"><a href="../" target="_blank">�z�[���y�[�W</a>�b<a href="./">�Ǘ����TOP</a></div>
    
{if !$r}<div class="massage">
{$contName}�����ʕύX�E�\���ύX�E�폜���܂��B�����������摜�f�[�^���E����C�ӂ̑�����s���ĉ������B<br />
���摜�T�C�Y�́y��510px �c370px�z�ŕ\������܂��B<br />
���o�^����Ă���摜�̒����烉���_����ENTER�y�[�W�ɕ\������܂��B<br />
</div>{/if}
{if $r == 1}<div class="massage">{$contName}�̓o�^���������܂����B</div>{/if}
{if $r == 2}<div class="massage">{$contName}�̏C�����������܂����B</div>{/if}
{if $r == 3}<div class="massage">{$contName}�̍폜���������܂����B</div>{/if}
        <table class="t1">
            <tr>
                <th style="text-align:center;" nowrap="nowrap">No</th>
                <th style="text-align:center;" width="100%">�G���A�� / �X�ܖ� / ���̎q��</th>
                <th style="text-align:center;" nowrap="nowrap">�摜</th>
<!--
                <th style="text-align:center;" nowrap="nowrap">����</th>
-->
                <th style="text-align:center;" nowrap="nowrap">�\��</th>
                <th style="text-align:center;" nowrap="nowrap">�C��</th>
                <th style="text-align:center;" nowrap="nowrap">�폜</th>
            </tr>
{foreach from=$prtMySQLResult item=value name=result}
            <tr>
                <td{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>{if $value.prtFlg == 1}�\��{else}{$smarty.foreach.result.iteration}{/if}</td>
                <td{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if} align="center" valign="middle"><font color="#ff0000">[{$value.areaName}]</font><br /><font color="#0000ff"><i>{$value.shopName}</i></font><br /><b>{$value.galName}</b></td>
				<td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>{if $value.file}<a href="../inc/thumb.php?imgId={$value.imgId}&t=coverImage&mh=140&mw=190" target="_blank"><img src="../inc/thumb.php?imgId={$value.imgId}&t=coverImage&mh=70&mw=95" border="0" /></a>{/if}</td>
<!--
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>{if $value.priority != $MyCount }<a href="./coverList.php?t=d&p={$value.priority}&imgId={$value.imgId}&ls={$ls}">��</a>{/if}{if $value.priority > 1 }<a href="./coverList.php?t=u&p={$value.priority}&imgId={$value.imgId}&ls={$ls}">��</a>{/if}</td>
-->
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>
                	<form action="./coverList.php" method="post">
	                    <input type="radio" name="prtFlg" value="0"{if $value.prtFlg == 0} checked{/if}>�\��<br />
	                    <input type="radio" name="prtFlg" value="1"{if $value.prtFlg == 1} checked{/if}>��\��<br />
	                    <input type="submit" name="changed" value="�ύX">
                        <input type="hidden" name="imgId" value="{$value.imgId}">
                    </form>
                </td>

                
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>
                	<form action="./coverAddChange.php" method="post">
	                    <input type="submit" name="changed" value="�C��">
                        <input type="hidden" name="imgId" value="{$value.imgId}">
                    </form>
                </td>
                <td nowrap="nowrap"{if $value.prtFlg == 1} style="background-color:#cccccc;"{/if}>
                    <form action="./coverList.php" method="post">
                        <input type="checkbox" name="delChk" value="{$value.imgId}"><br />
                        <input type="submit" name="del" value="�폜">
                        <input type="hidden" name="imgId" value="{$value.imgId}">
                    </form>
                </td>
            </tr>
{/foreach}
{if $pagerLinks.all}
            <tr>
                <td align="center" colSpan="9">{$pagerLinks.all}</td>
            </tr>
{/if}
        </table>
    </div>
    </div>
</div>
</body>
</html>