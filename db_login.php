<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- db_login.php: Text forms for loggin in a user -->
<?php
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

<h3>Dating Database<h3>
	<h4>User login</h4>
	<div id="error"></div>
	
	<div class="form-groups">
	<form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
	<div class="form-group">
    	<label for="user_name">Username</label>
    	<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter Username">
  	</div>

  	<div class="form-group">
    	<label for="user_password1">Password</label>
    	<input type="password" class="form-control" id="user_password1" name="user_password1" placeholder="Enter Password">
  	</div>

		<a class="btn btn-primary btn-lg" href="javascript:void(0);" onclick="user_login();" role="button">Submit</a>
		<a class="btn btn-primary btn-lg" href="db_signup.php" role="button">Need an Account?</a>
	</form>
</div>

<?php
	include 'db_footer.php';
?>

		</div>
	</body>
</html>
