<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/category_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/inteface/igrid_logic.php';


class Category_Logic extends Base_Logic implements iGrid_Logic {
    public $category_dao;
    
    public function __construct() {
        parent::__construct();
        $this->category_dao = new Category_DAO();
    }
    
    public function create_category($category) {
        /* @var $category Category */
        try {
            $category->categoryid = $this->category_dao->insert($category);
            return $category;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
	public function get_dynamic($cols, $where = NULL, $order_by = NULL, $row_limit = NULL) {
        return $this->category_dao->get_dynamic($cols,$where,$order_by,$row_limit);
    }
	
    public function update($category) {
        /* @var $category Category */
        try {
            $this->category_dao->update($category);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function delete($id) {
        try {
            $this->category_dao->delete($id);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function get_by_id($id) {
        return $this->category_dao->get($id);
    }
    
    public function get_next($org_unique_name,$index) {
        return $this->category_dao->get_next_row_by_index($org_unique_name,$index);
    }
    
    public function get_previous($org_unique_name,$index) {
        return $this->category_dao->get_previous_row_by_index($org_unique_name,$index);
    }
    
    public function get_by_organization_unique_name($org_unique_name) {
        return $this->category_dao->get_by_organization_unique_name($org_unique_name);
    }
}


