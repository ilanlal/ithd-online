<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/admin_control.php';

$actl = new Admin_Control();

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $actl->register();
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Registration</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>

    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <form action="register#register" method="post">
                <h1>Sign In</h1>
                <section class="error">
                    <?php echo $actl->error_message; ?>
                </section>
                <section><a href="/views/admin/user/login#login">I'm an existing user</a></section>
                <section class="section-login" id="register">
                    
                    <div>
                        <fieldset>
                            <legend>Company Information:</legend>
                            <div class="field">
                                <label title="Company Name" for="company">Company Name:</label>
                                <input type="text" name="company" required />
                            </div>
                            <!--<div class="field">
                                <label title="Company contact name" for="contact_name">Contact Name:</label>
                                <input type="text" name="contact_name" value="" disabled />
                            </div>
                            <div class="field">
                                <label title="Company logo url" for="logo_url">Company Logo (url):</label>
                                <input type="text" name="logo_url"  disabled />
                            </div>
                            <div class="field">
                                <label title="Company default language" for="default_lang">Company Language:</label>
                                <input type="text" name="default_lang" value="English" disabled />
                            </div>-->
                        </fieldset>
                    </div>
                    <div>
                        <fieldset>
                            <legend>Administrator Account Information:</legend>
                            <div class="field">
                                <label title="Email Address" for="email">Email Address:</label>
                                <input type="email" name="email" placeholder="email@domain.com" required />
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
                                <label title="Confirm Password" for="password2">Confirm Password:</label>
                                <input type="password" pattern=".{6,}" name="password2" value="" required 
                                       title="Please enter the same Password as above"
                                       onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
                            </div>
                            <div class="field">
                                <input type="checkbox" name="terms" required/>
                                <span>I agree to the <a target="_blank" href="/terms-of-service">Terms of Service<a>
                                            </span>
                                
                            </div>
                        </fieldset>
                    </div>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="submit" name="submit" value="Submit" />
                    </div>
                </section>
            </form>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
