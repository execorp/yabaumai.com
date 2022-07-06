<?
require_once( "../inc/exe.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$title = "面接応募詳細";

if( isset( $_POST["recruitId"] ) AND $_POST["recruitId"] ){
    $selectDataArray = array( $_POST["recruitId"] );
    $result = $db->query( "SELECT `recruitId` `wantDate`, `regDateTime`, `wantDate`, `galType`, `tel`, `eMail`, `comment`, `chk` FROM `recruit` WHERE `recruitId` = ? ", $selectDataArray );
        while( $row = $result -> fetchRow() ){
            $prtData["recruitId"]    = $row["recruitId"];
            $prtData["wantDate"]     = $row["wantDate"];
            $prtData["regDateTime"]  = $row["regDateTime"];
            $prtData["galType"]      = $row["galType"];
            $prtData["tel"]          = $row["tel"];
            $prtData["eMail"]        = $row["eMail"];
            $prtData["comment"]      = stripSlushR( $row["comment"] );
            $prtData["chk"]          = $row["chk"];
        }
}

$recruitAddChangeForm = new HTML_QuickForm( 'recruitAddChange', 'post' );
$recruitAddChangeForm->addElement( 'text', 'wantDate', '面接希望日' );

foreach( $reserveCompArray AS $key => $value ){
    $recruitCompArrayGroup[] = $recruitAddChangeForm->createElement( 'radio', null, null, $value, $key );
}
$recruitAddChangeForm->addGroup( $recruitCompArrayGroup, 'chk', '確認' );

$recruitAddChangeForm->addElement( 'submit', 'submit', '修正');
$recruitAddChangeForm->addElement( 'hidden', 'recruitId', $_POST["recruitId"] );
if( isset( $_POST["recruitId"] ) ) $recruitAddChangeForm->addElement( 'hidden', 'recruitUpDate', $_POST["recruitId"] );

//デフォルト値
$recruitAddChangeForm->setDefaults(
    array(
        "wantDate" => $prtData["wantDate"] , 
        "chk"      => $prtData["chk"] , 
    )
);

$recruitAddChangeForm->applyFilter( '__ALL__', 'trim');


$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$recruitAddChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'title', $title );
$smarty->assign( 'menu', $menu );
if( $_POST["recruitId"] ) $smarty->assign( 'recruitId', $_POST["recruitId"] );

if ( $recruitAddChangeForm->validate() AND isset( $_POST["recruitId"] ) ){
    $recruitAddChangeForm->freeze();

    if( isset( $_POST["recruitUpDate"] ) AND $_POST["recruitUpDate"] AND $_POST["recruitId"] ){
        $updateDataArray = array( $_POST["wantDate"], $_POST["chk"], $_POST["recruitId"] );
        $db->query( "UPDATE `recruit` SET `wantDate` = ?, `chk` = ? WHERE `recruitId` = ? ", $updateDataArray );

        header("Location: ./recruitList.php");
        exit;

    }
}

$smarty->display( 'recruitAddChange.tpl' );

?>
