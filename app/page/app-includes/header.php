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
	<style type="text/css">
		.alpha {
			padding-right: 0px !important;
		}
		.omega {
			padding-left: 0px !important;
		}
		.content-header-pe {
			display: flex;
		}
		.last-form-group {
			margin-bottom: 0px !important;
		}
		.phils-js-framework-template {
			display: none;
		}
		.subheader-pe {
			margin-top: 0px;
		}
		.select2-dropdown .select2-search__field:focus, .select2-search--inline .select2-search__field:focus {
			border-width: 0px !important;
		}
		.child-node-pe {
			transform: rotate(180deg);
			font-size: 10px;
			position: relative;
			top: -3px;
		}
		.sidebar-header-pe {
			text-transform: uppercase;
		}
		.navbar-nav>.user-menu>.dropdown-menu {
			width: 100px;
		}
		.pe-content-left-alert {
			position: absolute;
			left: 15px;
			bottom: 0;
			z-index: 1000;
			width: 35%;
		}
	</style>
	<!-- REQUIRED JS SCRIPTS -->

	<!-- jQuery 2.2.3 -->
	<script src="/lib/AdminLTE-2.3.6/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="/lib/AdminLTE-2.3.6/bootstrap/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="/lib/AdminLTE-2.3.6/dist/js/app.min.js"></script>
	<!-- Select2 -->
	<script src="/lib/AdminLTE-2.3.6/plugins/select2/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
	<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
	<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
	<!-- Visualizations  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.17.0/vis.min.js"></script>
	<script src="/lib/cytoscape.min.js"></script>
	<!-- Phil's Common JS -->
	<script src="<?php echo $base?>/static/js/phil_utils.js"></script>
	<script src="<?php echo $base?>/static/js/single_project_utils.js"></script>
	<!-- JQuery Template -->
	<script src="/lib/jquery-template/dist/jquery.loadTemplate.js"></script>
</head>

<body class="hold-transition sidebar-mini skin-blue">
	<div class="wrapper">

		<header class="main-header">
			<a href="/app/all-projects/" class="logo">
				<span class="logo-mini"><b>e</b>lyze</span>
				<span class="logo-lg"><b>echo</b>lyze</span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li>
            				<a target="_Blank" href="https://docs.google.com/forms/d/e/1FAIpQLSecAMHUxzKN1cVZCgjRGOcfAvjHI4mmku0nTRWanhRsTDp2qA/viewform">Feedback</a>
          				</li>
						<li>
            				<a target="_Blank" href="https://github.com/Echolyze/echolyze/wiki/Common-Echolyze-Tasks">Help</a>
          				</li>
						<li class="dropdown user user-menu">
							<?php if($user->isSigned()) { ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-user"></i>
								<span class="hidden-xs"><?php echo $user->first_name . ' ' . $user->last_name ?></span>
							</a> 
							<?php } ?>
							<ul class="dropdown-menu">
								<li role="presentation"><a style="padding-top:5px; padding-bottom: 5px" role="menuitem" tabindex="-1" href="/app/account">Profile</a></li>
								<li role="presentation"><a style="padding-top:5px; padding-bottom: 5px" role="menuitem" tabindex="-1" href="/app/account">Change Password</a></li>
								<li role="presentation"><a style="padding-top:5px; padding-bottom: 5px" role="menuitem" tabindex="-1" href="<?php echo $base?>/ps/logout.php">Sign Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>