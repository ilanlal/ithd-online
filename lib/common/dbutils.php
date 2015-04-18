<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/lib/config.php";

class DBUtils { 
    function __construct() {
    }
    
    function connect() { 
        $mysqli = new mysqli(ConfigUtils::Host, ConfigUtils::User, ConfigUtils::Password, ConfigUtils::Database);
        
        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return null;
        }
        
        return $mysqli;
    }


    function query( $Query_String ) { 
        $mysqli = $this->connect(); 
        if($mysqli == null)
            return;
        if ( ($result = $mysqli->query($Query_String))===false )
        {
          printf("Invalid query: %s\nWhole query: %s\n", $mysqli->error, $Query_String);
          die( "Session halted." ); 
        }
        
        return $result;
    } // end function query 
} // end class Database 
?>