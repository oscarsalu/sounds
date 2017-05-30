<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Sound House Promotions | Connect with Fans" />
    <meta property="og:description"        content="Sound House Promotions | Connect with Fans" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/global.css"/>
	<link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/template5/css/style.css"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/amp/css/jplayer.blue.monday.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url()?>/assets/js/jquery.steps.js"></script>
	<style type="text/css">
		#song a{
			color:#23527c;
		}
	</style>
	<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".l1").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#info").offset().top-50}, 700);
				$("*").removeClass("active1");
				$(".left1").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l2").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#photos").offset().top-50}, 700);
				$("*").removeClass("active1");
				$("*").removeClass("active2");
				$(".left2").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l3").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#stats").offset().top-50}, 700);
				$("*").removeClass("active1");
				$("*").removeClass("active2");
				$(".left3").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l4").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#videos").offset().top-50}, 700);
				$("*").parent().removeClass("active1");
				$("*").removeClass("active2");
				$(".left4").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l5").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#bios").offset().top-50}, 700);
				$("*").removeClass("active1");
				$("*").removeClass("active2");
				$(".left5").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l6").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#song").offset().top-50}, 700);
				$("*").removeClass("active1");
				$("*").removeClass("active2");
				$(".left6").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l7").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#press").offset().top-50}, 700);
				$("*").removeClass("active1");
				$("*").removeClass("active2");
				$(".left7").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l8").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#show").offset().top-50}, 700);
				$("*").removeClass("active1");
				$("*").removeClass("active2");
				$(".left8").addClass("active2");
				$(this).parent().addClass("active1");
			});
			$(".l9").click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop: $("#blog").offset().top-50}, 700);
				$("*").removeClass("active1");
				$("*").removeClass("active2");
				$(".left9").addClass("active2");
				$(this).parent().addClass("active1");
			});
		});
	</script>
