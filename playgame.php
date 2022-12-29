<?php 
      $title = 'Game';
      include 'header.php'; 
?>

      <?php 
        $mid = $_GET['id'];

        $sql = "SELECT gameName, gameGrade, gameCategory, gameSubject, gameDescription, gameInstructions, gameAccess, devID, gFile 
                FROM Game WHERE gameID = $mid";

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);

          $gName = $row["gameName"];
          $gGrade = $row["gameGrade"];
          $gCategory = $row["gameCategory"];
          $gSubject = $row["gameSubject"];
          $gDesc = $row["gameDescription"];
          $gInst = $row["gameInstructions"];
          $gAccess = $row["gameAccess"];
          $devID = $row["devID"];
          $gFileName = $row["gFile"];
        }
        else{
              // Error MSG
        }
      ?>

  <?php include('./footer.php'); ?>

