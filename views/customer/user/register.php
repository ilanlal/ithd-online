<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/customer/customer_control.php';

$customer_control = new Customer_Control();
$company = filter_input(INPUT_GET, Base_Control::GET_COMPANY_PARAM);

if ($company === NULL) {
    $customer_control->error_message = "Can't complete the registration, no company paramter!";
}

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && $company !== NULL) {
    $customer_control->register($company);
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
        <title>ITHD-Online - Registration Page</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>

    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu_customer.php'; ?>
        </header>
        <article>
            <form action="register#register" method="post">
                <section class="error">
                    <?php echo $customer_control->error_message; ?>
                </section>
                <section class="success">
                    <?php echo $customer_control->success_message; ?>
                </section>
                <section class="section-login" id="register">
                    <div class="div-3"></div>
                    <div class="div-3">
                        <fieldset>
                            <legend>Registration Information:</legend>

                            <div class="field">
                                <label title="First Name" for="first_name">First Name:</label>
                                <input type="text" name="first_name" required />
                            </div>
                            <div class="field">
                                <label title="Last Name" for="last_name">Last Name:</label>
                                <input type="text" name="last_name" required />
                            </div>
                            <div class="field">
                                <label title="Email Address" for="email">Email Address:</label>
                                <input type="email" name="email" placeholder="mail@domain.com" required />
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
                                <label title="Telephone Number" for="phone">Phone:</label>
                                <input type="tel" name="phone" />
                            </div>
                            <div class="field">
                                <input type="checkbox" name="terms" required/>
                                <span>I agree to the <a target="_blank" href="/terms-of-service">Terms of Service<a>
                                            </span>
                                
                            </div>
                        </fieldset>
                    </div>
                    <div class="div-3"></div>
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
