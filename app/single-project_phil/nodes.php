<div class="row">
	<div class="col-xs-8">
		<div id="allNodes" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">All Project Nodes</h3>
			</div>
			<div class="box-body">
				<table id="allNodesTable" class="table table-bordered">
					<tbody>
						<tr>
							<th style="width:40%">Name</th>
							<th style="width:60%">Description</th>
							<th>Actions</th>
						</tr>
						<tr id="singleNodeTemplate" class="phils-js-framework-template">
							<td class="node-name"></td>
							<td class="node-description"></td>
							<td>
								<div style="display:flex" class="btn-group btn-block">
									<button type="button" class="edit-node-btn btn btn-default btn-xs">Edit</button>
									<button type="button" class="delete-node-btn btn btn-default btn-xs">Delete</button>
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
		<div id="editNodeBox" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Edit Node</h3>
			</div>
			<form id="editNodeForm" class="form-horizontal">
			<div class="box-body">
				<div class="form-group">
					<label for="editNodeNameInput" class="col-sm-12">Node Name:</label>
					<div class="col-sm-12">
						<input type="text" class="form-control" id="editNodeNameInput" placeholder="Node Name">
					</div>
				</div>
				<div class="form-group last-form-group">
					<label for="editNodeDescriptionInput" class="col-sm-12">Node Description:</label>
					<div class="col-sm-12">
						<textarea class="form-control" id="editNodeDescriptionInput" placeholder="Node Description"></textarea>
					</div>
				</div>
				<div class="form-group last-form-group">
					<label for="parentEditNodeInput" class="col-sm-12">Parent Node:</label>
					<div class="col-sm-12 select2-pe">
						<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="parentEditNodeInput" placeholder="Node Description">
							<option value="">No Parent</option>
						</select>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" id="saveNodeSubmit" class="btn btn-primary">Save Node</button>
				<button type="reset" id="editNodeButton_Cancel" class="btn btn-default">Cancel</button>
			</div>
			</form>
		</div>
	</div>
	<div class="col-xs-4">
		<div id="addNodeBox" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Add New Node</h3>
			</div>
			<form id="addNodeForm" class="form-horizontal">
			<div class="box-body">
				<div class="form-group">
					<label for="addNodeNameInput" class="col-sm-12">Node Name:</label>
					<div class="col-sm-12">
						<input type="text" class="form-control" id="addNodeNameInput" placeholder="Node Name">
					</div>
				</div>
				<div class="form-group">
					<label for="addNodeDescriptionInput" class="col-sm-12">Node Description:</label>
					<div class="col-sm-12">
						<textarea class="form-control" id="addNodeDescriptionInput" placeholder="Node Description"></textarea>
					</div>
				</div>
				<div class="form-group last-form-group">
					<label for="parentAddNodeInput" class="col-sm-12">Parent Node:</label>
					<div class="col-sm-12 select2-pe">
						<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="parentAddNodeInput" placeholder="Node Description">
							<option value="">No Parent</option>
						</select>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" id="addNodeSubmit" class="btn btn-primary">Add Node</button>
				<button type="reset" id="addNodeButton_Cancel" class="btn btn-default">Cancel</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Elements:
	var currentProject = gup('projectID');
	var allNodesTable = $('#allNodesTable');
	var addNodeForm = $('#addNodeForm');
	
	var addNodeBox = $('#addNodeBox');
	var editNodeBox = $('#editNodeBox');
	var editNodeForm = $('#editNodeForm');
	editNodeBox.hide();
	

	// *************** All Nodes for Project ***************
	function loadAllNodes() {
		$.get("/api/standard.php/nodes?transform=1", function(data) {
			for (var i = 0; i < data.nodes.length; i++) {
				if (!data.nodes[i].parent_node) {
					insertNewNodeRow(data.nodes[i].id, data.nodes[i].name, data.nodes[i].description);
				}
			}
			// Do all the nodes that are children of another node after we have already inserted the parents...
			for (var i = 0; i < data.nodes.length; i++) {
				if (data.nodes[i].parent_node) {
					insertNewNodeRow(data.nodes[i].id, data.nodes[i].name, data.nodes[i].description, data.nodes[i].parent_node);
				}
			}
		});
	}
	function insertNewNodeRow(id, name, description, parentNode) {
		// console.log(id + ' ' + name);
		var existingSingleNode = $('#singleNodeTemplate');
		var newNodeToAdd = existingSingleNode.clone();
		newNodeToAdd.removeClass('phils-js-framework-template');
		newNodeToAdd.find('.node-name').text(name);
		newNodeToAdd.children('.node-description').text(description);
		newNodeToAdd.find('.delete-node-btn').click(function(){
			deleteNode(id);
		});
		newNodeToAdd.find('.edit-node-btn').click(function(){
			editNode(id);
		});
		newNodeToAdd.attr('data-node-id', id);
		newNodeToAdd.attr('id', '');
		if (parentNode > 0) {
			// console.log('trying to place child: ' + name);
			newNodeToAdd.find('.node-name').html('<i class="fa fa-fw fa-reply child-node-pe"></i> ' + name);
			newNodeToAdd.attr('data-parent-node-id', parentNode);
			allNodesTable.find("[data-node-id='" + parentNode + "']").after(newNodeToAdd);
		} else {
			// console.log('trying to place parent: ' + name);
			allNodesTable.children('tbody').append(newNodeToAdd);
		}
	}
	loadAllNodes();
	updateAddEdit_ParentNode();


	function updateAddEdit_ParentNode() {
		var addNodeParentNodeSelect = $('#parentAddNodeInput');
		var editNodeParentNodeSelect = $('#parentEditNodeInput');
		addNodeParentNodeSelect.empty();
		editNodeParentNodeSelect.empty();
		$.get("/api/standard.php/nodes?transform=1", function(data) {
			addNodeParentNodeSelect.append('<option value="">No Parent</option>');
			editNodeParentNodeSelect.append('<option value="">No Parent</option>');
			for (var i = 0; i < data.nodes.length; i++) {
				if (data.nodes[i].parent_node == 0) {
					addNodeParentNodeSelect.append('<option value="' + data.nodes[i].id + '">' + data.nodes[i].name  + '</option>');
					editNodeParentNodeSelect.append('<option value="' + data.nodes[i].id + '">' + data.nodes[i].name  + '</option>');
				}
			}
			addNodeParentNodeSelect.select2();
			editNodeParentNodeSelect.select2();
		});
	}

	// *************** Add Node ***************
	addNodeForm.submit(function(event){
		var formData = {
			name: $('#addNodeNameInput').val(),
			description: $('#addNodeDescriptionInput').val(),
			related_project: currentProject,
			parent_node: $('#parentAddNodeInput').val()
		}

		// @TODO: Error Validation

		$.post("/api/standard.php/nodes", formData, function(result) {
			if(!isNaN(result)) {
				insertNewNodeRow(result, formData.name, formData.description, formData.parent_node);
				$('#addNodeNameInput').val('');
				$('#addNodeDescriptionInput').val('');
				$('#parentAddNodeInput').val('').trigger("change");
				$('#addNodeSubmit').blur();
				updateAddEdit_ParentNode();
			} else {
				console.log('Error adding node.');
			}
		});
		event.preventDefault();
	})

	// *************** Edit Node ***************
	function editNode(id) {
		addNodeBox.hide();
		editNodeBox.show();

		var currentNodeName = allNodesTable.find("[data-node-id='" + id + "']").find('.node-name').text();
		var currentNodeDescription = allNodesTable.find("[data-node-id='" + id + "']").find('.node-description').text();
		var currentNodeParent = allNodesTable.find("[data-node-id='" + id + "']").attr('data-parent-node-id');

		if (currentNodeParent) {
			$('#parentEditNodeInput').val(currentNodeParent).trigger("change");
		}
		editNodeBox.find('#editNodeNameInput').val(currentNodeName).focus();
		editNodeBox.find('#editNodeDescriptionInput').val(currentNodeDescription);

		editNodeForm.submit(function(event){
			var formData = {
				name: $('#editNodeNameInput').val(),
				description: $('#editNodeDescriptionInput').val(),
				parent_node: $('#parentEditNodeInput').val()
			}

			// @TODO: Error Validation

			$.put("/api/standard.php/nodes/" + id, formData, function(result) {
				if(!isNaN(result)) {
					if (formData.parent_node) {
						allNodesTable.find("[data-node-id='" + id + "']").remove();
						insertNewNodeRow(id, formData.name, formData.description, formData.parent_node);
					} else {
						allNodesTable.find("[data-node-id='" + id + "']").find('.node-name').text(formData.name);
						allNodesTable.find("[data-node-id='" + id + "']").find('.node-description').text(formData.description);
					}
					editNodeBox.find('#editNodeButton_Cancel').trigger('click');
				} else {
					console.log('Error saving node.');
				}
			});
			event.preventDefault();
		})
	}
	$('#editNodeButton_Cancel').click(function() {
		$('#editNodeNameInput').val('');
		$('#nodeDescriptionInput').val('');
		$('#parentEditNodeInput').val('').trigger("change");
		addNodeBox.show();
		editNodeBox.hide();
	})


	// *************** Delete Node ***************
	function deleteNode(id) {
		$.delete("/api/standard.php/nodes/" + id,function(result) {
			if(!isNaN(result)) {
				allNodesTable.find("[data-node-id='" + id + "']").remove();
			} else {
				console.log('Error deleting node.');
			}
		});
	}


</script>