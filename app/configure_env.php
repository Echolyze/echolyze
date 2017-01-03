<style type="text/css">
	body {
		background-image: url(static/img/bg1.png);
	    background-size: cover;
	}
</style>

<?php

$configFileMade = false;
$configFilename = '../echolyze_user_config.php';

if ($_POST['db_host'] && $_POST['db_username'] && $_POST['db_password'] && $_POST['db_name']) {
  file_put_contents($configFilename,'<?php' . PHP_EOL);
  file_put_contents($configFilename,'$db_host = \'' . $_POST['db_host'] . '\';' . PHP_EOL, FILE_APPEND);
  file_put_contents($configFilename,'$db_username = \'' . $_POST['db_username'] . '\';' . PHP_EOL, FILE_APPEND);
  file_put_contents($configFilename,'$db_password = \'' . $_POST['db_password'] . '\';' . PHP_EOL, FILE_APPEND);
  file_put_contents($configFilename,'$db_name = \'' . $_POST['db_name'] . '\';' . PHP_EOL, FILE_APPEND);
  file_put_contents($configFilename,'?>', FILE_APPEND);

  $configFileMade = true;
}



?>

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


<?php 
if(!$configFileMade):
?>

<div class="login-box" style="background-color: #FFF;">
  <div class="login-logo" style="margin-bottom: 0px; padding-top:20px">
    <a href="../../index2.html"><b>echo</b>lyze</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Looks like this is your first time using Echolyze. Please complete the fields below to configure your environment.</p>
    <form method="post" action="" data-success="">
      <div class="form-group has-feedback">
        <input type="text" name="db_host" class="form-control" placeholder="Database Host Address" value="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="db_username" class="form-control" placeholder="Database Username" value="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="db_password" class="form-control" placeholder="Database Password" value="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="db_name" class="form-control" placeholder="Database Name" value="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Configure Environment</button>
        </div>
      </div>
    </form>
    <div class="row" style="margin-top:10px">
        <div class="col-xs-12">
          <a href="https://github.com/Echolyze/echolyze/wiki" class="text-left">Documentation WIKI</a>
        </div>
      </div>
  </div>
</div>

<? else: ?>
<h3 style="color: white">Success! Please refresh your page and create your own Echolyze account.</h3>
<? endif; ?>



<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<script src="/lib/AdminLTE-2.3.6/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/lib/AdminLTE-2.3.6/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/lib/AdminLTE-2.3.6/dist/js/app.min.js"></script>