<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/admin_control.php';

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

$actl = new Admin_Control();
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $actl->update();
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Account</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>

    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <form action="account#account" method="post">
                <section class="section-error">
                    <label name="error"><?php echo $actl->error_message; ?></label>
                </section>

                <section class="success">
                    <label><?php echo $actl->success_message; ?></label>
                </section>
                <section class="section-login" id="account">
                    <div class="div-2">
                        <fieldset>
                            <legend>Account Information:</legend>
                            <div class="field">
                                <label title="Company Name" for="company">Company Name:</label>
                                <input type="text" name="company" 
                                       value="<?php echo $actl->organization->name ? $actl->organization->organization_name : ' '; ?>"
                                       required />
                            </div>
                            <div class="field">
                                <label title="Email Address" for="email">Email Address:</label>
                                <input type="email" name="email" 
                                       value="<?php echo $actl->user->email ? $actl->user->email : ' '; ?>"
                                       placeholder="address@domain.com" required />
                            </div>
                            <div class="field">
                                <label title="Password" for="password1">Password:</label>
                                <input type="password" pattern=".{6,}" name="password1" 
                                       onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                                               if (this.checkValidity())
                                                   form.password2.pattern = this.value;"
                                       title="Password must contain at least 6 characters"
                                       value="" required />
                            </div>
                            <div class="field">
                                <label title="Password Confirmation" for="password2">Password Confirmation:</label>
                                <input type="password" pattern=".{6,}" name="password2" value="" required 
                                       title="Please enter the same Password as above"
                                       onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
                            </div>
                        </fieldset>
                    </div>
                    <div class="div-2">
                        <fieldset>
                            <legend>General Information:</legend>
                            <div class="field">
                                <label title="Customer url" for="customer_url">Customer Portal:</label>
                                <a href="<?php 
                                       echo "http://" . ConfigUtils::WebHost . $actl->company_path . "/views/customer/user/login#login";
                                       ?>" target="_blank"><?php 
                                       echo "http://" . ConfigUtils::WebHost . $actl->company_path . "/views/customer/user/login#login";
                                       ?></a>
                            </div>
                            <div class="field">
                                <label title="Company Unique Name" for="company_unique_name">Company Unique Name:</label>
                                <input type="text" name="company_unique_name" 
                                       value="<?php echo $actl->user->organization_unique_name; ?>"
                                       disabled />
                            </div>
                        </fieldset>
                    </div>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="hidden" name="id" value="<?php echo $actl->user->userid; ?>" />
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
