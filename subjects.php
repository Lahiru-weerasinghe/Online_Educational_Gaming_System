<?php 
      $title = 'Home';
      include 'header.php'; 
?>
<link rel="stylesheet"  href="css/subjects.css">
<?php 
	require 'includes/database.inc.php';
	$sql = "SELECT * FROM Subject;";
	$result = mysqli_query($conn, $sql);

	echo '<div class="subject-container">';
	while($row = mysqli_fetch_assoc($result)) {
		echo '<div class="gbox">
			  <img src="images/'.$row["subjectName"].'.jpg" alt="'.$row["subjectName"].'">
			  <a href="games.php?subject='.$row["SID"].'"><h2>'.$row["subjectName"].'</h2></a>
			  </div>';
	}
	echo '</div>';
	mysqli_close($conn);
?>
<?php
  include('./footer.php'); 
?>