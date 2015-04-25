<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/organization_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';

class Organization_Logic extends Base_Logic {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_by_id($id) {
        return $this->organization_dao->get($id);
    }
    
    public function get_by_unique_name($org_unique_name) {
        return $this->organization_dao->get_by_unique_name($org_unique_name);
    }

	public function get_dao() {
		return new Organization_DAO();
	}
}


