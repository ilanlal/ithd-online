<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_list_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/category_list_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_status_list_control.php';
include_once $_SERVER['DOCUMENT_ROOT'] . "/views/common/grid_view.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/controls/incident/incident_grid_control.php";

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

$listctl = new IncidentList_Control(TRUE);
$incidentctl = new Incident_Control(TRUE);
$category_list_control = new CategoryList_Control(TRUE);
$incident_status_list_control = new IncidentStatusList_Control(TRUE);

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "save") != NULL) {
        $incidentctl->upsert_incident_on_submit();
        header("Location: " . $incidentctl->company_path . "/views/admin/entities/incident_list#incident", true);
        die;
    }

    if (filter_input(INPUT_POST, "delete") != NULL) {
        $incidentctl->delete_row();
        header("Location: " . $incidentctl->company_path . "/views/admin/entities/incident_list#incident", true);
        die;
    }
}

$grid_control = new IncidentGrid_Control();
		
$grid = new GridView($grid_control,"standart");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="msvalidate.01" content="07C0053E19D8FC40FFF0BF909FB72C02" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="keywords" content="forms,forms generator,real free,free form,contact us
              ,free site,free page,freep,free contact us,iln software" />
        <meta name="description" 
              content="A real free contact form for your website with integrated anti-spam protection!
              ,get it now for free" />
        <title><?php echo ConfigUtils::ApplicationName ?> - Tickets</title>
		<script src="/views/scripts/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="/views/scripts/incident.js" type="text/javascript"></script>
        <script src="/views/scripts/grid.js" type="text/javascript"></script>
        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article id="incident">
            <section>
                <div class="error">
                    <?php if ($incidentctl->error_message != null && $incidentctl->error_message != ""): ?>
                        <legend>Error:</legend>
                        <p><?php echo $incidentctl->error_message ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <section>
                <h1>Tickets</h1>
			</section>
			<section>
					<?php $grid->render(); ?>
            </section>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>