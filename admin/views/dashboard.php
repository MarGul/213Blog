<?php include('views/admin_header.php') ?>

    <script type="text/javascript" src="JS/scripts.js"></script>

    <div class="container">
        <main class="page">

            <h2>
                Dashboard
            </h2>

            <div class="row">

                <div class="col-xs-12 col-sm-4">
                    <div class="dash-wrap posts">
                        <div class="dash-head">Latest Posts</div>
                        <div class="dash-content">
                            <ul class="list-unstyled">
                                <?php foreach ($objData->latestPosts as $post) { ?>
                                    <li><a href="blog_edit.php?blogID=<?php echo $post->getID(); ?>"><?php echo $post->getTitle(); ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <div class="dash-wrap comments">
                        <div class="dash-head">Latest Comments</div>
                        <div class="dash-content">
                            <ul class="list-unstyled">
                                <?php foreach ($objData->latestComments as $comment) { ?>
                                    <li>
                                        <strong>Name:</strong> <?php echo $comment->name; ?><br>
                                        <strong>Body:</strong> <?php echo (strlen($comment->comment) > 100) ? substr($comment->comment, 0, 100) .'...' : $comment->comment; ?><br>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <div class="dash-wrap subscribers">
                        <div class="dash-head">Latest Subscribers</div>
                        <div class="dash-content">
                            <ul class="list-unstyled">
                                <?php foreach ($objData->latestSubscribers as $subscriber) { ?>
                                    <li><a href="subscribers.php"><?php echo $subscriber['email']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

<?php include('views/admin_footer.php') ?>