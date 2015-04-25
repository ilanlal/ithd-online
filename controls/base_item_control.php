<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';

abstract class Base_Item_Control extends Base_Control {
	/* @var $item */
	public $item;
	public function __construct($admin = FALSE) {
		parent::__construct($admin);
		$this->upsert_on_submit();
		$this->execute_command();
	}
	
	/**
	* @return Base_DataModel 
	*/
	public abstract function get_item_on_submit();
	/**
	* @return Base_DataModel 
	*/
	public abstract function get_default_empty_item();
	
	public function get_item_from_db($id) {
		return $this->get_logic()->get_dao()->get_by_id($id);
	}
	
	public function upsert_on_submit() {
		if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
			return;
		}
		
		
		$this->item = $this->get_item_on_submit();
		
		$id = filter_input(INPUT_GET, "id");
		
		if($id=="") {
			$id = $this->insert_row($this->item);
		}
		else {
			$this->update_row($this->item);
		}
	}
	
	/**
	* @param int $id item id
	*/
	public function delete_row($id) {
		$this->get_logic()->delete_record($id);
	}
	
	/**
	* @param Base_DataModel $item
	* @return int The new record id
	*/
	public function insert_row($item) {
		$id = $this->get_logic()->insert_record($item);
		header("Location: edit/$id");
	}
	
	/**
	* @param Base_DataModel $item
	*/
	public function update_row($item) {
		$this->get_logic()->update_record($item);
	}

	public function execute_command() {
		$command = filter_input(INPUT_GET, "cmd");
		$id = filter_input(INPUT_GET, "id");

		switch ($command) {
			case "delete":
				$this->delete_row($id);
				die;
			case "edit":
				$this->item = $this->get_item_from_db($id);
				break;
			case "new":
				$this->item = $this->get_default_empty_item();
				break;
		}
	}
}
