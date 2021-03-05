<?php

  $title = "admin-login";

  include(dirname(__DIR__).'/includes/header.php');
?>
<body>



  <div style = "height:79vh">
  <div class = "shadow-lg bg-white rounder" style= "margin:auto; margin-top:25px;margin-bottom: 40px;width: 40%; display: flex; height:300px; padding: 0;">
  <div class="container">
  <form action="admin-dashboard.php" method="post" class="mt-4" id="form">
  <section class="mb-2 text-center">
  <h4><b style="color:green;">ADMIN</b></h4>
  </section>
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>

    <div class="container">
  <a style = "float : right;"href="#" data-target="#pwdModal" data-toggle="modal">Forgot Password</a>
</div>

<!--modal-->
<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          
                          <p>If you forgot your password you can reset it here.</p>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control input-lg" placeholder="E-mail Address" name="email" type="email">
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>

      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div>




  <button type="submit" class="btn btn-primary">LOG IN</button>
  </form>
  </div>
  </div>
</div>
 
<?php
  include(dirname(__DIR__).'/includes/footer.php');
?>


</body>

</html>

