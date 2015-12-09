<?php include('views/admin_header.php') ?>

    <script type="text/javascript" src="JS/scripts.js"></script>

    <div class="container">
        <main class="page">

            <h2>
                Media
            </h2>

            <div class="media-upload">
                <?php if($uploadSuccess === true) { ?>
                <div class="alert alert-success">
                    <strong>Your file was successfully uploaded</strong>
                </div>
                <?php } ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Upload Media</label>
                        <input type="file" name="upload" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-info" value="Upload">
                </form>
            </div>

            <hr>

            <div class="row">
                <?php foreach($objData->arrUploads as $upload) { ?>
                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="upload-wrapper" style="background-image: url('<?php echo $upload->url; ?>');">
                        <div class="upload-actions">
                            <div class="row">
                                <div class="col-xs-6"><a href="#" class="text-link upload-info" data-url="<?php echo $upload->url; ?>">Info</a></div>
                                <div class="col-xs-6"><a href="#" class="text-danger upload-delete" data-id="<?php echo $upload->id; ?>">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>


        </main>
    </div>

<?php include('views/admin_footer.php') ?>