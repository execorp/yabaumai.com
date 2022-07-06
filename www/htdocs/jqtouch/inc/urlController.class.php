<?
//�N���X�T�v
//GET�p�����[�^�[�t��URL���ꌳ�Ǘ�����
//�@09/12/11�@ver 1.00�@��{����쐬�itakeoka�j

//DB��{DAO�N���X�\��
//�����o�[�ϐ�
//$baseUrl  = �h���C����(str);
//$noCookie = �N�b�L�[�̗L��(int);

//�����o�[�֐�
//getUrl(�t�@�C����URL(str), GET�Ƃ��Ēǉ�����l(array(�ϐ���=>�l)))
//URL���擾����B

//getAbsoluteUrl(�t�@�C����URL(str), GET�Ƃ��Ēǉ�����l(array(�ϐ���=>�l)), �Í����̗L��(int))
//�t���p�X��URL���擾����B

class urlController
{
    var $baseUrl;
    var $noCookie;

    function urlController($baseUrl, $noCookie = 0) {
        $this->baseUrl = $baseUrl;
        $this->noCookie = $noCookie;
    }

    function getUrl($filePath, $parameter = "") {
        $result = $filePath;
        $result .= $this->_setUrlParameter($parameter);
        return $result;
    }

    function getAbsoluteUrl($filePath, $parameter = "", $https = 0) {
        if ($https > 0) {
            $result = "https://";
        } else {
            $result = "http://";
        }
        $result .= $this->baseUrl . "/" . $filePath;
        $result .= $this->_setUrlParameter($parameter);
        return $result;
    }

    function _setUrlParameter($parameter = "") {
        $result = "";
        if ($this->noCookie != "") {
            $parameter['PHPSESSID'] = session_id();
            $parameter['mobile'] = 1;
        }
        if (is_array($parameter)) {
            foreach($parameter As $key => $value){
                $tmpArray[] = $key."=".$value;
            }
            $result .= "?" . implode("&",$tmpArray);
        }
        return $result;
    }
}
?>
