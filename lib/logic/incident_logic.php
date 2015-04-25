<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/incident_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';


class Incident_Logic extends Base_Logic  {    
    public function __construct() {
        parent::__construct();
    }
    
	public function get_dao() {
		return new Incident_DAO();
	}
    
    public function delete($ticketnumber) {
        return $this->incident_dao->delete($ticketnumber);
    }
    
    public function get_by_organization_unique_name($org_unique_name,$view = FALSE) {
        return $this->incident_dao->get_by_organization_unique_name($org_unique_name,$view);
    }
    
    public function get_incidents_by_customerid($customerid,$view = FALSE) {
        return $this->incident_dao->get_by_customerid($customerid,$view);
    }

}


