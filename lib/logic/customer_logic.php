<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/customer_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';



class Customer_Logic extends Base_Logic {
    public $customer_dao;
    
    public function __construct() {
        parent::__construct();
        $this->customer_dao = new Customer_DAO();
    }
    
    public function create_customer($customer) {
        /* @var $customer Customer */
        try {
            $customer->userid = $this->customer_dao->insert($customer);
            return $customer;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function verify_customer($email,$password,$org_unique_name) {
        /* @var $customer Customer */
        try {
            $customer = $this->customer_dao->get_by_email_and_org_unique_name($email,$org_unique_name);
            if($customer == null) {
                return FALSE;
            }
            
            if($customer->password!==$password) {
                return FALSE;
            }
            
            return $customer;
        }
        catch(Exception $exc) {
            parent::error($exc);
            return FALSE;
        }
    }
    
    public function update_customer($customer) {
        /* @var $customer Customer */
        try {
            $this->customer_dao->update($customer);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function get_by_email_and_org_unique_name($email,$organizaion_unique_name) {
        return $this->customer_dao->get_by_email_and_org_unique_name($email,$organizaion_unique_name);
    }
    
    public function reset_password($customer) {
        /* @var $customer Customer */
        
        $reset_code = bin2hex(openssl_random_pseudo_bytes(2));
        $customer->reset_code = $reset_code;
        $this->customer_dao->update($customer);
        $this->send_reset_email($customer);
    }
    
    private function send_reset_email($customer) {
        /* @var $customer Customer */
        $url = ConfigUtils::FullWebHost . "/" . $customer->organization_unique_name . "/views/customer/user/reset-password/" . $customer->reset_code . "#reset/" ;
        $html = "Dear " . $customer->first_name . ",<br /> 
            This email was sent automatically by " . ConfigUtils::ApplicationName . "
            in response to your request to reset your password. 
            This is done for your protection; 
            only you, the recipient of this email can take the next step in the password recovery process<br /><br />";
        
        
        $html .= "To reset your password and access your account, 
            either click or copy and paste the following link
            into the address bar of your browser: <a href='$url'>$url<a><br /><br />
            Thank you <br />," . ConfigUtils::ApplicationName . " Trust Team";
                
        $email = new PHPMailer();
        $email->From = ConfigUtils::MAIL_SENDER;
        $email->FromName = ConfigUtils::ApplicationName;
        $email->Subject = ConfigUtils::ApplicationName . " Reset your password!";
        $email->Body = $html;
        $email->isHTML(true);
        $email->AddAddress($customer->email);

        return $email->Send();
    }
    
    public function get_by_id($id) {
        return $this->customer_dao->get($id);
    }
}


