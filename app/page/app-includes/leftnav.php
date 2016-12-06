<style type="text/css">
	/*For some reason the arrow isn't pointing down on the selected one...*/
	.sidebar-menu li.active>a>.fa-angle-left, .sidebar-menu li.active>a>.pull-right-container>.fa-angle-left {
	    transform: rotate(-90deg);
	}
	.treeview-menu li a {
		padding-top: 7px !important;
		padding-bottom: 7px !important;
	}
	#TopOfNav-PE {
		padding: 0px;
	}
	#TopOfNav-PE a:hover {
		border-left: 3px solid transparent;
	}
</style>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar ">
  	<section class="sidebar">
  		<!-- Sidebar Menu -->
  		<ul id="projectListingBar" class="sidebar-menu sidebar-project-menu">
  			<li id=TopOfNav-PE class="header"><a href="/app/all-projects/">PROJECTS</a></li>
  		</ul>

  	</section>
  </aside>


  <script id="singleNavTreeTemplate" type="text/html">
  	<a href="#">
  		<i class="fa fa-folder"></i> <span data-content="project-name" id="navProjectName"></span>
  		<span class="pull-right-container">
  			<i class="fa fa-angle-left pull-right"></i>
  		</span>
  	</a>
  	<ul class="treeview-menu" style="display: none;">
  		<li id="homeLink" class=""><a href=""><i class="fa fa-home"></i> Project Details</a></li>
  		<li id="nodesLink"><a href=""><i class="fa fa-cubes"></i> Manage Nodes</a></li>
  		<li id="codesLink"><a href=""><i class="fa fa-comment"></i> Manage Codes</a></li>
  		<li id="artifactsLink"><a href=""><i class="fa fa-file-text-o"></i> Artifacts & Coding</a></li>
  		<li id="reportingLink"><a href=""><i class="fa fa-pie-chart"></i> Reporting</a></li>
  	</ul>
  </script>
  <script type="text/javascript">
  	var currentProjectID = gup('projectID');
  	var currentDestination = gup('destination');


  	if(currentProjectID) {
  		$('.sidebar-project-menu').removeClass('hidden');
  		$('.projects-listing').addClass('hidden');
  	}

  // *************** All Projects for User ***************
  function loadAllProjectsAndSetupNav() {
  	$.get("/api/standard.php/projects?transform=1&filter=deleted,eq,0&filter=related_owner,eq," + CURRENTUSER_ID, function(data) {
  		for (var i = 0; i < data.projects.length; i++) {
  			var newProjectEntry = $("<li class='treeview'>");
  			newProjectEntry.loadTemplate(
  				$('#singleNavTreeTemplate'),
  				{
  					"project-name": data.projects[i].name
  				}
  			);
  			newProjectEntry.find('#homeLink').children('a').attr('href', '?projectID=' + data.projects[i].id);
  			newProjectEntry.find('#nodesLink').children('a').attr('href', '?projectID=' + data.projects[i].id + '&destination=nodes');
  			newProjectEntry.find('#codesLink').children('a').attr('href', '?projectID=' + data.projects[i].id + '&destination=codes');
  			newProjectEntry.find('#artifactsLink').children('a').attr('href', '?projectID=' + data.projects[i].id + '&destination=artifacts');
  			newProjectEntry.find('#reportingLink').children('a').attr('href', '?projectID=' + data.projects[i].id + '&destination=reporting');

  			console.log(currentProjectID);
  			if(currentProjectID == data.projects[i].id) {
  				newProjectEntry.find('.treeview-menu').css('display','block');
  				newProjectEntry.addClass('active');

				newProjectEntry.find('#' + currentDestination + 'Link').addClass('active')
				if(currentDestination == '') {
					newProjectEntry.find('#homeLink').addClass('active');
				}
  			}

  			$('#projectListingBar').append(newProjectEntry);
  		}
  	});
  }
  loadAllProjectsAndSetupNav();



    // $('#homeLink').find('a').attr('href', '?projectID=' + currentProjectID);
    // $('#nodesLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=nodes');
    // $('#codesLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=codes');
    // $('#artifactsLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=artifacts');
    // $('#reportingLink').find('a').attr('href', '?projectID=' + currentProjectID + '&destination=reporting');

    // $('#' + currentDestination + 'Link').addClass('active');
    // console.log(currentDestination);
    // if(currentDestination == '') {
    //   $('#homeLink').addClass('active');
    // }

</script>