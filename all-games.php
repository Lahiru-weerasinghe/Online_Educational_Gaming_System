  <link rel="styleSheet" href="css/sidebar.css" />
  <link rel="styleSheet" href="css/all-games.css" />
  <link rel="styleSheet" href="css/messagebox.css" />
  <?php 
      $title = 'All Games';
      include 'header.php'; 
      include_once ('./includes/admin-config.inc.php');
  ?>

    <div id="cbox" class="c-box">
      <span onclick="document.getElementById('cbox').style.display='none'" class="close" title="Close">×</span>
      <div class="c-box-content">
        <div class="content-container">
          <h2>Delete Game</h2>
          <p>Are you sure you want to delete this game?</p>
        
          <div class="c-buttons">
            <button onclick="document.getElementById('cbox').style.display='none'" class="cbtn">Cancel</button>
            <button onclick="deleteConfirm()" class="dbtn">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <div class="a-container">
      <?php include 'admin-sidebar.php'; ?>
      <div class="alg-container">
      <div id="msgbox-area" class="msgbox-area"></div>
        <h2>Games</h2>
        <div class = "table" >
        <table class = "games-table">
          <tr>
            <th>Game Name</th>
            <th>Grade</th>
            <th>Category</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Access Level</th>
            <th>Added By</th>
            <th>Developer</th>
            <th></th>
            <th></th>
          </tr>
          <?php
              require 'includes/database.inc.php';

              $sql = "SELECT gameID, gameName, gameGrade, gameCategory, gameSubject, gameDescription, gameAccess, adminID, devID FROM Game";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>'.$row["gameName"].'</td>';
                  echo '<td>'.$row["gameGrade"].'</td>';
                  echo '<td>'.$row["gameCategory"].'</td>';
                  echo '<td>'.$row["gameSubject"].'</td>';
                  echo '<td>'.$row["gameDescription"].'</td>';
                  echo '<td>'.$row["gameAccess"].'</td>';
                  echo '<td>'.$row["adminID"].'</td>';
                  echo '<td>'.$row["devID"].'</td>';
                  echo '<td><a href="modifygame.php?id='.$row['gameID'].'" class="tablebtn">Modify</a></td>';
                  echo '<td>
                        <button class="tablebtn2" type="submit" onClick="customConfirm('.$row['gameID'].')">Delete</button>
                        </td>';
                  echo '</tr>';
                }
              }
              else {
                echo '<tr>';
                echo '<td colspan="10">O Games Found!</td>';
                echo '</tr>';
              }
          ?>
        </table>
        </div>
      </div>
    </div>

<script>
  var deleteID = 0;
  function customConfirm(gid) {
    document.getElementById('cbox').style.display='block'
    deleteID = gid
  }
  function deleteConfirm() {
    window.location = 'includes/deletegame.inc.php?rowid='+deleteID;
  }
  var modal = document.getElementById('cbox');
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>

<script src="./js/messagebox.js"></script>
<?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "none") {
          echo '<script> msgboxbox.show("Game successfully deleted from the database"); </script>';
        }
        if ($_GET["error"] == "gmnone") {
          echo '<script> msgboxbox.show("Game successfully Modified"); </script>';
        }
        if ($_GET["error"] == "20") {
          echo '<script> msgboxbox.show("You can not upload a game file of this type!. only js,html are allowd"); </script>';
        }
        if ($_GET["error"] == "21") {
          echo '<script> msgboxbox.show("There was an error uplaoding game file!"); </script>';
        }
        if ($_GET["error"] == "22") {
          echo '<script> msgboxbox.show("Game file is too big!"); </script>';
        }
        if ($_GET["error"] == "23") {
          echo '<script> msgboxbox.show("You can not upload a thumbnail of this type!. only jpg,jpeg and png are allowd"); </script>';
        }
        if ($_GET["error"] == "24") {
          echo '<script> msgboxbox.show("here was an error uplaoding thumbnail!"); </script>';
        }
        if ($_GET["error"] == "25") {
          echo '<script> msgboxbox.show("Thumbnail is too big!"); </script>';
        }
      }
?>
  <?php include('./footer.php'); ?>
