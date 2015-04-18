<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class Incident_Control extends Base_Control {
     
     public $incident_logic;
     public $incident;
     public $error_message;
     public $success_message;
     public $last_index;
     
     public function __construct($admin = FALSE) {
         parent::__construct($admin);
         $this->incident_logic = new Incident_Logic();
         $this->incident = new Incident();
         $this->execute_command();
     }
     
	 public function execute_command() {
		 $command = filter_input(INPUT_GET, "cmd");
		 echo $command;
		 switch ($command) {
			 case "delete":
				 $this->delete_row();
				 die;
			 case "edit":
			 case "new":
				 $this->load_data();
				 break;
		 }
	 }
     public function load_data() {
         $ticketnumber = filter_input(INPUT_GET, "id");
         if($ticketnumber === NULL) 
             return;
         
         $this->incident = $this->incident_logic->get_by_ticketnumber($ticketnumber);
         if($this->incident == NULL)
             $this->incident = new Incident();
     }
     
     public function upsert_incident_on_submit() {
         $this->incident->title = filter_input(INPUT_POST, "title");
         $this->incident->description = filter_input(INPUT_POST, "description");
         $this->incident->statecode = 1;
         $this->incident->incident_statusid = filter_input(INPUT_POST, "incident_statusid");
         $this->incident->categoryid = filter_input(INPUT_POST, "categoryid");
		 if(isset($_SESSION[self::SESSION_CUSTOMER_ID])) {
			$this->incident->customerid = $_SESSION[self::SESSION_CUSTOMER_ID];
		 }
         $this->incident->organization_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         
         if(filter_input(INPUT_POST,"ticketnumber") !== "") {
             $this->incident->ticketnumber = filter_input(INPUT_POST,"ticketnumber");
             $this->incident_logic->update($this->incident);
         }
         else {
             $this->incident = $this->incident_logic->create_incident($this->incident);
         }
     }
     
     public function delete_row() {
         if(filter_input(INPUT_GET,"id") !== "") {
             $this->incident_logic->delete(filter_input(INPUT_GET,"id"));
         }
     }
     
     public function get_customer_url($id) {
        $url = "http://" . 
            ConfigUtils::WebHost . $this->company_path . '/views/admin/entities/customer/'
                . $id . '#customer' ;
        
        return $url;
    }
 }
 