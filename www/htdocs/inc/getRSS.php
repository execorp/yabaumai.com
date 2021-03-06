#!/usr/local/bin/php

<?
set_time_limit(0);
require_once("/var/www/fucafe/www/htdocs/inc/.ht_Config.php" );
require_once("/var/www/fucafe/www/htdocs/inc/magpierss/rss_fetch.inc");
require_once("HTTP/Request.php");
set_time_limit(0);

$fp = fopen("/home/fucafe/www/htdocs/inc/log/rss" . date("Y-m-d", time()) . ".log", "a");
fwrite($fp, date( 'H:i:s', strtotime("now"))."\n");

define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');
$cnt = 0;
$res = 0;
$now = date("Y-m-d H:i:s");
$nowTimeStamp = datetime2unixtime($now);

$shop = $db->getAssoc( "SELECT `shopId`, `shopName`, `tel`, `URL`, `RSS`, `price`, `openTime`, `areaId`, `prefectureId`, `genreId`, `iconList`, `comment` FROM `shopMaster` ORDER BY `shopId`" );
echo "start.<br>\n";
foreach($shop AS $key => $row){
	/* 各店舗RSS情報のパース */
	if($row['RSS']){
		//RSSファイルが存在するかどうかチェックする
		$url = 'http://' . $row['RSS'] . '?cache=' . time();
		$req =& new HTTP_Request($url);
		if (!PEAR::isError($req->sendRequest())) {
		    if(strpos($req->getResponseBody(), 'http://purl.org/rss/1.0/', 0)){
		    	$rss = fetch_rss($url);
		    	foreach ($rss->items AS $num => $item) {
		    		//取得済の情報かどうか判定
		    		$dateTime = date ("Y-m-d H:i:s", strtoTime($item['dc']['date']));
		    		$dateTimeStamp = datetime2unixtime($dateTime);
		    		
		    		$chk = $db->getOne('SELECT `imgId` FROM `whatsNew` WHERE `filePath` = ? AND `dateTime` = ? ', array($item['link'], $dateTime));
					if($dateTimeStamp > $nowTimeStamp)$chk = 1;
					
					if (!$chk) {
                        echo($dateTimeStamp . ' / ' . $nowTimeStamp . "\n");

                        $sjisTitle = mb_convert_encoding($item['title'], "SJIS-win", "UTF-8");
                        $sjisContents = mb_convert_encoding($item['description'], "SJIS-win", "UTF-8");

                        //店名等を 挿入
                        if( isset( $key ) AND $key > 0 ){
                            $selectDataArray     = array( $key );
                            $shopData = $db->getRow( "SELECT `shopName`, `tel`, `URL`, `prefectureId` FROM `shopMaster` WHERE `shopId` = ? ", $selectDataArray );
                        }

                        $sjisContents .= "<br />\r\n";
                        $sjisContents .= "-----------------------------<br />\r\n";
                        $sjisContents .= "デリヘル デリバリーヘルス" . $prefectureArray[$shopData['prefectureId']] . "<br />\r\n";
                        $sjisContents .= $shopData['shopName'] . "<br />\r\n";
                        $sjisContents .= $shopData['tel'] . "<br />\r\n";
                        $sjisContents .= "<a href=\"http://" . $shopData['URL'] . "\">" . $shopData['URL'] . "</a><br />\r\n";

			    		$db->query('DELETE FROM `whatsNew` WHERE `filePath` = ? AND `feedFlg` = ? ', array($item['link'], 1));
			    		$insertDataArray = array( 
			    						$sjisTitle,
			    						$sjisContents,
			    						$row['areaId'], 
			    						$key, 
			    						$dateTime, 
			    						$item['link'],
			    						1 );
				        $db->query( "INSERT `whatsNew` ( `title`,`comment`,`areaId`,`shopId`,`dateTime`,`filePath`,`feedFlg` ) VALUES ( ?, ?, ?, ?, ?, ?, ? ) ", $insertDataArray );
			    		$cnt++;
			    	}
			    }
		    	$res++;
		    }
		}
	}
	/* 各店舗RSS情報のパース ここまで */
}

$log = '　店舗数[' . count($shop) . ']　RSS設置店舗数[' . $res . ']　新着情報取得[' . $cnt . ']' . "\n";

fwrite($fp, $log);
fclose($fp);

echo($log);

function datetime2unixtime($datetime) {
    $regex = "/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/";
    if (preg_match($regex, $datetime, $m)) {
        array_walk($m, 'intval');
        return mktime($m[4],$m[5],$m[6],$m[2],$m[3],$m[1]);
    } else {
        return 0;
    }
}

?>