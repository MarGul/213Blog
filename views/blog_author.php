<?php include('header.php'); ?>

    <main role="main">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <section class="content">

                    <?php
                    foreach ($arrPosts as $post) {
                        include('partials/post_multi.php');
                    }
                    ?>

                </section>
            </div>
            <div class="col-xs-12 col-sm-3">
                <aside class="sidebar">
                    <div class="sidebar-wrap">
                        <div class="sidebar-head"><?php echo $objUser->getFirstName() . ' ' . $objUser->getLastName(); ?></div>
                        <div class="sidebar-content">
                            <br>

                        </div>
                    </div>
                    <div class="sidebar-wrap">
                        <div class="sidebar-head">Subscribe</div>
                        <div class="sidebar-content">
                            <?php if($subscriberSuccess) { ?>
                            <div class="alert alert-success">
                                <strong>You successfully subscribed</strong>
                            </div>
                            <?php } ?>
                            <form action="" method="POST">
                                <input type="hidden" name="subscribe_author" value="<?php echo (int)$_GET['id']; ?>">
                                <div class="form-group">
                                    <input type="email" name="subscribe_email" class="form-control" placeholder="Email">
                                </div>
                                <input type="submit" class="btn btn-link full-width" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

<?php include('footer.php'); ?>