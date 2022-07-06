<?
$MySQLHOST     = "localhost";
$MySQLUserName = "root";
$MySQLPasswd   = "1188";
$MySQLDatabase = "hakui-angel";

$dsn = array(
    "phptype"  => "mysqli",
    "username" => $MySQLUserName,
    "password" => $MySQLPasswd,
    "hostspec" => $MySQLHOST,
    "database" => $MySQLDatabase
);

/* --- ƒƒOƒCƒ“—p --- */
$params = array(
    'dsn'         => "mysqli://$MySQLUserName:$MySQLPasswd@$MySQLHOST/$MySQLDatabase",
    'table'       => 'loginMaster',
    'usernamecol' => 'loginId',
    'passwordcol' => 'passWord',
    'cryptType'   => 'none' ,
    'db_fields'   => array( 'userId', 'userName', 'userLevel', 'useFlg', 'lastLogin' )
);
?>
