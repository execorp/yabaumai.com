<?
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$pageTitle = "相互リンク一覧";

if( isset( $_POST['delChk'] ) AND isset( $_POST['imgId'] ) AND ( $_POST['delChk'] == $_POST['imgId'] ) ){
    $deleteDataArray = array( $_POST['imgId'] );
    $db->query( "DELETE FROM `linkEnterBanner` WHERE `imgId` = ? ", $deleteDataArray );

    $MyResult = $db->query( "SELECT `imgId` FROM `linkEnterBanner` ORDER BY `priority`" );
        $i = "1";
        while( $row = $MyResult->fetchRow() ){
            $sortArray[$i] = $row['imgId'];
            $i++;
        }

    for( $i=1; $i <= count( $sortArray ); $i++ ){
        $updateDataArray = array( $i, $sortArray[$i] );
        $db->query( "UPDATE `linkEnterBanner` SET `priority` = ? WHERE `imgId` = ? ", $updateDataArray );
    }
}

$MyResult = $db->query( "SELECT `imgId`, `name`, `URL` FROM `linkEnterBanner` ORDER BY `priority` " );
    $i = 1;
    while( $row = $MyResult->fetchRow() ){
        $prtData['linkEnterBanner'][$i]['imgId'] = $row['imgId'];
        $prtData['linkEnterBanner'][$i]['name']  = $row['name'];
        $prtData['linkEnterBanner'][$i]['URL']   = $row['URL'];
        $i++;
    }

$smarty = new Smarty;
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'pageTitle', $pageTitle );
$smarty->display( 'linkEnterList.tpl' );
?>