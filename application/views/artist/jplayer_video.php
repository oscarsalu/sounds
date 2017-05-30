<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<!-- Website Design By: www.happyworm.com -->
<title>Demo : jPlayer as a video player</title>


<script>var base_url="<?php echo base_url();?>"</script>


<!--<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/bootstrap-slider.min.css" rel="stylesheet" media="screen" type="text/css" />
<script src="<?php echo base_url()?>assets/js/bootstrap-slider.min.js"></script>-->
<script src="<?php echo base_url();?>assets/amp/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/amp/js/jquery.jplayer.min.js"></script>
<link href="<?=base_url('assets/amp/css/jplayer.pink.flag.css')?>" rel="stylesheet" type="text/css" />

    <?php if($video['video_file1']!=""){
                                        $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$video['user_id'].'/audio/'.$video['video_file1'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$video['user_id'].'/audio/'.$video['video_file1'];
                                        } else if($video['video_file2']!=""){
                                             $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$video['user_id'].'/audio/'.$video['video_file2'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$video['user_id'].'/audio/'.$video['video_file2'];
                                        }
                                        else {
                                             $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$video['user_id'].'/audio/'.$video['video_file3'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$video['user_id'].'/audio/'.$video['video_file3'];
                                        } ?>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

	$("#jquery_jplayer_video_<?php echo $video['id'];?>").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				title: "<?php echo $video['song_name']."-".$data_playlist['name'];?>",
                                <?php if($file_format_video=="mp4"){ ?>
                                     <?php echo "m4v"?>: "<?php echo $file_url_video;?>",
				
                                <?php } else if($file_format_video=="webm") { ?> 
                                <?php echo "webmv"?>: "<?php echo $file_url_video;?>",<?php } else { ?>
                                 <?php echo $file_format_video;?>: "<?php echo $file_url_video;?>",
                                <?php } ?>
                                    
			});
		},
                play: function() { // To avoid multiple jPlayers playing together.
			$(this).jPlayer("pauseOthers");
		},
		swfPath: "<?php echo FCPATH."assets/amp";?>",
               
                supplied: "<?php if($file_format_video=="mp4"){ echo "m4v"; } else if($file_format_video=="webm") { echo "webmv";}else { echo $file_format_video; }?>",
                 size: {
			width: "480px",
			height: "270px",
			
		},
                cssSelectorAncestor: "#jp_container_video_<?php echo $video['id'];?>",
		
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		
	});

});




//]]>
</script>
</head>
<body>
 <div id="jp_container_video_<?php echo $video['id'];?>" class="jp-video jp-video-270p" role="application" aria-label="media player">
	<div class="jp-type-single">
            <div id="jquery_jplayer_video_<?php echo $video['id'];?>" class="jp-jplayer"></div>
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
				<div class="jp-details">
					<div class="jp-title" aria-label="title">&nbsp;</div>
				</div>
				<div class="jp-controls-holder">
					<div class="jp-volume-controls">
						<button class="jp-mute" role="button" tabindex="0">mute</button>
						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
					<div class="jp-controls">
						<button class="jp-play" role="button" tabindex="0">play</button>
						<button class="jp-stop" role="button" tabindex="0">stop</button>
					</div>
					<div class="jp-toggles">
						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
					</div>
				</div>
			</div>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
      </div>

</body>
</html>