<?php 
      $title = 'Log in';
      include 'header.php'; 
?>
<link rel="styleSheet" href="css/login.css" />
<section class="main-container">
<div class="lg-container">
  <h2>SIGN IN</h2>
  <div class="login">
    <form method="POST" action="includes/login.inc.php">
      <input
        type="text"
        name="username"
        id="username"
        placeholder="Username..."
        required
      />
      <input
        type="password"
        name="pwd"
        id="pwd"
        placeholder="Password..."
        maxlength="10"
        required
      />
      <div class="form-row3">
        <div class="checkbox-container">
            <span>Remember Me</span>
            <input type="checkbox" name="remember" id="remember" />
        </div>
        <a class="reset-psw" href="#">Forgot Password?</a>
      </div>
      <button type="submit" class="submit-btn" name="log" id="log">
        LOG IN
      </button>
    </form>
  </div>
  <p>Not a Member yet? <a href="signup.php" class = "formlink2" >Register Now!</a></p>
 
<?php
    /*check whether empty inputs */
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            
            echo '<script language="javascript">';
            echo 'alert("Fill in all fields!")';
            echo '</script>';
        }
 
        else if ($_GET["error"] == "wronglogin") {
            
            echo '<script language="javascript">';
            echo 'alert("Incorrect login information!")';
            echo '</script>';
        }
    
    }
?>
</div>
<div class="bg-img">
    <img src="images/login-bg.png" alt="Sign Up">
</div>
</section>
 
<?php
    include_once 'footer.php';
?>
 
      <!-- <p class="or">Or Sign In With</p>
 
      <div class="socialIcon">
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