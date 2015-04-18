<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
    
    if (isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])) {
        unset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL]);
        unset($_SESSION[Base_Control::SESSION_CUSTOMER_ID]);
    }
    
    header("Location: /views/customer/user/login#login");
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
