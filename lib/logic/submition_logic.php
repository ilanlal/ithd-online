<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/submition_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';

class Submition_Logic extends Base_Logic {
    public function __construct() {
        parent::__construct();
    }

	public function get_dao() {
		return new Submition_DAO();
	}
}


