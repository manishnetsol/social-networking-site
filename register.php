<?php
  include 'includes/header.php';
  session_start();
  ?>
<body>
 
  <!-- PHP Code below -->
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
  $country = "SELECT * FROM countries"; //You don't need a ; like you do in SQL
  $res = mysqli_query($conn ,$country);
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";
  $form_posted = False;
  $valid_user_empty = False;
  $valid_email = False;
  $valid_firstname = False;
  $valid_user_unique = False;
  $valid_pwd = False;
  $valid_pwd_length = False;
  $valid_pwd_match = False;
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $gender =  $_POST['gender'];;
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $password= $_POST['pwd'];
    $dob = $_POST['dob'];
    $country= $_POST['country'];
    $token = bin2hex(random_bytes(15));
    // $active = 1;
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $num = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($num);
    $form_posted = True;
    $date2=date("Y-m-d");

   $date1=new DateTime($dob);
   $date2=new DateTime();

   $interval =date_diff($date2,$date1);

   $myage= $interval->y;
   

   if(!($myage >= 13)){ 
    echo "Invalid age";

  } 
  

    if(!empty(trim($_POST["username"]))){
      $valid_user_empty = True;
      // echo  "Username cannot be blank";
    }
    if(!empty(trim($_POST["email"]))){
      $valid_email = True;
    }
    
    if(!empty(trim($_POST["firstname"]))){
      $valid_firstname = True;
    }
    if(!$num_rows=="1"){
      $valid_user_unique = True;
      }
      
    if(!empty(trim($_POST["pwd"]))){
       $valid_pwd = True;
    }
    if(!strlen(trim($_POST["pwd"])) < 5){
       $valid_pwd_length = True;
    }
    
    
    // Check for confirm password field
    if(trim($_POST["pwd"]) ==  trim($_POST["confirm_password"])){
        $valid_pwd_match = True;
    }
    
      
  if($valid_email && $valid_firstname && $valid_pwd_length && $valid_pwd_match && $valid_user_empty && $valid_user_unique && $valid_pwd){

    $sql = "INSERT INTO users (username,password,email,first_name,last_name,gender,dob,country,token)
    values('$username','$hashed_password','$email','$first_name','$last_name','$gender','$dob','$country','$token') ";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
            $to_email = $email;
            $subject = "Email Activation";
            $body = "Hi, $username. Click  Here to  Activate your account     
            http://localhost/social-networking-site/activate.php?token=$token";
            $sender = "From: codermailtosent@gmail.com";

            if (mail($to_email, $subject, $body, $sender)) {
                  $_SESSION['msg'] = "Check your mail to activate your account $email";
                  $_SESSION['starttime']=time();
                  header('location:login.php');
            } else {
                echo "Email sending failed                  ...";
            }
    }
    else{
    echo "Error:".$sql;
  }
}
}


  ?>
  <!-- Registeration Section below -->
<div class = "shadow-lg bg-white rounder" style= "margin:auto; margin-top:25px;margin-bottom: 40px;width: 80%; display: flex; height:580px; padding: 0;">
  <div class="container mt-5">
  <form action="register.php" id= "form" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Username</label>
      <input  type="text" class="form-control"  name="username" id="username" placeholder="username">
      <?php if(!$valid_user_empty && $form_posted){
        echo " <small class='form-text text-danger'>!!!Username cannot be empty.</small>";
       }
       if(!$valid_user_unique && $form_posted){
        echo " <small class='form-text text-danger'>!!!Username already exists.</small>";
      }
      ?>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="Email" class="form-control" name="email" id="email" placeholder="Email">
      <?php if(!$valid_email && $form_posted){
        echo " <small class='form-text text-danger'>!!!Email cannot be empty.</small>";
       }
       ?>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name ="pwd" id="pwd" placeholder="Password">
      <?php if(!$valid_pwd && $form_posted){
        echo " <small class='form-text text-danger'>!!!pwd cannot be empty.</small>";
       }
       if(!$valid_pwd_length && $form_posted){
        echo " <small class='form-text text-danger'>!!!pwd should contain 5 letters.</small>";
       }
       ?>
    </div>
  
  
  <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name ="confirm_password" id="confrim_password" placeholder="Confirm Password">
      <?php
      if(!$valid_pwd_match && $form_posted){
        echo " <small class='form-text text-danger'>!!!pwd should match.</small>";
       }
       ?>
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Firstname</label>
      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname">
      <?php if(!$valid_firstname && $form_posted){
        echo " <small class='form-text text-danger'>!!!Firstname cannot be empty.</small>";
       }
       ?>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Lastname</label>
      <input type="text" class="form-control" name="lastname" id="inputEmail4" placeholder="lastname">
    </div>
  <div class="form-group col-md-6">
    <label for="inputAddress2">Country
</label>
    <select id="inputState7" name="country" class="form-control">
    <?php while ( $row = mysqli_fetch_array($res) ) { ?>
    <option value="<?php echo $row['country_id']; ?> "><?php echo $row['country_name'] ; ?></option>
    <?php } ?>
      </select>
  </div>
    <div class="form-group col-md-6">
      <label for="inputCity">DOB</label>
      <input type="Date" name="dob" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Gender</label>
      <select id="inputState" name="gender" class="form-control">
        <option selected  value="M">Male</option>
        <option  value="F">Female</option>
      </select>
    
  </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">SIGN UP</button>
</form>
</div>
  </div>
  <!-- JS Links Below -->
  <?php
  include 'includes/footer.php';
  ?>
  
  <script src="assets/js/login.js"></script>
</body>
</div>
</html>