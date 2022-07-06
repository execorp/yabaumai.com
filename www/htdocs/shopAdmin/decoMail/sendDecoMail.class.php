<?
//クラス概要
//このクラスはメールを送信するクラスのラッパークラスです

$mainDirectory = dirname(__FILE__) . "/";
require_once($mainDirectory . "getEmailList.inc.php");
require_once($mainDirectory . "decoFunction.class.php");
require_once(DECO_INC_PATH . "commonObject.class.php" );
require_once(DECO_INC_PATH . "dao/decoImageDAO.class.php");
require_once(DECO_INC_PATH . "dao/decoHistoryDAO.class.php");
class sendDecoMail extends commonObject
{
    var $historyDAO;
    var $imageDAO;
    var $deco;
    var $data;
    var $stopFlg;
    var $fileNameTmpArray;
    var $emoji_obj;

    function sendDecoMail($domain, $emoji_obj, $logFile = "", $testFlg = 0, $stopFlg = 0) {
        $this->historyDAO = new decoHistoryDAO($testFlg);
        $this->imageDAO   = new decoImageDAO($testFlg);
        $this->deco       = new decoFunction();
        $this->setTest($testFlg);
        $this->setLoging($logFile);
        $this->emoji_obj  = $emoji_obj;
        $this->stopFlg    = $stopFlg;
        $this->domain     = $domain;
    }

    function sendStart($data, $save="") {
        $this->setMailCondition($data['historyId'], 1);
        //メール送信準備
        $UPFILE    = array();

        $MAIL_DATA = array();
        $MAIL_DATA['TODATA']  = array();
        $MAIL_DATA['CCDATA']  = array();
        $MAIL_DATA['BCCDATA'] = array();

        $MAIL_DATA['TODATA'][$to_address] = '';
        $MAIL_DATA['from_name']   = '';  //各お店の名前
        $MAIL_DATA['from_add']    = $data['mailFrom'];
        $MAIL_DATA['repry_name']  = '';
        $MAIL_DATA['repry_to']    = $data['mailFrom'];
        $MAIL_DATA['return_path']    = $data['mailFrom'];
//        $MAIL_DATA['return_path'] = $data['shopId'] . "-" . MM_ADDRESS;  //お店ごとに処理	{$shopId}@error.exe-mail.com

        $fileName = $this->makeImage($data['page'], $data['shopId']);

        if ($save) {
            require_once($mainDirectory . "decoConv.class.php");
            $decoConv = new decoConv($this->domain,1);
            $decoConv->setDecoMail($data['mailBodyHtml']);
            $decoConv->setImgList($imgList);
            $decoConv->allConv();
            $data['mailBodyHtml'] = $decoConv->getDecoMail();
        }

        $MAIL_DATA['subject']    = $data['mailSubject'];
        $MAIL_DATA['body_plain'] = $this->deco->stripSlushR4mail($data['mailBody']);
        $bodyHtml = $this->deco->stripSlushR4mail($data['mailBodyHtml']);

        //送信条件設定
        if($data['decoMail']){
            $SETTING_DATA['decome_mode'] = '1';
        }else{
            $SETTING_DATA['decome_mode'] = '';
        }
        if ($data['testSend'] > 0) {
            $MAIL_DATA['subject']    = $data['mailSubject'] . "(テスト)";
            $sendTarget = "test";
        } else {
            $sendTarget = "member";
        }
        if ($this->testFlg != "") {
            $sendTarget = "debug";
        }
        $SETTING_DATA['mail_code']   = 'JIS';
        $SETTING_DATA['encode_pass'] = '';
        $SETTING_DATA['input_code']  = 'SJIS';
        $katakana_chg_cancel         = '1';

        echo "data<br>\n";
        refrain_print($data);
        //送信先設定「getEmailList.inc.php」内に存在
        $eMailArray = getEmailList($data, $this->testFlg);
        echo "address count.".count($eMailArray)."<br>\n";

        //アドレス一覧を元に送信
        if (is_array($eMailArray)) {
            $sendCount = count($eMailArray);
            chdir('/tmp/');
            $ownerTotal = 0;
            foreach ($eMailArray AS $key => $value) {
                unset($MAIL_DATA['TODATA']);
                $toAddr = $value['mailAddress'];
                $ownerTotal += $value['ownerFlg'];
                if ($data['decoMail']) {
                    if ($value['textOnly'] > 0 || $textOnly > 0) {
                        $SETTING_DATA['decome_mode'] = '';
                        unset($MAIL_DATA['body_html']);
                        $text = "plain";
                    } else if (!array_key_exists('body_html', $MAIL_DATA)) {
                        $SETTING_DATA['decome_mode'] = '1';
                        $MAIL_DATA['body_html']  = $bodyHtml;
                        $text = "deco";
                    }
                    echo $text . ":";
                }
                $MAIL_DATA['TODATA'][$toAddr] = '';
                $SETTING_DATA['to_career']   = $this->emoji_obj->get_mail_career($toAddr);
                //キャリアで転送エンコードを変更
                if ($SETTING_DATA['to_career'] == 'SoftBank') {
                    $SETTING_DATA['content_transfer_encoding'] = '8bit';
                } else {
                    $SETTING_DATA['content_transfer_encoding'] = 'base64';
                }
                // 停止フラグで送信可否を判断する
                if (!$this->stopFlg) {
                    //送信処理本体
                    if ($toAddr) {
                        if ($this->emoji_obj->emoji_decome($MAIL_DATA, $SETTING_DATA, $UPFILE, $katakana_chg_cancel)) {
                            $send_state = " send ok.";
                        } else {
                            $send_state = " send error.";
                        }
                    } else {
                        $send_state = " address is not found.";
                    }
                } else {
                    $send_state = " stop.";
                }
                $this->testDump($toAddr . $send_state . " ----\n",'mail');
            }
        }
        $this->delImage($fileName);
        $this->setMailCondition($data['historyId'], 2);
    }

