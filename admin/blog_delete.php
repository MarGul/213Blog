<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\Auth;
    use Blog\Models\Blog;
    require_once('../Models/Auth.php');
    require_once('../Models/Blog.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    // Get the blogID, the action to be performed and if it's an AJAX request or not
    $intID     = (int)$_GET['blogID'];
    $boolAjax  = (bool)$_GET['ajax'];

    // Create the blog object
    $objBlog = new Blog($intID);

    // Delete the post
    $objBlog->remove();

    if(!$objBlog->error()) {
        if($boolAjax) {
            die(json_encode(array('success' => true)));
        } else {
            $strBlogURL = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1) . 'blog.php';
            header('Location: '. $strBlogURL);
        }
    }

    die(json_encode(array('success' => false)));