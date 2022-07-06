<?
//クラス概要
//DBへのアクセスを一元管理する
//　09/12/11　ver 1.00　基本動作作成（takeoka）メモリ使用量が多いためまだまだ改良の余地あり
//　10/02/09　ver 1.01　deleteRecordでIDを複数指定して削除できるよう修正（takeoka）
//　10/02/18　ver 1.02　_setConnecterMainでデータが0件の場合後続処理を行わないよう修正（takeoka）

//DB基本DAOクラス構成
//メンバー変数
//$mainTable = 基幹テーブル名(str);

//$subTables(array)
//  $subTables[サブテーブルの主キーの外部参照用別名(str)] = サブテーブル名(str);
//  サブテーブルに指定できるテーブルはメインテーブルの主キーとサブテーブルの主キーでデータを１つに絞れる形式に限る

//$primaryKey = 基幹テーブルの主キー(str);

//$primaryLabel = 基幹テーブルの主キーの外部参照用別名(str);

//$searchType(array)検索条件一覧
//  $searchType[検索条件(str)] = 説明(str);

//$dataContainer(array)各種データ
//基幹テーブルのデータ
//  $dataContainer[基幹テーブルの主キーの値(str)][基幹テーブルのキー(str)] = 基幹テーブルのキーの値(str);
//サブテーブルのデータ
//  $dataContainer[基幹テーブルの主キーの値(str)][サブテーブルの主キー(str)][サブテーブルの主キーの値(str)][サブテーブルのキー(str)] = サブテーブルのキーの値(str);

//メンバー関数
//clearSearchValue()
//動作　$searchValueと$rangeを初期化する

//checkData(形式をチェックする配列(array))
//動作　指定した配列に対してバリデート（型チェック）を行う
//出力　エラーがない時はtrue、それ以外は$array[ラベル名(str)] = エラー番号(int);

//checkRepetition(重複をチェックする配列(array))
//動作　指定した配列の組み合わせのデータがメインテーブルに存在するかをチェックする
//出力　重複する時はID、それ以外は0を返す

//updateRecord(更新用配列($dataContainer形式))
//動作　更新用配列を元に関連テーブル全てを一度に登録・更新する。

//deleteRecord(基幹テーブルの主キーの値もしくは値の配列(any))
//動作　関連テーブル全てから指定された主キーのレコードを一度に削除する。値の場合単独削除、値の配列の場合複数削除

//updateRegion(サブテーブルの主キーの外部参照用別名(str), 更新用配列(array(キーの外部参照用別名(str) => 値(str))))
//動作　更新用配列を元に外部参照用別名で指定したサブテーブルのみ登録・更新する。

//deleteRegion(サブテーブルの主キーの外部参照用別名(str), 更新用配列(array(キーの外部参照用別名(str) => 値(str))))
//動作　外部参照用別名で指定されたテーブルのレコードの中から基幹テーブルの主キーとサブテーブルの主キーが一致する物を削除する。

//セッタ
//内部処理
//_setConnecterMain(取得する要素(array(添え字(any) => キーの外部参照用別名(str))));
//  基幹テーブルのデータを参照し$dataContainerに格納する

//_setConnecterSub(サブテーブルの主キーの外部参照用別名(str), 取得する要素(array(添え字(any) => キーの外部参照用別名(str))));
//  サブテーブルのデータを参照し$dataContainerに格納する

//_jointSubToMain(サブテーブルの主キーの外部参照用別名(str),  取得する要素(array(添え字(any) => キーの外部参照用別名(str))));
//  指定したサブテーブルを基準として基幹テーブルのデータを参照し$dataContainerに格納する
//用途　サブテーブルのデータを元に基幹テーブルを逆引きする

//公開処理
//setSearchValue(キーの外部参照用別名(str), 値(any), 条件($searchTypeのキー)・省略可, テーブルの外部参照用別名(str)・省略可)
//  検索条件を設定する。条件を省略した場合等しい物を条件とし、テーブルの外部参照用別名を省略した場合基幹テーブルを検索対象とする。

//setOrderValue(キーの外部参照用別名(str), ソート形式(int)・省略可, テーブルの外部参照用別名(str)・省略可)
//  ソート条件を設定する。ソート形式を省略した場合昇順とし、テーブルの外部参照用別名を省略した場合基幹テーブルをソート対象とする。

//setChildTotalAll(サブテーブルの主キーの外部参照用別名(str), 合計計算用のキーの外部参照用別名(str))
//  $dataContainer[基幹テーブルの主キーの値(str)][サブテーブルの主キーの外部参照用別名(str) . 合計計算用のキーの外部参照用別名(str) . 'Total'] = 合計計算用のキーの値の合計(int);

