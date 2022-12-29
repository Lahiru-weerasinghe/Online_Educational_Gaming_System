  <link rel="styleSheet" href="css/sidebar.css" />
  <link rel="styleSheet" href="css/all-members.css" />
  <link rel="styleSheet" href="css/messagebox.css" />
  <?php 
      $title = 'Add Members';
      include 'header.php'; 
      include_once ('./includes/admin-config.inc.php');
  ?>
    <div id="cbox" class="c-box">
      <span onclick="document.getElementById('cbox').style.display='none'" class="close" title="Close">×</span>
      <div class="c-box-content">
        <div class="content-container">
          <h2>Delete Member</h2>
          <p>Are you sure you want to delete this member?</p>
        
          <div class="c-buttons">
            <button onclick="document.getElementById('cbox').style.display='none'" class="cbtn">Cancel</button>
            <button onclick="deleteConfirm()" class="dbtn">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <div class="a-container">
      <?php include 'admin-sidebar.php'; ?>
      <div class="alm-container">
      <div id="msgbox-area" class="msgbox-area"></div>
        <h2>Members</h2>
        <div class = "table" >
        <table class = "member-table">
          <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Joined Date</th>
            <th>Current Rank</th>
            <th>Membership Type</th>
            <th>Plan</th>
            <th>Status</th>
            <th>Renewal Date</th>
            <th></th>
            <th></th>
          </tr>
          <?php
              require 'includes/database.inc.php';

              $sql = "SELECT M.memberID, M.username, M.firstName, M.lastName, M.m_rank, M.TID, ME.email, MM.m_plan, MM.m_status, MM.start_date, MM.renewal_date
              FROM Member AS M
              JOIN Member_email AS ME ON ME.memberID = M.memberID
              JOIN Membership AS MM ON MM.memberID = M.memberID";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>'.$row["firstName"].' '.$row["lastName"].'</td>';
                  echo '<td>'.$row["username"].'</td>';
                  echo '<td>'.$row["email"].'</td>';
                  echo '<td>'.$row["start_date"].'</td>';
                  echo '<td>'.$row["m_rank"].'</td>';
                  if($row["TID"] == 1){
                    echo '<td>Premium</td>';
                  }
                  else if($row["TID"] == 2){
                    echo '<td>Free</td>';
                  }
                  echo '<td>'.$row["m_plan"].'</td>';
                  echo '<td>'.$row["m_status"].'</td>';
                  echo '<td>'.$row["renewal_date"].'</td>';
                  echo '<td><a href="modifymember.php?id='.$row['memberID'].'" class="tablebtn">Modify</a></td>';
                  echo '<td>
                        <button class="tablebtn2" type="submit" onClick="customConfirm('.$row['memberID'].')">Delete</button>
                        </td>';
                  echo '</tr>';
                }
              }
              else {
                echo '<tr>';
                echo '<td colspan="10">O Members Found!</td>';
                echo '</tr>';
              }
          ?>
        </table>
        </div>
      </div>
    </div>

<script>
  var deleteID = 0;
  function customConfirm(mid) {
    document.getElementById('cbox').style.display='block'
    deleteID = mid
  }
  function deleteConfirm() {
    window.location = 'includes/deletemember.inc.php?rowid='+deleteID;
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
      echo '<script> msgboxbox.show("Member successfully deleted from the database"); </script>';
    }
    if ($_GET["error"] == "mmnone") {
      echo '<script> msgboxbox.show("Member successfully modified"); </script>';
    }
  }
?>

  <?php include('./footer.php'); ?>

