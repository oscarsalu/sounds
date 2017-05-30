<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/landing_page/landing_page9.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css">
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript">
$(".effect_slide").click(function(){
    $(this).parent().parent().find("img").click();
})   
</script>
<div class="wrap bg-landing" style="">
    <div class="container bg-lg-ct" style="width: 90%;">
        <div>
            <div class="col-md-12 profile-maxheight dis-n">
                <?php if (!empty($users[0]->banner_image)) {?>
                    <img src="<?php echo base_url(); ?>uploads/<?php echo $users[0]->id; ?>/photo/banner/<?php echo $users[0]->banner_image; ?>" class="n-ds" style="width:102.70%;margin-left:-15px;"/>
                <?php } else { } ?>
                <div class="col-md-6 profile-landing">
                    <div class="col-md-3 col-xs-12 pro-img-1">                                                                                                                     
                        <img class="avata_landing" src="<?php echo $this->M_user->get_avata($users[0]->id)?>"/>                                                 
                    </div>
                    <div class="col-md-9 col-xs-12 pro-img-2">
                        <h1 class="text-h1"><?php echo ucfirst($name); ?></h1>
                        <span><?php if(isset($genres[0]['name'])) echo ucfirst($genres[0]['name']); ?></span>
                        <span class="mg"><?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) {
     echo ', '.ucfirst($country_code[0]['countrycode']);
 }; ?></span>                                             
                    </div>                    
                </div>
                <div class="col-md-6 col-xs-12 info_social">
                    <?php if (!empty($users[0]->bio)) { echo $this->Member_model->short_Text_Bio($users[0]->bio); } ?>
                    <p class="text-justify" style="margin-left: -15px;margin-top: 20px;margin-bottom: 20px;">
                      <a href="<?php echo $users[0]->twitter_username; ?>" target="_blank" title="Twitter">
                        <span class="relative inline" style="height:24px;width:24px">
                          <img alt="Icon_twitter" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_twitter.png?1445003519" style="z-index:1">
                        </span>
                      </a>
                      <a href="<?php echo $users[0]->instagram_username; ?>" title="Instagram">
                        <span class="relative inline" style="height:24px;width:24px">
                          <img alt="Icon_instagram" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_instagram.png?1445003519" style="z-index:1">
                        </span>
                      </a>
                      <a href="<?php echo $users[0]->youtube_username; ?>" target="_blank" title="YouTube">
                        <span class="relative inline" style="height:24px;width:24px">
                          <img alt="Icon_youtube" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_youtube.png?1445003519" style="z-index:1">
                        </span>
                      </a>
                      <a href="<?php echo $users[0]->facebook_username; ?>" target="_blank" title="Facebook">
                        <span class="relative inline" style="height:24px;width:24px">
                          <img alt="Icon_facebook" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_facebook.png?1445003519" style="z-index:1">
                        </span>
                      </a>                          
                    </p>
                </div>
            </div>
            <div class="col-md-12 remove_padding">                
                <div class="col-md-4 padding_left">
                    <?php if (!empty($users[0]->status)){ ?>
                        <div class="row col-md-12 part_session photos_session header_new_style">
                        <div class="remove_part"></div>
                        <div class="status_view">Status: <?php echo $users[0]->status; ?></div>
                    </div>
                    <?php } ?>
                    <div class="row col-md-12 part_session photos_session header_new_style">
                        <div class="remove_part"></div>
                        <h2 class="tt text_caplock"><a href="<?php echo base_url().$name; ?>/photos"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_photo.png" /> Photos</a></h2>
                        <span class="liner_landing"></span>
                        <div class="col-md-12 remove_padding">
                            <ul class="docs-pictures clearfix">
                            <?php $count = count($photos);
                                 if ($count == 3) {
                                     $i = 0;
                                     foreach ($photos as $pt) {
                                         ?>
                                 <li class="col-md-4 col-xs-4">
                                    <div class="image_fix_value" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                    <img width="1px" style="width: 1px !important;" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/>
                                    
                                </li>
                            <?php ++$i;
                                     }
                                 } elseif ($count == 2) {
                                     $i = 0;
                                     foreach ($photos as $pt) {
                                         ?>
                                 <li class="col-md-4 col-xs-4">
                                    <div class="image_fix_value" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                    <img width="1px" style="width: 1px !important;" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>"class="img-responsive"/>
                                   
                                </li>
                            <?php ++$i;
                                     } ?>
                                <li class="col-md-4 col-xs-4">
                                    <div class="image_fix_value" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                    <img width="1px" style="width: 1px !important;" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                    
                                </li>
                                    <?php 
                                 } elseif ($count == 1) {
                                     foreach ($photos as $pt) {
                                         ?>
                                     <li class="col-md-4 col-xs-4">
                                        <div class="image_fix_value" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                        <img width="1px" style="width: 1px !important;" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/>
                                        
                                    </li>
                                    <?php 
                                     } ?>
                                        <div class="col-md-4 col-xs-4">
                                            <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"  class="img-responsive"/>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"class="img-responsive"/>
                                        </div>
                                    <?php 
                                 } else {
                                     ?>
                                    <div class="col-md-4 col-xs-4">
                                        <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                    </div> 
                            <?php 
                                 } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="row col-md-12 part_session photos_session header_new_style">
                        <div class="remove_part"></div>
                        <h2 class="tt text_caplock"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_member.png" /> Member</h2>
                        <span class="liner_landing"></span>
                        <div class="col-md-12 remove_padding">
                            <!--<div>
                                <div class="col-md-3 col-xs-3">
                                    <img width="70" src="<?php echo base_url(); ?>assets/images/2.jpg"/>
                                </div>
                                <div class="col-xs-9 col-md-9 remove_padding">
                                    <span class="col-xs-12"><span class="ListName" itemprop="name"><a href="#">Lamberg Smith</a></span></span>
                                    <span class="col-xs-12 DisName">Multi-Instrumentalist</span>
                                </div>
                            </div>-->
                            
                                <?php foreach($members as $member){ 
                            
                            ?>
                        
                        <div class="carousel-info">
                            <img alt="" src="<?php echo base_url(); ?>uploads/<?php echo $member['artist_id'];?>/image_member/<?php echo $member['member_image'];?>" class="pull-left">
                            <div class="pull-left">
                                <span class="testimonials-name"><a href="#"><?php echo $member['name_member']; ?></a></span>
                                <span class="testimonials-post"><?php echo $member['contribution'];?></span>
                            </div>
                        </div>
                        <?php } ?><!--  carousel-info  -->
                        </div>
                    </div>
                    <?php if (isset($blogs) && count($blogs) > 0) {?>
                    <div class="row col-md-12 part_session photos_session header_new_style">
                        <div class="remove_part"></div>
                        <h2 class="tt text_caplock"><a href="<?php echo base_url('artist/allblogs').'/'.$id; ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_blog.png" /> Recent Blogs</a></h2>
                        <span class="liner_landing"></span>
                        <div class="col-md-12 remove_padding">
                            <?php foreach ($blogs as $row) {?>
                                <div class="mb1"> 
                                    <div class="mb1-blog-img">                                   
                                        <img class="img-responsive" width="150" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>" />
                                    </div>
                                    <div class="mb1-blog-content">                                                                                                                                                                                                                                                                                                         
                                        <strong>
                                            <a href="<?php echo base_url('artist/blogs').'/'.$user_data['id']?>" class="blog_entry_header ellipsis  h6-size"><?php echo $row['title']?></a>
                                        </strong>
                                        <div class="" style="color: #000;">
                                            <span style=" font-size: small;"><?php echo date('M d, Y', $row['time'])?></span>
                                        </div>
                                        <div style="color: #000;">                                      
                                            <?php 
                                                $text = strip_tags($row['introduction']);
                                                $desLength = strlen($text);
                                                //var_dump($desLength);exit;            
                                                $stringMaxLength = 120;
                                            if ($desLength > $stringMaxLength) {
                                                $des = substr($text, 0, $stringMaxLength);
                                                $text = $des.'...';
                                                echo $text;
                                            } else {
                                                echo $row['introduction'];
                                            } ?>
                                        </div>   
                                    </div>                                                                   
                                </div>
                                <?php
                                if (end($blogs) != $row) {
                                    echo '<hr style="margin-bottom:0px;" />';
                                }
} ?>
                        </div>
                    </div>
                    <?php 
} ?>
                    <?php if (isset($events) && count($events) > 0) {
    ?>
                    <div class="row col-md-12 part_session photos_session header_new_style">
                        <div class="remove_part"></div>
                        <h2 class="tt text_caplock"><a href="#"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_git_event.png" /> Events</a></h2>
                        <span class="liner_landing"></span>
                        <div class="col-md-12 remove_padding">
                            <?php foreach ($events as $event) { ?>
                            <div class="wp_content_list">
                                <a href="#" class="show_ev item" data-event="<?=$event['event_id']; ?>" style="font-size: 16px;text-decoration: none;" data-toggle="modal" data-target="#showEvent">
                                    <figure class="effect-bubba" style="float: left; width: 100px;margin: 5px;">
            							<img class="img-responsive" src="<?php if (!empty($event['event_banner'])) {
    echo base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
} ?>" />
                                    </figure>
                                    <span class="OtListName"><?php echo ucfirst($event['event_title']); ?></span><br />
									<span class="DisName"><?php  custom_echo_html($event['event_desc'], 400); ?> </span>
                                </a><br />
                                
                                <div class="clearfix"></div>
                            </div>
                            <?php 
                            } ?>
                        </div>
                        
                       
                    </div>
                    <?php 
} ?>
                </div>
                <div class="col-md-4 margin_center">
                    <?php if (isset($album_songs) && count($album_songs) > 0) {?>
                    <div class="row col-md-12 part_session photos_session header_new_style">
                        <div class="remove_part"></div>
                        <h2 class="tt text_caplock"><a href="<?php echo base_url('artist/allsong').'/'.$id; ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_songs.png" /> Songs</a></h2>
                        <span class="liner_landing"></span>
                        <div class="col-md-12 remove_padding">

                        <div class="panel-group" id="accordion">

                            <?php

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
                                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php if ($i == 1) {
    echo 'in';
} ?>">
                                    <div class="panel-body remove_padding">
                                    <?php $video_by_albums = $this->M_audio_song->get_songs_by_album($album_song['id']); ?>

                                        <script type="text/javascript">
                                        $(document).ready(function(){

                                        	new jPlayerPlaylist({
                                        		jPlayer: "#jquery_jplayer_<?php echo $album_song['id']; ?>",
                                        		cssSelectorAncestor: "#jp_container_<?php echo $album_song['id']; ?>"
                                        	}, [
                                                <?php
                                                foreach ($video_by_albums as $video_by_album) {
                                                    $array_avai = explode(',', $video_by_album['availability']); ?>
                                        		   {
                                                        title:"<?php echo $video_by_album['song_name'] ?>",
                                                        mp3:"<?php echo 'http://d2c1n1yejcka7l.cloudfront.net/uploads/'.$id.'/audio/'.$video_by_album['audio_file'] ?>",
                                                        poster: "<?php echo base_url().'uploads/'.$id.'/img_playlist/'.$album_song['image_file']; ?>",
                                                        <?php
                                                        if (in_array('2', $array_avai)) {
                                                            ?>
                                                            link_download: "<?=base_url('artist/downloadsong/'.$video_by_album['id'])?>",
                                                            download: true
                                                            <?php

                                                        } ?>
                                                    },
                                        		<?php
                                                } ?>
                                        	], {
                                        		swfPath: "<?php echo base_url('assets/playermusic/dist/jplayer') ?>",
                                        		supplied: "webmv, ogv, m4v, oga, mp3",
                                        		useStateClassSkin: true,
                                        		autoBlur: false,
                                        		smoothPlayBar: true,
                                        		keyEnabled: true,
                                        		audioFullScreen: true
                                        	});
                                        });
                                        </script>
                                                <div id="jp_container_<?php echo $album_song['id']; ?>" class="jp-video jp-video-270p" role="application" aria-label="media player">
                                                	<div class="jp-type-playlist">
                                                		<div id="jquery_jplayer_<?php echo $album_song['id']; ?>" class="jp-jplayer"></div>
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
    } ?>
                            </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if (isset($videos) && count($videos) > 0) {?>
                            <div class="row col-md-12 part_session photos_session header_new_style">
                            <div class="remove_part"></div>
                            <h2 class="tt text_caplock"><a href="<?php echo base_url('artist/allvideos').'/'.$id; ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_video.png" /> Videos</a></h2>
                            <span class="liner_landing"></span>
                            <div class="col-md-12 remove_padding">
                                <?php 
                                foreach ($videos as $video) {
                                    if ($video['type'] == 'file') {
                                        $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
                                    } else {
                                        $link_video = $video['link_video'];
                                    } ?>
                                <div class="wp_content_list">
                                    <div class="col-md-4 col-xs-4">
                                        
                                        <a href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos">
                                            <div class="image_fix_value_video" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');"></div>
                                        </a>
                                    </div>
                                    <div class="col-xs-8 col-md-8 remove_padding">
                                        <span class="col-xs-12 content_video_title"><?php echo $video['name_video']; ?></span>
                                    </div>
                                    <div class="clearfix_check"></div>
                                </div>          
                            <?php 
                                } ?>
                            </div>
                        </div>
                        <?php } ?>
                            <div class="row col-md-12 part_session photos_session header_new_style">
                            <div class="remove_part"></div>
                            <h2 class="tt text_caplock"><a href="<?php echo base_url('artist/allcomment').'/'.$id;?>">
                            <img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_comment.png" /> Comments</a></h2>
                            <span class="liner_landing"></span>
                            <div class="col-md-12 remove_padding">
                                <div class="wp_content_list">
                                    <?php
                                    if (empty($comments)) {
                                        ?>
                                        <span class="col-md-12" style="font-size: 16px;">No Comment.</span>
                                        <?php

                                    }
                                    foreach ($comments as $comment) {
                                        ?>
                                            <span class="col-md-12" style="font-size: 16px;">
                                                <a href="<?=$this->M_user->get_home_page($comment['client'])?>">
                                                    <img width="60" style="min-height: 40px;margin-bottom: 5px;margin-right: 10px;" src="<?=$this->M_user->get_avata($comment['user_id'])?>" />
                                                </a>
                                                <span class="OtListName"><a href="<?=$this->M_user->get_home_page($comment['client'])?>" class="posi_img" style="position:absolute;">
                                                    <?=$this->M_user->get_name($comment['client'])?>
                                                </a>
                                                </span>
                                                <span class="DisName"><?php echo ucfirst($comment['comment']); ?></span>
                                                <?php if (end($comments) != $comment) {
    echo '<hr class="hr-small" />';
} ?>
                                            </span>
                                               
                                        <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-md-12 remove_padding">
                            
                            </div>
                            
                            <div class="text-center">
                                <a href="#" class="btn btn-default Dnew" data-toggle="modal" data-target="#addComment">Comment</a>
                            </div>
                        </div>
                    </div>
                <div class="col-md-4 padding_right">
                        <div class="row col-md-12 part_session photos_session header_new_style">
                            <div class="remove_part"></div>
                            <h2 class="tt text_caplock"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_amp.png" /> AMP</h2>
                            <span class="liner_landing"></span>
                            <div class="col-md-12 remove_padding">
                                <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
                            </div>
                        </div>
                        <div class="row col-md-12 part_session photos_session header_new_style">
                            <div class="remove_part"></div>
                            <h2 class="tt text_caplock"><a href="<?php echo base_url('social_media');?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_quickactions.png" /> Quick Actions</a></h2>
                            <span class="liner_landing"></span>

                            <div class="col-md-6 searchform">
                                <button class="btn btn-default col-xs-12" style="margin-top: 20px;padding: 15px;">Share</button>
                            </div>
                            <div class="col-md-6 searchform">
                                <?php $home_page = $this->uri->segment(1);
                                    $results = $this->db->where('home_page', $home_page)
                                                ->get('users')->result_array();
                                    foreach ($results as $result) {
                                        $user_i = $result['id'];
                                    }

                                    $isset = $this->db->where('user_id', $user_i)->where('fan_id', $user_id)->get('fans')->num_rows();
                                ?>
                                <a href="<?php if ($isset > 0) {
    echo '#';
} else {
    echo base_url().'artist/comefan/'.$user_id.'/'.$home_page;
} ?>" class="btn Dnew <?php if ($isset > 0) {
    echo 'btn-default';
} else {
    echo 'btn-default';
} ?> col-xs-12" style="margin-top: 20px;padding: 15px;<?php if ($isset > 0) {
    echo 'cursor: no-drop;';
} ?>">Be Come A Fan</a>
                            </div>
                            <!--BTN ADD CONTACT-->
                            <?php
                            if ($users[0]->id != $user_data['id']) {
                                ?>
                                <div class="col-md-12 searchform">
                                    <a class="btn btn-default col-xs-12" href="#" style="margin-top: 20px;padding: 15px;" data-toggle="modal" data-target="#invite-contact">Add Contact Chat</a>
                                </div>
                                <?php

                            }
                            ?>
                            <!--//BTN ADD CONTACT-->
                        </div>
                        <div class="row col-md-12 part_session photos_session header_new_style">
                            <div class="remove_part"></div>
                            <h2 class="tt text_caplock"><a href="<?php echo base_url('social_media');?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_status.png" /> Stats</a></h2>
                            <span class="liner_landing"></span>
                            <div class="col-md-12">
                                <div class="wp_content_list">
                                    <i class="fa fa-music"></i>
                                    <span class="full-w" style="font-size: 16px;margin-left: 15px;">Song Plays</span>
                                    <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span><?php echo $num_songs;?></span>
                                </div>
                                <div class="wp_content_list">
                                    <i class="fa fa-file-video-o"></i>
                                    <span class="full-w" style="font-size: 16px;margin-left: 15px;">Video Plays</span>
                                    <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span><?php echo $num_videos;?></span>
                                </div>
                                <div class="wp_content_list">
                                    <i class="fa fa-users"></i>
                                    <span class="full-w" style="font-size: 16px;margin-left: 15px;">Total Fans</span>
                                    <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span><?php echo $num_fands; ?></span>
                                </div>
                                <div class="wp_content_list">
                                    <i class="fa fa-hand-rock-o"></i>
                                    <span class="full-w" style="font-size: 16px;margin-left: 15px;">Total Events</span>
                                    <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span><?php echo $num_events; ?></span>
                                </div>
                                <div class="wp_content_list">
                                    <i class="fa fa-bookmark"></i>
                                    <span class="full-w" style="font-size: 16px;margin-left: 15px;">Total Blogs</span>
                                    <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span><?php echo $num_blogs; ?></span>
                                </div>
                                <div class="wp_content_list">
                                    <i class="fa fa-comments"></i>
                                    <span class="full-w" style="font-size: 16px;margin-left: 15px;">Total Comments</span>
                                    <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span><?php echo $num_comments; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($fans) && count($fans) > 0) { ?>
                        <div class="row col-md-12 part_session photos_session header_new_style">
                            <div class="remove_part"></div>
                            <h2 class="tt text_caplock"><a href="<?php echo base_url('artist/allfans').'/'.$id; ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_quickactions.png" /> Fans</a></h2>
                            <span class="liner_landing"></span>
                            <div class="col-md-12 remove_padding">
                                <?php 
                                $i = 0;
    foreach ($fans as $fan) {
        ?>                        
                                        <div class="col-md-3 col-xs-3" style="<?php if ($i == 0 || $i = 1 || $i == 2 || $i == 3) {
    echo 'margin-bottom: 10px;';
}
        if ($i == 0 || $i == 4) {
        } else {
            echo 'margin-left:-5px';
        } ?>"><a href="<?php echo base_url().$fan['home_page']; ?>"><img title="<?php echo $fan['artist_name']; ?>" style="min-height: 70px;max-height: 70px;" width="70" src="<?php if (!empty($fan['avata'])) {
    echo base_url().'uploads/'.$fan['user_id'].'/photo/'.$fan['avata'];
} else {
    echo base_url().'assets/images/default-img.gif';
}; ?>"/></a></div>
                                <?php ++$i;
    } ?>   
                            </div>
                        </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal comment -->
