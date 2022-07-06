<?

require_once("/var/www/fucafe/www/htdocs/inc/.ht_Config.php" );
require_once("/var/www/fucafe/www/htdocs/inc/magpierss/rss_fetch.inc");
require_once("HTTP/Request.php");

define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');
$cnt = 0;
$res = 0;

//未来記事削除
$now = date("Y-m-d H:i:s");
$db->query( "DELETE FROM `whatsNew` WHERE `dateTime` > ? AND `feedFlg` = ?", array($now, 1));

//同じ記事を取得してしまっている場合削除
$whatsNew = $db->getAssoc( "SELECT `imgId`, `filePath` FROM `whatsNew` WHERE `feedFlg` = '1' ORDER BY `imgId`" );
foreach($whatsNew AS $key => $value){
	//重複チェック
	$dubble = $db->getOne( "SELECT `imgId` FROM `whatsNew` WHERE `filePath` = ? AND `imgId` > ? AND `feedFlg` = ? ", array($value, $key, 1));
	if($dubble){
		$db->query( "DELETE FROM `whatsNew` WHERE `imgId` = ? AND `feedFlg` = ? ", array($key, 1));
		$cnt++;
	}
}
echo('重複している記事を' . $cnt . '件削除しました。');

?>