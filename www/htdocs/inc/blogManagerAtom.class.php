<?php
//クラス概要
//Atomに対応したブログを更新するための管理class

//HTTPリクエスト処理用
require_once "HTTP/Request.php";

require_once(dirname(__FILE__) . "/baseBlogPost.class.php");
class blogManagerAtom extends baseBlogPost {
    var $nonceTime;
    function setDefaultScript($host, $script) {
        if ($script == "") {
            $script = "/atom.xml";
        }
        $this->connection[$host]['script'] = $script;
    }

    function postBlog() {
        if (is_array($this->connection)){
            foreach($this->connection As $host => $data) {
                if (is_array($data)) {
                    $result[$host] = $this->postBlogHost($host);
                }
            }
        }
        return $result;
    }

    function postBlogHost($host) {
        if (is_array($this->connection[$host]) && isset($this->contents['title'])) {
            $url = $this->getBlogAtomURL($host);
            if (trim($url) == "" ) {
                $result = false;
            } else {
                $req = new HTTP_Request();
                $req->setURL($url);
                $wsse = $this->makeWSSE($host);
                $req->addHeader('X-WSSE', $wsse);
                $req->addHeader('Cache-Control', 'no-cache');
                $req->setMethod(HTTP_REQUEST_METHOD_GET);
                $result = $req->sendRequest();
//                $this->printResponse($result);

                $req->addHeader('content-type', 'application/x.atom+xml');
                $req->setMethod(HTTP_REQUEST_METHOD_POST);
                $rawd = $this->makeSendXML($host);
                $req->addRawPostData($rawd);
                $result = $req->sendRequest();
//                $this->printResponse($result);
            }
        } else {
            $result = false;
        }
        return $result;
    }

    function getAtomUrl($text) {
        preg_match('/<link\s*rel="service.post".*href=".*"\s*title=".*"\s*\/>/', $text, $tmpArray);
        $divArray  = explode('href="', $tmpArray[0]);
        $url = explode('"', $divArray[1]);
        $result = $url[0];
        return $result;
    }

    function makeWSSE($host) {
        $nonce = $this->makeNonce();
        $result = 'UsernameToken Username="' . $this->connection[$host]['user'] . '", '.
                    'PasswordDigest="' . base64_encode($this->makePassDigest($host, $nonce)) . '", '.
                    'Nonce="' . base64_encode($nonce) . '",'.
                    'Created="' . $this->nonceTime . '"';
        return $result;
    }

    function makePassDigest($host, $nonce) {
        $result = pack('H*', sha1($nonce . $this->nonceTime . $this->connection[$host]['password']));
        return $result;
    }

    function makeNonce() {
        $this->nonceTime = getDateTime();
        $result = pack('H*', sha1(md5(time())));
        return $result;
    }

    function makeSendXML($host) {
        $result = '<?xml version="1.0" encoding="UTF-8"?>'.
                    '<entry xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" '.
                    'xmlns:app="http://www.w3.org/2007/app#" xmlns:mt="http://www.movabletype.org/atom/ns#">'.
                    '<title type="text/html" mode="escaped">' . $this->_convertEncoding($this->contents['title'], $this->connection[$host]['encoding'], "SJIS-win") . '</title>'.
                    '<dc:subject type="text/html" mode="escaped">' . $this->_convertEncoding($this->contents['category'], $this->connection[$host]['encoding'], "SJIS-win") . '</dc:subject>';
        $result .='<content type="application/xhtml+xml" mode="base64">' . base64_encode($this->_convertEncoding($this->contents['content'], $this->connection[$host]['encoding'], "SJIS-win")) . '</content>';
        $result .='</entry>';
        return $result;
    }

    function getBlogAtomURL($host) {
        //Atomの絶対パスを設定する。
        exit('getBlogAtomURL un defined.');
    }
    

    function printResponse($req, $str) {
        echo "<br>".$str."<br>\n";
        $code = $req->getResponseCode();
        refrain_print($code);
        $header = $req->getResponseHeader();
        refrain_print($header);
        $body = $req->getResponseBody();
        refrain_print($body);
    }
}
?>
