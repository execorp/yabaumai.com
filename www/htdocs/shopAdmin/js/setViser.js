// 監視タイマー
var g_IdViser = new Array();
// 監視番号
var g_NumViser = 0;

//動作　定期的にスクリプトを実行する
//入力　条件(式や関数)、実行関数(関数)、ミリ秒で指定する待ち時間(数字)
function setViser( cond , funcCall , timeVise){
    // 条件が満たされれば、タイマーをクリアして関数を呼び出す
    strFunc = "" +
          "if(" + cond +"){ " + 
          "clearInterval(g_IdViser[" + g_NumViser + "]);" 
          + funcCall + ";" + 
          "}";
    // 監視タイマーをセットする
    g_IdViser[g_NumViser] = setInterval( strFunc , timeVise);
    g_NumViser++;
}
