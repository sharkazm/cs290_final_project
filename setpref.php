<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- setpref.php: Comes from db_render.php. Adds logged in user's
  preferences into the database for the user -->
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
  
  //comes in via post from db_render.php
  if (isset($_POST['pref_submit'])){
    $user_id = $_POST['id'];
    $username = $_POST['usn'];
    $gender_pref = $_POST['gender'];
    $age_pref = $_POST['age'];
    $ethnicity_pref = $_POST['ethnicity'];
    $education_pref = $_POST['education'];
    $height_pref = $_POST['height'];
    $build_pref = $_POST['build'];
    $location_pref = $_POST['location'];

    $sql = "INSERT INTO db_preferences (user_id, gender, age, ethnicity, education, height, build, location) 
            VALUES ('$user_id', '$gender_pref', '$age_pref', '$ethnicity_pref', '$education_pref', '$height_pref', '$build_pref', '$location_pref')";
    $res = mysqli_query($conn, $sql);

    $sql2 = "UPDATE db_users SET prefset='1' WHERE username='$username'";
    $res2 = mysqli_query($conn, $sql2);

    if ($res && $res2){
      echo "Preferences have been set successfully.<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
    else{
      echo "An error occurred.<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
  }
?>

<?php
	include 'db_footer.php';
?>

    </div>
  </body>
</html>
