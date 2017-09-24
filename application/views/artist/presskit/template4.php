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
	<link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/template4/main_epk4.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/global.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/epk/template4/style_epk4.css"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
	<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url()?>/assets/js/jquery.steps.js"></script>
	
</head>
<body >
<script type="text/javascript">
	$(document).ready(function(){
	    $end = $("#video .tab-pane").last();
        $first = $("#video .tab-pane").last();
        if($end== $first){
        	$(".video>.button-right").hide();
            $(".video>.button-left").hide();
        }
		$(".video>.button-left").click(function(event){
           
			$("#video .tab-pane").each(function() { 
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
		});// 

		$(".video>.button-right").click(function (event) {
            $("#video .tab-pane").each(function() { 
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

<script type="text/javascript">
	$(document).ready(function(){
		$(".l1").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#intro").offset().top-50}, 700);
		});
		$(".l2").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#image").offset().top-50}, 700);
		});
		$(".l3").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#star").offset().top-50}, 700);
		});
		$(".l4").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#video").offset().top-50}, 700);
		});
		$(".l5").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#bios").offset().top-50}, 700);
		});
		$(".l6").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#song").offset().top-50}, 700);
		});
		$(".l7").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#press").offset().top-50}, 700);
		});
		$(".l8").click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: $("#show").offset().top-50}, 700);
		});
	});
</script>
<?php 
    $data_json = json_decode($customize['data_customize']);
?>
<?php 
     if ($this->session->flashdata('message_error')) {
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
<!-- Wrapper -->
<div id="wrapper" style="min-height: 50vh;">

	<!-- Header -->
		<header id="header">
			<h1><a href="#"><?php echo ucfirst($res_data_artist['artist_name'])?></a></h1>
			<nav class="links">
				<ul>
					<li class="l1"><a href="#">Info</a></li>
                    <?php  if ($data_json->photo == 'on') {
     ?>
					<li class="l2"><a href="#image">Photos</a></li>
                    <?php 
 } if ($data_json->stats == 'on') {
     ?>
					<li class="l3"><a href="#star">Stats</a></li>
                    <?php 
 } if ($data_json->video == 'on') {
     ?>
					<li class="l4"><a href="#video">Videos</a></li><?php 
 }?>
					<li class="l5"><a href="#bios">Bios</a></li>
                    <?php  if ($data_json->song == 'on') {
     ?>
					<li class="l6"><a href="#song">Songs</a></li>
                    <?php 
 } if ($data_json->press == 'on') {
     ?>
					<li class="l7"><a href="#press">Press</a></li>
                    <?php 
 }
                    if ($data_json->show == 'on') {
                        ?>
					<li class="l8"><a href="#show">Shows</a></li>
                    <?php 
                    }?>
				</ul>
			</nav>
			<nav class="main">
				<ul>
					<li class="search">
						<a class="fa-search" href="#search">Search</a>
						<form id="search" method="get" action="#">
							<input type="text" name="query" placeholder="Search" />
						</form>
					</li>
					<li class="menu">
						<a class="fa-bars" href="#menu">Menu</a>
					</li>
				</ul>
			</nav>
		</header>
        
	<!-- Menu -->
		<section id="menu">

			<!-- Search -->
				<section>
					<h2><?php echo ucfirst($res_data_artist['artist_name'])?></h2>
				</section>

			<!-- Links -->
				<section>
					<ul class="links">
						<li>
							<a href="#">Info</a>
						</li>
                        <?php  if ($data_json->photo == 'on') {
     ?>
						<li>
							<a href="#image">Photos</a>
						</li>
                        <?php 
 }  if ($data_json->stats == 'on') {
     ?>
						<li>
							<a href="#star">Stats</a>
						</li>
                        <?php 
 } if ($data_json->video == 'on') {
     ?>
						<li>
							<a href="#video">Videos</a>
						</li>
                        <?php 
 }?>
						<li>
							<a href="#bios">Bios</a>
						</li>
                        <?php  if ($data_json->song == 'on') {
     ?>
						<li>
							<a href="#song">Songs</a>
						</li>
                        <?php 
 } if ($data_json->press == 'on') {
     ?>
						<li>
							<a href="#press">Press</a>
						</li>
                        <?php 
 } if ($data_json->press == 'on') {
     ?>
						<li>
							<a href="#show">Shows</a>
						</li>
                        <?php 
 }?>
					</ul>
				</section>

			<!-- Actions -->

		</section>
    
	<!-- Main -->
		<div id="main" >
             <?php if ($data_json->stats == 'on') {
    ?>
			<!-- Post -->
			<article class="post">
				<div id="info_statistics_div_placeholder" style="">
                    <ul class="new_charts">
                        <li style="border-width: 0px 1px 0px 0px">
                            <div id="gender_demographics" class="">
                                <div class="chartTitle">gender demographics</div>
                                <div class="chartBody">No Data Available</div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div id="demographics" class="">
                                <div class="chartTitle">age breakdown</div>
                                <div class="chartBody">
                                    <div class="row">
                                        <span class="labelChart">13-17</span>
                                        <div class="lineChart">
                                            <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 13, 17)?>%"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="labelChart">18-24</span>
                                        <div class="lineChart">
                                            <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 18, 24)?>%"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="labelChart">25-34</span>
                                        <div class="lineChart">
                                            <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 25, 34)?>%"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="labelChart">35-44</span>
                                        <div class="lineChart">
                                            <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 35, 44)?>%"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="labelChart">45+</span>
                                        <div class="lineChart">
                                            <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 45, 200)?>%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li style="border-width: 1px 1px 0px 0px">
                            <div id="fans" class="">
                                <div class="chartTitle"><span id="fans_count"><?php echo count($fans)?></span>&nbsp;&nbsp;fans</div>
                                <div class="chartBody"></div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li style="border-width: 0px 0px 0px 1px">
                            <div id="fans_near_chart" class="">
                                <div class="chartTitle">fans near</div>
                                <div class="chartBody"> No Data Available </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <div style="clear: both"></div>
                    </ul>
                    <div class="see_all">*Fan demographics represent 99Sound fans only</div>
                </div>
			</article> 
             <?php 
}?>
		</div>
      
	<!-- Sidebar -->
		<section id="sidebar">
			<!-- Intro -->
				<section id="intro">
					<a href="#" class="logo"><img width="150px" src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" alt="" /></a>
					<h3><?php echo $res_data_artist['artist_name'];?></h3>
					<header>
						<div class="info">
							<p><b>From:</b></p>
							<p><?php echo $res_data_artist['city'].', '.$country['country'];?></p>
						</div>

						<div class="info">
							<p><b>Genre:</b></p>
							<p><?php echo $genre['name'];?></p>
						</div>

						<div class="info">
							<p><b>Members:</b></p>
							<p><?php
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
                             </p>
						</div>

						<div class="info">
							<p><b>Bio:</b></p>
							<p><?php custom_echo_html($res_data_artist['bio'], 300)?></p>
						</div>
						
					</header>
				</section>
		</section>
		<div style="clear:both"></div>
