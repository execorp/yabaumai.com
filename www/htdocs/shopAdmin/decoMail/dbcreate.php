<?
require_once("./base.config.php");
/*---------------------------------------------------------------------
/* DAO
----------------------------------------------------------------------*/
$db  = DB::connect( $dsn );
if ( DB::isError( $db ) ){
    echo "error::<hr />\n";
    exit;
}
$db->setFetchMode( DB_FETCHMODE_ASSOC );
/*/
$sql = <<<EOF
CREATE TABLE `decoMailTestAd` (
  `ml_mas_00` int(6) NOT NULL auto_increment,
  `ml_mas_01` varchar(255) NOT NULL default '',
  `ml_mas_02` varchar(255) NOT NULL default '',
  `ml_mas_03` varchar(255) NOT NULL default '',
  `ml_mas_04` datetime NOT NULL default '0000-00-00 00:00:00',
  `ml_mas_05` varchar(255) NOT NULL default '',
  `ml_mas_06` int(1) NOT NULL default '0',
  `ml_mas_07` int(1) NOT NULL default '0',
  `timeAllChk` int(1) NOT NULL default '0',
  `timeStart` time default NULL,
  `timeStartMK` varchar(255) NOT NULL default '',
  `timeEnd` time default NULL,
  `timeEndMK` varchar(255) NOT NULL default '',
  `contentsEvent` int(1) NOT NULL default '0',
  `contentsFace` int(1) NOT NULL default '0',
  `contentsCal` int(1) NOT NULL default '0',
  PRIMARY KEY  (`ml_mas_00`)
) ENGINE=MyISAM  DEFAULT CHARSET=sjis;
EOF;
$db->query( $sql );
//*/

$sql = <<<EOF
CREATE TABLE `Deco_mailData` (
  `mailDataId` int(4) NOT NULL auto_increment,
  `dataA` varchar(40) default NULL,
  `dataB` text,
  `dataC` text,
  `chk` int(1) NOT NULL default '0',
  KEY `mailDataId` (`mailDataId`)
) ENGINE=MyISAM  DEFAULT CHARSET=sjis;
EOF;
$db->query( $sql );

$sql = <<<EOF
CREATE TABLE `Deco_mailImage` (
  `imgId` int(4) NOT NULL default '0',
  `file` varchar(255) default NULL,
  `size` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `width` varchar(8) default NULL,
  `height` varchar(8) default NULL,
  `contents` mediumblob,
  KEY `imgId` (`imgId`)
) ENGINE=MyISAM DEFAULT CHARSET=sjis;
EOF;
$db->query( $sql );

$sql = <<<EOF
CREATE TABLE `Deco_mailRecord` (
  `mailRecordId` int(10) NOT NULL auto_increment,
  `mailFrom` varchar(255) NOT NULL,
  `mailSubject` varchar(255) default NULL,
  `mailBody` text,
  `mailBodyHtml` text,
  `chk` int(1) default '0',
  `only` int(1) default '0',
  `startDateTime` datetime default NULL,
  `endDateTime` datetime default NULL,
  `state` int(1) default NULL,
  `sendFrom` text,
  `page` int(1) NOT NULL default '0',
  `contentsValue` text,
  KEY `mailRecordId` (`mailRecordId`),
  KEY `chk` (`chk`)
) ENGINE=MyISAM  DEFAULT CHARSET=sjis;
EOF;
$db->query( $sql );
echo "success.";
?>