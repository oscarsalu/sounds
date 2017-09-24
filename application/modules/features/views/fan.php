<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styletai.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/new_style.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/homepage/music.built.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/homepage/overview.built.css"/>
<link href="<?php echo base_url() ?>assets/css/rvslider.min.css" rel="stylesheet">
<div id="home" class="ffan">
    <nav id="ac-globalnav" class="js no-touch svg no-ie7 no-ie8" aria-label="Global Navigation" data-hires="false" data-analytics-region="global nav" lang="en-US" data-store-key="SFX9YPYY9PPXCU9KH" data-store-locale="us" data-store-api="/[storefront]/shop/bag/status" data-search-locale="en_US" data-search-api="/search-services/suggestions/" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
    </nav>
    <nav id="ac-localnav" class="ac-ln-switch js no-touch svg no-ie7 no-ie8 no-css-sticky theme-dark ac-ln-sticking" lang="en-US" data-analytics-region="local nav locked" data-sticky="" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
    </nav>
   	<main class="main page-overview css-filter" data-page-type="overview">

    <section class="section section-dark section-hero section-hero-overview"  id="feafan" data-section-type="OverviewHeroSection" data-analytics-section-engagement="name:hero">
		<div class="section-background large-fixed" style="">
			<div id="container_new" class="section-bleed large-fixed" style="">
				<?php echo $this->M_user->background_videos('fan_feature',1); ?>
			</div>
		</div>
        
		<div class="section-foreground container" style="">
			<div class="hero-headline">
				<div class="section-image"></div>
				<div class="section-content row">
                    <div class="col-sm-12" id="fixfox" >
                      <h1 class="hero-copy oswaldregularh1" style="margin-bottom: 0;" about="/content_ffan_headerh1/"><span property="content" id="content_ffan_headerh1">
                        <?php echo $this->M_text->getdatavalue('<_scontent_ffan_headerh1_s>','Feel The Music In Your Soul'); ?></span></h1>
						<br />
                        <p class="opensans">
                            <a href="<?php echo base_url('make_money') ?>" about="/content_a1_join_fan/" class=""><span property="content" id="content_a1_join_fan"><?php echo $this->M_text->getdatavalue('<_scontent_a1_join_fan_s>','Learn More'); ?></span><i class="fa fa-arrow-circle-o-right"></i></a>
						</p>
                    </div>
				</div>
			</div>
		</div>
    </section>

        
     <section tabindex="0" class="section section-dark section-fullheight section-radio s3 section-guided-tours" data-jump-section-name="radio" data-section-type="OverviewRadioSection" data-analytics-section-engagement="name:radio" style="<?php echo $this->M_user->background('fan_feature',2); ?>"><!--assets/images/bg/-Music-Vinyl-Fresh-New-Hd-Wallpaper--.jpg-->		

			<div class="section-foreground ">
				<div class="section-content container">
					<div class="row">
						
					<div class="column large-5 medium-6 small-12">
						<div class="content-hardware">
							<div class="hardware-container">
								<figure class="image-music-phone">
									<div>
										<div class="iphone">
                                            <div class="topphone" style="font-size: 15px;height:18px;color:#000;">
                                                <div class="col-xs-4"><i class="fa fa-signal"></i></div>
                                                <div class="col-xs-4 text-center"><b class="text-center">09:09 AM</b></div>
                                                <div class="col-xs-4 text-right"><i class="fa fa-wifi text-right"></i>
                                                <i class="fa fa-battery-full text-right"></i></div>
                                            </div>
                                            <div class="phonetext" style="background: #FFF;">
                                                <p class="text-center" style="color: crimson;font-weight: bold;" about="/scontent_makecareer_p/"><span property="content" id="scontent_makecareer_p"><?php echo $this->M_text->getdatavalue('<_scontent_makecareer_p>','99sound.com');?></span></p>
                                            </div>
                                            <div style="width: 100%;height:174px;">
                                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                              <!-- Indicators -->
                                        
                                                <div class="carousel-inner" role="listbox">
                                                <?php 
                                                $i = 0;
                                                foreach($artists as $artist){
                                                ?>
                                                    <div class="item <?php if($i == 0){echo "active";} ?>">
                                                      <img class="first-slide" src="<?php echo $this->M_user->get_avata($artist["id"])  ?>" alt="<?php echo $artist["artist_name"]; ?>" />
                                                      <div class="row">
                                                        <div class="carousel-caption">
                                                            <div class="cap">
                                                                <h4 class="botton_carousel"><a style="text-decoration: none;" href="<?php echo  base_url() ?><?php echo $artist["home_page"]; ?>"><?php echo $artist["artist_name"]; ?></a></h4>
                                                                <p>MUSICIAN | <?php echo $artist["genre_name"]; ?></p>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                <?php  
                                                $i++;  
                                                }
                                                ?>
                                            </div><!-- /.carousel -->

                                            </div>
                                            
                                            <div><img src="<?php echo base_url(); ?>assets/homepage/images/new_artisrt_feature.png" alt="" /></div>
                                            <div class="row add_bg_home_iphone">
                                                <?php 
                                                $i = 0;
                                                foreach($artists as $artist){
                                                ?>
                                                    <a href="<?php echo  base_url() ?><?php echo $artist["home_page"]; ?>">
                                                    <div class="col-xs-6">
                                                        <img class="first-slide" src="<?php echo $this->M_user->get_avata($artist["id"])  ?>" alt="<?php echo $artist["artist_name"]; ?>" />
                                                        <h5 class="name"><?php echo $artist["artist_name"]; ?> - <?php echo $artist["genre_name"]; ?></h5>
                                                    </div>
                                                    </a>
                                                <?php  
                                                $i++;  
                                                }
                                                ?>
                                                
                                            </div>
                                            <div><img src="<?php echo base_url(); ?>assets/homepage/images/bottom_artisrt_feature.png" alt=""/></div>
                                        </div>
                                    </div>
								</div>
							</figure>
						</div>
					</div>
				</div>
					
                    <div class="column large-6 large-offset-1 medium-offset-0 small-12 hidden-xs">
						<div class="content-copy">
							<div class="copy-container" data-analytics-region="learn more">
								<h2 class="oswaldregularh1" about="/content_header_home_fan/"><span property="content" id="content_header_home_fan"><?php echo $this->M_text->getdatavalue('<_scontent_header_home_fan_s>','Great Artists, Amazing Music') ?>
                                </span></h2>
								
                                <p class="opensans" about="/content_header_home_h3_fan2/"><span property="content" id="content_header_home_h3_fan2"><?php echo $this->M_text->getdatavalue('<_scontent_header_home_h3_fan2_s>','Join The Revolution - Become Part of the 99sound.com Team Make Money'); ?>
                                <br /><a href="<?php echo base_url('features/artist') ?>" class="more">Learn More <i class="fa fa-arrow-circle-o-right"></i></a>
                                </span></p>
							
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
	</section>
            
            
        <section class="section section-dark section-fullheight section-guided-tours" data-jump-section-name="guided-tours" data-section-type="OverviewGuidedToursSection" data-analytics-section-engagement="name:guided-tours" style="<?php echo $this->M_user->background('fan_feature',1); ?>"><!--assets/homepage/images/festival_back_large.jpg-->
			<div class="section-background">
				<div class="section-bleed">
				</div>
			</div>
			<div class="section-foreground" style="height: 670px;">
				<div class="section-content  container">
					<div class="row">
						<div class="column large-5 medium-6 small-12">
							<div class="content-copy">
								<div class="copy-container" data-analytics-region="learn more">
									<h2 class="oswaldregularh1" about="/content_ffan2_header/">
											<span property="content" id="content_ffan2_header"><?php echo $this->M_text->getdatavalue('<_scontent_ffan2_header_s>','Make Career With Us') ?></span>
										</h2>
										<p class="opensans" about="/content_header_care_h3_fan/"><span property="content" id="content_header_care_h3_fan"><?php echo $this->M_text->getdatavalue('<_scontent_header_care_h3_fan_s>','Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...'); ?>
                                        <br />
                                        </span></p>
                                        <a href="<?php echo base_url('account/signup') ?>" class="more" about="/f_joinfree/"><span property="content" id="f_joinfree"><?php echo $this->M_text->getdatavalue('<_sf_joinfree_s>','Join for free ');?></span><i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
						</div>
						<div class="column large-6 large-offset-1 medium-offset-0 small-12 hidden-xs">
							<div class="content-hardware">
								<div class="hardware-container">
									<figure class="image-music-phone">
									   <div>
											<div class="iphone">
                                                <div class="topphone" style="font-size: 15px;height:18px;color:#000;">
                                                    <div class="col-xs-4"><i class="fa fa-signal"></i></div>
                                                    <div class="col-xs-4 text-center"><b class="text-center">09:09 AM</b></div>
                                                    <div class="col-xs-4 text-right"><i class="fa fa-wifi text-right"></i>
                                                    <i class="fa fa-battery-full text-right"></i></div>
                                                </div>
                                                <div class="phonetext" style="background: #FFF;">
                                                    <p class="text-center" style="color: crimson;font-weight: bold;" about="/scontent_makecareer_p_fan/"><span property="content" id="scontent_makecareer_p_fan"><?php echo $this->M_text->getdatavalue('<_sscontent_makecareer_p_fan_s>','All Artists');?></span></p>
                                                </div>
                                                <!--
                                                <img src="<?php echo base_url(); ?>assets/images/adaptable.jpg" />-->
                                                
                                                <div style="width: 100%;height:174px;">
                                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                              <!-- Indicators -->
                                        
                                                <div class="carousel-inner" role="listbox">
                                                <?php 
                                                $i = 0;
                                                foreach($artists as $artist){
                                                ?>
                                                    <div class="item <?php if($i == 0){echo "active";} ?>">
                                                      <img class="first-slide" src="<?php echo $this->M_user->get_avata($artist["id"])  ?>" alt="<?php echo $artist["artist_name"]; ?>" />
                                                      <div class="row">
                                                        <div class="carousel-caption">
                                                            <div class="cap">
                                                                <h4 class="botton_carousel"><a style="text-decoration: none;" href="<?php echo  base_url() ?><?php echo $artist["home_page"]; ?>"><?php echo $artist["artist_name"]; ?></a></h4>
                                                                <p>MUSICIAN | <?php echo $artist["genre_name"]; ?></p>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                <?php  
                                                $i++;  
                                                }
                                                ?>
                                            </div><!-- /.carousel -->
                                            
                                            <div><img src="<?php echo base_url(); ?>assets/homepage/images/new_artisrt.png" alt=""/></div>
                                            <div class="row add_bg_home_iphone">
                                                <?php foreach($artist1s as $artist){  ?>
                                                   <a href="<?php echo  base_url() ?><?php echo $artist["home_page"]; ?>">
                                                    <div class="col-xs-4">
                                                        
                                                        <img class="first-slide" src="<?php echo $this->M_user->get_avata($artist["id"])  ?>" alt="<?php echo $artist["artist_name"]; ?>" />
                                                        <h5 class="name"><?php echo $artist["artist_name"]; ?></h5>
                                                        <h5 class="add"><?php echo $artist["genre_name"]; ?></h5>
                                                    </div>
                                                    </a>
                                                <?php }?>
                                            </div>
                                            <div><img src="<?php echo base_url(); ?>assets/homepage/images/new_artisrt_bottom.png" alt=""/></div>
                                            </div>
										</div>
                                    </div>
                                </div>
							</figure>
						</div>
					</div>
				</div>
			</div>
		</section>      
  
         <section class=" 123 section section-dark section-fullheight section-guided-tours" data-jump-section-name="guided-tours" data-section-type="OverviewGuidedToursSection" data-analytics-section-engagement="name:guided-tours" style="<?php echo $this->M_user->background('fan_feature',3); ?>">
			<div class="section-background">
				<div class="section-bleed">
				</div>
			</div>
			<div class="section-foreground">
				<div class="section-content  container">
					<div class="row">
						<div class="column large-5 medium-6 small-12">
							<div class="content-copy">
								<div class="copy-container" data-analytics-region="learn more">
									<h2 class="oswaldregularh1" about="/content_h2_tour/"><span  property="content" id="content_h2_tour"><?php echo $this->M_text->getdatavalue('<_scontent_h2_tour_s>','Where Artists And Fans Come Together') ?></span></h2>
                                    <p class="opensans" about="/content_tour_p223/" style="opacity: 1!important;"><span property="content" id="content_tour_p223"><?php echo $this->M_text->getdatavalue('<_scontent_tour_p223_s>','Use The Music Industrys First 4 Level Artist Music Player (AMP)<br>Become An Affiliate - Make MONEY'); ?>	</span></p><p class="opensans"><a href="<?php echo base_url('features/artist'); ?>" about="/content_tour_a/"><span property="content" id="content_tour_a" class="opensans"><?php echo $this->M_text->getdatavalue('<_scontent_tour_a_s>','Explore now') ?><i class="fa fa-arrow-circle-o-right"></i></span></a></p>
								</div>
							</div>
						</div>
						<div style="text-align: right;" class="column small-12 large-6 small-12 hidden-xs">
                            <iframe id="iframe_amp" src="http://demo99sound.com/amp/embed/e920cb4bbf3543c0c7f5637541532cf4" frameborder="0" scrolling="no" width="90%" height="450px" style="margin-top: 120px;"></iframe>                        
							
						</div>
					</div>
				</div>
			</div>
		</section>      
        
    </main> 

