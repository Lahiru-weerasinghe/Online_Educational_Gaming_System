<?php 
    if (isset($_POST["sumbit"])){
        session_start(); 
        $aid = $_SESSION["adminID"];
        $currPass = $_POST["old-pass"];
        $newPass = $_POST["new-pass"];
        $confirmNewPass = $_POST["cnew-pass"];

        require_once 'database.inc.php';
        require_once 'functions.inc.php';
        if (pwdMatch($newPass, $confirmNewPass) !== false) {
            header ("location: ../admin-settings.php?error=passwordsdontmatch");
            exit();
        }

        $result = mysqli_query($conn, "SELECT a_password FROM admin WHERE adminID = $aid");
        $psw = mysqli_fetch_array($result);
        $pwdHashed = $psw[0];
        $checkPwd = password_verify($currPass, $pwdHashed);
        if ($checkPwd === false) {
            header("location: ../admin-settings.php?error=wrongpass");
            exit();
        }
        else if ($checkPwd === true) {
            $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);
            $sql= "UPDATE Admin SET a_password = '$hashedPwd' WHERE adminID = $aid;"; 
            if(mysqli_query($conn, $sql)){
                header ("location: ../admin-settings.php?error=passnone");
            }
            else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            } 
        }

        mysqli_close($conn);
    }
    else{
        header ("location: ../admin-settings.php");
        exit();
    }
?>