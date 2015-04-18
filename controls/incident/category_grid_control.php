<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/element_model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/category_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_grid_control.php';

class CategoryGrid_Control extends BaseGrid_Control {
    public $category_logic;
    
    public function __construct($admin=FALSE) {
        $this->category_logic = new Category_Logic();
		$cols = [];
		$cols[] = new GridColumn("Title","title","text",NULL,"150px");
		$cols[] = new GridColumn("Index","`index`","text",NULL,"50px");
		
		$unique_id = "category_grid";
		$title = "Categories";
		$key = "categoryid";
		$where = "organization_unique_name = '" . $_SESSION[self::SESSION_ORGANIZATION_UNIQUE_NAME] . "'";
		$order_by = "`index`";
		parent::__construct($this->category_logic,$unique_id,$title,$cols,$key,$where,$order_by,$admin);
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
}

