<?
/*
// +----------------------------------------------------------------------+
// | PHP version 5.x                                                      |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009                                                   |
// +----------------------------------------------------------------------+
// | Authors: Kouji Hiramatsu <kouji@execute.jp>                          |
// +----------------------------------------------------------------------+
//

/* --- 携帯電話の機種を取得 --- */
/*
GetMobileCareer ( $_mode );
$_mode [ 0 => キャリア :: 1 => 機種 :: 2 => キャッシュ容量 :: 3 => w幅 ] )
*/


function GetMobileCareer ( $mode = 0, $smartPhone = 0 ){
/*-----------------------------------------------------------------------------
    GetMobileCareer ( $mode, $smartPhone  );
    $mode       0 => キャリア :: 1 => 機種
    $smartPhone 0 => スマートフォンは携帯認識 :: 1 スマートフォンはPCとして認識
-----------------------------------------------------------------------------*/

    $ua = $_SERVER["HTTP_USER_AGENT"];

    /* --- 環境変数からキャリアを取得 --- */
    switch( $mode ){
        case 0:
            if( preg_match("/DoCoMo/", $ua ) ){
                $machineType="iMODE";
            }elseif( preg_match("/J-PHONE/", $ua ) OR preg_match("/Vodafone/", $ua ) OR preg_match("/SoftBank/", $ua ) ){
                $machineType="Vodafone";
            }elseif(preg_match("/UP/",$ua)){
                $machineType = "EZweb";
            }elseif(preg_match("/iPhone/",$ua)){
                $machineType = "smartPhone";
            }elseif(preg_match("/iPad/",$ua)){
                $machineType = "smartPhone";
            }elseif(preg_match("/Android/",$ua)){
                $machineType = "smartPhone";
            }else{
                $machineType = "PC";
            }

            if( $smartPhone == 0 ){
                if( preg_match("/iPhone|iPod|Android/", $ua ) ) $machineType = "smartPhone";
            }

            return $machineType;
    break;

    /* --- 機種を取得 --- */
        case 1:
            if( preg_match("/DoCoMo/", $ua ) ){
                if(preg_match("/DoCoMo\/1.0/", $ua ) ){
                    list( $_nl1, $_nl2, $mobileModel) = split ("/", $ua, 3 );
                    list( $mobileModel )              = split ( "/", $mobileModel, 3 );
                }else{
                    list($_nl1,$_mova_model)          = split (" ", $ua, 2 );
                    list( $mobileModel )              = split ( "\(", $mobileModel, 2 );
                }
            }elseif( preg_match("/J-PHONE/", $ua ) OR preg_match("/Vodafone/", $ua ) OR preg_match("/SoftBank", $ua ) ){
                list( $_nl1, $_nl2, $mobileModel )    = split ( "/", $ua, 3 );
                list( $mobileModel )                  = split ( "/", $mobileModel, 3 );
            }elseif( preg_match("/UP/", $ua ) ){
                list( $mobileModel )                  = split ( " ", $ua, 2 );
                list( $_nl1, $mobileModel )           = split ( "-", $mobileModel, 2 );
            }else{
                $mobileModel = "PC";
            }
            return $mobileModel;
    break;

    /* --- キャッシュ容量を取得 --- */
        case 2:
        break;
    }
}


//絵文字の数字の作成配列
$num = array("\xf9\x87", "\xf9\x88", "\xf9\x89", "\xf9\x8a", "\xf9\x8b","\xf9\x8c", "\xf9\x8d", "\xf9\x8e", "\xf9\x8f", "\xf9\x90",);

function date_style($_date, $_style = 0){
	switch($_style){
		case 0:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_year . "/" . $_month . "/" . $_day;	break;
		case 1:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_year = substr($_year, 2, 2);	$_result = $_year . "/" . $_month . "/" . $_day;	break;
		case 2:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_month . "/" . $_day;	break;
		case 3:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_year . "年" . $_month . "月" . $_day . "日";	break;
		case 4:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_year = substr($_year, 2, 2);	$_result = $_year . "年" . $_month . "月" . $_day . "日";	break;
		case 5:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_month . "月" . $_day . "日";	break;
		case 6:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_year . "年" . $_month . "月";	break;
		case 7:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_year . "/" . $_month . "/" . $_day . "(" . Dayofweek($_date) . ")";	break;
		case 8:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_year = substr($_year, 2, 2);	$_result = $_year . "/" . $_month . "/" . $_day . "(" . Dayofweek($_date) . ")";	break;
		case 9:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_month . "/" . $_day . "(" . Dayofweek($_date) . ")";	break;
		case 10:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_year . "年" . $_month . "月" . $_day . "日" . "(" . Dayofweek($_date) . ")";	break;
		case 11:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_year = substr($_year, 2, 2);	$_result = $_year . "年" . $_month . "月" . $_day . "日" . "(" . Dayofweek($_date) . ")";	break;
		case 12:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_month . "月" . $_day . "日" . "(" . Dayofweek($_date) . ")";	break;
		case 13:
			list($_year,$_month,$_day)= split ("-", $_date, 3);	$_result = $_year . "年" . $_month . "月" . "(" . Dayofweek($_date) . ")";	break;
	}
return $_result;
}


