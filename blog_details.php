<?php

namespace Blog\Controllers;
use Blog\Models\Blog;
require_once('Models/Blog.php');

// Grab the ID
$intBlogID = (int)$_GET['id'];

// Handle inserting a comment
if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $blogID   = (int)$_POST['comment_blogid'];
    $strName  = $_POST['comment_name'];
    $strEmail = $_POST['comment_email'];
    $strBody  = $_POST['comment_body'];

    $blog = new Blog($blogID);
    $blog->insertComment($strName, $strEmail, $strBody);
}

// Create the blog object
$objBlog = new Blog($intBlogID);

// Load the view
include('views/blog_detail.php');