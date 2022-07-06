<html>
<body>
<?
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
//CONFIG“Ç
$mainDirectory = dirname(__FILE__) . "/";
require_once($mainDirectory . "base.config.php");
//*
require_once(DECO_INC_PATH . "dao/memberDAO.class.php");
$testDAO = new memberDAO(1);
$testDAO->printModelDetail();
$testDAO->setPage(1, 10);
$testDAO->setMemberList();
$testArray = $testDAO->getDataContainer();
$display = data2table($testArray);
echo $display."<br>\n";

//‘—Mæİ’èugetEmailList.inc.phpv“à‚É‘¶İ
require_once($mainDirectory . "getEmailList.inc.php");
echo "<br>all<br>\n";
$eMailArray = getEmailList("", 1);
?>
</body>
</html>
