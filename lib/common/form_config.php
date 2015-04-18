<?php

class FormTypes {
    const ContactUS = "ContactUS";
    const LendingPage = "LendingPage";
}

class FormConfiguration extends FormTypes {
    //$CONTACT_US_LIST
    public static $list = [
        self::ContactUS =>
        [["name"=>"email", "label"=>"Email", "title"=>"", "type"=>"email"],
        ["name"=>"first_name", "label"=>"First Name", "title"=>"","type"=>"text"],
        ["name"=>"middle_name", "label"=>"Middle Name", "title"=>"","type"=>"text"],
        ["name"=>"last_name", "label"=>"Last Name", "title"=>"","type"=>"text"],
        ["name"=>"company_name", "label"=>"Company Name", "title"=>"","type"=>"text"],
        ["name"=>"title", "label"=>"Title", "title"=>"","type"=>"text"],
        ["name"=>"description", "label"=>"Description", "title"=>"","type"=>"textarea"],
        ["name"=>"phone1", "label"=>"Home Phone", "title"=>"","type"=>"text"],
        ["name"=>"phone2", "label"=>"Mobile Phone", "title"=>"","type"=>"text"],
        ["name"=>"fax1", "label"=>"Home Fax", "title"=>"","type"=>"text"],
        ["name"=>"fax2", "label"=>"Work Fax", "title"=>"","type"=>"text"],]
    , self::LendingPage=> [
        ["name"=>"email", "label"=>"Email", "title"=>"", "type"=>"email"],
        ["name"=>"first_name", "label"=>"First Name", "title"=>"","type"=>"text"],
        ["name"=>"last_name", "label"=>"Last Name", "title"=>"","type"=>"text"],
        ["name"=>"phone1", "label"=>"Home Phone", "title"=>"","type"=>"text"],
    ]];
    
    public static function get_fields_list($formType) {
        return self::$list[$formType];
    }
}

