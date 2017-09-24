<!-- Start header  -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/landing_page/landing_page1_flp.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<script type="text/javascript">
    $(".effect_slide").click(function(){
        $(this).parent().parent().find("img").click();
    });
    // $(".videodiv").mCustomScrollbar();
    
    (function($){
        $(window).load(function(){
            $("#content-m, .scroller").mCustomScrollbar({theme:"minimal-dark"});
        });
    })(jQuery);
</script>

<style>
    .jp-video .jp-type-playlist .jp-controls {
        margin-left: 85px !important;
    }
    .jp-video .jp-toggles {
        right: 115px !important;
    }
    .jp-full-screen {
        margin-left: 0px;
    }
    .jp-volume-bar {
        width: 36px;
        left:15px;
    }
    .jp-volume-max {
        left: 60px;
    }

</style>
<!--  End header  -->
<header>
        <div class="container">
            <div class="row">
            <div class="col-md-12">
        <div  style="background:url(<?php if(!empty($users[0]->banner_image)){echo base_url().'uploads/'.$users[0]->id.'/photo/banner/'.$users[0]->banner_image; }else{ echo base_url().'assets/demotemp/images/profile-pic.jpg';} ?>) no-repeat center center; background-size:100% 100%;">
            <div class="row">
                <div class="col-sm-7 text-center">
                    <div class="header-content">
                        <div class="header-content-inner">
                           <?php if (!empty($users[0]->bio)){ ?>
                                <h1><?php echo $this->Member_model->short_Text_Bio($users[0]->bio); ?></h1>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="device-container">
                        <div class="profile-sidebar">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="<?php echo $avata; ?>" class="img-responsive" alt="">
                            </div> 
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <?php echo ucfirst($name); ?>
                                </div>
                                <div class="profile-usertitle-job">
                                    <?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) {
                                    echo ', '.ucfirst($country_code[0]['countrycode']);
                                }; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </header>
    <section id="download" class="sc-wrapper">
        <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-xs-12">
                        <div class="page-content">
                            <div class="home-blog-box-list clearfix">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        
                                    
                                    <div class="col-lg-6 col-sm-6 col-xs-12"  >
                                        <div class="home-blog-box-item">
                                            <div class="small-blog-list-cat-name">
                                                <div class="ico-img panel-title text-center">
                                                    <span>
                                                        <i class="fa fa-music fa-spin-hover" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                 <h2 class="panel-tp">VIDEOS</h2> 
                                            </div>
                                            <div class="video" id="content-m" style="max-height: 450px;overflow-y: scroll;overflow-x: hidden;">
                                             
                                            <?php if (isset($videos) && count($videos) > 0) {?>
                                            <?php foreach ($videos as $video) {
                                             if ($video['type'] == 'file') { $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];}
                     elseif($video['type'] == 'link') { $link_video = $video['link_video']; }
                    elseif($video['type'] == 'link-vimeo') { 
                    $video_vimeo=basename($video['link_video']);
                    $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                     
                    $hash = unserialize(file_get_contents($get_link));
                    $url_id=$hash[0]['id'];
                    $link_video = 'https://player.vimeo.com/video/'.$url_id.'?title=0&byline=0&portrait=0'; }?>
                                            
                                            <div  >
                                                <figure class="img-responsive">
                                                    <img src="<?=$this->M_video->get_image_video($video['id'])?>">
                                                    <figcaption>
                                                        <span class="video-details"><?php echo $video['name_video']; ?></span>
                                                    </figcaption>
                                                    <span class="actions">
                                                        <?php if(($video['type'] == 'file') || ($video['type'] == 'link')) { ?>
                                                         <button class="btn btn-warning bnt-action" type="submit" href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos" >View </button>
                                                           <?php } else { ?>
                                                            <button class="btn btn-warning bnt-action" type="submit" href="#vimeo_videos" onclick="javascript:play_vimeo_video(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#vimeo_videos" >View </button>
                                                           <?php } ?>
                                                    </span>
                                                </figure>
                                            </div>
                                            
                                            <?php }  } ?>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                              <div class="home-blog-box-item">
                                            <div class="small-blog-list-cat-name">
                                                <div class="ico-img panel-title text-center">
                                                    <span>
                                                        <i class="fa fa-calendar fa-spin-hover" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                 <h2 class="panel-tp">Blog</h2>
                                            </div>    
                                                <div class="row well well-sm scroller" style="max-height: 450px;overflow-y: scroll;overflow-x: hidden;">
                                                <?php if (isset($blogs) && count($blogs) > 0) {  ?>
                                                 <?php foreach ($blogs as $row) { 

                                                    ?>
                                                    <div class="col-xs-4 col-md-4 text-center">
                                                        <img src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>" alt="Image"
                                                            class="img-rounded img-responsive" />
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 section-box">
                                                        <h4>
                                                            <a href="<?php echo base_url('artist/blogs').'/'.$user_data['id']?>"><?php echo $row['title']?></a>
                                                        </h4>
                                                        <p>
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
                                                            } ?></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            
                                                            <span class="glyphicon glyphicon-comment"></span>(<?php echo $row['blog_comments_count'];?> Comments)
                                                        </div>
                                                        <hr/>
                                                         <?php } }?>
                                                    </div>     
                                        </div> 
                                    </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="home-blog-box-item">
                                            <div class="small-blog-list-cat-name">
                                                <div class="ico-img panel-title text-center">
                                                    <span>
                                                        <i class="fa fa-play fa-spin-hover" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                 <h2 class="panel-tp">AMP</h2> 
                                            </div>
                                            <div class="video" style="padding:2px;">
                                                <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
                                            </div>
                                        </div>
                                        </div>
                                      
                                    </div>
                                 <?php if($role == 1) { ?> 
                                    
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="home-blog-box-item">
                                            <div class="small-blog-list-cat-name">
                                                <div class="ico-img panel-title text-center">
                                                    <span>
                                                        <i class="fa fa-calendar fa-spin-hover" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                 <h2 class="panel-tp">Events</h2>
                                            </div>    
                                                <div class="row well well-sm scroller" style="height:284px; max-height: 284px;overflow-y: scroll;overflow-x: hidden;">
                                                <?php if (isset($events) && count($events) > 0){ ?>                      
                                                <?php foreach ($events as $event) {?>
                                                    <div class="col-xs-4 col-md-4 text-center">
                                                        <img src="<?php if (!empty($event['event_banner'])) { echo base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; } ?>"  alt="Image"
                                                            class="img-circle img-responsive" />
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 section-box">
                                                        <h4>
                                                            <a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a>
                                                        </h4>
                                                        <p>
                                                            <?php  custom_echo_html($event['event_desc'], 400); ?></p>
                                                        </div>
                                                        
                                                        <hr/>
                                                         <?php } }?>
                                                    </div>     
                                            </div> 

                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="home-blog-box-item">
                                            <div class="small-blog-list-cat-name">
                                                <div class="ico-img panel-title text-center">
                                                    <span>
                                                        <i class="fa fa-calendar fa-spin-hover" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                 <h2 class="panel-tp">Fans</h2>
                                            </div>    
                                                <div class="row well well-sm scroller" style="height:284px; max-height: 284px;overflow-y: scroll;overflow-x: hidden;">
                                               <?php if (isset($fans) && count($fans) > 0) { ?>                       
                           <?php $i = 0; foreach ($fans as $fan) { 
                            if($fan['role'] == 1)
                            {
                              $avata = $this->M_user->get_avata($fan['fan_id']);
                            }else{
                                $avata = $this->M_user->get_avata_flp($fan['fan_id']);
                            }
                            ?>
                            <div class="col-xs-12 col-md-12" style="padding-bottom: 5px">
                                
                            
                                <div class="col-xs-4 col-md-4 text-center">
                                    <img src="<?php echo $avata?>" alt="Image"
                                        class="img-rounded img-responsive" />
                                </div>
                                <div class="col-xs-8 col-md-8 section-box">
                                    <h4>
                                        <a href="<?php echo base_url().$fan['home_page']; ?>"><?php echo $this->M_user->get_name($fan['fan_id']); ?></a>
                                    </h4>
                                    
                                </div>
                                                        
                                    <hr/>
                                    </div>
                                 <?php } }?>
                        </div>     
                                        </div> 
                                        </div>
                                            
                                    </div>
                                    <?php }    ?>
                                </div>   
                            </div>
                       </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="sidebar-right">
                            <div class="widget-box">
                                <div class="about-widget">
                                    <div class="ico-img panel-title text-center">
                                        <span>
                                         <i class="fa fa-picture-o fa-spin-hover" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <h2 class="panel-tp"> Photos</h2>    
                                       <ul class="instagram-photo-list docs-pictures">
                                       <?php 
                                            $i = 0;
                                            foreach ($photos as $pt) {
                                                ?>
                                           <li class="effect_slide_wp">
                                                <a href="#" data-gal="photo" class="effect_slide">
                                                 <img data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" alt="Img">
                                                 </a>
                                          </li>
                                           <?php ++$i;
                                                }
                                            ?>
                                              
                                       </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right">
                            <div class="widget-box">
                                <div class="about-widget">
                                    <div class="ico-img panel-title text-center">
                                        <span>
                                         <i class="fa fa-users fa-spin-hover" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <h2 class="panel-tp">Quick Action</h2>    
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <table class="table">
                                                    <tr>
                                                        <td><a href="<?php echo base_url().'social_media'?>"><button  class="btn btn-default btn-sm com">Share</button></a></td>
                                                        <?php if($role == 1) { ?>
                                                        <td><?php $home_page = $this->uri->segment(1);
                                if($home_page == 'amp')
                                {
                                    $home_page = $this->uri->segment(2);
                                }
                                $results = $this->db->where('home_page', $home_page)->get('users')->result_array();
                                if($results){

                                    
                                foreach ($results as $result) { $user_i = $result['id']; }
                                $isset = $this->db->where('user_id', $user_i)->where('fan_id', $user_id)->get('fans')->num_rows();
                                ?>
                                <a href="<?php if ($isset > 0) { echo '#'; } else { echo base_url().'artist/comefan/'.$user_id.'/'.$home_page; } ?>" class="<?php if ($isset > 0) { echo 'btn btn-default btn-sm com'; } else {echo 'btn btn-primary btn-sm com'; } ?> " style="<?php if ($isset > 0) {
                                    echo 'cursor: no-drop;';
                                } ?>"> Become A Fan</a>
                                <?php
                                }?></td>

                                    <?php } ?>
                                    </tr>
                                    <?php
                                if ($users[0]->id != $user_data['id']) {
                                    ?>
                                    <tr >
                                        <td colspan="2"><div class="col-md-12 col-md-12">
                                        <a class="btn btn-default com"  data-toggle="modal" data-target="#invite-contact">Add Contact Chat</a>
                                    </div></td>
                                    </tr>
                                    <?php

                                }
                                ?>
                                </table>
                               
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right">
                            <div class="widget-box">
                                <div class="about-widget">
                                    <div class="ico-img panel-title text-center">
                                        <span>
                                         <i class="fa fa-eye fa-spin-hover" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <h2 class="panel-tp">Social Media</h2>    
                                        <ul class="widget-social">
                                            <li>
                                                <a href="<?php echo $user_info['facebook_username']?>" target="_blank">
                                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                                </a>
                                                
                                            </li>
                                            <li>
                                                  <a href="<?php echo $user_info['twitter_username']?>" target="_blank">
                                                   <i class="fa fa-twitter" aria-hidden="true"></i>
                                                   </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $user_info['instagram_username']?>" target="_blank">
                                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="<?php echo $user_info['youtube_username']?>" target="_blank">
                                                <i class="fa fa-youtube" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right scroller" style="max-height: 235px;">
                            <div class="widget-box">
                                <div class="about-widget">
                                    <div class="ico-img panel-title text-center">
                                        <span>
                                         <i class="fa fa-comments-o fa-spin-hover" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <h2 class="panel-tp">COMMENTS</h2>    
                                
                                    <div class="panel-body">
                                        <?php if (empty($comments)) { ?>
                                    <span class="col-md-12" style="font-size: 16px;">No Comment.</span>
                                <?php } foreach ($comments as $comment) { ?>
                                        <?php $role = $this->M_user->get_user_role($comment['client']);
                                        ?>
                                       <a href="<?php echo $this->M_user->get_home_page($comment['client']);?>">
                                            <img alt="" style="height: 60px" src="<?php if($role == '1'){ echo $this->M_user->get_avata($comment['client']);} else {echo $this->M_user->get_avata_flp($comment['client']);}?>" class="pull-left img-rounded">
                                        </a>
                                        <div class="comment-user"><i class="fa fa-user"></i> <a href="<?php echo $this->M_user->get_home_page($comment['client']);?>"><?php echo $this->M_user->get_name($comment['client']);?></a>
                                        </div>
                                        <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo date('d M Y',strtotime($comment['time']));?></time>
                                     <div class="comment-post">
                                        <p>
                                          <?php echo ucfirst($comment['comment']); ?>
                                        </p>
                                      </div>
                                      <?php } ?>
                                      <p class="text-right"><a class="btn btn-default btn-sm com"><i class="fa fa-reply"></i> Comment</a></p>
                                      
                                        <div class="clearfix"></div>
                                        <div class="col-md-12 col-xs-12 CommentForm" style="display: none;">
                                            <h5>Add Comment</h5>
                                            <form method="post" action="<?php echo base_url().'amper/membercomment'?>">
                                                <div class="col-md-12 col-xs-12 form-group">
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                                                    <input type="hidden" name="id_flp" value="<?=$id?>" />
                                                    <textarea class="form-control" name="comment" rows="5" required></textarea>
                                                    <div class="CoButG"><button class="ButCO btn btn-danger btn-sm">Close</button><button class="btn btn-primary btn-sm">Add</button></div>
                                                </div>
                                            </form>
                                        </div>
                                      
                                    </div>
          
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right">
                            <div class="widget-box">
                                <div class="about-widget">
                                     <div class="ico-img panel-title text-center">
                                                        <span>
                                                            <i class="fa fa-clock-o fa-spin-hover" aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                     <h2 class="panel-tp">STATS</h2>
                                                     <div class="panel-body well well-sm text-center">                        
                                                    <div class="Stats-area ">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-music"></i> Song Plays<span class="pull-right"><?php echo $num_songs;?></span></a></li>
                                                            <li><a href="#"><i class="fa fa-file-video-o"></i> Video Plays<span class="pull-right"><?php echo $num_videos;?></span></a></li>
                                                            <li><a href="#"><i class="fa fa-users"></i> Total Fans<span class="pull-right"><?php echo $num_fands; ?></span></a></li>
                                                            <li><a href="#"><i class="fa fa-hand-rock-o"></i> Total Events<span class="pull-right"><?php echo $num_events; ?></span></a></li>
                                                            <li><a href="#"><i class="fa fa-bookmark"></i> Total Blogs<span class="pull-right"><?php echo $num_blogs; ?></span></a></li>
                                                            <li><a href="#"><i class="fa fa-comments"></i> Total Comments<span class="pull-right"><?php echo $num_comments; ?></span></a></li>
                                                        </ul>
                                                    </div>
                                                </div> 
                                                </div>                        
                                            </div>     
                                        </div> 
                                        <div class="sidebar-right">
                            <div class="widget-box">
                                <div class="about-widget">
                                    <div class="ico-img panel-title text-center">
                                        <span>
                                         <i class="fa fa-users fa-spin-hover" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <h2 class="panel-tp">member</h2>    
                                       <?php if (isset($members) && count($members) > 0) { ?>
                      <?php foreach($members as $member){ 
                            
                            ?>
                       <div class="row">
                            <div class="col-xs-3 col-md-2">
                                <img src="<?php echo base_url(); ?>uploads/<?php echo $member['artist_id'];?>/image_member/<?php echo $member['member_image'];?>" class="img-circle img-responsive" alt="" />
                            </div>
                            <div class="col-xs-9 col-md-10">
                                <div>
                                    <a href="#"><?php echo $member['name_member']; ?></a>
                                </div>
                                <div class="comment-text">
                                    <?php echo $member['contribution'];?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php } }else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                                </div>
                            </div>
                        </div>             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

<!-- Modal showEvent -->
<div class="modal fade new_modal_style" id="showEvent" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <h4 class="tt" id="myModalevent">Add Comment</h4>
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
<div class="modal fade" id="vimeo_videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <iframe id="vimeo_video"  width="640" height="337" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        
        <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>
    </div>
</div>
<div class="modal fade" id="photos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog text-center" role="document">
        <img src="<?php echo base_url(); ?>assets/images/adaptable.jpg" width="500" height="400"/>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $(".com").click(function(){
            $(".CommentForm").css("display", 'block');
        });
    });
</script>
<script type="text/javascript">
    var url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/landing-page/js/landing-page-1.js"></script>
