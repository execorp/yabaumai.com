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

$title = "‚¨–â‡‚í‚¹";
$tableName = 'infoMaster';

$limit = 40;
$ls    = 0;
if( $_REQUEST["ls"] ) $ls = $_REQUEST["ls"] * $limit - $limit;

$db  = DB::connect( $dsn );

if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}

$db->setFetchMode( DB_FETCHMODE_ASSOC );

if(  isset( $_POST["id"] ) AND $_POST["delChk"] == $_POST["id"] ){
    $deleteDataArray = array( $tableName, $_POST["id"] );
    $db->query( "DELETE FROM `!` WHERE `id` = ? ", $deleteDataArray );
}

//recruitId  galType  yourName  yourAdd  tel  eMail  wantDate  time  customerType  payType  comment  

$MyCount = $db->getOne( "SELECT count( `id` ) FROM `!` ", array($tableName) );
$result  = $db->limitQuery( "SELECT * FROM `!` ORDER BY `dateTime` ", $ls, $limit, array($tableName) );
    $i = 1;
    while( $row = $result -> fetchRow() ){
        $prtData[$i]["id"] = $row["id"];
        $prtData[$i]["eMail"] = $row["eMail"];
        $prtData[$i]["shopName"] = $row["shopName"];
        $prtData[$i]["comment"] = $row["comment"];
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
    "separator"  => " „ ", 
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

$smarty->display( 'infoList.tpl' );
?>