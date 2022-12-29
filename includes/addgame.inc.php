<?php
  session_start(); 
?>

<?php 
         //Game File
        $gameFile = $_FILES['gamefile'];

        $gameFileName = $_FILES['gamefile']['name'];
        $gameFileTmpName = $_FILES['gamefile']['tmp_name'];
        $gameFileSize = $_FILES['gamefile']['size'];
        $gameFileError = $_FILES['gamefile']['error'];
        $gameFileType = $_FILES['gamefile']['type'];

        $gameFileExt = explode('.', $gameFileName);
        $gameFileActualExt = strtolower(end($gameFileExt));

        $gameAllowed = array('js', 'php');

        if(in_array($gameFileActualExt, $gameAllowed)){
            if ($gameFileError === 0) {
                if ($gameFileSize < 500000) {
                    $gameFileNameNew = uniqid('', true).".".$gameFileActualExt;
                    $gameFileDestination = '../games/gamefiles/'.$gameFileNameNew;

                    move_uploaded_file($gameFileTmpName, $gameFileDestination);
                }
                else {
                    header ("location: ../add-games.php?error=3");
                    exit();
                }
            }
            else {
                header ("location: ../add-games.php?error=2");
                exit();
            }
        }
        else {
            header ("location: ../add-games.php?error=1");
            exit();
        }

         //Thumbnail
        $thumbFile = $_FILES['thumbnail'];

        $thumbFileName = $_FILES['thumbnail']['name'];
        $thumbFileTmpName = $_FILES['thumbnail']['tmp_name'];
        $thumbFileSize = $_FILES['thumbnail']['size'];
        $thumbFileError = $_FILES['thumbnail']['error'];
        $thumbFileType = $_FILES['thumbnail']['type'];

        $thumbFileExt = explode('.', $thumbFileName);
        $thumbFileActualExt = strtolower(end($thumbFileExt));

        $thumbAllowed = array('jpg', 'jpeg', 'png');

        if ($thumbFileError !== 4) {
        if(in_array($thumbFileActualExt, $thumbAllowed)){
            if ($thumbFileError === 0) {
                if ($thumbFileSize < 500000) {
                    $thumbFileNameNew = uniqid('', true).".".$thumbFileActualExt;
                    $thumbFileDestination = '../games/thumbnails/'.$thumbFileNameNew;

                    move_uploaded_file($thumbFileTmpName, $thumbFileDestination);
                }
                else {
                    header ("location: ../add-games.php?error=6");
                    exit();
                }
            }
            else {
                header ("location: ../add-games.php?error=5");
                exit();
            }
        }}
        
        //Add Game Details to the Database

        require 'database.inc.php';

        $gameName = $_POST["gamename"];
        $description = $_POST["description"];
        $instructions = $_POST["instructions"];
        $grade = $_POST["grade"];
        $category = $_POST["category"];
        $subject = $_POST["subject"];
        $access = $_POST["access"];
        $developerID = $_POST["developer"];
        $adminID = $_SESSION["adminID"];
        $aDate = date("Y-m-d");

        $sql = "INSERT INTO Game (gameName, gameGrade, gameCategory, gameSubject, gameDescription, gameInstructions, gameAccess, adminID, devID, gFile, gThumbnail, added_date, last_modified_date)
                VALUES ('$gameName', '$grade', '$category', '$subject', '$description', '$instructions' , '$access', '$adminID', '$developerID', '$gameFileNameNew', '$thumbFileNameNew', '$aDate', '$aDate')";
        
        if(mysqli_query($conn, $sql)){
            header ("location: ../add-games.php?error=none");
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
        mysqli_close($conn);
?>