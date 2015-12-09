<?php include('header.php'); ?>

    <main role="main">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <section class="content">

                    <h1 class="title"><?php echo $objBlog->getTitle(); ?></h1>
                    <div class="details-wrap">
                        <ul class="list-inline">
                            <li><i class="fa fa-clock-o"></i> <?php echo $objBlog->getCreated()->format('F jS, Y'); ?></li>
                            <li><i class="fa fa-user"></i> <?php echo $objBlog->getAuthor()->getFirstname() . ' ' . $objBlog->getAuthor()->getLastname(); ?></li>
                            <li>
                                <?php
                                if(!empty($objBlog->getTags())) {
                                    echo '<i class="fa fa-tags"></i>';
                                    foreach ($objBlog->getTags() as $tag) {
                                        echo '<a href="blog_tag.php?id=<?php echo $tag->id; ?>">#<?php echo $tag->name; ?></a>';
                                    }
                                }   ?>
                            </li>
                        </ul>
                    </div>

                    <div class="details-content clearfix">
                        <img src="<?php echo (!empty($objBlog->getImg())) ? $objBlog->getImg() : '//placehold.it/230x255'; ?>" alt="<?php echo $objBlog->getTitle(); ?>">
                        <?php echo nl2br($objBlog->getBody()); ?>
                    </div>

                    <hr>

                    <?php
                    if(!empty($objBlog->getComments())) {
                        foreach ($objBlog->getComments() as $comment) {
                            include('partials/comment.php');
                        }
                    }
                    ?>

                    <div class="insert-comment clearfix">
                        <h3>Insert Comment</h3>
                        <form action="" method="POST">
                            <input type="hidden" name="comment_blogid" value="<?php echo (int)$_GET['id']; ?>">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="comment_name" placeholder="Name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="comment_email" placeholder="Email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <textarea name="comment_body" class="form-control" placeholder="Comment" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="pull-right btn btn-link" value="Insert">
                        </form>
                    </div>

                </section>
            </div>
            <div class="col-xs-12 col-sm-3">
                <aside class="sidebar">
                    <div class="sidebar-wrap">
                        <div class="sidebar-head"><?php echo $objBlog->getAuthor()->getFirstName() . ' ' . $objBlog->getAuthor()->getLastName(); ?></div>
                        <div class="sidebar-content">
                            <br>

                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

<?php include('footer.php'); ?>