</head>
<body data-spy="scroll" data-target="#left-menu" data-offset="50">
<?php 
$data_json = json_decode($customize['data_customize']);
?>
	<div id="wrapper">
		<header>
			<div id="menu">
				<nav class="navbar navbar-inverse navbar-fixed-top">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="#"><?php echo $this->M_user->get_name($res_data_artist['id'])?></a>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li><a href="#" class="l1">Info</a></li>
                        <?php  if ($data_json->photo == 'on') {
     ?>
				        <li><a href="#" class="l2">Photos</a></li>
                        <?php 
 } if ($data_json->stats == 'on') {
     ?>
				        <li><a href="#" class="l3">Stats</a></li>
                        <?php 
 } if ($data_json->video == 'on') {
     ?>
						<li><a href="#" class="l4">Videos</a></li>
                        <?php 
 }?>
						<li><a href="#" class="l5">Bios</a></li>
                        <?php  if ($data_json->song == 'on') {
     ?>
						<li><a href="#" class="l6">Songs</a></li>
                        <?php 
 } if ($data_json->press == 'on') {
     ?>
						<li><a href="#" class="l7">Press</a></li>
                        <?php 
 }
                            if ($data_json->show == 'on') {
                                ?>
						<li><a href="#" class="l8">Shows</a></li>
                        <?php 
                            }?>
                         <li><a href="#" class="l9">blog</a></li>   
				      </ul>
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
			</div>
		</header>
		<div id="content">
			<section id="sec1">
				<div class="container">
					<div class="row">
                      <div class="col-lg-12">  
						<div class="col-md-3 bord">
							<div id="left-menu" class="relative" role="tablist">
								<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="20">
									<li class="active3"><a href="#info" class="left1">Info <i class="fa fa-fighter-jet none"></i></a></li>
                                    <?php  if ($data_json->photo == 'on') {
     ?>
							        <li><a href="#photos" class="left2">Photos <i class="fa fa-fighter-jet none"></i></a></li>
                                    <?php 
 } if ($data_json->stats == 'on') {
     ?>
							        <li><a href="#stats" class="left3">Stats <i class="fa fa-fighter-jet none"></i></a></li>
                                    <?php 
 } if ($data_json->video == 'on') {
     ?>
									<li><a href="#videos" class="left4">Videos <i class="fa fa-fighter-jet none"></i></a></li>
                                    <?php 
 }?>
									<li><a href="#bios" class="left5">Bios <i class="fa fa-fighter-jet none"></i></a></li>
                                    <?php  if ($data_json->song == 'on') {
     ?>
									<li><a href="#song" class="left6">Songs <i class="fa fa-fighter-jet none"></i></a></li>
                                    <?php 
 } if ($data_json->press == 'on') {
     ?>
									<li><a href="#press" class="left7">Press <i class="fa fa-fighter-jet none"></i></a></li>

                                    <?php 
 } if ($data_json->show == 'on') {
     ?>
									<li><a href="#show" class="left8">Shows <i class="fa fa-fighter-jet none"></i></a></li>
                                    <?php 
 }?>
 									<li><a href="#blog" class="left9">blog <i class="fa fa-fighter-jet none"></i></a></li>
								</ul>
							</div>
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$(".left1").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#info").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left2").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#photos").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left3").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#stats").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left4").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#videos").offset().top-50}, 700);
									$("*").parent().removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left5").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#bios").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left6").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#song").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left7").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#press").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left8").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#show").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
								$(".left9").click(function(e){
									e.preventDefault();
									$('html, body').animate({scrollTop: $("#show").offset().top-50}, 700);
									$("*").removeClass("active2");
									$(this).parent().addClass("active2");
								});
							});
						</script>
						<div class="col-md-9  bord tph">
                             <div class="">
                                 <?php if ($this->session->flashdata('message_error')) {
    ?>
                                    <div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <h4><strong>Heads up!</strong></h4>
                                        <p> <?php echo $this->session->flashdata('message_error')?></p>
                                    </div>
                                    <?php

}
                                if ($this->session->flashdata('message_succsess')) {
                                    ?>
                                    <div class="alert alert-big alert-success alert-dismissable fade in">
                                        <h4><strong>Succces!</strong></h4>
                                        <p> <?php echo $this->session->flashdata('message_succsess')?></p>
                                    </div>
                                    <?php

                                }
                                ?>
                            </div>
							<div id="info">
								<div class="row">
									<div class="title">
										<h2>Info</h2>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12" style="padding-bottom: 2em;">
										
									
									<div class="col-md-3">
										<div class="info" >
											<img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" class="img-responsive">
											<h2 style="padding-top: 5px"><?php echo $this->M_user->get_name($res_data_artist['id'])?></h2>
										</div>
									</div>
										<div class="col-md-3">
											<p><b>From:</b><br />
												<span class="from"><?php echo $res_data_artist['city'].', '.$country['country'];?></span>
											</p>

											<p><b>Genre:</b><br />
												<span class="genre"><?php echo $genre['name'];?></span>
											</p>

											<p><b>Members:</b><br />
												<span class="members"><p><?php
                                                       foreach ($groups_member as $member) {
                                                           echo $member['name_member'].' - '.$member['contribution'];
                                                           if (!empty($member['contribution2'])) {
                                                               echo '/'.$member['contribution2'];
                                                           }
                                                           if ($member != end($groups_member)) {
                                                               echo ',';
                                                           }
                                                       }
                                                       ?> 
                                                 </p></span>
											</p>
											
										</div>
									

									<div class="col-md-6">
                                        <?php if ($data_json->stats == 'on') {
    ?>
										<div id="info_statistics_div_placeholder" style="">
				                            <ul class="new_charts fix-nav">
				                                <!-- <li>
				                                    <div id="gender_demographics" class="">
				                                        <div class="chartTitle">Gender Demographics</div>
				                                        <div class="chartBody">No Data Available</div>
				                                    </div>
				                                    <div class="clearfix"></div>
				                                </li> -->
				                                <li>
				                                    <div id="demographics" class="">
				                                        <div class="chartTitle">Age Breakdown</div>
				                                        <div class="chartBody">
				                                            <div class="row">
				                                                <span class="labelChart">13-17</span>
				                                                <div class="lineChart">
				                                                    <div class="innerLineChart last">
                                                                        <div class="value-chart" style="width: <?php echo $this->Member_model->stast_fan($fans, 13, 17)?>%;">
                                                                        </div>
                                                                    </div>
				                                                </div>
				                                            </div>
				                                            <div class="row">
				                                                <span class="labelChart">18-24</span>
				                                                <div class="lineChart">
				                                                    <div class="innerLineChart last">
                                                                        <div class="value-chart " style="width: <?php echo $this->Member_model->stast_fan($fans, 18, 24)?>%;"></div>
                                                                    </div>
				                                                </div>
				                                            </div>
				                                            <div class="row">
				                                                <span class="labelChart">25-34</span>
				                                                <div class="lineChart">
				                                                    <div class="innerLineChart last">
                                                                        <div class="value-chart"  style="width: <?php echo $this->Member_model->stast_fan($fans, 25, 34)?>%;"></div>
                                                                    </div>
				                                                </div>
				                                            </div>
				                                            <div class="row">
				                                                <span class="labelChart">35-44</span>
				                                                <div class="lineChart">
				                                                    <div class="innerLineChart last">
                                                                        <div class="value-chart" style="width: <?php echo $this->Member_model->stast_fan($fans, 35, 44)?>%;"></div>
                                                                    </div>
				                                                </div>
				                                            </div>
				                                            <div class="row">
				                                                <span class="labelChart">45+</span>
				                                                <div class="lineChart">
				                                                    <div class="innerLineChart last"> 
                                                                        <div class="value-chart" style="width: <?php echo $this->Member_model->stast_fan($fans, 45, 300)?>%;"></div>
                                                                    </div>
				                                                </div>
				                                            </div>
				                                        </div>
				                                    </div>
				                                    <div class="clearfix"></div>
				                                </li>
				                              <!--   <li >
				                                    <div id="fans" class="">
				                                        <div class="chartTitle"><span id="fans_count"><?php echo count($fans)?></span>&nbsp;&nbsp;fans</div>
				                                        <div class="chartBody"></div>
				                                    </div>
				                                    <div class="clearfix"></div>
				                                </li> -->
				                               <!--  <li>
				                                    <div id="fans_near_chart" class="">
				                                        <div class="chartTitle">Fans Near</div>
				                                        <div class="chartBody"> No Data Available </div>
				                                    </div>
				                                    <div class="clearfix"></div>
				                                </li> -->
				                                <div style="clear: both"></div>
				                            </ul>
				                            <div class="see_all">*Fan demographics represent 99Sound fans only</div>
				                        </div>
                                        <?php 
}?>
									</div>
									</div>
								</div>
							</div><!-- end #info -->
                            <?php if ($data_json->photo == 'on') {
    ?>
							<div id="photos">
								<div class="title">
								<h2>Photos</h2>
								</div>
								<div class="row">
									<div class="li-image">
                                        <?php
                                        foreach ($photos as $pt) {
                                            ?>
                                		<div class="col-md-4 col-sm-4 col-xs-12 img-reponsive">
                                			<a href="#"><img src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="fix-img"></a>
                                		</div>
                                            
                                            <?php

                                        } ?> 
									</div>
								</div>
							</div><!-- end #photo -->
                             <?php 
} if ($data_json->stats == 'on') {
    ?>
						<div id="stats">
							<div class="title">
								<h2>Stats</h2>
							</div>
							<div class="row">
								
								<?php if($epk_display_info->song_counts)
                                        { ?>
								<div class="col-xs-12 col-sm-4 col-lg-4">
									<div class="box">							
										<div class="icon">
											<div class="image"><i class="fa fa-music"></i></div>
											    <h3 class="title2"><?=$num_songs?></h3>
											    <p>Songs Counts</p>
										</div>
									</div> 
								</div>
								<?php } if($epk_display_info->video_counts) { ?>

								<div class="col-xs-12 col-sm-4 col-lg-4">
									<div class="box">							
										<div class="icon">
											<div class="image"><i class="fa fa-video-camera"></i></div>
											    <h3 class="title2"><?=$num_video?></h3>
											    <p>Video Counts</p>
										</div>
									</div> 
								</div>
								<?php } if($epk_display_info->blog_counts) { ?>
								<div class="col-xs-12 col-sm-4 col-lg-4">
									<div class="box">							
										<div class="icon">
											<div class="image"><i class="fa fa-rss"></i></div>
											    <h3 class="title2"><?=$num_blogs?></h3>
											    <p>Blogs Counts</p>
										</div>
									</div> 
								</div>
								 <?php } if($epk_display_info->fan_counts) { ?>
								<div class="col-xs-12 col-sm-4 col-lg-4">
									<div class="box">							
										<div class="icon">
											<div class="image"><i class="fa fa-users"></i></div>
											    <h3 class="title2"><?=$num_fans?></h3>
											    <p>Fans Counts</p>
										</div>
									</div> 
								</div>
								<?php } if($epk_display_info->comments_counts) { ?>
								<div class="col-xs-12 col-sm-4 col-lg-4">
									<div class="box">							
										<div class="icon">
											<div class="image"><i class="fa fa-comments"></i></div>
											    <h3 class="title2"><?=$num_comments?></h3>
											    <p>Comments Counts</p>
										</div>
									</div> 
								</div>
								 <?php } if($epk_display_info->show_counts) { ?>
								<div class="col-xs-12 col-sm-4 col-lg-4">
									<div class="box">							
										<div class="icon">
											<div class="image"><i class="fa fa-calendar-o"></i></div>
											    <h3 class="title2"><?=$num_events?></h3>
											    <p>Events Counts</p>
										</div>
									</div> 
								</div>
								<?php } ?>
									
								</div>
							</div><!-- end #stats -->
                             <?php 
} if ($data_json->video == 'on') {
    ?>
							<div id="videos">
								<div class="title">
									<h2>Videos</h2>
								</div>
								<div class="video-content">
									<div class="row">
										<div class="tab-content tab-video">
                                            <?php $i = 1;
											    foreach ($videos as $row) {
											        ?>
                                                <div role="tabpanel" class="tab-pane <?php if ($i == 1) {
													    echo 'active';
													} ?>" id="th<?php echo $i;
													        $i++?>">
    										    
						    				    	<iframe width="100%" height="380" src="<?= base_url().'video_embed/'.$row['id']?>" frameborder="0" allowfullscreen></iframe>
						                            
										    	</div>
	                                                <?php

    											} ?>
										    
										</div>
										<p class="but-control"><a href="#" class="prev">...Prev</a><a href="#" class="next">Next...</a></p>
									</div>
                                    
									
								</div>
									
							</div><!-- end #video -->
                            <?php 
						}?>

							<div id="bios">
							<div class="title">
								<h2>Bios</h2>
							</div>	
								<div class="row">
									<!-- <div class="bios-content"> -->
										<div class="col-md-4">
										<img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" class="img-responsive" width="100%">
										</div>
										<div class="col-md-8 blheight">
										<blockquote class="quote-card">
										<p><?php echo $res_data_artist['bio']?></p>
										</blockquote>
										</div>
									</div>
								<!-- </div> -->
							</div><!-- end #bios -->
                            <?php 
                                if ($data_json->song == 'on') {
                                    ?>
							<div id="song">
								<div class="title">
									<h2>Song</h2>
								</div>
								<div class="song_content">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 text-center">
						                    <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player"> </div>
						                </div>
									</div>
								</div>
							</div><!-- end #song -->
                            <?php 
                                }
                            if ($data_json->press == 'on') {
                                ?>
							<div id="press">
								<div class="title">
								<h2>Press</h2>
								</div>
								<div class="press-content">

									<div class="row">
										
                                        <?php foreach ($press as $row) {
										    ?>
									    <div class="col-sm-6 col-md-6">
									    	
									   
										    <article>
										    	<h1><?php if (!empty($row['link'])) {
										    ?><a href="<?php echo $row['link']?>" target="_blank"><?php

										} ?><?php echo $row['name']; ?> </a></h1>
												<blockquote ><?php echo $row['quote']?></blockquote>
												
												<br>
												<p class="text-center">By ~<?php echo $row['author']?></p>
										    </article>
										    </div>                                 	
										                                            <?php

} ?>
									</div>
								</div>
							</div><!-- end #press -->
                            <?php 
                            }
                            if ($data_json->show == 'on') {
                                ?>
							<div id="show">
								<div class="show-content">
									<div class="title">
									  <h2>Shows</h2>
									</div>

									<div class="row">
									<?php if(!empty($events)) {
                        foreach ($events as $event) {
                            ?>
                            <?php if (!empty($event['event_banner'])) {
                            $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
                            } else {
                                $url_image = base_url().'assets/images/icon/manager_git_event.png';
                            } ?>
										<div class="col-sm-6" style="padding-bottom: 5px;">
											<div class="pres">
												<div class="img-figure">
													
													<img src="<?php echo $url_image; ?>" style="width: 100%;height: 200px;">
												</div>	

												<div class="title1">
													<h1><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></h1>
												</div>
												<p class="description">
													<?php 
                                        $text = strip_tags($event['event_desc']);
                                        $desLength = strlen($text);
                                        $stringMaxLength = 250;
                                        if ($desLength > $stringMaxLength) {
                                            $des = substr($text, 0, $stringMaxLength);
                                            $text = $des.'...';
                                            echo $text;
                                        } else {
                                            echo $event['event_desc'];
                                        } ?>
												</p>
												<div class="caption">
					                                <h4 class="pull-right"><?php echo date('d/m/y',strtotime($event['event_start_date']));?></h4>
					                                <h4><a href="<?php echo base_url().$res_data_artist['home_page']?>"> <?php echo $res_data_artist['artist_name']?></a>
					                                </h4>
					                            </div>
											</div>
											</div>
											<?php }
                        } ?>
											
									</div>
								</div>
							</div>
                            <?php 
                            }?>
                            <div id="blog">
							<div class="title">
								<h2>Blog</h2>
							</div>	
								<div class="row">
								<?php
                    if($epk_blogs){
                     foreach ($epk_blogs as $key => $blog) { 
                    
                    ?>
									<!-- <div class="blog-content"> -->
										<div class="well">
									      <div class="media">
									      	<a class="pull-left" href="#">
									    		<img class="media-object" src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>" style="width: 100px;height: 100px;">
									  		</a>
									  		<div class="media-body">
									    		<h2 class="media-heading"><a href="<?php echo base_url('artist/allblogs').'/'.$blog['user_id'].'/'.$blog['id']?>"><?=$blog['title'] ?></a></h2>
									          <p class="text-right">By <a href="<?php echo base_url().$res_data_artist['home_page']?>" title="<?=$res_data_artist['home_page']?>">
                                                    <?=$res_data_artist['artist_name']?>
                                                </a></p>
									          <p><?php 
                                                $text = strip_tags($blog['content']);
                                                $desLength = strlen($text);
                                                $stringMaxLength = 250;
                                                if ($desLength > $stringMaxLength) {
                                                    $des = substr($text, 0, $stringMaxLength);
                                                    $text = $des.'...';
                                                    echo $text;
                                                } else {
                                                    echo $blog['content'];
                                                } ?> </p>
									          <ul class="list-inline list-unstyled">
									  			<li><span><i class="glyphicon glyphicon-calendar"></i> <?php echo date('M d, Y', $blog['time'])?> </span></li>
									            <li>|</li>
									            <span><i class="glyphicon glyphicon-comment"></i> <?php echo count($this->M_blog->getcomment_blog($blog['id'])) ?> comments</span>
									           
												</ul>
									       </div>
									    </div>
									  </div>
									  <?php } }?>
								</div>
								<!-- </div> -->
							</div><!-- end #blog -->
						</div>
					</div>
				</div>
				</div>
			</section>
		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="content-f1">
							<p>Download Media:</p>
							<ul>
                                <?php if ($data_json->dw_photo == 'on') {
    ?>
                                <li><a href="#" class="icon picture download" id="download_media" data-toggle="modal" data-target="#photo_assets"><i class="fa fa-picture-o"></i> Photos </a></li>
                                <?php 
}
                                 if ($data_json->dw_song == 'on') {
                                     ?>
                                 <li><a href="#" class="icon music download" id="download_audio" data-toggle="modal" data-target="#song_assets"><i class="fa fa-music"></i> Music </a></li>
                                
                                <?php 
                                 }
                                 if ($data_json->dw_bios == 'on') {
                                     ?>
                                 <li><a href="<?php echo base_url('artist/dashboard_epk/download/bio').'/'.$res_data_artist['id']?>" id="download_bio" ><i class="fa fa-music"></i> Bio </a></li>
                                
                                <?php 
                     }
                     if ($data_json->dw_video == 'on') {
                     ?>
                     <li><a href="#" class="icon picture download"  data-toggle="modal" data-target="#video" id="download_video" ><i class="fa fa-video-camera"></i> Videos </a></li>
                    <?php 
                     }
                     if ($data_json->dw_pdf == 'on') {
                     ?>
                     <li><a href="<?php echo base_url('epk').'/'.$res_data_artist['home_page'].'?action=pdf'?>" id="download_pdf" ><i class="fa fa-file-pdf-o"></i> .pdf </a></li>
                    <?php 
                     }
                     ?>
							</ul>
						</div>
					</div>

					<div class="col-md-4 col-sm-4">
						
					</div>

					<div class="col-md-4 col-sm-4">
						<div class="content-f3">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Contact Artist</button>
							<a href="<?php echo base_url().$res_data_artist['home_page']?>"class="btn btn-default">View Profile</a>
