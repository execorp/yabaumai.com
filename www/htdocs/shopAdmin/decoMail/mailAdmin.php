<?
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#デコメール編集システム
#　09/12/11　ver 1.00　基本動作作成（y.takeoka）
#　09/12/22　ver 1.01　エラー表示画面追加対応（y.takeoka）
#　09/12/24　ver 1.02　送信ボタンの二度押しによる重複送信防止処理追加（y.takeoka）
#　09/03/　ver 1.03　ファイル構成変更と予約配信の追加（y.takeoka）
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
//CONFIG読込
$mainDirectory = dirname(__FILE__) . "/";
require_once($mainDirectory . "getEmailList.inc.php");
require_once($mainDirectory . "decoConv.class.php");
require_once($mainDirectory . "decoFunction.class.php");
require_once(DECO_INC_PATH . "adv/jsInclude.class.php");
require_once(DECO_INC_PATH . "adv/imageController.class.php");
require_once(DECO_INC_PATH . "dao/decoDataDAO.class.php");
require_once(DECO_INC_PATH . "dao/decoImageDAO.class.php");
require_once(DECO_INC_PATH . "dao/decoHistoryDAO.class.php");
require_once(DECO_INC_PATH . "adv/pageRingMaker.inc.php");
/*---------------------------------------------------------------------
/* INIT
----------------------------------------------------------------------*/
//FCKエディタ要素名
$fckName = 'htmlComment';

//FCKエディタ背景色指定要素名
$fckBgc = 'fckbgcolor';

//背景色配列
$color = array(
            'White'   => 'Black',
            'Silver'  => 'Black',
            'Red'     => 'White',
            'Yellow'  => 'Black',
            'Lime'    => 'Black',
            'Aqua'    => 'Black',
            'Blue'    => 'White',
            'Fuchsia' => 'Black',
            'Gray'    => 'White',
            'Maroon'  => 'White',
            'Olive'   => 'White',
            'Green'   => 'White',
            'Teal'    => 'White',
            'Navy'    => 'White',
            'Purple'  => 'White',
            'Teal'    => 'White',
            'Black'   => 'White'
);
$debug = $sendArray['debug'];
if ($debug != 0) {
    echo "clientValue<br>\n";
    var_dump($cookieArray);
    echo "<br>\n";
    echo "serverValue<br>\n";
    var_dump($sessionArray);
    echo "<br>\n";
    echo "sendValue<br>\n";
    var_dump($sendArray);
    echo "<br>\n";
    echo "fileValue<br>\n";
    var_dump($fileArray);
    echo "<br>\n";
}
if ($sendArray['chk']) {
    $chk = $sendArray['chk'];
} else {
    $chk = 1;
}
if ($sendArray['page']) {
    $page = $sendArray['page'];
} else {
    $page = 1;
}
if ($sendArray['r']) {
    $r = $sendArray['r'];
} else {
    $r = 0;
}
if ($fromAddress) {
    $sendArray['from'] = $fromAddress;
}
$imgNumDef = $chk * 10;
/*---------------------------------------------------------------------
/* MODEL & VALIDATE
----------------------------------------------------------------------*/
$decoDataDAO = new decoDataDAO();
if ($gShopId) {
    $decoDataDAO->setSearchValue('shopId', $gShopId);
}
$decoDataDAO->setDecoDataInfo($chk);
$mailData = $decoDataDAO->getDataContainer();
if ($debug != 0) {
    echo "mailData<br>\n";
    var_dump($mailData);
    echo "<br>\n";
}
$seted_str  = '保存';
if ($makeDisplay) {
    $sended_str = '配信準備';
} else {
    $sended_str = '保存して送信';
}
$decoFunction = new decoFunction();
$subjectData = $mailData[$chk]['subject'];
$plainCommentData = $decoFunction->stripSlushR($mailData[$chk]['plainMail']);
if ($sendArray[$fckName] != "") {
    $convertHtml = $sendArray[$fckName];
} else {
    $convertHtml = $mailData[$chk]['htmlMail'];
}
// 背景色設定
if ($sendArray[$fckBgc] != "") {
    $FCKBgColor = $sendArray[$fckBgc];
} else {
    $FCKBgColor = $mailData[$chk]['backGroundColor'];
}
if (file_exists($mainDirectory . "../js/simplepicker.js")) {
    if (!preg_match("/^[0-9a-f]{6}$/i", $FCKBgColor)) {
        $FCKBgColor = "ffffff";
    }
}
$uploadForm = new HTML_QuickForm('upload', 'post');
for ($i = 1 ; $i <= $imageMax ; $i++) {
    $uploadForm->addElement('file', 'userfile' . $i, '画像[' . $i . ']' , array("size" => 10));
    $uploadForm->addElement('checkbox', 'delchk' . $i, '削除チェック');
}
$uploadForm->addElement('hidden', 'chk', $chk);
$uploadForm->addElement('submit', 'uploaded', 'アップロード');
$uploadForm->addElement('submit', 'deleted', '削除');

