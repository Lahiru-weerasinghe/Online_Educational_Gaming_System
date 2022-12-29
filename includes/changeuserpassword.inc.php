<?php 
    if (isset($_POST["changepass"])){
        session_start(); 
        $mid = $_SESSION["memberID"];
        $currPass = $_POST["pwd"];
        $newPass = $_POST["pwd1"];
        $confirmNewPass = $_POST["pwd2"];

        require_once 'database.inc.php';
        require_once 'functions.inc.php';
        if (pwdMatch($newPass, $confirmNewPass) !== false) {
            header ("location: ../userSettings.php?error=passwordsdontmatch");
            exit();
        }

        $result = mysqli_query($conn, "SELECT m_password FROM Member WHERE memberID = $mid");
        $psw = mysqli_fetch_array($result);
        $pwdHashed = $psw[0];
        $checkPwd = password_verify($currPass, $pwdHashed);
        if ($checkPwd === false) {
            header("location: ../userSettings.php?error=wrongpass");
            exit();
        }
        else if ($checkPwd === true) {
            $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);
            $sql= "UPDATE Member SET m_password = '$hashedPwd' WHERE memberID = $mid;"; 
            if(mysqli_query($conn, $sql)){
                header ("location: ../userSettings.php?error=passnone");
            }
            else {
                echo "ERROR: Could not able to change passsword ";
            } 
        }

        mysqli_close($conn);
    }
    else{
        header ("location: ../userSettings.php");
        exit();
    }
?>