<?
require_once( "../inc/exe.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "Pager/Pager.php" );

$page = $_GET['ls'];
if( !$_GET['ls'] ) $page = 1;


$pageTitle = "女の子紹介 " . $page;
$pageFile = "girls";

if( GetMobileCareer( 0 ) == "PC" AND ( !isset( $_GET['s'] ) AND $_COOKIE["mobile"] != 1 ) ){
    $limit = 120;
}else{
    $limit = 2;
}

$ls    = 0;
if( $_REQUEST["ls"] ) $ls = $_REQUEST["ls"] * $limit - $limit;

$db  = DB::connect( $dsn );

if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}

$db->setFetchMode( DB_FETCHMODE_ASSOC );

switch( $_GET['q'] ){
    case 1:
        $SQLOrderBy = " `age`, ";
    break;

    case 2:
        $SQLOrderBy = " `nameKana`, ";
    break;
}

/* --- 女の子の一覧を取得 --- */
$selectDataArray = array( 1, 3 );
$MyCount = $db->getOne( "SELECT count( `id` ) FROM `galMaster` WHERE `prtFlg` \!= ? AND `prtFlg` \!= ? ", $selectDataArray );
$result  = $db->limitQuery( "SELECT `id`, `name`, `age`, `t`, `b`, `c`, `w`, `h`, `marquee`, `iconList` FROM `galMaster` WHERE `prtFlg` \!= ? AND `prtFlg` \!= ? ORDER BY " . $SQLOrderBy . "`priority` ", $ls, $limit, $selectDataArray );
    $i = 1;
    while( $row = $result->fetchRow() ){
        /* --- 画像を取得 --- */
        $selectDataArray = array( $row["id"] );
        $imgId = $db->getOne( "SELECT `imgId` FROM `galImage` WHERE `id` = ? ORDER BY `priority` LIMIT 1 ", $selectDataArray );

        /* --- 出勤を取得 --- */
        $selectDataArray = array( $row["id"], $workDate );
        $schFlg = $db->getOne( "SELECT `id` FROM `schedule` WHERE `id` = ? AND `workDate` = ? ", $selectDataArray );

		/* --- 現在出勤を取得 ---*/
		$nowTime = date("H:i:s");
        $selectDataArray = array( $row["id"], $workDate, $nowTime, $nowTime );
        $nowFlg = $db->getOne( "SELECT `id` FROM `schedule` WHERE `id` = ? AND `workDate` = ? AND `startTime` <= ? AND `endTime` >= ? AND `lastFlg` < 1", $selectDataArray );

        if( GetMobileCareer( 0 ) == "PC" AND ( !isset( $_GET['s'] ) AND $_COOKIE["mobile"] != 1 ) ){
            $prtImg = "<img src=\"../img/noimage135-180.jpg\" />";
            if( $imgId ) $prtImg = "<img src=\"../inc/picR.php?imgId=" . $imgId . "&mw=135&mh=180\" border=\"0\" />";
        }else{
            $prtImg = "<img src=\"../img_i/noimage100-125.gif\" alt=\"noimage\" border=\"0\" />";
            if( $imgId ) $prtImg = "<img src=\"../inc/picR.php?imgId=" . $imgId . "&mw=100&mh=125\" border=\"0\" />";
        }

        $prtData[$i]["id"]      = $row["id"];
        $prtData[$i]["name"]    = mb_convert_encoding(str_replace('～', '&#65374;', $row["name"]), "UTF-8", "SJIS");
        $prtData[$i]["age"]     = mb_convert_encoding(str_replace('～', '&#65374;', $row["age"]), "UTF-8", "SJIS");
        //$prtData[$i]["name"]    = $row["name"];
        //$prtData[$i]["age"]     = $row["age"];
        $prtData[$i]["t"]       = $row["t"];
        $prtData[$i]["b"]       = $row["b"];
        $prtData[$i]["c"]       = $cArray[$row["c"]];
        $prtData[$i]["w"]       = $row["w"];
        $prtData[$i]["h"]       = $row["h"];
        $prtData[$i]["marquee"] = $row["marquee"];

        $prtData[$i]["img"]     = $prtImg;
        $prtData[$i]["nowFlg"] = $nowFlg;

        //アイコンリスト取得
        $iconCnt = 0;
        if($schFlg){
        	$prtData[$i]["iconList"] .= '<img src="../img/icon/2.gif" />';
        	$iconCnt++;
        }
        $iconListArray = split('\|', $row["iconList"]);
        foreach($iconListArray AS $key => $value){
        	if($value>0){
	        	if($iconCnt<4)$prtData[$i]["iconList"] .= '<img src="../img/icon/' . $value . '.gif" />';
	        	$iconCnt++;
        	}
        }

        $i++;
    }

