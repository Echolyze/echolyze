<?php
	//If user is not signed in refirect
	if(!$user->isSigned()) redirect("../app/login");
	echo '<script>console.log("auth is checked, good to go!");</script>';

	include 'app-includes/header.php';
	include 'app-includes/leftnav.php';
?>

<style type="text/css">
	.phil-box-project:hover {
		/*background-color: red;*/
		border-top-color: #3c8dbc;
		cursor: pointer;
	}
</style>

<div class="content-wrapper">
	<?php
	include 'app-includes/global_loading.php';
	?>
	<section class="content-header content-header-pe hidden">
		<h1 class="col-xs-6 omega">Projects</h1>
		<div class="col-xs-6 alpha">
			<button id="addProjectCTA" type="button" class="btn btn-primary pull-right">Add Project</button>
		</div>
	</section>
	<section class="content hidden">
		<div class="row">
		<div class="col-xs-12">
			<div id="addProjectBox" class="box box-primary">
  				<div class="box-header with-border">
    				<h3 class="box-title">Add New Project</h3>
  				</div>
  				<form id="addProjectForm" class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label for="projectNameInput" class="col-sm-12">Project Name:</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="projectNameInput" placeholder="Project Name">
						</div>
					</div>
					<div class="form-group last-form-group">
						<label for="projectDescriptionInput" class="col-sm-12">Project Description:</label>
						<div class="col-sm-12">
							<textarea class="form-control" id="projectDescriptionInput" placeholder="Project Description"></textarea>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Save Project</button>
					<button type="reset" id="addProjectButton_Cancel" class="btn btn-default">Cancel</button>
				</div>
				</form>
			</div>
		</div>
		<div id="projectListings" class="col-xs-12">
			<div id="noProjectsMessage" class="hidden callout callout-info projects-listing" style="margin-left:0px; margin-right: 0px">
	  			<h4>Welcome <?php echo $user->first_name . ' ' . $user->last_name ?>!</h4>
	  			<p>Thanks for using Echolyze! Looks like you haven't created any projects yet. To get started using Echolyze, please <a style="cursor:pointer" id="createProjectInMessage">create your first project</a>.</p>
	  		</div>
			<div id="singleProjectTemplate" data-project-id="" class="box phil-box-project phils-js-framework-template">
  				<div class="box-header with-border">
    				<a href="" style="color: #444; display: block"><h3 class="box-title"></h3></a>
  				</div>
				<div class="box-body">
				</div>
			</div>
		</div>
		</div>
	</section>
</div>

<?php include 'app-includes/footer.php'; ?>

<script type="text/javascript">
$(document).ready(function () {
	
	// Elements:
	var addProjectBox = $('#addProjectBox');
	var addProjectForm = $('#addProjectForm');
	var addProjectCTA = $('#addProjectCTA');
	var addProjectButton_Cancel = $('#addProjectButton_Cancel');
	var addProject_ProjectNameInput = $('#projectNameInput');
	var addProject_ProjectDescriptionInput = $('#projectDescriptionInput');
	var singleProjectListing = $('#singleProjectTemplate');
	var allProjectListings = $('#projectListings');
	var noProjectsMessage = $('#noProjectsMessage');

	// Hide Add Project Box by Default
	addProjectBox.hide();


	// *************** All Project Listings ***************
	function loadAllProjects() {
		$.get("/api/standard.php/projects?transform=1&filter=deleted,eq,0&filter=related_owner,eq," + CURRENTUSER_ID, function(data) {
			globalLoadingIndicator_Clear();
			for (var i = 0; i < data.projects.length; i++) {
				insertNewProject(data.projects[i].id, data.projects[i].name, data.projects[i].description)
			}
			if (data.projects.length == 0) {
				noProjectsMessage.removeClass('hidden');
			}
		});
	}
	function insertNewProject(pID, pName, pDescription) {
		var projectToAdd = singleProjectListing.clone();
		projectToAdd.removeClass('phils-js-framework-template');
		projectToAdd.find('.box-title').text(pName);
		projectToAdd.find('.enter-project-link').attr('href', '/app/project/?projectID=' + pID);
		projectToAdd.find('.box-title').parent('a').attr('href', '/app/project/?projectID=' + pID);
		projectToAdd.children('.box-body').text(pDescription);
		projectToAdd.attr('data-project-id', pID);

		projectToAdd.click(function() {
			window.location = '/app/project/?projectID=' + pID;
			return false;
		});

		allProjectListings.prepend(projectToAdd);
	}
	// Load all the project listings on initial load
	loadAllProjects(); 


	// *************** Add Project Box ***************
	// Show addProjectBox on click
	$('#createProjectInMessage').click(function(e){
		startAddingProject();
		noProjectsMessage.addClass('hidden');
	})
	addProjectCTA.click(function(){
		startAddingProject();
		noProjectsMessage.addClass('hidden');
	})
	function startAddingProject() {
		addProjectCTA.addClass('disabled');
		addProjectBox.show();
		addProject_ProjectNameInput.focus();
	}
	addProjectButton_Cancel.click(function(){
		addProjectCTA.blur();
		addProjectCTA.removeClass('disabled');
		addProjectBox.hide();
	})
	addProjectForm.submit(function(e){
		e.preventDefault();
		var formData = {
			name: $('#projectNameInput').val(),
			description: $('#projectDescriptionInput').val(),
			related_owner: CURRENTUSER_ID
		}

		if (!formData.name){
			throwErrorOnField('projectNameInput','A project name is required.','padding-left:15px');
			return;
		}

		$.post("/api/standard.php/projects", formData, function(result) {
			if(!isNaN(result)) {
				insertNewProject(result, formData.name, formData.description);
				window.location = '/app/project/?projectID=' + result;
				// addProjectButton_Cancel.trigger('click');
			} else {
				console.log('Error adding project.');
			}
		});
	})
});


</script>