<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=shift-jis" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-Script-Type" content="text/javascript" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>::: ImageMagick :: �A�j��GIF���T�C�Y�e�X�g :::</title>
</head>
<body>
<h1>::: ImageMagick :: �A�j��GIF���T�C�Y�e�X�g :::</h1><br />
	
<?
	
switch($_GET['re']){
	case 1:
		exec('convert img/test.gif -coalesce -resize 150x40 -deconstruct -colors 8 img/test_re1.gif');
		echo('<img src="img/test_re1.gif">');
		echo(' (' . filesize("img/test_re1.gif") . 'byte)');
	break;
	
	case 2:
		exec('convert img/test.gif -coalesce -resize 150x40 -deconstruct -colors 16 img/test_re2.gif');
		echo('<img src="img/test_re2.gif">');
		echo(' (' . filesize("img/test_re2.gif") . 'byte)');
	break;
	
	case 3:
		exec('convert img/test.gif -coalesce -resize 150x40 -deconstruct -colors 32 img/test_re3.gif');
		echo('<img src="img/test_re3.gif">');
		echo(' (' . filesize("img/test_re3.gif") . 'byte)');
	break;
	
	case 4:
		exec('convert img/test.gif -coalesce -resize 150x40 -deconstruct -colors 64 img/test_re4.gif');
		echo('<img src="img/test_re4.gif">');
		echo(' (' . filesize("img/test_re4.gif") . 'byte)');
	break;
	
	case 5:
		exec('convert img/test.gif -coalesce -resize 150x40 -deconstruct img/test_re5.gif');
		echo('<img src="img/test_re5.gif">');
		echo(' (' . filesize("img/test_re5.gif") . 'byte)');
	break;
	
	default:
		echo('<img src="img/test.gif">');
		echo(' (' . filesize("img/test.gif") . 'byte)');
	break;
}

echo('<br /><br /><a href="imagic.php">���T�C�Y��</a>�b<a href="imagic.php?re=1">���T�C�Y8�F</a>�b<a href="imagic.php?re=2">���T�C�Y16�F</a>�b<a href="imagic.php?re=3">���T�C�Y32�F</a>�b<a href="imagic.php?re=4">���T�C�Y64�F</a>�b<a href="imagic.php?re=5">���T�C�Y���F</a>');

?>

</body>
</html>