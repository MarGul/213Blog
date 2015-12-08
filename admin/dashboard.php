<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\Auth;
    use Blog\Models\Blog;
    use Blog\Models\Subscribers;
    require_once('../Models/Auth.php');
    require_once('../Models/Blog.php');
    require_once('../Models/Subscribers.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    $objData = new \stdClass;
    $objData->pageTitle  = 'Dashboard';
    $objData->activeLink = 'dash';
    $objBlog = new Blog();

    if(!Auth::isAdmin()) {
        // If the user is an administrator we should show data for all users.
        // The latest posts
        $arrLatestPosts = $objBlog->getPosts();
        // Only get the 5 newest ones
        if(count($arrLatestPosts) > 5) {
            $objData->latestPosts = array_slice($arrLatestPosts, 0, 5, true);
        } else {
            $objData->latestPosts = $arrLatestPosts;
        }

        // The latest comments
        $arrLatestComments = $objBlog->query("SELECT * FROM comments ORDER BY date DESC")->results();
        if(count($arrLatestComments) > 5) {
            $objData->latestComments = array_slice($arrLatestComments, 0, 5);
        } else {
            $objData->latestComments = $arrLatestComments;
        }

        // Get the latest subscribers
        $objSubscribers = new Subscribers();
        $arrLatestSubscribers = $objSubscribers->getSubscribers();
        if(count($arrLatestSubscribers) > 5) {
            $objData->latestSubscribers = array_slice($arrLatestSubscribers, 0, 5);
        } else {
            $objData->latestSubscribers = $arrLatestSubscribers;
        }

    } else {
        // If the user is a regular Author we should show his specific data.
        // The latest posts
        $arrLatestPosts = $objBlog->getPosts(array('author', '=', Auth::authID()));
        // Only get the 5 newest ones
        if(count($arrLatestPosts) > 5) {
            $objData->latestPosts = array_slice($arrLatestPosts, 0, 5, true);
        } else {
            $objData->latestPosts = $arrLatestPosts;
        }

        // The latest comments
        $arrLatestComments = $objBlog->query("SELECT c.* FROM comments c, blog b WHERE b.author = " . Auth::authID() . " AND b.id = c.blogID ORDER BY date DESC")->results();
        if(count($arrLatestComments) > 5) {
            $objData->latestComments = array_slice($arrLatestComments, 0, 5);
        } else {
            $objData->latestComments = $arrLatestComments;
        }

        // Get the latest subscribers
        $objSubscribers = new Subscribers();
        $arrLatestSubscribers = $objSubscribers->getSubscribers(Auth::authID());
        if(count($arrLatestSubscribers) > 5) {
            $objData->latestSubscribers = array_slice($arrLatestSubscribers, 0, 5);
        } else {
            $objData->latestSubscribers = $arrLatestSubscribers;
        }
    }

    // Load the dashboard view
    include('views/dashboard.php');