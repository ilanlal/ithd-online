<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/user_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_item_control.php';

class User_Control extends Base_Item_Control {

	public function __construct() {
		parent::__construct(TRUE);
	}

	public function get_default_empty_item() {
		$user = new User();
		$user->organization_unique_name = filter_input(INPUT_POST, "company");
		return $user;
	}

	public function get_item_on_submit() {
		$user = new User();
		$user->organization_unique_name = filter_input(INPUT_POST, "company");
		$user->userid = filter_input(INPUT_POST, "id");
		$user->email = filter_input(INPUT_POST, "email");
		$user->password = filter_input(INPUT_POST, "password1");
		return $user;
	}

	public function get_logic() {
		return new User_Logic();
	}
}
