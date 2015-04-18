<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/customer/customer_control.php';

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

$customer_control = new Customer_Control(TRUE);
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Customer</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>

    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <form action="customer#customr?id=<?php echo $customer_control->customer->customerid; ?>" method="post">
                <section class="section-error">
                    <label name="error"><?php echo $customer_control->error_message; ?></label>
                </section>

                <section class="success">
                    <label><?php echo $customer_control->success_message; ?></label>
                </section>
                <section class="section-login" id="account">
                    <div class="div-2">
                        <fieldset>
                            <legend>Customer Information:</legend>
                            <div class="field">
                                <label 
                                    title="First Name" 
                                    for="first_name">First Name:</label>
                                <input 
                                    type="text" 
                                    name="first_name" 
                                    value="<?php echo $customer_control->customer->first_name; ?>"
                                    required />
                            </div>
                            
                            <div class="field">
                                <label 
                                    title="Last Name" 
                                    for="last_name">Last Name:</label>
                                <input 
                                    type="text" 
                                    name="last_name" 
                                    value="<?php echo $customer_control->customer->last_name; ?>"
                                    required />
                            </div>
                            
                            <div class="field">
                                <label 
                                    title="Email Address" 
                                    for="last_name">Email:</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="<?php echo $customer_control->customer->email; ?>"
                                    required />
                            </div>
                            
                            <div class="field">
                                <label 
                                    title="Password" 
                                    for="password">Password:</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    value="<?php echo $customer_control->customer->password; ?>"
                                    required />
                            </div>
                            
                            <div class="field">
                                <label 
                                    title="Telephone" 
                                    for="phone">Phone:</label>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    value="<?php echo $customer_control->customer->phone; ?>"
                                     />
                            </div>
                        </fieldset>
                    </div>
                    <div class="div-2">
                        <fieldset>
                            <legend>General Information:</legend>
                            <div class="field">
                                <label 
                                    title="State" 
                                    for="state">State:</label>
                                <input 
                                    type="hidden" 
                                    name="statecode" 
                                    value="<?php echo $customer_control->customer->statecode; ?>" />
                                <select disabled name="statecode">
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                            <div class="field">
                                <label 
                                    title="Created Date" 
                                    for="createdon">Created On:</label>
                                <input 
                                    type="datetime" 
                                    name="createdon" 
                                    value="<?php echo $customer_control->customer->createdon; ?>"
                                    disabled
                                     />
                            </div>
                        </fieldset>
                    </div>
                </section>
                <section class="section-submit">
                    <div class="form-top-buttons">
                        <input type="hidden" name="id" value="<?php echo $customer_control->customer->customerid; ?>" />
                        <input type="hidden" name="organization_unique_name" value="<?php echo $customer_control->customer->organization_unique_name; ?>" />
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
