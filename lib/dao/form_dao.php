<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/dbutils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

class Form_DAO extends Base_DAO {

    public $baseSelect = "SELECT 
        formid
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
        ,logo_url
        ,strong_id
        ,free_title
        ,background_color
        ,color
        ,font_family
        ,font_size
        ,thanks_message
        ,submit_xml
        ,submit_json
        ,form_name
        ,org_unique_name
        ,form_type
        FROM forms";
    public $baseUpdate = "UPDATE forms SET
                                user_email = ?
                                ,email = ?
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
                                ,logo_url = ?
                                ,free_title = ?
                                ,background_color = ?
                                ,color = ?
                                ,font_family = ?
                                ,font_size = ?
                                ,thanks_message = ?
                                ,submit_xml = ?
                                ,submit_json = ?
                                ,form_name = ?
                                ,org_unique_name = ?
                                ,form_type = ?
                            WHERE strong_id = ?";
    public $baseInsert = "INSERT INTO 
                forms (
                    user_email
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
                    ,logo_url
                    ,strong_id
                    ,free_title
                    ,background_color
                    ,color
                    ,font_family
                    ,font_size
                    ,thanks_message
                    ,submit_xml
                    ,submit_json
                    ,form_name
                    ,org_unique_name
                    ,form_type) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

     public $baseDelete = 
            "DELETE FROM 
                forms WHERE formid = ?";
     
    public function __construct() {
        parent::__construct('Form');
    }

    public function get($id) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = $this->baseSelect . " WHERE formid = ?";
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
    
    public function get_by_organization_unique_name($org_unique_name) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = $this->baseSelect . " WHERE org_unique_name = ?";
        
        
        $stmt = $link->prepare($sqlQuery);
        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s', $org_unique_name);
        $stmt->execute();
        if ($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {   
            parent::error($stmt->error);
        }
        return parent::bind_all_or_null($stmt);
    }
    
    public function get_by_strong_id($strong_id) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = $this->baseSelect . " WHERE strong_id = ?";
        
        
        $stmt = $link->prepare($sqlQuery);
        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s', $strong_id);
        $stmt->execute();
        if ($link->error) {
            parent::error($link->error);
        }
        if($stmt->error) {   
            parent::error($stmt->error);
        }
        return parent::bind_first_or_null($stmt);
    }

    public function get_by_user_email($user_email) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = $this->baseSelect . " WHERE user_email = ?";
        $stmt = $link->prepare($sqlQuery);
        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param('s', $user_email);
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
        /* @var $obj ContactUsManager */
        $db = new DBUtils();
        $link = $db->connect();
        $stmt = $link->prepare($this->baseInsert);

        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'siiiiiiiiiiissssssssiisss'
                , $obj->user_email
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
                , $obj->logo_url
                , $obj->strong_id
                , $obj->free_title
                , $obj->background_color
                , $obj->color
                , $obj->font_family
                , $obj->font_size
                , $obj->thanks_message
                , $obj->submit_xml
                , $obj->submit_json
                , $obj->form_name
                , $obj->org_unique_name
                , $obj->form_type);
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
        /* @var $obj ContactUsManager */
        $db = new DBUtils();
        $link = $db->connect();
        $stmt = $link->prepare($this->baseUpdate);
        if ($link->error) {
            parent::error($link->error);
        }
        $stmt->bind_param(
                'siiiiiiiiiiisssssssiissss'
                , $obj->user_email
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
                , $obj->logo_url
                , $obj->free_title
                , $obj->background_color
                , $obj->color
                , $obj->font_family
                , $obj->font_size
                , $obj->thanks_message
                , $obj->submit_xml
                , $obj->submit_json
                , $obj->form_name
                , $obj->org_unique_name
                , $obj->form_type
                , $obj->strong_id);
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
