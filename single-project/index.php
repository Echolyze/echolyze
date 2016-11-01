<?php include '../includes/header.php'; ?>
<?php include '../includes/leftnav.php'; ?>

<?php 

// Where are we trying to be routed to?
$projectID = $_GET['projectID'];
$destination = $_GET['destination'];

$destinationPageName = 'Home';
$destinationInclude = '';

if ($destination == 'nodes') {
	$destinationPageName = "Manage Nodes";
	$destinationInclude = 'nodes.php';
} else if ($destination == 'codes') {
	$destinationPageName = "Manage Codes";
	$destinationInclude = 'codes.php';
} else if ($destination == 'artifacts') {
	$destinationPageName = "Manage Artifacts";
	$destinationInclude = 'artifacts.php';
} else if ($destination == 'artifacts-single') {
	$destinationPageName = "Manage Artifacts";
	$destinationInclude = 'artifacts-single.php';
}

?>

<div class="content-wrapper">
	<section class="content-header">
		<h1 class="col-xs-12 omega single-project-name"></h1>
		<h2 class="col-xs-12 omega subheader-pe"><?php echo $destinationPageName ?></h2>
		<!-- <div class="col-xs-6 alpha">
			<button id="addProjectCTA" type="button" class="btn btn-primary pull-right">Add Project</button>
		</div> -->
	</section>
	<section class="content">
	<?php include $destinationInclude; ?>
	</section>
</div>

<?php include '../includes/footer.php'; ?>

<script type="text/javascript">
	// Elements:
	var singleProjectName = $('.single-project-name');

	// Data:
	var basicProjectDetails = [];
	
	// *************** Basic Project Details ***************
	$.get("/api/standard.php/projects/" + gup('projectID'), function(data) {
		basicProjectDetails = data;
		singleProjectName.text(basicProjectDetails.name);
	});

</script>