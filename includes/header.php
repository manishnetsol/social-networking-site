<?php
include_once './language.php';
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<?php 
if(isset($_SESSION['user_email']))
{
			$user = $_SESSION['user_email'];
			$get_user = "select * from users where email='$user'"; 
			$run_user = mysqli_query($conn,$get_user);
			$row=mysqli_fetch_array($run_user);
					
			$user_id = $row['user_id']; 
}
			// $user_name = $row['user_name'];
			// $first_name = $row['f_name'];
			// $last_name = $row['l_name'];
			// $describe_user = $row['describe_user'];
			// $Relationship_status = $row['Relationship'];
			// $user_pass = $row['user_pass'];
			// $user_email = $row['user_email'];
			// $user_country = $row['user_country'];
			// $user_gender = $row['user_gender'];
			// $user_birthday = $row['user_birthday'];
			// $user_image = $row['user_image'];
			// $user_cover = $row['user_cover'];
			// $recovery_account = $row['recovery_account'];
			// $register_date = $row['user_reg_date'];
					
					
			// $user_posts = "select * from posts where user_id='$user_id'"; 
			// $run_posts = mysqli_query($con,$user_posts); 
			// $posts = mysqli_num_rows($run_posts);
			?>

<!-- Navbar section below -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php"><?php echo $lang['SITE_NAME']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo $currentPage == 'index.php' ? 'active' : ''?>">
          <a class="nav-link" href="index.php"><?php echo $lang['MENU_HOME']; ?></a>
        </li>
        <li class="nav-item <?php echo $currentPage == 'register.php' ? 'active' : ''?>">
          <a class="nav-link" href="register.php"><?php echo $lang['MENU_ABOUT_US']; ?></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $currentPage.'?lang=hi'?>" class="nav-link">हिन्दी</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $currentPage.'?lang=en'?>" class="nav-link">English</a>
        </li>
      </ul>
    </div>
  </nav>