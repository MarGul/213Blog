<?php
namespace Blog\Admin\Controllers;
use Blog\Models\Subscribers;
use Blog\Models\Auth;
require_once('../Models/Subscribers.php');
require_once('../Models/Auth.php');

// This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
Auth::isAuth();

// Create our return object
$objData = new \stdClass;
// Page title
$objData->pageTitle  = 'Subscribers';
$objData->activeLink = 'subscribers';

// Create the blog Model object
$objSubscriber = new Subscribers();
if(Auth::isAdmin()) {
    // If the user is an administrator then we should show them all the subscribers
    $objData->subscribers = $objSubscriber->getSubscribers();
} else {
    // If the user is not an administrator only show the users subscribers.
    $objData->subscribers = $objSubscriber->getSubscribers(Auth::authID());
}

// Load the view
include('views/subscribers.php');