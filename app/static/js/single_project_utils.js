var util_CurrentProject = gup('projectID');
var util_AllNodes = util_LoadAllNodes();
var util_AllCodes = util_LoadAllCodes();
var util_AllArtifacts = util_LoadAllArtifacts();
var util_AllFragments = util_LoadAllFragments();

// *************** LOAD DATA PARTICULAR TO PROJECT ***************
function util_LoadAllCodes() {
	$.get("/api/standard.php/codes?transform=1&filter=related_project,eq," + util_CurrentProject, function(data) {
		util_AllCodes = data.codes;
	});
};
function util_LoadAllNodes() {
	$.get("/api/standard.php/nodes?transform=1&filter=related_project,eq," + util_CurrentProject, function(data) {
		util_AllNodes = data.nodes;
	});
};
function util_LoadAllArtifacts() {
	$.get("/api/standard.php/artifacts?transform=1&filter=related_project,eq," + util_CurrentProject, function(data) {
		util_AllArtifacts = data.artifacts;
	});
};
function util_LoadAllFragments() {
	$.get("/api/standard.php/fragments?transform=1&filter=related_project,eq," + util_CurrentProject, function(data) {
		util_AllFragments = data.fragments;
	});
};
function provideNodesForSelect() {
	var nodesForSelect = [];
	for (var i = 0; i < util_AllNodes.length; i++) { // Adding child nodes:
		if (util_AllNodes[i].parent_node != 0) {
			for (var j = 0; j < util_AllNodes.length; j++) {
				if (util_AllNodes[j].id == util_AllNodes[i].parent_node) { // Looping through to get parent information for label
					nodesForSelect.push({
						id: util_AllNodes[i].id,
						text: util_AllNodes[j].name + ' > ' + util_AllNodes[i].name
					})
				}
			}
		} else { // Adding parent nodes:
			nodesForSelect.push({
				id: util_AllNodes[i].id,
				text: util_AllNodes[i].name
			})
		}
	}
	nodesForSelect.sort(function(a,b) {return (a.text > b.text) ? 1 : ((b.text > a.text) ? -1 : 0);} );
	return nodesForSelect;
}
function provideCodesForSelect() {
	var codesForSelect = [];
	for (var i = 0; i < util_AllCodes.length; i++) {
		codesForSelect.push({
			id: util_AllCodes[i].id,
			text: util_AllCodes[i].name
		})
	}
	return codesForSelect;
}
function provideArtifactsForSelect() {
	var artifactsForSelect = [];
	for (var i = 0; i < util_AllArtifacts.length; i++) {
		artifactsForSelect.push({
			id: util_AllArtifacts[i].id,
			text: util_AllArtifacts[i].name
		})
	}
	return artifactsForSelect;
}

// *************** GETS ***************
function getNodeByID(nodeIDPassed) {
	for (var i = 0; i < util_AllNodes.length; i++) {
		if (util_AllNodes[i].id == nodeIDPassed) {
			return util_AllNodes[i];
		}
	}
	return {
		id: null,
		name: 'No Node Defined'
	};
}
function getArtifactByID(artifactIDPassed) {
	for (var i = 0; i < util_AllArtifacts.length; i++) {
		if (util_AllArtifacts[i].id == artifactIDPassed) {
			return util_AllArtifacts[i];
		}
	}
	return null;
}
function getCodeByID(codeIDPassed) {
	for (var i = 0; i < util_AllCodes.length; i++) {
		if (util_AllCodes[i].id == codeIDPassed) {
			return util_AllCodes[i];
		}
	}
	return null;
}

// *************** FILTERS ***************
function filter_FragmentsByCodes(codesArrayPassed, existingFragmentsPassed = util_AllFragments) {
	if (!codesArrayPassed) {
		return existingFragmentsPassed;
	}
	var fragmentsToReturn = [];
	codesArrayPassed = codesArrayPassed.map(Number);
	for (var i = 0; i < existingFragmentsPassed.length; i++) {
		var thisFragmentsCodes = existingFragmentsPassed[i].codes.split(',');
		for (var j = 0; j < thisFragmentsCodes.length; j++) {
			if (codesArrayPassed.indexOf(parseInt(thisFragmentsCodes[j])) > -1) {
				fragmentsToReturn.push(existingFragmentsPassed[i]);
				break;
			}
		}
	}
	return fragmentsToReturn;
}
function filter_FragmentsByNodeA(nodeAsArrayPassed, existingFragmentsPassed = util_AllFragments) {
	if (!nodeAsArrayPassed) {
		return existingFragmentsPassed;
	}
	var fragmentsToReturn = [];
	nodeAsArrayPassed = nodeAsArrayPassed.map(Number);
	for (var i = 0; i < existingFragmentsPassed.length; i++) {
		for (var k = 0; k < nodeAsArrayPassed.length; k++) {
			if (nodeAsArrayPassed[k] == existingFragmentsPassed[i].nodeA) {
				fragmentsToReturn.push(existingFragmentsPassed[i]);
				break;
			}
		}
	}
	return fragmentsToReturn;
}
function filter_FragmentsByNodeB(nodeBsArrayPassed, existingFragmentsPassed = util_AllFragments) {
	if (!nodeBsArrayPassed) {
		return existingFragmentsPassed;
	}
	var fragmentsToReturn = [];
	nodeBsArrayPassed = nodeBsArrayPassed.map(Number);
	for (var i = 0; i < existingFragmentsPassed.length; i++) {
		for (var k = 0; k < nodeBsArrayPassed.length; k++) {
			if (nodeBsArrayPassed[k] == existingFragmentsPassed[i].nodeB) {
				fragmentsToReturn.push(existingFragmentsPassed[i]);
				break;
			}
		}
	}
	return fragmentsToReturn;
}

