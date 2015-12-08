<?php include('header.php'); ?>

    <main role="main">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <section class="content">

                    <h2>Showing Posts with Tag: <?php echo $strTagName; ?></h2>

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
                        <div class="sidebar-head">Authors</div>
                        <div class="sidebar-content">
                            <?php foreach ($arrUserData as $user) { ?>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge"><?php echo $user['count']; ?></span>
                                        <a href="blog_author.php?id=<?php echo $user['id']; ?>"><?php echo $user['name']; ?></a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="sidebar-wrap">
                        <div class="sidebar-head">Tag Cloud</div>
                        <div class="sidebar-content">
                            <ul class="list-inline">
                            <?php foreach ($arrTags as $tag) { ?>
                                <li>
                                    <a href="blog_tag.php?id=<?php echo $tag->id; ?>" style="font-size: <?php echo rand(14, 22); ?>px;"><?php echo $tag->name; ?></a>
                                </li>
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

<?php include('footer.php'); ?>