<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
if(ConfigUtils::ENV == "DEV") {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config_dev.xml');
}
else {
    Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config.xml');
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';

class Base_Logic {
    public $log;
    
    public function __construct() {
        $this->log = Logger::getLogger(get_called_class());
    }
    
    public function encrypt($clear_data) {
        $key = ConfigUtils::ky;
        $iv = ConfigUtils::iv;

        $encrypted_data = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $clear_data, MCRYPT_MODE_CBC, $iv);
        $encrypted_data = base64_encode($encrypted_data);

        return $encrypted_data;
    }

    public function decrypt($encrypted_data) {
        $key = ConfigUtils::ky;
        $iv = ConfigUtils::iv;

        $clear_data = base64_decode($encrypted_data);
        $clear_data = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $clear_data, MCRYPT_MODE_CBC, $iv);
        return $clear_data;
        
    }
    
    
    public function fatal($msg, $throwable = null) {
        $this->log->fatal($msg, $throwable);
    }
    
    public function error($msg, $throwable = null) {
        $this->log->error($msg, $throwable);
    }
    
    public function info($msg) {
        $this->log->info($msg);
    }
    
    public function warn($msg) {
        $this->log->warn($msg);
    }
}
