<?
require_once( "../inc/.ht_Config.php" );
require_once('thumbnail.trans.inc.php');
require_once( "DB.php" );
$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

/* --------------------------------------------- */
/* カバーSWF初期設定
/* --------------------------------------------- */
$time = time();
$quality = 90; //圧縮品質(%)
$width = 240; //最大横幅(px)
$height =160; //最大縦幅(px)
$tableName = 'coverImage'; //生成するコンテンツのテーブル名
$pathBase = '../thumb'; //キャッシュフォルダの場所
	
define('QUALITY', $quality);
define('MAX_WIDTH', $width);
define('MAX_HEIGHT', $height);
define('TABLE_NAME', $tableName);
define('CACHE_BASE_PATH', $pathBase);
define('CACHE_PATH', CACHE_BASE_PATH . '/' . TABLE_NAME);
define('BUFFER_BASE_PATH', CACHE_BASE_PATH . '/' . '_buf');
define('BUFFER_PATH', BUFFER_BASE_PATH . '/' . TABLE_NAME);

@mkdir(BUFFER_BASE_PATH); 
@mkdir(BUFFER_PATH);
@mkdir(CACHE_PATH);

/* --------------------------------------------- */
/* PHP4用 stream_get_contentsモドキ
/* --------------------------------------------- */
/*
if (!function_exists('stream_get_contents')) {
    function stream_get_contents($handle) {
        $contents = '';
        while (!feof($handle)) {
            $contents .= fread($handle, 8192);
        }
        return $contents;
    }
}
*/
/* --------------------------------------------- */
/* 携帯カバーFlash上位3枚取得
/* --------------------------------------------- */
if( GetMobileCareer( 0 ) == "PC" AND ( !isset( $_GET['s'] ) AND $_COOKIE["mobile"] != 1 ) ){

}else{
	$cover = $db->getAll('SELECT `imgId` FROM `coverImage` ORDER BY `priority` LIMIT !', array(3));
	$coverCount = count($cover);

	if($coverCount>0){
		//画像キャッシュが無い場合は、DBから画像を取得してキャッシュを出力
		foreach($cover AS $key => $row){
			if($cover[$key]['imgId']){
				$size = $db->getOne('SELECT `size` FROM `coverImage` WHERE `imgId` = ? LIMIT !', array($row['imgId'], 1));
				$type = $db->getOne('SELECT `type` FROM `coverImage` WHERE `imgId` = ? LIMIT !', array($row['imgId'], 1));
				$width = $db->getOne('SELECT `width` FROM `coverImage` WHERE `imgId` = ? LIMIT !', array($row['imgId'], 1));
				$height = $db->getOne('SELECT `height` FROM `coverImage` WHERE `imgId` = ? LIMIT !', array($row['imgId'], 1));
				
				switch($type){
					case 'image/jpeg':$ext = 'jpg';break;
					case 'image/pjpeg':$ext = 'jpg';break;
					case 'image/gif':$ext = 'gif';break;
					case 'image/png':$ext = 'png';break;
					case 'image/x-png':$ext = 'png';break;
				}
				if(!$ext){
					$file = $db->getOne('SELECT `file` FROM `coverImage` WHERE `imgId` = ? LIMIT !', array($row['imgId'], 1));
					list($fileDummy, $fileExt) = split('\.', $file);
					if($fileExt){
						$ext = $fileExt;
						switch($ext){
							case 'jpg':$type = 'image/jpeg';break;
							case 'gif':$type = 'image/gif';break;
							case 'png':$type = 'image/png';break;
						}
					}else{
						$ext = 'jpg';$type = 'image/jpeg';
					}
				}
				
				$cacheName = 'c-' . $cover[$key]['imgId'] . '_' . MAX_WIDTH . 'x' . MAX_HEIGHT . '_q' . QUALITY . '.' . $ext;
				$bufferName = 'c-' . $cover[$key]['imgId'] . '.' . $ext;
				$cacheSavePath = CACHE_PATH . '/' . $cacheName;
				$bufferSavePath = BUFFER_PATH . '/' . $bufferName;
				
				$sizeBuf = @filesize($bufferSavePath);
				if($size != $sizeBuf){
					$contents = $db->getOne('SELECT `contents` FROM `coverImage` WHERE `imgId` = ? ORDER BY `priority` LIMIT !', array($row['imgId'], 1));
					$img = fopen($bufferSavePath, "w");
					fwrite($img, $contents);
					fclose($img);
					unset($contents);
				}
				
				//一次キャッシュ更新時間と二次キャッシュ更新時間を比較
				$timeBuf = @filemtime($bufferSavePath);
				$timeCache = @filemtime($cacheSavePath);
				if($timeBuf > $timeCache){
					//リサイズ実行後二次キャッシュ書き込み
					$thumb[$key] = new Thumbnail($bufferSavePath);
					if($width > MAX_WIDTH || $height > MAX_HEIGHT){
						$thumb[$key]->resize(MAX_WIDTH, MAX_HEIGHT);
					}
					$thumb[$key]->save($cacheSavePath, QUALITY);
					$thumb[$key]->destruct();
				}

			}
			
			//女の子画像を置換用配列に格納
			$buf = 'iCover' . sprintf("%02d", ($key+1));
			$defaultImage[$buf] = '../swf/img/' . $buf . '.jpg';
			$replaceImage[$buf] = $cacheSavePath;
			if($cover[$key]['imgId']){
				$replaceImage[$buf] = $cacheSavePath;
			}else{
				$replaceImage[$buf] = '../swf/img/iCoverNoImage.jpg';
			}
		}
		
		for($i=0;$i<3;$i++){
			$buf = 'iCover' . sprintf("%02d", ($i+1));
			if(!$defaultImage[$buf]){
				$defaultImage[$buf] = '../swf/img/' . $buf . '.jpg';
				$replaceImage[$buf] = $cacheSavePath;
			}
		}
		
		
		/* --------------------------------------------- */
		$pattern = intval($_GET['pattern']);
		if (!in_array($pattern, array(0,1))) {
		    $pattern = 0;
		}

		$swfData = file_get_contents('../swf/iCoverEvent2.swf');
		$descriptorspec = array(
		   0 => array("pipe", "r"),
		   1 => array("pipe", "w"),
//		   2 => array("file", "/home/fukuoka-galleria/www/htdocs/inc/error-output.txt", "a")
		);
		$process = proc_open('/usr/local/bin/swfmill -e cp932 swf2xml stdin stdout', $descriptorspec, $pipes);
		if (is_resource($process)) {
		    // 標準入力にSWFファイルのバイナリデータを書き込み
		    fwrite($pipes[0], $swfData);
		    fclose($pipes[0]);

		    // 標準出力からXMLデータを読み込み
		    $xmlString = stream_get_contents($pipes[1]);
		    fclose($pipes[1]);

		    // パイプを全て閉じてからプロセスを閉じる
		    proc_close($process);
		}
		$replaceStrings[0] = array(
		);

		foreach($replaceStrings[$pattern] as $key => $value){
		    // 文字列を連想配列の値に置換
		    $xmlString = str_replace('{$' . $key . '}', $value, $xmlString);
		}

		foreach($replaceImage as $key => $value){
		    // 元の画像データを取得してエンコード
		    $defaultImageData = file_get_contents($defaultImage[$key]);
		    $defaultImageEncoded = base64_encode("\xFF\xD9\xFF\xD8" . $defaultImageData);

		    // 置換する画像データを取得してエンコード
		    $replaceImageData = file_get_contents($replaceImage[$key]);
		    $replaceImageEncoded = base64_encode("\xFF\xD9\xFF\xD8" . $replaceImageData);

		    // エンコードした画像データを置換
		    $xmlString = str_replace($defaultImageEncoded, $replaceImageEncoded, $xmlString);
		}

		$descriptorspec = array(
		   0 => array("pipe", "r"),
		   1 => array("pipe", "w"),
//		   2 => array("file", "/home/fukuoka-galleria/www/htdocs/inc/error-output.txt", "a")
		);
		$process = proc_open('/usr/local/bin/swfmill -e cp932 xml2swf stdin stdout', $descriptorspec, $pipes);
		if (is_resource($process)) {

		    // 標準入力にXMLデータを書き込み
		    fwrite($pipes[0], $xmlString);
		    fclose($pipes[0]);

		    // 標準出力からSWFファイルのバイナリデータを読み込み
		    $swfOutput = stream_get_contents($pipes[1]);
		    fclose($pipes[1]);

		    // パイプを全て閉じてからプロセスを閉じる
		    proc_close($process);
		}
		$swf = fopen('../swf/cache/iCover.swf', "w");
		fwrite($swf, $swfOutput);
		fclose($swf);
		unset($swfOutput);
	
	   $Agent = getenv( "HTTP_USER_AGENT" );
	    /* 環境変数 HTTP_USER_AGENT を見て、正規表現のマッチングをする(ereg)。*/
	   if( ereg( "MSIE", $Agent ) ){
$iCoverTag = <<<EOF
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="240" height="66" id="iCover" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="movie" value="../swf/cache/iCover.swf?time={$time}" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#000000" />
		<embed src="../swf/cache/iCover.swf?time={$time}" quality="high" bgcolor="#000000" width="240" height="66" name="iCover" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>
EOF;
	   }else{
$iCoverTag = <<<EOF
		<object data="../swf/cache/iCover.swf?time={$time}" type="application/x-shockwave-flash" width="240" height="66">
		  <param name="bgcolor" value="#000000">
		  <param name="loop" value="on">
		  <param name="quality" value="high">
		</object>
EOF;
	   }
		/*
		}else{
			//ﾄｯﾌﾟ画像ランダム表示
			include("prandimage.php");
			$ObjP = new prandimage();
			$ObjP->outputImage();//ﾄｯﾌﾟバナーランダム表示
			$ObjP->nothing;//ランダム閉じる
		}
		*/
	}
}

define('ICOVER_TAG', $iCoverTag);

?>