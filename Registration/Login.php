<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>User Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="header">
			<h2>Login</h2>
		</div>

		<form method="post" action="login.php">
			<?php	include('errors.php'); ?>
			<div class="input-group">
				<label>Username/Email</label>
				<input type="text" name="email">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<div class="input-group">
				<button type="submit" name="login" class="btn">Login</button>
			</div>
			<p>
				New user? <a href="Register.php"> Sign up</a>
			</p>
		</form>
	</body>
	</html>