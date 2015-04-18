<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/user_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/organization_logic.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
 
 class Admin_Control extends Base_Control {
     public $user_logic;
     public $user;
     public $error_message;
     public $success_message;
     public $organization_logic;
     public $organization;
     
     public function __construct() {
         parent::__construct(TRUE);
         $this->user_logic = new User_Logic();
         $this->user = new User();
         $this->organization = new Organization();
         $this->organization_logic = new Organization_Logic();
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
     
     public function verify_if_email_exist() {
         $email = filter_input(INPUT_POST,"email");
         $user = $this->user_logic->get_user_by_email($email);
         if($user != null) {
             $this->error_message = "The account for address email: '$email' is already exist, please login!<br />";
             return FALSE;
         }
         
         return TRUE;
     }
     
     public function update() {
         if($this->verify_registration_form() !== TRUE) {
             return;
         }
         $this->organization->organization_name = filter_input(INPUT_POST, "company");
         $this->organization_logic->update_organization($this->organization);
         
         $this->user->userid = filter_input(INPUT_POST, "id");
         $this->user->email = filter_input(INPUT_POST, "email");
         $this->user->password = filter_input(INPUT_POST, "password1");
         
         $this->user = $this->user_logic->update_user($this->user);
         
         header("Location: " . $this->company_path . "/views/admin/entities/account#account");
     }
     
     public function register() {
         if($this->verify_registration_form() !== TRUE) {
             return;
         }
         
         if($this->verify_if_email_exist() !== TRUE) {
             return;
         }
         
         $company_name = filter_input(INPUT_POST, "company");
         $unique_name = str_replace(' ', '-', $company_name); 
         $unique_name = preg_replace('/[^A-Za-z0-9\-]/', '', $unique_name); 
         $unique_name .= bin2hex(openssl_random_pseudo_bytes(2));
         
         $this->organization->organization_name = $company_name;
         $this->organization->unique_name = $unique_name;
         $this->organization->statecode = 1;
         $this->organization = $this->organization_logic->create_organization($this->organization);
         
         $this->user->email = filter_input(INPUT_POST, "email");
         $this->user->password = filter_input(INPUT_POST, "password1");
         $this->user->statecode = 1;
         $this->user->organization_unique_name = $this->organization->unique_name;
         
         $this->user = $this->user_logic->create_user($this->user);
         
         header("Location: /" . $unique_name . "/views/admin/user/login#login");
     }
     
     public function recover() {
         if($this->verify_registration_form() !== TRUE) {
             return;
         }
         
         $email = filter_input(INPUT_POST,"email");
         $company = filter_input(INPUT_POST,"company");
         $reset_code = filter_input(INPUT_GET,"id");
         $user = $this->user_logic->get_user_by_email_and_company($email, $company);
         if($user == NULL || $user->reset_code != $reset_code) {
             $this->error_message = "Email or Company not match!";
             return;
         }
         
         $user->password = filter_input(INPUT_POST,"password1");
         $this->user_logic->user_dao->update($user);
         header("Location: /" . $company . "/views/admin/user/login#login");
     }
     
     public function load_data() {
         $this->load_user();
         $this->load_organization();
         
     }
     
     public function load_organization() {
         if($this->user == null || $this->user->userid == null || $this->user->organization_unique_name==null) {
             return;
         }
         
         $this->organization = $this->organization_logic->get_by_unique_name($this->user->organization_unique_name);
     }

     public function load_user() {
         $userid = NULL;
         $email = NULL;
         
         if(isset($_SESSION[parent::SESSION_ADMIN_EMAIL])) {
             $email = $_SESSION[parent::SESSION_ADMIN_EMAIL];
             $this->user = $this->user_logic->get_user_by_email($email);   
             return;
         }
         
         $userid = filter_input(INPUT_GET,"id");
         
         if($userid === NULL || $userid=="") {
             return;
         }
         
         $this->user = $this->user_logic->get_by_id($userid);
     }
     
     public function forgat_password() {
         $email = filter_input(INPUT_POST, "email");
         $user = $this->user_logic->get_user_by_email($email);
         if($user==null) {
             $this->error_message = "We can't find information about that account, please verify the email address.";
         }
         else {
             $this->user_logic->reset_password($email);
             $this->success_message = "A link to reset your password was send to you email address!";
         }
     }
     
     public function login() {
         $email = filter_input(INPUT_POST, "email");
         $password = filter_input(INPUT_POST, "password");
         $user = $this->user_logic->verify_user($email,$password);
         if($user !== FALSE) {
             $_SESSION[parent::SESSION_ADMIN_EMAIL]= $user->email;
             $_SESSION[parent::SESSION_ADMIN_ID]= $user->userid;
             $_SESSION[parent::SESSION_ORGANIZATION_UNIQUE_NAME] = $user->organization_unique_name;
             
             header("Location: /" . $user->organization_unique_name . "/views/admin/entities/incident_list#incident");
             die;
         }
         else {
             $this->error_message = "Bad email or password!<br />";
         }
     }
 }
 