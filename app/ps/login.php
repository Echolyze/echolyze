<?php

include('../core/config.php');

//Process Login
if(count($_POST)){
    /*
     * Covert POST into a Collection object
     * for better value handling
     */
    $input = new \ptejada\uFlex\Collection($_POST);
    // var_dump($input);

	$user->login($input->username, $input->password, $input->auto);

	// echo $input->username . '</br></br>';

	$errMsg = '';

	if($user->log->hasError()){
		$errMsg = $user->log->getErrors();
		$errMsg = $errMsg[0];
	}

	$errors = $user->log->getErrors();
	if (count($errors) == 0) {
		redirect("../all-projects");
	}

	echo json_encode(array(
		'error'    => $user->log->getErrors(),
		'confirm'  => "You are now login as <b>$user->Username</b>",
		'form'     => $user->log->getFormErrors(),
	));
}

