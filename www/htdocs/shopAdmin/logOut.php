<?
require_once( "../inc/.ht_Config.php" );
require_once( "../inc/authClient.php" );

$authObjClient = new Auth( "DB", $paramsClient, "loginFunction" );
$authObjClient->logout();

ob_end_clean();

header("Location: ./logIn.php");
exit;
?>
