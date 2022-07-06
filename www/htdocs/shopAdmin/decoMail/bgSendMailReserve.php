#!/usr/local/bin/php
<?
//予約配信用プログラム
//ここでは送るメールの内容だけ指定
//処理の本体は「sendDecoMail.class.php」内
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
$timeCount = time();
$sendTime = date("Y-m-d H:i:s", mktime(date('H'), 0, 1, date('m'), date('d'), date('Y')));
$nowTime = date("Y-m-d H:i:s", time());
require_once(dirname(__FILE__) . "/sendDecoMail.class.php");

require_once("emojilib/lib/mobile_class_8.php");
/*---------------------------------------------------------------------
/* INIT
----------------------------------------------------------------------*/
set_time_limit(0);
//$log = dirname(__FILE__) . '/templates_c/mail.txt';
/*---------------------------------------------------------------------
/* DAO
----------------------------------------------------------------------*/
$decoHistoryDAO = new decoHistoryDAO();
/*---------------------------------------------------------------------
/* MODEL & VALIDATE
----------------------------------------------------------------------*/
$decoHistoryDAO->setSearchValue('state', 4);
$decoHistoryDAO->setSearchValue('startDateTime', $sendTime,'small');
$decoHistoryDAO->setHistoryInfo();
$dataArray = $decoHistoryDAO->getDataContainer();
refrain_print($dataArray);
$sendDecoMail = new sendDecoMail($domain,$emoji_obj,$log,0,0);
if (is_array($dataArray)) {
    foreach($dataArray As $key => $dataSet) {
        $sendDecoMail->sendStart($dataSet);
    }
}
$endCount = time() - $timeCount;
echo "<br>time is ".$endCount.".<br>\n";
?>
