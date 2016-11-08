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
	padding: 3px;
    border-radius: 5px;
}
abbr.editing {
	background-color: pink;
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
.nav-tabs-custom>.nav-tabs>li {
	border-top-color: #f5f5f5;
	margin-right: 0px;
	width: 33.33333333%;
}

.nav-tabs-custom>.nav-tabs>li>a {
	min-height: 70px;
}
.nav-tabs-custom>.tab-content {
	padding: 0px;
}
#cke_artifactBody {
	border-left: none !important;
	border-right: none !important;
	border-color: #f5f5f5 !important;
}
.cke_top {
	border-bottom-color: #f5f5f5 !important;
}
.nav-tabs-custom {
	border-left: 1px solid #d2d6de;
	border-bottom: 1px solid #d2d6de;
	border-right: 1px solid #d2d6de;
}
#artifactBodyForCoding {
	padding: 20px;
	font-family: sans-serif, Arial, Verdana, "Trebuchet MS";
	font-size: 13px;
	/*border-right: 1px solid #f5f5f5 !important;*/
}
.artifactBody-step3-container {
	border-top: 1px solid #f5f5f5 !important;
	border-bottom: 1px solid #f5f5f5 !important;
}
#addFragmentForm_Message.active {
    position: absolute;
    width: 100%;
    top: 41px;
    bottom: 0;
    background-color: rgba(245, 245, 245, 0.60);
    z-index: 10;
    display: flex;
    align-items: center;
}
</style>
<div id="cal1">&nbsp;</div>
    <div id="cal2">&nbsp;</div>
    <div id="tooltip"><a id="codeFragmentMoveableButton" class="btn btn-block btn-warning btn-xs" style="margin:0"><i class="fa fa-edit"></i> Code Selected Text</a></div>
    
