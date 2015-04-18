<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/category_list_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_status_list_control.php';

if (!isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/customer/user/login#login");
}

$incident_ctl = new Incident_Control(FALSE);
$category_list_control = new CategoryList_Control(FALSE);
$incident_status_list_control = new IncidentStatusList_Control(FALSE);

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $incident_ctl->upsert_incident_on_submit();
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
        <title>ITHD-Online - New Ticket Page</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
        
    </head>
    <body>
         <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu_customer.php'; ?>
        </header>
        <article>
            <form action="incident#incident" method="post">
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
                            <input type="text" name="title" value="<?php echo $incident_ctl->incident->title ?>" required 
                                   title="Please enter the ticket title here"/>
                        </div>
                        <div class="field">
                            <label title="Ticket category" for="categoryid">Category:</label>
                            <select name="categoryid">
                                <?php foreach ($category_list_control->categories as $category): ?>
                                    <option value="<?php echo $category->categoryid ?>"
                                    <?php
                                    if ($incident_ctl->incident->categoryid == $category->categoryid) 
                                        {echo " selected ";} ?>
                                            ><?php echo $category->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <label title="Ticket status" for="incident_statusid">Status:</label>
                            <?php if($incident_ctl->incident->incident_statusid != NULL): ?>
                            <input type="hidden" name="incident_statusid" value="<?php echo $incident_ctl->incident->incident_statusid; ?>" />
                            <?php elseif(sizeof($incident_status_list_control->statuses)>0): ?>
                            <input type="hidden" name="incident_statusid" value="<?php echo $incident_status_list_control->statuses[0]; ?>" />
                            <?php else: ?>
                            <input type="hidden" name="incident_statusid" value="" />
                            <?php endif; ?>
                            <select name="incident_statusid" disabled>
                                <?php foreach ($incident_status_list_control->statuses as $status): ?>
                                    <option value="<?php echo $status->incident_statusid ?>"
                                            <?php if($incident_ctl->incident->incident_statusid == $status->incident_statusid) 
                                                {echo " selected ";} ?>
                                            ><?php echo $status->status_name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        <div class="field">
                            <label title="Ticket description" for="description">Description:</label>
                            <textarea name="description"><?php echo $incident_ctl->incident->description ?></textarea>
                        </div>
                        
                    </fieldset>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="hidden" name="ticketnumber" value="<?php echo $incident_ctl->incident->ticketnumber;  ?>" />
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
