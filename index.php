<?php 
      $title = 'Home';
      include 'header.php'; 
    ?>
<!--css link part-->
<link rel="stylesheet" type="text/css" href="css/h.css">
<!--<link rel="stylesheet" type="text/css" href="css/Style1.css">-->
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="images/1.jpg" style="width:100%">
  <div class="text">Play</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="images/4.jpg" style="width:100%">
  <div class="text">Play</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="images/3.jpg" style="width:100%">
  <div class="text">Play</div>
</div>


<div class="mySlides fade">
  <div class="numbertext">3 / 4</div>
  <img src="images/2.jpg" style="width:100%">
  <div class="text">Play</div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span>
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

<!--brows by grade-->

<h1>Browse by Grade</h1>

<div class="btn-group">
  <button>Grade-1</button>
  <button>Grade-2</button>
  <button>Grade-3</button>
  <button>Grade-4</button>
  <button>Grade-5</button>
  <button>Grade-6</button>
</div>
<br><br>
<hr>

  <!--popular subject-->

  <h1>Popular Subjects</h1>
<div class="subjects-btn">
  <button class="bon">Mathematics</button>
  <button class="bon">Science</button>
  <button class="bon">English</button>
  <button class="bon">History</button>
  <button class="bon">Health</button>
</div> 

<br><br><br>

<hr>

<!--popular Game-->
<div class="game-header">
  <h1>Popular Games</h1>
  <a href="games.php">
    <button class="butt"><span>View AllGames </span></button>
  </a>
  <form action="search.php" method="get">
  <label>Search Games</label>
  <input type="text" name="search">
  <input type="submit" value="Search">
</div>

<div class="game-container">
<?php 
  require 'includes/database.inc.php';
  $count = 1;
  $sql = "SELECT gameID, gameName, gameGrade, gameCategory, gameSubject, gameAccess, gThumbnail FROM Game";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    // if($count < 5){
    echo '<div class="box">
          <div class="bicon">
          <img src="games/thumbnails/'.$row["gThumbnail"].'" class="logbcon">
          </div>
          <h3>'.$row["gameName"].'</h3>
          <button class="playBTN">
          <a href="game.php?gameID='.$row["gameID"].'">Play 🎮</a></button>
          <h4>'.$row["gameCategory"].'/'.$row["gameGrade"].'</h4>
          
          </div>';
    //   $count = $count + 1;
    // }
  }
?>
</div>
<?php
include 'footer.php';
?>