<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\User;
    require_once('../Models/User.php');

    // Grab the ID
    $intUsrID = (int)filter_input(INPUT_POST, 'usrID');

    // Set the user
    $objUser = new User($intUsrID);

    // Delete the user. This is done by AJAX.
    $objUser->delete('users', array('id', '=', $intUsrID));
    if(!$objUser->error()) {
        echo json_encode(array('success' => true));
        die;
    } else {
        echo json_encode(array('success' => false));
        die;
    }
