<?php
//クラス概要
//対ライブドアブログ専用更新クラス

require_once(dirname(__FILE__) . "/blogManagerAtom.class.php");
class blogManagerLD extends blogManagerAtom {
    var $defaultHost;
    function setBlogConnection($host, $user, $password, $script = "" ,$encoding = "UTF-8") {
        $host = 'blog.livedoor.jp';
        $this->defaultHost = $host;
        $this->setDefaultScript($host, $script);
        $this->connection[$host]['encoding'] = $encoding;
        $this->connection[$host]['user']     = $user;
        $this->connection[$host]['password'] = $password;
    }

    function postBlog() {
        $result = $this->postBlogHost($this->defaultHost);
        return $result;
    }

    function getBlogAtomURL($host) {
        $href = "";

        // atom.xml オープン
        $intSes  = curl_init();

        curl_setopt($intSes,CURLOPT_URL,'http://' . $host .  "/" . $this->connection[$host]['user'] . $this->connection[$host]['script']);
        curl_setopt($intSes,CURLOPT_RETURNTRANSFER, true);
        $atomxml = curl_exec($intSes);
        curl_close($intSes);
        $href = $this->getAtomUrl($atomxml);
        return $href;
    }
}
?>
