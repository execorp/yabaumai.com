<?php
//クラス概要
//RPCに対応した複数のブログを一括更新するための管理class

//XML-RPC package 読み込み
require_once("XML/RPC.php");

require_once(dirname(__FILE__) . "/baseBlogPost.class.php");
class blogManagerRPC extends baseBlogPost {

    function setDefaultScript($host, $script) {
        if ($script == "") {
            $script = "/xmlrpc.php";
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
            //クライアントの作成
            $client = new XML_RPC_client($this->connection[$host]['script'], $host, 80);
            //送信データ
            $value[] = new XML_RPC_Value( 0, 'string');
            $value[] = new XML_RPC_Value($this->connection[$host]['user'], 'string');
            $value[]   = new XML_RPC_Value($this->connection[$host]['password'], 'string');
            $parameter['title'] = new XML_RPC_Value($this->_convertEncoding($this->contents['title'], $this->connection[$host]['encoding'], "SJIS-win"), 'string');
            $parameter['description'] = new XML_RPC_Value($this->_convertEncoding($this->contents['content'], $this->connection[$host]['encoding'], "SJIS-win"), 'string');
            $parameter['dateCreated'] = new XML_RPC_Value($this->contents['dateTime'], 'dateTime.iso8601');
            $value[] = new XML_RPC_Value($parameter, 'struct');
            $value[] = new XML_RPC_Value(1, 'boolean');
            //XML-RPCメソッドのセット
            $message = new XML_RPC_Message('metaWeblog.newPost', $value);
            $result = $this->_sendMessage($client, $message);
        } else {
            $result = false;
        }
        return $result;
    }

    function getUsersBlogs($host) {
        if (is_array($this->connection[$host])) {
            //クライアントの作成
            $client = new XML_RPC_client($this->connection[$host]['script'], $host, 80);
            $value[] = new XML_RPC_Value('', 'string');
            $value[] = new XML_RPC_Value($this->connection[$host]['user'], 'string');
            $value[] = new XML_RPC_Value($this->connection[$host]['password'], 'string');
            //メッセージ作成
            $message = new XML_RPC_Message("blogger.getUsersBlogs", $value);
            $result = $this->_sendMessage($client, $message);
        } else {
            $result = false;
        }
        return $result;
    }

    function _sendMessage($client, $message) {
        //メッセージ送信
        $messageResult = $client->send($message);
        if (!$messageResult) {
             exit('Could not connect to the server.');
        } else if($messageResult->faultCode()) {
             exit('XML-RPC fault ('.$messageResult->faultCode().'): ' . $messageResult->faultString());
        }
        $result = $this->_arrayConvEnc(XML_RPC_decode($messageResult->value()), "SJIS-win");
        return $result;
    }

    function _arrayConvEnc($data, $toCode) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $result[$key] = $this->_arrayConvEnc($value, $toCode);
            }
        } else if (is_string($data)) {
            $result = $this->_convertEncoding($data, $toCode, mb_detect_encoding($data));
        }
        return $result;
    }

}
