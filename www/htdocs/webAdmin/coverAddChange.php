<?
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
require_once("../inc/.ht_Config.php");
require_once( "HTML/QuickForm.php" );
require_once( "HTML/QuickForm/Renderer/ArraySmarty.php" );
require_once( "/usr/local/lib/php/Smarty/Smarty.class.php" );
require_once( "DB.php" );
require_once( "./menu.php" );

mb_language("Japanese");
mb_internal_encoding("SJIS");

$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );

/*---------------------------------------------------------------------
/* INIT
----------------------------------------------------------------------*/
$coverData = $db->getRow( "SELECT * FROM `coverImage` WHERE `imgId` = ? ", array( @$_POST["imgId"] ));
        
$form = new HTML_QuickForm('cover', 'post');

//���[�U�[��{���
$form->addElement( 'text', 'priority', '�D�揇��',  array( "istyle" => 1, "size" => 3 ) );
$form->addElement( 'file', 'userfile', '�摜' );
$prtArray = array( 0 => '�\��', 1 => '��\��');
$form->addElement( 'select', 'prtFlg', '�\��', $prtArray );
$form->addElement( 'submit', 'submit', '�o�^', array( "class" => "botan_right" ) );
$form->addElement( 'text', 'galName', '���̎q�̖��O', array( "size" => "40" ) );

/* �G���A��-�X�ܖ� �q�A�Z���N�g */
foreach($areaArray AS $key => $value){
	$shopArray[$key] = $db->getAssoc('SELECT `shopId`, `shopName` FROM `shopMaster` WHERE `areaId` = ' . $key);
}
$form->setDefaults(array('areaShop' => array($coverData['areaId'], $coverData['shopId'])));
$sel =& $form->addElement('hierselect', 'areaShop', '�G���A�E�X�ܖ�');
$sel->setOptions(array($areaArray, $shopArray));
/* �G���A��-�X�ܖ� �q�A�Z���N�g */

if( isset( $_POST["imgId"] ) )$form->addElement( 'hidden', 'imgId', $_POST["imgId"] );
$form->applyFilter( '__ALL__', 'trim');

$form->setDefaults(
    array(
        "galName"    => $coverData['galName'], 
        "priority"    => $coverData['priority'], 
        "prtFlg"      => $coverData['prtFlg'], 
        "file"      => $coverData['file']
    )
);

$form->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">�̍��ڂ͕K�����͂��Ă��������B</span>');
$form->setJsWarnings('���̓G���[', "\n\n" . $_SERVER["SERVER_NAME"] . "");

if(!$_POST['changed']){
	if ( $form->validate() ){
		//�摜�ȊO�̃f�[�^�o�^
	    if( !$_POST["imgId"] ){
	        //�V�K�o�^
	        $insertDataAray = array( $_POST['galName'], $_POST['areaShop'][0], $_POST['areaShop'][1], $_POST["priority"], $_POST["prtFlg"] );
	        $db->query( "INSERT `coverImage` ( `galName`, `areaId` , `shopId`, `priority`, `prtFlg` ) 
	                     VALUES ( ?, ?, ?, ?, ? ) ", $insertDataAray );
	        //print_r($db);exit;
	        $compChk = 1;
			$_postForEnter_id = $db->getOne( "SELECT LAST_INSERT_ID()" );//���̃��R�[�hID
	    }else{
	        //�C��
	        $updateDataArray = array( $_POST['galName'], $_POST['areaShop'][0], $_POST['areaShop'][1], $_POST["priority"], $_POST["prtFlg"], $_POST["imgId"] );
	        $db->query( "UPDATE `coverImage` SET `galName` = ?, `areaId` = ?, `shopId` = ?, `priority` = ?, `prtFlg` = ? WHERE `imgId` = ?", $updateDataArray );

	        $compChk = 2;
			$_postForEnter_id = $_POST["imgId"];//���̃��R�[�hID
	    }
	    
	    //�摜�f�[�^�o�^
	    $file     = $_FILES['userfile']['name'];
	    $type     = $_FILES['userfile']['type'];
	    $tmp_name = $_FILES['userfile']['tmp_name'];
	    $size     = $_FILES['userfile']['size'];
	    // �摜�T�C�Y���擾
	    list( $width, $height ) = getimagesize( $tmp_name );
	    if( $type == "image/pjpeg" ) $type = "image/jpeg";
	    $contents   = '0x' . bin2hex( file_get_contents( $tmp_name ) );
	    if( $contents != '0x' ){
		    $updateDataArray = array( $file, $size, $type, $width, $height, $contents, $_postForEnter_id );
		    $db->query( "UPDATE `coverImage` SET `file` = ?, `size` = ?, `type` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `imgId` = ? ", $updateDataArray );
		}
	}
}

$smarty = new Smarty;

$renderer = & new HTML_QuickForm_Renderer_ArraySmarty( $smarty );
$form ->accept( $renderer );
$smarty->assign( 'form', $renderer->toArray() );

$smarty->assign( 'domain', $domain );
$smarty->assign( 'siteName', $siteName );
$smarty->assign( 'contName', '�J�o�[�K�[��' );
$smarty->assign( 'funcName', '�o�^' );
$smarty->assign( 'menu', $menu );
$smarty->assign( 'prtTitle', @$prtTitle );
if( @$coverData['imgId'] ) $smarty->assign( 'imgId', $coverData['imgId'] );
if( @$coverData['file'] ) $smarty->assign( 'file', $coverData['file']);

if(isset($_POST["change"])) $smarty->assign( 'now', "change" );

if( @$compChk ){
    header("Location: ./coverList.php?r=" . $compChk . "");
    exit;
}else{
	if( @$otherName ) $smarty->assign( 'NameMessage', $nameError );
    $smarty->display( 'coverAddChange.tpl' );
}
?>