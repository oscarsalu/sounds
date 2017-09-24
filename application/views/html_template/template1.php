<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>William</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
     <!-- Fonts -->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/html_template/template1/style.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

    
    $("#jquery_jplayer_3").jPlayer({
        ready: function () {
            $(this).jPlayer("setMedia", {
                title: "Finding Nemo Teaser",
                m4v: "http://www.jplayer.org/video/m4v/Finding_Nemo_Teaser.m4v",
                ogv: "http://www.jplayer.org/video/ogv/Finding_Nemo_Teaser.ogv",
                webmv: "http://www.jplayer.org/video/webm/Finding_Nemo_Teaser.webm",
                poster: "http://www.jplayer.org/video/poster/Finding_Nemo_Teaser_640x352.png"
            });
        },
        play: function() { // To avoid multiple jPlayers playing together.
            $(this).jPlayer("pauseOthers");
        },
        swfPath: "../../dist/jplayer",
        supplied: "webmv, ogv, m4v",
        cssSelectorAncestor: "#jp_container_3",
        globalVolume: true,
        useStateClassSkin: true,
        autoBlur: false,
        smoothPlayBar: true,
        keyEnabled: true
    });
    new jPlayerPlaylist({
        jPlayer: "#jquery_jplayer_2",
        cssSelectorAncestor: "#jp_container_2"
    }, [
        {
            title:"Cro Magnon Man",
            mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",
            oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"
        },
        {
            title:"Your Face",
            mp3:"http://www.jplayer.org/audio/mp3/TSP-05-Your_face.mp3",
            oga:"http://www.jplayer.org/audio/ogg/TSP-05-Your_face.ogg"
        },
        {
            title:"Cyber Sonnet",
            mp3:"http://www.jplayer.org/audio/mp3/TSP-07-Cybersonnet.mp3",
            oga:"http://www.jplayer.org/audio/ogg/TSP-07-Cybersonnet.ogg"
        },
        {
            title:"Tempered Song",
            mp3:"http://www.jplayer.org/audio/mp3/Miaow-01-Tempered-song.mp3",
            oga:"http://www.jplayer.org/audio/ogg/Miaow-01-Tempered-song.ogg"
        },
        {
            title:"Hidden",
            mp3:"http://www.jplayer.org/audio/mp3/Miaow-02-Hidden.mp3",
            oga:"http://www.jplayer.org/audio/ogg/Miaow-02-Hidden.ogg"
        },
        {
            title:"Lismore",
            mp3:"http://www.jplayer.org/audio/mp3/Miaow-04-Lismore.mp3",
            oga:"http://www.jplayer.org/audio/ogg/Miaow-04-Lismore.ogg"
        },
        {
            title:"The Separation",
            mp3:"http://www.jplayer.org/audio/mp3/Miaow-05-The-separation.mp3",
            oga:"http://www.jplayer.org/audio/ogg/Miaow-05-The-separation.ogg"
        },
        {
            title:"Beside Me",
            mp3:"http://www.jplayer.org/audio/mp3/Miaow-06-Beside-me.mp3",
            oga:"http://www.jplayer.org/audio/ogg/Miaow-06-Beside-me.ogg"
        },
        
    ], {
        swfPath: "../../dist/jplayer",
        supplied: "oga, mp3",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: false,
        smoothPlayBar: true,
        keyEnabled: true
    });
});
//]]>
</script>
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
                <a class="navbar-brand" href="#">William</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#info" class="scroll">INFO </a>
                    </li>
                    <li>
                        <a href="#photo" class="scroll">PHOTO</a>
                    </li>
                    <li>
                        <a href="#stats" class="scroll">STATS</a>
                    </li>
                   
                    <li>
                     <a href="#songs" class="scroll">SONGS</a>                     
                    </li>
                    <li>
                        <a href="#shows" class="scroll">SHOWS</a>
                    </li>
                    <li>
                        <a href="#blos" class="scroll">BLOS</a>
                    </li>
                    <li>
                        <a href="#press" class="scroll">PRESS</a>
                    </li>
                     <li>
                        <a href="#blog" class="scroll">BLOG</a>
                    </li>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

                    <!-- Full Page Image Background Carousel Header -->
                    <header id="myCarousel" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for Slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <!-- Set the first background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('<?php echo base_url(); ?>assets/html_template/template1/images/ba1.jpg');"></div>
                                <div class="carousel-caption">
                                    <h2>Caption 1</h2>
                                </div>
                            </div>
                            <div class="item">
                                <!-- Set the second background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('<?php echo base_url(); ?>assets/html_template/template1/images/ba2.jpg');"></div>
                                <div class="carousel-caption">
                                    <h2>Caption 2</h2>
                                </div>
                            </div>
                            <div class="item">
                                <!-- Set the third background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('<?php echo base_url(); ?>assets/html_template/template1/images/ba3.jpg');"></div>
                                <div class="carousel-caption">
                                    <h2>Caption 3</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="icon-next"></span>
                        </a>

                    </header>
                <div id="Wrapper">
                   <!-- info code -->
                     <section id="info" class="welcome-tp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <h2 class="section-heading">Welcome</h2>
                                    <hr class="primary">
                                    <span>Lorem ipsum dolor sit amet, ad eos iriure corpora prodesset. Partem timeam at vim, mel veritus accusata ea. Ius ei dicam inciderint, eleifend deseruisse ei mea. Alia dicam eam te, summo exerci ei mei.Ei sea debet choro omittantur. Ea nam quis aeterno, et usu semper senserit.</span>
                                    </div>
                                </div>
                            </div>
                    
                        <div class="container">
                            <div class="row">
                               <div class="wel-grids">
                                        <div class="col-md-3 wel-grid">
                                            <img src="<?php echo base_url(); ?>assets/html_template/template1/images/v1.jpg" title="Designer_girl" class="img-responsive" alt=""/>
                                        </div>
                                        <div class="col-md-6 wel-grid1">
                                            <div class="wel-left">
                                                <h4>13+</h4>
                                                <h5>Age</h5>
                                                <p>Lorem ipsum dolor sit amet, alia honestatis an qui, ne soluta nemore eripuit sed. Falli exerci aperiam ut </p>
                                            </div>
                                            <div class="wel-left">
                                                <h4>25+</h4>
                                                <h5>break</h5>
                                                <p>Lorem ipsum  sit amet, alia honestatis an qui, ne soluta nemore eripuit sed. Falli exerci aperiam ut </p>
                                            </div>
                                            <div class="wel-left">
                                                <h4>45+</h4>
                                                <h5>down</h5>
                                                <p>Lorem ipsum dolor sit amet, alia honestatis an qui, ne soluta nemore eripuit sed. Falli exerci aperiam ut </p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-3 wel-grid">
                                            <img src="<?php echo base_url(); ?>assets/html_template/template1/images/v2.jpg" title="Designer_girl" class="img-responsive" alt=""/>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                            </div>
                        </div>
                    </section>
                    <!-- photo code -->
                    <section id="photo" class="back-image">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 button-height text-center">
                                    <h2 class="section-heading">Photo</h2>
                                    <hr class="primary">
                                    <span>Lorem ipsum dolor sit amet, ad eos iriure corpora prodesset. Partem timeam at vim, mel veritus accusata ea. Ius ei dicam inciderint, eleifend deseruisse ei mea. Alia dicam eam te, summo exerci ei mei.Ei sea debet choro omittantur. Ea nam quis aeterno, et usu semper senserit.</span>
                                </div>
                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail catbox">
                                    <img src="<?php echo base_url(); ?>assets/html_template/template1/images/a3.jpg" alt="">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail catbox">
                                    <img src="<?php echo base_url(); ?>assets/html_template/template1/images/a4.jpg" alt="">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail catbox">
                                    <img src="<?php echo base_url(); ?>assets/html_template/template1/images/a5.jpg" alt="">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail catbox">
                                    <img src="<?php echo base_url(); ?>assets/html_template/template1/images/a2.jpg" alt="">
                                </div>
                            </div>
                        </div>
                      </div>
                        
                    </section>
                    <!-- songs codes -->
                    <section id="songs" class="button-height">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 button-height text-center">
                                    <h2 class="section-heading">Songs</h2>
                                    <hr class="primary">
                                    <span>Lorem ipsum dolor sit amet, ad eos iriure corpora prodesset. Partem timeam at vim, mel veritus accusata ea. Ius ei dicam inciderint, eleifend deseruisse ei mea. Alia dicam eam te, summo exerci ei mei.Ei sea debet choro omittantur. Ea nam quis aeterno, et usu semper senserit.</span>
                                </div>
                            <div class="col-md-6 col-sm-12 barea">
                                    <h3>Video Player</h3>
                                    <div id="jp_container_3" class="jp-video jp-video-270p barea" role="application" aria-label="media player">
                                    <div class="jp-type-single">
                                        <div id="jquery_jplayer_3" class="jp-jplayer"></div>
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
                                                        <button class="jp-play" role="button" tabindex="0">play</button>
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
                                                        <button class="jp-full-screen" role="button" tabindex="0">full screen</button>
                                                    </div>
                                                </div>
                                                <div class="jp-details">
                                                    <div class="jp-title" aria-label="title">&nbsp;</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12  barea">
                                <h3>Audio Player</h3>
                        <div id="jquery_jplayer_2" class="jp-jplayer"></div>
                        <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">
                            <div class="jp-type-playlist">
                                <div class="jp-gui jp-interface">
                                    <div class="jp-controls">
                                        <button class="jp-previous" role="button" tabindex="0">previous</button>
                                        <button class="jp-play" role="button" tabindex="0">play</button>
                                        <button class="jp-next" role="button" tabindex="0">next</button>
                                        <button class="jp-stop" role="button" tabindex="0">stop</button>
                                    </div>
                                    <div class="jp-progress">
                                        <div class="jp-seek-bar">
                                            <div class="jp-play-bar"></div>
                                        </div>
                                    </div>
                                    <div class="jp-volume-controls">
                                        <button class="jp-mute" role="button" tabindex="0">mute</button>
                                        <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                    </div>
                                    <div class="jp-time-holder">
                                        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="jp-playlist">
                                    <ul>
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
                    </section>
                    <!-- stats code -->
                     <section id="stats" class="button-height back-image">
                                <div class="container">
                                <div class="row">
                                 <div class="col-lg-12 button-height text-center">
                                    <h2 class="section-heading">Stats</h2>
                                    <hr class="primary">
                                    <span>Lorem ipsum dolor sit amet, ad eos iriure corpora prodesset. Partem timeam at vim, mel veritus accusata ea. Ius ei dicam inciderint, eleifend deseruisse ei mea. Alia dicam eam te, summo exerci ei mei.Ei sea debet choro omittantur. Ea nam quis aeterno, et usu semper senserit.</span>
                                                    </div>
                            <div class="right_col" role="main">
                              <!-- top tiles -->
                                                                
                                        <div class="col-xs-12 col-md-4">
                                          
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
                                        </div>
                              <div class="row tile_count">
                                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                  <span class="count_top"><i class="fa fa-music"></i> Songs Counts</span>
                                  <div class="count">6</div>
                                  
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                  <span class="count_top"><i class="fa fa-rss"></i> Blogs Counts</span>
                                  <div class="count">1</div>
                                  
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                  <span class="count_top"><i class="fa fa-video-camera"></i> Video Counts</span>
                                  <div class="count green">16</div>
                                 
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                  <span class="count_top"><i class="fa fa-users"></i> Fans Counts</span>
                                  <div class="count">1</div>
                                  
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                  <span class="count_top"><i class="fa fa-comments"></i> Comments Counts</span>
                                  <div class="count">3</div>
                                  
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                  <span class="count_top"><i class="fa fa-calendar-o"></i> Events Counts</span>
                                  <div class="count">3</div>
                                  
                                </div>
                              </div>
                               </div>
                               </div> 
                         </section>
                   
                <!--Shows codes-->
                     <section id="shows" class="button-height">
                        <div class="container">
                            <div class="row">
                                           <div class=" col-md-12 col-lg-12 text-center">
                                            <h2 class="section-heading">Shows</h2>
                                            <hr class="primary">
                                            </div> 
                                              
                               <div class=" col-xs-12  col-sm-12 ">
                                <ul class="event-list">
                                    <li>
                                        <time datetime="2014-07-20">
                                            <span class="day">4</span>
                                            <span class="month">Jul</span>
                                            <span class="year">2014</span>
                                            <span class="time">ALL DAY</span>
                                        </time>
                                        <img alt="Independence Day" src="<?php echo base_url(); ?>assets/html_template/template1/images/pc4.jpg" />
                                        <div class="info">
                                            <h2 class="title">Independence Day</h2>
                                            <p class="desc">United States Holiday</p>
                                             <ul>
                                                <li style="width:33%;">1 <span class="glyphicon glyphicon-ok"></span></li>
                                                <li style="width:34%;">3 <i class="fa fa-question"></i></li>
                                                <li style="width:33%;">103 <span class="fa fa-envelope"></span></li>
                                            </ul>
                                        </div>
                                        <div class="social">
                                            <ul>
                                                <li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
                                                <li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
                                                <li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <time datetime="2014-07-20 0000">
                                            <span class="day">8</span>
                                            <span class="month">Jul</span>
                                            <span class="year">2014</span>
                                            <span class="time">12:00 AM</span>
                                        </time>
                                         <img alt="Unlimited World Red" src="<?php echo base_url(); ?>assets/html_template/template1/images/pc.jpg" />
                                        <div class="info">
                                            <h2 class="title">One Piece Unlimited World Red</h2>
                                            <p class="desc">PS Vita</p>
                                            <ul>
                                                <li style="width:33%;">1 <span class="glyphicon glyphicon-ok"></span></li>
                                                <li style="width:34%;">3 <span class="fa fa-question"></span></li>
                                                <li style="width:33%;">103 <span class="fa fa-envelope"></span></li>
                                            </ul>
                                               
                                            
                                        </div>
                                        <div class="social">
                                            <ul>
                                                <li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
                                                <li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
                                                <li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <time datetime="2014-07-20 2000">
                                            <span class="day">20</span>
                                            <span class="month">Jan</span>
                                            <span class="year">2014</span>
                                            <span class="time">8:00 PM</span>
                                        </time>
                                        <img alt="My 24th Birthday!" src="<?php echo base_url(); ?>assets/html_template/template1/images/pc3.jpg" />
                                        <div class="info">
                                            <h2 class="title">Mouse0270's 24th Birthday!</h2>
                                            <p class="desc">Bar Hopping in Erie, Pa.</p>
                                            <ul>
                                                <li style="width:33%;">1 <span class="glyphicon glyphicon-ok"></span></li>
                                                <li style="width:34%;">3 <span class="fa fa-question"></span></li>
                                                <li style="width:33%;">103 <span class="fa fa-envelope"></span></li>
                                            </ul>
                                        </div>
                                        <div class="social">
                                            <ul>
                                                <li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
                                                <li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
                                                <li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <time datetime="2014-07-31 1600">
                                            <span class="day">31</span>
                                            <span class="month">Jan</span>
                                            <span class="year">2014</span>
                                            <span class="time">4:00 PM</span>
                                        </time>
                                        <img alt="Disney Junior Live On Tour!" src="<?php echo base_url(); ?>assets/html_template/template1/images/pc1.jpg" />
                                        <div class="info">
                                            <h2 class="title">Disney Junior Live On Tour!</h2>
                                            <p class="desc"> Pirate and Princess Adventure</p>
                                             <ul>
                                                <li style="width:33%;">1 <span class="glyphicon glyphicon-ok"></span></li>
                                                <li style="width:34%;">3 <span class="fa fa-question"></span></li>
                                                <li style="width:33%;">103 <span class="fa fa-envelope"></span></li>
                                            </ul>
                                        </div>
                                        <div class="social">
                                            <ul>
                                                <li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
                                                <li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
                                                <li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </section>
                    <!--Biography codes-->
                    <section id="blos" class="button-height back-image">
                        <div class="container">
                         <div class=" col-md-12 col-lg-12 text-center">
                            <h2 class="section-heading">Biography</h2>
                            <hr class="primary">
                            </div> 
                            <div class="biography-grids">
                                <div class="col-md-6 biography-grid">
                                <img src="<?php echo base_url(); ?>assets/html_template/template1/images/s.jpg" class="img-responsive" alt=""/>
                                </div>
                                <div class="col-md-6 biography-grid">
                                    <h4>Who are we?</h4>
                                    <p>Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing metus sit amet. In eu justo a felis faucibus ornare vel id metus. Sed hendrerit enim non justo posuere placerat. Phasellus eget purus vel mauris tincidunt tincidunt. Sed et nibh tortor faucibus pellentesque facilisis.</p>
                                    <ul>
                                        <li>Nam convallis non eros curabitur.</li>
                                        <li> Donec vehicula suscipit oasselus.</li>
                                        <li>Accumasan mauris tellus feugiat.</li>
                                        <li>Sed hendrerit enim non justo.</li>
                                        <li>Nam convallis non eros curabitur.</li>
                                        <li>Nam convallis non eros curabitur.</li>
                                        <li> Donec vehicula suscipit oasselus.</li>
                                        <li>Accumasan mauris tellus feugiat.</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </section>
                     <!--Blog codes-->
                      <section id="blog" class="button-height">
                        <div class="container">
                             <div class="row">
                                            <div class=" col-md-12 col-lg-12 text-center">
                                                <h2 class="section-heading">Blog</h2>
                                                <hr class="primary">
                                            </div> 
                                     <div class="container">
                                    <div class="row "> 
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <a href="#">
                                            <img src="<?php echo base_url(); ?>assets/html_template/template1/images/pc5.jpg" class="img-responsive img-box img-thumbnail"> 
                                        </a>
                                    </div> 
                                    <div class="col-xs-12 col-sm-9 col-md-9">
                                        <div class="list-group">
                                            <div class="list-group-item">
                                                <div class="row-picture">
                                                    <a href="#" title="post">
                                                        <img class="circle img-thumbnail img-box" src="<?php echo base_url(); ?>assets/html_template/template1/images/pc4.jpg" alt="images">
                                                    </a>
                                                </div>
                                                <div class="row-content">
                                                    <div class="list-group-item-heading">
                                                        <a href="#" title="sintret">
                                                            <small>blog post</small>
                                                        </a>
                                                    </div>
                                                    <small>
                                                        <i class="glyphicon glyphicon-time"></i> 3 days ago via <span class="twitter"> <i class="fa fa-twitter"></i> <a target="_blank" href="images/pc4.jpg" alt="image" title="William">@William</a></span>
                                                        
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <h4><a href="#">A concert that we will never forget</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis possimus pariatur necessitatibus cum vitae, dolores, nisi temporibus excepturi fuga unde, eum illo quam nam ad debitis. Dignissimos quae quisquam exercitationem nisi cum earum quia aperiam, excepturi error. Aliquid officiis eveniet, obcaecati blanditiis accusamus excepturi error?.</p>
                                    </div> 
                                </div>
                              <br/>

                                <div class="row"> 
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <a href="#">
                                            <img src="<?php echo base_url(); ?>assets/html_template/template1/images/pc6.jpg" class="img-responsive img-box img-thumbnail"> 
                                        </a>
                                    </div> 
                                    <div class="col-xs-12 col-sm-9 col-md-9">
                                        <div class="list-group">
                                            <div class="list-group-item">
                                                <div class="row-picture">
                                                    <a href="#" title="sintret">
                                                        <img class="circle img-thumbnail img-box" src="<?php echo base_url(); ?>assets/html_template/template1/images/pc1.jpg" alt="image">
                                                    </a>
                                                </div>
                                                <div class="row-content">
                                                    <div class="list-group-item-heading">
                                                        <a href="#" title="post">
                                                            <small>blog post</small>
                                                        </a>
                                                    </div>
                                                    <small>
                                                        <i class="glyphicon glyphicon-time"></i> 1 month ago via <span class="twitter"> <i class="fa fa-twitter"></i> <a target="_blank" href="images/pc2.jpg" alt="image" title="joshan">@joshan</a></span>
                                                       
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <h4><a href="#">A concert that we will never forget</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis possimus pariatur necessitatibus cum vitae, dolores, nisi temporibus excepturi fuga unde, eum illo quam nam ad debitis. Dignissimos quae quisquam exercitationem nisi cum earum quia aperiam, excepturi error. Aliquid officiis eveniet, obcaecati blanditiis accusamus excepturi error?.</p>
                                    </div> 
                                </div>
                                <br/>
                                <div class="row"> 
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        <a href="#">
                                            <img src="<?php echo base_url(); ?>assets/html_template/template1/images/pc6.jpg" class="img-responsive img-box img-thumbnail"> 
                                        </a>
                                    </div> 
                                    <div class="col-xs-12 col-sm-9 col-md-9">
                                        <div class="list-group">
                                            <div class="list-group-item">
                                                <div class="row-picture">
                                                    <a href="#" title="post">
                                                        <img class="circle img-thumbnail img-box" src="<?php echo base_url(); ?>assets/html_template/template1/images/pc3.jpg" alt="post">
                                                    </a>
                                                </div>
                                                <div class="row-content">
                                                    <div class="list-group-item-heading">
                                                        <a href="#" title="post">
                                                            <small>blog post</small>
                                                        </a>
                                                    </div>
                                                    <small>
                                                        <i class="glyphicon glyphicon-time"></i> 1 month ago via <span class="twitter"> <i class="fa fa-twitter"></i> <a target="_blank" href="images/pc2.jpg" alt="images" title="William">@William</a></span>
                                                       
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                            <h4><a href="#">A concert that we will never forget</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis possimus pariatur necessitatibus cum vitae, dolores, nisi temporibus excepturi fuga unde, eum illo quam nam ad debitis. Dignissimos quae quisquam exercitationem nisi cum earum quia aperiam, excepturi error. Aliquid officiis eveniet, obcaecati blanditiis accusamus excepturi error?.</p>
                                       </div> 
                                    </div>  
                                </div>
                            </div> 
                        </div>
                   </section>
                    <!--press codes-->
                        <section id="press" class="button-height back-area back-image">
                            <div class="container">
                              <div class="row">
                                      <div class="col-lg-12 text-center">
                                         <h2 class="section-heading">Press</h2>
                                             <hr class="primary">
                                             <span>Lorem ipsum dolor sit amet, ad eos iriure corpora prodesset. Partem timeam at vim, mel veritus accusata ea. Ius Ea nam quis aeterno, et usu semper senserit.</span>
                                        </div>       
                                     <div class="col-md-12">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <h3 class="pull-left">Upcoming News</h3>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <h4 class="pull-right">
                                                                <small><em>2014-07-30<br>18:30:00</em></small>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat. Duis aute irure dolor in... <a href="#">Read more</a>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>  
                                <!-- Footer -->
                                <footer>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <p>Copyright &copy; Your Website 2016</p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </footer>

                            </div>
                            <!-- /.container -->
                        </div>
                            <!-- jQuery -->
                            <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>

                            <!-- Bootstrap Core JavaScript -->
                            <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
                           <!-- script for play-list -->
                        <link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
                        <script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
                        <script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>
                            <!-- Script to Activate the Carousel -->
                            <script>
                            $('.carousel').carousel({
                                interval: 5000 //changes the speed
                            })
                            </script>

                        </body>

                        </html>
