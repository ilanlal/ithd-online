<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/form_control.php';

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/form_control.php';

$form_control = new Form_Control(filter_input(INPUT_GET, "type"));

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $form_control->upsert_data_on_submit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="msvalidate.01" content="07C0053E19D8FC40FFF0BF909FB72C02" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="keywords" content="form,form generator,free,free form,contact us
              ,free page,free contact us,iln software" />
        <meta name="description" 
              content="A real free contact form for your website with integrated anti-spam protection!
              ,get it now for free" />
        <title><?php echo ConfigUtils::ApplicationName ?> - Form</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
        <script>
            function showLogo() {
                if (document.getElementById('logo_url').value != '') {
                    document.getElementById('logo_display').src = document.getElementById('logo_url').value;
                }
            }
        </script>
    </head>
    <body onload="showLogo()">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article>
            <section>
                <h1>Form</h1>
                <div class="content-area">

                </div>
            </section>
            <section id="form">
                <form action="<?php echo $form_control->company_path . "/views/admin/form/" . $form_control->form_type . "/" . $form_control->form->formid . "#form"?>" method="post">
                    <section>
                        <?php if ($form_control->error_message != null && $form_control->error_message != ""): ?>
                            <div class="error">
                                <legend>Error:</legend>
                                <p><?php echo $form_control->error_message ?></p>

                            </div>
                        <?php endif; ?>
                        <?php if ($form_control->success_message != null && $form_control->success_message != ""): ?>
                            <div class="success">
                                <p><?php echo $form_control->success_message ?></p>
                            </div>
                        <?php endif; ?>
                    </section>
                    <section>
                        <div>
                            <?php if ($form_control->form->strong_id != null): ?>
                                <fieldset>
                                    <legend>Your Form information:</legend>
                                    <div class="field">
                                        <label>Form Page:</label>
                                        <a target="_blank" href="<?php
                                        echo ConfigUtils::FullWebHost
                                        . "/views/customer/forms/general-forms/"
                                        . $form_control->form_type . "/" . $form_control->form->strong_id;
                                        ?>">Form URL</a>
                                    </div>
                                    <label>Embedded Code</label>
                                    <textarea><?php
                                        echo '<iframe style="width:350px; height:500px;border:0" '
                                        . 'src="' . ConfigUtils::FullWebHost . '/views/customer/general-forms/' . $form_control->form_type . "/" . $form_control->form->strong_id . '">';
                                        ?>
                                    </textarea>

                                </fieldset>
                            <?php endif; ?>
                            <fieldset>
                                 <legend>Form Informatica:</legend>
                                 <div class="field">
                                    <label title="" 
                                           for="form_name">Name</label>
                                    <input type="text" placeholder=""
                                           name="form_name" value="<?php echo $form_control->form->form_name ?>" 
                                           required />
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Transmit Target:</legend>
                                <input type="hidden" name="id" value="<?php echo $form_control->form->strong_id ?>" />
                                <input type="hidden" name="form_type" value="<?php echo $form_control->form_type; ?>" />
                                <div class="field">
                                    <label title="Choose E-mail address to receive content forms" 
                                           for="user_email">E-mail</label>
                                    <input type="email" placeholder="email@domain.com"
                                           name="user_email" value="<?php echo $form_control->form->user_email ?>" 
                                           required />
                                </div>
                                
                            </fieldset>
                            <fieldset class="nobr">
                                <legend title="Select witch fields to display on the forms">Fields To Display:</legend>
                                <?php echo $form_control->generate_html_selections(); ?>
                            </fieldset>
                            <fieldset>
                                <legend class="">Terms Verification:</legend>
                                <div class="field">
                                    <input type="checkbox" name="terms" <?php if ($form_control->form->strong_id != null) echo "checked"; ?> required />
                                    <span>I agree to the <a target="_blank" href="/terms-of-service">Terms of Service</a>
                                    </span>

                                </div>
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                                <legend>Form Titles:</legend>
                                <div class="field">
                                    <label title="The title will appear in top of the page" for="free_title">Page Title:</label>
                                    <textarea name="free_title" required><?php echo $form_control->form->free_title ?></textarea>
                                </div>
                                <div class="field">
                                    <label title="The messahe will appear to customer after sumit action" for="thanks_message">Thanks Message:</label>
                                    <textarea name="thanks_message" required><?php echo $form_control->form->thanks_message ?></textarea>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Form Styling & Decorations:</legend>
                                <div class="field">
                                    <label title="The logo will be shrink to 32x32 pixel" for="logo_url">Your Logo url:</label>
                                    <input type="url" id="logo_url" name="logo_url"
                                           placeholder="http://www.iln-software.com/imgs/logo.png"
                                           value="<?php echo $form_control->form->logo_url ?>"
                                           onchange="showLogo()" >
                                    <img id="logo_display" src="" alt="Logo" title="Your logo" />
                                </div>
                                <div class="field">
                                    <label title="" for="font_family">Font Family:</label>
                                    <select name="font_family">
                                        <option id="cursive" <?php
                                        if ($form_control->form->font_family == "cursive") {
                                            echo 'selected';
                                        }
                                        ?> >cursive</option>
                                        <option id="fantasy" <?php
                                        if ($form_control->form->font_family == "fantasy") {
                                            echo 'selected';
                                        }
                                        ?>>fantasy</option>
                                        <option id="monospace" <?php
                                        if ($form_control->form->font_family == "monospace") {
                                            echo 'selected';
                                        }
                                        ?>>monospace</option>
                                        <option id="sans-serif" <?php
                                        if ($form_control->form->font_family == "sans-serif") {
                                            echo 'selected';
                                        }
                                        ?>>sans-serif</option>
                                        <option id="serif" <?php
                                        if ($form_control->form->font_family == "serif") {
                                            echo 'selected';
                                        }
                                        ?>>serif</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label title="" for="font_size">Font Size:</label>
                                    <select name="font_size">
                                        <option id="x-large" <?php
                                        if ($form_control->form->font_size == "x-large") {
                                            echo 'selected';
                                        }
                                        ?>>x-large</option>
                                        <option id="larger" <?php
                                        if ($form_control->form->font_size == "larger") {
                                            echo 'selected';
                                        }
                                        ?>>larger</option>
                                        <option id="large" <?php
                                        if ($form_control->form->font_size == "large") {
                                            echo 'selected';
                                        }
                                        ?>>large</option>
                                        <option id="medium" <?php
                                        if ($form_control->form->font_size == "medium") {
                                            echo 'selected';
                                        }
                                        ?>>medium</option>
                                        <option id="small" <?php
                                        if ($form_control->form->font_size == "small") {
                                            echo 'selected';
                                        }
                                        ?>>small</option>
                                        <option id="smaller" <?php
                                        if ($form_control->form->font_size == "smaller") {
                                            echo 'selected';
                                        }
                                        ?>>smaller</option>
                                        <option id="x-small" <?php
                                        if ($form_control->form->font_size == "x-small") {
                                            echo 'selected';
                                        }
                                        ?>>x-small</option>
                                        <option id="xx-small" <?php
                                        if ($form_control->form->font_size == "xx-small") {
                                            echo 'selected';
                                        }
                                        ?>>xx-small</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label title="The color of the font in the page" for="color">Font Color:</label>
                                    <input type="color" name="color" 
                                           value="<?php echo ($form_control->form->color == null ? '#0000FF' : $form_control->form->color) ?>"/>
                                </div>
                                <div class="field">
                                    <label title="The background color of the page" for="color">Back Color:</label>
                                    <input type="color" name="background_color" 
                                           value="<?php echo ($form_control->form->background_color == null ? '#EEEEEE' : $form_control->form->background_color) ?>"/>
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend>Developers Features</legend>
                                <div class="field">
                                    <label>XML Attachment</label>
                                    <input type="checkbox" title="Attach xml file to the email" name="submit_xml" value="1"
                                    <?php if ($form_control->form->submit_xml == 1) echo 'checked="checked"' ?>
                                           />
                                </div>
                                <div class="field">
                                    <label>JSON Attachment</label>
                                    <input type="checkbox" title="Attach json file to the email" name="submit_json" value="1"
                                    <?php if ($form_control->form->submit_json == 1) echo 'checked="checked"' ?>
                                           />
                                </div>

                            </fieldset>
                        </div>
                    </section>
                    <div>
                        <div class="form-top-buttons">
                            <input type="submit" name="submit" value="Save" />
                        </div>
                    </div>
                </form>
            </section>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
