<?php
    require 'database.inc.php';
    $memberID = $_GET["rowid"];

    $sql ="DELETE FROM Member Where memberID = $memberID ";

    if(mysqli_query($conn, $sql)){
        header ("location: ../all-members.php?error=none");
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>