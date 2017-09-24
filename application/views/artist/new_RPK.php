<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/crop-image/css/cropper.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/newrpk/sweetalert.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/newrpk/jquery.onoff.css">

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">


 <style type="text/css">
 	body{
 		background: #2A3F54;
 	}
 
 </style> 
<body class="nav-md">
    <div class="container body">
      	<div class="main_container">
   		 	<div class="col-md-3 left_col">
      			<div class="left_col scroll-view">
		            <!-- menu profile quick info -->
		            <div class="profile clearfix">
		              	<div class="profile_pic">
			                <img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" alt="..." class="img-circle profile_img">
		              	</div>
		              	<div class="profile_info">
		                	<span><?php echo $user_data['artist_name']?></span>
		                	<h2><i class="fa fa-map-marker"></i> <?php echo $user_data['city']?></h2>
		              	</div>
		            </div>
			            <!-- /menu profile quick info -->

        			<br />

		            <!-- sidebar menu -->
		            <div id="sidebar-menu"  class="main_menu_side hidden-print main_menu">
		              	<div class="menu_section" >
			                <ul class="nav side-menu1" >
			                  <li><a data-toggle="pill"  href="#home"><i class="fa fa-home"></i> Home </a>
			                    
			                  </li>
			                  <li><a data-toggle="pill"  href="#photo"><i class="fa fa-file-image-o" ></i> Set Your Best Photo</a>
			                  </li>
			                  <li><a data-toggle="pill"  href="#songDiv"><i class="fa fa-music"></i>Set Your Best Songs </a>
			                    
			                  </li>
			                  <li><a data-toggle="pill"  href="#videodiv" onclick="fetch_video(<?=$user_id?>)"><i class="fa  fa-file-video-o"></i> Set Your Best Video </a>
			                    
			                  </li>
			                  <li>
			                  	<a data-toggle="pill"  href="#bioDiv"><i class="fa fa-info-circle"></i> Set Your Bio</a>
			                    
			                  </li>
			                  <li><a data-toggle="pill"  href="#setlimit"><i class="fa  fa-tachometer"></i>Set Your Display Limit </a>  
			                  	
			                  </li>
			                  <li><a data-toggle="pill"  href="#settingDiv"><i class="fa fa-wrench"></i>Setting EPK Display </a>  
			                  	
			                  </li>
			                  <li><a data-toggle="pill"  href="#uploadDiv"><i class="fa fa-plus"></i>Upload New Media </a>
			                    
			                  </li>
			                  <!--<li><a data-toggle="pill"  href="#editDiv"><i class="fa fa-pencil-square-o"></i>Edit Media</a>  
			                  </li>-->
			                  <li><a data-toggle="pill"  href="#setshow"><i class="fa fa-eye"></i>Set Your Shows </a> 
			                  </li>
			                  <li><a data-toggle="pill"  href="#setblog"><i class="fa fa-rss"></i>Set Your Blogs for EPK </a> 
			                  </li>
			                  <li><a data-toggle="pill"  href="#setpress"><i class="fa fa-newspaper-o"></i>Set Your Press for EPK </a> 
			                  </li>
			                  <li><a data-toggle="pill"  href="#sendepk"><i class="fa fa-send-o"></i>Send EPk</a> 
			                  </li>	
			                  <li><a data-toggle="pill"  href="#shareepk"><i class="fa fa-share-alt"></i>Share Your EPK</a> 
			                  </li>	
			                </ul>
		              	</div>
		            </div>
            				<!-- /sidebar menu -->
      			</div>
    		</div>
	        <!-- top navigation -->
	        <div class="top_nav">
	          <div class="nav_menu">
	            <nav>
	              <div class="nav toggle">
	                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
	              </div>
	            </nav>
	          </div>
	        </div>
	        <!-- /top navigation -->
   		<div class="tab-content">
	        <!-- page content -->
	        <div class="right_col tab-pane fade in active" role="main" id="home">
	          <!-- top tiles -->
	           	<div class="row top_tiles">
	              	<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
               		 	<div class="tile-stats">
		                  <div class="icon"><i class="fa fa-envelope-o"></i></div>
		                  	<div class="count"><?php if (empty($view_tats['send_email'])) {
		    					echo '0';} else {echo $view_tats['send_email'];} ?></div>
		                  <h3>Send Mail</h3>
		                </div>
	              	</div>
	              	<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="tile-stats">
		                  	<div class="icon"><i class="fa fa-twitter"></i></div>
		                  	<div class="count"><?php if (empty($view_tats)) {
		    					echo '0';} else {echo $view_tats['share_tw'];} ?>
	    						
	    					</div>
		                  	<h3>Share Twitter</h3>
		                </div>
	              	</div>
	              	<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
		                <div class="tile-stats">
		                  	<div class="icon"><i class="fa fa-facebook"></i></div>
	                  		<div class="count"><?php if (empty($view_tats)) {
		    					echo '0';} else {echo $view_tats['share_fb'];} ?></div>
		                  	<h3>Share Facebook</h3>
		                </div>
	              	</div>
	             </div>
          		<div class="row tile_count">
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              	<span class="count_top"><i class="fa fa-music"></i> Songs Counts</span>
		              	<div class="count"><?php if (empty($num_songs)) {
			    			echo '0';} else {echo $num_songs;} ?>
		    			</div>
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-rss"></i> Blogs Counts</span>
		              <div class="count"><?php if (empty($num_blogs)) {
		    			echo '0';} else {echo $num_blogs;} ?></div>
		              
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-video-camera"></i> Video Counts</span>
		              <div class="count"><?php if (empty($num_video)) {
		    					echo '0';} else {echo $num_video;} ?></div>
		             
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-users"></i> Fans Counts</span>
		              <div class="count"><?php if (empty($num_fans)) {
		    					echo '0';} else {echo $num_fans;} ?></div>
		              
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-comments"></i> Comments Counts</span>
		              <div class="count"><?php if (empty($num_comments)) {
		    				echo '0';} else {echo $num_comments;} ?></div>
		              
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              	<span class="count_top"><i class="fa fa-calendar-o"></i> Events Counts</span>
		              	<div class="count"><?php if (empty($num_events)) {
		    				echo '0';} else {echo $num_events;} ?></div>
		              
		            </div>
          		</div><!-- /top tiles -->
      			<br />
          		<div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2><i class="fa fa-info-circle"></i> Detail</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="user-menu-list">
                    <!-- <li>
                    <a href="<?php echo base_url().'artist/presskit/customize'?>" class="btn wow "  data-wow-delay="1s">
					   <button class="btn btn-labeled "  style="background:#EF1C1C;padding-top:0px; padding-bottom:0px; padding-left:0px;">
                            <span class="btn-label" style="color:#FFFFFF;"><i class="fa fa-bell-o"></i></span><span style="color:#FFFFFF;">Customize EPK</span>
							
						</button></a>
                     </li> -->
                    <li>
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#choose-tpl">
							<i class="fa fa-book"></i> Template EPK</a>
                         <!-- <button class="btn btn-labeled btn-primary"  data-wow-delay="1s" data-toggle="modal" data-target="#choose-tpl" style="padding-top:0px; padding-bottom:0px; padding-left:0px;"> <span class="btn-label"><i class="fa fa-book"></i></span><a  href="#" class="btn wow "  data-wow-delay="1s"><span style="color:#FFFFFF;">Template EPK</span></a></button>  -->
                    </li>
                    <li>
                     <a class="btn btn-primary"  target="_blank" href="<?php echo base_url().'epk/'.$user_data['home_page']?>"  onclick='displayEpk("<?php echo base_url().'epk/'.$user_data['home_page']?>")'>
							<i class="fa fa-book"></i> Preview</a>
					
                    </li>
                    <li style="word-wrap:break-word;">
                        <h3><?php echo base_url('epk/'.$user_data['home_page'])?></h3>
                    </li>
                </ul>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2><i class="fa fa-tasks"></i> Download</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-6"><h2 class="m-0"> <?php if (empty($view_tats)) {echo '0';} else {echo $view_tats['interactions'];} ?></h2><h4>Download</h4></div>
                            <div class="col-md-6"><h2 class="m-0">
							<?php if (empty($view_tats)) {echo '0';} else {echo $view_tats['contact'];} ?></h2><h4>Contact</h4></div>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2><i class="fa fa-list" aria-hidden="true"></i> List View</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content text-center">
                    <h3><?php if (empty($view_tats)){echo '0';} else {echo $view_tats['view'];} ?></h3> 
						<h4 about="/content_homes1_tittle_new3_11/">
                            <span property= "content" id= "content_homes1_tittle_new3_11">
                                <?php
                                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'VIEWS');
                                ?>
                            </span> 
                        </h4>
                    
                  </div>
                </div>
              </div>
            </div>

          </div>


        </div>
        <!-- /page content -->
        <div class="right_col tab-pane fade" id="photo">
        	<div class="container">
                 	<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#menu1">Select Photos</a></li>
                        <li><a data-toggle="tab" href="#menu2">Photos on EPK</a></li>
                        
                  	</ul>
                  	
                  	<div class="tab-content">
                        <div id="menu1" class="container tab-pane fade in active">
                        	<h2><input type="radio" name="showdiv" checked onclick="showdiv('backgrounds')" /> Click on photo to select and display on EPK dashboard or <input type="radio" name="showdiv" onclick="showdiv('uploadnewphoto')" /> Upload Image</h2>
                  			<hr>
                        	<div class="row" id="backgrounds"></div>
                        	<div class="row" id="uploadnewphoto" style="display: none">
                        		<div class="titleCls">Upload the Image</div>
          
					           <form enctype="multipart/form-data" class="" method="post"  action="<?php echo base_url();?>artist/presskit/upload_image" name="background_image_upload_form" id="background1"  style="margin-top: 12px;">
					               <div id="img1"><img src="<?php echo base_url();?>assets/images/default-background.png">
										<div class="progressBar1">
											<div class="bar1"></div>
											<div class="percent1">0%</div>
										</div>
					                   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					    				<div id="imgChange1"><span>Upload image for EPK</span>
					    					<input type="file" accept="image/*" name="image_upload" id="background_image_upload">
					    				</div>
					    			</div>
					          </form>
                        	</div>
                    	</div>
                		<div id="menu2" class="tab-pane fade">
                			<br/>
			                <div class="row" id="adddiv">
			                	<?php if(!empty($epk_photos))
			                	{
			                	foreach ($epk_photos as $key => $photos) {
			                		?>
		                		<div class="col-md-3 col-md-offset-0 col-xs-offset-2 col-xs-8 portfolio-item" id="photo_<?=$photos['id']?>">
		                            <img class="img-responsive" style="width:750px;height:250px" src="<?php echo base_url(); ?>uploads/<?php echo $photos['user_id']; ?>/photo/<?php echo $photos['filename']; ?>" alt="<?php echo $photos['caption']; ?>" >
		                                <a onclick='delete_epk_photo("<?php echo $photos['id']?>")' title="Delete Photo from EPK">
		                                	<i class="fa fa-times closeBtn" aria-hidden="true"></i>
		                                </a>
		                        </div>
			                	<?php }
			                	} ?>
		                    </div>
                		</div>
                		
             	 	</div>
          		</div>
        	</div>
        	<div class="right_col tab-pane fade" id="videodiv">
        		<div class="container">
        			<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#video1">Select Video</a></li>
                        <li><a data-toggle="tab" href="#video2">Videos on EPK</a></li>
                    </ul>
                  	
                  	<div class="tab-content">
                        <div id="video1" class="container tab-pane fade in active">
                        	<h2> Click on Video to select and display on EPK dashboard </h2>
                  			<hr>
                  			<div class="row">
                  				<div id="video"></div>
                  			</div>
                        	
                    	</div>
                		<div id="video2" class="tab-pane fade">
                			<br/>
			               	<div class="row" id="addVideoDiv">
			               <?php if(!empty($epk_videos)){

			               			foreach ($epk_videos as $key => $value) {
			               				if($value['type'] == 'file') 
			               				{
			               					$link_video = base_url().'uploads/'.$value['user_id'].'/video/'.$value['name_file'];
			               			?>
			               				<div class="col-md-4 col-sm-6 col-xs-12 portfolio-item" id="video_<?=$value['id']?>" >
			               					<a href="#videos"  data-toggle="modal" data-target="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>)">
					               			<div class="embed-responsive embed-responsive-16by9" style="background-image:url(<?php echo base_url().'uploads/'.$value['user_id'].'/video/'.$value['cover_image'] ?>);background-position: center;background-size: 100% 100%">
					               				
										 	</div>
										 	</a>
										 	<a onclick='delete_epk_video("<?=$value['id']?>")' title="Delete video from EPK">
		                                	<i class="fa fa-times closeBtn" aria-hidden="true"></i></a>
					               		</div>
			               			<?php		
			               				}elseif ($value['type'] == 'link-vimeo') {
		               					 	$video_vimeo=basename($value['link_video']);
								            $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
		                  					$hash = unserialize(file_get_contents($get_link));
							                $image=$hash[0]['thumbnail_medium']; 
							               	$src = $image;
						                    $url_id=$hash[0]['id'];
						                    $link_video = 'https://player.vimeo.com/video/'.$url_id.'?title=0&byline=0&portrait=0';
			               					?>
	               					 	<div class="col-md-4 col-sm-6 col-xs-12 portfolio-item" id="video_<?=$value['id']?>">
	               					 	<a href="#vimeo_videos"  data-toggle="modal" data-target="#vimeo_videos" onclick="javascript:play_vimeo_video(<?php echo "'".$link_video."'"; ?>)">
					               			<div class="embed-responsive embed-responsive-16by9" style="background-image:url(<?php echo $src ?>);background-position: center;background-size: 100% 100%">
												 
										 	</div>
										 	</a>
										 	<a onclick='delete_epk_video("<?=$value['id']?>")' title="Delete video from EPK">
		                                	<i class="fa fa-times closeBtn" aria-hidden="true"></i></a>
					               		</div> 
					               		<?php
			               				}
			               				else{
			               					if(strpos($value['link_video'],"youtube.com")) 
												$videoArr = explode("v=",$value['link_video']);
												$videoId  = ""; 
												if(strpos($videoArr[1],'&'))
												{
													$temp = explode("&",$videoArr[1]);
													$videoId = $temp[0];	
												}
												else
													$videoId = $videoArr[1];
												
		               					?>
		               					 <div class="col-md-4 col-sm-6 col-xs-12 portfolio-item" id="video_<?=$value['id']?>">
		               					 <a href="#videos"  data-toggle="modal" data-target="#videos" onclick="javascript:playvideo(<?php echo "'".$value['link_video']."'"; ?>)">
					               			<div class="embed-responsive embed-responsive-16by9" style="background-image:url(<?php echo 'https://img.youtube.com/vi/'.$videoId.'/default.jpg'; ?>);background-position: center;background-size: 100% 100%">
										 	</div>
										 	</a>
										 	<a onclick='delete_epk_video("<?=$value['id']?>")' title="Delete video from EPK">
		                                	<i class="fa fa-times closeBtn" aria-hidden="true"></i></a>
					               		</div> 
					               		
			               			<?php		
			               				}
	               				?>
               					
	               				<?php
			               			}
			               			}
			               		?>
			               		
			               
                		</div>
             	 	</div>
        		</div>
        	</div>
    	</div>
        	<div class="right_col tab-pane fade" id="songDiv">
        	<div class="container">
        			<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#song1">Select Song</a></li>
                        <li><a data-toggle="tab" href="#song2" onclick="fetch_song()">Songs on EPK</a></li>
                    </ul>
                  	
                  	<div class="tab-content">
                        <div id="song1" class="container tab-pane fade in active">
                        	<h2>Click on Song name to select song for EPK</h2>
                  			<hr>
                  			<div class="row">
                  				<div class="panel-group" id="accordion">
                        <?php
                        	if(!empty($album_songs))
                        	{


                        $i = 1;
                        foreach ($album_songs as $album_song) {

                            ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                                    Album <?php echo $album_song['name']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php if ($i == 1) { echo 'in';} ?>">
                                <div class="panel-body remove_padding">
                                <?php $video_by_albums = $this->M_audio_song->get_data_songs_epk($album_song['id']); 

                                ?>
                            
                                    <script type="text/javascript">
                                    $(document).ready(function(){
                                    
                                    	new jPlayerPlaylist({
                                    		jPlayer: "#jquery_jplayer_<?php echo $album_song['id']; ?>",
                                    		cssSelectorAncestor: "#jp_container_<?php echo $album_song['id']; ?>"
                                    	}, [
                                            <?php
                                            foreach ($video_by_albums as $video_by_album) {
                                            	if($video_by_album['audio_file1']!=""){
                                        $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file1'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file1'];
                                        } else if($video_by_album['audio_file2']!=""){
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file2'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file2'];
                                        }
                                        else if($video_by_album['audio_file3']!=""){
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file3'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file3'];
                                        }
                                        else if($video_by_album['audio_file4']!=""){
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file4'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file4'];
                                        }
                                        else {
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file5'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['audio_file5'];
                                        }
                                        if($video_by_album['video_file1']!=""){
                                        $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['video_file1'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['video_file1'];
                                        } else if($video_by_album['video_file2']!=""){
                                             $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['video_file2'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['video_file2'];
                                        }
                                        else {
                                             $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['video_file3'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$video_by_album['video_file3'];
                                        }

                                            	?>
                                    		   {
                                                    title:"<?php echo $video_by_album['song_name'] ?>",
                                                    artist:"Price: <?php echo $video_by_album['price'] ?> <?php echo $video_by_album['currency'] ?>",
                                                    mp3:"<?php echo $file_url ?>",
                                                    //oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg",
                                                    poster: "<?php echo $this->M_audio_song->get_cover_playlist($album_song['id']); ?>",
                                                    id:"<?php echo $video_by_album['id'] ?>"
                                                },
                                    		<?php 
                                            } ?>
                                    	], {
                                    		swfPath: "<?php echo base_url('') ?>assets",
                                            swfPath: "<?php echo base_url('') ?>assets/playermusic/dist/jplayer",
                                    		supplied: "webmv, ogv, m4v, oga, mp3",
                                    		useStateClassSkin: true,
                                    		autoBlur: false,
                                    		smoothPlayBar: true,
                                    		keyEnabled: true,
                                    		audioFullScreen: true
                                    	});
                                    });
                                    </script>
                                    <div id="jp_container_<?php echo $album_song['id']; ?>" class="jp-video jp-video-270p" role="application" aria-label="media player" style="margin: 0 auto;">
                                    	<div class="jp-type-playlist">
                                    		<div id="jquery_jplayer_<?php echo $album_song['id']; ?>" class="jp-jplayer">
                                    		</div>
                                    		<div class="jp-gui">
                                    			<div class="jp-video-play">
                                    				<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
                                    			</div>
                                        			<div class="jp-interface">
                                        				<div class="jp-progress">
                                        					<div class="jp-seek-bar">
                                        						<div class="jp-play-bar"></div>
                                        					</div>
                                        				</div>
                                        				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                        				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                        				<div class="jp-controls-holder">
                                        					<div class="jp-controls">
                                        						<button class="jp-previous" role="button" tabindex="0">previous</button>
                                        						<button class="jp-play" role="button" tabindex="0">play</button>
                                        						<button class="jp-next" role="button" tabindex="0">next</button>
                                        						<button class="jp-stop" role="button" tabindex="0">stop</button>
                                        					</div>
                                        					<div class="jp-volume-controls">
                                        						<button class="jp-mute" role="button" tabindex="0">mute</button>
                                        						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                        						<div class="jp-volume-bar">
                                        							<div class="jp-volume-bar-value"></div>
                                        						</div>
                                        					</div>
                                        					<div class="jp-toggles">
                                        						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                        						<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
                                        						<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
                                        					</div>
                                        				</div>
                                        				<div class="jp-details">
                                        					<div class="jp-title" aria-label="title">&nbsp;</div>
                                        				</div>
                                        			</div>
                                        		</div>
                                        		<div class="jp-playlist">
                                        			<ul>
                                        				<!-- The method Playlist.displayPlaylist() uses this unordered list -->
                                        				<li>&nbsp;</li>
                                        			</ul>
                                        		</div>
                                        		<div class="jp-no-solution">
                                        			<span>Update Required</span>
                                        			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                        		</div>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        ++$i;
                        }
                        }
                        ?>
                    </div>
                </div>
			</div>    	
	
                		<div id="song2" class="tab-pane fade">
                			<br/>
			               	Selected songs
			               	<!-- <div id="song"></div> -->
			               	<div class="form-group">
								    <ul id="tree_playlist" class="droptree" >
								       <div id="frmt1" class="demo"></div>
								    </ul>
							</div>
			               	<!-- <a href="#" class="btn btn-primary" id="songsave">Save changes</a> -->
             	 		</div>
        		</div>
        	</div>
    	</div>
    	<div class="right_col tab-pane fade" id="bioDiv">
    		<h2>Set Your Bio</h2>
        	<div class="col-md-12 col-sm-12 col-xs-12">
			    <div class="span3 well">
			        <center>
			        <a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" name="aboutme" width="140" height="140" class="img-circle"></a>
			        <h3><?=$user_data['artist_name']?></h3>
			        <em>click Image for more</em>
					</center>
			    </div>
			    <!-- Modal -->
			    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			        <div class="modal-dialog">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" > <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			                    <h4 class="modal-title" id="myModalLabel">More About <?=$user_data['artist_name']?></h4>
			                </div>
			                <div class="modal-body">
			                    <center>
				                    <img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" name="aboutme" width="140" height="140" border="0" class="img-circle">
				                    <h3 class="media-heading"><?=$user_data['artist_name']?> <small><?=$user_data['city']?></small></h3>
				                    <span><strong>Genre: </strong></span>
			                        <span class="label label-success"><?=$genres['name']?></span>
			                    </center>
			                    <hr>
			                    <strong>Bio: </strong><br>
			                    <center>
				                    <p class="text-left" id="bioParagraph">
				                    	<?=$epk_bio?>
				                    </p>
			                    	<br>
			                    </center>
			                </div>
			                <div class="modal-footer">
			                    <center>
			                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#SetBios" >Edit Bio For EPK</button>
			                    </center>

			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			  

