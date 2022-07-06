<?
require_once(dirname(__FILE__) . "/setRss.config.php");
require_once(dirname(__FILE__) . "/feedcreator.class.php");
function setRss($db="") {
    $url = 'http://www.' . RSS_DOMAIN . '/';
    $rss = new UniversalFeedCreator();
    $rss->useCached();
    $rss->title = mb_convert_encoding(RSS_SITE_NAME . '新着情報(' . RSS_DOMAIN . ')', "UTF-8", "SJIS");
    $rss->description = mb_convert_encoding(RSS_SITE_NAME . '新着情報(' . RSS_DOMAIN . ')のRSSです。', "UTF-8", "SJIS");
    $rss->link = mb_convert_encoding($url, "UTF-8", "SJIS" );
    $rss->syndicationURL = mb_convert_encoding($url . 'rss/news/feed.xml', "UTF-8", "SJIS");

    $MyLink = mysql_connect(RSS_MySQLHOST, RSS_MySQLUserName, RSS_MySQLPasswd);
    mysql_select_db(RSS_MySQLDatabase, $MyLink);
    $MyResult = mysql_query(NEWS_SQL, $MyLink);
    $myCount = @mysql_num_rows($MyResult);	//結果の行数
    mysql_close($MyLink);
    while($row=@mysql_fetch_array($MyResult)){
        $pubDate = date("r",  strtotime($row['dateTime']));
        $item = new FeedItem();
        $item->title = mb_convert_encoding($row['title'], "UTF-8", "SJIS");
        $item->date = mb_convert_encoding($pubDate, "UTF-8", "SJIS");
        $item->link = mb_convert_encoding($url . 'inc/picR.php?imgId=' . $row['imgId'] . '&amp;t=' . RSS_NEWS_TABLE_NAME , "UTF-8", "SJIS");
        $item->description = mb_convert_encoding($row['comment'], "UTF-8", "SJIS");
        $item->source = mb_convert_encoding($url, "UTF-8", "SJIS");
        $item->author = mb_convert_encoding(RSS_SITE_NAME . '(' . RSS_DOMAIN . ')', "UTF-8", "SJIS");
        $rss->addItem($item);
    }
    $rss->saveFeed('RSS1.0', dirname(__FILE__) . '/../rss/news/feed.xml', false);
    return true;
}
?>