//setSearchParallel(検索値(array), AND・OR指定(str)・省略した場合AND)
//  同じ項目に複数の条件を設定する。必ずsetSearchValue(項目,setSearchParallel(配列),'○○Array')の形で使う。
/*
用例：名前に太郎か花子が含まれているものを検索する
$search[] = '太郎';
$search[] = '花子';
$exampleDAO->setSearchValue('name', $exampleDAO->setSearchParallel($search,'or'), 'aboutArray');
*/

//setSubSearch(階層(array),キーの外部参照用別名(str), 値(str), 条件($searchTypeのキー)・省略可, テーブルの外部参照用別名(str)・省略可)
//  検索条件を階層構造で設定する。条件を省略した場合等しい物を条件とし、テーブルの外部参照用別名を省略した場合基幹テーブルを検索対象とする。
/*
用例
$hierarchy[1] = "";
$exampleDAO->setSubSearch($hierarchy,'age', 18, 'andLarge');
unset($hierarchy);
$hierarchy[1][1] = "";
$exampleDAO->setSubSearch($hierarchy,'age', 16, 'andLarge');
$exampleDAO->setSubSearch($hierarchy,'gender', 2);

生成されるSQLの検索文字列
('age' >= 18 OR ('age' >= 16 AND 'gender' = 2))
*/

//ゲッタ
//getChildCount(基幹テーブルの主キーの値(str), サブテーブルの主キー(str))
//  指定したIDの中のサブテーブルのデータ数(int)

//getChildTotal(基幹テーブルの主キーの値(str), サブテーブルの主キー(str), 合計計算用のキーの外部参照用別名(str))
//  合計計算用のキーの値の合計(int)

require_once(dirname(__FILE__) . "/baseDAO.class.php");
require_once(dirname(__FILE__) . "/dbDAO.config.php");
class dbDAO extends baseDAO
{
    var $db;
    var $mainTable = "";
    var $subTables = array();
    var $primaryKey = "";
    var $primaryLabel = "";
    var $searchValue = array();
    var $orderValue = array();
    var $searchType = array('large'             => 'より大きい',
                            'andLarge'          => '以上',
                            'small'             => 'より小さい',
                            'andSmall'          => '以下',
                            'about'             => '含まれる',
                            'prefix'            => '指定語句で始まる',
                            'suffix'            => '指定語句で終わる',
                            'prohibition'       => '含まない',
                            'notPrefix'         => '指定語句で始まらない',
                            'notSuffix'         => '指定語句で終わらない',
                            'in'                => '列挙した値の１つと等しい',
                            'not'               => '指定値以外',
                            'null'              => 'NULL',
                            'search'            => '子検索条件',
                            'aboutArray'        => '含まれる（複数用）',
                            'prefixArray'       => '指定語句で始まる（複数用）',
                            'suffixArray'       => '指定語句で終わる（複数用）',
                            'prohibitionArray'  => '含まない（複数用）',
                            'notArray'          => '指定値以外（複数用）',
                            'equal'             => '等しい'
                            );
    var $tmpRange = array();
    var $tmpSearchValue = array();
    var $tmpOrderValue = array();
    var $subStopFlg = 0;

    function dbDAO($testFlg = 0) {
        $this->db  = new dbAccess();
        $this->setTest($testFlg);
    }
//内部処理
//検索
    function _returnDbAssoc($sqlStr) {
        $this->testDump($sqlStr,'query');
        if (!is_null($sqlStr) && strlen($sqlStr) > 0) {
            $result = $this->db->getAssoc($sqlStr . "\n", $this->primaryKey);
            $this->testDump($result,'result');
        }
        return $result;
    }

    function _returnDbAll($sqlStr) {
        $this->testDump($sqlStr,'query');
        if (!is_null($sqlStr) && strlen($sqlStr) > 0) {
            $result = $this->db->getAll($sqlStr . "\n");
            $this->testDump($result,'result');
        }
        return $result;
    }
//SQL実行
    function _returnDbQuery($sqlStr, $sqlArray, $test="") {
        if (!is_array($sqlStr)) {
            $this->testDump($sqlStr,'query');
            $this->testDump($sqlArray,'data');
            if (!$test) {
                $result = $this->db->query($sqlStr . "\n");
            } else {
                $result = "test";
            }
        } else {
            $this->testDump($sqlStr,'error');
            $result = $sqlStr;
        }
        return $result;
    }
//SQL自動生成
    function _baseGet($tableName, $dataArray = "", $optionStr = "") {
        $result = true;
        $selectArray = "";
        if (is_array($dataArray)) {
            foreach ($dataArray As $key => $value) {
                if (array_key_exists($value, $this->dataConnect[$tableName])) {
                    $selectArray[] = $this->dataConnect[$tableName][$value];
                }
            }
            if (!is_array($selectArray)) {
                $result = false;
            }
        }
        if ($result) {
            $sqlArray = $this->_selectMaker($tableName, $selectArray);
            $result = "SELECT ";
            $result .= $sqlArray['value'];
            $result .= " FROM `" . $tableName . "` ";
            $result .= $this->_whereMaker($tableName);
            $result .= $this->_orderMaker($tableName);
            if ($optionStr) {
                $result .= $optionStr;
            }
        }
        return $result;
    }

