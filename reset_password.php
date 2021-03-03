<?php
$title = "Reset Password";
$currentPage = 'reset_password.php';
ob_start();
include 'includes/header.php';
?>

<body>

<?php
   $resetpasstime=time();
   $resetTime = $_SESSION['resettime'];
   $timetaken1 = $resetpasstime - $resetTime;
   if($timetaken1<=300)
   {
    if ($_SERVER['REQUEST_METHOD']=='POST')  
    {
            $email=$_POST['email'];
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
            $token = $_GET['token'];
            $tokennew = bin2hex(random_bytes(15));
            $updatetoken= "UPDATE `users` SET token='$tokennew' where token ='$token'";
            mysqli_query($conn, $updatetoken);
            $newpassword1 = $_POST['pwd'];
            $newconfirmpass=$_POST['confirm_password'];
            $pass=password_hash($newpassword1,PASSWORD_BCRYPT);
            if($newpassword1 == $newconfirmpass && $newpassword1 != '' && $newconfirmpass != '')
            {
                $updatequery ="UPDATE `users` SET `password` ='$pass' where `token` ='$tokennew' ";

                $iquery =mysqli_query($conn, $updatequery);
                if($iquery)
                {
                 
                    $_SESSION['msg']= $lang['RECOVER_PASSWORD_MSG'];
                    $updatequery1 ="UPDATE `users` SET `active` = '1' where `token` ='$tokennew' ";
                    mysqli_query($conn, $updatequery1);
                    header('location:login.php');
                }
                else
                {
                 $_SESSION['failedpass']= $lang['RECOVER_FAILED_MSG'];
                  header('location: reset_password.php');
                }
            }

            else if($newpassword1 != $newconfirmpass && $newpassword1 != '' && $newconfirmpass != '' )
            {
                $_SESSION['failedpass']= $lang['RECOVER_FAILED_MSG2'];
                header('location: reset_password.php');    
            }
        }
        else
        {
            echo $lang['TOKEN_NOT_FOUND'];
        }      
    }
  }
  else
  {
    $_SESSION['msg']="link expired try again connecting";
    header('location:login.php');

  }
?>
      <div style = "height:79vh">
  <div class = "shadow-lg bg-white rounder" style= "margin:auto; margin-top:25px;margin-bottom: 40px;width: 40%; 
  display: flex; height:300px; padding: 0;">
                <div class="container mt-3">
                <h4><?php echo $lang['RECOVER_HEADER']; ?></h4>
                <form action="" method="post" id="form">   
                 <p> 

                   <?php
                    if(isset($_SESSION['failedpass']))
                    {
                    echo $_SESSION['failedpass'];
                    }
                    else
                    {
                   echo  $_SESSION['failedpass']="";
                    }
                   ?>

                 </p>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label mt-2"><?php echo $lang['RECOVER_PWD_NEW']; ?></label>
                    <input type="password" class="form-control" name ="pwd" id="pwd" required>
                </div>
                
                <div class="mb-3">
                    <label for="confirmpass" class="form-label"><?php echo $lang['RECOVER_PWD_REPEAT']; ?></label>
                    <input type="password" class="form-control" name ="confirm_password" id="confirm_password" required>
                </div>

                 
                <button type="submit"  name= "submit" class="btn btn-primary"><?php echo $lang['RECOVER_PWD_UPDATE']; ?></button>
                </form>
                </div>

                </div> 
                </div>


                <?php
include 'includes/footer.php';

?> 
 <script src="assets/js/login.js"></script>

  </body>
</html>