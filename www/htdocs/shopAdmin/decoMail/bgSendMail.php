#!/usr/local/bin/php
<?
//通常配信用プログラム
//ここでは送るメールの内容だけ指定
//配信処理の本体は「sendDecoMail.class.php」内
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
$timeCount = time();
$mainDirectory = dirname(__FILE__) . "/";
require_once(dirname(__FILE__) . "/sendDecoMail.class.php");

require_once("emojilib/lib/mobile_class_8.php");
/*---------------------------------------------------------------------
/* INIT
----------------------------------------------------------------------*/
set_time_limit(0);
if ($_SERVER['HTTP_USER_AGENT']) {
    $debug = 1;
} else {
//    $fplog = fopen($mainDirectory.'/templates_c/mail.txt','a');
}
$page = $sendArray['page'];
$stop = $sendArray['stop'];
$save = $sendArray['data'];
$textOnly = $sendArray['text'];
/*---------------------------------------------------------------------
/* MODEL & VALIDATE
----------------------------------------------------------------------*/
if ($fplog) {
    fputs($fplog, "start.\n");
} else {
    echo "<br>\n";
}
if ($save > 0) {
    require_once(DECO_INC_PATH . "dao/decoDataDAO.class.php");
    $decoHistoryDAO = new decoDataDAO();
    $decoHistoryDAO->setDecoDataInfo($save);
    $mailData = $decoHistoryDAO->getDataContainer();
    refrain_print($mailData);

    if (is_array($mailData)) {
        $dataArray[$save]['page'] = $save;
        $dataArray[$save]['mailRecordId'] = 1;
        $dataArray[$save]['mailFrom'] = 'test@execute.jp';
        $dataArray[$save]['mailSubject'] = $mailData[$save]['subject'];
        $dataArray[$save]['mailBody'] = $mailData[$save]['plainMail'];
        $dataArray[$save]['mailBodyHtml'] = $mailData[$save]['htmlMail'];
        $dataArray[$save]['decoMail'] = 1;
        $dataArray[$save]['testSend'] = 1;
        $debug = 1;
    } else {
        exit;
    }
} else {
    require_once(DECO_INC_PATH . "dao/decoHistoryDAO.class.php");
    $decoHistoryDAO = new decoHistoryDAO();
    $decoHistoryDAO->setRange(1);
    if ($page > 0) {
        //指定したIDのメールを取得
        $decoHistoryDAO->setHistoryInfo($page);
        if (!$debug) {
            $stop = 1;
        }
    } else {
        if ($debug > 0) {
            //最新のメールを取得
            $decoHistoryDAO->setOrderValue('historyId', 1);
        } else {
            //最古の送信待ちメールを取得
            $decoHistoryDAO->setSearchValue('state', 0);
        }
        $decoHistoryDAO->setHistoryInfo();
    }
    $dataArray = $decoHistoryDAO->getDataContainer();
}
if ($fplog) {
    fputs($fplog, array_divider($dataArray));
} else {
    refrain_print($dataArray);
}
$sendDecoMail = new sendDecoMail($domain,$emoji_obj,$log,$debug,$stop);
if (is_array($dataArray)) {
    foreach($dataArray As $key => $dataSet) {
        $sendDecoMail->sendStart($dataSet,$save);
    }
} else {
    if ($fplog) {
        fputs($fplog, "no data.\n");
    } else {
        echo "no data.<br>\n";
    }
}
if ($fplog) {
    fclose($fplog);
}
$endCount = time() - $timeCount;
echo "time is ".$endCount.".<br>\n";
?>
