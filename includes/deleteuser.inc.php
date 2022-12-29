<?php 
    session_start(); 
    if (isset($_POST["delete"])){
        require 'database.inc.php';
        $memberID = $_SESSION["memberID"];

        $sql ="DELETE FROM Member Where memberID = $memberID ";

        if(mysqli_query($conn, $sql)){
            session_unset();
            session_destroy();

            header("location: ../index.php");
            exit();
        } 
        else{
            echo "ERROR: Could not able to delete member" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    else {
        header ("location: ../usersettings.php");
        exit();
    }
?>