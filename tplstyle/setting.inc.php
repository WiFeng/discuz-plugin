<?php
/**
 * @package discuz.plugin
 * @author WiFeng
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT . './source/plugin/tplstyle/style.func.php';

if (submitcheck('editsubmit')) {
    $id = dintval($_POST['id']);
    list($script, $module) = explode('-', $_POST['module']);
    $status = dintval($_POST['status']);
    $domain = trim($_POST['domain']);
    $styleid = dintval($_POST['styleid']);
    $priority = dintval($_POST['priority']);
    $param = trim($_POST['param']);
    $param = explode("\r\n", $param);
    $param = json_encode($param);
    $data = array(
            'styleid' => $styleid,
            'domain' => $domain,
            'script' => $script,
            'module' => $module,
            'param' => $param,
            'priority' => $priority,
            'status' => $status,
            );
    if ($id) {
        $ret = C::t('#tplstyle#plugin_tplstyle')->update($id, $data);
        $opertype = 'edit';
    } else {
        $ret = C::t('#tplstyle#plugin_tplstyle')->insert($data);
        $opertype = 'add';
    }

    if ($ret !== false) {
        cpmsg('tplstyle:' . $opertype . '_succeed', 'action=plugins&operation=config&do=' . $pluginid . '&identifier=tplstyle&pmod=admincp', 'succeed');
    } else {
        cpmsg_error('tplstyle:' . $opertype . '_error', 'action=plugins&operation=config&do=' . $pluginid . '&identifier=tplstyle&pmod=setting&id=' . $id);
    }
} else {
    $id = dintval($_GET['id']);
    $data = array();
    if ($id) {
        $data = C::t('#tplstyle#plugin_tplstyle')->fetch($id);
        $data['param'] = json_decode($data['param'], true);
        $data['param'] = implode("\r\n", $data['param']);
        $data['module'] = $data['script'] ? $data['script'] . ($data['module'] ? '-'.$data['module'] : '') : '';
    }

    $allstyle = C::t('common_style')->fetch_all_data();
    $styleselect = array('styleid');
    foreach ($allstyle as $k => $style) {
        $styleselect[1][$k][] = $style['styleid'];
        $styleselect[1][$k][] = $style['name'];
    }

    $allmodule = get_module_list();
    $moduleselect = array('module');
    $i = 0;
    foreach ($allmodule as $k => $v) {
        $moduleselect[1][$i][] = $k;
        $moduleselect[1][$i][] = $v['name'];
        if (isset($v['sub']) && $v['sub']) {
            foreach ($v['sub'] as $kk => $vv) {
                $i++;
                $moduleselect[1][$i][] = $k . '-' . $kk;
                $moduleselect[1][$i][] = '&nbsp;&nbsp;|- ' . $vv;
            }
        }
        $i++;
    }

    showtips(_cplang('tips_setting'));

    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=tplstyle&pmod=setting');
    showtableheader();
    showsetting(_cplang('domain'), 'domain', $data['domain'], 'text', '', 0, _cplang('domain_comment'));
    showsetting(_cplang('module'), $moduleselect, $data['module'], 'select');
    showsetting(_cplang('param'), 'param', $data['param'], 'textarea', '', 0, _cplang('param_comment'));
    showsetting(_cplang('priority'), 'priority', $data['priority'], 'text', '', 0, _cplang('priority_comment'));
    showsetting(_cplang('style'), $styleselect, $data['styleid'], 'select');
    showsetting(_cplang('switch'), 'status', $data['status'], 'radio');
    showsubmit('editsubmit', 'submit', '<input type="hidden" name="id" value="'.$data['id'].'">');
    showtablefooter();
    showformfooter();
}


?>