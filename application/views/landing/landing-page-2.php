
<!-- player css/js-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/landing_page/landing_page2_alp.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css" />
<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script type="text/javascript">
    $(".effect_slide").click(function(){
        $(this).parent().parent().find("img").click();
    })

    $(document).ready(function(){
        $(".Comment2").click(function(){
            $(".CommentForm-2").slideToggle();
        });
    });
    (function($){
        $(window).load(function(){
            $(".ScrollStyle1,.ScrollStyle2").mCustomScrollbar({theme:"minimal-dark"});
        });
    })(jQuery);

</script>
<style type="text/css">
    header {
    position: relative;
    min-height: 450px;
    text-align: center;
    color: #fff;
    width: 100%;
    background-image: url('<?php if(!empty($users[0]->banner_image)){echo base_url().'uploads/'.$users[0]->id.'/photo/banner/'.$users[0]->banner_image; }else{ echo base_url().'assets/demotemp/images/profile-pic.jpg';} ?>');
    background-color: #c9c9c9;
   
    background-position: center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: 100% 100%;
    -o-background-size: cover;
   
}
</style>


<!-- End-->
<header >
    <div class="container-fluid ProfileTranc2">
        <div class="row ">
        <div class="col-md-12 profile-pic">
            <div class="col-md-2 col-sm-4 col-xs-12  ProfilePicZoom1">
               
                <img id="user_profile_pic" class="img-thumbnail img-responsive " src="<?php echo $this->M_user->get_avata($users[0]->id); ?>" alt="">
                
            </div>
            <div class="col-md-3 col-sm-6 textcent col-xs-12  ">
                
                <h2><?php echo ucfirst($name); ?> <br /><span><?php if(isset($genres[0]['name'])) echo ucfirst($genres[0]['name']); ?>  <?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) { echo ', '.ucfirst($country_code[0]['countrycode']); }?></span></h2>
                <div class="ProfileSocial">
                    <ul>
                         <li><a href="<?php echo $users[0]->facebook_username; ?>" target="_blank" class="fa fb"><i class="fa fa-fw fa-facebook"></i></a></li>
                         <li><a href="<?php echo $users[0]->twitter_username; ?>" target="_blank" class="fa tw"><i class="fa fa-fw fa-twitter"></i></a></li>
                         <li><a href="<?php echo $users[0]->youtube_username; ?>" target="_blank" class="fa gp"><i class="fa-fw fa-youtube"></i></a></li>
                         <li><a href="<?php echo $users[0]->instagram_username; ?>" target="_blank" class="fa in"><i class="fa fa-fw fa-instagram"></i></a></li>
                    </ul>
                </div>
        </div>
        </div>
       
    </div>
