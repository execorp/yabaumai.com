<?
// ������̓ǂݍ���
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

$basePath = dirname(__FILE__) . "/";
//��t�H���_
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
//�e��f�[�^�i�N�b�L�[�A�Z�b�V�����A��M�f�[�^�j�A�N�Z�X�N���X�Ǎ�
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
//��Ԕz��
$stateList = array(
                '0' => '���M��',
                '1' => '���M��',
                '2' => '���M��',
                '3' => '���M���s',
                '4' => '�z�M�\��'
);
require_once($basePath . "advance.config.php");
?>
