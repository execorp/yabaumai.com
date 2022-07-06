<?
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//    メールマガジン登録者一覧
//
//
//
//
//
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//---------------------------------------------------------------------
// INCLUDE
//---------------------------------------------------------------------
//CONFIG読込
$mainDirectory = dirname(__FILE__) . "/";
require_once($mainDirectory . "base.config.php");
if (file_exists(DECO_INC_PATH . "dao/testMemberDAO.class.php")) {
    header("Location: ./testAddressAdd.php");
    exit;
}
require_once(DECO_INC_PATH . "dao/memberDAO.class.php");
require_once(DECO_INC_PATH . "adv/pageRingMaker.inc.php");
//---------------------------------------------------------------------
// INIT
//---------------------------------------------------------------------

if (DEBUG_MODE > 0) {
    $debug = 1;
} else {
    $debug = $sendArray['debug'];
}
if ($debug != 0) {
    echo "clientValue<br />\n";
    var_dump($cookieArray);
    echo "<br />\n";
    echo "serverValue<br />\n";
    var_dump($sessionArray);
    echo "<br />\n";
    echo "sendValue<br />\n";
    var_dump($sendArray);
    echo "<br />\n";
    echo "fileValue<br />\n";
    var_dump($fileArray);
    echo "<br />\n";
}
$search = $sessionArray['search'];
if ($sendArray['search'] != "" && ($sendArray['mailAddress'] != "")) {
    $search['mailAddress'] = $sendArray['mailAddress'];
    $array['search'] = $search;
    $valueContainer->commitHost($array);
} else if (!$sendArray['page']) {
    $search = "";
    $array['search'] = $search;
    $valueContainer->commitHost($array);
}
if ($sendArray['page']) {
    $page = $sendArray['page'];
} else {
    $page = 1;
}
if ($page < 1 || !$page) {
    $page = 1;
}
/*---------------------------------------------------------------------
/* MODEL & VALIDATE
----------------------------------------------------------------------*/
$memberDAO = new memberDAO();
if ($gShopId) {
    $memberDAO->setSearchValue('shopId', $gShopId);
}
if ($sendArray["memberId"]) {
    $inArray['memberId'] = $sendArray["memberId"];
}
if (isset($sendArray["add"])) {
    //会員登録
    $inArray['mailAddress'] = $sendArray["mailAddress"];
    if ($gShopId) {
        $inArray['shopId'] = $gShopId;
    }
    $tmp = $memberDAO->checkRepetition($inArray);
    if ($tmp > 0) {
        $inArray['memberId'] = $tmp;
    } else {
        $inArray['dateTime'] = getDateTime();
    }
    $inArray['testFlg']     = $sendArray["testFlg"];
    $inArray['stateFlg']     = 1;
    $memberDAO->updateRecord($inArray);
    $change = 1;
} else if (isset($sendArray["testChk"]) AND isset($sendArray["testSubmit"]) AND ($sendArray["testChk"] == $sendArray["memberId"])) {
    //テストメール設定
    $inArray['testFlg'] = 1;
    $memberDAO->updateRecord($inArray);
    $change = 1;
} else if (isset($sendArray["testDelChk"]) AND isset($sendArray["testDelSubmit"]) AND ($sendArray["testDelChk"] == $sendArray["memberId"])) {
    //テストメール解除
    $inArray['testFlg'] = 0;
    $memberDAO->updateRecord($inArray);
    $change = 1;
} else if (isset($sendArray["ownerChk"]) AND isset($sendArray["ownerSubmit"]) AND ($sendArray["ownerChk"] == $sendArray["memberId"])) {
    //管理者メール設定
    $inArray['ownerFlg'] = 1;
    $memberDAO->updateRecord($inArray);
    $change = 1;
} else if (isset($sendArray["ownerDelChk"]) AND isset($sendArray["ownerDelSubmit"]) AND ($sendArray["ownerDelChk"] == $sendArray["memberId"])) {
    //管理者メール解除
    $inArray['ownerFlg'] = 0;
    $memberDAO->updateRecord($inArray);
    $change = 1;
} else if (isset($sendArray["delChk"]) AND isset($sendArray["delSubmit"]) AND ($sendArray["delChk"] == $sendArray["memberId"])) {
    //会員削除
    $memberDAO->deleteRecord($sendArray["memberId"]);
    $change = 1;
//} else if (isset($sendArray["decrement"]) AND isset($sendArray["decrementSubmit"])) {
} else if ( isset($sendArray["decrementSubmit"] ) ) {

//print_R( $_POST );
    //エラーリセット
    $updatetDataArray['memberId'] = $sendArray["decMemberId"];
    $updatetDataArray['errorMailFlg'] = 0;
    $memberDAO->updateRecord($updatetDataArray);
    $change = 1;
}
$self = "/webAdmin/magaList.php";
if ($change > 0) {
    header("Location: " . $self);
    exit;
} else {
    //登録者一覧を取得
    if ( is_array( $search ) ) {
        if ($search['mailAddress'] != "") {
            $memberDAO->setSearchValue('mailAddress', $search['mailAddress'], 'about');
        }
        if ($search['nickName'] != "") {
            $memberDAO->setSearchValue('nickName', $search['nickName'], 'about');
        }
        $pageDiv = 100;
    } else {
        $pageDiv = 20;
    }
    if ($gShopId) {
        $memberDAO->setSearchValue('shopId', $gShopId);
    }
    $memberDAO->setPage($page, $pageDiv);
    $memberDAO->setMemberList();
    $memberList = $memberDAO->getDataContainer();
    $maxCount = $memberDAO->getMaxCount();
    $pageRing = pageRingMaker($self, 0, $maxCount, $page, $pageDiv);

    //パラメータ
    $smarty = new Smarty;

    $smarty->assign('errorMailColor', $errorMailColor);
    $smarty->assign('search', $search);
    $smarty->assign('memberList', $memberList);
    $pageRingHtml = makePageRingSimple($pageRing, $page);
    $smarty->assign('pageHtml', $pageRingHtml);
    $smarty->assign('url_self', $self);

    $smarty->assign( 'domain', $domain );
    $smarty->assign( 'category', $sendArray["category"] );
    $smarty->assign( 'siteName', $siteName );
    $smarty->assign( 'prtCategory', $prtCategory );
    $smarty->assign( 'prtTitle', $prtTitle );
    $smarty->assign( 'prtPage', $prtPage );
    $smarty->assign( 'prtFooter', $prtFooter );

    $smarty->template_dir = $mainDirectory . 'templates/';
    $smarty->compile_dir  = $mainDirectory . 'templates_c/';
    $smarty->display('userList.tpl');
}
?>