function Dayofweek( $inDay ){
    if( preg_match( "/-/", $inDay ) )  $inDay = mktime( 0, 0, 0, substr( $inDay, 5, 2 ), substr( $inDay, 8, 2 ), substr( $inDay, 0, 4 ) );

    $Youbi = date( "w", $inDay );

    switch( $Youbi ){
        case 0:
              $Youbi = "日";
        break;

        case 1:
            $Youbi = "月";
        break;

        case 2:
            $Youbi = "火";
        break;

        case 3:
            $Youbi = "水";
        break;

        case 4:
            $Youbi = "木";
        break;

        case 5:
            $Youbi = "金";
        break;

        case 6:
            $Youbi = "土";
        break;

        default;
        break;
    }

    return $Youbi;
}

function stripSlushR( $text ){
    $textStriped = preg_replace( "/\\\\r/", "", $text );
    $textStriped = preg_replace( "/\\\\n/", "", $textStriped );


    return $textStriped;
}

function stripSlushR4mail( $text ){
    $textStriped = preg_replace( "/\\\\r/", " ", $text );
    $textStriped = preg_replace( "/\\\\n/", "", $textStriped );


    return $textStriped;
}

function calender_print ( $qry = "" , $action = "01" , $action2 = ""){

//カレンダー表示
// 指定日
if(!$qry){$qry = date ("Y-m-d", mktime (0,0,0,date("m"),date("d"),date("Y")));}

if(ereg("^([0-9]{4})[-/ \.]([01]?[0-9])[-/ \.]([0123]?[0-9])$",$qry)){
	$yr = substr($qry,0,4);
	$mon = substr($qry,5,2);
	$dy = substr($qry,8,2);

	$today = getdate(mktime(0,0,0,$mon,$dy,$yr));
}else{
//普通は今日
	$today = getdate();

	$qry = mktime (0,0,0,date("m"),date("d"),date("Y"));
	$qry = date ("Y-m-d", $qry);
}
$m_num = $today[mon];
$d_num = $today[mday];
$year = $today[year];
//1日目の曜日
$f_today = getdate(mktime(0,0,0,$m_num,1,$year));
$wday = $f_today[wday];
//月表示
$m_name = "$year ".substr($today[month],0,3);
//前次
$prev_month = date("Y-m-d", mktime(0,0,0,$m_num,0,$year));
$next_month = date("Y-m-d", mktime(0,0,0,$m_num+1,1,$year));
$prev_day = date("Y-m-d", mktime(0,0,0,$m_num,$d_num-1,$year));
$next_day = date("Y-m-d", mktime(0,0,0,$m_num,$d_num+1,$year));

$qry_print = date_style("$qry", "0");

$_result =<<<HEAD
<TABLE BORDERCOLOR="#FFFFFF" CELLPADDING="1" CELLSPACING="1" WIDTH="150" BORDER="0">
<TBODY>
<TR>
<TD ALIGN="MIDDLE" BGCOLOR="#909090" HEIGHT="15" COLSPAN="7">
<FONT COLOR="#FFFFFF" SIZE="2">$qry_print</FONT>
</TD>
<TR>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACe="Verdana"><B><A HREF="$_SERVER[PHP_SELF]?_date=$prev_month&action=$action2">≪</A></B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B><A HREF="$_SERVER[PHP_SELF]?_date=$prev_day&action=$action2">＜</A></B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" COLSPAN="3" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><b>$m_name</B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="1"5>
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B><A HREF="$_SERVER[PHP_SELF]?_date=$next_day&action=$action2">＞</A></B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B><A HREF="$_SERVER[PHP_SELF]?_date=$next_month&action=$action2">≫</A></FONT></DIV>
</TD>
</TR>
<TR>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15"
<DIV ALIGN="CENTER"><FONT SIZE="1" face="Verdana"><B>S</B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B>M</B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B>T</B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B>W</B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B>T</B></FONT></DIV>
</TD>
<TD ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B>F</B></FONT></DIV>
</TD>
<TD BORDERCOLOR="#FFFFFF" ALIGN="MIDDLE" BGCOLOR="#E0E0E0" HEIGHT="15">
<DIV ALIGN="CENTER"><FONT SIZE="1" FACE="Verdana"><B>S</B></FONT></DIV>
</TD>
</TR>
<TR>

HEAD;

for($i=0;$i<$wday;$i++){//Blank
	$_result .= "<TD WIDTH=14% ALIGN=CENTER BGCOLOR=#F3F3F8 HEIGHT=19>　</TD>\n";
}
$day = 1;
while(checkdate($m_num,$day,$year)){
	$link = sprintf("%4d" . "-" . "%02d" . "-" . "%02d", $year, $m_num, $day);
	if(($day == $today[mday]) && ($m_num == $today[mon]) && ($year == $today[year])){
//Today
$_result .= "<TD WIDTH=14% ALIGN=CENTER BGCOLOR=#E0E0E0 HEIGHT=19><FONT FACE=Verdana SIZE=1><A HREF=$_SERVER[PHP_SELF]?_date=$link&action=$action><B>$day</B></A></FONT></TD>\n";
	}elseif($wday == "0"){
//Sunday
$_result .= "<TD WIDTH=14% ALIGN=CENTER BGCOLOR=#FFCCCC HEIGHT=19><FONT FACE=Verdana SIZE=1><A HREF=$_SERVER[PHP_SELF]?_date=$link&action=$action>$day</A></FONT></TD>\n";
	}elseif($wday == "6"){
//Saturday
$_result .= "<TD WIDTH=14% ALIGN=CENTER BGCOLOR=#AACCFF HEIGHT=19><FONT FACE=Verdana SIZE=1><A HREF=$_SERVER[PHP_SELF]?_date=$link&action=$action>$day</A></FONT></TD>\n";
	}else{
// Weekday
$_result .= "<TD WIDTH=14% ALIGN=CENTER BGCOLOR=#EFEFEF HEIGHT=19><FONT FACE=Verdana SIZE=1><A HREF=$_SERVER[PHP_SELF]?_date=$link&action=$action>$day</A></FONT></TD>\n";
	}
if($wday == "6") $_result .= "</TR><TR>";
	$day++;		$wday++;	$wday = $wday % 7;
}
if($wday > 0){
	while($wday < "7"){//Blank
		$_result .= "<TD WIDTH=14% ALIGN=CENTER BGCOLOR=#F3F3F8 HEIGHT=19>　</TD>\n";
		$wday++;
	}
}else{
	$_result .= "<TD COLSPAN=7></TD>\n";
}
$_result .= "</TR></TABLE>";

return $_result;
}

