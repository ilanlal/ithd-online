<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';

$vercode_session_uniquename = "vercode_contact_us";
if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/contact_us_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/customer/submition_control.php';

$cumctl = new ContactUs_Control();
echo $cumctl->form->form_type;
$submition_control = new Submition_Control($cumctl->form);
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "vercode") != $_SESSION[$vercode_session_uniquename] || $_SESSION[$vercode_session_uniquename] == '') {
        $cumctl->error_message = 'Incorrect verification code.';
    } else {
        $submition_control->submit_form();
        header("Location: /views/customer/forms/thanks/" . filter_input(INPUT_GET, "id"));
        die;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/views/style/contact-us.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" media="(min-width: 640px)" href="/views/style/max-640/contact-us.css" />
        <link rel="stylesheet" media="(min-width: 980px)" href="/views/style/max-980/contact-us.css" />
        <title>Contact US</title>
        <style>
            body {
                background-color: <?php echo $cumctl->form->background_color ?>;
                color: <?php echo $cumctl->form->color ?>;
                font-family: <?php echo $cumctl->form->font_family ?>;
                font-size: <?php echo $cumctl->form->font_size ?>;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="logo">
                <?php if ($cumctl->form->logo_url != null): ?>
                    <img src="<?php echo $cumctl->form->logo_url ?>" />
                <?php endif; ?>
            </div>
            <h1>
                    <?php echo $cumctl->form->free_title ?>
                
             </h1>
        </header>
        <article>
            <section>
                <div class="error">
                    <?php if ($cumctl->error_message != null && $cumctl->error_message != ""): ?>
                        <legend>Error:</legend>
                        <p><?php echo $cumctl->error_message ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <form action="/views/customer/forms/contact-us/<?php echo filter_input(INPUT_GET, "id") ?>" method="post">
                <sections>
                    <fieldset>
                        <?php echo $submition_control->generate_html_fields() ?>
                    </fieldset>
                </sections>
                <section class="section-captcha">
                    <fieldset>
                        <legend>Human testing:</legend>
                        <label>Enter Code:</label>
                        <input type="number" name="vercode" required/>
                        <img src="/captcha.php?var=<?php echo $vercode_session_uniquename; ?>"  alt="This is anti spam protection">
                    </fieldset>
                </section>
                <section>
                    <div class="form-top-buttons">
                        <input type="submit" name="submit" value="Send" />
                    </div>
                </section>
            </form>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
