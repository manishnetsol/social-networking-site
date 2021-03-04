<?php
  $title = "Login";
  $currentPage = 'login.php';
  include 'includes/header.php';
  ?>
<body>
    
  <!-- PHP Code Below -->
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
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
 
  
  $verifyemail = "SELECT * FROM `users` WHERE email='$email' && active ='1'";
  $query = mysqli_query($conn, $verifyemail);
  $count = mysqli_num_rows($query);

  $emailnotactive="SELECT * FROM `users` WHERE email='$email' && active= '0' ";
  $query1 = mysqli_query($conn, $emailnotactive);
  $count1 = mysqli_num_rows($query1);

  if($count==1){
    $email_pass=mysqli_fetch_assoc($query);
    $dbpass =$email_pass['password'];
    $db_verify= password_verify($password,$dbpass);
    if($db_verify)
    {
      echo "login Succcess";
      header('Location: home.php');

    }
    else{
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>". $lang['PASSWORD_INCORRECT'] ."</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";

      // echo $lang['PASSWORD_INCORRECT'];

    }
  } 

    else if($count1==1)
  {
   // echo "Please Activate your Account ";
   echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong> Please Activate your Account  </strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    // header('Location: login.php');
  }

  else
  {
    echo "email not present";
    header('Location: register.php');    
  }
}
  ?>
  <!-- Login Section below -->
  <div style = "height:79vh">
  <div class = "shadow-lg bg-white rounder" style= "margin:auto; margin-top:25px;margin-bottom: 40px;
  width: 40%; display: flex; height:350px; padding: 0;">
  <div class="container">
  <form action="login.php" method="post" class="mt-2" id="form">
  <p  class="text-success" style="font-weight:bold">
      <?php
          if(isset($_SESSION['msg']))
              {
                  echo $_SESSION['msg'] ; 
              }
                         
      ?> 
  </p>
    <div class="form-group">
      <label for="email"><?php echo $lang['EMAIL']; ?></label>
      <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
      <label for="password"><?php echo $lang['PASSWORD']; ?></label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
  <button type="submit" class="btn btn-primary"><?php echo $lang['INDEX_LOGIN']; ?></button>
  <div class="row  my-4" style="font-size: 17px">
    <div class="col-12" >
      <a style="padding: 0 "href="register.php"><?php echo $lang['NO_ACCOUNT']; ?></a>
    </div>
    <div class="row  ">
      <div class="col-12">
       <p style="margin-left:15px"><?php echo $lang['FORGOT_PASSWORD']; ?>
       <a href="recover_account.php"><?php echo $lang['PASSWORD_RESET']; ?></a> </p>
     </div>
    </div>
  </div>
 
  </form>
  </div>
  </div>
</div>
  
  <!-- JS Links Below -->
  
 
  <?php
  include 'includes/footer.php';
  ?>
  
  <script src = "assets/js/login.js"></script>

</body>

</html>

