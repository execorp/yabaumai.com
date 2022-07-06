<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

/*

2010/03/26  1.01   お知らせシステムアイコン表示不具合修正
2010/03/12  1.00   入力可能変更

**** 必須項目
** ファイル
/webAdmin/home.php ( 本体 )
/webAdmin/templates/home.tpl ( 表示用テンプレート )

** 変数
$ipArrowListArray ( 許可IP )


** SQL
CREATE TABLE `adminInfo` (
  `adminInfoId` int(8) NOT NULL auto_increment,
  `regDateTime` datetime default NULL,
  `message` text,
  `iconList` varchar(100) default NULL,
  PRIMARY KEY  (`adminInfoId`)
) ENGINE=MyISAM DEFAULT CHARSET=sjis;


*/

$version = "1.01";


$prtCategory = "home";
$prtTitle    = "ホーム";
$prtPage     = "お知らせ";

//require_once( "../inc/auth.php" );
require_once( "../inc/authClient.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "Pager/Pager.php" );
require_once( "./adminConfig.php" );

/* --- セッティング確認 --- */
unset( $settingError  );
if( !is_array( $ipArrowListArray ) )                                   $settingError[] = "許可IP配列が見つかりません";
if( !file_exists( "./templates/home.tpl" ) )                  $settingError[] = "home.tplが見つかりません";
if( !$db->getOne( "SHOW TABLES FROM `" . $MySQLDatabase . "` LIKE 'adminInfo'" ) ) $settingError[] = "adminInfoテーブルが見つかりません";

if( $settingError ){
    echo $_SERVER['PHP_SELF'] . " ファイル でのセッティングエラー<hr />\n";
    foreach( $settingError AS $key => $value ){
        echo $value . "<br />\n";
    }
    exit;
}
/* --- セッティング確認/ --- */

/* exe ログイン時のみ表示 */
$adminIconArray = array(
    0 => array(
        0 => "PC" , 
        1 => "pc.gif" , 
    ) , 

    1 => array(
        0 => "携帯" , 
        1 => "mobile.gif" , 
    ) , 

    2 => array(
        0 => "管理" , 
        1 => "admin.gif" , 
    ) 
);

$ls = 0;
$limit = 5;

if( $_REQUEST['ls'] ) $ls = $_REQUEST['ls'] * $limit - $limit;

$MyCount = $db->getOne( "SELECT COUNT( `adminInfoId` ) FROM `adminInfo` " );
$result  = $db->limitQuery( "SELECT `adminInfoId`, `regDateTime`, `message`, `iconList` FROM `adminInfo` ORDER BY `regDateTime` DESC, `adminInfoId` DESC ", $ls, $limit );
while( $row = $result->fetchRow() ){
    $prtData[$i]['adminInfoId'] = $row['adminInfoId'];
    $prtData[$i]['regDateTime'] = $row['regDateTime'];
    $prtData[$i]['message']     = $row['message'];

    foreach( split ( "\|", trim( $row['iconList'], "|" ) ) AS $key=> $value ){
        $prtData[$i]['iconList'][$value] = 1;
    }

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
    "prevImg"    => "&lt;&lt;", 
    "altNext"    => "NextPage", 
    "nextImg"    => "&gt;&gt;", 
    "altLast"    => "Last", 
    "altPage"    => "", 
    "separator"  => " ＞ ", 
    "append"     => 1, 
    "urlVar"     => "ls", 
);
$pager      = pager::factory( $pageParam );


if( $_SESSION['_authsession']['data']['userLevel'] == 0 ){
    $infoForm = new HTML_QuickForm( 'infoForm', 'post' );
    $infoForm->addElement( 'text', 'regDateTime', '登録日', array( "size" => 23, "style" => "padding: 1px 2px 1px;" ) );
    $infoForm->addElement( 'textarea', 'message', 'メッセージ', array( "cols" => 80, "rows" => 5, "style" => "padding: 1px 2px 1px;" ) );


    if( $_POST['adminInfoId'] ){
        //デフォルト値取得
        $selectDataArray = array( $_POST['adminInfoId'] );
        $result  = $db->query( "SELECT `regDateTime`, `message`, `iconList` FROM `adminInfo` WHERE `adminInfoId` = ? ", $selectDataArray );
        while( $row = $result->fetchRow() ){
            $regDateTime = $row['regDateTime'];
            $message     = $row['message'];
            $iconListDefArray = split ( "\|", trim( $row["iconList"], "|" ) );

            foreach( $iconListDefArray AS $key=> $value ){
                $iconListDef["iconList"][$value] = 1;
            }
        }

        $infoForm->addElement( 'hidden', 'adminInfoId', $_POST['adminInfoId'] );
        $infoForm->addElement( 'submit', 'submitChange', '修正', array( "class" => "submit" ) );
    }else{
        $infoForm->addElement( 'submit', 'submitReg', '登録', array( "class" => "submit" ) );
    }

    foreach( $adminIconArray AS $key => $value ){
        $iconGroup[] = $infoForm->createElement( 'advcheckbox', $key, null, $adminIconArray[$key][0] . "<img src=\"./img/" . $adminIconArray[$key][1] . "\" alt=\"" . $key . "\" />", array( 0, 1 ) );
    }
    $infoForm->addGroup( $iconGroup, 'iconList', null );

    $infoForm->applyFilter( '__ALL__', 'trim' );

    $infoForm->addRule( 'message', 'メッセージを入力して下さい。', 'required', null, 'client' );

    if( !$regDateTime ) $regDateTime = $dateTime;

    $infoForm->setDefaults( $iconListDef );
    $infoForm->setDefaults(
        array(
            "message"      => $message , 
            "regDateTime"  => $regDateTime , 
        )
    );

    if ( $infoForm->validate() ){
        $_POST['regDateTime'] = ZENtoHAN( $_POST['regDateTime'], 2 );

        $infoForm->freeze();

        if( $_POST['iconList'] ) foreach( (array)$_POST['iconList'] AS $key => $value ) if( $value )$iconList .= '|' . $key;
        if( $iconList ) $iconList .= '|';

        if( $_POST['submitReg'] ){
            $insertDataArray= array( $_POST['regDateTime'], $_POST['message'], $iconList );
            $db->query( "INSERT `adminInfo` ( `regDateTime`, `message`, `iconList` ) VALUES ( ?, ?, ? ) ", $insertDataArray );

            $compKey = 1;
        }

        if( $_POST['submitChange'] AND $_POST['adminInfoId'] ){
            $updateDataArray = array( $_POST['regDateTime'], $_POST['message'], $iconList, $_POST['adminInfoId'] );
            $db->query( "UPDATE `adminInfo` SET `regDateTime` = ?, `message` = ?, `iconList` = ? WHERE `adminInfoId` = ? ", $updateDataArray );

            $compKey = 2;
        }

        header( "Location: ./home.php?comp=" . $compKey . "" );
        exit;
    }
}


/* --- 指定IP以外 exe 管理非表示 --- */
if( !in_array( $_SERVER['REMOTE_ADDR'], $ipArrowListArray ) ){
    unset( $levelArray[0] );
    unset( $levelArray[1] );
    $sql = " AND `userLevel` > '1'";
}



$smarty = new Smarty;

if( $_SESSION['_authsession']['data']['userLevel'] == 0 ){
    $renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
    $infoForm->accept( $renderer );
    $smarty->assign( 'form', $renderer->toArray() );

}

$smarty->assign( 'version', $version );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'category', $_GET["category"] );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtCategory', $prtCategory );
$smarty->assign( 'prtTitle', $prtTitle );
$smarty->assign( 'prtPage', $prtPage );
$smarty->assign( 'prtFooter', $prtFooter );
$smarty->assign( 'adminIconArray', $adminIconArray );
$smarty->assign( 'pagerLinks', $pager->getLinks() );
$smarty->display( 'home.tpl' );

?>