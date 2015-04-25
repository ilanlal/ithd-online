<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/form_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_grid_control.php';
 
 class Landing_Page_Grid_Control extends Base_Grid_Control {
     public function __construct($admin = FALSE) {
		$cols = [];
		$cols[] = new GridColumn("Name","form_name","text",NULL,"150px");
		$cols[] = new GridColumn("Title","title","text",NULL,"250px");
		$cols[] = new GridColumn("User Email","user_email","text",NULL,"150px");
		$cols[] = new GridColumn("Organization","organization_unique_name","text",NULL,"150px");
		
		
		$unique_id = "form_grid";
		$title = "Landing Page";
		$key = "strong_id";
		$where = "1=1";
		$order_by = "1";
		parent::__construct($unique_id,$title,$cols,$key,$where,$order_by,$admin);
     }

	public function get_logic() {
		return new Form_Logic();
	}

	public function get_item_edit_url($itemid) {
        $url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/landing-page/edit/$itemid";
        return $url;
    }
	
	public function get_item_new_url() {
        $url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/landing-page/new";
        return $url;
    }
	
	public function get_item_delete_url($itemid) {
		$url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/landing-page/delete/$itemid";
        return $url;
	}

}
 