<?php
	include("../core/config.php");
	

	//Process Update
	if(count($_POST)){
        /*
         * Covert POST into a Collection object
         * for better handling
         */
        $input = new \ptejada\uFlex\Collection($_POST);

		$res = $user->resetPassword($input->Email);

		$errorMessage = '';
		$confirmMessage = '';

		if($res){
			//Hash succesfully generated
			//You would send an email to $res['Email'] with the URL+HASH $res['hash'] to enter the new Password
			//In this demo we will just redirect the user directly
			
			$pwURL = 'https://echolyze.herokuapp.com/app/account/update/password?c=' . $res->Confirmation;
			$confirmMessage = "Use the link below to change your password <a href='{$pwURL}'>Change Password</a>";

			// echo $res->Email;
			// echo 'Requesting Password Reset...';
			// var_dump($res);

		$fromName = 'Echolyze';
		$fromEmail = 'Echolyze_NoReply@echolyze.com';


		//send grid to mail to recirpent 
		$url = 'https://api.sendgrid.com/';
		$user = 'phil@phileverson.com';
		$pass = 'John1993';

		$body = '<p>Please use the link below to reset your Echolyze account password.</p><h3>Account Details</h3><p>Email Address: ' . $res->Email . '</p><p>Password Reset Link: ' . $pwURL . '</p>';
		$subject = 'Echolyze Password Reset';


		

		$params = array(
		    'api_user'  => $user,
		    'api_key'   => $pass,
		    // 'x-smtpapi' => json_encode($json_string),
		    'to'        => $res->Email,
		    'subject'   => $subject,
		    'html'      => $body,
		    'text'      => $body,
		    'from'      => $fromEmail,
		  );

		$request =  $url.'api/mail.send.json';


		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		// obtain response
		$response = curl_exec($session);
		curl_close($session);

		// print everything out
		print_r($response);
		echo '</br></br><h1>Please check your email for a password reset link.</h1>';


		}else{
			$errorMessage = $user->log->getErrors();
			$errorMessage = $errorMessage[0];
		}

		echo json_encode(array(
			'error'    => $user->log->getErrors(),
			'confirm'  => $confirmMessage,
			'form'     => $user->log->getFormErrors(),
		));
	}