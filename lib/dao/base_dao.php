<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
if(ConfigUtils::ENV == "DEV") {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config_dev.xml');
}
else {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config.xml');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';

abstract class Base_DAO {
	public $dynamicSelect = 
		"SELECT " . self::COLS . " 
        FROM " . self::TABLE . "
        WHERE (" . self::WHERE . ") AND organization_unique_name = ?
		ORDER BY " . self::ORDER_BY . "
		LIMIT " . self::ROW_LIMIT . "";
	
	const TABLE = "{{table}}";
    const COLS = "{{cols}}";
    const WHERE = "{{where}}";
    const ORDER_BY = "{{order_by}}";
    const ROW_LIMIT = "{{row_limit}}";
    
    public $log;
    public $data_model_name = null;
	public $table_name = null;
    
    public function __construct($data_model_name, $table_name) {
        $this->data_model_name = $data_model_name;
		$this->table_name = $table_name;
        $this->log = Logger::getLogger(get_called_class());
    }
    
	/**
	* @param Base_DataModel $item
	*/
	public abstract function insert($item);
	/**
	* @param Base_DataModel $item
	*/
	public abstract function update($item);
	
	/**
	* @return Base_DataModel
	*/
	public abstract function get_by_id($id);
	
	public abstract function delete($id);
	
    public function error($msg) {
        $this->log->error($msg);
        throw new Exception($msg);
    }
    
    function bind_first_or_null(&$stmt) {
        /* @var $stmt mysqli_stmt*/
        $arrayOfObject = [];
        $row = [];
        
        $meta = $stmt->result_metadata(); 
        
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $params); 
        
        while ($stmt->fetch()) { 
            $item = new ReflectionClass($this->data_model_name);
            
            foreach($row as $key => $val)
            {
                $item->getProperty($key)->setValue($item,$val);
            }
            $arrayOfObject[] = $item; 
        }
        
        if ($arrayOfObject != null && count($arrayOfObject) > 0) {
            return $arrayOfObject[0];
        }
        return null;
    }

    function bind_all_or_null($stmt) {
        /* @var $stmt mysqli_stmt*/
        $params = [];
        $row = [];
        
        
        $arrayOfObject = [];
        $meta = $stmt->result_metadata(); 
        
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $params); 
        
        while ($stmt->fetch()) { 
            $item = new ReflectionClass($this->data_model_name);
            
            foreach($row as $key => $val)
            {
                $item->getProperty($key)->setValue($item,$val);
            }
            $arrayOfObject[] = $item; 
        }
		
        return $arrayOfObject;
    }
	
	/**
	* @param string $cols like "col1,col2,col3...."
	* @param string $where like "col1=1";
	* @param string $order_by
	* @param string $row_limit
	* @return ArrayObject
	*/
	public function get_dynamic($org_unique_name,$cols,$where=NULL,$order_by=NULL,$row_limit=NULL) {
        $db = new DBUtils();
        $link = $db->connect();
        $sqlQuery = $this->dynamicSelect;
        
        $where=($where===NULL?"1=1":$where);
        $order_by=($order_by===NULL?"1":$order_by);
		$row_limit=($row_limit===NULL?ConfigUtils::DYNAMIC_SELECT_DEFAULT_ROW_LIMIT:$row_limit);     
		$sqlQuery = str_replace(self::TABLE, $this->table_name, $sqlQuery);
		$sqlQuery = str_replace(self::COLS, $cols, $sqlQuery);
		$sqlQuery = str_replace(self::WHERE, $where, $sqlQuery);
		$sqlQuery = str_replace(self::ORDER_BY, $order_by, $sqlQuery);
		$sqlQuery = str_replace(self::ROW_LIMIT, $row_limit, $sqlQuery);
        $stmt = $link->prepare($sqlQuery);
        if($link->error) {
            self::error($link->error);
        }
		$stmt->bind_param("s", $org_unique_name);
		
        $stmt->execute();
        if($link->error) {
            self::error($link->error);
        }
        if($stmt->error) {
            self::error($stmt->error);
        }
		
        return self::bind_all_or_null($stmt);
    }
}

