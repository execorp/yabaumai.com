<?php
//クラス概要
//ブログを更新するための管理class

//HTTP処理用
require_once "HTTP/Client.php";

require_once(dirname(__FILE__) . "/baseBlogPost.class.php");
class blogManagerHttp extends baseBlogPost {
    var $defaultHost;
    var $doorScript;
    var $loginScript;
    var $writeScript;
    var $blogScript;

    function postBlog() {
        //初期設定
        $client = new HTTP_Client();
        $client->setMaxRedirects(5);
        //ログインページにアクセス
        $client->post($this->doorScript, "");
        $doorResponse = $client->currentResponse();
        //ログインデータをログイン用スクリプトに送信
        $loginData = $this->_makeLoginFormData($doorResponse['body']);
        $client->post($this->loginScript, $loginData);
        //ブログ作成ページにアクセス
        $client->post($this->writeScript, "");
        $writeResponse = $client->currentResponse();
        //ブログデータを更新用スクリプトに送信
        $blogData = $this->_makeBlogFormData($writeResponse['body']);
        $client->post($this->blogScript, $blogData);
        $result = $client->currentResponse();
        return $result;
    }

    function setDefaultScript($host, $script) {
    }

    function _getFormData($text, $url, $number = 1) {
        $data = $this->_hostCode2code($text);
        $divArray = explode($url, $data);
        $formData = explode('</form>', $divArray[$number]);
        $tmp = $this->_getHddinValue($formData[0]);
        if (is_array($tmp)) {
            foreach ($tmp As $key => $data) {
                $result[$key] = $data;
            }
        }
        $tmp = $this->_getSelectValue($formData[0]);
        if (is_array($tmp)) {
            foreach ($tmp As $key => $data) {
                $result[$key] = $data;
            }
        }
        return $result;
    }

    function _getHddinValue($text) {
        $repArray = explode('>', $text);
        if (is_array($repArray)) {
            foreach ($repArray As $key => $value) {
                $tmpArray = explode('input ', $value);
                if ($tmpArray[1] != "") {
                    $hiddenArray = explode(' ', $tmpArray[1]);
                    $hiddenData = array();
                    foreach ($hiddenArray As $id => $data) {
                        $tmpData = explode('=', $data);
                        if (is_array($tmpData)) {
                            $hiddenData[str_replace('"','',$tmpData[0])] = str_replace('"','',$tmpData[1]);
                        }
                    }
                    if ($hiddenData['name'] != '') {
                        $result[$hiddenData['name']] = $this->_code2hostCode($hiddenData['value']);
                    }
                }
            }
        }
        return $result;
    }

    function _getSelectValue($text) {
        $repArray = explode('</select>', $text);
        if (is_array($repArray)) {
            foreach ($repArray As $key => $data) {
                $tmpArray = explode('option ', $data);
                if (is_array($tmpArray)) {
                    $selectTmp = array_shift($tmpArray);
                    $selectArray = explode('select ', $selectTmp);
                    if (is_array($selectArray)) {
                        $selectNameSearch = str_replace('=',' ',$selectArray[1]);
                        $selectData = explode(' ', $selectNameSearch);
                        $selectName = '';
                        if (is_array($selectData)) {
                            $nameFlg = 0;
                            foreach ($selectData As $label => $value) {
                                if ($value == 'name') {
                                    $nameFlg = 1;
                                } else if ($nameFlg > 0 && $value != '') {
                                    $selectName = $value;
                                    $nameFlg = 0;
                                }
                            }
                        }
                        if ($selectName != '') {
                            foreach ($tmpArray As $label => $value) {
                                $search = str_replace('=',' ',$value);
                                $selectArray = explode(' ', $search);
                                $serectData = array();
                                $valueFlg = 0;
                                $selectFlg = 0;
                                foreach ($selectArray As $id => $data) {
                                    if ($data == 'value') {
                                        $valueFlg = 1;
                                    } else if ($data == 'selected') {
                                        $selectFlg = 1;
                                    } else if ($valueFlg > 0 && $data != '') {
                                        $selectValue = $data;
                                        $valueFlg = 0;
                                    }
                                }
                                if ($selectFlg == 1) {
                                    $result[str_replace('"', '', $selectName)] = $this->_code2hostCode(str_replace('"', '', $selectValue));
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

    function _code2hostCode($text) {
        return $this->_convertEncoding($text, $this->connection[$this->defaultHost]['encoding'], "SJIS-win");
    }

    function _hostCode2code($text) {
        return $this->_convertEncoding($text, "SJIS-win", $this->connection[$this->defaultHost]['encoding']);
    }

    function _makeLoginFormData($text = "") {
        //ログインフォームに送るデータを設定するためのメンバー関数
        exit('makeLoginData un defined.');
    }

    function _makeBlogFormData($text = "") {
        //ブログ更新の時に送るデータを設定するためのメンバー関数
        exit('makeBlogData un defined.');
    }
}
?>
