<?php
class ConfigUtils {
    /****** DEV **********/
    
    const FullWebHost  = "http://www.ithd-online.local:8080";
    const WebHost  = "www.ithd-online.local:8080";
    const Host     = "localhost"; // Hostname of our MySQL server. 
    const Database = "ithd-online-db"; // Logical database name on that server.
    const User     = "root"; // User and Password for login.
    const Password = "";
    const ENV = "DEV";
    
    /**********************************************************/
    
    /******* PROD **************/
    /*
    const ENV = "PROD";
    const FullWebHost  = "http://www.ithd-online.com";
    const WebHost  = "www.ithd-online.com";
    const Host     = "localhost"; // Hostname of our MySQL server. 
    const Database = "ilanlal_ithd-online-db"; // Logical database name on that server.
    const User     = "ilanlal_admin"; // User and Password for login.
    const Password = "_DLv!yZWvC]t";
    */
    /**************************************************************/
    const DYNAMIC_SELECT_DEFAULT_ROW_LIMIT = 250;
    const MAIL_SENDER = "admin@ithd-onlie.com";
    const MAIL_SUPPORT = "support@ithd-onlie.com";
    const MAIL_ADMIN = "admin@ithd-onlie.com";
    const ky = 'lkirwf897+22#bbtrm8814z5qq=498j5'; // 32 * 8 = 256 bit key
    const iv = '741952hheeyy66#cs!9hjv887mxx7@8y'; // 32 * 8 = 256 bit iv
    const ClientID = "70938211407-6j6noemnkmrnj4cpuufhhjr9ckaru8nr.apps.googleusercontent.com";
    const ClientSecret = "A72JMpVZcIX-TbOZhVAUBDF2";
    const ApplicationName = "ITHD-Online.com";
    const ACTIVATION_FILE_FOLDER = "activation_file_folder";
    
    
    function __construct() {
    }
}
