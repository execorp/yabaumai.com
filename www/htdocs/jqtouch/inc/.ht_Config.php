<?
/* -------------------------------------------------------------------------------------- */
//  �ݒ��ύX���Ȃ��Ƃ����Ȃ��ӏ�
//  /webAdmin/mm/errorMailChecker.php �� php �p�X
//  /webAdmin/mm/errorMailChecker.php �� config.php �p�X
//
//  ���L�C���N���[�h�p�X
/* -------------------------------------------------------------------------------------- */

//�X�V������ݒ�
define ("JET_LAG", 6 );

define ("FILE_PATH", "/home/hakui-angel/www/files/" );
define ("ROOT_PATH", "/home/hakui-angel/www/htdocs/" );
define ("PUBLIC_HTML", "http://www.hakui-angel.com/" );
require_once( ROOT_PATH ."inc/.ht_DBConnect.inc" );
require_once( "DB.php" );
require_once( '/usr/local/lib/php/Smarty/Smarty.class.php' );

//�E�҃A�N�Z�X��͗p�^�O�Ǎ�
require_once( "ninjaTag.php" );

$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

//�E�N���b�N�֎~�ݒ�擾
$rightClick = $db->getOne("SELECT `settingValue` FROM `setting` WHERE `settingName` = ?", array('rightClickFlg'));
define ( 'RIGHT_CLICK_BAN', $rightClick );

/* --- ���O�C���p --- */
$cookieLimit = 3600 * 24 * 30;

$levelArray = array(
     0 => 'exe��p' , 
     1 => '�㗝�X' , 
     2 => '�X�[�p�[���[�U�[' , 
     3 => '����' , 
     4 => '�ʏ�' 
);

//exe��p�ύX��IP
$ipArrowListArray = array(
    "211.132.41.217" , 
    "59.190.117.210" , 
);

$domain   = "hakui-angel.com";
define ( domain, $domain );
$siteName = "�L�� ���߂̓V�g�̃A���o�C�g";
define ( siteName, $siteName );

$shopTenpo1 = "�L�� ���߂̓V�g�̃A���o�C�g";
define ( shopTenpo1, $shopTenpo1 );
$shopTel1 = "082-504-6669";
define ( shopTel1, $shopTel1 );

/*
$shopTenpo2 = "���É�";
define ( shopTenpo2, $shopTenpo2 );
$shopTel2 = "052-981-4441";
define ( shopTel2, $shopTel2 );

$shopTenpo3 = "�ÁE����";
define ( shopTenpo3, $shopTenpo3 );
$shopTel3 = "059-235-2552";
define ( shopTel3, $shopTel3 );

$shopTenpo4 = "��";
define ( shopTenpo4, $shopTenpo4 );
$shopTel4 = "058-268-8585";
define ( shopTel4, $shopTel4 );
*/

define ( 'shopTenpo', shopTenpo1 );
define ( 'shopTel', shopTel1 );

$shopMail = "info@" . $domain;
define ( shopMail, $shopMail );

/* --- keywords�Edescription�p --- */
$title   = "�L�� ���� �f���o���[�w���X " . $siteName . "";
define ( title, $title );
$titleM   = "�L�� ���� �����ذ�ٽ " . $siteName;
define ( titleM, $titleM );

$keywords   = "�L�� ���� �f���o���[�w���X," . $siteName . ",�f�l���,�f���w��,�f���o���[�w���X";
define ( keywords, $keywords );
$description   = "�L�� �f���o���[�w���X������" . $siteName . "�������p���������B";
define ( description, $description );
$Author   = "�L�� �f���o���[�w���X �����b" . $siteName . "";
define ( Author, $Author );
$owner   = "�L�� �f���o���[�w���X  �����b" . $siteName . "";
define ( owner, $owner );
$classification   = "�L�� �f���o���[�w���X �����b" . $siteName . "";
define ( classification, $classification );

/* --- copyright�p --- */
$copyright   = "Copyright2010(C) HAKUI-ANGEL.COM All Right Reserved.";
define ( copyright, $copyright );

/* --- header�Efooter�p(PC) --- */
$header_pc = ROOT_PATH . 'templates/header.tpl';
define ( header_pc, $header_pc );
$footer_pc = ROOT_PATH . 'templates/footer.tpl';
define ( footer_pc, $footer_pc );
$ninja_pc = ROOT_PATH . 'templates/ninja.tpl';
define ( ninja_pc, $ninja_pc );

