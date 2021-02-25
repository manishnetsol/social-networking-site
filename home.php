<?php
include 'includes/header.php';
?>

<div class="d-flex" id="wrapper">

<div>
<?php
include 'includes/sidebar.php';
?>
</div>


<div class="container" id="page-content-wrapper">
    <button class="btn btn-primary" data-toggle="collapse" data-target="#sidebar-wrapper">Toggle Sidebar</button>

    <form class="mt-5">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="fname">First Name</label>
        <input type="text" class="form-control" id="fname">
      </div>
      <div class="form-group col-md-6">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control" id="lname">
      </div>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" class="form-control" id="address" placeholder="1234 Main St">
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password">
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>

</div>


<?php
include 'includes/footer.php';
?>