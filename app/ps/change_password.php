<?php
include('../core/config.php');

//Process Password change
if (count($_POST)) {
    /*
     * Covert POST into a Collection object
     * for better handling
     */
    $input = new \ptejada\uFlex\Collection($_POST);

    $hash = $input->c;

    if (!$user->isSigned() and $hash) {
        //Change Password with confirmation hash
        $user->newPassword(
            $hash,
            array(
                'Password'  => $input->Password,
                'Password2' => $input->Password2,
            )
        );
        $redirectPage = "login";
    } else {
        //Change the Password of signed in user without a confirmation hash
        $user->update(
            array(
                'Password'  => $input->Password,
                'Password2' => $input->Password2,
            )
        );
        $redirectPage = 'account';
    }

    $errors = $user->log->getAllErrors();
    if (count($errors) == 0) {
        redirect("../all-projects");
    }

    echo json_encode(
        array(
            'error'   => $user->log->getAllErrors(),
            'confirm' => 'Password Changed',
            'form'    => $user->log->getFormErrors(),
        )
    );
}