<?php
namespace Blog\Models;
require_once('Database.php');

class Uploads extends Database {

    /**
     * Function for uploading a file
     *
     * @param $arrFile
     * @return bool
     */
    public function uploadMedia($arrFile) {
        if(!empty($arrFile)) {
            if($arrFile['error'] == 0) {
                $uploadsDir = str_replace('/admin/media.php', '/uploads/', $_SERVER['SCRIPT_FILENAME']);
                $uploadFile = $uploadsDir . basename($arrFile['name']);
                $uploadURL  = 'http://localhost/dev/213Blog/uploads/'.$arrFile['name'];

                if (move_uploaded_file($arrFile['tmp_name'], $uploadFile)) {
                    // File successfully uploaded. Insert into db.
                    $this->insert('uploads', array(
                        'path' => $uploadFile,
                        'url'  => $uploadURL
                    ));

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

    /**
     * Function to grab all the uploads
     *
     * @return mixed
     */
    public function getUploads() {
        return $this->get('uploads', array(1, '=', 1))->results();
    }

    /**
     * Function for deleting a upload
     *
     * @param $intID
     * @return bool
     */
    public function deleteUpload($intID) {
        if(is_integer($intID)) {
            $objData = $this->get('uploads', array('id', '=', $intID))->first_result();

            if(unlink($objData->path)) {
                $this->delete('uploads', array('id', '=', $intID));

                if(!$this->error()) {
                    return true;
                }
            }
        }

        return false;
    }
}