$decoImageDAO = new decoImageDAO();
if ($gShopId) {
    $decoImageDAO->setSearchValue('shopId', $gShopId);
}
if ($sendArray["deleted"]) {
    for ($i = 1 ; $i <= $imageMax ; $i++) {
        if ($sendArray["delchk" . $i]) {
            $decoImageDAO->deleteRecord($imgNumDef + $i);
            $compChk = 3;
        }
    }
}

/* --- 画像アップロード処理 --- */
if ($sendArray['uploaded']) {
    for ($i = 1 ; $i <= $imageMax ; $i++) {
        unset($file);unset($type);
        $file     = $fileArray['userfile' . $i]['name'];
        
        if ($file) {
            $save_path = "/tmp/";
            $tmp_name = $fileArray['userfile' . $i]['tmp_name'];
            $size     = $fileArray['userfile' . $i]['size'];
            $type     = $fileArray['userfile' . $i]['type'];
            
            $updImage = new imageController($tmp_name, $type, $size);
            
            if ($updImage->typeImage() && $type != 'image/png' && $type != 'image/x-png' ) {
                $size = $updImage->resizeImage($imgMaxWidth,$imgMaxHeight,$quality,$save_path);
                $width = $updImage->getImageWidth();
                $height = $updImage->getImageHeight();
                $contents = "0x" . bin2hex($updImage->getContents());

                $insertDataArray = "";
                $insertDataArray['imageNo']  = $imgNumDef + $i;
                $insertDataArray['name']     = $file;
                $insertDataArray['size']     = $size;
                $insertDataArray['type']     = $type;
                $insertDataArray['width']    = $width;
                $insertDataArray['height']   = $height;
                $insertDataArray['contents'] = $contents;
                if ($sendArray["imgId"][$i] > 0) {
                    $insertDataArray['imageId']  = $sendArray["imgId"][$i];
                }
                if ($gShopId) {
                    $insertDataArray['shopId'] = $gShopId;
                }

                $decoImageDAO->updateRecord($insertDataArray);
                $compChk = 3;
            }
        }
    }
}
if (!$compChk) {
    $decoHistoryDAO = new decoHistoryDAO();
    $sendForm = new HTML_QuickForm('send', 'post');
    $decoImageDAO->clearSearchValue();
    //DB取得:登録済画像の取得
    if ($gShopId) {
        $decoImageDAO->setSearchValue('shopId', $gShopId);
        $dup_array['shop_id'] = $gShopId;
    }
    $decoImageDAO->setDecoImageList($chk);
    $imgArray = $decoImageDAO->getDataContainer();
    if ($debug != 0) {
        echo "imgArray<br>\n";
        var_dump($imgArray);
        echo "<br>\n";
    }

    if ($dragAndDropImageUpload) {
        $dup_array['chk'] = $chk;
        require_once($mainDirectory . "../DandD/makeDragAndDrop.class.php");
        $img_up_form = new makeDragAndDrop(96,96,$dup_array);
    }
    unset($dup_array);
    if (is_array($imgArray)) {
        foreach ($imgArray as $key => $value) {
            if ($value['type'] == 'image/jpeg' || $value['type'] == 'image/pjpeg') $extension = '.jpg';
            if ($value['type'] == 'image/gif')$extension = '.gif';
            if ($value['type'] == 'image/png' || $value['type'] == 'image/x-png')  $extension = '.png';
            $i = $key - $imgNumDef;

            $imgBufArray[$i] = $value;
            $imgBufArray[$i]['ext'] = $extension;
            $imgAmountSize = $imgAmountSize + $value['size'];

            $imagePage = floor($key / 10);
            $number = $key - $imagePage * 10;
            if ($gShopId) {
                $imgRecover[$value['imageId']] = "image_" . $domain . "-" . $gShopId ."-" . $imagePage . "-" . $number . $extension;
            } else {
                $imgBufArray[$i]['imageId'] = $key;
                $imgRecover[$key] = "image_" . $domain . "-" . $imagePage . "-" . $number . $extension;
            }
        }
    }
    if ($debug != 0) {
        echo "imgBufArray<br>\n";
        var_dump($imgBufArray);
        echo "<br>\n";
    }
    if ($img_up_form) {
        if ($htmlSave > 0) {
            $js_unload = <<<EOF
          if (saveConfirm()) {
              execUnload=false;
          } else {
              execUnload=false;
              top.location.reload(true);
          }

EOF;
            $img_up_form->setUnLoad($js_unload);
        }
        for ($i = 1 ; $i <= $imageMax ; $i++) {
            $img_up_form->setUpTag();
            $imgList[$i]['del'] = "delchk".$i;
            $imgList[$i]['file'] = "userfile".$i;
        }
    } else {
        for ($i = 1; $i <= $imageMax; $i++) {
            $imgList[$i]['del'] = "delchk".$i;
            $imgList[$i]['file'] = "userfile".$i;
        }
    }
    // 容量制限
    $decoConv = new decoConv($domain, 1, $incFolder);
    $decoConv->setDecoMail($convertHtml);
    $decoConv->setImgList($imgRecover);
    $decoConv->allConv();

    if ($decoConv->checkDecoMailImg()) {
        $r = 7;
    }
    if ($decoConv->checkMailLen()) {
        $r = 6;
    }
    //メール送信登録処理
    if ($sendArray["seted"] || $sendArray["sended"] || $sendArray["save"] > 0) {
        if ($gShopId) {
            $decoDataDAO->setSearchValue('shopId', $gShopId);
            $inArray['shopId'] = $gShopId;
        }
        $inArray['decoDataId'] = $chk;
        $inArray['dataA'] = $sendArray["from"];
        $decoDataDAO->updateRecord($inArray);
        //本文登録
        /* --- 件名登録 --- */
        $inArray['decoDataId'] = 10 + $chk;
        $inArray['dataA'] = $sendArray["subject"];
        $decoDataDAO->updateRecord($inArray);
        /* --- 通常本文登録 --- */
        if ($sendArray["plainComment"] != "") {
            $plainComment = $sendArray["plainComment"];
        } else {
            $plainConv = new decoConv($domain, 1, $incFolder);
            $plainConv->setDecoMail($sendArray['htmlComment']);
            $plainConv->plainConv();
            $plainComment = $plainConv->getDecoMail();
        }
        unset($inArray['dataA']);
        $inArray['decoDataId'] = 20 + $chk;
        $inArray['dataB'] = $plainComment;
        $decoDataDAO->updateRecord($inArray);
        /* --- HTML本文登録 --- */
        if ($sendArray[$fckName] != ""){
            $htmlComment = $sendArray[$fckName];
        } else {
            $htmlComment = str_replace("\n","<br>",$sendArray["plainComment"]);
        }
        $inArray['decoDataId'] = 30 + $chk;
        $inArray['dataB'] = $htmlComment;
        $decoDataDAO->updateRecord($inArray);
        /* --- 背景色登録 --- */
        unset($inArray['dataB']);
        $inArray['decoDataId'] = 40 + $chk;
        $inArray['dataA'] = $FCKBgColor;
        $decoDataDAO->updateRecord($inArray);
        /* --- メール送信処理 --- */
        if ($sendArray["sended"] && $sendProhibition == 0 ) {
            if ($sendArray["plainComment"] == "" && $sendArray[$fckName] == "") {
                $r = 8;
            }
            if ($sendArray["subject"] == "" || $sendArray["from"] == "") {
                $r = 9;
            }
            /* --- エラー中断チェック --- */
            if ($r > 5) {
                $dispError = $errorPage;
            } else if ($makeDisplay && $sendArray['r'] != 5) {
                /* --- 確認画面表示 --- */
                //深夜時間
                if ($sendArray["testSend"] != ""){
                    $test_str = "(テスト送信)";
                } else {
                    $test_str = "";
                }
                $data = "";
                $data['testSend'] = $sendArray["testSend"];
                if ($gShopId) {
                    $data['shopId'] = $gShopId;
                }
                $totalArray = getEmailList($data, $debug);
                if (is_array($totalArray)) {
                    foreach($totalArray As $key => $value) {
                        $owner += $value['ownerFlg'];
                    }
                }
                $total = count($totalArray) - $owner;
                if ($debug != 0) {
                    echo "total<br>\n";
                    var_dump($totalArray);
                    echo "<br>\n";
                }
                $deco_str = "";
                if ($sendArray["decoMail"] == 1) {
                    $deco_str = "デコメール";
                } else {
                    $deco_str = "通常メール";
                }
                $contentsList = $_time." ".$deco_str."配信 全".$total."件".$test_str;
                $r = 5;
                $sended_str = '送信する';
                $seted_str  = '戻る';

                $sendForm->addElement('hidden', 'testSend', $sendArray["testSend"]);
                $sendForm->addElement('hidden', 'decoMail', $sendArray["decoMail"]);
                $sendForm->addElement('hidden', 'r', $r);
            } else {
                /* --- 送信 --- */
                /* --- 事前準備 --- */
                $htmlComment = "";
                if ($FCKBgColor != "" && $FCKBgColor != "White" && $FCKBgColor != "ffffff") {
                    if (preg_match("/^[0-9a-f]{6}$/i", $FCKBgColor)) {
                        $FCKBgColor .= '#' . $FCKBgColor;
                    }
                    $htmlComment .= '<body bgcolor="' . $FCKBgColor . '">';
                    $body_end = '</body>';
                }
                $htmlComment .= $decoConv->getDecoMail();
                $htmlComment .= $body_end;
                unset($inArray);
                if ($gShopId) {
                    $decoHistoryDAO->setSearchValue('shopId', $gShopId);
                    $inArray['shopId'] = $gShopId;
                }
                $inArray['mailFrom']     = $sendArray['from'];
                $inArray['sendFrom']     = $sendArray['from'];
                $inArray['mailSubject']  = $sendArray['subject'];
                $inArray['mailBody']     = $sendArray['plainComment'];
                $inArray['mailBodyHtml'] = $htmlComment;
                $inArray['testSend']     = $sendArray['testSend'];
                $inArray['decoMail']     = $sendArray['decoMail'];
                $inArray['page']         = $chk;
                if (is_array($contentsArray)) {
                    if ($sendArray['contentsAll']) {
                        $contentsValue = "all";
                    } else {
                        if(is_array ($sendArray['search'])) {
                            $tmpArray = array();
                            foreach ($sendArray['search'] as $key => $value) {
                                $tmpArray[]= $value;
                            }
                            $contentsValue = implode(",", $tmpArray);
                        } else {
                            $contentsValue = "all";
                        }
                    }
                    $inArray['genre'] = $contentsValue;
                }
                if ($gShopId) {
                    foreach ($imgArray as $key => $value) {
                        $inArray['imageNo'][$value['image_no']] = $value;
                        $inArray['imageNo'][$value['image_no']]['contents'] = "0x" . bin2hex($value['contents']);
                        $inArray['imageNo'][$value['image_no']]['shopId'] = $gShopId;
                    }
                } else {
                    foreach ($imgArray as $key => $value) {
                        $inArray['imageNo'][$value['image_no']] = $value;
                        $inArray['imageNo'][$value['image_no']]['contents'] = "0x" . bin2hex($value['contents']);
                    }
                }
                //重複チェックで二度押し防止
                $checkArray['mailSubject']  = "";
                $checkArray['mailBody']     = "";
                $checkArray['mailBodyHtml'] = "";
                $checkArray['testSend']     = "";
                $checkArray['decoMail']     = "";
                $decoHistoryDAO->setTest(1);
                $decoHistoryDAO->setRange(1);
                $decoHistoryDAO->setOrderValue('historyId', 1);
                $decoHistoryDAO->setHistoryInfo();
                $decoHistoryDAO->setTest(0);
                $tmpArray = $decoHistoryDAO->getDataContainer();
                if (is_array($tmpArray)) {
                    foreach ($tmpArray as $id => $value) {
                        $checkArray = $value;
                    }
                }
                if ($checkArray['mailSubject']  != $inArray['mailSubject'] ||
                    $checkArray['mailBody']     != $inArray['mailBody'] ||
                    $checkArray['mailBodyHtml'] != $inArray['mailBodyHtml'] ||
                    $checkArray['page']         != $inArray['page'] ||
                    $checkArray['testSend']     != $inArray['testSend'] ||
                    $checkArray['decoMail']     != $inArray['decoMail'] 
                    ) {
                    if ($sendArray['reserve']) {
                        $inArray['startDateTime'] = str_replace('/', '-', $sendArray['reserveDate'])." ";
                        $inArray['startDateTime'] .= date("H:i:s", mktime($sendArray['reserveTime'], 0, 0, date('m'), date('d'), date('Y')));
                        $inArray['state'] = 4;
                    } else {
                        $inArray['startDateTime'] = getDateTime();
                        $inArray['state']         = 0;
                    }
                    /* --- メールの状態を変更する --- */
                    $decoHistoryDAO->udpFailureStatus();
                    /* --- メール送信履歴を保存する --- */
                    $decoHistoryDAO->updateRecord($inArray);
                    /* --- BG送信 --- */
                    if (!$sendArray['reserve']) {
                        system($mainDirectory . "bgSendMail.php > /dev/null &");
                    }
                }
                $compChk = 2;
            }
        } else {
            $compChk = 1;
        }
    }
}
$self = "/webAdmin/magaAddChange.php";
//テンプレートを表示
if ($compChk) {
    header("Location: " . $self . "?r=" . $compChk . "&chk=" . $chk);
    exit;
} else if ($dispError == 1) {
    $smarty = new Smarty;
    $smarty->assign('menu', $menu);
    $smarty->assign('domain', $domain);             //ドメイン名
    $smarty->assign('contName', 'デコメール');      //コンテンツ名
    $smarty->assign('funcName', '登録・送信');      //機能名
    $smarty->assign('r', $r);
    $smarty->assign('e', $error);
    $smarty->template_dir = $mainDirectory . 'templates/';
    $smarty->compile_dir  = $mainDirectory . 'templates_c/';
    $smarty->display('dispError.tpl');
} else {
    $sendForm->addElement('hidden', 'chk', $chk);
    $sendForm->addElement('submit', 'seted', $seted_str, array("onClick" => 'execUnload=false;'));
    if ($sendProhibition == 0) {
        $sendForm->addElement('submit', 'sended', $sended_str, array("onClick" => 'execUnload=false;'));
    } else {
        $sendForm->addElement('submit', 'sended', $sended_str, array("disabled" => 'disabled'));
    }
/*---------------------------------------------------------------------
/* VIEW
----------------------------------------------------------------------*/
    // ジャバスクリプトの設定
    $smarty = new Smarty;
    $jsInclude = new jsInclude();
    // FCKエディタの設定
    if ($r != 5) {
        if (file_exists(DECO_INC_PATH . "dao/girlsDAO.class.php")) {
            //女の子情報の取得
            require_once(DECO_INC_PATH . "dao/girlsDAO.class.php");
            $girlsDAO = new girlsDAO();
            if ($gShopId) {
                $girlsDAO->setSearchValue('shopId', $gShopId);
            }
            $girlsDAO->setGirlList();
            $galsArray = $girlsDAO->getDataContainer();
            if ($debug != 0) {
                echo "galsArray<br>\n";
                var_dump($galsArray);
                echo "<br>\n";
            }
            $smarty->assign('galsArray', $galsArray);
            $rows = 21;
        } else {
            $rows = 21;
        }
        //DB取得:送信履歴の取得
        $decoHistoryDAO->clearSearchValue();
        if ($gShopId) {
            $decoHistoryDAO->setSearchValue('shopId', $gShopId);
        }
        $pageDiv = 10;
        $decoHistoryDAO->setPage($page, $pageDiv);
        $decoHistoryDAO->setHistoryList();
        $historyArray = $decoHistoryDAO->getDataContainer();
        $maxCount = $decoHistoryDAO->getMaxCount();

        $pageRing = pageRingMaker($self, 0, $maxCount, $page, $pageDiv);
        $pageRingHtml = makePageRingSimple($pageRing, $page);
        $smarty->assign('pageHtml', $pageRingHtml);

        $smarty->assign('historyDisplay', $historyDisplay);
        $smarty->assign('historyList', $historyArray);
        $smarty->assign('stateList', $stateList);

        $jsInclude->setInitContainer("/fckeditor/fckeditor.js");
        $jsInclude->setInitContainer("/webAdmin/js/fck_common.js");
        $jsInclude->setInitContainer("/webAdmin/js/fck_ins.js");
        // FCKエディタの背景色を変更する
        $jsInclude->setInitContainer("/webAdmin/js/fck_bgc.js");
        $jsInclude->setInitContainer("/webAdmin/js/setViser.js");

        if (file_exists($mainDirectory . "../js/fckTextChange.js")) {
            $jsInclude->setInitContainer("/webAdmin/js/fckTextChange.js");
            $smarty->assign('baseTextArea', "1");
            $rows = 20;
        }
        if (file_exists($mainDirectory . "../js/simplepicker.js")) {
            $jsInclude->setInitContainer("/webAdmin/js/simplepicker.js");
        }

        $sendForm->addElement('text',     'from',         '送信元',     array("istyle" => 1, "size" => 40));
        $sendForm->addElement('text',     'subject',      '件名',       array("id" => 'subject', "istyle" => 1, "size" => 50));
        $sendForm->addElement('textarea', 'plainComment', '通常メール', array("id" => 'plainComment', "istyle" => 1, "rows" => $rows, "cols" => 51));
        $sendForm->addElement('textarea', $fckName,       'デコメール', array("id" => $fckName, "istyle" => 1, "rows" => 15, "cols" => 51));
        $sendForm->setDefaults(
            array(
                "from"         => $mailData[$chk]['sendAddress'] , 
                "subject"      => $subjectData , 
                "plainComment" => $plainCommentData , 
                "$fckName"     => $decoFunction->stripSlushR($mailData[$chk]['htmlMail']) 
           )
        );

        if ($img_up_form) {
            // ドラッグアンドドロップアップロードを追加する
            $jsInclude->setInitContainer("/webAdmin/js/gears_init.js");
            $jsInclude->setInitContainer("/webAdmin/js/gears_start.js");
            $jsInclude->setInitContainer("/webAdmin/js/gears_dandd.js");
            // javascriptのオンロードを設定する
            //ドラッグアンドドロップ用
            $jsInclude->setOnloadContainer($img_up_form->getOnLoad());
        }

        // 基本設定
        $jsInclude->setValueContainer("g_area_name", "'" . $fckName . "'");
        $jsInclude->setValueContainer("oFCKeditor", "new FCKeditor(g_area_name)");
        $jsInclude->setValueContainer("execUnload", "true");
        if ($htmlSave > 0) {
            $jsInclude->setValueContainer("subjectOld", "'" . $subjectData ."'");
            $jsInclude->setValueContainer("colorOld", "'" . $FCKBgColor ."'");
            $jsInclude->setValueContainer("plainCommentOld", "'" . str_replace("\r","\\r",str_replace("\n","\\n",$plainCommentData)) . "'");
            $js_str = <<<EOF
function saveConfirm() {
  var result = false;
  var oEditor=FCKeditorAPI.GetInstance(g_area_name);
  if (oEditor.IsDirty() || 
      plainCommentOld != window.document.getElementById('plainComment').value || 
      colorOld != window.document.getElementById('fckbgcolor').value || 
      subjectOld != window.document.getElementById('subject').value 
      ) {
    var flg = window.confirm("本文の変更を保存しますか？");
    if(flg == true) {
      window.document.getElementById('htmlComment').value = oEditor.GetHTML();
      document.send.submit();
      result = true;
    }
  }
  return result;
}
EOF;
            $jsInclude->setFunctionContainer($js_str);
            $save_conf = <<<EOF
  if (execUnload) {
    saveConfirm();
  }
EOF;
            $jsInclude->setUnloadContainer($save_conf);
            $sendForm->addElement('hidden', 'save', 1);
        }
    //FCKエディタ用
        $fckStr = <<<EOF
  oFCKeditor.BasePath = '../../fckeditor/';
  oFCKeditor.Width = '300';
  oFCKeditor.Height = '450';
  oFCKeditor.ToolbarSet = 'Custom';
  oFCKeditor.ReplaceTextarea();

EOF;
        $fckStr .= "  bgcolorregularity(window.document.getElementById('" . $fckBgc . "'));\n";
        if (file_exists($mainDirectory . "../js/simplepicker.js")) {
            $fckStr .= <<<EOF
  if (simplePicker.windowOnLoad) {
    simplePicker.windowOnLoad();
  }
  simplePicker.chartFrame=document.createElement('div');
  document.body.appendChild(simplePicker.chartFrame);
  simplePicker.chartImage=document.createElement('div');
  simplePicker.chartFrame.appendChild(simplePicker.chartImage);
  simplePicker.chartString=document.createElement('input');
  simplePicker.chartFrame.appendChild(simplePicker.chartString);
  simplePicker.chartFrame.style.left='0px';
  simplePicker.chartFrame.style.top='0px';
  simplePicker.chartFrame.style.backgroundColor='#fff';
  simplePicker.chartFrame.style.border='#888 1px solid';
  simplePicker.chartFrame.style.padding='4px';
  simplePicker.chartFrame.style.position='absolute';
  simplePicker.chartFrame.style.visibility='hidden';
  simplePicker.chartImage.style.backgroundImage='url("img/colorchart.png")';
  simplePicker.chartImage.style.cursor='crosshair';
  simplePicker.chartImage.style.width='256px';
  simplePicker.chartImage.style.height='256px';
  simplePicker.chartString.style.backgroundColor='#fff';
  simplePicker.chartString.style.border='#888 1px solid';
  simplePicker.chartString.style.marginTop='4px';
  simplePicker.chartString.style.width='256px';
  simplePicker.chartFrame.onclick=function(e) {
    simplePicker.chartFrame.style.visibility='hidden';
  };
  simplePicker.chartImage.onmousemove=function(e) {
    simplePicker.getColor(e,e || event);
  };
  simplePicker.chartImage.onclick=function(e) {
    simplePicker.getColor(e,e || event);
    if(simplePicker.mode=='HEX') {
      simplePicker.textH.value=simplePicker.HEX;
    } else if(simplePicker.mode=='RGB') {
      simplePicker.textR.value=simplePicker.RGB[0];
      simplePicker.textG.value=simplePicker.RGB[1];
      simplePicker.textB.value=simplePicker.RGB[2];
    }
  };
EOF;
            $sendForm->addElement('hidden', $fckBgc, $FCKBgColor ,array("id" => $fckBgc));
        } else {
            $smarty->assign('colorArray', $color);
        }
        $jsInclude->setOnloadContainer($fckStr);
    } else {
        if ($sendReserve) {
            for ($i = 0; $i < 7; $i++) {
                $dateList[] = date("Y/m/d", mktime(0, 0, 0, date('m'), date('d') + $i, date('Y')));
            }
            $smarty->assign('dateList', $dateList);
        }
        $smarty->assign('subject_str', $sendArray["subject"]);
        $dispStr = eregi_replace("[\r\n]+","<br>", $sendArray["plainComment"]);
        $smarty->assign('plainComment_str', $dispStr);
        $smarty->assign('htmlComment_str', $sendArray[$fckName]);

        $sendForm->addElement('hidden', 'subject',      htmlspecialchars($sendArray["subject"]));
        $sendForm->addElement('hidden', 'plainComment', htmlspecialchars($sendArray["plainComment"]));
        $sendForm->addElement('hidden', $fckName,       htmlspecialchars($sendArray[$fckName]));
        $sendForm->addElement('hidden', $fckBgc,        htmlspecialchars($sendArray[$fckBgc]));
        if (preg_match("/^[0-9a-f]{6}$/i", $FCKBgColor)) {
            $FCKBgColor = "#" . $FCKBgColor;
        }

        $smarty->assign('contentsList', $contentsList);

        if ($fromAddress == "") {
            $fromAddress = htmlspecialchars($sendArray["from"]);
        }
    }
    if ($fromAddress) {
        $sendForm->addElement('hidden', 'from', $fromAddress);
    }
    $sendForm->applyFilter('__ALL__', 'trim');
    $sendForm->addRule('subject', '件名を入力してください。', 'required', null, 'client');
    $sendForm->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">の項目は必ず入力してください。</span>');
    $sendForm->setJsWarnings('入力エラー', "\n\n" . $_SERVER['SERVER_NAME'] . "");
    $renderer = & new HTML_QuickForm_Renderer_ArraySmarty($smarty);
    $sendForm->accept($renderer);
    $smarty->assign('sendForm', $renderer->toArray());
    $uploadForm->accept($renderer);
    $smarty->assign('uploadForm', $renderer->toArray());

    $smarty->assign('imgArray', $imgBufArray);
    $smarty->assign('imgAmountSize', $imgAmountSize);
    $smarty->assign('php_self', $_SERVER['PHP_SELF']);

    // ジャバスクリプトの書き込み
    $jsIncludeStr = $jsInclude->getjsInclude();
    $smarty->assign('jsInclude', $jsIncludeStr);

    if ($img_up_form) {
        //ドラッグアンドドロップ用タグ
        $ddUpdTag = $img_up_form->getUpTag();
        $smarty->assign('ddUpdTag', $ddUpdTag);
    }

    //選択色
    $smarty->assign('fck_bgc', $FCKBgColor);
    // メール番号を渡す
    $smarty->assign('chk', $chk);

    //ページ内容表示パス定義
    $smarty->assign('tableName', $imageSetName); //テーブル名
    if ($gShopId) {
        $smarty->assign('shop_id', $gShopId);
    }

    $smarty->assign('listMax', $listMax + 1);
    $smarty->assign('imgList', $imgList);
    $smarty->assign('dateList', $dateList);
    $smarty->assign('incFolder', $incFolder);
    $smarty->assign('sendProhibition', $sendProhibition);
    $smarty->assign('decoMailOnly', $decoMailOnly);

    $smarty->assign('r', $r);
    $smarty->assign('e', $error);
    if (is_array($contentsArray)) {
        $smarty->assign('contentsArray', $contentsArray);
    }
    $smarty->assign('shopOption', $gShopOption);

    $smarty->assign('_header', $_header);
    $smarty->assign('_contensMenu', $_contensMenu);
    $smarty->assign('_mainMenu', $_mainMenu);
    $smarty->assign('_footer', $_footer);

    $smarty->assign('sendFromData', $fromAddress);

    $smarty->assign( 'domain', $domain );
    $smarty->assign( 'category', $sendArray["category"] );
    $smarty->assign( 'siteName', $siteName );
    $smarty->assign( 'prtCategory', $prtCategory );
    $smarty->assign( 'prtTitle', $prtTitle );
    $smarty->assign( 'prtPage', $prtPage );
    $smarty->assign( 'prtFooter', $prtFooter );

    $smarty->template_dir = $mainDirectory . 'templates/';
    $smarty->compile_dir  = $mainDirectory . 'templates_c/';
    $smarty->display('mailAdmin.tpl');
}
?>
