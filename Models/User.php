<?php

    class User extends Database {
        private $_id;
        private $_email;
        private $_fname;
        private $_lname;
        private $_website;
        private $_admin;

        public function __construct($usrID = null) {
            if(!is_null($usrID)) {
                $this->_fetchUser($usrID);
            }
        }

        public function setEmail($strEmail) {

            return $this;
        }

        public function setFirstName($strFname) {
            if(is_string($strFname)) {
                $this->_fname = $strFname;
            } else {
                throw new Exception('The first name property needs to be of string data type.');
            }
            return $this;
        }

        public function setLastName($strLname) {
            if(is_string($strLname)) {
                $this->_lname = $strLname;
            } else {
                throw new Exception('The last name property needs to be of string data type.');
            }

            return $this;
        }

        public function setWebsite($strWeb) {
            if(is_string($strWeb)) {
                $this->_website = $strWeb;
            } else {
                throw new Exception('The website property needs to be of string data type.');
            }

            return $this;
        }

        public function setAdmin($bolAdmin) {
            if(is_bool($bolAdmin)) {
                $this->_amdmin = $bolAdmin;
            } else {
                throw new Exception('The admin property needs to be of boolean data type.');
            }

            return $this;
        }

        public function getEmail() { return (!empty($this->_email)) ? $this->_email : ''; }
        public function getFirstName() { return (!empty($this->_fname)) ? $this->_fname : ''; }
        public function getLastName() { return (!empty($this->_lname)) ? $this->_lname : ''; }
        public function getWebsite() { return (!empty($this->_website)) ? $this->_website : ''; }

        public function isAdmin() {
            return $this->_admin;
        }

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

            // Grab the data and set the instance variables.
        }

        private function _createUser() {

        }

        private function _updateUser() {

        }

    }