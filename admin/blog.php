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
        $objData->posts = $objBlog->getPosts();
    } else {
        $objData->posts = $objBlog->getPosts(array('user' => Auth::authID()));
    }

    echo '<pre>';
    var_dump($objData->posts);
    echo '</pre>';

    // Load the view
    include('views/blog.php');
?>