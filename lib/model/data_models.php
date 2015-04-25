<?php
abstract class Base_DataModel {}

class Incident extends Base_DataModel {
    public $ticketnumber, $title, $description,$createdon, $statecode,
        $incident_statusid, $categoryid,$customerid,$organization_unique_name;
    
    /* View customer parameters */
    public $first_name,$last_name;
}

class Category extends Base_DataModel {
    public $categoryid,$title,$organization_unique_name,$index;
}

class IncidentStatus extends Base_DataModel {
    public $incident_statusid,$status_name,$organization_unique_name,$index;
}

class Organization extends Base_DataModel {
    public $organizationid, $organization_name, $statecode,$createdon,$unique_name;
}

class User extends Base_DataModel {
    public $userid,$organization_unique_name,$email, $password, $statecode,$createdon,$reset_code;
}

class Customer extends Base_DataModel {
    public $customerid,$organization_unique_name,$first_name,$last_name,$email
            ,$password,$phone, $statecode,$createdon,$reset_code;
}

class Form extends Base_DataModel {
    public $formid
            ,$user_email
            ,$email
            ,$first_name
            ,$middle_name
            ,$last_name
            ,$company_name
            ,$title
            ,$description
            ,$phone1
            ,$phone2
            ,$fax1
            ,$fax2
            ,$logo_url
            ,$strong_id
            ,$free_title
            ,$background_color
            ,$color
            ,$font_family
            ,$font_size
            ,$thanks_message
            ,$submit_xml
            ,$submit_json
            ,$form_name
            ,$organization_unique_name
            ,$form_type;
}

class Submition extends Base_DataModel {
    public $submitionid
            ,$email
            ,$first_name
            ,$middle_name
            ,$last_name
            ,$company_name
            ,$title
            ,$description
            ,$phone1
            ,$phone2
            ,$fax1
            ,$fax2
            ,$createdon
            ,$category
            ,$type
            ,$item
            ,$send_to;
}

