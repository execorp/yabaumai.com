<?
	require_once( "../inc/.ht_Config.php" );

	
	//JSON^¶ñÉÏ·
	$FlashVars = '<>';
	foreach($areaArray AS $key => $value){
		$FlashVars .= $value . ':,';
		foreach(${'areaArray' . $key} AS $num => $item){
				$FlashVars .= $item . ',';
		}
		$FlashVars = rtrim($FlashVars, ',');
		$FlashVars .= '<>';
	}
	$FlashVars = rtrim($FlashVars, ',');
	
	header("Content-type: text/html; charset=sjis");
	echo('<script src="../js/AC_RunActiveContent.js" language="javascript"></script>');
	echo($FlashVars);
?>