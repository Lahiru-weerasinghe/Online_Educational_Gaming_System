<link rel="styleSheet" href="css/sidebar.css" />
<link rel="styleSheet" href="css/admin-settings.css" />
<link rel="styleSheet" href="css/messagebox.css" />
<?php 
      $title = 'Edit Profile';
      include 'header.php'; 
      include_once ('./includes/admin-config.inc.php');
?>

<!-- Confirm Box -->
<div id="cbox" class="c-box">
    <span onclick="document.getElementById('cbox').style.display='none'" class="close" title="Close">×</span>
    <div class="c-box-content">
    <div class="content-container">
        <h2>Save Profile</h2>
        <p>Are you sure?</p>
    
        <div class="c-buttons">
        <button onclick="document.getElementById('cbox').style.display='none'" class="cbtn">Cancel</button>
        <button onclick="submitForm()" class="dbtn">Save</button>
        </div>
    </div>
    </div>
</div>

<div id="cbox2" class="c-box">
    <span onclick="document.getElementById('cbox2').style.display='none'" class="close" title="Close">×</span>
    <div class="c-box-content">
    <div class="content-container">
        <h2>Change Password</h2>
        <p>Are you sure?</p>
    
        <div class="c-buttons">
        <button onclick="document.getElementById('cbox2').style.display='none'" class="cbtn">Cancel</button>
        <button onclick="passChangeSubmit()" class="dbtn">Save</button>
        </div>
    </div>
    </div>
</div>

<div class="a-container">
      <?php include 'admin-sidebar.php'; ?>
    
      <div class="setting-form">
        <div id="msgbox-area" class="msgbox-area"></div>
        <form action="includes/edit-admin.php" method="post" enctype="multipart/form-data">
          <div class="form-item">
            <label for="profilepic">Change Profile Picture:</label>
            <input type="file" name="profilepic" id="profilepic" onchange="previewImage(event)"/>
          </div>
          <div class="selected-image">
            <img id="prevIMG" alt="No Image Selected"/>
          </div>
          <?php
            echo '<div class="form-item">
                    <label for="fname">Chane First Name:</label>
                    <input type="text" name="fname" id="fname" value="'.$_SESSION["firstName"].'" required />
                  </div>';
            echo '<div class="form-item">
                    <label for="lname">Change Last Name:</label>
                    <input type="text" name="lname" id="lname" value="'.$_SESSION["lastName"].'" required />
                  </div>';
            $aid = $_SESSION['adminID'];
            require 'includes/database.inc.php';
            $result = mysqli_query($conn, "SELECT email FROM Administrator_email WHERE adminID= $aid");
            $adminEmail = mysqli_fetch_array($result);
            echo '<div class="form-item">
                    <label for="email">Change Email:</label>
                    <input type="text" name="email" id="email" value="'.$adminEmail[0].'" required />
                  </div>';
          ?>
          <div class="as-buttons">
            <button class="save-btn" type="button" onclick="submitConfirm()">Save</button>
            <button class="psave-btn" id="submit" name="sumbit" type="submit">Save</button>
          </div>
        </form>
        <form action="includes/change-admin-pass.php" method="post">
          <div class="form-item">
            <label for="change-pass">Change password:</label>
            <div id="change-pass">
                <input type="password" placeholder="Current Password" name="old-pass" id="old-pass" required/>
                <input type="password" placeholder="New Password" name="new-pass" id="new-pass" required/>
                <input type="password" placeholder="Confirm New Password" name="cnew-pass" id="cnew-pass" required/>
            </div>
          </div>
          <div class="as-buttons">
            <button class="save-btn" type="button" onclick="passChangeConfirm()">Change</button>
            <button class="psave-btn" id="submit2" name="sumbit" type="submit">Change</button>
          </div>
        </form>
      </div>
</div>
<script>
  function submitConfirm() {
    document.getElementById('cbox').style.display='block'
  }
  function submitForm() {
    document.getElementById('cbox').style.display='none'
    document.getElementById("submit").click();
  }
  function passChangeConfirm() {
    document.getElementById('cbox2').style.display='block'
  }
  function passChangeSubmit() {
    document.getElementById('cbox2').style.display='none'
    document.getElementById("submit2").click();
  }
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
<script src="./js/messagebox.js"></script>

<?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "none") {
            echo '<script>
                    msgboxbox.show(
                    "Settings Saved!"
                );
                </script>';
        }
        if ($_GET["error"] == "passnone") {
            echo '<script>
                    msgboxbox.show(
                    "Password Changed!"
                );
                </script>';
        }
        if ($_GET["error"] == "emailtaken") {
            echo '<script>
                    msgboxbox.show(
                    "Email is taken!"
                );
                </script>';
        }
        if ($_GET["error"] == "3") {
            echo '<script>
                    msgboxbox.show(
                    "You can not upload a profile picture of this type!. only jpg,jpeg and png are allowd"
                );
                </script>';
        }
        if ($_GET["error"] == "2") {
            echo '<script>
                    msgboxbox.show(
                    "here was an error uplaoding profile picture!"
                );
                </script>';
        }
        if ($_GET["error"] == "1") {
            echo '<script>
                    msgboxbox.show(
                    "Profile picture is too big!"
                );
                </script>';
        }
        if ($_GET["error"] == "passwordsdontmatch") {
            echo '<script>
                    msgboxbox.show(
                    "New Password and Confirm New password does not match!"
                );
                </script>';
        }
        if ($_GET["error"] == "wrongpass") {
            echo '<script>
                    msgboxbox.show(
                    "Wrong Password!"
                );
                </script>';
        }
    }
?>
<?php include('./footer.php'); ?>

