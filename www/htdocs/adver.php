<?
//ini_set('error_reporting', E_ALL & ~E_NOTICE );
//ini_set('display_errors', 1);

require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "Smarty/Smarty.class.php" );
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );
require_once( "jcode/jcode.php" );


// 画像認証
require_once( './securimage/securimage.php' );

$pageName = "掲載申し込み";
$tableName = 'adver';

$form = new HTML_QuickForm( 'form', 'post' );

//$form->addElement( 'select', 'type', '申し込み区分', $adverTypeArray );
$form->addElement( 'select', 'area', '掲載エリア', $areaArray );

if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
    $form->addElement( 'text', 'shopName', '法人名もしくは組織名', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'shopNameKana', '法人名もしくは組織名(フリガナ)', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'masterName', '担当者名', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'industry', '業種', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'select', 'shopPref', '組織所在地', $prefectureArray );
    $form->addElement( 'text', 'shopAddress', '組織所在地', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'tel', '電話番号', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'workTime', '営業時間', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'holiday', '定休日', array( "istyle" => 1, "size" => 40 ) );
    //$form->addElement( 'text', 'entrySafety', '届出公安委員会', array( "istyle" => 1, "size" => 40 ) );
    //$form->addElement( 'text', 'entryNum', '届出番号', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'eMail', 'メールアドレス', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'pcURL', 'ホームページアドレス', array( "istyle" => 1, "size" => 60 ) );
    $form->addElement( 'text', 'mobileURL', '携帯ホームページアドレス', array( "istyle" => 1, "size" => 60 ) );
    $form->addElement( 'textarea', 'comment', '担当者コメント ', array( "istyle" => 1, "rows" => 16, "cols" => 55 ) );
}elseif(GetMobileCareer(0) == "smartPhone"){
    $form->addElement( 'text', 'shopName', '法人名もしくは組織名', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'shopNameKana', '法人名もしくは組織名(フリガナ)', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'masterName', '担当者名', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'industry', '業種', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'select', 'shopPref', '組織所在地', $prefectureArray );
    $form->addElement( 'text', 'shopAddress', '組織所在地', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'tel', '電話番号', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'workTime', '営業時間', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'holiday', '定休日', array( "istyle" => 1, "size" => 30 ) );
    //$form->addElement( 'text', 'entrySafety', '届出公安委員会', array( "istyle" => 1, "size" => 30 ) );
    //$form->addElement( 'text', 'entryNum', '届出番号', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'eMail', 'メールアドレス', array( "istyle" => 1, "size" => 30 ) );
    $form->addElement( 'text', 'pcURL', 'ホームページアドレス', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'text', 'mobileURL', '携帯ホームページアドレス', array( "istyle" => 1, "size" => 40 ) );
    $form->addElement( 'textarea', 'comment', '担当者コメント ', array( "istyle" => 1, "rows" => 16, "cols" => 35 ) );
}
$form->addElement( 'submit', 'submit', '送信', array("class" => "submit"));
$form->addElement( 'reset', 'reset', 'リセット', array("class" => "reset"));

//デフォルト
$form->setDefaults(
    array(
    	'pcURL' => 'http://',
    	'mobileURL' => 'http://'
    )
);
$form->addRule( 'shopName', '法人名もしくは組織名を入力して下さい。', 'required', null, 'client' );
$form->addRule( 'shopNameKana', '法人名もしくは組織名(フリガナ)を入力して下さい。', 'required', null, 'client' );
//$form->addRule( 'entrySafety', '届出公安委員会を入力して下さい。', 'required', null, 'client' );
//$form->addRule( 'entryNum', '届出番号を入力して下さい。', 'required', null, 'client' );
$form->addRule( 'eMail', 'メールアドレスを入力して下さい。', 'required', null, 'client' );


$form->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">の項目は必ず入力してください。</span>');
$form->setJsWarnings('入力エラー', "\n\n" . $_SERVER['SERVER_NAME'] . "");

