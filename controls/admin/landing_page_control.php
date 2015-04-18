<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/data_models.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/form_logic.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/form_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/form_control.php';

class LandingPage_Control extends Form_Control {
    public function __construct() {
        parent::__construct(FormTypes::LendingPage);
    }
}
