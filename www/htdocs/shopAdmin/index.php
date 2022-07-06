<?
//require_once( "../inc/auth.php" );
require_once( "../inc/authClient.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "./adminConfig.php" );

if( !$_GET['category'] ) $_GET['category'] = "home"; 
if( !$_GET['page'] )     $_GET['page']     = "home"; 

$siteName   = siteNamePrint;

//HTML書き出し
$html = <<<EOF
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<title>::: $siteName 管理システム :::</title>
</head>
<frameset rows="115,*,0" cols="1*" border="0">
	<frame src="adminHeader.php?category={$_GET['category']}" name="topframe" frameborder="0" noresize scrolling="no" marginwidth="0" marginheight="0">
	<frameset cols="175,*" rows="1*" border="0">
		<frame src="adminMenu.php?category={$_GET['category']}" name="menuframe" frameborder="0" noresize scrolling="no" marginwidth="0" marginheight="0">
		<frame src="$_GET[page].php" name="mainframe" frameborder="0" noresize scrolling="auto" marginwidth="3" marginheight="0">
	</frameset>
	<frame src="adminBlank.php" name="bottomframe" frameborder="0" noresize scrolling="no" marginwidth="0" marginheight="0">
	<NOFRAMES>
		<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red">
			<p>
			このページはframeを使ってます。
			</p>
		</body>
	</NOFRAMES>
</frameset>
</html>

EOF;


echo  $html;

?>