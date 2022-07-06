<?
/*
CREATE TABLE `$tableName` (
  `imgId` int(8) NOT NULL auto_increment,
  `name` varchar(40) default NULL,
  `url` varchar(255) default NULL,
  `priority` int(2) default NULL,
  `genre` int(1) default NULL,
  `file` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `width` varchar(8) default NULL,
  `height` varchar(8) default NULL,
  `contents` mediumblob,
  KEY `imgId` (`imgId`)
)
*/
/*---------------------------------------------------------------------
/* INCLUDE（外部CLASS・CONFIG読込処理）
----------------------------------------------------------------------*/
//CONFIG読込
require_once( "../inc/.ht_Config.php" );
//PEAR:QuickForm読込
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
//PEAR:DB読込
require_once( "DB.php" );
require_once( "./menu.php" );

/*---------------------------------------------------------------------
/* INIT（変数設定・初期化）
----------------------------------------------------------------------*/
$contId = 'link'; //コンテンツID
$contName = 'エンター相互リンク'; //コンテンツ名
$tableName = 'linkBanner'; //テーブル名
//機能名
if( !$_POST["mode"]){
    $funcName = '新規登録';
}else{
    $funcName = '情報修正';
}
$selectDataArray = array( $_POST["imgId"] );
//最大画像サイズ決定
$imgMaxWidth  = 88;
$imgMaxHeight = 31;

/*---------------------------------------------------------------------
/* DAO（DB処理 ⇒ 外部CLASS化推奨）
----------------------------------------------------------------------*/
$db  = DB::connect( $dsn );

if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

if( isset( $_POST["imgId"] ) ){
    $selectDataArray = array( $_POST["imgId"] );
    $MyResult = $db->query( "SELECT `name`, `url`, `genre`, `file`, `priority` FROM `$tableName` WHERE `imgId` = ? ", $selectDataArray );
        while( $row = $MyResult->fetchRow() ){
            $name     = $row["name"];
            $url      = $row["url"];
            $genre    = $row["genre"];
            $file     = $row["file"];
            $priority = $row["priority"];
        }
}

$addChangeForm = new HTML_QuickForm('linkAddChange', 'post' );
$addChangeForm->addElement( 'text', 'name', 'リンク先名称', array( "istyle" => 1, "size" => 24 ) ); 
$addChangeForm->addElement( 'text', 'url', 'リンク先URL', array( "istyle" => 1, "size" => 48 ) ); 
$addChangeForm->addElement( 'select', 'genre', 'ジャンル' , $linkGenreArray );
$addChangeForm->addElement( 'file', 'userfile', 'バナー画像' );
$addChangeForm->addElement( 'text', 'priority', '優先順位', array( "istyle" => 1, "size" => 3 ) );    
$addChangeForm->addElement( 'submit', 'submit', '登録' );
if( $_POST["imgId"] )$addChangeForm->addElement( 'hidden', 'imgId', $_POST["imgId"] );
if( $_REQUEST["imgFlg"] )$addChangeForm->addElement( 'hidden', 'imgFlg', $_REQUEST["imgFlg"] );

//デフォルト値
$addChangeForm->setDefaults(
    array(
        "name"     => $name , 
        "url"      => $url , 
        "genre"    => $genre , 
        "priority" => $priority , 
    )
);

$addChangeForm->applyFilter( '__ALL__', 'trim');

$addChangeForm->addRule( 'name', '名前を入力してください。', 'required', null, 'client' );
$addChangeForm->addRule( 'url', 'urlを入力してください。', 'required', null, 'client' );
$addChangeForm->addRule( 'userfile', 'ファイルを選択してください。', 'userfile', null );

