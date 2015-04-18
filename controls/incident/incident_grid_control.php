<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/element_model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_grid_control.php';

class IncidentGrid_Control extends BaseGrid_Control {
    public $incident_logic;
    
    public function __construct($admin=FALSE) {
        $this->incident_logic = new Incident_Logic();
		$cols = [];
		$cols[] = new GridColumn("Ticket","ticketnumber","text",NULL,"50px");
		$cols[] = new GridColumn("Title","title","text",NULL,"150px");
		$cols[] = new GridColumn("Description","description","text",NULL,"200px");
		$cols[] = new GridColumn("Created On","createdon","datetime",NULL,"150px");
		
		$unique_id = "incident_grid";
		$title = "Tickets";
		$key = "ticketnumber";
		$where = "organization_unique_name = '" . $_SESSION[self::SESSION_ORGANIZATION_UNIQUE_NAME] . "'";
		$order_by = NULL;
		parent::__construct($this->incident_logic,$unique_id,$title,$cols,$key,$where,$order_by,$admin);
    }
    

    public function get_item_edit_url($itemid) {
        $url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/incident/edit/$itemid";
        return $url;
    }
	
	public function get_item_new_url() {
        $url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/incident/new";
        return $url;
    }
	
	public function get_item_delete_url($itemid) {
		$url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/incident/delete/$itemid";
        return $url;
	}
}