<div class="modal fade new_modal_style" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/membercomment'?>" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_artist" value="<?=$id?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add a Comment</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">     
                        <label class="form-input col-md-2">Comment</label>
                        <div class="input-group col-md-9">
                        <textarea class="form-control" name="comment" rows="6" required="" ></textarea>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default Dnew" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default Dnew">Add</button>
                </div> 
            </form>      
        </div>       
    </div>
</div>
<!-- Modal showEvent -->
<div class="modal fade new_modal_style" id="showEvent" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                
                <h4 class="tt" id="myModalevent">Add a Comment</h4>
                <span class="liner"></span>
            </div>            
            <div class="modal-body">                                                     
                 <div class="col-md-12">
                    <img id="event_banner" src="" width="535" />
                 </div>   
                 <div class="col-md-12 text-center" style="margin-top: 10px;">
                    <span id="cat" style="font-weight: bold; font-size: 18px;"></span>
                 </div>
                 <div class="col-md-12" style="padding:10px 30px  0px 15px;">
                    <span style="float: left;">Start Date: <span id="start" ></span></span>
                    <span style="float: right;">End Date: <span id="end" style="color: red;"></span></span>
                 </div>
                 <div class="col-md-12" style="padding: 20px 30px">
                    <span id="des"></span>
                 </div> 
                 <div class="col-md-12">
                    <span>Post By: <span id="post-b" style="font-weight: bold;"></span></span>
                 </div>
                 <div class="col-md-12">
                    <span>Location: <span id="lo" style="font-weight: bold;"></span></span>
                 </div>
            </div>
            <div class="modal-footer searchform" style="border-top: none;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>                                    
        </div>
    </div>
