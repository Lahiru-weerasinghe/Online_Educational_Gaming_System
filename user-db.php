    

    <link rel="styleSheet" href="css/user-db.css" />
    <link rel="styleSheet" href="css/sidebar.css" />
    <?php 
      $title = 'Dashboard';
      include 'header.php'; 
      include_once ('./includes/user-config.inc.php');
    ?>
  

  
    <div class="u-container">
      <?php include 'user-sidebar.php'; ?>
      <div class="db-container">
        <div class="history">
            <p id="p2">MY SCORE</p>
            <?php 
              $mid = $_SESSION["memberID"];
              require_once 'includes/database.inc.php';

              $result = mysqli_query($conn, "SELECT COALESCE(SUM(score),0) FROM History WHERE memberID = $mid;");
              $totalScore = mysqli_fetch_array($result);
              echo '<h2>'.$totalScore[0].'</h2>';
            ?>
            <table style="width: 100%" border="1" > 
               <tr>
                   <th>Game</th>
                   <th>Time</th>
                   <th>Score</th>
               </tr>
               <tbody class="table-body">
                 <?php 
                    $result = mysqli_query($conn, "SELECT gameID, h_datetime, score FROM History WHERE memberID = $mid");

                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        $gid = $row["gameID"];
                        $result2 = mysqli_query($conn, "SELECT gameName FROM Game WHERE gameID = $gid");
                        $gameName = mysqli_fetch_array($result2);
                        echo '<tr>';
                        echo '<td>'.$gameName[0].'</td>';
                        echo '<td>'.$row["h_datetime"].'</td>';
                        echo '<td>'.$row["score"].'</td>';
                        echo '</tr>';
                      }
                    }
                 ?>
               </tbody>

            </table>
        </div>
        <br /> <br /> 
        <div class="stats">
            <p id="p3"><b> My Status </b><br><br>
          
            <?php 
              if($_SESSION["TID"] == 1) {
                $sub = "Premium";
              }
              if($_SESSION["TID"] == 2) {
                $sub = "Free";
              }
              $result = mysqli_query($conn, "SELECT start_date FROM membership WHERE memberID = $mid;");
              $memberSince = mysqli_fetch_array($result);
              $result = mysqli_query($conn, "SELECT m_rank FROM member WHERE memberID = $mid;");
              $memberRank = mysqli_fetch_array($result);
              $result = mysqli_query($conn, "SELECT COALESCE(COUNT(DISTINCT `gameID`),0) FROM history WHERE memberID = $mid;");
              $gamesPlayed = mysqli_fetch_array($result);

              echo 'Type of subscription :- '.$sub.'<br><br>
              Member since :- '.$memberSince[0].'<br><br>
              Number of games played :- '.$gamesPlayed[0].'<br><br>
              Rank :- '.$memberRank[0].''
            ?>
          </p>
            <img src="images/db_Pic.png" class="db-pic" >
        </div>
      </div>
    </div>
 

  <?php include('./footer.php'); ?>