</div>

<div id="full" style="min-height: 50vh;">
    <?php if ($data_json->photo == 'on') {
    ?>
	<section id="image">
		<div class="image-content">
			<h3>Photos</h3>
			<div class="image">
                <?php
                foreach ($photos as $pt) {
                    ?><a href="#"><img src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"></a>
                    <?php

                } ?> 
			</div>
		</div>
	</section>
    <?php 
}
    if ($data_json->stats == 'on') {
        ?>
	<section id="star">
		<div class="star-content">
			<h3>Stats</h3>

			<div class="col-4">
				<h5>Their fans live here</h5>
				<p>No Data Available</p>
			</div>

			<div class="col-4">
				<h5>Fan Demographics</h5>
				<p>Top Demographics is Females (age 13-17)</p>
				<div class="index">
					<table>
						<tr>
							<th>Female</th>
							<th>Age</th>
							<th>Male</th>
						</tr>

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
							<td><?php echo $this->Member_model->stast_fan($fans, 55, 200, 1)?>%</td>
						</tr>
						<tr>
							<td><?php echo $this->Member_model->stast_fan($fans, 0, 12, 1)?>%</td>
							<td>n/a</td>
							<td><?php echo $this->Member_model->stast_fan($fans, 0, 12, 2)?>%</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="col-4">
				<h5>Fan Summary</h5>
				<p><b><?php echo count($fans)?> total fans</b></p>
			</div>
		</div>
	</section>
    <?php 
    }
    if ($data_json->video == 'on') {
        ?>    
	<section id="video">
		<div class="video-content">
			<h3>Videos</h3>
			<div class="relative">
				<a href="#" class="button-left" title="previous" ><i class="fa fa-angle-left"></i></a>
				<div class="tab-content">
                    <?php $i = 1;
        foreach ($videos as $row) {
            ?>
                        <div role="tabpanel" class="tab-pane <?php if ($i == 1) {
    echo 'active';
} ?>" id="th<?php echo $i++?>">
    				    <?php 
                        
                            if (!empty($res_data_artist['primary_video'])) { ?>
                                <iframe width="100%" height="380" src="<?= base_url().'video_embed/'.$res_data_artist['primary_video'] ?>" frameborder="0" allowfullscreen></iframe>
                     <?php       } else { ?>
    				    	<iframe width="100%" height="380" src="<?= base_url().'video_embed/'.$row['id']?>" frameborder="0" allowfullscreen></iframe>
                            <?php } ?>
    				    </div>
                        <?php

        } ?>
				    
				 </div>
				 <a href="#" class="button-right" title="next"><i class="fa fa-angle-right"></i></a>
			</div>

		</div>
	</section><!-- end #video -->
    <?php 
    }
    ?>
	<section id="bios">
		<div class="bios-content">
			<h3>Bios</h3>
			<div class="col-9">
				<a href="#"><img width="200px" src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" class="img-responsive"></a>
				<p><?php echo $res_data_artist['bio']?></p>
			</div>
		</div>
	</section><!-- end #bios -->
    <?php 
        if ($data_json->song == 'on') {
            ?>
	<section id="song">
		<div class="song-content">
			<h3>Song</h3>
			<div class="row">
				<div class="col-md-5 li-bn">
					<ul>
                        <?php $i = 0;
            foreach ($songs as $row) {
                ?>
                            <li class="butn" id="song_<?php echo $i; ?>">
                                <a href="javascript:playTrailer('<?php echo $i?>')" class="" >
                                <?php echo $row['song_name']; ?>
                                </a>
                            </li>
                            <?php
                        ++$i;
            } ?>
					</ul>
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
				</div>

				<div class="col-md-7 hidden-xs">
					<?=$this->M_audio_song->get_shortcode_AMP($res_data_artist['id']); ?>
				</div>

				<!-- TODO: <div class="col-md-3">
					<div class="info-song top">
						<h4>This <b>Artist</b> has</h4>
						<p><b>10</b> plays</p>
						<p><b>0</b> downloads</p>
					</div>

					<div class="info-song top">
						<h4>This <b>Song</b> has</h4>
						<p><b>10</b> plays</p>
						<p><b>0</b> downloads</p>
					</div>
				</div> -->
			</div>
				
		</div>
	</section><!-- end #songs -->
    <?php 
        }
    if ($data_json->press == 'on') {
        ?>
	<section id="press">
		<div class="press-content">
			<h3>Press</h3>
			<div class="col-md-3"></div>
			<div class="col-md-6">
                <?php foreach ($press as $row) {
    ?>
                        <p>
        					<i class="fa fa-quote-left"></i>
        					<?php echo $row['quote']?>
        					<i class="fa fa-quote-right"></i>
        				</p>
                        <?php echo $row['author']?> 
                        <?php if (!empty($row['link'])) {
    ?><a href="<?php echo $row['link']?>" target="_blank"><?php

} ?> <span class="publication">~ <?php echo $row['name']; ?></span>
                        <?php if (!empty($row['link'])) {
    ?></a><?php

} ?> 
                    <?php

} ?>
				
			</div>
			<div class="col-md-3"></div>
		</div>
	</section><!-- end #press -->
    <?php 
    }
    if ($data_json->show == 'on') {
        ?>
	<div style="clear:both"></div>
	<section id="show">
		<div class="show-content">
			<h3>Shows</h3>
			<div class="col-md-1"></div>
			<div class="col-md-11">
				<div class="main-tab">
				  <!-- Nav tabs -->
				  <div class="tab-left">
				  	<ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Upcoming Shows</a></li>
					    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Past Shows </a></li>
					  </ul>
				  </div>
					<div class="tab-right">
						<div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="home">No data available</div>
					    <div role="tabpanel" class="tab-pane" id="profile">No data available1</div>
					  </div>
					</div>

				  <!-- Tab panes -->
				</div>
			</div>
		</div>
	</section>
    <?php 
    }
    ?>
