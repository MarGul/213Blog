<?php

    namespace Blog\Admin\Controllers;
    use Blog\Models\Auth;
    require_once('../Models/Auth.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    $objData = new \stdClass;
    $objData->pageTitle  = 'Add New Blog Post';
    $objData->activeLink = 'blog';


    // Load the view
    include('/views/blog_add.php');
?>