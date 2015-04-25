<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/base_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
if (ConfigUtils::ENV == "DEV") {
	Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config_dev.xml');
} else {
	Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/config.xml');
}

abstract class Base_Control {

	CONST SESSION_ADMIN_EMAIL = "login_user";
	CONST SESSION_ADMIN_ID = "login_userid";
	CONST SESSION_CUSTOMER_EMAIL = "login_customer";
	CONST SESSION_CUSTOMER_ID = "login_customerid";
	CONST SESSION_ORGANIZATION_ID = "organizationid";
	CONST SESSION_ORGANIZATION_UNIQUE_NAME = "organization_unique_name";
	CONST GET_COMPANY_PARAM = "company";

	/* @var Base_Logic */
	public $logic;
	/* @var Logger */
	public $log;
	public $admin = FALSE;
	public $company_path = "";
	public $error_message;
	public $success_message;

	public function __construct($admin = FALSE) {
		$this->log = Logger::getLogger(get_called_class());

		register_shutdown_function(array($this, "fatal_handler"));
		$this->admin = $admin;
		if (isset($_SESSION[self::SESSION_ORGANIZATION_UNIQUE_NAME])) {
			$this->company_path .= "/" . $_SESSION[self::SESSION_ORGANIZATION_UNIQUE_NAME];
		}
		$this->logic = $this->get_logic();
	}

	/**
	* @return Base_Logic
	*/
	public abstract function get_logic();
	
	public function get_org_id() {
		if (isset($_SESSION[self::SESSION_ORGANIZATION_ID])) return $_SESSION[self::SESSION_ORGANIZATION_ID];

		return NULL;
	}

	public function get_org_unique_name() {
		if (isset($_SESSION[self::SESSION_ORGANIZATION_UNIQUE_NAME])) return $_SESSION[self::SESSION_ORGANIZATION_UNIQUE_NAME];

		return NULL;
	}

	public function get_current_customer_id() {
		if (isset($_SESSION[self::SESSION_CUSTOMER_ID])) return $_SESSION[self::SESSION_CUSTOMER_ID];

		return NULL;
	}

	function fatal_handler() {
		$e = error_get_last();
		if (!is_null($e)) {
			$this->log->fatal($e);
		}
	}

}
