
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
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style4.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/epk/template1/epk1.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url()?>/assets/js/jquery.steps.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
</head>
<div class="">
    <script>
        $(function ()
        {
            $("#wizard").steps({
                headerTag: "h2",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                stepsOrientation: "vertical"
            });
        });
    </script>
   
    <?php 
        $data_json = json_decode($customize['data_customize']);
    ?>
    <h1><?php echo ucfirst($res_data_artist['artist_name'])?></h1>
  
      <?php 
     if ($this->session->flashdata('message_error')) {

         ?>
        <div class="alert alert-big alert-lightred alert-dismissable fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><strong>Heads up!</strong></h4>
            <p> <?php echo $this->session->flashdata('message_error')?></p>
        </div>
        <?php

     }
    if ($this->session->flashdata('message_succsess')) {
        ?>
        <div class="alert alert-big alert-success alert-dismissable fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><strong>Succces!</strong></h4>
            <p> <?php echo $this->session->flashdata('message_succsess')?></p>
        </div>
        <?php

    }
    ?>
    <div id="wizard">
        <h2>Info</h2>
        <section>
            <div class="">
                <div class="row">
                    <div class="col-md-4 col-lg-4 ">
                        <?php if ($data_json->stats == 'on') {
    ?>
                        <div id="info_statistics_div_placeholder" style="">
                            <ul class="new_charts">
                                <li style="border-width: 0px 1px 0px 0px">
                                    <div id="gender_demographics" class="">
                                        <div class="chartTitle">gender demographics</div>
                                        <div class="chartBody">No Data Available</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <li style="border-width: 0px">
                                    <div id="demographics" class="">
                                        <div class="chartTitle">age breakdown</div>
                                        <div class="chartBody">
                                            <div class="row">
                                                <span class="labelChart">13-17</span>
                                                <div class="lineChart">
                                                    <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 13, 17)?>%"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span class="labelChart">18-24</span>
                                                <div class="lineChart">
                                                    <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 18, 24)?>%"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span class="labelChart">25-34</span>
                                                <div class="lineChart">
                                                    <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 25, 34)?>%"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span class="labelChart">35-44</span>
                                                <div class="lineChart">
                                                    <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 34, 44)?>%"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span class="labelChart">45+</span>
                                                <div class="lineChart">
                                                    <div class="innerLineChart" style="width: <?php echo $this->Member_model->stast_fan($fans, 44, 200)?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <li style="border-width: 1px 1px 0px 0px">
                                    <div id="fans" class="">
                                        <div class="chartTitle"><span id="fans_count"><?php echo count($fans)?></span>&nbsp;&nbsp;fans</div>
                                        <div class="chartBody"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <li style="border-width: 1px 0px 0px 0px">
                                    <div id="fans_near_chart" class="">
                                        <div class="chartTitle">fans near</div>
                                        <div class="chartBody"> No Data Available </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <div style="clear: both"></div>
                            </ul>
                            <div class="see_all">*Fan demographics represent 99Sound fans only</div>
                        </div>
                        <?php 
}?>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="photo_container">
                            <?php if ($photo != 'notfound') {
    ?>
                                <img class="img-responsive" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" />    
                            <?php 
} else {
    ?>
                                <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                            <?php 
} ?>
                            <br style="clear:right"> 
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="side">
                            <div style="float:left">
                                <h5 class="first">From:</h5>
                                <p><?php echo $res_data_artist['city'].', '.$country['country'];?></p>
                                <h5>Genre:</h5>
                                <p><?php echo $genre['name'];?></p>
                                <h5>Members:</h5>
                                <p class="display_band_members">
                                   <?php
                                   foreach ($groups_member as $member) {
                                       echo $member['name_member'].' - '.$member['contribution'];
                                       if (!empty($member['contribution2'])) {
                                           echo '/'.$member['contribution2'];
                                       }
                                       if ($member != end($groups_member)) {
                                           echo ',';
                                       }
                                   }
                                   ?> 
                                </p>
                                <h5>Bio:</h5>
                                <p>
                                </p>
                                <p><?php custom_echo_html($res_data_artist['bio'], 300)?></p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <?php if ($data_json->photo == 'on') {
    ?>
        <h2>Photos</h2>
        <section>
            <div id="artist_tab_photos" class="artist_tab_content">
                <div class="photos_container">
                    <a href="javascript:void(0)" class="left disabled" style="display: none;">‹</a>
                    <a href="javascript:void(0)" class="right disabled" style="display: none;">›</a>
                    <div class="photos_wrapper">
                        <div style="text-align: center; width: 100%;"> 
                            <?php
                            foreach ($photos as $pt) {
                                ?><img width="200" class="img-responsive photo_image" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" /><?php

                            } ?> 
                        </div>
                    </div>
                    <div id="photo_handler_518866" class="photo_event_handler"></div>
                </div>
            </div>
        </section>
        <?php 
}
        if ($data_json->stats == 'on') {
            ?>
        <h2>Stats</h2>
        <section>
            <div class="row stats_container" >
                <div class="col-md-4">
                    <div class="stats_column">
                        <div style="">
                            <h4>Their fans live here</h4>
                            <div class="stats_contents">
                                No Data Available
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats_column center_stat_column">
                        <h4>Fan Demographics </h4>
                        <p class="info">Top Demographics is Females (age 13-17)</p>
                        <div class="demographic_stats stats_contents">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Female</th>
                                        <th></th>
                                        <th style="text-align: center;">Age</th>
                                        <th></th>
                                        <th style="text-align:right">Male</th>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage"><span class="label"><?php echo $this->Member_model->stast_fan($fans, 13, 17, 1)?>%</span><span class="graph"><span style="width:0%">&nbsp; </span> </span><br class="clear"></td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">13-17</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage"><span class="graph"><span style="width:0%">&nbsp; </span> </span><span class="label"><?php echo $this->Member_model->stast_fan($fans, 13, 17, 2)?>%</span><br class="clear"></td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage"><span class="label"><?php echo $this->Member_model->stast_fan($fans, 18, 24, 1)?>%</span><span class="graph"><span style="width:0%">&nbsp; </span> </span><br class="clear"></td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">18-24</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage"><span class="graph"><span style="width:0%">&nbsp; </span> </span><span class="label"><?php echo $this->Member_model->stast_fan($fans, 18, 24, 2)?>%</span><br class="clear"></td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage"><span class="label"><?php echo $this->Member_model->stast_fan($fans, 25, 34, 1)?>%</span><span class="graph"><span style="width:0%">&nbsp; </span> </span><br class="clear"></td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">25-34</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage"><span class="graph"><span style="width:0%">&nbsp; </span> </span><span class="label"><?php echo $this->Member_model->stast_fan($fans, 25, 34, 2)?>%</span><br class="clear"></td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage"><span class="label"><?php echo $this->Member_model->stast_fan($fans, 35, 44, 1)?>%</span><span class="graph"><span style="width:0%">&nbsp; </span> </span><br class="clear"></td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">35-44</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage"><span class="graph"><span style="width:0%">&nbsp; </span> </span><span class="label"><?php echo $this->Member_model->stast_fan($fans, 35, 44, 1)?>%</span><br class="clear"></td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage"><span class="label"><?php echo $this->Member_model->stast_fan($fans, 45, 54, 1)?>%</span><span class="graph"><span style="width:0%">&nbsp; </span> </span><br class="clear"></td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">45-54</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage"><span class="graph"><span style="width:0%">&nbsp; </span> </span><span class="label"><?php echo $this->Member_model->stast_fan($fans, 45, 54, 2)?>%</span><br class="clear"></td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage"><span class="label"><?php echo $this->Member_model->stast_fan($fans, 55, 200, 1)?>%</span><span class="graph"><span style="width:0%">&nbsp; </span> </span><br class="clear"></td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">55+</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage"><span class="graph"><span style="width:0%">&nbsp; </span> </span><span class="label"><?php echo $this->Member_model->stast_fan($fans, 55, 200, 1)?>%</span><br class="clear"></td>
                                    </tr>
                                    <tr>
                                        <td class="left_percentage"><span class="label"><?php echo $this->Member_model->stast_fan($fans, 0, 13, 1)?>%</span><span class="graph"><span style="width:0%">&nbsp; </span> </span><br class="clear"></td>
                                        <td style="border-bottom:none"></td>
                                        <td style="text-align: center;">n/a</td>
                                        <td style="border-bottom:none"></td>
                                        <td class="right_percentage"><span class="graph"><span style="width:0%">&nbsp; </span> </span><span class="label"><?php echo $this->Member_model->stast_fan($fans, 0, 13, 2)?>%</span><br class="clear"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats_column">
                        <h4>Fan Summary</h4>
                        <p class="info"><strong><?php echo count($fans); ?> total fans</strong></p>
                        <div style="width:280px; height:171px;" class="stats_contents" id="fan_summary">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        }
        if ($data_json->video == 'on') {
            ?>
        <h2>Videos</h2>
        <section>
            <div class="row video_container">
                <div class="col-md-12 media">
                   
                    <div class="media-video"><div id="videopk"></div></div>
                    
                    <?php 
                    if (!empty($videos[0])) {
                        if ($videos[0]['type'] == 'file') {
                            $link_video = base_url().'uploads/'.$videos[0]['user_id'].'/video/'.$videos[0]['name_file'];
                        } else {
                            $link_video = $videos[0]['link_video'];
                        } ?>
                        <script>
                        jwplayer("videopk").setup({
                        	stretching: 'fill',
                        	file: "<?=$link_video?>",
                            width: "100%",
                            aspectratio: "16:9",
                            right: "-5%",
                        });
                        var arr =[ <?php foreach ($videos as $row) {
    if ($row['type'] == 'file') {
        $link_video = base_url().'uploads/'.$row['user_id'].'/video/'.$row['name_file'];
    } else {
        $link_video = $row['link_video'];
    }
    echo '"'.$link_video.'"';
    if (end($videos) != $row) {
        echo ',';
    }
} ?>
                                 ];
                            var left= -1;
                            var right= 1;
                            function playleft() { 
                                if(arr[left]!=null){
                                    jwplayer("videopk").load([{
                                        file: arr[left]
                                    }]);
                                    jwplayer("videopk").play();    
                                    right=left+1 ;
                                    if(arr[left-1]!=null) left--;
                                }
                                
                            }
                            function playright() { 
                                if(arr[right]!=null){
                                    jwplayer("videopk").load([{
                                        file: arr[right]
                                    }]);
                                    jwplayer("videopk").play();
                                    left = right-1;
                                    if(arr[right+1]!=null) right++;
                                    
                                }  
                            }
                            
                        </script> 
                        <?php

                    } ?>
                    <a href="javascript:playleft()" class="left">‹</a>
                    <a class="right" href="javascript:playright()" >›</a>
                </div>
            </div>
        </section>
        <?php 
        }
        ?>
        <h2>Bios</h2>
        <section>
            <div id="artist_tab_bio" class="artist_tab_content">
                <div class="bio_container">
                    <?php if ($photo != 'notfound') {
    ?>
                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" />    
                    <?php 
} else {
    ?>
                        <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                    <?php 
} ?>
                   <strong><?php echo $res_data_artist['artist_name']?></strong>
                    <div id="bio">
                        <p><?php echo $res_data_artist['bio']?></p>
                    </div>
                </div>
                <div id="bio_handler_922256" class="bio_event_handler"></div>
            </div>
        </section>
        <?php 
        if ($data_json->song == 'on') {
            ?>
        <h2>Songs</h2>
        <section>
            <div class="row songs_container media_container">
                <div class="col-md-4">
                    <div class="side" id="song_lyrics">
                         <div class="media">
                            <div class="playlist">
                                <div class="template" data-template="" id="songs_template"></div>
                                <ul style=" list-style: none;">
                                    <?php $i = 0;
            foreach ($songs as $row) {
                ?>
                                        <li id="song_<?php echo $i; ?>">
                                            <a href="javascript:playTrailer(<?php echo $i?>)" class="" >
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
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                   <?=$this->M_audio_song->get_shortcode_AMP($res_data_artist['id']); ?>
                </div>
            </div>
        </section>
        <?php 
        }
        if ($data_json->press == 'on') {
            ?>
        <h2>Press</h2>
        <section>
            <div id="artist_tab_press" class="artist_tab_content" style="height: 51px;">
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
                                                    <td class="lquote">
                                                        <div style="min-height: 100px"></div>
                                                    </td>
                                                    <td>
                                                        <div class="excerpt"><?php echo $row['quote']?></div>
                                                    </td>
                                                    <td class="rquote"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="info">
                                                            <?php echo $row['author']?> 
                                                            <?php if (!empty($row['link'])) {
    ?><a href="<?php echo $row['link']?>" target="_blank"><?php

} ?> <span class="publication">~ <?php echo $row['name']; ?></span>
                                                            <?php if (!empty($row['link'])) {
    ?></a><?php

} ?> 
                                                        </div>
                                                    </td>
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
        </section>
        <?php 
        }
        if ($data_json->show == 'on') {
            ?>
        <h2>Shows</h2>
        <section>
            <div id="artist_tab_shows" class="artist_tab_content">
                <div class="shows_content">
                    <div class="tabs">
                        <div class="tabs_header">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#upcoming_shows_tab" role="tab" data-toggle="tab">Upcoming Shows</a></li>
                                <li><a href="#past_shows_tab" role="tab" data-toggle="tab">Past Shows </a></li>
                            </ul>
                        </div>
                        <div class="tabs_items">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane tab_content no_data active" id="upcoming_shows_tab">
                                    <p>No data available</p>
                                </div>
                                <div class="tab-pane tab_content no_data" id="past_shows_tab">
                                    <p>No data available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        }
        ?>
    </div>
    <div class="player">
        <hr />
        <div class="col-md-4">
        <div class="section-left" style="">
             <div class="inner_content">
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
                     <a href="#" class="icon picture download"  data-toggle="modal" data-target="#video" id="download_video" ><i class="fa fa-video-camera"></i> Videos </a>
                    <?php 
                     }
                     if ($data_json->dw_pdf == 'on') {
                        
                     ?>
                     <a href="<?php echo base_url('epk').'/'.$res_data_artist['home_page'].'?action=pdf'?>" id="download_pdf" ><i class="fa fa-file-pdf-o"></i> .pdf </a>
                    <?php 
                     }
                     ?>
             </div>
        </div>
        </div>
        <div class="col-md-4"><div id="mp3" ></div></div>
        <div class="col-md-4">
            <div class="section-right">
                <a href="#" style="margin-right:20px;" class="btn btn-primary" data-toggle="modal" data-target="#contact">Contact Artist</a>
                <a href="<?php echo base_url().$res_data_artist['home_page']?>" class="btn btn-default" style="margin-right:20px" target="_blank">View Profile</a>
            </div>
        </div>
        
        <?php
            if (!empty($songs)) {
                ?>
        <script>
            var playerInstance = jwplayer("mp3");
            jwplayer("mp3").setup({
            stretching: 'fill',
            playlist: [
            <?php foreach ($songs as $row) {
    ?>
            {
                sources: [{ 
                    file: "<?php echo 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['filename'] ?>"                
                }]
            },
                <?php 
} ?>],                                         
            height: 40,
            width: "100%",
            events: {
                onPause: function(event){
                    var index = this.getPlaylistIndex();
                    $('#song_'+index).find('a').removeClass("selected");
                },
                onPlay: function(event){
                    var index = this.getPlaylistIndex();
                    $( ".playlist ul li" ).each(function() {
                        $(this).find('a').removeClass("selected");
                    });
                    $('#song_'+index).find('a').addClass("selected");
                }
                
            }
            });
        </script>
        <?php

            }
            ?>
        <hr />
    </div>
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
</body>
</html>
