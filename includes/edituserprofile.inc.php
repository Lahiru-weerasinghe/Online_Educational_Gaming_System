<?php
  session_start(); 
  require_once 'database.inc.php';
  require_once 'functions.inc.php';
  
  if (isset($_POST["submit"])){
    $mid = $_SESSION["memberID"];
    $Uname= $_SESSION["username"];
    $fName = $_POST["fname"];
    $lName = $_POST["lname"];
    $email = $_POST["email"];

    $result = mysqli_query($conn, "SELECT email FROM member_email WHERE memberID = $mid");
    $emails = mysqli_fetch_array($result);

    if($email != $emails[0]){
        if (emailExists($conn, $email) !== false) {
            header ("location: ../userSettings.php?error=emailtaken");
            exit();
        }
    }

    //Profile Pic
    $profilePic = $_FILES['propic'];

    $profilePicName = $_FILES['propic']['name'];
    $profilePicTmpName = $_FILES['propic']['tmp_name'];
    $profilePicSize = $_FILES['propic']['size'];
    $profilePicError = $_FILES['propic']['error'];
    $profilePicType = $_FILES['propic']['type'];

    $profilePicExt = explode('.', $profilePicName);
    $profilePicActualExt = strtolower(end($profilePicExt));

    $imgAllowed = array('jpg', 'jpeg', 'png');

    if ($profilePicError !== 4) {
       if(in_array($profilePicActualExt, $imgAllowed)){
           if ($profilePicError === 0) {
               if ($profilePicSize < 500000) {
                   $profilePicNameNew = $Uname."-".uniqid('', true).".".$profilePicActualExt;
                   $profilePicDestination = '../uploads/userpropics/'.$profilePicNameNew;

                   move_uploaded_file($profilePicTmpName, $profilePicDestination);
               }
               else {
                   header ("location: ../userSettings.php?error=1");
                   exit();
               }
           }
           else {
               header ("location: ../userSettings.php?error=2");
               exit();
           }
       }
       else {
           header ("location: ../userSettings.php?error=3");
           exit();
       }}

       if ($profilePicError !== 4){
           $sql= "UPDATE Member SET firstName = '$fName', lastName = '$lName', profile_pic = '$profilePicNameNew' WHERE memberID = $mid;";
       }
       else{
           $sql= "UPDATE Member SET firstName = '$fName', lastName = '$lName' WHERE memberID = $mid;";   
       }

       if(mysqli_query($conn, $sql)){
            $sql= "UPDATE Member_email SET email = '$email' WHERE memberID = $mid;";
            if(mysqli_query($conn, $sql)){
                header ("location: ../userSettings.php?error=none");
            }
            else {
                echo "ERROR: Could not able to edit member details  " . mysqli_error($conn);
            }
            $_SESSION["firstName"] = $fName;
            $_SESSION["lastName"] = $lName;

            if ($profilePicError !== 4){
                $_SESSION["proPic"] = $profilePicNameNew; 
            }  
        } 
       else{
            echo "ERROR: Could not able to edit member details " . mysqli_error($conn);
        }
    
        mysqli_close($conn);

  }
  else{
    header ("location: ../userSettings.php");
    exit();
  }
  
?>