<?
//クラス概要
//PHP内部データを一元管理する
//クライアント側のクッキー、サーバー側のセッション、送信されたファイル、送信されたデータをそれぞれコンテナに格納する
//　09/12/11　ver 1.00　基本動作作成（takeoka）

//基本DAOクラス構成

//メンバー変数
//$clientArray(array)クッキー格納配列
//  $clientArray[クッキー名(str)] = 格納値(any);

//$hostArray(array)セッション格納配列
//  $hostArray[セッション名(str)] = 格納値(any);

//$fileArray(array)fileで送信されたファイル格納配列
//  $fileArray[ファイル名(str)] = 格納値(any);

//$sendArray(array)httpリクエスト格納配列(同じ項目名が存在する場合postが優先される)
//  $sendArray[変数名(str)] = 格納値(any);

//メンバー関数
//commitClient(値(str/array), 有効期限(int)・省略可)
//動作　クッキーへの値の格納を行う。

//commitHost(値(str/array)) 
//動作　セッションへの値の格納を行う

//ゲッタ
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
//セッタ+α
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
//ゲッタ
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
