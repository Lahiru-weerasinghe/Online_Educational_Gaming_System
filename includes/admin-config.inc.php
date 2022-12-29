<?php
    if ($_SESSION["role"] !== 'Admin') {
        header("location: ./admin-login.php");
        exit();
    }
?>