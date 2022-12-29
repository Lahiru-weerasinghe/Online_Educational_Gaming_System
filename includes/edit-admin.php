<?php
  session_start(); 
  require_once 'database.inc.php';
  require_once 'functions.inc.php';
  
  if (isset($_POST["sumbit"])){
    $aid = $_SESSION["adminID"];
    $aUname= $_SESSION["username"];
    $fName = $_POST["fname"];
    $lName = $_POST["lname"];
    $email = $_POST["email"];

    $result = mysqli_query($conn, "SELECT email FROM administrator_email WHERE adminID = $aid");
    $emails = mysqli_fetch_array($result);

    if($email != $emails[0]){
        if (emailExists($conn, $email) !== false) {
            header ("location: ../admin-settings.php?error=emailtaken");
            exit();
        }
    }

    //Profile Pic
    $profilePic = $_FILES['profilepic'];

    $profilePicName = $_FILES['profilepic']['name'];
    $profilePicTmpName = $_FILES['profilepic']['tmp_name'];
    $profilePicSize = $_FILES['profilepic']['size'];
    $profilePicError = $_FILES['profilepic']['error'];
    $profilePicType = $_FILES['profilepic']['type'];

    $profilePicExt = explode('.', $profilePicName);
    $profilePicActualExt = strtolower(end($profilePicExt));

    $imgAllowed = array('jpg', 'jpeg', 'png');

    if ($profilePicError !== 4) {
       if(in_array($profilePicActualExt, $imgAllowed)){
           if ($profilePicError === 0) {
               if ($profilePicSize < 500000) {
                   $profilePicNameNew = $aUname."-".uniqid('', true).".".$profilePicActualExt;
                   $profilePicDestination = '../uploads/adminpropics/'.$profilePicNameNew;

                   move_uploaded_file($profilePicTmpName, $profilePicDestination);
               }
               else {
                   header ("location: ../admin-settings.php?error=1");
                   mysqli_close($conn);
                   exit();
               }
           }
           else {
               header ("location: ../admin-settings.php?error=2");
               mysqli_close($conn);
               exit();
           }
       }
       else {
           header ("location: ../admin-settings.php?error=3");
           mysqli_close($conn);
           exit();
       }}

       if ($profilePicError !== 4){
           $sql= "UPDATE Admin SET firstName = '$fName', lastName = '$lName', profile_pic = '$profilePicNameNew' WHERE adminID = $aid;";
       }
       else{
           $sql= "UPDATE Admin SET firstName = '$fName', lastName = '$lName' WHERE adminID = $aid;";   
       }

       if(mysqli_query($conn, $sql)){
            $sql= "UPDATE Administrator_email SET email = '$email' WHERE adminID = $aid;";
            if(mysqli_query($conn, $sql)){
                header ("location: ../admin-settings.php?error=none");
            }
            else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
            $_SESSION["firstName"] = $fName;
            $_SESSION["lastName"] = $lName;

            if ($profilePicError !== 4){
                $_SESSION["proPic"] = $profilePicNameNew; 
            }  
        } 
       else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    
        mysqli_close($conn);

  }
  else{
    header ("location: ../admin-settings.php");
    exit();
  }
  
?>