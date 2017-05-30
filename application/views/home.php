<?php if($this->session->flashdata('message_msg')){
?>
<div class="alert alert-big alert-success alert-dismissable fade in">
    <h4><strong>Success!</strong></h4>
    <p> <?php echo $this->session->flashdata('message_msg')?></p>
</div>
<?php
}
if($this->session->flashdata('message_error')){
    ?>
    <div class="alert alert-big alert-lightred alert-dismissable fade in">
        <h4><strong>Error!</strong></h4>
        <p> <?php echo $this->session->flashdata('message_error')?></p>
    </div>
    <?php
} 
?>
<link rel="stylesheet" href="<?php base_url() ?>assets/css/jquery.mCustomScrollbar.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/styletai.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/new_style.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/mystyle.css" />
<div id="home">

<section class="s1 text-center" style="padding:50px;height:1100px;color:#FFF">
    <?php echo $this->M_user->background_videos('home',1); ?>
    
    <div class="hs1" style="margin-top: 0px;">
		<h1 class="oswaldregularh1" style="line-height: 2;" about="/content_homes1_tittle/">
        <span property= "content" id= "content_homes1_tittle">
        <?php
            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_s>','The Best Artist - Amazing Music<br />
    		And Its Only The Beginning');
        ?>
        </span>
    	</h1>
    	<p class="opensans">
            <a href="<?php echo base_url('account/signup') ?>" about="/content_homes1_a1/"><span  property="content" id="content_homes1_a1"><?php echo $this->M_text->getdatavalue('<_scontent__homes1_a1_s>','Join as Fan')?></span><i class="fa fa-arrow-circle-o-right"></i></a>
            <a href="<?php echo base_url('subscriptions/upgrade') ?>" about="/content_homes1_a2/"><span  property="content" id="content_homes1_a2"><?php echo $this->M_text->getdatavalue('<_scontent__homes1_a2_s>','See Our Plans')?></span><i class="fa fa-arrow-circle-o-right"></i></a>
            <a href="<?php echo base_url('make_money') ?>" about="/content_homes1_a3/"><span  property="content" id="content_homes1_a3"><?php echo $this->M_text->getdatavalue('<_scontent__homes1_a3_s>','Learn More Fan')?></span><i class="fa fa-arrow-circle-o-right"></i></a>

        </p>
    </div>
    <div class="hs2" style="margin-top: 100px;" >
		<h1 id="artist" class="oswaldregularh1" about="/content_homes1_tittle_new1/">
             <span property="content" id= "content_homes1_tittle_new1">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_s>','ARTIST');
                ?>
            </span>
       </h1>
    	<h3 class="oswaldregularh3" about="/content_homes1_tittle_new2/">
                  
       </h3>
        <br />
        <h1 id="fan" class="oswaldregularh1" about="/content_homes1_tittle_new3/">
            <span property="content" id= "content_homes1_tittle_new3">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_s>',"FAN");
                ?>
            </span> 
        </h1>
    	<h3 class="oswaldregularh3" about="/content_homes1_tittle_new4/">
            <span property="content" id= "content_homes1_tittle_new4">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_s>'," Be The First, Use Cutting Edge Technology Connecting Your Favorite Artist And You");
                ?>
            </span>  
      </h3>
        <p class="opensans">
            <a class="opensans" href="<?php echo base_url("account/signup") ?>">Join as Artist<i class="fa fa-arrow-circle-o-right"></i></a>
            <a class="opensans" href="<?php echo base_url("features/artist") ?>">Learn More Artist<i class="fa fa-arrow-circle-o-right"></i></a>
        </p>
    </div>
</section> 

<section class="section section-light section-itunes s4"  style="padding: 40px 0;<?php echo $this->M_user->background('home',3); ?>"><!--assets/images/bg/musical.png-->
	<div class="section-lightgrey section-hardware">
		<div class="container-fluid">
			<div class="row artists" id="s4" style="padding: 10px 0;">
                            <div class="col-md-10 col-md-offset-2">
                                <div class="col-md-5" style="margin-top:120px;">
                                <img src="<?php echo base_url();?>/assets/logos/logo-07.png" class="img-responsive">
                                <h2 about="/content_title_home_amp/" style="color:#fff;text-transform:uppercase;" class="text-center"><span property="content" id="content_title_home_amp"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_amp_s>','Features and Tools') ?></span></h2>
                                <div style="margin-top:50px;">
                                <h1 about="/content_title_home_local5/" class="text-center" style="color:#fff;"><span property="content" id="content_title_home_local5"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local5_s>','Artist Music Player') ?></span></h1>
                                 <p about="/content_title_home_local55/" class="text-center"><span property="content" id="content_title_home_local55" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local55_s>','An Industry First 4 level Affiliate Music Player, Fans & Artist can earn money<br/>Post This Player almost anywhere with shortcode you embed') ?></span> </p>
                                 <h3 about="/content_title_home_local55_link/" class="text-center"><span property="content" id="content_title_home_local55_link"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local55_link_s>','<a href="/make_money" class="button_new"  style="width:50%; text-align:center; display:inline-block;">View Artist Music Player</a>'); ?></span></h3>
                                </div>
                                </div>
                 <div class="col-md-5" style="margin-top:20px;">
