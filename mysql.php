<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- mysql.php: database address, name, password, and username -->
<?php
	
		$conn = mysqli_connect("oniddb.cws.oregonstate.edu", "sharkazm-db", "wPb48qsJFnowXv5n", "sharkazm-db");
			if (mysqli_connect_errno($conn)) {
				echo "Failed to connect to server<br><br>";
			} 
?>
