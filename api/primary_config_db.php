<?php
header('Content-Type: application/json');

if(file_exists("../echolyze_user_config.php")) {
	include('../echolyze_user_config.php');

} else {
	$db_host = getenv('DB_HOST');
	$db_username = getenv('DB_USERNAME');
	$db_password = getenv('DB_PASSWORD');
	$db_name = getenv('DB_NAME');
}
?>

