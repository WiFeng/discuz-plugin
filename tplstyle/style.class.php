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
        $domain = isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

        foreach ($data as $val) {
            if (!$val['status']) {
                continue;
            }
            if ($val['domain'] && strpos($domain, $val['domain']) === false) {
                continue;
            }
            if ($val['script'] && $val['script'] != CURSCRIPT) {
                continue;
            }
            if ($val['module'] && $val['module'] != CURMODULE) {
                continue;
            }

            $param = json_decode($val['param'], true);
            if ($param) {
                if (empty($_GET)) {
                    continue;
                }
                $enable = false;
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