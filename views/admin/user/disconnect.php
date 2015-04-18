<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
    if (isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
        unset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL]);
        unset($_SESSION[Base_Control::SESSION_ADMIN_ID]);
        $base = new Base_Control();
        header("Location: " . $base->company_path . "/views/admin/user/login#login");
        die;
    }
    
    header("Location: " . $base->company_path . "/");
    die;
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Disconnecting</title>
    </head>
    <body>
        <header>
        </header>
        <article>
        </article>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
        </footer>
    </body>
</html>
