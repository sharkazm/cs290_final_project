<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- db_favorites.php: Comes from db_render.php via GET. Based on
  user's selection, adds or removes other users into the favorites
  tables in the database. -->
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

//GET to remove a favorited user from logged in user's favorited list
if (isset($_GET['remove']) && isset($_GET['id1']) && isset($_GET['id2'])){
    $user1_id = $_GET['id1'];
    $user2_id = $_GET['id2'];
    $username = $_GET['usn'];

    $sql = "DELETE FROM db_favorites WHERE user1_id='$user1_id' && user2_id=$user2_id";
    $res = mysqli_query($conn, $sql);

    if ($res){
      echo "<center><font color = 'green'>Favorited user deleted.<br /><br />";
      echo "<center>Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
    else{
      echo "<center><font color = 'red'>An error occurred.<br /><br />";
      echo "<center>Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
  }

//GET to add a user into logged in user's favorited list
if (isset($_GET['add']) && isset($_GET['id1']) && isset($_GET['id2'])){
    $user1_id = $_GET['id1'];
    $user2_id = $_GET['id2'];
    $username = $_GET['usn'];

    $sql = "INSERT INTO db_favorites (user1_id, user2_id, date) VALUES ('$user1_id', '$user2_id', now())";
    $res = mysqli_query($conn, $sql);

    if ($res){
      echo "<center><font color = 'green'>Favorited user added.<br /><br />";
      echo "<center>Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
    else{
      echo "<center><font color = 'red'>An error occurred.<br /><br />";
      echo "<center>Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
}

?>

<?php
	include 'db_footer.php';
?>

    </div>
  </body>
</html>
