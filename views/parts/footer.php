<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/menu_control.php';
$base = new Menu_Control(TRUE);
$company_name = $base->company_path;
?>

<div>
    <p>Powered by: <a href="http://www.iln-software.com" title="ILN-software Connecting you everywhere">
        <img src="/img/iln_software_16x16.png" alt="ILN-Software connecting you everywhere"/> ILN-software</a>
    | <a href="http://www.iln-software.com/about-us.php" title="ILN-software Connecting you everywhere">Read More About: ILN-software</a>
    | <a href="<?php echo $company_name; ?>/views/admin/user/login#login" title="Administrator Login">Administrator</a>
    | <a href="<?php echo $company_name; ?>/views/customer/user/login#login" title="Customer Login">Customer</a>
    | <a href="/terms-of-service#terms" title="Terms of service">Terms</a>
    | <a href="/contact-us" title="Contact us">Contact us</a>
    
    </p>
</div>