<iframe id="iframe_amp" src="http://99sound.com/amp/embed/5aa6884a1c57a26cdbdcab26eec1a99d" frameborder="0" scrolling="no" width="100%" height="500px"></iframe>
                            </div>
                             
			</div>
		</div>
                </div>
	</div>
</section>
<section class="section section-light section-itunes s4"  style="padding: 40px 0;<?php echo $this->M_user->background('home',4); ?>"><!--assets/images/bg/musical.png-->
<!--<div class="new_home_page" id="worldwide">
    <div class="col-md-10 music_ttt col-md-offset-1">
        <div class="col-md-4 gigs_event">
            <h1 about="/content_title_home_local2/" style="color:#fff;"><span property="content" id="content_title_home_local2"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local2_s>','Artist Landing Page') ?></span></h1>
            <p about="/content_title_home_local22/" style="color:#fff;"><span property="content" id="content_title_home_local22"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local22_s>','Choose a different design and in an instant get a fresh Look.<br/>All Your Vitals Stored in One Place') ?></span> </p>
         
            <h3 about="/content_title_home_artist_landing/"><span property="content" id="content_title_home_artist_landing"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_artist_landing_s>','<a href="features/artist#artist_landing" class="button_new" style="width:70%; text-align:center; display:inline-block;">View Artist Landing Page</a>'); ?></span></h3>
        </div>
        <div class="col-md-4 gigs_event" id="epk">
            <h1 about="/content_title_home_local3/" style="color:#fff;"><span property="content" id="content_title_home_local3"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local3_s>','Electronic Press Kit') ?></span></h1>
            <p about="/content_title_home_local33/" style="color:#fff;"><span property="content" id="content_title_home_local33"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local33_s>','Choose different designs and Viola, a new look for new opportunities<br><br>') ?></span> </p>
    
            <h3 about="/content_title_home_artist_epk/"><span property="content" id="content_title_home_artist_epk"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_artist_epk_s>','<a href="features/artist#epk" class="button_new" style="width:70%; text-align:center; display:inline-block;">View Electronic Press Kit</a>'); ?></span></h3>
        </div>
    
        <div class="col-md-4 gigs_event">
            <h1 class="text-center oswaldregularh2" about="/content_title_home_new_worldwide/" style="color:#fff;"><span property="content" id="content_title_home_new_worldwide"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_new_worldwide_s>','Worldwide Featured Artist') ?></span></h1>
            <p about="/content_ct_home_new_worldwide/" style="color:#fff;">
                <span property="content" id="content_ct_home_new_worldwide"><?php echo $this->M_text->getdatavalue('<_scontent_ct_home_new_worldwide_s>','OurFeatured/Premium Artists<br><br>') ?></span>
            </p>
              <h3 about="/content_ct_home_new_viewmore/"><span property="content" id="content_ct_home_new_viewmore"><?php echo $this->M_text->getdatavalue('<_scontent_ct_home_new_viewmore_s>','<a  href="features/artist_premium" class="button_new" style="width:50%; text-align:center; display:inline-block;">View More</a>') ?></span></h3>
        </div>
        
        
    </div>
    
</div>--->

