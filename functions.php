<?php
include_once('config.php');


function delete_account($dob,$email){

	if(!empty($dob) and !empty($email)){
		delete_query("delete from user_profile where email = '$email' and DOB = '$dob'");
		session_destroy();
		unset($_SESSION['email']);
		header('location: index.php');
		exit;
	}else{
		session_destroy();
		unset($_SESSION['email']);
		
		header('location: index.php');
		exit;
	
	}
	
}
function delete_query($a){

$conn = mysqli_connect(constant("db_host"), constant("db_username"),constant("db_password"),constant("db_dbname"));
if (!$conn) {
   echo "database error";
   exit;
}
$res = mysqli_query($conn,$a);
mysqli_close($conn);
}
function select_query($a){

$f = array();
$conn = mysqli_connect(constant("db_host"), constant("db_username"),constant("db_password"),constant("db_dbname"));
if (!$conn) {
   echo "database error";
   exit;
}

	$res = mysqli_query($conn,$a);
	while($row = mysqli_fetch_array($res)){
		$f[] = $row;
	}


mysqli_close($conn);


return $f;

}


function get_profile($email){
	$content = '';
	if(!empty($email)){
		$rows = select_query("select * from user_profile where email = '$email'");
		if(!empty($rows[0])){
			
				$content = '<div class="container">
<div class="leftside">
<img src="'.$rows[0]['profilepicture'].'" width="200" height="300"/>
</div>
<div class="rightside">

<ul>
<li><b>First Name</b>: '.$rows[0]['firstname'].'</li>
<li><b>Last Name</b>: '.$rows[0]['lastname'].'</li>
<li><b>Date of Birth</b>: '.$rows[0]['DOB'].'</li>
<li><b>Delete Account</b>: <a href="?delete='.$rows[0]['DOB'].'">Delete</a></li>


</ul>
</div>
<div class="clear"></div>
</div>
';
			
		}
	}
	
	return $content;
}

function get_home_page($page,$sort=''){

if(is_numeric($page)){
	$offset = ($page-1)*10;
}else{
	$offset = 0;
}


$contents = '';

if($sort == 'az'){
 	$contents.='<a href="?page='.$page.'&sort=za">Sort Z To A</a>'."<br>";
}else{
	$contents.='<a href="?page='.$page.'&sort=az">Sort A To Z</a>'."<br>";
}

if(!empty($sort)){
	if($sort == 'az'){
		$rows = select_query("select * from anime_data  ORDER BY `title` ASC limit 10 OFFSET $offset");
	}else{
		$rows = select_query("select * from anime_data  ORDER BY `title` DESC limit 10 OFFSET $offset");
	}
	
}else{
	$rows = select_query("select * from anime_data  ORDER BY `anime_id` DESC limit 10 OFFSET $offset");
}



if(!empty($rows)){
	foreach($rows as $row){
	
	$li = '';
	$li.= '<li><b>Episodes</b>: '.$row['episodes'].'</li>';
	
	$row['status'] = trim($row['status']); 
	if(!empty($row['status'])){$li.= '<li><b>Status</b>: '.$row['status'].'</li>';   }

	$row['duration'] = trim($row['duration']); 
	if(!empty($row['duration'])){$li.= '<li><b>Duration</b>: '.$row['duration'].'</li>';   }

	$row['rating'] = trim($row['rating']); 
	if(!empty($row['rating'])){$li.= '<li><b>Rating</b>: '.$row['rating'].'</li>';   }

	$li.= '<li><b>Score</b>: '.$row['score'].'</li>';

	$row['studio'] = trim($row['studio']); 
	if(!empty($row['studio'])){$li.= '<li><b>Studio</b>: '.$row['studio'].'</li>';   }

	$row['genre'] = trim($row['genre']); 
	if(!empty($row['genre'])){$li.= '<li><b>Genres</b>: '.$row['genre'].'</li>';   }

	
		$contents.= '<div class="container">
<div class="leftside">
<img src="Images/default.jpg" width="200" height="300"/>
</div>
<div class="rightside">
<h3>'.$row['title'].'</h3>
<ul>
'.$li.'	

</ul>
</div>
<div class="clear"></div>
</div>
';
	
	}

}

$pagination = '';
if($page < 5){
if($page == 1){
	$pagination = ' <a href="#">&laquo;</a>
  <a href="#" class="active">1</a>
  <a href="?page=2&sort='.$sort.'">2</a>
  <a href="?page=3&sort='.$sort.'">3</a>
  <a href="?page=4&sort='.$sort.'">4</a>
  <a href="?page=5&sort='.$sort.'">5</a>
  <a href="?page=6&sort='.$sort.'">6</a>
  <a href="?page=7&sort='.$sort.'">7</a>
  <a href="?page=2&sort='.$sort.'">&raquo;</a>';
}else{
	$pagination.=' <a href="?page='.($page-1).'&sort='.$sort.'">&laquo;</a>';
	$pagination.= ' <a href="?page=1&sort='.$sort.'">1</a>';
	if($page == 2){
		$pagination.=' <a href="?page=2&sort='.$sort.'" class="active">2</a>';
	}else{
		$pagination.=' <a href="?page=2&sort='.$sort.'">2</a>';
	}
	if($page == 3){
		$pagination.=' <a href="?page=3&sort='.$sort.'" class="active">3</a>';
	}else{
		$pagination.=' <a href="?page=3&sort='.$sort.'">3</a>';
	}
	if($page == 4){
		$pagination.=' <a href="?page=4&sort='.$sort.'" class="active">4</a>';
	}else{
		$pagination.=' <a href="?page=4&sort='.$sort.'">4</a>';
	}
	$pagination.= ' <a href="?page=5&sort='.$sort.'">5</a>';
	$pagination.= ' <a href="?page=6&sort='.$sort.'">6</a>';
	$pagination.= ' <a href="?page=7&sort='.$sort.'">7</a>';
	$pagination.=' <a href="?page='.($page+1).'&sort='.$sort.'">&raquo;</a>';
}
}else{

$pagination = ' <a href="?page='.($page-1).'&sort='.$sort.'">&laquo;</a>

  <a href="?page='.($page-3).'&sort='.$sort.'">'.($page-3).'</a>
  <a href="?page='.($page-2).'v">'.($page-2).'</a>
  <a href="?page='.($page-1).'&sort='.$sort.'">'.($page-1).'</a>
  <a href="?page='.$page.'&sort='.$sort.'" class="active">'.$page.'</a>
  <a href="?page='.($page+1).'&sort='.$sort.'">'.($page+1).'</a>
  <a href="?page='.($page+2).'&sort='.$sort.'">'.($page+2).'</a>
  <a href="?page='.($page+3).'&sort='.$sort.'">'.($page+3).'</a>
  <a href="?page='.($page+1).'&sort='.$sort.'">&raquo;</a>';

}



$contents.='<div class="pagination">
 '.$pagination.'
</div>';


return $contents;

}



