<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/landing_page/landing_page9.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/landing_page/style03.css" rel="stylesheet" type="text/css">
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
                        <img class="avata_landing" src="<?php echo $avata;?>"/>                                                 
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
                    <p class="text-justify info_area">
                    <?php if (!empty($users[0]->bio)) { echo $this->Member_model->short_Text_Bio($users[0]->bio); } ?>
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
           
                 <div class="col-md-12 body_session"><!--body-session -->
                    <div class="box-section">
                        <div class="col-md-12 photos_title header_new_style">
                            <h2 class="title-line"><a href="<?php echo base_url().$name; ?>/photos"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_photo.png" /> Photos</a> 
                            </h2>
                            <div class="line"></div>
                        </div>
                        <div class="col-md-12 remove_padding">
                                <ul class="docs-pictures clearfix">
                                <?php $count = count($photos);
                                     if ($count == 3) {
                                         $i = 0;
                                         foreach ($photos as $pt) {
                                             ?>
                                     <li class="col-md-4 col-xs-12">
                                        <div class="" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                        <img height="230" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/><br/>
                                        
                                    </li>
                                <?php ++$i;
                                         }
                                     } elseif ($count == 2) {
                                         $i = 0;
                                         foreach ($photos as $pt) {
                                             ?>
                                     <li class="col-md-4 col-xs-12">
                                        <div class="" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                        <img height="230" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/>
                                       
                                    </li>
                                <?php ++$i;
                                         } ?>
                                    <li class="col-md-4 col-xs-12">
                                        <div class="" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                        <img height="230" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                        
                                    </li>
                                        <?php 
                                     } elseif ($count == 1) {
                                         foreach ($photos as $pt) {
                                             ?>
                                         <li class="col-md-4 col-xs-12">
                                            <div class="" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                            <img height="230" data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/>
                                            
                                        </li>
                                        <?php 
                                         } ?>
                                            <div class="col-md-4 col-xs-12">
                                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"  class="img-responsive"/>
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                            </div>
                                        <?php 
                                     } else {
                                         ?>
                                        <div class="col-md-4 col-xs-12">
                                            <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                        </div> 
                                <?php 
                                     } ?>
                                </ul>
                        </div>
                    </div>    
                    <div class="box-section">
                        <div class="col-md-3">
                            <div class="col-md-12 photos_title box-line">
                                <h2 class="title-line"><a href="<?php echo base_url('social_media');?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_status.png" /> Stats</a></h2>
                                <div class="line"></div>
                            </div>
                             <div class="col-md-12 box-line">
                                <article class="stats-box box-line">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-music tb"></i> Song Plays<span class="tb pull-right"><?php echo $num_songs;?></span></a></li>
                                        <div class="stats-line line"></div>
                                        <li><a href="#"><i class="fa fa-file-video-o tb"></i> Video Plays<span class="tb pull-right"><?php echo $num_videos;?></span></a></li>
                                        <div class="stats-line line"></div>
                                        <li><a href="#"><i class="fa fa-users tb"></i> Total Fans<span class="tb pull-right"><?php echo $num_fands; ?></span></a></li>
                                        <div class="stats-line line"></div>
                                        <li><a href="#"><i class="fa fa-hand-rock-o tb"></i> Total Events<span class="tb pull-right"><?php echo $num_events; ?></span></a></li>
                                        <div class="stats-line line"></div>
                                        <li><a href="#"><i class="fa fa-bookmark tb"></i> Total Blogs<span class="tb pull-right"><?php echo $num_blogs; ?></span></a></li>
                                        <div class="stats-line line"></div>
                                        <li><a href="#"><i class="fa fa-comments tb"></i> Total Comments<span class="tb pull-right"><?php echo $num_comments; ?></span></a></li>
                                        <div class="stats-line line"></div>
                                    </ul>
                                </article> 
                            </div>
                            <div class="col-md-12 photos_title box-line quick-box">
                                <h2 class="title-line"><a href="<?php echo base_url('social_media');?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_quickactions.png" /> Quick Actions</a></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12">
                            <div class="row quick-area">
                            <div class="col-md-5 col-xs-6 text-center">
                                <a class="quickcl href="#"><i class="fa fa-share"></i>Share</a>
                            </div>
                            <div class="col-md-7 col-xs-6 ">
                                <?php $home_page = $this->uri->segment(1);
                                if($home_page == 'amp')
                                {
                                    $home_page = $this->uri->segment(2);
                                }
                                $results = $this->db->where('home_page', $home_page)->get('users')->result_array();
                                foreach ($results as $result) { $user_i = $result['id']; }
                                $isset = $this->db->where('user_id', $user_i)->where('fan_id', $user_id)->get('fans')->num_rows();
                                ?>
                                <a href="<?php if ($isset > 0) { echo '#'; } else { echo base_url().'artist/comefan/'.$user_id.'/'.$home_page; } ?>" class="quickcl" style="<?php if ($isset > 0) {
                                    echo 'cursor: no-drop;';
                                } ?>"><i class="fa fa-user"></i> Become A Fan</a>
                                </div>
                                <?php
                                if ($users[0]->id != $user_data['id']) {
                                    ?>
                                    <div class="col-md-12 searchform text-center">
                                        <a class="btn btn-default buttanquck" href="#" style=" margin: 20px auto;padding: 15px; background-color:rgb(91,201,138);" data-toggle="modal" data-target="#invite-contact">Add Contact Chat</a>
                                    </div>
                                    <?php

                                }
                                ?>                          
                        </div><!--  row  -->
                         <div class="line"></div>
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 photos_title ">
                               <h2 class="title-line"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_amp.png" /><span>AMP</span></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12">
                            <article class="audio-box">
                                <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
                            </article>    
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12 photos_title ">
                                <h2 class="title-line"><a href="<?php echo base_url('artist/allvideos').'/'.$id; ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_video.png" /> Videos</a></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12" style=" height:520px; max-height: 560px;overflow-y: scroll;overflow-x: hidden;">
                            <?php foreach ($videos as $video) {
                                             if ($video['type'] == 'file') { $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];}
                     elseif($video['type'] == 'link') { $link_video = $video['link_video']; }
                    elseif($video['type'] == 'link-vimeo') { 
                    $video_vimeo=basename($video['link_video']);
                    $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                     
                    $hash = unserialize(file_get_contents($get_link));
                    $url_id=$hash[0]['id'];
                    $link_video = 'https://player.vimeo.com/video/'.$url_id.'?title=0&byline=0&portrait=0'; } ?>
                                <figure class="video-box">                 
                                    <img class="img-responsive" src="<?=$this->M_video->get_image_video($video['id'])?>">
                                    <?php if(($video['type'] == 'file') || ($video['type'] == 'link')) { ?>
                                     <a class="fa fa-play-circle" href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos"></a>
                                     <?php } else { ?>
                                     <a class="fa fa-play-circle" href="#vimeo_videos" onclick="javascript:play_vimeo_video(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#vimeo_videos"></a>
                                     <?php } ?>
                                     <h6> <?php echo $video['name_video']; ?></h6>
                                </figure>
                                <?php } ?>
                                
                             </div>  
                        </div>
                    </div>
                    <div class="box-section">
                        <div class="col-md-8" >
                            <div class="col-md-12 photos_title ">
                               <h2 class="title-line"><a href="<?php echo base_url('artist/allblogs').'/'.$id; ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_blog.png" /> Recent Blogs</a></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12" style="height:250px; max-height: 250px;overflow-y: scroll;overflow-x: hidden;">
                            <article class="audio-box">
                            <?php foreach ($blogs as $row) {
                        ?>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object  img-responsive" width="200" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading tcolor"><?php echo $row['title']?>
                                      <p class="text-right tcolor">By ~ <?php echo $this->M_user->get_name($row['user_id']);?></p></h4>
                                          <p><?php 
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
                                      <ul class="list-inline list-unstyled">
                                        <li><span><i class="fa fa-calendar"></i> <?php echo date('M d, Y', $row['time'])?></span></li>
                                        <li>|</li>
                                        <span><i class="fa fa-comment"></i><?php echo $row['blog_comments_count'];?></span>          
                                        </ul>
                                   </div>
                                </div>
                                 <?php } ?>
                            </article>    
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="col-md-12 photos_title ">
                                <h2 class="title-line"><a href="<?php echo base_url('artist/allcomment').'/'.$id;?>">
                            <img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_comment.png" /> Comments</a></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12" style="height:250px; max-height: 250px;overflow-y: scroll;overflow-x: hidden;">
                                 <article>
                                     <?php  foreach ($comments as $comment) { ?>
                                        <?php $role = $this->M_user->get_user_role($comment['client']);
                                        ?>
                                    <div class="media">
                                       <p class="pull-right"><small><?php echo date('d M Y',$comment['time']);?></small></p>
                                        <a class="media-left" href="#">
                                          <img class="media-object" src="<?php if($role == '1'){ echo $this->M_user->get_avata($comment['client']);} else {echo $this->M_user->get_avata_flp($comment['client']);}?>" width="40" height="40" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading user_name"><a href="<?php echo $this->M_user->get_home_page($comment['client']);?>"><?php echo $this->M_user->get_name($comment['client']);?></a></h4>
                               <?php echo ucfirst($comment['comment']); ?> 
                                        </div>
                                     </div>
                                      <?php } ?>
                                       <div class="text-right clb3" >
                                            <a class="btn btn-info" data-toggle="modal" data-target="#addComment" style="color:#fff;">comments</a>
                                        </div>     
                                  </article>
                             </div>  
                        </div>
                    </div>
                    <div class="box-section">
                        <div class="col-md-4" >
                            <div class="col-md-12 photos_title ">
                               <h2 class="title-line"><a href="<?php echo base_url('artist/allblogs').'/'.$id; ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_git_event.png" /> Events</a></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12" style="height:200px; max-height: 200px;overflow-y: scroll;overflow-x: hidden;">
                            <article class="audio-box">
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
                            </article>    
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="col-md-12 photos_title ">
                                <h2 class="title-line"><a href="<?php echo base_url('artist/allcomment').'/'.$id;?>">
                            <img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/support.png" /> fan</a></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12" style=" height:200px; max-height: 200px;overflow-y: scroll;overflow-x: hidden;">
                                 <article>
                                     <?php if (isset($fans) && count($fans) > 0) { ?>                       
                           <?php $i = 0; foreach ($fans as $fan) { 
                            if($fan['role'] == 1)
                            {
                              $avata = $this->M_user->get_avata($fan['fan_id']);
                            }else{
                                $avata = $this->M_user->get_avata_flp($fan['fan_id']);
                            }
                            ?>
                            <div class="col-xs-12 col-md-12 fan-area ">
                                
                                
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
                                  </article>
                             </div>  
                        </div>
                         <div class="col-md-4" >
                            <div class="col-md-12 photos_title ">
                                <h2 class="title-line"><a href="<?php echo base_url('artist/allcomment').'/'.$id;?>">
                            <img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_member.png" /> member</a></h2>
                                <div class="line"></div>
                            </div>
                            <div class="col-md-12" style=" height:200px; max-height: 200px;overflow-y: scroll;overflow-x: hidden;">
                                 <article>
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
                                  </article>
                             </div>  
                        </div>
                    </div>

                </div><!--end-body-session -->  
               
   <!--  end        -->
           
        </div>
    </div>
</div>
<!-- Modal comment -->
<div class="modal fade new_modal_style" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'amper/membercomment'?>" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_flp" value="<?=$id?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add Comment</h4>
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

<script type="text/javascript">
var url = "<?php echo base_url(); ?>";   
</script>
<script src="<?php echo base_url(); ?>assets/landing-page/js/landing-page-1.js"></script> 
