<link rel="stylesheet" href="css/SubscriptionSetting-Page.css" />
<link rel="stylesheet" href="css/sidebar.css" />

<?php
 $title = 'SubscriptionSetting -Page';
 include 'header.php';
 include_once ('./includes/user-config.inc.php');
?>

<div class="main-div">
  <div class="sub-div1">

     <?php
    include 'user-sidebar.php';
    ?>
  </div>


  <div class="sub-div2">
      <div class="sub-divContainer">
      <?php 
        $mid = $_SESSION["memberID"];
        $TID = $_SESSION["TID"];
        if($TID == 2){
          echo '<h3>Your Subscription : Free Membership</h3>';
          echo '<div class="button-div">';
          echo '<a href="payment.php"><button name="RenewNow"  class="RenewNow-button">Upgrade Now</button></a>';
          echo '</div>';
        }
        else if ($TID == 1){
          require_once 'includes/database.inc.php';
          $sql = "SELECT m_plan,renewal_date FROM membership WHERE memberID = $mid;";
          $result = mysqli_query($conn, $sql); 
          $row = mysqli_fetch_assoc($result);
          echo '<h3>Your Subscription : Premium Membership</h3>
                <h3>Plan              : '.$row["m_plan"].'</h3>
                <h3>Renewal Date      : '.$row["renewal_date"].'</h3>';
          echo '<div class="button-div">
                <a href="payment.php"><button type="submit" name="RenewNow"  class="RenewNow-button">Renew Now</button></a>
                <a href="includes/cancelSubscription.inc.php"><button type="submit" name="CancelSubscription"  class="CancelSubscription-button" onclick="return confirm(\'Are you sure? Cancel Subscription!\')" >Cancel Subscription</button></a>';
          mysqli_close($conn);
        }
      ?>
      </div>
      </div>

  </div>

</div>



<?php include('./footer.php'); ?>