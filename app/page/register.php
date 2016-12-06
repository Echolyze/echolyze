<?php
	if($user->isSigned()) redirect(".");
	
	$d = @$_SESSION["regData"];
	unset($_SESSION["regData"]);
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

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<script src="/lib/AdminLTE-2.3.6/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/lib/AdminLTE-2.3.6/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/lib/AdminLTE-2.3.6/dist/js/app.min.js"></script>


<div class="login-box" style="background-color: #FFF;">
	<div class="login-logo" style="margin-bottom: 0px; padding-top:20px">
		<a href="../../index2.html"><b>echo</b>lyze</a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Register for a new echolyze account.</p>
		<form method="post" action="<?php echo $base ?>/ps/register.php" data-success="<?php echo $base?>/login">
			<div class="form-group">
				<input name="Username" id="username" type="hidden" required class="form-control" autofocus>
			</div>

			<div class="form-group">
				<label>First Name:</label>
				<input name="first_name" type="text" class="form-control">
			</div>

			<div class="form-group">
				<label>Last Name:</label>
				<input name="last_name" type="text" class="form-control">
			</div>

			<div class="form-group">
				<label>Email: </label>
				<input name="Email" id="email" type="text" required class="form-control">
			</div>

			<div class="form-group">
				<label>Password:</label>
				<input name="Password" type="password" required class="form-control">
			</div>

			<div class="form-group">
				<label>Confirm Password:</label>
				<input name="Password2" type="password" required class="form-control">
			</div>

			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Register</button>
				</br>
				</br>
				<a href="<?php echo $base?>/login" class="">Login to an Existing Account</a>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$('#email').keyup(function(e){
		$('#username').val(e.target.value)
	})
</script>