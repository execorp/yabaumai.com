<?
require_once( "../inc/.ht_Config.php" );
require_once("Auth.php");

function loginFunction( $username, $status ){
    require_once("authForm.php");
}

$authObjClient = new Auth("DB", $paramsClient, "loginFunction");
$authObjClient -> start();

if( $authObjClient->getAuth() ){
    Header( "Location: ./index.php" );
    exit;
}
?>