/* --- header�Efooter�p(�g��) --- */
$header_mobile = ROOT_PATH . 'templates/headerM.tpl';
define ( header_mobile, $header_mobile );
$footer_mobile = ROOT_PATH . 'templates/footerM.tpl';
define ( footer_mobile, $footer_mobile );
$ninja_mobile = ROOT_PATH . 'templates/ninjaM.tpl';
define ( ninja_mobile, $ninja_mobile );

/* --- �J���[�R�[�h�p(�g��) --- */
define ("COLOR_BG_BASE", '#ffffff' ); //��{�w�i�F
define ("COLOR_TEXT_BASE", '#CF0002' ); //��{�����F
define ("COLOR_LINK_BASE", '#F590A3' ); //��{�����N�����F
define ("COLOR_LINK_DARK", '#9d000c' ); //�w�i���Z���Ƃ��p�����N�����F
define ("COLOR_VLINK_BASE", COLOR_LINK_BASE ); //�K��σ����N�����F
	
define ("COLOR_BG_H1", '#e60012' ); //�匩�o���w�i�F
define ("COLOR_BG_H2", '#e4e4e4' ); //�����o���w�i�F
define ("COLOR_BG_H3", '#575757' ); //�����o���w�i�F
define ("COLOR_BG_COMMENT", '#e6e0d4' ); //�R�����g�w�i�F
define ("COLOR_BG_MENU1", '#DDE6F7' ); //���j���[�w�i�F�@
define ("COLOR_BG_MENU2", '#F7DEFE' ); //���j���[�w�i�F�A
	
define ("COLOR_TEXT_H1", '#ffffff' ); //�匩�o�������F
define ("COLOR_TEXT_H2", '#FF99CC' ); //�����o�������F
define ("COLOR_TEXT_H3", '#FF99CC' ); //�����o�������F
define ("COLOR_TEXT_COMMENT", '#f2c861' ); //�R�����g�����F
define ("COLOR_TEXT_MENU1", '#ff0000' ); //���j���[�����F�@
define ("COLOR_TEXT_MENU2", '#ff0000' ); //���j���[�����F�A

define ("COLOR_FONT_H1", COLOR_TEXT_H1 ); //�匩�o�������F
define ("COLOR_FONT_H2", COLOR_TEXT_H2 ); //�����o�������F
define ("COLOR_FONT_H3", COLOR_TEXT_H3 ); //�����o�������F
define ("COLOR_FONT_COMMENT", COLOR_TEXT_COMMENT ); //�R�����g�����F
define ("COLOR_FONT_MENU1", COLOR_TEXT_MENU1 ); //���j���[�����F�@
define ("COLOR_FONT_MENU2", COLOR_TEXT_MENU2 ); //���j���[�����F�A

define ("COLOR_LINE_BASE", '#e60012' ); //���C���F�@
define ("COLOR_LINE_COMMENT", '#9d000c' ); //���C���F�A

/* --- profile�p(�|�b�v�A�b�v�̕��E����) --- */
$profileWidth = 910;
define ( profileWidth, $profileWidth );
$profileHeight = 810;
define ( profileHeight, $profileHeight );

/* --- ���j���[�p(PC) --- */
$here = $_SERVER["PHP_SELF"];
//���j���[���X�g
$_menuAry = array( 
    "top"         => "�g�b�v�y�[�W" , 
    "schedule"    => "�o�Ώ��" , 
    "girls"       => "���̎q�Љ�" , 
    "system"      => "�����V�X�e��" , 
    "card"        => "�J�[�h����" , 
    "reserve"     => "�I�����C���\��" ,
    "diary"       => "���̎q���X�^�b�t���L" , 
    "recruit"     => "���l�ē�" , 
    "link"        => "���݃����N" , 
);
//���j���[����
foreach( $_menuAry as $key => $value ){
    $menu .= "<li id=\"" . $key . "\"><a href=\"../" . $key . "/\" title=\"" . $value . "\" class=\"";
        if( strstr( $here , $key ) ){
            $menu .= "this";
        }else{
            $menu .= "other";
        }
    $menu .= "\">" . $value . "</a></li>\n";
    
    //�t�b�^�[�����N
    $footerManu .= "�b<a href=\"../" . $key . "/\" title=\"" . $value . "\">" . $value . "</a>\n";
}
define ( menu, $menu );
define ( footerManu, $footerManu );


/* --- ���L�p --- */
$masterDiaryAddress = "masterdiary@" . $domain ; //�Ǘ��җp
$galDiaryAddress    = "galdiary@" . $domain ;    //���̎q�p

