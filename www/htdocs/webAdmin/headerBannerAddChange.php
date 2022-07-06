<?
/*
CREATE TABLE IF NOT EXISTS `headerBanner` (
  `imgId` int(8) NOT NULL auto_increment,
  `name` varchar(40) default NULL,
  `url` varchar(255) default NULL,
  `file` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `width` varchar(8) default NULL,
  `height` varchar(8) default NULL,
  `contents` mediumblob,
  KEY `imgId` (`imgId`),
  KEY `name` (`name`),
  KEY `URL` (`url`)
)
*/
/*---------------------------------------------------------------------
/* INCLUDE�i�O��CLASS�ECONFIG�Ǎ������j
----------------------------------------------------------------------*/
//CONFIG�Ǎ�
require_once( "../inc/.ht_Config.php" );
//PEAR:QuickForm�Ǎ�
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
//PEAR:DB�Ǎ�
require_once( "DB.php" );
require_once( "./menu.php" );

/*---------------------------------------------------------------------
/* INIT�i�ϐ��ݒ�E�������j
----------------------------------------------------------------------*/
$contId = 'headerBanner'; //�R���e���cID
$contName = '�w�b�_�[�L���o�i�['; //�R���e���c��
$tableName = 'headerBanner'; //�e�[�u����
$funcName = '���C��';

//�ő�摜�T�C�Y����
$imgMaxWidth  = 468;
$imgMaxHeight = 60;

/*---------------------------------------------------------------------
/* DAO�iDB���� �� �O��CLASS�������j
----------------------------------------------------------------------*/
$db  = DB::connect( $dsn );

if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

$selectDataArray = array( 1 );
$MyResult = $db->query( "SELECT `imgId`, `name`, `alt`, `url`, `file` FROM `" . $tableName . "` WHERE `imgId` = ? ", $selectDataArray );
    while( $row = $MyResult->fetchRow() ){
        $imgId    = $row["imgId"];
        $name     = $row["name"];
        $alt      = $row["alt"];
        $url      = $row["url"];
        $file     = $row["file"];
    }

$addChangeForm = new HTML_QuickForm('headerBannerAddChange', 'post' );
$addChangeForm->addElement( 'text', 'name', '�����N�於��', array( "istyle" => 1, "size" => 50 ) );
$addChangeForm->addElement( 'text', 'alt', 'alt', array( "istyle" => 1, "size" => 80 ) );
$addChangeForm->addElement( 'text', 'url', '�����N��URL', array( "istyle" => 1, "size" => 70 ) );
$addChangeForm->addElement( 'file', 'userfile', '�o�i�[�摜' );
$addChangeForm->addElement( 'submit', 'submit', '�o�^' );
if( $imgId )$addChangeForm->addElement( 'hidden', 'imgId', $imgId );
if( $_REQUEST["imgFlg"] )$addChangeForm->addElement( 'hidden', 'imgFlg', $_REQUEST["imgFlg"] );

//�f�t�H���g�l
$addChangeForm->setDefaults(
    array(
        "name"     => $name , 
        "alt"      => $alt , 
        "url"      => $url , 
    )
);

$addChangeForm->applyFilter( '__ALL__', 'trim');

$addChangeForm->addRule( 'name', '���O����͂��Ă��������B', 'required', null, 'client' );
$addChangeForm->addRule( 'url', 'url����͂��Ă��������B', 'required', null, 'client' );
$addChangeForm->addRule( 'userfile', '�t�@�C����I�����Ă��������B', 'userfile', null );

$addChangeForm->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">�̍��ڂ͕K�����͂��Ă��������B</span>');
$addChangeForm->setJsWarnings('���̓G���[', "\n\n" . $_SERVER["SERVER_NAME"] . "");

