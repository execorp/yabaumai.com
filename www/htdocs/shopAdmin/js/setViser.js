// �Ď��^�C�}�[
var g_IdViser = new Array();
// �Ď��ԍ�
var g_NumViser = 0;

//����@����I�ɃX�N���v�g�����s����
//���́@����(����֐�)�A���s�֐�(�֐�)�A�~���b�Ŏw�肷��҂�����(����)
function setViser( cond , funcCall , timeVise){
    // ���������������΁A�^�C�}�[���N���A���Ċ֐����Ăяo��
    strFunc = "" +
          "if(" + cond +"){ " + 
          "clearInterval(g_IdViser[" + g_NumViser + "]);" 
          + funcCall + ";" + 
          "}";
    // �Ď��^�C�}�[���Z�b�g����
    g_IdViser[g_NumViser] = setInterval( strFunc , timeVise);
    g_NumViser++;
}
