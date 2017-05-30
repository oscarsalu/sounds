

<script type="text/javascript">
    var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
    var link = "<?php echo base_url();?>";
</script>
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/amp/dashboard_home.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/amp/dashboard_home_next.js"></script>

<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css">
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/js/detail_pages/artists/managervideo.js"></script>
<style>
    .btn-choose-layout {
        color: #ffffff;
    background-color: #222222;
    border-color: #222222; 
}
.btn-choose-layout:hover ,.btn-choose-layout:active,.btn-choose-layout:focus{
        color: #ffffff !important;
    background-color: #090909 !important;
    border-color: #040404 !important;
}
/* COMMON RADIO AND CHECKBOX STYLES  */
input[type=radio]
{
  /* Hide original inputs */
  visibility: hidden;
  position: absolute;
}
input[type=radio] + label:before
{
  height:12px;
  width:12px;
  margin-right: 2px;
  content: " ";
  display:inline-block;
  vertical-align: baseline;
  border:1px solid #777;
}
input[type=radio]:checked + label:before
{
  background:#5bc0de;
}

/* CUSTOM RADIO AND CHECKBOX STYLES */
input[type=radio] + label:before{
  border-radius:50%;
}

</style>
<div class="alert_panel"></div>
<div class="row">
    <div class="col-md-6 col-sm-6">
        <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;">
            <h4 class="tt text_caplock">Choose Layout</h4>
            <span class="liner"></span>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <button class="button_new"  data-toggle="modal" data-target="#chooseLayout">Choose Layout</button>
                </div>
                <div class="col-md-5 col-sm-5">
               <img id="new-img" style="width: 100%;" src="<?php echo base_url()?>uploads/templates/landing/<?php echo $langing_select['images'] ?>" />
                </div>
                 <div class="col-md-3 col-sm-3  ">
                    <span class="current_tpl"><strong><?php echo strtoupper($langing_select['name']) ?></strong></span>
                    <a class="btn btn-default" href="<?=base_url().'amp/'.$this->M_user->get_home_page($U_map['user_id']);?>"> Preview  </a>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-6 col-sm-6">
        <section class=" full-width header_new_style" style="overflow: hidden; border: 1px solid #454545;margin-bottom: 10px; padding: 20px;">
            <h4 class="tt text_caplock">Bios</h4>
            <span class="liner"></span>
            <div class="col-md-12 col-sm-12">
                <form class="bios-form" onsubmit="return false" action="<?=base_url()?>amper/upload/bios">
                    <textarea class="text_bio" id="text_bio" name="bios" rows="5"><?= $user_data['bio']?></textarea>
                    <button class="button_new" type="submit"> Update</button>
                </form>
            </div>
        </section>
    </div>
</div>
<script>                
    CKEDITOR.replace('text_bio');
</script>
<div class="row">
	<div class="cta">
		<a href="<?php echo base_url().$user_data['home_page']?>" class="button big">Preview</a>
	</div>
