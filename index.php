<?php include('server.php'); ?>
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
		<p>Welcome <strong><?php echo $_SESSION['firstname'] ?></strong></p>
		<p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
	<?php endif ?>
</div>

<?php
require_once('functions.php');
if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
if(isset($_GET['sort']) and !empty($_GET['sort'])){
	$sort = $_GET['sort'];
}else{
	$sort= '';
}
$page = get_home_page($page,$sort);
$title = "Home";
$content = $page;
include 'Template.php';
?>

