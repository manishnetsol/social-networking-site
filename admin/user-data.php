<?php

$title = "admin-data";

  include '../includes/header.php';
?>

<!-- <script>
function showTable(){
document.getElementById('myTable1').style.visibility = "visible";
}
function hideTable(){
document.getElementById('myTable1').style.visibility = "hidden";
}
</script>
<body onload="javascript:hideTable()"> -->
<!-- <input type='button' onClick='javascript:showTable();' value='show'>
<input type='button' onClick='javascript:hideTable();' value='hide'> -->

<a href="admin-data.php">
<button type="button" class="btn btn-primary btn-lg" >Admin Data</button>
</a>
<a href="user-data.php">
<button type="button" class="btn btn-secondary btn-lg">User Data</button>
</a>



<div class="container">
<h3>User Table</h3>
    <table class="table table-fluid" id="myTable2">
    <thead>
    <tr><th>Name</th><th>Email</th><th>Password</th></tr>
    </thead>
    <tbody>
    <tr><td>Daniel Danny</td><td>danny.daniel@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Veronica Lodge</td><td>veronicalodge@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Betty Cooper</td><td>bettycooper@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>jughead Jones</td><td>jugheadjones@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Pinky</td><td>pinky@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Mishti</td><td>mishti@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Puneet</td><td>puneet@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Nick</td><td>nick@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Disha</td><td>disha@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Vishakha</td><td>vishakha@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Nitin</td><td>ni3@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Latika</td><td>latika@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Kaavya</td><td>kaavya@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Ishika</td><td>ishika@gmail.com</td><td>Pass1234</td></tr>
    <tr><td>Veronika</td><td>veronika@gmail.com</td><td>Pass1234</td></tr>
    </tbody>
    </table>
</div>



<?php
  include '../includes/footer.php';
  ?>




<script>
    $(document).ready( function () {
    $('#myTable2').DataTable();
} );
    </script>