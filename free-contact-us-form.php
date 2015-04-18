<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/common/form_config.php';
$vercode_session_uniquename = "vercode_contact_us_manager";

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/admin/contact_us_control.php';

$cumctl = new ContactUs_Control();

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "vercode") != $_SESSION[$vercode_session_uniquename] || $_SESSION[$vercode_session_uniquename] == '') {
        $cumctl->error_message = 'Incorrect verification code.';
        $cumctl->load_data_to_object();
    } else {
        $cumctl->upsert_data_on_submit();
        header("Location: /free-contact-us-form/" .$cumctl->form->strong_id);
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

        <meta name="keywords" content="form,form generator,free,free form,contact us
              ,free page,free contact us,iln software" />
        <meta name="description" 
              content="A real free contact form for your website with integrated anti-spam protection!
              ,get it now for free" />
        <title>ITHD-Online - A Real Free Contact Us Page</title>

        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />
        <title>A real free contact form</title>

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
                <h1>A real free contact us form for your website with integrated anti-spam protection!</h1>
                <div class="content-area">
                    <div class="content-group">
                        <div class="content" onclick="this.className = (this.className == 'content' ? 'content inlarge' : 'content')">
                            <h2>Free Contact us Features:</h2>
                            <h3>In less than 5 minute you can setup your free contact us page</h3>
                            <h3>All free contact is form are compatible with all mobile devices</h3>
                            <h3>No registration and no credit card required, you can start and use your contact us form right now</h3>
                            <h3>Anti-Spam "Captcha" protection - protecting your getting junk e-mails</h3>
                        </div>
                        <div class="content" onclick="this.className = (this.className == 'content' ? 'content inlarge' : 'content')">
                            <h2>Free Contact us Customize:</h2>
                            <h3>Add your logo on the top of your free contact is page</h3>
                            <h3>Add your custom text title to your free contact us form</h3>
                            <h3>Add custom text confirmation message, after the submission of your free contact us form</h3>
                            <h3>Select your required and optional fields, in your free contact us page</h3>
                        </div>
                    </div>
                    <div class="content-group">
                        <div class="content" onclick="this.className = (this.className == 'content' ? 'content inlarge' : 'content')">
                            <h2>Free Contact is Design:</h2>
                            <h3>Design background color for your free contact us page</h3>
                            <h3>Select your favourite colors on the free contact us page</h3>
                            <h3>Select font family and size for your free contact us form</h3>
                        </div>
                        <div class="content" onclick="this.className = (this.className == 'content' ? 'content inlarge' : 'content')">
                            <h2>Developers Features:</h2>
                            <h3>XML Transformation Support</h3>
                            <h3>JSON Transformation Support</h3>
                        </div>
                    </div>
                </div>
            </section>
            <section id="form">
                <h2>Create your free contact us form now! <?php echo $cumctl->error_message ?></h2>
                <form action="/free-contact-us-form/<?php echo $cumctl->form->strong_id ?>#form" method="post">
                    <section>
                        <?php if ($cumctl->error_message != null && $cumctl->error_message != ""): ?>
                            <div class="error">
                                <legend>Error:</legend>
                                <p><?php echo $cumctl->error_message ?></p>

                            </div>
                        <?php endif; ?>
                        <?php if ($cumctl->success_message != null && $cumctl->success_message != ""): ?>
                            <div class="success">
                                <p><?php echo $cumctl->success_message ?></p>

                            </div>
                        <?php endif; ?>
                    </section>
                    <section>
                        <div>
                            <?php if ($cumctl->form->strong_id != null): ?>
                                <fieldset>
                                    <legend>Your Form information:</legend>
                                    <div class="field">
                                        <label>Manager page:</label> 
                                        <a href="<?php
                                        echo ConfigUtils::FullWebHost
                                        . "/free-contact-us-form/"
                                        . $cumctl->form->strong_id
                                        . "#form";
                                        ?>">Manager</a>
                                    </div>
                                    <div class="field">
                                        <label>Contact us page:</label>
                                        <a target="_blank" href="<?php
                                        echo ConfigUtils::FullWebHost
                                        . "/views/customer/forms/general-forms/"
                                        . FormConfiguration::ContactUS . "/"
                                        . $cumctl->form->strong_id;
                                        ?>">Contact US</a>
                                    </div>
                                    <label>IFrame Embedded Code</label>
                                    <textarea><?php
                                        echo '<iframe style="width:350px; height:500px;border:0" '
                                        . 'src="' . ConfigUtils::FullWebHost . '/views/customer/forms/contact-us/' . $cumctl->form->strong_id . '">';
                                        ?>
                                    </textarea>

                                </fieldset>
                            <?php endif; ?>
                            <fieldset>
                                <legend>Transmit Target:</legend>
                                <input type="hidden" name="form_type" value="<?php echo $cumctl->form->form_type ?>" />
                                <input type="hidden" name="id" value="<?php echo $cumctl->form->strong_id ?>" />
                                <div class="field">
                                    <label title="Choose E-mail address to receive content forms" 
                                           for="user_email">E-mail</label>
                                    <input type="email" placeholder="email@domain.com"
                                           name="user_email" value="<?php echo $cumctl->form->user_email ?>" 
                                           required />
                                </div>
                            </fieldset>
                            <fieldset class="nobr">
                                <legend title="Select witch fields to display on the forms">Fields To Display:</legend>
                                <?php echo $cumctl->generate_html_selections(); ?>
                            </fieldset>
                            <?php if ($cumctl->form->strong_id == null): ?>
                            <fieldset>
                                <legend class="This is anti spam protection">Human Verification:</legend>
                                <div class="field">
                                    <label>Enter Code:</label>
                                    <input type="number" name="vercode" required />
                                </div>
                                <img src="/captcha.php?var=<?php echo $vercode_session_uniquename; ?>"  alt="This is anti spam protection" />
                                <div class="field">
                                    <input type="checkbox" name="terms" required />
                                    <span>I agree to the <a target="_blank" href="/terms-of-service">Terms of Service</a>
                                    </span>

                                </div>
                            </fieldset>
                            <?php endif; ?>
                        </div>
                        <div>
                            <fieldset>
                                <legend>Form Titles:</legend>
                                <div class="field">
                                    <label title="The title will appear in top of the page" for="free_title">Page Title:</label>
                                    <textarea name="free_title" required><?php echo $cumctl->form->free_title ?></textarea>
                                </div>
                                <div class="field">
                                    <label title="The messahe will appear to customer after sumit action" for="thanks_message">Thanks Message:</label>
                                    <textarea name="thanks_message" required><?php echo $cumctl->form->thanks_message ?></textarea>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Form Styling & Decorations:</legend>
                                <div class="field">
                                    <label title="The logo will be shrink to 32x32 pixel" for="logo_url">Your Logo url:</label>
                                    <input type="url" id="logo_url" name="logo_url"
                                           placeholder="http://www.iln-software.com/imgs/logo.png"
                                           value="<?php echo $cumctl->form->logo_url ?>"
                                           onchange="showLogo()" >
                                    <img id="logo_display" src="" alt="Logo" title="Your logo" />
                                </div>
                                <div class="field">
                                    <label title="" for="font_family">Font Family:</label>
                                    <select name="font_family">
                                        <option id="cursive" <?php
                                        if ($cumctl->form->font_family == "cursive") {
                                            echo 'selected';
                                        }
                                        ?> >cursive</option>
                                        <option id="fantasy" <?php
                                        if ($cumctl->form->font_family == "fantasy") {
                                            echo 'selected';
                                        }
                                        ?>>fantasy</option>
                                        <option id="monospace" <?php
                                        if ($cumctl->form->font_family == "monospace") {
                                            echo 'selected';
                                        }
                                        ?>>monospace</option>
                                        <option id="sans-serif" <?php
                                        if ($cumctl->form->font_family == "sans-serif") {
                                            echo 'selected';
                                        }
                                        ?>>sans-serif</option>
                                        <option id="serif" <?php
                                        if ($cumctl->form->font_family == "serif") {
                                            echo 'selected';
                                        }
                                        ?>>serif</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label title="" for="font_size">Font Size:</label>
                                    <select name="font_size">
                                        <option id="x-large" <?php
                                        if ($cumctl->form->font_size == "x-large") {
                                            echo 'selected';
                                        }
                                        ?>>x-large</option>
                                        <option id="larger" <?php
                                        if ($cumctl->form->font_size == "larger") {
                                            echo 'selected';
                                        }
                                        ?>>larger</option>
                                        <option id="large" <?php
                                        if ($cumctl->form->font_size == "large") {
                                            echo 'selected';
                                        }
                                        ?>>large</option>
                                        <option id="medium" <?php
                                        if ($cumctl->form->font_size == "medium") {
                                            echo 'selected';
                                        }
                                        ?>>medium</option>
                                        <option id="small" <?php
                                        if ($cumctl->form->font_size == "small") {
                                            echo 'selected';
                                        }
                                        ?>>small</option>
                                        <option id="smaller" <?php
                                        if ($cumctl->form->font_size == "smaller") {
                                            echo 'selected';
                                        }
                                        ?>>smaller</option>
                                        <option id="x-small" <?php
                                        if ($cumctl->form->font_size == "x-small") {
                                            echo 'selected';
                                        }
                                        ?>>x-small</option>
                                        <option id="xx-small" <?php
                                        if ($cumctl->form->font_size == "xx-small") {
                                            echo 'selected';
                                        }
                                        ?>>xx-small</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label title="The color of the font in the page" for="color">Font Color:</label>
                                    <input type="color" name="color" 
                                           value="<?php echo ($cumctl->form->color == null ? '#0000FF' : $cumctl->form->color) ?>"/>
                                </div>
                                <div class="field">
                                    <label title="The background color of the page" for="color">Back Color:</label>
                                    <input type="color" name="background_color" 
                                           value="<?php echo ($cumctl->form->background_color == null ? '#EEEEEE' : $cumctl->form->background_color) ?>"/>
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend>Developers Features</legend>
                                <div class="field">
                                    <label>XML Attachment</label>
                                    <input type="checkbox" title="Attach xml file to the email" name="submit_xml" value="1"
                                    <?php if ($cumctl->form->submit_xml == 1) echo 'checked="checked"' ?>
                                           />
                                </div>
                                <div class="field">
                                    <label>JSON Attachment</label>
                                    <input type="checkbox" title="Attach json file to the email" name="submit_json" value="1"
                                    <?php if ($cumctl->form->submit_json == 1) echo 'checked="checked"' ?>
                                           />
                                </div>

                            </fieldset>
                        </div>
                    </section>
                    <div>
                        <div class="form-top-buttons">
                            <input type="submit" name="submit" value="Submit" />
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
