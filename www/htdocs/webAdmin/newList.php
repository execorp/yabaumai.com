<?
require_once( "../inc/exe.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );
require_once( "Pager/Pager.php" );

mb_language("Japanese");
mb_internal_encoding("SJIS");

$prtTitle = "新着情報一覧";

$limit = 10;

$ls    = 0;
if( $_REQUEST['ls'] ) $ls = $_REQUEST['ls'] * $limit - $limit;


if(  isset( $_POST['imgId'] ) AND $_POST['delChk'] == $_POST['imgId'] ){
    $deleteDataArray = array( $_POST['imgId'] );
    $db->query( "DELETE FROM `whatsNew` WHERE `imgId` = ? ", $deleteDataArray );
}

$MyCount = $db->getOne( "SELECT COUNT( `imgId` ) FROM `whatsNew` " );
$result  = $db->limitQuery( "SELECT `imgId`, `title`, `areaId`, `comment`, `dateTime`, `file` FROM `whatsNew` WHERE `feedFlg` = 0 ORDER BY `dateTime` DESC ", $ls, $limit );
    $i = 1;
    while( $row = $result -> fetchRow() ){
        $prtMySQLResult[$i]['imgId']    = $row['imgId'];
        $prtMySQLResult[$i]['file']     = $row['file'];
        $prtMySQLResult[$i]['title']    = strip_tags( $row['title'] );
        $prtMySQLResult[$i]['comment']  = mb_substr( stripSlushR( strip_tags( $row['comment'] ) ), 0, 20 ) . '...';
        $prtMySQLResult[$i]['areaId']   = $row['areaId'];
        $prtMySQLResult[$i]['areaName'] = $areaArray[$row['areaId']];
        $prtMySQLResult[$i]['dateTime'] = $row['dateTime'];
        $i++;
    }

$pageParam = array(
    "totalItems" => $MyCount, 
    "delta"      => 4, 
    "perPage"    => $limit, 
    "mode"       => "Sliding",
    "httpMethod" => "GET",
    "altFirst"   => "First", 
    "altPrev"    => "PrevPage", 
    "prevImg"    => "<<", 
    "altNext"    => "NextPage", 
    "nextImg"    => ">>", 
    "altLast"    => "Last", 
    "altPage"    => "", 
    "separator"  => " ＞ ", 
    "append"     => 1, 
    "urlVar"     => "ls", 
);

$pager      = pager::factory( $pageParam );
$pagerLinks = $pager->getLinks();

$smarty = new Smarty;
$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtTitle', $prtTitle );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtFooter', $prtFooter );
$smarty->assign( 'prtMySQLResult', $prtMySQLResult );
$smarty->assign( 'MyCount', $MyCount );
$smarty->assign( 'pagerLinks', $pagerLinks );
$smarty->display( 'newList.tpl' );
?>