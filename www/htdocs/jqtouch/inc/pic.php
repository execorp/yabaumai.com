<?
require_once("./.ht_DBConnect.inc");

//db����img��ǂݏo���\��
$MySQLTable = $_GET["t"];
if( !isset( $MySQLTable ) ) $MySQLTable = "galImage";
$MyLink     = mysql_connect( $MySQLHOST, $MySQLUserName, $MySQLPasswd );
mysql_select_db( $MySQLDatabase, $MyLink );
$MyQuery    = "SELECT `contents`, `type`, `size` FROM `" . $MySQLTable . "` WHERE `imgId` = '" . $_GET["imgId"] . "' \n";
$MyResult   = mysql_query($MyQuery, $MyLink);
mysql_close( $MyLink );
    while($row=mysql_fetch_array($MyResult)){
        $imgData  = $row["contents"];
        $imgType  = $row["type"];
        $imgSize  = $row["size"];
    }

if( $imgType == "image/pjpeg" )	$imgType = "image/jpeg";

/*
Mac�o�C�i���[�΍�		application/x-macbinary
�擪��128�o�C�g���폜
*/

if( $imgType == "application/x-macbinary" ) $imgData = substr( $imgData, 128 );

header( "Content-Length: ".$imgSize );
header( "Content-type: ".$imgType) ;
echo $imgData;
?>