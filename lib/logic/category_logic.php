<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/category_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';


class Category_Logic extends Base_Logic {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_next($org_unique_name,$index) {
		return $this->get_dao()->get_next_row_by_index($org_unique_name,$index);
    }
    
    public function get_previous($org_unique_name,$index) {
        return $this->get_dao()->get_previous_row_by_index($org_unique_name,$index);
    }
    
    public function get_by_organization_unique_name($org_unique_name) {
        return $this->get_dao()->get_by_organization_unique_name($org_unique_name);
    }

	public function get_dao() {
		return new Category_DAO();
	}
}


