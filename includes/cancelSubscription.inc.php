<?php 
    session_start(); 
    $mid = $_SESSION["memberID"];
    require_once 'database.inc.php';

    $sql = "UPDATE member SET TID = 2 WHERE memberID = $mid;";
    if(mysqli_query($conn, $sql)){
        $sql = "UPDATE membership SET m_status = 'Canceled' WHERE memberID = $mid;";
        mysqli_query($conn, $sql);
        $_SESSION["TID"] = 2;
        header("location: ../SubscriptionSetting-Page.php?error=none");
        exit();
    }
    else {
        echo "ERROR: Could not able cancel membership. Please try again";
    } 
    mysqli_close($conn);
?>