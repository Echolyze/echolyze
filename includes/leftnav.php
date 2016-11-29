  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar ">
    <section class="sidebar">
      <div class="callout callout-info projects-listing" style="margin:10px">
        <h4>Welcome Test Account!</h4>
        <p>Please select a project to continue.</p>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu sidebar-project-menu hidden">
        <li class="header sidebar-header-pe single-project-name"></li>
        <li id="homeLink">
            <a href="#"><i class="fa fa-home"></i> <span>Project Home</span></a>
        </li>
        <li id="nodesLink">
            <a href="#"><i class="fa fa-cubes"></i> <span>Manage Nodes</span></a>
        </li>
        <li id="codesLink">
            <a href="#"><i class="fa fa-comment"></i> <span>Manage Codes</span></a>
        </li>
        <li id="artifactsLink">
            <a href="#"><i class="fa fa-file-text-o"></i> <span>Artifacts & Coding</span></a>
        </li>
        <li id="reportingLink">
            <a href="#"><i class="fa fa-pie-chart"></i> <span>Reporting</span></a>
        </li>
      </ul>
    </section>
  </aside>

  <script type="text/javascript">
    var currentProjectID = gup('projectID');
    var currentDestination = gup('destination');

    if(currentProjectID) {
      $('.sidebar-project-menu').removeClass('hidden');
      $('.projects-listing').addClass('hidden');
    }
    $('#homeLink').find('a').attr('href', '?projectID=' + currentProjectID);
    $('#nodesLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=nodes');
    $('#codesLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=codes');
    $('#artifactsLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=artifacts');
    $('#reportingLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=reporting');

    $('#' + currentDestination + 'Link').addClass('active');
    console.log(currentDestination);
    if(currentDestination == '') {
      $('#homeLink').addClass('active');
    }

  </script>