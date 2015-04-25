<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_grid_control.php';

class Incident_Grid_Control extends Base_Grid_Control {
    public function __construct($admin=FALSE) {
        
		$cols = [];
		$cols[] = new GridColumn("Ticket","ticketnumber","text",NULL,"50px");
		$cols[] = new GridColumn("Title","title","text",NULL,"150px");
		$cols[] = new GridColumn("Description","description","text",NULL,"200px");
		$cols[] = new GridColumn("Created On","createdon","datetime",NULL,"150px");
		
		$unique_id = "incident_grid";
		$title = "Tickets";
		$key = "ticketnumber";
		$where = "1=1";
		$order_by = NULL;
		parent::__construct($unique_id,$title,$cols,$key,$where,$order_by,$admin);
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

	public function get_logic() {
		return new Incident_Logic();
	}

}

