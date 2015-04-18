<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/customer/customer_control.php';

if(!isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/customer/user/login#login");
}

$customer_control = new Customer_Control();
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $customer_control->update();
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
        <title>ITHD-Online - Account Page</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
        
    </head>
    <body>
         <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu_customer.php'; ?>
        </header>
        <article>
            <form action="account.php?#account" method="post">
                <section class="section-error">
                    <label name="error"><?php echo $customer_control->error_message; ?></label>
                </section>
                
                <section class="success">
                    <label><?php echo $customer_control->success_message; ?></label>
                </section>
                <section class="section-login" id="account">
                    <fieldset>
                        <legend>Account Information:</legend>
                        
                        
                        <label title="Email Address" for="email">Email Address:</label>
                        <input type="email" name="email" 
                               value="<?php echo $customer_control->customer->email?$customer_control->customer->email:' '; ?>"
                               placeholder="mail@domain.com" readonly />
                        
                        <label title="First Name" for="first_name">First Name:</label>
                        <input type="text" name="first_name" 
                               value="<?php echo $customer_control->customer->first_name; ?>" required />
                        
                        <label title="Last Name" for="last_name">Last Name:</label>
                        <input type="text" name="last_name" 
                               value="<?php echo $customer_control->customer->last_name; ?>" required />

                        <label title="Telephone" for="phone">Telephone:</label>
                        <input type="tel" name="phone" 
                               value="<?php echo $customer_control->customer->phone; ?>" />
                        
                        <label title="Password" for="password1">Password:</label>
                        <input type="password" pattern=".{6,}" name="password1" 
                               onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.password2.pattern = this.value;"
                               title="Password must contain at least 6 characters"
                               value="<?php echo $customer_control->customer->password; ?>" required />
                        
                        <label title="Password Confirmation" for="password2">Password Confirmation:</label>
                        <input type="password" pattern=".{6,}" name="password2" value="" required 
                               title="Please enter the same Password as above"
                               onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
                    </fieldset>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="hidden" name="id" value="<?php echo $customer_control->customer->customerid;  ?>" />
                        <input type="submit" name="submit" value="Update" />
                    </div>
                </section>
                
            </form>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