    function _baseIns($tableName, $dataArray) {
        $error = $this->_validateCheckDb($tableName, $dataArray);
        if (!is_array($error)) {
            $sqlArray = $this->_insertMaker($tableName, $dataArray);
            $result = " INSERT `" . $tableName . "` ";
            $result .= $sqlArray['key'];
            $result .= " VALUES " . $sqlArray['value'];
        } else {
            $result = $error;
        }
        return $result;
    }

    function _baseUpd($tableName, $dataArray) {
        $error = $this->_validateCheckDb($tableName, $dataArray, 1);
        if (!is_array($error)) {
            $updateStr = $this->_updateMaker($tableName, $dataArray);
            $result = "UPDATE `" . $tableName . "` SET ";
            $result .= $updateStr . " ";
            $result .= $this->_whereMaker($tableName);
        } else {
            $result = $error;
        }
        return $result;
    }

    function _baseDel($tableName) {
        $result = "DELETE FROM `" . $tableName . "` ";
        $where = $this->_whereMaker($tableName);
        if (strlen($where) > 0) {
            $result .= $where;
        } else {
            $result = "";
        }
        return $result;
    }

    function _selectMaker($tableName, $makeArray) {
        $result = "";
        if (is_array($makeArray)) {
            foreach ($makeArray as $key => $value) {
                if (is_array($this->dataModel[$tableName]) && array_key_exists($value, $this->dataModel[$tableName])) {
                    $tmpValueArray[] = "`".$value."`";
                }
            }
            if (is_array($tmpValueArray)) {
                $result['value'] = implode("," , $tmpValueArray);
            }
        } else {
            $result['value'] = "*";
        }
        return $result;
    }

    function _whereMaker($tableName) {
        $result = $this->_whereMakerRefrain($tableName, $this->searchValue[$tableName]);
        if (strlen($result) > 0) {
            $result = "WHERE " . $result;
        }
        return $result;
    }

    function _whereMakerRefrain($tableName, $whereArray, $joint = "AND") {
        $result = "";
        if (is_array($whereArray) && is_array($this->dataModel[$tableName])) {
            foreach ($whereArray As $key => $dataArray) {
                if (array_key_exists($key, $this->dataModel[$tableName])) {
                    foreach ($dataArray As $type => $data) {
                        if (isset($data)) {
                            if (is_array($data) && $type != 'in') {
                                $searchJoint = "";
                                if (array_key_exists('and', $data)) {
                                    $searchJoint = "AND";
                                    $divider = "and";
                                } else if (array_key_exists('or', $data)) {
                                    $searchJoint = "OR";
                                    $divider = "or";
                                }
                                if ($searchJoint != "") {
                                    $preData = "";
                                    $sufData = "";
                                    switch ($type) {
                                        case 'aboutArray':
                                            $comparison = "LIKE";
                                            $preData = "%";
                                            $sufData = "%";
                                            break;
                                        case 'prohibitionArray':
                                            $comparison = "NOT LIKE";
                                            $preData = "%";
                                            $sufData = "%";
                                            break;
                                        case 'prefixArray':
                                            $comparison = "LIKE";
                                            $sufData = "%";
                                            break;
                                        case 'suffixArray':
                                            $comparison = "LIKE";
                                            $preData = "%";
                                            break;
                                        case 'notArray':
                                            $comparison = "!=";
                                            break;
                                        default:
                                            $comparison = "=";
                                            break;
                                    }
                                    foreach ($data[$divider] As $label => $value) {
                                        $searchValue = $preData . $this->_preEscape($value) . $sufData;
                                        $searchValue = "'" . $searchValue . "'";
                                        $searchTmp[] = "`" . $key . "` " . $comparison . " " . $searchValue;
                                    }
                                    $whereArrayTmp[] = " (" . implode(" " . $searchJoint . " " , $searchTmp) . ") ";
                                }
                            } else {
                                $irregular = 0;
                                if (!is_array($data)) {
                                    $data = $this->_preEscape($data);
                                }
                                switch ($type) {
                                    case 'large':
                                        $comparison = ">";
                                        break;
                                    case 'andLarge':
                                        $comparison = ">=";
                                        break;
                                    case 'small':
                                        $comparison = "<";
                                        break;
                                    case 'andSmall':
                                        $comparison = "<=";
                                        break;
                                    case 'about':
                                        $comparison = "LIKE";
                                        $data = "%".$data."%";
                                        break;
                                    case 'preAbout':
                                        $comparison = "LIKE";
                                        $data = $data."%";
                                        break;
                                    case 'prefix':
                                        $comparison = "LIKE";
                                        $data = $data."%";
                                        break;
                                    case 'sufAbout':
                                        $comparison = "LIKE";
                                        $data = "%".$data;
                                        break;
                                    case 'suffix':
                                        $comparison = "LIKE";
                                        $data = "%".$data;
                                        break;
                                    case 'prohibition':
                                        $comparison = "NOT LIKE";
                                        $data = "%".$data."%";
                                        break;
                                    case 'notPrefix':
                                        $comparison = "NOT LIKE";
                                        $data = $data."%";
                                        break;
                                    case 'notSufix':
                                        $comparison = "NOT LIKE";
                                        $data = "%".$data;
                                        break;
                                    case 'not':
                                        $comparison = "!=";
                                        break;
                                    case 'in':
                                        $tmpData = "";
                                        $comparison = "IN";
                                        if (is_array($data)) {
                                            foreach ($data As $tmpKey => $tmpValue) {
                                                $tmpValue = "'" . $this->_preEscape($tmpValue) . "'";
                                                $tmpData[] = $tmpValue;
                                            }
                                        } else {
                                            $tmpData[] = "'" . $data . "'";
                                        }
                                        $data = "(" . implode(',', $tmpData) . ")";
                                        $irregular = 1;
                                        break;
                                    case 'null':
                                        $comparison = "IS";
                                        $data = "NULL";
                                        $irregular = 1;
                                        break;
                                    default:
                                        $comparison = "=";
                                        break;
                                }
                                if ($irregular == 0) {
                                    $data = "'" . $data . "'";
                                }
                                $whereArrayTmp[] = "`" . $key . "` " . $comparison ." ". $data;
                            }
                        }
                    }
                } else if (array_key_exists('search', $dataArray)) {
                    if ($joint == "AND") {
                        $jointStr = "OR";
                    } else {
                        $jointStr = "AND";
                    }
                    $whereArrayTmp[] = $this->_whereMakerRefrain($tableName, $dataArray['search'], $jointStr);
                }
            }
            if (is_array($whereArrayTmp)) {
                $result = " (" . implode(" " . $joint . " " , $whereArrayTmp) . ") ";
            }
            $whereArrayTmp = "";
        }
        return $result;
    }

