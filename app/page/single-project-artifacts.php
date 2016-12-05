<div class="row">
	<div class="col-xs-12">
		<div id="allArtifacts" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title col-xs-6 alpha omega" style="margin-top: 7px">All Artifacts</h3>
				<div class="box-title col-xs-6 alpha omega" style="text-align: right"><a type="button" id="addNewArtifactButton" class="delete-artifact-btn btn btn-primary ">Add New Artifact</a></div>
			</div>
			<div class="box-body">
				<table id="allArtifactsTable" class="table table-bordered">
					<tbody>
						<tr>
							<th style="width:80%">Name</th>
							<th>Actions</th>
						</tr>
						<tr id="singleArtifactTemplate" class="phils-js-framework-template">
							<td class="artifact-name"></td>
							<td>
								<div style="display:flex" class="btn-group btn-block">
									<a type="button" class="edit-artifact-btn btn btn-default btn-xs">Edit</a>
									<a type="button" class="delete-artifact-btn btn btn-default btn-xs">Delete</a>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer">

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Elements:
	var currentProject = gup('projectID');
	var allArtifactsTable = $('#allArtifactsTable');
	$("#addNewArtifactButton").attr('href', '/app/project/?projectID=' + currentProject + '&destination=artifacts-single')


	// *************** All Artifacts for Project ***************
	function loadArticlesArtifacts() {
		$.get("/api/standard.php/artifacts?transform=1", function(data) {
			for (var i = 0; i < data.artifacts.length; i++) {
				insertNewArtifactRow(data.artifacts[i].id, data.artifacts[i].name);
			}
		});
	}
	function insertNewArtifactRow(id, name) {
		var existingSingleArtifact = $('#singleArtifactTemplate');
		var newArtifactToAdd = existingSingleArtifact.clone();
		newArtifactToAdd.removeClass('phils-js-framework-template');
		newArtifactToAdd.find('.artifact-name').text(name);
		newArtifactToAdd.find('.delete-artifact-btn').click(function(e){
			$(e.target).addClass('btn-danger');
			$(e.target).removeClass('btn-default');
			$(e.target).text('Really Delete?');
			$(e.target).click(function(){
				deleteArtifact(id);
			});
		});
		newArtifactToAdd.find('.edit-artifact-btn').attr('href', '/app/project/?projectID=' + currentProject + '&destination=artifacts-single&rid=' + id);
		newArtifactToAdd.attr('data-artifact-id', id);
		newArtifactToAdd.attr('id', '');
		allArtifactsTable.children('tbody').append(newArtifactToAdd);
	}
	loadArticlesArtifacts();


	// *************** Delete Artifact ***************
	function deleteArtifact(id) {
		$.delete("/api/standard.php/artifacts/" + id,function(result) {
			if(!isNaN(result)) {
				deleteArtifactFragments(id);
				allArtifactsTable.find("[data-artifact-id='" + id + "']").remove();
				alertInjector('success', 'Artifact Successfully Deleted', 'Artifact has been successfully deleted.')
			} else {
				console.log('Error adding project.');
			}
		});
	}

	function deleteArtifactFragments(rid) {
		var allFragments = [];
		$.get("/api/standard.php/fragments?transform=1&filter=related_artifact,eq," + rid, function(data) {
			for (var i = 0; i < data.fragments.length; i++) {
				deleteSingleFragment(data.fragments[i].id);
			}
		});
	}

	function deleteSingleFragment(dbFragmentPK) {
		$.delete("/api/standard.php/fragments/" + dbFragmentPK, function(result) {
			if(!isNaN(result)) {
				console.log("SUCCESS: DB Fragment Element Deleted");
			} else {
				console.log('Error deleting fragment PK #' + dbFragmentPK + '.');
			}
		});
	}


</script>