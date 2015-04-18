<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="msvalidate.01" content="07C0053E19D8FC40FFF0BF909FB72C02" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="keywords" 
              content="ithd,ticket,management,incident,case,online,free,service,iln software,saas" />
        <meta name="description" 
              content="A real free online ticket service management with great features and help desk management!
              ,get it now for free" />
        <title>ITHD-Online The Free Ticket Service Management</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <section>
                <h1>ITHD-Online is a online real free Ticket Service management!</h1>
                <div class="content-area">
                    <div class="content-group">
                        <div class="content" onclick="this.className = (this.className == 'content' ? 'content inlarge' : 'content')">
                            <h2>Free Ticket Management:</h2>
                            <h3>Manage all your service ticket on-line for free</h3>
                            <h3>Customize your status and category in your free ticket service system</h3>
                            <h3>Track your ticket on-line from anywhere</h3>
                            <h3>Android Support</h3>
                            <h3>iOS Support</h3>
                            <h3>Windows Mobile Support</h3>
                            <h3>Anti-Spam Protection</h3>
                            <div class="content-button">
                                <a href="http://<?php echo ConfigUtils::WebHost ?>/views/admin/user/register">Start Now!</a>
                            </div>
                        </div>
                        <div class="content" onclick="this.className = (this.className == 'content' ? 'content inlarge' : 'content')">
                            <h2>Free Contact US:</h2>
                            <h3>No registration and no credit card required</h3>
                            <h3>Select filed to show on your free contact us form</h3>
                            <h3>Set your custom logo on the free contact us page</h3>
                            <h3>Select your favourite colors on the free contact us page</h3>
                            <h3>set a custom welcome and success messages in the free contact us page</h3>
                            <h3>Use the free embedded code to integrate the contact us form in your site</h3>
                            <h3>Use the free develop fuiture to integrate your free contact us with your crm</h3>  
                            <div class="content-button">
                                <a href="http://<?php echo ConfigUtils::WebHost ?>/free-contact-us-form">Get for FREE now!</a>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
            <section class="free-content">
                <h2>FREE Ticket Service and customer management tools for small business</h2>
                <p>The first goal of our company is to make a real small and smart SAAS software for a small business used</p>
                <p>The second goal is to reach all the small businesses and publish our softwares as a free softwar.</p>
                <p>
                As a small company we are fully aware about the scopes of services for small and medium business, 
                That is why we publish our Ticket Service management as a FREE SAAS (Software AS A Service). 
                Now each business can use our Free Ticket Service management very easily with no commits and no IT resource,</p>
            </section>
        </article>
        <footer>
            <span>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
            </span>
        </footer>
    </body>
</html>
