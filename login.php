<?php
session_start();
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
  else{
//     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
//   <strong>Success!</strong>Connection Successful.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
  //   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  //   <strong>Success!</strong> Your email ' . $email . ' and Password ' . $password . ' have been submitted successfully.
  //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  //     <span aria-hidden="true">&times;</span>
  //   </button>
  // </div>';
  
  $verifyemail = "SELECT * FROM `users` WHERE email='$email'";
  $query = mysqli_query($conn, $verifyemail);
  $count = mysqli_num_rows($query);

  if($count==1){
    $_SESSION['email']= $email;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if(password_verify($password, $hashed_password))
    {
      echo "login Succcess";
      header('Location: home.php');

    }
    else{
      echo "password incorrect";
    }
  } 
  else{
    echo "email not present";
    header('Location: register.php');
    
  }
  }
  ?>
  <!-- Login Section below -->
  <div style = "height:79vh">
  <div class = "shadow-lg bg-white rounder" style= "margin:auto; margin-top:25px;margin-bottom: 40px;width: 40%; display: flex; height:300px; padding: 0;">
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
      <label for="email">Email address</label>
      <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
  <button type="submit" class="btn btn-primary">LOG IN</button>
  <div class="row  my-4" style="font-size: 17px">
    <div class="col-12" >
      <a style="padding: 0 "href="register.php"> Don't have An Account </a>
    </div>
    <div class="row  ">
      <div class="col-12">
       <p style="margin-left:15px"> Forgot Password ?
       <a href="recover_account.php"> Reset here </a> </p>
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

