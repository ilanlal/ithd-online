<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/dbutils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

class Incident_DAO extends Base_DAO {
	public $dynamicSelect = "SELECT " . parent::COLS . " 
        FROM `incident` `i`
        /*LEFT JOIN `customer` `c` ON `i`.`customerid` = `c`.`customerid`*/
        WHERE " . parent::WHERE . "
		ORDER BY " . parent::ORDER_BY . "
		LIMIT " . parent::ROW_LIMIT . "";
    
    public $baseSelect = "SELECT 
        ticketnumber
        ,title
        ,description
        ,createdon
        ,statecode
        ,incident_statusid
        ,categoryid
        ,customerid
        ,organization_unique_name
        FROM incident";
    public $viewSelect = "SELECT 
        `i`.`ticketnumber` AS `ticketnumber`,
        `i`.`title` AS `title`,
        `i`.`description` AS `description`,
        `i`.`createdon` AS `createdon`,
        `i`.`statecode` AS `statecode`,
        `i`.`incident_statusid` AS `incident_statusid`,
        `i`.`categoryid` AS `categoryid`,
        `i`.`customerid` AS `customerid`,
        `i`.`organization_unique_name` AS `organization_unique_name`,
        `c`.`first_name` AS `first_name`,
        `c`.`last_name` AS `last_name`
        FROM
            (`incident` `i`
            LEFT JOIN `customer` `c` ON ((`i`.`customerid` = `c`.`customerid`)))";
            
    public $baseUpdate = "UPDATE incident SET
                                title = ?
                                ,description = ?
                                ,statecode = ?
                                ,incident_statusid = ?
                                ,categoryid = ?
                                ,customerid = ?
                                ,organization_unique_name = ?
                            WHERE ticketnumber = ?";
    public $baseInsert = 
            "INSERT INTO 
                incident (
                    title
                    ,description
                    ,createdon
                    ,statecode
                    ,incident_statusid
                    ,categoryid
                    ,customerid
                    ,organization_unique_name) 
        VALUES (?,?,?,?,?,?,?,?)";
    
    public $baseDelete = 
            "DELETE FROM 
                incident WHERE ticketnumber = ?";

    public function __construct() {
        parent::__construct('Incident');
    }

    public function get($ticketnumber,$view = FALSE) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = NULL;
        if($view === FALSE) {
            $sqlQuery = $this->baseSelect . " WHERE ticketnumber = ?";
        }
        else {
            $sqlQuery = $this->viewSelect . " WHERE i.ticketnumber = ?";
        }
        
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s',$ticketnumber);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }
    
    public function get_dynamic($cols,$where=NULL,$order_by=NULL,$row_limit=NULL) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = $this->dynamicSelect;
        
        $where=($where===NULL?"1":$where);
        $order_by=($order_by===NULL?"1":$order_by);
		$row_limit=($row_limit===NULL?ConfigUtils::DYNAMIC_SELECT_DEFAULT_ROW_LIMIT:$row_limit);     
        
		$sqlQuery = str_replace(parent::COLS, $cols, $sqlQuery);
		$sqlQuery = str_replace(parent::WHERE, $where, $sqlQuery);
		$sqlQuery = str_replace(parent::ORDER_BY, $order_by, $sqlQuery);
		$sqlQuery = str_replace(parent::ROW_LIMIT, $row_limit, $sqlQuery);
		
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
		
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
		
        return parent::bind_all_or_null($stmt);
    }
    
    public function get_by_customerid($customerid,$view = FALSE) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = NULL;
        if($view === FALSE) {
            $sqlQuery = $this->baseSelect . " WHERE customerid = ?";
        }
        else {
            $sqlQuery = $this->viewSelect . " WHERE i.customerid = ?";
        }
        
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('i',$customerid);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_all_or_null($stmt);
    }
    
    public function get_by_organization_unique_name($org_unique_name,$view = FALSE) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = NULL;
        if($view === FALSE) {
            $sqlQuery = $this->baseSelect . " WHERE organization_unique_name = ?";
        }
        else {
            $sqlQuery = $this->viewSelect . " WHERE `i`.`organization_unique_name` = ?";
        }
        
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
    
    public function insert($obj) {
        /* @var $obj Incident */
        $db = new DBUtils();
        $currentTime = new DateTime();
        $formatedDate = $currentTime->format('Y-m-d');
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseInsert);
        
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'sssiiiis'
                ,$obj->title
                ,$obj->description
                ,$formatedDate
                ,$obj->statecode
                ,$obj->incident_statusid
                ,$obj->categoryid
                ,$obj->customerid
                ,$obj->organization_unique_name);
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
        /* @var $obj Incident */
        $db = new DBUtils();
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseUpdate);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'ssiiiiss'
                ,$obj->title
                ,$obj->description
                ,$obj->statecode
                ,$obj->incident_statusid
                ,$obj->categoryid
                ,$obj->customerid
                ,$obj->organization_unique_name
                ,$obj->ticketnumber);
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
