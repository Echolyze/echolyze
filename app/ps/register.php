<?php
include('../core/config.php');
include('../core/validations.php');

//Process Registration
if (count($_POST)) {
    /*
     * Covert POST into a Collection object
     * for better values handling
     */
    $input = new \ptejada\uFlex\Collection($_POST);

    /*
     * If the form fields names match your DB columns then you can reduce the collection
     * to only those expected fields using the filter() function
     */
    // $input->filter('Username', 'first_name', 'last_name', 'Email', 'Password', 'Password2', 'website', 'GroupID');
    $input->filter('Username', 'first_name', 'last_name', 'Email', 'Password', 'GroupID');


    /*
     * Register the user
     * The register method takes either an array or a Collection
     */
    $user->register($input);

    $errors = $user->log->getErrors();
    if (count($errors) == 0) {
        echo '<script>alert("Successfully Registered. You will now be redirected to login.")</script>';
        redirect("../all-projects");
    }


    // echo json_encode(
    //     array(
    //         'error'   => $user->log->getErrors(),
    //         'confirm' => 'User Registered Successfully. You may login now!',
    //         'form'    => $user->log->getFormErrors(),
    //     )
    // );
}