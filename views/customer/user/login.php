<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/customer/customer_control.php';
if (isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/customer/entities/incident_list#incident");
    die;
}
$customer_control = new Customer_Control();

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $customer_control->login();
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
        <title>ITHD-Online - Login Page</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>

    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu_customer.php'; ?>
        </header>
        <article>
            <form action="login#login" method="post">
                <section class="error">
                    <?php echo $customer_control->error_message; ?>
                </section>
                <section class="section-login" id="login">
                    <div class="div-3"></div>
                    <div class="div-3">
                        <fieldset>
                            <legend>Login Information:</legend>
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
                                <label 
                                    title="Email Address" 
                                    for="email">Email Address:</label>
                                <input 
                                    type="text" 
                                    name="email"
                                    value="" 
                                    placeholder="mail@domain.com" 
                                    required />
                            </div>
                            <div class="field">
                                <label 
                                    title="Password" 
                                    for="password">Password:</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    value="" 
                                    required />
                            </div>
                            <a href="<?php echo $base->company_path ?>/views/customer/user/forgat-password#forgat">Forgot Password?</a>
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
