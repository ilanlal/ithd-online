<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/customer_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/organization_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class Customer_Control extends Base_Item_Control {
     public $customer_logic;
     public $customer;
     public $error_message;
     public $success_message;
     public $organization_logic;
     
     public function __construct($admin = FALSE) {
         parent::__construct($admin);
         $this->customer_logic = new Customer_Logic();
         $this->organization_logic = new Organization_Logic();
         $this->customer = new Customer();
         $this->load_data();
     }
     
     public function verify_registration_form() {    
         $password1 = filter_input(INPUT_POST,"password1");
         $password2 = filter_input(INPUT_POST,"password2");
         
         if($password1 !== $password2) {
             $this->error_message = "Confirmation password not match the source password!<br />";
             return FALSE;
         }
         
         return TRUE;
     }
     
     public function verify_if_email_and_organization_exist($email,$org_unique_name) {
         
         $customer = $this->customer_logic->get_by_email_and_org_unique_name($email,$org_unique_name);
         if($customer != null) {
             $this->error_message = "The account for address email: '$email' is already exist, please login!<br />";
             return FALSE;
         }
         
         return TRUE;
     }
     
     public function update() {
         if($this->verify_registration_form() !== TRUE) {
             return;
         }
         
         $this->customer->customerid = filter_input(INPUT_POST, "id");
         $this->customer->first_name = filter_input(INPUT_POST, "first_name");
         $this->customer->last_name = filter_input(INPUT_POST, "last_name");
         $this->customer->email = filter_input(INPUT_POST, "email");
         $this->customer->password = filter_input(INPUT_POST, "password");
         $this->customer->phone = filter_input(INPUT_POST, "phone");
         $this->customer->statecode = filter_input(INPUT_POST, "statecode");
         $this->customer->organization_unique_name = filter_input(INPUT_POST, "organization_unique_name");
         
         $this->customer_logic->update_customer($this->customer);
         header("Location: " . $this->company_path . "/views/admin/entities/customer/" . $this->customer->customerid . "#customer");
         die;
     }
     
     public function register($company) {
         $org = $this->organization_logic->get_by_unique_name($company);
         $email = filter_input(INPUT_POST, "email");
         if($org == null) {
             $this->error_message = "Organization not exist!";
             return;
         }
         
         if($this->verify_registration_form() !== TRUE) {
             return;
         }
         
         if($this->verify_if_email_and_organization_exist($email,$company) !== TRUE) {
             return;
         }
         
         $this->customer->first_name = filter_input(INPUT_POST, "first_name");
         $this->customer->last_name = filter_input(INPUT_POST, "last_name");
         $this->customer->email = filter_input(INPUT_POST, "email");
         $this->customer->password = filter_input(INPUT_POST, "password1");
         $this->customer->phone = filter_input(INPUT_POST, "phone");
         
         $this->customer->organization_unique_name = $company;
         $this->customer->statecode = 1;
         
         $this->customer = $this->customer_logic->create_customer($this->customer);
         header("Location: /" . $company . "/views/customer/user/login#login");
     }
     
     
     public function load_data() {
         $this->load_customer();
     }

     public function load_customer() {
         $customer_email = NULL;
         $customerid = NULL;
         
         if($customer_email === NULL) {
            $customerid = filter_input(INPUT_GET,"id");
         }
         if($customerid === NULL || $customerid=="") {
             return;
         }
         
         $this->customer = $this->customer_logic->get_by_id($customerid);
     }
     
     public function recover() {
         if($this->verify_registration_form() !== TRUE) {
             return;
         }
         
         $email = filter_input(INPUT_POST,"email");
         $company = filter_input(INPUT_GET,"company");
         $reset_code = filter_input(INPUT_GET,"id");
         $customer = $this->customer_logic->get_by_email_and_org_unique_name($email, $company);
         if($customer == NULL || $customer->reset_code != $reset_code) {
             $this->error_message = "Email or Company not match!";
             return;
         }
         
         $customer->password = filter_input(INPUT_POST,"password1");
         $this->customer_logic->customer_dao->update($customer);
         header("Location: /" . $company . "/views/customer/user/login#login");
     }
     
     public function forgat_password() {
         $email = filter_input(INPUT_POST, "email");
         $org_name = filter_input(INPUT_POST, "org_unique_name");
         $customer = $this->customer_logic->get_by_email_and_org_unique_name($email,$org_name);
         if($customer==null) {
             $this->error_message = "We can't find information about that account, please verify the email address.";
         }
         else {
             $this->customer_logic->reset_password($customer);
             $this->success_message = "A link to reset your password was send to you email address!";
         }
     }
     
     public function login() {
         $email = filter_input(INPUT_POST, "email");
         $password = filter_input(INPUT_POST, "password");
         $org_unique_name = filter_input(INPUT_POST, "org_unique_name");
         
         $customer = $this->customer_logic->verify_customer($email,$password,$org_unique_name);
         if($customer !== FALSE) {
             $_SESSION[parent::SESSION_CUSTOMER_EMAIL]= $customer->email;
             $_SESSION[parent::SESSION_CUSTOMER_ID]= $customer->customerid;
             $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME] = $customer->organization_unique_name;
             header("Location: /" . $customer->organization_unique_name . "/views/customer/entities/incident_list#incident");
         }
         else {
             $this->error_message = "Bad email or password!<br />";
         }
     }
 }
 