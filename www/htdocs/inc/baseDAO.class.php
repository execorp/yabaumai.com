<?
//クラス概要
//データと記憶領域を結び付ける。
//データの妥当性をチェックするパリデート処理も行う。


//基本DAOクラス構成
//メンバー変数
//$dataConnect(array)外部参照用別名を記憶領域のキーに置き換えるための配列
//  $dataConnect[記憶領域名(str)][キーの外部参照用別名(str)] = キー(str);

//$dataContainer(array)各種データ
//  データ形式は各DAOに応じて変動する。

//$dataModel(array)型チェックを行うための配列
//  $dataModel[記憶領域名(str)][キー(str)] = array('notNull'=>notNullフラグ(int), 'type'=>データ形式($modelTypeのキー), 'min'=>最小(int), 'max'=>最大(int));

//$maxCount = データ総数(int);

//$modelType(array)データ形式一覧
//  $searchType[データ形式(str)] = 説明(str);


//メンバー関数
//_reset()
//動作　$maxCountと$dataContainerを初期化する

//_validateAdvance(記憶領域名(str), 形式をチェックする配列(array))
//動作　基本バリデートで対応できない場合の拡張バリデート関数。各種DAO側で何も指定していない場合、何でも通る。
//出力　エラーがない時はtrue、それ以外は$array[外部参照用別名(str)] = エラー番号(int);
//      エラー番号について…必須エラーは1、型エラーは2、数値・字数・桁数不足は3、数値・字数・桁数超過は4を返す。

//printModelDetail()
//動作　$dataModelを元にデータ形式を日本語で画面に表示する


//セッタ
//setPage(現在ページ(int), 表示件数(int))
//  $range

//setRange(表示件数(int), 検索開始位置(int))
//  $range


//ゲッタ
//getDataContainer()
//  $dataContainer

//getMaxCount()
//  $maxCount

require_once(dirname(__FILE__) . "/commonObject.class.php" );
class baseDAO extends commonObject
{
    var $dataConnect = array();
    var $dataContainer = array();
    var $dataModel = array();
    var $maxCount = 0;
    var $range = array( 'limit'  => 0,
                        'offset' => 0);
    var $modelType = array( 'dateTime'    => '日付型',
                            'date'        => '日時型',
                            'tel'         => '電話番号型',
                            'telephone'   => '電話番号型',
                            'post'        => '郵便番号型',
                            'postNumber'  => '郵便番号型',
                            'mail'        => 'メールアドレス型',
                            'mailAddress' => 'メールアドレス型',
                            'binary'      => 'バイナリ型',
                            'blob'        => 'バイナリ型',
                            'integer'     => '整数型',
                            'string'      => '文字列型',
                            'text'        => '文書型');
//内部変数の初期化
    function _reset() {
        $this->maxCount = 0;
        $this->dataContainer = "";
    }
//バリデート（型チェック）
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
                        // 日時型チェック
                        if (!$this->_isDateTime($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'dateTime':
                        // 日時型チェック
                        if (!$this->_isDateTime($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'date':
                        // 日付型チェック
                        if (!$this->_isDate($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'tel':
                        // 電話番号型チェック
                        if (!$this->_isTelephone($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'telephone':
                        // 電話番号型チェック
                        if (!$this->_isTelephone($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'post':
                        // 郵便番号型チェック
                        if (!$this->_isPostNumber($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'postNumber':
                        // 郵便番号型チェック
                        if (!$this->_isPostNumber($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'mail':
                        // メールアドレス型チェック
                        if (!$this->_isMailAddress($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'mailAddress':
                        // メールアドレス型チェック
                        if (!$this->_isMailAddress($array[$key])) {
                            $error[$key] = 2;
                        }
                        break;
                    case 'integer':
                        // 整数チェック
                        if (!is_numeric($array[$key])) {
                            $error[$key] = 2;
                        }
                        // 範囲チェック
                        if ($value['min'] > 0 && $array[$key] < $value['min']) {
                            $error[$key] = 3;
                        } else if ($value['max'] > 0 && $array[$key] > $value['max']) {
                            $error[$key] = 4;
                        }
                        break;
                    default:
                        // 文字数チェック
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
        if (preg_match( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$/i", $value)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
// 内部セッタ
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
//内部用型変換
    function _arrayConvert($dataSetName, $dataArray) {
        foreach ($this->dataConnect[$dataSetName] As $key => $value) {
            if (array_key_exists($key, $dataArray)) {
                $result[$value] = $dataArray[$key];
            }
        }
        return $result;
    }
//公開処理
//セッタ
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
//ゲッタ
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
//ヘルプ
    function printModelDetail() {
        foreach ($this->dataModel As $dataSetName => $dataSetModel) {
            echo $this->_getDataSetNameLabel($dataSetName)."(<br>\n";
            foreach ($dataSetModel As $key => $data) {
                $display = 1;
                echo $this->_getDataSetValueLabel($key, $dataSetName)."<br>\n";
                if ($display > 0) {
                    if ($data['notNull'] > 0) {
                        echo "__必須項目<br>\n";
                    }
                    if (array_key_exists($data['type'], $this->modelType)) {
                        echo "__" . $this->modelType[$data['type']] . "<br>\n";
                    } else {
                        echo "__文字列型<br>\n";
                    }
                    if ($data['min'] > 0) {
                        echo "__最小" . $data['min'] . "以上<br>\n";
                    }
                    if ($data['max'] > 0) {
                        echo "__最大" . $data['max'] . "以下<br>\n";
                    }
                }
            }
            echo ")<br>\n";
        }
    }
}
?>
