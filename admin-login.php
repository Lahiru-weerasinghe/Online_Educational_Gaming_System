<?php 
      $title = 'Admin Log in';
      include 'header.php'; 
?>
<link rel="styleSheet" href="css/login.css" />
<section class="main-container">
<div class="lg-container">
  <h2>ADMIN SIGN IN</h2>
  <div class="login">
    <form method="POST" action="includes/admin-login.inc.php">
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
            echo "<p>Fill in all fields!</p>";
        }

        else if ($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login information!</p>";
        }
    
    }
?>
</div>
<div class="bg-img">
    <img src="images/adminlogin-bg.png" alt="Sign Up">
</div>
</section>

<?php
    include_once 'footer.php';
?>
