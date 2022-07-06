<?
//クラス概要
//GETパラメーター付きURLを一元管理する
//　09/12/11　ver 1.00　基本動作作成（takeoka）

//DB基本DAOクラス構成
//メンバー変数
//$baseUrl  = ドメイン名(str);
//$noCookie = クッキーの有無(int);

//メンバー関数
//getUrl(ファイルのURL(str), GETとして追加する値(array(変数名=>値)))
//URLを取得する。

//getAbsoluteUrl(ファイルのURL(str), GETとして追加する値(array(変数名=>値)), 暗号化の有無(int))
//フルパスでURLを取得する。

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
