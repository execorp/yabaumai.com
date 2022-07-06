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

require_once( "../inc/.ht_Config.php" );
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

$pageTitle = "店舗登録";

if( isset( $_POST['shopId'] ) ){
    $pageTitle = "店舗修正";

    //初期値を取得
    $selectDataArray = array( $_POST['shopId'] );
    $result = $db->query( "SELECT * FROM `shopMaster` WHERE `shopId` = ? ", $selectDataArray );
    while( $row = $result -> fetchRow() ){
        $shopName     = $row['shopName'];
        $shopNameKana = $row['shopNameKana'];
        $tel          = $row['tel'];
        $URL          = $row['URL'];
        $RSS          = $row['RSS'];
        $mail         = $row['mail'];
        $jobCategory = $row['jobCategory'];
        $jobBack = $row['jobBack'];
        $workComment = $row['workComment'];
        $license = $row['license'];
//        $activityaction = $row['activityaction'];
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
        $shopComment = $row['shopComment'];
        $areaId       = $row['areaId'];
        $prefectureId = $row['prefectureId'];
        $iconList     = $row['iconList'];
        $genreId      = $row['genreId'];
        $priority     = $row['priority'];
        $regDateTime  = $row['regDateTime'];
        $loginId      = $row['loginId'];
        $loginPass    = $row['loginPass'];
        
        $iconListArray = split ( "\|", trim( $iconList, "|" ) );
        foreach( $iconListArray AS $key => $value ){
            $iconListDef["iconList"][$value] = 1;
        };
    }

    $imgId0 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = '0' ", $selectDataArray );
    $imgId1 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = '1' ", $selectDataArray );
}

