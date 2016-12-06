<?php
	//If user is not signed in refirect
	if(!$user->isSigned()) redirect("../login");
	echo '<script>console.log("auth is checked, good to go!");</script>';

	include 'app-includes/header.php';
	include 'app-includes/leftnav.php';
?>

<?php 
// Where are we trying to be routed to?
$projectID = $_GET['projectID'];
$destination = $_GET['destination'];

$destinationPageName = 'Project Dashboard';
$destinationInclude = 'single-project-home.php';

if ($destination == 'nodes') {
	$destinationPageName = "Manage Nodes";
	$destinationInclude = 'single-project-nodes.php';
} else if ($destination == 'codes') {
	$destinationPageName = "Manage Codes";
	$destinationInclude = 'single-project-codes.php';
} else if ($destination == 'reporting') {
	$destinationPageName = "Reporting";
	$destinationInclude = 'single-project-reporting.php';
} else if ($destination == 'artifacts') {
	$destinationPageName = "Manage Artifacts";
	$destinationInclude = 'single-project-artifacts.php';
} else if ($destination == 'artifacts-single') {
	$destinationPageName = "Manage Artifacts";
	$destinationInclude = 'single-project-artifacts-single.php';
}
?>

<div class="content-wrapper">
	<?php include 'app-includes/global_loading.php'; ?>
	<section class="content-header hidden">
		<h1 class="col-xs-12 omega single-project-name"></h1>
		<h2 class="col-xs-12 omega subheader-pe"><?php echo $destinationPageName ?></h2>
	</section>
	<section class="content hidden">
	<?php include $destinationInclude; ?>
	</section>
</div>

<?php include '../includes/footer.php'; ?>