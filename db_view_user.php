<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- db_view_users.php: view the selected user's preferences,
  hobbies, favorite places, and other favorited users -->
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


<?php

//accepts from db_render.php via GET
if (isset($_GET['usn']) && isset($_GET['viewid']) && isset($_GET['viewusn'])){
  $username = $_GET['usn'];
  $view_user_id = $_GET['viewid'];
  $view_username = $_GET['viewusn'];
  echo "<h2>$view_username's Profile </h2>";
  echo "<h3><a href=db_render.php?usn=$username>Click Here</a> to return.</h3>";
  $sql = "SELECT * FROM db_users WHERE id='$view_user_id'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);

  //show selected user's preferences
  echo "<h3>$view_username's Preferences</h3>";
  if ($row['prefset'] == 0){
    echo "$view_username does not have any preferences set yet...<br />";
  }
  elseif ($row['prefset'] == 1){
      $sql2 = "Select p.gender, p.age, p.ethnicity, p.education, p.height, p.build, p.location from db_preferences p INNER JOIN 
              db_users u ON u.id = p.user_id WHERE u.id = '".$view_user_id."'";
      $res2 = mysqli_query($conn, $sql2);

      echo "<table border='1'><tr><td>Gender</td><td>Age</td><td>Ethnicity</td><td>Education</td><td>Height</td><td>Build</td><td>Location</td></tr>";
      if (mysqli_num_rows($res2) > 0){
        while ($row = mysqli_fetch_assoc($res2)){
          echo "<tr><td>".$row['gender']."</td><td>".$row['age']."</td><td>".$row['ethnicity']."</td><td>".$row['education']."</td><td>".$row['height']."</td><td>".$row['build']."</td><td>".$row['location']."</td></tr>";
        }
        echo "</table>";
      }
  }

  //show selected user's hobby
  echo "<h3>$view_username's Hobbies</h3>";
  $hob_sql = "SELECT id, name from db_hobbies WHERE user_id='".$view_user_id."'";
  $hob_res = mysqli_query($conn, $hob_sql);
    if (mysqli_num_rows($hob_res) > 0){
      echo "<table border='1'><tr><td>Hobby</td></tr>";
      while ($hob_row = mysqli_fetch_assoc($hob_res)){
        echo "<tr><td>".$hob_row['name']."</td></tr>";
      }
      echo "</table>";
    }
    else{
      echo "There are no hobbies added yet.<br />";
  }
  
  //show selected user's favorite places
  echo "<h3>$view_username's favorite places</h3>";
  $place_sql = "SELECT p.id, p.name, l.location FROM db_favorite_places p INNER JOIN 
              db_location l ON p.location_id = l.id WHERE p.user_id ='".$view_user_id."'"; 
  $place_res = mysqli_query($conn, $place_sql);
    if (mysqli_num_rows($place_res) > 0){
      echo "<table border='1'><tr><td>Place</td><td>Location</td></tr>";
      while ($place_row = mysqli_fetch_assoc($place_res)){
        echo "<tr><td>".$place_row['name']."</td><td>".$place_row['location']."</td></tr>";
      }
      echo "</table><br />";
    }
    else{
      echo "There are no favorite places added yet.<br />";
    }

  //show user's favorite users list
  echo "<h3>$view_username's favorite users</h3>";
  $fav_sql = "SELECT * FROM db_users u INNER JOIN db_favorites f ON f.user2_id = u.id WHERE f.user1_id='".$view_user_id."'";
  $fav_res = mysqli_query($conn, $fav_sql);
    if (mysqli_num_rows($fav_res) > 0){
    echo "<table border='1'><tr><td>Name</td><td>Gender</td><td>Age</td><td>Ethnicity</td><td>Education</td><td>Height</td><td>Build</td><td>Location</td><td>Date Added</td></tr>";
    while ($fav_row = mysqli_fetch_assoc($fav_res)){
         echo "<tr><td>".$fav_row['username']."</td><td>".$fav_row['gender']."</td><td>".$fav_row['age']."
            </td><td>".$fav_row['ethnicity']."</td><td>".$fav_row['education']."</td><td>".$fav_row['height']."
            </td><td>".$fav_row['build']."</td><td>".$fav_row['location']."</td><td>".$fav_row['date']."
            </td></tr>";
      }
    echo "</table><br />";
    }
    else{
      echo "There are no favorite users added yet.<br />";
    }
  }
?>

<?php
	include 'db_footer.php';
?>

    </div>
  </body>
</html>
