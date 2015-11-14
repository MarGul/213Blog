<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\User;
    use Blog\Models\Auth;
    require_once('../Models/User.php');
    require_once('../Models/Auth.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    // Create a user object so we can fetch all users
    $objUser = new User();

    $objData = new \stdClass;
    $objData->pageTitle  = 'Users';
    $objData->activeLink = 'users';
    $objData->users      = $objUser->fetchUsers();

    // Load the view
    include('views/users.php');
