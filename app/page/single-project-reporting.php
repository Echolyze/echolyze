<style type="text/css">
        #mynetwork {
            width: 100%;
            height: 800px;
        }
        #cy {
  height: 600px;
  width: 100%;
  left: 0;
  top: 0;
}
.field-helper {
	display: block;
    font-size: 10px;
    font-weight: normal;
}
.group {
	background: #f4f4f4;
}
.group td {
	line-height: 15px !important;
}
.pe-group-total {
	text-align: right;
}
.help-block-pe {
	display: inline-block;
	padding-left: 15px;
}
</style>

<div class="row">
	<div class="col-xs-12">
		<div id="reportParameters" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Report Parameters</h3>
			</div>
			<div class="box-body">
				<div class="form-group" style="display: flex;">
					<label for="reportTypeSelect" class="col-sm-4">Report Type:</label>
					<div class="col-sm-8">
						<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="reportTypeSelect">
							<option value="ReportType_SingleNodeMatrix">Single Node Matrix</option>
							<option value="ReportType_FragmentsByNodeFeelings">Fragments Summarized by Feelings</option>
							<option value="ReportType_FragmentsByCode">Fragments Summarized by Code</option>
							<option value="ReportType_FragmentsByNodeFeelingsGraph">Fragments Summarized by Feelings (Graph)</option>
							<option value="ReportType_CodeCounts">Code Usage Summary</option>
						</select>
					</div>
				</div>
				<div class="form-group" style="display: flex;">
					<label for="reportCodeFilterSelect" class="col-sm-4">Filter Codes: <span class="field-helper">Only include fragments that are coded with one of these codes.</span></label>
					<div class="col-sm-8">
						<select class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width:100%" id="reportCodeFilterSelect">
						</select>
					</div>
				</div>
				<div class="form-group" style="display: flex;">
					<label for="reportSingleProjectingNodeFilterSelect" class="col-sm-4">Source Node:<span class="field-helper">Only consider fragments projected by this node.</span></label>
					<div class="col-sm-8">
						<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="reportSingleProjectingNodeFilterSelect" data-placeholder="All Nodes">
						</select>
					</div>
				</div>
				<div class="form-group" style="display: flex;">
					<label for="reportNodeAFilterSelect" class="col-sm-4">Filter Source Node(s):<span class="field-helper">Only include fragments that are projected by one of these nodes.</span></label>
					<div class="col-sm-8">
						<select class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width:100%" id="reportNodeAFilterSelect" data-placeholder="Select a Node">
						</select>
					</div>
				</div>
				<div class="form-group" style="display: flex;">
					<label for="reportNodeBFilterSelect" class="col-sm-4">Filter Target Node(s):<span class="field-helper">Only include fragments that are targeted towards one of these nodes.</span></label>
					<div class="col-sm-8">
						<select class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width:100%" id="reportNodeBFilterSelect" data-placeholder="All Nodes">
						</select>
					</div>
				</div>
				<div class="form-group" style="display: flex;">
					<label for="reportArtifactFilterSelect" class="col-sm-4">Filter Artifacts:<span class="field-helper">Only include fragments that belong to any of these artifacts.</span></label>
					<div class="col-sm-8">
						<select class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width:100%" id="reportArtifactFilterSelect" data-placeholder="All Nodes">
						</select>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<div class="col-sm-offset-4 col-sm-8">
					<button type="submit" id="runReport" class="btn btn-primary">Generate Report</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div id="reportContent" class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Report</h3>
			</div>
			<div class="box-body">
			<table id="primaryReportTable" class="table table-bordered">
				<thead></thead>
				<tbody>
					
				</tbody>
			</table>
			<div id="cy"></div>
			</div>
			<div class="box-footer">

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Elements:
	var currentProject = gup('projectID');
	var primaryReportTable = $('#primaryReportTable');
	var primaryGraphRegion_CY = $('#cy');
	var reportTypeSelect = $('#reportTypeSelect');
	var reportCodeFilterSelect = $('#reportCodeFilterSelect');
	var reportSingleProjectingNodeFilterSelect = $('#reportSingleProjectingNodeFilterSelect');
	var reportNodeAFilterSelect = $('#reportNodeAFilterSelect');
	var reportNodeBFilterSelect = $('#reportNodeBFilterSelect');
	var reportArtifactFilterSelect = $('#reportArtifactFilterSelect');

	// ******************** Waiting for Load *************************
	var interval = setInterval(function() {
	    if ((typeof util_AllNodes == 'undefined') || 
	    	(typeof util_AllCodes == 'undefined') || 
	    	(typeof util_AllArtifacts == 'undefined') || 
	    	(typeof util_AllFragments == 'undefined') || 
	    	(typeof util_BasicProjectDetails == 'undefined')) return;
	    clearInterval(interval);

	    console.log('Nodes, Artifacts, Fragments, and Codes Loaded');
	    initReporting();
	    globalLoadingIndicator_Clear();

	}, 10);

	$('#runReport').click(function(){
		runReportCreate();
		$('#runReport').blur();
	})

	function initReporting() {
		primaryGraphRegion_CY.hide(); // hiding the space for the graph
		primaryReportTable.hide(); // hiding the space for the table
		initDataTable('#primaryReportTable'); // init the data table so that we can always destroy it for each report 

		var allCodesForSelect = provideCodesForSelect();
		var allNodesForSelect = provideNodesForSelect();
		var allArtifactsForSelect = provideArtifactsForSelect();

		reportTypeSelect.select2({
			allowClear: true,
			placeholder: "Report Type"
		})
		reportCodeFilterSelect.select2({
			data: allCodesForSelect,
			allowClear: true,
			placeholder: "All Codes"
		})
		reportSingleProjectingNodeFilterSelect.select2({
			data: allNodesForSelect,
			allowClear: true
		})
		reportNodeAFilterSelect.select2({
			data: allNodesForSelect,
			allowClear: true
		})
		reportNodeBFilterSelect.select2({
			data: allNodesForSelect,
			allowClear: true
		})
		reportArtifactFilterSelect.select2({
			data: allArtifactsForSelect,
			allowClear: true
		})
		reportTypeSelect.val('').trigger('change')
		reportCodeFilterSelect.val('').trigger('change')
		reportSingleProjectingNodeFilterSelect.val('').trigger('change')
		reportNodeAFilterSelect.val('').trigger('change')
		reportNodeBFilterSelect.val('').trigger('change')
		reportArtifactFilterSelect.val('').trigger('change')

		// hide all the selects until a report type is shown...
		reportSingleProjectingNodeFilterSelect.parent().parent('.form-group').hide();
		reportNodeAFilterSelect.parent().parent('.form-group').hide();
		reportNodeBFilterSelect.parent().parent('.form-group').hide();
		reportArtifactFilterSelect.parent().parent('.form-group').hide();
		reportCodeFilterSelect.parent().parent('.form-group').hide();

		reportTypeSelect.change(function(){
			// Clear the values of them:
			reportCodeFilterSelect.val('').trigger('change')
			reportSingleProjectingNodeFilterSelect.val('').trigger('change')
			reportNodeAFilterSelect.val('').trigger('change')
			reportNodeBFilterSelect.val('').trigger('change')
			reportArtifactFilterSelect.val('').trigger('change')

			// Rehide them in case things have changed...
			reportSingleProjectingNodeFilterSelect.parent().parent('.form-group').hide();
			reportNodeAFilterSelect.parent().parent('.form-group').hide();
			reportNodeBFilterSelect.parent().parent('.form-group').hide();
			reportArtifactFilterSelect.parent().parent('.form-group').hide();
			reportCodeFilterSelect.parent().parent('.form-group').hide();

			var pickedReportType = reportTypeSelect.val();
			if (pickedReportType == 'ReportType_SingleNodeMatrix') {
				reportSingleProjectingNodeFilterSelect.parent().parent('.form-group').show();
			} else if (pickedReportType == 'ReportType_FragmentsByNodeFeelings') {
				reportCodeFilterSelect.parent().parent('.form-group').show();
			} else if (pickedReportType == 'ReportType_FragmentsByCode') {
				reportNodeAFilterSelect.parent().parent('.form-group').show();
				reportNodeBFilterSelect.parent().parent('.form-group').show();
				reportCodeFilterSelect.parent().parent('.form-group').show();
			} else if (pickedReportType == 'ReportType_FragmentsByNodeFeelingsGraph') {
				// reportSingleProjectingNodeFilterSelect.parent().parent('.form-group').show();
			}
		})
	}
	function clearReportTable() {
		if ($.fn.DataTable.isDataTable('#primaryReportTable')) {
			$('#primaryReportTable').DataTable().destroy();
		}		
		$('#primaryReportTable thead').empty();
		$('#primaryReportTable tbody').empty();
	}
	function runReportCreate() {
		clearReportTable();

		var filteredData_Fragments = jQuery.extend(true, {}, util_AllFragments);
		var filteredData_Fragments_ThisSession = [];
		$.each(filteredData_Fragments, function(index, value) {
			filteredData_Fragments_ThisSession.push(value);
		}); 
		var filteredData_Nodes = (util_AllNodes);
		var filteredData_Codes = (util_AllCodes);
		var filteredData_Artifacts = util_AllArtifacts;

		var codes_InFilterSelect = reportCodeFilterSelect.val();
		var singleProjectingNode_InFilterSelect = reportSingleProjectingNodeFilterSelect.val();
		var nodeA_InFilterSelect = reportNodeAFilterSelect.val();
		var nodeB_InFilterSelect = reportNodeBFilterSelect.val();

		filteredData_Fragments_ThisSession = filter_FragmentsByCodes(codes_InFilterSelect, filteredData_Fragments_ThisSession);
		filteredData_Fragments_ThisSession = filter_FragmentsByNodeA(nodeA_InFilterSelect, filteredData_Fragments_ThisSession);
		filteredData_Fragments_ThisSession = filter_FragmentsByNodeB(nodeB_InFilterSelect, filteredData_Fragments_ThisSession);

		var reportType = reportTypeSelect.val();
		console.log('Requesting Report Type: ' + reportType);
		console.log(filteredData_Fragments_ThisSession);
		if (reportType == 'ReportType_SingleNodeMatrix') {
			singleNodeMatrix(singleProjectingNode_InFilterSelect);
		} else if (reportType == 'ReportType_FragmentsByNodeFeelings') {
			nodeBasedReport(filteredData_Fragments_ThisSession);
		} else if (reportType == 'ReportType_CodeCounts') {
			codeCountsReport(filteredData_Codes, filteredData_Fragments_ThisSession, filteredData_Artifacts);
		} else if (reportType == 'ReportType_FragmentsByCode') {
			codeBasedReport(filteredData_Fragments_ThisSession);
		} else if (reportType == 'ReportType_FragmentsByNodeFeelingsGraph') {
			directedGraphMatrix();
		}
	}

	function codeCountsReport(passedCodes, passedFragments, passedArtifacts) {
		primaryGraphRegion_CY.hide();
		primaryReportTable.show();
		primaryReportTable.children('thead').append('<tr><th>Code</th><th># of Fragments</th><th># of Unique Artifacts</th><th># of Artifacts Globally Coded</th></tr>');
		var countMatrixCodes = countCodeUsageInFragments(passedCodes, passedFragments);
		var countMatrixCodesByFragment = countCodeUsageInFragmentsByArtifact(passedCodes, passedFragments);
		var countMatrixGlobalCodesByArtifact = countGlobalCodeUsageInArtifacts(passedCodes, passedArtifacts);

		for (var i = 0; i < passedCodes.length; i++) {
			primaryReportTable.children('tbody').append('<tr>' + '<td>' + passedCodes[i].name + '</td>' + '<td>' + countMatrixCodes[passedCodes[i].id] + '</td>' + '<td>' + countMatrixCodesByFragment[passedCodes[i].id] + '</td>' +  '<td>' + countMatrixGlobalCodesByArtifact[passedCodes[i].id] + '</td>' + '</tr>');
			if (i == (passedCodes.length - 1)) {
				initDataTable('#primaryReportTable', false, true);
			}
		}
	}

	function codeBasedReport(passedFragments, passedArtifacts) {
		primaryGraphRegion_CY.hide();
		primaryReportTable.show();
		primaryReportTable.children('thead').append('<tr><th>Code</th><th>Source & Target Nodes</th><th>Related Artifact</th><th>Fragment Body</th></tr>')

		// Loop through all fragments, creating single entry based on number of codes for fragment

		var preProcessFragments = [];
		for (var k = 0; k < passedFragments.length; k++) {
			var numCodes = passedFragments[k].codes.split(',');
			for (var j = 0; j < numCodes.length; j++) {
				var futurePartialFragment = jQuery.extend(true, {}, passedFragments[k]);
				futurePartialFragment['org_id'] = passedFragments[k].id;
				if (j > 0) {
					futurePartialFragment.id = passedFragments[k].id + '_' + j;
				}
				futurePartialFragment['codes'] = numCodes[j];
				preProcessFragments.push(futurePartialFragment);
			}
		}

		preProcessFragments.sort(function(a, b){
			if (a.codes < b.codes) {
				return -1;
			} else if (a.codes > b.codes) {
				return  1;
			} else {
				return 0;
			}
		});
		console.log(preProcessFragments);
		for (var i = 0; i < preProcessFragments.length; i++) {
			codeBasedReport_RowAdder(preProcessFragments[i]);
			if (i == (preProcessFragments.length - 1)) {
				initDataTable('#primaryReportTable', true, false);
			}
		}
	}
	function codeBasedReport_RowAdder(proccessedFragmentObject) {
		var nodeADetail = getNodeByID(proccessedFragmentObject.nodeA);
		var nodeBDetail = getNodeByID(proccessedFragmentObject.nodeB);
		var artifactDetail = getArtifactByID(proccessedFragmentObject.related_artifact);
		var codes = prettyEnglishListOfCodes(proccessedFragmentObject.codes);
		var fragmentText = getFragmentTextByInlineIDAndArtifactID(proccessedFragmentObject.inline_id, proccessedFragmentObject.related_artifact)

		primaryReportTable.children('tbody').append('<tr>' + '<td>' + codes + '</td>' +'<td>' + nodeADetail.name + ' feels ' + proccessedFragmentObject.feeling + ' towards ' + nodeBDetail.name + '</td>' + '<td>' + artifactDetail.name + '</td>' + '<td><span class="pe-parsed-fragment-text">' + fragmentText + '</span></td>' + '</tr>');
	}

	function singleNodeMatrix(projectingNodeID) {
		if(!projectingNodeID) {
			alert('In order to view this report, please specify a source node.')
			// throwErrorOnField('reportSingleProjectingNodeFilterSelect','This is a required field. Please select a source node.');
			return;
		};
		console.log(projectingNodeID);
		primaryGraphRegion_CY.hide();
		primaryReportTable.show();
		primaryReportTable.children('thead').append('<tr><th>Feelings Projected by ' + getNodeByID(projectingNodeID).name + ' Towards:</th><th>Positive</th><th>Negative</th></tr>');
		var matrixResult = matrixMaker();

		for (var i = 0; i < util_AllNodes.length; i++) {
			primaryReportTable.children('tbody').append('<tr>' + '<td>' + util_AllNodes[i].name + '</td><td>' + matrixResult[projectingNodeID][util_AllNodes[i].id].positive.count + '</td><td>' + matrixResult[projectingNodeID][util_AllNodes[i].id].negative.count + '</td>' + '</tr>');
			if (i == (util_AllNodes.length - 1)) {
				initDataTable('#primaryReportTable', false, true);
			}
		}

	}

	function directedGraphMatrix() {
		primaryGraphRegion_CY.show();
		primaryReportTable.hide();
		var directedGraphMatrix_Matrix = matrixMaker();
		// create an arrays for nodes and edges
		var nodesArray = [];
		var edgesArray = [];
		for (var i = 0; i < util_AllNodes.length; i++) {
			singleNode = {
				data: {
					id: util_AllNodes[i].id,
					name: util_AllNodes[i].name,
					faveShape: 'rectangle'
				}
			}
			nodesArray.push(singleNode);
			for (var k = 0; k < util_AllNodes.length; k++) {
				var netValueCalc = directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].positive.count - directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].negative.count;
				var positiveCounts = directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].positive.count;
				var negativeCounts = directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].negative.count;

				if (positiveCounts > 0) {
					var edgeWordLabel = positiveCounts + ' fragment';
					if (positiveCounts > 1) {
						edgeWordLabel = positiveCounts + ' fragments';
					}
					singleEdge = {
						data: {
							source: util_AllNodes[i].id,
							target: util_AllNodes[k].id,
							strength: (positiveCounts * 2),
							faveColor: '#00d44d',
							label: edgeWordLabel
						}
					}
					edgesArray.push(singleEdge);
				}
				if (negativeCounts > 0) {
					var edgeWordLabel = negativeCounts + ' fragment';
					if (negativeCounts > 1) {
						edgeWordLabel = negativeCounts + ' fragments';
					}
					singleEdge = {
						data: {
							source: util_AllNodes[i].id,
							target: util_AllNodes[k].id,
							strength: (negativeCounts * 2),
							faveColor: '#d33724',
							label: edgeWordLabel
						}
					}
					edgesArray.push(singleEdge);
				}
			}
		}
		$('#cy').cytoscape({
			layout: {
				name: 'circle',
				padding: 25,
				randomize: false,
				avoidOverlapPadding: 30,
				avoidOverlap: true
			},
			style: [
			{
				selector: 'node',
				style: {
					'shape': 'roundrectangle',
					'width': '150px',
					'height': '40px',
					'content': 'data(name)',
					'text-valign': 'center',
					'background-color': '#3c8dbc',
					'color': '#fff',
					'font-size': 12
				}
			},
			{
				selector: 'edge',
				style: {
					'curve-style': 'bezier',
					'text-rotation': 'autorotate',
					'font-size': 10,
					'opacity': 1,
					'text-background-color': '#FFF',
					'text-background-opacity': 0.8,
					'text-background-shape': 'rectangle',
					'width': 'data(strength)',
					'target-arrow-shape': 'triangle',
					'source-arrow-shape': '',
					'line-color': 'data(faveColor)',
					'source-arrow-color': 'data(faveColor)',
					'target-arrow-color': 'data(faveColor)',
					'label': 'data(label)',

				}
			}
			],
			elements: {
				nodes: nodesArray,
				edges: edgesArray
			},

			ready: function(){
				window.cy = this;
			}
		});
	}

	function nodeBasedReport(providedFragments) {
		primaryGraphRegion_CY.hide();
		primaryReportTable.show();

		primaryReportTable.children('thead').append('<tr><th>NodeA/B Feeling</th><th>Codes</th><th>Related Artifact</th><th>Fragment Body</th></tr>')

		// Loop through all fragments, creating single entry based on number of codes for fragment
		var preProcessFragments = [];
		for (var k = 0; k < providedFragments.length; k++) {
			var numCodes = providedFragments[k].codes.split(',');
			for (var j = 0; j < numCodes.length; j++) {
				var futurePartialFragment = providedFragments[k];
				futurePartialFragment['org_id'] = providedFragments[k].id;
				if (j > 0) {
					futurePartialFragment.id = providedFragments[k].id + '_' + j;
				}
				futurePartialFragment['codes'] = numCodes[j];

				console.log(providedFragments[k]);
				nodeBasedReport_RowAdder(futurePartialFragment);
			}
			if (k == (providedFragments.length - 1)) {
				initDataTable('#primaryReportTable', true, false);
			}
		}
	}

	function nodeBasedReport_RowAdder(passedSingleRowToAdd) {
			console.log('running row adder for:');
			console.log(passedSingleRowToAdd);
			var nodeADetail = getNodeByID(passedSingleRowToAdd.nodeA);
			var nodeBDetail = getNodeByID(passedSingleRowToAdd.nodeB);
			var artifactDetail = getArtifactByID(passedSingleRowToAdd.related_artifact);
			var codes = prettyEnglishListOfCodes(passedSingleRowToAdd.codes);
			var fragmentText = getFragmentTextByInlineIDAndArtifactID(passedSingleRowToAdd.inline_id, passedSingleRowToAdd.related_artifact)

			var columnOneDescribingNodeAandB_Color = 'warning';
			var columnOneDescribingNodeAandB_Icon = 'Unknown';
			if (passedSingleRowToAdd.feeling == 'negative') {
				columnOneDescribingNodeAandB_Color = 'danger'
				columnOneDescribingNodeAandB_Icon = '<i class="fa fa-minus" style="vertical-align: text-bottom;"></i>'
			} else if (passedSingleRowToAdd.feeling == 'positve') {
				columnOneDescribingNodeAandB_Color = 'success'
				columnOneDescribingNodeAandB_Icon = '<i class="fa fa-plus" style="vertical-align: text-bottom;"></i>'
			}
			var columnOneDescribingNodeAandB = '<span class="label label-primary">' + nodeADetail.name + '</span> <span class="label label-' + columnOneDescribingNodeAandB_Color + '">' + columnOneDescribingNodeAandB_Icon + '</span> <span class="label label-primary">' + nodeBDetail.name + '</span> '

			primaryReportTable.children('tbody').append('<tr><td>' + columnOneDescribingNodeAandB + '</td>' + '<td>' + codes + '</td>' + '<td>' + artifactDetail.name + '</td>' + '<td><span class="pe-parsed-fragment-text">' + fragmentText + '</span></td>' + '</tr>');
	}

	function initDataTable(selector, groupingEnabled = true, sortingEnabled = true) {
		var table = $(selector).DataTable({
			"bSort" : sortingEnabled,
			lengthChange: false,
			buttons: ['excel', 'pdf' ],
			"autoWidth": true,
			"bInfo" : false,
			"sSearch": "Filter: ",
			"paging": false,
			language: {
        		search: "Filter: "
    		},
			"drawCallback": function ( settings ) {
				if (!groupingEnabled) {
					return;
				}
	            var api = this.api();
	            if (!api.row(0).data()) {
	            	return;
	            };
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	            var colonne = api.row(0).data().length;
	            var totale = new Array();
	            totale['Totale']= new Array();
	            var groupid = -1;
	            var subtotale = new Array();

	                
	            api.column(0, {page:'current'} ).data().each( function ( group, i ) {     
	                if ( last !== group ) {
	                    groupid++;
	                    $(rows).eq( i ).before(
	                        '<tr class="group"><td>'+group+'</td></tr>'
	                    );
	                    last = group;
	                }
	                
	                                
	                val = api.row(api.row($(rows).eq( i )).index()).data();      //current order index
	                $.each(val,function(index2,val2){
	                        if (typeof subtotale[groupid] =='undefined'){
	                            subtotale[groupid] = new Array();
	                        }
	                        if (typeof subtotale[groupid][index2] =='undefined'){
	                            subtotale[groupid][index2] = 0;
	                        }
	                        if (typeof totale['Totale'][index2] =='undefined'){ totale['Totale'][index2] = 0; }
	                        
	                        valore = Number(val2.replace('€',"").replace('.',"").replace(',',"."));
	                        subtotale[groupid][index2] += valore;
	                        totale['Totale'][index2] += valore;
	                });
	                
	                
	                
	            } );                
				$('tbody').find('.group').each(function (i,v) {
		                var rowCount = $(this).nextUntil('.group').length;
		        		$(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }));
		        		$(this).find('td:first').attr('colspan', (colonne - 2));
		                var subtd = '';
		                // Totals for sub columns
	                    // for (var a=2;a<colonne;a++)
	                    // { 
	                    //     subtd += '<td>'+subtotale[i][a]+' OUT OF '+totale['Totale'][a]+ ' ('+ Math.round(subtotale[i][a]*100/totale['Totale'][a],2) +'%) '+'</td>';
	                    // }
	                    subtd += '<td class="pe-group-total">Count: ' + rowCount + '</td>';
	                    $(this).append(subtd);
	                });
							
	        },
	        "aoColumnDefs": [
	            { "bVisible": !(groupingEnabled), "aTargets": [ 0 ] }
	        ]
		});
		// Adding buttons to top left
		table.buttons().container()
			.appendTo( selector + '_wrapper .col-sm-6:eq(0)' );
		$(selector).css('width', '100%');
	}
</script>