<div class="modal fade" id="SetBios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Your Bio</h4>
      </div>
      <div class="modal-body">
          <div id="message"></div>
          <form class="form-horizontal" method="post">
              <textarea class="form-control" cols="20" rows="20" name="bios" id="bios"><?php echo $epk_bio;?></textarea>                        
              <input type="hidden" id="user_id" value="<?php echo $user_data['id'];?>" name="user_id">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick=" return setBios();">Save changes</button>
      </div>
    </div>
  </div>
</div>

    	
		</div>
		
		<div class="right_col tab-pane fade" id="settingDiv">
        	<div class="container">
        		<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#setting1">Select Nav Menu Display</a></li>
                        <li><a data-toggle="tab" href="#setting2">Select Data Display</a></li>
                        
                  	</ul>
                  	
                  	<div class="tab-content">
                        <div id="setting1" class="tab-pane fade in active">
                        	<form id="form_edit" class="form-horizontal" action="<?php echo base_url()?>artist/presskit/postcustomize" method="post">
                        	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        	<div class="container">
                        		<div class="col-md-6 col-sm-6 col-xs-12">
                        		<div class="panel panel-default ">
                        			<div class="panel-heading">
                        				<h2>Preview EPK Page</h2>
                        				
                        			</div>
                        			<div class="panel-body">
                        			<span>Choose which content you will show and hide</span>
                        				<table class="table table-responsive">
                        		<thead>
                        			<th>Sr No</th>
                        			<th>Menu Name</th>
                        			<th>Display Status</th>
                        		</thead>
                        		<tbody>
                        			
                        				<tr>
	                        			<td>1</td>
	                        			<td>Photos</td>
	                        			<td><input type='checkbox' name="photo" <?php if ($data_customize->photo == 'on') {
    echo 'checked';}?> /></td>
	                        		</tr>
	                        		<tr>
	                        			<td>2</td>
	                        			<td>Videos</td>
	                        			<td><input type="checkbox" name="video"<?php if ($data_customize->video == 'on') {
    echo 'checked';}?> /></td>
	                        		</tr>
	                        		<tr>
	                        			<td>3</td>
	                        			<td>Stats</td>
	                        			<td><input type='checkbox' name="stats" <?php if ($data_customize->stats == 'on') {
    echo 'checked';
}?> /></td>
	                        		</tr>
	                        		<tr>
	                        			<td>4</td>
	                        			<td>Shows</td>
	                        			<td><input type='checkbox' name="show"<?php if ($data_customize->show == 'on') {
    echo 'checked';
}?>/></td>
	                        		</tr>
	                        		<tr>
	                        			<td>5</td>
	                        			<td>Songs</td>
	                        			<td><input type='checkbox' name="song"<?php if ($data_customize->song == 'on') {
    echo 'checked';
}?> /></td>
	                        		</tr>
	                        		<tr>
	                        			<td>6</td>
	                        			<td>Press</td>
	                        			<td><input type='checkbox' name="press"<?php if ($data_customize->press == 'on') {
    echo 'checked';
}?> /></td>
	                        		</tr>
	                        		
                        		</tbody>
                        	</table>
                			</div>
            		</div>	
                    			
        	</div>
                		
                        		<div class="col-md-6 col-sm-6 col-xs-12 ">
                        		<div class="panel panel-default">
                        			<div class="panel-heading">
                        				<h2>MEDIA Downloads Avail to Recipients</h2>
                        				
                        			</div>
                        			<div class="panel-body">
                        				<span>Download Assets</span><br>	
                        				<span>Sometimes people want a hardcopy. Select which assets you'd like to make available for download here. </span>
                        			</div>
                        			<table class="table table-responsive">
                        		<thead>
                        			<th>Sr No</th>
                        			<th>Menu Name</th>
                        			<th>Display Status</th>
                        		</thead>
                        		<tbody>
                        			
                        				<tr>
	                        			<td>1</td>
	                        			<td>Photos</td>
	                        			<td><input type='checkbox' name="dw_photo" <?php if ($data_customize->dw_photo == 'on') {
    echo 'checked';
}?> /></td>
	                        		</tr>
	                        		<tr>
	                        			<td>2</td>
	                        			<td>Bio</td>
	                        			<td><input type="checkbox" name="dw_bios" <?php if ($data_customize->dw_bios == 'on') {
    echo 'checked';
}?> /></td>
	                        		</tr>
	                        		<tr>
	                        			<td>3</td>
	                        			<td>Songs</td>
	                        			<td><input type='checkbox' name="dw_song" <?php if ($data_customize->dw_song == 'on') {
    echo 'checked';
}?> /></td>
	                        		</tr>
	                        		<tr>
	                        			<td>4</td>
	                        			<td>Videos</td>
	                        			<td><input type='checkbox' name="dw_video" <?php if ($data_customize->dw_video == 'on') {
    echo 'checked';
}?>/></td>
	                        		</tr>
	                        		<tr>
	                        			<td>5</td>
	                        			<td>.pdf</td>
	                        			<td><input type='checkbox' name="dw_pdf" <?php if ($data_customize->dw_pdf == 'on') {
    echo 'checked';
}?> /></td>
	                        		</tr>
	                        			
                        		</tbody>
                        	</table>
                        		</div>
                        		
                        		
                        		
                        		</div>
                        		<div class="col-md-12 col-sm-12 col-xs-12 well">
                        			<h3 class="tt mystyle" about="/content_homes1_tittle_new6_14/" style="border-bottom:1px solid #999999; margin-top:9px;">
                        				<span property= "content" id= "content_homes1_tittle_new6_14">
				                            <?php echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_14_s>', 'CONTACT FOR REPLY');
				                            ?>
				                        </span>
				       	            </h3> 
				       	            <div class="tile-body text-center vertical_line">
                        
                        <ul class="list-inline tbox m-0">
                            <li class="b-r tcol">
                                <h2 class="m-0"></h2>
                                 <p  about="/content_homes1_tittle_new6_16/">
                                        <span property= "content" id= "content_homes1_tittle_new6_16">
                                            <?php
                                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_16_s>', "
                                Decide where messages are sent when someone clicks 'Contact' in your Press Kit. 
                                You can set and select from your Artist, Booking, and/or Management email addresses.");
                                            ?>
                                        </span>
                   	            </p>                               
                            </li>
                        </ul>
						
						
                        
						
						 <button class="btn btn-primary"  data-target="#editemail" data-toggle="modal" type="button"> <span class="btn-label" ><i class="fa fa-pencil-square-o"></i></span><a class="btn  wow " data-wow-delay="1.0s" href="#" style="color:white">Artist Email Addresses</a></button>
						<?php ?>
                        <div class="row">
                            <div class="col-md-4 col-xs-4" >
								 <input type="checkbox" name="email_artist" <?php

								  if ($data_customize->email_artist == 'on') {
								    echo 'checked';
								} if (empty($email_contact['email_artist'])) {
								    echo 'disabled';
								}?>/> Artist email 
                             </div>
                             <div class="col-xs-4 col-md-4">
                              	<input type="checkbox" name="email_booking" <?php if ($data_customize->email_booking == 'on') {
    echo 'checked';
} if (empty($email_contact['email_booking'])) {
    echo 'disabled';
}?>/> Booking email
      
                             </div>
                            <div class="col-md-4 col-xs-4" >
                            	 <input type="checkbox" name="manager_email" <?php if ($data_customize->email_manager == 'on') {
    echo 'checked';
} if (empty($email_contact['email_manager'])) {
    echo 'disabled';
}?>/> Management email 
                             </div>
                        </div>
                            
                    </div>
                        		</div>
                        		<div class="col-md-12 col-sm-12 col-xs-12">
                        		<center>
                        			<button class="btn btn-primary" type="submit">Save changes</button>
                        		</center>
                        				
                        		</div>
                        	</div>
                        	</form>
                    	</div>
                		<div id="setting2" class="tab-pane fade">
                			<div class="x_panel col-md-12 col-sm-12 col-xs-12">
                				<div class="x_title col-md-12 col-sm-12 col-xs-12">
                					<h2>Select Info For display</h2>
                				</div>
                				<div class="x_content col-md-12 col-sm-12 col-xs-12">
                				<form id="display_edit" class="form-horizontal" action="<?php echo base_url()?>artist/presskit/update_epk_display_info" method="post">
                				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                					<table class="table table-responsive">
								    	<tr>
								    		<td>Display Songs Count</td>
								    		<td><input type="checkbox" name="song_counts" <?php if ($epk_display_info->song_counts == 'on') {
    echo 'checked';
}?>/></td>
								    	</tr>
								    	<tr>
								    		<td>Display Videos Count</td>
								    		<td><input type="checkbox" name="video_counts" <?php if ($epk_display_info->video_counts == 'on') {
    echo 'checked';
}?>/></td>
								    	</tr>
								    	<tr>
								    		<td>Display Fans Count</td>
								    		<td><input type="checkbox" name="fan_counts" <?php if ($epk_display_info->fan_counts == 'on') {
    echo 'checked';
}?>/></td>
								    	</tr>
								    	<tr>
								    		<td>Display Blogs Count</td>
								    		<td><input type="checkbox" name="blog_counts" <?php if ($epk_display_info->blog_counts == 'on') {
    echo 'checked';
}?>/></td>
								    	</tr>
								    	<tr>
								    		<td>Display Comments Count</td>
								    		<td><input type="checkbox" name="comments_counts"<?php if ($epk_display_info->comments_counts == 'on') {
    echo 'checked';
}?>/></td>
								    	</tr>
								    	<tr>
								    		<td>Display Events Count</td>
								    		<td><input type="checkbox" name="show_counts" <?php if ($epk_display_info->show_counts == 'on') {
    echo 'checked';
}?>/></td>
								    	</tr>
								    	<tr>
                							<td>Display Age breakdown</td>
                							<td><input type="checkbox" name="age_break_down_display" <?php if ($epk_display_info->age_break_down_display == 'on') {
    echo 'checked';
}?>/></td>
                						</tr>
								    	<tr>
								    		<td>Save Changes</td>
								    		<td><button type="submit" id="save_epk_display
