<body>


<?php
$title = "GenZ";
$currentPage = 'index.php';
include 'includes/header.php';
?>

  <!-- content -->


<div class="m-4">
	<div class="row">	
		<div class="col-md-7">
			<img src="assets/images/mainpic.jpg" class="img-fluid mt-auto" title="Connect">
			
		</div>
		<div class="col-md-5">
			<img src="assets/images/logo.png" class="img-fluid w-75" title="Business Icon">
			<h4><strong><?php echo $lang['SLOGAN']; ?></strong></h4><br><br>
			<h4><strong><?php echo $lang['INDEX_JOIN']; ?></strong></h4>
			<form>
			<a href="register.php" class="btn btn-info btn-lg w-75"><?php echo $lang['INDEX_SIGNUP']; ?></a><br><br>
			<a href="login.php" class="btn btn-info btn-lg w-75"><?php echo $lang['INDEX_LOGIN']; ?></a><br><br>
			</form>
		</div>
	</div>

</div>
	
<?php
include 'includes/footer.php';
?>






</body>


</html>