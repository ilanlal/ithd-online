<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/menu_control.php';
$base = new Menu_Control(TRUE);
$company_name = $base->company_path;
?>

<nav class="clearfix1">
	<div class="menu-top-line">
		<img src="/views/img/ithd-online.png" alt="A Real free contat us form" title="Home" />
		<div class="menu-top-line-center">
		</div>
		<?php if (isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])): ?>
		<span class="user-info">Hi: <a href="#"><?php echo $_SESSION[Base_Control::SESSION_ADMIN_EMAIL] ?></a></span>
		<?php endif; ?>
	</div>
    <div class="menu">
        <span class="tile green">
            <a href="<?php echo $company_name; ?>/default">    
                <img src="/views/img/home.png" alt="ithd-online home" />
            </a>
        </span>
        <?php if (isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])): ?>
            <div class="tile blue">
                <a href="<?php echo $company_name; ?>/views/admin/entities/account#account">
                    <img src="/views/img/account.png" alt="ithd-online account" />
                </a>
            </div>

            <!--<div class="tile blue">
                <a href="<?php echo $company_name; ?>/admin/administrator#admin">
                    <img src="/views/img/administrator.png" alt="ithd-online administrator" />
                </a>
            </div>-->
            <div class="tile brown">
                <a href="<?php echo $company_name; ?>/views/admin/entities/incident_list#incident">
                    <img src="/views/img/incident.png" alt="ithd-online incident" />
                </a>
            </div>
            <div class="tile brown">
                <a href="<?php echo $company_name; ?>/views/admin/entities/incident_status_list#status">
                    <img src="/views/img/status.png" alt="ithd-online statuses" />
                </a>
            </div>
            <div class="tile brown">
                <a href="<?php echo $company_name; ?>/views/admin/entities/category_list#category">
                    <img src="/views/img/category.png" alt="ithd-online categories" />
                </a>
            </div>
            <div class="tile brown">
                <a href="<?php echo $company_name; ?>/views/admin/entities/landing-page-list#form">
                    <img src="/views/img/forms.png" alt="ithd-online forms" />
                </a>
            </div>
            <div class="tile yellow">
                <a href="<?php echo $company_name; ?>/views/admin/user/disconnect#disconnect">
                    <img src="/views/img/disconnect.png" alt="ithd-online disconnect" />
                </a>
            </div>
        <?php else: ?>
            <div class="tile yellow">
                <a href="<?php echo $company_name; ?>/views/admin/user/login#login">
                    <img src="/views/img/login.png" alt="ithd-online log-in" />
                </a>
            </div>
            <div class="tile yellow">
                <a href="<?php echo $company_name; ?>/views/admin/user/register#register">
                    <img src="/views/img/register.png" alt="ithd-online registration" />
                </a>
            </div>
        <?php endif; ?>

        <div class="tile brown">
            <a href="<?php echo $company_name; ?>/free-contact-us-form">
                <img src="/views/img/free-contact-us.png" alt="ithd-online free contact us forms" />
            </a>
        </div>
        <div class="tile green">
            <a href="<?php echo $company_name; ?>/contact-us">
                <img src="/views/img/help.png" alt="ithd-online help" />
            </a>
        </div>
        <div class="tile green">
            <a href="<?php echo $company_name; ?>/terms-of-service">
                <img src="/views/img/terams.png" alt="ithd-online terms of service" />
            </a>
        </div>
    </div>
</nav>