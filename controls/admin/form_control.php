<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/form_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/form_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_item_control.php';

class Form_Control extends Base_Item_Control {
    public $form_type;
    
    public function __construct($form_type) {
		$this->form_type = $form_type;
		parent::__construct(TRUE);
    }

	
    public function get_item_from_db($id) {
		return $this->get_logic()->get_dao()->get_by_strong_id($id);
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
        $val = $ref->getProperty($element_id)->getValue($this->item);
        
        $html = "<label title='$title' for='$element_id'>$label:</label>";
        $html .= "<select name='$element_id'>";
        $html .= "<option value='1' " . ($val==1?"selected='selected'":"") . ">Hide</option>";
        $html .= "<option value='2' " . ($val==2?"selected='selected'":"") . ">Optional</option>";
        $html .= "<option value='3' " . ($val==3?"selected='selected'":"") . ">Required</option>";
        $html .= "</select>";
        
        return $html;
    }

	public function get_default_empty_item() {
		$item = new Form();
		$item->form_type = $this->form_type;
		$item->font_size = "medium";
        $item->font_family = "serif";
		$item->strong_id = bin2hex(openssl_random_pseudo_bytes(16));
		
		return $item;
	}

	public function get_item_on_submit() {
		$item = new Form();
		$ref = new ReflectionClass('Form');
        
        $item->logo_url = filter_input(INPUT_POST, "logo_url");
        $item->user_email = filter_input(INPUT_POST, "user_email");
        $item->free_title = filter_input(INPUT_POST, "free_title");
        $item->background_color = filter_input(INPUT_POST, "background_color");
        $item->color = filter_input(INPUT_POST, "color");
        $item->font_family = filter_input(INPUT_POST, "font_family");
        $item->font_size = filter_input(INPUT_POST, "font_size");
        $item->thanks_message = filter_input(INPUT_POST, "thanks_message");
        $item->submit_xml = filter_input(INPUT_POST, "submit_xml");
        $item->submit_json = filter_input(INPUT_POST, "submit_json");
        $item->form_type = filter_input(INPUT_POST, "form_type");
        $item->form_name = filter_input(INPUT_POST, "form_name");
        $item->org_unique_name = filter_input(INPUT_GET, "company");
		$item->strong_id = filter_input(INPUT_POST,"id");
        
		
        foreach (FormConfiguration::get_fields_list($this->form_type) as $field) {
            if (filter_input(INPUT_POST,$field["name"]) === FALSE || filter_input(INPUT_POST,$field["name"]) === NULL) 
                continue;
            
            $value = filter_input(INPUT_POST, $field["name"]);
            $ref->getProperty($field["name"])->setValue($item,$value);
        }
		
		return $item;
	}

	public function get_logic() {
		return new Form_Logic();
	}

}
