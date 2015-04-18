<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/incident_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/inteface/igrid_logic.php';


class Incident_Logic extends Base_Logic implements iGrid_Logic  {
    public $incident_dao;
    
    public function __construct() {
        parent::__construct();
        $this->incident_dao = new Incident_DAO();
    }
    
    public function create_incident($incident) {
        /* @var $incident Incident */
        try {
            $ticketnumber = $this->incident_dao->insert($incident);
            $incident->ticketnumber = $ticketnumber;
            return $incident;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
     public function update($incident) {
        /* @var $incident Incident */
        try {
            $this->incident_dao->update($incident);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function get_dynamic($cols, $where = NULL, $order_by = NULL, $row_limit = NULL) {
        return $this->incident_dao->get_dynamic($cols,$where,$order_by,$row_limit);
    }
    
    public function get_by_ticketnumber($ticketnumber,$view = FALSE) {
        return $this->incident_dao->get($ticketnumber,$view);
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


