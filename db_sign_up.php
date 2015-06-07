<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- db_signup.php: shows text forms for username, password, firstname, and select
  forms for gender, age, ethnicity, education, height, build, and location. It then
  sends the selected areas via post to db_save_users.php to save the user data into
  the database -->

<?php
include 'db_header.php';
    $conn = mysqli_connect("oniddb.cws.oregonstate.edu", "sharkazm-db", "wPb48qsJFnowXv5n", "sharkazm-db");
      if (mysqli_connect_errno($conn)) {
        echo "Failed to connect to server<br><br>";
      } 
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


	<h3>Welcome to the Dating Database<h3>
	<h4>Create an account and profile</h4>
	<div id="error"></div>
<div class="container-fluid">
	<fieldset>
	<div class="form-groups">
	<form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
	<div class="form-group">
    	<label for="user_name">Username</label>
    	<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter Username">
  	</div><br />

  	<div class="form-group">
    	<label for="user_password1">Password</label>
    	<input type="password" class="form-control" id="user_password1" name="user_password1" placeholder="Enter Password">
  	</div><br />

  	<div class="form-group">
    	<label for="user_password2">Confirm password</label>
    	<input type="password" class="form-control" id="user_password2" name="user_password2" placeholder="Confirm Password">
  	</div><br />

  	<div class="form-group">
    	<label for="firtsname">Firstname</label>
    	<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
  	</div><br />

    <div class="form-group">
      <?php 
        $res = "SELECT gender FROM db_gender";
        $results = mysqli_query($conn, $res);
        $categories = array();
        while ($row = mysqli_fetch_array($results)){
          $categories[] = $row['gender'];
        }
      ?>
      <label for="gender">Gender</label>
      <select name='gender' id='gender'>
        <?php foreach ($categories as &$c) {
          echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        } ?>
      </select>
    </div><br />

    <div class="form-group">
      <?php 
        $res = "SELECT age FROM db_age";
        $results = mysqli_query($conn, $res);
        $categories = array();
        while ($row = mysqli_fetch_array($results)){
          $categories[] = $row['age'];
        }
      ?>
      <label for="age">Age</label>
      <select name='age' id='age'>
        <?php foreach ($categories as &$c) {
          echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        } ?>
      </select>
    </div><br />

    <div class="form-group">
      <?php 
        $res = "SELECT ethnicity FROM db_ethnicity";
        $results = mysqli_query($conn, $res);
        $categories = array();
        while ($row = mysqli_fetch_array($results)){
          $categories[] = $row['ethnicity'];
        }
      ?>
      <label for="ethnicity">Ethnicity</label>
      <select name='ethnicity' id='ethnicity'>
        <?php foreach ($categories as &$c) {
          echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        } ?>
      </select>
    </div><br />

    <div class="form-group">
      <?php 
        $res = "SELECT education FROM db_education";
        $results = mysqli_query($conn, $res);
        $categories = array();
        while ($row = mysqli_fetch_array($results)){
          $categories[] = $row['education'];
        }
      ?>
       <label for="education">Education</label>
      <select name='education' id='education'>
        <?php foreach ($categories as &$c) {
          echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        } ?>
      </select>
    </div><br />

    <div class="form-group">
      <?php 
        $res = "SELECT height FROM db_height";
        $results = mysqli_query($conn, $res);
        $categories = array();
        while ($row = mysqli_fetch_array($results)){
          $categories[] = $row['height'];
        }
      ?>
      <label for="height">Height</label>
      <select name='height' id='height'>
        <?php foreach ($categories as &$c) {
          echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        } ?>
      </select>
    </div><br />

    <div class="form-group">
      <?php 
        $res = "SELECT build FROM db_build";
        $results = mysqli_query($conn, $res);
        $categories = array();
        while ($row = mysqli_fetch_array($results)){
          $categories[] = $row['build'];
        }
      ?>
      <label for="build">Build</label>
      <select name='build' id='build'>
        <?php foreach ($categories as &$c) {
          echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        } ?>
      </select>
    </div><br />

    <div class="form-group">
      <?php 
        $res = "SELECT location FROM db_location";
        $results = mysqli_query($conn, $res);
        $categories = array();
        while ($row = mysqli_fetch_array($results)){
          $categories[] = $row['location'];
        }
      ?>
      <label for="location">Location</label>
      <select name='location' id='location'>
        <?php foreach ($categories as &$c) {
          echo "<option value='" . $c . "' id='" . $c . "' name='" . $c . "'>" . $c . "</option>";
        } ?>
      </select>
    </div>
    <br />  
		<a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="signup();" role="button">Submit</a>
		<a class="btn btn-primary btn-lg" href="db_login.php" role="button">Already Registered?</a>
	</fieldset>
	</form>
</div>
</div>

<?php
	include 'db_footer.php';
?>

    </div>
  </body>
</html>
