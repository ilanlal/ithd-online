<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/category_control.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/incident/category_list_control.php';
include_once $_SERVER['DOCUMENT_ROOT'] . "/views/common/grid_view.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/controls/incident/category_grid_control.php";

if (!isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
    $base = new Base_Control();
    header("Location: " . $base->company_path . "/views/admin/user/login#login");
}

if (ConfigUtils::ENV == "PROD") {
    error_reporting(E_ERROR | E_PARSE);
}

$listctl = new CategoryList_Control(TRUE);
$categoryctl = new Category_Control($listctl->last_index);

$grid_control = new CategoryGrid_Control();
$grid = new GridView($grid_control,"standart");


if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (filter_input(INPUT_POST, "save") != NULL) {
        $categoryctl->upsert_category_on_submit();
        header("Location: " . $categoryctl->company_path . "/views/admin/entities/category#category", true);
        die;
    }

    if (filter_input(INPUT_POST, "delete") != NULL) {
        $categoryctl->delete_row();
        header("Location: " . $categoryctl->company_path . "/views/admin/entities/category#category", true);
        die;
    }


    if (filter_input(INPUT_POST, "up") != NULL) {
        $categoryctl->up();
        header("Location: " . $categoryctl->company_path . "/views/admin/entities/category#category", true);
        die;
    }

    if (filter_input(INPUT_POST, "down") != NULL) {
        $categoryctl->down();
        header("Location: " . $categoryctl->company_path . "/views/admin/entities/category#category", true);
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
        <title><?php echo ConfigUtils::ApplicationName ?> - Category</title>
        <script src="/views/scripts/category.js" type="text/javascript"></script>
        <script src="/views/scripts/grid.js" type="text/javascript"></script>
        <meta name="google-site-verification" content="WNMH4sH0ng4oS6XDwMXS_5VdNzw_Avh59n6p8cGLvB8" />

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php'; ?>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php'; ?>
        </header>
        <article id="category">
            <section>
                <div class="error">
                    <?php if ($categoryctl->error_message != null && $categoryctl->error_message != ""): ?>
                        <legend>Error:</legend>
                        <p><?php echo $categoryctl->error_message ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <section>
                <h1>Categories</h1>
            </section>
			<section>
				<?php $grid->render(); ?>
			</section>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>