<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

/*

2010/04/09  1.00   変更・要望作成

**** 必須項目
** ファイル
/webAdmin/request.php ( 本体 )
/webAdmin/templates/request.tpl ( 表示用テンプレート )

** 変数
$ipArrowListArray ( 許可IP )


** SQL
CREATE TABLE `request` (
  `requestId` int(8) NOT NULL auto_increment,
  `requestSubId` int(3),
  `regDateTime` datetime default NULL,
  `title` varchar(100) default NULL,
  `message` text,
  `iconList` varchar(100) default NULL,
  `moneyFlg` int(1) default 0,
  `money` varchar(8) default 0,
  `progressFlg` int(1) default 0,
  PRIMARY KEY  (`requestId`)
) ENGINE=MyISAM DEFAULT CHARSET=sjis;

progress 0 -> 発注 :: 1 -> 確認中 :: 2 -> 作業中 :: 3 -> 完了 :: 9 -> キャンセル
*/

$version = "1.00";


$prtCategory = "home";
$prtTitle    = "要望";
$prtPage     = "変更・要望";

require_once( "../inc/auth.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "jcode/jcode.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "Pager/Pager.php" );
require_once( "./adminConfig.php" );

$requestMailArray = array(
    "kouji@execute.jp" , 
//    "kouji@docomo.ne.jp" 
);

/* --- セッティング確認 --- */
unset( $settingError  );
if( !is_array( $requestMailArray ) )         $settingError[] = "メール送信先配列が見つかりません";
if( !file_exists( "./templates/request.tpl" ) ) $settingError[] = "home.tplが見つかりません";
if( !$db->getOne( "SHOW TABLES FROM `" . $MySQLDatabase . "` LIKE 'request'" ) ) $settingError[] = "requestテーブルが見つかりません";

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

$progressArray = array(
    0 => "発注" , 
    1 => "確認中" , 
    2 => "作業中" , 
    3 => "完了" , 
    9 => "キャンセル"
);

$progressArrayOrigin = $progressArray;

if( $_SESSION['_authsession']['data']['userLevel'] != 0 ){
    unset( $progressArray[1] );
    unset( $progressArray[2] );
    unset( $progressArray[3] );
}

unset( $title );

$ls = 0;
$limit = 5;

if( $_REQUEST['ls'] ) $ls = $_REQUEST['ls'] * $limit - $limit;

if( isset( $_GET['submit'] ) AND $_GET['submit'] ){
    foreach( $_GET['progress'] AS $key => $value ){
        if( $value == 1 ){
            if( $sql )  $sql .= " OR";
            $sql .= " `progressFlg` = '" . $key . "' ";
        }
    }

    if( !$sql ){
        $_GET['progress'][0] = 1;
        $_GET['progress'][1] = 1;
        $_GET['progress'][2] = 1;
        $_GET['progress'][3] = 1;
        $_GET['progress'][9] = 1;
    }
}else{
    $sql = " `progressFlg` < '9' ";
}

