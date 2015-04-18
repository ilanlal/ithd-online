<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/dbutils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

class Customer_DAO extends Base_DAO {
    public $baseSelect = "SELECT 
        customerid
        ,organization_unique_name
        ,first_name
        ,last_name
        ,email
        ,password
        ,phone
        ,statecode
        ,createdon
        ,reset_code
        FROM customer";
    public $baseUpdate = "UPDATE customer SET
                                organization_unique_name = ?
                                ,first_name = ?
                                ,last_name = ?
                                ,email = ?
                                ,password = ?
                                ,phone = ?
                                ,statecode = ?
                                ,reset_code = ?
                            WHERE customerid = ?";
    public $baseInsert = 
            "INSERT INTO 
                customer (
                    organization_unique_name
                    ,first_name
                    ,last_name
                    ,email
                    ,password
                    ,phone
                    ,statecode
                    ,createdon
                    ,reset_code) 
        VALUES (?,?,?,?,?,?,?,?,?)";

    public function __construct() {
        parent::__construct('Customer');
    }

    public function get($id) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE customerid = ?";
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
    
    public function get_by_email_and_org_unique_name($email, $organization_unique_name) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE email = ? AND organization_unique_name = ?";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('ss',$email,$organization_unique_name);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }
    
    public function get_by_email($email) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE email = ?";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s',$email);
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
        /* @var $obj Customer */
        $db = new DBUtils();
        $currentTime = new DateTime();
        $formatedDate = $currentTime->format('Y-m-d');
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseInsert);
        
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'ssssssiss'
                ,$obj->organization_unique_name
                ,$obj->first_name
                ,$obj->last_name
                ,$obj->email
                ,$obj->password
                ,$obj->phone
                ,$obj->statecode
                ,$formatedDate
                ,$obj->reset_code);
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
        /* @var $obj Customer */
        $db = new DBUtils();
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseUpdate);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'ssssssisi'
                ,$obj->organization_unique_name
                ,$obj->first_name
                ,$obj->last_name
                ,$obj->email
                ,$obj->password
                ,$obj->phone
                ,$obj->statecode
                ,$obj->reset_code
                ,$obj->customerid);
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
