<?
// 基幹部分の読み込み
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

$basePath = dirname(__FILE__) . "/";
//基幹フォルダ
$incFolder = "inc";
$baseInc = $basePath . "../../" . $incFolder . "/";
if (is_dir($baseInc . "dao/") && is_dir($baseInc . "adv/")) {
    define('DECO_INC_PATH', $baseInc );
} else {
    define('DECO_INC_PATH', $basePath."inc/" );
}
if (file_exists($baseInc.".ht_Config.php")) {
    require_once(DECO_INC_PATH . ".ht_Config.php");
} else if (file_exists($baseInc."config.php")) {
    require_once(DECO_INC_PATH . "config.php");
} else if (file_exists($baseInc."config.inc")) {
    require_once(DECO_INC_PATH . "config.inc");
}
//各種データ（クッキー、セッション、受信データ）アクセスクラス読込
require_once(DECO_INC_PATH . "BaseValueDAO.class.php");
$valueContainer = new BaseValueDAO();
$cookieArray = $valueContainer->getClient();
$sessionArray = $valueContainer->getHost();
$sendArray = $valueContainer->getSend();
$fileArray = $valueContainer->getFile();
$debug = $sendArray['debug'];
if ($debug != 0) {
    echo "clientValue<br>\n";
    refrain_print($cookieArray);
    echo "<br>\n";
    echo "serverValue<br>\n";
    refrain_print($sessionArray);
    echo "<br>\n";
    echo "sendValue<br>\n";
    refrain_print($sendArray);
    echo "<br>\n";
    echo "fileValue<br>\n";
    refrain_print($fileArray);
    echo "<br>\n";
}
//状態配列
$stateList = array(
                '0' => '送信待',
                '1' => '送信中',
                '2' => '送信済',
                '3' => '送信失敗',
                '4' => '配信予約'
);
require_once($basePath . "advance.config.php");
?>
