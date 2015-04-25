<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_status_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_grid_control.php';

class IncidentStatus_Grid_Control extends Base_Grid_Control {

	public function __construct($admin = FALSE) {
		$cols = [];
		$cols[] = new GridColumn("Title", "status_name", "text", NULL, "150px");
		$cols[] = new GridColumn("Index", "`index`", "text", NULL, "50px");

		$unique_id = "status_grid";
		$title = "Statuses";
		$key = "incident_statusid";
		$where = "1=1";
		$order_by = "`index`";
		parent::__construct($unique_id, $title, $cols, $key, $where, $order_by, $admin);
	}

	public function get_item_edit_url($itemid) {
		$url = ConfigUtils::FullWebHost . "/" . $this->company_path . "/views/admin/entities/incident_status/edit/$itemid";
		return $url;
	}

	public function get_item_new_url() {
		$url = ConfigUtils::FullWebHost . "/" . $this->company_path . "/views/admin/entities/incident_status/new";
		return $url;
	}

	public function get_item_delete_url($itemid) {
		$url = ConfigUtils::FullWebHost . "/" . $this->company_path . "/views/admin/entities/incident_status/delete/$itemid";
		return $url;
	}

	public function get_logic() {
		return new IncidentStatus_Logic();
	}

}
