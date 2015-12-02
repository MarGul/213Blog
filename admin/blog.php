<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\Blog;
    use Blog\Models\Auth;
    require_once('../Models/Blog.php');
    require_once('../Models/Auth.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    // Create our return object
    $objData = new \stdClass;
    // Page title
    $objData->pageTitle  = 'Blog Posts';
    $objData->activeLink = 'blog';

    // Create the blog Model object
    $objBlog = new Blog();
    if(Auth::isAdmin()) {
        // If the user is an administrator then we should show them all the posts
        $objData->posts = $objBlog->getPosts();
    } else {
        // If the user is not an administrator only show the users posts.
        $objData->posts = $objBlog->getPosts(array('author' => Auth::authID()));
    }

    // Load the view
    include('views/blog.php');
?>