</div>
<div class="container-fluid ">
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;">
        <h4 class="tt text_caplock">Photos</h4>
        <span class="liner"></span>
        <div class="row effect_slide_wp docs-pictures" >
            <?php foreach ($photos as $photo) {
    ?>  
                
                    
                    <div class="col-md-3 col-sm-4  view view-third" >       
                    
                        <img class="none-bg"  src="<?=base_url()?>uploads/<?=$photo['user_id']?>/photo/<?=$photo['filename']?>" height="250px"  />
                        
                        <div class="mask ">
                            <a class="effect_slide" data-gal="photo" href="#" title="<?php echo $photo['caption']?>" rel="bookmark">
                                <img class="img-circle effect-bubba"  style="background-color:whitesmoke;"  width="150px" src="<?=base_url()?>uploads/<?=$photo['user_id']?>/photo/<?=$photo['filename']?>"/>
                                <img class="hide" id="test" title="<?php echo $photo['filename']; ?>" width="200px" data-original="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>" />

                            </a>
                             

                            <p class="view_style_text text-center fixnameuser"><?=$photo['caption']?></p>
                            <p class="view_style_text text-center">
                                <a class="get_ajax" href="<?=base_url()?>amper/delete/photo/<?=$photo['id']?>"><span class="option_del"><i class="fa fa-times"></i> Delete</span></a>
                            </p>
                        </div>
                       
                        
                    </div>
                     
                     
            <?php 
}?>	
            <div class="col-md-3 col-sm-4 " >
                    <?php if (count($photos) < 6) {
            ?>
                    <dl class="basic">
    					<div class="empty"  data-toggle="modal" data-target="#add_photo"> Add New </div>
    				</dl>
                    <?php

}?>
            </div>
        </div>
    </section>
    
    
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;">
        <h4 class="tt text_caplock">Videos</h4>
        <span class="liner"></span>
        <div>
            <div><!-- SLIDER CONTAINER -->
                <div class="row">
                    <?php foreach ($videos as $video) {
    if ($video['type'] == 'file') {
        $source = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
    } else {
        $source = $video['link_video'];
    } ?>
                    <div class="col-md-3 col-sm-4 view view-third" >   
                        <img class="none-bg"  height="250px" class="watch_video border_profile" src="<?=$this->M_video->get_image_video($video['id'])?>" alt="<?=$video['name_video']?>"/>
                        <div class="mask">
                            <img data-toggle="modal" data-target="#layervideo-<?php echo $video['id'];?>" class="watch_video img-circle" style="background-color:whitesmoke;cursor: pointer;" width="150px" src="<?=$this->M_video->get_image_video($video['id'])?>"/>
                            <p class="view_style_text text-center fixnameuser"><?=$video['name_video']?></p>
                            <p class="view_style_text text-center">
                                <a class="get_ajax" href="<?=base_url()?>amper/delete/video/<?=$video['id']?>"><span class="option_del"><i class="fa fa-times"></i> Delete</span></a>
                                <input type="hidden" class="file_source" value="<?=$source?>" />
                            </p>
                        </div>
                    </div>
                    <!-- Modal upload video -->
<div class="modal fade bs-example-modal-lg" id="layervideo-<?php echo $video['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
                    <?php 
    if (!empty($video)) {
        if ($video['type'] == 'file') {
            echo '<div id="videofile" ></div>';
            ?>
            <script>
            jwplayer("videofile").setup({
                width: "100%",
                aspectratio: "16:9",
                stretching: 'fill',
                file: "<?php echo base_url().'uploads/'.$user_data['id'].'/video/'.$video['name_file']?>",
                
            });
            function playTrailer(video) { 
              jwplayer().load([{
                file: video
              }]);
              jwplayer().play();
            }
            </script>
            <?php

        } else if($video['type'] == 'link-vimeo'){
            $video_vimeo=basename($video['link_video']);
                 
                  $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                 
                  $hash = unserialize(file_get_contents($get_link));
            $url_id=$hash[0]['id'];
            ?>
            <iframe src="https://player.vimeo.com/video/<?php echo $url_id; ?>?title=0&byline=0&portrait=0" width="900" height="518" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p></p>
       <?php } else {
              echo '<div id="video" ></div>';
            ?>
            <script>
            var playerInstance = jwplayer("video");
            jwplayer("video").setup({
            	stretching: 'fill',
            	file: "<?php echo $video['link_video']?>",
            	skin: "stormtrooper",
                width: "100%",
                aspectratio: "16:9"
            });
            </script>
            <?php

        }
    }
    ?>
    </div>
  </div>
</div>
                    <?php 
}?>	
                    
                    <div class="col-md-3 col-sm-4" >
                        
                            <?php if (count($videos) < 3) {
    ?>
                            <dl class="basic">
            					<div class="empty" data-toggle="modal" data-target="#add_video"> Add New </div>
            				</dl>
                            <?php

}?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal photo-->
<div class="modal fade" id="add_photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Upload Photo</h4>
			</div>
            <form class="form form-signup MyUploadForm" method="post" role="form" onsubmit="return false"  action="<?php echo base_url().'amper/upload/photo'?>" enctype="multipart/form-data">
    			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="modal-body">
                       <div class="form-group">
                            <label class="form-input col-md-4">Choose A Photo File</label>
                            <div class="input-group col-md-6">
                                <input type="file" class="form-control imageInput" name="photo" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-input col-md-4">Add Caption *</label>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control " name="caption" placeholder="Enter the caption of the photo"/>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <input type="checkbox" class="form-input" name="check"/>
                            I own or have licensed all rights to use this photo.
                            <a href="#" data-toggle="tooltip" data-placement="right" title="about">??</a>
                        </div>
                        <div class="progressbox" style="display:none;">
                            <div class="progressbar"></div>
                            <div class="statustxt">0%</div>
                        </div>
                        <div class="output"></div>
                    </div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				<button type="submit" class="btn submit-btn btn-primary">Upload</button>
    			</div>
            </form>
		</div>
	</div>
