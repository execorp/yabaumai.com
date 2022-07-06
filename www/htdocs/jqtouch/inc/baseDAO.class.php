<?
//�N���X�T�v
//�f�[�^�ƋL���̈�����ѕt����B
//�f�[�^�̑Ó������`�F�b�N����p���f�[�g�������s���B
//�@09/12/11�@ver 1.00�@��{����쐬�itakeoka�j
//�@10/02/25�@ver 1.01�@�g�����Ԍ^(24h�ȍ~)�A�g�уA�h���X�^�ǉ��itakeoka�j

//��{DAO�N���X�\��
//�����o�[�ϐ�
//$dataConnect(array)�O���Q�Ɨp�ʖ����L���̈�̃L�[�ɒu�������邽�߂̔z��
//  $dataConnect[�L���̈於(str)][�L�[�̊O���Q�Ɨp�ʖ�(str)] = �L�[(str);

//$dataContainer(array)�e��f�[�^
//  �f�[�^�`���͊eDAO�ɉ����ĕϓ�����B

//$dataModel(array)�^�`�F�b�N���s�����߂̔z��
//  $dataModel[�L���̈於(str)][�L�[(str)] = array('notNull'=>notNull�t���O(int), 'type'=>�f�[�^�`��($modelType�̃L�[), 'min'=>�ŏ�(int), 'max'=>�ő�(int));

//$maxCount = �f�[�^����(int);

//$modelType(array)�f�[�^�`���ꗗ
//  $searchType[�f�[�^�`��(str)] = ����(str);


//�����o�[�֐�
//_reset()
//����@$maxCount��$dataContainer������������

//_validateAdvance(�L���̈於(str), �`�����`�F�b�N����z��(array))
//����@��{�o���f�[�g�őΉ��ł��Ȃ��ꍇ�̊g���o���f�[�g�֐��B�e��DAO���ŉ����w�肵�Ă��Ȃ��ꍇ�A���ł��ʂ�B
//�o�́@�G���[���Ȃ�����true�A����ȊO��$array[�O���Q�Ɨp�ʖ�(str)] = �G���[�ԍ�(int);
//      �G���[�ԍ��ɂ��āc�K�{�G���[��1�A�^�G���[��2�A���l�E�����E�����s����3�A���l�E�����E�������߂�4��Ԃ��B

//printModelDetail()
//����@$dataModel�����Ƀf�[�^�`������{��ŉ�ʂɕ\������


//�Z�b�^
//setPage(���݃y�[�W(int), �\������(int))
//  $range

//setRange(�\������(int), �����J�n�ʒu(int))
//  $range


//�Q�b�^
//getDataContainer()
//  $dataContainer

//getMaxCount()
//  $maxCount

require_once(dirname(__FILE__) . "/commonObject.class.php");
class baseDAO extends commonObject
{
    var $dataConnect = array();
    var $dataContainer = array();
    var $dataModel = array();
    var $maxCount = 0;
    var $range = array( 'limit'  => 0,
                        'offset' => 0);
    var $modelType = array( 'dateTime'    => '���t�^',
                            'date'        => '�����^',
                            'time'        => '���Ԍ^',
                            'timeEx'      => '���Ԍ^(24h�z��)',
                            'tel'         => '�d�b�ԍ��^',
                            'telephone'   => '�d�b�ԍ��^',
                            'post'        => '�X�֔ԍ��^',
                            'postNumber'  => '�X�֔ԍ��^',
                            'mail'        => '���[���A�h���X�^',
                            'mailAddress' => '���[���A�h���X�^',
                            'mobile'      => '�g�уA�h���X�^�iRFC�񏀋��j',
                            'mailMobile'  => '�g�уA�h���X�^�iRFC�񏀋��j',
                            'binary'      => '�o�C�i���^',
                            'blob'        => '�o�C�i���^',
                            'integer'     => '�����^',
                            'string'      => '������^',
                            'text'        => '�����^');
//�����ϐ��̏�����
    function _reset() {
        $this->maxCount = 0;
        $this->dataContainer = "";
    }
//�o���f�[�g�i�^�`�F�b�N�j
    function _validateCheck($dataSetName, $dataArray, $update = 0) {
        $errorArray = $this->_validate($dataSetName, $dataArray, $update);
        $errorAdvanceArray = $this->_validateAdvance($dataSetName, $dataArray);
        if (!is_array($errorArray) && !is_array($errorAdvanceArray)) {
            $result = "";
        } else {
            if (is_array($errorArray)) {
                if (is_array($errorAdvanceArray)) {
                    $result = array_merge($errorArray, $errorAdvanceArray);
                } else {
                    $result = $errorArray;
                }
            } else {
                $result = $errorAdvanceArray;
            }
        }
        return $result;
    }