" class="btn btn-primary">Save</button></td>
								    	</tr>
								    </table> 
                				</form>
								             					
                				</div>
                			</div>
                		</div>
                		
             	 	</div>
        	</div>
        </div>
	        <div class="right_col tab-pane fade" id="setlimit">
	        	<div class="container">
	        		<h2>Set Limit of photos, Videos and Shows to Display on EPK Template</h2>
	        		<div class="col-md-12">
	        			<form class="form" method="post" id="limitform" onsubmit="return false;">
					        <div class="form-group">
								<label class="form-input col-md-3">Set Photo Limit</label>
								<div class="input-group col-md-8">
									<input type="text"  class="form-control" name="photo_limit" id="photo_limit" value="<?=$epk_data['photo_limit']?>" disabled="disableInput" placeholder="Enter Number to display photo on EPK template" />
								</div>
							</div>  
							<div class="form-group">
								<label class="form-input col-md-3">Set Video Limit</label>
								<div class="input-group col-md-8">
									<input type="text" class="form-control" id="video_limit" name="video_limit" disabled="disableInput" value="<?=$epk_data['video_limit']?>" placeholder="Enter Number to display Video on EPK template" />
								</div>
							</div> 
							<div class="form-group">
								<label class="form-input col-md-3">Set Show Limit</label>
								<div class="input-group col-md-8">
									<input type="text" disabled="disableInput" value="<?=$epk_data['show_limit']?>" class="form-control" id="show_limit" name="show_limit" placeholder="Enter Number to display Show on EPK template" />
								</div>
							</div> 
							<div class="form-group">
								<label class="form-input col-md-3">Set Songs Limit</label>
								<div class="input-group col-md-8">
									<input type="text" value="<?=$epk_data['song_limit']?>" class="form-control" disabled="disableInput" id="song_limit" name="song_limit" placeholder="Enter Number to display Songs on EPK template" />
								</div>
							</div> 
							<div class="form-group">
								<label class="form-input col-md-3">Set Songs Available for Download Limit</label>
								<div class="input-group col-md-8">
									<input type="text" disabled="disableInput" value="<?=$epk_data['download_song_limit']?>" class="form-control" id="download_song_limit" name="download_song_limit" placeholder="Enter Number to display Sogs to download on EPK template" />
								</div>
							</div> 
							<div class="form-group">
								<label class="form-input col-md-3">Set Press Display Limit</label>
								<div class="input-group col-md-8">
									<input type="text" disabled="disableInput" value="<?=$epk_data['press_limit']?>" class="form-control" id="press_limit" name="press_limit" placeholder="Enter Number to display Press on EPK template" />
								</div>
							</div> 
							<div class="form-group">
								<button class="btn btn-primary" id="saveDisplay" onclick="save_content_limit()" style="display: none;">Save Changes</button>
								<button class="btn btn-default" id="editButton" onclick="showButton('saveDisplay');">Edit</button>
							</div> 
			          	</form>
	        			
	        		</div>
	        	</div>
	        	
	        </div>
	        <div class="right_col tab-pane fade" id="setshow">
	        	<div class="container">
		        	<ul class="nav nav-tabs">
	                        <li class="active"><a data-toggle="tab" href="#show1">Select Show</a></li>
	                        <li><a data-toggle="tab" href="#show2">Selected Show</a></li>
	              	</ul>
                  	<div class="tab-content">
                  		<div class="tab-pane fade in active" id="show1">
                  			<h2>Set Show to display on EPK</h2>
	        				<div class="col-md-12 col-sm-12 col-xs-12">
	        					<form id="setShowForm" method="post" onsubmit="return false">
                       				 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                   		
					        		<?php
				                        foreach ($events as $key => $event) {
				                                
				                     ?>
				                    <?php if (!empty($event['event_banner'])) { ?>
					                        <?php
					                            $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; ?>
					                        <?php
					                    } else {
					                        $url_image = base_url().'assets/images/icon/manager_git_event.png';
					                    } ?>
					        			<div class="col-md-6 col-sm-6 col-xs-12 well" id="selectShow_<?=$event['event_id']?>">
					        				<div class="col-md-4 col-sm-4 col-xs-3">
					        				
					        					<img class="img-responsive img-thumbnail" src="<?=$url_image?>">
					        				</div>
					        				<div class="col-md-8 col-sm-8 col-xs-9">
					        					<h2><strong><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></strong></h2>
					        					<table class="table">
					        						<tr>
					        							<td><strong>Location:</strong></td>
					        							<td><?php custom_echo_html($event['location'], 400); ?></td>
					        						</tr>
					        						<tr>
					        							<td><strong>Start:</strong></td>
					        							<td><?php custom_echo_html($event['event_start_date'], 400); ?>  </td>
					        						</tr>
					        						<tr>
					        							<td><strong>To:</strong></td>
					        							<td><?php custom_echo_html($event['event_end_date'], 400); ?></td>
					        						</tr>
					        						<tr>
					        							<td><strong>Capacity:</strong><td>
					        							<td><?php custom_echo_html($event['capacity'], 400); ?><td>
					        						</tr>
					        						<tr>
					        							<td><strong> Star:</strong></td>
					        							<td><?php custom_echo_html($event['sum_star'], 400); ?></td>
					        						</tr>
					        					</table>
					        					
				        						<button class="btn btn-primary" 
				                                 onclick="selectShowEvent('<?=$event['event_id']?>');">Select Event</button>
					        				</div>
					        			</div>
	        					
	        					<?php }?>
	        					</form>
	        				</div>
                  		</div>
                  		<div class="tab-pane fade" id="show2">
                  			<h2>Selected Show</h2>
			        		<div class="col-md-12 col-sm-12 col-xs-12" id="addEvent">
			        		<?php
		                        foreach ($epk_events as $key => $event) {
		                                
		                     ?>
		                    <?php if (!empty($event['event_banner'])) { ?>
			                        <?php
			                            $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; ?>
			                        <?php
			                    } else {
			                        $url_image = base_url().'assets/images/icon/manager_git_event.png';
			                    } ?>
			        			<div class="col-md-6 col-sm-6 col-xs-12 well" id="show_<?=$event['event_id']?>">
			        				<div class="col-md-4 col-sm-4 col-xs-3">
			        				
			        					<img class="img-responsive img-thumbnail" src="<?=$url_image?>">
			        				</div>
			        				<div class="col-md-8 col-sm-8 col-xs-9">
			        					<h2><strong><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></strong></h2>
			        					<table class="table">
			        						<tr>
			        							<td><strong>Location:</strong></td>
			        							<td><?php custom_echo_html($event['location'], 400); ?></td>
			        						</tr>
			        						<tr>
			        							<td><strong>Start:</strong></td>
			        							<td><?php custom_echo_html($event['event_start_date'], 400); ?>  </td>
			        						</tr>
			        						<tr>
			        							<td><strong>To:</strong></td>
			        							<td><?php custom_echo_html($event['event_end_date'], 400); ?></td>
			        						</tr>
			        						<tr>
			        							<td><strong>Capacity:</strong><td>
			        							<td><?php custom_echo_html($event['capacity'], 400); ?><td>
			        						</tr>
			        						<tr>
			        							<td><strong> Star:</strong></td>
			        							<td><?php custom_echo_html($event['sum_star'], 400); ?></td>
			        						</tr>
			        					</table>
			        					
		        						<button class="btn btn-primary" 
		                                 onclick="delete_epk_event('<?=$event['event_id']?>');">Delete Event</button>
			        				</div>
			        			</div>
			        			<?php }?>
			        			
			        			</div>
              			</div>
	        		</div> <!-- tab -->
	        		
	        	</div> <!-- coontainer -->
	        </div> <!-- setshow -->
	        <div class="right_col tab-pane fade" id="setblog">
	        	<div class="container">
		        	<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#blog1">Select Blog</a></li>
                        <li><a data-toggle="tab" href="#blog2">Selected Blog</a></li>
	              	</ul>
                  	<div class="tab-content">
                  		<div class="tab-pane fade in active" id="blog1">
                  			<h2>Set Blogs to display on EPK</h2>
	        				<div class="col-md-12 col-sm-12 col-xs-12">
	        					<form id="setBlogForm" method="post" onsubmit="return false">
                       				 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                   		
					        		<?php
				                        foreach ($blogs as $key => $blog) {
				                     ?>
				                    	<div class="col-md-6 col-sm-6" >
				                    		<article class="articleblog">
				                    			<header >
				                    				<img src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>">
				                    				<h3><a href="<?php echo base_url('artist/blogs').'/'.$blog['user_id']?>"><?=$blog['title'] ?></a>s</h3><!-- -webkit-border-radius: 200px;-moz-border-radius: 200px; -->
				                    				<span><?php echo date('M d, Y', $blog['time'])?> </span>
				                    				<hr>
				                    			</header>
				                    			<div>
				                    				<?php 
                                                $text = strip_tags($blog['introduction']);
    											$desLength = strlen($text);
                                                //var_dump($desLength);exit;            
                                                $stringMaxLength = 120;
											    if ($desLength > $stringMaxLength) {
											        $des = substr($text, 0, $stringMaxLength);
											        $text = $des.'...';
											        echo $text;
											    } else {
											        echo $blog['introduction'];
											    } ?>                          
				                    			</div>
				                    			<div class="clearfix">
				                    				<a href="<?php echo base_url('artist/allblogs').'/'.$blog['user_id'].'/'.$blog['id']?>"><button class="btn btn-primary pull-right">Read More</button></a>
			                    					<button onclick="selectBlog(<?=$blog['id']?>)" class="btn btn-primary pull-right">Select Blog</button>
			                    				</div>
				                    		</article>
				                    	</div>
	        					
	        					<?php }?>
	        					</form>
	        				</div>
                  		</div>
                  		<div class="tab-pane fade" id="blog2">
                  			<h2>Selected Blogs</h2>
			        		<div class="col-md-12 col-sm-12 col-xs-12" id="addBlog">
				        		<?php
				        			if(!empty($epk_blogs))
				        			{


			                        foreach ($epk_blogs as $key => $blog) {
			                                
			                     ?>
		                    		<div class="col-md-6 col-sm-6" id="blog_<?=$blog['id']?>">
				                    		<article class="articleblog">
				                    			<header >
				                    				<img src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>" >
				                    				<h3><a href="<?php echo base_url('artist/blogs').'/'.$blog['user_id']?>"><?=$blog['title'] ?></a></h3><!-- -webkit-border-radius: 200px;-moz-border-radius: 200px; -->
				                    				<span><?php echo date('M d, Y', $blog['time'])?> </span>
				                    				<hr>
				                    			</header>
				                    			<div>
				                    				<?php 
                                                $text = strip_tags($blog['introduction']);
    											$desLength = strlen($text);
                                                //var_dump($desLength);exit;            
                                                $stringMaxLength = 120;
											    if ($desLength > $stringMaxLength) {
											        $des = substr($text, 0, $stringMaxLength);
											        $text = $des.'...';
											        echo $text;
											    } else {
											        echo $blog['introduction'];
											    } ?>                          
				                    			</div>
				                    			<div class="clearfix">
				                    				<a href="<?php echo base_url('artist/allblogs').'/'.$blog['user_id'].'/'.$blog['id']?>"><button class="btn btn-primary pull-right">Read More</button></a>
			                    					<button onclick="delete_epk_blog(<?=$blog['id']?>)" class="btn btn-primary pull-right">Delete Blog</button>
			                    				</div>
				                    		</article>
				                    	</div>
			        			<?php }

			        			}?>
			        			
		        			</div>
              			</div>
	        		</div> <!-- tab -->
	        		
	        	</div> <!-- coontainer -->
	        </div> <!-- setshow -->
	        <div class="right_col tab-pane fade" id="setpress">
	        	<div class="container">
		        	<ul class="nav nav-tabs">
	                        <li class="active"><a data-toggle="tab" href="#press1">Select Press</a></li>
	                        <li><a data-toggle="tab" href="#press2">Selected Press</a></li>
	              	</ul>
                  	<div class="tab-content">
                  		<div class="tab-pane fade in active" id="press1">
                  			<h2>Set press to display on EPK</h2>
	        				<div class="col-md-12 col-sm-12 col-xs-12">
	        					<form id="setPressForm" method="post" onsubmit="return false">
                       				 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                   		
					        		<?php
					        		if(!empty($press_data)){


			                        foreach ($press_data as $key => $press) {
				                        // var_dump($press);     	   
				                     ?>
				                     	<div class="col-md-6 col-sm-6 col-xs-12" >
				                     		<div class="card">
											  	<div class="card-header">
											   		<?=$press['name']?>
											  	</div>
											  	<div class="card-block">
												    <blockquote class="card-blockquote">
												      <p><?=$press['quote']?></p>
												      <span>By :- <cite title="Source Title"><?=$press['author']?></cite></span>
												    </blockquote>
											  	</div>
											  	<div class="card-footer text-muted">
												    Published On <?=$press['date_on']?>
												    <button onclick="select_epk_press(<?=$press['id']?>)" class="btn btn-primary pull-right">Select Press</button>
								  				</div>
								  				
											</div>
				                     	</div>

        								 		
	        					<?php } }?>
	        					</form>
	        				</div>
                  		</div>
                  		<div class="tab-pane fade" id="press2">
                  			<h2>Selected press</h2>
			        		<div class="col-md-12 col-sm-12 col-xs-12" id="addPress">
			        		<?php
			        			if(!empty($epk_press))
			        			{
		                        	foreach ($epk_press as $key => $press) 
		                        	{
	                     	?>
		                    		<div class="col-md-6 col-sm-6 col-xs-12" id="press_<?=$press['id']?>">
				                     		<div class="card">
											  	<div class="card-header">
											   		<?=$press['name']?>
											  	</div>
											  	<div class="card-block">
												    <blockquote class="card-blockquote">
												      <p><?=$press['quote']?></p>
												      <span>By :- <cite title="Source Title"><?=$press['author']?></cite></span>
												    </blockquote>
											  	</div>
											  	<div class="card-footer text-muted">
												    Published On <?=$press['date_on']?>
												    <button onclick="delete_epk_press(<?=$press['id']?>)" class="btn btn-primary pull-right">Delete Press</button>
								  				</div>
								  				
											</div>
				                     	</div>
		        			<?php 
		        					}
		        				}
		        			?>
			        			
			        		</div>
              			</div>
	        		</div> <!-- tab -->
	        		
	        	</div> <!-- coontainer -->
	        </div> <!-- setshow -->
	        <div class="right_col tab-pane fade" id="uploadDiv">
	        	<div class="container">
                            <div class="row">
                                
		        	<div class="col-sm-8 col-xs-8 col-md-8 col-md-offset-2">
                                    

