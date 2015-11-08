<?php
namespace Blog\Models;
require_once('Database.php');

    class User extends Database {
        private $_id;
        private $_email;
        private $_password;
        private $_fname;
        private $_lname;
        private $_website;
        private $_admin;
        private $_created;

        public function __construct($usrID = null) {
            parent::__construct();

            if(!is_null($usrID)) {
                $this->_fetchUser($usrID);
            } else {
                $this->_id = null;
            }
        }

        public function setEmail($strEmail) {
            if(filter_var($strEmail, FILTER_VALIDATE_EMAIL)) {
                $this->_email = $strEmail;
            } else {
                throw new \Exception('The user needs to provide a valid email. Make sure to check for that first.');
            }
            return $this;
        }

        public function setFirstName($strFname) {
            if(is_string($strFname)) {
                $this->_fname = $strFname;
            } else {
                throw new \Exception('The first name property needs to be of string data type.');
            }
            return $this;
        }

        public function setLastName($strLname) {
            if(is_string($strLname)) {
                $this->_lname = $strLname;
            } else {
                throw new \Exception('The last name property needs to be of string data type.');
            }

            return $this;
        }

        public function setWebsite($strWeb) {
            if(is_string($strWeb)) {
                $this->_website = $strWeb;
            } else {
                throw new \Exception('The website property needs to be of string data type.');
            }

            return $this;
        }

        public function setPassword($strPassword) {
            if(is_string($strPassword)) {
                $this->_password = $strPassword;
            } else {
                throw new \Exception('The password property needs to be of string data type.');
            }

            return $this;
        }

        public function setAdmin($bolAdmin) {
            if(is_bool($bolAdmin)) {
                $this->_admin = $bolAdmin;
            } else {
                throw new \Exception('The admin property needs to be of boolean data type.');
            }

            return $this;
        }

        public function getEmail() { return (!empty($this->_email)) ? $this->_email : ''; }
        public function getFirstName() { return (!empty($this->_fname)) ? $this->_fname : ''; }
        public function getLastName() { return (!empty($this->_lname)) ? $this->_lname : ''; }
        public function getWebsite() { return (!empty($this->_website)) ? $this->_website : ''; }
        public function isAdmin() { return $this->_admin; }

        public function save() {
            if(is_null($this->_id)) {
                $this->_createUser();
            } else {
                $this->_updateUser();
            }
        }

        public static function emailExists($strEmail) {
            // Grab the database instance.

            // Code for checking email

            return false;
        }

        private function _fetchUser($intID) {
            // check to see if its a integer otherwise throw an exception
            if(!is_int($intID)) throw new \Exception('The user ID needs to be of integer data type.');
            // Grab the data
            $objUser = $this->get('users', array('id', '=', $intID))->first_result();
            // Set the instance variables
            $this->_id          = $objUser->id;
            $this->_email       = $objUser->email;
            $this->_fname       = $objUser->firstname;
            $this->_lname       = $objUser->lastname;
            $this->_website     = $objUser->website;
            $this->_admin       = (bool)$objUser->admin;
            $this->_created     = new \DateTime($objUser->created);
        }

        private function _createUser() {
            $this->insert('users', array(
                'email'     => $this->_email,
                'password'  => password_hash($this->_password, PASSWORD_DEFAULT, array('cost' => 12)),
                'firstname' => $this->_fname,
                'lastname'  => $this->_lname,
                'website'   => $this->_website,
                'created'   => date('Y-m-d H:i:s')
            ));
        }

        private function _updateUser() {
            $arrUpdate = array(
                'email'     => $this->_email,
                'firstname' => $this->_fname,
                'lastname'  => $this->_lname,
                'website'   => $this->_website,
                'admin'     => $this->_admin
            );
            if(!empty($this->_password)) {
                $arrUpdate['password'] = password_hash($this->_password, PASSWORD_DEFAULT, array('cost' => 12));
            }

            $this->update('users', $this->_id, $arrUpdate);
        }

    }