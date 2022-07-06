<?php
//クラス概要
//対アメーバブログ専用更新クラス

require_once(dirname(__FILE__) . "/blogManagerAtom.class.php");
class blogManagerAB extends blogManagerAtom {
    var $defaultHost;
    function setBlogConnection($host, $user, $password, $script = "" ,$encoding = "UTF-8") {
        $host = 'blog.ameba.jp';
        $this->defaultHost = $host;
        $this->setDefaultScript($host, $script);
        $this->connection[$host]['encoding'] = $encoding;
        $this->connection[$host]['user']     = $user;
        $this->connection[$host]['password'] = md5($password);
    }

    function postBlog() {
        $result = $this->postBlogHost($this->defaultHost);
        return $result;
    }

    function getBlogAtomURL($host) {
        $href = 'http://atomblog.ameba.jp/servlet/_atom/blog/0';
        return $href;
    }

    function makeSendXML($host) {
        $result = '<?xml version="1.0" encoding="utf-8"?>'.
                    '<entry xmlns="http://purl.org/atom/ns#" '.
                    'xmlns:app="http://www.w3.org/2007/app#" '.
                    'xmlns:mt="http://www.movabletype.org/atom/ns#">'.
                    '<title>' . $this->_convertEncoding($this->contents['title'], $this->connection[$host]['encoding'], "SJIS-win") . '</title>';
        $result .='<content type="application/xhtml+xml">' . $this->_convertEncoding($this->contents['content'], $this->connection[$host]['encoding'], "SJIS-win") . '</content>';
        $result .='<updated>' . $this->contents['dateTime'] . '</updated>';
        $result .='</entry>';
        return $result;
    }

    function makeNonce() {
        $tmpTime = explode(' ', getDateTime());
        $this->nonceTime = $tmpTime[0] . "T" . $tmpTime[1] . "Z";
        $sCharList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $result = "";
        for ($i = 0; $i < 20; $i++) {
            $result .= substr($sCharList, rand(0,strlen($sCharList) - 1), 1);
        }
        return $result;
    }

    function sendXMLOption() {
        $result = "<updated>" . $this->contents['dateTime'] . "</updated>";
        return $result;
    }
}
?>
