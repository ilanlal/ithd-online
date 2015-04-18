<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/submition_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/form_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';


class Submition_Control extends Base_Control {
    public $submition_logic;
    public $submition;
    /* @var string */
    public $error_message;
    public $form;
    
    public function __construct($form,$admin = FALSE) {
        parent::__construct($admin);
        $this->form = $form;
        $this->submition_logic = new Submition_Logic();
        $this->submition = new Submition();
    }

    public function submit_form() {
        try {
            $this->load_data_to_object();
            
            $this->submition_logic->create($this->submition);
            $this->email_submition($this->form, $this->submition);
        } catch (Exception $exc) {
            $this->log->error("Error in submit_contact!", $exc);
        }
    }

    public function email_submition($form, $submition) {
        /* @var $submition Submition */
        /* @var $form Form */

        $email = new PHPMailer();
        $email->From = ConfigUtils::MAIL_SENDER;
        $email->FromName = ConfigUtils::ApplicationName;
        $email->Subject = ConfigUtils::ApplicationName . " - New submition [" . $submition->submitionid . "]";
        $email->Body = html_entity_decode($this->build_html_body($submition));
        $email->isHTML(true);
        $email->AddAddress($form->user_email);
        
        if ($form->submit_json == 1) {
            $json = json_encode($submition);
            $email->AddStringAttachment($json, "json_attachment_" . $submition->submitionid . ".json", "base64", "text/json");
        }
        if ($form->submit_xml == 1) {
            $xml = wddx_serialize_value($submition);
            $email->AddStringAttachment($xml, "xml_attachment_" . $submition->submitionid . ".xml", "base64", "text/xml");
        }


        return $email->Send();
    }

    public function build_html_body($submition) {
        /* @var $submition Submition */
        $body = "";
        $body .= "ID: " . $submition->submitionid . "<br />";
        $body .= "Email: " . $submition->email . "<br />";
        $body .= "First Name: " . $submition->first_name . "<br />";
        $body .= "Middle Name:" . $submition->middle_name . "<br />";
        $body .= "Last Name:" . $submition->last_name . "<br />";
        $body .= "Company: " . $submition->company_name . "<br />";
        $body .= "Title: " . $submition->title . "<br />";
        $body .= "Description: " . $submition->description . "<br />";
        $body .= "phone1: " . $submition->phone1 . "<br />";
        $body .= "phone2: " . $submition->phone2 . "<br />";
        $body .= "fax1 " . $submition->fax1 . "<br />";
        $body .= "fax2: " . $submition->fax2 . "<br />";

        return $body;
    }

    public function load_data_to_object() {
        $ref = new ReflectionClass('Submition');
        
        foreach (FormConfiguration::get_fields_list($this->form->form_type) as $field) {
            if (filter_input(INPUT_POST,$field["name"]) === FALSE || filter_input(INPUT_POST,$field["name"]) === NULL) 
                continue;
            
            $value = filter_input(INPUT_POST, $field["name"]);
            $ref->getProperty($field["name"])->setValue($this->submition,$value);
        }
    }
    
    public function generate_html_fields() {
        $html = "";
        
        foreach (FormConfiguration::get_fields_list($this->form->form_type) as $field) {
            $form_ref = new ReflectionClass('Form');
            $selection = $form_ref->getProperty($field["name"])->getValue($this->form);
            $submition_ref = new ReflectionClass('Submition');
            $value = $submition_ref->getProperty($field["name"])->getValue($this->submition);
            
            if($selection == 1)
                continue;
            $html .= "<div class='field'>";
            $html .= "<label title='" . $field["title"] . "' for='" . $field["name"] . "'>" . $field["label"] . ":</label>";
            
            switch (strtolower($field["type"])) {
                case "text":
                case "email":
                case "phone":
                case "password":
                    $html .= "<input type='" . $field["type"] . "' name='" . $field["name"] . "' " 
                        . ($selection==3?"required":"") 
                        . " value='" . $value . "'"
                        . " />";
                    break;
                case "textarea":
                    $html .= "<textarea name='" . $field["name"] . "' " . ($selection==3?"required":"") 
                        . ">" . $value . "</textarea>";
                    break;
            }
            
            $html .= "</div>";
        }
        return $html;
    }
    
}