<div id="top100 home " class="top100" style="background: url(<?php echo base_url(); ?>assets/images/bg/musical.png);">
            <section class="s4" style="padding: 40px 0" >
        			<div class="container">
        		        <div class="text-center" style="color: #fff; margin: 15px 0;">
                            <h2 class="oswaldregularh3 wow zoomIn"  data-wow-delay="1s">TOP 100 LIST</h2>
                			<div class="line wow zoomIn"  data-wow-delay="1s"></div>
                            <p style="color:#FFF" class="opensans excerpt wow zoomIn"  data-wow-delay="1s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>
                         </div>
                         
        				<div class="row" id="s4" style="padding: 10px 0;">
                            <?php foreach($fantop as $fan){?>
                                <div class="col-xs-6 col-sm-4 col-md-2">
        							<div class="newtrend remix_items grid" >
                                        <a href="<?php echo  base_url() ?><?php echo $fan["home_page"]; ?>">
                                		<figure class="effect-bubba">
                                			<?php 
                                            if($fan["avata"] != null){
                                            //if($fan["artist_name"] != null){?>
                                                <img class="first-slide img-responsive" src="<?php echo  base_url() ?>uploads/<?php echo $fan["id"]; ?>/photo/<?php echo $fan["avata"]; ?>" alt="<?php echo $fan["fan_name"]; ?>" />
                                                <?php }else{?>
                                                <img class="first-slide img-responsive" src="<?php echo  base_url() ?>assets/images/user_default.gif" alt="<?php echo $fan["artist_name"]; ?>" />
                                            <?php } ?>							
                                			<figcaption>
                                				<h2><?php echo $fan["fan_name"]?> </h2>
                                                <p>FAN</p>
                                			</figcaption>
                                		</figure>
          		                        </a>
                                    </div>
        						</div>
                            <?php } ?>
                            
        				</div>
        			</div>
        	</section>
        </div>