if ( $addChangeForm->validate() AND isset( $_POST["submit"] ) ){
    $addChangeForm->freeze();

	    $file     = $_FILES["userfile"]["name"];
	    $type     = $_FILES["userfile"]["type"];
	    $tmp_name = $_FILES["userfile"]["tmp_name"];
	    $size     = $_FILES["userfile"]["size"];

	    list( $width, $height ) = getimagesize( $tmp_name );

	    if( $width > $imgMaxWidth OR $height > $imgMaxHeight ){
	        unset( $size );

	        $_img = file_get_contents( $tmp_name );
	        $handle = imagecreatefromstring( $_img );

	        $size["0"]   = $width;
	        $size["1"]   = $height;

	        $re_size = $size;

	        //�A�X�y�N�g��Œ菈��
	        $tmp_w = $size["0"] / $imgMaxWidth;

	        if( $imgMaxHeight != 0 ){
	            $tmp_h = $size["1"] / $imgMaxHeight;
	        }

	        if( $tmp_w > 1 || $tmp_h > 1 ){
	            if( $imgMaxHeight == 0 ){
	                if( $tmp_w > 1 ){
	                    $re_size["0"] = $imgMaxWidth;
	                    $re_size["1"] = $size["1"] * $imgMaxWidth / $size["0"];
	                }
	            }else{
	                if( $tmp_w > $tmp_h ){
	                    $re_size["0"] = $imgMaxWidth;
	                    $re_size["1"] = $size["1"] * $imgMaxWidth / $size["0"];
	                }else{
	                    $re_size["1"] = $imgMaxHeight;
	                    $re_size["0"] = $size["0"] * $imgMaxHeight / $size["1"];
	                }
	            }
	        }

	        $imgNew = ImageCreateTrueColor( $re_size["0"],  $re_size["1"] );
	        $imgDef = $handle;
	        ImageCopyResampled( $imgNew,  $imgDef,  0,  0,  0,  0, $re_size["0"], $re_size["1"], $size["0"], $size["1"] );

	        ImageJpeg( $imgNew, "/tmp/" . $prtMd5 . "", $quality );
	        ImageDestroy( $imgDef );
	        ImageDestroy( $imgNew );

	        $contents = file_get_contents( "/tmp/" . $prtMd5 . "" );
	        $size     = strlen( $contents );
	        list( $width, $height ) = getimagesize( "/tmp/" . $prtMd5 . "" );

	        //�摜���폜
	        unlink ( "/tmp/" . $prtMd5 . "" );

	        $type = "image/jpeg";

	    }else{
	        $contents = file_get_contents( $tmp_name );
	    }

	    if( $type == "image/pjpeg" ) $type = "image/jpeg";
	    $contents = "0x" . bin2hex( $contents );

    //������
    $_POST["url"] = mbereg_replace( "http:\/\/", "", $_POST["url"] );

    if( isset( $_POST["imgId"] ) ){
        if( $contents == '0x' ){
            $updateDataArray = array( $_POST["name"], $_POST["alt"], $_POST["url"], $_POST["imgId"] );
            $db->query( "UPDATE `" . $tableName . "` SET `name` = ?, `alt` = ?, `url` = ? WHERE `imgId` = ? ", $updateDataArray );
        }else{
            $updateDataArray = array( $_POST["name"], $_POST["alt"], $_POST["url"], $file, $size, $type, $width, $height, $contents, $_POST["imgId"] );
            $db->query( "UPDATE `" . $tableName . "` SET `name` = ?, `alt` = ?, `url` = ?, `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? ", $updateDataArray );
        }
    }else{
        if( $contents == '0x' ){
            $insertDataArray = array( $_POST["name"], $_POST["alt"], $_POST["url"] );
            $db->query( "INSERT `" . $tableName . "` (`name`,`alt`,`url`) VALUES ( ?, ?, ? ) ", $insertDataArray ) ;
        }else{
            $insertDataArray = array( $_POST["name"], $_POST["alt"], $_POST["url"], $file, $size, $type, $width, $height, $contents );
            $db->query( "INSERT `" . $tableName . "` (`name`,`alt`,`url`,`file`,`size`,`type`,`width`,`height`,`contents`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, !) ", $insertDataArray ) ;
        }
    }
    
    header( 'Location: ./' . $contId . 'AddChange.php' );
    exit;
}

/*---------------------------------------------------------------------
/* VIEW�i�\�����������j
----------------------------------------------------------------------*/
$smarty   = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$addChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
if( isset( $_POST["imgId"] ) )$smarty->assign( 'imgId', $_POST["imgId"] );
if( isset( $_REQUEST["imgFlg"] ) )$smarty->assign( 'imgFlg', $_REQUEST["imgFlg"] );
if( $file ) $smarty->assign( 'file', $file );
$smarty->assign( 'menu', $menu );

//�y�[�W���e�\���p�X��`
$smarty->assign( 'domain', $DOMAIN ); //�h���C����
$smarty->assign( 'siteName', $SITE_NAME ); //�T�C�g��
$smarty->assign( 'contName', $contName ); //�R���e���c��
$smarty->assign( 'contId', $contId ); //�R���e���cID
$smarty->assign( 'tableName', $tableName ); //�e�[�u����
$smarty->assign( 'funcName', $funcName ); //�@�\��

//���ʃe���v���[�g�p�X��`
$smarty->assign( 'headerPath', $ADMIN_HEAD_PATH ); //�w�b�_�p�X
$smarty->assign( 'menuPath', $ADMIN_MENU_PATH ); //���j���[�p�X
$smarty->assign( 'footerPath', $ADMIN_FOOT_PATH ); //�t�b�^�p�X
$smarty->assign( 'incDir', $INC_DIR ); //INC�t�H���_�p�X

if( $imgId ) $smarty->assign( 'imgId', $imgId );

//�e���v���[�g��\��
$smarty->display( $contId . 'AddChange.tpl' );

?>
