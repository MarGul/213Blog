<?php include('views/admin_header.php') ?>

<script type="text/javascript" src="JS/scripts.js"></script>

<div class="container">
    <main class="page">

        <h2>
            Blog Posts
            <a href="blog_add.php" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-plus"></i> Add New Post</a>
        </h2>


        <table class="table table-striped data-table">
            <thead>
            <tr>
                <th width="60%">Title</th>
                <th width="25%">Author</th>
                <th width="15%">Date</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if(!empty($objData->posts)) {
                foreach ($objData->posts as $post) { ?>
                    <tr>
                        <td>
                            <?php echo $post->title; ?>
                            <div class="table-actions">
                                <a href="blog_edit.php?blogID=<?php echo $post->id; ?>" class="text-blue">Edit</a> |
                                <a href="#" class="text-danger delete-blog"
                                   data-id="<?php echo $post->id; ?>">Delete</a> |
                                <a href="#" class="text-blue">View</a>
                            </div>
                        </td>
                        <td><?php echo $post->firstname . ' ' . $post->lastname; ?></td>
                        <td><?php echo $post->created; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="3" class="text-center"><h3>No Blog Posts</h3></td>';
            } ?>
            </tbody>

            <tfoot>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
            </tr>
            </tfoot>
        </table>

    </main>
</div>

<?php include('views/admin_footer.php') ?>
