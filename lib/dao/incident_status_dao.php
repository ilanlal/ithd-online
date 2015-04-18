<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/dbutils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

class IncidentStatus_DAO extends Base_DAO {
    public $baseSelect = "SELECT 
        incident_statusid
        ,status_name
        ,organization_unique_name
        ,`index`
        FROM incident_status";
    public $baseUpdate = "UPDATE incident_status SET
                                status_name = ?
                                ,organization_unique_name = ?
                                ,`index` = ?
                            WHERE incident_statusid = ?";
    public $baseInsert = 
            "INSERT INTO 
                incident_status (
                    status_name
                    ,organization_unique_name
                    ,`index`) 
        VALUES (?,?,?)";

    public $baseDelete = 
            "DELETE FROM 
                incident_status WHERE incident_statusid = ?";
    
    public function __construct() {
        parent::__construct('IncidentStatus');
    }

    public function get($id) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE incident_statusid = ?";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('i',$id);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }
    
    
    public function get_by_organization_unique_name($org_unique_name) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE organization_unique_name = ? ORDER BY `index`";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s',$org_unique_name);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_all_or_null($stmt);
    }
    
    public function get_previous_row_by_index($org_unique_name,$index) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE organization_unique_name = ? AND `index` < ? ORDER BY `index` DESC LIMIT 1";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('si',$org_unique_name,$index);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }
    
    public function get_next_row_by_index($org_unique_name,$index) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE organization_unique_name = ? AND `index` > ? ORDER BY `index` LIMIT 1";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('si',$org_unique_name,$index);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }
    
    public function insert($obj) {
        /* @var $obj IncidentStatus */
        $db = new DBUtils();
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseInsert);
        
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'ssi'
                ,$obj->status_name
                ,$obj->organization_unique_name
                ,$obj->index);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        $res = $link->insert_id;
        $link->close();
        return $res;
    }   
    
    public function update($obj) {
        /* @var $obj IncidentStatus */
        $db = new DBUtils();
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseUpdate);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'ssii'
                ,$obj->status_name
                ,$obj->organization_unique_name
                ,$obj->index
                ,$obj->incident_statusid);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        $link->close();
    }
    
    public function delete($id) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseDelete;
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('i',$id);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        $link->close();
    }
}
