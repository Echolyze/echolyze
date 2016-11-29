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
					<label for="reportSingleProjectingNodeFilterSelect" class="col-sm-4">Projecting Node:<span class="field-helper">Only consider fragments projected by this node.</span></label>
					<div class="col-sm-8">
						<select class="form-control select2 select2-hidden-accessible" style="width:100%" id="reportSingleProjectingNodeFilterSelect" data-placeholder="All Nodes">
						</select>
					</div>
				</div>
				<div class="form-group" style="display: flex;">
					<label for="reportNodeAFilterSelect" class="col-sm-4">Filter Projecting Node(s):<span class="field-helper">Only include fragments that are projected by one of these nodes.</span></label>
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
	    if ((typeof util_AllNodes == 'undefined') || (typeof util_AllCodes == 'undefined') || (typeof util_AllArtifacts == 'undefined') || (typeof util_AllFragments == 'undefined')) return;
	    clearInterval(interval);

	    console.log('Nodes, Artifacts, Fragments, and Codes Loaded');
	    initReporting()

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

		var filteredData_Fragments = util_AllFragments;
		var filteredData_Nodes = util_AllNodes;
		var filteredData_Codes = util_AllCodes;

		var codes_InFilterSelect = reportCodeFilterSelect.val();
		var singleProjectingNode_InFilterSelect = reportSingleProjectingNodeFilterSelect.val();
		var nodeA_InFilterSelect = reportNodeAFilterSelect.val();
		var nodeB_InFilterSelect = reportNodeBFilterSelect.val();

		filteredData_Fragments = filter_FragmentsByCodes(codes_InFilterSelect);
		filteredData_Fragments = filter_FragmentsByNodeA(nodeA_InFilterSelect, filteredData_Fragments);
		filteredData_Fragments = filter_FragmentsByNodeB(nodeB_InFilterSelect, filteredData_Fragments);

		var reportType = reportTypeSelect.val();
		console.log('Requesting Report Type: ' + reportType);
		if (reportType == 'ReportType_SingleNodeMatrix') {
			singleNodeMatrix(singleProjectingNode_InFilterSelect);
		} else if (reportType == 'ReportType_FragmentsByNodeFeelings') {
			nodeBasedReport(filteredData_Fragments);
		} else if (reportType == 'ReportType_FragmentsByCode') {
			codeBasedReport(filteredData_Fragments);
		} else if (reportType == 'ReportType_FragmentsByNodeFeelingsGraph') {
			directedGraphMatrix();
		}
	}

	function codeBasedReport(filteredData_Fragments) {
		primaryGraphRegion_CY.hide();
		primaryReportTable.show();
		primaryReportTable.children('thead').append('<tr><th>Code</th><th>Related Artifact</th><th>Fragment Body</th><th>NodeA/B Feeling</th></tr>')

		// Loop through all fragments, creating single entry based on number of codes for fragment
		var preProcessFragments = [];
		for (var k = 0; k < filteredData_Fragments.length; k++) {
			var numCodes = filteredData_Fragments[k].codes.split(',');
			for (var j = 0; j < numCodes.length; j++) {
				var futurePartialFragment = filteredData_Fragments[k];
				futurePartialFragment['org_id'] = filteredData_Fragments[k].id;
				if (j > 0) {
					futurePartialFragment.id = filteredData_Fragments[k].id + '_' + j;
				}
				futurePartialFragment['codes'] = numCodes[j];

				codeBasedReport_RowAdder(futurePartialFragment);
			}
			if (k == (filteredData_Fragments.length - 1)) {
				initDataTable('#primaryReportTable');
			}
		};
	}
	function codeBasedReport_RowAdder(proccessedFragmentObject) {
		var nodeADetail = getNodeByID(proccessedFragmentObject.nodeA);
		var nodeBDetail = getNodeByID(proccessedFragmentObject.nodeB);
		var artifactDetail = getArtifactByID(proccessedFragmentObject.related_artifact);
		var codes = prettyEnglishListOfCodes(proccessedFragmentObject.codes);
		var fragmentText = getFragmentTextByInlineIDAndArtifactID(proccessedFragmentObject.inline_id, proccessedFragmentObject.related_artifact)

		primaryReportTable.children('tbody').append('<tr>' + '<td>' + codes + '</td>' + '<td>' + artifactDetail.name + '</td>' + '<td><span class="pe-parsed-fragment-text">' + fragmentText + '</span></td>' + '<td>' + nodeADetail.name + ' feels ' + proccessedFragmentObject.feeling + ' towards ' + nodeBDetail.name + '</td>' + '</tr>');
	}

	function singleNodeMatrix(projectingNodeID) {
		console.log(projectingNodeID);
		primaryGraphRegion_CY.hide();
		primaryReportTable.show();
		primaryReportTable.children('thead').append('<tr><th>Feelings Projected by ' + getNodeByID(projectingNodeID).name + ' Towards:</th><th>Positive</th><th>Negative</th></tr>');
		var matrixResult = matrixMaker();

		for (var i = 0; i < util_AllNodes.length; i++) {
			primaryReportTable.children('tbody').append('<tr>' + '<td>' + util_AllNodes[i].name + '</td><td>' + matrixResult[projectingNodeID][util_AllNodes[i].id].positive.count + '</td><td>' + matrixResult[projectingNodeID][util_AllNodes[i].id].negative.count + '</td>' + '</tr>');
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
					faveShape: 'rectangle',
					faveColor: '#3c8dbc'
				}
			}
			nodesArray.push(singleNode);
			for (var k = 0; k < util_AllNodes.length; k++) {
				var netValueCalc = directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].positive.count - directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].negative.count;
				var positiveCounts = directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].positive.count * 10;
				var negativeCounts = directedGraphMatrix_Matrix[util_AllNodes[i].id][util_AllNodes[k].id].negative.count;

				if (positiveCounts > 0) {
					singleEdge = {
						data: {
							source: util_AllNodes[i].id,
							target: util_AllNodes[k].id,
							strength: positiveCounts,
							faveColor: '#3c8dbc'
						}
					}
					edgesArray.push(singleEdge);
				}
				if (negativeCounts > 0) {
					singleEdge = {
						data: {
							source: util_AllNodes[i].id,
							target: util_AllNodes[k].id,
							strength: negativeCounts,
							faveColor: '#d33724'
						}
					}
					edgesArray.push(singleEdge);
				}
			}
		}
		$('#cy').cytoscape({
			layout: {
				name: 'cose',
				padding: 10,
				randomize: true
			},

			style: cytoscape.stylesheet()
			.selector('node')
			.css({
				'shape': 'roundrectangle',

				'width': '150px',
				'height': '40px',
				'content': 'data(name)',
				'text-valign': 'center',
				'text-outline-width': 1,
				'text-outline-color': 'data(faveColor)',
				'background-color': 'data(faveColor)',
				'color': '#fff',
				'font-size': 12
			})
			.selector(':selected')
			.css({
				'border-width': 3,
				'border-color': '#3c8dbc'
			})
			.selector('edge')
			.css({
				'curve-style': 'bezier',
				'opacity': 0.666,
				'width': 'data(strength)',
				'target-arrow-shape': 'triangle',
				'source-arrow-shape': '',
				'line-color': 'data(faveColor)',
				'source-arrow-color': 'data(faveColor)',
				'target-arrow-color': 'data(faveColor)'
			})
			.selector('edge.questionable')
			.css({
				'line-style': 'dotted',
				'target-arrow-shape': 'diamond'
			})
			.selector('.faded')
			.css({
				'opacity': 0.25,
				'text-opacity': 0
			}),
			elements: {
				nodes: nodesArray,
				edges: edgesArray
			},

			ready: function(){
				window.cy = this;
			}
		});
	}

	function nodeBasedReport() {
		primaryGraphRegion_CY.hide();
		primaryReportTable.show();

		primaryReportTable.children('thead').append('<tr><th>NodeA/B Feeling</th><th>Related Artifact</th><th>Fragment Body</th><th>Codes</th></tr>')

		//@TODO: Check Filters?
		var filteredData_Fragments = util_AllFragments;

		for (var i = 0; i < filteredData_Fragments.length; i++) {
			var nodeADetail = getNodeByID(filteredData_Fragments[i].nodeA);
			var nodeBDetail = getNodeByID(filteredData_Fragments[i].nodeB);
			var artifactDetail = getArtifactByID(filteredData_Fragments[i].related_artifact);
			var codes = prettyEnglishListOfCodes(filteredData_Fragments[i].codes);
			var fragmentText = getFragmentTextByInlineIDAndArtifactID(filteredData_Fragments[i].inline_id, filteredData_Fragments[i].related_artifact)

			var columnOneDescribingNodeAandB_Color = 'warning';
			var columnOneDescribingNodeAandB_Icon = 'Unknown';
			if (filteredData_Fragments[i].feeling == 'negative') {
				columnOneDescribingNodeAandB_Color = 'danger'
				columnOneDescribingNodeAandB_Icon = '<i class="fa fa-minus" style="vertical-align: text-bottom;"></i>'
			} else if (filteredData_Fragments[i].feeling == 'positve') {
				columnOneDescribingNodeAandB_Color = 'success'
				columnOneDescribingNodeAandB_Icon = '<i class="fa fa-plus" style="vertical-align: text-bottom;"></i>'
			}
			var columnOneDescribingNodeAandB = '<span class="label label-primary">' + nodeADetail.name + '</span> <span class="label label-' + columnOneDescribingNodeAandB_Color + '">' + columnOneDescribingNodeAandB_Icon + '</span> <span class="label label-primary">' + nodeBDetail.name + '</span> '

			primaryReportTable.children('tbody').append('<tr><td>' + columnOneDescribingNodeAandB + '</td><td>' + artifactDetail.name + '</td>' + '<td><span class="pe-parsed-fragment-text">' + fragmentText + '</span></td>' + '<td>' + codes + '</td>' + '</tr>');
			if (i == (filteredData_Fragments.length - 1)) {
				initDataTable('#primaryReportTable');
			}
		}

	}

	function initDataTable(selector) {
		var table = $(selector).DataTable({
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
	            { "bVisible": false, "aTargets": [ 0 ] }
	        ]
		});
		// Adding buttons to top left
		table.buttons().container()
			.appendTo( selector + '_wrapper .col-sm-6:eq(0)' );
		$(selector).css('width', '100%');
	}
</script>