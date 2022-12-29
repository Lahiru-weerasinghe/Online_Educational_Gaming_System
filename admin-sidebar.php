<div class = "admin-sidebar">
        <div class = "profile">
            <?php 
                if(!is_null($_SESSION['proPic'])){
                    echo '<img class = "propic" src="uploads/adminpropics/'.$_SESSION['proPic'].'" alt="ProfilePicture">';
                }
                else{
                    echo '<img class = "propic" src="images/defaultProfile.png" alt="ProfilePicture">';
                }
            ?>         
            <?php echo '<p class="a-name">'.$_SESSION["firstName"].' '.$_SESSION["lastName"].'</p>'?>
            <h5 class="role">Administrator</h5>
        </div>
        <div class = "sidemenu">
            <ul class = "sidemenu-items">
                <a href="admin-db.php"><li class="sidemenu-item">Dashboard</li></a>
                <a href="add-games.php"><li class="sidemenu-item">Add Games</li></a>
                <a href="all-games.php"><li class="sidemenu-item">All Games</li></a>
                <a href="all-members.php"><li class="sidemenu-item">Members</li></a>
                <a href="admin-settings.php"><li class="sidemenu-item">Settings</li></a>
                <a href="includes/logout.inc.php"><li class="sidemenu-item">Log out</li></a>
            </ul>
        </div>
    </div>