<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/submition_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';



class Submition_Logic extends Base_Logic {
    public $submition_dao;
    
    public function __construct() {
        parent::__construct();
        $this->submition_dao = new Submition_DAO();
    }
    
    public function create($item) {
        /* @var $item Submition */
        try {
            $item->submitionid = $this->submition_dao->insert($item);
            return $item;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function update($item) {
        /* @var $item Submition */
        try {
            $this->submition_dao->update($item);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
}


