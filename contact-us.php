<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="contact us,question,support,iln software,customer,care,help" />
        <meta name="description" content="Contact ITHD-Online for any question in any time
              ,our team will glad to help you and serve you, We ara here for any question" />
        <title>I.L.N Software - Contact us & question</title>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php';
            if (isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php';
            } else if (isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])){
                include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu_customer.php';
            } else {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php';
            }
            ?>
        </header>
        <article>
            <section class="contact-us">
                <div>
                    <h1>We ara here for any question</h1>
                    <p>You can contact our support team for any question in any time, our team will 
                        glad to help you and serve you, please add your company name for your question</p>
                    <h3>
                        <a href="mailto:support@iln-software.com">support@iln-software.com</a>
                    </h3>
                    <!--<h3>
                        Free from US: <a href="">855-845-6804</a>
                    </h3>
                    <h3>
                        <a href="tel:8558456804">Direct dial (US)</a>
                    </h3>
                    <h3>
                        <a href="">+972-52-611-8067</a>
                    </h3>
                    <h3>
                        <a href="tel:+972526778067">Direct dial (NOT US):</a>
                    </h3>->
                </div>-->
                </div>
            </section>
        </article>
        <aside></aside>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
