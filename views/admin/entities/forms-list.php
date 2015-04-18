<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/form_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/form_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/forms_list_control.php';

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

$listctl = new FormsList_Control(TRUE);
$form_control = new Form_Control(TRUE);


if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "save") != NULL) {
        $form_control->upsert_data_on_submit();
        header("Location: " . $form_control->company_path . "/views/admin/forms-list#forms", true);
        die;
    }

    if (filter_input(INPUT_POST, "delete") != NULL) {
        $form_control->delete_row();
        header("Location: " . $form_control->company_path . "/views/admin/forms-list#forms", true);
        die;
    }
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Forms</title>
        <script src="/views/scripts/forms.js" type="text/javascript"></script>
        <script src="/views/scripts/grid.js" type="text/javascript"></script>
        <script src="/views/scripts/jquery-1.11.2.min.js" type="text/javascript"></script>
        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article id="form">
            <section>
                <div class="error">
                    <?php if ($form_control->error_message != null && $form_control->error_message != ""): ?>
                        <legend>Error:</legend>
                        <p><?php echo $form_control->error_message ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <section>
                <h1>Forms</h1>

                <div class="grid">
                    <div id='cssmenu'>
                        <ul>
                            <li class='active has-sub'><a><span>New</span></a>
                                <ul>
                                    <li class='has-sub'><a href="<?php echo $form_control->company_path ?>/views/admin/form/<?php echo FormTypes::LendingPage ?>/-1#form" target="_blank"><span>Lending Page</span></a></li>
                                    <li class='has-sub'><a href="<?php echo $form_control->company_path ?>/views/admin/form/<?php echo FormTypes::ContactUS ?>/-1#form" target="_blank"><span>Contact-us Page</span></a></li>
                                </ul>
                            </li>
                            <li><a><span>Edit</span></a></li>
                            <li><a><span>Delete</span></a></li>
                        </ul>
                    </div>
                    <div class="grid-body">
                        <div class="grid-header-row">
                            <div class="grid-header-col">
                                <span>Name</span>
                            </div>
                            <div class="grid-header-col">
                                <span>Email</span>
                            </div>
                            <div class="grid-header-col">
                                <span>Type</span>
                            </div>
                            <div class="grid-header-col">
                                <span>&NonBreakingSpace;</span>
                            </div>
                        </div>
                        <?php foreach ($listctl->forms as $form): ?>
                            <form 
                                action="forms-list#form"
                                class="grid-row" 
                                method="post">
                                <input type="hidden" 
                                       name="dirty" value="0" 
                                       onchange="setRowDirty(this)" />
                                <input type="hidden" 
                                       name="formid" 
                                       value="<?php echo $form->formid ?>" />

                                <div class="grid-cell">
                                    <label>Name:</label>
                                    <span>
                                        <input 
                                            disabled
                                            type="text" 
                                            name="form_name" 
                                            placeholder="<?php echo $form->form_name ?>"
                                            value="<?php echo $form->form_name ?>" 
                                            />
                                    </span>
                                </div>

                                <div class="grid-cell">
                                    <label>Email:</label>
                                    <span>
                                        <input 
                                            disabled
                                            type="email" 
                                            name="user_email" 
                                            placeholder="<?php echo $form->user_email ?>"
                                            value="<?php echo $form->user_email ?>" 
                                            />
                                    </span>
                                </div>
                                <div class="grid-cell">
                                    <label>Type:</label>
                                    <span>
                                        <input 
                                            disabled
                                            type="text" 
                                            name="form_type" 
                                            placeholder="<?php echo $form->form_type ?>"
                                            value="<?php echo $form->form_type ?>" 
                                            />
                                    </span>
                                </div>
                                <div class="grid-cell row-button-group">
                                    <a 
                                        href="<?php echo $form_control->company_path . "/views/admin/form/" . $form->form_type . "/" . $form->formid . "#form" ?>"
                                        target="_blank">
                                        <img 
                                            src="/img/edit.png" 
                                            alt="edit" 
                                            title="Open the record in new window for editing" />
                                    </a>
                                    <input 
                                        type="submit" 
                                        name="delete" 
                                        value="delete" 
                                        title="Delete this record" 
                                        onclick="confirmDelete(this)">
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>