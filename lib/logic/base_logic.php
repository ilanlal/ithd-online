<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/base_dao.php';

if(ConfigUtils::ENV == "DEV") {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config_dev.xml');
}
else {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config.xml');
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';

abstract class Base_Logic {
    public $log;
	   
	
    public function __construct() {
        $this->log = Logger::getLogger(get_called_class());
    }
    
	/**
	* @return Base_DAO
	*/
	public abstract function get_dao();
	
	/**
	* @param Base_DataModel $item
	*/
	public function update_record($item) {
		$this->get_dao()->update($item);
	}
	
	/**
	* @param Base_DataModel $item
	* @return int item id
	*/
	public function insert_record($item) {
		return $this->get_dao()->insert($item);
	}
	
	/**
	* @param int $id item id
	*/
	public function delete_record($id) {
		$this->get_dao()->delete($id);
	}
	
    public function encrypt($clear_data) {
        $key = ConfigUtils::ky;
        $iv = ConfigUtils::iv;

        $encrypted_data = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $clear_data, MCRYPT_MODE_CBC, $iv);
        $encrypted_data = base64_encode($encrypted_data);

        return $encrypted_data;
    }

    public function decrypt($encrypted_data) {
        $key = ConfigUtils::ky;
        $iv = ConfigUtils::iv;

        $clear_data = base64_decode($encrypted_data);
        $clear_data = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $clear_data, MCRYPT_MODE_CBC, $iv);
        return $clear_data;
        
    }
    
    public function get_dynamic($org_unique_name,$cols, $where = NULL, $order_by = NULL, $row_limit = NULL) {
        return $this->get_dao()->get_dynamic($org_unique_name,$cols,$where,$order_by,$row_limit);
    }
	
    public function fatal($msg, $throwable = null) {
        $this->log->fatal($msg, $throwable);
    }
    
    public function error($msg, $throwable = null) {
        $this->log->error($msg, $throwable);
    }
    
    public function info($msg) {
        $this->log->info($msg);
    }
    
    public function warn($msg) {
        $this->log->warn($msg);
    }
}
