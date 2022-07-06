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

$title = "掲載申込管理";
define('MENU_NUM', 13);

$limit = 40;

$ls    = 0;
if( $_REQUEST["ls"] ) $ls = $_REQUEST["ls"] * $limit - $limit;

$db  = DB::connect( $dsn );

if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}

$db->setFetchMode( DB_FETCHMODE_ASSOC );

if(  isset( $_POST["adverId"] ) AND $_POST["delChk"] == $_POST["adverId"] ){
    $deleteDataArray = array( $_POST["adverId"] );
    $db->query( "DELETE FROM `adver` WHERE `adverId` = ? ", $deleteDataArray );
}

//adverId  galType  yourName  yourAdd  tel  eMail  wantDate  time  customerType  payType  comment  

$MyCount = $db->getOne( "SELECT count( `adverId` ) FROM `adver` " );
$result  = $db->limitQuery( "SELECT * FROM `adver` ORDER BY `regDateTime` DESC ", $ls, $limit );
    $i = 1;
    while( $row = $result -> fetchRow() ){
        $prtData['adver'][$i]["adverId"] = $row["adverId"];
        $prtData['adver'][$i]["shopName"] = $row["shopName"];
        $prtData['adver'][$i]["eMail"] = $row["eMail"];
        $prtData['adver'][$i]["regDateTime"] = $row["regDateTime"];
        $prtData['adver'][$i]["chk"] = $row["chk"];
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
$smarty->assign( 'title', $title );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtFooter', $prtFooter );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'MyCount', $MyCount );
$smarty->assign( 'pagerLinks', $pagerLinks );
$smarty->assign( 'ls', $_GET[ls] );
$smarty->assign( 'prtTitle', 'お問合わせ管理' );

$smarty->display( 'adverList.tpl' );
?>
