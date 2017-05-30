<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $user_data['firstname']?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type"               content="profile" />
    <meta property="og:title"              content="<?php echo $user_data['firstname']?>" />
    <meta property="og:url" content="<?php echo base_url().'epk/'.$user_data['home_page']?>" />
    <meta property="og:description"        content="<?php echo $res_data_artist['bio']?>" />
    <meta property="og:image" content="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" />
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <!-- Theme CSS -->
    <link href="<?php echo base_url()?>/assets/epk/template3_new/css/style.css" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/amp/css/jplayer.blue.monday.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.min.js"> </script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.js"></script>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.jplayer.js"> </script>   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jplayer.playlist.js"> </script>   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.redirect.js"> </script>   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/setting.epk.js"> </script>    
    <script type="text/javascript">AMP_Load_data('<?=$user_id?>', '<?=$affiliatesId?>', '<?=$albumIds?>');</script>
    <style type="text/css">
        
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i> <span class="light"><?php echo $res_data_artist['artist_name']?></span>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#info">INFO</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#blos">BIO</a>
                    </li>
                    <?php  if ($data_json->photo == 'on') {
                 ?>
                    <li>
                        <a class="page-scroll" href="#Photos">PHOTO</a>
                    </li>
                    <?php 
             } if ($data_json->stats == 'on') {
                 ?>
                    <li>
                        <a class="page-scroll" href="#stats">STATS</a>
                    </li>
                    <?php 
             }
                            if ($data_json->video == 'on') {
                                ?>
                    <li>
                        <a class="page-scroll" href="#videos">VIDEOS</a>
                    </li>
                    <?php 
                            }
                            if ($data_json->song == 'on') {
                                ?>
                    <li>
                        <a class="page-scroll" href="#songs">SONGS</a>
                    </li>

                     <?php 
                            }?>
                             <?php 
                            if ($data_json->show == 'on') {
                                ?>
                    <li>
                        <a class="page-scroll" href="#shows">SHOWS</a>
                    </li>
                    <?php 
                            }
                            if ($data_json->press == 'on') {
                                ?>
                                <li>
                        <a class="page-scroll" href="#press">PRESS</a>
                    </li>
                    
                    
                     <?php 
                            }?>
                    <li>
                        <a class="page-scroll" href="#blog">BLOG</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Intro Header -->
    
    <section id="info" class="content-section text-center back-image2 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 content-sect ">
                    <div class="title text-center">
                        <h2> Infrom<span class="color">ation</span></h2>
                        <div class="border"></div>
                    </div>
                    <br/>
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="col-md-3 col-md-offset-1 col-sm-6 hero-feature">
                            <?php if ($photo != 'notfound') { ?>
                               <img class="img-responsive img-thumbnail" width="400" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" />    
                            <?php } else {     ?>
                                <img class="img-responsive img-thumbnail" width="400" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                            <?php } ?>
                        </div>
                        <div class="col-md-7  col-sm-6 hero-feature">
                            <?php custom_echo_html($customize['epk_bio'], 300)?>
                        </div>
                        <br/>
                    </div>
                    <br/>
                    <?php 
                        if ($epk_display_info->age_break_down_display == 'on') {
                    ?>
                    <div class="col-md-2 col-md-offset-1 col-sm-3 hero-feature">
                        <div class="skill-chart text-center">
                            <span class="chart" data-percent="<?php echo $this->Member_model->stast_fan($fans, 13, 17)?>">
                               <span class="percent"><?php echo $this->Member_model->stast_fan($fans, 13, 17)?></span>
                            </span>
                            <h3><i class="fa fa-users"></i>13-17</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 hero-feature">
                        <div class="skill-chart text-center">
                            <span class="chart" data-percent="<?php echo $this->Member_model->stast_fan($fans, 18, 24)?>">
                                      <span class="percent"><?php echo $this->Member_model->stast_fan($fans, 18, 24)?></span>
                            </span>
                            <h3><i class="fa fa-users"></i>18-24</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 hero-feature">
                        <div class="skill-chart text-center">
                            <span class="chart" data-percent="<?php echo $this->Member_model->stast_fan($fans, 24, 34)?>">
                                      <span class="percent"><?php echo $this->Member_model->stast_fan($fans, 24, 34)?></span>
                            </span>
                            <h3><i class="fa fa-users"></i>25-34</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 hero-feature">
                        <div class="skill-chart text-center">
                            <span class="chart" data-percent="<?php echo $this->Member_model->stast_fan($fans, 35, 44)?>">
                                      <span class="percent"><?php echo $this->Member_model->stast_fan($fans, 35, 44)?></span>
                            </span>
                            <h3><i class="fa fa-users"></i>35-45</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 hero-feature">
                        <div class="skill-chart text-center">
                            <span class="chart" data-percent="<?php echo $this->Member_model->stast_fan($fans, 45, 200)?>">
                                      <span class="percent"><?php echo $this->Member_model->stast_fan($fans, 45, 200)?></span>
                            </span>
                            <h3><i class="fa fa-users"></i>45+</h3>
                        </div>
                    </div>
                    <?php 
                    }?>
                </div>
            </div>
        </div>
    </section>
    <!-- photo Section -->
    <?php 
        if ($data_json->photo == 'on') {
    ?>
    <section id="Photos" class="content-section text-center back-color ">
        <div class="photo-section content-sect">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">Photo</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <?php  
                    if (!empty($photos)) {
                ?>

                <div class="col-lg-12 col-md-12 content-sect photo_max_height">
                    <?php
                        for ($i = 0; $i <= count($photos);++$i) {
                            if (!empty($photos[$i])) {
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="site-content">
                            <div class="columns">
                                <div class="project-list">
                                    <div class="project">
                                        <div class="project__card">
                                            <a href="" class="project__image"><img src="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id']; ?>/photo/<?php echo $photos[$i]['filename']; ?>" class="img-responsive"  style="width: 370px;height: 255px" alt="<?php echo $photos[$i]['caption']; ?>"></a>
                                            <div class="project__detail">
                                                <h2 class="project__title"><a href="#"><?php echo $photos[$i]['caption']; ?></a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } ?>
                    
                </div>
                <?php

                } ?>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- photo Section -->
    <!-- stat Section -->
    <?php 
        if ($data_json->stats == 'on') {
    ?>
    <section id="stats" class="content-section text-center back-image1">
        <div class="stats-section content-sect ">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">stats</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <div class="col-lg-12 col-md-12">
                    <?php if($epk_display_info->song_counts)
                        { ?> 
                    <!-- first Count iteam -->
                    <div class="col-md-4 col-sm-6 col-xs-12 text-center count-item">
                        <div class="counters-item">
                            <div>
                                <span class="c-size"><?=$num_songs?></span>
                            </div>
                            <i class="fa fa-music fa-2x"></i>
                            <h3>Songs Counts</h3>
                        </div>
                    </div>
                    <?php } if($epk_display_info->video_counts) {?>
                    <!-- end first count iteam -->
                    <!-- second count item -->
                    <div class="col-md-4 col-sm-6 col-xs-12 text-center count-item">
                        <div class="counters-item">
                            <div>
                                <span class="c-size"><?=$num_video?></span>
                            </div>
                            <i class=" fa fa-video-camera fa-2x"></i>
                            <h3>Video Counts</h3>
                        </div>
                    </div>
                     <?php } if($epk_display_info->blog_counts) {?>
                    <!-- end second Count item -->
                    <!-- third Count item -->
                    <div class="col-md-4 col-sm-6 col-xs-12 text-center count-item">
                        <div class="counters-item">
                            <div>
                                <span class="c-size"><?=$num_blogs?></span>
                            </div>
                            <i class="fa fa-rss fa-2x"></i>
                            <h3>Blogs Counts</h3>
                        </div>
                    </div>
                     <?php } if($epk_display_info->fan_counts) {?>
                    <!-- end third count  item -->
                    <!-- four item -->
                    <div class="col-md-4 col-sm-6 col-xs-12 text-center count-item">
                        <div class="counters-item">
                            <div>
                                <span class="c-size"><?=$num_fans?></span>
                            </div>
                            <i class="fa fa-users fa-2x"></i>
                            <h3>Fans Counts</h3>
                        </div>
                    </div>
                    <?php } if($epk_display_info->comments_counts) {?>
                    <!-- end four count  item -->
                    <!-- five item -->
                    <div class="col-md-4 col-sm-6 col-xs-12 text-center count-item">
                        <div class="counters-item">
                            <div>
                                <span class="c-size"><?=$num_comments?></span>
                            </div>
                            <i class="fa fa-comments fa-2x"></i>
                            <h3>Comments Counts</h3>
                        </div>
                    </div>
                     <?php } if($epk_display_info->show_counts) {?>
                    <!-- end four count  item -->
                    <!-- six  item -->
                    <div class="col-md-4 col-sm-6 col-xs-12 text-center count-item">
                        <div class="counters-item">
                            <div>
                                <span class="c-size"><?=$num_events?></span>
                            </div>
                            <i class="fa fa-calendar-o fa-2x"></i>
                            <h3>Events Counts</h3>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-4 col-sm-6 col-xs-12 text-center count-item">
                        <div class="counters-item">
                            <div>
                                <span class="c-size"><?php if (empty($view_tats)){echo '0';} else {echo $view_tats['view'];} ?></span>
                            </div>
                            <i class="fa fa-calendar-o fa-2x"></i>
                            <h3>View Counts</h3>
                        </div>
                    </div>
                    <!-- end six count iteam -->
                </div>
            </div>
        </div>
    </section>
     <?php  } 
        if ($data_json->video == 'on') { ?>
    <!-- stat Section end -->
    <section id="videos" class="content-section text-center  back-color">
        <div class="videos-section content-sect">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">videos</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <div id="features">
                    <div class="item">
                        <div class="features-item">
                            <!-- features media -->
                            <div class="col-md-12 features-media ">
                            <?php if(!empty($videos)){ ?>
                               <div id="myCarousel" class="carousel slide" data-interval="false">
                    
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
                    <a class="left carousel-control" id="left-button" href="#myCarousel" data-slide="prev" style="overflow: hidden;position: absolute;cursor: pointer;width: 40px;height: 40px;left: 10%;top: 50%;margin-top: -16px;display:block;border-radius: 100% 100%;background-color: gray;"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" id="right-button" href="#myCarousel" data-slide="next" style="overflow: hidden;position: absolute;cursor: pointer;width: 40px;height: 40px;right: 10%;top: 50%;margin-top: -16px;display:block;border-radius: 100% 100%;background-color: gray;"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                <?php } ?>   
                            </div>
                              
                            <!-- /features media -->
                            <!-- features content -->
                            <!-- <div class="col-md-6 ">
                                <h3>Main Features of music</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, dolores corporis maxime modi amet nisi quod delectus nesciunt ullam nemo natus soluta!</p>
                            </div> -->
                            <!-- /features content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php }  if ($data_json->song == 'on') { ?>
    <!-- songs Section -->
    <section id="songs" class="content-section text-center back-image1">
        <div class="songs-section content-sect">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">songs</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player"> </div>
                </div>
            </div>
        </div>
    </section>
    <?php } if ($data_json->show == 'on') {?>
    <!-- shows Section -->
    <section id="shows" class="content-section text-center back-color ">
        <div class="shows-section content-sect">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">shows</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event_max_height" >
                <?php if(!empty($events)) {
                        foreach ($events as $event) {
                            ?>
                        <?php if (!empty($event['event_banner'])) {
                            $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
                            } else {
                                $url_image = base_url().'assets/images/icon/manager_git_event.png';
                            } ?>
                    <div class="panel panel-default event">
                        <div class="panel-body">
                            <div class="rsvp col-xs-12 col-sm-2">
                                <i><?php echo date('d',strtotime($event['event_start_date']));?></i>
                                <i><?php echo date('M',strtotime($event['event_start_date']));?></i>
                            </div>
                            <div class="info col-xs-12 col-sm-7">
                                <p><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></p>
                                <p><?php 
                                        $text = strip_tags($event['event_desc']);
                                        $desLength = strlen($text);
                                        $stringMaxLength = 250;
                                        if ($desLength > $stringMaxLength) {
                                            $des = substr($text, 0, $stringMaxLength);
                                            $text = $des.'...';
                                            echo $text;
                                        } else {
                                            echo $event['event_desc'];
                                        } ?></p>
                            </div>
                            <div class="author col-xs-12 col-sm-3">
                                <div class="profile-image">
                                    <img src="<?php echo $url_image; ?>" />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php }
                        } ?> 
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- blos Section -->
    <section id="blos" class="content-section text-center back-image1">
        <div class="blos-section">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">Bio</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <div class="col-md-12">
                    <img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" alt="Texto Alternativo" class="img-circle img-thumbnail">
                    <h2> <?php echo $res_data_artist['artist_name']?></h2>
                    <p><?=$epk_bio?></p>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning">
                            Social</button>
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span><span class="sr-only">Social</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?=$res_data_artist['twitter_username']?>">Twitter</a></li>
                            <li><a href="<?=$res_data_artist['instagram_username']?>">Instagram</a></li>
                            <li><a href="<?=$res_data_artist['facebook_username']?>">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- press Section -->
     <?php 
            if ($data_json->press == 'on') {
        ?>
    <section id="press" class="content-section text-center back-color">
        <div class="press-section">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">press</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="container press_max_height">
                        <div class="row">
                            <ul class="timeline">
                                <?php
                        if($press) { $i = 0;
                        foreach ($press as $row) {
                    ?>
                                <li class="<?php if($i%2 != 0) { echo 'timeline-inverted'; } ?>">
                                    <div class="timeline-badge">
                                        <a><i class="fa fa-circle" id=""></i></a>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4><?php echo $row['name']?></h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p><?php echo $row['quote']?></p>
                                        </div>
                                        <div class="timeline-footer">
                                            <p class="text-right"><?php echo date('M-d-Y',strtotime($row['date_on']));?></p>
                                        </div>
                                    </div>
                                </li>
                                 <?php  $i++; } } ?>
                                <li class="clearfix no-float"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <?php } ?>
    <!-- blog Section -->
    <section id="blog" class="content-section text-center back-image1 ">
        <div class="blog-section">
            <div class="container">
                <div class="title text-center">
                    <h2><span class="color">blog</span></h2>
                    <div class="border"></div>
                </div>
                <br/>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_max_height">
                    <?php foreach ($epk_blogs as $key => $blog) { 
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Blog Post -->
                        <div class="blog-post">
                            <!-- Blog Item Header -->
                            <div class="blog-item-header">
                                <!-- Date -->
                                <div class="blog-post-date pull-left">
                                    <span class="day"><?php echo date('d', $blog['time'])?></span>
                                    <span class="month"><?php echo date('M, Y', $blog['time'])?></span>
                                </div>
                                <h2>
                                    <a href="<?php echo base_url('artist/allblogs').'/'.$blog['user_id'].'/'.$blog['id']?>"><?=$blog['title'] ?></a>
                                </h2>
                                <div class="blog-post-details">
                                    <!-- Author Name -->
                                    <div class="blog-post-details-item blog-post-details-item-left user-icon">
                                        <i class="fa fa-user"></i> 
                                        <a href="<?php echo base_url().$res_data_artist['home_page']?>" title="<?=$res_data_artist['home_page']?>">
                                                    <small><?=$res_data_artist['home_page']?></small>
                                        </a>
                                    </div>
                                    <!-- End Tags -->
                                    <!-- # of Comments -->
                                    <div class="blog-post-details-item blog-post-details-item-left blog-post-details-item-last comments-icon">
                                        <a href="">
                                            <i class="fa fa-comments"></i> <?php echo count($this->M_blog->getcomment_blog($blog['id'])) ?> Comments
                                        </a>
                                    </div>
                                    <!-- End # of Comments -->
                                </div>
                            </div>
                            <!-- End Blog Item Header -->
                            <!-- Blog Item Body -->
                            <div class="blog">
                                <div class="clearfix"></div>
                                <div class="blog-post-body row margin-top-15">
                                    <div class="col-md-5">
                                        <img class="pull-left img-responsive" src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" alt="<?=$res_data_artist['home_page']?>">
                                    </div>
                                    <div class="col-md-7">
                                        <p><?php 
                                                $text = strip_tags($blog['content']);
                                                $desLength = strlen($text);
                                                $stringMaxLength = 550;
                                                if ($desLength > $stringMaxLength) {
                                                    $des = substr($text, 0, $stringMaxLength);
                                                    $text = $des.'...';
                                                    echo $text;
                                                } else {
                                                    echo $blog['content'];
                                                } ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Blog Item Body -->
                        </div>
                        <!-- End Blog Item -->
                        <!-- Blog Post -->
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
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

   <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Pie Chart -->
    <script src="<?php echo base_url()?>/assets/epk/template3_new/js/easyPieChart.js"></script>
    <!-- Jappear js -->
    <script src="<?php echo base_url()?>/assets/epk/template3_new/js/jquery.appear.js"></script>
    <!-- Pie Chart -->
    <!-- Theme JavaScript -->
    <script src="<?php echo base_url()?>/assets/epk/template3_new/js/customar.js"></script>
    <script src="<?php echo base_url()?>/assets/epk/template3_new/js/jquery.hover3d.js"></script>
    <script>
    $(document).ready(function() {
        $(".project").hover3d({
            selector: ".project__card",
            shine: false,
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
        $end = $("#section4 .tab-pane").last();
        $first = $("#section4 .tab-pane").last();
        if($end== $first){
            $("#right-button").hide();
            $(".#left-button").hide();
        }
        $("#left-button").click(function(event){
           
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

        $("#right-button").click(function (event) {
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
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
        (function($){
        $(window).load(function(){
            $("body").mCustomScrollbar({theme:"minimal-dark"});
            $(".photo_max_height, .blog_max_height, .press_max_height, .event_max_height").mCustomScrollbar({theme:"minimal-dark"});
        });
    })(jQuery);
    </script>
</body>

</html>
