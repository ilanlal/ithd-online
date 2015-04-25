<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/category_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_item_control.php';
 
 class Category_Control extends Base_Item_Control {
     public $error_message;
     public $success_message;
     public $last_index;
     
     public function __construct($last_index) {
         parent::__construct(TRUE);
         $this->last_index = ($last_index == null || $last_index == ""?0:$last_index);
     }
     
     public function up() {
         $current_index = filter_input(INPUT_POST,"index");
         $current_id = filter_input(INPUT_POST,"id");
         $org_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         if($current_index == 0) {
             return;
         }
         
		 $current_category = $this->get_logic()->get_by_id($current_id);
         $pre_category = $this->get_logic()->get_previous($org_unique_name,$current_index);
         if($pre_category == NULL || $current_category == NULL) {
             return;
         }

         $current_category->index = $pre_category->index;
         $pre_category->index = $current_index;
         
         $this->get_logic()->update_record($current_category);
         $this->get_logic()->update_record($pre_category);
     }
     
     public function down() {
         $current_index = filter_input(INPUT_POST,"index");
         $current_id = filter_input(INPUT_POST,"id");
         $org_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         if($current_index == $this->last_index) {
             return;
         }
         
         $current_category = $this->get_logic()->get_by_id($current_id);
         $next_category = $this->get_logic()->get_next($org_unique_name,$current_index);
         if($next_category == NULL || $current_category == NULL) {
             return;
         }

         $current_category->index = $next_category->index;
         $next_category->index = $current_index;
         
		 $this->get_logic()->update_record($current_category);
         $this->get_logic()->update_record($next_category);
     }

	public function get_default_empty_item() {
		$category = new Category();
		
		$category->organization_unique_name = parent::get_org_unique_name();
		$category->index = $this->last_index;
		return $category;
	}

	public function get_item_on_submit() {
		$category = new Category();
		$category->title = filter_input(INPUT_POST, "title");
		$category->organization_unique_name = parent::get_org_unique_name();
		$category->index = filter_input(INPUT_POST,"index");
		$category->categoryid = filter_input(INPUT_POST,"id");
		return $category;
	}

	public function get_logic() {
		return new Category_Logic();
	}

}
 