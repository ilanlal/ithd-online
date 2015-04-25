<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/dbutils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

class Organization_DAO extends Base_DAO {
    public $baseSelect = "SELECT 
        organizationid
        ,organization_name
        ,statecode
        ,createdon
        ,unique_name
        FROM organization";
    public $baseUpdate = "UPDATE organization SET
                                organization_name = ?
                                ,statecode = ?
                                ,unique_name = ?
                            WHERE organizationid = ?";
    public $baseInsert = 
            "INSERT INTO 
                organization (
                    organization_name
                    ,statecode
                    ,createdon
                    ,unique_name) 
        VALUES (?,?,?,?)";
	
	public $baseDelete = 
            "DELETE FROM 
                organization WHERE organizationid = ?";
	
    public function __construct() {
        parent::__construct('Organization',"organization");
    }

    public function get_by_id($id) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE organizationid = ?";
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
    
    public function get_by_unique_name($unique_name) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE unique_name = ?";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s',$unique_name);
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
        /* @var $obj Organization */
        $db = new DBUtils();
        $currentTime = new DateTime();
        $formatedDate = $currentTime->format('Y-m-d');
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseInsert);
        
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'siss'
                ,$obj->organization_name
                ,$obj->statecode
                ,$formatedDate
                ,$obj->unique_name);
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
        /* @var $obj Organization */
        $db = new DBUtils();
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseUpdate);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'sisi'
                ,$obj->organization_name
                ,$obj->statecode
                ,$obj->unique_name
                ,$obj->organizationid);
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
