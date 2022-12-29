<?php

    if (isset($_POST["log"])){
        
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];

        require_once 'database.inc.php';
        require_once 'functions.inc.php';

        /*check whether the inputs are empty */
        if(emptyInputLogin( $username, $pwd) !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        loginUser($conn, $username, $pwd);
    }

    else{

        header("location: ../login.php");
        exit();
    }
?>    
