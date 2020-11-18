<?php	include('server.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Change Password</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="header">
			<h2>Update Password</h2>
		</div>

		<form method="post" action="register.php">
			<?php	include('errors.php'); ?>
			<div class="input-group">
				<label>Email</label>
				<input type="text" name="email" value="<?php echo($email); ?>">
			</div>
			<div class="input-group">
				<label>Old Password</label>
				<input type="password" name="password_old" required>
			</div>
			<div class="input-group">
				<label>New Password</label>
				<input type="password" name="password_1" required>
			</div>
			<div class="input-group">
				<label>Confirm Password</label>
				<input type="password" name="password_2" required>
			</div>
			<div class="input-group">
				<button type="submit" name="changepass" class="btn">Update</button>
			</div>
			<p>
				Go back to profile? <a href="profile.php"> Go Back</a>
			</p>
		</form>
	</body>


	
	</html>