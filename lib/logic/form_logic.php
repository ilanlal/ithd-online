<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/form_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';



class Form_Logic extends Base_Logic {
    public $form_dao;
    
    public function __construct() {
        parent::__construct();
        $this->form_dao = new Form_DAO();
    }
    
    public function create($item) {
        /* @var $item Form */
        try {
            $item->formid = $this->form_dao->insert($item);
            return $item;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function update($item) {
        /* @var $item Form */
        try {
            $this->form_dao->update($item);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function delete($formid) {
        return $this->form_dao->delete($formid);
    }
    
    public function get_user_by_email($user_email) {
        return $this->form_dao->get_by_user_email($user_email);
    }
    
    public function get_by_id($id) {
        return $this->form_dao->get($id);
    }
    
    public function get_by_organization_unique_name($org_unique_name) {
        return $this->form_dao->get_by_organization_unique_name($org_unique_name);
    }
    
    public function get_by_strong_id($strong_id) {
        return $this->form_dao->get_by_strong_id($strong_id);
    }
}