</div>
<!-- Modal Invite Contact -->
<div class="modal fade" id="invite-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Invite Contact (<?=$this->M_user->get_name($users['0']->id)?>)</h4>
			</div>
            <form class="form form-signup" action="<?php echo base_url()?>chat/invite_contact" method="post"  >
            	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
    				<div class="form-group">
    					<label class="form-input col-md-3">Messages</label>
    					<div class="input-group col-md-8">
                            <input type="hidden" name ="user_invite" value="<?php echo $user_data['id']?>" />
                            <input type="hidden" name ="user_to" id="user_id2" value="<?php echo $users['0']->id?>" />
    						<textarea class="form-control" rows="5" name="messages_invite">Hi <?=$this->M_user->get_name($users['0']->id)?>, I'd like to add you as a contact.</textarea>
    					</div>
    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				<button type="submit" class="btn btn-primary">Add to Contacts</button>
    			</div>
            </form>
		</div>
	</div>
</div>
<!--MODAL video-->
    <div class="modal fade" id="videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div id="video"></div>
            <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>      
        </div>
    </div>
    
    <div class="modal fade" id="photos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog text-center" role="document">
            <img src="<?php echo base_url(); ?>assets/images/adaptable.jpg" width="500" height="400"/>
        </div> 
    </div>
</div>    

<script type="text/javascript">
var url = "<?php echo base_url(); ?>";   
</script>
<script src="<?php echo base_url(); ?>assets/landing-page/js/landing-page-1.js"></script> 
