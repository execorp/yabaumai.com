<?
// �z�u����Ă���ʒu�ɉ�����DB�t�@�C����ǂݍ���
$dbAccessFile = ".ht_DBConnect.inc";
if (file_exists(dirname(__FILE__) . "/" . $dbAccessFile)) {
    require_once(dirname(__FILE__) . "/" . $dbAccessFile);
} else {
    require_once(dirname(__FILE__) . "/../../" . $incFolder . "/" . $dbAccessFile);
}
define(SQL_HOST, $MySQLHOST);
define(SQL_USER, $MySQLUserName);
define(SQL_PASS, $MySQLPasswd);
define(SQL_DB_NAME, $MySQLDatabase);
require_once(dirname(__FILE__) . "/mySql.class.php");
?>
