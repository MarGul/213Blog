<?php
    namespace Blog\Controllers;
    use Blog\Models\Blog;
    use Blog\Models\User;
    require_once('Models/Blog.php');
    require_once('Models/User.php');

    // Grab all the posts
    $objBlog  = new Blog();
    $arrPosts = $objBlog->getPosts();

    // Grab the users for the sidebar
    $objUser  = new User();
    $arrUsers = $objUser->fetchUsers();
    // Get the count
    $arrUserData = array();
    foreach ($arrUsers as $user) {
        $arrUserData[] = array(
            'id'    => $user->id,
            'name'  => $user->firstname . ' ' . $user->lastname,
            'count' => $objUser->getBlogCount($user->id)
        );
    }

    // Get tags for the tagcloud
    $arrTags = $objBlog->get('tags', array(1, '=', 1))->results();

    // Load the view
    include('views/index.php');