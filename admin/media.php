<?php
namespace Blog\Admin\Controllers;
use Blog\Models\Auth;
use Blog\Models\Uploads;
require_once('../Models/Auth.php');
require_once('../Models/Uploads.php');

// This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
Auth::isAuth();

// Create our return object
$objData = new \stdClass;
// Page title
$objData->pageTitle  = 'Media';
$objData->activeLink = 'media';

$objUpload = new Uploads();
$uploadSuccess = null;
// Handle uploading of media
if(!empty($_FILES) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadSuccess = $objUpload->uploadMedia($_FILES['upload']);
}

// Grab all the uploads
$objData->arrUploads = $objUpload->getUploads();

// Load the view
include('views/media.php');
?>