<script>
        
    function checkOtherMail() {
        $('#myModal').modal('hide');
        $( "#dialog-confirm" ).dialog({
          resizable: false,
          height: "auto",
          width: 400,
          title: "Send mail to more people",
          modal: true,
            buttons: [
            {
              text: "Yes",
              icons: {
                primary: "ui-icon-heart"
              },
              click: function() {

                $('#send-multimail').modal('show');
                var from = $('#from').val();
                var subject = $('#subject').val();
                $('#subject1').val(subject);
                var msg = $('#msg').val();
                $('#msg1').val(msg);
                $( "#dialog-confirm" ).dialog('close');
              }
            },
            {
              text: "Cancel",
              icons: {
                primary: "ui-icon-heart"
              },
              click: function() {
                $('#myModal').modal('show');
                $( "#dialog-confirm" ).dialog('close');
                var <?php echo $this->security->get_csrf_token_name(); ?> = <?php echo "'".$this->security->get_csrf_hash()."'";?>;
                var uri = "<?php echo base_url()?>artist/presskit/contact";
                var toArray = {
                    'public_email':$("input[name='to[public_email]']").val(),
                    'booking_email':$("input[name='to[booking_email]']").val(),
                    'mngt_email':$("input[name='to[mngt_email]']").val()
               };
                
                $.ajax({
                    type: "POST",
                    url: uri,
                    data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': <?php echo "'".$this->security->get_csrf_hash()."'";?>,
                    'from': $('#from').val(),
                    'subject': $('#subject').val(),
                    'to': toArray,
                    'msg': $('#msg').val(),
                },
                    dataType: "JSON",
                    success: function(response) {
                        
                    }
                });   
                $('#myModal').modal('hide');
              }
            }
          ]
          
        });
         $('#send-multimail').modal('hide');   
    }

   function submitform(){
        var <?php echo $this->security->get_csrf_token_name(); ?> = <?php echo "'".$this->security->get_csrf_hash()."'";?>;
        var uri = "<?php echo base_url()?>artist/presskit/contact";
        var toArray = {
            'public_email':$("input[name='to[public_email]']").val(),
            'booking_email':$("input[name='to[booking_email]']").val(),
            'mngt_email':$("input[name='to[mngt_email]']").val()
       };
        
        $.ajax({
            type: "POST",
            url: uri,
            data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>': <?php echo "'".$this->security->get_csrf_hash()."'";?>,
            'from': $('#from').val(),
            'subject': $('#subject').val(),
            'to': toArray,
            'msg': $('#msg').val(),
            'email1': $('#email1').val(),
            'email2': $('#email2').val(),
            'email3': $('#email3').val()
        },
            dataType: "JSON",
            success: function(response) {
                
            }
        });   
        $('#send-multimail').modal('hide');   
   } 
    
            
