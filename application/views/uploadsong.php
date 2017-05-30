<div class="container" style="margin-top:150px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- Button trigger modal -->
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#uploadsong">
            Upload Song
            </button>
        </div>
    </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="uploadsong" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Song</h4>
            </div>
            <form class="form form-signup" role="form" action="<?php echo base_url().'artist/uploadsong'?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                  <div class="form-group">
                        <label class="form-input col-md-4">Choose a Song File</label>
                        <div class="input-group col-md-6">
                            <input type="file" class="form-control" name="song" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-4">Song Name *</label>
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control " name="song_name" placeholder="Enter the name of the song"/>
                        </div>
                        <?php echo form_error('song_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-4">Availability *</label>
                        <div class="input-group col-md-6">
                            <select class="form-control " name="availability" >
                                <option value="Streaming Only">Streaming Only</option>
                                <option value="Download And Streaming">Download And Streaming</option>
                                <option value="Exclusive Download">Exclusive Download</option>
                                <option value="RPK Only">RPK Only</option>
                                <option value="RPK Only">Hidden</option>
                            </select>
                        </div>
                        <?php echo form_error('availability', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-input" name="check"/>
                        I own or have licensed all rights to use this song.
                        <a href="#" data-toggle="tooltip" data-placement="right" title="about">??</a>
                        <?php echo form_error('check', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>