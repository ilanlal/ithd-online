<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/user_dao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';



class User_Logic extends Base_Logic {
    public $user_dao;
    
    public function __construct() {
        parent::__construct();
        $this->user_dao = new User_DAO();
    }
    
    public function create_user($user) {
        /* @var $user User */
        try {
            $user->userid = $this->user_dao->insert($user);
            return $user;
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function verify_user($email,$password) {
        /* @var $user User */
        try {
            $user = $this->get_user_by_email($email);
            if($user == null) {
                return FALSE;
            }
            
            if($user->password!==$password) {
                return FALSE;
            }
            
            return $user;
        }
        catch(Exception $exc) {
            parent::error($exc);
            return FALSE;
        }
    }
    
    public function update_user($user) {
        /* @var $user User */
        try {
            $this->user_dao->update($user);
        }
        catch(Exception $exc) {
            parent::error($exc);
            throw $exc;
        }
    }
    
    public function get_user_by_email($email) {
        return $this->user_dao->get_by_email($email);
    }
    
    public function get_user_by_email_and_company($email,$company) {
        return $this->user_dao->get_by_email_and_company($email,$company);
    }
    
    public function reset_password($email) {
        $users = $this->user_dao->get_all_by_email($email);
        $reset_code = bin2hex(openssl_random_pseudo_bytes(2));
        $companies = [];
        foreach ($users as $user) {
            /* @var $user User */
            $user->reset_code = $reset_code;
            $companies[] = $user->organization_unique_name;
            $this->user_dao->update($user);
            
        }
        
        $this->send_reset_email($email,$reset_code,$companies);
    }
    
    private function send_reset_email($email_address,$reset_code,$companies) {
        $company_html = "<ul>";
        foreach ($companies as $company) {
            $company_html .= "<li>$company</li>";
        }
        $company_html .= "</ul>";
        
        $url = ConfigUtils::FullWebHost . "/views/admin/user/reset-password/$reset_code#reset/" ;
        $html = "Dear $email_address <br /> 
            This email was sent automatically by " . ConfigUtils::ApplicationName . "
            in response to your request to reset your password. 
            This is done for your protection; 
            only you, the recipient of this email can take the next step in the password recovery process<br /><br />";
        
        $html .= "Your company information:<br />" . $company_html . "<br /><br />";
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
        $email->AddAddress($email_address);

        return $email->Send();
    }
    
    public function get_by_id($id) {
        return $this->user_dao->get($id);
    }
}


