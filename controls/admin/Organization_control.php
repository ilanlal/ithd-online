<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/organization_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_item_control.php';

class Organization_Control extends Base_Item_Control {

	public function __construct() {
		parent::__construct(TRUE);
	}

	public function get_default_empty_item() {
		
		$organization = new Organization();
		$organization->statecode = 1;
		return $organization;
	}

	public function get_item_on_submit() {
		$id = filter_input(INPUT_GET, "id");
		$organization = new Organization();
		
		if($id=="") {
			$company_name = filter_input(INPUT_POST, "company");
			$unique_name = str_replace(' ', '-', $company_name); 
			$unique_name = preg_replace('/[^A-Za-z0-9\-]/', '', $unique_name); 
			$unique_name .= bin2hex(openssl_random_pseudo_bytes(2));
			$organization->unique_name = $unique_name;
		}
		else {
			$organization->unique_name = filter_input(INPUT_POST, "unique_name");
		}
		
		$organization->organizationid = filter_input(INPUT_POST, "id");
        $organization->organization_name = filter_input(INPUT_POST, "company");
		$organization->statecode = filter_input(INPUT_POST, "statecode");
        return $organization;
	}

	public function get_logic() {
		return new Organization_Logic();
	}
}