<div class="row">
	<div class="col-xs-12">
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
					<div class="col-sm-12 alpha omega">
					<label for="" class="alpha omega col-sm-12">Artifact Body:</label>
					<div class="nav-tabs-custom" style="display: inline-block; width: 100%">
						<ul class="nav nav-tabs">
							<li class="active"><a id="step1TabHandle" href="#tab_1-1" style="font-size:10px;" data-toggle="tab"><span style="font-size:14px; display: inline-block; width: 100%; font-weight: bold;">Step 1: Raw Artifact</span>Copy/paste the contents of your artifact into the text area. Edit artifact (content and/or formatting) as needed.</a></li>
							<li><a href="#tab_2-2" id="step2TabHandle" style="font-size:10px;" data-toggle="tab"><span style="font-size:14px; display: inline-block; width: 100%; font-weight: bold;">Step 2: Artifact Preprocessing</span>Specify options to make coding your artifact easier.</a></li>
							<li><a href="#tab_3-3" id="step3TabHandle" style="font-size:10px;" data-toggle="tab"><span style="font-size:14px; display: inline-block; width: 100%; font-weight: bold;">Step 3: Artifact Coding</span>Specify codes, positive/negative reactions, and add comments to artifact fragments.</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1-1">
								<div class="form-group" style="margin-bottom: 0px">
									<div id="artifactBody" contenteditable="true">
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab_2-2">
							<div class="col-xs-12">
								<div id="artifactAlreadyHasFragmentsError" class="hidden col-xs-12 alert alert-danger" style="margin-top: 15px;">
									<i class="icon fa fa-ban"></i><strong>Sorry, this operation can not be completed on this artifact.</strong> This is most likely because the artifact already contains coded fragments. Please continue to the next step. 
								</div>
								<p style="margin-top: 10px">Optionally, you can choose to pre create fragments by word. By doing this, your artifact will automatically be broken into a fragment per word. Thus, each word will be codeable.</p>
								<button type="button" id="autoBreakIntoOneWordFragments" class="btn btn-sm btn-info">Break Artifact Into One Word Fragments</button>
								<div id="artifactBodyForWordFragmenting" style="display: none"></div>
							</div>

							</div>
							<div class="tab-pane" id="tab_3-3">
								<div class="col-xs-12 alpha omega artifactBody-step3-container">
									<div id="artifactBodyForCoding" class="artifactBody-Codeable col-xs-8"></div>
									    <div class="col-xs-4">
										<div id="fragmentModalOptions" style="z-index: 10; margin-top: 15px;" class="box box-default">
											<div class="box-header with-border">
												<h3 class="box-title">Word / Fragment Code Details</h3>
											</div>
											<form id="addFragmentForm" class="form-horizontal">
												<div class="box-body omega alpha">
												<div id="addFragmentForm_Message" class="active">
													<div class="alert alert-info" style="width:100%; margin:20%;">
														<h4><i class="icon fa fa-info"></i> No Fragment Selected!</h4>
														To view coded data for a particular fragment, please select one. To code data for the first time, highlight the text you'd like to code.
													</div>
												</div>
													<div class="col-xs-12" style="border-bottom: 1px solid #f4f4f4">
														<div class="form-group" style="margin-left: 0px; margin-top: 0px; margin-right: 0px;">
															<label for="fragmentCodes" class="col-sm-12 alpha omega">Codes:</label>
															<select class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width:100%" id="fragmentModalOptions_Codes" data-placeholder="Select Codes...">
															</select>
														</div>
													</div>
													<div class="col-xs-12" style="border-bottom: 1px solid #f4f4f4">
														<div class="form-group" style="margin-left: 0px; margin-right: 0px;">
															<label for="fragmentCodes" class="col-sm-12 alpha omega">Relationship:</label>
															<select class="form-control select2" style="width:100%" id="fragmentModalOptions_NodeA"></select>
															<select class="form-control select2" style="width:100%" id="fragmentModalOptions_Feelings">
																<option value="positve">Feels postive towards...</option>
																<option value="negative">Feels negatives towards...</option>
															</select>
															<select class="form-control select2" style="width:100%" id="fragmentModalOptions_NodeB"></select>
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
													<button type="button" id="fragmentModalOptions_Save" class="btn btn-sm btn-primary">Save Fragment</button>
													<button type="reset" id="fragmentModalOptions_Cancel" class="btn btn-sm btn-default">Cancel</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<a id="previousStepHandle" style="display:none; margin: 10px;" class="btn btn-default pull-left"><< Previous Step </a>
						<a id="nextStepHandle" style="margin: 10px;" class="btn btn-default pull-right">Next Step >> </a>
					</div>
					</div>
				</form>
			</div>
			<div class="box-footer">
				<button type="" id="saveCodingButton" class="btn btn-primary" >Save Artifact & Coded Fragments</button>
				<a type="reset" id="editArtifactButton_Cancel" class="btn btn-default">Cancel</a>
			</div>
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

	var latestArtifactBodyContents = '';

	$('#editArtifactButton_Cancel').attr('href', '/single-project/?projectID=' + currentProject + '&destination=artifacts');


	// *************** All Nodes for Project ***************
	function loadAllNodes() {
		$.get("/api/standard.php/nodes?transform=1", function(data) {
			for (var i = 0; i < data.nodes.length; i++) { // Adding child nodes:
				if (data.nodes[i].parent_node != 0) {
					for (var j = 0; j < data.nodes.length; j++) {
						if (data.nodes[j].id == data.nodes[i].parent_node) { // Looping through to get parent information for label
							allNodes.push({
								id: data.nodes[i].id,
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
					$('#artifactBody').html(data.body);
					latestArtifactBodyContents = data.body;
					deafultProjectingNode.select2().val(data.default_projector).trigger("change");
					var globalCodesArrayd = [];
					if(data.global_codes) {
						globalCodesArrayd = data.global_codes.split(',');
					}
					globalArtifactCodes.select2().val(globalCodesArrayd).trigger("change");
					artifactBodyTabInitialSetup();
				}
			});
		} else {
			artifactBodyTabInitialSetup();
		}
	}
	

	// *************** Artifact Body Tabs Management ***************
	var currentTab = 1;
	function artifactBodyTabInitialSetup() {
		var preChosenStep = gup('step');
		if(preChosenStep.length > 0) {
			if(preChosenStep == '2') {
				currentTab = '2';
				$('#step2TabHandle').click();
			} else if(preChosenStep == '3') {
				currentTab = '3';
				$('#step3TabHandle').click();
			} else {
				currentTab = '1';
				$('#step1TabHandle').click();
			}
		} else {
			currentTab = '1';
			$('#step1TabHandle').click();
		}
	}

	function artifactBodyTabTearDown(futureTab) {
		if(futureTab != currentTab) {
			if(currentTab == '2') {
				endStep2();
			} else if(currentTab == '3') {
				endStep3();
			} else {
				endStep1();
			}
		}
		setupPrevNextButtons(futureTab);
	}

	$('#step1TabHandle').click(function(){
		artifactBodyTabTearDown('1');
		currentTab = 1;
		initStep1();
	})
	$('#step2TabHandle').click(function(){
		artifactBodyTabTearDown('2');
		currentTab = 2;
		initStep2();
	})
	$('#step3TabHandle').click(function(){
		artifactBodyTabTearDown('3');
		currentTab = 3;
		initStep3();
	})

	function setupPrevNextButtons(futureTab) {
		console.log('running setupPrevNextButtons for tab: ' + futureTab);
		if(futureTab == '2') {
			$('#nextStepHandle').removeAttr('disabled');
			$('#nextStepHandle').click(function(){
				$('#step3TabHandle').click();
			})
		} else if (futureTab == '3') {
			$('#nextStepHandle').attr('disabled', 'true');
		} else {
			$('#nextStepHandle').removeAttr('disabled');
			$('#nextStepHandle').click(function(){
				$('#step2TabHandle').click();
			})
		}
	}

	function initStep1() {
		console.log('INIT STEP 1');
		console.log(latestArtifactBodyContents);
		$('#artifactBody').html('');
		$('#artifactBody').append(latestArtifactBodyContents);
		initCKEditorArea()
	}
	function endStep1() {
		console.log('END STEP 1');
		var bodyContents = CKEDITOR.instances.artifactBody.getData();
		if (CKEDITOR.instances.artifactBody) CKEDITOR.instances.artifactBody.destroy();
		performBasicSave(bodyContents);
		latestArtifactBodyContents = bodyContents;
	}
	function initStep2() {
		console.log('INIT STEP 2');
		$('#artifactBodyForWordFragmenting').html(latestArtifactBodyContents);
		if (latestArtifactBodyContents.indexOf('<abbr') > 0) {
			$('#autoBreakIntoOneWordFragments').attr('disabled', 'true');
			$('#artifactAlreadyHasFragmentsError').removeClass('hidden');
		}
	}
	function endStep2() {
		console.log('END STEP 2');
		latestArtifactBodyContents = $('#artifactBodyForWordFragmenting').html();
		console.log(latestArtifactBodyContents);
		console.log($('#artifactBodyForWordFragmenting').html());
		performArtifactWithCodesSave();
	}
	function initStep3() {
		console.log('INIT STEP 3');
		console.log(latestArtifactBodyContents);
		$('#artifactBodyForCoding').html('');
		$('#artifactBodyForCoding').append(latestArtifactBodyContents);
		activateFragmentCoding();
		$('abbr').click(function(e){
			showAbbrOptions(e.target.id);
		})
	}
	function endStep3() {
		console.log('END STEP 3');
		latestArtifactBodyContents = $('#artifactBodyForCoding').html();
		performArtifactWithCodesSave()
	}


	// *************** Artifact Body Tabs Util ***************

	$('#autoBreakIntoOneWordFragments').click(function(){
		var c = 0;
		$('#artifactBodyForWordFragmenting > *').each(function( ind ){
			var text = $(this).html().split(' '),
			len = text.length,               
			result = [];                     
			for( i=0; i<len; i++ ) {            
				result[i] = '<abbr id="'+( ++c )+'">' + text[i] + '</abbr>'; 
			}
			$(this).html(result.join(' '));      
		});
		console.log($('#artifactBodyForWordFragmenting > *').html());
		latestArtifactBodyContents = $('#artifactBodyForWordFragmenting > *').html();

	})

	function initCKEditorArea() {
		CKEDITOR.config.floatingtools = 'Basic';
		CKEDITOR.config.floatingtools_Basic =
		[
			['Abbr', 'Italic', '-', 'NumberedList', 'BulletedList']
		];

		CKEDITOR.replace( 'artifactBody', {
			extraPlugins: 'autogrow,abbr,toolbar',
			toolbarGroups: [
				{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
				{ name: 'document',	   groups: [ 'mode' ] },
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph',   groups: [ 'list', 'indent' ] },
				],
				removePlugins: 'elementspath,font,iframe,pagebreak,flash,stylescombo,print,preview,save,smiley,pastetext,pastefromword',
				removeButtons: 'Anchor,Font,Strike,Subscript,Superscript'
		});
	}

	// For "click here to add fragment"...
	function checkIfInArticleBody(textSelection) {
		// console.log('here');
		var artifactBody = $("#artifactBodyForCoding").text();
		if (artifactBody.indexOf(textSelection.anchorNode.data) >= 0) {
			return true;
		} else {
			console.log('nope');
			return false;
		}
	}

	function activateFragmentCoding() {
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
	}

	codeFragmentMoveableButton.click(function(){
		   
		clearAnyEditingAbbrs()
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

 		showAbbrOptions(span.id);
		$('#tooltip').css('display', 'none');
	})

	function getSelectedText() {
	  t = (document.all) ? document.selection.createRange().text : document.getSelection();
	  return t;
	}

	function showAbbrOptions(abbrID) {
		$('#addFragmentForm_Message').css('display', 'none');

		console.log(abbrID);
		clearAnyEditingAbbrs();
		var abbrElement = $('#artifactBodyForCoding').find("#" + abbrID);
		abbrElement.addClass('editing');

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
			fragmentModalOptions_Comment.val(abbrElement.attr('data-comments'));
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

		$('#artifactBodyForCoding').find("#" + fragmentID).attr('data-codes',fragmentCodesFormatted);
		$('#artifactBodyForCoding').find("#" + fragmentID).attr('data-nodeA',fragmentModalOptions_NodeA.val());
		$('#artifactBodyForCoding').find("#" + fragmentID).attr('data-nodeB',fragmentModalOptions_NodeB.val());
		$('#artifactBodyForCoding').find("#" + fragmentID).attr('data-feelings',fragmentModalOptions_Feelings.val());
		$('#artifactBodyForCoding').find("#" + fragmentID).attr('data-comments',fragmentModalOptions_Comment.val());

		clearAbbrOptions(fragmentID);
	})

	fragmentModalOptions_Cancel.click(function(){
		var fragmentID = fragmentModalOptions.attr('data-abbrID');
		clearAbbrOptions(fragmentID);
	})

	function clearAbbrOptions(abbrID) {
		$('#artifactBodyForCoding').find("#" + abbrID).removeClass('editing');
		$('#addFragmentForm_Message').css('display', 'flex');
		fragmentModalOptions_Codes.select2().val('').trigger("change");
		fragmentModalOptions_NodeA.select2().val('').trigger("change");
		fragmentModalOptions_NodeB.select2().val('').trigger("change");
		fragmentModalOptions_Feelings.select2().val('').trigger("change");
		fragmentModalOptions_Comment.val('');
	}

	function clearAnyEditingAbbrs() {
		$('body').find('abbr').removeClass('editing');
	}


	saveCodingButton.click(function(){
		performBasicSave($('#artifactBodyForCoding').html(), true);
	})


	// *************** BASIC Artifact Save ***************
	function performBasicSave(body, redirectHome) {
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
					if(redirectHome) {
						window.location.replace("/single-project/?projectID=92&destination=artifacts");
					}
				} else {
					console.log('Error adding node.');
				}
			});
		} else {
			$.post("/api/standard.php/artifacts", formData, function(result) {
				if(!isNaN(result)) {
					console.log("SUCCESS: Artifact Saved");
					if(redirectHome) {
						window.location.replace("/single-project/?projectID=92&destination=artifacts");
					}
				} else {
					console.log('Error adding node.');
				}
			});
		}
	}


	// *************** Artifact With Codes Save ***************
	function performArtifactWithCodesSave() {
		var artifactID = gup('rid');
		var formData = {
			body: $('#artifactBodyForCoding').html()
		}

		// @TODO: Error Validation

		if (artifactID) {
			$.put("/api/standard.php/artifacts/" + artifactID, formData, function(result) {
				if(!isNaN(result)) {
					console.log("SUCCESS: Codes for Artifact Saved");
					// alert("Success: Codes Saved");
				} else {
					console.log('Error saving artifact codes.');
				}
			});
		}
	}

	// function disableBasicFields() {
	// 	globalArtifactCodes.attr('disabled', 'true');
	// 	deafultProjectingNode.attr('disabled', 'true');
	// 	$('#artifactName').attr('disabled', 'true');
	// 	beginCodingButton.attr('disabled', 'true');
	// 	saveCodingButton.removeAttr('disabled');
	// }

</script>