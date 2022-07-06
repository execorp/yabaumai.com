<?
//�N���X�T�v
//PHP�����f�[�^���ꌳ�Ǘ�����
//�N���C�A���g���̃N�b�L�[�A�T�[�o�[���̃Z�b�V�����A���M���ꂽ�t�@�C���A���M���ꂽ�f�[�^�����ꂼ��R���e�i�Ɋi�[����
//�@09/12/11�@ver 1.00�@��{����쐬�itakeoka�j

//��{DAO�N���X�\��

//�����o�[�ϐ�
//$clientArray(array)�N�b�L�[�i�[�z��
//  $clientArray[�N�b�L�[��(str)] = �i�[�l(any);

//$hostArray(array)�Z�b�V�����i�[�z��
//  $hostArray[�Z�b�V������(str)] = �i�[�l(any);

//$fileArray(array)file�ő��M���ꂽ�t�@�C���i�[�z��
//  $fileArray[�t�@�C����(str)] = �i�[�l(any);

//$sendArray(array)http���N�G�X�g�i�[�z��(�������ږ������݂���ꍇpost���D�悳���)
//  $sendArray[�ϐ���(str)] = �i�[�l(any);

//�����o�[�֐�
//commitClient(�l(str/array), �L������(int)�E�ȗ���)
//����@�N�b�L�[�ւ̒l�̊i�[���s���B

//commitHost(�l(str/array)) 
//����@�Z�b�V�����ւ̒l�̊i�[���s��

//�Q�b�^
//getClient
//  $clientArray

//getHost
//  $hostArray

//getFile
//  $fileArray

//getSend
//  $sendArray

require_once(dirname(__FILE__) . "/commonObject.class.php");
session_start();
class BaseValueDAO extends commonObject
{
    var $clientArray;
    var $hostArray;
    var $fileArray;
    var $sendArray;

    function BaseValueDAO($testFlg = 0) {
        $this->setTest($testFlg);
        $this->clientArray = $_COOKIE;
        $this->hostArray = $_SESSION;

        $tmpFiles = $_FILES;
        if (is_array($tmpFiles)) {
            foreach ($tmpFiles as $fileName => $data) {
                unset($tmpFiles[$fileName]);
                foreach ($data as $key => $container) {
                    if (is_array($container)) {
                        foreach ($container as $number => $value) {
                            $this->fileArray[$fileName][$number][$key] = $value;
                        }
                    } else {
                        $this->fileArray[$fileName][$key] = $container;
                    }
                }
            }
        }
        unset($tmpFiles);
        $this->sendArray = array_merge($_GET,$_POST);
    }
//�Z�b�^+��
    function commitClient($value, $time = 0) {
        $result = true;
        if (is_array($value)) {
            foreach ($array as $arrayKey => $arrayvalue) {
                setcookie($arrayKey, $arrayvalue, $time);
            }
        } else {
            setcookie('default', $value, $time);
        }
        return $result;
    }

    function commitHost($value) {
        $result = true;
        if (is_array($value)) {
            foreach ($value as $arrayKey => $arrayvalue) {
                $_SESSION[$arrayKey] = $arrayvalue;
            }
        } else {
            $_SESSION['default'] = $value;
        }
        return $result;
    }
//�Q�b�^
    function getClient($key = "") {
        if ($key == "") {
            $result = $this->clientArray;
        } else if (array_key_exists($key,$this->clientArray)) {
            $result = $this->clientArray[$key];
        } else {
            $result = false;
        }
        return $result;
    }

    function getHost($key = "") {
        if ($key == "") {
            $result = $this->hostArray;
        } else if (array_key_exists($key,$this->hostArray)) {
            $result = $this->hostArray[$key];
        } else {
            $result = false;
        }
        return $result;
    }

    function getFile($key = "") {
        if ($key == "") {
            $result = $this->fileArray;
        } else if (array_key_exists($key , $this->fileArray)) {
            $result = $this->fileArray[$key];
        } else {
            $result = false;
        }
        return $result;
    }

    function getSend($key = "") {
        if ($key == "") {
            $result = $this->sendArray;
        } else if (array_key_exists($key,$this->sendArray)) {
            $result = $this->sendArray[$key];
        } else {
            $result = false;
        }
        return $result;
    }
}
?>