function escape_php_mysql ( $str )
{
    if( !ini_get('magic_quotes_gpc')  ){
        $str = unpack("C*", $str);
        $len = count($str);
        $buff = "";
        $n = 1;

        while($n <= $len) {
            $ch1 = $str[$n];
            $ch2 = $str[$n+1];
            if($ch2 == 92) {
                $buff .= pack("C", $ch1) . pack("C", $ch2 . "\\");
                $n++;
            }else{
                $buff .= pack("C", $ch1);
                $n++;
            }
        }
        // '(シングルクォート)をエスケープ \'
        $buff = preg_replace("/'/", "\\'", $buff);
    }else{
        $buff = preg_replace("/'/", "\\'", $str);
    }
    return $buff;
}

function escapePhpMysql ( $str )
{
    if( !ini_get('magic_quotes_gpc')  ){
        $str = unpack("C*", $str);
        $len = count($str);
        $buff = "";
        $n = 1;

        while($n <= $len) {
            $ch1 = $str[$n];
            $ch2 = $str[$n+1];
            if($ch2 == 92) {
                $buff .= pack("C", $ch1) . pack("C", $ch2 . "\\");
                $n++;
            }else{
                $buff .= pack("C", $ch1);
                $n++;
            }
        }
        // '(シングルクォート)をエスケープ \'
        $buff = preg_replace("/'/", "\\'", $buff);
    }else{
        $buff = preg_replace("/'/", "\\'", $str);
    }
    return $buff;
}

//キャッシュ削除関数
function remove_directory($dir) {
  if ($handle = opendir("$dir")) {
   while (false !== ($item = readdir($handle))) {
     if ($item != "." && $item != "..") {
       if (is_dir("$dir/$item")) {
         remove_directory("$dir/$item");
       } else {
         unlink("$dir/$item");
         echo " removing $dir/$item<br>\n";
       }
     }
   }
   closedir($handle);
   @rmdir($dir);
   echo "removing $dir<br>\n";
  }
}

?>