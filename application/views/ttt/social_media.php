<script src="https://apis.google.com/js/platform.js" ></script>
<script src="https://platform.twitter.com/widgets.js" ></script>    
<script src="https://apis.google.com/js/client:platform.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style/social_ttt.css" />
<div class="col-md-12 remove_padding">
            <div class="col-md-4 right_padding  ttt_pack" id="rm_pd">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">Location</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <hr />
                        <div class="form-group">                        
                            <label class="form-input col-md-3">LOCATON: </label>
                            <div class="input-group col-md-8">
                                <select class="selectlocation">
                                    <?php foreach ($locations as $location) {
    ?>
                                        <option <?php if ($location_id == $location['location_id']) {
    echo 'selected="selected"';
} ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?></option>
                                    <?php 
} ?>
                                </select>
                                <hr />
                            </div>
                            
                        </div>
                        <hr />
                        
                    </div>
                </div>
            </div>
            <div class="col-md-8 left_padding  ttt_pack">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">Events</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <table class="table">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Create by</th>
                                <th>Start date - End date</th>
                                <th>Select share</th>
                                <th>Share</th>
                            </tr>
                            <?php foreach ($events as $event) {
    ?>
                            <tr>
                                <td>
                                <?php if ($event['event_banner'] == '') {
    ?>
                                    <?php $image_url = base_url().'assets/images/icon/manager_git_event.png'; ?>
                                <?php 
} else {
    ?>
                                    <?php $image_url = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; ?>
                                <?php 
} ?>
                                    
                                    <img width="50px" src="<?php echo $image_url; ?>" />
                                </td>
                                <td><?php echo $event['event_title']; ?></td>
                                <td><?php echo $event['firstname'].' '.$event['lastname']; ?></td>
                                <td><?php echo $event['event_start_date'].' - '.$event['event_end_date']; ?></td>
                                <td>
                                <form class="form-horizontal shareFrm_<?php echo $event['event_id']; ?> " id="shareFrm_<?php echo $event['event_id']; ?>" action="<?php echo base_url("the_total_tour/social_share/".$event['tour_id']."/".$event['location_id']); ?>" method="post">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>" />
                                        <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>" />
                                        <input type="hidden" name="location_id" value="<?php echo $location_id; ?>" />
                                        <input type="hidden" name="url_post_photo_input" class="url_post_photo_input" value="<?php echo $image_url; ?>" />
                                        <input type="hidden" name="twitterMsg_<?php echo $event['event_id']; ?>" value="<?php echo $event['event_title'].'&#010;'.$event['event_desc'].'&#010;Event Time: '.$event['event_start_date'].' to '.$event['event_end_date'].'&#010;Venue: '.$event['location'];?>" class="twitterMsg_<?php echo $event['event_id']; ?>">
					<div class="facebook">
					  <input type="checkbox" value="" id="facebook_<?php echo $event['event_id']; ?>" name="check" checked class="chkBox"/>
					  <label for="facebook"></label>
					  <span class="chckLbl">Facebook</span>
					</div>
					<div class="twiterChk">
					  <input type="checkbox" value="None" id="twiterChk_<?php echo $event['event_id']; ?>" name="check" checked class="twiterChk chkBox"/>
					  <label for="twiterChk"></label>
					  <span class="chckLbl">Twitter</span>
					</div>
					<div class="googleChk">
					  <input type="checkbox" value="None" id="googleChk_<?php echo $event['event_id']; ?>" name="check" checked class="chkBox"/>
					  <label for="googleChk"></label>
					  <span class="chckLbl">Google</span>
					</div>
					
					
					
					

                                        <input type="hidden" name="description" value="<?php echo $event['event_title']; ?>" class="description" />
                                        <input type="hidden" name="image" value="<?php echo $image_url; ?>" class="image" />
                                        <input type="hidden" name="description_share" value="<?php echo strip_tags($event['event_desc']); ?>" class="description_share" />
                                        <input type="hidden" name="location_share" value="<?php echo $event['location']; ?>" class="location_share" />
                                        <input type="button" name="facebook" value="Facebook" class="btnFb btn btn-lg btn-primary" style="display:none" />
                                        <input type="submit" name="twitter" value="Twitter" class="btn btn-lg btn-primary twitterShare" style="display:none" />
                                        
                                        
                                        
                                        
                                    </form>
                                    
                                </td>
                                <td>
                                    <input type="button" name="share" value="Share" class="share share_button" onclick="shareSocial(<?php echo "'".$image_url."','".$event['event_title']."','".$event['location']."','".$event['event_desc']."','".$event['event_start_date']." to ".$event['event_end_date']."','".$event['event_id']."'" ?>)"/></td>
                            </tr>
                            <script>
		/*var shareTxt = $('.twitterMsg_<?php echo $event['event_id'];?>').val();
		console.log("txt: "+shareTxt);
		var options = {
		contenturl: '99Sound.com',
		contentdeeplinkid: '/pages',
		clientid: '614939124466-0rsd0pptd6c443503hqrb2uss5smhbmu.apps.googleusercontent.com',
		cookiepolicy: 'single_host_origin',
		prefilltext: shareTxt,
		calltoactionlabel: 'READ',
		calltoactionurl: 'http://google.com/',
		calltoactiondeeplinkid: '/pages/create'
		};
		  // Call the render method when appropriate within your app to display
		  // the button.
		gapi.interactivepost.render('sharePost_<?php echo $event['event_id']; ?>', options); */
							</script>
							
                            <?php 
}?>
                          
                        <div id="sharePost"><button class="g-interactivepost btn btn-lg btn-primary" id="btnGoogle" style="float: left;margin-left: 208px;margin-top: -46px;display: none;">Google</button></div>  
                        </table>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(".selectlocation").change(function(){
    location_id = $(this).val();
    <?php
    if ($this->uri->segment(5)) {
        ?>
        location.href = "<?php echo base_url('the_total_tour/social_media/').'/'.$tour_id.'/'; ?>"+location_id+'/'+<?php echo $this->uri->segment(5); ?>;
    <?php 
    } else {
        ?>
        location.href = "<?php echo base_url('the_total_tour/social_media/').'/'.$tour_id.'/'; ?>"+location_id;
    <?php 
    }
    ?> 
});
</script>

<script type="text/javascript">
     var facebook_permissions      = '<?php echo implode(',', $this->config->item('facebook_permissions')); ?>';
     var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
     var page_url                  = '<?php echo base_url(); ?>';
     var facebook_app_id           = '<?php echo $this->config->item('facebook_app_id'); ?>';
     var client_id_googleplus      ='<?php echo $this->config->item('client_id', 'googleplus') ?>';
</script>

<script src="<?php echo base_url(); ?>assets/js/detail_pages/ttt/social.js"></script>
