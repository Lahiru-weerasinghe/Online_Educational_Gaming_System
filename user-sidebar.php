<div class = "admin-sidebar">
        <div class = "profile">
             <?php 
                if(!is_null($_SESSION['proPic'])){
                    echo '<img class = "propic" src="uploads/userpropics/'.$_SESSION['proPic'].'" alt="ProfilePicture">';
                }
                else{
                    echo '<img class = "propic" src="images/defaultProfile.png" alt="ProfilePicture">';
                }
                
                echo '<p class="a-name">'.$_SESSION["firstName"].' '.$_SESSION["lastName"].'</p>';
            
                if ($_SESSION['TID'] == 1){
                    echo '<h5 class="role">Premium Member</h5>';
                }
                else if ($_SESSION['TID'] == 2){
                    echo '<h5 class="role">Free Member</h5>';
                }
            
            ?> 
        </div>
        <div class = "sidemenu">
            <ul class = "sidemenu-items">
                <a href="/OEGPlay/user-db.php"><li class="sidemenu-item">Dashboard</li></a>
                <a href="/OEGPlay/SubscriptionSetting-Page.php"><li class="sidemenu-item">Subscription</li></a>
                <a href="/OEGPlay/userSettings.php"><li class="sidemenu-item">Settings</li></a>
                <a href="includes/logout.inc.php"><li class="sidemenu-item">Log out</li></a>
            </ul>
        </div>
    </div>