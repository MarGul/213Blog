<?php
namespace Blog\Models;
require_once('Database.php');

class Uploads extends Database {

    public function uploadMedia($arrFile) {
        if(!empty($arrFile)) {
            if($arrFile['error'] == 0) {
                $uploadsDir = str_replace('/admin/media.php', '/uploads/', $_SERVER['SCRIPT_FILENAME']);
                $uploadFile = $uploadsDir . basename($arrFile['name']);

                if (move_uploaded_file($arrFile['tmp_name'], $uploadFile)) {
                    // File successfully uploaded. Insert into db.
                    $this->insert('uploads', array('path' => $uploadFile));

                    if(!$this->error()) {
                        return true;
                    }

                } else {
                    return false;
                }
            }
        }

        return false;
    }
}