/* --- QR�쐬(�����}�K�ꔭ�o�^�p) --- */
$qre = "M";	//�G���[
$qrt = "J";	//JPG�o��
$qrs = "6";	//�T�C�Y
//$qr_img = "http://www." . $domain . "/qr/qr_img.php?d=reg@" . $domain . "&e=" . $qre . "&t=" . $qrt . "&s=" . $qrs;
$qr_img = "http://www." . $domain . "/qr/qr_img.php?d=reg@" . $domain . "&e=" . $qre . "&t=" . $qrt . "&s=" . $qrs;
define ( qr_img, $qr_img );

/* --- �N���W�b�g�J�[�h���ϗp --- */
$shopId4card = "";
$shopName = siteName;
$shopTel4Card = shopTel1;
define('shopId4card', $shopId4card);
define('shopName', $shopName);
define('shopTel4Card', $shopTel4Card);

/* --- ���[���}�K�W�� --- */
$returnMail = "errormail@" . $domain ;
$testEmail  = "info@" . $domain;

/* --- ���[���}�K�W���o�^ --- */
$mailFrom          = "mm@" . $domain;
$returnMailAddress = "errormail@" . $domain ;
$mailSubject       = "���o�^���������܂���";

$mailBody    = $siteName . "�ł����o�^���������܂���\n";
$mailBody   .= "�{�o�^�����������邽�߂ɉ��LURL���N���b�N���Ă�������\n";

$mailBody2   = "��낵�����肢���܂��B\n";

$sleepTime   = 10000;
$ezSleepTime = 200000;
/* --- ���[���}�K�W��/ --- */


$today    = date ( "Y-m-d", mktime ( 0, 0, 0, date( "m" ), date( "d" ), date( "Y" ) ) );
$dateTime = date ( "Y-m-d H:i:s", mktime ( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) );
if( date( "H" ) < 7 ) $ajust = 1;
$workDate = date ( "Y-m-d", mktime ( 0, 0, 0, date( "m" ), date( "d" ) - $ajust, date( "Y" ) ) );

/* --- ���̎q�摜 --- */
$imgMaxWidth  = 305;
$imgMaxHeight = 420;
$prtMd5       = md5( time() );
$quality      = 100;

/* --- �o�ΊǗ� --- */
$schTypeArray = array( '�x��', '�o��' );

/* --- ���݃����N --- */
$linkGenreArray = array(
     1 => "�����L���O�T�C�g" , 
     2 => "���l�T�C�g" , 
     3 => "�������߃T�C�g" , 
     4 => "���݃����N�T�C�g" , 
);


/* --- �z�e�����X�g --- */
$hotelGenreArray = array(
    "0" => "�r�W�l�X�z�e��" , 
    "1" => "���u�z�e��" 
);

/* --- �\��p --- */
$payTypeArray = array(
    1 => "����" , 
    2 => "�N���W�b�g�J�[�h" , 
);

$customerTypeArray = array(
    1 => "���߂Ă̂��q�l" , 
    2 => "���s�[�^�[�̂��q�l" , 
);

$reserveCompArray = array(
    0 => "���m�F" , 
    1 => "�m�F��" , 
);


$cArray = array(
    "0" => "A" ,
    "1" => "B" ,
    "2" => "C" ,
    "3" => "D" ,
    "4" => "E" ,
    "5" => "F" ,
    "6" => "G" ,
    "7" => "H" ,
    "8" => "I" ,
    "9" => "J" 
);

$typeArray = array(
    "0" => "����" , 
    "1" => "���^" , 
    "2" => "����" , 
);


$iconArray = array(
    1 => "NEW" , 
//	2 => "�{���o��" , 
    3 => "����" , 
    4 => "���o��" , 
    5 => "�l�C��" , 
    6 => "���e�d��" , 
    7 => "�X�^�C�����Q" , 
    8 => "���b�N�X���Q" , 
    9 => "���A�o��" , 
   10 => "�ӂߍD��" , 
   11 => "��g�D��" , 
   12 => "�l�C�}�㏸" , 
   13 => "�����n" , 
   14 => "���o�n" , 
   15 => "�M�����n" , 
   16 => "���^�n" , 
   17 => "�e�N�j�V����"
);

