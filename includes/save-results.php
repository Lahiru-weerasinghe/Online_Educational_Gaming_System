<?php
  session_start(); 
?>
<?php
    if(isset($_POST['submit'])) {
        require 'database.inc.php';
        $score = $_POST['score'];
        $gid = $_POST['gameID'];
        $uID = $_SESSION['memberID'];
        $dateTime = date("Y-m-d h:i:s");

        $sql = "INSERT INTO History(memberID, gameID, h_datetime, score) VALUES ($uID, $gid, '$dateTime', $score );";

        if(mysqli_query($conn, $sql)){
            header ("location: ../game.php?gameID=".$gid);
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    else {
        header ("location: ../all-games.php");
    }  
?>