<section class="sponsors">
        <div class="container marketing2">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center oswaldregularh2">Visit Our Sponsors</h1>
                    <div class="bottomheader"  data-wow-delay="1s"></div>
                    <div class="padding-20">
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://dittytv.com"><img src="<?php echo base_url(); ?>assets/images/ditty-tv.png" class="img-responsive img-sponser"></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://planetlarecords.com"><img src="<?php echo base_url(); ?>assets/images/Planet-LA-Records.jpg" class="img-responsive img-sponser"></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://aktivatedmusic.com"><img src="<?php echo base_url(); ?>assets/images/1799088_693516810711011_1580074293_o-672x706.jpg" class="img-responsive img-sponser"></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://www.universalmusic.com/"><img src="<?php echo base_url(); ?>assets/images/sponsor4.png" class="img-responsive img-sponser"></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://www.universalmusic.com/"><img src="<?php echo base_url(); ?>assets/images/sponsor3.png" class="img-responsive img-sponser"></a></div>
                        <div class="col-sm-4 col-md-2 col-xs-6 logohome "><a href="http://www.livenation.com/"><img src="<?php echo base_url(); ?>assets/images/ticketmaster-ln.jpg" class="img-responsive img-sponser"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
</div>
<script src="<?php echo base_url(); ?>assets/js/rvslider.min.js"></script>
<script>
	jQuery(function($){
		$('.rvs-container').rvslider();
	});
</script> 