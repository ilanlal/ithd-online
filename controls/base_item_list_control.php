<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';


abstract class Base_Item_List_Control extends Base_Control {
    public $items = [];
	
	public function __construct($admin = FALSE) {
		parent::__construct($admin);
	}

	/**
	* @return Base_DataModel[] 
	*/
	public function get_items_list() {
		$this->get_logic()->get_dynamic();
	}	
}
