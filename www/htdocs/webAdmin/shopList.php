<?
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "Pager/Pager.php" );
require_once( "jcode/jcode.php" );
require_once( "./menu.php" );

$pageTitle = "店舗一覧";

$limit = 20;

$ls    = 0;
if( $_REQUEST['ls'] ) $ls = $_REQUEST['ls'] * $limit - $limit;

if(  isset( $_POST['shopId'] ) AND $_POST['delChk'] == $_POST['shopId'] ){
    $deleteDataArray = array(  $_POST['shopId']);
    $db->query( "DELETE FROM `shopMaster` WHERE `shopId` = ? ", $deleteDataArray );
}

//ID+PASS 発行送信
if( isset( $_POST['sendMail'] ) AND $_POST['sendMail']  ){
    $shopDataArray = $db->getRow( "SELECT `shopName`, `loginId`, `loginPass` FROM `shopMaster` WHERE `shopId` = '" . $_POST['shopId'] . "' " );

	$_from    = $shopMail;
	$_subject = $siteNamePrint . " ログイン情報";

	$eMail = $shopDataArray['loginId'];
	//$eMail = "kouji@execute.jp";

	$_body  = $shopDataArray['shopName'] . "様 " . $siteNamePrint . " へのご登録ありがとうございます。\n\n";
	$_body .= "お客様のログインIDとパスワードを 送信致します。\n";
	$_body .= "厳重に保管して下さい。\n\n";
	$_body .= "=====================================================================\n";
	$_body .= "ID  \t" . $shopDataArray['loginId'] . "\n";
	$_body .= "PASS\t" . $shopDataArray['loginPass'] . "\n";
	$_body .= "=====================================================================\n\n";
	$_body .= "管理画面は\n";
	$_body .= "http://www." . $domain . "/shopAdmin/\n";
	$_body .= "となっております。\n\n\n";
	$_body .= "管理画面にある\n";
	$_body .= "1:利用規約\n";
	$_body .= "2:管理画面の操作説明\n";
	$_body .= "をよく読んで ご利用下さい。\n\n\n";

	//$_body .= "株式会社　d-works \n";
	$_body .= "    Mail  " . $shopMail . "\n";
	$_body .= "    http://www." . $domain . "/\n";
	
	mb_convert_variables( 'Shift-JIS', 'UTF-8', $_subject );
	mb_convert_variables( 'Shift-JIS', 'UTF-8', $_body );
	
	$header  = "From: " . $_from . "\n";
	$header .= "Reply-To: ".$_from."\n";
	$header .= "Return-Path: ".$_from."\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n";
	$header .= "Content-Transfer-Encoding: 7bit\n";
	$header .= "X-mailer: PHP/".phpversion();
	$_subject="=?iso-2022-jp?B?".base64_encode(jcodeconvert($_subject,0,3))."?=";
	$_body =jcodeconvert($_body,0,3);
	if($eMail)	mail($eMail,$_subject ,$_body,$header,"-f $_from");

	$sendShopName = $shopDataArray['shopName'];
}



if( isset( $_GET['t'] ) AND isset( $_GET['shopId'] ) ){
    switch( $_GET['t'] ){
        case u:
            $targetPriority = $_GET['p'] - 1;
            //優先順位を +1
            $db -> query( "UPDATE `shopMaster` SET `priority` = `priority` + 1 WHERE `priority` >= '" . $targetPriority . "' " );
        break;

        case d:
            $targetPriority = $_GET['p'] + 1;
            //優先順位を -1
            $db -> query( "UPDATE `shopMaster` SET `priority` = `priority` - 1 WHERE `priority` <= '" . $targetPriority . "' " );
        break;
    }

    $db -> query( "UPDATE `shopMaster` SET `priority` = '" . $targetPriority . "' WHERE `shopId` = '" . $_GET['shopId'] . "' " );
    $MyResult = $db -> query( "SELECT `shopId`, `priority` FROM `shopMaster` ORDER BY `priority` " );

    $i = 1;
    while( $row = $MyResult->fetchRow() ){
        $sortArray[$i] = $row['shopId'];
        $i++;
    }

    foreach( $sortArray AS $key => $value ){
        $db -> query( "UPDATE `shopMaster` SET `priority` = '" . $key . "' WHERE `shopId` = '" . $value . "' " );
    }
}

/* --- 検索用 --- */
if( $_POST['search'] ){
    $SQL = " WHERE `shopName` LIKE '%" . $_POST['search'] . "%' OR `shopNameKana` LIKE '%" . $_POST['search'] . "%' OR `tel` LIKE '%" . $_POST['search'] . "%' ";
}

$MyCount = $db->getOne( "SELECT COUNT( `shopId` ) FROM `shopMaster`" . $SQL . " " );
$result = $db->limitQuery( "SELECT `shopId`, `shopName`, `URL`, `areaId`, `prefectureId`, `genreId`, `priority`, `loginId`, `loginPass` FROM `shopMaster`" . $SQL . " ORDER BY `priority` ", $ls, $limit );
    $i = 1;
    while( $row = $result -> fetchRow() ){
        $prtData['shopMaster'][$i]['shopId']       = $row['shopId'];
        $prtData['shopMaster'][$i]['shopName']     = $row['shopName'];
        $prtData['shopMaster'][$i]['URL']          = $row['URL'];
        $prtData['shopMaster'][$i]['areaId']       = $areaArray[$row['areaId']];
        $prtData['shopMaster'][$i]['prefectureId'] = $prefectureArray[$row['prefectureId']];
        $prtData['shopMaster'][$i]['genreId']      = $genreArray[$row['genreId']];
        $prtData['shopMaster'][$i]['priority']     = $row['priority'];
        $prtData['shopMaster'][$i]['username']     = $row['loginId'];
        $prtData['shopMaster'][$i]['password']     = $row['loginPass'];
        $i++;
    }

$pageParam = array(
    "itemData"   => $dates, 
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
$smarty->assign( 'pageTitle', $pageTitle );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtFooter', $prtFooter );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'MyCount', $MyCount );
$smarty->assign( 'pagerLinks', $pagerLinks );
if( $_POST['sendMail'] ) $smarty->assign( 'sendShopName', $sendShopName );
$smarty->display( 'shopList.tpl' );
?>