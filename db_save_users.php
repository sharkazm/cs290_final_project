<!-- Names: Mike Sharkazy -->
<!-- Class: CS 290 Spring 2015 -->
<!-- Assignment: Final Project -->
<!-- Title: Dating Website Database -->
<!-- db_save_users.php: saves user's entered and selected fields sent
	via POST. It enters the user into the database if user comes in from
	db_signup.php and checks if the user exists if user comes in from
	db_login.php -->
<?php
session_start();
		$conn = mysqli_connect("oniddb.cws.oregonstate.edu", "sharkazm-db", "wPb48qsJFnowXv5n", "sharkazm-db");
			if (mysqli_connect_errno($conn)) {
				echo "Failed to connect to server<br><br>";
			} 

//the page attribute has to be sent via post.
if(isset($_POST['page']) && !empty($_POST['page'])){

		//if statement to register new users. Comes from db_signup.php
		if ($_POST['page'] == "register"){
			$username = $_POST['user_name'];
			$password_protected = $_POST['user_password1'];
			$firstname = $_POST['user_firstname'];
			$gender = $_POST['user_gender'];
			$age = $_POST['user_age'];
			$ethnicity = $_POST['user_ethnicity'];
			$education = $_POST['user_education'];
			$height = $_POST['user_height'];
			$build = $_POST['user_build'];
			$location = $_POST['user_location'];

			$us_check = mysqli_real_escape_string($conn, $_POST['user_name']);
			$check = mysqli_query($conn, "SELECT * FROM db_users WHERE username='".$us_check."'");

			$row_count = mysqli_num_rows($check);
				if ($row_count > 0){
					echo  'Username already exists. Please choose a different username.';
				}
				else{
					$sql = "INSERT INTO db_users (fname, username, password, gender, age, ethnicity, education, height, build, location) VALUES 
							('$firstname', '$username', '$password_protected', '$gender', '$age', '$ethnicity', '$education', '$height', '$build', '$location')";
					$result = mysqli_query($conn, $sql);

					if (!$result){
						echo "Could not create account. Please try again.";
					}
					else{
						echo 'success=yes';
					}
				}
	}

	//elseif statement to login users who already have an account. Comes from db_login.php.
	elseif($_POST["page"] == "users_login"){ 	
		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password1'];
		//$encrypted_md5_password = md5($user_password);
		$encrypted_md5_password = $user_password;
		$validate_user_information = mysqli_query($conn, "SELECT * FROM db_users WHERE username= '".mysqli_real_escape_string($conn, $user_name)."' AND password= '".mysqli_real_escape_string($conn, $encrypted_md5_password)."'");
		$check = mysqli_num_rows($validate_user_information);

		if($check == 1)
		{
			$get_user_information = mysqli_fetch_array($validate_user_information, MYSQLI_BOTH);
			$_SESSION["username"] = $user_name;
			$_SESSION["uid"] = $get_user_information["user_id"];
			$_SESSION["logged_on"] = 1;
			echo 'login_success=yes';
		}
		else
		{
			echo '<br><div class="info">Incorrect username or password.</div><br>';
		}
	}
}

?>
