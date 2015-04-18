<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/form_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/form_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';

class Form_Control extends Base_Control {
    /* @var Form_Logic */
    public $form_logic;
    /* @var ContactUsManager */
    public $form;
    /* @var string */
    public $error_message;
    /* @var string */
    public $success_message;
    
    public $form_type;
    
    public function __construct($form_type) {
        parent::__construct(TRUE);
        $this->form_logic = new Form_Logic();
        $this->form = new Form();
        $this->form_type = $form_type;
        $this->form->form_type = $form_type;
        $this->set_default_paramters();
        $this->load_data();
    }

    private function set_default_paramters() {
        $this->form->font_size = "medium";
        $this->form->font_family = "serif";
    }
    
    public function load_data() {
        /* @var $incident Incident */
         if(filter_input(INPUT_GET,"id") === NULL && filter_input(INPUT_GET,"sid") === NULL) {
             return;
         }
         
         $id = filter_input(INPUT_GET,"id");
         if($id!="") {
             $this->form = $this->form_logic->get_by_id($id);
         }
         
         $sid = filter_input(INPUT_GET,"sid");
         if($sid!="") {
             $this->form = $this->form_logic->get_by_strong_id($sid);
         }
         
         if($this->form == null) {
             $this->form = new Form();
         }
    }

    public function generate_html_selections() {
        $html = "";
        foreach (FormConfiguration::get_fields_list($this->form_type) as $field) {
            $html .= "<div class='field'>";
            $html .= $this->generate_html_selection($field["name"],$field["label"],$field["title"]);
            $html .= "</div>";
        }
        return $html;
    }
    
    public function generate_html_selection($element_id,$label,$title) {
        $ref = new ReflectionClass('Form');
        $val = $ref->getProperty($element_id)->getValue($this->form);
        
        $html = "<label title='$title' for='$element_id'>$label:</label>";
        $html .= "<select name='$element_id'>";
        $html .= "<option value='1' " . ($val==1?"selected='selected'":"") . ">Hide</option>";
        $html .= "<option value='2' " . ($val==2?"selected='selected'":"") . ">Optional</option>";
        $html .= "<option value='3' " . ($val==3?"selected='selected'":"") . ">Required</option>";
        $html .= "</select>";
        
        return $html;
    }
    
    public function load_data_to_object() {
        $ref = new ReflectionClass('Form');
        
        $this->form->logo_url = filter_input(INPUT_POST, "logo_url");
        $this->form->user_email = filter_input(INPUT_POST, "user_email");
        $this->form->free_title = filter_input(INPUT_POST, "free_title");
        $this->form->background_color = filter_input(INPUT_POST, "background_color");
        $this->form->color = filter_input(INPUT_POST, "color");
        $this->form->font_family = filter_input(INPUT_POST, "font_family");
        $this->form->font_size = filter_input(INPUT_POST, "font_size");
        $this->form->thanks_message = filter_input(INPUT_POST, "thanks_message");
        $this->form->submit_xml = filter_input(INPUT_POST, "submit_xml");
        $this->form->submit_json = filter_input(INPUT_POST, "submit_json");
        $this->form->form_type = filter_input(INPUT_POST, "form_type");
        $this->form->form_name = filter_input(INPUT_POST, "form_name");
        $this->form->org_unique_name = filter_input(INPUT_GET, "company");
        
        foreach (FormConfiguration::get_fields_list($this->form_type) as $field) {
            if (filter_input(INPUT_POST,$field["name"]) === FALSE || filter_input(INPUT_POST,$field["name"]) === NULL) 
                continue;
            
            $value = filter_input(INPUT_POST, $field["name"]);
            $ref->getProperty($field["name"])->setValue($this->form,$value);
        }
    }
    
    public function upsert_data_on_submit() {
        $this->load_data_to_object();
        
        if (filter_input(INPUT_POST,"id") != "") {
            $this->form->strong_id =  filter_input(INPUT_POST,"id");
            $this->form_logic->update($this->form);
        } else {
            $strong_id = bin2hex(openssl_random_pseudo_bytes(16));
            $this->form->strong_id = $strong_id;
            $this->form = $this->form_logic->create($this->form);
        }
        
        $this->success_message = "Success!";
    }
    
     public function delete_row() {
         if(filter_input(INPUT_POST,"formid") !== "") {
             $this->form_logic->delete(filter_input(INPUT_POST,"formid"));
         }
     }
}
