<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/incident_status_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_item_control.php';
 
 class IncidentStatus_Control extends Base_Item_Control {
     
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
         
         $current_status = $this->get_logic()->get_by_id($current_id);
         $pre_status = $this->get_logic()->get_previous($org_unique_name,$current_index);
         if($pre_status == NULL || $current_status == NULL) {
             return;
         }
         

         $current_status->index = $pre_status->index;
         $pre_status->index = $current_index;
         
         $this->get_logic()->update_record($current_status);
         $this->get_logic()->update_record($pre_status);
     }
     
     public function down() {
         $current_index = filter_input(INPUT_POST,"index");
         $current_id = filter_input(INPUT_POST,"id");
         $org_unique_name = $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME];
         
         if($current_index == $this->last_index-1) {
             return;
         }
         
         $current_status = $this->get_logic()->get_by_id($current_id);
         $next_status = $this->get_logic()->get_next($org_unique_name,$current_index);
         if($next_status == NULL || $current_status == NULL) {
             return;
         }
         

         $current_status->index = $next_status->index;
         $next_status->index = $current_index;
         
		 $this->get_logic()->update_record($current_status);
         $this->get_logic()->update_record($next_status);
     }

	public function get_default_empty_item() {
		$item = new IncidentStatus();
		$item->organization_unique_name = parent::get_org_unique_name();
		$item->index = $this->last_index;
		return $item;
	}

	public function get_item_on_submit() {
		$item = new IncidentStatus();
		$item->status_name = filter_input(INPUT_POST, "title");
		$item->organization_unique_name = parent::get_org_unique_name();
		$item->index = filter_input(INPUT_POST,"index");
		$item->incident_statusid = filter_input(INPUT_POST,"id");
		return $item;
	}

	public function get_logic() {
		return new IncidentStatus_Logic();
	}
}
 