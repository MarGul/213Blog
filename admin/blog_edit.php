<?php
    namespace Blog\Admin\Controllers;
    use Blog\Models\Auth;
    use Blog\Models\Blog;
    require_once('../Models/Auth.php');
    require_once('../Models/Blog.php');

    // This will perform a check to see if the user is authenticated. If not it will redirect to the login page.
    Auth::isAuth();

    // Get the blog Id
    $intBlogID = (int)$_GET['blogID'];
    $objBlog   = new Blog($intBlogID);

    // Set up the default object
    $objData = new \stdClass;
    $objData->pageTitle  = 'Edit Blog Post';
    $objData->activeLink = 'blog';
    $objData->error      = false;
    $objData->errors     = array();
    $objData->input      = array(
        'title'   => $objBlog->getTitle(),
        'body'    => $objBlog->getBody(),
        'status'  => $objBlog->getStatus(),
        'tags'    => $objBlog->getTagsJSON(),
    );
    $objData->msg        = array();
    $objData->success    = null;

    // User posted the form
    if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $objData->input = $_POST;

        // Validate title
        if(empty(trim($objData->input['title']))) {
            $objData->error     = true;
            $objData->errors[]  = 'title';
            $objData->msg[]     = ' - A title is required for a blog post';
        }

        // Validate body
        if(empty(trim($objData->input['body']))) {
            $objData->error     = true;
            $objData->errors[]  = 'body';
            $objData->msg[]     = ' - Content is required for a blog post';
        }

        // Validate status
        if(empty(trim($objData->input['status']))) {
            $objData->error     = true;
            $objData->errors[]  = 'status';
            $objData->msg[]     = ' - A status is required for a blog post';
        }

        // No errors then insert the blog post
        if(!$objData->error) {
            try {
                $objBlog->setTitle(trim($objData->input['title']))
                        ->setBody(trim($objData->input['body']))
                        ->setAuthor((int)$_SESSION['user_id'])
                        ->setTags(json_decode($objData->input['tags']))
                        ->setStatus(trim($objData->input['status']))
                        ->save();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            if(!$objBlog->error()) {
                $objData->success = true;
                $objData->msg[]   = 'The blog post was successfully updated.';
            }

        }
    }

    // Load the view
    include('views/blog_edit.php');
?>