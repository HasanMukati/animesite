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