// *************** UTILS ***************
function prettyEnglishListOfCodes(codesString) {
	var codesSplit = codesString.split(',');
	var codesPretty = '';
	for (var i = 0; i < codesSplit.length; i++) {
		var codeDetail = getCodeByID(codesSplit[i]);
		if (codesPretty.length > 1) {
			codesPretty += ', ';
		}
		if(codeDetail) {
			codesPretty += codeDetail.name;
		} else {
			codesPretty = '(No Code Applied)';
		}
	}
	return codesPretty;
}
function getFragmentTextByInlineIDAndArtifactID(inlineID, artifactID) {
	var artifactToParse = getArtifactByID(artifactID);
	var tempFragmentElement = $("<div></div>").html(artifactToParse.body);
	return tempFragmentElement.find('#' + inlineID).text();
}
function matrixMaker() {
	var matrix = {};
	for (var i = 0; i < util_AllNodes.length; i++) {
		matrix[util_AllNodes[i].id] = {};
		for (var w = 0; w < util_AllNodes.length; w++) {
			matrix[util_AllNodes[i].id][util_AllNodes[w].id] = {
				'positive': matrixMaker_Counter(util_AllNodes[i].id, util_AllNodes[w].id, 'positve'),
				'negative': matrixMaker_Counter(util_AllNodes[i].id, util_AllNodes[w].id, 'negative')
			}
		}
	}
	return matrix;
}
function matrixMaker_Counter(nodeAPassed, nodeBPassed, positiveNegative) {
	// console.log('matrixMaker_Counter is running with: ' + nodeAPassed + '<--a   b--> ' + nodeBPassed);
	var count = 0;
	var records = [];
	for (var i = 0; i < util_AllFragments.length; i++) {
		if (util_AllFragments[i].nodeA == nodeAPassed && 
			util_AllFragments[i].nodeB == nodeBPassed &&
			util_AllFragments[i].feeling == positiveNegative) {
			records.push(util_AllFragments[i]);
			count++;
		}
	}
	return {
		count: count,
		records: records
	};
}
function countCodeUsageInFragments(codesPassed, fragmentsPassed) {
	var codeUsageAcrossFragments = {};
	for (var i = 0; i < codesPassed.length; i++) {
		var countOfCode = 0;
		for (var j = 0; j < fragmentsPassed.length; j++) {
			if (fragmentsPassed[j].codes.indexOf(codesPassed[i].id) > -1) {
				countOfCode++;
			}
		}
		codeUsageAcrossFragments[codesPassed[i].id] = countOfCode;
	}
	return codeUsageAcrossFragments;
}
function countGlobalCodeUsageInArtifacts(codesPassed, artifactsPassed) {
	var codeUsageAcrossArtifacts = {};
	for (var i = 0; i < codesPassed.length; i++) {
		var countOfCode = 0;
		for (var j = 0; j < artifactsPassed.length; j++) {
			if (artifactsPassed[j].global_codes.indexOf(codesPassed[i].id) > -1) {
				countOfCode++;
			}
		}
		codeUsageAcrossArtifacts[codesPassed[i].id] = countOfCode;
		console.log(countOfCode);
	}
	console.log(codeUsageAcrossArtifacts);
	return codeUsageAcrossArtifacts;
}
function countCodeUsageInFragmentsByArtifact(codesPassed, fragmentsPassed) {
	var codeUsageAcrossFragments = {};
	for (var i = 0; i < codesPassed.length; i++) {
		var artifactsWithIt = [];
		for (var j = 0; j < fragmentsPassed.length; j++) {
			if (fragmentsPassed[j].codes.indexOf(codesPassed[i].id) > -1) {
				artifactsWithIt.push(fragmentsPassed[j].related_artifact);			}
		}
		artifactsWithIt = jQuery.uniqueSort(artifactsWithIt);
		codeUsageAcrossFragments[codesPassed[i].id] = artifactsWithIt.length;
	}
	return codeUsageAcrossFragments;
}





