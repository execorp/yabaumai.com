<?
// �T�[�o�[���ɕς����e�͂��̃t�@�C���ŕύX����
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
// �R���t�B�O�t�@�C���̎Q��
require_once(dirname(__FILE__) . "/base.config.php");
require_once(DECO_INC_PATH . "dao/memberDAO.class.php");
require_once(DECO_INC_PATH . "adv/japanHoliday.class.php");

// ���M��擾�p�֐�
function getEmailList($data, $debug = "") {
    if ( $debug == "" ) {
        $result = getEmailListDb($data);
    } else {
        $data['testSend'] = 0;
        $memberArray = getEmailListDb($data, $debug);
        echo "member address " . count($memberArray) . "<br>\n";
        $data['testSend'] = 1;
        $testArray = getEmailListDb($data, $debug);
        echo "test address " . count($testArray) . "<br>\n";
        $result = '';
        //�f�o�b�O�p�A�h���X
        $result[]['mailAddress'] = 'takeoka@execute.jp';
        $result[]['mailAddress'] = 'execute@docomo.ne.jp';
        $result[]['mailAddress'] = 'exe_cute@ezweb.ne.jp';
        $result[]['mailAddress'] = 'exe_cute@softbank.ne.jp';
    }
    return $result;
}
function getEmailListDb($data, $debug = "") {
    if ( $data['testSend'] > 0 ) {
        //�e�X�g���[�����M��
        if (file_exists(DECO_INC_PATH . "dao/testMemberDAO.class.php")) {
            require_once(DECO_INC_PATH . "dao/testMemberDAO.class.php");
            $memberDAO = new testMemberDAO($debug);
        } else {
            $memberDAO = new memberDAO($debug);
            $memberDAO->setSearchValue('testFlg', 1);
        }
    } else {
        //�{���M��
        $memberDAO = new memberDAO($debug);
        $memberDAO->setSearchValue('errorMailFlg', 1, 'small');
        $memberDAO->setSearchValue('stateFlg', 1);
    }
    if ($data['shopId']) {
        $memberDAO->setSearchValue('shopId', $data['shopId']);
    }
    //�ǉ����������ݒ聫
/*�@�R�����g�A�E�g�X�C�b�`(�擪��/�̐��Œ��̋L�q�̗L��������؂�ւ���B//*�ŗL���A/*�Ŗ���)
    $time = date("H", time());
    $searchArray['time'] = 'time,' . $time;
    $year = date("Y", time());
    $holidayClass = new japanHoliday($year);
    $monthly = date("m", time());
    $date = date("d", time());
    if ($holidayClass->isHoliday($monthly, $date)) {
        $searchArray['week'] = 'week,7';
    } else {
        $week = date("w", time());
        $searchArray['week'] = 'week,' . $week;
    }
    $index[1] = "";
    $memberDAO->setSubSearch($index, 'sendOption', 1, 'null');
    $memberDAO->setSubSearch($index, 'sendOption', ',', 'about');
    $memberDAO->setSubSearch($index, 'sendOption', $memberDAO->setSearchParallel($searchArray), 'aboutArray');
//*/
    //���ǉ����������ݒ�
    $memberDAO->setMemberList();
    $result = $memberDAO->getDataContainer();
    return $result;
}
?>
