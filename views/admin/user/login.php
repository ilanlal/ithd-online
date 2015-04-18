<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/admin_control.php';
if (isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/entities/incident_list#incident");
    die;
}

$actl = new Admin_Control();

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $actl->login();
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Login</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>

    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            
            <form action="login" method="post">
                <section class="error">
                    <?php echo $actl->error_message; ?>
                </section>
                <section class="success">
                    <?php echo $actl->success_message; ?>
                </section>
                <section id="login">
                    <div class="div-3"></div>
                    <div class="div-3">
                        <fieldset>
                            <legend>Login Information:</legend>

                            <div class="field">
                                <label title="Email Address" for="email">Email Address:</label>
                                <input type="text" name="email" value="" placeholder="mail@domain.com" required />
                            </div>
                            <div class="field">
                                <label title="Password" for="password">Password:</label>
                                <input type="password" name="password" value="" required />
                            </div>
                            <a href="/views/admin/user/forgat-password#forgat">Forgot Password?</a>
                        </fieldset>
                    </div>
                    <div class="div-3"></div>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="submit" name="submit" value="Login" />
                    </div>
                </section>
            </form>
            
            
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
