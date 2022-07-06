<?php
	require_once( "../inc/auth.php" );
	require_once( "../inc/.ht_Config.php" );
	require_once( "./adminConfig.php" );

	$modeDef = 'secure';
	($_GET['mode'])?$mode = $_GET['mode']:$mode = $modeDef;
	
	if($_GET['file']){
		//セキュアモードの場合 ⇒ FILE_PATHを参照
		if( FILE_PATH == 'FILE_PATH' ){
			echo("FILE_PATHが設定されていません。");
			exit;
		}
		
		if($mode == 'secure'){
			$filename = FILE_PATH . $_GET['file'];
		}else{
			$filename = $_GET['file'];
		}
	}else{
		echo('ファイル名が指定されていません。');
		exit;
	}
	
	$mime_type = mime_content_type($filename);
	$len = filesize($filename);
	
	header("Content-type:" . $mime_type . "");
	header("Content-Length: " . $len . "");
	header("Content-Disposition: inline; filename=" . $_GET['file'] . "");
	readfile($filename);
?>
