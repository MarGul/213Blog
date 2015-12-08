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


        </main>
    </div>

<?php include('views/admin_footer.php') ?>