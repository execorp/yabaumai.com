<?
require_once( "../inc/auth.php" );

$thiFileName = rtrim( ereg_replace( ROOT_PATH . "webAdmin/", "", $_SERVER['SCRIPT_FILENAME'] ), "/" );

$menu = <<<EOF
<div id="menu_area">
<h3 id="menu_title"><a href="../" target="_blank">オフィシャルポップアップ</a></h3>
    <div id="basic-accordian" >
        <div id="test-content"><!--DIV which show/hide on click of header-->
            <div class="accordion_child">

EOF;

unset( $cssLInk ); if( $thiFileName == "linkList.php" ) $cssLInk = "2";
$menu .= "                <dl><dt class=\"link" . $cssLInk . "\"><a href=\"./linkList.php\">リンク管理</a></dt></dl>\r\n";
unset( $cssLInk ); if( $thiFileName == "linkList.php" ) $cssLInk = "2";
$menu .= "                <dl><dt class=\"link\"><a href=\"./logOut.php\">ログアウト</a></dt></dl>\r\n";

$menu .= <<<EOF
            </div>
        </div>
    </div>
</div>

EOF;
?>
