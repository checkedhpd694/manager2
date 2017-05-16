<?php
include("config.php");
##  --> T???o database  <-- ##
// --> Table Vip <--
mysql_query("CREATE TABLE IF NOT EXISTS `BLOCK` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idfb` varchar(32) NOT NULL,
  `thoigian` int(11) NOT NULL,
  PRIMARY KEY (`id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
");
?>