<?php
$title = 'Recover Account';
$currentPage = 'recover_account.php';
include 'includes/header.php';
?>


  <body>

    <?php
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
        
            $emailquery = "SELECT * FROM `users` WHERE email ='$email'";  //(already email not exist)
            $query =mysqli_query($conn, $emailquery);
            $emailcount = mysqli_num_rows($query);
        
            if($emailcount)
            {
                $userdata=mysqli_fetch_array($query);
                $username= $userdata['username'];
                $token = $userdata['token'];
                    $to_email = $email;
                    $subject = $lang['ACCOUNT_RESET'];
                    $body = "Hi, $username. Click Here to  Reset Your Password   <br>   
                    http://localhost/social-networking-site/reset_password.php?token=$token";
                    $sender = "From: codermailtosent@gmail.com";
                    if (mail($to_email, $subject, $body, $sender)) 
                    {
                        $_SESSION['msg'] = "Check your mail to reset  your password for  $email";
                        $date = date('Y-m-d H:i:s');
                         $updateDATE = "UPDATE users SET token_date = '$date' where token ='$token'";
                        mysqli_query($conn, $updateDATE);
                        header('location:login.php');
                    } 
                    else
                    {
                        echo $lang['SEND_MAIL_FAILED'];
                    }
            }
            
            else
            {
                echo "<h3>". $lang['SEND_MAIL_MSG'] ."</h3>";
            }
        }
     ?>
      <div style = "height:79vh">
  <div class = "shadow-lg bg-white rounder" style= "margin:auto; margin-top:25px;margin-bottom: 40px;width: 40%; 
  display: flex; height:200px; padding: 0;">
                <div class="container mt-3">
                <h4 class="text-center " ><?php echo $lang['ACCOUNT_RECOVER_EMAIL']; ?></h4>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label mt-2"><?php echo $lang['EMAIL']; ?></label>
                    <input type="email" class="form-control" name="email" id="email" 
                    aria-describedby="emailHelp" required>
                </div>             
                <button type="submit"  name= "submit" class="btn btn-primary"><?php echo $lang['SEND_MAIL']; ?></button>
                </form>
                </div>

                </div>
                </div>    
<?php
include 'includes/footer.php';
?> 
  </body>
</html>