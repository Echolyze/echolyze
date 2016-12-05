<?php include '../includes/header.php'; ?>
<?php include '../includes/leftnav.php'; ?>

<style type="text/css">
	.phil-box-project:hover {
		/*background-color: red;*/
		border-top-color: #3c8dbc;
		cursor: pointer;
	}
</style>

<div class="content-wrapper">
	<section class="content-header content-header-pe">
		<h1 class="col-xs-6 omega">Projects</h1>
		<div class="col-xs-6 alpha">
			<button id="addProjectCTA" type="button" class="btn btn-primary pull-right">Add Project</button>
		</div>
	</section>
	<section class="content">
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
			<div id="singleProjectTemplate" data-project-id="" class="box phil-box-project phils-js-framework-template">
  				<div class="box-header with-border">
    				<a href="" style="color: #444; display: block"><h3 class="box-title"></h3></a>
  				</div>
				<div class="box-body">
					Nulla ut mi erat. Maecenas euismod mauris et tempus fringilla. Nulla facilisi. Etiam tortor augue, imperdiet sit amet pulvinar sit amet, porttitor at purus. Mauris molestie eget arcu nec rutrum. Cras non tempor nibh. In luctus sit amet neque ut eleifend.
				</div>
			</div>
		</div>
		</div>
	</section>
</div>

<?php include '../includes/footer.php'; ?>

<script type="text/javascript">
	// Elements:
	var addProjectBox = $('#addProjectBox');
	var addProjectForm = $('#addProjectForm');
	var addProjectCTA = $('#addProjectCTA');
	var addProjectButton_Cancel = $('#addProjectButton_Cancel');
	var addProject_ProjectNameInput = $('#projectNameInput');
	var addProject_ProjectDescriptionInput = $('#projectDescriptionInput');
	var singleProjectListing = $('#singleProjectTemplate');
	var allProjectListings = $('#projectListings');


	// *************** All Project Listings ***************
	function loadAllProjects() {
		$.get("/api/standard.php/projects?transform=1", function(data) {
			for (var i = 0; i < data.projects.length; i++) {
				insertNewProject(data.projects[i].id, data.projects[i].name, data.projects[i].description)
			}
		});
	}
	function insertNewProject(pID, pName, pDescription) {
		var projectToAdd = singleProjectListing.clone();
		projectToAdd.removeClass('phils-js-framework-template');
		projectToAdd.find('.box-title').text(pName);
		projectToAdd.find('.enter-project-link').attr('href', '/single-project/?projectID=' + pID);
		projectToAdd.find('.box-title').parent('a').attr('href', '/single-project/?projectID=' + pID);
		projectToAdd.children('.box-body').text(pDescription);
		projectToAdd.attr('data-project-id', pID);

		projectToAdd.click(function() {
			window.location = '/single-project/?projectID=' + pID;
			return false;
		});

		allProjectListings.prepend(projectToAdd);
	}
	// Load all the project listings on initial load
	loadAllProjects(); 


	// *************** Add Project Box ***************
	// Hide Add Project Box by Default
	addProjectBox.hide();
	// Show addProjectBox on click
	addProjectCTA.click(function(){
		addProjectCTA.addClass('disabled');
		addProjectBox.show();
		addProject_ProjectNameInput.focus();
	})
	addProjectButton_Cancel.click(function(){
		addProjectCTA.blur();
		addProjectCTA.removeClass('disabled');
		addProjectBox.hide();
	})
	addProjectForm.submit(function(){
		var formData = {
			name: $('#projectNameInput').val(),
			description: $('#projectDescriptionInput').val(),
		}

		// @TODO: Error Validation

		$.post("/api/standard.php/projects", formData, function(result) {
			if(!isNaN(result)) {
				insertNewProject(result, formData.name, formData.description);
				addProjectButton_Cancel.trigger('click');
			} else {
				console.log('Error adding project.');
			}
		});
	})


	// *************** Edit Project Box ***************


</script>