<?
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );

$result = $db->query( "SELECT `shopId`, `dateTime`, MAX(dateTime) FROM `whatsNew` GROUP BY `shopId` ORDER BY MAX(dateTime) DESC " );
//var_dump( $db );
echo "<table border=\"1\">\n";
echo "<tr><td bgcolor=\"#e4e4e4\">shopId</td><td bgcolor=\"#e4e4e4\">最終更新時間</td></tr>\n";

while( $row = $result -> fetchRow() ){
    echo "<tr><td>" . $row['shopId'] . "</td><td>" . $row['MAX(dateTime)'] . "</td></tr>\n";
    //$updateDataArray = array( $row['MAX(dateTime)'], $row['shopId'] );
    //$db->query( "UPDATE `shopMaster` SET `whatsNewTime` = ? WHERE `shopId` = ? ", $updateDataArray );
}
echo "</table>\n";

?>