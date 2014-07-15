<?php
/**
 * @package discuz.plugin
 * @author WiFeng
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT . './source/plugin/tplstyle/style.func.php';

if (submitcheck('admincpsubmit')) {
    $opertype = in_array($_GET['opertype'], array('delete', 'edit')) ? $_GET['opertype'] : 'edit';
    if ($opertype == 'delete') {
        $ids = $_GET['ids'];
        C::t('#tplstyle#plugin_tplstyle')->delete($ids);
    } else {
        $prioritys = $_POST['prioritys'];
        foreach ($prioritys as $id => $p) {
            C::t('#tplstyle#plugin_tplstyle')->update($id, array('priority' => $p));
        }
    }
    cpmsg('tplstyle:' .$opertype . '_succeed', 'action=plugins&operation=config&do=' . $pluginid . '&identifier=tplstyle&pmod=admincp', 'succeed');

/*

} elseif ($_GET['opertype'] == 'delete') {
	$id = dintval($_GET['id']);
    C::t('#tplstyle#plugin_tplstyle')->delete($id);
	cpmsg('tplstyle:delete_succeed', 'action=plugins&operation=config&do=' . $pluginid . '&identifier=tplstyle&pmod=admincp', 'succeed');
*/

} else {
    $data = C::t('#tplstyle#plugin_tplstyle')->fetch_all();

    showtips(_cplang('tips_admincp'));
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=tplstyle&pmod=admincp', 'onsubmit="if($(\'oper_del\').checked) return confirm(\'' . _cplang('confirm_delete') . '\'); "');
    showtableheader(_cplang('manage'));
    showsubtitle(array('', _cplang('priority'), _cplang('style'), _cplang('domain'), _cplang('module'), _cplang('param'), _cplang('switch'), _cplang('oper')));
    foreach ($data as $row) {
        showtablerow('', array('class="td25"', 'class="td25"'), array(
        '<input type="checkbox" class="checkbox" name="ids[]" value="'.$row['id'].'" />',
        '<input type="input" class="txt" name="prioritys['.$row['id'].']" value="'.$row['priority'].'">',
        $row['stylename'] . '<span class="lightfont">(styleid:'.$row['styleid'].')</span>',
        $row['domain'] ? $row['domain'] : '-',
        get_module_name($row['script'], $row['module']),
        $row['param'] ? $row['param'] : '-',
        $row['status'] ? _cplang('yes') : _cplang('no'),
        '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=tplstyle&pmod=setting&opertype=edit&id=' . $row['id'] . '">' . _cplang('edit') . '</a>'
		// .&nbsp;|&nbsp;'.
        // '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=tplstyle&pmod=admincp&opertype=delete&id='.$row['id'].'" onclick="return confirm(\'' . _cplang('confirm_delete') . '\');">' . _cplang('delete') . '</a>'
                ));
    }

    showsubmit('admincpsubmit', 'submit',
            '<input name="chkall" id="chkall" type="checkbox" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\', \'chkall\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;&nbsp;&nbsp;' .
            cplang('operation') . ':<input id="oper_del" class="radio" type="radio" name="opertype" value="delete"> '.cplang('delete'));
    showtablefooter();
    showformfooter();
}

?>