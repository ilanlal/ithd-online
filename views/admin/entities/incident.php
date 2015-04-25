<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/category_grid_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_status_grid_control.php';

$incident_ctl = new Incident_Control(TRUE);

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
	header("Location: " . $incident_ctl->company_path . "/views/admin/user/login#login");
}

$category_list_control = new Category_Grid_Control(TRUE);
$incident_status_list_control = new IncidentStatus_Grid_Control(TRUE);
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="msvalidate.01" content="07C0053E19D8FC40FFF0BF909FB72C02" />
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <title><?php echo ConfigUtils::ApplicationName ?> - Ticket</title>
		<script src="/views/scripts/incident.js" type="text/javascript"></script>
        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
        
    </head>
    <body>
         <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <form action="<?php echo filter_input(INPUT_GET, "id") . "#incident"; ?>" method="post">
                <section class="section-error">
                    <label name="error"><?php echo $incident_ctl->error_message; ?></label>
                </section>
                
                <section class="success">
                    <label><?php echo $incident_ctl->success_message; ?></label>
                </section>
                <section class="section-login" id="incident">
                    <fieldset>
                        <legend>Incident Information:</legend>
                        <div class="field">
                            <label title="Ticket main subject" for="title">Title:</label>
                            <input type="text" name="title" value="<?php echo $incident_ctl->item->title ?>" required 
                                   title="Please enter the ticket title here"/>
                        </div>
                        <div class="field">
                            <label title="Ticket category" for="categoryid">Category:</label>
                            <select name="categoryid">
                                <?php foreach ($category_list_control->items as $category): ?>
                                    <option value="<?php echo $category->categoryid ?>"
                                    <?php
                                    if ($incident_ctl->item->categoryid == $category->categoryid) 
                                        {echo " selected ";} ?>
                                            ><?php echo $category->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <label title="Ticket status" for="incident_statusid">Status:</label>
                                <select name="incident_statusid">
                                <?php foreach ($incident_status_list_control->items as $status): ?>
                                    <option value="<?php echo $status->incident_statusid ?>"
                                            <?php if($incident_ctl->item->incident_statusid == $status->incident_statusid) 
                                                {echo " selected ";} ?>
                                            ><?php echo $status->status_name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        <div class="field">
                            <label title="Ticket description" for="description">Description:</label>
                            <textarea name="description"><?php echo $incident_ctl->item->description ?></textarea>
                        </div>
                        
                    </fieldset>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="hidden" name="id" value="<?php echo $incident_ctl->item->ticketnumber;  ?>" />
                        <input type="submit" name="submit" value="Save" />
                    </div>
                </section>
                
            </form>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
