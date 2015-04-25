<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/category_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_grid_control.php';

class Category_Grid_Control extends Base_Grid_Control {
    public function __construct($admin=FALSE) {

		$cols = [];
		$cols[] = new GridColumn("Title","title","text",NULL,"150px");
		$cols[] = new GridColumn("Index","`index`","text",NULL,"50px");
		
		$unique_id = "category_grid";
		$title = "Categories";
		$key = "categoryid";
		$where = "1=1";
		$order_by = "`index`";
		parent::__construct($unique_id,$title,$cols,$key,$where,$order_by,$admin);
    }
    

    public function get_item_edit_url($itemid) {
        $url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/category/edit/$itemid";
        return $url;
    }
	
	public function get_item_new_url() {
        $url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/category/new";
        return $url;
    }
	
	public function get_item_delete_url($itemid) {
		$url = ConfigUtils::FullWebHost . "/" . $this->company_path .  "/views/admin/entities/category/delete/$itemid";
        return $url;
	}

	public function get_logic() {
		return new Category_Logic();
	}
}