</div>
<!-- Modal video-->
<div class="modal fade" id="add_video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"style="border-radius:45px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title btn btn-info btn-block disabled" id="myModalbg" style="width:50%;text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
             0px 8px 13px rgba(0,0,0,0.1),
             0px 18px 23px rgba(0,0,0,0.1);font-size:25px;" >Add A New Video</h2>
			</div>
            <hr style="border-bottom: 1px solid #000;">
            <div class="router-type">
                <div class="input-group col-md-offset-4 col-md-7 ">
                    <div class="radio1">
                        <input type="radio" name="router-type" checked="" value="link" id="youtube"/><label class="radio-label" for="youtube"> Youtube </label>
                        <br> <input type="radio" name="router-type"  value="vimeo-link" id="vimeo"/><label class="radio-label" for="vimeo"> Vimeo </label>
                        <br> <input type="radio" name="router-type" value="file"  id="harddrive"/><label class="radio-label" for="harddrive"> Hard Drive </label>
                </div>
            </div>
            </div>
            <form class="form_video_link"  onsubmit="return false"  action="<?php echo base_url().'amper/amper/link_video'?>" method="post">           
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">YouTube Video Name </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" />
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Url </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="link_video" />
                        </div>
                        
                    </div>
                    <div class="input-group col-md-offset-4 col-md-7"> 
                        
                        
                        
                    </div>
                </div>
                 <hr style="border-bottom: 1px solid #000;">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div> 
            </form>   
              <form class="form_video_vimeo_link" style="display: none;" onsubmit="return false"  action="<?php echo base_url().'amper/amper/link_video'?>" method="post">           
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">Vimeo Video Name </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" />
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Url </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="link_video" />
						</div>
                        
                    </div>
                    <div class="input-group col-md-offset-4 col-md-7"> 
                        
                        
                        
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div> 
            </form>        
            <form id="MyUploadForm" class="form_video_file" style="display: none;" action="<?php echo base_url().'amper/amper/file_video'?>" onsubmit="return false" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Name *</label> 
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" required />
		</div>
	</div>
                    <div class="form-group">
						<label class="form-input col-xs-4">Choose a video file (Max_size: 150Mb)</label>
						<div class="input-group col-xs-6">
							<input type="file" class="form-control" name="video_file" id="imageInput"  />
</div>
    </div>
                    <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                    <div id="output"></div>
  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-btn" class="btn btn-primary">Add</button>
</div>
            </form>         
        </div>
    </div>
</div>

<div class="modal fade new_modal_style" id="chooseLayout" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form_tpl " onsubmit="return false" action="<?php echo base_url().'amper/changelayout'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Change Layout</h4>
                <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group col-xs-12">
                        <p>Desired template change will be seen upon selecting Create Profile as Fan</p>
                    </div>
                    <div class="alp-template_box">
                        <ul class="sortable with_main_songs"> 
                         <?php
                         foreach ($landings as $landing) {
                           ?>

                                <li class=" searchform-1 <?php if ($user_data['template_landing'] == $landing['position']) {
    echo 'selected';
} ?>">
                                    <input type="hidden" class="hidden-val" value="<?= $landing['position'] ?>" />
                                    <?php if($landing['type'] == "landing"): ?>
										<input type="hidden"  class="hidden-img" value="<?php echo base_url()?>uploads/templates/landing/<?php echo $landing['images'] ?>" />
										<img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>uploads/templates/landing/<?php echo $landing['images'] ?>"/>
									<?php else: ?>
										<input type="hidden" class="hidden-img" value="<?php echo base_url()?>uploads/templates/landing_flp/<?php echo $landing['images'] ?>" />
										<img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>uploads/templates/landing_flp/<?php echo $landing['images'] ?>"/>
									<?php endif; ?>
                                                                                <span><?= strtoupper($landing['name'])?></span> 
                                    <a class="btn btn-default pull-right changeimages" data-toggle="modal" data-target="#preview-tpl">Preview</a>
                                </li>
                                <?php

                         }
                        ?>   
                        </ul>
                    </div>
                    <input id="result-tpl" type="hidden" name="template_landing" value=""/>
                    <input id="result-img" type="hidden" name="template_image" value=""/>
                </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default btn-choose-layout" >Change</button>
                </div> 
            </form>           
        </div>
    </div>
</div>
<!-- Modal preview ChangeLayout -->
<div class="modal fade new_modal_style" id="preview-tpl" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Preview Template page</h4>
                <span class="liner"></span>
            </div>            
            <div class="modal-body" style="max-height: none!important;">
                <img id="alp-pre-img" src="" width="100%" />
            </div>    
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
            </div>           
        </div>
    </div>
</div>
<script type="text/javascript">
       $(".effect_slide").click(function(){
            $(this).find("img.hide").click();
           
        })

              
</script>