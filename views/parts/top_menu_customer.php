<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
$base = new Base_Control(FALSE);
$company_name = $base->company_path;
?>

<nav class="clearfix1">
    <div class="logo">
        <img src="/views/img/ithd-online.png" alt="A Real free contat us form" title="Home" />
    </div>
    <div class="menu">

        <?php if (isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])): ?>
            <div class="tile blue">
                <a href="<?php echo $company_name; ?>/views/customer/entities/account#account">
                    <img src="/views/img/account.png" alt="ithd-online account" />
                </a>
            </div>
            <div class="tile brown">
                <a href="<?php echo $company_name; ?>/views/customer/entities/incident_list#incident">
                    <img src="/views/img/incident.png" alt="ithd-online incident" />
                </a>
            </div>
            <div class="tile yellow">
                <a href="<?php echo $company_name; ?>/views/customer/user/disconnect#disconnect">
                    <img src="/views/img/disconnect.png" alt="ithd-online disconnect" />
                </a>
            </div>
        <?php else: ?>
            <div class="tile yellow">
                <a href="<?php echo $company_name; ?>/views/customer/user/login#login">
                    <img src="/views/img/login.png" alt="ithd-online log-in" />
                </a>
            </div>
            <div class="tile yellow">
                <a href="<?php echo $company_name; ?>/views/customer/user/register#register">
                    <img src="/views/img/register.png" alt="ithd-online registration" />
                </a>
            </div>
        <?php endif; ?>
        <div class="tile green">
            <a href="<?php echo $company_name; ?>/terms-of-service">
                <img src="/views/img/terams.png" alt="ithd-online terms of service" />
            </a>
        </div>
    </div>
</nav>