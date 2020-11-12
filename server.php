<?php 
	session_start();
	include_once('config.php');

	$email = "";
	$firstname = "";
	$lastname = "";
	$profilepicture = "";
	$errors = array();


	$db = mysqli_connect(constant("db_host"), constant("db_username"),constant("db_password"),constant("db_dbname"));
//Creating a new account
	if (isset($_POST['register'])) {//click register button 
		
		$email = mysqli_real_escape_string($db, $_POST['email']); //Get Email

		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		$dob = date('Y-m-d', strtotime($_POST['dob']));

		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);

		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);

		//see if they are all filled correctly
		if (empty($email))
			array_push($errors, "Email is required");

		if (empty($password_1))
			array_push($errors, "Password is required");

		if ($password_1 != $password_2)
			array_push($errors, "Passwords must match");

		if (empty($firstname))
			array_push($errors, "First Name is required");

		if (empty($lastname))
			array_push($errors, "Last Name is required");

		if (empty($dob))
			array_push($errors, "Date of Birth is required");

		if (count($errors) == 0){
			$password = md5($password_1);
			$sql = "INSERT INTO user_profile (email, password, DOB, firstname, lastname, profilepicture) VALUES ('$email', '$password', '$dob', '$firstname', '$lastname', '$profilepicture')";

			mysqli_query($db, $sql);

			$_SESSION['email'] = $email; 
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');

		}
	}

	if (isset($_POST['login'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']); //Get Email

		$password = mysqli_real_escape_string($db, $_POST['password']);

		//see if they are all filled correctly
		if (empty($email))
			array_push($errors, "Email is required");

		if (empty($password))
			array_push($errors, "Password is required");

		if (count($errors) == 0){
			$password = md5($password);
			$query = "SELECT * FROM user_profile WHERE email='$email' AND password='$password'";
			$result = mysqli_query($db, $query);

			if(mysqli_num_rows($result) == 1){
				$_SESSION['email'] = $email;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			} 
			else {
				array_push($errors, "Email and password do not match");
				//header('location: Login.php');
			}

		}
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['email']);
		header('location: Login.php');
	}

 ?>