    function setMailCondition($id, $state) {
        if ($this->testFlg == 0 &&  $this->stopFlg == 0 && $id > 0) {
            //ステータス変更
            $this->historyDAO->clearSearchValue();
            $updArray['historyId'] = $id;
            $updArray['state'] = $state;
            if ($state == 2) {
                $updArray['endDateTime'] = getDateTime();
            }
            $this->historyDAO->updateRecord($updArray);
        }
    }

    function makeImage($page, $shop = "") {
        //メール画像準備
        if ($shop) {
            $this->imageDAO->setSearchValue('shopId', $shop);
        }
        $this->imageDAO->setDecoImageList($page);
        $imgArray = $this->imageDAO->getDataContainer();
        $imgNumDef = $page * 10;
        if (is_array($imgArray)) {
            foreach ($imgArray as $key => $value) {
                if($value['type'] == 'image/jpeg' || $value['type'] == 'image/pjpeg') $extension = '.jpg';
                if($value['type'] == 'image/gif')$extension = '.gif';
                if($value['type'] == 'image/png' || $value['type'] == 'image/x-png')  $extension = '.png';
                $i = $key - $imgNumDef;
                if ($shop) {
                    $imgList[$value['imageNo']] = 'image_' . $this->domain . '-' . $shop . '-' . $page . '-' . $i . $extension;
                    $fileName = "/tmp/image_" . $this->domain . "-" . $shop . "-" . $page . "-" . $i . $extension;
                } else {
                    $imgList[$value['imageNo']] = 'image_' . $this->domain . '-' . $page . '-' . $i . $extension;
                    $fileName = "/tmp/image_" . $this->domain . "-" . $page . "-" . $i . $extension;
                }
                $fileNameArray[] = $fileName;
                $fp = fopen($fileName, "w");
                fputs($fp, $value['contents']);
                fclose($fp);
            }
        }
        return $fileNameArray;
    }

    function delImage($fileNameArray) {
        //メール画像削除
        if (is_array($fileNameArray)) {
            foreach($fileNameArray AS $key => $value){
                unlink($value);
            }
        }
    }
}
?>
