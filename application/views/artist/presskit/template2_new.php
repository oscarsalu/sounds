<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$epk_bio?>">
    <meta name="author" content="<?php echo $user_data['home_page']?>">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $user_data['home_page']?>" />
    <meta property="og:url" content="<?php echo base_url().'epk/'.$user_data['home_page']?>" />
    <meta property="og:description"  content="<?=$epk_bio?>" />
    <meta property="og:image" content="http://staging2-99s.dev/uploads/205/photo/avatar.png" />
    <meta name="twitter:title" content="Test Twitter" />
    <meta name="twitter:description" content="<?=$epk_bio?>" />
    <meta name="twitter:domain" content="<?php echo base_url()?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="<?=$avata?>" />
    <title><?=$res_data_artist['home_page']?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>/assets/epk/template2_new/template_epk_2.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/amp/css/jplayer.blue.monday.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <style type="text/css">
        .modal {
            color: black;
        }
        .max_height550{
            max-height: 650px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
    </style>
    <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/amp/css/jplayer.blue.monday.css">
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.jplayer.js"> </script>   
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jplayer.playlist.js"> </script>   
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.redirect.js"> </script>   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/setting.epk.js"> </script>    
    <script type="text/javascript">AMP_Load_data('<?=$user_id?>', '<?=$affiliatesId?>', '<?=$albumIds?>');</script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url().$res_data_artist['home_page']?>"><?=$res_data_artist['home_page']?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#info" class="scroll">INFO </a>
                    </li>
                <?php  if ($data_json->photo == 'on') {
                 ?>
                    <li>
                        <a href="#photo" class="scroll">PHOTO</a>
                    </li>
                    <?php 
                       } if ($data_json->stats == 'on') {
                    ?>
                    <li>
                        <a href="#stats" class="scroll">STATS</a>
                    </li>
                    <?php }
                     if ($data_json->video == 'on') {
                    ?>
                    <li>
                        <a href="#video" class="scroll">VIDEO</a>
                    </li>
                <?php 
                    } if ($data_json->song == 'on') {
                ?>
                    <li>
                        <a href="#songs" class="scroll">SONGS</a>
                    </li>
                <?php 
                    }
                    ?>
                    <li>
                        <a href="#blos" class="scroll">BIO</a>
                    </li>
                   
                    <?php 
                    if ($data_json->press == 'on') {
                ?>
                    <li>
                        <a href="#press" class="scroll">PRESS</a>
                    </li>
                <?php }?>
                 <?php if ($data_json->show == 'on') {
                ?>
                    <li>
                        <a href="#shows" class="scroll">SHOWS</a>
                    </li>
                <?php 
                    }
                ?>
                
                    <li>
                        <a href="#blog" class="scroll">BLOG</a>
                    </li>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Full Page Image Background Carousel Header -->
    
    <div id="Wrapper">
     <!-- Footer -->
        <footer >
    <div class="container">
            <div class="row text-center">
                <div class="col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0 mdarea  ">
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
                     <a href="#" class="icon picture download"  data-toggle="modal" data-target="#video_modal" id="download_video"><i class="fa fa-video-camera"></i> Videos </a>
                    <?php 
                     }
                     if ($data_json->dw_pdf == 'on') {
                     ?>
                     <a href="<?php echo base_url('epk').'/'.$res_data_artist['home_page'].'?action=pdf'?>" id="download_pdf" ><i class="fa fa-file-pdf-o"></i> .pdf </a>
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
       
        <!-- info code -->
        <section id="info" class="welcome-tp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Welcome</h2>
                        <hr class="primary">
                        <span><?=$customize['epk_bio']?></span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="wel-grids">
                        <div class="col-md-3 wel-grid">
                        <?php if ($photo != 'notfound') { ?>
                            
                           <img src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" width="400" height="200"   alt="" />
                        <?php } else {     ?>
                            <img class="img-responsive img-thumbnail" height="200" width="400" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                        <?php } ?>
                            <!--  -->
                        </div>
                        <div class="col-md-6 wel-grid1">
                        <?php
                            if ($data_json->stats == 'on') {
                        ?>
                            <div class="wel-left">
                                <?php if($epk_display_info->song_counts)
                                { ?> 
                                <h4><?=$num_songs?></h4>
                                <h5>Songs Count</h5>
                                <?php }?>
                            </div>
                            <div class="wel-left">
                                <?php if($epk_display_info->video_counts)
                                { ?>
                                <h4><?=$num_video?></h4>
                                <h5>Video Counts</h5>
                                <?php }?>
                            </div>
                            <div class="wel-left">
                                <?php if($epk_display_info->fan_counts) {?>
                                <h4><?=$num_fans?></h4>
                                <h5>Fans Counts</h5>
                                 <?php }?>
                            </div>
                            
                            <div class="clearfix"></div>
                            <?php
                            }
                        ?>
                        </div>
                        
                        <div class="col-md-3 wel-grid">
                            <img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" width="400" height="200" alt="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- photo code -->
        <?php 
            if ($data_json->photo == 'on') {
        ?>
        <section id="photo" class="back-image max_height550">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 button-height text-center">
                        <h2 class="section-heading">Photo</h2>
                        <hr class="primary">
                        
                    </div>
                    <?php  
                        if (!empty($photos)) {
                        for ($i = 0; $i < count($photos);$i++) {
                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="thumbnail catbox">
                            <img src="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id']; ?>/photo/<?php echo $photos[$i]['filename'];?>" class="img-responsive" style="height: 200px;"  alt="<?php echo $photos[$i]['caption']; ?>">
                        </div>
                    </div>
                    <?php }
                    } ?>
                   
                </div>
            </div>
        </section>
        <?php } ?>

         <!-- stats code -->
        <?php if ($data_json->stats == 'on') {
                ?>
        <section id="stats" class="button-height max_height550">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 button-height text-center">
                        <h2 class="section-heading">Stats</h2>
                        <hr class="primary">
                    </div>
                    <div class="right_col" role="main">
                        <!-- top tiles -->
                        <!-- <div class="col-xs-12 col-md-4">
                            <div class="panel status panel-warning">
                                <div class="panel-heading">
                                    <h1 class="panel-title text-center">17</h1>
                                </div>
                                <div class="panel-body status-area text-center">
                                    <h4><strong>Send Mail</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="panel status panel-success">
                                <div class="panel-heading">
                                    <h1 class="panel-title text-center">2</h1>
                                </div>
                                <div class="panel-body status-area text-center">
                                    <h4> <strong>Share Twitter</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="panel status panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title text-center">18</h1>
                                </div>
                                <div class="panel-body status-area text-center">
                                    <h4><strong>Share Facebook</strong></h4>
                                </div>
                            </div>
                        </div> -->
                        <div class="row tile_count">
                            <?php if($epk_display_info->song_counts)
                            { ?> 
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <span class="count_top"><i class="fa fa-music"></i> Songs Counts</span>
                                <div class="count"><?=$num_songs?></div>
                            </div>
                            <?php } if($epk_display_info->blog_counts) {?>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <span class="count_top"><i class="fa fa-rss"></i> Blogs Counts</span>
                                <div class="count"><?=$num_blogs?></div>
                            </div>
                            <?php } ?>
                            
                            <?php if($epk_display_info->fan_counts) {?>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <span class="count_top"><i class="fa fa-users"></i> Fans Counts</span>
                                <div class="count"><?=$num_fans?></div>
                            </div>
                            <?php } if($epk_display_info->comments_counts) {?>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <span class="count_top"><i class="fa fa-comments"></i> Comments Counts</span>
                                <div class="count"><?=$num_comments?></div>
                            </div>
                             <?php } if($epk_display_info->show_counts) {?>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <span class="count_top"><i class="fa fa-calendar-o"></i> Events Counts</span>
                                <div class="count"><?=$num_events?></div>
                            </div>
                            <?php } ?>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <span class="count_top"><i class="fa fa-calendar-o"></i> Profile Views</span>
                                <div class="count"><?php if (empty($view_tats)){echo '0';} else {echo $view_tats['view'];} ?></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
        </section>
        <?php
        }
        ?>

        <!-- Video codes -->
        <?php 
            if ($data_json->video == 'on') {
        ?>
            <section id="video" class="back-image max_height550">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 button-height text-center">
                            <h2 class="section-heading">Video</h2>
                            <hr class="primary">
                        </div>
                        <div class="col-md-7 col-md-offset-3 col-sm-12 ">
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
                    </div>
                </div>
            </section>
        <?php }?>
        <!-- songs codes -->
        <section id="songs" class="button-height ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 button-height text-center">
                        <h2 class="section-heading">Songs</h2>
                        <hr class="primary">
                    </div>
                    
                    <div class="col-md-6 col-md-offset-3 col-sm-12 ">
                       
                        <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player"> </div>
                    </div>
                </div>
            </div>
        </section>
            <!--Biography codes-->
        <section id="blos" class="button-height back-image max_height550">
            <div class="container">
                <div class=" col-md-12 col-lg-12 text-center">
                    <h2 class="section-heading">Biography</h2>
                    <hr class="primary">
                </div>
                <div class="biography-grids">
                    <div class="col-md-4 col-sm-6 col-xs-12 biography-grid">
                        <img  style="height:250px;" src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" class="img-responsive" alt="" />
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12  biography-grid">
                        <h4>Who are we?</h4>
                        <p><?=$epk_bio?></p>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
       
        <!--Shows codes-->
        <?php if ($data_json->show == 'on') {?>
        <section id="shows" class="button-height max_height550">
            <div class="container">
                <div class="row">
                    <div class=" col-md-12 col-lg-12 text-center">
                        <h2 class="section-heading">Shows</h2>
                        <hr class="primary">
                    </div>
                    <div class=" col-xs-12  col-sm-12 ">
                        <ul class="event-list">
                        <?php if(!empty($events)) {
                        foreach ($events as $event) {
                            ?>
                        <?php if (!empty($event['event_banner'])) {
                            $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
                            } else {
                                $url_image = base_url().'assets/images/icon/manager_git_event.png';
                            } ?>
                            <li>
                                <time datetime="<?=$event['event_start_date']?>">
                                    <span class="day"><?php echo date('d',strtotime($event['event_start_date']));?></span>
                                    <span class="month"><?php echo date('M',strtotime($event['event_start_date']));?></span>
                                    <span class="year">2014</span>
                                    <span class="time">ALL DAY</span>
                                </time>
                                <img alt="<?=$event['event_title']?>" src="<?php echo $url_image; ?>" />
                                <div class="info">
                                    <h2 class="title"><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></h2>
                                    <p class="desc"><?php custom_echo_html($event['location'], 400); ?></p>
                                    <ul>
                                        <li style="width:33%;"><span >To Date: </span> <?php echo date('d/M/Y',strtotime($event['event_end_date']));?> </li>
                                        <li style="width:34%;"><span>Capacity:</span>
                                         <?php custom_echo_html($event['capacity'], 400); ?></li>
                                        <li style="width:33%;"><span>Star rating :</span><?php custom_echo_html($event['sum_star'], 400); ?></li>
                                    </ul>
                                </div>
                                
                            </li>
                        <?php }
                        } ?>    
                            
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
            }
        ?>
   
        <!--press codes-->
        <?php 
            if ($data_json->press == 'on') {
        ?>
        <section id="press" class="button-height back-area back-image max_height550">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Press</h2>
                        <hr class="primary">
                        
                    </div>
                    <?php
                        if($press) {
                        foreach ($press as $row) {
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="opacity: 0.7">

                        <div class="panel">
                            <div class="panel-heading">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h3 class="pull-left"><?php echo $row['name']?></h3>

                                        </div>
                                        <div class="col-sm-3">
                                            <h4 class="pull-right">
                                                <small><span>Author : <?php echo $row['author']?> </span></small>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php echo $row['quote']?>
                            </div>
                        </div>
                    </div>
                    <?php  } }?>
                </div>
            </div>
        </section>
        <?php } ?>
         <!--Blog codes-->
        <section id="blog" class="button-height max_height550">
            <div class="container">
                <div class="row">
                    <div class=" col-md-12 col-lg-12 text-center">
                        <h2 class="section-heading">Blog</h2>
                        <hr class="primary">
                    </div>
                    <div class="container">
                    <?php
                    if($epk_blogs){
                     foreach ($epk_blogs as $key => $blog) { 
                    
                    ?>
                        <div class="row ">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>" class="img-responsive img-box img-thumbnail">
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-9">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <div class="row-picture">
                                            <a href="<?php echo base_url().$res_data_artist['home_page']?>" title="<?=$res_data_artist['home_page']?>">
                                                <img class="circle img-thumbnail img-box" src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" >
                                            </a>
                                        </div>
                                        <div class="row-content">
                                            <div class="list-group-item-heading">
                                                <a href="<?php echo base_url().$res_data_artist['home_page']?>" title="<?=$res_data_artist['home_page']?>">
                                                    <small><?=$res_data_artist['artist_name']?></small>
                                                </a>
                                            </div>
                                            <small>
                                                        <i class="glyphicon glyphicon-time"></i> <?php echo date('M d, Y', $blog['time'])?> 
                                                        
                                                    </small>
                                        </div>
                                    </div>
                                </div>
                                <h4><a href="<?php echo base_url('artist/allblogs').'/'.$blog['user_id'].'/'.$blog['id']?>"><?=$blog['title'] ?></a></h4>
                                <p><?php 
                                                $text = strip_tags($blog['content']);
                                                $desLength = strlen($text);
                                                $stringMaxLength = 250;
                                                if ($desLength > $stringMaxLength) {
                                                    $des = substr($text, 0, $stringMaxLength);
                                                    $text = $des.'...';
                                                    echo $text;
                                                } else {
                                                    echo $blog['content'];
                                                } ?> </p>
                            </div>
                        </div>
                        <br/>
                        <?php } }?>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
     <!--    <footer >
    <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0 mdarea  ">
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
                     <a href="#" class="icon picture download"  data-toggle="modal" data-target="#video_modal" id="download_video"><i class="fa fa-video-camera"></i> Videos </a>
                    <?php 
                     }
                     if ($data_json->dw_pdf == 'on') {
                     ?>
                     <a href="<?php echo base_url('epk').'/'.$res_data_artist['home_page'].'?action=pdf'?>" id="download_pdf" ><i class="fa fa-file-pdf-o"></i> .pdf </a>
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
</footer> -->
        </div>
        <!-- /.container -->
    </div>
    <!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->
     
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- script for play-list -->
    
    
    <!-- Script to Activate the Carousel -->
    <script>
    
    </script>
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
<div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="myModalVideo" aria-hidden="true">
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
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
        (function($){
        $(window).load(function(){
            console.log("I worked");
            $("body").mCustomScrollbar({theme:"minimal-dark"});
            $(".max_height550").mCustomScrollbar({theme:"minimal-dark"});
        });
    })(jQuery);
    </script>

</body>

</html>