$MyCount = $db->getOne( "SELECT COUNT( `requestId` ) FROM `request` " );
$result  = $db->limitQuery( "SELECT `requestId`, `regDateTime`, `title`, `message`, `iconList`, `moneyFlg`, `progressFlg` FROM `request` WHERE" . $sql . " ORDER BY `regDateTime` DESC, `requestId` DESC ", $ls, $limit );
while( $row = $result->fetchRow() ){
    $prtData[$i]['requestId']   = $row['requestId'];
    $prtData[$i]['regDateTime'] = $row['regDateTime'];
    $prtData[$i]['title']       = $row['title'];
    $prtData[$i]['message']     = $row['message'];

    foreach( split ( "\|", trim( $row['iconList'], "|" ) ) AS $key=> $value ){
        $prtData[$i]['iconList'][$value] = 1;
    }

    $prtData[$i]['moneyFlg']    = $row['moneyFlg'];
    $prtData[$i]['progressFlg'] = $row['progressFlg'];
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



    $requestForm = new HTML_QuickForm( 'infoForm', 'post' );
    $requestForm->addElement( 'text', 'regDateTime', '登録日', array( "size" => 23, "style" => "padding: 1px 2px 1px;" ) );
    $requestForm->addElement( 'text', 'title', 'タイトル', array( "size" => 50, "style" => "padding: 1px 2px 1px;" ) );
    $requestForm->addElement( 'textarea', 'message', 'メッセージ', array( "cols" => 80, "rows" => 5, "style" => "padding: 1px 2px 1px;" ) );
    $requestForm->addElement( 'select', 'progressFlg', '進捗', $progressArray );
    $requestForm->addElement( 'text', 'money', '金額', array( "size" => 10, "style" => "padding: 1px 2px 1px;" ) );
    $requestForm->addElement( 'advcheckbox', 'moneyFlg', null, "有料", array( 0, 1 ) );

    if( $_POST['requestId'] ){
        //デフォルト値取得
        $selectDataArray = array( $_POST['requestId'] );
        $result  = $db->query( "SELECT `regDateTime`, `title`, `message`, `iconList`, `moneyFlg`, `money`, `progressFlg` FROM `request` WHERE `requestId` = ? ", $selectDataArray );
        while( $row = $result->fetchRow() ){
            $regDateTime = $row['regDateTime'];
            $title       = $row['title'];
            $message     = $row['message'];
            $iconListDefArray = split ( "\|", trim( $row["iconList"], "|" ) );

            foreach( $iconListDefArray AS $key=> $value ){
                $iconListDef['iconList'][$value] = 1;
            }
            $moneyFlg    = $row['moneyFlg'];
            $money       = $row['money'];
            $progressFlg = $row['progressFlg'];
        }

        $requestForm->addElement( 'hidden', 'requestId', $_POST['requestId'] );
        $requestForm->addElement( 'submit', 'submitChange', '修正', array( "class" => "submit" ) );
    }else{
        $requestForm->addElement( 'submit', 'submitReg', '登録', array( "class" => "submit" ) );
    }

    $requestForm->addElement( 'submit', 'submit', '絞り込み', array( "class" => "submit" ) );

    foreach( $adminIconArray AS $key => $value ){
        $iconGroup[] = $requestForm->createElement( 'advcheckbox', $key, null, $adminIconArray[$key][0] . "<img src=\"./img/" . $adminIconArray[$key][1] . "\" alt=\"" . $key . "\" />", array( 0, 1 ) );
    }
    $requestForm->addGroup( $iconGroup, 'iconList', null );

    /* --- 絞り込みよう --- */
    foreach( $progressArrayOrigin AS $key => $value ){
        $progressGroup[] = $requestForm->createElement( 'advcheckbox', $key, null, $progressArrayOrigin[$key], array( 0, 1 ) );
        if( $key < 9 ) $progressDef['progress'][$key] = 1;
        if( isset( $_GET['progress'][$key] ) AND $_GET['progress'][$key] == 0 ) $progressDef['progress'][$key] = 0;
        if( isset( $_GET['progress'][$key] ) AND $_GET['progress'][$key] == 1 ) $progressDef['progress'][$key] = 1;
    }
    $requestForm->addGroup( $progressGroup, 'progress', null );

    $requestForm->applyFilter( '__ALL__', 'trim' );

    $requestForm->addRule( 'title', 'タイトルを入力して下さい。', 'required', null, 'client' );
    $requestForm->addRule( 'message', 'メッセージを入力して下さい。', 'required', null, 'client' );

    if( !$regDateTime ) $regDateTime = $dateTime;

    $requestForm->setDefaults( $progressDef );
    $requestForm->setDefaults( $iconListDef );
    $requestForm->setDefaults(
        array(
            "message"     => $message , 
            "title"       => $title , 
            "regDateTime" => $regDateTime , 
            "moneyFlg"    => $moneyFlg , 
            "money"       => $money , 
            "progressFlg" => $progressFlg , 
        )
    );

    if ( $requestForm->validate() ){
        $_POST['regDateTime'] = ZENtoHAN( $_POST['regDateTime'], 2 );

        $requestForm->freeze();

        if( $_POST['iconList'] ) foreach( (array)$_POST['iconList'] AS $key => $value ) if( $value )$iconList .= '|' . $key;
        if( $iconList ) $iconList .= '|';

        if( $_POST['submitReg'] ){
            $insertDataArray= array( $_POST['regDateTime'], $_POST['title'], $_POST['message'], $iconList, $_POST['moneyFlg'], $_POST['money'], $_POST['progressFlg'] );
            $db->query( "INSERT `request` ( `regDateTime`, `title`, `message`, `iconList`, `moneyFlg`, `money`, `progressFlg` ) VALUES ( ?, ?, ?, ?, ?, ?, ? ) ", $insertDataArray );
            $_POST['requestId'] = $db->getOne( "SELECT LAST_INSERT_ID()" );

            $compKey = 1;
        }

        if( $_POST['submitChange'] AND $_POST['requestId'] ){
            if( $_SESSION['_authsession']['data']['userLevel'] == 0 ){
                $updateDataArray = array( $_POST['regDateTime'], $_POST['title'], $_POST['message'], $iconList, $_POST['progressFlg'], $_POST['requestId'] );
                $db->query( "UPDATE `request` SET `regDateTime` = ?, `title` = ?, `message` = ?, `iconList` = ?, `progressFlg` = ? WHERE `requestId` = ? ", $updateDataArray );
            }else{
                $updateDataArray = array( $_POST['regDateTime'], $_POST['title'], $_POST['message'], $iconList, $_POST['moneyFlg'], $_POST['money'], $_POST['progressFlg'], $_POST['requestId'] );
                $db->query( "UPDATE `request` SET `regDateTime` = ?, `title` = ?, `message` = ?, `iconList` = ?, `moneyFlg` = ?, `money` = ?, `progressFlg` = ? WHERE `requestId` = ? ", $updateDataArray );
            }

            $compKey = 2;
        }

        /* --- 確認メール送信 --- */
        $mailFrom          = "work@execute.jp";
        $returnMailAddress = "info@execute.jp";

        unset( $mailSubject );
        if( $_POST['moneyFlg'] == 1 ) $mailSubject = "金 ";
        $mailSubject .= "変更・要望 確認メール";

        $mailBody     = $siteName . "\n";
        $mailBody    .= "http://www." . $domain . "\n";
        $mailBody    .= $_POST['regDateTime'] . "\n";
        $mailBody    .= "状態 ";
        if( $compKey == 1 ) $mailBody    .= "新規\n";
        if( $compKey == 2 ) $mailBody    .= "修正\n";
        $mailBody    .= "進捗 " . $progressArray[$_POST['progressFlg']] . "\n";
        if( $_POST['moneyFlg'] == 1 AND $_POST['money'] > 0 ) $mailBody    .= "予価 \\" . number_format( $_POST['money'] ) . "\n\n";
        $mailBody    .= $_POST['title'] . "\n";
        $mailBody    .= $_POST['message'] . "\n\n";
        foreach( (array)$_POST['iconList'] AS $key => $value ){
            $mailBody    .= $iconListArray[$value] . " ";
        }
        $mailBody    .= "\n";
        $mailBody    .= "JobNum:" . $_POST['requestId'] . "-" . ereg_replace( "-| |:", "", $_POST['regDateTime'] ) . "\n";
        $mailHeader   = "From: "        . $mailFrom . "\n";
        $mailHeader  .= "Reply-To: "    . $mailFrom . "\n";
        $mailHeader  .= "Return-Path: " . $returnMailAddress . "\n";
        $mailHeader  .= "MIME-Version: 1.0\n";

        //料金が発生する場合は 重要度を最大に
        if( $_POST['moneyFlg'] == 1 AND $_POST['money'] > 0 )$mailHeader  .= "X-Priority: 1\n";
        if( $_POST['moneyFlg'] == 1 AND $_POST['money'] > 0 )$mailHeader  .= "X-MSMail-Priority: High\n";
        if( $_POST['moneyFlg'] == 1 AND $_POST['money'] > 0 )$mailHeader  .= "Importance: High\n";

        $mailHeader  .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n";
        $mailHeader  .= "Content-Transfer-Encoding: 7bit\n";
        $mailHeader  .= "X-mailer: execute.jp ";
        $mailSubject  = "=?iso-2022-jp?B?" . base64_encode( jcodeconvert( $mailSubject, 0, 3) ) . "?=";
        $mailBody     = jcodeconvert( $mailBody, 0, 3 );

        foreach( $requestMailArray AS $key => $value ){
            if( $value ) mail( $value, $mailSubject, $mailBody, $mailHeader, "-f " . $returnMailAddress . "" );
        }
        header( "Location: ./request.php?comp=" . $compKey . "" );
    }

$smarty = new Smarty;

$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$requestForm->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'version', $version );
$smarty->assign( 'prtData', $prtData );
$smarty->assign( 'domain', $domain );
$smarty->assign( 'category', $_GET['category'] );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'prtCategory', $prtCategory );
$smarty->assign( 'prtTitle', $prtTitle );
$smarty->assign( 'prtPage', $prtPage );
$smarty->assign( 'prtFooter', $prtFooter );
$smarty->assign( 'adminIconArray', $adminIconArray );
$smarty->assign( 'progressArray', $progressArrayOrigin );
$smarty->assign( 'pagerLinks', $pager->getLinks() );
$smarty->display( 'request.tpl' );

?>
