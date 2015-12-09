<?php include('views/admin_header.php') ?>

    <script type="text/javascript" src="JS/scripts.js"></script>

    <div class="container">

        <div class="row">
            <main class="page clearfix">
                <form action="" method="POST">
                    <div class="col-xs-12 col-md-9">

                        <h2>
                            Edit Blog Post
                        </h2>

                        <?php if($objData->error) { ?>
                            <div class="alert alert-danger" role="alert"><strong>Invalid Input</strong><br><?php echo implode('<br>', $objData->msg); ?></div>
                        <?php } ?>

                        <?php if($objData->success) { ?>
                            <div class="alert alert-success" role="alert"><strong>Success</strong><br><?php echo implode('<br>', $objData->msg); ?></div>
                        <?php } ?>

                        <div class="form-group <?php echo (in_array('title', $objData->errors)) ? 'has-error' : ''; ?>">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title Here" value="<?php echo $objData->input['title']; ?>">
                        </div>

                        <button type="button" class="btn btn-info"><i class="fa fa-picture-o"></i> Add Media</button>

                        <div class="form-group <?php echo (in_array('body', $objData->errors)) ? 'has-error' : ''; ?>"><textarea id="body" name="body" rows="17" class="form-control blog-body"><?php echo $objData->input['body']; ?></textarea></div>

                        <label for="tags">Tags</label>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-success add-tag" type="button"><i class="fa fa-plus"></i> Add</button>
                            </span>
                        </div>
                        <input type="hidden" name="tags" id="tags" value='<?php echo $objData->input['tags']; ?>'>
                        <ul class="list-unstyled" id="tagsList">
                            <?php
                            if(!empty($objData->input['tags'])) {
                                foreach (json_decode($objData->input['tags']) as $tag) {
                                    echo '<li><span>' . $tag . '</span><button type="button" class="delete-tag"><i class="fa fa-minus-circle"></i></button></li>';
                                }
                            }
                            ?>
                        </ul>

                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12">
                                <label for="comments">Comments</label>
                                <?php
                                    if(!empty($objBlog->getComments())) {
                                        foreach ($objBlog->getComments() as $comment) {
                                            include('partials/comment.php');
                                        }
                                    }
                                ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-12 col-md-3">
                        <aside class="sidebar-block">
                            <div class="sidebar-title">Actions</div>
                            <div class="sidebar-content">
                                <div class="form-group">
                                    <label for="status"><i class="fa fa-eye"></i> Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="published" <?php echo ($objData->input['status'] == 'published') ? 'selected="selected"' : ''; ?>'>Published</option>
                                        <option value="draft" <?php echo ($objData->input['status'] == 'draft') ? 'selected="selected"' : ''; ?>>Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sidebar-bottom">
                                <div class="left"><a href="blog_delete.php?blogID=<?php echo (int)$_GET['blogID']; ?>&ajax=0" class="text-danger">Delete</a></div>
                                <div class="right">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                        </aside>

                        <aside class="sidebar-block clearfix">
                            <input type="hidden" name="image" id="img-insert-field" value="<?php echo $objData->input['image']; ?>">
                            <div class="sidebar-title">Featured Image</div>
                            <div class="sidebar-content featured-img" id="img-insert-div">
                                <?php if(!empty($objData->input['image'])) { ?>
                                    <img src="<?php echo $objData->input['image']; ?>" class="img-responsive">
                                <?php } ?>
                            </div>

                            <button type="button" class="btn btn-primary pull-right" style="margin: 3px;" data-toggle="modal"
                                    data-target="#chooseMedia">Choose Media</button>

                        </aside>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <?php include('views/partials/choose_media.php'); ?>

<?php include('views/admin_footer.php') ?>