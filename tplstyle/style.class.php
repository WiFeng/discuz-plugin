<?php
/**
 * @package discuz.plugin
 * @author WiFeng
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_tplstyle {
    public function common() {
        global $_G;

        $data = C::t('#tplstyle#plugin_tplstyle')->fetch_all();
        foreach ($data as $val) {
            if (!$val['status']) {
                continue;
            }
            if ($val['domain'] && $val['domain'] != $_SERVER['SERVER_NAME']) {
                continue;
            }
            if ($val['script'] && $val['script'] != CURSCRIPT) {
                continue;
            }
            if ($val['module'] && $val['module'] != CURMODULE) {
                continue;
            }

            if ($val['param']) {
                if (empty($_GET)) {
                    continue;
                }
                $enable = false;
                $param = json_decode($val['param'], true);
                foreach ($param as $vv) {
                    parse_str($vv, $pp);
                    $diff = array_diff_assoc($pp, $_GET);
                    if (!$pp || !$diff) {
                        $enable = true;
                        break;
                    }
                }
                if (!$enable) {
                    continue;
                }
            }

            $_G['category']['styleid'] = $val['styleid'];
            break;
        }

        if (defined('DISCUZ_DEBUG') && DISCUZ_DEBUG) {
            $_G['setting']['cacheindexlife'] = 0;
            $_G['setting']['cachethreadlife'] = 0;
        }
    }
}


?>