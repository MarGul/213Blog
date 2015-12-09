<div class="modal fade" id="chooseMedia" tabindex="-1" role="dialog" aria-labelledby="chooseMedia">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Choose Featured Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($objData->arrUploads as $upload) { ?>
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="upload-wrapper img-select" style="background-image: url('<?php echo $upload->url; ?>');" data-img="<?php echo $upload->url; ?>"></div>
                    </div>
                    <?php } ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-img-select">Select</button>
            </div>
        </div>
    </div>
</div>
