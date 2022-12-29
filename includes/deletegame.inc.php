<?php
    require 'database.inc.php';
    $gameID = $_GET["rowid"];

    if($gameID != 0){
        $gameFile = "SELECT gFile FROM Game WHERE gameID= $gameID";
        $result = mysqli_query($conn, $gameFile);
        $row = mysqli_fetch_assoc($result);
        unlink("../games/gamefiles/".$row['gFile']);

        $gameThumb = "SELECT gThumbnail FROM Game WHERE gameID= $gameID";
        $result = mysqli_query($conn, $gameThumb);
        $row = mysqli_fetch_assoc($result);

        if(!is_null($row['gThumbnail'])){
        unlink("../games/thumbnails/".$row['gThumbnail']);}

        $sql ="DELETE FROM Game WHERE gameID='$gameID'";

        if(mysqli_query($conn, $sql)){
            header ("location: ../all-games.php?error=none");
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    else{
        header ("location: ../all-games.php");
    }
?>