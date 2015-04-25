<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/form_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';

class Form_Logic extends Base_Logic {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_user_by_email($user_email) {
		return $this->get_dao()->get_by_user_email($user_email);
    }
    
    public function get_by_id($id) {
        return $this->get_dao()->get($id);
    }
    
    public function get_by_organization_unique_name($org_unique_name) {
        return $this->get_dao()->get_by_organization_unique_name($org_unique_name);
    }
    
    public function get_by_strong_id($strong_id) {
        return $this->get_dao()->get_by_strong_id($strong_id);
    }

	public function get_dao() {
		return new Form_DAO();
	}

}


