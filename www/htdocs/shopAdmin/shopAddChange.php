<?
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//    お店登録修正
//
//
//
//
//
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/*
CREATE TABLE `shopMaster` (
  `shopId` int(8) NOT NULL auto_increment,
  `shopName` varchar(255) default NULL,
  `shopNameKana` varchar(255) default NULL,
  `tel` varchar(20) default NULL,
  `URL` varchar(100) default NULL,
  `RSS` text,
  `mail` varchar(100) default NULL,
  `jobCategory` varchar(255) default NULL,
  `salary` varchar(255) default NULL,
  `license` varchar(255) default NULL,
  `place` varchar(255) default NULL,
  `workday` varchar(255) default NULL,
  `workTime` varchar(255) default NULL,
  `treatment` varchar(255) default NULL,
  `workComment` text,
  `shopComment` text,
  `areaId` int(1) default NULL,
  `prefectureId` int(2) default NULL,
  `genreId` int(2) default NULL,
  `iconList` varchar(255) default NULL,
  `priority` int(3) default NULL,
  `regDateTime` datetime default NULL,
  `loginId` varchar(80) default NULL,
  `loginPass` varchar(80) default NULL,
  PRIMARY KEY  (`shopId`),
  KEY `shopName` (`shopName`),
  KEY `shopNameKana` (`shopNameKana`),
  KEY `tel` (`tel`),
  KEY `URL` (`URL`),
  KEY `mail` (`mail`),
  KEY `salary` (`salary`),
  KEY `areaId` (`areaId`),
  KEY `prefectureId` (`prefectureId`),
  KEY `genreId` (`genreId`),
  KEY `regDateTime` (`regDateTime`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM DEFAULT CHARSET=sjis AUTO_INCREMENT=1 ;


//model 0 -> リンクバナー :: 1 -> お店画像(320px 240px)
CREATE TABLE `image` (
  `imgId` int(10) NOT NULL auto_increment,
  `shopId` int(8) default NULL,
  `model` int(1) default 0,
  `file` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `width` varchar(8) default NULL,
  `height` varchar(8) default NULL,
  `contents` mediumblob,
  KEY `imgId` (`imgId`),
  KEY `shopId` (`shopId`)
) ENGINE=MyISAM  DEFAULT CHARSET=sjis;

*/
require_once( "../inc/authClient.php" );
require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./adminConfig.php" );
//require_once( "./menu.php" );

$prtTitle = "店舗登録";

//print_r( $_SESSION['_authsession']['data']['shopId'] );

if( isset( $_SESSION['_authsession']['data']['shopId'] ) ){
    $pageTitle = "店舗修正";

    //初期値を取得
    $selectDataArray = array( $_SESSION['_authsession']['data']['shopId'] );
    $result = $db->query( "SELECT * FROM `shopMaster` WHERE `shopId` = ? ", $selectDataArray );

    while( $row = $result -> fetchRow() ){
        $mail         = $row['mail'];
        $jobBack = $row['jobBack'];
        $workComment = $row['workComment'];
        $license = $row['license'];
        $activityaction = $row['activityaction'];
        $employ = $row['employ'];
        $place = $row['place'];
        $traffic = $row['traffic'];
        $workTime = $row['workTime'];
        $salary = $row['salary'];
        $treatment = $row['treatment'];
        $holiday = $row['holiday'];
        $educatetrain = $row['educatetrain'];
        $establish = $row['establish'];
        $represent = $row['represent'];
        $companyMoney = $row['companyMoney'];
        $employee = $row['employee'];
        $business = $row['business'];
        $officePlace = $row['officePlace'];
        $selection = $row['selection'];
        $application = $row['application'];
        $interviewPlace = $row['interviewPlace'];
        $contactAddress = $row['contactAddress'];
        $shopComment  = $row['shopComment'];
        $iconList     = $row['iconList'];
        $loginPass    = $row['loginPass'];
        foreach( split ( "\|", trim( $iconList, "|" ) ) AS $key => $value ){
            $iconListDef["iconList"][$value] = 1;
        };
    }

    $imgId0 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = '0' ", $selectDataArray );
    $imgId1 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = '1' ", $selectDataArray );
}

