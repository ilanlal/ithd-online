<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/form_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class FormsList_Control extends Base_Control {
     /* @var $form Form */
     public $form_logic;
     public $forms = [];
     
     public function __construct($admin = FALSE) {
         parent::__construct($admin);
         $this->form_logic = new Form_Logic();
         $this->load_data();
     }
     
     public function load_data() {
             $org_unique_name = $this->get_org_unique_name();
             if($org_unique_name !== NULL) {
                $this->forms = $this->form_logic->get_by_organization_unique_name($org_unique_name);
                return;
            }       
     }
 }
 