</script>
							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Send Message</h4>
							      </div>
                                  <form  method="post">
    							      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                      <div class="modal-body">
    							           <div class="form-group">
    									    <label for="to">To <span><?php if(!empty($customize['email_artist'])) { echo $customize['email_artist']; echo ',';}?></span><span><?php if(!empty($customize['email_booking'])) { echo ' '.$customize['email_booking']; echo ',';}?></span><span><?php if(!empty($customize['email_manager'])) { echo ' '.$customize['email_manager']; echo ',';}?></span></label>
    									    <ul class="li-check">
                    					    	<li><input type="checkbox" name="to[public_email]" value="<?php if(!empty($customize['email_artist'])) { echo $customize['email_artist']; }else {'';} ?>"<?php if (empty($customize['email_artist'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Artist</li>
                    					    	<li><input type="checkbox" name="to[booking_email]" value="<?php if(!empty($customize['email_booking'])) { echo $customize['email_booking']; }else{'';} ?>"<?php if (empty($customize['email_booking'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Booking</li>
                    					    	<li><input type="checkbox" name="to[mngt_email]" value="<?php if(!empty($customize['email_manager'])) { echo $customize['email_manager']; }else{'';} ?>"<?php if (empty($customize['email_manager'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Management</li>
        					   
    									    </ul>
    									  </div>
    									  <div class="form-group">
    									    <label for="from">From</label>
    									    <input type="text" class="form-control" id="from" name="from">
    									  </div>
    									  <div class="form-group">
    									    <label for="sub">Subject</label>
    									    <input type="text" class="form-control" id="subject" name="subject">
    									  </div>
    									  <div class="form-group">
    									    <label for="message">Message</label>
    									     <textarea name="msg" id="msg" rows="5" cols="10"></textarea>
    									  </div>
    									
    							      </div>
    							      <div class="modal-footer">
    							        <button type="submit" class="btn btn-primary" id="dialog-confirm" onclick="checkOtherMail()">Send</button>
    							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    							      </div>
                                  </form>
							    </div>
							  </div>
							</div>
                            <!--end modal contact-->
                            			<div class="modal fade" id="send-multimail" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Send Message</h4>
            </div>
            <!-- action="<?php echo base_url()?>artist/presskit/contact" -->
            <form class="form form-signup send-multimail1" id="send-multimail1" role="form" onsubmit="return false" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label class="form-input col-md-3">Email1</label>
                        <div class="input-group col-md-8">
                            <input type="email" class="form-control" name="email1" id="email1" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-input col-md-3">Email2</label>
                        <div class="input-group col-md-8">
                            <input type="email" class="form-control" name="email2" id="email2" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-3">Email3</label>
                        <div class="input-group col-md-8">
                            <input type="email" class="form-control" name="email3" id="email3"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-3">Subject:</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" id="subject1" disabled="" name="subject" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-3">Message:</label>
                        <div class="input-group col-md-8">
                            <textarea class="form-control" rows="6" name="msg" disabled="" id="msg1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="submitform()"> Send</button> 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
                </div>
            </form>
        </div>
    </div>
</div>
						</div>
					</div>
				</div>
			</div>
		</footer>

			<?php  if ($data_json->dw_video == 'on') {
    ?>
        <!-- Modal download video -->
<div class="modal fade" id="video" tabindex="-1" role="dialog" aria-labelledby="myModalVideo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalVideo">Download Media Videos</h4>
            </div>
            <div class="modal-body">
                <p>The following media videos are available for download.
                 You can save videos individually by clicking the download link next to each.</p>
                <h3>Click link to download</h3>
                <div class="song_box" style="max-width: 500px;">
                    <ul class="sortable with_main_songs"> 
                        <?php
                        foreach ($videos as $video) {
                            if($video['type'] == 'file'){


                            ?>
                            <li style="text-transform: capitalize;">
                                <a>
                                  <img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url(); ?>uploads/<?php echo $video['user_id']; ?>/video/<?php echo $video['cover_image']; ?>"/>
                                </a>
                                <a  href="<?php echo base_url('epk/download/video').'/'.$res_data_artist['id'].'/'.$video['name_file']?>" >Download <?php echo $video['name_video']?></a>
                            </li>
                            <?php
                             }
                        }
                        ?> 
                        
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
            </div>
        </div>
    </div>
</div>
        <?php } if ($data_json->dw_photo == 'on') {
    ?>
        <!-- Modal download photo -->
        <div class="modal fade" id="photo_assets" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
                    <div class="modal-header">
        		        <h4 class="modal-title" id="myModalLabel">Download Media Photos</h4>
        		      </div>
        			<div class="modal-body">
                        <p>The following media photos are available for download.
                         You can save images individually by clicking the download link next to each.</p>
                        <h3>Click link to download</h3>
        				<div class="song_box" style="max-width: 500px;">
                            <ul class="sortable with_main_songs"> 
                                <?php
                                foreach ($photos as $pt) {
                                    ?>
                                    <li style="text-transform: capitalize;">
                                        <a>
                                          <img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>"/>
                                        </a>
                                        <a  href="<?php echo base_url('epk/download/photo').'/'.$res_data_artist['id'].'/'.$pt['filename']?>" >Download <?php echo $pt['caption']?></a>
                                    </li>
                                    <?php

                                } ?> 
                                
                            </ul>
                        </div>
        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
        			</div>
        		</div>
        	</div>
        </div>
        <?php 
} if ($data_json->dw_song == 'on') {
    ?>
        <!-- Modal download songs -->
        <div class="modal fade" id="song_assets" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h4 class="modal-title" id="myModalPhoto">Download Media Photos</h4>
        			</div>
        			<div class="modal-body">
                        <p>The following songs are available for download in MP3 format. For higher quality audio, you may try contacting the artist directly.</p>
                        <h3>Click link to download</h3>
        				<div class="song_box" style="max-width: 500px;">
                            <ul class="sortable with_main_songs"> 
                                <?php
                                foreach ($download_songs as $row) {
                                    ?>
                                    <li style="text-transform: capitalize;">
                                        <a  href="<?php echo base_url('epk/download/song/').'/'.$row['id']?>" >Download Song: <?php echo $row['song_name']?></a>
                                    </li>
                                    <?php

                                } ?> 
                                
                            </ul>
                        </div>
        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
        			</div>
        		</div>
        	</div>
        </div>
        <?php 
}?>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
	    $end = $("#videos .tab-pane").last();
        $first = $("#videos .tab-pane").last();
        if($end== $first){
        	$(".video>.button-right").hide();
            $(".video>.button-left").hide();
        }
		$(".prev").click(function(event){
			$("#videos .tab-pane").each(function() { 
				
                if($(this).hasClass("active")){
                	event.preventDefault();
					$prev = $(this).prev();
                    if($prev.hasClass("tab-pane")){
                        var children = $(this).children();
                       var src= children.attr('src');
                        children.attr('src',src);  
                        $(this).hide();
                       $prev.show();
						$(this).removeClass("active");
						$prev.addClass("active");
                    }
					
                    return false;
				}
            });
		});//previous video

		$(".next").click(function (event) {
			$("#videos .tab-pane").each(function() { 
                if($(this).hasClass("active")){
					event.preventDefault();
                    //$end = $("#video .tab-pane").last();
                    $next = $(this).next();
                   if($next.hasClass("tab-pane")){
                    	var children = $(this).children();
                        var src= children.attr('src');
                        children.attr('src',src);  
                        $(this).hide();
						$next.show();
						
						$(this).removeClass("active");
						$next.addClass("active");
						
                    }
					return false;
				}
            });
			
		});//next video
	});
</script>
<script src="<?php echo base_url()?>/assets/epk/template3_new/js/jquery.js"></script>
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.jplayer.js"> </script>   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jplayer.playlist.js"> </script>   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.redirect.js"> </script>   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/setting.epk.js"> </script>    
    <script type="text/javascript">AMP_Load_data('<?=$user_id?>', '<?=$affiliatesId?>', '<?=$albumIds?>');</script>
</body>
</html>