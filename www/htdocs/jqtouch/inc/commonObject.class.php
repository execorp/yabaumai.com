<?
//�N���X�T�v
//�f�o�b�O�⃍�M���O���N���X�����̃f�[�^���Ԃ̏o�͂��ꌳ�Ǘ�����
//�@09/12/11�@ver 1.00�@��{����쐬�itakeoka�j

//��{�N���X�\��

//�����o�[�ϐ�
//$testFlg = �e�X�g�\���̗L��(int);

//testDump(�\������l(any), ��ʕ\���p���o��(str))
//����@$flog������ꍇ���O�ɁA�Ȃ��ꍇ���͂��ꂽ�l����ʂɏo�͂���B�l���z��̏ꍇ�W�J�����B

//loging(�L�^���镶(str))
//����@���O�t�@�C���ɏ����������ށB

//�Z�b�^
//setTest(�e�X�g�\���̗L��(int))
//  $testFlg
//setLoging(���O�t�@�C���ւ̃|�C���^(&))
//  $flog

require_once(dirname(__FILE__) . "/commonLibrary.lib.php" );
class commonObject
{
    var $testFlg;
    var $flog;

    function commonObject($testFlg = 0) {
        $this->setTest($testFlg);
    }

    function testDump($view, $title = 'none') {
        if ($this->flog || $this->testFlg) {
            if ( $this->flog ) {
                $this->loging($title . "," . array_divider($view));
            } else {
                echo $title . " ( <br>\n";
                if (is_array($view)) {
                    foreach($view As $key => $data) {
                        echo " [ " . $key . " ] ( <br>\n";
                        refrain_print($data);
                        echo " ) <br>\n";
                    }
                } else {
                    refrain_print($view);
                }
                echo " ) <br>\n";
            }
        }
        return true;
    }

    function loging($logStr) {
        fwrite($this->flog, $logStr . "\n");
    }

    function setTest($value) {
        $this->testFlg = $value;
    }

    function setLoging($value) {
        $this->flog = $value;
    }
}
?>