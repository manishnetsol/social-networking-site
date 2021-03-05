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

function insertPost()
{
	if(isset($_POST['sub'])){
		global $conn;
		global $user_id;

		$content = $_POST['content'];
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);

		if(strlen($content) > 250)
        {
			echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
			// echo "<script>window.open('home.php', '_self')</script>";
            header('location:home.php');
		}
        else
        {
			if(strlen($upload_image) >= 1 && strlen($content) >= 1)
            {
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts ( user_id,caption, post_url) values('$user_id', '$content', '$upload_image.$random_number')";

				$run = mysqli_query($conn, $insert);

				if($run)
                {
					echo "<script>alert('Your Post updated a moment ago!')</script>";
					// echo "<script>window.open('home.php', '_self')</script>";
                    header('location:home.php');

					// $update = "update users set posts='yes' where user_id='$user_id'";
					// $run_update = mysqli_query($con, $update);
				}
				exit();
			}
            else
            {
				if($upload_image=='' && $content == '')
                {
					echo "<script>alert('Error Occured while uploading!')</script>";
					// echo "<script>window.open('home.php', '_self')</script>";
                    header('location:home.php');
				}
                else
                {
					if($content=='')
                    {
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,caption,post_url) values ('$user_id','--','$upload_image.$random_number')";
						$run = mysqli_query($conn, $insert);

						if($run)
                        {
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							// echo "<script>window.open('home.php', '_self')</script>";
                            header('location:home.php');
							// $update = "update users set posts='yes' where user_id='$user_id'";
							// $run_update = mysqli_query($con, $update);
						}

						exit();
					}
                    else
                    {
						$insert = "insert into posts (user_id,caption) values( '$user_id','$content')";
						$run = mysqli_query($conn, $insert);

						if($run)
                        {
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							// echo "<script>window.open('home.php', '_self')</script>";
                            header('location:home.php');

							// $update = "update users set posts='yes' where user_id='$user_id'";
							// $run_update = mysqli_query($con, $update);
						}
					}
				}
			}
		}
	}
}
?>