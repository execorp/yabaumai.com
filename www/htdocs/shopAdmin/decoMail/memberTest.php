<html>
<body>
<?
/*---------------------------------------------------------------------
/* INCLUDE
----------------------------------------------------------------------*/
//CONFIG読込
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

//送信先設定「getEmailList.inc.php」内に存在
require_once($mainDirectory . "getEmailList.inc.php");
echo "<br>all<br>\n";
$eMailArray = getEmailList("", 1);
?>
</body>
</html>
