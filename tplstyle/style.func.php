<?php
/**
 * @package discuz.plugin
 * @author WiFeng
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function _lang($title) {
    return lang('plugin/tplstyle', $title);
}

function _cplang($title) {
    return _lang($title);
}

function get_module_list() {
    static $modulelist;

    if (isset($modulelist) && !empty($modulelist)) {
        return $modulelist;
    }

    $modulelist = array(
            'forum' => array(
                    'name' => _cplang('forum'),
                    'sub' => array(
                            'index' => _cplang('forum-index'),
                            'forumdisplay' => _cplang('forum-forumdisplay'),
                            'viewthread' => _cplang('forum-viewthread'),
                            'guide' => _cplang('forum-guide'),
                            'collection' => _cplang('forum-collection'),
                            'modcp' => _cplang('forum-modcp'),
                            'group' => _cplang('forum-group'),
                            ),
                    ),
            'home' => array(
                    'name' => _cplang('home'),
                    'sub' => array(
                            'space' => _cplang('home-space'),
                            'follow' => _cplang('home-follow'),
                            'spacecp' => _cplang('home-spacecp'),
                            ),
                    ),
            'portal' => array(
                    'name' => _cplang('portal'),
                    'sub' => array(
                            'index' => _cplang('portal-index'),
                            'topic' => _cplang('portal-topic'),
                            'portalcp' => _cplang('portal-portalcp'),
                            'list' => _cplang('portal-list'),
                            'view' => _cplang('portal-view'),
                            ),
                    ),
            'group' => array(
                    'name' => _cplang('group'),
                    'sub' => array(
                            'index' => _cplang('group-index'),
                            'my' => _cplang('group-my'),
                            ),
                    ),
            'member' => array(
                    'name' => _cplang('member'),
                    'sub' => array(
                            'logging' => _cplang('member-loggin'),
                            'register' => _cplang('member-register'),
                            ),
                    ),
            'misc' => array(
                    'name' => _cplang('misc'),
                    'sub' => array(
                            'tag' => _cplang('misc-tag'),
                            'faq' => _cplang('misc-faq'),
                            'ranklist' => _cplang('misc-ranklist'),
                            'stat' => _cplang('misc-stat'),
                            'invite' => _cplang('misc-invite'),
                            ),
                    ),
            'userapp' => array(
                    'name' => _cplang('userapp'),
            ),
            'plugin' => array(
                    'name' => _cplang('plugin'),
            ),
            'search' => array(
                    'name' => _cplang('search'),
                    ),
            );
    return $modulelist;
}

function get_module_name($script, $module = '', $join = ' - ') {
    $modulelist = get_module_list();
    $modulename = $modulelist[$script]['name'];
    if ($module && isset($modulelist[$script]['sub'][$module])) {
        $modulename .= $join . $modulelist[$script]['sub'][$module];
    }

    return $modulename;
}



?>