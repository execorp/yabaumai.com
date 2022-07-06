<?
/*
CREATE TABLE `linkEnterBanner` (
  `imgId` int(8) NOT NULL auto_increment,
  `name` varchar(40) default NULL,
  `URL` varchar(255) default NULL,
  `priority` int(2) default NULL,
  `file` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `width` varchar(8) default NULL,
  `height` varchar(8) default NULL,
  `contents` mediumblob,
  KEY `imgId` (`imgId`)
)
*/
require_once("../inc/.ht_Config.php");
require_once("HTML/QuickForm.php");
require_once("HTML/QuickForm/Renderer/ArraySmarty.php");
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$pageTitle = "相互リンク登録・修正";

if( isset( $_POST["imgId"] ) ){
    $selectDataArray = array( $_POST["imgId"] );
    $MyResult = $db->query( "SELECT `name`, `URL`, `file`, `priority` FROM `linkEnterBanner` WHERE `imgId` = ? ", $selectDataArray );
        while( $row = $MyResult->fetchRow() ){
            $name     = $row['name'];
            $URL      = $row['URL'];
            $file     = $row['file'];
            $priority = $row['priority'];
        }
}

$linkAddChangeForm = new HTML_QuickForm('linkAddChange', 'post' );
$linkAddChangeForm->addElement( 'text', 'name', 'name' );
$linkAddChangeForm->addElement( 'text', 'URL', 'URL' );
$linkAddChangeForm->addElement( 'file', 'userfile', NULL );
$linkAddChangeForm->addElement( 'text', 'priority', 'priority' );
$linkAddChangeForm->addElement( 'submit', 'regSubmit', 'この内容で登録' );
if( $_POST['imgId'] )	$linkAddChangeForm->addElement( 'hidden', 'imgId', $_POST['imgId'] );

//デフォルト値
$linkAddChangeForm->setDefaults(
    array(
        "name"     => $name , 
        "URL"      => $URL , 
        "priority" => $priority , 
    )
);

$linkAddChangeForm->applyFilter( '__ALL__', 'trim');

$linkAddChangeForm->addRule( 'name', '名前を入力してください。', 'required', null, 'client' );
$linkAddChangeForm->addRule( 'URL', 'URLを入力してください。', 'required', null, 'client' );
//$linkAddChangeForm->addRule( 'userfile', 'ファイルを選択してください。', 'userfile', null );

$linkAddChangeForm->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">の項目は必ず入力してください。</span>');
$linkAddChangeForm->setJsWarnings('入力エラー', "\n\n" . $_SERVER['SERVER_NAME'] . "");

$smarty   = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$linkAddChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'file', $file );
$smarty->assign( 'pageTitle', $pageTitle );

if( isset( $_POST["imgId"] ) )$smarty->assign( 'imgId', $_POST['imgId'] );

if ( $linkAddChangeForm->validate() AND isset( $_POST['regSubmit'] ) ){
    $linkAddChangeForm->freeze();

    $file     = $_FILES['userfile']['name'];
    $type     = $_FILES['userfile']['type'];
    $tmp_name = $_FILES['userfile']['tmp_name'];
    $size     = $_FILES['userfile']['size'];

    // 画像サイズを取得
    list( $width, $height ) = getimagesize( $tmp_name );

    if( $type == "image/pjpeg" )	$type = "image/jpeg";

    $contents   = '0x' . bin2hex( file_get_contents( $tmp_name ) );

    //微調整
    $_POST['URL'] = mbereg_replace( "http:\/\/", "", $_POST['URL'] );

    $updateDataArray = array( 1, $_POST['priority'] );
    $db->query( "UPDATE `linkEnterBanner` SET `priority` = `priority` + ? WHERE `priority` >= ? ", $updateDataArray );


    if( isset( $_POST['imgId'] ) ){
        if( $contents == '0x' ){
            $updateDataArray = array( $_POST['name'], $_POST['URL'], $_POST['priority'], $_POST['imgId'] );
            $db->query( "UPDATE `linkEnterBanner` SET `name` = ?, `URL` = ?, `priority` = ? WHERE `imgId` = ? ", $updateDataArray );
        }else{
            $updateDataArray = array( $_POST['name'], $_POST['URL'], $_POST['priority'], $file, $size, $type, $width, $height, $contents, $_POST['imgId'] );
            $db->query( "UPDATE `linkEnterBanner` SET `name` = ?, `URL` = ?, `priority` = ?, `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? ", $updateDataArray );
        }
    }else{
        $insertDataArray = array( $_POST['name'], $_POST['URL'], $_POST['priority'], $file, $size, $type, $width, $height, $contents );
        $db->query( "INSERT `linkEnterBanner` ( `name`, `URL`, `priority`, `file`, `size`, `type`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray ) ;
    }

	//並び替え
    $MyResult = $db->query( "SELECT `imgId` FROM `linkEnterBanner` ORDER BY `priority`" );
        $i = "1";
        while( $row = $MyResult->fetchRow() ){
            $sortArray[$i] = $row['imgId'];
            $i++;
        }

    //ソートしたものを書き込む
    for( $i=1; $i <= count( $sortArray ); $i++ ){
        $updateDataArray = array( $i, $sortArray[$i] );
        $db->query( "UPDATE `linkEnterBanner` SET `priority` = ? WHERE `imgId` = ? ", $updateDataArray );
    }

    //完了ページ
    header("Location: ./linkEnterList.php");
    exit;
}

$smarty->display( 'linkEnterAddChange.tpl' );
?>
