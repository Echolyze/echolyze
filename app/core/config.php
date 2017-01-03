<?php


// include ROOT . 'primary_config.php';
include('primary_config_two.php');

include('inc/functions.php');
include('autoload.php');
// include(dirname(__FILE__) .'/../../../lib/uFlex/autoload.php');

//Instantiate the uFlex User object
$user = new \ptejada\uFlex\User();

//Add database credentials and information
    $user->config->database->host = $db_host;
    $user->config->database->user = $db_username;
    $user->config->database->password = $db_password;
    $user->config->database->name = $db_name; //Database name
    // var_dump($user->config->database);
/*
 * Instead of editing the Class files directly you may make
 * the changes in this space before calling the ->start() method.
 * For example: if we want to change the default Username from "Guess"
 * to "Stranger" you do this:
 * 'userTableName'   => 'users',
 * $user->config->userTableName = 'users';
 *
 * You may change and customize all the options and configurations like
 * this, even the error messages. By exporting your customizations outside
 * the class file it will be easier to maintain your application configuration
 * and update the class core itself in the future.
 */
 $user->config->userTableName = 'users';
 $user->addValidation(
    array(
        'first_name' => array(
            'limit' => '0-15',
            'regEx' => '/\w+/'
        ),
        'last_name'  => array(
            'limit' => '0-15',
            'regEx' => '/\w+/'
        ),
        'Username' => array(
            'limit' => '0-100'
            )
    )
);

//Starts the object by triggering the constructor
$user->start();

