<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_item_control.php';

class Incident_Control extends Base_Item_Control {
	public $error_message;
	public $success_message;
	
	public function __construct($admin = FALSE) {
		parent::__construct($admin);
	}

	public function get_customer_url($id) {
		$url = "http://" .
		ConfigUtils::WebHost . $this->company_path . '/views/admin/entities/customer/'
		. $id . '#customer';

		return $url;
	}

	public function get_default_empty_item() {
		$incident = new Incident();
		$incident->statecode = 1;
		$incident->organization_unique_name = parent::get_org_unique_name();
		return $incident;
	}

	public function get_item_on_submit() {
		$incident = new Incident();
		$incident->title = filter_input(INPUT_POST, "title");
		$incident->description = filter_input(INPUT_POST, "description");
		$incident->statecode = 1;
		$incident->incident_statusid = filter_input(INPUT_POST, "incident_statusid");
		$incident->categoryid = filter_input(INPUT_POST, "categoryid");
		if (isset($_SESSION[self::SESSION_CUSTOMER_ID])) {
			$incident->customerid = $_SESSION[self::SESSION_CUSTOMER_ID];
		}
		
		$incident->organization_unique_name = parent::get_org_unique_name();
		$incident->ticketnumber = filter_input(INPUT_POST, "id");
		return $incident;
	}

	public function get_logic() {
		return new Incident_Logic();
	}
}
