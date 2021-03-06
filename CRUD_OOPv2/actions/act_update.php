<?php
include_once '../classes/sessions.php';
include_once "../classes/constants.php";

// instantiate user object
include_once '../classes/user.php';
include_once '../classes/database.php';
include_once '../initial.php';


// check if the form is submitted

if ($_POST) {

    // isset() is a PHP function used to verify if ID is there or not
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR! ID not found!');
    // instantiate user object
    $user = new User($db);
    $user->id = $id;



    $user = new User($db);
    $session = new session_data();

    // set user property values
    $user->firstname = htmlentities(trim($_POST['firstname']));
    $user->lastname = htmlentities(trim($_POST['lastname']));
    $user->email = htmlentities(trim($_POST['email']));
    $user->mobile = htmlentities(trim($_POST['mobile']));

    // check and print msg ...
    if ($user->update()) {
        $session->set("err_code", true);
    } else {
        $session->set("err_code", false);
    }

    header("location:../index.php");
    exit();
}