<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/contact_us_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/customer/submition_control.php';

$form_type = filter_input(INPUT_GET, "type");
$form_control = new Form_Control($form_type);

$lctl = new Submition_Control($form_control->form,FALSE);
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
                <?php if($form_control->form->logo_url!=null && $form_control->form->logo_url != ''): ?>
                    <img src="<?php echo $form_control->form->logo_url ?>" />
                <?php endif; ?>
            </div>
            <h1>Complete</h1>
        </header>
        <article>
            <section class="section-error">
                <label name="error"><?php echo $form_control->error_message ?></label>
            </section>
            <section>
                <div class="thank-message">
                    <?php echo $form_control->form->thanks_message ?>
                </div>
            </section>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