    function _preEscape($str) {
        if (function_exists(get_magic_quotes_gpc) && get_magic_quotes_gpc() === 1) {
            $str = stripslashes($str);
        }
        $str = $this->db->escape($str);
        return $str;
    }

    function _orderMaker($tableName) {
        if (is_array($this->dataModel[$tableName]) && array_search('priority', $this->dataModel[$tableName])) {
            $tmpValueArray[] = "`priority`";
        }
        $makeArray = $this->orderValue[$tableName];
        $result = "";
        if (is_array($makeArray)) {
            foreach ($makeArray as $key => $value) {
                if ($value != "") {
                    $tmpValueArray[] = "`".$key."` DESC";
                } else {
                    $tmpValueArray[] = "`".$key."`";
                }
            }
        }
        if (is_array($tmpValueArray)) {
            $result = "ORDER BY ".implode("," , $tmpValueArray)." ";
        }
        return $result;
    }

    function _insertMaker($tableName, $makeArray) {
        $result = "";
        if (is_array($makeArray)) {
            if (!is_array($fileList)) {
                $fileList = array();
            }
            foreach ($makeArray as $key => $value) {
                if (!is_array($value)) {
                    if (is_array($this->dataModel[$tableName]) && array_key_exists($key, $this->dataModel[$tableName])) {
                        $tmpKeyArray[] = "`".$key."`";
                        $value = $this->_preEscape($value);
                        if ($this->dataModel[$tableName][$key]['type'] == 'blob' ||
                             $this->dataModel[$tableName][$key]['type'] == 'binary') {
                        } else {
                            $value = "'".$value."'";
                        }
                        $tmpValueArray[] = $value;
                    }
                }
            }
            $result['key'] = " (" . implode("," , $tmpKeyArray) . ") ";
            $result['value'] = " (" . implode("," , $tmpValueArray) . ") ";
        } else {
            $result['value'] = "*";
        }
        return $result;
    }

