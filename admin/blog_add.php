<?php

    namespace Blog\Admin\Controllers;
    use Blog\Models\Auth;
    use Blog\Models\Blog;
    use Blog\Models\Uploads;
    require_once('../Models/Auth.php');
    require_once('../Models/Blog.php');
    require_once('../Models/Uploads.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    // Set up the default object
    $objData = new \stdClass;
    $objData->pageTitle  = 'Add New Blog Post';
    $objData->activeLink = 'blog';
    $objData->error      = false;
    $objData->errors     = array();
    $objData->input      = array();
    $objData->msg        = array();
    $objData->success    = null;

    // Get the uploads
    $objUploads = new Uploads();
    $objData->arrUploads = $objUploads->getUploads();

    // User posted the form
    if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $objData->input = $_POST;

        // Validate title
        if(empty(trim($objData->input['title']))) {
            $objData->error     = true;
            $objData->errors[]  = 'title';
            $objData->msg[]     = ' - A title is required for a new blog post';
        }

        // Validate body
        if(empty(trim($objData->input['body']))) {
            $objData->error     = true;
            $objData->errors[]  = 'body';
            $objData->msg[]     = ' - Content is required for a new blog post';
        }

        // Validate status
        if(empty(trim($objData->input['status']))) {
            $objData->error     = true;
            $objData->errors[]  = 'status';
            $objData->msg[]     = ' - A status is required for a new blog post';
        }

        // No errors then insert the blog post
        if(!$objData->error) {
            $objBlog = new Blog();
            try {
                $objBlog->setTitle(trim($objData->input['title']))
                        ->setBody(trim($objData->input['body']))
                        ->setTags(json_decode($objData->input['tags']))
                        ->setAuthor((int)$_SESSION['user_id'])
                        ->setImg(trim($objData->input['featuredImg']))
                        ->setStatus(trim($objData->input['status']))
                        ->save();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            if(!$objBlog->error()) {
                $objData->success = true;
                $objData->msg[]   = 'The blog post was successfully created.';
            }

        }
    }

    // Load the view
    include('/views/blog_add.php');
?>