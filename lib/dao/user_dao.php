<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/dbutils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

class User_DAO extends Base_DAO {
    public $baseSelect = "SELECT 
        userid
        ,organization_unique_name
        ,email
        ,password
        ,statecode
        ,createdon
        ,reset_code
        FROM users";
    public $baseUpdate = "UPDATE users SET
                                organization_unique_name = ?
                                ,email = ?
                                ,password = ?
                                ,statecode = ?
                                ,reset_code = ?
                            WHERE userid = ?";
    public $baseInsert = 
            "INSERT INTO 
                users (
                    organization_unique_name
                    ,email
                    ,password
                    ,statecode
                    ,createdon
                    ,reset_code) 
        VALUES (?,?,?,?,?,?)";

    public function __construct() {
        parent::__construct('User');
    }

    public function get($id) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE userid = ?";
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
    
    public function get_by_email_and_company($email,$company) {
        $db = new DBUtils();
        $link = $db->connect(); 
        $sqlQuery = $this->baseSelect . " WHERE email = ? AND organization_unique_name = ?";
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('ss',$email,$company);
        $stmt->execute();
        if($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }
    
    public function get_all_by_email($email) {
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
        return parent::bind_all_or_null($stmt);
    }
    
    public function insert($obj) {
        /* @var $obj User */
        $db = new DBUtils();
        $currentTime = new DateTime();
        $formatedDate = $currentTime->format('Y-m-d');
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseInsert);
        
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'sssiss'
                ,$obj->organization_unique_name
                ,$obj->email
                ,$obj->password
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
        /* @var $obj User */
        $db = new DBUtils();
        $link = $db->connect(); 
        $stmt = $link->prepare($this->baseUpdate);
        if($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'sssisi'
                ,$obj->organization_unique_name
                ,$obj->email
                ,$obj->password
                ,$obj->statecode
                ,$obj->reset_code
                ,$obj->userid);
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
