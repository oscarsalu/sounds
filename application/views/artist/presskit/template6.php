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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/epk/template6/css/animate.css">
	<link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/template6/css/style.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/global.css"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
     <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".l1").click(function(){
				$("#info").siblings().fadeOut("slow","linear");
				$("#info").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
			$(".l2").click(function(){
				$("#photos").siblings().fadeOut("slow","linear");
				$("#photos").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
			$(".l3").click(function(){
				$("#stats").siblings().fadeOut("slow","linear");
				$("#stats").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
			$(".l4").click(function(){
				$("#videos").siblings().fadeOut("slow","linear");
				$("#videos").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
			$(".l5").click(function(){
				$("#bios").siblings().fadeOut("slow","linear");
				$("#bios").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
			$(".l6").click(function(){
				$("#song").siblings().fadeOut("slow","linear");
				$("#song").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
			$(".l7").click(function(){
				$("#press").siblings().fadeOut("slow","linear");
				$("#press").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
			$(".l8").click(function(){
				$("#show").siblings().fadeOut("slow","linear");
				$("#show").fadeIn("slow","linear");
				$(this).parent().siblings().children().removeClass("current");
				$(this).addClass("current");
			});
		});
	</script>
</head>
<body>
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
				      <ul class="nav navbar-nav js">
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
			</div><!-- end #menu -->
		</header>
		<div id="main-content">
			<div class="container">
				<div id="info" class="panels">
					<div class="row">
                        <div class="col-md-12">
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
						<h2 class="h2 animated fadeInDown">Info</h2>
						<div class="col-md-3">
							<div class="info">
								<img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" class="img-responsive animated bounceInDown">
								<!-- <h3 class="animated fadeInUp"><?php echo $this->M_user->get_name($res_data_artist['id'])?></h3>

								<p class="animated fadeInUp">From:<br />
									<span class="from"><?php echo $res_data_artist['city'].', '.$country['country'];?></span>
								</p>

								<p class="animated fadeInUp">Genre:<br />
									<span class="genre"><?php echo $genre['name'];?></span>
								</p>

								<p class="animated fadeInUp">Members:<br />
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
                                <p class="animated fadeInUp">Bio:<br />
									<span class="bio"><?php custom_echo_html($res_data_artist['bio'], 300)?></span>
								</p> -->
							</div>
						</div>

						<div class="col-md-9">
                            <?php if ($data_json->stats == 'on') {
    ?>
							<div id="info_statistics_div_placeholder">
	                            <ul class="new_charts fix-nav">
	                                <li class="animated bounceInLeft">
	                               <!--  <h3 class="animated fadeInUp"><?php echo $this->M_user->get_name($res_data_artist['id'])?></h3> -->
	                                <div class="chartTitle animated fadeInUp"><?php echo $this->M_user->get_name($res_data_artist['id'])?></div>
								<p class="animated fadeInUp"><b>From:</b>
									<span class="from"><?php echo $res_data_artist['city'].', '.$country['country'];?></span>
								</p>

								<p class="animated fadeInUp"><b>Genre:</b>
									<span class="genre"><?php echo $genre['name'];?></span>
								</p>

								<p class="animated fadeInUp"><b>Members:</b>
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
                                <p class="animated fadeInUp"><b>Bio:</b>
									<span class="bio"><?php custom_echo_html($res_data_artist['bio'], 300)?></span>
								</p>
	                                    <!-- <div id="gender_demographics">
	                                        <div class="chartTitle">Gender Demographics</div>
	                                        <div class="chartBody">No Data Available</div>
	                                    </div> -->
	                                    <div class="clearfix"></div>
	                                </li>
	                                <li class="animated bounceInRight">
	                                    <div id="demographics">
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
	                               <!--  <li class="animated bounceInLeft">
	                                    <div id="fans">
	                                        <div class="chartTitle"><span id="fans_count"><?php echo count($fans)?></span>&nbsp;&nbsp;fans</div>
	                                        <div class="chartBody"></div>
	                                    </div>
	                                    <div class="clearfix"></div>
	                                </li>
	                                <li  class="animated bounceInRight">
	                                    <div id="fans_near_chart">
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
				</div><!-- end #info -->
                <?php if ($data_json->photo == 'on') {
    ?>
				<div id="photos" class="none panels">
					<h2 class="h2 animated fadeInDown">Photos</h2>
						<div class="row">
						<div class="col-sm-12">

							<div class="li-image">
                                <?php
                                foreach ($photos as $pt) {
                                    ?><a class="animated slideInLeft" href="#"><img src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive fix-img">
                                    
                                    </a>
                                    <?php

                                } ?> 
							</div>
							</div>
						</div>
				</div><!-- end #photos -->
                 <?php 
} if ($data_json->stats == 'on') {
    ?>
				<div id="stats" class="none panels">
					<h2 class="h2 animated fadeInDown">Stats</h2>
					<div class="row top_tiles">
					 <div class="right_col" role="main">
		              <div class="animated fadeInDown col-lg-3 col-md-3 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-envelope fa-3x"></i></div>
		                  <div class="count">6</div>
		                  <h3>Send Mail</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-3 col-md-3 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-twitter fa-3x"></i></div>
		                  <div class="count">9</div>
		                  <h3>Share Twitter</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-3 col-md-3 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-facebook fa-3x"></i></div>
		                  <div class="count">9</div>
		                  <h3>Share Facebook</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-3 col-md-3 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-music fa-3x"></i></div>
		                  <div class="count">9</div>
		                  <h3>Songs Counts</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-offset-1 col-lg-2 col-md-2 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-rss fa-2x"></i></div>
		                  <div class="count">17</div>
		                  <h3>Blogs Counts</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-2 col-md-2 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-video-camera fa-2x"></i></div>
		                  <div class="count">9</div>
		                  <h3>Video Counts</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-2 col-md-2 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-users fa-2x"></i></div>
		                  <div class="count">12</div>
		                  <h3>Fans Counts</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-2 col-md-2 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-comments fa-2x"></i></div>
		                  <div class="count">179</div>
		                  <h3>Comments Counts</h3>
		                </div>
		              </div>
		              <div class="animated fadeInDown col-lg-2 col-md-2 col-sm-6 col-xs-12">
		                <div class="tile-stats">
		                  <div class="icon"><i class="fa fa-calendar-o fa-2x"></i></div>
		                  <div class="count">12</div>
		                  <h3>Events Counts</h3>
		                </div>
		              </div>
		            
					
<!-- 						<div class="index">
							<h5 class="animated fadeInDown">Fan Demographics</h5>
							<p class="animated fadeInDown">Top Demographics is Females (age 13-17)</p>

							<table  class="animated fadeInRight">
								<tr>
									<td><?php echo $this->Member_model->stast_fan($fans, 13, 17, 1)?>%</td>
									<td>13-17</td>
									<td><?php echo $this->Member_model->stast_fan($fans, 13, 17, 2)?>%</td>
								</tr>

								<tr>
									<td><?php echo $this->Member_model->stast_fan($fans, 18, 24, 1)?>%</td>
									<td>18-24</td>
									<td><?php echo $this->Member_model->stast_fan($fans, 18, 24, 2)?>%</td>
								</tr>
								<tr>
									<td><?php echo $this->Member_model->stast_fan($fans, 25, 34, 1)?>%</td>
									<td>25-34</td>
									<td><?php echo $this->Member_model->stast_fan($fans, 25, 34, 2)?>%</td>
								</tr>
								<tr>
									<td><?php echo $this->Member_model->stast_fan($fans, 35, 44, 1)?>%</td>
									<td>35-44</td>
									<td><?php echo $this->Member_model->stast_fan($fans, 35, 44, 2)?>%</td>
								</tr>
								<tr>
									<td><?php echo $this->Member_model->stast_fan($fans, 45, 54, 1)?>%</td>
									<td>45-54</td>
									<td><?php echo $this->Member_model->stast_fan($fans, 45, 54, 2)?>%</td>
								</tr>
								<tr>
									<td><?php echo $this->Member_model->stast_fan($fans, 55, 200, 1)?>%</td>
									<td>55+</td>
									<td><?php echo $this->Member_model->stast_fan($fans, 55, 200, 2)?>%</td>
								</tr>
								<tr>
									<td><?php echo $this->Member_model->stast_fan($fans, 0, 12, 1)?>%</td>
									<td>n/a</td>
									<td><?php echo $this->Member_model->stast_fan($fans, 0, 12, 2)?>%</td>
								</tr>
							</table>
						</div> -->

						<!-- <div class="stats-info animated fadeInLeft">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6 stats-info">
									<h5>Their fans live here</h5>
									<p>No Data Available</p>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-6 stats-info">
									<h5>Fan Summary</h5>
									<p><b><?php echo count($fans)?> total fans</b></p>
								</div>
							</div>
						</div> -->
					</div>
				</div><!-- end #stats -->
                <?php 
} if ($data_json->video == 'on') {
    ?>
				<div id="videos" class="none">
					<h2 class="h2 animated fadeInDown">Videos</h2>
					<div class="video-content">
						<div class="row">
							<div class="tab-content tab-video col-md-8 col-md-offset-2">
                                <?php $i = 1;
    foreach ($videos as $row) {
        ?>
                                    <div role="tabpanel" class="tab-pane animated zoomIn <?php if ($i == 1) {
    echo 'active';
} ?>" id="th<?php echo $i;
        $i++?>">
								    <?php 
                        
                            if (!empty($res_data_artist['primary_video'])) { ?>
                                <iframe width="100%" height="380" src="<?= base_url().'video_embed/'.$res_data_artist['primary_video'] ?>" frameborder="0" allowfullscreen></iframe>
                     <?php       } else { ?>
    				    	<iframe width="100%" height="380" src="<?= base_url().'video_embed/'.$row['id']?>" frameborder="0" allowfullscreen></iframe>
                            <?php } ?>
								    </div>
                                    <?php

    } ?>
							    <p class="but-control animated fadeInUp"><a href="#" class="prev">...Prev</a><a href="#" class="next">Next...</a></p>
							</div>

							<div class="col-md-4">
								<!-- TODO: <div class="video-caption animated fadeInUp">
									<p>This <b>Videos</b> has</p>
									<ul>
										<li><b>10101</b> views</li>
										<li><b>10101</b> likes</li>
										<li><b>10101</b> comment</li>
									</ul>
								</div> -->
								
							</div>

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
                                    					//$(this).parent().next().$(".video-info1").addClass("none");
                                    					//$(".col-3>.video-info2")removeClass("none");
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
                                    						//$(this).parent().next().$(".video-info1").addClass("none");
                                    						//$(".col-3>.video-info2")removeClass("none");
                                                        }
                                    					return false;
                                    				}
                                                });
                                    			
                                    		});//next video
                                    	});
                                    </script>
					</div>
				</div><!-- end #video -->
                <?php 
}?>
				<div id="bios" class="none">
					<h2 class="h2 animated fadeInDown">Bios</h2>
					<div class="row">
						<div class="bios-content">
							<div class="bios-img animated fadeInDown">
								<img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" class="img-responsive">
							</div>
							<p style="color: #fff;" class="animated fadeInUp"><?php echo $res_data_artist['bio']?></p>
						</div>
					</div>
				</div><!-- end #bios -->
                <?php 
                    if ($data_json->song == 'on') {
                        ?>
				<div id="song" class="none">
					<h2 class="h2 animated fadeInDown">Song</h2>
					<div class="song-content">
						<div class="row">
							<div class="col-md-4">
                                <ul class="li-btn song-content">
                                    <?php $i = 0;
                        foreach ($songs as $row) {
                            ?>
                                        <li class="" id="song_<?php echo $i; ?>">
                                            <a href="javascript:playTrailer('<?php echo $i?>')" class="" >
                                            <?php echo $row['song_name']; ?>
                                            </a>
                                        </li>
                                        <?php
                                    ++$i;
                        } ?>
								</ul>
							</div>
							<script>
                                function playTrailer(index) {
                                    if(index == jwplayer().getPlaylistIndex()){
                                        if(jwplayer().getState()=='paused'||jwplayer().getState()=='idle'){
                                           jwplayer("mp3").play();
                                        }else if(jwplayer().getState()=='playing'){
                                            jwplayer("mp3").pause();
                                        }    
                                    }else{
                                        playerInstance.playlistItem(index);
                                    }
                                }
                            </script>
							<div class="col-md-8">
								<?=$this->M_audio_song->get_shortcode_AMP($res_data_artist['id']); ?>
							</div>

							<!-- TODO: <div class="col-md-3 col-sm-3">
								<div class="info-song  animated fadeInRight">
									<h4>This <b>Artist</b> has</h4>
									<p><b>10</b> plays</p>
									<p><b>0</b> downloads</p>
								</div>

								<div class="info-song bot animated fadeInRight">
									<h4>This <b>Song</b> has</h4>
									<p><b>10</b> plays</p>
									<p><b>0</b> downloads</p>
								</div>
							</div> -->

							<div class="clear"></div>
						</div>
					</div>
				</div><!-- end #song -->
                 <?php 
                    }
                if ($data_json->press == 'on') {
                    ?>
				<div id="press" class="none">
					<h2 class="h2 animated fadeInDown">Press</h2>
					<div class="press-content">

						<div class="row">
						  <h1>Article title first</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam dictum ex eget porttitor sollicitudin. Morbi cursus tempor placerat. Pellentesque suscipit tortor in orci pretium, ac facilisis ex pretium. Fusce hendrerit orci diam, vitae tristique quam porttitor eu. Donec ligula orci, ultricies in sagittis non, porta sed lorem. Aenean interdum posuere mattis. Curabitur dignissim dictum quam, vitae malesuada velit tristique a. </p>
        <div>
            <ul class="list-unstyled list-inline">
								<li><i class="fa fa-calendar"></i> January 18, 2017</li>
								<li><i class="fa fa-user"></i> Sergio Rodriguez</li>
							</ul>
        </div> 
        <div class="clear"></div>
        <hr>
        <h1>Article title second</h1>
        <p>Sed interdum massa ac pretium faucibus. Integer semper euismod lorem faucibus molestie. Aenean luctus ut metus eget dignissim. Sed tincidunt augue non elementum pharetra. Suspendisse non feugiat urna. Etiam egestas neque euismod neque sollicitudin consectetur. Fusce facilisis augue a velit porta scelerisque. Sed mattis justo sapien. Sed ultrices lectus diam, id vestibulum ante finibus a. </p>
        <div style="margin-bottom:40px;">
            <ul class="list-unstyled list-inline">
								<li><i class="fa fa-calendar"></i> January 18, 2017</li>
								<li><i class="fa fa-user"></i> Sergio Rodriguez</li>
							</ul>
        </div> 
                      <!--       <?php $i = 1;
                    foreach ($press as $row) {
                        ?>
                                	<div id="id<?php echo $i;
                        $i++?>" class="press-block animated fadeInUp">
                                    <p>
                    					"
                    					<?php echo $row['quote']?>
                    					"
                    				</p>
                                    <?php echo $row['author']?> 
                                    <?php if (!empty($row['link'])) {
    ?><a href="<?php echo $row['link']?>" target="_blank"><?php

} ?> <span >~ <?php echo $row['name']; ?></span>
                                    <?php if (!empty($row['link'])) {
    ?></a><?php

} ?> 
                                    </div>
                                    
                                <?php

                    } ?> -->
						</div>
					</div>
				</div><!-- end #press -->
                <?php 
                }
                if ($data_json->show == 'on') {
                    ?>
				<div id="show" class="none">
					<div class="show-content">
						<h2 class="h2 animated fadeInDown">Shows</h2>

						<div class="row">
							<div class="tab-show animated fadeInDown">
							  <!-- Nav tabs -->
							  <ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Upcoming Shows</a></li>
							    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Past Shows</a></li>
							  </ul>

							  <!-- Tab panes -->
							  <div class="tab-content">
							    <div role="tabpanel" class="tab-pane active" id="home">
							    	<div class="panel-body">
					                    <ul class="media-list">
					                        <li class="media">
					                            <div class="media-left">
					                                <img src="http://placehold.it/60x60" class="img-circle">
					                            </div>
					                            <div class="media-body">
					                                <h4 class="media-heading">
					                                    Aenean Consect 
					                                </h4>
					                                <ul class="list-unstyled list-inline">
														<li><i class="fa fa-calendar"></i> January 18, 2017</li>
													</ul>
					                                <p>
					                                    Curabitur vel malesuada tortor, sit amet ultricies mauris. Aenean consectetur ultricies luctus.
					                                </p>
					                            </div>
					                        </li>
					                        <li class="media">
					                            <div class="media-left">
					                                <img src="http://placehold.it/60x60" class="img-circle">
					                            </div>
					                            <div class="media-body">
					                                <h4 class="media-heading">
					                                    Aenean Consect 
					                                </h4>
					                                <ul class="list-unstyled list-inline">
														<li><i class="fa fa-calendar"></i> January 18, 2017</li>
													</ul>
					                                <p>
					                                    Curabitur vel malesuada tortor, sit amet ultricies mauris. Aenean consectetur ultricies luctus.
					                                </p>
					                            </div>
					                        </li>
					                    </ul> 
					                </div>
							    </div>
							    <div role="tabpanel" class="tab-pane" id="profile">
							    		<div class="panel-body">
					                    <ul class="media-list">
					                        <li class="media">
					                            <div class="media-left">
					                                <img src="http://placehold.it/60x60" class="img-circle">
					                            </div>
					                            <div class="media-body">
					                                <h4 class="media-heading">
					                                    Aenean Consect 
					                                </h4>
					                                <ul class="list-unstyled list-inline">
														<li><i class="fa fa-calendar"></i> January 18, 2017</li>
													</ul>
					                                <p>
					                                    Curabitur vel malesuada tortor, sit amet ultricies mauris. Aenean consectetur ultricies luctus.
					                                </p>
					                            </div>
					                        </li>
					                    </ul> 
					                </div>
							    </div>
							  </div>
							</div>
						</div>
					</div>
				</div>

				<div id="blog" class="none">
					<h2 class="h2 animated fadeInDown">Blog</h2>
					<div class="row">
						<div class="bios-content">
							<div class="well">
									      <div class="media">
									      	<a class="pull-left" href="#">
									    		<img class="media-object" src="http://placekitten.com/150/150">
									  		</a>
									  		<div class="media-body">
									    		<h4 class="media-heading"><b>Receta xyz</b></h4>
									          <p class="text-right">By Francisco</p>
									          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
									Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
									dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
									Aliquam in felis sit amet augue.</p>
									          <ul class="list-inline list-unstyled">
									  			<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li>
									            <li>|</li>
									            <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
									            <li>|</li>
									            <li>
									               <span class="glyphicon glyphicon-star"></span>
									                        <span class="glyphicon glyphicon-star"></span>
									                        <span class="glyphicon glyphicon-star"></span>
									                        <span class="glyphicon glyphicon-star"></span>
									                        <span class="glyphicon glyphicon-star-empty"></span>
									            </li>
									            <li>|</li>
									            <li>
									            <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
									              <span><i class="fa fa-facebook-square"></i></span>
									              <span><i class="fa fa-twitter-square"></i></span>
									              <span><i class="fa fa-google-plus-square"></i></span>
									            </li>
												</ul>
									       </div>
									    </div>
									  </div>
							<p style="color: #fff;" class="animated fadeInUp"><?php echo $res_data_artist['bio']?></p>
						</div>
					</div>
				</div><!-- end #bios -->
                 <?php 
                }?>
			</div>
		</div>

		<footer class="navbar-fixed-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="content-f1">
							<p>Download Media:</p>
                            <ul>
                                <?php if ($data_json->dw_photo == 'on') {
    ?>
                                <li><a href="#" id="download_media" data-toggle="modal" data-target="#photo_assets"><i class="fa fa-picture-o"></i> Photos </a></li>
                                <?php 
}
                                 if ($data_json->dw_song == 'on') {
                                     ?>
                                 <li><a href="#"  id="download_audio" data-toggle="modal" data-target="#song_assets"><i class="fa fa-music"></i> Music </a></li>
                                
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

					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="content-f2">
							<?php
                            if (!empty($songs)) {
                                ?><div class="player-song-jwplayer" style="background-color: rgba(0, 0, 0, 0);"><div id="mp3" ></div></div> 
                                <script>
                                    var playerInstance = jwplayer("mp3");
                                    jwplayer("mp3").setup({
                                    stretching: 'fill',
                                    playlist: [
                                        <?php foreach ($songs as $row) {
    ?>
                                        {
                                            sources: [{ 
                                                file: "<?php echo 'http://d2c1n1yejcka7l.cloudfront.net/uploads/'.$res_data_artist['id'].'/audio/'.$row['filename'] ?>"
                                            }]
                                        },
                                            <?php 
} ?>],                                        
                                    height: 35,
                                    width: "100%",
                                    events: {
                                        onPause: function(event){
                                            var index = this.getPlaylistIndex();
                                            $('#song_'+index).find('a').removeClass("selected");
                                        },
                                        onPlay: function(event){
                                            var index = this.getPlaylistIndex();
                                            $( ".song-content li" ).each(function() {
                                                $(this).find('a').removeClass("selected");
                                                $(this).find('a').addClass( "" );
                                            });
                                            $('#song_'+index).find('a').addClass("selected");
                                        }
                                        
                                    }
                                    });
                                </script>
                                <?php

                            }
                            ?>
						</div>
					</div>

					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="content-f3">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Contact Artist</button>
							<button type="button" class="btn btn-default">View Profile</button>
							<script>
        
    function checkOtherMail() {
        console.log('function calls');
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
        console.log('Function calls');
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
                    					    	<li><input type="checkbox" name="to[public_email]"  value="<?php if(!empty($customize['email_artist'])) { echo $customize['email_artist']; }else {'';} ?>" <?php if (empty($customize['email_artist'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Artist</li>
                    					    	<li><input type="checkbox" name="to[booking_email]" value="<?php if(!empty($customize['email_booking'])) { echo $customize['email_booking']; }else{'';} ?>"<?php if (empty($customize['email_booking'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Booking</li>
                    					    	<li><input type="checkbox" name="to[mngt_email]" value="<?php if(!empty($customize['email_manager'])) { echo $customize['email_manager']; }else{'';} ?>" <?php if (empty($customize['email_manager'])) {
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
</body>
</html>