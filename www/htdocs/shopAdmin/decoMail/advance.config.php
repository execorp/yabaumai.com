<?
//各サーバー毎の設定を読み込む
//　09/12/11　ver 1.00　基本動作作成（y.takeoka）
//　09/12/22　ver 1.01　エラー表示画面追加対応（y.takeoka）

//認証がある場合認証スクリプトを読み込む
/*　コメントアウトスイッチ(先頭の/の数で中の記述の有効無効を切り替える。//*で有効、/*で無効)
if ($_SERVER['HTTP_USER_AGENT']) {
    require_once(INC_PATH . "auth.php");
}
//*/
//SMARTY読込
require_once("/usr/local/lib/php/Smarty/Smarty.class.php");
//PEAR:QuickForm読込
require_once("HTML/QuickForm.php");
require_once("HTML/QuickForm/Renderer/ArraySmarty.php");
//以下、各種設定
//ドメイン名
if (!$domain) {
    $domain = 'exe';
}

//画像DB名（pic.php用）
$imageSetName = 'Deco_mailImage';

//画像リサイズ設定(imageController.class用)
$imgMaxWidth = 240;
$imgMaxHeight = 320;
$quality = 100;

//デコメ総数1-9(3が基本)
$listMax = 3;

//画像総数1-9(5が基本)
$imageMax = 5;

//送信元(送信元を固定する時に設定)
$fromAddress = '';

//送信モード(デコメール送信に固定する時に設定)
$decoMailOnly = '';

//変更保存確認(HTMLやplainに変更があった場合確認ダイアログを出す時の設定)
$htmlSave = '';

//履歴確認(履歴から送信内容を確認できるようにする時に設定)
$historyDisplay = '1';

//送信前確認(送信する前に確認画面を表示する時に設定)
$makeDisplay = '1';

//ドラッグアンドドロップ(ドラッグアンドドロップでのアップロードタグを追加する時に設定)
$dragAndDropImageUpload = '';

//エラーページ(入力ミス時にエラーページを表示する時に設定)
$errorPage = '1';

//ショップID(ショップ毎の時に設定)
//$gShopId = $sessionArray['S_shopId'];

//配信条件配列(条件指定配信を行う時に設定)
/*　コメントアウトスイッチ(先頭の/の数で中の記述の有効無効を切り替える。//*で有効、/*で無効)
$contentsArray = array(
                    'contentsEvent' => 'イベント',
                    'contentsFace'  => '新人',
                    'contentsCal'   => '出勤'
);
//*/
//日付配列(予約配信を行う時に設定)
/*　コメントアウトスイッチ(先頭の/の数で中の記述の有効無効を切り替える。//*で有効、/*で無効)
for ($i = 0; $i < 7; $i++) {
    $dateList[] = date("Y/m/d", mktime(0, 0, 0, date('m'), date('d') + $i, date('Y')));
}
//*/
//メニュー読込(不要ならコメントアウト)
/*　コメントアウトスイッチ(先頭の/の数で中の記述の有効無効を切り替える。//*で有効、/*で無効)
if (!$siteName) {
    $siteName = 'エグゼ';
}
require_once($basePath . "../menu.php");
//*/
?>
