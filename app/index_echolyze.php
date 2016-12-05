<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>echolyze</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>echo</b>lyze</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="/projects/" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" value="testaccount@testing.com">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" value="testaccountpassword">
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
          <a href="#" class="text-left">Register a new account</a>
        </div>
        <div class="col-xs-6 text-right">
          <a href="#" class="">I forgot my password</a>
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
</body>
</html>
