<?php
   session_start();
?>

<?php
    if (isset($_POST["submit"])){
        require 'database.inc.php';

        $mid = $_SESSION["memberID"];
        $name = $_POST["name"]; 
        $subject = $_POST["subject"];
        $email = $_POST["email"];
        $description = $_POST["description"];

        if(isset($_SESSION["memberID"]))
        {
          $sql = "INSERT INTO contact(memberID, name, subject, email, description, c_datetime) VALUES('$mid', '$name', '$subject', '$email', '$description', now())";
        }
        else{
          $sql = "INSERT INTO contact(name, subject, email, description, c_datetime) VALUES('$name', '$subject', '$email', '$description', now())";
        }

        if(mysqli_query($conn, $sql)){
            header("location: ../Contact us.php?error=none");
        }
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    else{
        header("location: ../contact us.php");
        exit();
    }
?>
