<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
if(ConfigUtils::ENV == "DEV") {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config_dev.xml');
}
else {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config.xml');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';

class Base_DAO {
    const COLS = "{{cols}}";
    const WHERE = "{{where}}";
    const ORDER_BY = "{{order_by}}";
    const ROW_LIMIT = "{{row_limit}}";
    
    public $log;
    public $bindObjectModelName = null;
    
    public function __construct($bindObjectModelName) {
        $this->bindObjectModelName = $bindObjectModelName;
        $this->log = Logger::getLogger(get_called_class());
    }
    
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
            $item = new ReflectionClass($this->bindObjectModelName);
            
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
            $item = new ReflectionClass($this->bindObjectModelName);
            
            foreach($row as $key => $val)
            {
                $item->getProperty($key)->setValue($item,$val);
            }
            $arrayOfObject[] = $item; 
        }
		
        return $arrayOfObject;
    }
}

