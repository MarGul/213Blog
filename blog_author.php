<?php
namespace Blog\Controllers;
use Blog\Models\Blog;
use Blog\Models\User;
use Blog\Models\Subscribers;
require_once('Models/Blog.php');
require_once('Models/User.php');
require_once('Models/Subscribers.php');

// Grab the author
$intAuthor = (int)$_GET['id'];
$objUser   = new User($intAuthor);

// Grab all the posts
$objBlog  = new Blog();
$arrPosts = $objBlog->getPosts(array('author' => $intAuthor));

// Handle a subscription
$subscriberSuccess = false;
if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $authorID = (int)$_POST['subscribe_author'];
    $subscribeEmail = $_POST['subscribe_email'];

    $objSubscriber = new Subscribers();
    $objSubscriber->insertSubscriber($authorID, $subscribeEmail);

    if(!$objSubscriber->error()) {
        $subscriberSuccess = true;
    }
}

// Load the view
include('views/blog_author.php');