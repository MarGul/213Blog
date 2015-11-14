<?php
    namespace Blog\Models;
    require_once('Database.php');

    class Auth extends Database {

        /**
         * Function to log a user in
         *
         * @param $strEmail
         * @param $strPassword
         * @return bool
         */
        public static function login($strEmail, $strPassword) {
            session_start();

            // Get the database instance. Using singleton design pattern here.
            $objDB = parent::getInstance();
            // If it's not a valid email return false
            if(!filter_var($strEmail, FILTER_VALIDATE_EMAIL)) return false;
            // Get the user data
            $objUser = $objDB->get('users', array('email', '=', $strEmail));
            if($objUser->count()) {
                // The password algorithm is bcrypt so let's verify the hash.
                if(password_verify($strPassword, $objUser->first_result()->password)) {
                    // Set the session variables needed if the password was correct.
                    $_SESSION['user_id'] = $objUser->first_result()->id;
                    $_SESSION['isAdmin'] = (bool)$objUser->first_result()->admin;
                    return true;
                }
            }

            return false;
        }

        public static function logout() {
            session_unset();
            session_destroy();

            $strHomeURL = str_replace('/admin', '', substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1))  . 'index.php';
            header('Location: ' . $strHomeURL);
        }

        /**
         * Function to see if the user is authenticated. If not redirect to the log in page.
         */
        public static function isAuth() {
            session_start();

            if(!isset($_SESSION['user_id'])) {
                $strLoginURL = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1) . 'login.php';
                header('Location: ' . $strLoginURL);
            }
        }
    }