<?php
    if ($_SESSION["role"] !== 'Member') {
        header("location: ./login.php");
        exit();
    }
?>