<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

/* 実行速度計測（開始）
$startTime = microtime_float();
*/

/**
 * thumb.php @author execute.jp @copyright Copyright 2009 @version 0.9 (PHP4)
 * @GETパラメータ
 *  [mode] リサイズモード ('1' => 透過画像対応モード, '2' => 透過画像非対応モード, '3' => 強制JPG出力モード)
 *  [q] 画像リサイズ時の圧縮品質 (%)
 *  [mw] 画像リサイズ時の縦幅 (px)
 *  [mh] 画像リサイズ時の横幅 (px)
 *  [p] 画像リサイズ時の縮小比 (%)
 *  [rs] リサイズする条件 ('0'=>縮小のみ, '1'=>無効, '2'=>縮小拡大, '3'=>拡大のみ)
 *  [t] 画像が格納されているDBのテーブル名
 *  [imgId] 画像が格納されているDBの画像ID① ('contents'を取得)
 *  [imgId2] 画像が格納されているDBの画像ID② ('contents2'を取得)
 *  [imgId3] 画像が格納されているDBの画像ID③ ('contents3'を取得)
 *  [imgId4] 画像が格納されているDBの画像ID④ ('contents4'を取得)
 *  [index] 'imgId'以外のキーレコードを参照 ('imgId2','imgId3'と併用可)
 *  [file] サーバー上の画像ファイルパスを指定
 *  [noimg] 画像が取得できない場合の表示 ('1' => UNIXフォントによる「NO IMAGE」, '2' => CenturyGothicフォントによる「NO IMAGE」, '3' =>「../img/noimage[MAX_WIDTH]x[MAX_HEIGHT].jpg」の表示)
 *  [anime] アニメーションGIFのリサイズ ('1' => リサイズしない, '2' => 強制リサイズ（1フレームのみ）, '3' => PECL::Imagickによる完全リサイズ（未実装）
 *  [cache] キャッシュ使用モード ('1' => 一次キャッシュ有効, '2' => 二次キャッシュ有効, '3' => キャッシュ無効(未実装) )
 *  [rm] キャッシュ削除モード ('all' => 全キャッシュ削除, '整数値' => ○ヶ月以上前キャッシュ削除(未実装))
 */
/*---------------------------------------------------------------------
/* INIT
----------------------------------------------------------------------*/
/* --- 基本設定(必要に応じて変更) --- */
$modeDef = 1; //リサイズモード
$qualityDef = 80; //圧縮品質(%)
$widthDef = 240; //最大横幅(px)
$heightDef = 320; //最大縦幅(px)
$pathBase = '../thumb'; //キャッシュフォルダの場所
$tableDef = 'galImage'; //指定が無い場合のテーブル名
$noimgDef = 1; //画像が取得できない場合の表示
$animeDef = 1; //アニメーションGIFのリサイズ
$cacheDef = 1; //キャッシュ使用モード
/* ---------------------------------- */
($_GET['mode'])?$mode = $_GET['mode']:$mode = $modeDef;
($_GET['q'])?$quality = $_GET['q']:$quality = $qualityDef;
($_GET['mw'])?$width = $_GET['mw']:$width = $widthDef;
($_GET['mh'])?$height = $_GET['mh']:$height = $heightDef;
($_GET['p'])?$percent = $_GET['p']:$percent = 0;
($_GET['rs'])?$resize = $_GET['rs']:$resize = 0;
($_GET['cache'])?$cache = $_GET['cache']:$cache = $cacheDef;
($_GET['t'])?$tableName = $_GET['t']:$tableName = $tableDef;
($_GET['index'])?$index = $_GET['index']:$index = 'imgId';
($_GET['imgId'])?$imgId = $_GET['imgId']:$imgId = 0;
($_GET['imgId2'])?$imgId2 = $_GET['imgId2']:$imgId2 = 0;
($_GET['imgId3'])?$imgId3 = $_GET['imgId3']:$imgId3 = 0;
($_GET['imgId4'])?$imgId4 = $_GET['imgId4']:$imgId4 = 0;
($_GET['noimg'])?$noimg = $_GET['noimg']:$noimg = $noimgDef;
($_GET['anime'])?$anime = $_GET['anime']:$anime = $animeDef;
define('MODE', $mode);
define('QUALITY', $quality);
define('MAX_WIDTH', $width);
define('MAX_HEIGHT', $height);
define('PARCENT', $percent);
define('RESIZE', $resize);
define('CACHE', $cache);
define('INDEX', $index);
define('TABLE_NAME', $tableName);
define('NOIMG', $noimg);
define('ANIME', $anime);

