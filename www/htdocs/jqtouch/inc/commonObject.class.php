<?
//クラス概要
//デバッグやロギング等クラス内部のデータや状態の出力を一元管理する
//　09/12/11　ver 1.00　基本動作作成（takeoka）

//基本クラス構成

//メンバー変数
//$testFlg = テスト表示の有無(int);

//testDump(表示する値(any), 画面表示用見出し(str))
//動作　$flogがある場合ログに、ない場合入力された値を画面に出力する。値が配列の場合展開される。

//loging(記録する文(str))
//動作　ログファイルに情報を書き込む。

//セッタ
//setTest(テスト表示の有無(int))
//  $testFlg
//setLoging(ログファイルへのポインタ(&))
//  $flog

require_once(dirname(__FILE__) . "/commonLibrary.lib.php" );
class commonObject
{
    var $testFlg;
    var $flog;

    function commonObject($testFlg = 0) {
        $this->setTest($testFlg);
    }

    function testDump($view, $title = 'none') {
        if ($this->flog || $this->testFlg) {
            if ( $this->flog ) {
                $this->loging($title . "," . array_divider($view));
            } else {
                echo $title . " ( <br>\n";
                if (is_array($view)) {
                    foreach($view As $key => $data) {
                        echo " [ " . $key . " ] ( <br>\n";
                        refrain_print($data);
                        echo " ) <br>\n";
                    }
                } else {
                    refrain_print($view);
                }
                echo " ) <br>\n";
            }
        }
        return true;
    }

    function loging($logStr) {
        fwrite($this->flog, $logStr . "\n");
    }

    function setTest($value) {
        $this->testFlg = $value;
    }

    function setLoging($value) {
        $this->flog = $value;
    }
}
?>