<?php
    use Blog\Models\Auth;;
    require_once('../Models/Auth.php');

    $objData = new stdClass;
    $objData->pageTitle = 'Admin Login';
    $objData->error     = false;

    // If the user has submitted the login form
    if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $strEmail    = filter_input(INPUT_POST, 'email');
        $strPassword = filter_input(INPUT_POST, 'password');

        if(Auth::login($strEmail, $strPassword)) {
            $strDashboardURL = str_replace('login.php', '', $_SERVER['HTTP_REFERER']) . 'dashboard.php';
            header('Location: ' .  $strDashboardURL);
        } else {
            $objData->error = true;
        }
    }

    // Load the login view
    include('views/login.php');