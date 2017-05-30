<link href="<?php  echo base_url(); ?>assets/css/style1.css" rel="stylesheet" />
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<div class="col-md-12 n-padding" id="artist" style="min-height:100vh;background-color: #161616;border-bottom: 1px solid #000;">
<div class="n-padding" style="">
<div class="col-md-12 n-padding">
	<div class="row">
		<div class="top-signup">
            <?php
            if (empty($user_data['id'])) {
                ?>
                <div class="row">
    				<div class="col-md-offset-2 col-md-8">
    					<div class="top-container">
    						<h2 class="text-center wow bounceInDown oswaldregularh3" data-wow-duration="2s"  style="color:#fff;" about="/title_make_n/">                                                                
    							<span property="content" id="title_make_n" class="">
    							<?php  echo $this->M_text->getdatavalue('<_stitle_make_n_s>', 'Make Career With Us')  ?>							
    							</span>
    						</h2>
    						<div class="bottomheader wow zoomIn"  data-wow-delay="1s"></div>
    						<h3 class="text-center wow bounceInUp font-san"  data-wow-duration="2s" style="color:#fff;padding:0 30px" about="/title_make_n_con/">                                
    							<span property="content" id="title_make_n_con" class="">
    							<?php  echo $this->M_text->getdatavalue('<_stitle_make_n_con_s>', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...')  ?>							
    							</span>
    						</h3>
    						<div class="text-center wow zoomIn"  data-wow-duration="2s" style="margin-top:20px;">
    							<a href="<?php  echo base_url('account/signup')  ?>" class="myButton" about="/sig_fr/">
    							<span property="content" id="sig_fr" class="">
    							<?php  echo $this->M_text->getdatavalue('<_ssig_fr_s>', 'Signup For Free')  ?>							
    							</span>
    							</a>
    						</div>
    					</div>
    				</div>
    			</div>
                <?php

            }
            ?>
			
			<div class="featured-videos">
				<div class="container">
					<h2 about="/fea_h2_vid/">
						<span property="content" id="fea_h2_vid" class="">
						<?php  echo $this->M_text->getdatavalue('<_sfea_h2_vid_s>', 'FEATURED VIDEOS')  ?>							
						</span>
					</h2>
					<div class="row" id="hove">
						<?php 
                        if (!empty($videos)) {
                            foreach ($videos as $video) {
                                $images_video = $this->M_video->get_image_video($video['id']);
                                if ($video['type'] == 'file') {
                                    $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
                                } else {
                                    $link_video = $video['link_video'];
                                } ?>  
        						<div class="col-xs-6 col-sm-3 col-md-3 text-center">
        							<a class="hover" href="#"  data-toggle="modal" data-target="#layervideoartist-<?php  echo $video['id']; ?>">
        							<span class="bg-text-vid"></span>                            
        							<img style="border: 2px solid #292929; height: 165px;"  class="img-responsive" src="<?php  echo $images_video ?>" /><br />                                
        							<span class="about-video">singsong</span>
        							<span class="play_vid"></span>
        							</a>  
        						</div>
        						<div class="modal fade" id="layervideoartist-<?php  echo $video['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        							<div class="modal-dialog">
        								<div class="modal-content">
        									<div class="modal-header">
        										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        										<h4 class="modal-title">Modal title</h4>
        									</div>
        									<div class="modal-body">
        										<div id="video-<?php  echo $video['id']; ?>"></div>
        										<?php  if (!empty($videos)) {
     ?>
        										<script type="text/javascript">
        											$('.play_vid').hide();
        											$('.bg-text-vid').hide();
        											$('.about-video').hide();
        											$('#hove').delegate('.hover', 'mouseenter mouseleave', function(e) {
        											    if(e.type == 'mouseenter')
        											    {   
        											        $(this).find('.play_vid').fadeIn("slow");
        											        $(this).find('.bg-text-vid').fadeIn("slow");
        											        $(this).find('.about-video').fadeIn("slow");                               
        											    }else if(e.type == 'mouseleave'){
        											        $(this).find('.play_vid').fadeOut("slow");
        											        $(this).find('.bg-text-vid').fadeOut("slow");
        											        $(this).find('.about-video').fadeOut("slow");
        											    }
        											});         
        											    var playerInstance = jwplayer("video-<?php  echo $video['id']; ?>");
        											    jwplayer("video-<?php  echo $video['id']; ?>").setup({
        											    	stretching: 'fill',
        											    	file: "<?php  echo $link_video; ?>",            	
        											        width: "100%",
        											        aspectratio: "16:9"
        											    });              
        										</script> 
        										<?php

 } ?>
        									</div>
        									<div class="modal-footer">
        									</div>
        								</div>
        								<!-- /.modal-content -->
        							</div>
        							<!-- /.modal-dialog -->
        						</div>
        						<!-- /.modal -->
        						<!--<script src="<?php  echo base_url(); ?>assets/js/bootstrap.php?video-id=<?php  echo $video['id']; ?>"></script>-->
        						<script type="text/javascript">
        							$('.close').click(function () {
        							$('#layervideoartist-<?php  echo $video['id']; ?>').hide();
        							$('#layervideoartist-<?php  echo $video['id']; ?> iframe').attr("src", jQuery("#layervideoartist-<?php  echo $video['id']; ?> iframe").attr("src"));
        							});
        						</script>     
    						<?php 
                            }//end foreach video
                        }//end if 
                        ?>
					</div>
				</div>
			</div>
			<!--end featured-videos-->
			<div class="all-artist" style="border-top: 1px solid #292929;">
				<div class="row">
					<div class="search search-artist1">
						<div class="container">
							<div class="text-center">
								<form class="form-inline searchform" onsubmit="return false;" style="padding-left: 5px;">
									<div class="col-xs-6 col-sm-10 col-md-10">
										<div class="form-group col-xs-6 col-sm-3 col-md-3 ">
											<input type="text" placeholder="Name" class="form-control" id="name" name="name"/>
										</div>
										<div class="form-group col-xs-6 col-sm-3 col-md-3">
											<input type="text" class="form-control" id="location" name="location"  placeholder="Location" value="" readonly="" />
											<input type="hidden" id="location" name="location" value="217" class="form-control bor-sr" required=""/> 
											
										</div>
										<div class="form-group col-xs-6 col-sm-3 col-md-3">
											<input type="text" class="form-control" id="instrument" placeholder="Instrument" name="instrument"  >
										</div>
										<div class="form-group col-xs-6 col-sm-3 col-md-3">
											<!--<label for="exampleSelect1">Genre</label>-->
											<select class="form-control bor-sr"  id="genre" name="genre">
												<option value="">-- Genre --</option>
												<option value="1"> Rock </option>
												<option value="2"> Dane </option>
												<option value="3"> Pop </option>
												<option value="4"> R&B </option>
												<option value="5"> DJ </option>
												<option value="6"> Children </option>
											</select>
										</div>
									</div>
									<div class="form-group col-xs-6 col-sm-2 col-md-2">
										<button type="submit" class="btn" id="search">Search</button>
										<a type="submit" href="<?php  echo base_url('artists'); ?>" class="btn" id="all_artist">All Artist</a>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--end search-->
					<h2 class="aa" about="/all_art_h2/">All Artist
						<span property="content" id="all_art_h2" class="">
						<?php  echo $this->M_text->getdatavalue('<_sall_art_h2_s>', 'FEATURED VIDEOS 121')  ?>							
						</span> 
					</h2>
					<div id="load_ajax" class="remix_items grid clearfix four_col" style="min-height: 100px;">  
					</div>
				</div>
			</div>
            <div class="player-fixed">
                <div id="mp3"></div>      
                <a href="#" class="close-mp3" ><i class="glyphicon glyphicon-remove" style="font-size: 18px;"></i></a>          
            </div> 
		</div> 
	</div>
</div>
<input type="hidden" value="1" id="check_homepage" />
<?php  $row_count = $artists; ?>
<script type="text/javascript">       
	var $url = "<?php  echo base_url(); ?>";
	var $total_record = <?php  echo $row_count; ?>;
	var get_csrf_hash = '<?php  echo $this->security->get_csrf_hash(); ?>';
	var base_url = "<?php  echo base_url(); ?>";
</script>
<script src="<?php  echo base_url(); ?>assets/js/detail_pages/all_artist.js"></script>