<div class="panel panel-info panel-custom">
  <div class="panel-heading">
    <h3 class="panel-title">Upload New Media</h3>
  </div>
  <div class="panel-body">
       <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-3 margintop-20">
       <a href="<?php echo base_url().'artist/managervideo'?>" class="btn btn-default btn-default-custom btn-block">Upload New Video</a>
       </div>
      <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-3 margintop-20">
		                    <a href="<?php echo base_url().'artist/managerphoto'?>" class="btn btn-default btn-default-custom btn-block">Upload New Photo</a>
      </div>          
      <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-3 margintop-20">
                                    <a href="<?php echo base_url().'artist/managersong'?>" class="btn btn-default btn-default-custom btn-block">Upload New Song</a>
      </div>           
      <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-3 margintop-20">
                                    <a href="<?php echo base_url().'artist/managerpress'?>" class="btn btn-default btn-default-custom btn-block">Upload New Press</a>
      </div>       
      <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-3 margintop-20">
                                    <a href="<?php echo base_url().'artist/blogsmanager'?>" class="btn btn-default btn-default-custom btn-block">Upload New Blogs</a>
      </div>                
  </div>
</div>
		        		
		               
		            </div> 
                            </div>
	        	</div> <!-- coontainer -->
	        </div> <!-- setshow -->
	        <div class="right_col tab-pane fade" id="editDiv">
	        	<div class="container">
		        	<div class="col-sm-12 col-xs-12">
		        		<h1>To Edit media click on Following Links</h1>
		                <ul>
		                    <a href="<?php echo base_url().'artist/managervideo'?>"><li>Edit Video</li></a>
		                    <a href="<?php echo base_url().'artist/managerphoto'?>"><li>Edit Photo</li></a>
		                    <a href="<?php echo base_url().'artist/managersong'?>"><li>Edit Song</li></a>
		                    <a href="<?php echo base_url().'artist/managerpress'?>"><li>Edit Press</li></a>
		                    <a href="<?php echo base_url().'artist/blogsmanager'?>"><li>Edit Blogs</li></a>
		                </ul>
		            </div>  
	        	</div> <!-- coontainer -->
	        </div> <!-- setshow -->
	        <div class="right_col tab-pane fade" id="sendepk">
	        	<div class="container" id="sendmail">
	        	 	<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#sendEpkMail1">Select Press</a></li>
                        <li><a data-toggle="tab" href="#sendEpkMail2">Selected Press</a></li>
	              	</ul>
	              	<div class="tab-content">
                  		<div class="tab-pane fade in active" id="sendEpkMail1">

		        	<div class="col-md-12 col-sm-12 col-xs-12">
		        		<form class="form form-signup searchform" id="send_email_epk" role="form" action="<?php echo base_url()?>artist/presskit/sendmail" method="post">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
					<div class="intro">
						<p> When you email your EPK through 99Sound, we'll track when the email is opened along with
							interaction that each recipient takes on your EPK.
						</p>
					</div>
                    <div class="form-group">
						<label class="form-input col-md-3 col-sm-3"> Choose Template Email:</label>
						<div class="input-group col-md-8 col-sm-8">
                            <div class="epk-tpl_box_scroll">
                            
                                <ul>
                                <?php  for($i=1;$i<=6;$i++){ ?>
                                <li class="<?php if($epk->tpl_epk==$i) echo 'selected' ?>">
                                    <input type="hidden" class="hidden-val" value="<?= $i?>" />
                                    <a class="clearbg" href="#myModal" data-toggle="modal" data-target="#preview" data-img-url="<?php echo base_url()?>assets/images/email_tpl/tpl_email_epk<?=$i?>.png">
                                    <img style="width: 65px; height: 52px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>assets/images/email_tpl/tpl_email_epk<?=$i?>.png"/>
                                    </a>
                                    <span>Template <?= $i?></span>
                                </li>
                                <?php } ?>   
                                </ul> 
                            </div>
                            
							
                          	<input type="hidden" class="form-control" rows="6" name="tpl_email" id="tpl_email" value="<?php echo $epk->tpl_epk ?>"/>
                        </div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3 col-sm-3">From:</label>
						<div class="input-group col-md-8 col-sm-8">
							<input type="email" class="form-control" name="from" value="<?php echo $user_data['email']?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3 col-sm-3">Subject:</label>
						<div class="input-group col-md-8 col-sm-8">
							<input type="text"class="form-control" name="subject" value="<?php echo 'View press kit for '.$user_data['artist_name']?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3 col-sm-3">Message:</label>
						<div class="input-group col-md-8 col-sm-8">
							<textarea class="form-control" rows="6" name="msg" id="msg">Hi, thank you for your visiting our website. Let's click "view press kit" to listen to samples of new music, view photos and more interesting things. You may reply directly to this email or click the "contact" button from press kit if you would like to follow up. Thanks!
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3">Send to:</label>
						<div class="input-group col-md-8">
                            <div class="epk-sendto-email" >
                                <ul>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                  <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                </ul>
                                <button type="button" class="btn btn-primary" onclick='addExtraInput()'> Add Extra Email Field</button> 
                            </div>
						</div>
                        
					</div>
				</div>
                                
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" onclick='document.getElementById("send_email_epk").submit();'> Send</button> 
				</div>
			</form>
		            </div> 
		            
            </div>
            		<div class="tab-pane fade" id="sendEpkMail2">
		            	<div class="row">
                          <div class="action text-center wow " style="border-radius:0px; box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);">
                            <div style="text-align: left;">                                
                                     <h4 class="tt" about="/content_homes1_tittle_new3_11/">
                                        <span property= "content" id= "content_homes1_tittle_new3_11">
                                            <?php
                                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'ACTIONS');
                                            ?>
                                        </span> 
                                    </h4>
                                    <span class="liner"></span>
                                </div>
                            <div class="tile-body text-center p-0">
                                <ul class="events-action list-inline tbox m-0">
                                    <?php
                                        foreach ($statsrpk as $row) {
                                            ?>
                        			<li>
                        				<span  class="rect image_frame"><img width="50" height="50" alt="xgdfh" src="<?php echo $avata?>" title="xgdfh"></span>
                        				<div class="text" style="color:#000000;">
                        					<a href="<?php echo base_url().$user_data['home_page']?>">You</a> sent your epk to add [<?php echo $row['email_to']?>] <span> <?php echo $controller->time_calculation($row['time'])?></span>
                        				</div>
                        			</li>
                                    
                        			<?php
                                    //if(end($statsrpk)!=$row)
                                     //echo '<hr/>';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
		            </div>
            </div> 
        	</div> <!-- coontainer -->
	        </div> <!-- setshow -->
	        <div class="right_col tab-pane fade" id="shareepk">
	        	<div class="container">
		        	<div class="col-sm-12 col-xs-12">
		        		<div class="modal-header">
			                <h4 class="tt">Share EPK</h4>
			                <span class="liner"></span>
			    		</div>
    		<div class="modal-body share_btn">
    			<p>Use Twitter or Facebook to share your EPK.</p>
    			<p>
                    <a class="btn btn-block btn-social btn-twitter" href="https://twitter.com/intent/tweet?original_referer=<?php echo base_url().'epk/'.$user_data['home_page']?>&text=Sound%20House%20Promotions%20%7C%20Connect%20with%20Fans&tw_p=tweetbutton&url=<?php echo base_url().'epk/'.$user_data['home_page']?>"
        				onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
        			<i class="fa fa-twitter"></i> Share Twitter
        			</a>
                </p>
                <p>
                <!-- https://www.facebook.com/dialog/feed?app_id=373331799684974&display=popup&caption='99sound'&link=<?php echo base_url().'epk/'.$user_data['home_page']?>&redirect_uri=<?php echo base_url().'epk/'.$user_data['home_page']?>&description=<?php echo $user_data['bio']?>&picture=<?php echo $avata?>&source=<?php echo $avata?> -->
  <!--  -->

        			<!-- <a class="btn btn-block btn-social btn-facebook" 
        				onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
        			<i class="fa fa-facebook"></i> Share Facebook
        			</a> -->
        			
        			<button class="btn btn-block btn-social btn-facebook"  id="shareBtn"><i class="fa fa-facebook"></i> Share Facebook</button>
        			<script type="text/javascript">
					document.getElementById('shareBtn').onclick = function() {
						
				  FB.ui({
				    method: 'share',
				    display: 'popup',
				    title: '<?=$user_data['home_page']?>',  // The same than name in feed method
				    picture: '<?php echo $avata?>',  
				    caption: '<?=$user_data['home_page']?>',  
				    href: "<?php echo base_url().'epk/'.$user_data['home_page']?>",
				  }, function(response){
				});
			}
			</script>

                </p>
                
    			<script>
    				!function(d,s,id){
    				    var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
    				    if(!d.getElementById(id)){
    				        js=d.createElement(s);
    				        js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
    				        fjs.parentNode.insertBefore(js,fjs);
    				    }
    				}(document, 'script', 'twitter-wjs');
    			</script>   
    		</div>
		            </div>  
	        	</div> <!-- coontainer -->
	        </div> <!-- setshow -->
        </div>
      </div>
         <!-- Modal choose -->
<div class="modal fade new_modal_style " id="choose-tpl" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Choose A Template-EPK</h4>
                <span class="liner"></span>
            </div>            
            <div class="modal-body searchform">
                <div class="alp-template_box">
                    <ul class="sortable with_main_songs"> 
                     <?php
                     foreach ($epks as $epk1) {
                         ?>
                            <li class="<?php if ($user_data['tpl_epk'] == $epk1['position']) {
    echo 'selected';
} ?>">
                                <input type="hidden" class="hidden-val" value="<?= $epk1['position']?>" />
                                <input type="hidden" class="hidden-img" value="<?php echo base_url()?>uploads/templates/epk/<?php echo $epk1['images'] ?>" />
                                <img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>uploads/templates/epk/<?php echo $epk1['images'] ?>"/>
                                <span>Template EPK <?= $epk1['position']?></span> 
                                <a class="btn btn-default pull-right btn-preview" data-toggle="modal" data-target="#preview-tpl">Preview</a>
                            </li>
                            <?php

                     }
                    ?>   
                    </ul>
                </div>
            </div>
            <div class="modal-footer searchform">
                <form action="<?php echo base_url()?>artist/update_tplepk" method="post" name="setTemplate">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" name="template_epk" id="template_epk" value="<?=$user_data['tpl_epk']?>" />
                    <input type="hidden" name="id_artist"  value="<?php echo $user_data['id']?>" />
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>
            </div>          
        </div>
    </div>