    function _updateMaker($tableName, $makeArray) {
        $result = "";
        if (is_array($makeArray)) {
            if (!is_array($fileList)) {
                $fileList = array();
            }
            foreach ($makeArray as $key => $value) {
                if (!is_array($value)) {
                    if (is_array($this->dataModel[$tableName]) && array_key_exists($key, $this->dataModel[$tableName])) {
                        $value = $this->_preEscape($value);
                        if ($this->dataModel[$tableName][$key]['type'] == 'blob' ||
                             $this->dataModel[$tableName][$key]['type'] == 'binary') {
                        } else {
                            $value = "'".$value."'";
                        }
                        $tmpValueArray[] = "`".$key."`=".$value;
                    }
                }
            }
            $result = implode("," , $tmpValueArray);
        }
        return $result;
    }
//登録・更新処理
    function _updateRecord($tableName, $dataArray, $test = 0) {
        $mode = 0;
//        if (is_array($dataArray)) {
            $inArray = $this->_arrayConvert($tableName, $dataArray);
            $this->_setSearchToTmp();
            if ($tableName == $this->mainTable && strlen(array_key_exists($this->primaryKey, $inArray)) > 0) {
                $this->setSearchValue($this->primaryLabel,$inArray[$this->primaryKey]);
                $sqlStr = $this->_baseGet($tableName, $getArray);
                $dbArray = $this->_returnDbAll($sqlStr);
                if (is_array($dbArray)) {
                    $mode = 1;
                }
            } else {
                $tableLabel = array_search($tableName, $this->subTables);
                if ($tableLabel != "") {
                    if (array_key_exists($tableLabel, $this->dataConnect[$tableName])) {
                        $mainKey = $this->dataConnect[$tableName][$tableLabel];
                        $this->setSearchValue($this->primaryLabel, $inArray[$this->primaryKey], 'equal', $tableName);
                        $this->setSearchValue($tableLabel, $inArray[$mainKey], 'equal', $tableName);
                        foreach ($dataArray As $key => $data) {
                            $getArray[] = $key;
                        }
                        $sqlStr = $this->_baseGet($tableName, $getArray);
                        $dbArray = $this->_returnDbAll($sqlStr);
                        if (is_array($dbArray)) {
                            $mode = 1;
                        }
                    }
                }
            }
            if ($mode == 1) {
                $sqlStr = $this->_baseUpd($tableName, $inArray);
            } else {
                $sqlStr = $this->_baseIns($tableName, $inArray);
            }
            $this->_setTmpToSearch();
            $result = $this->_returnDbQuery($sqlStr, $inArray, $test);
/*
        } else {
            echo $tableName . "<br>";
            var_dump($dataArray);
            echo "<br>";
        }
*/
        return $result;
    }
//バリデート（型チェック）
    function _validateCheckDb($dataSetName, $dataArray, $update = 0) {
        $result = $this->_validateCheck($dataSetName, $dataArray ,$update);
        if (is_array($result) && $dataSetName == $this->mainTable && $update == 1 && array_key_exists($this->primaryLabel, $result)) {
            unset($result[$this->primaryLabel]);
            if (count($result) == 0) {
                $result = true;
            }
        }
        return $result;
    }
//内部セッタ
    function _searchRange() {
        $result = "";
        if ($this->range['limit'] > 0) {
            $pageOffset = 0;
            if ($this->range['offset'] > 0) {
                $pageOffset = $this->range['offset'];
            } else if ($this->range['page'] > 0) {
                $pageOffset = ($this->range['page'] - 1) * $this->range['limit'];
            }
            if ($pageOffset > 0) {
                if ($pageOffset > $this->maxCount) {
                    $pageOffset = (ceil($this->maxCount / $this->range['limit']) - 1) * $this->range['limit'];
                }
                if ($PostgreSQL > 0) {
                    $result = "OFFSET " . $pageOffset . " LIMIT " . $this->range['limit'];
                } else {
                    $result = "LIMIT " . $pageOffset . "," . $this->range['limit'];
                }
            } else {
                $result = "LIMIT " . $this->range['limit'];
            }
        }
        return $result;
    }

    function _setConnectPrimaryKey() {
        $this->dataConnect[$this->mainTable][$this->primaryLabel] = $this->primaryKey;
        if (is_array($this->subTables)) {
            foreach ($this->subTables As $subKey => $subTableName) {
                $this->dataConnect[$subTableName][$this->primaryLabel] = $this->primaryKey;
            }
        }
    }

    function _setConnecterMain($getArray = "", $count = 1) {
        $tableName = $this->mainTable;
        if (!array_search($this->primaryLabel, $getArray)) {
            array_unshift($getArray, $this->primaryLabel);
        }
        if ($count == 1) {
            $sqlStr = $this->_baseGet($tableName, $getArray);
            $this->maxCount = $this->db->getCount($sqlStr);
            unset($countArray);
        }
        $sqlStr = $this->_baseGet($tableName, $getArray, $this->_searchRange());
        $dbArray = $this->_returnDbAssoc($sqlStr);
        if (is_array($dbArray)) {
            foreach ($dbArray As $id => $data) {
                if (is_array($data)) {
                    foreach ($data As $key => $value) {
                        $connection = $this->_getDataSetValueLabel($key, $tableName);
                        if (strlen($connection) > 0) {
                            $key = $connection;
                        }
                        $this->dataContainer[$id][$key] = $value;
                    }
                }
            }
        }
        if (!is_array($this->dataContainer) || count($this->dataContainer) == 0) {
            $this->subStopFlg = 1;
        }
    }

