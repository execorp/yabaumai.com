<?
// サーバー毎に変わる内容はこのファイルで変更する
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
// コンフィグファイルの参照
require_once(dirname(__FILE__) . "/base.config.php");
require_once(DECO_INC_PATH . "dao/memberDAO.class.php");
require_once(DECO_INC_PATH . "adv/japanHoliday.class.php");

// 送信先取得用関数
function getEmailList($data, $debug = "") {
    if ( $debug == "" ) {
        $result = getEmailListDb($data);
    } else {
        $data['testSend'] = 0;
        $memberArray = getEmailListDb($data, $debug);
        echo "member address " . count($memberArray) . "<br>\n";
        $data['testSend'] = 1;
        $testArray = getEmailListDb($data, $debug);
        echo "test address " . count($testArray) . "<br>\n";
        $result = '';
        //デバッグ用アドレス
        $result[]['mailAddress'] = 'takeoka@execute.jp';
        $result[]['mailAddress'] = 'execute@docomo.ne.jp';
        $result[]['mailAddress'] = 'exe_cute@ezweb.ne.jp';
        $result[]['mailAddress'] = 'exe_cute@softbank.ne.jp';
    }
    return $result;
}
function getEmailListDb($data, $debug = "") {
    if ( $data['testSend'] > 0 ) {
        //テストメール送信先
        if (file_exists(DECO_INC_PATH . "dao/testMemberDAO.class.php")) {
            require_once(DECO_INC_PATH . "dao/testMemberDAO.class.php");
            $memberDAO = new testMemberDAO($debug);
        } else {
            $memberDAO = new memberDAO($debug);
            $memberDAO->setSearchValue('testFlg', 1);
        }
    } else {
        //本送信先
        $memberDAO = new memberDAO($debug);
        $memberDAO->setSearchValue('errorMailFlg', 1, 'small');
        $memberDAO->setSearchValue('stateFlg', 1);
    }
    if ($data['shopId']) {
        $memberDAO->setSearchValue('shopId', $data['shopId']);
    }
    //追加検索条件設定↓
/*　コメントアウトスイッチ(先頭の/の数で中の記述の有効無効を切り替える。//*で有効、/*で無効)
    $time = date("H", time());
    $searchArray['time'] = 'time,' . $time;
    $year = date("Y", time());
    $holidayClass = new japanHoliday($year);
    $monthly = date("m", time());
    $date = date("d", time());
    if ($holidayClass->isHoliday($monthly, $date)) {
        $searchArray['week'] = 'week,7';
    } else {
        $week = date("w", time());
        $searchArray['week'] = 'week,' . $week;
    }
    $index[1] = "";
    $memberDAO->setSubSearch($index, 'sendOption', 1, 'null');
    $memberDAO->setSubSearch($index, 'sendOption', ',', 'about');
    $memberDAO->setSubSearch($index, 'sendOption', $memberDAO->setSearchParallel($searchArray), 'aboutArray');
//*/
    //↑追加検索条件設定
    $memberDAO->setMemberList();
    $result = $memberDAO->getDataContainer();
    return $result;
}
?>