</header>
<!--  End header  -->
<section class="bg-primary1" id="one">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12  col-md-12 col-sm-12">
                   <div class="panel cl">
                        <ul class="nav  nav-pills nav-area nav-tabare">
                            <li class="active"><a data-toggle="pill" href="#home"><i class="fa fa-check-square-o"></i> STATUS</a></li>
                            <li><a data-toggle="pill" href="#menu1"><i class="fa fa-share-alt" aria-hidden="true"></i>QUICK ACTION</a></li>
                            <li><a data-toggle="pill" href="#menu2"><i class="fa fa-user-plus" aria-hidden="true"></i>FANS</a></li>
                            <li><a data-toggle="pill" href="#menu3"><i class="fa fa-users" aria-hidden="true"></i>MEMBER</a></li>
                        </ul>
                   <div class="panel-body cl">
                  <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <a href="#"><h3>STATUS</h3></a>
                      
                        <div class="row">
                            <?php if (!empty($users[0]->status)){ ?>
                                <p> <?php echo $users[0]->status; ?> </p>
                            <?php } else {?>
                                <p class="animate bounce">No status</p>
                            <?php } ?>
                        </div>

                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <a href="<?php echo base_url('social_media');?>"><h3>QUICK ACTION</h3></a>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 table-responsive">
                                <table class="table text-center">
                                    <tr>
                                        <td><a href="<?php echo base_url('social_media');?>">
                                    <button class="btn btn-primary">Share</button>
                                </a></td>
                                        <td> <?php $home_page = $this->uri->segment(1);
                                if($home_page == 'amp')
                                {
                                    $home_page = $this->uri->segment(2);
                                }
                                $results = $this->db->where('home_page', $home_page)->get('users')->result_array();
                                foreach ($results as $result) { $user_i = $result['id']; }
                                $isset = $this->db->where('user_id', $user_i)->where('fan_id', $user_id)->get('fans')->num_rows();
                                ?>
                                <a href="<?php if ($isset > 0) { echo '#'; } else { echo base_url().'artist/comefan/'.$user_id.'/'.$home_page; } ?>" class="btn btn-primary" style="<?php if ($isset > 0) {
                                    echo 'cursor: no-drop;';
                                } ?>">Become A Fan</a>
                               </td>
                                    </tr>
                                     <?php
                                if ($users[0]->id != $user_data['id']) {
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                             <div class="col-md-12 searchform">
                                        <a class="btn btn-default col-xs-12" href="#" style="margin-top: 20px;padding: 15px;" data-toggle="modal" data-target="#invite-contact">Add Contact Chat</a>
                                    </div>
                                        </td>
                                    </tr>
                                    <?php

                                }
                                ?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                      <a href="<?php echo base_url('artist/allfans').'/'.$id; ?>"><h3>FANS</h3></a>
                      <?php if (isset($fans) && count($fans) > 0) { ?>
                       <?php $i = 0; foreach ($fans as $fan) { ?>
                        
                        <div class="row">
                            <div class="col-xs-3 col-md-2">
                                <img src="<?php if (!empty($fan['avata'])) { echo base_url().'uploads/'.$users[0]->id.'/photo/'.$fan['avata'];}
                                                 else { echo base_url().'assets/images/default-img.gif'; } ?>" class="img-circle img-responsive" alt="?php echo $fan['artist_name']; ?>" />
                            </div>
                            <div class="col-xs-9 col-md-10">
                                <div>
                                    <a href="<?php echo base_url().$fan['home_page']; ?>">
                                    <?php echo $fan['firstname']?></a>
                                    
                                </div>
                                <?php echo $fan['bio']?>
                            </div>
                        </div>
                        <hr>
                        <?php $i++ ; } ?>
                         <?php } else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                      <a href="#"><h3>MEMBER</h3></a>
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
    <section id="two">
               
    <div class="container">
        <div class="row">
        <div class="col-xs-12  col-md-5  pull-left artist-title">
            <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
        </div>
        <div class="col-xs-12 col-md-offset-1 col-md-6 artist-title alb-height ScrollStyle2">
                 <?php if (isset($album_songs) && count($album_songs) > 0) { ?>
                 <div class="panel-group" id="accordion">
                                        <?php $i = 1; foreach ($album_songs as $album_song) { ?>
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
                                                                    $array_avai = explode(',', $video_by_album['availability']); ?>
                                                                    {
                                                                        title:"<?php echo $video_by_album['song_name'] ?>",
                                                                        mp3:"<?php echo $file_url ?>",
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
                                                                    swfPath: "<?php echo FCPATH."assets/amp";?>",
                                                                    supplied: "<?php echo $file_format; ?>",
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
                                            <?php ++$i; } ?>

                                    </div>
                                    <?php } else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
        </div>
              
    </div>

</section>
<section id="three">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="margin-top-0 text-primary">Photos</h2>
                        <hr class="primary">
                    </div>
                </div>
            </div>
            <div class="row no-gutter">
            <?php if (isset($photos) && count($photos) > 0) {
               
                    $i = 0;
                    foreach ($photos as $pt) {
                        ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>">
                        <img src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive" alt="Image 1">
                        <div class="gallery-box-caption">
                            <div class="gallery-box-content">
                                <div>
                                    <i class="icon-lg ion-ios-search"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                 
               
                <?php ++$i;
                        }
                    }else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                
            </div>
        </div>
    </section>
    <section class="container" id="four">
        <div class="row">
            <div class="col-xs-12  col-sm-12  col-md-12 ">
                <h2 class="text-center text-primary">Features</h2>
                 <hr/>
                <div class="col-xs-12  col-md-4">
                 <article class="panel panel-default">
                    <div class="panel-heading plarea">
                       <h4>
                        <a href="<?php echo base_url('artist/allcomment').'/'.$id;?>"><i class="fa fa-comments-o" aria-hidden="true"></i> COMMENTS</a></h4>
                    </div>
                    <div class="panel-body panel-height1 ScrollStyle1 plbdy">
                    <?php if (empty($comments)) { ?>
                        <span class="col-md-12" style="font-size: 16px;">No Comment.</span>
                    <?php }foreach ($comments as $comment) { ?>
                       <div class="row">
                            <div class="col-xs-3 col-md-2">
                                <a href="<?php echo $this->M_user->get_home_page($comment['client']);?>">
                                <?php if($this->M_user->get_user_role($comment['client']) == "1") { ?>
                                    
                                    <img src="<?php echo $this->M_user->get_avata($comment['client']);?>" class="img-circle img-responsive" alt="" />
                                    <?php } else {
                                        ?>
                                    <img src="<?php echo $this->M_user->get_avata_flp($comment['client']);?>" class="img-circle img-responsive" alt="" />
                                        <?php 
                                    }

                                    ?>
                                </a>
                            </div>
                            <div class="col-xs-9 col-md-10">
                                <div>
                                    <a href="<?php echo $this->M_user->get_home_page($comment['client']);?>"><?php echo $this->M_user->get_name($comment['client']);?></a>
                                    
                                    <p><?php echo ucfirst($comment['comment']); ?></p>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <?php } ?>
                        <div class="col-md-4 col-md-offset-8">
                            <button class="ShareBut-2 center-block Comment2  btn-sm btn-info"><i class="fa fa-comments-o" aria-hidden="true"></i> COMMENT</button>
                        </div>
                        <div class="col-md-12">
                            <div class="CommentForm-2">
                                <div class="col-md-12">
                                    <form method="post" action="<?php echo base_url().'artist/membercomment'?>">
                                        <h2>Add a Comment</h2>
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                                        <input type="hidden" name="id_artist" value="<?=$id?>" />
                                        <textarea class="CommentText-2" rows="3" name="comment" placeholder="Enter Your Comment" required></textarea>
                                        <div class="CoButG">
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                                            <button class="btn btn-sm btn-default Comment2"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
               </div>
                <div class="col-xs-12  col-md-4">
                    <article class="panel panel-default">
                        <div class="panel-heading plarea">
                            <h4><i class="fa fa-calendar" aria-hidden="true"></i> EVENTS</h4>  
                        </div>

                        <div class="panel-body panel-height1 ScrollStyle1 plbdy">
                            <?php if (isset($events) && count($events) > 0){ ?>
                            <?php foreach ($events as $event) {?>
                                <?php if (!empty($event['event_banner'])) {
                                $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
                                } else {
                                    $url_image = base_url().'assets/images/icon/manager_git_event.png';
                                } ?>
                            <article class="media event">
                              <a class="pull-left date">
                                    <p class="month"><?php echo date('M',strtotime($event['event_start_date']));?></p>
                                    <p class="day"><?php echo date('d',strtotime($event['event_start_date']));?></p>
                              </a>
                              <div class="media-body">
                                    <a  class="title"href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a>
                                    <p><?php  custom_echo_html($event['event_desc'], 400); ?></p>
                              </div>
                            </article>
                            <?php } ?>
                            <?php }  else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                        </div>
                    </article>
               </div>
               <div class="col-xs-12  col-md-4">
                    <article class="panel panel-default">
                        <div class="panel-heading plarea">
                             <h4> <i class="fa fa-clock-o" aria-hidden="true"></i> STATS</h4>  
                        </div>

                         <div class="panel-body panel-height1 plbdy">
                        <div class="list-group">
                            <a class="list-group-item" href="#">
                                <i class="fa fa-music"></i>
                                Song Plays
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_songs;?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-file-video-o"></i>
                                    Video Plays
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_videos;?></em>
                                </span>
                            </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-users"></i>
                                Total Fans
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_fands; ?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-hand-rock-o"></i>
                                    Total Events
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_events; ?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-bookmark"></i>
                                    Total Blogs
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_blogs; ?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-comments"></i>
                                    Total Comments
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_comments; ?></em>
                                </span>
                            </a>
                            
                        </div>
                       
                    </div>
                    </article>
               </div>
               <!-- <div class="col-xs-12  col-md-4 watch-card">
                    
                <article class="panel panel-default">
                    <div class="panel-heading plarea">
                       <h4> <i class="fa fa-clock-o" aria-hidden="true"></i> STATS</h4>
                    </div>
                    <div class="panel-body panel-height plbdy">
                        <div class="list-group">
                            <a class="list-group-item" href="#">
                                <i class="fa fa-music"></i>
                                Song Plays
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_songs;?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-file-video-o"></i>
                                    Video Plays
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_videos;?></em>
                                </span>
                            </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-users"></i>
                                Total Fans
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_fands; ?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-hand-rock-o"></i>
                                    Total Events
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_events; ?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-bookmark"></i>
                                    Total Blogs
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_blogs; ?></em>
                                </span>
                           </a>
                            <a class="list-group-item" href="#">
                                <i class="fa fa-comments"></i>
                                    Total Comments
                                <span class="pull-right text-muted small">
                                    <em><?php echo $num_comments; ?></em>
                                </span>
                            </a>
                            
                        </div>
                       
                    </div>
                </article>
                 
        
               </div> -->
            </div>
        </div>
    </section>
    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2 class="text-primary">video List</h2>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-md-12 col-md-offset-0 text-center">
                 <?php if (isset($videos) && count($videos) > 0) { ?>
                <?php foreach ($videos as $video) {
                    if ($video['type'] == 'file') { $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];}
                     elseif($video['type'] == 'link') { $link_video = $video['link_video']; }
                    elseif($video['type'] == 'link-vimeo') { 
                    $video_vimeo=basename($video['link_video']);
                    $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                     
                    $hash = unserialize(file_get_contents($get_link));
                    $url_id=$hash[0]['id'];
                    $link_video = 'https://player.vimeo.com/video/'.$url_id.'?title=0&byline=0&portrait=0'; }?>
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                        <div class="view">
                            <div class="caption">
                                <h3><?php echo $video['name_video']; ?></h3>
                            </div>
                            <?php if(($video['type'] == 'file') || ($video['type'] == 'link')) { ?>
                                            <a href="#videos"  data-toggle="modal" data-target="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))">
                                                <div class="image_fix_value_video  my-view" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');"></div>
                                            </a>
                                           <?php } else { ?>
                                            
                                            <a href="#vimeo_videos"  data-toggle="modal" data-target="#vimeo_videos" onclick="javascript:play_vimeo_video(<?php echo "'".$link_video."'"; ?>)">
                                                <div class="image_fix_value_video my-view" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');"></div>
                                            </a>
                                            <?php } ?>
                        </div>
                    </div>
                    <?php } } else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                </div>
            </div>
        </div>        
    </aside>

<!-- End section  -->
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
<div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
         <div class="modal-body">
          <img src="" id="galleryImage" class="img-responsive" />
          <p>
              <br/>
              <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Close <i class="ion-android-close"></i></button>
          </p>
         </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function($) {
    "use strict";

    
    new WOW().init();
    
    $('a.page-scroll').bind('click', function(event) {
        var $ele = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($ele.attr('href')).offset().top - 60)
        }, 1450, 'easeInOutExpo');
        event.preventDefault();
    });
    
    $('.navbar-collapse ul li a').click(function() {
        /* always close responsive nav after click */
        $('.navbar-toggle:visible').click();
    });

    $('#galleryModal').on('show.bs.modal', function (e) {
        console.log(e);
        $('#galleryImage').attr("src",$(e.relatedTarget).data("src"));
    });

})(jQuery);
</script>