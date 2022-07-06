<?
require_once( ".ht_Config.php" );
require_once( "Auth.php" );

$authObjClient = new Auth( "DB", $paramsClient, "loginFunction" );

//セッション定数格納
define('CLIENT_SHOP_ID', $_SESSION["_authsession"]["data"]["shopId"]);
define('CLIENT_SHOP_NAME', $_SESSION["_authsession"]["data"]["shopName"]);
define('CLIENT_AREA_ID', $_SESSION["_authsession"]["data"]["areaId"]);

if ( !$authObjClient->getAuth() ){
    Header( "Location: ./logIn.php" );
    exit;
}

?>