</div>
<!-- Modal preview -->
<div class="modal fade new_modal_style" id="preview-tpl" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Preview EPK page</h4>
                <span class="liner"></span>
            </div>            
            <div class="modal-body">
                <img id="pre-img" src="" width="100%" />
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>          
        </div>

    </div>
</div>

</div>


  <div class="modal fade new_modal_style" id="editemail" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              
                <h4 class="tt" about="/content_homes1_tittle_new6_15/">
                        <span property= "content" id= "content_homes1_tittle_new6_15">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_15_s>', 'Artist Email Addresses');
                            ?>
                        </span>
   	            </h4> 
                <span class="liner"></span>
                
            </div>  
            <form class="form form-signup searchform" id="update_pt" role="form" method="post">          
               <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                
    				<div class="modal-body">
    					<div class="form-group">
    						<label class="form-input col-md-5">Artist Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email" class="form-control" name="artist_email" value="<?php echo $email_contact['email_artist']?>" id="m_artist_email"/>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="form-input col-md-5">Booking Info Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email" class="form-control" id="m_booking_email" name="booking_email" value="<?php echo $email_contact['email_booking']?>"/>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="form-input col-md-5">Management Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email" class="form-control" id="m_manager_email" name="manager_email" value="<?php echo $email_contact['email_manager']?>"/>
    						</div>
    					</div>
    				</div>
                </div> 
    			<div class="modal-footer">
    				<button type="button" class="btn btn-primary " onclick="saveArtistEmail()">Save</button>    
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
    			</div>   
            </div>
        </form>
    </div>
