<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/category_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class CategoryList_Control extends Base_Control {
     /* @var $incident Incident */
     public $category_logic;
     public $categories = [];
     public $last_index;
     
     public function __construct($admin = FALSE) {
         parent::__construct($admin);
         $this->category_logic = new Category_Logic();
         $this->load_data();
     }
     
     public function load_data() {
         /* @var $incident Incident */
         $name = $this->get_org_unique_name();
         if($name === NULL) {
             return;
         }
         
         $this->categories = $this->category_logic->get_by_organization_unique_name($name);
         
         //Set the last index
         if($this->categories !=NULL) {
             $this->last_index = sizeof($this->categories);
         }
     }
 }
 