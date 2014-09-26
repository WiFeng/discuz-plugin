<?php
/**
 * @package discuz.plugin
 * @author WiFeng
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = "DROP TABLE IF EXISTS `pre_plugin_tplstyle`;";

runquery($sql);

$finish = TRUE;

?>