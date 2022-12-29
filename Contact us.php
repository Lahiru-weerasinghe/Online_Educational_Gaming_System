<link rel="styleSheet" href="css/Contact us.css" />
    <?php 
      $title = 'Contact Us';
      include 'header.php'; 
    ?>
    
    <!--content of the page-->
    <h3 id="heading1">If you have questions or just want to get in touch,<br> use the form below</h3>
   
    <br>

    <!--Add a form-->
    <div class="cu-body">
    <form action="includes/contact.inc.php" method="post">
      <label for="email">Your e-mail address</label></br>
      <input type="email" class="fields" id="email" name="email" required></br>

      <label for="name">Full name</label></br>
      <input type="text" class="fields" id="name" name="name" required></br>

      <label for="subject">Subject</label></br>
      <input type="text" class="fields" id="subject" name="subject" required></br>

      <label for="description">Description</label></br>
      <textarea id="descr" name="description" required></textarea></br>

      we will respond as soon as possible
      <br><br />
      <input type="reset"  class="btn1" name="reset" value="Reset" onclick="return confirm('Are you sure?')">
      <input type="submit" class="btn2" name="submit" value="Submit" onclick="return confirm('Are you sure?')">
    </form>
    </div>

    <?php include('./footer.php'); ?>
    
    <?php
    /*check errors in contact us page */
    
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "none") {
            
            echo '<script language="javascript">';
            echo 'alert("Successfully done")';
            echo '</script>';
        }
    }
    ?>

