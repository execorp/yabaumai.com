<?
//�e�T�[�o�[���̐ݒ��ǂݍ���
//�@09/12/11�@ver 1.00�@��{����쐬�iy.takeoka�j
//�@09/12/22�@ver 1.01�@�G���[�\����ʒǉ��Ή��iy.takeoka�j

//�F�؂�����ꍇ�F�؃X�N���v�g��ǂݍ���
/*�@�R�����g�A�E�g�X�C�b�`(�擪��/�̐��Œ��̋L�q�̗L��������؂�ւ���B//*�ŗL���A/*�Ŗ���)
if ($_SERVER['HTTP_USER_AGENT']) {
    require_once(INC_PATH . "auth.php");
}
//*/
//SMARTY�Ǎ�
require_once("/usr/local/lib/php/Smarty/Smarty.class.php");
//PEAR:QuickForm�Ǎ�
require_once("HTML/QuickForm.php");
require_once("HTML/QuickForm/Renderer/ArraySmarty.php");
//�ȉ��A�e��ݒ�
//�h���C����
if (!$domain) {
    $domain = 'exe';
}

//�摜DB���ipic.php�p�j
$imageSetName = 'Deco_mailImage';

//�摜���T�C�Y�ݒ�(imageController.class�p)
$imgMaxWidth = 240;
$imgMaxHeight = 320;
$quality = 100;

//�f�R������1-9(3����{)
$listMax = 3;

//�摜����1-9(5����{)
$imageMax = 5;

//���M��(���M�����Œ肷�鎞�ɐݒ�)
$fromAddress = '';

//���M���[�h(�f�R���[�����M�ɌŒ肷�鎞�ɐݒ�)
$decoMailOnly = '';

//�ύX�ۑ��m�F(HTML��plain�ɕύX���������ꍇ�m�F�_�C�A���O���o�����̐ݒ�)
$htmlSave = '';

//�����m�F(�������瑗�M���e���m�F�ł���悤�ɂ��鎞�ɐݒ�)
$historyDisplay = '1';

//���M�O�m�F(���M����O�Ɋm�F��ʂ�\�����鎞�ɐݒ�)
$makeDisplay = '1';

//�h���b�O�A���h�h���b�v(�h���b�O�A���h�h���b�v�ł̃A�b�v���[�h�^�O��ǉ����鎞�ɐݒ�)
$dragAndDropImageUpload = '';

//�G���[�y�[�W(���̓~�X���ɃG���[�y�[�W��\�����鎞�ɐݒ�)
$errorPage = '1';

//�V���b�vID(�V���b�v���̎��ɐݒ�)
//$gShopId = $sessionArray['S_shopId'];

//�z�M�����z��(�����w��z�M���s�����ɐݒ�)
/*�@�R�����g�A�E�g�X�C�b�`(�擪��/�̐��Œ��̋L�q�̗L��������؂�ւ���B//*�ŗL���A/*�Ŗ���)
$contentsArray = array(
                    'contentsEvent' => '�C�x���g',
                    'contentsFace'  => '�V�l',
                    'contentsCal'   => '�o��'
);
//*/
//���t�z��(�\��z�M���s�����ɐݒ�)
/*�@�R�����g�A�E�g�X�C�b�`(�擪��/�̐��Œ��̋L�q�̗L��������؂�ւ���B//*�ŗL���A/*�Ŗ���)
for ($i = 0; $i < 7; $i++) {
    $dateList[] = date("Y/m/d", mktime(0, 0, 0, date('m'), date('d') + $i, date('Y')));
}
//*/
//���j���[�Ǎ�(�s�v�Ȃ�R�����g�A�E�g)
/*�@�R�����g�A�E�g�X�C�b�`(�擪��/�̐��Œ��̋L�q�̗L��������؂�ւ���B//*�ŗL���A/*�Ŗ���)
if (!$siteName) {
    $siteName = '�G�O�[';
}
require_once($basePath . "../menu.php");
//*/
?>
