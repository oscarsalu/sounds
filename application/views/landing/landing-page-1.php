<!-- Start header  -->
<link href="<?php echo base_url();?>assets/css/landing_page/99sound1.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<link href="<?php echo base_url(); ?>assets/css/landing_page/landing_page1.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />

<script type="text/javascript">
    $(".effect_slide").click(function(){
        $(this).parent().parent().find("img").click();
    })



!function ($) {

    "use strict"; 

       var Magnify = function (element, options) {
        this.init('magnify', element, options)
    }

    Magnify.prototype = {

        constructor: Magnify

        , init: function (type, element, options) {
            var event = 'mousemove'
                , eventOut = 'mouseleave';

            this.type = type
            this.$element = $(element)
            this.options = this.getOptions(options)
            this.nativeWidth = 0
            this.nativeHeight = 0

            this.$element.wrap('<div class="magnify" \>');
            this.$element.parent('.magnify').append('<div class="magnify-large" \>');
            this.$element.siblings(".magnify-large").css("background","url('" + this.$element.attr("src") + "') no-repeat");

            this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
            this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
        }

        , getOptions: function (options) {
            options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

            if (options.delay && typeof options.delay == 'number') {
                options.delay = {
                    show: options.delay
                    , hide: options.delay
                }
            }

            return options
        }

        , check: function (e) {
            var container = $(e.currentTarget);
            var self = container.children('img');
            var mag = container.children(".magnify-large");

            // Get the native dimensions of the image
            if(!this.nativeWidth && !this.nativeHeight) {
                var image = new Image();
                image.src = self.attr("src");

                this.nativeWidth = image.width;
                this.nativeHeight = image.height;

            } else {

                var magnifyOffset = container.offset();
                var mx = e.pageX - magnifyOffset.left;
                var my = e.pageY - magnifyOffset.top;

                if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                    mag.fadeIn(100);
                } else {
                    mag.fadeOut(100);
                }

                if(mag.is(":visible"))
                {
                    var rx = Math.round(mx/container.width()*this.nativeWidth - mag.width()/2)*-1;
                    var ry = Math.round(my/container.height()*this.nativeHeight - mag.height()/2)*-1;
                    var bgp = rx + "px " + ry + "px";

                    var px = mx - mag.width()/2;
                    var py = my - mag.height()/2;

                    mag.css({left: px, top: py, backgroundPosition: bgp});
                }
            }

        }
    }


    /* MAGNIFY PLUGIN DEFINITION
     * ========================= */

    $.fn.magnify = function ( option ) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('magnify')
                , options = typeof option == 'object' && option
            if (!data) $this.data('tooltip', (data = new Magnify(this, options)))
            if (typeof option == 'string') data[option]()
        })
    }

    $.fn.magnify.Constructor = Magnify

    $.fn.magnify.defaults = {
        delay: 0
    }


    /* MAGNIFY DATA-API
     * ================ */

    $(window).on('load', function () {
        $('[data-toggle="magnify"]').each(function () {
            var $mag = $(this);
            $mag.magnify()
        })
    })

} ( window.jQuery );
(function($){
        $(window).load(function(){
            $(".ScrollStyle2,.ScrollStyle1,.ScrollStyle3, .ScrollStyle4").mCustomScrollbar({theme:"minimal-dark"});
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
<header>
    <div class="ProfilePic2" style="background:url(<?php if(!empty($users[0]->banner_image)){echo base_url().'uploads/'.$users[0]->id.'/photo/banner/'.$users[0]->banner_image; }else{ echo base_url().'assets/demotemp/images/profile-pic.jpg';} ?>) no-repeat center center; background-size:100% 100%; ">
        <div class="ProfileTranc2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 home-profile">
                        <div class="home-profile-image">
                            <img src="<?php echo $this->M_user->get_avata($users[0]->id); ?>" alt="">
                        </div>
                        <?php if (!empty($users[0]->bio)){ ?>
                        <div class="home-profile-quick">
                            <h4>Bio</h4>
                            <p><?php echo $this->Member_model->short_Text_Bio($users[0]->bio); ?></p>
                            <!--<a href="#" class="view-profile">View Profile</a>-->
                        </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-6 home-details">
                        <h1><?php echo ucfirst($name); ?></h1>
                        <h2><?php if(isset($genres[0]['name'])) echo ucfirst($genres[0]['name']); ?></h2>
                        <hr>
                        <p><i><?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) {
                                    echo ', '.ucfirst($country_code[0]['countrycode']);
                                }; ?></i></p>
                        <ul class="social">
                            <li><a href="<?php echo $users[0]->facebook_username; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo $users[0]->twitter_username; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo $users[0]->instagram_username; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="<?php echo $users[0]->youtube_username; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div><!-- row  -->
            </div><!-- container  -->
        </div><!-- ProfileTranc2  --><div class="clearfix"></div>
    </div><!-- ProfilePic2  -->

</header>
<!--  End header  -->
<!--  start section  -->
<section id="SectionGrid1">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="col-md-4 col-sm-12">
              
                <div class="col-md-12 section-shadow">
                    <div class="panel status panel-primary">
                        <div class="panel-heading">
                             <div class="ico-img panel-title text-center"><span><i class="fa fa-check fa-spin-hover" aria-hidden="true"></i></span></div>
                             <hr class="style1">
                              <h2 class="panel-tp">STATUS</h2>  
                        </div>
                        <div class="panel-body panel-area1 ScrollStyle1 text-center"> 
                            <?php if (!empty($users[0]->status)) { ?>                       
                            <span class="testimonials-name"><?php echo $users[0]->status; ?></span>
                           <?php } else { ?>
                           
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                        </div>
                   </div>
                </div><!-- col-md-12  -->
                    
           </div>
               
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="col-md-12 section-shadow">
                        <div class="panel status panel-primary">
                            <div class="panel-heading">
                                <div class="ico-img panel-title text-center">
                                    <i class="fa fa-calendar fa-spin-hover" aria-hidden="true"></i>
                                </div>
                                <hr class="style1">
                                <h2 class="panel-tp">EVENTS</h2>  
                            </div>
                            <div class="panel-body panel-area1 ScrollStyle1 text-center">  
                            <?php if (isset($events) && count($events) > 0){ ?>                      
                                <?php foreach ($events as $event) {?>
                                    <div class="carousel-info">
                                        <a href="#" class="show_ev item" data-event="<?=$event['event_id']; ?>" style="font-size: 16px;text-decoration: none;" data-toggle="modal" data-target="#showEvent">
                                        <img class="pull-left"  src="<?php if (!empty($event['event_banner'])) { echo base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; } ?>" />
                                        </a>
                                        <div class="pull-left">
                                            <span class="rblog-name"><?php echo ucfirst($event['event_title']); ?></span>
                                            <span class="rblog-post"><?php  custom_echo_html($event['event_desc'], 400); ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                 <?php } else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                            </div>
                        </div>
                    </div><!-- col-md-12  -->
                   
                </div>    
                <div class="col-md-4 col-sm-12 col-xs-12 mar-top section-shadow">
                    <div class="col-md-12 section-shadow">
                        <div class="panel status panel-primary">
                            <div class="panel-heading">
                                <div class="ico-img panel-title text-center">
                                    <span>
                                        <i class="fa fa-users fa-spin-hover" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <hr class="style1">
                                <h2 class="panel-tp">MEMBER</h2>  
                            </div>
                            <div class="panel-body panel-area1 ScrollStyle1 text-center">                        
                               <?php  if (isset($members) && count($members) > 0) {
                               foreach($members as $member){ 
                                
                            ?>
                                <div class="carousel-info">
                                    <img alt="" src="<?php echo base_url(); ?>uploads/<?php echo $member['artist_id'];?>/image_member/<?php echo $member['member_image'];?>" class="pull-left">
                                    <div class="pull-left">
                                        <span class="rblog-name">
                                        <a href="#"><?php echo $member['name_member']; ?></a></span>
                                        <span class="testimonials-post"><?php echo $member['contribution'];?></span>
                                    </div>
                                </div>
                                <?php } }else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                            </div>
                        </div>
                    </div><!-- col-md-12  -->
                </div>
            </div>
        </div>
    </div>    
</section>
    <!--  end section  -->
<!--  start section  -->
<section id="SectionGrid2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 section-shadow">
                    <div class="panel status panel-primary">
                        <div class="panel-heading">
                            <div class="ico-img panel-title text-center">
                               <a href="<?php echo base_url().$name; ?>/photos">
                                   <span><i class="fa fa-picture-o fa-spin-hover"></i>
                                   </span>
                               </a>
                            </div>
                               <hr class="style1">
                               <h2 class="panel-tp">photo</h2>  
                        </div>
                        <div class="panel-body text-center">                        
                             <div class="row">

                            <?php if (isset($photos) && count($photos) > 0) {
                              $count = count($photos);
                             
                                $i = 0;
                                foreach ($photos as $pt) {
                                    ?>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="mag">
                                            iPhone<br>
                                            <img data-toggle="magnify" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" alt="">
                                        </div>
                                    </div><!--/span-->

                                <?php ++$i;
                                }
                            } else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                                    <!--/span-->
                            </div><!--/row--> 
                        </div>
                    </div>
                </div><!-- col-md-12  -->
            </div> 
        </div>
    </div>
</section>
    <!--  end section  -->
<!--  start section  -->
<section id="SectionGrid2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="col-md-6 col-sm-6 col-xs-12">
                      
                    <div class="col-md-12 section-shadow">
                        <div class="panel status panel-primary">
                            <div class="panel-heading">
                                <div class="ico-img panel-title text-center">
                                     <a href="<?php echo base_url('artist/allsong').'/'.$id; ?>">
                                       <span><i class="fa fa-music fa-spin-hover" aria-hidden="true"></i></span>
                                     </a>
                                </div>
                               <hr class="style1">
                               <h2 class="panel-tp">SONGS</h2>  
                            </div>
                            <div class="panel-body panel-area4 ScrollStyle4 text-center">                        
                                <span class="liner_landing"></span>
                                <?php if (isset($album_songs) && count($album_songs) > 0) { 
                                     ?>
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
                                                <?php $video_by_albums = $this->M_audio_song->get_songs_by_album($album_song['id']);

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
    </div><!-- col-md-12  -->
                
</div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-12 section-shadow">
                        <div class="panel status panel-primary">
                            <div class="panel-heading">
                                <div class="ico-img panel-title text-center">
                                   <a href="<?php echo base_url('social_media');?>"><span><i class="fa fa-clock-o  fa-spin-hover" aria-hidden="true"></i></span></a>
                                </div>
                                 <hr class="style1">
                                <h2 class="panel-tp">STATS</h2>  
                            </div>
                            <div class="panel-body panel-area4  text-center">                        
                                <div class="Stats-area ">
                                    <ul >
                                        <li ><a href="#" ><i class="fa fa-music"></i> Song Plays &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $num_songs;?></span></a></li>
                                        <li><a href="#" ><i class="fa fa-file-video-o"></i> Video Plays &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $num_videos;?></span></a></li>
                                        <li><a href="#" ><i class="fa fa-users"></i> Total Fans &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $num_fands; ?></span></a></li>
                                        <li><a href="#"><i class="fa fa-hand-rock-o"></i> Total Events &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $num_events; ?></span></a></li>
                                        <li><a href="#" ><i class="fa fa-bookmark"></i> Total Blogs &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $num_blogs; ?></span></a></li>
                                        <li><a href="#" ><i class="fa fa-comments"></i> Total Comments &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $num_comments; ?></span></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                    </div><!-- col-md-12  -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--  end section  -->
<!--  start section  -->
<section id="SectionGrid2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 section-shadow">
                        <div class="panel status panel-primary">
                            <div class="panel-heading">
                                <div class="ico-img panel-title text-center">
                                   <span><i class="fa fa-play fa-spin-hover" aria-hidden="true"></i></span>
                                </div>
                                <hr class="style1">
                                 <h2 class="panel-tp">amp</h2>   
                            </div>
                            <div class="panel-body text-center">                        
                                <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>  
                            </div>
                        </div>
                    </div><!-- col-md-12  -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--  end section  -->
<!--  start section  -->
<section id="SectionGrid2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        
                           <div class="col-md-12 section-shadow">
                                <div class="panel status panel-primary">
                                    <div class="panel-heading">
                                         <div class="ico-img panel-title text-center"><a href="<?php echo base_url('artist/allvideos').'/'.$id; ?>"><span><i class="fa fa-play fa-spin-hover" aria-hidden="true"></i></span></a>
                                        </div>
                                        <hr class="style1">
                                        <h2 class="panel-tp">VIDEOS</h2>  
                                    </div>
                                    <div class="panel-body panel-area2 text-center ScrollStyle2 "> 
                                    <?php if (isset($videos) && count($videos) > 0) {?>
                                         <div class="carousel-info">
                                         <?php foreach ($videos as $video) {
                                    if ($video['type'] == 'file') { $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];}
                                    elseif($video['type'] == 'link') { $link_video = $video['link_video']; }
                                    elseif($video['type'] == 'link-vimeo') { 
                                            $video_vimeo=basename($video['link_video']);
                                            $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                                             
                                            $hash = unserialize(file_get_contents($get_link));
                                            $url_id=$hash[0]['id'];
                                            $link_video = 'https://player.vimeo.com/video/'.$url_id.'?title=0&byline=0&portrait=0'; }?>
                                    <div class="wp_content_list">
                                        <div class="col-md-4 col-xs-4">
                                        <?php if(($video['type'] == 'file') || ($video['type'] == 'link')) { ?>
                                            <a href="#videos"  data-toggle="modal" data-target="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this), <?php echo "'".$video['type']."'"; ?>)">
                                                <div class="image_fix_value_video" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');"></div>
                                            </a>
                                           <?php } else { ?>
                                            
                                            <a href="#vimeo_videos"  data-toggle="modal" data-target="#vimeo_videos" onclick="javascript:play_vimeo_video(<?php echo "'".$link_video."'"; ?>)">
                                                <div class="image_fix_value_video" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');"></div>
                                            </a>
                                            <?php } ?>
                                        </div>
                                        <div class="pull-right">
                                            <span class="rblog-name content_video_title"><?php echo $video['name_video']; ?></span>
                                        </div>
                                        <!--<div class="col-xs-8 col-md-8 remove_padding">
                                            <span class="col-xs-12 content_video_title"><?php echo $video['name_video']; ?></span>
                                        </div>-->
                                        <div class="clearfix_check"></div>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php } else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                    </div>
                </div>
                </div><!-- col-md-12  -->
                    
                    
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <div class="col-md-12 section-shadow">
                        <div class="panel status panel-primary">
                    <div class="panel-heading">
                        <!-- <h1 class="panel-title text-center">25</h1> -->
                        <div class="ico-img panel-title text-center"><a href="<?php echo base_url('artist/allcomment').'/'.$id;?>"><span><i class="fa fa-comments-o fa-spin-hover" aria-hidden="true"></i></span></a></div>
                         <hr class="style1">
                           <h2 class="panel-tp">COMMENTS</h2>  
                    </div>
                    <div class="panel-body panel-area2 text-center ScrollStyle2">                        
                       <?php if (empty($comments)) { ?>
                                        <span class="col-md-12" style="font-size: 16px;">No Comment.</span>
                                    <?php } foreach ($comments as $comment) { ?>
                                        <div class="carousel-info">
                                            <a href="<?php echo $this->M_user->get_home_page($comment['client']);?>">
                                                
                                                <?php if($this->M_user->get_user_role($comment['client']) == "1") { ?>
                                    
                                    <img alt="" src="<?php echo $this->M_user->get_avata($comment['client']);?>" class="pull-left">
                                    <?php } else {
                                        ?>
                                        <img alt="" src="<?php echo $this->M_user->get_avata_flp($comment['client']);?>" class="pull-left">
                                    
                                        <?php 
                                    }

                                    ?>
                                            </a>
                                            <div class="pull-left">
                                                <span class="rblog-name"><a href="<?php echo $this->M_user->get_home_page($comment['client']);?>"><?php echo $this->M_user->get_name($comment['client']);?></a></span>
                                                <span class="rblog-post"><?php echo ucfirst($comment['comment']); ?></span>
                                            </div>

                                        </div>
                                    <?php } ?>
                                    <div class="CoButG"><button  class="CommBut CoButt">Comment</button></div>
                                    <div class="clearfix"></div>
                                    <div class="CommentForm">
                                        <h2>Add Comment</h2>
                                        <form method="post" action="<?php echo base_url().'artist/membercomment'?>">
                                            <div class="col-md-12">
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                                                <input type="hidden" name="id_artist" value="<?=$id?>" />
                                                <textarea class="CommentText" name="comment" rows="3" required></textarea>
                                                <div class="CoButG"><button class="btn btn-danger btn-xs">Close</button> <button class="btn btn-info btn-xs">Add</button></div>
                                            </div>
                                        </form>
                                    </div><!--  CommentForm  -->
                                    <div class="clearfix"></div>
                    </div>
                </div>
                </div><!-- col-md-12  --> 
                </div>
                </div>
            </div>
        </div>
</section>
<section id="SectionGrid2">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="col-md-4 col-sm-4 col-xs-12">
             

                 <div class="col-md-12 section-shadow">
                    <div class="panel status panel-primary">
                <div class="panel-heading">
                    <!-- <h1 class="panel-title text-center">25</h1> -->
                    <div class="ico-img panel-title text-center"><span><i class="fa fa-calendar fa-spin-hover" aria-hidden="true"></i></span></div>
                     <hr class="style1">
                       <h2 class="panel-tp">RECENT BLOGS</h2>  
                </div>
                <div class="panel-body panel-area3 ScrollStyle3 text-center">  
                <?php if (isset($blogs) && count($blogs) > 0) {?>                      
                    <?php foreach ($blogs as $row) {?>
                        <div class="carousel-info">
                            <img alt="" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>" class="pull-left">
                            <div class="">
                                <span class="pull-right" style="font-size:12px; color: #e00000;"><?php echo date('M d, Y', $row['time'])?> </span>
                                <p class="rblog-name">
                                    <a href="<?php echo base_url('artist/blogs').'/'.$user_data['id']?>" class="blog_entry_header ellipsis  h6-size">
                                        <?php echo $row['title']?>
                                    </a>
                                </p>
                                <span class="rblog-post">
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
                                </span>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                </div>
            </div>
            </div><!-- col-md-12  -->
              
                
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="col-md-12 section-shadow">
                    <div class="panel status panel-primary">
                <div class="panel-heading">
                    <!-- <h1 class="panel-title text-center">25</h1> -->
                    <div class="ico-img panel-title text-center"><a href="<?php echo base_url('social_media');?>"><span><i class="fa fa-eye fa-spin-hover" aria-hidden="true"></i></span></a></div>
                     <hr class="style1">
                       <h2 class="panel-tp">QUICK ACTION</h2>  
                </div>
                <div class="panel-body panel-area3 ScrollStyle3 text-center">                        
                    <div class="row QuickAction">
                            <div class="col-md-12 col-xs-12 table-responsive">
                                <table class="table">
                                                    <tr>
                                                        <td><a href="<?php echo base_url().'social_media'?>"><button  class="btn btn-default btn-sm com">Share</button></a></td>
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
                        </div><!--  row  -->
                </div>
            </div>
            </div><!-- col-md-12  -->
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                   
                 <div class="col-md-12 section-shadow">
                    <div class="panel status panel-primary">
                        <div class="panel-heading">
                            <!-- <h1 class="panel-title text-center">25</h1> -->
                            <div class="ico-img panel-title text-center"><a href="<?php echo base_url('artist/allfans').'/'.$id; ?>"><span><i class="fa fa-user-plus fa-spin-hover" aria-hidden="true"></i></span></a></div>
                             <hr class="style1">
                              <h2 class="panel-tp"><a class="color-hov" href="<?php echo base_url('artist/allfans').'/'.$id; ?>">FANS</a></h2>  
                              <!--  <h2 class="panel-tp"><a class="color-hov" href="<?php echo base_url('artist/allfans').'/'.$id; ?>">FANS</a></h2>   -->
                        </div>
                        <div class="panel-body panel-area3 ScrollStyle3 text-center"> 
                        <?php if (isset($fans) && count($fans) > 0) { ?>                       
                           <?php $i = 0; foreach ($fans as $fan) { 

                            ?>
                                <div class="carousel-info">
                                    <a href="<?php echo base_url().$fan['home_page']; ?>">
                                        <img title="<?php echo $fan['artist_name']; ?>" alt=""
                                            src="<?php if (!empty($fan['avata'])) { echo base_url().'uploads/'.$users[0]->id.'/photo/'.$fan['avata'];}
                                            else { echo base_url().'assets/images/default-img.gif'; } ?>" class="pull-left">
                                    </a>
                                    <span class="rblog-name"><a href="<?php echo base_url().$fan['home_page']?>"><?php echo $fan['firstname']; ?></a></span>
                                </div>
                        <?php $i++ ; } ?>
                         <?php } else { ?>
                         <strong>
                           <span class="testimonials-name">No content have been added in this section yet.</span></strong>
                           <?php } ?>
                        </div>
                 </div>
            </div><!-- col-md-12  -->
               
               
            </div>
            </div>
        </div>
    </div>
</section>

<!-- End section  -->
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
        $(".CoButG").click(function(){
            $(".CommentForm").slideToggle();
        });
    });
</script>
<script type="text/javascript">
    var url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/landing-page/js/landing-page-1.js"></script>
