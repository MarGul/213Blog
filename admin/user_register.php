<?php  
	namespace Blog\Admin\Controllers;
	use Blog\Models\User;
	use Blog\Models\Auth;
	use Blog\Models\Uploads;
	require_once('../Models/User.php');
	require_once('../Models/Auth.php');
	require_once('../Models/Uploads.php');

	// This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
	Auth::isAuth();

	// Create our return object
	$objData = new \stdClass;
	// Page title
	$objData->pageTitle  = 'Add New User';
	$objData->activeLink = 'users';
	// Set up the default data for no warnings (this is when the user hasn't submitted the form).
	$objData->error 	= false;
	$objData->errors    = array();
	$objData->input 	= array(
		'usrEmail' 		=> '',
		'usrFirstName' 	=> '',
		'usrLastName' 	=> '',
		'usrWebsite'	=> '',
		'usrBio'        => '',
		'usrImage'      => ''
	);
	$objData->msg    	= array();
	$objData->success   = null;

	// Get the uploads
	$objUploads = new Uploads();
	$objData->arrUploads = $objUploads->getUploads();

	// Check to see if the form has been submitted
	if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {

		//-- Set the input --//
		$objData->input = array(
			'usrEmail' 			=> filter_input(INPUT_POST, 'usrEmail'),
			'usrFirstName' 		=> filter_input(INPUT_POST, 'usrFirstName'),
			'usrLastName' 		=> filter_input(INPUT_POST, 'usrLastName'),
			'usrWebsite' 		=> filter_input(INPUT_POST, 'usrWebsite'),
			'usrPassword' 		=> filter_input(INPUT_POST, 'usrPassword'),
			'usrPasswordRepeat' => filter_input(INPUT_POST, 'usrPasswordRepeat'),
			'usrBio'            => filter_input(INPUT_POST, 'usrBio'),
			'usrImage'          => filter_input(INPUT_POST, 'usrImage'),
			'usrRole' 			=> filter_input(INPUT_POST, 'usrRole')
		);

		//-- Validate input --//
		
		// Loop through the data and see so that all the required fields have input.
		foreach ($objData->input as $key => $input) {
			// Non required fields
			if(in_array($key, array('usrWebsite', 'usrRole', 'usrBio', 'usrImage'))) continue;

			if(empty($input)) {
				$objData->error    = true;
				$objData->errors[] = $key; 
			}
		}
		if($objData->error) $objData->msg[] = ' - Please fill in the fields with a red border. These are required fields';

		// If the email provided is not a valid email address
		if(!filter_var($objData->input['usrEmail'], FILTER_VALIDATE_EMAIL)) {
			$objData->error    = true;
			if(!in_array('usrEmail', $objData->errors)) $objData->errors[] = 'usrEmail';
			$objData->msg[]    = ' - Please provide a valid email address';
		}

		// If the passwords doesn't match
		if(!empty($objData->input['usrPassword']) && ($objData->input['usrPassword'] != $objData->input['usrPasswordRepeat'])) {
			$objData->error = true;
			if(!in_array('usrPassword', $objData->errors)) $objData->errors[] = 'usrPassword';
			if(!in_array('usrPasswordRepeat', $objData->errors)) $objData->errors[] = 'usrPasswordRepeat';
			$objData->msg[] = ' - Your passwords does not match.';
		}

		// Check to see if the email already exists.

		// If there is no errors then let's create the user
		if(!$objData->error) {
			$objUser = new User();
			// Using method chaining to set all the object variables and then save, which in this case will mean a new user.
			// The User model will throw errors if the input is wrong. It should be validated here but safety first.
			try {
				$objUser->setEmail($objData->input['usrEmail'])
						->setFirstName($objData->input['usrFirstName'])
						->setLastName($objData->input['usrLastName'])
						->setWebsite($objData->input['usrWebsite'])
						->setPassword($objData->input['usrPassword'])
						->setBio($objData->input['usrBio'])
						->setImage($objData->input['usrImage'])
						->setAdmin((bool)$objData->input['usrRole'])
						->save();
			} catch(\Exception $e) {
				die($e->getMessage());
			}

			// Let's see so the user was successfully inserted
			if(!$objUser->error()) {
				$objData->success = true;
				$objData->msg[]   = 'The user was successfully registered.';
			}
		}
	}

	// Load the view
	include('views/user_register.php');
?>