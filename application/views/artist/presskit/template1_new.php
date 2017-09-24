<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php echo $user_data['firstname']?>" />
    <meta property="og:url" content="<?php echo base_url().'epk/'.$user_data['home_page']?>" />
    <meta property="og:description"        content="<?php echo $res_data_artist['bio']?>" />
    <meta property="og:image" content="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $user_data['firstname']?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/template3/epk3.css">
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/epk/template3/magnific-popup.css">

    <!--ninjaVideoPlugin.js is required only when the slider contains video or audio.-->
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/template1_new/epk_new1.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
    <style type="text/css">
    .tab-content .previous{ 
     display:inline;
     float:left;
     margin-left:350px;
     text-decoration:none;
 } 

 .tab-content .next{ 
     display:inline;
     float:right;
     margin-right:350px;
     text-decoration:none;
 }
        .infro-img img {
            transition: all 0.7s ease 0s;       
        }
        .infro-img img:hover { 
            opacity: 0.7;
            transform: scale(1.2);
            transition: all 0.7s ease 0s;
        }
        .modal {
            color: black;
        }
        .easypiechart {
          display: inline-block;
          position: relative;
          text-align: center;
          margin: 5px auto;
    }

.easypiechart .pie-percent {
  display: inline-block;
  line-height: 100%;
  font-size: 40px;
  font-weight: 300;
  color: #95a2a9;
}

.easypiechart .pie-percent:after {
  /*content: 's';*/
  margin-left: 0.1em;
  font-size: .6em;
}

.easypiechart canvas {
  position: absolute;
  top: 0;
  left: 0;
}
/*-- blog --*/
.list-group {border-radius: 0;}
.list-group .list-group-item {background-color: transparent;overflow: hidden;border: 0;border-radius: 0;padding: 0 16px;}
.list-group .list-group-item .row-picture,
.list-group .list-group-item .row-action-primary {float: left;display: inline-block;padding-right: 16px;padding-top: 8px;}
.list-group .list-group-item .row-picture img,
.list-group .list-group-item .row-action-primary img,
.list-group .list-group-item .row-picture i,
.list-group .list-group-item .row-action-primary i,
.list-group .list-group-item .row-picture label,
.list-group .list-group-item .row-action-primary label {display: block;width: 56px;height: 56px;}
.list-group .list-group-item .row-picture img,
.list-group .list-group-item .row-action-primary img {background: rgba(0, 0, 0, 0.1);padding: 1px;}
.list-group .list-group-item .row-picture img.circle,
.list-group .list-group-item .row-action-primary img.circle {border-radius: 100%;}
.list-group .list-group-item .row-picture i,
.list-group .list-group-item .row-action-primary i {background: rgba(0, 0, 0, 0.25);border-radius: 100%;text-align: center;line-height: 56px;font-size: 20px;color: white;}
.list-group .list-group-item .row-picture label,
.list-group .list-group-item .row-action-primary label {margin-left: 7px;margin-right: -7px;margin-top: 5px;margin-bottom: -5px;}
.list-group .list-group-item .row-content {display: inline-block;width: calc(100% - 92px);min-height: 66px;}
.list-group .list-group-item .row-content .action-secondary {position: absolute;right: 16px;top: 16px;}
.list-group .list-group-item .row-content .action-secondary i {font-size: 20px;color: rgba(0, 0, 0, 0.25);cursor: pointer;}
.list-group .list-group-item .row-content .action-secondary ~ * {max-width: calc(100% - 30px);}
.list-group .list-group-item .row-content .least-content {position: absolute;right: 16px;top: 0px;color: rgba(0, 0, 0, 0.54);font-size: 14px;}
.list-group .list-group-item .list-group-item-heading {color: rgba(0, 0, 0, 0.77);font-size: 20px;line-height: 29px;}
.list-group .list-group-separator {clear: both;overflow: hidden;margin-top: 10px;margin-bottom: 10px;}
.list-group .list-group-separator:before {content: "";width: calc(100% - 90px);border-bottom: 1px solid rgba(0, 0, 0, 0.1);float: right;}