</div>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 on1">
				<p>Download Media:</p>
				<ul>
					<?php if ($data_json->dw_photo == 'on') {
    ?>
                    <a href="#" class="icon picture download" id="download_media" data-toggle="modal" data-target="#photo_assets"><i class="fa fa-picture-o"></i> Photos </a>
                    <?php 
}
                     if ($data_json->dw_song == 'on') {
                         ?>
                    <a href="#" class="icon music download" id="download_audio" data-toggle="modal" data-target="#song_assets"><i class="fa fa-music"></i> Music </a>
                    <?php 
                     }
                     if ($data_json->dw_bios == 'on') {
                         ?>
                    <a href="<?php echo base_url('artist/dashboard_epk/download/bio').'/'.$res_data_artist['id']?>" id="download_bio" ><i class="fa fa-user"></i> Bio </a>
                    <?php 
                     }
                     if ($data_json->dw_video == 'on') {
                     ?>
                     <a href="#" class="icon picture download"  data-toggle="modal" data-target="#video" id="download_video" ><i class="fa fa-video-camera"></i> Videos </a>
                    <?php 
                     }
                     if ($data_json->dw_pdf == 'on') {
                     ?>
                     <a href="<?php echo base_url('epk').'/'.$res_data_artist['home_page'].'?action=pdf'?>" id="download_pdf" ><i class="fa fa-file-pdf-o"></i> .pdf </a>
                    <?php 
                     }
                     ?>
				</ul>
			</div>
			<div class="col-sm-offset-4 col-md-4 col-sm-4 on1">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Contact Artist</button>
				<a target="_blank" href="<?php echo base_url().$res_data_artist['home_page']?>" ><button type="button"class="btn btn-default">View Profile</button></a>
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
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
                  <form  method="post">
        			   <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="modal-content">
        			      <div class="modal-header">
        			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			        <h4 class="modal-title" id="myModalLabel">Send Message</h4>
        			      </div>
        			      <div class="modal-body">
        			        
        			           <div class="form-group">
        					    <label for="to">To  <span><?php if(!empty($customize['email_artist'])) { echo $customize['email_artist']; echo ',';}?></span><span><?php if(!empty($customize['email_booking'])) { echo ' '.$customize['email_booking']; echo ',';}?></span><span><?php if(!empty($customize['email_manager'])) { echo ' '.$customize['email_manager']; echo ',';}?></span></label>
        					   <label></label>
        					    <ul>
        					    	<li><input type="checkbox" name="to[public_email]" value="<?php if(!empty($customize['email_artist'])) { echo $customize['email_artist']; }else {'';} ?>" <?php if (empty($customize['email_artist'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Artist</li>
        					    	<li><input type="checkbox" name="to[booking_email]" value="<?php if(!empty($customize['email_booking'])) { echo $customize['email_booking']; }else{'';} ?>" <?php if (empty($customize['email_booking'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Booking</li>
        					    	<li><input type="checkbox" name="to[mngt_email]"  value="<?php if(!empty($customize['email_manager'])) { echo $customize['email_manager']; }else{'';} ?>" <?php if (empty($customize['email_manager'])) {
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
        					    <textarea name="msg"  rows="5" id="msg" cols="10"></textarea>
        					  </div>
        					  
        					
        			      </div>
        			      <div class="modal-footer">
        			        <button type="submit" class="btn btn-primary" id="dialog-confirm" onclick="checkOtherMail()">Send</button>
        			        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</button>
        			      </div>
                      </div>
				    </form>
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
</footer>
<?php
    if (!empty($songs)) {
        ?><div class="player-song-jwplayer" style="background-color: rgba(0, 0, 0, 0);"><div class="container"><div id="mp3" ></div></div> </div>
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
<?php if ($data_json->dw_photo == 'on') {
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
		<?php } if ($data_json->dw_video == 'on') {
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

<script src="<?php echo base_url(); ?>assets/epk/template4/skel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/epk/template4/util.js"></script>
<script src="<?php echo base_url(); ?>assets/epk/template4/main_epk4.js"></script>
</body>

</html>
