<script src="/lib/ckeditor/ckeditor.js"></script>
<!-- Load jQuery.selection plugin-->
<script src="/lib/jquery.selection/src/jquery.selection.js"></script>

<script type="text/javascript">
	CKEDITOR.timestamp = Math.floor(Math.random() * (10000000 - 0 + 1)) + 0;
	// Turn off automatic editor creation first.
	CKEDITOR.disableAutoInline = true;
</script>
<style type="text/css">
	.form-group {
		display: inline-block;
		width: 100%;
	}
	.cke_chrome {
    	border-left: 1px solid #ccc;
    	border-right: 1px solid #ccc;
	}
	#cke_1_top {
		border-bottom: 1px solid #ccc;
	}
	#tooltip {
    position:absolute;
    display:none;
    /*border:grey solid 1px;*/
    background:white;
    z-index: 10;
}
#cal1{
    position:absolute;
    height:0px;
    width:0px;
    top:100px;
    left:100px;
    overflow:none;
    z-index:-100;
}
#cal2{
    position:absolute;
    height:0px;
    width:0px;
    top:0px;
    left:0px;
    overflow:none;
    z-index:-100;
}
abbr {
	background-color: yellow;
	cursor: pointer;
}
#leftArrowIndicator {
    position: absolute;
    top: 50%;
    font-size: 20px;
    left: -37px;
    background: #3c8dbc;
    padding-top: 5px;
    padding-bottom: 5px;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 3px;
    color: white;
}
</style>
<div id="cal1">&nbsp;</div>
    <div id="cal2">&nbsp;</div>
    <div id="tooltip"><a id="codeFragmentMoveableButton" class="btn btn-block btn-warning btn-xs" style="margin:0"><i class="fa fa-edit"></i> Code Selected Text</a></div>
    
