<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class IncidentList_Control extends Base_Control {
     /* @var $incident Incident */
     public $incident_logic;
     public $incidents = [];
     public $admin = FALSE;
     public function __construct($admin = FALSE) {
         parent::__construct($admin);
         $this->incident_logic = new Incident_Logic();
         $this->load_data();
     }
     
     public function load_data() {
         if($this->admin) {
             $org_unique_name = $this->get_org_unique_name();
             if($org_unique_name !== NULL) {
                $this->incidents = $this->incident_logic->get_by_organization_unique_name($org_unique_name,TRUE);
                return;
            }
         }
         else {
             $customerid = $this->get_current_customer_id();
            if($customerid !== NULL) {
                $this->incidents = $this->incident_logic->get_incidents_by_customerid($customerid,TRUE);
                return;
            }
         }
     }
 }
 