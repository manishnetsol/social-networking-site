<?php


$servername = "localhost";
    $username = "root";
    $pass = "";
 // Create a Table in our Database
  $database = "social_network"; 
  $conn = mysqli_connect($servername, $username, $pass, $database);
  
  if (!$conn) {
    die('<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Connection Failed. ' . mysqli_connect_error() .
    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>');
  }

//function for inserting post

function get_posts(){
	global $conn;
	$per_page = 4;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($conn, $get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['caption'], 0,40);
		$upload_image = $row_posts['post_url'];
		$post_date = $row_posts['date_created'];

		$user = "select *from users where user_id='$user_id'";
		$run_user = mysqli_query($conn,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['username'];
		

		//now displaying posts from database

		if($content=="--" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-9' style='border: 5px solid #e6e6e6;padding: 40px 50px;'>
					<div class='row'>
						<div class='col-sm-2'>
						</div>
						<div class='col-sm-9'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='#'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<img id='posts-img' src='images/$upload_image' style='height:350px;padding-top: 5px;
							padding-right: 10px;
							min-width: 102%;
							max-width: 50%;'>
						</div>
					</div><br>
					<a href='#' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-9' style='border: 5px solid #e6e6e6;padding: 40px 50px;'>
					<div class='row'>
						<div class='col-sm-2'>
					
						</div>
						<div class='col-sm-9'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='#'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style='height:350px;padding-top: 5px;
							padding-right: 10px;
							min-width: 102%;
							max-width: 50%;'>
						</div>
					</div><br>
					<a href='#' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-9' style='border: 5px solid #e6e6e6;padding: 40px 50px;'>
					<div class='row'>
						<div class='col-sm-2'>
						
						</div>
						<div class='col-sm-9'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='#'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<h3><p>$content</p></h3>
						</div>
					</div><br>
					<a href='#' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}

	include("pagination.php");
}

?>