<?php include('views/admin_header.php') ?>

    <script type="text/javascript" src="JS/scripts.js"></script>

    <div class="container">

        <div class="row">
            <main class="page clearfix">
                <form action="" method="POST">
                    <div class="col-xs-12 col-md-9">

                        <h2>
                            Add New Blog Post
                        </h2>



                            <div class="form-group">
                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title Here">
                            </div>

                            <button type="button" class="btn btn-info"><i class="fa fa-picture-o"></i> Add Media</button>

                            <div class="form-group">
                                <textarea id="body" name="body" rows="17" class="form-control blog-body"></textarea>
                            </div>


                    </div>

                    <div class="col-xs-12 col-md-3">
                        <aside class="sidebar-block">
                            <div class="sidebar-title">Actions</div>
                            <div class="sidebar-content">
                                <div class="form-group">
                                    <label for="status"><i class="fa fa-eye"></i> Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="published">Published</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sidebar-bottom">
                                <div class="left"><a href="#" class="text-danger">Move to Trash</a></div>
                                <div class="right">
                                    <input type="submit" value="Publish" class="btn btn-primary">
                                </div>
                            </div>
                        </aside>
                    </div>
                </form>
            </main>
        </div>
    </div>

<?php include('views/admin_footer.php') ?>