<?php 
      $title = 'Sign Up';
      include 'header.php'; 
?>
<link rel="styleSheet" href="css/signup.css" />

<section class="main-container">
<div class="su-container">
  <h1>SIGN UP</h1>
  <div class="signup-form">
    <form action="includes/signup.inc.php" method="POST">
      <div class="form-row">

        <input required placeholder="First Name..." type="text" name="fname" />
        <input required placeholder="Last Name..." type="text" name="lname" />
      </div>
      
      <input required placeholder="Email..." type="text" name="email" />
      <input required placeholder="Username..." type="text" name="uname" />
      <input required placeholder="Password..." type="password" name="pwd" />
      <input required placeholder="Confirm Password..." type="password" name="repwd"/>

      <p>
        by submitting this form you agree to our <a href="#">terms of use</a>
      </p>

      <button class="submit-btn" type="submit" name="submit">SIGN UP</button>

    </form>
  </div>
  <p>Already a member ? <a href="login.php">Log In!</a></p>
</div>
<div class="bg-img">
    <img src="images/signup-bg.png" alt="Sign Up">
</div>
<?php
    /*check errors in sign up */
    
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            
            echo '<script language="javascript">';
            echo 'alert("Fill in all fields!")';
            echo '</script>';
        }

        else if ($_GET["error"] == "invalidemail") {
            
            echo '<script language="javascript">';
            echo 'alert("Choose a proper e-mail!")';
            echo '</script>';
        }

        else if ($_GET["error"] == "usernametaken") {
            
            echo '<script language="javascript">';
            echo 'alert("username already taken!")';
            echo '</script>';
        }

        else if ($_GET["error"] == "passwordsdontmatch") {
            
           
            echo '<script language="javascript">';
            echo 'alert("Passwords does not match!")';
            echo '</script>';
        }

        else if ($_GET["error"] == "stmtfailed") {
            
            echo '<script language="javascript">';
            echo 'alert("Something went wrong, Try again!")';
            echo '</script>';
        }

        else if ($_GET["error"] == "emailtaken") {
            
            echo '<script language="javascript">';
            echo 'alert("E-mail already taken!")';
            echo '</script>';
        }

        else if ($_GET["error"] == "none") {
            
            echo '<script language="javascript">';
            echo 'alert("You have signed up! Now please login")';
            echo '</script>';

        }
      
    }
?>
</section>

<?php
    include_once 'footer.php';
?>


      <!-- <div class="seperator"><b>Or</b><b>Sign</b><b>In</b><b>With</b></div> -->

      <!-- <div class="socialIcon">
        <a class="btn1" href="#">
          <img class="social" src="images/Facebook.png" />
        </a>

        <a class="btn1" href="#">
          <img class="social" src="images/Twitter.png" />
        </a>

        <a class="btn1" href="#">
          <img class="social" src="images/G-mail.png" />
        </a>
      </div> -->
