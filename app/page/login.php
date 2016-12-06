<?php
	if($user->isSigned()) redirect("./all-projects");
?>

<style type="text/css">
	body {
		background-image: url(static/img/bg1.png);
	    background-size: cover;
	}
</style>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="/lib/AdminLTE-2.3.6/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/lib/AdminLTE-2.3.6/plugins/select2/select2.min.css">
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/lib/AdminLTE-2.3.6/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="/lib/AdminLTE-2.3.6/dist/css/skins/skin-blue.min.css">
<!-- Visualizations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.17.0/vis.min.css">



<div class="login-box" style="background-color: #FFF;">
  <div class="login-logo" style="margin-bottom: 0px; padding-top:20px">
    <a href="../../index2.html"><b>echo</b>lyze</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form method="post" action="ps/login.php" data-success="<?php echo $base?>/all-projects">
      <div class="form-group has-feedback">
        <input type="email" name="username" class="form-control" placeholder="Email" value="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" value="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
    <div class="row" style="margin-top:10px">
        <div class="col-xs-6">
          <a href="register" class="text-left">Register a new account</a>
        </div>
        <div class="col-xs-6 text-right">
          <a href="resetPassword" class="">I forgot my password</a>
        </div>
      </div>
  </div>
</div>



<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<script src="/lib/AdminLTE-2.3.6/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/lib/AdminLTE-2.3.6/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/lib/AdminLTE-2.3.6/dist/js/app.min.js"></script>