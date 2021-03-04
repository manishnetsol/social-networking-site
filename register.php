<?php
  $title = 'Registeration';
  $currentPage = 'register.php';
  include 'includes/header.php';
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
  $valid_age = False;
  
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
   

   if($myage >= 13){ 
    $valid_age = True;

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
    
      
  if($valid_email && $valid_firstname && $valid_pwd_length && $valid_pwd_match && $valid_user_empty && $valid_user_unique && $valid_pwd && $valid_age){

    $sql = "INSERT INTO users (username,password,email,first_name,last_name,gender,dob,country,token)
    values('$username','$hashed_password','$email','$first_name','$last_name','$gender','$dob','$country','$token') ";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
            $to_email = $email;
            $subject =  $lang['ACTIVATION_SUBJECT'];
            $body = "Hi, $username. Click  Here to  Activate your account     
            http://localhost/social-networking-site/activate.php?token=$token";
            $sender = "From: codermailtosent@gmail.com";

            if (mail($to_email, $subject, $body, $sender)) {
                  $_SESSION['msg'] = "Check your mail to activate your account $email";
                  
                  header('location:login.php');
            } else
             {
                echo $lang['SEND_MAIL_FAILED'];
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
      <label for="inputEmail4"><?php echo $lang['REGISTER_USERNAME']; ?></label>
      <input  type="text" class="form-control"  name="username" id="username" placeholder="<?php echo $lang['REGISTER_USERNAME']; ?>">
      <?php if(!$valid_user_empty && $form_posted){
        echo "<small class='form-text text-danger'>". $lang['REGISTER_USERNAME_EMPTY'] ."</small>";
       }
       if(!$valid_user_unique && $form_posted){
        echo "<small class='form-text text-danger'>". $lang['REGISTER_USERNAME_EXISTS'] ."</small>";
      }
      ?>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4"><?php echo $lang['REGISTER_EMAIL']; ?></label>
      <input type="Email" class="form-control" name="email" id="email" placeholder="<?php echo $lang['REGISTER_EMAIL']; ?>">
      <?php if(!$valid_email && $form_posted){
        echo "<small class='form-text text-danger>". $lang['REGISTER_EMAIL_EMPTY'] ."</small>";
       }
       ?>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4"><?php echo $lang['REGISTER_PWD']; ?></label>
      <input type="password" class="form-control" name ="pwd" id="pwd" placeholder="<?php echo $lang['REGISTER_PWD']; ?>">
      <?php if(!$valid_pwd && $form_posted){
        echo "<small class='form-text text-danger'>". $lang['REGISTER_PWD_EMPTY'] ."</small>";
       }
       if(!$valid_pwd_length && $form_posted){
        echo "<small class='form-text text-danger'>". $lang['REGISTER_PWD_MIN'] ."</small>";
       }
       ?>
    </div>
  
  
  <div class="form-group col-md-6">
      <label for="inputPassword4"><?php echo $lang['REGISTER_PWD_REPEAT']; ?></label>
      <input type="password" class="form-control" name ="confirm_password" id="confrim_password" placeholder="<?php echo $lang['REGISTER_PWD_REPEAT']; ?>">
      <?php
      if(!$valid_pwd_match && $form_posted){
        echo "<small class='form-text text-danger'>". $lang['REGISTER_PWD_MATCH'] ."</small>";
       }
       ?>
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4"><?php echo $lang['REGISTER_FNAME']; ?></label>
      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="<?php echo $lang['REGISTER_FNAME']; ?>">
      <?php if(!$valid_firstname && $form_posted){
        echo "<small class='form-text text-danger'>". $lang['REGISTER_FNAME_EMPTY'] ."</small>";
       }
       ?>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4"><?php echo $lang['REGISTER_LNAME']; ?></label>
      <input type="text" class="form-control" name="lastname" id="inputEmail4" placeholder="<?php echo $lang['REGISTER_LNAME']; ?>">
    </div>
  <div class="form-group col-md-6">
    <label for="inputAddress2"><?php echo $lang['REGISTER_COUNTRY']; ?>
</label>
    <select id="inputState7" name="country" class="form-control">
    <?php while ( $row = mysqli_fetch_array($res) ) { ?>
    <option value="<?php echo $row['country_id']; ?> "><?php echo $row['country_name'] ; ?></option>
    <?php } ?>
      </select>
  </div>
    <div class="form-group col-md-6">
      <label for="inputCity"><?php echo $lang['REGISTER_DOB']; ?></label>
      <input type="Date" name="dob" class="form-control" id="inputCity">
      <?php if(!$valid_age && $form_posted){
      echo "<small class='form-text text-danger'>".$lang['REGISTER_DOB_INVALID']."</small>";
      }
      ?>
    </div>
    <div class="form-group col-md-6">
      <label for="inputState"><?php echo $lang['REGISTER_GENDER']; ?></label>
      <select id="inputState" name="gender" class="form-control">
        <option selected  value="M"><?php echo $lang['REGISTER_GENDER_MALE']; ?></option>
        <option  value="F"><?php echo $lang['REGISTER_GENDER_FEMALE']; ?></option>
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
  <button type="submit" class="btn btn-primary"><?php echo $lang['INDEX_SIGNUP']; ?></button>
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