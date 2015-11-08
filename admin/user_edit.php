<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\User;
    require_once('../Models/User.php');

    // Grab the user ID
    //$intUsrID = (int)filter_input(INPUT_GET, 'usrID');
    $intUsrID = 5;

    // Grab a user object with this data
    $objUser = new User($intUsrID);

    // Build up our data object
    $objData = new \stdClass;
    $objData->pageTitle  = 'Edit User';
    $objData->userExists = false;
    if($objUser->count()) {
        $objData->userExists = true;
        $objData->error      = false;
        $objData->errors     = array();
        $objData->msg        = array();
        $objData->success    = null;
        $objData->input      = array(
            'email'     => $objUser->getEmail(),
            'firstname' => $objUser->getFirstName(),
            'lastname'  => $objUser->getLastName(),
            'website'   => $objUser->getWebsite(),
            'admin'     => $objUser->isAdmin()
        );
    }

    // Form submitted
    if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Set the new input
        $objData->input['email']          = filter_input(INPUT_POST, 'usrEmail');
        $objData->input['firstname']      = filter_input(INPUT_POST, 'usrFirstName');
        $objData->input['lastname']       = filter_input(INPUT_POST, 'usrLastName');
        $objData->input['website']        = filter_input(INPUT_POST, 'usrWebsite');
        $objData->input['password']       = filter_input(INPUT_POST, 'usrPassword');
        $objData->input['passwordRepeat'] = filter_input(INPUT_POST, 'usrPasswordRepeat');
        $objData->input['admin']          = (bool)filter_input(INPUT_POST, 'usrRole');

        //-- Validate input --//

        // Loop through the data and see so that all the required fields have input.
        foreach ($objData->input as $key => $input) {
            // Non required fields
            if(in_array($key, array('website', 'admin', 'password', 'passwordRepeat'))) continue;

            if(empty($input)) {
                $objData->error    = true;
                $objData->errors[] = $key;
            }
        }
        if($objData->error) $objData->msg[] = ' - Please fill in the fields with a red border. These are required fields';

        // If the email provided is not a valid email address
        if(!filter_var($objData->input['email'], FILTER_VALIDATE_EMAIL)) {
            $objData->error    = true;
            if(!in_array('email', $objData->errors)) $objData->errors[] = 'email';
            $objData->msg[]    = ' - Please provide a valid email address';
        }

        // If the user has entered stuff in the password field it means they want to change their password. Otherwise disregard this field
        if(!empty($objData->input['password'])) {
            // Password and Password Repeat is the same
            if($objData->input['password'] != $objData->input['passwordRepeat']) {
                $objData->error    = true;
                $objData->errors[] = 'password';
                $objData->msg[]    = 'The password and the password repeat fields are not matching.';
            }
        }

        // Check to see so that the email doesn't exist. Don't regard your current email (if the user didn't change the email we don't want a error)

        // If there is no errors then let's update the user
        if(!$objData->error) {
            // Using method chaining to set all the object variables and then save, which in this case will mean a new user.
            // The User model will throw errors if the input is wrong. It should be validated here but safety first.
            try {
                $objUser->setEmail($objData->input['email'])
                        ->setFirstName($objData->input['firstname'])
                        ->setLastName($objData->input['lastname'])
                        ->setWebsite($objData->input['website'])
                        ->setPassword($objData->input['password'])
                        ->setAdmin((bool)$objData->input['admin'])
                        ->save();
            } catch(\Exception $e) {
                die($e->getMessage());
            }

            // Let's see so the user was successfully inserted
            if(!$objUser->error()) {
                $objData->success = true;
                $objData->msg[]   = 'The user was successfully updated.';
            }
        }

    }

    echo '<pre>';
    var_dump($objData);
    echo '</pre>';


    include('views/user_edit.php');