<!--<div class="new_home_page">
    <div class="col-md-10 music_distribution col-md-offset-1" id="music">
        <div class="col-md-4 gigs_event" >
            <h3 about="/content_title_home_local1/"><span property="content" id="content_title_home_local1" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local1_s>','Music Distribution System') ?></span></h3>
            <p about="/content_title_home_local11/"><span property="content" id="content_title_home_local11" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local11_s>','Distribute Worldwide to over 140 countries.<br/>Choice of many different channels, iTunes, Spotify, 7digital, Deezer etc.') ?></span> </p>
            <h3 about="/content_ct_home_new_mds/"><span property="content" id="content_ct_home_new_mds"><?php echo $this->M_text->getdatavalue('<_scontent_ct_home_new_mds_s>','<a  href="mds" class="button_new">View MDS</a>') ?></span></h3>
        </div>
        <div class="col-md-4 gigs_event" >
              <h3 about="/content_title_home_local4/"><span property="content" id="content_title_home_local4" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local4_s>','The Total Tour') ?></span></h3>
            <p about="/content_title_home_local44/"><span property="content" id="content_title_home_local44" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local44_s>','Budgetary and Itinerary solutions at your fingertips.<br/>Always stay informed with real time itinerary and notification alerting<br>') ?></span> </p>
            <h3 about="/content_title_home_ttt/"><span property="content" id="content_title_home_ttt"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_ttt_s>','<a href="features/artist#ttt" class="button_new" style="width:70%; text-align:center; display:inline-block;">View The Total Tour</a>') ?></span></h3>
        </div>
        <div class="col-md-4 gigs_event" >
             <h3 about="/content_title_home_local6/"><span property="content" id="content_title_home_local6" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local6_s>','One Stop Social Media') ?></span></h3>
            <p about="/content_title_home_local66/"><span property="content" id="content_title_home_local66" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local66_s>','Post to the big 4, with one tool, Save time.<br><br>') ?></span> </p>
            <h3 about="/content_title_home_social_media/"><span property="content" id="content_title_home_social_media"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_social_media_s>','<a href="features/artist#social_media" class="button_new">View Social Media</a>') ?></span></span></h3>
        </div>
    </div>
    <div class="col-md-10 music_ttt col-md-offset-1" >
        <div class="col-md-4 gigs_event">
             <h1 about="/content_title_home_local8/"><span property="content" id="content_title_home_local8" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local8_s>','Dashboard Chat') ?></span></h1>
            <p about="/content_title_home_local88/"><span property="content" id="content_title_home_local88" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local8_s>','Chat privately with your affiliates, form groups, blog<br><br>') ?></span> </p>
            
            <h3 about="/content_title_home_dashboard_chat/"><span property="content" id="content_title_home_dashboard_chat"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_dashboard_chat_s>','<a href="features/artist#social_media" class="button_new" style="width:50%; text-align:center; display:inline-block;">View Dashboard Chat</a>') ?></span></h3>
        </div>
        <div class="col-md-4 gigs_event" id="epk">
             <h1 about="/content_title_home_local7/"><span property="content" id="content_title_home_local7" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local7_s>','Gigs & Events') ?></span></h1>
            <p about="/content_title_home_local77/"><span property="content" id="content_title_home_local77" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local77_s>','Fans: Find out where your favorite Artists are playing.<br/>Artist: Send EPK’s to any Venue that pops up<br>') ?></span> </p>
             <h3 about="/content_title_home_gigs_events/"><span property="content" id="content_title_home_gigs_events"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_gigs_events_s>','<a href="features/artist#gigs_events" class="button_new" style="width:70%; text-align:center; display:inline-block;">View Gigs & Events</a>') ?></span></h3>
            <h3></h3>
        </div>
        <div class="col-md-4 gigs_event">
         <h1 about="/content_title_home_local9/"><span property="content" id="content_title_home_local9" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local9_s>','Musicians Referral') ?></span></h1>
            <p about="/content_title_home_local99/"><span property="content" id="content_title_home_local99" style="color:#fff;"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local99_s>','Band and Artist, find each other, hook up<br><br>') ?></span> </p>
     
            <h3 about="/content_title_home_music_referral/"><span property="content" id="content_title_home_music_referral"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_music_referral_s>','<a href="features/artist#music_referral" class="button_new" style="width:70%; text-align:center; display:inline-block;">View Musicians Referral</a>') ?></span></h3>
            
           
        
        </div>
    </div>
    
    
</div>-->


<!--New section start -->