    function _setConnecterSub($label, $getArray = "") {
        if ($this->subStopFlg == 0 && $this->_getSubTableName($label)) {
            $this->_setJointArray();
            if (!array_search($label, $getArray)) {
                array_unshift($getArray, $label);
            }
            if (!array_search($this->primaryLabel, $getArray)) {
                array_unshift($getArray, $this->primaryLabel);
            }
            $tableName = $this->subTables[$label];
            $this->setOrderValue($label,0, $tableName);
            $sqlStr = $this->_baseGet($tableName, $getArray);
            $dbArray = $this->_returnDbAll($sqlStr);
            if (is_array($dbArray)) {
                if (array_key_exists($label, $this->dataConnect[$tableName])) {
                    $labelName = $this->dataConnect[$tableName][$label];
                    $ok = 1;
                }
                foreach ($dbArray As $id => $data) {
                    if (!$ok) {
                        $labelName = $id;
                    }
                    if (is_array($data)) {
                        foreach ($data As $key => $value) {
                            if ($key != $this->primaryKey) {
                                $connection = $this->_getDataSetValueLabel($key, $tableName);
                                if (strlen($connection) > 0) {
                                    $key = $connection;
                                }
                                if ($label != $key) {
                                    $this->dataContainer[$data[$this->primaryKey]][$label][$data[$labelName]][$key] = $value;
                                }
                            }
                        }
                    }
                }
            }
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _jointSubToMain($label, $getArray) {
        if ($this->_getSubTableName($label)) {
            if (!array_search($label, $getArray)) {
                array_unshift($getArray, $label);
            }
            if ($this->_setJointArray()) {
                $tmpArray = $this->dataContainer;
                $this->dataContainer = "";
                $this->_setConnecterMain($getArray);
                foreach ($tmpArray As $id => $data) {
                    if (array_key_exists($id, $this->dataContainer)) {
                        $this->dataContainer[$id][$label] = $data[$label];
                    }
                }
            }
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _setJointArray() {
        $tmpArray = $this->dataContainer;
        if (is_array($tmpArray) && count($tmpArray) > 0) {
            $jointArray = "";
            foreach ($tmpArray As $key => $value) {
                $jointArray[] = $key;
            }
            if ($this->maxCount == 0) {
                $this->maxCount = count($jointArray);
            }
            $this->setSearchValue($this->primaryLabel, $jointArray, 'in');
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function _setSearchToTmp() {
        $this->tmpRange       = $this->range;
        $this->tmpOrderValue  = $this->orderValue;
        $this->tmpSearchValue = $this->searchValue;
    }

    function _setTmpToSearch() {
        $this->clearSearchValue();
        $this->searchValue = $this->tmpSearchValue;
        $this->orderValue  = $this->tmpOrderValue;
        $this->range       = $this->tmpRange;
    }
//内部ゲッタ
    function _getDataSetNameLabel($dataSetName) {
        if ($dataSetName == $this->mainTable) {
            $result = "main";
        } else if ($tmp = array_search($dataSetName, $this->subTables)) {
            $result = $tmp;
        } else {
            $result = false;
        }
        return $result;
    }
    function _getSubTableName($label) {
        return array_key_exists($label, $this->subTables);
    }
//公開処理
//検索初期化
    function clearSearchValue() {
        $this->searchValue = "";
        $this->orderValue = "";
        $this->range = array('limit'  => 0,
                        'offset' => 0);
    }
//型チェック
    function checkData($dataArray) {
        $checkArray = $this->_arrayConvert($this->mainTable, $dataArray);
        $result = $this->_validateCheckDb($this->mainTable, $checkArray);
        return $result;
    }
//重複チェック
    function checkRepetition($dataArray) {
        $this->_setSearchToTmp();
        $this->setRange(1);
        $this->setOrderValue($this->primaryLabel, 1);
        foreach ($dataArray As $key => $value) {
            if (!is_array($value)) {
                $this->setSearchValue($key, $value);
            }
        }
        $dataContainer = $this->dataContainer;
        $this->_reset();
        $connection = $this->dataConnect[$this->mainTable];
        foreach ($connection As $label => $key) {
            $getArray[] = $label;
        }
        $this->_setConnecterMain($getArray, 0);
        if (is_array($this->dataContainer)) {
            foreach ($this->dataContainer As $id => $data) {
                $result = $id;
            }
        } else {
            $result = 0;
        }
        $this->_reset();
        $this->dataContainer = $dataContainer;
        $this->_setTmpToSearch();
        return $result;
    }

//データ操作
    function updateRecord($array) {
        $this->_reset();
        $result = $this->_updateRecord($this->mainTable, $array);
        if (!is_array($result)) {
            $this->_setSearchToTmp();
            if (strlen(array_key_exists($this->primaryLabel, $array)) > 0) {
                $orderId = $array[$this->primaryLabel];
            } else {
                $orderId = $this->db->getNewId();
            }
            $this->testDump($orderId,'editId');
            foreach ($this->subTables As $label => $tableName) {
                if (is_array($array[$label])) {
                    foreach ($array[$label] As $id => $data) {
                        $data[$this->primaryLabel] = $orderId;
                        $data[$label] = $id;
                        $this->_updateRecord($tableName, $data);
                    }
                }
            }
            $this->_setTmpToSearch();
            $result = $orderId;
        }
        return $result;
    }

    function deleteRecord($id) {
        $mainSqlStr = "";
        if ($id != "") {
            $this->_reset();
            $this->_setSearchToTmp();
            $this->setIdSearch($this->primaryLabel, $id);
            $mainSqlStr = $this->_baseDel($this->mainTable);
        }
        if (strlen($mainSqlStr) > 0) {
            foreach ($this->subTables As $label => $tableName) {
                $subSqlStr = $this->_baseDel($tableName);
                $this->_returnDbQuery($subSqlStr, array());
            }
            $this->_returnDbQuery($mainSqlStr, array());
            $this->_setTmpToSearch();
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function updateRegion($label, $array) {
        if ($this->_getSubTableName($label) && array_key_exists($this->primaryLabel, $array)) {
            $this->_reset();
            $this->_setSearchToTmp();
            $this->setSearchValue($this->primaryLabel, $array[$this->primaryLabel]);
            $this->setSearchValue($label, $array[$label]);
            $result = $this->_updateRecord($this->subTables[$label], $array);
            $this->_setTmpToSearch();
        } else {
            $result = array('error',1);
        }
        return $result;
    }

    function deleteRegion($label, $array) {
        if ($this->_getSubTableName($label) && array_key_exists($this->primaryLabel, $array) && array_key_exists($label, $array)) {
            $this->_reset();
            $this->_setSearchToTmp();
            $this->setSearchValue($this->primaryLabel, $array[$this->primaryLabel]);
            $this->setSearchValue($label, $array[$label]);
            $subSqlStr = $this->_baseDel($this->subTables[$label]);
            $this->_returnDbQuery($subSqlStr, array());
            $this->_setTmpToSearch();
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function numberChange($id, $from, $to, $label='priority') {
        $this->_reset();
        $test = $this->testFlg;
        if ($key = $this->dataConnect[$this->mainTable][$label]) {
            if (is_numeric($id) && (is_numeric($from) || $from ==' 0') && is_numeric($to)) {
                if ($from > $to) {
                    $move = "+";
                    $large = $from;
                    $small = $to;
                } else {
                    $move = "-";
                    $large = $to;
                    $small = $from;
                }
                $inArray[$label] = $small."～".$large;
                $sqlStr = "UPDATE `" . $this->mainTable . "` SET `" . $key . "` = `" . $key . "` " . $move . " 1 WHERE `" . $key . "` <= '" . $large ."' AND `" . $key . "` >= '" . $small ."'";
                $result = $this->_returnDbQuery($sqlStr, $inArray, $test);
                $inArray[$this->primaryKey] = $id;
                $sqlStr = "UPDATE `" . $this->mainTable . "` SET `" . $key . "` = '" . $to . "' WHERE `" . $this->primaryKey . "` = '" . $id . "'";
                $result = $this->_returnDbQuery($sqlStr, $inArray, $test);
                $sqlStr = "SELECT `" . $this->primaryKey . "`, `" . $key . "` FROM `" . $this->mainTable . "` WHERE `" . $key . "` > '0' ORDER BY `" . $key . "`";
                $result = $this->_returnDbAssoc($sqlStr);
                if (is_array($result)) {
                    $i = 0;
                    foreach($result As $upId => $data) {
                        $i++;
                        $sqlStr = "UPDATE `" . $this->mainTable . "` SET `" . $key . "` = '" . $i . "' WHERE `" . $this->primaryKey . "` = '" . $upId . "'";
                        $result = $this->_returnDbQuery($sqlStr, $inArray, $test);
                    }
                }
            } else {
                $sqlStr[$label] = 2;
            }
        } else {
            $sqlStr[$label] = 1;
        }
        return $result;
    }
//セッタ
    function _reset() {
        $subStopFlg = 0;
        $this->maxCount = 0;
        $this->dataContainer = "";
    }

    function setIdSearch($label, $id = "") {
        if (!is_null($id)) {
            if (is_array($id)) {
                $this->setSearchValue($label, $id,'in');
            } else {
                $this->setSearchValue($label, $id);
            }
        }
    }

    function setSearchValue($tmpKey, $value, $type = 'equal', $tableName = null) {
        if (array_key_exists($tmpKey, $this->subTables)) {
            $tableName = $this->subTables[$tmpKey];
        } else {
            if (is_null($tableName) || ($tableName != $this->mainTable && strlen(array_search($tableName, $this->subTables))) == 0) {
                $tableName = $this->mainTable;
            }
        }
        $key = "";
        $result = false;
        if (array_key_exists($tmpKey, $this->dataConnect[$tableName])) {
            $key = $this->dataConnect[$tableName][$tmpKey];
            $this->searchValue[$tableName][$key][$type] = $value;
            if ($key == $this->primaryKey && is_array($this->subTables)) {
                foreach ($this->subTables As $subKey => $subTableName) {
                    $this->searchValue[$subTableName][$key][$type] = $value;
                }
            }
            $result = true;
        }
        return $result;
    }

    function setSearchParallel($valueArray, $joint = '') {
        if (strtolower($joint) == 'or') {
            $joint = 'or';
        } else {
            $joint = 'and';
        }
        $result[$joint] = $valueArray;
        return $result;
    }

    function setSubSearch($hierarchy, $tmpKey, $value, $type = 'equal', $tableName = null) {
        if (array_key_exists($tmpKey, $this->subTables)) {
            $tableName = $this->subTables[$tmpKey];
        } else {
            if (is_null($tableName) || ($tableName != $this->mainTable && strlen(array_search($tableName, $this->subTables))) == 0) {
                $tableName = $this->mainTable;
            }
        }
        $key = "";
        $result = false;
        if (array_key_exists($tmpKey, $this->dataConnect[$tableName])) {
            $key = $this->dataConnect[$tableName][$tmpKey];
            $setArray[$key][$type] = $value;
            $setHierarchy = $this->_makeSearchHierarchy($hierarchy, $setArray, $this->searchValue[$tableName]);
            $this->searchValue[$tableName] = $setHierarchy;
            $result = true;
        }
        return $result;
    }

    function _makeSearchHierarchy($hierarchy, $setArray, $searchArray = "") {
        $result = $searchArray;
        if (is_array($hierarchy)) {
            $mainKey = array_shift(array_keys($hierarchy));
            if (is_array($searchArray) && array_key_exists($mainKey, $searchArray) && array_key_exists('search', $searchArray[$mainKey])) {
                $subSearchArray = $searchArray[$mainKey]['search'];
            } else {
                $subSearchArray = "";
            }
            $result[$mainKey]['search'] = $this->_makeSearchHierarchy($hierarchy[$mainKey], $setArray, $subSearchArray);
        } else {
            $mainKey = array_shift(array_keys($setArray));
            $subKey = array_shift(array_keys($setArray[$mainKey]));
            $result[$mainKey][$subKey] = $setArray[$mainKey][$subKey];
        }
        return $result;
    }

    function setOrderValue($tmpKey, $type = '', $tableName = null) {
        if (is_null($tableName)) {
            $tableName = $this->mainTable;
        }
        $key = "";
        $result = false;
        if (array_key_exists($tmpKey, $this->dataConnect[$tableName])) {
            $key = $this->dataConnect[$tableName][$tmpKey];
            $this->orderValue[$tableName][$key] = $type;
            $result = true;
        }
        return $result;
    }

    function setChildTotalAll($label, $subLabel) {
        $result = false;
        if (is_array($this->dataContainer)) {
            foreach ($this->dataContainer As $id => $data) {
                if (array_key_exists($label, $data) && is_array($data[$label])) {
                    $this->dataContainer[$id][$label.$subLabel.'Total'] = $this->getChildTotal($id, $label, $subLabel);
                    $result = true;
                }
            }
        }
        return $result;
    }

    function setCommonList($id = "") {
        $this->_reset();
        if ($id) {
            $this->setIdSearch($this->primaryLabel, $id);
        }
        $tmpArray = $this->dataConnect[$this->mainTable];
        unset($tmpArray[$this->primaryLabel]);
        foreach ($tmpArray As $key => $value) {
            $getArray[] = $key;
        }
        $this->_setConnecterMain($getArray);
    }
//ゲッタ
    function getChildCount($mainId, $label) {
        $result = 0;
        if (array_key_exists($label, $this->dataContainer[$mainId]) && is_array($this->dataContainer[$mainId][$label])) {
            $result = count($this->dataContainer[$mainId][$label]);
        }
        return $result;
    }

    function getChildTotal($mainId, $label, $subLabel) {
        $result = 0;
        if (array_key_exists($label, $this->dataContainer[$mainId]) && is_array($this->dataContainer[$mainId][$label])) {
            foreach ($this->dataContainer[$mainId][$label] As $key => $value) {
                if (array_key_exists($subLabel, $value)) {
                    $result += $value[$subLabel];
                } else {
                    break;
                }
            }
        }
        return $result;
    }

    function getTableName() {
        return $this->mainTable;
    }
}
?>
