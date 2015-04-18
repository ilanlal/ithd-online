<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/contact_us_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/incident_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

$cumctl = new ContactUs_Control();

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "vercode") != $_SESSION["vercode"] OR $_SESSION["vercode"] == '') {
        $cumctl->error_message = 'Incorrect verification code.';
    } else {
        $cumctl->upsert_data_on_submit();
        //header("Location: " . $cumctl->company_path . "/administrator#admin/" . $cumctl->contact_us_manager->strong_id, true);
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Administrator</title>
        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body onload="showLogo()">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article id="admin">
            <form action="administrator.php?#admin" method="post">
                <section>
                    <div class="error">
                        <?php if ($cumctl->error_message != null && $cumctl->error_message != ""): ?>
                            <legend>Error:</legend>
                            <p><?php echo $cumctl->error_message ?></p>
                        <?php endif; ?>
                    </div>
                </section>
                <section>
                    
                </section>
                <section>
                    <div>
                        <fieldset>
                            <!--<legend>Tickets:</legend>
                            <div class="field">
                                <label title="Choose E-mail address to receive content forms" 
                                       for="user_email">E-mail address to receive data</label>
                                <input type="email" placeholder="email@domain.com"
                                       name="user_email" value="<?php echo $cumctl->contact_us_manager->user_email ?>" 
                                       required />
                            </div>-->
                        </fieldset>
                    </div>
                </section>
                <div>
                    <div class="form-top-buttons">
                        <input type="submit" name="submit" value="Save" />
                    </div>
                </div>
            </form>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>