<div id="wr_service">
    <div class="container">
       <!-- Introduction Row -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 service text-center">
                <h3 about="/content_title_features/">
                    <span property="content" id="content_title_features"><?php echo $this->M_text->getdatavalue('<_scontent_title_features_s>','<small><b>FEATURES</b></small>') ?></span>
                </h3>
               
                <hr id="style">
                
            </div>
        </div>
    </div>
            <br/>
        <!-- service row -->
        <div class="container">
          <div class="row">
           
            <div class="col-lg-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/am_player01.png" alt="">
                <h3 about="/content_title_home_amp1/"><span property="content" id="content_title_home_amp1" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_amp1_s>','Artist Music Player') ?></span></h3>
           
               <p about="/content_desc_home_amp1/" class="text-muted"><span property="content" id="content_desc_home_amp1"><?php echo $this->M_text->getdatavalue('<_scontent_desc_home_amp1_s>','An Industry First 4 level Affiliate Music Player, Fans & Artist can earn money
                       Post This Player almost anywhere with shortcode you embed') ?></span></p>
           
                                             <h5 about="/content_title_home_amp1_link/" class="text-center"><span property="content" id="content_title_home_amp1_link"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_amp1_link_s>','<a href="/make_money"  display:inline-block;">View Artist Music Player</a>'); ?></span></h5>
            </div>
            <div class="col-lg-3 col-sm-6  serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/al_page.png" alt="">
                
           <h3 about="/content_title_home_local2/" ><span property="content" id="content_title_home_local2"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local2_s>','Artist Landing Page') ?></span></h3>
           <p class="text-muted" about="/content_title_home_local22/"><span property="content" id="content_title_home_local22"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local22_s>','Choose a different design and in an instant get a fresh Look.<br/>All Your Vitals Stored in One Place') ?></span> </p>
         
            <h5 about="/content_title_home_artist_landing/"><span property="content" id="content_title_home_artist_landing"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_artist_landing_s>','<a href="features/artist#artist_landing"  text-align:center; display:inline-block;">View Artist Landing Page</a>'); ?></span></h5>
            </div>
            <div class="col-lg-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/ep_kit.png" alt="">
             
            <h3 about="/content_title_home_local3/" ><span property="content" id="content_title_home_local3"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local3_s>','Electronic Press Kit') ?></span></h3>
            <p class="text-muted" about="/content_title_home_local33/" ><span property="content" id="content_title_home_local33"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local33_s>','Choose different designs and Viola, a new look for new opportunities<br><br>') ?></span> </p>
    
            <h5 about="/content_title_home_artist_epk/"><span property="content" id="content_title_home_artist_epk"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_artist_epk_s>','<a href="features/artist#epk"  text-align:center; display:inline-block;">View Electronic Press Kit</a>'); ?></span></h5>
            
            </div>
            <div class="col-lg-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/wf_artist1.png" alt="">
               
                <h3  about="/content_title_home_new_worldwide/" ><span property="content" id="content_title_home_new_worldwide"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_new_worldwide_s>','Worldwide Featured Artist') ?></span></h3>
            <p class="text-muted" about="/content_ct_home_new_worldwide/" >
                <span property="content" id="content_ct_home_new_worldwide"><?php echo $this->M_text->getdatavalue('<_scontent_ct_home_new_worldwide_s>','OurFeatured/Premium Artists<br><br><br>') ?></span>
            </p>
              <h5 about="/content_ct_home_new_viewmore/"><span property="content" id="content_ct_home_new_viewmore"><?php echo $this->M_text->getdatavalue('<_scontent_ct_home_new_viewmore_s>','<a  href="features/artist_premium"  text-align:center; display:inline-block;">View More</a>') ?></span></h5>
            </div>
         
            <div class="col-lg-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/icon-landing-page22.png" alt="">
          
            <h3 about="/content_title_home_local4/"><span property="content" id="content_title_home_local4"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local4_s>','The Total Tour') ?></span></h3>
            <p class="text-muted" about="/content_title_home_local44/"><span property="content" id="content_title_home_local44" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local44_s>','Budgetary and Itinerary solutions at your fingertips.Always stay informed with real time itinerary and notification alerting<br>') ?></span> </p>
            <h5 about="/content_title_home_ttt/"><span property="content" id="content_title_home_ttt"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_ttt_s>','<a href="features/artist#ttt"  text-align:center; display:inline-block;">View The Total Tour</a>') ?></span></h5>
            
            </div>
            <div class="col-lg-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/md_system.png" alt="">

             <h3 about="/content_title_home_local1/"><span property="content" id="content_title_home_local1" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local1_s>','Music Distribution System') ?></span></h3>
            <p class="text-muted" about="/content_title_home_local11/"><span property="content" id="content_title_home_local11" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local11_s>','Distribute Worldwide to over 140 countries.<br/>Choice of many different channels, iTunes, Spotify, 7digital, Deezer etc.') ?></span> </p>
            <h5 about="/content_ct_home_new_mds/"><span property="content" id="content_ct_home_new_mds"><?php echo $this->M_text->getdatavalue('<_scontent_ct_home_new_mds_s>','<a  href="mds" >View MDS</a>') ?></span></h5>
            
            
            </div>
			 <div class="col-lg-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/ssmedia2.png" alt="">

             <h3 about="/content_title_home_local6/"><span property="content" id="content_title_home_local6" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local6_s>','One Stop Social Media') ?></span></h3>
            <p about="/content_title_home_local66/" class="text-muted"><span property="content" id="content_title_home_local66" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local66_s>','Post to the big 4, with one tool, Save time.<br><br><br>') ?></span> </p>
            <h5 about="/content_title_home_social_media/"><span property="content" id="content_title_home_social_media"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_social_media_s>','<a href="features/artist#social_media" >View Social Media</a>') ?></span></h5>
                         
                         </div>
			 <div class="col-lg-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/d_chat.png" alt="">
             
                   <h3 about="/content_title_home_local8/"><span property="content" id="content_title_home_local8" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local8_s>','Dashboard Chat') ?></span></h3>
            <p about="/content_title_home_local88/" class="text-muted"><span property="content" id="content_title_home_local88" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local8_s>','Chat privately with your affiliates, form groups, blog<br><br>') ?></span> </p>
            
            <h5 about="/content_title_home_dashboard_chat/"><span property="content" id="content_title_home_dashboard_chat"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_dashboard_chat_s>','<a href="features/artist#social_media"  text-align:center; display:inline-block;">View Dashboard Chat</a>') ?></span></h5>      
                         </div>
        </div>
        <div class="col-lg-3 col-lg-offset-3 col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/g_events.png" alt="">
             
                
                <h3 about="/content_title_home_local7/"><span property="content" id="content_title_home_local7" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local7_s>','Gigs & Events') ?></span></h3>
            <p about="/content_title_home_local77/"class="text-muted"><span property="content" id="content_title_home_local77" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local77_s>','Fans: Find out where your favorite Artists are playing.Artist: Send EPK’s to any Venue that pops up') ?></span> </p>
             <h5 about="/content_title_home_gigs_events/"><span property="content" id="content_title_home_gigs_events"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_gigs_events_s>','<a href="features/artist#gigs_events"  text-align:center; display:inline-block;">View Gigs & Events</a>') ?></span></h5>
            </div>
             <div class="col-lg-3  col-sm-6 serive-box text-center">
                <img class="img-rounded img-responsive img-center" src="<?php echo base_url();?>assets/images/wf_artist.png" alt="">
             
             <h3 about="/content_title_home_local9/"><span property="content" id="content_title_home_local9" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local9_s>','Musicians Referral') ?></span></h3>
            <p about="/content_title_home_local99/" class="text-muted"><span property="content" id="content_title_home_local99" ><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local99_s>','Band and Artist, find each other, hook up<br><br><br>') ?></span> </p>
     
            <h5 about="/content_title_home_music_referral/"><span property="content" id="content_title_home_music_referral"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_music_referral_s>','<a href="features/artist#music_referral" text-align:center; display:inline-block;">View Musicians Referral</a>') ?></span></h5>
             </div>
        </div>

    </div>
    <!-- /.container -->
</div>
<!--/New Section End-->





    </section>
    <section class="sponsors" style="padding: 40px 0;<?php echo $this->M_user->background('home',5); ?>">
        <div class="container marketing2">
            <div class="row">
                <div class="col-md-12">
                    <h2 about="/content_title_home_local10/" class="text-center oswaldregularh2"><span property="content" id="content_title_home_local10"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_local10_s>','Visit Our Sponsors') ?></span></h2>
                    <div class="bottomheader"  data-wow-delay="1s"></div>
                    <div class="padding-20">
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://dittytv.com"><img src="<?php echo base_url(); ?>assets/images/ditty-tv.png" class="img-responsive img-sponser" alt=""></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://planetlarecords.com"><img src="<?php echo base_url(); ?>assets/images/Planet-LA-Records.jpg" class="img-responsive img-sponser" alt=""></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://aktivatedmusic.com"><img src="<?php echo base_url(); ?>assets/images/1799088_693516810711011_1580074293_o-672x706.jpg" class="img-responsive img-sponser" alt=""></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://www.universalmusic.com/"><img src="<?php echo base_url(); ?>assets/images/sponsor4.png" class="img-responsive img-sponser" alt=""></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://www.universalmusic.com/"><img src="<?php echo base_url(); ?>assets/images/sponsor3.png" class="img-responsive img-sponser" alt=""></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://www.livenation.com/"><img src="<?php echo base_url(); ?>assets/images/ticketmaster-ln.jpg" class="img-responsive img-sponser" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
</div>






<script src="<?php base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php base_url() ?>assets/js/detail_pages/home.js"></script>