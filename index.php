<?php
    namespace Blog\Controllers;
    use Blog\Models\Blog;
    require_once('Models/Blog.php');

    // Grab all the posts
    $objBlog = new Blog();
    $arrPosts = $objBlog->getPosts();

    echo '<pre>';
    var_dump($arrPosts);

    // Load the view
    include('views/index.php');