$shopAddChangeForm = new HTML_QuickForm( 'shopAddChange', 'post' );
$shopAddChangeForm->addElement( 'text', 'shopName', '店舗名', array( "istyle" => 1, "size" => 24 ) );
$shopAddChangeForm->addElement( 'text', 'shopNameKana', 'てんぽめい', array( "istyle" => 1, "size" => 24 ) );
$shopAddChangeForm->addElement( 'text', 'tel', '電話番号', array( istyle => 1, "size" => 21 ) );
$shopAddChangeForm->addElement( 'text', 'URL', 'HP URL', array( istyle => 1, "size" => 70 ) );
$shopAddChangeForm->addElement( 'text', 'RSS', 'RSS URL', array( istyle => 1, "size" => 70 ) );
$shopAddChangeForm->addElement( 'text', 'mail', '問い合わせメールアドレス', array( istyle => 1, "size" => 50 ) );
$shopAddChangeForm->addElement( 'textarea', 'jobCategory', '募集職種', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'jobBack', '募集背景', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'workComment', 'メニュー', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
$shopAddChangeForm->addElement( 'textarea', 'license', 'カフェ概要', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
//$shopAddChangeForm->addElement( 'textarea', 'activityaction', 'こんな人が活躍（向いています）', array( "istyle" => 1, "rows" => 7, "cols" => 55 ) );
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
$shopAddChangeForm->addElement( 'select', 'areaId', 'エリア', $areaArray );
$shopAddChangeForm->addElement( 'select', 'prefectureId', '都道府県', $prefectureArray );
$shopAddChangeForm->addElement( 'select', 'genreId', '職種', $genreArray );
$shopAddChangeForm->addElement( 'text', 'loginId', 'ログインID', array( istyle => 1, "size" => 21 ) );
$shopAddChangeForm->addElement( 'text', 'loginPass', 'ログインPASS', array( istyle => 1, "size" => 21 ) );

//アイコンリスト
foreach($iconArray AS $key => $value){
	$shopAddChangeForm->addElement( 'advcheckbox', 'iconList[' . $key . ']', $value, $value, NULL, array(0,1));
}

$shopAddChangeForm->addElement( 'text', 'priority', '表示順位', array( "istyle" => 1, "size" => 2 ) );        // 表示順位
$shopAddChangeForm->addElement( 'text', 'regDateTime', '登録日', array( "istyle" => 1, "size" => 23 ) );      // 登録

$shopAddChangeForm->addElement( 'file', 'userfile0', 'リンク用バナー' );
$shopAddChangeForm->addElement( 'file', 'userfile1', 'お店画像' );

if( isset( $_POST['shopId'] ) )$shopAddChangeForm->addElement( 'hidden', 'shopId', $_POST['shopId'] );

if( isset( $_POST['shopId'] ) ){
    $shopAddChangeForm->addElement( 'submit', 'submitReg', '修正' );
}else{
    $shopAddChangeForm->addElement( 'submit', 'submitReg', '登録' );
}

$shopAddChangeForm->applyFilter( '__ALL__', 'trim');

if( !$regDateTime ) $regDateTime = date ( "Y-m-d H:i:s", mktime ( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) );

//デフォルト
$shopAddChangeForm->setDefaults( $iconListDef );
$shopAddChangeForm->setDefaults(
    array(
        "shopName"     => $shopName , 
        "shopNameKana" => $shopNameKana , 
        "tel"          => $tel , 
        "URL"          => $URL , 
        "RSS"          => $RSS , 
        "mail"          => $mail , 
        "jobCategory"  => $jobCategory , 
        "jobBack"  => $jobBack , 
        "workComment"  => $workComment , 
        "license"  => $license , 
//        "activityaction"  => $activityaction ,
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
        "shopComment"  => $shopComment , 
        "areaId"       => $areaId , 
        "prefectureId" => $prefectureId , 
        "genreId"      => $genreId , 
        "priority"     => $priority , 
        "regDateTime"  => $regDateTime , 
        "loginId"      => $loginId , 
        "loginPass"    => $loginPass , 
    )
);

$shopAddChangeForm->setDefaults( $optionDefault );

$shopAddChangeForm->addRule( 'shopName', '名前を入力して下さい。', 'required', null, 'client' );
$shopAddChangeForm->addRule( 'shopNameKana', 'なまえを入力して下さい。', 'required', null, 'client' );
$shopAddChangeForm->addRule( 'loginId', 'ログインIDを入力して下さい。', 'required', null, 'client' );
$shopAddChangeForm->addRule( 'loginPass', 'ログインPASSを入力して下さい。', 'required', null, 'client' );

$shopAddChangeForm->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">の項目は必ず入力してください。</span>');
$shopAddChangeForm->setJsWarnings('入力エラー', "\n\n" . $_SERVER['SERVER_NAME'] . "");

if ( $shopAddChangeForm->validate() ){
    //微調整
    $_POST['URL'] = mbereg_replace( "http:\/\/", "", $_POST['URL'] );
    
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

    if( !$_POST['shopId'] ){
        //名前に重複がないか？
        $selectDataArray = array( $_POST['shopName'] );
        $otherName = $db->getOne( "SELECT `shopId` FROM `shopMaster` WHERE `shopName` = ? ", $selectDataArray );
        $selectDataArray = array( $_POST['loginId'] );
		$otherLoginId = $db->getOne( "SELECT `shopId` FROM `shopMaster` WHERE `loginId` = ? ", $selectDataArray );
		
        if( !$otherName){
        	if(!$otherLoginId){
            $shopAddChangeForm->freeze();

            /* --- 優先順位の並び替え --- */
            $selectDataArray = array( $_POST["priority"], $_POST['areaId'] );
            $db->query( "UPDATE `shopMaster` SET `priority` = `priority` + 1 WHERE `priority` >= ? AND `areaId` = ? ", $selectDataArray );

            //新規登録
            $insertDataAray = array( $_POST['shopName'], $_POST['shopNameKana'], $_POST['tel'], $_POST['URL'], $_POST['RSS'], $_POST['mail'], $_POST['jobCategory'], $_POST['jobBack'], $_POST['workComment'], $_POST['license'], $_POST['employ'], $_POST['place'], $_POST['traffic'], $_POST['workTime'], $_POST['salary'], $_POST['treatment'], $_POST['holiday'], $_POST['educatetrain'], $_POST['establish'], $_POST['represent'], $_POST['companyMoney'], $_POST['employee'], $_POST['business'], $_POST['officePlace'], $_POST['selection'], $_POST['application'], $_POST['interviewPlace'], $_POST['contactAddress'], $_POST['shopComment'], $_POST['areaId'], $_POST['loginId'], $_POST['loginPass'], $_POST['prefectureId'], $_POST['genreId'], $iconList, $_POST['priority'], $_POST['regDateTime'] );
            $db->query( "INSERT `shopMaster` ( `shopName`, `shopNameKana`, `tel`, `URL`, `RSS`, `mail`, `jobCategory`, `jobBack`, `workComment`, `license`, `employ`, `place`, `traffic`, `workTime`, `salary`, `treatment`, `holiday`, `educatetrain`, `establish`, `represent`, `companyMoney`, `employee`, `business`, `officePlace`, `selection`, `application`, `interviewPlace`, `contactAddress`, `shopComment`, `areaId`, `loginId`, `loginPass`, `prefectureId`, `genreId`, `iconList`, `priority`, `regDateTime` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ) ", $insertDataAray );
            $shopId = $db->getOne( "SELECT LAST_INSERT_ID()" );

            /* --- 再ソート --- */
            $selectDataArray = array( $_POST['areaId'] );
            $result = $db->query( "SELECT `shopId`, `areaId` FROM `shopMaster` WHERE `areaId` = ? ORDER BY `priority`", $selectDataArray );
            $i = 1;
            while( $row = $result->fetchRow() ){
                $updateDataArray = array( $i, $row['shopId'] );
                $db->query( "UPDATE `shopMaster` SET `priority` = ? WHERE `shopId` = ? ", $updateDataArray );

                $i++;
            }

            if( $shopId ){
                if( $contents0 != '0x' ){
                    $insertDataArray = array( $shopId, 0, $file0, $size0, $type0, $width0, $height0, $contents0 );
                    $db->query( "INSERT `image` ( `shopId`, `model`, `file`, `size`, `type`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray ) ;
                }

                if( $contents1 != '0x' ){
                    $insertDataArray = array( $shopId, 1, $file1, $size1, $type1, $width1, $height1, $contents1 );
                    $db->query( "INSERT `image` ( `shopId`, `model`, `file`, `size`, `type`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray ) ;
                }
            }


            header("Location: ./shopList.php?q=1");
            exit;
        	}else{
        		$errorStr = 'そのログインIDは既に登録されています。';
        	}
        }else{
        	$errorStr = 'その店舗名は既に登録されています。';
        }
    }else{
        $shopAddChangeForm->freeze();

        /* --- 現状のpriorityを取得 --- */
        $selectDataArray = array( $_POST['shopId'], $_POST['areaId'] );
        $nowPriority = $db->getOne( "SELECT `priority` FROM `shopMaster` WHERE `shopId` = ? AND `areaId` = ? ", $selectDataArray );

        if( $nowPriority > $_POST['priority'] ){
            $selectDataArray = array( $_POST['priority'], $_POST['areaId'] );
            $db->query( "UPDATE `shopMaster` SET `priority` = `priority` + 1 WHERE `priority` >= ? AND `areaId` = ? ", $selectDataArray );
        }elseif( $nowPriority < $_POST['priority'] ){
            $selectDataArray = array( $nowPriority, $_POST['priority'], $_POST['areaId'] );
            $db->query( "UPDATE `shopMaster` SET `priority` = `priority` - 1 WHERE `priority` > ? AND `priority` <= ? AND `areaId` = ? ", $selectDataArray );
        }

        /* --- 修正 --- */
        $updateDataArray = array( $_POST['shopName'], $_POST['shopNameKana'], $_POST['tel'], $_POST['URL'], $_POST['RSS'], $_POST['mail'], $_POST['jobCategory'], $_POST['jobBack'], $_POST['workComment'], $_POST['license'], $_POST['employ'], $_POST['place'], $_POST['traffic'], $_POST['workTime'], $_POST['salary'], $_POST['treatment'], $_POST['holiday'], $_POST['educatetrain'], $_POST['establish'], $_POST['represent'], $_POST['companyMoney'], $_POST['employee'], $_POST['business'], $_POST['officePlace'], $_POST['selection'], $_POST['application'], $_POST['interviewPlace'], $_POST['contactAddress'], $_POST['shopComment'], $_POST['areaId'], $_POST['loginId'], $_POST['loginPass'], $_POST['prefectureId'], $_POST['genreId'], $iconList, $_POST['priority'], $_POST['shopId'] );
        $db->query( "UPDATE `shopMaster` SET `shopName` = ?, `shopNameKana` = ?, `tel` = ?, `URL` = ?, `RSS` = ?, `mail` = ?, `jobCategory` = ?, `jobBack` = ?, `workComment` = ?, `license` = ?, `employ` = ?, `place` = ?, `traffic` = ?, `workTime` = ?, `salary` = ?, `treatment` = ?, `holiday` = ?, `educatetrain` = ?, `establish` = ?, `represent` = ?, `companyMoney` = ?, `employee` = ?, `business` = ?, `officePlace` = ?, `selection` = ?, `application` = ?, `interviewPlace` = ?, `contactAddress` = ?, `shopComment` = ?, `areaId` = ?, `loginId` = ?, `loginPass` = ?, `prefectureId` = ?, `genreId` = ?, `iconList` = ?, `priority` = ? WHERE `shopId` = ? ", $updateDataArray );

        /* --- 再ソート --- */
        $selectDataArray = array( $_POST['areaId'] );
        $result = $db->query( "SELECT `shopId`, `areaId` FROM `shopMaster` WHERE `areaId` = ? ORDER BY `priority`", $selectDataArray );
        $i = 1;
        while( $row = $result->fetchRow() ){
            $updateDataArray = array( $i, $row['shopId'] );
            $db->query( "UPDATE `shopMaster` SET `priority` = ? WHERE `shopId` = ? ", $updateDataArray );

            $i++;
        }

        /* --- リンクバナー model == 0 --- */
        if( $_POST['imageBanaDelChk'] ){ //削除
            $deleteDataArray = array( $_POST['imageBanaDelChk'] );
            $db->query( "DELETE FROM `image` WHERE `imgId` = ? ", $deleteDataArray );
        }else{
            if( $contents0 != '0x' ){
                $selectDataArray = array( $_POST['shopId'], 0 );
                $imgId0 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = ? ", $selectDataArray );

                if( $imgId0 ){
                    
                    $imgSaveFolder = realpath(dirname(__FILE__) . '/../');
                    //picResize.phpで作成されたキャッシュ画像を削除する
                    system( '/bin/rm -rf ' . $imgSaveFolder . '/userImg/image/' . $imgId0 . "/*" );
                    
                    $updateDataArray = array( $file0, $size0, $type0, $width0, $height0, $contents0, $imgId0, $_POST['shopId'] );
                    $db->query( "UPDATE `image` SET `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? AND `shopId` = ? ", $updateDataArray );
                }else{
                    $insertDataArray = array( $_POST['shopId'], 0, $file0, $size0, $type0, $width0, $height0, $contents0 );
                    $db->query( "INSERT `image` ( `shopId`, `model`, `file`, `size`, `type`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray ) ;
                }
            }
        }

        /* --- お店画像 model == 1 --- */
        if( $_POST['imageShopDelChk'] ){ //削除
            $deleteDataArray = array( $_POST['imageShopDelChk'] );
            $db->query( "DELETE FROM `image` WHERE `imgId` = ? ", $deleteDataArray );
        }else{
            if( $contents1 != '0x' ){
                $selectDataArray = array( $_POST['shopId'], 1 );
                $imgId1 = $db->getOne( "SELECT `imgId` FROM `image` WHERE `shopId` = ? AND `model` = ? ", $selectDataArray );

                if( $imgId1 ){
                    
                    $imgSaveFolder = realpath(dirname(__FILE__) . '/../');
                    //picResize.phpで作成されたキャッシュ画像を削除する
                    system( '/bin/rm -rf ' . $imgSaveFolder . '/userImg/image/' . $imgId1 . "/*" );
                    
                    $updateDataArray = array( $file1, $size1, $type1, $width1, $height1, $contents1, $imgId1, $_POST['shopId'] );
                    $db->query( "UPDATE `image` SET `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? AND `shopId` = ? ", $updateDataArray );
                }else{
                    $insertDataArray = array( $_POST['shopId'], 1, $file1, $size1, $type1, $width1, $height1, $contents1 );
                    $db->query( "INSERT `image` ( `shopId`, `model`, `file`, `size`, `type`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ! ) ", $insertDataArray ) ;
                }
            }
        }

        header("Location: ./shopList.php?q=2");
        exit;
    }
}

$smarty = new Smarty;
$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$shopAddChangeForm ->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
$smarty->assign( 'errorStr', $errorStr );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'pageTitle', $pageTitle );
if( $imgId0 ) $smarty->assign( 'imgId0', $imgId0 );
if( $imgId1 ) $smarty->assign( 'imgId1', $imgId1 );
$smarty->display( 'shopAddChange.tpl' );
?>