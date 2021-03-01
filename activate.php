<?php
session_start();

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

if(isset($_GET['token']))
{
    $token =$_GET['token'];
    $tokennew = bin2hex(random_bytes(15));
    $updatetoken= "UPDATE `users` SET token='$tokennew' where token ='$token'";
    $query1 =mysqli_query($conn, $updatetoken);
    $submittime=time();
    $startTime = $_SESSION['starttime'];
    $timetaken = $submittime - $startTime;
    if($timetaken <=60)
    {

        $updatestatus= "UPDATE `users` SET active='1' where token ='$tokennew'";
        $query =mysqli_query($conn, $updatestatus);
        
        if($query)
        {
            
            
                if(isset($_SESSION['msg']))
                {
                    $_SESSION['msg'] ="Account updated Successfully";
                    header('location:login.php');
                }
                else
                {
                    $_SESSION['msg'] ="you are logged out";
                    header('location:login.php');
                }
            
        }
    }
    else{
        
        $_SESSION['msg']="Link expired please reset your password to activate your account";
        header('location:login.php');
    }
}



?>