<?php
// echo 'top of index';
/*
 * This index file servers as a simple unified request
 * controller and route handler
 */


if(!file_exists("core/config.php")){
	header("Location: install/");
}

$base = dirname($_SERVER['PHP_SELF']);
$fullPagePath = substr($_SERVER['REQUEST_URI'], strlen($base)+1);
$pagePath = substr($_SERVER['REQUEST_URI'], strlen($base)+1);

include('core/config.php');

// Remove any URI variables
$pagePath = explode('?', $pagePath);
$pagePath = $pagePath[0];

// Trim any leading forward slash
$pagePath = trim($pagePath,"/");

if ( ! $pagePath )
{
	$pagePath = 'login';
}

$pageInclude = "page/$pagePath.php";

//Page not found and/or trying to hit API
if(!file_exists($pageInclude) || strpos($pageInclude, ".."))
{
	// if(strpos($pageInclude, 'api') !== false) {
	// 	// echo 'yes...';
	// 	// echo $fullPagePath;
	// 	// $pageInclude = 'page/' . $fullPagePath;
	// 	// echo $pageInclude;
	// 	// include_get($pageInclude);
	// 	$apiEndpointPass = $base . '/' . $fullPagePath;
	// 	echo $apiEndpointPass;
	// 	header("Location: " . $apiEndpointPass);
	// 	// header("Location: http://www.google.ca");
	// } else {
	// 	echo 'no file for this: ' . $pageInclude;
	// }
	send404();
}

$pageTitle = str_replace('/', ' ', $pagePath);
$pageTitle = ucfirst($pageTitle);

include 'page/header.php';
include $pageInclude;
include 'page/footer.php';