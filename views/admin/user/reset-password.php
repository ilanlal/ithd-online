<!DOCTYPE html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/admin_control.php';

$actl = new Admin_Control();

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $actl->recover();
}
?>
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Reset Password</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>

    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <form action="/views/admin/user/reset-password/<?php echo filter_input(INPUT_GET,"id") ?>#reset" method="post">
                <h1>Reset Your passwords</h1>
                <section class="error">
                    <?php echo $actl->error_message; ?>
                </section>
                <section class="success">
                    <?php echo $actl->success_message; ?>
                </section>
                <section class="section-login" id="reset">
                    <div class="div-3"></div>
                    <div class="div-3">
                        <fieldset>
                            <legend>Reset Information:</legend>
                             <?php if(filter_input(INPUT_GET, Base_Control::GET_COMPANY_PARAM) === NULL): ?>
                            <div class="field">
                                <label 
                                    title="Company" 
                                    for="org_unique_name">Company ID:</label>
                                <input 
                                    type="text" 
                                    name="org_unique_name" 
                                    value="" 
                                    placeholder="Company Unique Name" 
                                    required />
                            </div>
                            <?php else: ?>
                            <div class="field">
                                <label title="Company" 
                                       for="org_unique_name">Company ID:</label>
                                <input type="text" 
                                       name="org_unique_name" 
                                       value="<?php echo filter_input(INPUT_GET, Base_Control::GET_COMPANY_PARAM) ?>" 
                                       placeholder="Company Unique Name" 
                                       readonly />
                            </div>
                            <?php endif; ?>
                            
                            <div class="field">
                                <label title="You can find it in the recovery email" for="company">Company Name:</label>
                                <input type="text" name="company" required />
                            </div>
                            <div class="field">
                                <label title="Email Address" for="email">Email Address:</label>
                                <input type="email" name="email" placeholder="email@domain.com" required />
                            </div>
                            <div class="field">
                                <label title="Password" for="password1">New Password:</label>
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
                        </fieldset>
                    </div>
                    <div class="div-3"></div>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="submit" name="submit" value="Reset" />
                    </div>
                </section>
            </form>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
