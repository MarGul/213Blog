<?php
    namespace Blog\Models;
    require_once('Database.php');


    class Blog extends Database {

        private $_id;
        private $_title;
        private $_body;
        private $_status;
        private $_author;
        private $_modified;
        private $_created;

        /**
         * Constructor
         *
         * @param null $blogID
         */
        public function __construct($blogID = null) {
            parent::__construct();

            if(!is_null($blogID)) {
                $this->_fetchBlog($blogID);
            } else {
                $this->_id = null;
            }
        }

        /**
         * Function for setting the title
         *
         * @param $strTitle
         * @return $this
         * @throws \Exception
         */
        public function setTitle($strTitle) {
            if(is_string($strTitle)) {
                $this->_title = $strTitle;
            } else {
                throw new \Exception('A blog entry needs a title');
            }
            return $this;
        }

        /**
         * Function for setting the body
         *
         * @param $strBody
         * @return $this
         * @throws \Exception
         */
        public function setBody($strBody) {
            if(is_string($strBody)) {
                $this->_body = $strBody;
            } else {
                throw new \Exception('A blog entry needs content');
            }
            return $this;
        }

        /**
         * Function for setting the status
         *
         * @param $strStatus
         * @return $this
         * @throws \Exception
         */
        public function setStatus($strStatus) {
            if(is_string($strStatus)) {
                $this->_status = $strStatus;
            } else {
                throw new \Exception('A blog entry needs a status');
            }
            return $this;
        }

        /**
         * Function for setting the author
         *
         * @param $intUserID
         * @return $this
         * @throws \Exception
         */
        public function setAuthor($intUserID) {
            if(is_int($intUserID)) {
                $this->_author = $intUserID;
            } else {
                throw new \Exception('A blog entry needs a author');
            }
            return $this;
        }

        /**
         * Getters
         */
        public function getTitle() { return (!empty($this->_title)) ? $this->_title : ''; }
        public function getBody() { return (!empty($this->_body)) ? $this->_body : ''; }
        public function getStatus() { return (!empty($this->_status)) ? $this->_status : ''; }
        public function getAuthor() { return (!empty($this->_author)) ? $this->_author : ''; }
        public function getModified() { return (!empty($this->_modified)) ? $this->_modified : ''; }
        public function getCreated() { return (!empty($this->_created)) ? $this->_created : ''; }

        public function save() {
            if(is_null($this->_id)) {
                $this->_createBlog();
            } else {
                $this->_updateBlog();
            }
        }

        private function _createBlog() {
            $this->insert('blog', array(
                'title'    => $this->_title,
                'body'     => $this->_body,
                'status'   => $this->_status,
                'author'   => $this->_author,
                'modified' => '',
                'created'  => date('Y-m-d H:i:s')
            ));
        }
    }