$shopAddChangeForm = new HTML_QuickForm( 'shopAddChange', 'post' );
$shopAddChangeForm->addElement( 'text', 'mail', '問い合わせメールアドレス', array( istyle => 1, "size" => 50 ) );
$shopAddChangeForm->addElement( 'textarea', 'jobCategory', '募集職種', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'jobBack', '募集背景', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'workComment', 'メニュー', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'license', 'カフェ概要', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'activityaction', 'こんな人が活躍（向いています）', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'employ', '雇用形態', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'place', '勤務地', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'traffic', '交通', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'workTime', '勤務時間', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'salary', '年収・給与', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'treatment', '待遇・福利厚生', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'holiday', '休日休暇', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'educatetrain', '教育制度', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'establish', '設立', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'represent', '代表者', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'companyMoney', '資本金', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'employee', '従業員数', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'business', '事業内容', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'officePlace', '事業所', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'selection', '選考プロセス', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'application', '応募方法', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'interviewPlace', '面接地', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'contactAddress', '連絡先', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'shopComment', 'お店からのメッセージ', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );

//アイコンリスト
foreach($iconArray AS $key => $value){
	$shopAddChangeForm->addElement( 'advcheckbox', 'iconList[' . $key . ']', $value, $value, NULL, array(0,1));
}
$shopAddChangeForm->addElement( 'text', 'loginPass', 'ログインPASS', array( istyle => 1, "size" => 21 ) );                     // ログインPASS

$shopAddChangeForm->addElement( 'text', 'priority', '表示順位', array( "istyle" => 1, "size" => 2 ) );        // 表示順位
$shopAddChangeForm->addElement( 'text', 'regDateTime', '登録日', array( "istyle" => 1, "size" => 23 ) );      // 登録

$shopAddChangeForm->addElement( 'file', 'userfile0', 'リンク用バナー' );
$shopAddChangeForm->addElement( 'file', 'userfile1', 'お店画像' );

$shopAddChangeForm->addElement( 'submit', 'submitReg', '修正' );

$shopAddChangeForm->applyFilter( '__ALL__', 'trim');

if( !$regDateTime ) $regDateTime = date ( "Y-m-d H:i:s", mktime ( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) );

//デフォルト
$shopAddChangeForm->setDefaults( $iconListDef );
$shopAddChangeForm->setDefaults(
    array(
        "mail"           => $mail , 
        "jobCategory"  => $jobCategory , 
        "jobBack"  => $jobBack , 
        "workComment"  => $workComment , 
        "license"  => $license , 
        "activityaction"  => $activityaction , 
        "employ"  => $employ , 
        "place"  => $place , 
        "traffic"  => $traffic , 
        "workTime"  => $workTime , 
        "salary"  => $salary , 
        "treatment"  => $treatment , 
        "holiday"  => $holiday , 
        "educatetrain"  => $educatetrain , 
        "establish"  => $establish , 
        "represent"  => $represent , 
        "companyMoney"  => $companyMoney , 
        "employee"  => $employee , 
        "business"  => $business , 
        "officePlace"  => $officePlace , 
        "selection"  => $selection , 
        "application"  => $application , 
        "interviewPlace"  => $interviewPlace , 
        "contactAddress"  => $contactAddress , 
        "shopComment"    => $shopComment , 
        "loginPass"      => $loginPass , 
    )
);

$shopAddChangeForm->setDefaults( $optionDefault );
$shopAddChangeForm->addRule( 'loginPass', 'ログインPASSを入力して下さい。', 'required', null, 'client' );

$shopAddChangeForm->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">の項目は必ず入力してください。</span>');
$shopAddChangeForm->setJsWarnings('入力エラー', "\n\n" . $_SERVER['SERVER_NAME'] . "");

