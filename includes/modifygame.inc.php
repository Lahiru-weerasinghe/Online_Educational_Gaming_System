<?php
    require 'database.inc.php';
    $mid = $_GET['id'];

    $gameName = $_POST["gamename"];
    $description = $_POST["description"];
    $instructions = $_POST["instructions"];
    $grade = $_POST["grade"];
    $category = $_POST["category"];
    $subject = $_POST["subject"];
    $access = $_POST["access"];
    $developerID = $_POST["developer"];

    //Game File
    $gameFileName = $_FILES['gamefile']['name'];
    $gameFileTmpName = $_FILES['gamefile']['tmp_name'];
    $gameFileSize = $_FILES['gamefile']['size'];
    $gameFileError = $_FILES['gamefile']['error'];
    $gameFileType = $_FILES['gamefile']['type'];

    $gameFileExt = explode('.', $gameFileName);
    $gameFileActualExt = strtolower(end($gameFileExt));

    $gameAllowed = array('js', 'php');
    if ($gameFileError !== 4) {
        $gameFile = "SELECT gFile FROM Game WHERE gameID= $mid";
        $result = mysqli_query($conn, $gameFile);
        $row = mysqli_fetch_assoc($result);
        unlink("../games/gamefiles/".$row['gFile']);
        if(in_array($gameFileActualExt, $gameAllowed)){
            if ($gameFileError === 0) {
                if ($gameFileSize < 500000) {
                    $gameFileNameNew = uniqid('', true).".".$gameFileActualExt;
                    $gameFileDestination = '../games/gamefiles/'.$gameFileNameNew;

                    move_uploaded_file($gameFileTmpName, $gameFileDestination);
                }
                else {
                    header ("location: ../all-games.php?error=22");
                    mysqli_close($conn);
                    exit();
                }
            }
            else {
                header ("location: ../all-games.php?error=21");
                mysqli_close($conn);
                exit();
            }
        }
        else {
            header ("location: ../all-games.php?error=20");
            mysqli_close($conn);
            exit();
        }
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
        $gameThumb = "SELECT gThumbnail FROM Game WHERE gameID= $mid";
        $result = mysqli_query($conn, $gameThumb);
        $row = mysqli_fetch_assoc($result);

        if(!is_null($row['gThumbnail'])){
        unlink("../games/thumbnails/".$row['gThumbnail']);}

        if(in_array($thumbFileActualExt, $thumbAllowed)){
            if ($thumbFileError === 0) {
                if ($thumbFileSize < 500000) {
                    $thumbFileNameNew = uniqid('', true).".".$thumbFileActualExt;
                    $thumbFileDestination = '../games/thumbnails/'.$thumbFileNameNew;

                    move_uploaded_file($thumbFileTmpName, $thumbFileDestination);
                }
                else {
                    header ("location: ../all-games.php?error=25");
                    mysqli_close($conn);
                    exit();
                }
            }
            else {
                header ("location: ../all-games.php?error=24");
                mysqli_close($conn);
                exit();
            }
        }
        else {
            header ("location: ../all-games.php?error=23");
            mysqli_close($conn);
            exit();
        }}
    if ($gameFileError !== 4 && $thumbFileError !== 4) {
    $sql = "UPDATE Game SET gameName = '$gameName', gameGrade = '$grade', gameCategory = '$category', gameSubject = '$subject', 
            gameDescription = '$description', gameInstructions = '$instructions', gameAccess = '$access', devID = '$developerID',
            gFile = '$gameFileNameNew', gThumbnail = '$thumbFileNameNew'
            WHERE gameID= $mid";
    }
    else {
    $sql = "UPDATE Game SET gameName = '$gameName', gameGrade = '$grade', gameCategory = '$category', gameSubject = '$subject', 
        gameDescription = '$description', gameInstructions = '$instructions', gameAccess = '$access', devID = '$developerID'
        WHERE gameID= $mid";    
    }
    if(mysqli_query($conn, $sql)){
    header ("location: ../all-games.php?error=gmnone");
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>