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
    <h3 id="pageTitle">�Ǘ��V�X�e���b{$title}</h3>
    <div class="topUrl"><a href="../" target="_blank">�z�[���y�[�W</a>�b<a href="./">�Ǘ����TOP</a></div>
        <table class="t1" style="width:680px;">
            <tr>
                <th>�\���</th>
                <th>�\�����</th>
                <th>�ڍ�</th>
                <th>�폜</th>
                <th>�m�F</th>
            </tr>
{foreach from=$prtData item=value name=result}
            <tr>
                <td vAlign="middle" width="20%">{$value.regDateTime|date_format:"%y/%m/%d %H:%M"}</td>
                <td vAlign="middle" width="20%">{$value.wantDate}</td>
                <td width="10%"><form action="./recruitAddChange.php" method="post"><input type="submit" name="change" value="�ڍ�"><input type="hidden" name="recruitId" value="{$value.recruitId}"></form></td>
                <td width="10%"><form action="./recruitList.php" method="post"><input type="checkbox" name="delChk" value="{$value.recruitId}"><input type="submit" name="del" value="�폜"><input type="hidden" name="recruitId" value="{$value.recruitId}"></form></td>
                {if $value.chk == 1}<td width="10%" style="background-color:#b0ffff;" >�m�F�ς�</td>{else}<td width="10%" >���m�F</td>{/if}
            </tr>
{/foreach}
{if $pagerLinks.all}
            <tr>
                <td align="center" colSpan="6">{$pagerLinks.all}</td>
            </tr>
{/if}
        </table>
    </div>
    </div>
    

    <div style="position:absolute;left:860px;top:80px;">
	    <iframe name="preview" src="../recruit/?s=1" height="550" width="270"> 
			���̕����� iframe �Ή��̃u���E�U�Ō��Ă��������B
		</iframe>
	</div>
</div>
</body>
</html>