if ( $shopAddChangeForm->validate() ){
    //アイコン配列展開
    unset($iconList);
    foreach( $_POST["iconList"] AS $key => $value ){
        if( $value ) $iconList .= "|" . $key;
    }
    if( $iconList ) $iconList .= "|";

    /* --- リンクバナー --- */
    $file0     = $_FILES['userfile0']['name'];
    $type0     = $_FILES['userfile0']['type'];
    $tmp_name0 = $_FILES['userfile0']['tmp_name'];
    $size0     = $_FILES['userfile0']['size'];

    // 画像サイズを取得
    list( $width0, $height0 ) = getimagesize( $tmp_name0 );
    if( $type0 == "image/pjpeg" )	$type0 = "image/jpeg";
    $contents0   = '0x' . bin2hex( file_get_contents( $tmp_name0 ) );


    /* --- 女の子バナー --- */
    $file1     = $_FILES['userfile1']['name'];
    $type1     = $_FILES['userfile1']['type'];
    $tmp_name1 = $_FILES['userfile1']['tmp_name'];
    $size1     = $_FILES['userfile1']['size'];

    // 画像サイズを取得
    list( $width1, $height1 ) = getimagesize( $tmp_name1 );
    if( $type1 == "image/pjpeg" )	$type1 = "image/jpeg";
    $contents1   = '0x' . bin2hex( file_get_contents( $tmp_name1 ) );

    $shopAddChangeForm->freeze();

    /* --- 修正 --- */
    $updateDataArray = array( $_POST['mail'], $_POST['jobCategory'], $_POST['jobBack'], $_POST['workComment'], $_POST['license'], $_POST['activityaction'], $_POST['employ'], $_POST['place'], $_POST['traffic'], $_POST['workTime'], $_POST['salary'], $_POST['treatment'], $_POST['holiday'], $_POST['educatetrain'], $_POST['establish'], $_POST['represent'], $_POST['companyMoney'], $_POST['employee'], $_POST['business'], $_POST['officePlace'], $_POST['selection'], $_POST['application'], $_POST['interviewPlace'], $_POST['contactAddress'], $_POST['shopComment'], $_POST['loginPass'], $iconList, $_SESSION['_authsession']['data']['shopId'] );
    $db->query( "UPDATE `shopMaster` SET `mail` = ?, `jobCategory` = ?, `jobBack` = ?, `workComment` = ?, `license` = ?, `activityaction` = ?, `employ` = ?, `place` = ?, `traffic` = ?, `workTime` = ?, `salary` = ?, `treatment` = ?, `holiday` = ?, `educatetrain` = ?, `establish` = ?, `represent` = ?, `companyMoney` = ?, `employee` = ?, `business` = ?, `officePlace` = ?, `selection` = ?, `application` = ?, `interviewPlace` = ?, `contactAddress` = ?, `shopComment` = ?, `loginPass` = ?, `iconList` = ? WHERE `shopId` = ? ", $updateDataArray );

    /* --- リンクバナー model == 0 --- */
    if( $contents0 != '0x' ){
        $selectDataArray = array( $_SESSION['_authsession']['data']['shopId'], 0 );
        $imgId0 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = ? ", $selectDataArray );
        
        if( $imgId0 ){
            $updateDataArray = array( $file0, $size0, $type0, $width0, $height0, $contents0, $imgId0, $_SESSION['_authsession']['data']['shopId'] );
            $db->query( "UPDATE `image` SET `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? AND `shopId` = ? ", $updateDataArray );
        }else{
            $insertDataArray = array( $_SESSION['_authsession']['data']['shopId'], 0, $file0, $size0, $type0, $width0, $height0, $contents0 );
            $db->query( "INSERT `image` ( `shopId`, `model`, `file`, `size`, `type`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray ) ;
        }
    }

    /* --- 女の子画像 model == 1 --- */
    if( $contents1 != '0x' ){
        $selectDataArray = array( $_SESSION['_authsession']['data']['shopId'], 1 );
        $imgId1 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = ? ", $selectDataArray );

        if( $imgId1 ){
            $updateDataArray = array( $file1, $size1, $type1, $width1, $height1, $contents1, $imgId1, $_SESSION['_authsession']['data']['shopId'] );
            $db->query( "UPDATE `image` SET `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? AND `shopId` = ? ", $updateDataArray );
        }else{
            $insertDataArray = array( $_SESSION['_authsession']['data']['shopId'], 1, $file1, $size1, $type1, $width1, $height1, $contents1 );
            $db->query( "INSERT `image` ( `shopId`, `model`, `file`, `size`, `type`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray ) ;
        }
    }

    header("Location: ./shopAddChange.php?q=1");
    exit;
}

$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$shopAddChangeForm ->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'errorStr', $errorStr );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtTitle', $prtTitle );
if( $imgId0 ) $smarty->assign( 'imgId0', $imgId0 );
if( $imgId1 ) $smarty->assign( 'imgId1', $imgId1 );

$smarty->display( 'shopAddChange.tpl' );
?>