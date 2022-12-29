<?php 
      $title = 'User Dashboard';
      include 'header.php'; 
      include_once ('./includes/user-config.inc.php');
?>
    <link href="css/userDashboard.css" rel="stylesheet" type="text/css">
    <?php include 'user-sidebar.php'; ?>
        <div class="vl"></div>

        <div class="div1">
           <p id="p2">MY SCORE</p>
           <div class="div2">
             <b>123456</b></div>
             <br><br>
             <p id="p2">GAME HISTORY(Hide the game history)</p>

           <table style="width: 100%" border="1">
               <tr>
                   <td colspan="3">Clear history</td>
               </tr>
               <tr>
                   <td>Game</td>
                   <td>Time</td>
                   <td>Score</td>
               </tr>
               <tr id="row1">
                 <td></td>
                 <td></td>
                 <td></td>
               </tr>
               
           </table>
           <div class="div3">
             <p id="p3">
               <center>My Status</center>
            </p>
            Type of subscription :- Premium<br><br>
            Member since :- 21/01/2021<br><br>
            Total time played :- 4:45:34<br><br>
            Number of games played :- 24<br><br>
            Rank :- Gold<br>
           </div>
        </div>
<?php 
    include 'footer.php'; 
?>