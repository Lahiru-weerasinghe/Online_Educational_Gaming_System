<?php
    require 'database.inc.php';
    $mid = $_GET['id'];

    $fName = $_POST["fname"];
    $lName = $_POST["lname"];
    $mEmail = $_POST["email"];
    $TID = $_POST["m-type"];
    $mPlan = $_POST["plan"];
    $mStatus = $_POST["status"];
    $rDate = $_POST["rdate"];

    if($TID == 1){
        $sql = "UPDATE Member, member_email, Membership
                SET Member.firstName = '$fName',
                    Member.lastName = '$lName',
                    Member.TID = $TID,
                    Member_email.email = '$mEmail',
                    Membership.m_status = '$mStatus',
                    Membership.m_plan = '$mPlan',
                    Membership.renewal_date = '$rDate'
                WHERE Member.memberID = $mid 
                  AND Member_email.memberID = $mid
                  AND Membership.memberID = $mid;";
    }
    else if($TID == 2){
        $sql = "UPDATE Member, member_email, Membership
                SET Member.firstName = '$fName',
                    Member.lastName = '$lName',
                    Member.TID = $TID,
                    Member_email.email = '$mEmail',
                    Membership.m_status = ' ',
                    Membership.m_plan = ' ',
                    Membership.renewal_date = '$rDate'
                WHERE Member.memberID = $mid 
                  AND Member_email.memberID = $mid
                  AND Membership.memberID = $mid;";
    }

    if(mysqli_query($conn, $sql)){
        header ("location: ../all-members.php?error=mmnone");
    } 
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>