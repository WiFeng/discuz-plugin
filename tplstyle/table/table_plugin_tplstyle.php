<?php
/**
 *
 * @package discuz.plugin
 * @author WiFeng
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_tplstyle extends discuz_table {

    public function __construct() {

        $this->_table = 'plugin_tplstyle';
        $this->_pk = 'id';
        $this->_pre_cache_key = 'plugin_tplstyle_';
        $this->_cache_ttl = 600;

        parent::__construct();
    }

    public function fetch_all() {
        $key  = 'all';
        $data = $this->fetch_cache($key);
        if (empty($data)) {
            $data = DB::fetch_all('SELECT p.*, s.name stylename FROM ' . DB::table($this->_table) . ' as p LEFT JOIN '.DB::table('common_style').' as s ON p.styleid=s.styleid ORDER BY p.priority');
            $this->store_cache($key, $data);
        }
        return $data;
    }

    public function update($val, $data) {
        $this->clear_cache('all');
        return parent::update($val, $data);
    }

    public function insert($data) {
        $this->clear_cache('all');
        return parent::insert($data);
    }

    public function delete($val) {
        $this->clear_cache('all');
        return parent::delete($val);
    }
}

?>