        <link rel="stylesheet" href="css/userSettings.css" />
        <link rel="styleSheet" href="css/sidebar.css" />
        <?php 
            $title = 'Settings';
            include 'header.php'; 
            include_once ('./includes/user-config.inc.php');

            require_once 'includes/database.inc.php';
            $mid = $_SESSION['memberID'];
            $result = mysqli_query($conn, "SELECT firstName, lastName FROM member WHERE memberID = $mid;");
            $memberDetails = mysqli_fetch_array($result);
            $fName = $memberDetails[0];
            $lName = $memberDetails[1];

            $result = mysqli_query($conn, "SELECT email FROM member_email WHERE memberID = $mid;");
            $memberEmail = mysqli_fetch_array($result);
            $email = $memberEmail[0];

            mysqli_close($conn); 
        ?>

    <div class="st-container">
        <?php include "user-sidebar.php"; ?>

       <div class="setting-form">
       <form class="form-details" method="post" action="includes/edituserprofile.inc.php" enctype="multipart/form-data">
          
          <div class="form-item">
          <label for="propic">Change Profile Picture:    </label>
          <input type ="file" id="propic" name="propic" onchange="previewImage(event)"/>
          </div>

          <div class="selected-image">
            <img id="prevIMG" alt="No Image Selected"/>
          </div>

          <?php 
            echo '<div class="form-item">';
            echo '<label for="name">Change First Name:     </label>
                <input type="text" class="fields" id="fname" name="fname" value = "'.$fName.'" required />';
            echo '</div>';

            echo '<div class="form-item">';
            echo '<label for="name">Change Last Name:     </label>
                <input type="text" class="fields" id="lname" name="lname" value = "'.$lName.'" required/>';
            echo '</div>';

            echo '<div class="form-item">';
            echo '<label for="email">Change E-mail:    </label>
                <input type="email" class="fields" id="email" name="email" placeholder="abcTest@gmail.com" value = "'.$email.'"required/>';
            echo '</div>';
          ?>
          <div class="us-buttons">
            <button type="submit" name="submit" class="save-button" onclick="return confirm('Are you sure?')">Save</button>
          </div>
        </form>
        
        <form class="pass-form" method="post" action="includes/changeuserpassword.inc.php">
          <div class="form-item">
            <label for="change-pass">Change Password:    </label>
            <div id =change-pass>
                <input required type="password" maxlength="50" id="pwd" name="pwd" placeholder="Current password"/>
                <input required type="password" maxlength="50" id="pwd1" name="pwd1" placeholder="New password"/>
                <p><font size="1" color="red">(*minimum 8 characters)</font></p>
                <input required type="password" maxlength="50" id="pwd1" name="pwd2" placeholder="Confirm password"/>
            </div>
          </div>
          <div class="us-buttons">
            <button type="submit" name="changepass" class="save-button" onclick="return confirm('Are you sure?')">Save</button>
          </div>
       </form>
       
       <form action="includes/deleteuser.inc.php" method="post">
          <div class="form-item">
            <label for="delete">Delete account:   </label>
            <button type="submit" name="delete" id = "delete" class="delete-button" onclick="return confirm('Are you sure? This cannot be undone!')">Delete</button>
          </div>
       </form>
    </div>
    <?php
    /*check errors in user settings page */
    
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
          echo 'alert("Successfully saved your changes!!!")';
          echo '</script>';

      }

    }
?>     
    </div>

<script>
  function previewImage(event) {
    var imageReader = new FileReader();
    imageReader.onload = function()
    {
      var image = document.getElementById('prevIMG');
      image.src = imageReader.result;
    }
    imageReader.readAsDataURL(event.target.files[0]);
    }
</script>

    <?php include "footer.php"; ?>
