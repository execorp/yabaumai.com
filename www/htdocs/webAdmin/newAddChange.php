<?
/*
CREATE TABLE `whatsNew` (
  `imgId` int(8) NOT NULL auto_increment,
  `id` int(8) NOT NULL ,
  `title` varchar(255) default NULL,
  `comment` text,
  `dateTime` datetime default NULL,
  `file` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `width` varchar(8) default NULL,
  `height` varchar(8) default NULL,
  `contents` mediumblob,
INDEX ( `imgId` ) 
)
*/
require_once( "../inc/exe.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$prtTitle = "新着情報登録";

if( isset( $_POST['imgId'] ) AND $_POST['imgId'] ){
    $prtTitle = "新着情報修正";

    $selectDataArray = array( $_POST['imgId'] );
    $result = $db->query( "SELECT `title`, `comment`, `areaId`, `shopId`, `dateTime`, `file` FROM `whatsNew` WHERE `imgId` = ? ", $selectDataArray );
        while( $row = $result -> fetchRow() ){
        	$areaId   = $row['areaId'];
        	$shopId   = $row['shopId'];
            $dateTime = $row["dateTime"];
            $title    = $row["title"];
            $comment  = $row["comment"];
            $file     = $row["file"];
        }
}

$newAddChangeForm = new HTML_QuickForm('newAddChange', 'post');
$newAddChangeForm->addElement( 'text', 'dateTime', 'dateTime', array( "size" => "23" ) );
$newAddChangeForm->addElement( 'text', 'title', 'タイトル', array( "size" => "40" ) );
/*
$newAddChangeForm->addElement( 'select', 'areaId', 'エリア', $areaArray );
*/
$newAddChangeForm->addElement( 'textarea', 'comment', 'コメント', array( "cols" => "60", "rows" => "10" ) );
$newAddChangeForm->addElement( 'file', 'userfile', '画像 (130 * 165)' );

/* エリア名-店舗名 ヒアセレクト */
foreach($areaArray AS $key => $value){
	$shopArray[$key] = $db->getAssoc('SELECT `shopId`, `shopName` FROM `shopMaster` WHERE `areaId` = ' . $key);
}
$newAddChangeForm->setDefaults(array('areaShop' => array($areaId, $shopId)));
$sel =& $newAddChangeForm->addElement('hierselect', 'areaShop', 'エリア・店舗名');
$sel->setOptions(array($areaArray, $shopArray));
/* エリア名-店舗名 ヒアセレクト */

if( isset( $_POST['imgId'] ) ){
    $newAddChangeForm->addElement( 'hidden', 'imgId', $_POST['imgId'] );
    $newAddChangeForm->addElement( 'submit', 'submit', '修正');
}else{
    $newAddChangeForm->addElement( 'submit', 'submit', '登録');
}
if( !$_POST['imgId'] ){
	$dateTime = date ( "Y-m-d H:i:s", mktime ( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) );
}

//デフォルト値
$newAddChangeForm->setDefaults(
    array(
        "areaId"   => $areaId , 
        "dateTime" => $dateTime , 
        "title"    => $title , 
        "comment"  => stripSlushR( $comment ) , 
    )
);

$newAddChangeForm->applyFilter( '__ALL__', 'trim');

$newAddChangeForm->addRule( 'dateTime', '登録時刻を入力してください。', 'required', null, 'client' );
$newAddChangeForm->addRule( 'dateTime', '更新日時は正しい形式で入力してください半角入力になっていない、日付と日時に半角スペースが抜けている、日付と日時に『-』『:』が抜けている可能性があります。', 'regex', '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}\:[0-9]{2}\:[0-9]{2}$/', 'client' );
$newAddChangeForm->addRule( 'title', 'タイトルを入力してください。', 'required', null, 'client' );
$newAddChangeForm->addRule( 'comment', '本文を入力してください。', 'required', null, 'client' );

$newAddChangeForm->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">の項目は必ず入力してください。</span>');
$newAddChangeForm->setJsWarnings('入力エラー', "\n\n" . $_SERVER['SERVER_NAME'] . "");

// Smartyの設定
$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$newAddChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtTitle', $prtTitle );

if( $_POST['imgId'] ) $smarty->assign( 'imgId', $_POST['imgId'] );
if( $file ) $smarty->assign( 'file', $file );

if ( $newAddChangeForm->validate() ){
    $newAddChangeForm->freeze();

    $file     = $_FILES['userfile']['name'];
    $type     = $_FILES['userfile']['type'];
    $tmp_name = $_FILES['userfile']['tmp_name'];
    $size     = $_FILES['userfile']['size'];

    // 画像サイズを取得
    list( $width, $height ) = getimagesize( $tmp_name );

    if( $type == "image/pjpeg" ) $type = "image/jpeg";

    $contents   = '0x' . bin2hex( file_get_contents( $tmp_name ) );
    
    //shopMasterに新着更新時間を入れる
    $updateDataArray = array( $_POST['dateTime'], $_POST['areaShop'][1] );
    $db->query( "UPDATE `shopMaster` SET `whatsNewTime` = ? WHERE `shopId` = ? ", $updateDataArray );
    
    if( $_POST["imgId"]){
        if( $contents == '0x' ){
            $updateDataArray = array( $_POST['title'], $_POST['comment'], $_POST['areaShop'][0], $_POST['areaShop'][1], $_POST['dateTime'], $_POST['imgId'] );
            $db->query( "UPDATE `whatsNew` SET `title` = ?, `comment` = ?, `areaId` = ?, `shopId` = ?, `dateTime` = ? WHERE `imgId` = ? ", $updateDataArray );
        }else{
            
            $imgSaveFolder = realpath(dirname(__FILE__) . '/../');
            //picResize.phpで作成されたキャッシュ画像を削除する
            system( '/bin/rm -rf ' . $imgSaveFolder . '/userImg/whatsNew/' . $_POST['imgId'] . "/*" );
            
            $updateDataArray = array( $_POST['title'], $_POST['comment'], $_POST['areaShop'][0], $_POST['areaShop'][1], $_POST['dateTime'], $file, $size, $type, $width, $height, $contents, $_POST['imgId'] );
            $db->query( "UPDATE `whatsNew` SET `title` = ?, `comment` = ?, `areaId` = ?, `shopId` = ?, `dateTime` = ?, `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? ", $updateDataArray );
        }
    }else{
        if( $contents == '0x' ){
            $insertDataArray = array( $_POST['title'], $_POST['comment'], $_POST['areaShop'][0], $_POST['areaShop'][1], $_POST['dateTime'] );
            $db->query( "INSERT `whatsNew` ( `title`,`comment`,`areaId`,`shopId`,`dateTime` ) VALUES ( ?, ?, ?, ?, ? ) ", $insertDataArray );
        }else{
            $insertDataArray = array( $_POST['title'], $_POST['comment'], $_POST['areaShop'][0], $_POST['areaShop'][1], $_POST['dateTime'], $file, $size, $type, $width, $height, $contents  );
            $db->query( "INSERT `whatsNew` ( `title`,`comment`,`areaId`,`shopId`,`dateTime`,`file`,`size`,`type`,`width`,`height`,`contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray );
        }
    }
    
    //過去ログ7日間のみ（※それ以前は削除）
    $deleteDataTime = date("Y-m-d H:i:s", mktime (0,0,0,date("m"),date("d")-7,date("Y")));
    $deleteDataArray = array( $_POST['areaShop'][0], $_POST['areaShop'][1], $deleteDataTime );
    $db->query( "DELETE FROM `whatsNew` WHERE `areaId` = ? AND `shopId` = ? AND dateTime <= ? ", $deleteDataArray );
    
    //完了ページ
    header("Location: ./newList.php");
    exit;
}

$smarty->display( 'newAddChange.tpl' );
?>
