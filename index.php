<?php
    namespace Blog\Controllers;
    use Blog\Models\Blog;
    require_once('Models/Blog.php');

    // Grab all the posts
    $objBlog = new Blog();
    $arrPosts = $objBlog->getPosts();

    // Load the view
    include('views/index.php');