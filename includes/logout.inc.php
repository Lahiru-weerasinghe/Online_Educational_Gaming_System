<?php

    /*destroy the login details */
    session_start();
    session_unset();
    session_destroy();

    header("location: ../index.php");
    exit();

?>