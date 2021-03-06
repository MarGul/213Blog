<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>mBlog</title>

    <!-- Pull in Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Pull in font awesome-->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Pull in our styles-->
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <!-- Pull in OpenSans-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <!-- Pull in jQuery and Bootstrap JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="page">
        <header>
            <div id="slideshow" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="//localhost/dev/213Blog/uploads/slide1.jpg" alt="...">
                    </div>
                    <div class="item">
                        <img src="//localhost/dev/213Blog/uploads/slide2.jpg" alt="...">
                    </div>
                    <div class="item">
                        <img src="//localhost/dev/213Blog/uploads/slide3.jpg" alt="...">
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#slideshow" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#slideshow" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </header>