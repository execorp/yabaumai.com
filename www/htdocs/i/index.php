<?
require_once( "../inc/.ht_Config.php" );
include_once( "emojilib/lib/mobile_class_8.php" );

$HARDDATA = $emoji_obj->Get_PhoneData();

if( $HARDDATA['hard'] == "PC" ) $pc = "?s=1";

header( "HTTP/1.0 301 Moved Permanently" ) ;
header( "Location: http://www." . domain . $pc . "" ) ;
?>