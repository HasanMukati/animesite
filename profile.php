<?php
include('server.php'); 

 if(isset($_SESSION['email']) and isset($_GET['delete'])){
	require_once('functions.php');
	delete_account($_GET['delete'],$_SESSION['email']);
}

?>
<div class="content">
	<?php  if(isset($_SESSION['success'])): ?>
		<div class="error success">
			<h3>
				<?php 
					echo $_SESSION['success'];
					unset($_SESSION['success']);
				 ?>
			</h3>
		</div>
	<?php endif ?>

	<?php if(isset($_SESSION['success'])): ?>
		<p>Welcome <strong><?php echo $_SESSION['firstname']; ?></strong></p>
		<p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
	<?php endif ?>
</div>

<?php
require_once('functions.php');
$profile = get_profile($_SESSION['email']);

$title = "profile page";
$content = $profile;
include 'Template.php';
?>

