<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_list_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/category_list_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_status_list_control.php';

if (!isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/customer/user/login#login");
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}


$listctl = new IncidentList_Control(FALSE);
$incidentctl = new Incident_Control(FALSE);
$category_list_control = new CategoryList_Control(FALSE);
$incident_status_list_control = new IncidentStatusList_Control(FALSE);

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "save_x") != NULL) {
        $incidentctl->upsert_incident_on_submit();
        header("Location: " . $incidentctl->company_path . "/views/customer/entities/incident_list#incident", true);
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
        <title>ITHD-Online - Incidents Page</title>
        <script src="../scripts/incident.js" type="text/javascript"></script>
        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu_customer.php'; ?>
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
                <div class="grid">
                    <div class="grid-buttons">
                        <a href="<?php echo $incidentctl->company_path ?>/views/customer/entities/incident#incident" target="_blank">New Ticket</a>
                    </div>
                    <div class="grid-body">
                        <div class="grid-header-row">
                            <div class="grid-header-col">
                                <span>Title</span>
                            </div>
                            <div class="grid-header-col">
                                <span>Description</span>
                            </div>
                            <div class="grid-header-col">
                                <span>Category</span>
                            </div>
                            <div class="grid-header-col">
                                <span>Status</span>
                            </div>
                        </div>

                        <?php foreach ($listctl->incidents as $incident): ?>
                            <form class="grid-row" action="incident_list.php?#incident" method="post">
                                <input 
                                    type="hidden" 
                                    name="ticketnumber" 
                                    value="<?php echo $incident->ticketnumber ?>" />

                                <div class="grid-cell">
                                    <label>Title:</label>
                                    <span>
                                        <input 
                                            type="text" 
                                            name="title" 
                                            value="<?php echo $incident->title ?>" 
                                            readonly />
                                    </span>
                                </div>

                                <div class="grid-cell">
                                    <label>Description:</label>
                                    <span>
                                        <input 
                                            type="text" 
                                            name="description" 
                                            value="<?php echo $incident->description ?>" 
                                            readonly />
                                    </span>
                                </div>

                                <div class="grid-cell">
                                    <label>Category:</label>
                                    <span>
                                        <input 
                                            type="hidden" 
                                            name="categoryid" 
                                            value="<?php echo $incident->categoryid ?>" />
                                        <select 
                                            name="categoryid" 
                                            disabled>
                                                <?php foreach ($category_list_control->categories as $category): ?>
                                                <option value="<?php echo $category->categoryid ?>"
                                                <?php
                                                if ($incident->categoryid == $category->categoryid) {
                                                    echo " selected ";
                                                }
                                                ?>
                                                        ><?php echo $category->title ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </span>
                                </div>
                                <div class="grid-cell">
                                    <label>Status:</label>
                                    <span>
                                        <input 
                                            type="hidden" 
                                            name="incident_statusid" 
                                            value="<?php echo $incident->incident_statusid ?>" />
                                        <select 
                                            name="incident_statusid" 
                                            disabled>
                                                <?php foreach ($incident_status_list_control->statuses as $status): ?>
                                                <option value="<?php echo $status->incident_statusid ?>"
                                                <?php
                                                if ($incident->incident_statusid == $status->incident_statusid) {
                                                    echo " selected ";
                                                }
                                                ?>
                                                        ><?php echo $status->status_name ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </span>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>