<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/category_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class Category_Control extends Base_Control {
     public $category_logic;
     public $category;
     public $error_message;
     public $success_message;
     public $last_index;
     
     public function __construct($last_index) {
         parent::__construct(TRUE);
         $this->category_logic = new Category_Logic();
         $this->category = new Category();
         $this->last_index = ($last_index == null || $last_index == ""?0:$last_index);
     }
     
     public function upsert_category_on_submit() {
         $this->category->title = filter_input(INPUT_POST, "title");
         $this->category->organization_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         
         if(filter_input(INPUT_POST,"id") !== "") {
             $this->category->categoryid = filter_input(INPUT_POST,"id");
             $this->category->index = filter_input(INPUT_POST,"index");
             $this->category_logic->update_category($this->category);
         }
         else {
             $this->category->index = $this->last_index;
             $this->category = $this->category_logic->create_category($this->category);
         }
     }
     
     public function delete_row() {
         if(filter_input(INPUT_POST,"id") !== "") {
             $this->category_logic->delete(filter_input(INPUT_POST,"id"));
         }
     }
     
     public function up() {
         $current_index = filter_input(INPUT_POST,"index");
         $current_id = filter_input(INPUT_POST,"id");
         $org_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         if($current_index == 0) {
             return;
         }
         
         $current_category = $this->category_logic->get_by_id($current_id);
         $pre_category = $this->category_logic->get_previous($org_unique_name,$current_index);
         if($pre_category == NULL || $current_category == NULL) {
             return;
         }

         $current_category->index = $pre_category->index;
         $pre_category->index = $current_index;
         
         $this->category_logic->update_category($current_category);
         $this->category_logic->update_category($pre_category);
     }
     
     public function down() {
         $current_index = filter_input(INPUT_POST,"index");
         $current_id = filter_input(INPUT_POST,"id");
         $org_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         if($current_index == $this->last_index) {
             return;
         }
         
         $current_category = $this->category_logic->get_by_id($current_id);
         $next_category = $this->category_logic->get_next($org_unique_name,$current_index);
         if($next_category == NULL || $current_category == NULL) {
             return;
         }

         $current_category->index = $next_category->index;
         $next_category->index = $current_index;
         
         $this->category_logic->update_category($current_category);
         $this->category_logic->update_category($next_category);
     }
 }
 