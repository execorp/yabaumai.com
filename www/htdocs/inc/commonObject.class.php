<?
//クラス概要
//デバッグやロギング等クラス内部のデータや状態の出力を一元管理する

//基本クラス構成

//メンバー変数
//$testFlg = テスト表示の有無(int);

//testDump(表示する値(any), 画面表示用見出し(str))
//動作　入力された値を画面に表示する。値が配列の場合展開して表示する。

//loging(ファイル名(str), 記録する文(str))
//動作　ログファイルに情報を書き込む。

//セッタ
//setTest(テスト表示の有無(int))
//  $testFlg

require_once(dirname(__FILE__) . "/commonLibrary.lib.php" );
class commonObject
{
    var $testFlg;

    function commonObject($testFlg = 0) {
        $this->setTest($testFlg);
    }

    function testDump($view, $title = 'none') {
        if ( $this->testFlg ) {
            echo $title . " ( <br>\n";
            refrain_print($view);
            echo " ) <br>\n";
        }
        return true;
    }

    function loging($fileName, $logStr) {
        $flog = fopen(LOG_FOLDER . $fileName . ":" . getTimeHis() . ".txt", "w");
        fwrite($flog, $logStr . "\n");
        return true;
    }

    function setTest($value) {
        $this->testFlg = $value;
    }
}
?>