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
    /*.select2-pe .select2-container--default .select2-selection--single .select2-selection__arrow{
      height: 34px !important;
    }
    .select2-pe .select2-container .select2-selection--single{
      height: 34px !important;
      padding-left: 4px !important;
      border-radius: 0px !important;
      border-color: #d2d6de !important;
    }*/
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
    <script src="http://cytoscape.github.io/cytoscape.js/api/cytoscape.js-latest/cytoscape.min.js"></script>

  <script type="text/javascript">
    function gup( name ) {
      name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
      var regexS = "[\\?&]"+name+"=([^&#]*)";
      var regex = new RegExp( regexS );
      var results = regex.exec( window.location.href );
      if( results == null )
        return "";
      else
        return results[1];
    }

// http://stepansuvorov.com/blog/2014/04/jquery-put-and-delete/
jQuery.each( [ "put", "delete" ], function( i, method ) {
  jQuery[ method ] = function( url, data, callback, type ) {
    if ( jQuery.isFunction( data ) ) {
      type = type || callback;
      callback = data;
      data = undefined;
    }
 
    return jQuery.ajax({
      url: url,
      type: method,
      dataType: type,
      data: data,
      success: callback
    });
  };
});


  </script>

  <!-- Phil's Common JS -->
  <script src="/lib/object-watch.js"></script>
  <script src="/single-project/single_project_utils.js"></script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/projects/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>e</b>lyze</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>echo</b>lyze</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Current User: Test Account</span>
            </a>
            <ul class="dropdown-menu">
            <li><a href="#" class="btn btn-default btn-flat">Profile</a></li>
            <li><a href="/index.php" class="btn btn-default btn-flat">Sign Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>