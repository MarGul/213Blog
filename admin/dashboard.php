<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\Auth;
    require_once('../Models/Auth.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    $objData = new \stdClass;
    $objData->pageTitle  = 'Dashboard';
    $objData->activeLink = 'dash';

    // Load the dashboard view
    include('views/dashboard.php');