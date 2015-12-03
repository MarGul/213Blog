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
                    Sidebar
                </aside>
            </div>
        </div>
    </main>

<?php include('footer.php'); ?>