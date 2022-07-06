<?
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#　送信履歴変換表示
#　09/12/11　ver 1.00　基本動作作成（takeoka）
#　
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//---------------------------------------------------------------------
// INCLUDE
//---------------------------------------------------------------------
//CONFIG読込
$mainDirectory = dirname(__FILE__) . "/";
require_once($mainDirectory . "base.config.php");
require_once($mainDirectory . "decoConv.class.php");
require_once(DECO_INC_PATH . "dao/decoImageDAO.class.php");
require_once(DECO_INC_PATH . "dao/decoHistoryDAO.class.php");
if ( $sendArray["chk"] > 0 ) {
    $chk = $sendArray["chk"];
} else if ( $sendArray["page"] > 0 ) {
    $chk = $sendArray["page"];
} else {
    $chk = 1;
}
//---------------------------------------------------------------------
// MODEL & VALIDATE
//---------------------------------------------------------------------
//DB取得:送信履歴の取得
$decoHistoryDAO = new decoHistoryDAO();
if ($gShopId) {
    $decoHistoryDAO->setSearchValue('shopId', $gShopId);
}
$decoHistoryDAO->setHistoryInfo($chk);
$tmpArray = $decoHistoryDAO->getDataContainer();
$historyArray = $tmpArray[$chk];
unset($tmpArray);
if ( $debug  != 0 ) {
    echo "<br>historyArray<br>\n";
    var_dump($historyArray);
    echo "<br>\n";
}
//DB取得:登録済画像の取得
$decoImageDAO = new decoImageDAO();
if ($gShopId) {
    $decoImageDAO->setSearchValue('shopId', $gShopId);
}
$decoImageDAO->setDecoImageList($historyArray['page']);
$imgArray = $decoImageDAO->getDataContainer();
if ( $debug  != 0 ) {
    echo "<br>imgArray<br>\n";
    var_dump($imgArray);
    echo "<br>\n";
}
if ( is_array( $imgArray ) ) {
    foreach ( $imgArray as $key => $value ) {
        if ($value['type'] == 'image/jpeg' || $value['type'] == 'image/pjpeg') $extension = '.jpg';
        if ($value['type'] == 'image/gif')$extension = '.gif';
        if ($value['type'] == 'image/png' || $value['type'] == 'image/x-png')  $extension = '.png';
        $page = floor($key / 10);
        $number = $key - $page * 10;
        if ($gShopId) {
            $imgRecover[$value['imageId']] = "image_" . $domain . "-" . $gShopId . "-" . $page . "-" . $number . $extension;
        } else {
            $imgRecover[$key] = "image_" . $domain . "-" . $page . "-" . $number . $extension;
        }
    }
}
if ( DEBUG_MODE  != 0 ) {
    echo "<br>imgRecover<br>\n";
    var_dump($imgRecover);
    echo "<br>\n";
}
$decoConv = new decoConv($domain, 1, $incFolder);
$decoConv->setDecoMail($historyArray['mailBodyHtml']);
$decoConv->setImgList($imgRecover);
$bgColor = $decoConv->trimBodyTag();
$decoConv->FckEmojiRecover();
$decoConv->decoMailImgRecover($imageSetName);
//---------------------------------------------------------------------
// VIEW
//---------------------------------------------------------------------
$smarty = new Smarty;
$smarty->assign( 'domain', $domain );
$smarty->assign( 'disp_mail',  $decoConv->getDecoMail());
$smarty->assign( 'chk', $chk );
$smarty->assign( 'bgColor', $bgColor );

//テンプレートを表示
$smarty->template_dir = $mainDirectory . 'templates/';
$smarty->compile_dir  = $mainDirectory . 'templates_c/';
$smarty->display( 'dispMail.tpl' );
?>
