<?
require_once( "../inc/auth.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "./adminConfig.php" );

//HTML書き出し
$html = <<<EOF
<html>
<head>
<title>::: $siteName 管理システム :::</title>
</head>
</html>
EOF;

//HTML書き出し
print $html;

?>