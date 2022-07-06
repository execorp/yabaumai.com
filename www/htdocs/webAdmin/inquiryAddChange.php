<?
require_once( "../inc/exe.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$title = "お問合わせ管理";
define('MENU_NUM', 13);

if( isset( $_POST["inquiryId"] ) AND $_POST["inquiryId"] ){
    $selectDataArray = array( $_POST["inquiryId"] );
    $result = $db->query( "SELECT * FROM `inquiry` WHERE `inquiryId` = ? ", $selectDataArray ); 
        while( $row = $result -> fetchRow() ){
            $prtData['inquiryId'] = $row["inquiryId"];
            $prtData['name'] = $row["name"];
            $prtData['eMail'] = $row["eMail"];
            $prtData['comment'] = $row["comment"];
            $prtData['regDateTime'] = $row["regDateTime"];
            $prtData['chk']  = $row["chk"];
        }
}

$inquiryAddChangeForm = new HTML_QuickForm( 'inquiryAddChange', 'post' );

foreach( $reserveCompArray AS $key => $value ){
    $inquiryCompArrayGroup[] = $inquiryAddChangeForm->createElement( 'radio', null, null, $value, $key );
}
$inquiryAddChangeForm->addGroup( $inquiryCompArrayGroup, 'chk', '確認' );

$inquiryAddChangeForm->addElement( 'submit', 'submit', '変更', array("class" => "submit"));
$inquiryAddChangeForm->addElement( 'hidden', 'inquiryId', $_POST["inquiryId"] );
if( isset( $_POST["inquiryId"] ) ) $inquiryAddChangeForm->addElement( 'hidden', 'inquiryUpDate', $_POST["inquiryId"] );

//デフォルト値
$inquiryAddChangeForm->setDefaults(
    array(
	    "chk"  => $prtData['chk']
    )
);

$inquiryAddChangeForm->applyFilter( '__ALL__', 'trim');


$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$inquiryAddChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'prtTitle', $title );
$smarty->assign( 'menu', $menu );
if( $_POST["inquiryId"] ) $smarty->assign( 'inquiryId', $_POST["inquiryId"] );

if ( $inquiryAddChangeForm->validate() AND isset( $_POST["inquiryId"] ) ){
    $inquiryAddChangeForm->freeze();

    if( isset( $_POST["inquiryUpDate"] ) AND $_POST["inquiryUpDate"] AND $_POST["inquiryId"] ){
        $updateDataArray = array( $_POST["chk"], $_POST["inquiryId"] );
        $db->query( "UPDATE `inquiry` SET `chk` = ? WHERE `inquiryId` = ? ", $updateDataArray );

        header("Location: ./inquiryList.php");
        exit;

    }
}

$smarty->display( 'inquiryAddChange.tpl' );

?>
