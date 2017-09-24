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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/global.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/template3/epk3.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/epk/template3/magnific-popup.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>

</head>
<body >
<?php 
    $data_json = json_decode($customize['data_customize']);
?>
<script type="text/javascript">
    $(document).ready(function(){
        $end = $("#section4 .tab-pane").last();
        $first = $("#section4 .tab-pane").last();
        if($end== $first){
            $(".video>.button-right").hide();
            $(".video>.button-left").hide();
        }
        $(".video>.button-left").click(function(event){
           
            $("#section4 .tab-pane").each(function() { 
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
            $("#section4 .tab-pane").each(function() { 
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
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
            <?php echo ucfirst($res_data_artist['artist_name'])?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#section1">Info</a>
                </li>
                <?php  if ($data_json->photo == 'on') {
     ?>
                <li>
                    <a class="page-scroll" href="#section2">Photo</a>
                </li>
                <?php 
 } if ($data_json->stats == 'on') {
     ?>
                <li>
                    <a class="page-scroll" href="#section3">Stats</a>
                </li>
                <?php 
 }
                if ($data_json->video == 'on') {
                    ?>
                <li>
                    <a class="page-scroll" href="#section4">Videos</a>
                </li>
                <?php 
                }
                if ($data_json->song == 'on') {
                    ?>
                <li>
                    <a class="page-scroll" href="#section5">Songs</a>
                </li>
                <?php 
                }?>
                <li>
                    <a class="page-scroll" href="#section6">Bios</a>
                </li>
                <?php 
                if ($data_json->press == 'on') {
                    ?>
                <li>
                    <a class="page-scroll" href="#section7">Press</a>
                </li>
                <?php 
                }
                if ($data_json->show == 'on') {
                    ?>
                <li>
                    <a class="page-scroll" href="#section7">Shows</a>
                </li>
                <?php 
                }?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    
</nav>
<div class="epk3-tpl">
    <section class="tab3-info"  id="section1">
        <div class="container ">
            <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="INFO">INFO</span></a></h1>
            <div class="row">
                <div class="tile-widget">
                    <?php 
                    if ($data_json->stats == 'on') {
                        ?>
                    <!-- col -->
                    <div class="col-md-5">
                        <h3>Age breakdown</h3>
                        <div>
                            <span class="bar-title">13-17</span>
                            <div class="progress progress-transparent-black">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 13, 17)?>%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                            <span class="bar-title">18-24</span>
                            <div class="progress progress-transparent-black">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 18, 24)?>%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                            <span class="bar-title">25-34</span>
                            <div class="progress progress-transparent-black">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 24, 34)?>%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                            <span class="bar-title">35-44</span>
                            <div class="progress progress-transparent-black">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 35, 44)?>%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                            <span class="bar-title">45+</span>
                            <div class="progress progress-transparent-black">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 45, 200)?>%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }?>
                    <div class="col-md-7">
                        <div class="media mb-20">
                            <div class="pull-left thumb">
                                <?php if ($photo != 'notfound') {
    ?>
                                    <img class="img-responsive  " width="400" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" />    
                                <?php 
} else {
    ?>
                                    <img class="img-responsive  " width="400" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                                <?php 
} ?>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading mb-0"><strong><?php echo $res_data_artist['artist_name']?></strong></h4>
                                <!-- col -->
                                <div class="col-xs-4 text-center b-r b-solid">
                                    <small class="text-lightred">Fans <i class="fa fa-heart-o"></i> <?=$num_fans?></small>
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <div class="col-xs-4 text-center">
                                    <small class="text-blue">Commnet <i class="fa fa-comment-o"></i> <?=$num_comments?></small>
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <div class="col-xs-12">
                                    <dl class="dl-horizontal text-sm">
                                        <dt style="width: 60px">About: </dt>
                                        <dd ><?php custom_echo_html($res_data_artist['bio'], 300)?></dd>
                                        <dt style="width: 60px">Genre: </dt>
                                        <dd ><?php echo $genre['name'];?></dd>
                                        <dt style="width: 60px">Members: </dt>
                                        <dd ><?php
                                               foreach ($groups_member as $member) {
                                                   echo $member['name_member'].' - '.$member['contribution'];
                                                   if (!empty($member['contribution2'])) {
                                                       echo '/'.$member['contribution2'];
                                                   }
                                                   if ($member != end($groups_member)) {
                                                       echo ',';
                                                   }
                                               }
                                               ?> </dd>
                                        <dt style="width: 60px">Rating: </dt>
                                        <dd class="text-lightred" ><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></dd>
                                    </dl>
                                </div>
                                <!-- /col -->
                                </div>
                        </div>
                    </div>
                    <!-- /col -->
                </div>
            </div>
        </div>
    </section>
    <?php 
    if ($data_json->photo == 'on') {
        ?>
    <!-- Section 2 -->
    <section  id="section2">
        <div class="container ">
            <div class="row">
                <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="PHOTO">PHOTO</span></a></h1>
                <div class="col-md-12" data-lightbox="gallery">
                    <?php if (!empty($photos)) {
    ?>
                        <div class="row">
                        <?php
                        for ($i = 0; $i <= count($photos);++$i) {
                            if (!empty($photos[$i])) {
                                ?>
                             <!-- col -->
                            <div class="col-md-3 padding-10 photo-epk3">
                                <a href="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id']; ?>/photo/<?php echo $photos[$i]['filename']; ?>" class="img-link" data-lightbox="gallery-item">
                                    <img  src="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id']; ?>/photo/<?php echo $photos[$i]['filename']; ?>" alt="<?php echo $photos[$i]['caption']; ?>" class="img-responsive">
                                </a>
                            </div>
                            <!-- /col -->
                            <?php

                            }
                        } ?>
                        </div>
                        <!-- /row -->
                        <?php

} ?>
                </div>    
            </div>
        </div>
        
    </section>
    <?php 
    }
    if ($data_json->stats == 'on') {
        ?>
    <section class="tab3-stats"  id="section3">
        <div class="container ">
            <div class="row">
                <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="STATS">STATS</span></a></h1>
                <div class="col-md-6">
                    <div class="demographic_stats stats_contents">
                        <div class="stats_column center_stat_column">
                            <h4>Fan Demographics </h4>
                            <p class="info">Top Demographics is Females (age 13-17)</p>
                            <table>
                                <tbody>
                                    <tr>
                                        <th style="width: 40%;">Female</th>
                                        <th></th>
                                        <th style="width: 10%;text-align: center;">Age</th>
                                        <th></th>
                                        <th style="width: 40%;text-align:right">Male</th>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 13, 17, 1)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">13-17</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 13, 17, 2)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 18, 24, 1)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">18-24</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 18, 24, 3)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 25, 34, 1)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">25-34</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 25, 34, 2)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 35, 44, 1)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">35-44</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 35, 44, 2)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 45, 54, 1)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">45-54</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 45, 54, 3)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 55, 200, 1)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">55+</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 55, 200, 2)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 0, 12, 1)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">n/a</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage">
                                            <div class="progress progress-transparent-black" >
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->Member_model->stast_fan($fans, 0, 12, 2)?>%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>Fan Summary</h2>
                </div>
            </div>
        </div>
    </section>
    <?php 
    }
    if ($data_json->video == 'on') {
        ?>
    <section class="tab3-videos" id="section4" style="padding: 0px;">
        <div class="video-content">
            <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="VIDEOS">VIDEOS</span></a></h1>
            <div class="video col-12 relative">
                <a href="#" class="button-left" title="previous" ><i class="fa fa-angle-left"></i></a>
                <div class="tab-content">
                    <?php $i = 1;
        foreach ($videos as $row) {
            ?>
                        <div role="tabpanel" class="tab-pane <?php if ($i == 1) {
    echo 'active';
} ?>" id="th<?php echo $i++?>">
                             <?php 
                        
                            if ($res_data_artist['primary_video']==$row['id']) { ?>
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
    </section>
    <?php 
    }
    if ($data_json->song == 'on') {
        ?>
    <section class="tab3-songs" id="section5">
        <div class="container">
            <div class="row song-content">
                <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="SONGS">SONGS</span></a></h1>
                <div class="col-md-3">
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
                <div class="col-md-6">
                    <?=$this->M_audio_song->get_shortcode_AMP($res_data_artist['id']); ?>
                </div>
            </div>
        </div>
    </section>
    <?php 
    }?>
    <section class="tab3-bios" id="section6">
        <div class="container">
            <div class="row">
                <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="BIOS">BIOS</span></a></h1>
                <div class="col-md-4">
                      <img width="300" src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" alt="" class="img-responsive mb-20">
                </div>
                <div class="col-md-8">
                    <h2 class="custom-font mb-5"><span class="label label-success">Bios</span></h2>
                    <p class="short-desc text-sm text-default lt mb-20"><?php echo $res_data_artist['bio']?></p>
                </div>    
            </div>
        </div>
    </section>
    <?php 
    if ($data_json->press == 'on') {
        ?>
    <section class="tab3-press" id="section7">
        <div class="container">
            <div class="row">
                <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="PRESS">PRESS</span></a></h1>
                <div class="col-md-offset-1 col-md-10">
                    <div id="press_items">
                        <div class="press_container">
                            <div id="press_handler_212672" class="press_event_handler">
                            </div>
                            <ul id="ticker" style=" min-height: 200px;">
                            <?php
                                foreach ($press as $row) {
                                    ?>
                                    <li>
                                        <div class="press_item" style="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <blockquote class="filled bg-slategray lter">
                                                            <p><i class="fa fa-quote-left pull-left"></i><?php echo $row['quote']?></p>
                                                            <small><?php echo $row['author']?> 
                                                            <?php if (!empty($row['link'])) {
    ?><a href="<?php echo $row['link']?>" target="_blank"><?php

} ?> <span class="publication">~ <?php echo $row['name']; ?></span>
                                                            <?php if (!empty($row['link'])) {
    ?></a><?php

} ?> </small>
                                                        </blockquote>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                <?php

                                } ?>
                            </ul>
                        </div>
                    <script>
                        function tick(){
                            $('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
                        }
                        setInterval(function(){ tick () }, 5000);
                    </script>
                </div>
                </div>
                
            </div>
        </div>
    </section>
    <?php 
    } ?>
    <section class="tab3-footer" id="section8">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 ">
                    <h5>Download Media: </h5> 
                    <?php if ($data_json->dw_photo == 'on') {
    ?>
                    <a href="#" class="icon picture download" id="download_media" data-toggle="modal" data-target="#photo"><i class="fa fa-picture-o"></i> Photos </a>
                    <?php 
}
                     if ($data_json->dw_song == 'on') {
                         ?>
                    <a href="#" class="icon music download" id="download_audio" data-toggle="modal" data-target="#songsdownload"><i class="fa fa-music"></i> Music </a>
                    <?php 
                     }
                     if ($data_json->dw_bios == 'on') {
                         ?>
                    <a href="<?php echo base_url('artist/dashboard_epk/download/bio').'/'.$res_data_artist['id']?>" id="download_bio" ><i class="fa fa-user"></i> Bio </a>
                    <?php 
                     }
                     if ($data_json->dw_video == 'on') {
                     ?>
                     <a href="#" class="icon picture download"  data-toggle="modal" data-target="#video" id="download_video"><i class="fa fa-video-camera"></i> Videos </a>
                    <?php 
                     }
                     if ($data_json->dw_pdf == 'on') {
                     ?>
                     <a href="<?php echo base_url('epk').'/'.$res_data_artist['home_page'].'?action=pdf'?>" id="download_pdf" ><i class="fa fa-file-pdf-o"></i> .pdf </a>
                    <?php 
                     }
                     ?>
                </div>
                <div class="col-xs-6 " style="text-align: right;;">
                   <a href="#" style="margin-right:20px;" class="btn btn-primary" data-toggle="modal" data-target="#contact">Contact Artist</a>
                   <a href="<?php echo base_url().$res_data_artist['home_page']?>" class="btn btn-default" style="margin-right:20px" target="_blank">View Profile</a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Contact -->
 <script>
    function checkOtherMail() {
        console.log('function calls');
        $('#contact').modal('hide');
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
                $('#contact').modal('show');
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
                $('#contact').modal('hide');
              }
            }
          ]
          
        });
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
<!--Send mail to multiple mail-->
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

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Send Message</h4>
            </div>
            <!-- action="<?php echo base_url()?>artist/presskit/contact" -->
            <form class="form form-signup" id="contact_form" role="form"  method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-3">To:</label>
                        <div class="input-group col-md-8">
                            <label><span><?php if(!empty($customize['email_artist'])) { echo $customize['email_artist']; echo ',';}?></span><span><?php if(!empty($customize['email_booking'])) { echo ' '.$customize['email_booking']; echo ',';}?></span><span><?php if(!empty($customize['email_manager'])) { echo ' '.$customize['email_manager']; echo ',';}?></span></label>
                            <label  class="checkbox">
                            
                            <input type="checkbox"  name="to[public_email]" id="to[public_email]" value="<?php if(!empty($customize['email_artist'])) { echo $customize['email_artist']; }else {'';} ?>" <?php if (empty($customize['email_artist'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Artist</label>
                            <label  class="checkbox">
                                 
                            <input type="checkbox" id="to[booking_email]" value="<?php if(!empty($customize['email_booking'])) { echo $customize['email_booking']; }else{'';} ?>" name="to[booking_email]" <?php if (empty($customize['email_booking'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Booking</label>
                            <label  class="checkbox">
                                
                            <input type="checkbox" id="to[mngt_email]"  value="<?php if(!empty($customize['email_manager'])) { echo $customize['email_manager']; }else{'';} ?>" name="to[mngt_email]" <?php if (empty($customize['email_manager'])) {
    echo 'disabled';
} else {
    echo 'checked';
} ?>/>Management</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-3">From:</label>
                        <div class="input-group col-md-8">
                            <input type="hidden" name="fromemail" >
                            <input type="email" class="form-control" id="from" name="from" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-3">Subject:</label>
                        <div class="input-group col-md-8">
                            <input type="hidden" name="subject" >
                            <input type="text" class="form-control" id="subject" name="subject" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-3">Message:</label>
                        <div class="input-group col-md-8">
                             <input type="hidden" name="msg" >
                            <textarea class="form-control" rows="6" name="msg" id="msg"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="dialog-confirm" onclick="checkOtherMail()"> Send</button> 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
                </div>
            </form>
        </div>
    </div>
</div>
<?php if ($data_json->dw_photo == 'on') {
    ?>
<!-- Modal download photo -->
<div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Download Media Photos</h4>
            </div>
            s
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
        <?php } if ($data_json->dw_song == 'on') {
    ?>
<!-- Modal download songs -->
<div class="modal fade" id="songsdownload" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
</body>
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
                    file: "<?php echo 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$res_data_artist['id'].'/audio/'.$row['filename'] ?>"
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/agency.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cbpAnimatedHeader.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>
<!-- Main slider JS script file -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mightyslider.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var isTouch = !!('ontouchstart' in window),
            clickEvent = isTouch ? 'tap' : 'click';

        (function() {
            // Global slider's DOM elements
            var $example = $('#example'),
                $parent = $('.mightyslider_modern_skin', $example),
                $tabs = $('.tabs ul', $example),
                $frame = $('.frame', $example);

            // Calling mightySlider via jQuery proxy
            $frame.mightySlider({
                    speed: 1000,
                    autoScale: 'easeOutExpo',
                    easing: 'easeOutExpo',

                    // Navigation options
                    navigation: {
                        slideSize: '100%'
                    },

                    // Thumbnails options
                    thumbnails: {
                        horizontal: 0,
                        preloadThumbnails: 0,
                        activateOn: clickEvent,
                        thumbnailsBar: $tabs,
                        thumbnailBuilder: function(index, thumbnail) {
                            return '<li><h3>' + this.slides[index].options.title + '</h3>by ' + this.slides[index].options.owner + '</li>';
                        }
                    },

                    // Commands options
                    commands: {
                        buttons: 1
                    }
                },

                // Register callbacks to the events
                {
                    // Register mightySlider :active event callback
                    active: function(name, index) {
                        var skin = this.slides[index].options.skin || '';
                        $example.removeClass('black').addClass(skin);
                    }
                });
                $('.mSSlideElement .active .mSCover').addClass("hidden-cover");
        })();
        
        
    }
    
    );
</script>
<script>
$(document).ready(function() {
  $lightboxGalleryEl = $('[data-lightbox="gallery"]');
  $lightboxGalleryEl.each(function() {
        var element = $(this);

        if( element.find('a[data-lightbox="gallery-item"]').parent('.clone').hasClass('clone') ) {
            element.find('a[data-lightbox="gallery-item"]').parent('.clone').find('a[data-lightbox="gallery-item"]').attr('data-lightbox','');
        }

        element.magnificPopup({
            delegate: 'a[data-lightbox="gallery-item"]',
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            image: {
                verticalFit: true
            },
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            }
        });
    });  
  $('.image-link').magnificPopup({type:'image'});
});
</script>
</html>
