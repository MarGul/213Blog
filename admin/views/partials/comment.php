<div class="comment-wrap">
    <div class="comment-head">
        <ul class="list-inline">
            <li><i class="fa fa-user"></i> <?php echo $comment->name; ?></li>
            <li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $comment->email; ?>"><?php echo $comment->email; ?></a></li>
            <li><i class="fa fa-clock-o"></i> <?php echo $comment->date; ?></li>
            <li><a href="#" data-id="<?php echo $comment->id; ?>" class="text-danger delete-comment">Delete</a></li>
        </ul>
    </div>
    <div class="comment-body">
        <?php echo nl2br($comment->comment); ?>
    </div>
</div>