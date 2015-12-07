<?php
    namespace Blog\Models;
    use \Blog\Models;
    require_once('Database.php');
    require_once('User.php');


    class Blog extends Database {

        private $_id;
        private $_title;
        private $_body;
        private $_status;
        private $_author;
        private $_tags;
        private $_comments;
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
         * Function for setting the tags
         *
         * @param $arrTags
         * @return $this
         */
        public function setTags($arrTags) {
            if(is_array($arrTags) && !empty($arrTags)) {
                $this->_tags = $arrTags;
            }

            return $this;
        }

        /**
         * Getters
         */
        public function getID() { return (!is_null($this->_id)) ? $this->_id : null; }
        public function getTitle() { return (!empty($this->_title)) ? $this->_title : ''; }
        public function getBody() { return (!empty($this->_body)) ? $this->_body : ''; }
        public function getStatus() { return (!empty($this->_status)) ? $this->_status : ''; }
        public function getAuthor() { return (!empty($this->_author)) ? $this->_author : ''; }
        public function getTags() { return (!empty($this->_tags)) ? $this->_tags : ''; }
        public function getTagsJSON() {
            $arrReturn = array();
            foreach ($this->_tags as $tag) {
                $arrReturn[] = $tag->name;
            }
            return json_encode($arrReturn);
        }
        public function getComments() { return (!empty($this->_comments)) ? $this->_comments : array(); }
        public function getModified() { return (!empty($this->_modified)) ? $this->_modified : ''; }
        public function getCreated() { return (!empty($this->_created)) ? $this->_created : ''; }

        /**
         * When you hit save it will either create a new blog post or if you passed in a ID to the constructor it will
         * update the blog post.
         */
        public function save() {
            if(is_null($this->_id)) {
                $this->_createBlog();
            } else {
                $this->_updateBlog();
            }
        }

        public function remove() {
            if(!is_null($this->_id)) {
                return $this->delete('blog', array('id', '=', $this->_id));
            }
        }

        /**
         * Static function for getting posts. If you pass in no parameter it will grab all the blog posts.
         */
        public function getPosts($args = array()) {

            $arrDefaults = array(
                'status' => '',
                'author' => '',
                'tag'    => ''
            );

            $args = array_merge($arrDefaults, $args);

            $arrValues = array();
            $strSQL = "SELECT id
                       FROM blog
                       WHERE status = ?";
            if(empty($args['status'])) {
                $arrValues[] = "published";
            } else {
                $arrValues[] = $args['status'];
            }

            if(!empty($args['author'])) {
                $strSQL .= ' AND author = ?';
                $arrValues[] = (int)$args['author'];
            }

            $strSQL .= ' ORDER BY created DESC';

            $arrPosts = $this->query($strSQL, $arrValues)->results();
            $arrReturn = array();
            foreach ($arrPosts as $post) {
                $arrReturn[] = new Blog((int)$post->id);
            }

            return $arrReturn;

        }

        private function _fetchBlog($intID) {
            // check to see if its a integer otherwise throw an exception
            if(!is_int($intID)) throw new \Exception('The blog ID needs to be of integer data type.');
            // Grab the data
            $objBlog = $this->get('blog', array('id', '=', $intID))->first_result();
            // Set the instance variables
            $this->_id          = $objBlog->id;
            $this->_title       = $objBlog->title;
            $this->_body        = $objBlog->body;
            $this->_author      = new User((int)$objBlog->author);
            $this->_tags        = $this->_fetchTags();
            $this->_comments    = $this->_fetchComments();
            $this->_status      = $objBlog->status;
            $this->_modified    = new \DateTime($objBlog->modified);
            $this->_created     = new \DateTime($objBlog->created);
        }

        /**
         * Private function for creating a blog post
         */
        private function _createBlog() {

            $this->insert('blog', array(
                'title'    => $this->_title,
                'body'     => $this->_body,
                'status'   => $this->_status,
                'author'   => $this->_author,
                'modified' => '',
                'created'  => date('Y-m-d H:i:s')
            ));

            if(!$this->error()) {
                $this->_id = $this->_pdo->lastInsertId();

                // Insert the tags
                $this->_createTags()->_setTags();
            }
        }

        /**
         * Function for updating the blog
         */
        private function _updateBlog() {
            $this->update('blog', $this->_id, array(
                'title'    => $this->_title,
                'body'     => $this->_body,
                'status'   => $this->_status,
                'modified' => date('Y-m-d H:i:s')
            ));

            if(!$this->error()) {
                $this->_createTags()->_setTags(true);
            }
        }

        /**
         * Function for inserting the tag names that does not exist in the database already
         *
         * @return $this
         */
        private function _createTags() {
            if(!empty($this->_tags)) {
                // Loop through the tags and insert then if they do not exist
                foreach ($this->_tags as $tag) {
                    $this->query("INSERT IGNORE INTO tags (name) VALUES ('".$tag."')");
                }
            }

            return $this;
        }

        /**
         * Function for setting the
         *
         * @return $this
         */
        private function _setTags($boolUpdate = false) {
            if(!empty($this->_tags)) {
                if($boolUpdate) {
                    // Clear the old tags first if we're updating.
                    $arrTags = $this->_fetchTags();
                    foreach ($arrTags as $tag) {
                        $this->query("DELETE FROM blog_tags WHERE blog_id = " . $this->_id . " AND tag_id = " . $tag->id);
                    }

                }

                // Get the SQL formatted
                $inSQL = '';
                foreach ($this->_tags as $key => $tag) {
                    $inSQL .= "'" . $tag . "'";
                    if($key != count($this->_tags) - 1) {
                        $inSQL .= ", ";
                    }
                }

                // Grab the tags data and set it
                $this->_tags = $this->query("SELECT * FROM tags WHERE name IN (" . $inSQL . ")")->results();

                // Loop through the tags and set the relationships
                foreach ($this->_tags as $tag) {
                    $this->insert('blog_tags', array(
                        'blog_id' => $this->_id,
                        'tag_id'  => $tag->id
                    ));
                }


            }
            return $this;
        }

        /**
         * Function for grabbing the tags set to a blog post
         *
         * @return mixed
         */
        private function _fetchTags() {
            if(!is_null($this->_id)) {
                return  $this->query("
                              SELECT t.id as id, name
                              FROM blog_tags bt, tags t
                              WHERE bt.blog_id = ". $this->_id ." AND
                                    bt.tag_id = t.id"
                        )->results();
            }
        }

        /**
         * Function for getting the comments for a blog post
         *
         * @return mixed
         */
        private function _fetchComments() {
            return $this->get('comments', array('blogID', '=', $this->_id))->results();
        }

        public function insertComment($strName, $strEmail, $strComment) {
            return $this->insert('comments', array(
                'blogID'  => $this->_id,
                'name'    => $strName,
                'email'   => $strEmail,
                'comment' => $strComment,
                'date'    => date('Y-m-d')
            ));
        }
    }