<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_status_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class IncidentStatusList_Control extends Base_Control {
     /* @var $incident Incident */
     public $incident_status_logic;
     public $statuses = [];
     public $last_index;
     
     public function __construct($admin = FALSE) {
         parent::__construct($admin);
         $this->incident_status_logic = new IncidentStatus_Logic();
         $this->load_data();
     }
     
     public function load_data() {
         /* @var $incident Incident */
         $name = $this->get_org_unique_name();
         if($name === NULL) {
             return;
         }
         
         $this->statuses = $this->incident_status_logic->get_by_organization_unique_name($name);
         
         //Set the last index
         if($this->statuses !=NULL) {
             $this->last_index = sizeof($this->statuses);
         }
     }
 }
 