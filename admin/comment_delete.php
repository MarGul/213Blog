<?php
namespace Blog\Admin\Controllers;
use Blog\Models\Blog;
use Blog\Models\Auth;
require_once('../Models/Blog.php');
require_once('../Models/Auth.php');

// This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
Auth::isAuth();

// Grab the ID
$intID = (int)filter_input(INPUT_POST, 'id');

// Create subscriber object
$objBlog = new Blog();

// Delete the user. This is done by AJAX.
$objBlog->delete('comments', array('id', '=', $intID));
if(!$objBlog->error()) {
    echo json_encode(array('success' => true));
    die;
} else {
    echo json_encode(array('success' => false));
    die;
}