$optionArray = array(
    1 => "�p���e�B�[" , 
    2 => "�p���X�g" , 
    3 => "�ԃ^�C�c" , 
    4 => "�s���N���[�^�[" , 
    5 => "�A���}�}�b�T�[�W" , 
    6 => "���[�V�������C" , 
    7 => "�I�i�j�[�ӏ�" , 
    8 => "����" , 
    9 => "����" , 
   10 => "���" , 
   11 => "�C�}���`�I" , 
   12 => "��������" , 
   13 => "�t����" , 
   14 => "AF" , 
   15 => "�I���W�i��" , 
);


$prtArray = array(
    0 => "�\��" , 
    1 => "��\��"
	/*
    0 => "HP�\���E�ڋq�Ǘ��\��" , 
    1 => "HP��\���E�ڋq�Ǘ��\��" , 
    2 => "HP�\���E�ڋq�Ǘ���\��" , 
    3 => "��\��"
    */
);


/* --- ���[���}�K�W���ڍ� --- */
$mailStateAray = array(
    "0" => array (
        "0" => "���o�^" , 
        "1" => "#cccccc" 
    ), 

    "1" => array (
        "0" => "�{�o�^" , 
        "1" => "#ffffff" 
    ), 

    "2" => array (
        "0" => "�폜��" , 
        "1" => "#999999" 
    )
);

$errorMailColor = "#ff0000";

/* --- ���[���}�K�W���ڍ�/ --- */

