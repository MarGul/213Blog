<article class="post-multi clearfix">
    <figure class="post-multi-image col-xs-12 col-md-4 col-lg-3 hidden-xs hidden-sm" style="background-image: url('http://placehold.it/230x255');"></figure>
    <section class="post-multi-content col-xs-12 col-md-8 col-lg-9">
        <h1><a href="#"><?php echo $post->getTitle(); ?></a></h1>

        <ul class="list-inline">
            <li><i class="fa fa-clock-o"></i> <?php echo $post->getCreated()->format('F jS, Y'); ?></li>
            <li><i class="fa fa-user"></i> <?php echo $post->getAuthor()->getFirstname() . ' ' . $post->getAuthor()->getLastname(); ?></li>
        </ul>

        <p>
            <?php
                if(strlen($post->getBody()) < 235) {
                    echo $post->getBody();
                } else {
                    echo substr($post->getBody(), 0, 235) . '...';
                }
            ?>
        </p>
        <a href="#" class="btn btn-link pull-right">Read More <i class="fa fa-arrow-circle-right"></i></a>
    </section>
    <div class="post-multi-footer col-xs-12">
        <ul class="list-inline">
            <li><i class="fa fa-comment"></i> 2 Comments</li>
            <li>
                <i class="fa fa-tags"></i>
                <?php
                foreach ($post->getTags() as $tag) {
                    echo '<a href="#">#' . $tag->name . '</a> ';
                }
                ?>
            </li>
        </ul>
    </div>
</article>