<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_status_control.php';

$control = new IncidentStatus_Control(TRUE);
if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    header("Location: " . $control->company_path . "/views/admin/user/login#login");
}

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="msvalidate.01" content="07C0053E19D8FC40FFF0BF909FB72C02" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title><?php echo ConfigUtils::ApplicationName ?> - Status</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
        
    </head>
    <body>
         <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <form action="<?php echo filter_input(INPUT_GET, "id"); ?>" method="post">
                <section class="section-error">
                    <label name="error"><?php echo $control->error_message; ?></label>
                </section>
                
                <section class="success">
                    <label><?php echo $control->success_message; ?></label>
                </section>
                <section class="section-login" id="status">
                    <fieldset>
                        <legend>Category Information:</legend>
                        <div class="field">
                            <label title="Status name" for="title">Title:</label>
                            <input type="text" name="title" value="<?php echo $control->item->status_name ?>" required 
                                   title="Please enter the status title here"/>
                        </div>
                       <div class="field">
                            <label title="Status index order" for="index">Index:</label>
                            <input type="number" name="index" value="<?php echo $control->item->index ?>" required 
                                   title="Please enter the status index order here"/>
                        </div>
                    </fieldset>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="hidden" name="id" value="<?php echo $control->item->incident_statusid;  ?>" />
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
