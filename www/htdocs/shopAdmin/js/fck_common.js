//�d�v�@���O��fck�G�f�B�^�̔z�u�������g_area_name���O���[�o���Œ�`���鎖

//����@FCK�G�f�B�^�̕\��������HTML�ҏW���[�h���ۂ��𒲂ׂ�
//�o�́@�^�U
function fckareacheck(){
    if (document.getElementById(g_area_name + '___Frame') && 
        "contentWindow" in document.getElementById(g_area_name + '___Frame') &&
        document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea')  &&
        document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0] && 
        "contentWindow" in document.getElementById(g_area_name+'___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0]) {
        result = true;
    } else {
        result = false;
    }
    return result;
}
