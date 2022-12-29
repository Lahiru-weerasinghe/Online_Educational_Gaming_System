<?php
  session_start(); 
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php if (isset($title)) {echo "OEGPlay - "; echo $title;} else {echo "OEGPlay";} ?></title>
    <link rel="styleSheet" href="css/header.css" />
    <link rel="styleSheet" href="css/footer.css" />
    <nav class="navbar">
      <div class="logo-container">
        <a href="index.php"
          ><img src="images/OEGplay.png" alt="OEGPlay" class="nav-logo"
        /></a>
      </div>
      <div class="nav-container">
        <ul class="nav-links">
          <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item"><a href="games.php">Games</a></li>
          <li class="nav-item"><a href="subjects.php">Subjects</a></li>

          <?php 
            if (isset($_SESSION["memberID"])) {
              if ($_SESSION["TID"] == 2){
                echo '<li class="nav-item">'.'<a href="pricing.php">Pricing</a>'.'</li>';
              }
              echo '<li class="nav-item-profile">';
              echo '<div class="dropdown">
                      <button class="dropbtn">
                        <p>'.$_SESSION["firstName"].' '.$_SESSION["lastName"].'</p>';
              if(!is_null($_SESSION['proPic'])){
                  echo '<img class ="profile-img" src="uploads/userpropics/'.$_SESSION['proPic'].'" alt="ProfilePicture">';
              }
              else{
                  echo '<img class ="profile-img" src="images/defaultProfile.png" alt="ProfilePicture">';
              }
              echo '</button>
                    <div class="dropdown-content">
                        <a href="user-db.php?id='.$_SESSION["memberID"].'">My Dashboard</a>
                        <a href="usersettings.php?id='.$_SESSION["memberID"].'">Settings</a>
                        <a href="includes/logout.inc.php">Log Out</a>
                      </div>
                    </div>';
              echo '</li>';
            }
            else if (isset($_SESSION["adminID"])) {
              echo '<li class="nav-item-profile">';
              echo '<div class="dropdown">
                      <button class="dropbtn">
                        <p>'.$_SESSION["firstName"].' '.$_SESSION["lastName"].'</p>';
              if(!is_null($_SESSION['proPic'])){
                  echo '<img class ="profile-img" src="uploads/adminpropics/'.$_SESSION['proPic'].'" alt="ProfilePicture">';
              }
              else{
                  echo '<img class ="profile-img" src="images/defaultProfile.png" alt="ProfilePicture">';
              }
              echo '</button>
                      <div class="dropdown-content">
                        <a href="admin-db.php?id='.$_SESSION["adminID"].'">My Dashboard</a>
                        <a href="admin-settings.php?id='.$_SESSION["adminID"].'">Settings</a>
                        <a href="includes/logout.inc.php">Log Out</a>
                      </div>
                    </div>';
              echo '</li>';
            }
            else {
              echo '<li class="nav-item"><a href="pricing.php">Pricing</a></li>';
              echo '<li class="nav-item-signin"><a href="login.php">Sign In </a></li>';
              echo '<li class="nav-item-signup"><a href="signup.php">Sign Up </a></li>';
            }
          ?>
        </ul>
      </div>
    </nav>
  </head>
  <body>