if(CACHE != 3)require_once('./thumbnail.trans.inc.php'); //画像処理クラス読込
require_once('./.ht_DBConnect.inc'); //DB情報読込
require_once('DB.php'); //PEAR::DBクラス読込

if($imgId > 0){
	define('IMGID', $imgId);
	define('CONTENTS_NUM', '');
}elseif($imgId2 > 0){
	define('IMGID', $imgId2);
	define('CONTENTS_NUM', '2');
}elseif($imgId3 > 0){
	define('IMGID', $imgId3);
	define('CONTENTS_NUM', '3');
}elseif($imgId4 > 0){
	define('IMGID', $imgId4);
	define('CONTENTS_NUM', '4');
}else{
	$tableName = 'local';
}
($_GET['file'])?$file = $_GET['file']:$file = IMGID;
define('FILE_NAME', $file);

if(CACHE != 3){
	if(PARCENT > 0){
		$cacheName = 'c' . CONTENTS_NUM . '-' . basename(FILE_NAME) . '_p' . PARCENT . '_q' . QUALITY . '_rs' . RESIZE;
	}else{
		$cacheName = 'image' . sprintf("%05d", basename(FILE_NAME));
	}
}
/*---------------------------------------------------------------------
/* DAO
----------------------------------------------------------------------*/
if(IMGID > 0){
	$db = DB::connect( $dsn );
	if(DB::isError($db)){echo("error::<hr />\n");exit;}
	$db->setFetchMode( DB_FETCHMODE_ASSOC );
	
	//データベース画像の情報を取得
	$size = $db->getOne( "SELECT `size!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
	$type = $db->getOne( "SELECT `type!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
	$width = $db->getOne( "SELECT `width!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
	$height = $db->getOne( "SELECT `height!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));

	switch($type){
		case 'image/jpeg':$ext = 'jpg';break;
		case 'image/pjpeg':$ext = 'jpg';break;
		case 'image/gif':$ext = 'gif';break;
		case 'image/png':$ext = 'png';break;
		case 'image/x-png':$ext = 'png';break;
	}
	
	if(!$ext){
		$file = $db->getOne( "SELECT `file!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
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
	
	define('WIDTH', $width);
	define('HEIGHT', $height);
	define('FILE', $file);
	define('TYPE', $type);
	define('EXT', $ext);
	
	$cacheName .= '.' . EXT;
	define('CACHE_BASE_PATH', $pathBase);
	define('CACHE_NAME', $cacheName);
	define('CACHE_PATH', CACHE_BASE_PATH . '/' . TABLE_NAME);
	define('CACHE_SAVE_PATH', CACHE_PATH . '/' . CACHE_NAME);
	
	if(CACHE != 3){
		$bufferName = 'c' . CONTENTS_NUM . '-' . IMGID . '.' . $ext;
		define('BUFFER_NAME', $bufferName);
		define('BUFFER_BASE_PATH', CACHE_BASE_PATH . '/' . '_buf');
		define('BUFFER_PATH', BUFFER_BASE_PATH . '/' . TABLE_NAME);
		define('BUFFER_SAVE_PATH', BUFFER_PATH . '/' . BUFFER_NAME);
	}
}

/*---------------------------------------------------------------------
/* MODEL
----------------------------------------------------------------------*/
if(CACHE != 3){
	//一時ファイル格納ディレクトリ作成
	@mkdir(BUFFER_BASE_PATH); 
	@mkdir(BUFFER_PATH);

	if(IMGID > 0){
		//一時画像のファイルサイズを取得
		$sizeBuf = @filesize(BUFFER_SAVE_PATH);
		
		//ファイルサイズが異なっていたら一時ファイル書込
		if($size != $sizeBuf){
			$contents = $db->getOne( "SELECT `contents!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
			$img = fopen(BUFFER_SAVE_PATH, "w");
			
			fwrite($img, $contents);
			fclose($img);
			unset($contents);
		}
	}
	if(CACHE == 2){
		//キャッシュファイル格納ディレクトリ作成
		@mkdir(CACHE_PATH);
	}
}else{
	$contents = $db->getOne( "SELECT `contents!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
}

//キャッシュファイルを削除する
if($_GET['rm'] == 'all'){
	remove_directory(CACHE_BASE_PATH);
	exit;
}elseif($_GET['rm'] > 0){
	//未実装
}

/*---------------------------------------------------------------------
/* VIEW
----------------------------------------------------------------------*/
if(CACHE != 3){
	if(IMGID > 0){
		$judge = judgeAnimeGif(BUFFER_SAVE_PATH);
	}else{
		$judge = judgeAnimeGif(FILE_NAME);
	}

	if(RESIZE == 1 OR ($judge == true AND ANIME == 1)){
		if(IMGID > 0){
			showCache(BUFFER_SAVE_PATH);
		}else{
			showCache(FILE_NAME);
		}
	}else{
		switch(CACHE){
			case 1:
				if(IMGID > 0){
					$thumb = new Thumbnail(BUFFER_SAVE_PATH, MAX_WIDTH, MAX_HEIGHT, NOIMG);
				}else{
					$thumb = new Thumbnail(FILE_NAME, MAX_WIDTH, MAX_HEIGHT, NOIMG);
				}

				if(PARCENT > 0){
					if(RESIZE != 1){
						$thumb->resizePercent(PARCENT, MODE, ANIME);
					}
				}else{
					if($width > MAX_WIDTH || $height > MAX_HEIGHT || RESIZE > 1 ){
							$thumb->resize(MAX_WIDTH, MAX_HEIGHT, MODE, ANIME);
					}
				}
				$thumb->show(QUALITY, '', MODE);
				$thumb->destruct();
			break;
			case 2:
				//一次キャッシュ更新時間と二次キャッシュ更新時間を比較
				$timeBuf = @filemtime(BUFFER_SAVE_PATH);
				$timeCache = @filemtime(CACHE_SAVE_PATH);
				if($timeBuf > $timeCache){
					//リサイズ実行後二次キャッシュ書き込み
					if(IMGID > 0){
						$thumb = new Thumbnail(BUFFER_SAVE_PATH);
					}else{
						$thumb = new Thumbnail(FILE_NAME);
					}
					if(PARCENT > 0){
						if(RESIZE != 1){
							$thumb->resizePercent(PARCENT);
						}
					}else{
						if(WIDTH > MAX_WIDTH || HEIGHT > MAX_HEIGHT || RESIZE > 1 ){
							if(RESIZE != 1){
								$thumb->resize(MAX_WIDTH, MAX_HEIGHT);
							}
						}
					}
					$thumb->save(CACHE_SAVE_PATH, QUALITY);
					$thumb->destruct();
				}
				showCache(CACHE_SAVE_PATH);
			break;
		}
	}
}else{
	//キャッシュを使用しない場合
	showResize( $contents, MAX_WIDTH, MAX_HEIGHT, WIDTH, HEIGHT, QUALITY, MODE, ANIME, RESIZE );
}

/* 実行速度計測（終了）
$endTime = microtime_float();
if($_GET['timeLog']){
	$time = ($endTime - $startTime) . '秒';
	$log = fopen('time.log', "w");
	fwrite($log, $time);
	fclose($log);
}
*/

/*---------------------------------------------------------------------
/* FUNCTION
----------------------------------------------------------------------*/
//GIFアニメ判定関数
function judgeAnimeGif($name){
		$imgcnt = 0;
		$fp = @fopen($name,"rb");
		@fread($fp,4);
		$c = @fread($fp,1);
		if(ord($c) !== 0x39) {
			return false;
		}
		while(!feof($fp)){
			do{
				$c = fread($fp,1);
			}while(ord($c) !== 0x21 && !feof($fp));	
			if(feof($fp)){
				break;
			}
			$c2 = fread($fp,2);
			if(bin2hex($c2) === "f904"){
				$imgcnt++;
			}
			if(feof($fp)){
				break;
			}
			
		}
		if($imgcnt > 1){
			return true;
		} else {
			return false;
		}
}

//画像単純出力関数
function showCache($name) {
	header('Content-type: '. $type);
	$image = fopen( $name, "r" );
	echo @fread( $image, filesize( $name ) );
	fclose( $image );
}

//画像リサイズ出力関数（キャッシュ不使用）
function showResize( $contents, $mw, $mh, $width, $height, $quality, $mode, $anime, $resizeFlg ) {
	$handle = imagecreatefromstring( $contents );
    $size1 = $width;
    $size2 = $height;
	$re_size1 = $size1;
	$re_size2 = $size2;
	$tmp_w = $size1 / $mw;
	if( $mh != 0 ) $tmp_h = $size2 / $mh;
	if( $tmp_w > 1 || $tmp_h > 1 ){
	    if( $mh == 0 ){
	        if($tmp_w > 1){
	            $re_size1 = $mw;
	            $re_size2 = $size2 * $mw / $size1;
	        }
	    }else{
	        if( $tmp_w > $tmp_h ){
	            $re_size1 = $mw;
	            $re_size2 = $size2 * $mw / $size1;
	        }else{
	            $re_size2 = $mh;
	            $re_size1 = $size1 * $mh / $size2;
	        }
	    }
	}
	$imgNew = ImageCreateTrueColor( $re_size1, $re_size2 );
	$imgDef = $handle;

    if ( (EXT == 'gif' || EXT == 'png') && $mode != 2 && $anime != 2) {
    	$imgNew = ImageCreate($re_size1,$re_size2);
	    $trnprt_indx = imagecolortransparent($imgDef);
	    if ($trnprt_indx >= 0) {
		    $trnprt_color = imagecolorsforindex($imgDef, $trnprt_indx);
		    $trnprt_indx = imagecolorallocate($imgNew, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
		    imagefill($imgNew, 0, 0, $trnprt_indx);
		    imagecolortransparent($imgNew, $trnprt_indx);
	    }elseif ($this->format == PNG) {
		    imagealphablending($imgNew, false);
		    $color = imagecolorallocatealpha($imgNew, 0, 0, 0, 127);
		    imagefill($imgNew, 0, 0, $color);
		    imagesavealpha($imgNew, true);
	    }
    }else{
		$imgNew = ImageCreateTrueColor($re_size1,$re_size2);
    }
    
    ImageCopyResampled( $imgNew, $imgDef, 0, 0, 0, 0, $re_size1, $re_size2, $size1, $size2 );
	
	if($resizeFlg == 1){
		header('Content-type: image/gif');
		ImageGif($imgDef);
	}else{
		if($mode == 3){
			header('Content-type: image/jpeg');
			ImageJpeg($imgNew,'',$quality);
		}else{
		    switch(EXT) {
		        case 'gif':
		           header('Content-type: image/gif');
		           ImageGif($imgNew);
		        break;
		        case 'jpg':
		           header('Content-type: image/jpeg');
		           ImageJpeg($imgNew,'',$quality);
		        break;
		        case 'png':
		           header('Content-type: image/png');
		           ImagePng($imgNew);
		        break;
		    }
		}
	}
	ImageDestroy( $imgDef );
	ImageDestroy( $imgNew );
}

//キャッシュ削除関数
function remove_directory($dir) {
  if ($handle = opendir("$dir")) {
   while (false !== ($item = readdir($handle))) {
     if ($item != "." && $item != "..") {
       if (is_dir("$dir/$item")) {
         remove_directory("$dir/$item");
       } else {
         unlink("$dir/$item");
         echo " removing $dir/$item<br>\n";
       }
     }
   }
   closedir($handle);
   @rmdir($dir);
   echo "removing $dir<br>\n";
  }
}

//実行速度計測関数
function microtime_float(){
    list($usec, $sec) = explode(' ', microtime());
    return ((float)$usec + (float)$sec);
}

?>