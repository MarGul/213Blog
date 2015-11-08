<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\User;
    require_once('../Models/User.php');

    // Create a user object so we can fetch all users
    $objUser = new User();

    $objData = new \stdClass;
    $objData->pageTitle = 'Users';
    $objData->users     = $objUser->fetchUsers();

    // Load the view
    include('views/users.php');
