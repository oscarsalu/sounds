    <script src="https://apis.google.com/js/platform.js" ></script>
    <script src="https://platform.twitter.com/widgets.js" ></script>    
	<script src="https://apis.google.com/js/client:platform.js" ></script>

<div class="row col-md-12" id="social_media" style="z-index:998;background:url('<?php echo base_url();?>assets/img/dark_mosaic.png') #000 repeat;">
    <div class="container">
        <div class="page-big-title">
            <h1 class="text-center oswaldregularh3 header_h1_social">Post to Social Media</h1>
            <div class="bottomheader wow zoomIn" data-wow-delay="1s"></div>
            
        </div>
        <div class="col-md-12">
            <div class="container opensans2">
                <div class="complete_alter alert alert-big alert-success alert-dismissable fade in">
                    <h4><strong>Success!</strong></h4>
                    <p> Post completed</p>
                </div>
                <div class="not_complete_alert alert alert-big alert-lightred alert-dismissable fade in">
                    <h4><strong>Error!</strong></h4>
                    <p> Post not completed</p>
                </div>
            <?php if ($this->session->flashdata('message_msg')) {
    ?>
                    <div class="alert alert-big alert-success alert-dismissable fade in">
                        <h4><strong>Success!</strong></h4>
                        <p> <?php echo $this->session->flashdata('message_msg')?></p>
                    </div>
                    <?php

}
                    if ($this->session->flashdata('message_error')) {
                        ?>
                        <div class="alert alert-big alert-lightred alert-dismissable fade in">
                            <h4><strong>Error!</strong></h4>
                            <p> <?php echo $this->session->flashdata('message_error')?></p>
                        </div>
                        <?php

                    }
                ?>
					<?php if(count($lists) > 0):?>
						<div class="col-md-6" id="form_share_music">                    
					<?php else: ?>
						<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2" id="form_share_music">
					<?php endif; ?>
                        <form class="form-horizontal shareFrm searchform" id="shareFrm" action="<?php echo base_url('social_media/share'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            
                            <div class="form-group">
                                <label id="post-to" class="checkbox-inline">Post type: </label>
                                
                                <label class="checkbox-inline">
            					<span>Text</span>
                                    <input type="radio" class="type_value" name="type" id="field" value="field" checked="true" />
                                </label>
                                <label class="checkbox-inline">
                                <span>Photo</span>
                                    <input type="radio" class="type_value" name="type" id="image" value="image" />
                                </label>
                                <label class="checkbox-inline">
            					<span>Video</span>
                                    <input type="radio" class="type_value" name="type" id="video" value="video" />
                                </label>
                            </div>
                            <div class="form-group">
                                <label id="post-to" class="checkbox-inline">Post to: </label>

                                    <label class="checkbox-inline checkbox_facebook">
                					   <span>Facebook</span><input type="checkbox" name="facebook" id="facebook" />
                                    </label>

                                
                                <label class="checkbox-inline checkbox_twitter">
                                <span>Twitter</span><input type="checkbox" name="twitter_check" id="twitter" />
                                </label>
                                <label class="checkbox-inline checkbox_google">
            					<span>Google</span><input type="checkbox" name="google" id="google" />
                                </label>
                            </div>
                            <div class="video_sesion">
                                <div class="form-group">
                                    <label class="checkbox-inline" id="up_load">
                                    <span>Upload video to post</span>
                                        <input type="radio" class="video_post" name="video_post" id="upload_video" value="upload_video" checked="true" />
                                    </label>
                                    <label class="checkbox-inline" id="up_load_url">
                					<span>Url video</span>
                                        <input type="radio" class="video_post" name="video_post" id="url_video" value="url_video" />
                                    </label>
                                </div>
                                <div class="form-group url_video_input">
                                    <input type="text" style="float:left;" id="url_video_input" name="url_video_input" placeholder="Video url" />
                                </div>
                                <div class="form-group url_video_upload">
                                    <input type="file" style="float:left;" id="url_video_upload" name="url_video_upload" placeholder="Video url" />
                                </div>
                            </div>
                            <div class="photo_sesion">
                                <div class="form-group">
                                    <label class="checkbox-inline " id="up_load">
                                    <span>Upload photo to post</span>
                                        <input type="radio" class="post_photo" name="post_photo" id="upload_photo" value="upload_photo" checked="true" />
                                    </label>
                                    <label class="checkbox-inline" id="up_load_url">
                					<span>Url photo</span>
                                        <input type="radio" class="post_photo" name="post_photo" id="url_photo" value="url_photo" />
                                    </label>
                                </div>
                                <div class="form-group url_post_photo_input">
                                    <input type="text" style="float: left;" id="url_post_photo_input" name="url_post_photo_input" placeholder="Photo url" />
                                </div>
                                <div class="form-group url_photo_upload">
                                    <input type="file" style="float: left;" id="url_photo_upload" name="url_photo_upload" placeholder="Photo file" />
                                </div>
                                
                            </div>
                            <div class="form-group description_show">
                                <textarea name="post_data" class="form-control description" id="description" placeholder="Description to post" cols="3" rows="4"></textarea>
                            </div>
                            <div class="field_sesion">
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                    <span>No photo</span>
                                        <input type="radio" class="no_upload_field_fb" name="no_upload_field_fb" id="no_upload_field_fb" value="no_upload_field_fb" checked="true" />
                                    </label>
                                    <label class="checkbox-inline" id="up_load">
                                    <span>Upload photo to post</span>
                                        <input type="radio"  class="no_upload_field_fb" name="no_upload_field_fb" id="upload_field_fb" value="upload_field_fb" />
                                    </label>
                                    <label class="checkbox-inline" id="up_load_url">
                					<span>Url photo</span>
                                        <input type="radio" class="no_upload_field_fb" name="no_upload_field_fb" id="url_field_fb" value="url_field_fb" />
                                    </label>
                                </div>
                                <div class="form-group url_post_field_input">
                                    <input type="text" style="float: left;" id="url_post_field_input" name="url_post_field_input" placeholder="Photo url" />
                                </div>
                                <div class="form-group upload_field_upload">
                                    <input type="file" style="float: left;" id="upload_field_upload" name="upload_field_upload" placeholder="Photo file" />
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" style="float: left;" id="share_link_url" name="share_link_url" placeholder="Share link url" />
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" style="float: left;" name="share_caption" id="share_caption" placeholder="Share caption" />
                                </div>
                                <div class="form-group">
                                    <input type="text" style="float: left;" name="share_description" id="share_description" placeholder="Share message" />
                                </div>
                            </div>
                            <input type="button" name="facebook" value="Facebook" class="btnFb btn btn-lg btn-primary" style="display:none" />
                            <input type="submit" name="twitter" value="Twitter" class="btn btn-lg btn-primary twitterShare" style="display:none" />
							
							<input type="hidden" value="<?php echo $U_map['affiliate_id']; ?>" id="affId" name="affId">
							
                        </form>
                        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                            <div id="sharePost"><button class="g-interactivepost btn btn-lg btn-primary" id="btnGoogle" style="float: left;margin-left: 208px;margin-top: -46px;display:none">Google</button></div>
    			            <input type="button" name="share" value="Share" class="share share_button col-md-6" id="share"/>
    			            
							<input type="button" name="share" value="Share Song" class="share share_button col-md-6" id="" data-toggle="modal" data-target="#songModal"/>
    			       
    			            <!--<input type="button" name="shareSong" value="Share AMP" class="share share_button col-md-6" onclick="shareSong()"/>-->
    			            
							
							
                        </div>
                    </div>
                    <?php if(count($lists) > 0): ?>
                    <div class="col-md-6 right_social">
                        <div class="">
                            <?php
                            foreach ($lists as $list) {
                                ?>
                            <div class="col-md-12 list_sc">
                                <div class="col-md-2"><img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" class="thumbnail_social" height="150" width="150" alt="Avatar"/></div>
                                <div class="col-md-10 remove_padding_sc">
                                    <div class="col-md-12 remove_padding_sc"><?php echo $list['message']; ?></div>
                                    <?php if ($list['type'] == 'video') {
    ?>
                                    <div class="col-md-12 remove_padding_sc">
                                        <video width="80%" controls >
                                            <source src='<?php echo $list['path']; ?>' type='video/mp4' />
                                        </video>
                                    </div>
                                    <?php 
} elseif ($list['type'] == 'image') {
    ?>
                                        <div class="col-md-12 remove_padding_sc">
                                            <img src="<?php echo $list['path']; ?>" width="80%" />
                                        </div>
                                    <?php 
} ?>
                                    <div class="col-md-12">
                                        <?php if ($list['facebook']) {
    ?><i class="fa fa-facebook"></i><?php 
} ?>
                                        <?php if ($list['twitter']) {
    ?><i class="fa fa-twitter"></i><?php 
} ?>
                                        <?php if ($list['google']) {
    ?><i class="fa fa-google"></i><?php 
} ?>
                                    </div>
                                </div>
                            </div>
                               
                            <?php 
                            }
                            ?>
                        </div>
                    </div>                   
               
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<!-- Song  Modal -->
<div id="songModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Song Share</h4>
      </div>
      <div class="modal-body">
		<?php if(count($listsong) > 0): ?>
			<div style="text-align:center">Please select song to share:</div>
		<?php endif; ?>
        <div class="">
			<?php foreach($listsong as $song):?>
				<input type="radio" name="songs" value="<?php echo $song['id']."-".$song['album_id'];?>"><?php echo $song['song_name']; ?><br><br>
			<?php endforeach; ?>
			<?php if(count($listsong) <= 0): ?>
				No songs added yet
			<?php endif; ?>
        </div>
      </div>
      <div class="modal-footer">
		<?php if(count($listsong) > 0): ?>
			<button type="button" class="btn btn-default" onclick="shareSong()">Share</button>
		<?php endif; ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
     var facebook_permissions      = '<?php echo implode(',', $this->config->item('facebook_permissions')); ?>';
     var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
     var page_url                  = '<?php echo base_url(); ?>';
     var facebook_app_id           = '<?php echo $this->config->item('facebook_app_id'); ?>';
     var client_id_googleplus      ='<?php echo $this->config->item('client_id', 'googleplus') ?>';
</script>	
<script src="<?php echo base_url(); ?>assets/js/detail_pages/social_media/social_media.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/social_media/social_media_fb.js"></script>
