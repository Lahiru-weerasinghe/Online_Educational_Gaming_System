
  <link rel="styleSheet" href="css/admin-db.css" />
  <link rel="styleSheet" href="css/sidebar.css" />
  <?php 
      $title = 'Admin Dashboard';
      include 'header.php'; 
      include_once ('./includes/admin-config.inc.php');
  ?>
  <?php
    require 'includes/database.inc.php';

    $result = mysqli_query($conn, "SELECT COUNT(memberID) FROM Member");
    $totalMembers = mysqli_fetch_array($result);

    $result = mysqli_query($conn, "SELECT COUNT(memberID) FROM Member WHERE TID = 2");
    $freeMembers = mysqli_fetch_array($result);

    $result = mysqli_query($conn, "SELECT COUNT(memberID) FROM Member WHERE TID = 1");
    $premiumMembers = mysqli_fetch_array($result);

    $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()");
    $totalIncome = mysqli_fetch_array($result);

    echo '<script>
          document.addEventListener("DOMContentLoaded", () => {
            dbCounter("c1", 0, '.$totalMembers[0].', 2500);
            dbCounter("c2", 0, '.$premiumMembers[0].', 2500);
            dbCounter("c3", 0, '.$freeMembers[0].', 2500);
            dbCounter("c4", 0, '.$totalIncome[0].', 2500);
          });
          </script>';

    $result = mysqli_query($conn, "SELECT COUNT(memberID) FROM Membership WHERE m_status = 'Expired'");
    $overdueMembers = mysqli_fetch_array($result);

    $result = mysqli_query($conn, "SELECT COUNT(memberID) FROM Membership WHERE start_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()");
    $newMembers = mysqli_fetch_array($result);

    $result = mysqli_query($conn, "SELECT COUNT(MID)FROM Member AS M INNER JOIN Membership AS MM ON MM.memberID = M.memberID WHERE M.TID = 2 AND MM.start_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW();");
    $newFreeMembers = mysqli_fetch_array($result);

    $result = mysqli_query($conn, "SELECT COUNT(MID)FROM Member AS M INNER JOIN Membership AS MM ON MM.memberID = M.memberID WHERE M.TID = 1 AND MM.start_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW();");
    $newPremiumMembers = mysqli_fetch_array($result);

  ?>
  
  <div class="a-container">
      <?php include 'admin-sidebar.php'; ?>
      <div class="db-container">
        <div class="db-counter">
          <div class="counter-coulmn">
            <span id="c1" class="counter-item"></span>
            <h4>Total members</h4>
          </div>
          <div class="counter-coulmn">
            <span id="c2" class="counter-item"></span>
            <h4>Premium members</h4>
          </div>
          <div class="counter-coulmn">
            <span id="c3" class="counter-item"></span>
            <h4>Free members</h4>
          </div>
          <div class="counter-coulmn">
            <span id="c4" class="counter-item"></span>
            <h4>Total Income (Last 30 days)</h4>
          </div>
        </div>
        
        <div class="in-numbers">
          <?php
            echo '<div>
                  <div class="in-numbers-item">
                    <h3>Total Overdue Members:</h3>
                    <p>'.$overdueMembers[0].'</p>
                  </div>
                  <div class="in-numbers-item">
                    <h3>New Members Registerd in last 30 days:</h3>
                    <p>'.$newMembers[0].'</p>
                  </div>
                  <div class="in-numbers-item">
                    <h3>New Free Members Registerd in last 30 days:</h3>
                    <p>'.$newPremiumMembers[0].'</p>
                  </div>
                  <div class="in-numbers-item">
                    <h3>New Premium Members Registerd in last 30 days:</h3>
                    <p>'.$newFreeMembers[0].'</p>
                  </div>
                </div>'
          ?>
        </div>
        <div class="graph">
          <h3>Monthly Income (Past 12 Months)</h3>
          <canvas class="line-graph">
          </canvas>
        </div>
      </div>
    </div>
<script src="./js/admin-db.js"></script>
<?php 
  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 2 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 1 month)");
  $income1 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 3 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 2 month)");
  $income2 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 4 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 3 month)");
  $income3 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 5 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 4 month)");
  $income4 = mysqli_fetch_array($result);
  
  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 6 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 5 month)");
  $income5 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 7 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 6 month)");
  $income6 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 8 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 7 month)");
  $income7 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 9 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 8 month)");
  $income8 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 10 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 9 month)");
  $income9 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 11 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 10 month)");
  $income10 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 12 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 11 month)");
  $income11 = mysqli_fetch_array($result);

  $result = mysqli_query($conn, "SELECT COALESCE(SUM(amount),0) FROM Payment WHERE p_datetime BETWEEN last_day(curdate() - interval 13 month) + INTERVAL 1 DAY AND last_day(curdate() - interval 12 month)");
  $income12 = mysqli_fetch_array($result);

  $dateMonth = 'Month';
  echo "<script>
          let graphData = {
            '".date('Y-m', strtotime(date('Y-m').' -12 month'))."': ".$income12[0].",
            '".date('Y-m', strtotime(date('Y-m').' -11 month'))."': ".$income11[0].",
            '".date('Y-m', strtotime(date('Y-m').' -10 month'))."': ".$income10[0].",
            '".date('Y-m', strtotime(date('Y-m').' -9 month'))."': ".$income9[0].",
            '".date('Y-m', strtotime(date('Y-m').' -8 month'))."': ".$income8[0].",
            '".date('Y-m', strtotime(date('Y-m').' -7 month'))."': ".$income7[0].",
            '".date('Y-m', strtotime(date('Y-m').' -6 month'))."': ".$income6[0].",
            '".date('Y-m', strtotime(date('Y-m').' -5 month'))."': ".$income5[0].",
            '".date('Y-m', strtotime(date('Y-m').' -4 month'))."': ".$income4[0].",
            '".date('Y-m', strtotime(date('Y-m').' -3 month'))."': ".$income3[0].",
            '".date('Y-m', strtotime(date('Y-m').' -2 month'))."': ".$income2[0].",
            '".date('Y-m', strtotime(date('Y-m').' -1 month'))."': ".$income1[0].",
            };
          const entries = Object.entries(graphData);
          drawChart(entries);
        </script>";
        mysqli_close($conn); 
?>
<!-- <script>
  let graphData = {
  '01-21': 220,
  '02-21': 320,
  '03-21': 700,
  '04-21': 480,
  '05-21': 500,
  '06-21': 820,
  '07-21': 345,
  '08-21': 480,
  '09-21': 540,
  '10-21': 1000,
  '11-21': 790,
  '12-21': 1220,
  };
  const entries = Object.entries(graphData);
  drawChart(entries);
</script> -->
<?php include('./footer.php'); ?>