.bg-profile{background-color: #3498DB !important;height: 150px;z-index: 1;}
.bg-bottom{height: 100px;margin-left: 30px;}
.img-profile{display: inline-block !important;background-color: #fff;border-radius: 6px;margin-top: -50%;padding: 1px;vertical-align: bottom;border: 2px solid #fff;-moz-box-sizing: border-box;box-sizing: border-box;color: #fff;z-index: 2;}
.row-float{margin-top: -40px;}
.explore a {color: green; font-size: 13px;font-weight: 600}
.twitter a {color:#4099FF}
.img-box{box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23);border-radius: 2px;border: 0;}
.blog-area{
    margin-bottom:10px;
}
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/amp/css/jplayer.blue.monday.css">
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.jplayer.js"> </script>   
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jplayer.playlist.js"> </script>   
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/jquery.redirect.js"> </script>   
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/setting.epk.js"> </script>    
    <script type="text/javascript">AMP_Load_data('<?=$user_id?>', '<?=$affiliatesId?>', '<?=$albumIds?>');</script>
  </head>
  <body class="bkimage">
    <div class="container-fluid" >
        <div class="container-fluid" >
            <div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid black; background-image: url('../assets/images/concert-smoke-stage-audience-applause-the-darkness-the-crowd-resized.jpg');background-position: 50% 50%;padding: 25px;padding-right: 25px" >
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <h1 class="media-heading tp-heading text-center"><strong><?php echo $res_data_artist['artist_name']?></strong></h1>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 ">
                    <div class="pull-right thumb">
                        <?php if ($photo != 'notfound') { ?>
                           <img class="img-responsive img-thumbnail" width="400" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" />    
                        <?php } else {     ?>
                            <img class="img-responsive img-thumbnail" width="400" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px">
                <!-- Navigation -->
                <nav class="navbar navbar-inverse">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
                                <a class="page-scroll" data-toggle="pill" href="#section6">Bios</a>
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
                    
                
                </nav>
                <div class="container-fluid max_height450" >
                    <div class="tab-content">
                        <div id="section1" class="tab-pane fade in active ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h1 class="text-center"><a  href="" class="link-effect link-effect-20 tp-title"><span data-hover="INFO" class="tp-title">INFO</span></a></h1>
                                <div class="tile-widget">
                                    <!-- col -->
                                    <div class="col-md-4  pull-left">
                                    <?php 
                                        if ($epk_display_info->age_break_down_display == 'on') {
                                    ?>
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
                                        <?php 
                                    }?>
                                    </div>
                                    
                                    
                                    <div class="col-md-7">
                                        <div class="media mb-20">
                                            <div class="media-body">
                                                <h3 class="media-heading mb-0"><strong><?php echo $res_data_artist['artist_name']?></strong></h3>
                                                 
                                                <div class="col-md-12">
                                                    <table class="table table-condensed">
                                                        <tr>
                                                            <td>Fans :</td>
                                                            <td> <i class="fa fa-heart-o"></i> <?=$num_fans?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Comments :</td>
                                                            <td><i class="fa fa-comment-o"></i> <?=$num_comments?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>About: </td>
                                                            <td><?php custom_echo_html($customize['epk_bio'], 300)?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Genre:</td>
                                                            <td><?php echo $genre['name'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Members:</td>
                                                            <td><?php
                                                               foreach ($groups_member as $member) {
                                                                   echo $member['name_member'].' - '.$member['contribution'];
                                                                   if (!empty($member['contribution2'])) {
                                                                       echo '/'.$member['contribution2'];
                                                                   }
                                                                   if ($member != end($groups_member)) {
                                                                       echo ',';
                                                                   }
                                                               }
                                                               ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rating:</td>
                                                            <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                    <!-- /col -->
                                                    <!-- col -->
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /col -->
                                </div>
                           
                            </div>
                        </div>
                         <?php 
                        if ($data_json->photo == 'on') {
                            ?>
                        <div id="section2" class="tab-pane fade">
                           <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="PHOTO" class="tp-title">Gallery</span></a></h1>
                            <div class="col-md-12" data-lightbox="gallery">
                                    <?php  
                                    if (!empty($photos)) {
                    ?>
                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                    <?php
                                    for ($i = 0; $i <= count($photos);++$i) {
                                        if (!empty($photos[$i])) {
                                            ?>
                                         <!-- col -->
                                        <div class="col-md-3 col-sm-6 padding-10 photo-epk4 infro-img">
                                            <a href="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id']; ?>/photo/<?php echo $photos[$i]['filename']; ?>"  data-lightbox="gallery-item">
                                                <img  src="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id']; ?>/photo/<?php echo $photos[$i]['filename']; ?>" alt="<?php echo $photos[$i]['caption']; ?>" class="img-responsive img-thumbnail " style="width: 250px;height: 250px; margin-bottom:20px;">
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
                        
                        <?php 
                }
                if ($data_json->stats == 'on') {
                ?>
                    <div id="section3" class="tab-pane fade">
                        <div class="container ">
                                <div class="row">
                                    <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20 tp-title"><span data-hover="STATS" class="tp-title">STATS</span></a></h1>
                                    <div class=" col-lg-12 col-md-12 col-sm-12 text-center">
                                        
                                    </div>
                                        <div class=" col-lg-12 col-md-12 col-sm-12">
                                        <?php if($epk_display_info->song_counts)
                                        { ?> 
                                        <div class="col-md-4 col-sm-6 col-xs-12 field txcent">
                                            <div class="legend text-center">
                                                 <div class="easypiechart animate" data-percent="<?=$num_songs?>" data-size="180" data-scale-color="false" data-bar-color="#1693A5" data-line-cap="round" data-line-width="5" style="width:180px;">
                                                    <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$num_songs?></span></div>
                                                </div>
                                            </div>
                                           <span>Songs Counts</span>
                                        </div>
                                        <?php } if($epk_display_info->video_counts) {?>
                                        <div class="col-md-4 col-sm-6 col-xs-12 txcent">
                                            <div class="legend text-center">
                                                <div class="easypiechart animate" data-percent="<?=$num_video?>" data-size="180" data-scale-color="false" data-bar-color="#4D17E2" data-line-cap="round" data-line-width="5" style="width:180px;">
                                                    <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$num_video?></span></div>
                                                </div>
                                            </div>
                                            <span>Video Counts</span>
                                        </div>
                                        <?php } if($epk_display_info->blog_counts) {?>
                                        <div class="col-md-4 col-sm-6 col-xs-12 txcent">
                                            <div class="legend">
                                                <div class="easypiechart animate" data-percent="<?=$num_blogs?>" data-size="180" data-scale-color="false" data-bar-color="#FFFF11" data-line-cap="round" data-line-width="5" style="width:180px;">
                                                    <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$num_blogs?></span></div>
                                                </div>
                                            </div>
                                            <span>Blog Counts</span>
                                        </div>
                                        <?php } if($epk_display_info->fan_counts) {?>
                                        <div class="col-md-4 col-sm-6 col-xs-12 txcent">
                                            <div class="legend">
                                                <div class="easypiechart animate" data-percent="<?=$num_fans?>" data-size="180" data-scale-color="false" data-bar-color="#00F985" data-line-cap="round" data-line-width="5" style="width:180px;">
                                                    <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$num_fans?></span></div>
                                                </div>
                                            </div>
                                            <span>Fans Counts</span>
                                        </div>
                                        <?php } if($epk_display_info->comments_counts) {?>
                                        <div class="col-md-4 col-sm-6 col-xs-12 txcent">
                                            <div class="legend">
                                                <div class="easypiechart animate" data-percent="<?=$num_comments?>" data-size="180" data-scale-color="false" data-bar-color="#FD20EE" data-line-cap="round" data-line-width="5" style="width:180px;">
                                                    <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$num_comments?></span></div>
                                                </div>
                                            </div>
                                            <span>Comments Counts</span> 
                                        </div>
                                        <?php } if($epk_display_info->show_counts) {?>
                                        <div class="col-md-4 col-sm-6 col-xs-12 txcent">
                                            <div class="legend">
                                                <div class="easypiechart animate" data-percent="<?=$num_events?>" data-size="180" data-scale-color="false" data-bar-color="#FD20EE" data-line-cap="round" data-line-width="5" style="width:180px;">
                                                    <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$num_events?></span></div>
                                                </div>
                                            </div>
                                            <span>Events Counts</span> 
                                        </div>
                                        <?php } ?>
                                        <div class="col-md-4 col-sm-6 col-xs-12 txcent">
                                            <div class="legend">
                                                <div class="easypiechart animate" data-percent="<?php if (empty($view_tats)){echo '0';} else {echo $view_tats['view'];} ?>" data-size="180" data-scale-color="false" data-bar-color="#FD20EE" data-line-cap="round" data-line-width="5" style="width:180px;">
                                                    <div class="pie-percent custom-font" style="line-height: 170px;"><span><?php if (empty($view_tats)){echo '0';} else {echo $view_tats['view'];} ?></span></div>
                                                </div>
                                            </div>
                                            <span>Views</span> 
                                        </div>
                                    </div>
                                    <br/>
                                    
                                </div>
                            </div>
                        </div>
                        <?php } 
                            if ($data_json->video == 'on') {?>
                        <div id="section4" class="tab-pane fade">
                            <div class="video-content">
                                <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="VIDEOS" class="tp-title">VIDEOS</span></a></h1>
                                <div class="video col-md-8 col-md-offset-2 col-sm-12 col-xs-12 relative">
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
             
                                        }  ?> 
                        
                    </div>
                    <a class="left carousel-control" id="left-button" href="#myCarousel" data-slide="prev" style="overflow: hidden;position: absolute;cursor: pointer;width: 40px;height: 40px;left: 10%;top: 50%;margin-top: -16px;display:block;border-radius: 100% 100%;background-color: gray;"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" id="right-button" href="#myCarousel" data-slide="next" style="overflow: hidden;position: absolute;cursor: pointer;width: 40px;height: 40px;right: 10%;top: 50%;margin-top: -16px;display:block;border-radius: 100% 100%;background-color: gray;"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                                    
                          <?php } ?>           
                            </div>
                            </div>
                        </div>
                        <?php } if ($data_json->song == 'on') {?>
                        <div id="section5" class="tab-pane fade">
                            <div class="container">
                                <div class="row song-content">
                                    <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="SONGS">SONGS</span></a></h1>
                                    <div class="col-md-3">
                                        
                                    </div>
                                    <div class="col-md-6">
                                       
                                        <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <div id="section6" class="tab-pane fade">
                            <div class="container">
                                <div class="row">
                                    <h1 class="text-center"><a style="font-size: 35px;" href="" class="link-effect link-effect-20"><span data-hover="BIOS" class="tp-title">BIO</span></a></h1>
                                    <div class="col-md-4" >
                                          <img width="300" src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" alt="" class="img-responsive img-thumbnail mb-20">
                                    </div>
                                    <div class="col-md-8">
                                        <h2 class="custom-font mb-5"><span class="label label-success">Bios</span></h2>
                                        <p class="short-desc text-sm text-default lt mb-20"><?php echo $epk_bio?></p>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <?php 
    if ($data_json->press == 'on') {
        ?>
                        <div id="section7" class="tab-pane fade">
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
                                                    if($press) {
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

                                                    } 
                                                     }?>
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
                        </div>
                        <?php } if ($data_json->show == 'on') {?>
                        <div id="section8" class="tab-pane fade">
                            <h1 class="tp-title text-center">Shows</h1>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                            
                         <?php foreach ($events as $event) {
                            ?>
                            <?php if (!empty($event['event_banner'])) {
                                $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
                                } else {
                                    $url_image = base_url().'assets/images/icon/manager_git_event.png';
                                } ?>
                                    
                                 <div class="col-sm-6 col-md-4 col-xs-12">
                                    <img class="img img-responsive img-rounded" src="<?php echo $url_image; ?>"  width="304" height="236"/>
                                </div>
                                <div class="col-sm-6 col-md-8 col-xs-12">
                                    <div class="text-center"><strong><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></strong></div>
                                    <table class="table table-responsive">
                                        <tr>
                                            <td><strong>Location:</strong></td>
                                            <td><?php custom_echo_html($event['location'], 400); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Start:</strong></td>
                                            <td><?php custom_echo_html($event['event_start_date'], 400); ?> </td>
                                        </tr>
                                        <tr>
                                            <td><strong>To:</strong></td>
                                            <td><?php custom_echo_html($event['event_end_date'], 400); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Capacity:</strong></td>
                                            <td><?php custom_echo_html($event['capacity'], 400); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            <?php 
                            } ?>
                             </div>
                        </div>
                                    
                          
                        <?php } ?>
                        <div id="section9" class="tab-pane fade">
                        <div class="container">
                        <?php foreach ($epk_blogs as $key => $blog) { 
                                
                            ?>
                            <div class="row">
                            <div class="col-xs-12  col-md-6">
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                <a href="#">
                                    <img src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>" class="img-responsive img-box img-thumbnail"> 
                                </a>
                            </div> 
                            <div class="col-xs-12 col-sm-9 col-md-9">
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
                                                            <small><?=$res_data_artist['home_page']?></small>
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
                                    <?php
                        } ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
<footer >
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
  
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/epk/template3/magnific-popup.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/agency.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/cbpAnimatedHeader.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>
<!-- Main slider JS script file -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mightyslider.min.js"></script>

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
<script src="<?=base_url()?>assets/js/easypiechart/jquery.easypiechart.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.resize.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.orderBars.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.stack.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.pie.min.js"></script>
<script >
    $(".easypiechart").easyPieChart({
        barColor: $(this).attr("data-bar-color")
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
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
        (function($){
        $(window).load(function(){
            console.log("I worked");
            $("body").mCustomScrollbar({theme:"minimal-dark"});
            $(".max_height450").mCustomScrollbar({theme:"minimal-dark"});
        });
    })(jQuery);
    </script>
    
    
  </body>
</html>