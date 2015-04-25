<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class Menu_Control extends Base_Control {
     public $error_message;
     public $success_message;
     
     public function __construct() {
         parent::__construct(TRUE);
     }

	public function get_logic() {
		return NULL;
	}
}
 