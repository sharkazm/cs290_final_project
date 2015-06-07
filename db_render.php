<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- db_render.php: shows the main page of the dating website. The page
  shows the logged in user's preferences or form to set preferences,
  fields to add hobbies and favorite places and also shows hobbies and favorite
  places as tables. It also shows favorited users and all users in table form -->
<?php
session_start();
if ($_SESSION["logged_on"] != 1){
	header("Location: db_login.php");
}
    $conn = mysqli_connect("oniddb.cws.oregonstate.edu", "sharkazm-db", "wPb48qsJFnowXv5n", "sharkazm-db");
      if (mysqli_connect_errno($conn)) {
        echo "Failed to connect to server<br><br>";
      } 
include 'db_header.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">      
  <title align = "center">Welcome to the Dating Database</title>  
  <style>
    table, td, th{border-style: ridge; 
          background-color:white;
          background-size: 75%;
          border-width: thick; 
          border-color:#99CCFF; 
          border-collapse: collapse; 
          width: 50%;
          margin: auto;
          table-layout: center; 
          text-align: center; 
          padding: 10px;
          font-family: Century Gothic, sans-serif;};
  </style>
</head>
<body style = "background-color:#CC0033">
  <div style = "font-family: Century Gothic, sans-serif;
                text-align: center; 
                background-color: white; 
                padding:10px; 
                margin-left: 15%;
                margin-right: 15%; 
                border-style: ridge; 
                border-width: thick; 
                border-color:#99CCFF">

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select an image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="image_submit">
    </form>
	
