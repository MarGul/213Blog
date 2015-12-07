<?php
namespace Blog\Models;
use \Blog\Models\Database;
require_once('Database.php');

class Subscribers extends Database {

    public function insertSubscriber($authorID, $email) {
        $this->insert('subscribers', array(
            'author'  => $authorID,
            'email'   => $email,
            'date'    => date('Y-m-d')
        ));

        return $this;
    }
}