<div class="row">
	<div class="col-xs-8">
		<div id="allCodes" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Edit Artifact</h3>
			</div>
			<div class="box-body">
				<form id="artifactForm">
					<div class="form-group">
						<label for="artifactName" class="alpha omega col-sm-12">Artifact Name:</label>
						<div class="col-sm-12 alpha omega">
							<input type="text" class="form-control" id="artifactName" placeholder="Artifact Name">
						</div>
					</div>
					<div class="form-group">
						<label for="deafultProjectingNode" class="alpha omega col-sm-12">Default Projecting Node:</label>
						<div class="col-sm-12 alpha omega">
							<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="deafultProjectingNode" data-placeholder="Default Projecting Node">
							</select>
						</div>
					</div>
					<div class="col-sm-12 alpha omega">
					<div class="form-group">
						<label for="globalArtifactCodes" class="alpha omega col-sm-12">Global Artifact Codes:</label>
							<select class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width:100%" id="globalArtifactCodes" data-placeholder="Codes Applied to Entire Artifact">
							</select>
						</div>
					</div>
					<label for="artifactBody" class="alpha omega col-sm-12">Artifact Body:</label>
					<div class="form-group">
						<div id="artifactBody" contenteditable="true">
						</div>
					</div>
				</form>
			</div>
			<div class="box-footer">
				<button type="" id="beginCodingButton" class="btn btn-primary" >Save & Code Artifact</button>
				<button type="submit" id="saveCodingButton" class="btn btn-primary" disabled>Save Coded Fragments </button>
				<a type="reset" id="editArtifactButton_Cancel" class="btn btn-default">Cancel</a>
			</div>
		</div>
	</div>
    <div class="col-xs-4">
		<div id="fragmentModalOptions" style="display: none; z-index: 10; border: 3px solid #3c8dbc" class="box box-primary">
			<div id="leftArrowIndicator"><i class="fa fa-arrow-left"></i></div>
			<div class="box-header with-border">
				<h3 class="box-title">Code Selected Text / Fragment</h3>
			</div>
			<form id="addNodeForm" class="form-horizontal">
				<div class="box-body omega alpha">
					<div class="col-xs-12" style="border-bottom: 1px solid #f4f4f4">
						<div class="form-group" style="margin-left: 0px; margin-right: 0px;">
							<label for="fragmentCodes" class="col-sm-12 alpha omega">Codes:</label>
							<select class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width:100%" id="fragmentModalOptions_Codes" data-placeholder="Select Codes...">
							</select>
						</div>
					</div>
					<div class="col-xs-12" style="border-bottom: 1px solid #f4f4f4">
						<div class="form-group" style="margin-left: 0px; margin-right: 0px;">
							<label for="fragmentCodes" class="col-sm-12 alpha omega">Relationship:</label>
							<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="fragmentModalOptions_NodeA"></select>
							<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="fragmentModalOptions_Feelings">
								<option value="positve">Feels postive towards...</option>
								<option value="negative">Feels negatives towards...</option>
							</select>
							<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="fragmentModalOptions_NodeB"></select>
						</div>
					</div>
					<div class="col-xs-12" style="border-bottom: 1px solid #f4f4f4">
						<div class="form-group" style="margin-left: 0px; margin-right: 0px;">
							<label for="fragmentModalOptions_Comment" class="col-sm-12 alpha omega">Comments/Notes:</label>
							<div class="col-sm-12 alpha omega">
								<textarea class="form-control" id="fragmentModalOptions_Comment" placeholder="Comments/Notes"></textarea>
							</div>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group" style="margin-left: 0px; margin-right: 0px;">
							<label for="fragmentModalOptions_Weight" class="col-sm-12 alpha omega">Numeric Weight:</label>
							<div class="col-sm-12 alpha omega">
								<input type="text" class="form-control" id="fragmentModalOptions_Weight" placeholder="Enter a number"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="button" id="fragmentModalOptions_Save" class="btn btn-primary">Save Fragment</button>
					<button type="reset" id="fragmentModalOptions_Cancel" class="btn btn-default">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Elements:
	var currentProject = gup('projectID');
	var artifactForm = $('#artifactForm');
	var deafultProjectingNode = $('#deafultProjectingNode');
	var globalArtifactCodes = $('#globalArtifactCodes');
	var beginCodingButton = $('#beginCodingButton');
	var saveCodingButton = $('#saveCodingButton');
	var codeFragmentMoveableButton = $('#codeFragmentMoveableButton');

	var fragmentModalOptions = $('#fragmentModalOptions');
	var fragmentModalOptions_Codes = $('#fragmentModalOptions_Codes');
	var fragmentModalOptions_NodeA = $('#fragmentModalOptions_NodeA');
	var fragmentModalOptions_NodeB = $('#fragmentModalOptions_NodeB');
	var fragmentModalOptions_Feelings = $('#fragmentModalOptions_Feelings');
	var fragmentModalOptions_Comment = $('#fragmentModalOptions_Comment');
	var fragmentModalOptions_Save = $('#fragmentModalOptions_Save');
	var fragmentModalOptions_Cancel = $('#fragmentModalOptions_Cancel');

	var allCodes = [];
	var allNodes = [];
	var currentlySelectedObject;
	var artifactIDGlobal = '';

	$('#editArtifactButton_Cancel').attr('href', '/single-project/?projectID=' + currentProject + '&destination=artifacts');


	// *************** All Nodes for Project ***************
	function loadAllNodes() {
		$.get("/api/standard.php/nodes?transform=1", function(data) {
			for (var i = 0; i < data.nodes.length; i++) { // Adding child nodes:
				if (data.nodes[i].parent_node != 0) {
					for (var j = 0; j < data.nodes.length; j++) {
						if (data.nodes[j].id == data.nodes[i].parent_node) { // Looping through to get parent information for label
							allNodes.push({
								id: data.nodes[j].id,
								text: data.nodes[j].name + ' > ' + data.nodes[i].name
							})
						}
					}
				} else { // Adding parent nodes:
					allNodes.push({
						id: data.nodes[i].id,
						text: data.nodes[i].name
					})
				}
			}

			allNodes.sort(function(a,b) {return (a.text > b.text) ? 1 : ((b.text > a.text) ? -1 : 0);} );

			deafultProjectingNode.select2({
				placeholder: "Default Projecting Node",
				allowClear: true,
				data: allNodes
			});
			deafultProjectingNode.val('').trigger('change')
		});
	}
	loadAllNodes();


	// *************** All Codes for Project ***************
	function fetchCodes() {
		$.get("/api/standard.php/codes?transform=1", function(data) {
			for (var i = 0; i < data.codes.length; i++) {
				allCodes.push({
					id: data.codes[i].id,
					text: data.codes[i].name
				})
			}

			globalArtifactCodes.select2({
				data: allCodes
			});
			loadArtifact();
		});
	}
	fetchCodes();


	// *************** Load Existing Artifact ***************
	function loadArtifact() {
		var artifactID = gup('rid');
		artifactIDGlobal = artifactID;
		if (artifactID) {
			$.get("/api/standard.php/artifacts/" + artifactID, function(data) {
				if (data) {
					$('#artifactName').val(data.name);
					$('#artifactBody').html(data.body)
					initCKEditorArea();
					deafultProjectingNode.select2().val(data.default_projector).trigger("change");
					var globalCodesArrayd = [];
					if(data.global_codes) {
						globalCodesArrayd = data.global_codes.split(',');
					}
					globalArtifactCodes.select2().val(globalCodesArrayd).trigger("change");
				}
			});
		} else {
			initCKEditorArea()
		}
	}
	

	function initCKEditorArea() {

		CKEDITOR.config.floatingtools = 'Basic';
		CKEDITOR.config.floatingtools_Basic =
		[
			['Abbr', 'Italic', '-', 'NumberedList', 'BulletedList']
		];

		// CKEDITOR.inline( 'artifactBody' );
		CKEDITOR.replace( 'artifactBody', {
			// Load the abbr plugin.
			extraPlugins: 'autogrow,abbr,toolbar,floating-tools',
			// config.extraPlugins = 'floating-tools'

			// The following options are set to make the sample more clear for demonstration purposes.

			// Rearrange toolbar groups and remove unnecessary plugins.
			toolbarGroups: [
				{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
				{ name: 'coding' },
				{ name: 'document',	   groups: [ 'mode' ] },
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph',   groups: [ 'list', 'indent' ] },
				],
				removePlugins: 'elementspath,font,iframe,pagebreak,flash,stylescombo,print,preview,save,smiley,pastetext,pastefromword',
				removeButtons: 'Anchor,Font,Strike,Subscript,Superscript'
		});
	}


	// *************** Click to add Fragment... ***************
	function checkIfInArticleBody(textSelection) {
		// console.log('here');
		var artifactBody = $("#artifactBody").text();
		if (artifactBody.indexOf(textSelection.anchorNode.data) > 0) {
			console.log('yes, it is');
			return true;
		} else {
			console.log('nope');
			return false;
		}
	}

	beginCodingButton.click(function(){
		var bodyContents = CKEDITOR.instances.artifactBody.getData();
		performBasicSave(bodyContents);


		$('#artifactBody').attr('contenteditable', 'false');
		if (CKEDITOR.instances.artifactBody) CKEDITOR.instances.artifactBody.destroy();

		$('#artifactBody').addClass('artifactBody-Codeable');

		$('abbr').click(function(e){
			showAbbrOptions(e.target.id);
		})

		alert("To code a piece of text, highlight it with your cursor.");

		var ele = document.getElementById('tooltip');
		var sel = window.getSelection();
		var rel1= document.createRange();
		rel1.selectNode(document.getElementById('cal1'));
		var rel2= document.createRange();
		rel2.selectNode(document.getElementById('cal2'));
		// $('.artifactBody-Codeable').mouseup(function () {
		$(document).mouseup(function () {
		    // if (!sel.isCollapsed) {
		    if (!sel.isCollapsed && checkIfInArticleBody(sel)) {
		    	currentlySelectedObject = sel;        
		        var r = sel.getRangeAt(0).getBoundingClientRect();
		        var rb1 = rel1.getBoundingClientRect();
		        var rb2 = rel2.getBoundingClientRect();
		        ele.style.top = (r.bottom - rb2.top)*100/(rb1.top-rb2.top) + 'px'; //this will place ele below the selection
		        ele.style.left = (r.left - rb2.left)*100/(rb1.left-rb2.left) + 'px'; //this will align the right edges together

		        //code to set content
		        ele.style.display = 'block';
		    } else {
		    	ele.style.display = 'none';
		    }
		});

	})

	codeFragmentMoveableButton.click(function(){
		console.log('running select code');
		   
		var selection = getSelectedText();
	    var selection_text = selection.toString();
	    
	    var span = document.createElement('abbr');
	    span.textContent = selection_text;
	    var unix = Math.round(+new Date()/1000);
	    span.id = unix;
	    
	    var range = selection.getRangeAt(0);
	    range.deleteContents();
	    range.insertNode(span);
	    $('#' + span.id).hover(function(){
			console.log('hovering');
		})
	    $('#' + span.id).click(function(){
			showAbbrOptions(span.id);
		})
		// initially show the fragment options after click
		showAbbrOptions(span.id);
		$('#tooltip').css('display', 'none');
	})

	function getSelectedText() {
	  t = (document.all) ? document.selection.createRange().text : document.getSelection();
	  return t;
	}

	function showAbbrOptions(abbrID) {
		console.log(abbrID);
		fragmentModalOptions.css('display', 'block');
		var abbrElement = $("#" + abbrID);
		console.log(abbrElement);

		var topPosition = (abbrElement.position().top - (fragmentModalOptions.outerHeight() * (4/5)));
		fragmentModalOptions.css('top', topPosition);
		fragmentModalOptions.attr('data-abbrID', abbrID);

		fragmentModalOptions_Codes.select2({
			data: allCodes
		});
		fragmentModalOptions_Codes.val('').trigger('change')
		fragmentModalOptions_NodeA.select2({
			data: allNodes,
			placeholder: "Select a node...",
			allowClear: true
		});
		fragmentModalOptions_NodeA.val('').trigger('change')
		fragmentModalOptions_NodeB.select2({
			data: allNodes,
			placeholder: "Select a node...",
			allowClear: true
		});
		fragmentModalOptions_NodeB.val('').trigger('change')
		fragmentModalOptions_Feelings.select2({
			placeholder: "Feels",
			allowClear: true
		});
		fragmentModalOptions_Feelings.val('').trigger('change')

		// Populate for existing abbr:
		if(abbrElement.attr('data-codes')) {
			fragmentModalOptions_CodesArrayd = abbrElement.attr('data-codes').split(',');
			console.log('knows theres codes');
			fragmentModalOptions_Codes.select2().val(fragmentModalOptions_CodesArrayd).trigger("change");
		}
		if (abbrElement.attr('data-nodeA')) {
			fragmentModalOptions_NodeA.select2().val(abbrElement.attr('data-nodeA')).trigger("change");
		}
		if (abbrElement.attr('data-feelings')) {
			fragmentModalOptions_Feelings.select2().val(abbrElement.attr('data-feelings')).trigger("change");
		}
		if (abbrElement.attr('data-nodeB')) {
			fragmentModalOptions_NodeB.select2().val(abbrElement.attr('data-nodeB')).trigger("change");
		}
		if (abbrElement.attr('data-comments')) {
			fragmentModalOptions_Comment.val(abbrElement.attr('data-comment'));
		}

	}

	fragmentModalOptions_Save.click(function(){
		var fragmentID = fragmentModalOptions.attr('data-abbrID');

		var fragmentCodesFormatted = '';
		if (fragmentModalOptions_Codes.val()) {
			for (var i = 0; i < fragmentModalOptions_Codes.val().length; i++) {
				fragmentCodesFormatted += fragmentModalOptions_Codes.val()[i];
				if ((i + 1) != fragmentModalOptions_Codes.val().length) {
					fragmentCodesFormatted += ',';
				}
			}
		}

		$("#" + fragmentID).attr('data-codes',fragmentCodesFormatted);
		$("#" + fragmentID).attr('data-nodeA',fragmentModalOptions_NodeA.val());
		$("#" + fragmentID).attr('data-nodeB',fragmentModalOptions_NodeB.val());
		$("#" + fragmentID).attr('data-feelings',fragmentModalOptions_Feelings.val());
		$("#" + fragmentID).attr('data-comment',fragmentModalOptions_Comment.val());

		hideAbbrOptions(fragmentID);
	})

	fragmentModalOptions_Cancel.click(function(){
		var fragmentID = fragmentModalOptions.attr('data-abbrID');

		hideAbbrOptions(fragmentID);
	})

	function hideAbbrOptions(abbrID) {
		fragmentModalOptions.css('display', 'none');
	}


	saveCodingButton.click(function(){

		performArtifactWithCodesSave(artifactIDGlobal, $("#artifactBody").html());

	})


	// *************** BASIC Artifact Save ***************
	function performBasicSave(body) {
		var artifactID = gup('rid');

		var globalCodesFormatted = '';
		if ($('#globalArtifactCodes').val()) {
			for (var i = 0; i < $('#globalArtifactCodes').val().length; i++) {
				globalCodesFormatted += $('#globalArtifactCodes').val()[i];
				if ((i + 1) != $('#globalArtifactCodes').val().length) {
					globalCodesFormatted += ',';
				}
			}
		}

		var formData = {
			name: $('#artifactName').val(),
			default_projector: $('#deafultProjectingNode').val(),
			related_project: currentProject,
			body: body,
			global_codes: globalCodesFormatted
		}

		// @TODO: Error Validation

		if (artifactID) {
			$.put("/api/standard.php/artifacts/" + artifactID, formData, function(result) {
				if(!isNaN(result)) {
					console.log("SUCCESS: Existing Artifact Saved");
				} else {
					console.log('Error adding node.');
				}
			});
		} else {
			$.post("/api/standard.php/artifacts", formData, function(result) {
				if(!isNaN(result)) {
					console.log("SUCCESS: Artifact Saved");
				} else {
					console.log('Error adding node.');
				}
			});
		}
		disableBasicFields();
	}


	// *************** Artifact With Codes Save ***************
	function performArtifactWithCodesSave(artifactID, body) {

		var formData = {
			body: body
		}

		// @TODO: Error Validation

		if (artifactID) {
			$.put("/api/standard.php/artifacts/" + artifactID, formData, function(result) {
				if(!isNaN(result)) {
					console.log("SUCCESS: Codes for Artifact Saved");
					alert("Success: Codes Saved");
				} else {
					console.log('Error saving artifact codes.');
				}
			});
		} 

		disableBasicFields();
	}

	function disableBasicFields() {
		globalArtifactCodes.attr('disabled', 'true');
		deafultProjectingNode.attr('disabled', 'true');
		$('#artifactName').attr('disabled', 'true');
		beginCodingButton.attr('disabled', 'true');
		saveCodingButton.removeAttr('disabled');
	}

</script>