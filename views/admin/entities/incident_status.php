<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_status_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_status_list_control.php';

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

$listctl = new IncidentStatusList_Control(TRUE);
$statusctl = new IncidentStatus_Control($listctl->last_index);

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "save") != NULL) {
        $statusctl->upsert_status_on_submit();
        $base = new Base_Control();
        header("Location: " . $base->company_path . "/views/admin/entities/incident_status#status", true);
        die;
    }

    if (filter_input(INPUT_POST, "delete") != NULL) {
        $statusctl->delete_row();
        $base = new Base_Control();
//        header("Location: " . $base->company_path . "/views/admin/entitiesincident_status#status", true);
        die;
    }


    if (filter_input(INPUT_POST, "up") != NULL) {
        $statusctl->up();
        $base = new Base_Control();
        header("Location: " . $base->company_path . "/views/admin/entities/incident_status#status", true);
        die;
    }

    if (filter_input(INPUT_POST, "down") != NULL) {
        $statusctl->down();
        $base = new Base_Control();
        header("Location: " . $base->company_path . "/views/admin/entities/incident_status#status", true);
        die;
    }
}
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Statuses</title>
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
                    <?php if ($statusctl->error_message != null && $statusctl->error_message != ""): ?>
                        <legend>Error:</legend>
                        <p><?php echo $statusctl->error_message ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <section>
                <h1>Incident Status!</h1>
                <div class="grid">

                    <div class="grid-body">
                        <div class="grid-header-row">
                            <div class="grid-header-col">
                                <span>Name</span>
                            </div>
                            
                        </div>
                        <?php foreach ($listctl->statuses as $status): ?>
                            <form class="grid-row" action="incident_status#status" method="post">
                                <input type="hidden" 
                                       name="dirty" value="0" 
                                       onchange="setRowDirty(this)" />
                                <input type="hidden" name="id" 
                                       value="<?php echo $status->incident_statusid ?>" />

                                <input type="hidden" name="index" 
                                       value="<?php echo $status->index ?>" />

                                <div class="grid-cell">
                                    <label>Status Name:</label>
                                    <span>
                                        <input type="text" 
                                               name="status_name" 
                                               placeholder="<?php echo $status->status_name ?>" 
                                               value="<?php echo $status->status_name ?>" 
                                               onkeyup="onCellChange(this)" 
                                               required />
                                    </span>
                                </div>
                                <div class="grid-cell row-button-group">
                                    <input 
                                        type="submit" 
                                        name="up" 
                                        value="up" 
                                        title="Move Up">
                                    <input 
                                        type="submit" 
                                        name="down" 
                                        value="down" 
                                        title="Move Down">
                                    <input 
                                        type="submit" 
                                        name="save" 
                                        value="save" 
                                        title="Save Record" 
                                        class="unsave">
                                    <input 
                                        type="submit" 
                                        name="delete" 
                                        value="delete" 
                                        title="Delete Record" 
                                        onclick="confirmDelete(this)">
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>

                    <div>
                        <form class="grid-row" action="incident_status#status" method="post">
                            <input type="hidden" name="id" 
                                   value="" />

                            <input type="hidden" name="index" 
                                   value="" />

                            <div class="grid-cell">
                                <input type="text" name="status_name" value="" required placeholder="New Status" />
                            </div>
                            <div class="grid-cell">
                                <input type="submit" name="save" value="Add">
                            </div>
                    </div>
                    </form>
                </div>
                </div>
            </section>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>