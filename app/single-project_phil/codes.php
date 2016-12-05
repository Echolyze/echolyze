<div class="row">
	<div class="col-xs-8">
		<div id="allCodes" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">All Project Codes</h3>
			</div>
			<div class="box-body">
				<table id="allCodesTable" class="table table-bordered">
					<tbody>
						<tr>
							<th style="width:40%">Name</th>
							<th style="width:60%">Description</th>
							<th>Actions</th>
						</tr>
						<tr id="singleCodeTemplate" class="phils-js-framework-template">
							<td class="code-name"></td>
							<td class="code-description"></td>
							<td>
								<div style="display:flex" class="btn-group btn-block">
									<button type="button" class="edit-code-btn btn btn-default btn-xs">Edit</button>
									<button type="button" class="delete-code-btn btn btn-default btn-xs">Delete</button>
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
	<div class="col-xs-4">
		<div id="editCodeBox" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Edit Code</h3>
			</div>
			<form id="editCodeForm" class="form-horizontal">
			<div class="box-body">
				<div class="form-group">
					<label for="editCodeNameInput" class="col-sm-12">Code Name:</label>
					<div class="col-sm-12">
						<input type="text" class="form-control" id="editCodeNameInput" placeholder="Code Name">
					</div>
				</div>
				<div class="form-group last-form-group">
					<label for="editCodeDescriptionInput" class="col-sm-12">Code Description:</label>
					<div class="col-sm-12">
						<textarea class="form-control" id="editCodeDescriptionInput" placeholder="Code Description"></textarea>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" id="saveCodeSubmit" class="btn btn-primary">Save Code</button>
				<button type="reset" id="editCodeButton_Cancel" class="btn btn-default">Cancel</button>
			</div>
			</form>
		</div>
	</div>
	<div class="col-xs-4">
		<div id="addCodeBox" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Add New Code</h3>
			</div>
			<form id="addCodeForm" class="form-horizontal">
			<div class="box-body">
				<div class="form-group">
					<label for="addCodeNameInput" class="col-sm-12">Code Name:</label>
					<div class="col-sm-12">
						<input type="text" class="form-control" id="addCodeNameInput" placeholder="Code Name">
					</div>
				</div>
				<div class="form-group last-form-group">
					<label for="addCodeDescriptionInput" class="col-sm-12">Code Description:</label>
					<div class="col-sm-12">
						<textarea class="form-control" id="addCodeDescriptionInput" placeholder="Code Description"></textarea>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" id="addCodeSubmit" class="btn btn-primary">Add Code</button>
				<button type="reset" id="addCodeButton_Cancel" class="btn btn-default">Cancel</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Elements:
	var currentProject = gup('projectID');
	var allCodesTable = $('#allCodesTable');
	var addCodeForm = $('#addCodeForm');
	var addCodeBox = $('#addCodeBox');
	var editCodeBox = $('#editCodeBox');
	var editCodeForm = $('#editCodeForm');
	editCodeBox.hide();


	// *************** All Codes for Project ***************
	function loadAllCodes() {
		$.get("/api/standard.php/codes?transform=1", function(data) {
			for (var i = 0; i < data.codes.length; i++) {
				insertNewCodeRow(data.codes[i].id, data.codes[i].name, data.codes[i].description);
			}
		});
	}
	function insertNewCodeRow(id, name, description) {
		var existingSingleCode = $('#singleCodeTemplate');
		var newCodeToAdd = existingSingleCode.clone();
		newCodeToAdd.removeClass('phils-js-framework-template');
		newCodeToAdd.find('.code-name').text(name);
		newCodeToAdd.children('.code-description').text(description);
		newCodeToAdd.find('.delete-code-btn').click(function(){
			deleteCode(id);
		});
		newCodeToAdd.find('.edit-code-btn').click(function(){
			editCode(id);
		});
		newCodeToAdd.attr('data-code-id', id);
		newCodeToAdd.attr('id', '');
		allCodesTable.children('tbody').append(newCodeToAdd);
	}
	loadAllCodes();


	// *************** Add Code ***************
	addCodeForm.submit(function(event){
		var formData = {
			name: $('#addCodeNameInput').val(),
			description: $('#addCodeDescriptionInput').val(),
			related_project: currentProject
		}

		// @TODO: Error Validation

		$.post("/api/standard.php/codes", formData, function(result) {
			if(!isNaN(result)) {
				insertNewCodeRow(result, formData.name, formData.description);
				$('#addCodeNameInput').val('');
				$('#addCodeDescriptionInput').val('');
				$('#addCodeSubmit').blur();
			} else {
				console.log('Error adding project.');
			}
		});
		event.preventDefault();
	})

	// *************** Delete Code ***************
	function deleteCode(id) {
		$.delete("/api/standard.php/codes/" + id,function(result) {
			if(!isNaN(result)) {
				allCodesTable.find("[data-code-id='" + id + "']").remove();
			} else {
				console.log('Error adding project.');
			}
		});
	}

	// *************** Edit Code ***************
	function editCode(id) {
		addCodeBox.hide();
		editCodeBox.show();

		var currentCodeName = allCodesTable.find("[data-code-id='" + id + "']").find('.code-name').text();
		var currentCodeDescription = allCodesTable.find("[data-code-id='" + id + "']").find('.code-description').text();

		editCodeBox.find('#editCodeNameInput').val(currentCodeName).focus();
		editCodeBox.find('#editCodeDescriptionInput').val(currentCodeDescription);

		editCodeForm.submit(function(event){
			var formData = {
				name: $('#editCodeNameInput').val(),
				description: $('#editCodeDescriptionInput').val(),
			}

			// @TODO: Error Validation

			$.put("/api/standard.php/codes/" + id, formData, function(result) {
				if(!isNaN(result)) {
					allCodesTable.find("[data-code-id='" + id + "']").find('.code-name').text(formData.name);
					allCodesTable.find("[data-code-id='" + id + "']").find('.code-description').text(formData.description);
					editCodeBox.find('#editCodeButton_Cancel').trigger('click');
				} else {
					console.log('Error adding project.');
				}
			});
			event.preventDefault();
		})
	}
	$('#editCodeButton_Cancel').click(function() {
		$('#editCodeNameInput').val('');
		$('#editCodeDescriptionInput').val('');
		addCodeBox.show();
		editCodeBox.hide();
	})


</script>