<div class="row">
	<div class="col-xs-4">
		<div id="projectDetails" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Edit Project Details</h3>
			</div>
			<form id="editProjectDetails" class="form-horizontal">
			<div class="box-body">
				<div class="form-group">
					<label for="editProjectNameInput" class="col-sm-12">Project Name:</label>
					<div class="col-sm-12">
						<input type="text" class="form-control" id="editProjectNameInput" placeholder="Project Name">
					</div>
				</div>
				<div class="form-group last-form-group">
					<label for="editProjectDescriptionInput" class="col-sm-12">Project Description:</label>
					<div class="col-sm-12">
						<textarea class="form-control" id="editProjectDescriptionInput" placeholder="Project Description"></textarea>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" id="saveProjectSubmit" class="btn btn-primary">Save Project Details</button>
				<button type="reset" id="editProjectButton_Cancel" class="btn btn-default">Cancel</button>
			</div>
			</form>
		</div>
	</div>
	<div class="col-xs-4">
		<div id="projectSettings" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Project Settings</h3>
			</div>
			<form id="editProjectDetails" class="form-horizontal">
			<div class="box-body">
				<button id="deleteProjectButton_Step1" class="btn btn-danger">Delete Project</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal modal-danger" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Project</h4>
      </div>
      <div class="modal-body">
        <strong>Are you sure you wish to delete this project?</strong>
        <p>This action can't be undone.</p>
      </div>
      <div class="modal-footer">
        <button id="reallyDeleteProject_Step2" type="button" href="" class="btn btn-default">Yes, delete this project.</button>
        <a id="Cancel" type="button" href="" class="btn btn-default">Cancel</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	// Elements:
	var currentProject = gup('projectID');
	var editProjectDetails = $('#editProjectDetails');

	// ******************** Waiting for Load *************************
	var interval = setInterval(function() {
	    if ((typeof util_AllNodes == 'undefined') || 
	    	(typeof util_AllCodes == 'undefined') || 
	    	(typeof util_AllArtifacts == 'undefined') || 
	    	(typeof util_AllFragments == 'undefined') || 
	    	(typeof util_BasicProjectDetails == 'undefined')) return;
	    clearInterval(interval);

	    console.log(util_BasicProjectDetails);
	    console.log('Everything Loaded!');
	    initProjectHome();
	    globalLoadingIndicator_Clear();

	}, 100);

	function initProjectHome() {
		setupEditProjectDetails();
	}

	// Populate "Edit Project Details"
	function setupEditProjectDetails() {
		$('#editProjectNameInput').val(util_BasicProjectDetails.name);
		$('#editProjectDescriptionInput').val(util_BasicProjectDetails.description);
	}
	


	// *************** Edit Project Details ***************
	editProjectDetails.submit(function(event){
		event.preventDefault();
		var formData = {
			name: $('#editProjectNameInput').val(),
			description: $('#editProjectDescriptionInput').val(),
			related_project: currentProject
		}

		console.log(formData);

		// @TODO: Error Validation

		$.put("/api/standard.php/projects/" + currentProject, formData, function(result) {
			if(!isNaN(result)) {
				alertInjector('success','Project Updated','Project details have been successfully updated.')
			} else {
				console.log('Error updating project.');
			}
		});
	});

	// *************** "Delete" Project ***************
	$('#reallyDeleteProject_Step2').click(function(event){
		event.preventDefault();
		var formData = {
			deleted: 1
		}

		console.log(formData);

		$.put("/api/standard.php/projects/" + currentProject, formData, function(result) {
			if(!isNaN(result)) {
				window.location.replace("/app/all-projects/");
				// alertInjector('success','Project Deleted','Project has been successfully deleted.')
			} else {
				console.log('Error updating project.');
			}
		});
	});

	// *************** Delete Prompt ***************
	$('#deleteProjectButton_Step1').click(function(e){
		e.preventDefault();
		$('#deleteProjectModal').modal('show');
	})

	$('#editProjectButton_Cancel').click(function() {
		$('#editProjectNameInput').val(util_BasicProjectDetails.name);
		$('#editProjectDescriptionInput').val(util_BasicProjectDetails.description);
	})


</script>