$addChangeForm->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">の項目は必ず入力してください。</span>');
$addChangeForm->setJsWarnings('入力エラー', "\n\n" . $_SERVER["SERVER_NAME"] . "");

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

	        //アスペクト比固定処理
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

	        //画像を削除
	        unlink ( "/tmp/" . $prtMd5 . "" );

	        $type = "image/jpeg";

	    }else{
	        $contents = file_get_contents( $tmp_name );
	    }

	    if( $type == "image/pjpeg" ) $type = "image/jpeg";
	    $contents = "0x" . bin2hex( $contents );

    //微調整
    $_POST["url"] = mbereg_replace( "http:\/\/", "", $_POST["url"] );

    $updateDataArray = array( 1, $_POST["priority"], $_POST["genre"] );
    $db->query( "UPDATE `" . $tableName . "` SET `priority` = `priority` + ? WHERE `priority` >= ? AND `genre` = ? ", $updateDataArray );


    if( isset( $_POST["imgId"] ) ){
        if( $contents == '0x' ){
            $updateDataArray = array( $_POST["name"], $_POST["url"], $_POST["genre"], $_POST["priority"], $_POST["imgId"] );
            $db->query( "UPDATE `" . $tableName . "` SET `name` = ?, `url` = ?, `genre` = ?, `priority` = ? WHERE `imgId` = ? ", $updateDataArray );
        }else{
            $updateDataArray = array( $_POST["name"], $_POST["url"], $_POST["genre"], $_POST["priority"], $file, $size, $type, $width, $height, $contents, $_POST["imgId"] );
            $db->query( "UPDATE `" . $tableName . "` SET `name` = ?, `url` = ?, `genre` = ?, `priority` = ?, `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? ", $updateDataArray );
        }
        $compChk = 2;
    }else{
        if( $contents == '0x' ){
	        $insertDataArray = array( $_POST["name"], $_POST["url"], $_POST["genre"], $_POST["priority"] );
	        $db->query( "INSERT `" . $tableName . "` (`name`,`url`,`genre`,`priority`) VALUES ( ?, ?, ?, ? ) ", $insertDataArray ) ;
        }else{
	        $insertDataArray = array( $_POST["name"], $_POST["url"], $_POST["genre"], $_POST["priority"], $file, $size, $type, $width, $height, $contents );
	        $db->query( "INSERT `" . $tableName . "` (`name`,`url`,`genre`,`priority`,`file`,`size`,`type`,`width`,`height`,`contents`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, !) ", $insertDataArray ) ;
		}
		$compChk = 1;
    }

	//並び替え
    $selectDataArray = array( $_POST["genre"] );
    $MyResult = $db->query( "SELECT `imgId` FROM `" . $tableName . "` WHERE `genre` = ? ORDER BY `priority`", $selectDataArray );
        $i = "1";
        while( $row = $MyResult->fetchRow() ){
            $sortArray[$i] = $row["imgId"];
            $i++;
        }

    //ソートしたものを書き込む
    for( $i=1; $i <= count( $sortArray ); $i++ ){
        $updateDataArray = array( $i, $sortArray[$i] );
        $db->query( "UPDATE `" . $tableName . "` SET `priority` = ? WHERE `imgId` = ? ", $updateDataArray );
    }
}

/*---------------------------------------------------------------------
/* VIEW（表示準備処理）
----------------------------------------------------------------------*/
$smarty   = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$addChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
if( isset( $_POST["imgId"] ) )$smarty->assign( 'imgId', $_POST["imgId"] );
if( isset( $_REQUEST["imgFlg"] ) )$smarty->assign( 'imgFlg', $_REQUEST["imgFlg"] );
if( $file ) $smarty->assign( 'file', $file );
$smarty->assign( 'menu', $menu );

//ページ内容表示パス定義
$smarty->assign( 'domain', $DOMAIN ); //ドメイン名
$smarty->assign( 'siteName', $SITE_NAME ); //サイト名
$smarty->assign( 'contName', $contName ); //コンテンツ名
$smarty->assign( 'contId', $contId ); //コンテンツID
$smarty->assign( 'tableName', $tableName ); //テーブル名
$smarty->assign( 'funcName', $funcName ); //機能名

//共通テンプレートパス定義
$smarty->assign( 'headerPath', $ADMIN_HEAD_PATH ); //ヘッダパス
$smarty->assign( 'menuPath', $ADMIN_MENU_PATH ); //メニューパス
$smarty->assign( 'footerPath', $ADMIN_FOOT_PATH ); //フッタパス
$smarty->assign( 'incDir', $INC_DIR ); //INCフォルダパス

//テンプレートを表示
if( $compChk ){
    header("Location: ./" . $contId . "List.php?r=" . $compChk . "&genre=" . $_POST["genre"]  . "&imgFlg=" . $_REQUEST["imgFlg"] );
    exit;
}else{
	$smarty->display( $contId . 'AddChange.tpl' );
}

?>
