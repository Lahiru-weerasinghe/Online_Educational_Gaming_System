<link rel="styleSheet" href="css/game-page.css" />
<?php 
    if (isset($_GET["gameID"])) {
        $gID = $_GET["gameID"];
        require 'includes/database.inc.php';

        $sql = "SELECT * FROM Game WHERE gameID = $gID";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $gName = $row['gameName'];
        $gDescription = $row['gameDescription'];
        $gInstructions = $row['gameInstructions'];
        $gFile = $row['gFile'];
        $gSubject = $row['gameSubject'];
        $gGrade = $row['gameGrade'];
        $gCategory = $row['gameCategory'];
    }
    else {
        header ("location: ./games.php");
    }

    $title = $gName;
    include 'header.php';
    include ('includes/user-config.inc.php');

    echo '<div class="game-container">';
    echo '<h1 class="game-name">'.$gName.'<h2>';
    echo '<p class="game-desc">'.$gDescription.'</p>';
    include('./games/gamefiles/'.$gFile.'');
    echo '<form name="save" action="includes/save-results.php" method="post">
                <input type="hidden" name="gameID" value="'.$gID.'">
                <input type="text" id="score" name="score">
                <button id="save-btn" type="submit" name="submit">Save Results</button>
            </form></div>';
    echo '<p class="game-ins">'.$gInstructions.'</p>';
    echo '</div>';

    include('./footer.php');
?>