if ($form->validate()){


    $securimage = new Securimage();

    if(isset($_POST['captcha_code'])) {
        if ($securimage->check($_POST['captcha_code']) === true) {
            $form->freeze();
//            $confirmPrint = 1;
            $errors = 0;
        } else {
            $errors = '認証文字列が正しくありません。再度ご入力ください。';
        }
    }


//	/* Zend画像認証の実行 */
//	//require_once( "Zend/Captcha/Image.php" );
//	$captcha = new Zend_Captcha_Image();
//	$captcha->setName("name");
//	$captchaValidate = array(
//		"id" => $_POST['captcha_id'],
//		"input" => $_POST['captcha']
//	);
//	$errorFlg = 0;
//	if (!$captcha->isValid($captchaValidate))$errorFlg = 1;
//	/* Zend画像認証の実行 */
	
	if(!$errors){
	    $form->freeze();
	    $form->process('process_display', false);
	    
	    $dateTime = date("Y/m/d g:i");
	    
	    //新規登録
	        $insertDataAray = array(
	        	$tableName,
	            $_POST["type"], 
	            $_POST["area"], 
	            
	            $_POST["shopName"], 
	            $_POST["shopNameKana"], 
	            $_POST["masterName"], 
	            $_POST["industry"], 
	            $_POST["shopPref"], 
	            $_POST["shopAddress"], 
	            $_POST["tel"], 
	            $_POST["workTime"], 
	            $_POST["holiday"], 
	            $_POST["entrySafety"], 
	            $_POST["entryNum"], 
	            	
	            $_POST["eMail"], 
	            $_POST["pcURL"], 
	            $_POST["mobileURL"], 
	            
	            $_POST["comment"], 
	            
	            $dateTime
	        );
	        
	        $db->query( "INSERT `!` ( `type`, 
	        						`area`,

	        						`shopName`,
	        						`shopNameKana`,
	        						`masterName`,
	        						`industry`,
	        						`shopPref`,
	        						`shopAddress`,
	        						`tel`,
	        						`workTime`,
	        						`holiday`,
	        						`entrySafety`,
	        						`entryNum`,

	        						`eMail`,
	        						`pcURL`,
	        						`mobileURL`,

									`comment`,
										
									`regDateTime`
				 ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ) ", $insertDataAray );
	    
	    /* --- 登録完了 --- */
//	    $_to      = $shopMail;
	    $_to = "mikuni@execute.jp";
	    $_from    = $shopMail;
	    $_subject = $siteNamePrint . "ホームページより掲載申し込みがありました。";

	    /* --- 登録完了のメールを送信 --- */
	    $_body  = $siteName . "\n";
	    $_body .= $domain . "\n";
	    $_body .= $siteNamePrint . "ホームページより掲載申し込みがありました。\n\n";

	    $_body .= "【送信日時】\n"   . $dateTime . "\n\n";
	    
	    //$_body .= "【申し込み区分】\n"   . $adverTypeArray[$_POST["type"]] . "\n\n";
	    $_body .= "【掲載エリア】\n"    . $areaArray[$_POST["area"]] . "\n\n";

	    $_body .= "【法人名もしくは組織名】\n"    . $_POST["shopName"] . "\n\n";
	    $_body .= "【法人名もしくは組織名(フリガナ)】\n"    . $_POST["shopNameKana"] . "\n\n";
	    $_body .= "【担当者名】\n"    . $_POST["masterName"] . "\n\n";
	    $_body .= "【業種】\n"    . $_POST["industry"] . "\n\n";
	    $_body .= "【組織所在地】\n"    . $prefectureArray[$_POST["shopPref"]] . "\n\n";
	    $_body .= "【電話番号】\n"    . $_POST["tel"] . "\n\n";
	    $_body .= "【営業時間】\n"    . $_POST["workTime"] . "\n\n";
	    $_body .= "【定休日】\n"    . $_POST["holiday"] . "\n\n";
	    //$_body .= "【届出公安委員会】\n"    . $_POST["entrySafety"] . "\n\n";
	    //$_body .= "【届出番号】\n"    . $_POST["entryNum"] . "\n\n";
	    $_body .= "【メールアドレス】\n"    . $_POST["eMail"] . "\n\n";
	    $_body .= "【ホームページアドレス】\n"    . $_POST["pcURL"] . "\n\n";
	    $_body .= "【携帯ホームページアドレス】\n"    . $_POST["mobileURL"] . "\n\n";
	    $_body .= "【担当者コメント】\n"   . $_POST["comment"] . "\n\n";
	    $_body .= "IP："     . $_SERVER["REMOTE_ADDR"] . "\n";
	    $_body .= "Server：" . $_SERVER["SERVER_NAME"] . "";
	
	    mb_convert_variables( 'Shift-JIS', 'UTF-8', $_subject );
	    mb_convert_variables( 'Shift-JIS', 'UTF-8', $_body );
	
	    $header   = "From: " . $_from . "\n";
	    $header  .= "Reply-To: " . $_from . "\n";
	    $header  .= "Return-Path: " . $_from . "\n";
	    $header  .= "MIME-Version: 1.0\n";
	    $header  .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n";
	    $header  .= "Content-Transfer-Encoding: 7bit\n";
	    $header  .= "X-mailer: PHP/".phpversion();
	    $_subject = "=?iso-2022-jp?B?" . base64_encode( jcodeconvert( $_subject, 0, 3 ) ) . "?=";
	    $_body    = jcodeconvert( $_body, 0, 3 );
	    mail( $_to, $_subject , $_body, $header, "-f $_from" );
	    
	    $pageChk = "1";
    }
}

$smarty = new Smarty;

$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$form ->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );
//$smarty->assign ( "captchaArray", $captchaArray );
$smarty->assign ( "errorFlg", $errorFlg );
$smarty->assign ( "emjArray", $emjArray );
$smarty->assign ( "areaArray", $areaArray );
$smarty->assign ( "banner", $banner );
$smarty->assign ( "pageName", $pageName );
$smarty->assign ( "pageChk", $pageChk );

if( $errors ) $smarty->assign ( "errors", $errors );

$smarty->assign( 'other_page', 1 );

$smarty->display( 'adver.tpl' );

//if( GetMobileCareer(0) == "PC" AND $_GET['s'] != '1' ){
//    $smarty->display( 'adver.tpl' );
//}elseif(GetMobileCareer(0) == "smartPhone"){
//    $smarty->display( 'adverSP.tpl' );
//}else{
//    $smarty->assign ( "areaIdSelect", $_GET[areaId] );
//    echo $emoji_obj->replace_emoji( $smarty->fetch( "adverM.tpl" ) );
//}