<?php
	
		$usn = $_GET['usn'];
		$sql = "SELECT * FROM db_users WHERE username='".$usn."'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);
		$id = $row['id'];	//current user id
		$fname = $row['fname'];
		$prefset = $row['prefset'];
		$gender = $row['gender'];

		//have user set their preferences if not has been set
		if ($prefset == 0){
			echo "<h3>Please set your preferences</h3>";
			echo "<form method='post' action='setpref.php'>";
			
			//select gender
			echo "<div class='form-group'>";
        	$res = "SELECT gender FROM db_gender";
        	$results = mysqli_query($conn, $res);
        	$categories = array();
        	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['gender'];
        	}
      		echo "<label for='gender'>Gender </label>";
      		echo "<select name='gender' id='gender'>";
         	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
      		echo "</div><br />";

      		//select age
      		echo "<div class='form-group'>";
        	$res = "SELECT age FROM db_age";
        	$results = mysqli_query($conn, $res);
        	$categories = array();
        	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['age'];
        	}
      		echo "<label for='age'>Age </label>";
      		echo "<select name='age' id='age'>";
        	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
    		echo "</div><br />";

    		//select ethnicity
    		echo "<div class='form-group'>";
        	$res = "SELECT ethnicity FROM db_ethnicity";
        	$results = mysqli_query($conn, $res);
        	$categories = array();
       	 	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['ethnicity'];
        	}
      		echo "<label for='ethnicity'>Ethnicity </label>";
      		echo "<select name='ethnicity' id='ethnicity'>";
        	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
    		echo "</div><br />";

    		//select education
    		echo "<div class='form-group'>"; 
        	$res = "SELECT education FROM db_education";
        	$results = mysqli_query($conn, $res);
        	$categories = array();
       	 	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['education'];
        	}
       		echo "<label for='education'>Education </label>";
      		echo "<select name='education' id='education'>";
        	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
    		echo "</div><br />";

    		//select height
    		echo "<div class='form-group'>";
        	$res = "SELECT height FROM db_height";
       		$results = mysqli_query($conn, $res);
       		$categories = array();
        	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['height'];
        	}
      		echo "<label for='height'>Height </label>";
      		echo "<select name='height' id='height'>";
        	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
    		echo "</div><br />";

    		//select build
    		echo "<div class='form-group'>";
        	$res = "SELECT build FROM db_build";
        	$results = mysqli_query($conn, $res);
        	$categories = array();
        	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['build'];
        	}
      		echo "<label for='build'>Build </label>";
      		echo "<select name='build' id='build'>";
        	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
    		echo "</div><br />";

    		//select location
    		echo "<div class='form-group'>";
        	$res = "SELECT location FROM db_location";
       	 	$results = mysqli_query($conn, $res);
        	$categories = array();
        	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['location'];
        	}
      		echo "<label for='location'>Location </label>";
      		echo "<select name='location' id='location'>";
        	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
    		echo "</div><br />";
    		echo "<input type='hidden' name='id' value=$id />";
      		echo "<input type='hidden' name='usn' value=$usn />";
			echo "<input type='submit' name='pref_submit' value='Submit' />";	//user id and username sent via post
      		echo "</form>";
		}

		//show preferences if set
		else{
			echo "<h3>$fname's Preferences</h3>";
			$sql2 = "Select p.gender, p.age, p.ethnicity, p.education, p.height, p.build, p.location from db_preferences p INNER JOIN 
					db_users u ON u.id = p.user_id WHERE u.id = '".$id."'";
			$res2 = mysqli_query($conn, $sql2);

			echo "<table border='1'><tr><td>Gender</td><td>Age</td><td>Ethnicity</td><td>Education</td><td>Height</td><td>Build</td><td>Location</td></tr>";
			if (mysqli_num_rows($res2) > 0){
				while ($row = mysqli_fetch_assoc($res2)){
					echo "<tr><td>".$row['gender']."</td><td>".$row['age']."</td><td>".$row['ethnicity']."</td><td>".$row['education']."</td><td>".$row['height']."</td><td>".$row['build']."</td><td>".$row['location']."</td></tr>";
				}
				echo "</table>";
			}
		}

		//show user's hobby
		echo "<h3>$fname's Hobbies</h3>";
		echo "<form method='post' action='db_hobbies.php'>";
		echo "<input type='hidden' name='id' value=$id />";
		echo "<input type='hidden' name='usn' value=$usn />";
		echo "<input type='name' name='hobby' id='hobby' minlength = 0 placeholder='Enter a new hobby' /><br />";
		echo "<input type='submit' name='hobby_submit' value='Add Hobby' />";	//user id is sent via post
		echo "</form><br />";
		$hob_sql = "SELECT id, name from db_hobbies WHERE user_id='".$id."'";
		$hob_res = mysqli_query($conn, $hob_sql);
		if (mysqli_num_rows($hob_res) > 0){
			echo "<table border='1'><tr><td>Hobby</td></tr>";
			while ($hob_row = mysqli_fetch_assoc($hob_res)){
				echo "<tr><td>".$hob_row['name']."</td><td><a href=db_hobbies.php?usn=$usn&id1=$id&hobbyid=".$hob_row['id'].">Remove</a></td></tr>";
			}
			echo "</table>";
		}
		else{
			echo "There are no hobbies added yet.<br />";
		}

		//show users favorite places
		echo "<h3>$fname's Favorite places</h3>";
		echo "<form method='post' action='db_favoriteplaces.php'>";
		echo "<input type='hidden' name='id' value=$id />";
		echo "<input type='hidden' name='usn' value=$usn />";
		echo "<input type='name' name='fav_place' id='fav_place' placeholder='Enter a favorite place' /><br /><br />";
		$res = "SELECT location FROM db_location";
       	 	$results = mysqli_query($conn, $res);
        	$categories = array();
        	while ($row = mysqli_fetch_array($results)){
          		$categories[] = $row['location'];
        	}
      		echo "<label for='location'>Place is in: </label>";
      		echo "<select name='location' id='location'>";
        	foreach ($categories as &$c) {
          		echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        	}
      		echo "</select>";
    		echo "<br /><br />";
		echo "<input type='submit' name='favorite_place_submit' value='Add Favorite Places' />";	//user id is sent via post
		echo "</form><br />";
		$place_sql = "SELECT p.id, p.name, l.location FROM db_favorite_places p INNER JOIN db_location l ON p.location_id = l.id WHERE p.user_id ='".$id."'";	
		$place_res = mysqli_query($conn, $place_sql);
		if (mysqli_num_rows($place_res) > 0){
			echo "<table border='1'><tr><td>Place</td><td>Location</td></tr>";
			while ($place_row = mysqli_fetch_assoc($place_res)){
				echo "<tr><td>".$place_row['name']."</td><td>".$place_row['location']."</td><td><a href=db_favoriteplaces.php?usn=$usn&id1=$id&placeid=".$place_row['id'].">Remove</a></td></tr>";
			}
			echo "</table>";
		}
		else{
			echo "There are no favorite places added yet.<br />";
		}

		//show user's favorite users list
		echo "<h3>$fname's favorite users</h3>";
		$fav_sql = "SELECT * FROM db_users u INNER JOIN db_favorites f ON f.user2_id = u.id WHERE f.user1_id='".$id."'";
		$fav_res = mysqli_query($conn, $fav_sql);
		//$fav_row = mysqli_fetch_assoc($fav_res);
		if (mysqli_num_rows($fav_res) > 0){
		echo "<table border='1'><tr><td>Name</td><td>Gender</td><td>Age</td><td>Ethnicity</td><td>Education</td><td>Height</td><td>Build</td><td>Location</td><td>Date Added</td></tr>";
		while ($fav_row = mysqli_fetch_assoc($fav_res)){
		 		 echo "<tr><td>".$fav_row['username']."</td><td>".$fav_row['gender']."</td><td>".$fav_row['age']."
		 		 		</td><td>".$fav_row['ethnicity']."</td><td>".$fav_row['education']."</td><td>".$fav_row['height']."
		 		 		</td><td>".$fav_row['build']."</td><td>".$fav_row['location']."</td><td>".$fav_row['date']."
		 		 		</td><td><a href=db_favorites.php?remove=yes&usn=$usn&id1=$id&id2=".$fav_row['user2_id'].">Remove</a></td></tr>";	//$id is user id, user2_id is favorited user, sent via get
			}
		echo "</table>";
		}
		else{
			echo "There are no favorite users added yet.<br />";
		}


		//show all users in database (NEED TO REMOVE PEOPLE ADDED TO FAVORITES)
		$sql3 = "SELECT * FROM db_users WHERE username!='".$usn."'";
		$res3 = mysqli_query($conn, $sql3);
		echo "<h2>All users in the dating database</h2>";
		echo "<h3>Click on a user's name to see more about them</h3>";
		if (mysqli_num_rows($res3) > 0){
			echo "<table border='1'><tr><td>Name</td><td>Gender</td><td>Age</td><td>Ethnicity</td><td>Education</td><td>Height</td><td>Build</td><td>Location</td></tr>";
			while ($row3 = mysqli_fetch_assoc($res3)){
				echo "<tr><td><a href=db_view_user.php?usn=$usn&viewusn=".$row3['username']."&viewid=".$row3['id'].">".$row3['username']."</a></td><td>".$row3['gender']."</td><td>".$row3['age']."
						</td><td>".$row3['ethnicity']."</td><td>".$row3['education']."</td><td>".$row3['height']."
						</td><td>".$row3['build']."</td><td>".$row3['location']."</td><td><a href=db_favorites.php?add=yes&usn=$usn&id1=$id&id2=".$row3['id'].">Favorite</a></td></tr>";
			}
			echo "</table>";
		}
		else{
			echo "There are no users in the dating database added yet.<br />";
		}
?>	

<?php
	include 'db_footer.php';
?>
  </div>
</body>
</html>
