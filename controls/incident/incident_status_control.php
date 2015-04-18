<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_status_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class IncidentStatus_Control extends Base_Control {
     /* @var $incident Incident */
     public $incident_status_logic;
     public $incident_status;
     public $error_message;
     public $success_message;
     public $last_index;
     
     public function __construct($last_index) {
         parent::__construct(TRUE);
         $this->incident_status_logic = new IncidentStatus_Logic();
         $this->incident_status = new IncidentStatus();
         $this->last_index = ($last_index == null || $last_index == ""?0:$last_index);
     }
     
     public function upsert_status_on_submit() {
         $this->incident_status->status_name = filter_input(INPUT_POST, "status_name");
         $this->incident_status->organization_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         
         if(filter_input(INPUT_POST,"id") !== "") {
             $this->incident_status->incident_statusid = filter_input(INPUT_POST,"id");
             $this->incident_status->index = filter_input(INPUT_POST,"index");
             $this->incident_status_logic->update_status($this->incident_status);
         }
         else {
             $this->incident_status->index = $this->last_index;
             $this->incident_status = $this->incident_status_logic->create_status($this->incident_status);
         }
     }
     
     public function delete_row() {
         if(filter_input(INPUT_POST,"id") !== "") {
             $this->incident_status_logic->delete(filter_input(INPUT_POST,"id"));
         }
     }
     
     public function up() {
         $current_index = filter_input(INPUT_POST,"index");
         $current_id = filter_input(INPUT_POST,"id");
         $org_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         if($current_index == 0) {
             return;
         }
         
         $current_status = $this->incident_status_logic->get_by_id($current_id);
         $pre_status = $this->incident_status_logic->get_previous($org_unique_name,$current_index);
         if($pre_status == NULL || $current_status == NULL) {
             return;
         }
         

         $current_status->index = $pre_status->index;
         $pre_status->index = $current_index;
         
         $this->incident_status_logic->update_status($current_status);
         $this->incident_status_logic->update_status($pre_status);
     }
     
     public function down() {
         $current_index = filter_input(INPUT_POST,"index");
         $current_id = filter_input(INPUT_POST,"id");
         $org_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         if($current_index == $this->last_index-1) {
             return;
         }
         
         $current_status = $this->incident_status_logic->get_by_id($current_id);
         $next_status = $this->incident_status_logic->get_next($org_unique_name,$current_index);
         if($next_status == NULL || $current_status == NULL) {
             return;
         }
         

         $current_status->index = $next_status->index;
         $next_status->index = $current_index;
         
         $this->incident_status_logic->update_status($current_status);
         $this->incident_status_logic->update_status($next_status);
     }
 }
 