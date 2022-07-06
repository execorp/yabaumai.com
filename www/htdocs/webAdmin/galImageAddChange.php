<?
/*
CREATE TABLE `galImage` (
  `imgId` int(10) NOT NULL auto_increment,
  `shopId` int(8) default NULL,
  `priority` int(1) default '1',
  `file` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `width` varchar(8) default NULL,
  `height` varchar(8) default NULL,
  `contents` mediumblob,
  KEY `imgId` (`imgId`),
  KEY `shopId` (`shopId`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM  DEFAULT CHARSET=sjis;

*/

//require_once( "../inc/authClient.php" );
require_once( "../inc/exe.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$prtTitle = "‰æ‘œ“o˜^EC³";

if( $_POST['delChk'] ){
    foreach( $_POST['delChk'] AS $key => $value ){
        //$updateDataArray = array( 1, $key );
        //if( $value ) $db->query( "UPDATE `galImage` SET `prtFlg` = ? WHERE `imgId` = ? ", $updateDataArray );
        $updateDataArray = array( "NULL", "NULL", "NULL", "NULL", "NULL", "NULL", $key );
        if( $value ) $db->query( "UPDATE `galImage` SET `file` = !, `size` = !, `type` = !, `width` = !, `height` = !, `contents` = ! WHERE `imgId` = ? ", $updateDataArray );
        //var_dump( $db );
    }
    remove_directory("../thumb/_buf/galImage");
}

$imgArray = $db->getAssoc( "SELECT `priority`, `imgId` FROM `galImage` ORDER BY `priority` " );
//var_dump( $db );

//“X•ÜSelec
$shopSelectArray = $db->getAssoc( "SELECT `shopId`, `shopName` FROM `shopMaster` ORDER BY `shopName` " );
//var_dump( $db );

$galImageAddChangeForm = new HTML_QuickForm('galImageAddChange', 'post');

for( $i = 1; $i <= 18; $i++ ){
    //$galImageAddChangeForm->addElement( 'text', "name[$i]", '–¼‘O', array( "size" => 20 ) );
    //$galImageAddChangeForm->addElement( 'text', "age[$i]", '”N—î', array( "size" => 3, "maxlength" => 2 ) );
    $galImageAddChangeForm->addElement( 'advcheckbox', "delChk[$i]", NULL, '‚±‚Ì‰æ‘œ‚ðíœ‚·‚é' );
    $galImageAddChangeForm->addElement( 'file', "userfile[$i]", '‰æ‘œ' );
    
    $galImageAddChangeForm->addElement( 'select', "shopId[$i]", '“X•Ü', $shopSelectArray );
    //“X•ÜƒfƒtƒHƒ‹ƒgÝ’è
    $setDefaultShopId = $db->getOne( "SELECT `shopId` FROM `galImage` WHERE `imgId` = '" . $i . "' " );
    $setDefault["shopId[$i]"] = $setDefaultShopId;
    
}
$galImageAddChangeForm->addElement( 'submit', 'submit', '“o˜^EC³');

//ƒfƒtƒHƒ‹ƒg
$galImageAddChangeForm->setDefaults( $setDefault );


if( isset( $_POST['submit'] ) AND $_POST['submit'] ){
    foreach( $_POST['shopId'] AS $key => $value ){
    //foreach( $_FILES['userfile']['name'] AS $key => $value ){
        if( $value ){
            unset( $file );
            unset( $type );
            unset( $tmp_name );
            unset( $size );
            unset( $width );
            unset( $height );
            unset( $imgId );

            $file     = $_FILES['userfile']['name'][$key];
            $type     = $_FILES['userfile']['type'][$key];
            $tmp_name = $_FILES['userfile']['tmp_name'][$key];
            $size     = $_FILES['userfile']['size'][$key];

            // ‰æ‘œƒTƒCƒY‚ðŽæ“¾
            list( $width, $height ) = getimagesize( $tmp_name );

            if( $type == "image/pjpeg" ) $type = "image/jpeg";

            $contents   = '0x' . bin2hex( file_get_contents( $tmp_name ) );

            if( $contents == '0x' ){
                $updateDataArray = array( $_POST['shopId'][$key], $_POST['name'][$key], $_POST['age'][$key], $key );
                $db->query( "UPDATE `galImage` SET `shopId` = ?, `name` = ?, `age` = ? WHERE `imgId` = ? ", $updateDataArray );
                //var_dump( $db );
            }else{
                
                $imgSaveFolder = realpath(dirname(__FILE__) . '/../');
                //picResize.php‚Åì¬‚³‚ê‚½ƒLƒƒƒbƒVƒ…‰æ‘œ‚ðíœ‚·‚é
                system( '/bin/rm -rf ' . $imgSaveFolder . '/userImg/galImage/' . $key . "/*" );
                
                $updateDataArray = array( $_POST['shopId'][$key], $_POST['name'][$key], $_POST['age'][$key], $file, $size, $type, $width, $height, $contents, $key );
                $db->query( "UPDATE `galImage` SET `shopId` = ?, `name` = ?, `age` = ?, `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? ", $updateDataArray );
            }
        }
    }

    header( "Location: ./galImageAddChange.php" );
    exit;
}

$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$galImageAddChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'imgArray', $imgArray );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtTitle', $prtTitle );

$smarty->display( 'galImageAddChange.tpl' );
?>