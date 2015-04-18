<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/element_model.php';


abstract class BaseGrid_Control extends Base_Control {
    private $cols = [];
	public function set_cols($cols) {
		$this->cols = $cols;
		return $this;
	}
	
	private $rows = [];
	public function set_rows($rows) {
		$this->rows = $rows;
		return $this;
	}
	
    private $unique_id;
	public function set_unique_id($unique_id) {
		$this->unique_id = $unique_id;
		return $this;
	}
	
	private $title;
	public function set_title($title) {
		$this->title = $title;
		return $this;
	}
	private $key;
	public function set_key($key) {
		$this->key = $key;
		return $this;
	}
	
	private $where;
	public function set_where($where) {
		$this->where = $where;
		return $this;
	}
	
	private $order_by;
	public function set_order_by($order_by) {
		$this->order_by = $order_by;
		return $this;
	}
	private $row_limit;
	public function set_row_limit($row_limit) {
		$this->row_limit = $row_limit;
		return $this;
	}
	
	/* @var iGrid_Logic */
	private $logic_object;
	public function set_logic_object(iGrid_Logic $logic_object) {
		$this->logic_object = $logic_object;
		return $this;
	}
	
    public function __construct(iGrid_Logic $logic_object,$unique_id,$title,$cols,$key,$where,$order_by, $admin = FALSE) {
		$this
		->set_unique_id($unique_id)
		->set_title($title)
		->set_cols($cols)
		->set_key($key)
		->set_logic_object($logic_object)
		->set_where($where)
		->set_order_by($order_by);
		
        parent::__construct($admin);
		$this->load();
    }
    
	public abstract function get_item_edit_url($itemid);
	public abstract function get_item_new_url();
	public abstract function get_item_delete_url($itemid);
	
	
	public function load() {
		$this->rows = $this->get_items($this->where, $this->order_by, $this->row_limit);
		if($this->rows == NULL) {
			$this->rows = [];
		}
	}
	
	public function get_items($where = NULL, $order_by = NULL, $row_limit = NULL) { 
        $cols = $this->build_select_string_from_array();
        return $this->logic_object->get_dynamic($cols,$where,$order_by,$row_limit);
	}
    
	
    public function build_select_string_from_array() {
        $cols_str = "";
		$key_in = FALSE;
        for($i = count($this->cols)-1; $i >= 0; $i--) {
			if($this->cols[$i]->schema_name == $this->key) {
				$key_in = TRUE;
			}
			
            $cols_str .= $this->cols[$i]->schema_name;
            if($i!=0) {
                $cols_str.=",";
            }
        }
        
		if($key_in === FALSE) {
			 $cols_str .= ("," . $this->key);
		}
        return $cols_str;
    }
    
    public function getColumns() {
        return $this->cols;
    }
    
    public function addColumn(GridColumn $col) {
        $this->cols[] = $col; 
    }
    
    public function removeColumn($schema_name) {
        for($i = count($this->cols)-1; $i >= 0; $i--){
            if($this->cols[$i]["scema_name"] == $schema_name){
                unset($this->cols[$i]);
            }
        }
    }
    
    public function get_xml() {
		$xml = "<?xml version='1.0' encoding='UTF-8'?>";
		
		$root_template = "<grid id='{{grid_id}}' title='{{grid_title}}' page='1' key='{{key}}'
			new_url='{{new_url}}'>";
		
		$root = $root_template;
		$root = str_replace("{{grid_id}}", $this->unique_id, $root);
		$root = str_replace("{{grid_title}}", $this->title, $root);
		$root = str_replace("{{key}}", $this->key, $root);
		$root = str_replace("{{new_url}}", $this->get_item_new_url(), $root);
		$xml .= $root;
		$xml .= "<cols>";
		$col_template = "<col schema_name='{{schema_name}}' display_name='{{display_name}}' width='{{width}}' type='{{type}}' sorted='{{sorted}}' />";
		foreach ($this->cols as $col) {
			$xml_col = $col_template;
			$xml_col = str_replace("{{schema_name}}", $col->schema_name, $xml_col);
			$xml_col = str_replace("{{display_name}}", $col->display_name, $xml_col);
			$xml_col = str_replace("{{width}}", $col->width, $xml_col);
			$xml_col = str_replace("{{type}}", $col->type, $xml_col);
			$xml .= $xml_col;
		}
		$xml .= "</cols>";
		
		$xml .= "<rows>";
		$row_template = "<row id='{{id}}' open_url='{{open_url}}' delete_url='{{delete_url}}'>{{cells}}</row>";
		$cell_template = "<cell name='{{schema_name}}'>{{value}}</cell>";
		
		foreach ($this->rows as $row) {
			$id = $row->getProperty($this->key)->getValue($row);
            
			$xml_row = $row_template;
			$xml_row = str_replace("{{id}}", $id, $xml_row);
			$xml_row = str_replace("{{open_url}}",$this->get_item_edit_url($id) , $xml_row);
			$xml_row = str_replace("{{delete_url}}",$this->get_item_delete_url($id) , $xml_row);
			$cells = "";
			foreach ($this->cols as $col) {
				$value = $row->getProperty(trim($col->schema_name,'`'))->getValue($row);
				$xml_cell = $cell_template;
				
				$xml_cell = str_replace("{{schema_name}}", $col->schema_name, $xml_cell);
				$xml_cell = str_replace("{{value}}", $value, $xml_cell);
				$cells .= $xml_cell;
			}
			
			$xml_row = str_replace("{{cells}}",$cells , $xml_row);
			$xml .= $xml_row;
		}
		$xml .= "</rows>";
		$xml .= "</grid>";
		
		return simplexml_load_string($xml);
    }
}

