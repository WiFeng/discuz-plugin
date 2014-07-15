<?php
/**
 * @package discuz.plugin
 * @author WiFeng
 */

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS `pre_plugin_tplstyle` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `styleid` mediumint(8) unsigned NOT NULL default '0',
  `domain` char(100) NOT NULL,
  `script` char(50) NOT NULL,
  `module` char(50) NOT NULL,
  `param` char(255) NOT NULL,
  `priority` mediumint(8) unsigned NOT NULL default '0',
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
SQL;

runquery($sql);

$finish = TRUE;
?>