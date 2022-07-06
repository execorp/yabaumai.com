<?
//このファイルの内容はサイトに則した物に適宜変更する事
if ($domain) {
    define('RSS_DOMAIN',$domain);
} else {
    define('RSS_DOMAIN', '');
}
if ($siteName) {
    define('RSS_SITE_NAME', $siteName);
} else {
    define('RSS_SITE_NAME', '');
}
define('RSS_NEWS_TABLE_NAME', 'whatsNew');
//SELECTの項目名は`imgId`, `title`, `comment`, `dateTime`を返す事、項目名が異なる場合は別名でそれらを指定する。
define('NEWS_SQL','SELECT `imgId`, `title`, `comment`, `dateTime` FROM `' . RSS_NEWS_TABLE_NAME . '` ORDER BY `dateTime` DESC LIMIT !');
?>