    function _validate($dataSetName, $array, $update = 0) {
        $result = "";
        foreach ($this->dataModel[$dataSetName] As $key => $value) {
            if ((!is_null($array[$key]) && $array[$key] != "") || $array[$key] === 0) {
                switch ($value['type']) {
                    case 'datetime':
                        // �����^�`�F�b�N
                        if (!$this->_isDateTime($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'dateTime':
                        // �����^�`�F�b�N
                        if (!$this->_isDateTime($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'date':
                        // ���t�^�`�F�b�N
                        if (!$this->_isDate($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'time':
                        // ���Ԍ^�`�F�b�N
                        if (!$this->_isTime($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'timeEx':
                        // 24h�z�����Ԍ^�`�F�b�N
                        if (!$this->_isTimeEx($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'tel':
                        // �d�b�ԍ��^�`�F�b�N
                        if (!$this->_isTelephone($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'telephone':
                        // �d�b�ԍ��^�`�F�b�N
                        if (!$this->_isTelephone($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'post':
                        // �X�֔ԍ��^�`�F�b�N
                        if (!$this->_isPostNumber($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'postNumber':
                        // �X�֔ԍ��^�`�F�b�N
                        if (!$this->_isPostNumber($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'mail':
                        // ���[���A�h���X�^�`�F�b�N
                        if (!$this->_isMailAddress($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'mailAddress':
                        // ���[���A�h���X�^�`�F�b�N
                        if (!$this->_isMailAddress($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'mobile':
                        // ���g�ь������܂ރ��[���A�h���X�^�`�F�b�N
                        if (!$this->_isMailMobile($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'mailMobile':
                        // ���g�ь������܂ރ��[���A�h���X�^�`�F�b�N
                        if (!$this->_isMailMobile($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'integer':
                        // �����`�F�b�N
                        if (!is_numeric($array[$key])) {
                            $error[$key] = 2;
                        }
                        // �͈̓`�F�b�N
                        if ($value['min'] > 0 && $array[$key] < $value['min']) {
                            $error[$key] = 3;
                        } else if ($value['max'] > 0 && $array[$key] > $value['max']) {
                            $error[$key] = 4;
                        }
                        break;
                    default:
                        // �������`�F�b�N
                        if ($value['min'] > 0 && strlen($array[$key]) < $value['min']) {
                            $error[$key] = 3;
                        } else if ($value['max'] > 0 && strlen($array[$key]) > $value['max']) {
                            $error[$key] = 4;
                        }
                        break;
                }
            } else if ($value['notNull'] > 0 && ($update == 0 || (!is_null($array[$key]) && $update > 0))) {
                $error[$key] = 1;
            }
        }
        if (is_array($error)) {
            foreach($error As $key => $value) {
                $result[$this->_getDataSetValueLabel($key, $dataSetName)] = $value;
            }
        } else {
            $result = true;
        }
        return $result;
    }

    function _validateAdvance($dataSetName, $array) {
        return true;
    }

    function _isDateTime($value) {
        if (preg_match("/^(\d{4})-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2]\d)|(3[0-1])) ([0-1]\d|2[0-3]):[0-5]\d:[0-5]\d$/", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _isDate($value) {
        if (preg_match("/^(\d{4})-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2]\d)|(3[0-1]))$/", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _isTime($value) {
        if (preg_match("/^([0-1]\d|2[0-3]):[0-5]\d:[0-5]\d$/", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _isTimeEx($value) {
        if (preg_match("/^\d\d:[0-5]\d:[0-5]\d$/", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _isTelephone($value) {
        if (preg_match("/^((\d{3}\-\d{4})|(\d{2}\-\d{4})|(\d{3}\-\d{3})|(\d{4}\-\d{2})|(\d{5}\-\d{1}))\-\d{4}$/", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _isPostNumber($value) {
        if (preg_match("/^\d{3}\-\d{4}$/", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _isMailAddress($value) {
        if (preg_match( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*[_a-z0-9-]@[a-z0-9-]+([\.][a-z0-9-]+)+$/i", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _isMailMobile($value) {
        if (preg_match( "/^[_a-z0-9-\.]+@[a-z0-9-]+([\.][a-z0-9-]+)+$/i", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
// �����Z�b�^
    function _setModel($dataSetName, $label = "", $notNull = 0, $type='string', $min = 0, $max = 0) {
        if ($dataSetName != "" && $label != "") {
            $accessKey = $this->dataConnect[$dataSetName][$label];
            $this->dataModel[$dataSetName][$accessKey] = array('notNull'=>$notNull, 'type'=>$type, 'min'=>$min, 'max'=>$max);
            if ($accessKey == $this->primaryKey && is_array($this->subTables)) {
                foreach ($this->subTables As $subKey => $subdataSetName) {
                    $this->dataModel[$subdataSetName][$accessKey] = array('notNull'=>1, 'type'=>$type, 'min'=>$min, 'max'=>$max);
                }
            }
        }
    }
//�����p�^�ϊ�
    function _arrayConvert($dataSetName, $dataArray) {
        foreach ($this->dataConnect[$dataSetName] As $key => $value) {
            if (array_key_exists($key, $dataArray)) {
                $result[$value] = $dataArray[$key];
            }
        }
        return $result;
    }
//���J����
//�Z�b�^
    function setPage($page = 1, $div = 10) {
        if (is_numeric($div) && $div >= 0) {
            $this->range['limit'] = $div;
        }
        if (is_numeric($page) && $page >= 0) {
            $this->range['page'] = $page;
        }
    }

    function setRange($limit = 0, $offset = 0) {
        if (is_numeric($limit) && $limit >= 0) {
            $this->range['limit'] = $limit;
        }
        if (is_numeric($offset) && $offset >= 0) {
            $this->range['offset'] = $offset;
        }
    }
//�Q�b�^
    function _getDataSetValueLabel($key, $dataSetName) {
        return array_search($key, $this->dataConnect[$dataSetName]);
    }
    function _getDataSetNameLabel($dataSetName) {
        return $dataSetName;
    }

    function getMaxCount() {
        return $this->maxCount;
    }

    function getDataContainer() {
        if (!is_array($this->dataContainer)) {
            $this->dataContainer = array();
        }
        return $this->dataContainer;
    }
//�w���v
    function printModelDetail() {
        foreach ($this->dataModel As $dataSetName => $dataSetModel) {
            echo $this->_getDataSetNameLabel($dataSetName)."(<br>\n";
            foreach ($dataSetModel As $key => $data) {
                $display = 1;
                echo $this->_getDataSetValueLabel($key, $dataSetName)."<br>\n";
                if ($display > 0) {
                    if ($data['notNull'] > 0) {
                        echo "__�K�{����<br>\n";
                    }
                    if (array_key_exists($data['type'], $this->modelType)) {
                        echo "__" . $this->modelType[$data['type']] . "<br>\n";
                    } else {
                        echo "__������^<br>\n";
                    }
                    if ($data['min'] > 0) {
                        echo "__�ŏ�" . $data['min'] . "�ȏ�<br>\n";
                    }
                    if ($data['max'] > 0) {
                        echo "__�ő�" . $data['max'] . "�ȉ�<br>\n";
                    }
                }
            }
            echo ")<br>\n";
        }
    }
}
?>
