<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/dbutils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

class Submition_DAO extends Base_DAO {

    public $baseSelect = "SELECT 
        submitionid
        ,user_email
        ,email
        ,first_name
        ,middle_name
        ,last_name
        ,company_name
        ,title
        ,description
        ,phone1
        ,phone2
        ,fax1
        ,fax2
        ,createdon
        ,category
        ,type
        ,item
        ,send_to
        FROM submitions";
    public $baseUpdate = "UPDATE submitions SET
                                email = ?
                                ,first_name = ?
                                ,middle_name = ?
                                ,last_name = ?
                                ,company_name = ?
                                ,title = ?
                                ,description = ?
                                ,phone1 = ?
                                ,phone2 = ?
                                ,fax1 = ?
                                ,fax2 = ?
                                ,category = ?
                                ,type = ?
                                ,item = ?
                                ,send_to = ?
                            WHERE submitionid = ?";
    public $baseInsert = "INSERT INTO 
                submitions (
                    email
                    ,first_name
                    ,middle_name
                    ,last_name
                    ,company_name
                    ,title
                    ,description
                    ,phone1
                    ,phone2
                    ,fax1
                    ,fax2
                    ,createdon
                    ,category
                    ,type
                    ,item
                    ,send_to) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	public $baseDelete = 
            "DELETE FROM 
                submitions WHERE submitionid = ?";
	
	
    public function __construct() {
        parent::__construct('Submition',"submitions");
    }

	public function get_by_id($id) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = $this->baseSelect . " WHERE submitionid = ?";
        $stmt = $link->prepare($sqlQuery);
        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($link->error) {
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
        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        if ($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }

    public function insert($obj) {
        /* @var $obj Submition */
        $currentTime = new DateTime();
        $formatedDate = $currentTime->format('Y-m-d');
        
        $db = new DBUtils();
        $link = $db->connect();
        $stmt = $link->prepare($this->baseInsert);

        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'ssssssssssssiiis'
                , $obj->email
                , $obj->first_name
                , $obj->middle_name
                , $obj->last_name
                , $obj->company_name
                , $obj->title
                , $obj->description
                , $obj->phone1
                , $obj->phone2
                , $obj->fax1
                , $obj->fax2
                , $formatedDate
                , $obj->category
                , $obj->type
                , $obj->item
                , $obj->send_to);
        $stmt->execute();
        if ($link->error) {
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
        /* @var $obj Submition */
        $db = new DBUtils();
        $link = $db->connect();
        $stmt = $link->prepare($this->baseUpdate);
        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'sssssssssssiiisi'
                , $obj->email
                , $obj->first_name
                , $obj->middle_name
                , $obj->last_name
                , $obj->company_name
                , $obj->title
                , $obj->description
                , $obj->phone1
                , $obj->phone2
                , $obj->fax1
                , $obj->fax2
                , $obj->category
                , $obj->type
                , $obj->item
                , $obj->send_to
                , $obj->submitionid);
        $stmt->execute();
        if ($link->error) {
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
