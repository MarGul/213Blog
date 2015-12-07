<?php
namespace Blog\Models;
use \Blog\Models\User;
require_once('Database.php');
require_once('User.php');


class Subscribers extends Database {

    /**
     * Function for inserting a subscriber
     *
     * @param $authorID
     * @param $email
     * @return $this
     */
    public function insertSubscriber($authorID, $email) {
        $this->insert('subscribers', array(
            'author'  => $authorID,
            'email'   => $email,
            'date'    => date('Y-m-d')
        ));

        return $this;
    }

    /**
     * Function for getting all subscribers or a subscriber for a specific author
     *
     * @param null $authorID
     * @return mixed
     */
    public function getSubscribers($authorID = null) {
        $arrSubscribers = array();
        $arrReturn      = array();

        if(is_null($authorID)) {
            $arrSubscribers =  $this->get('subscribers', array(1, '=', 1))->results();
        } else {
            $arrSubscribers = $this->get('subscribers', array('author', '=', (int)$authorID))->results();
        }

        foreach ($arrSubscribers as $subscriber) {
            $arrReturn[] = array(
                'id'     => $subscriber->id,
                'author' => new User((int)$subscriber->author),
                'email'  => $subscriber->email
            );
        }

        return $arrReturn;
    }
}