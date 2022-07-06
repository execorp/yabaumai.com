<?php
//クラス概要
//対ヤフーブログ専用更新クラス

require_once(dirname(__FILE__) . "/blogManagerHttp.class.php");
class blogManagerYH extends blogManagerHttp {
    function setBlogConnection($host, $user, $password, $script = "" ,$encoding = "EUC-JP") {
        $host = 'yahoo.co.jp';
        $this->defaultHost = $host;
        $this->doorScript  = 'https://login.yahoo.co.jp/config/login?.src=blog&.done=http://blogs.yahoo.co.jp/NBLOG/makeblog.html?.src=blog%26.done%3Dhttp://blogs.yahoo.co.jp';
        $this->loginScript = $this->doorScript;
        $this->writeScript = 'http://blogs.yahoo.co.jp/'.$user.'/MYBLOG/write.html';
        $this->blogScript  = 'http://post2.blogs.yahoo.co.jp/'.$user.'/MYBLOG/write_proc.html';
        $this->setDefaultScript($host, $script);
        $this->connection[$host]['encoding'] = $encoding;
        $this->connection[$host]['user']     = $user;
        $this->connection[$host]['password'] = $password;
    }

    function _makeLoginFormData($text = "") {
        $result['login'] = $this->connection[$this->defaultHost]['user'];
        $result['passwd'] = $this->connection[$this->defaultHost]['password'];
        return $result;
    }

    function _makeBlogFormData($text = "") {
        $result = $this->_getFormData($text, $this->blogScript);
        $result['title']  = $this->_code2hostCode($this->contents['title']);
        $result['content'] = $this->_code2hostCode($this->contents['content']);
        if ($result['fid'] > 0) {
        } else {
            $result['fid'] = $result['_fid'];
        }
        return $result;
    }
}
?>
