<?php
$title = 'Activate Your Account';
$currentPage = 'activate.php';
//session_start();
include 'includes/header.php';
$servername = "localhost";
$username = "root";
$pass = "";
// Create a Table in our Database
$database = "social_network"; 
$conn = mysqli_connect($servername, $username, $pass, $database);

if (!$conn) 
{
die('<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Error!</strong> Connection Failed. ' . mysqli_connect_error() .
'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>');
}

if(isset($_GET['token']))
{
    $token =$_GET['token'];
    $tokennew = bin2hex(random_bytes(15));

    $verifytime = "SELECT * FROM `users` WHERE token='$token'";
    $query = mysqli_query($conn, $verifytime);
      $token_date=mysqli_fetch_assoc($query);
      $dbpass =$token_date['token_date'];
      $date1 = strtotime($dbpass);
      $date = date('Y-m-d H:i:s');
      $date2= strtotime($date);
      $diff = abs($date1 - $date2);
      $hours = floor( $diff/(60*60));  

    $updatetoken= "UPDATE `users` SET token='$tokennew' , token_date = '$date' where token ='$token'";
    $query1 =mysqli_query($conn, $updatetoken);
    
    if($hours <=1)
    {

        $updatestatus= "UPDATE `users` SET active='1' where token ='$tokennew'";
        $query =mysqli_query($conn, $updatestatus);
        
        if($query)
        {            
                if(isset($_SESSION['msg']))
                {
                    $_SESSION['msg'] = $lang['ACTIVATION_UPDATED'];
                    header('location:login.php');
                }
                else
                {
                    $_SESSION['msg'] = $lang['ACCOUNT_LOGOUT'];
                    header('location:login.php');
                }            
        }
    }
    else
    {    
        $_SESSION['msg']= $lang['ACTIVATION_EXPIRED'];
        header('location:login.php');
    }
}

?>