//�G�����z��
$emojiArray = array(
         0 => "\xF9\x90" , 
         1 => "\xF9\x87" , 
         2 => "\xF9\x88" , 
         3 => "\xF9\x89" , 
         4 => "\xF9\x8A" , 
         5 => "\xF9\x8B" , 
         6 => "\xF9\x8C" , 
         7 => "\xF9\x8D" , 
         8 => "\xF9\x8E" , 
         9 => "\xF9\x8F" , 
    "F89F" => "\xF8\x9F" , //���� ���z
    "F8A0" => "\xF8\xA0" , //�܂� �_
    "F8A1" => "\xF8\xA1" , //�J �P
    "F8A2" => "\xF8\xA2" , //�� �Ⴞ���
    "F8A3" => "\xF8\xA3" , //�� ���}�[�N
    "F8A4" => "\xF8\xA4" , //�䕗 ���邮��}�[�N
    "F8A5" => "\xF8\xA5" , //�� �_�X�ܒi
    "F8A6" => "\xF8\xA6" , //���J �P���Ă�
    "F8A7" => "\xF8\xA7" , //���r�� �����}�[�N�i�r�j
    "F8A8" => "\xF8\xA8" , //������ �����}�[�N�i���j
    "F8A9" => "\xF8\xA9" , //�o�q�� �����}�[�N�i�o�q�j
    "F8AA" => "\xF8\xAA" , //�I�� �����}�[�N�i�I�j
    "F8AB" => "\xF8\xAB" , //���q�� �����}�[�N�i���q�j
    "F8AC" => "\xF8\xAC" , //������ �����}�[�N�i�����j
    "F8AD" => "\xF8\xAD" , //�V���� �����}�[�N�i�V���j
    "F8AE" => "\xF8\xAE" , //嶍� �����}�[�N�i嶁j
    "F8AF" => "\xF8\xAF" , //�ˎ�� �����}�[�N�i�ˎ�j
    "F8B0" => "\xF8\xB0" , //�R�r�� �����}�[�N�i�R�r�j
    "F8B1" => "\xF8\xB1" , //���r�� �����}�[�N�i���r�j
    "F8B2" => "\xF8\xB2" , //���� �����}�[�N�i���j
    "F8B3" => "\xF8\xB3" , //�X�|�[�c �����j���O�V���c�ΐ�
    "F8B4" => "\xF8\xB4" , //�싅 �{�[��
    "F8B5" => "\xF8\xB5" , //�S���t �S���t�N���u�i�h���C�o�[�j
    "F8B6" => "\xF8\xB6" , //�e�j�X �e�j�X���P�b�g���{�[��
    "F8B7" => "\xF8\xB7" , //�T�b�J�[ �T�b�J�[�{�[��
    "F8B8" => "\xF8\xB8" , //�X�L�[ �X�L�[�̔ƌC
    "F8B9" => "\xF8\xB9" , //�o�X�P�b�g�{�[�� �{�[�����o�X�P�b�g�S�[��
    "F8BA" => "\xF8\xBA" , //���[�^�[�X�|�[�c �`�F�b�J�[�t���b�O
    "F8BB" => "\xF8\xBB" , //�|�P�b�g�x�� �|�P�x���̊G
    "F8BC" => "\xF8\xBC" , //�d�� �d�ԁ����H
    "F8BD" => "\xF8\xBD" , //�n���S ���[�}����"�l"�̃}�[�N
    "F8BE" => "\xF8\xBE" , //�V���� �V�����������猩���G
    "F8BF" => "\xF8\xBF" , //�ԁi�Z�_���j �ԉ�����Z�_���̌`
    "F8C0" => "\xF8\xC0" , //�ԁi�q�u�j �ԉ�����q�u�̌`
    "F8C1" => "\xF8\xC1" , //�o�X �o�X���ʂ���
    "F8C2" => "\xF8\xC2" , //�D �D���ʂ���ォ�牌
    "F8C3" => "\xF8\xC3" , //��s�@ ��s�@�ォ�猩���`
    "F8C4" => "\xF8\xC4" , //�� ���̏�Ɂ��������P���Ȍ` �������
    "F8C5" => "\xF8\xC5" , //�r�� �c�������` ���������ς�
    "F8C6" => "\xF8\xC6" , //�X�֋� ���̏�ɓʃ}�[�N ���Ɂ��}�[�N
    "F8C7" => "\xF8\xC7" , //�a�@ ���̏�ɓʃ}�[�N ���Ɂ{�}�[�N
    "F8C8" => "\xF8\xC8" , //��s �a�j
    "F8C9" => "\xF8\xC9" , //�`�s�l �`�s�l
    "F8CA" => "\xF8\xCA" , //�z�e�� ���̏�Ɂ� ���̒��ɂg�̃}�[�N
    "F8CB" => "\xF8\xCB" , //�R���r�j �b�u�r
    "F8CC" => "\xF8\xCC" , //�K�\�����X�^���h �f�r
    "F8CD" => "\xF8\xCD" , //���ԏ� ���̒��ɂo
    "F8CE" => "\xF8\xCE" , //�M�� �M���@
    "F8CF" => "\xF8\xCF" , //�g�C�� �j�����̃V���G�b�g
    "F8D0" => "\xF8\xD0" , //���X�g���� �t�H�[�N���i�C�t
    "F8D1" => "\xF8\xD1" , //�i���X �R�[�q�[�J�b�v
    "F8D2" => "\xF8\xD2" , //�o�[ �J�N�e���O���X
    "F8D3" => "\xF8\xD3" , //�r�[�� �r�[���W���b�L
    "F8D4" => "\xF8\xD4" , //�t�@�[�X�g�t�[�h �n���o�[�K�[
    "F8D5" => "\xF8\xD5" , //�u�e�B�b�N �n�C�q�[��
    "F8D6" => "\xF8\xD6" , //���e�@ �͂���
    "F8D7" => "\xF8\xD7" , //�J���I�P �}�C�N
    "F8D8" => "\xF8\xD8" , //�f�� �r�f�I�J����
    "F8D9" => "\xF8\xD9" , //�E�΂ߏ� ���E�΂ߏ�
    "F8DA" => "\xF8\xDA" , //�V���n �����[�S�[�����h�H
    "F8DB" => "\xF8\xDB" , //���y �w�b�h�z��
    "F8DC" => "\xF8\xDC" , //�A�[�g �ۂ��p���b�g�H
    "F8DD" => "\xF8\xDD" , //���� ���҂̃V���G�b�g�H
    "F8DE" => "\xF8\xDE" , //�C�x���g �e���g�̏�Ɋ�
    "F8DF" => "\xF8\xDF" , //�`�P�b�g ���������` �E���ɏc�̓_��
    "F8E0" => "\xF8\xE0" , //�i�� �^�o�R
    "F8E1" => "\xF8\xE1" , //�։� ���̒��Ƀ^�o�R �ΐ�
    "F8E2" => "\xF8\xE2" , //�J���� �J����
    "F8E3" => "\xF8\xE3" , //�J�o�� �n���h�o�b�N
    "F8E4" => "\xF8\xE4" , //�{ �{�J���Ă�
    "F8E5" => "\xF8\xE5" , //���{���@���{��
    "F8E6" => "\xF8\xE6" , //�v���[���g �����{��
    "F8E7" => "\xF8\xE7" , //�o�[�X�f�C ���E�\�N�R�{
    "F8E8" => "\xF8\xE8" , //�d�b �d�b
    "F8E9" => "\xF8\xE9" , //�g�ѓd�b �g�ѓd�b
    "F8EA" => "\xF8\xEA" , //���� �������E��܂�
    "F8EB" => "\xF8\xEB" , //�e���r �e���r
    "F8EC" => "\xF8\xEC" , //�Q�[�� �R���g���[���[
    "F8ED" => "\xF8\xED" , //�b�c �b�c
    "F8EE" => "\xF8\xEE" , //�n�[�g �n�[�g�}�[�N
    "F8EF" => "\xF8\xEF" , //�X�y�[�h �X�y�[�h�}�[�N
    "F8F0" => "\xF8\xF0" , //�_�C�� �_�C���}�[�N
    "F8F1" => "\xF8\xF1" , //�N���u �N���u�}�[�N
    "F8F2" => "\xF8\xF2" , //�� ��
    "F8F3" => "\xF8\xF3" , //�� ��
    "F8F4" => "\xF8\xF4" , //��i�O�[�j 
    "F8F5" => "\xF8\xF5" , //��i�`���L�j
    "F8F6" => "\xF8\xF6" , //��i�p�[�j 
    "F8F7" => "\xF8\xF7" , //�E�΂߉� ���E�΂߉�
    "F8F8" => "\xF8\xF8" , //���΂ߏ� �����΂ߏ�
    "F8F9" => "\xF8\xF9" , //�� ������
    "F8FA" => "\xF8\xFA" , //�C �C������ΐ��Q�{
    "F8FB" => "\xF8\xFB" , //�ዾ �ዾ
    "F8FC" => "\xF8\xFC" , //�Ԉ֎q �l�̍������Ԉ֎q������
    "F940" => "\xF9\x40" , //�V�� ��
    "F941" => "\xF9\x41" , //��⌇���� �����΂ߏ�P�^�R��
    "F942" => "\xF9\x42" , //���� �����΂ߏ�P�^�Q��
    "F943" => "\xF9\x43" , //�O���� ���E�΂߉������O����
    "F944" => "\xF9\x44" , //���� ��
    "F945" => "\xF9\x45" , //�� ���̊�
    "F946" => "\xF9\x46" , //�L �L�̊�
    "F947" => "\xF9\x47" , //���]�[�g ���b�g
    "F948" => "\xF9\x48" , //�N���X�}�X �N���X�}�X�c���[
    "F949" => "\xF9\x49" , //���΂߉� �����΂߉�
    "F972" => "\xF9\x72" , //phone to ���g�ѓd�b
    "F973" => "\xF9\x73" , //male to �����[���G����
    "F974" => "\xF9\x74" , //fax to ���e�`�w
    "F975" => "\xF9\x75" , //�����[�h ���}�[�N
    "F976" => "\xF9\x76" , //�����[�h�i�g���j ���}�[�N�g��
    "F977" => "\xF9\x77" , //���[�� ���[���G����
    "F978" => "\xF9\x78" , //�h�R���� ���[�}���̂c�ɁH
    "F979" => "\xF9\x79" , //�h�R���|�C���g ���E���e�̒��ɂc
    "F97A" => "\xF9\x7A" , //�L�� ���}�[�N�g��
    "F97B" => "\xF9\x7B" , //���� �e�q�d�d
    "F97C" => "\xF9\x7C" , //�h�c �h�c
    "F97D" => "\xF9\x7D" , //�p�X���[�h �J�M�}�[�N
    "F97E" => "\xF9\x7E" , //�����L �߂�}�[�N
    "F980" => "\xF9\x80" , //�N���A �b�k
    "F981" => "\xF9\x81" , //�T�[�` ���ዾ
    "F982" => "\xF9\x82" , //�m�d�v �m�d�v
    "F983" => "\xF9\x83" , //�ʒu��� ��
    "F984" => "\xF9\x84" , //�t���[�_�C���� �t���[�_�C�����̃}�[�N
    "F985" => "\xF9\x85" , //�V���[�v�_�C���� ��
    "F986" => "\xF9\x86" , //���o�p �����ɂp
    "F987" => "\xF9\x87" , //�P �P�g��
    "F988" => "\xF9\x88" , //�Q �Q�g��
    "F989" => "\xF9\x89" , //�R �R�g��
    "F98A" => "\xF9\x8A" , //�S �S�g��
    "F98B" => "\xF9\x8B" , //�T �T�g��
    "F98C" => "\xF9\x8C" , //�U �U�g��
    "F98D" => "\xF9\x8D" , //�V �V�g��
    "F98E" => "\xF9\x8E" , //�W �W�g��
    "F98F" => "\xF9\x8F" , //�X �X�g��
    "F990" => "\xF9\x90" , //�O �O�g��
    "F9B0" => "\xF9\xB0" , //���� �n�j
    "F991" => "\xF9\x91" , //���n�[�g �n�[�g�}�[�N
    "F992" => "\xF9\x92" , //�h���n�[�g �h���n�[�g�}�[�N
    "F993" => "\xF9\x93" , //���� ���ꂽ�n�[�g
    "F994" => "\xF9\x94" , //�n�[�g�����i�����n�[�g�j �n�[�g�Q��
    "F995" => "\xF9\x95" , //��[���i���ꂵ����j
    "F996" => "\xF9\x96" , //�����i�{������j
    "F997" => "\xF9\x97" , //�����`�i���_������j
    "F998" => "\xF9\x98" , //�����₾�`�i�߂�����j
    "F999" => "\xF9\x99" , //�ӂ�ӂ� �ڂ��~ ��������
    "F99A" => "\xF9\x9A" , //�O�b�h�i��������j
    "F99B" => "\xF9\x9B" , //����� ����
    "F99C" => "\xF9\x9C" , //�����C�� �i����j
    "F99D" => "\xF9\x9D" , //���킢�� �Ђ��`
    "F99E" => "\xF9\x9E" , //�L�X�}�[�N �O
    "F99F" => "\xF9\x9F" , //�҂��҂��i�V�����j �Ђ����Ă�H
    "F9A0" => "\xF9\xA0" , //�Ђ�߂� �d��
    "F9A1" => "\xF9\xA1" , //�ނ����i�{��j
    "F9A2" => "\xF9\xA2" , //�p���` ���Ԃ�
    "F9A3" => "\xF9\xA3" , //���e �_�C�i�}�C�g
    "F9A4" => "\xF9\xA4" , //���[�h �����O��
    "F9A5" => "\xF9\xA5" , //�o�b�h �i���������j
    "F9A6" => "\xF9\xA6" , //�����i�����j ������
    "F9A7" => "\xF9\xA7" , //exclamation �I�}�[�N
    "F9A8" => "\xF9\xA8" , //exclamation&question �I�H
    "F9A9" => "\xF9\xA9" , //exclamation�~�Q !!
    "F9AA" => "\xF9\xAA" , //�ǂ���i�Փˁj���Ƃ���̃~���[
    "F9AB" => "\xF9\xAB" , //���������i��юU�銾�j
    "F9AC" => "\xF9\xAC" , //����[���i���j
    "F9AD" => "\xF9\xAD" , //�_�b�V���i����o�����܁j
    "F9AE" => "\xF9\xAE" , //�[�i�����L���P�j
    "F9AF" => "\xF9\xAF" , //�[�i�����L���Q�j
    "F950" => "\xF9\x50" , //�J�`���R �f��̃J�`���R
    "F951" => "\xF9\x51" , //�ӂ���@
    "F952" => "\xF9\x52" , //�y�� ���N�M�̐�
    "F955" => "\xF9\x55" , //�l�e
    "F956" => "\xF9\x56" , //���� �l���������ɂ�����Ă�H
    "F957" => "\xF9\x57" , //�� �O�����Ɛ��g��
    "F95B" => "\xF9\x5B" , //soon ���̉���soon
    "F95C" => "\xF9\x5C" , //on �̂̉���on!
    "F95D" => "\xF9\x5D" , //end ���̉���end
    "F95E" => "\xF9\x5E" , //���v�@���v

    /* --- �g�� --- */
    "F9B1" => "\xF9\xB1" , //i�A�v�� ��
    "F9B2" => "\xF9\xB2" , //i�A�v���i�g���j ���g��
    "F9B3" => "\xF9\xB3" , //�s�V���c�i�{�[�_�[�j
    "F9B4" => "\xF9\xB4" , //���܌����z
    "F9B5" => "\xF9\xB5" , //���� ���g
    "F9B6" => "\xF9\xB6" , //�W�[���Y
    "F9B7" => "\xF9\xB7" , //�X�m�{
    "F9B8" => "\xF9\xB8" , //�`���y�� �x��
    "F9B9" => "\xF9\xB9" , //�h�A
    "F9BA" => "\xF9\xBA" , //�h���� �܂̒��Ɂ��}�[�N
    "F9BB" => "\xF9\xBB" , //�p�\�R��
    "F9BC" => "\xF9\xBC" , //���u���^�[ �n�[�g�ƃ��[��
    "F9BD" => "\xF9\xBD" , //�����` �X�p�i
    "F9BE" => "\xF9\xBE" , //���M
    "F9BF" => "\xF9\xBF" , //����
    "F9C0" => "\xF9\xC0" , //�w��
    "F9C1" => "\xF9\xC1" , //�����v
    "F9C2" => "\xF9\xC2" , //���]��
    "F9C3" => "\xF9\xC3" , //���̂�
    "F9C4" => "\xF9\xC4" , //�r���v
    "F9C5" => "\xF9\xC5" , //�l���Ă��
    "F9C6" => "\xF9\xC6" , //�ق��Ƃ�����
    "F9C7" => "\xF9\xC7" , //��⊾
    "F9C8" => "\xF9\xC8" , //��⊾�Q
    "F9C9" => "\xF9\xC9" , //�Ղ��������Ȋ�
    "F9CA" => "\xF9\xCA" , //�{�P�[�Ƃ�����
    "F9CB" => "\xF9\xCB" , //�ڂ��n�[�g�i��j
    "F9CC" => "\xF9\xCC" , //�w�łn�j
    "F9CD" => "\xF9\xCD" , //��������x�[�i��j
    "F9CE" => "\xF9\xCE" , //�E�B���N�i��j
    "F9CF" => "\xF9\xCF" , //���ꂵ����
    "F9D0" => "\xF9\xD0" , //���܂��
    "F9D1" => "\xF9\xD1" , //�L�Q
    "F9D2" => "\xF9\xD2" , //������
    "F9D3" => "\xF9\xD3" , //�܁i��j
    "F9D4" => "\xF9\xD4" , //�m�f �m�f
    "F9D5" => "\xF9\xD5" , //�N���b�v
    "F9D6" => "\xF9\xD6" , //�R�s�[���C�g ���̂Ȃ��ɂb
    "F9D7" => "\xF9\xD7" , //�g���[�h�}�[�N �s�l
    "F9D8" => "\xF9\xD8" , //����l
    "F9D9" => "\xF9\xD9" , //�}���� "��"�g��
    "F9DA" => "\xF9\xDA" , //���T�C�N��
    "F9DB" => "\xF9\xDB" , //���W�X�^�[�h�g���[�h�}�[�N ���̒��ɂq
    "F9DC" => "\xF9\xDC" , //�댯�E�x�� ���̒��ɁI
    "F9DD" => "\xF9\xDD" , //�֎~ "��"�g��
    "F9DE" => "\xF9\xDE" , //�󎺁E��ȁE��� "��"�g��
    "F9DF" => "\xF9\xDF" , //���i�}�[�N "��"�g��
    "F9E0" => "\xF9\xE0" , //�����E���ȁE���� "��"�g��
    "F9E1" => "\xF9\xE1" , //��󍶉E ��
    "F9E2" => "\xF9\xE2" , //���㉺ �̂̏c�o�[�W����
    "F9E3" => "\xF9\xE3" , //�w�Z
    "F9E4" => "\xF9\xE4" , //�g
    "F9E5" => "\xF9\xE5" , //�x�m�R
    "F9E6" => "\xF9\xE6" , //�N���[�o�[
    "F9E7" => "\xF9\xE7" , //��������
    "F9E8" => "\xF9\xE8" , //�`���[���b�v
    "F9E9" => "\xF9\xE9" , //�o�i�i
    "F9EA" => "\xF9\xEA" , //�����S
    "F9EB" => "\xF9\xEB" , //��@�Ԃ̐V��
    "F9EC" => "\xF9\xEC" , //���݂�
    "F9ED" => "\xF9\xED" , //��
    "F9EE" => "\xF9\xEE" , //���ɂ���
    "F9EF" => "\xF9\xEF" , //�V���[�g�P�[�L
    "F9F0" => "\xF9\xF0" , //�Ƃ�����i�����傱�t�j
    "F9F1" => "\xF9\xF1" , //�ǂ�Ԃ�
    "F9F2" => "\xF9\xF2" , //�p��
    "F9F3" => "\xF9\xF3" , //�����ނ�
    "F9F4" => "\xF9\xF4" , //�Ђ悱
    "F9F5" => "\xF9\xF5" , //�y���M��
    "F9F6" => "\xF9\xF6" , //��
    "F9F7" => "\xF9\xF7" , //���܂��I �i��j
    "F9F8" => "\xF9\xF8" , //�E�b�V�b�V�i��j
    "F9F9" => "\xF9\xF9" , //�E�}
    "F9FA" => "\xF9\xFA" , //�u�^
    "F9FB" => "\xF9\xFB" , //���C���O���X
    "F9FC" => "\xF9\xFC" , //��������i��j
);
?>