</div>
<div class="modal new_modal_style" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				 
                <h4 class="tt">Email EPK</h4>
                <span class="liner"></span>
			</div>
            <div class="modal-body" >
                <div id="template1">
                    <img class="img-responsive" src="#" />
                </div>
				<div class="modal-footer">  
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>                                
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div id="videoorg"></div>
        <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>
    </div>
</div>
<div class="modal fade" id="vimeo_videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <iframe id="vimeo_video"  width="640" height="337" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        
        <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/crop-image/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.js"></script>
<script src="<?=base_url('assets/js/ckeditor/ckeditor.js')?>"></script>
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.form.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>

<script src="<?php echo base_url()?>assets/js/newrpk/sweetalert.min.js"></script>
<script src="<?php echo base_url()?>assets/js/newrpk/jquery.onoff.min.js"></script>
<script src="<?php echo base_url()?>assets/js/newrpk/custom.js"></script>
<script>
    $('input[type=checkbox]').onoff();
</script>
<script>                
    CKEDITOR.replace('bios');
</script>
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script type="text/javascript">
	(function($) {
    $(window).load(function() {
        $("#sendmail .modal-body").mCustomScrollbar();
        $("#preview .modal-body").mCustomScrollbar();
        $("#choose-tpl .modal-body").mCustomScrollbar();
        $("#preview-tpl .modal-body").mCustomScrollbar();
    });
})(jQuery);