$pageParam = array(
    "totalItems" => $MyCount, 
    "delta"      => 0, 
    "perPage"    => $limit, 
    "mode"       => "Sliding",
    "httpMethod" => "GET",
    "altFirst"   => "First", 
    "altPrev"    => "PrevPage", 
    "altNext"    => "NextPage", 
    "altLast"    => "Last", 
    "altPage"    => "", 
	'prevImg'   => '&lt;&lt;BACK', 
	'nextImg'   => 'NEXT&gt;&gt;' ,
    "separator"  => "・", 
    "append"     => 1, 
    "urlVar"     => "ls", 
);

$pager      = pager::factory( $pageParam );
$pagerLinks = $pager->getLinks();

$smarty = new Smarty;

$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'pagerLinks', $pagerLinks );
$smarty->assign( 'method', $method );
$smarty->assign( 'pageTitle', $pageTitle );
$smarty->assign( 'pageFile', $pageFile );
$smarty->assign( 'titleMarquee', $titleMarquee );

//ヘッダーのピックアップ（待機中の女の子）
//require_once( "../pickup.php" );

//if( GetMobileCareer( 0 ) == "PC" AND ( !isset( $_GET['s'] ) AND $_COOKIE["mobile"] != 1 ) ){
    //$smarty->assign( 'ninjaId', NINJA_PC_GIRL );
    $smarty->cache_lifetime = 60;
    $smarty->display('index.tpl');

/*
}else{
    include_once( "emojilib/lib/mobile_class_8.php" );
    $smarty->assign( 'ninjaId', NINJA_MOBILE_GIRL );
    $smarty->assign( 'emojiArray', $emojiArray );

    if($_GET['id']){
        //リスト用情報取得
        $listDetail  = $db->getRow( "SELECT `id`,`name`,`age` FROM `galMaster` WHERE `id` = ? ", array( $_GET["id"] ) );
        $imgId = $db->getOne( "SELECT `imgId` FROM `galImage` WHERE `id` = ? ORDER BY `priority` LIMIT 1 ", array( $_GET["id"] ) );
        $listDetail['img'] = "<img src=\"../img_i/noimage100-125.gif\" alt=\"noimage\" border=\"0\" />";
        if( $imgId ) $listDetail['img'] = "<img src=\"../inc/picR.php?imgId=" . $imgId . "&mw=100&mh=125\" border=\"0\" />";
        $listDetail['schFlg'] = $db->getOne( "SELECT `id` FROM `schedule` WHERE `id` = ? AND `workDate` = ? ", array( $_GET["id"], $workDate ) );

       $pageTitle = "女の子紹介 " . $listDetail['name'];
       $smarty->assign( 'pageTitle', $pageTitle );    //再アサイン

        $smarty->assign( 'listDetail', $listDetail );
        echo $emoji_obj->replace_emoji( $smarty->fetch( 'listM.tpl' ) );
    }else{
        echo $emoji_obj->replace_emoji( $smarty->fetch( 'indexM.tpl' ) );
    }
}
*/

?>