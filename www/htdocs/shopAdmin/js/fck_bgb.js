//�d�v�@���O��fck�G�f�B�^�̔z�u�������g_area_name���O���[�o���Œ�`���鎖

//�����F�w��p�O���[�o���ϐ�
var g_strcobject = "";

//����@fckeditor�̓��͗��̔w�i���Œ肷��
//���Ӂ@���s���邽�тɎ������g���Ē�`���Ă��܂�
//�@�@�@�F�𒼐ڎw�肵�Ă��܂��Bg_bgcobject�ɂ��F�����ړ���܂��B
function bgcolorone(colorstr) {
    g_bgcobject = colorstr;
    fckbackgroundchange(colorstr);
    // setViser.js�����O�ɓǂݍ��ޕK�v������
    setViser( "fckareacheck()" , "bgcolorone(g_bgcobject)" , 300 );
}

function strcolorone(colorstr) {
    g_strcobject = colorstr;
    fckfontcolorchange(colorstr);
    // setViser.js�����O�ɓǂݍ��ޕK�v������
    setViser( "fckareacheck()" , "strcolorone(g_strcobject)" , 300 );
}

//����@FCK�G�f�B�^�̃f�t�H���g�����F���w�肵���F�ō����ւ���
//���́@�F��(������)
function fckfontcolorchange(selectcolor) {
    // fck_common.js�����O�ɓǂݍ��ޕK�v������
    if ( fckareacheck() ) {
        document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0].contentWindow.document.body.style.color=selectcolor;
    }
}
