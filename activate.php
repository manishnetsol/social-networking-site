<?php
$title = 'Activate Your Account';
$currentPage = 'activate.php';

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
    if($timetaken <=600)
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
    else{
        
        $_SESSION['msg']= $lang['ACTIVATION_EXPIRED'];
        header('location:login.php');
    }
}



?>