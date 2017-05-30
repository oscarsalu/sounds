<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php echo $user_data['firstname']?>" />
    <meta property="og:url" content="<?php echo base_url().'epk/'.$user_data['home_page']?>" />
    <meta property="og:description"        content="<?php echo $res_data_artist['bio']?>" />
    <meta property="og:image" content="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $user_data['firstname']?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>/assets/epk/template4_new/style.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
    <style type="text/css">
        .max_height515{
            max-height: 515px;
            min-height: 515px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .event_height{
            min-height: 270px;
            max-height: 270px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .press_height{
            max-height: 275px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .blog_height{
            max-height: 390px;
             min-height:  390px;
            overflow-x: hidden;
            overflow-y: scroll;
        }
        .modal, .modal p{
            color: black;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/amp/css/jplayer.blue.monday.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
     <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>


</head>

<body>
<!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Business Casual</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <!--  <ul class="nav navbar-nav">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">song</a>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a href="contact.html">blos</a>
                    </li>
                </ul> -->
                <ul class="nav navbar-nav ">
                            <li class="hidden">
                                <a href="#page-top"></a>
                            </li>
                            <li>
                                <a class="page-scroll"  data-toggle="pill"  href="#section1">Info</a>
                            </li>
                            <?php  if ($data_json->photo == 'on') {
                 ?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section2">Photo</a>
                            </li>
                            <?php 
             } if ($data_json->stats == 'on') {
                 ?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section3">Stats</a>
                            </li>
                            <?php 
             }
                            if ($data_json->video == 'on') {
                                ?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section4">Videos</a>
                            </li>
                            <?php 
                            }
                            if ($data_json->song == 'on') {
                                ?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section5">Songs</a>
                            </li>
                            <?php 
                            }?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section6">Bio</a>
                            </li>
                            <?php 
                            if ($data_json->press == 'on') {
                                ?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section7">Press</a>
                            </li>
                            <?php 
                            }
                            if ($data_json->show == 'on') {
                                ?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section8">Shows</a>
                            </li>
                            <?php 
                            }?>
                            <li>
                                <a class="page-scroll" data-toggle="pill" href="#section9">Blog</a>
                            </li>
                        </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  id="section1">
                    <div class="box1">
                        <h3 class="text-center">Info
                        </h3>
                    </div>
                     <div class="brand"><?php echo $res_data_artist['artist_name']?></div>
                    <div class="person-bar"><?php custom_echo_html($customize['epk_bio'], 300)?></div>
                </div>
            </div>
        </div>    
    </section>
   
     <!--End amp & comments  -->
    <section class="mus-area" >
        <!--start amp -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="section2">
                    <div class="box1">
                        <h3 class="text-center">photo
                        </h3>
                    </div>
                    <?php 
                        if ($data_json->photo == 'on') {
                            ?>
                    <div class="row img-thumbnails max_height515">
                    
                            <?php  
                                    if (!empty($photos)) {
                    ?>
                    <?php
                        for ($i = 0; $i <= count($photos);++$i) {
                            if (!empty($photos[$i])) {
                    ?>
                        <div class="col-md-4 morph ">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id']; ?>/photo/<?php echo $photos[$i]['filename']; ?>" width="200"  class="img-thumbnail" style="height: 200px;">
                            </a>
                        </div>
                         <?php

                            }
                        } ?>
                       <!--  <div class="col-md-4 morph">
                            <a href="#">
                                <img src="http://lorempixel.com/600/600/nature/4/" class="img-responsive img-thumbnail">
                            </a>
                        </div>
                        <div class="col-md-4 morph">
                            <a href="#">
                                <img src="http://lorempixel.com/600/600/nature/5/" class="img-responsive img-thumbnail">
                            </a>
                        </div>
                        <div class="col-md-4 morph ">
                            <a href="#">
                                <img src="http://lorempixel.com/600/600/nature/3/" class=" img-responsive img-thumbnail">
                            </a>
                        </div>
                        <div class="col-md-4 morph">
                            <a href="#">
                                <img src="http://lorempixel.com/600/600/nature/4/" class="img-responsive img-thumbnail">
                            </a>
                        </div>
                        <div class="col-md-4 morph">
                            <a href="#">
                                <img src="http://lorempixel.com/600/600/nature/5/" class="img-responsive img-thumbnail">
                            </a>
                        </div> -->
                          <?php 
                    }else{
                    ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 music-area text-center" style="color: white">
                            No Content Avaliable
                        </div>
                    <?php
                    } ?>
                    </div>
                    <?php
                    } ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 music-area" id="section6">
                    <div class="box1">
                        <h3 class="text-center">BIO
                            </h3>
                    </div>
                    <div class="col-md-12">
                        <div class="comm-back1">
                            <div class="col-xs-4 col-md-4">
                                <img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-8 col-md-8 status-text">
                               
                                <?php 
                                $text = strip_tags($epk_bio);
                                $desLength = strlen($text);
                                $stringMaxLength = 100;
                                if ($desLength > $stringMaxLength) {
                                    $des = substr($text, 0, $stringMaxLength);
                                    $text = $des.'...';
                                    echo $text;
                                } else {
                                    echo $epk_bio;
                                } ?>
                            </div>
                         
                        </div>
                    </div>
                </div>

                <?php  if ($data_json->show == 'on') {?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="section8">
                    <div class="box1">
                        <h3 class="text-center">Event
                            </h3>
                    </div>
                    <div class="col-md-12">
                        <div class="comm-back event_height">
                            <div class="socil-media">
                                <div class="panel-body">
                                    <ul class="media-list">
                                    <?php foreach ($events as $event) {
                                    if (!empty($event['event_banner'])) {
                                $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
                                } else {
                                    $url_image = base_url().'assets/images/icon/manager_git_event.png';
                                } ?>
                                        <li class="media">
                                            <div class="media-left">
                                                <div class="panel panel-danger text-center date">
                                                    <div class="panel-heading month">
                                                        <span class="panel-title strong">
                                                            <?php echo date('M',strtotime($event['event_start_date']));?>
                                                        </span>
                                                    </div>
                                                    <div class="panel-body day text-danger">
                                                        <?php echo date('d',strtotime($event['event_start_date']));?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a>
                                                    </h4> <?php 
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
                                            </div>
                                        </li>
                                        <hr/>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
     <?php 
            if ($data_json->video == 'on') {
        ?>
    <section class="mus-area" id="section4">
        <!--start videos -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box1">
                        <h3 class="text-center">Videos
                        </h3>
                    </div>
                </div>
            </div>
                
    
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="box">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                         <?php $i = 1;

                                        foreach ($videos as $row) {

                                            ?>
                        <?php 
                            if ($res_data_artist['primary_video']==$row['id']) { ?>
                            
                            <div class="item <?php if ($i == 1) {
                                    echo 'active';
                                } ?>">
                                <iframe width="100%" height="380" src="<?= base_url().'video_embed/'.$res_data_artist['primary_video'] ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                         <?php  } else { ?>
                            <div class="item <?php if ($i == 1) {
                                    echo 'active';
                                } ?>" >
                                <iframe width="100%" height="380" src="<?= base_url().'video_embed/'.$row['id']?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                            
                                <?php $i++;} ?>
                    <?php
             
                                        } ?> 
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev" style="overflow: hidden;position: absolute;cursor: pointer;width: 40px;height: 40px;left: 10%;top: 50%;margin-top: -16px;display:block;border-radius: 100% 100%;background-color: gray;">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next" style="overflow: hidden;position: absolute;cursor: pointer;width: 40px;height: 40px;right: 10%;top: 50%;margin-top: -16px;display:block;border-radius: 100% 100%;background-color: gray;">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
        
    </section>
     <?php }?>
          
    <!--End videos -->
    <!-- Video codes -->
   
    
    <section class="mus-area">
        <!--start amp -->
        <div class="container">
            <div class="row">
                <?php if ($data_json->song == 'on') { ?>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="section5">
                    <div class="box1">
                        <h3 class="text-center">amp
                        </h3>
                    </div>
                    <div class="col-md-12">
                         <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player"> </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($data_json->stats == 'on') {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="section3">
                    <div class="box1">
                        <h3 class="text-center">stats
                            </h3>
                    </div>
                    <div class="col-md-12">
                    <?php if($epk_display_info->song_counts)
                                        { ?>
                        <div class="list-group lgroup">
                            <a href="#" class="list-group-item lgitem clearfix">
                                <i class="fa fa-music"></i> Song Plays
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-info"><?=$num_songs?></button>
                                  </span>
                            </a>
                        </div>
                    <?php } if($epk_display_info->video_counts) { ?>
                        <div class="list-group lgroup">
                            <a href="#" class="list-group-item lgitem clearfix">
                                <i class="fa fa-file-video-o"></i> Video Plays
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-info"><?=$num_video?></button>
                                  </span>
                            </a>
                        </div>
                        <?php } if($epk_display_info->fan_counts) { ?>
                        <div class="list-group lgroup">
                            <a href="#" class="list-group-item lgitem clearfix">
                                <i class="fa fa-users"></i> Total Fans
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-info"><?=$num_fans?></button>
                                  </span>
                            </a>
                        </div>
                         <?php } if($epk_display_info->show_counts) { ?>
                        <div class="list-group lgroup">
                            <a href="#" class="list-group-item lgitem clearfix">
                                <i class="fa fa-hand-rock-o"></i> Total Events
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-info"><?=$num_events?></button>
                                  </span>
                            </a>
                        </div>
                         <?php } if($epk_display_info->blog_counts) { ?>
                        <div class="list-group lgroup">
                            <a href="#" class="list-group-item lgitem clearfix">
                                <i class="fa fa-bookmark"></i> Total Blogs
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-info"><?=$num_blogs?></button>
                                  </span>
                            </a>
                        </div>
                        <?php } if($epk_display_info->comments_counts) { ?>
                        <div class="list-group lgroup">
                            <a href="#" class="list-group-item lgitem clearfix">
                                <i class="fa fa-comments"></i> Total Comments
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-info"><?=$num_comments?></button>
                                  </span>
                            </a>
                        </div>
                         <?php } ?>
                         <div class="list-group lgroup">
                            <a href="#" class="list-group-item lgitem clearfix">
                                <i class="fa fa-comments"></i> View Counts
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-info"><?php if (empty($view_tats)){ echo '0'; } else { echo $view_tats['view']; } ?></button>
                                  </span>
                            </a>
                        </div>
                        
                    </div>
                </div>
                 <?php } ?>
            </div>
        </div>
    </section>
   
    <section class="mus-area">
        <!--start blog -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="section9" style="min-height: 390px;">
                    <div class="box1">
                        <h3 class="text-center">blog
                        </h3>
                    </div>
                    <?php if($epk_blogs) { ?>
                    <div class="col-md-12 comm-back1" style="min-height: 415px">
                    <?php  
                        $i = 0;
                            
                        if($i == 0) {
                    ?>   
                        <div class="col-md-6 col-xs-12 portfolio-item">
                            <a href="<?php echo base_url('artist/allblogs').'/'.$epk_blogs[$i]['user_id'].'/'.$epk_blogs[$i]['id']?>">
                                <img style="height: 200px;width: 250px;" src="<?php echo base_url('uploads/'.$epk_blogs[$i]['user_id'].'/photo/blogs/'.$epk_blogs[$i]['image_rep']) ?>" alt="">
                            </a>
                            <h4>
                                <a href="<?php echo base_url('artist/allblogs').'/'.$epk_blogs[$i]['user_id'].'/'.$epk_blogs[$i]['id']?>"><?=$epk_blogs[$i]['title'] ?></a>
                            </h4>
                            <p><?php 
                                $text = strip_tags($epk_blogs[$i]['content']);
                                $desLength = strlen($text);
                                $stringMaxLength = 150;
                                if ($desLength > $stringMaxLength) {
                                    $des = substr($text, 0, $stringMaxLength);
                                    $text = $des.'...';
                                    echo $text;
                                } else {
                                    echo $epk_blogs[$i]['content'] ;
                                } ?></p>
                            <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"> </i> <?php echo date('d/M/Y', $epk_blogs[$i]['time'])?> </span></li>
                                
                            </ul>
                        </div>
                       <?php } 
                        if($epk_blogs){
                        
                        ?>
                        <div class="col-md-6 col-xs-12 blog_height" style="">
                        <?php for($i = 1; $i < count($epk_blogs); $i++)
                        { ?>
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-responsive" src="<?php echo base_url('uploads/'.$epk_blogs[$i]['user_id'].'/photo/blogs/'.$epk_blogs[$i]['image_rep']) ?>" alt="" style="width: 80px;height: 80px;">
                                </a>
                                <div class="media-body">
                                    <a href="<?php echo base_url('artist/allblogs').'/'.$epk_blogs[$i]['user_id'].'/'.$epk_blogs[$i]['id']?>"><h4><?=$epk_blogs[$i]['title'] ?></h4></a>
                                    <span>
                                            <i class="fa fa-clock-o"></i>
                                            <?php echo date('d/M/Y', $epk_blogs[$i]['time'])?>
                                            </span>
                                    <br/><?php 
                                $text = strip_tags($epk_blogs[$i]['content']);
                                $desLength = strlen($text);
                                $stringMaxLength = 250;
                                if ($desLength > $stringMaxLength) {
                                    $des = substr($text, 0, $stringMaxLength);
                                    $text = $des.'...';
                                    echo $text;
                                } else {
                                    echo $epk_blogs[$i]['content'] ;
                                } ?>
                                </div>
                            </div>
                            <?php 
                            if($epk_blogs[$i] != (end($epk_blogs))) {
                            ?>
                            <hr>
                            <?php } ?>
                        <?php
                        }
                        
                        } ?>    
                        </div>
                    </div>
                    <?php }else {
                    ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 music-area text-center" style="color: white">
                            No Content Avaliable
                        </div>
                    <?php
                    } ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 music-area">
                    <div class="box1">
                        <h3 class="text-center">Social Media
                            </h3>
                    </div>
                    <div class="col-md-12">
                        <div class="comm-back">
                            <div class="socil-media">
                                <ul class="music-social">
                                    <li>
                                        <a href="<?=$res_data_artist['facebook_username']?>" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=$res_data_artist['twitter_username']?>" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=$res_data_artist['instagram_username']?>" target="_blank">
                                            <i class="fa  fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=$res_data_artist['youtube_username']?>" target="_blank">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    if ($data_json->press == 'on') {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="section7">
                    <div class="box1">
                        <h3 class="text-center">Press
                            </h3>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 " >
                        <div class="comm-back press_height">
                            <div class="socil-media">
                                <div class="panel-body">
                                    <ul class="media-list">
                                     <?php
                        if($press) { $i = 0;
                        foreach ($press as $row) {
                    ?>
                                        <li class="media">
                                            <div class="media-body">
                                               <div class="panel panel-default">
                                                <div class="panel-heading text-center"><?php echo $row['name']?></div>
                                                <div class="panel-body text-center" style="color: red"> <?php echo $row['quote']?></div>
                                                <div class="panel-footer text-right" style="color: black;"><?php echo date('M-d-Y',strtotime($row['date_on']));?></div>
                                            </div>
                                        </div>
                                           
                                            
                                        </li>
                                        <hr/>
                                        <?php  $i++; } } ?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php

                    } ?>  
            </div>
        </div>  
    </section>
    <footer >
    <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0 mdarea  ">
                    <h5>Download Media: </h5> 
                    <?php if ($data_json->dw_photo == 'on') {
    ?>
                    <a href="#" style="color: white" class="icon picture download" id="download_media" data-toggle="modal" data-target="#photo"><i class="fa fa-picture-o"></i> Photos </a>
                    <?php 
}
                     if ($data_json->dw_song == 'on') {
                         ?>
                    <a href="#" style="color: white"  class="icon music download" id="download_audio" data-toggle="modal" data-target="#songsdownload"><i class="fa fa-music"></i> Music </a>
                    <?php 
                     }
                     if ($data_json->dw_bios == 'on') {
                         ?>
                    <a style="color: white"  href="<?php echo base_url('artist/dashboard_epk/download/bio').'/'.$res_data_artist['id']?>" id="download_bio" ><i class="fa fa-user"></i> Bio </a>
                    <?php 
                     }
                     if ($data_json->dw_video == 'on') {
                     ?>
                     <a href="#" style="color: white"  class="icon picture download"  data-toggle="modal" data-target="#video" id="download_video"><i class="fa fa-video-camera"></i> Videos </a>
                    <?php 
                     }
                     if ($data_json->dw_pdf == 'on') {
                     ?>
                     <a style="color: white"  href="<?php echo base_url('epk').'/'.$res_data_artist['home_page'].'?action=pdf'?>" id="download_pdf" ><i class="fa fa-file-pdf-o"></i> .pdf </a>
                    <?php 
                     }
                     ?>
                </div>
                <div class="col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 col-xs-12 mdarea1 ">
                   <a href="#"  class="btn btn-primary" data-toggle="modal" data-target="#contact">Contact Artist</a>
                   <a href="<?php echo base_url().$res_data_artist['home_page']?>" class="btn btn-default" target="_blank">View Profile</a>
                </div>
            </div>
        </div>
</footer>
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
<?php }?>
  

    <!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $("html, body").scrollTop($($anchor.attr('href')).offset().top); 
        
        event.preventDefault();
    });
});

    </script>
    <script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
        (function($){
        $(window).load(function(){
            $("body").mCustomScrollbar({theme:"minimal-dark"});
            $(".blog_height, .press_height, .event_height, .max_height515").mCustomScrollbar({theme:"minimal-dark"});
        });
    })(jQuery);
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.min.js"> </script> 
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.jplayer.js"> </script>   
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jplayer.playlist.js"> </script>   
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.redirect.js"> </script>   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/setting.epk.js"> </script>    
    <script type="text/javascript">AMP_Load_data('<?=$user_id?>', '<?=$affiliatesId?>', '<?=$albumIds?>');</script>
</body>

</html>



