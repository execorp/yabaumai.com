<html>
<body>
<?
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
//CONFIG“Çž
$mainDirectory = dirname(__FILE__) . "/";
require_once($mainDirectory . "base.config.php");
require_once(DECO_INC_PATH . "dao/decoDataDAO.class.php");
$testDAO = new decoDataDAO(1);
$testDAO->printModelDetail();
$testDAO->setDecoDataInfo();
$testArray = $testDAO->getDataContainer();
$display = data2table($testArray);
echo $display."<br>\n";

require_once(DECO_INC_PATH . "dao/decoImageDAO.class.php");
$testDAO = new decoImageDAO(1);
$testDAO->printModelDetail();
$testDAO->setDecoImageList();
$testArray = $testDAO->getDataContainer();
$display = data2table($testArray);
echo $display."<br>\n";

require_once(DECO_INC_PATH . "dao/decoHistoryDAO.class.php");
$testDAO = new decoHistoryDAO(1);
$testDAO->printModelDetail();
$testDAO->setPage(1, 10);
$testDAO->setHistoryInfo();
$testArray = $testDAO->getDataContainer();
$display = data2table($testArray);
echo $display."<br>\n";

require_once(DECO_INC_PATH . "dao/memberDAO.class.php");
$testDAO = new memberDAO(1);
$testDAO->printModelDetail();
$testDAO->setPage(1, 10);
$testDAO->setMemberList();
$testArray = $testDAO->getDataContainer();
$display = data2table($testArray);
echo $display."<br>\n";

//‘—MæÝ’èugetEmailList.inc.phpv“à‚É‘¶Ý
require_once($mainDirectory . "getEmailList.inc.php");
$eMailArray = getEmailList("", 1);
?>
</body>
</html>
