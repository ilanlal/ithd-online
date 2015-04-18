<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/incident_status_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';



class IncidentStatus_Logic extends Base_Logic {
    public $incident_status_dao;
    
    public function __construct() {
        parent::__construct();
        $this->incident_status_dao = new IncidentStatus_DAO();
    }
    
    public function create_status($status) {
        /* @var $status IncidentStatus */
        try {
            $status->incident_statusid = $this->incident_status_dao->insert($status);
            return $status;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function update_status($status) {
        /* @var $status IncidentStatus */
        try {
            $this->incident_status_dao->update($status);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function delete($id) {
        try {
            $this->incident_status_dao->delete($id);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function get_by_id($id) {
        return $this->incident_status_dao->get($id);
    }
    
    public function get_next($orgid,$index) {
        return $this->incident_status_dao->get_next_row_by_index($orgid,$index);
    }
    
    public function get_previous($orgid,$index) {
        return $this->incident_status_dao->get_previous_row_by_index($orgid,$index);
    }
    
    public function get_by_organization_unique_name($org_unique_name) {
        return $this->incident_status_dao->get_by_organization_unique_name($org_unique_name);
    }
}