var disableInput = "disabled";
$(document).on('change', '#background_image_upload', function() {
    var progressBar1 = $('.progressBar1'),
        bar1 = $('.progressBar1 .bar1'),
        percent1 = $('.progressBar1 .percent1');

    $('#background1').ajaxForm({

        beforeSend: function() {
            progressBar1.fadeIn();
            var percentVal = '0%';
            bar1.width(percentVal)
            percent1.html(percentVal);

        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar1.width(percentVal)
            percent1.html(percentVal);

        },
        success: function(html, statusText, xhr, $form) {
            obj = $.parseJSON(html);

            if (obj.status) {
                var percentVal = '100%';
                bar1.width(percentVal)
                percent1.html(percentVal);
                $("#img1>img").prop('src', obj.image_medium);
                $("#img2>img").prop('src', obj.image_medium);
                //$("#profilepic").prop('value',obj.image_medium);
                showdiv('backgrounds');
            } else {
                alert(obj.error);

            }
        },
        complete: function(xhr) {
            progressBar1.fadeOut();
        }
    }).submit();

});

$(function() {
    update_image();
});

function displayEpk(url) {
    var win = window.open(url, '_blank');
    win.focus();
}

//Function to set bios for EPk
function setBios() {
    user_id = $('#user_id').val();
    bios = CKEDITOR.instances['bios'].getData();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/update_bios",
        type: "POST",
        data: {
            user_id: user_id,
            bios: bios,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",
        success: function(msg) {
            $('#message').html('<div class="alert alert-success">Bios Updated Successfully.</div>');
            $('#SetBios').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

//Function to update EPK Image
function update_image() {
    $.getJSON("<?php echo base_url();?>artist/presskit/get_image", function(data1) {
        $("div#backgrounds").empty();

        $.each(data1.json, function() {

            $("div#backgrounds").append('<div class="col-md-3 col-md-offset-0 col-xs-offset-2 col-xs-8 portfolio-item"><a href="#" onclick=changeimg("' + this['imgN'] + '");><img style="width:750px;height:250px" class="img-responsive img-thumbnail" src="' + this['image'] + '" alt="' + this['caption'] + '"></a></div>');
        });

    });
}

//Function to display div
function showdiv(id) {
    if (id == 'backgrounds') {
        $("#backgrounds").show();
        $("#uploadnewphoto").hide();
    } else {
        $("#uploadnewphoto").show();
        $("#backgrounds").hide();
    }
}

function imgfun(id) {
    $('.rmv').removeClass('imgdesgin');
    $('#ism' + id).addClass('imgdesgin');
    $('#btnsave').attr("onclick", "changeimg(" + id + ")");
}
//Function to change EPK image 
function changeimg(nid) {
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/update_img/" + nid,
        success: function(msg) {

            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_epk_photo/"+<?=$user_id?>,
                dataType: 'json',
                success: function(msg) {
                    $('#adddiv').empty();

                    $.each(msg, function() {
                        $('#adddiv').append("<div class='col-md-3 col-md-offset-0 col-xs-offset-2 col-xs-8 portfolio-item' id='photo_" + this['id'] + "'><img class='img-responsive' style='width:750px;height:250px' src='<?php echo base_url(); ?>uploads/" + this['user_id'] + "/photo/" + this['filename'] + "' alt='" + this['caption'] + "' ><a onclick='delete_epk_photo(" + this['id'] + ")'><span class='close'></span></a></div>");
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            swal(
                'Good job!',
                'Profile Image Update succesfully!',
                'success'
            );
            // alert("Profile Image Update succesfully");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
//Function to select Event for EPK
function selectShowEvent(event_id) {
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>artist/presskit/set_show',
        dataType: "text",
        data: {
            'event_id': event_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        success: function(datatest) {
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_shows/"+<?=$user_id?>,
                dataType: 'json',
                success: function(msg) {
                    $('#addEvent').empty();
                    swal(
                        'Good job!',
                        'Show selected succesfully!',
                        'success'
                    );
                    $.each(msg, function() {
                        var url_image = "";
                        if (this['event_banner'] !== null || this['event_banner'] !== "") {
                            url_image = "<?php echo base_url()?>" + 'uploads/' + this['user_id'] + '/photo/banner_events/' + this['event_banner'];
                        } else {
                            url_image = "<?php echo base_url()?>assets/images/icon/manager_git_event.png";
                        }

                        $('#addEvent').append("<div class='col-md-6 col-sm-6 col-xs-12 well' id='show_" + this['event_id'] + "'><div class='col-md-4 col-sm-4 col-xs-3'><img class='img-responsive img-thumbnail' src='" + url_image + "'></div><div class='col-md-8 col-sm-8 col-xs-9'><h2><strong><a href='<?=base_url()?>'gigs_events/read/'" + this['event_title'] + "'-'" + this['event_id'] + "'>" + this['event_title'] + "</a></strong></h2><table class='table'><tr><td><strong>Location:</strong></td><td>" + this['location'] + "</td></tr><tr><td><strong>Start:</strong></td><td>" + this['event_start_date'] + "</td></tr><tr><td><strong>To:</strong></td><td>" + this['event_end_date'] + "</td></tr><tr><td><strong>Capacity:</strong><td><td>" + this['capacity'] + "<td></tr><tr><td><strong> Star:</strong></td><td>" + this['sum_star'] + "</td></tr></table><button class='btn btn-primary' onclick='delete_epk_event(" + this['event_id'] + ");'>Delete Event</button></div></div>")

                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

        }
    });
}
//Function to Select blog for EPk
function selectBlog(blog_id) {
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>artist/presskit/set_blog',
        dataType: "text",
        data: {
            'blog_id': blog_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        success: function(datatest) {
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_blogs/"+<?=$user_id?>,
                dataType: 'json',
                success: function(msg) {
                    $('#addBlog').empty();
                    swal(
                        'Good job!',
                        'Blog selected succesfully!',
                        'success'
                    );
                    $.each(msg, function() {
                        var utcSeconds = this['time'];
                        var d = new Date(); // The 0 there is the key, which sets the date to the epoch

                        $('#addBlog').append("<div class='col-md-6 col-sm-6' id='blog_" + this['id'] + "'><article class='articleblog'><header ><img src='<?php echo base_url()?>uploads/" + this['user_id'] + "/photo/blogs/" + this['image_rep'] + "' ><h3><a href='<?php echo base_url()?>artist/blogs/" + this['user_id'] + "'>'" + this['title'] + "</a></h3><span>" + d.setUTCSeconds(utcSeconds) + "</span><hr></header><div>" + this['introduction'] + "</div><div class='clearfix'><a href='<?php echo base_url()?>'artist/allblogs/'" + this['user_id'] + "'/'" + this['id'] + "''><button class='btn btn-primary pull-right'>Read More</button></a><button onclick='delete_epk_blog(" + this['id'] + ")' class='btn btn-primary pull-right'>Delete Blog</button></div></article></div>");
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
}
//Function to select blog
function select_epk_press(press_id) {
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>artist/presskit/select_epk_press',
        dataType: "text",
        data: {
            'press_id': press_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        success: function(datatest) {
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_press/"+<?=$user_id?>,
                dataType: 'json',
                success: function(msg) {
                    $('#addPress').empty();
                    swal(
                        'Good job!',
                        'Press selected succesfully!',
                        'success'
                    );
                    $.each(msg, function() {
                        $('#addPress').append("<div class='col-md-6 col-sm-6 col-xs-12' id='press_" + this['id'] + "'><div class='card'><div class='card-header'>" + this['name'] + "</div><div class='card-block'><blockquote class='card-blockquote'><p>" + this['quote'] + "</p><span>By :- <cite title='Source Title'>" + this['author'] + "</cite></span></blockquote></div><div class='card-footer text-muted'>Published On " + this['date_on'] + "<button onclick='delete_epk_press(" + this['id'] + ")' class='btn btn-primary pull-right'>Delete Press</button></div></div></div>");
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
}

function delete_epk_press(press_id) {
    var divId = '#press_' + press_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_press",
        type: "POST",
        data: {
            'press_id': press_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {},
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_photo(photo_id) {
    var divId = '#photo_' + photo_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_photo",
        type: "POST",
        data: {
            'photo_id': photo_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {},
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function save_content_limit() {
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/save_content_limit",
        type: "POST",
        data: {
            'photo_limit': $("#photo_limit").val(),
            'video_limit': $("#video_limit").val(),
            'show_limit': $("#show_limit").val(),
            'download_song_limit': $("#download_song_limit").val(),
            'song_limit': $("#song_limit").val(),
            'press_limit': $("#press_limit").val(),
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {
            $("#saveDisplay").hide();
            $("#editButton").show();
            $("#limitform input").attr('disabled', 'disabled');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function showButton(id) {
    var Id = '#' + id;
    $("#limitform input").removeAttr('disabled');
    $(Id).show();
    $("#editButton").hide();
}

function fetch_video(user_id) {
    $.ajax({
        url: "<?php echo base_url();?>artist/Presskit/video_list/" + user_id,
        success: function(data) {
            $('#video').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function setvideo(nid) {
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/update_video/" + nid,
        success: function(msg) {
            swal(
                'Good job!',
                'Profile Video Update succesfully!',
                'success'
            );
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_epk_video/"+<?=$user_id?>,
                dataType: 'json',
                success: function(msg) {
                    $('#addVideoDiv').empty();

                    $.each(msg, function() {
                        if (this['type'] == 'file') {
                        	var link_video = "<?php echo base_url()?>uploads/"+ this['user_id'] + "/video/" + this['name_file'];
                            $('#addVideoDiv').append("<div class='col-md-4 col-sm-6 col-xs-12 portfolio-item' id='video_" + this['id'] + "'><a href='#videos'  data-toggle='modal' data-target='#videos' onclick=playvideo('" + link_video +"')><div class='embed-responsive embed-responsive-16by9' style='background-image:url(<?php echo base_url()?>uploads/" + this['user_id'] + "/video/" + this['cover_image'] + ");background-position: center;background-size: 100% 100%'></div></a><a onclick='delete_epk_video(" + this['id'] + ")' title='Delete video from EPK'><i class='fa fa-times closeBtn' aria-hidden='true'></i></a></div>");
                        } else if(this['type'] == 'link-vimeo')
                        {
                        		var thumbnail_src = "";
				               	var str = this['link_video'];
                        		var n = str.indexOf("vimeo.com");
                            	var videoId = "";
                            	if (n) {
	                                var videoArr = str.split("/");
	                                var id = videoArr[3];
	                            }
				               	var url = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumb";
				               $.ajax({
						        type:'GET',
						        url: url,
						        jsonp: 'callback',
						        dataType: 'jsonp',
						        success: function(data){
						             thumbnail_src = data[0].thumbnail_large;
						             var link_video = 'https://player.vimeo.com/video/'+data[0].id+'?title=0&byline=0&portrait=0';
						             $('#addVideoDiv').append("<div class='col-md-4 col-sm-6 col-xs-12 portfolio-item' id='video_" + this['id'] + "'><a href='#vimeo_videos'  data-toggle='modal' data-target='#vimeo_videos' onclick=play_vimeo_video('"+link_video+"')><div class='embed-responsive embed-responsive-16by9' style='background-image:url("+ thumbnail_src +");background-position: center;background-size: 100% 100%'></div></a><a onclick='delete_epk_video(" + this['id'] + ")' title='Delete video from EPK'><i class='fa fa-times closeBtn' aria-hidden='true'></i></a></div>");
						        }
						    });
										               	
                        }
                        else
                         {

                            var str = this['link_video'];
                            var n = str.indexOf("youtube.com");
                            var videoId = "";
                            if (n) {
                                var videoArr = str.split("v=");

                                if (videoArr[1].indexOf("&")) {
                                    var temp = videoArr[1].split("&");
                                    videoId = temp[0];
                                } else {
                                    videoId = videoArr[1];
                                }
                            }
                            $('#addVideoDiv').append("<div class='col-md-4 col-sm-6 col-xs-12 portfolio-item' id='video_" + this['id'] + "'><a href='#videos'  data-toggle='modal' data-target='#videos' onclick=playvideo('" + this['link_video'] +"')><div class='embed-responsive embed-responsive-16by9' style='background-image:url(https://img.youtube.com/vi/"+videoId+"/default.jpg);background-position: center;background-size: 100% 100%'></div></a><a onclick='delete_epk_video(" + this['id'] + ")' title='Delete video from EPK'><i class='fa fa-times closeBtn' aria-hidden='true'></i></a></div>");
                        }

                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });


            // alert("Profile Video Update succesfully");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_video(video_id) {

    var divId = '#video_' + video_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_video",
        type: "POST",
        data: {
            'video_id': video_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Success!',
                'Video deleted succesfully!',
                'success'
            );
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_event(event_id) {
    var divId = '#show_' + event_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_event",
        type: "POST",
        data: {
            'event_id': event_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Success!',
                'Show deleted succesfully!',
                'success'
            );
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_blog(blog_id) {
    var divId = '#blog_' + blog_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_blog",
        type: "POST",
        data: {
            'blog_id': blog_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {},
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
$('#form_edit').on('click', '#publish_save', function() {
    $('#form_edit').submit();
});
$('#display_edit').on('click', '#save_epk_display', function() {
    $('#display_edit').submit();
});

function fetch_song() {
    $.ajax({
        url: "<?php echo base_url();?>artist/audio/album_list",
        success: function(data) {
            $('#myModal3').modal('show');
            $('#song').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }

    });
}

function get_song_list(id) {
    $.ajax({
        url: "audio/test/" + id,

        success: function(data) {
            $('#song').html(data);
            //alert(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function get_song_choose(albumid) {
    $.ajax({
        url: "audio/update_primary_song_user/" + albumid,

        success: function(data) {
            $('#myModal3').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

}

function get_song_select(id) {
    $('.rmvsong').removeClass('songdesgin');
    $('#song' + id).addClass('songdesgin');

    $('#songsave').attr("onclick", "get_song_choose(" + id + ")");

}

$(document).ready(function() {
    $('#wrapper-banner').hide();
    $('.banner-save').hide();
    $('.banner-input').change(function() {
        $('#wrapper-banner').show();
        $('.banner-save').show();
    });

});


(function($) {

    $(".changeimages").click(function() {
        var value = $(this).parent().find(".hidden-img").val();
        $("#preview-tpl").find("#alp-pre-img").attr("src", value);
    });
    $(".image-banner .banner-input").css("display", "none");
    $(".button_changebanner").click(function() {
        $(".image-banner .banner-input").click();
        return false;
    })
})(jQuery);

$(document).ready(function() {
    $('#choose-tpl').on('click', 'ul li', function() {
        $("#choose-tpl ul li").each(function() {
            $(this).removeClass("selected");
            $(this).addClass("");
        });
        $(this).addClass("selected");
        var tpl_vl = $(this).find('.hidden-val').val();
        $("#template_epk").val(tpl_vl);
    });

    $('#choose-tpl').on('click', '.btn-preview', function() {
        var parent = $(this).parent();
        var src = parent.find('.hidden-img').val();
        $("#pre-img").attr("src", src);
    });

});

function saveArtistEmail() {
    $("#editemail").modal('hide');
    $.ajax({
        url: "<?php echo base_url()?>artist/presskit/email_contact",
        type: "POST",
        data: {
            'artist_email': $('#m_artist_email').val(),
            'booking_email': $('#m_booking_email').val(),
            'manager_email': $('#m_manager_email').val(),
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Good job!',
                'Email Updated Successfully!',
                'success'
            );

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function update_epk_display_info() {
    $.ajax({
        url: "<?php echo base_url()?>artist/presskit/update_epk_display_info",
        type: "POST",
        data: {
            'comments_counts': $('#m_artist_email').val(),
            'video_counts': $('#m_booking_email').val(),
            'fan_counts': $('#m_artist_email').val(),
            'song_counts': $('#m_booking_email').val(),
            'blog_counts': $('#m_artist_email').val(),
            'show_counts': $('#m_booking_email').val(),
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Good job!',
                'Email Updated Successfully!',
                'success'
            );

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
$(document).ready(function() {
        $('#sendmail').on('click','.epk-tpl_box_scroll ul li', function (){
            $( ".epk-tpl_box_scroll ul li" ).each(function() {
                $(this).removeClass("selected");
                $(this).addClass( "" );
            });
            $(this).addClass( "selected" );
            var tpl_vl = $(this).find('.hidden-val').val();
            $( "#tpl_email" ).val(tpl_vl);
        });
        
        $('#sendmail').on('click','.myButton', function (){
            var parent = $(this).parent().parent();
            var messager = $('#msg').val();
            var value_epk = parent.find('.hidden-val').val();
             $.ajax({
             type: "POST",
             url: '<?=base_url()?>' + "artist/managerrpk/load_tpl_email/"+value_epk ,
             dataType: "text",
             data: {'msg':messager},
             success: function(datatest) {
                     $('#template1').html(datatest);
                     $('#template1').show();
                    $('#template2').hide();
                 }
             });
	    });
        
	});
$('.epk-tpl_box_scroll ul li a').click(function(e) {
  $('#preview img').attr('src', $(this).attr('data-img-url'));
});
function addExtraInput()
{
    var ele = '<li> <div class="col-sm-6"><input type="email"class="form-control" name="emailto[]" placeholder="Email" /></div><div class="col-sm-6"><input type="text"class="form-control" name="nameto[]" placeholder="Name (for tracking)"/></div></li>';
    $('.epk-sendto-email ul').append(ele);
}

function playvideo(link_video){
    $link_vd = link_video;              
    var playerInstance = jwplayer("videoorg");
    jwplayer("videoorg").setup({
    	stretching: 'fill',
    	file: $link_vd,            	
        width: "100%",            
        aspectratio: "16:9"
    });             
}

 function play_vimeo_video(link_video){
    $link_vd = link_video;              
    $("#vimeo_video").attr("src", $link_vd);       
}

function select_epk_song(song_id){
	$.ajax({
     type: "POST",
     url: '<?php echo base_url();?>artist/presskit/set_epk_song' ,
     dataType: "text",
     data: {
     	'song_id': song_id,
        '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'},
     success: function(datatest) {
             console.log(datatest);
             swal(
                'Good job!',
                'Profile Song Update succesfully!',
                'success'
            );
         }
     });
}
</script>
<script src="<?=base_url()?>assets/js/jstree/jstree.min.js"></script>
<script>
$(document).ready(function() {
    //$(" .modal-body").mCustomScrollbar();
   console.log("loaded fjtrer");
    $('#frmt1').jstree({
        'core' : {
            'data' : [
                <?php
                    $my_songs = $controller->get_epk_songs_id($user_id);

                   	$list_albums = $this->M_audio_song->get_all_albums_epk($user_id);

                    if (!empty($user_id)) {
                        ?>
                        
                            <?php
                            foreach ($list_albums as $albums) {
                                
                                $songs = $this->M_audio_song->get_data_songs_epk($albums['id']); ?>
                                {

                                    "text" : "<?=$albums['name']?>",
                                    "state" : { "opened" : true },
                                    "children" : [
                                    <?php
                                    foreach ($songs as $song) {
                                    	if (in_array($song['id'], $my_songs)) {
                                            $select_b = 'true';
                                        } else {
                                            $select_b = 'false';
                                        }
                                        if ($song['listened'] == 0) {
                                            $rating = 0;
                                        } else {
                                            $rating = $song['sales'] * 100 / $song['listened'];
                                        } ?>
                                        {
                                            "text" : "<?=$song['song_name'].'- Rating ('.$rating.'%)'?>",
                                            "state" : { "selected" : false },
                                            "icon" : "jstree-file",
                                            "id": "<?=$song['id']?>",
                                            "state" : { "selected" : <?=$select_b?> },

                                        },
                                        <?php

                                    } ?>
                                    ],
                                    "id":  "<?=$albums['id']?>",
                                },  
                                <?php

                            } ?> 
                            ,
                        <?php 
                    }
               
                ?>
            ]
        },
        "plugins" : [ "wholerow", "checkbox","search" ]
    });
     
    
    
});
</script>
</body> 