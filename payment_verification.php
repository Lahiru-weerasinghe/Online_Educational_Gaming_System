<link rel="stylesheet" href="../OEGPlay/css/payment_verification.css" />
  <?php 
      $title = 'payment verification';
      include 'header.php'; 
  ?>

  <!--start content of the page-->
  <div class="payment_alert">
  <img src="../OEGPlay/images/clipart2707415.png" alt="payment_verification" width="200" />
  
  <h1> Payment Succsessfull</h1>
  <p>You are now a premium member</p>
  <button style="display: flex;flex-direction: row;justify-content: center;align-items:center ;">start playing <img src="../OEGPlay/images/download.png" width="15" alt=""></button>
  

  </div>

  <div class="payment_alert">
  <img src="../OEGPlay/images/failed-icon-7.jpg" alt="payment_verification" width="200" />
 
  <h1> Payment failed</h1>
  

  </div>


<!--End content of the page-->

   <?php include('./footer.php'); ?>
