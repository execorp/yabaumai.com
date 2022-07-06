<?
require_once( "../inc/exe.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$title = "掲載申込管理";
define('MENU_NUM', 13);

if( isset( $_POST["adverId"] ) AND $_POST["adverId"] ){
    $selectDataArray = array( $_POST["adverId"] );
    //$prtData = $db->getRow( "SELECT * FROM `adver` WHERE `adverId` = ? ", $selectDataArray ); 
    $MyResult = $db->query( "SELECT * FROM `adver` WHERE `adverId` = ? ", $selectDataArray ); 
        while( $row = $MyResult->fetchRow() ){
            $prtData['adver']['adverId'] = $row['adverId'];
            $prtData['adver']['area'] = $areaArray[$row['area']];
            $prtData['adver']['shopName'] = $row['shopName'];
            $prtData['adver']['shopNameKana'] = $row['shopNameKana'];
            $prtData['adver']['masterName'] = $row['masterName'];
            $prtData['adver']['industry'] = $row['industry'];
            $prtData['adver']['shopPref'] = $prefectureArray[$row['shopPref']];
            $prtData['adver']['shopAddress'] = $row['shopAddress'];
            $prtData['adver']['tel'] = $row['tel'];
            $prtData['adver']['workTime'] = $row['workTime'];
            $prtData['adver']['holiday'] = $row['holiday'];
            $prtData['adver']['eMail'] = $row['eMail'];
            $prtData['adver']['pcURL'] = $row['pcURL'];
            $prtData['adver']['mobileURL'] = $row['mobileURL'];
            $prtData['adver']['comment'] = $row['comment'];
            $prtData['adver']['regDateTime'] = $row['regDateTime'];
            $prtData['adver']['datetime'] = $row['datetime'];
            $prtData['adver']['chk'] = $row['chk'];
        }
}

$adverAddChangeForm = new HTML_QuickForm( 'adverAddChange', 'post' );

foreach( $reserveCompArray AS $key => $value ){
    $adverCompArrayGroup[] = $adverAddChangeForm->createElement( 'radio', null, null, $value, $key );
}
$adverAddChangeForm->addGroup( $adverCompArrayGroup, 'chk', '確認' );

$adverAddChangeForm->addElement( 'submit', 'submit', '変更', array("class" => "submit"));
$adverAddChangeForm->addElement( 'hidden', 'adverId', $_POST["adverId"] );
if( isset( $_POST["adverId"] ) ) $adverAddChangeForm->addElement( 'hidden', 'adverUpDate', $_POST["adverId"] );

//デフォルト値
$adverAddChangeForm->setDefaults(
    array(
	    "chk"  => $prtData['adver']['chk']
    )
);
unset($prtData['adver']['chk']);

$adverAddChangeForm->applyFilter( '__ALL__', 'trim');

$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$adverAddChangeForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'labelArray', $labelArray );
$smarty->assign( 'prtTitle', $title );
$smarty->assign( 'menu', $menu );
if( $_POST["adverId"] ) $smarty->assign( 'adverId', $_POST["adverId"] );

if ( $adverAddChangeForm->validate() AND isset( $_POST["adverId"] ) ){
    $adverAddChangeForm->freeze();

    if( isset( $_POST["adverUpDate"] ) AND $_POST["adverUpDate"] AND $_POST["adverId"] ){
        $updateDataArray = array( $_POST["chk"], $_POST["adverId"] );
        $db->query( "UPDATE `adver` SET `chk` = ? WHERE `adverId` = ? ", $updateDataArray );

        header("Location: ./adverList.php");
        exit;

    }
}

$smarty->display( 'adverAddChange.tpl' );

?>
