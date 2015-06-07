<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- db_hobbies.php: Comes from db_render.php via POST or GET. From POST,
  it enters a hobby that the user entered into the text field on db_render.php.
  Via GET, it deletes the specified hobby from the database connected to the logged
  in user -->

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
session_start();
if ($_SESSION["logged_on"] != 1){
  header("Location: db_login.php");
}
    $conn = mysqli_connect("oniddb.cws.oregonstate.edu", "sharkazm-db", "wPb48qsJFnowXv5n", "sharkazm-db");
      if (mysqli_connect_errno($conn)) {
        echo "<center><font color = 'red'>Failed to connect to server<br><br>";
      } 
include 'db_header.php';
?>

<?php
  
  //POST from db_render.php to enter a new hobby
  if (isset($_POST['hobby_submit'])){
    $user_id = $_POST['id'];
    $username = $_POST['usn'];
    $hobby = $_POST['hobby'];

    $sql = "INSERT INTO db_hobbies (user_id, name) 
            VALUES ('$user_id', '$hobby')";

    $res = mysqli_query($conn, $sql);

    if ($res){
      echo "<center><font color = 'green'>Hobby added.<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
    else{
      echo "<center><font color = 'red'>An error occurred.<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
  }

  //GET from db_render.php to delete the specified hobby from the table
  if (isset($_GET['id1']) && isset($_GET['hobbyid'])){
    $user_id = $_GET['id1'];
    $hobby_id = $_GET['hobbyid'];
    $username = $_GET['usn'];

    $sql = "DELETE FROM db_hobbies WHERE id='$hobby_id'";
    $res = mysqli_query($conn, $sql);

    if ($res){
      echo "<center><font color = 'green'>Hobby deleted.<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
    else{
      echo "<center><font color = 'red'>An error occurred.<br /><br />";
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


