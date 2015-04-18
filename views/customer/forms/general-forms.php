<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';

$vercode_session_uniquename = "vercode_contact_us";
if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/contact_us_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/customer/submition_control.php';

$form_type = filter_input(INPUT_GET, "type");

$form_control = new Form_Control($form_type);
$submition_control = new Submition_Control($form_control->form,FALSE);
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "vercode") != $_SESSION[$vercode_session_uniquename] || $_SESSION[$vercode_session_uniquename] == '') {
        $submition_control->error_message = 'Incorrect verification code.';
        $submition_control->load_data_to_object();
    } else {
        $submition_control->submit_form();
        header("Location: /views/customer/forms/thanks/" . filter_input(INPUT_GET, "type") . "/".  filter_input(INPUT_GET, "sid"));
        die;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
        <title><?php echo ConfigUtils::ApplicationName ?></title>
        <style>
            body {
                background-color: <?php echo $form_control->form->background_color ?>;
                color: <?php echo $form_control->form->color ?>;
                font-family: <?php echo $form_control->form->font_family ?>;
                font-size: <?php echo $form_control->form->font_size ?>;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="logo">
                <?php if ($form_control->form->logo_url != null): ?>
                    <img src="<?php echo $form_control->form->logo_url ?>" />
                <?php endif; ?>
            </div>
            <h1>
                    <?php echo $form_control->form->free_title ?>
                
             </h1>
        </header>
        <article>
            <section>
                <div class="error">
                    <?php if ($submition_control->error_message != null && $submition_control->error_message != ""): ?>
                        <legend>Error:</legend>
                        <p><?php echo $submition_control->error_message ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <form action="/views/customer/forms/general-forms/<?php echo filter_input(INPUT_GET, "type") ?>/<?php echo filter_input(INPUT_GET, "sid") ?>" method="post">
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
