<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . "/views/common/grid_view.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/controls/incident/incident_status_grid_control.php";

$grid_control = new IncidentStatus_Grid_Control(TRUE);

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    header("Location: " . $grid_control->company_path . "/views/admin/user/login#login");
}

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

$grid = new GridView($grid_control,"standart");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="msvalidate.01" content="07C0053E19D8FC40FFF0BF909FB72C02" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo ConfigUtils::ApplicationName ?> - Statuses</title>
		<script src="/views/scripts/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="/views/scripts/incident_status.js" type="text/javascript"></script>
        <script src="/views/scripts/grid.js" type="text/javascript"></script>
        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article id="status">
            <section>
                <div class="error">
                    <?php if ($grid_control->error_message != null && $categoryctl->error_message != ""): ?>
                        <legend>Error:</legend>
                        <p><?php echo $grid_control->error_message ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <section>
                <h1>Statuses</h1>
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