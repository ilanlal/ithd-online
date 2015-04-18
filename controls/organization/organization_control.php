<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/organization_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class Organization_Control extends Base_Control {
     public $error_message;
     public $success_message;
     public $organization_logic;
     public $organization;
     
     public function __construct($admin = FALSE) {
         parent::__construct($admin);
         $this->organization = new Organization();
         $this->organization_logic = new Organization_Logic();
         $this->load_data();
     }
     
     
     public function update() {
         $this->organization->organization_name = filter_input(INPUT_POST, "company");
         $this->organization_logic->update_organization($this->organization);
         header("Location: " . $this->company_path . "/organization#organization");
     }
     
     
     public function load_data() {
         $this->load_organization();
         
     }
     
     public function load_organization() {
         if(filter_input(INPUT_POST, "id") !== NULL ) {
            $this->organization = $this->organization_logic->get_by_id(filter_input(INPUT_POST, "id"));
         }
     }
 }
 