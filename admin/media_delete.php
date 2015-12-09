<?php
namespace Blog\Admin\Controllers;
use Blog\Models\Auth;
use Blog\Models\Uploads;
require_once('../Models/Auth.php');
require_once('../Models/Uploads.php');

// This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
Auth::isAuth();

// Grab the ID
$intID = (int)filter_input(INPUT_POST, 'id');

// Create upload object
$objUpload = new Uploads();

// Delete the upload. This is done by AJAX.
if($objUpload->deleteUpload($intID)) {
    echo json_encode(array('success' => true));
    die;
} else {
    echo json_encode(array('success' => false));
    die;
}
?>