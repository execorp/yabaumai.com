//�d�v�@���O��fck�G�f�B�^�̔z�u�������g_area_name���O���[�o���Œ�`���鎖

// �Z���N�g���X�g�̏�Ԃ��󂯎��O���[�o���ϐ�
var g_bgcobject = "";
var g_oldvalue = "";

//����@FCK�G�f�B�^�̕\�������̔w�i�F���w�肵���F�ō����ւ���
//���́@�F��(������)
function fckbackgroundchange(selectcolor) {
    // fck_common.js�����O�ɓǂݍ��ޕK�v������
    if ( fckareacheck() ) {
//        if (selectcolor != g_oldvalue) {
            if ( selectcolor.match(/[0-9a-f]{6}/) ) {
                document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0].contentWindow.document.body.style.background='#'+selectcolor;
                if (document.getElementById('colorBox')) {
                    document.getElementById('colorBox').value = selectcolor;
                }
            } else {
                document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0].contentWindow.document.body.style.background=selectcolor;
            }
//            g_oldvalue = selectcolor;
//        }
    }
}
//����@FCK�G�f�B�^�̕\�������̔w�i�F����Ԃɉ����č����ւ���
//���́@�F�̃e�L�X�g�{�b�N�X(�I�u�W�F�N�g)
function selectbgcolor(inputColor) {
    if (typeof(inputColor.value) == 'string') {
        selectcolor = inputColor.value;
    } else {
        selectcolor = inputColor.options[inputColor.selectedIndex].value;
    }
    fckbackgroundchange(selectcolor);
}
//����@selectbgcolor�̒������Ď��N���p�֐�
//���́@�F�̃e�L�X�g�{�b�N�X(�I�u�W�F�N�g)
//���Ӂ@���s���邽�тɎ������g���Ē�`���Ă��܂�
function bgcolorregularity(inputColor) {
    g_bgcobject = inputColor;
    selectbgcolor(g_bgcobject);
    // setViser.js�����O�ɓǂݍ��ޕK�v������
    setViser( "fckareacheck()" , "bgcolorregularity(g_bgcobject)" , 300 );
}
