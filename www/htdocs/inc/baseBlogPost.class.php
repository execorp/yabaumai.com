<?php
//クラス概要
//ブログを更新するための基幹クラス

require_once(dirname(__FILE__) . "/commonObject.class.php");
class baseBlogPost extends commonObject {
    var $connection;
    var $contents;

    function baseBlogPost() {
        $this->connection = array();
        $this->contents   = array();
    }

    function setBlogConnection($host, $user, $password, $script = "" ,$encoding = "UTF-8") {
        $this->setDefaultScript($host, $script);
        $this->connection[$host]['encoding'] = $encoding;
        $this->connection[$host]['user']     = $user;
        $this->connection[$host]['password'] = $password;
    }

    function setBlogContents($title, $content, $dateTime = "", $category = "") {
        $this->contents['title']    = $title;
        $this->contents['content']  = $content;
        $this->contents['category']  = $category;
        if ($dateTime == "") {
            $this->contents['dateTime'] = getDateTime();
        } else {
            $this->contents['dateTime'] = $dateTime;
        }
    }

    function _convertEncoding($data, $toCode, $fromCode) {
        return mb_convert_encoding($data, $toCode, $fromCode);
    }

    function setDefaultScript($host, $script) {
        //スクリプトのパスを設定する。
        exit('setDefaultScript un defined.');
    }

    function postBlog() {
        //ブログ更新処理本体を設定する。
        exit('postBlog un defined.');
    }

}
?>
