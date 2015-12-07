<?php
namespace Blog\Admin\Controllers;
use Blog\Models\Subscribers;
use Blog\Models\Auth;
require_once('../Models/Subscribers.php');
require_once('../Models/Auth.php');

// This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
Auth::isAuth();

// Grab the ID
$intID = (int)filter_input(INPUT_POST, 'id');

// Create subscriber object
$objSubscriber = new Subscribers();

// Delete the user. This is done by AJAX.
$objSubscriber->delete('subscribers', array('id', '=', $intID));
if(!$objSubscriber->error()) {
    echo json_encode(array('success' => true));
    die;
} else {
    echo json_encode(array('success' => false));
    die;
}
