<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/organization_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';



class Organization_Logic extends Base_Logic {
    public $organization_dao;
    
    public function __construct() {
        parent::__construct();
        $this->organization_dao = new Organization_DAO();
    }
    
    public function create_organization($org) {
        /* @var $org Organization */
        try {
            $org->organizationid = $this->organization_dao->insert($org);
            return $org;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function update_organization($org) {
        /* @var $org Organization */
        try {
            $this->organization_dao->update($org);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function get_by_id($id) {
        return $this->organization_dao->get($id);
    }
    
    public function get_by_unique_name($org_unique_name) {
        return $this->organization_dao->get_by_unique_name($org_unique_name);
    }
}


