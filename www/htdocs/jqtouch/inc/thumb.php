<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

/* ���s���x�v���i�J�n�j
$startTime = microtime_float();
*/

/**
 * thumb.php @author execute.jp @copyright Copyright 2009 @version 0.9 (PHP4)
 * @GET�p�����[�^
 *  [mode] ���T�C�Y���[�h ('1' => ���߉摜�Ή����[�h, '2' => ���߉摜��Ή����[�h, '3' => ����JPG�o�̓��[�h)
 *  [q] �摜���T�C�Y���̈��k�i�� (%)
 *  [mw] �摜���T�C�Y���̏c�� (px)
 *  [mh] �摜���T�C�Y���̉��� (px)
 *  [p] �摜���T�C�Y���̏k���� (%)
 *  [rs] ���T�C�Y������� ('0'=>�k���̂�, '1'=>����, '2'=>�k���g��, '3'=>�g��̂�)
 *  [t] �摜���i�[����Ă���DB�̃e�[�u����
 *  [imgId] �摜���i�[����Ă���DB�̉摜ID�@ ('contents'���擾)
 *  [imgId2] �摜���i�[����Ă���DB�̉摜ID�A ('contents2'���擾)
 *  [imgId3] �摜���i�[����Ă���DB�̉摜ID�B ('contents3'���擾)
 *  [imgId4] �摜���i�[����Ă���DB�̉摜ID�C ('contents4'���擾)
 *  [index] 'imgId'�ȊO�̃L�[���R�[�h���Q�� ('imgId2','imgId3'�ƕ��p��)
 *  [file] �T�[�o�[��̉摜�t�@�C���p�X���w��
 *  [noimg] �摜���擾�ł��Ȃ��ꍇ�̕\�� ('1' => UNIX�t�H���g�ɂ��uNO IMAGE�v, '2' => CenturyGothic�t�H���g�ɂ��uNO IMAGE�v, '3' =>�u../img/noimage[MAX_WIDTH]x[MAX_HEIGHT].jpg�v�̕\��)
 *  [anime] �A�j���[�V����GIF�̃��T�C�Y ('1' => ���T�C�Y���Ȃ�, '2' => �������T�C�Y�i1�t���[���̂݁j, '3' => PECL::Imagick�ɂ�銮�S���T�C�Y�i�������j
 *  [cache] �L���b�V���g�p���[�h ('1' => �ꎟ�L���b�V���L��, '2' => �񎟃L���b�V���L��, '3' => �L���b�V������(������) )
 *  [rm] �L���b�V���폜���[�h ('all' => �S�L���b�V���폜, '�����l' => �������ȏ�O�L���b�V���폜(������))
 */
/*---------------------------------------------------------------------
/* INIT
----------------------------------------------------------------------*/
/* --- ��{�ݒ�(�K�v�ɉ����ĕύX) --- */
$modeDef = 1; //���T�C�Y���[�h
$qualityDef = 80; //���k�i��(%)
$widthDef = 240; //�ő剡��(px)
$heightDef = 320; //�ő�c��(px)
$pathBase = '../thumb'; //�L���b�V���t�H���_�̏ꏊ
$tableDef = 'galImage'; //�w�肪�����ꍇ�̃e�[�u����
$noimgDef = 1; //�摜���擾�ł��Ȃ��ꍇ�̕\��
$animeDef = 1; //�A�j���[�V����GIF�̃��T�C�Y
$cacheDef = 1; //�L���b�V���g�p���[�h
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

if(CACHE != 3)require_once('./thumbnail.trans.inc.php'); //�摜�����N���X�Ǎ�
require_once('./.ht_DBConnect.inc'); //DB���Ǎ�
require_once('DB.php'); //PEAR::DB�N���X�Ǎ�

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
	
	//�f�[�^�x�[�X�摜�̏����擾
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
	//�ꎞ�t�@�C���i�[�f�B���N�g���쐬
	@mkdir(BUFFER_BASE_PATH); 
	@mkdir(BUFFER_PATH);

	if(IMGID > 0){
		//�ꎞ�摜�̃t�@�C���T�C�Y���擾
		$sizeBuf = @filesize(BUFFER_SAVE_PATH);
		
		//�t�@�C���T�C�Y���قȂ��Ă�����ꎞ�t�@�C������
		if($size != $sizeBuf){
			$contents = $db->getOne( "SELECT `contents!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
			$img = fopen(BUFFER_SAVE_PATH, "w");
			
			fwrite($img, $contents);
			fclose($img);
			unset($contents);
		}
	}
	if(CACHE == 2){
		//�L���b�V���t�@�C���i�[�f�B���N�g���쐬
		@mkdir(CACHE_PATH);
	}
}else{
	$contents = $db->getOne( "SELECT `contents!` FROM `!` WHERE `!` = ? ", array(CONTENTS_NUM, TABLE_NAME, INDEX, IMGID));
}

//�L���b�V���t�@�C�����폜����
if($_GET['rm'] == 'all'){
	remove_directory(CACHE_BASE_PATH);
	exit;
}elseif($_GET['rm'] > 0){
	//������
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
				//�ꎟ�L���b�V���X�V���ԂƓ񎟃L���b�V���X�V���Ԃ��r
				$timeBuf = @filemtime(BUFFER_SAVE_PATH);
				$timeCache = @filemtime(CACHE_SAVE_PATH);
				if($timeBuf > $timeCache){
					//���T�C�Y���s��񎟃L���b�V����������
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
	//�L���b�V�����g�p���Ȃ��ꍇ
	showResize( $contents, MAX_WIDTH, MAX_HEIGHT, WIDTH, HEIGHT, QUALITY, MODE, ANIME, RESIZE );
}

/* ���s���x�v���i�I���j
$endTime = microtime_float();
if($_GET['timeLog']){
	$time = ($endTime - $startTime) . '�b';
	$log = fopen('time.log', "w");
	fwrite($log, $time);
	fclose($log);
}
*/

/*---------------------------------------------------------------------
/* FUNCTION
----------------------------------------------------------------------*/
//GIF�A�j������֐�
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

//�摜�P���o�͊֐�
function showCache($name) {
	header('Content-type: '. $type);
	$image = fopen( $name, "r" );
	echo @fread( $image, filesize( $name ) );
	fclose( $image );
}

//�摜���T�C�Y�o�͊֐��i�L���b�V���s�g�p�j
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

//�L���b�V���폜�֐�
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

//���s���x�v���֐�
function microtime_float(){
    list($usec, $sec) = explode(' ', microtime());
    return ((float)$usec + (float)$sec);
}

?>