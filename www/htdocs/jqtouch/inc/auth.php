<?
/*
2010/03/12  1.00   �F�؏�������

**** �K�{����
** �t�@�C��
Auth.php ( pear/Auth )
/inc/auth.php ( �{�� )

** �g�p���@
�A�N�Z�X�����������t�@�C���̐擪�� require( '/inc/auth.php' ) ����

** �ϐ�
$params ( pear/Auth �ݒ�ϐ� )

** �ˑ��t�@�C��
/webAdmin/logIn.php ( �F��CMS )
/webAdmin/passAddChange.php ( ID PASS �ݒ�pCMS )

Auther kouji@execute.jp
*/

$version = "1.00";

require_once( "Auth.php" );
require_once( "/home/hakui-angel/www/htdocs/inc/.ht_Config.php" );

/* --- �Z�b�e�B���O�m�F --- */
unset( $settingError  );
if( !is_array( $params ) )                                   $settingError[] = "�F�ؗp�z�񂪌�����܂���";

if( $settingError ){
//    echo $_SERVER['PHP_SELF'] . " �t�@�C�� �ł̃Z�b�e�B���O�G���[<hr />\n";
    echo "/inc/auth.php ( " . $_SERVER['PHP_SELF'] . " ) �t�@�C�� �ł̃Z�b�e�B���O�G���[<hr />\n";  //require�O��̃t�@�C���Ȃ̂�
    foreach( $settingError AS $key => $value ){
        echo $value . "<br />\n";
    }
    exit;
}
/* --- �Z�b�e�B���O�m�F/ --- */


$authObj = new Auth( "DB", $params, "loginFunction" );

/* --- useFlg ���g�p (useFlg == 1 OK )�ɂȂ��Ă��Ȃ��ꍇ�������O�A�E�g ---  */
if( isset( $_SESSION['_authsession']['data']['useFlg'] ) AND $_SESSION['_authsession']['data']['useFlg'] != 1 ){
    $authObj -> logout();
    ob_end_clean();

    header("Location: ./logIn.php");
    exit;
}

$updateDataArray = array( date ( "Y-m-d H:i:s", mktime ( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) ), $_SESSION['_authsession']['data']['userId'] );
$db->query( "UPDATE `loginMaster` SET `lastLogin` = ? WHERE `userId` = ? ", $updateDataArray );


if ( !$authObj->getAuth() ){
    unset( $_SESSION );
    unset( $REFERER );

    if( $_SERVER['REQUEST_URI'] != "/webAdmin/" ) $REFERER = "?p=" . base64_encode( rtrim( ereg_replace( "/webAdmin/", "", $_SERVER['REQUEST_URI'] ), "/" ) );

    Header( "Location: ./logIn.php" . $REFERER );
    exit;
}
?>