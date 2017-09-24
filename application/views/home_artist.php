<?php if (isset($user_data)) {
    ?>
    <?php if (isset($user_data['id']) && $user_data['role'] == 1) {
    ?>
        <?php if ($this->session->flashdata('message_msg')) {
    ?>
    <div class="alert alert-big alert-success alert-dismissable fade in">
        <h4><strong>Success!</strong></h4>
        <p> <?php echo $this->session->flashdata('message_msg')?></p>
    </div>
    <?php

}
    if ($this->session->flashdata('message_error')) {
        ?>
        <div class="alert alert-big alert-lightred alert-dismissable fade in">
            <h4><strong>Error!</strong></h4>
            <p> <?php echo $this->session->flashdata('message_error')?></p>
        </div>
        <?php

    } ?>
<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/styletai.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/new_style.css" />
<link rel="stylesheet" href="<?php base_url() ?>assets/homepage/music.built.css"/>
<link rel="stylesheet" href="<?php base_url() ?>assets/homepage/overview.built.css"/>
<link href="<?php base_url() ?>assets/css/rvslider.min.css" rel="stylesheet">
<div id="home">
    <nav id="ac-globalnav" class="js no-touch svg no-ie7 no-ie8" role="navigation" aria-label="Global Navigation" data-hires="false" data-analytics-region="global nav" lang="en-US" data-store-key="SFX9YPYY9PPXCU9KH" data-store-locale="us" data-store-api="/[storefront]/shop/bag/status" data-search-locale="en_US" data-search-api="/search-services/suggestions/" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
    </nav>
    <nav id="ac-localnav" class="ac-ln-switch js no-touch svg no-ie7 no-ie8 no-css-sticky theme-dark ac-ln-sticking" lang="en-US" role="navigation" data-analytics-region="local nav locked" data-sticky="" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
    </nav>
   	<main class="main page-overview css-filter" role="main" data-page-type="overview" style="display: run-in;">

    <section class="section section-dark section-hero section-hero-overview" data-section-type="OverviewHeroSection" data-analytics-section-engagement="name:hero">
			<div class="section-background large-fixed" style="" >
				<div id="container_new" class="section-bleed large-fixed" style="">
					<?php echo $this->M_user->background_videos('home', 1); ?>
                                     
				</div>
			</div>
            
			<div class="section-foreground container" style="">
				<div class="hero-headline">
					<div class="section-image"></div>
					<div class="section-content row">
						<div class="col-sm-12">
                      <h1 class="hero-copy oswaldregularh1" style="" about="/content_tittle_join/"><div property="content" id="content_tittle_join">
                            <?php echo $this->M_text->getdatavalue('<_scontent_tittle_join_s>', "FANS<br />
                            FIND NEW & AMAZING ARTIST - ' MAKE MONEY ' <br/>"); ?>
                        </div></h1>
						<p class="opensans">
                            <a href="<?php echo base_url('account/signup') ?>" about="/content_a1_join/" class=""><span property="content" id="content_a1_join"><?php echo $this->M_text->getdatavalue('<_scontent_a1_join_s>', 'Join as Fan'); ?></span><i class="fa fa-arrow-circle-o-right"></i></a>
                            <a href="<?php echo base_url('subscriptions/upgrade') ?>" about="/content_a2_join/" class=""><span property="content" id="content_a2_join"><?php echo $this->M_text->getdatavalue('<_scontent_a2_join_s>', 'See Our Plans'); ?></span><i class="fa fa-arrow-circle-o-right"></i></a>
                            <a href="<?php echo base_url('make_money') ?>"  about="/content_a3_join/" class=""><span property="content" id="content_a3_join"><?php echo $this->M_text->getdatavalue('<_scontent_a3_join_s>', 'Learn More Fan'); ?></span><i class="fa fa-arrow-circle-o-right"></i></a>
						</p>
                        </div>
					</div>
					<div class="icon icon-paddledown" aria-hidden="true" style=""></div>
				</div>
                
				<div class="hero-intro is-absolute">
					<div class="section-content row fixsafari">
                        <div class="col-sm-12 ">
                            <h2 class="intro-headline oswaldregularh1" style="padding-bottom: 20px; padding-top: 10px;" about="/content_title_all/">
                            <div property="content" id="content_title_all" class="">
                                <?php echo $this->M_text->getdatavalue('<_scontent_title_all_s>', ' ARTIST <br class="small-hide"/>FIND & PAY YOUR FANS WITH OUR AMAZING TOOLS <br/> � 99sound.com') ?>							
                            </div>
    						</h2>
                           
    						<p class="intro-copy opensans" style="" about="/content_text_all/">
                                 <!--<div property="content" id="content_text_all">
                                    <?php echo $this->M_text->getdatavalue('<_scontent_text_all_s>', 'We are profoundly passionate about music.<br> Its a force thats driven and inspired us from day one. 
                                    <br class="small-hide"> This is 99Sound.com . And its just the beginning.
        							<br><br>'); ?>
                                </div>-->
                                <a class="opensans" href="<?php echo base_url('account/signup') ?>"  about="/content_header_pro_a1/"><span property="content" id="content_header_pro_a1"><?php echo $this->M_text->getdatavalue('<_scontent_header_pro_a1_s>', 'Join as Artist'); ?><i class="fa fa-arrow-circle-o-right" style="margin-left: 5px;"></i></span></a>
                                <a class="opensans" href="<?php echo base_url('features/artist') ?>"  about="/content_header_pro_a2/"><span property="content" id="content_header_pro_a2"><?php echo $this->M_text->getdatavalue('<_scontent_header_pro_a2_s>', 'Learn More Artist'); ?><i class="fa fa-arrow-circle-o-right" style="margin-left: 5px;"></i></span></a>
    						</p>
                        </div>
					</div>
				</div>
			</div>
		</section>
        
        <section class="section section-light section-itunes s4" data-section-type="OverviewITunesSection" data-analytics-section-engagement="name:itunes" style="padding: 40px 0;<?php echo $this->M_user->background('home', 3); ?>"><!--assets/images/bg/musical.png-->
			<div class="section-lightgrey section-hardware">
				<div class="container">
                    <h2 class="text-center oswaldregularh1" about="/content_title_home_new_worldwide/" style="color: #fff;"><div property="content" id="content_title_home_new_worldwide"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_new_worldwide_s>', 'Worldwide Featured Artist') ?></div></h2>
					<div class="row artists" id="s4" style="padding: 10px 0;">
                        <?php foreach ($worldwide_artists as $worldwide_artist) {
    ?>
                            <div class="col-sm-3 artist">
            					<div class="artist-wrapper">
            						<img class="first-slide" src="<?php echo $this->M_user->get_avata($worldwide_artist['id'])  ?>" alt="<?php echo $worldwide_artist['artist_name']; ?>" />
            						<div class="mask">
                                        
            							<h1><a href="<?php echo  base_url() ?><?php echo $worldwide_artist['home_page']; ?>"><?php echo $worldwide_artist['artist_name']; ?></a></h1>
            							<p><?php echo $worldwide_artist['genre_name']; ?> Artist</p>
            							<ul class="social">
            								<li><a href="https://www.facebook.com/" class="fa fa-facebook"></a></li>
            								<li><a href="https://www.instagram.com/" class="fa fa-instagram"></a></li>
            								<li><a href="https://twitter.com/" class="fa fa-twitter"></a></li>
            							</ul>
                                        
            						</div>
            					</div>
            				</div>
                        <?php 
} ?>
                        
					</div>
				</div>
			</div>
		</section>
        <section class="section section-light section-itunes s4" data-section-type="OverviewITunesSection" data-analytics-section-engagement="name:itunes" style="padding: 40px 0;<?php echo $this->M_user->background('home', 3); ?>"><!--assets/images/bg/musical.png-->
			<div class="section-lightgrey section-hardware">
				<div class="container">
                    <h2 class="text-center oswaldregularh1" about="/content_title_home_new_trending/" style="color: #fff;"><div property="content" id="content_title_home_new_trending"><?php echo $this->M_text->getdatavalue('<_scontent_title_home_new_trending_s>', 'NEW & TRENDING ARTIST') ?></div></h2>
					<div class="row" id="s4" style="padding: 10px 0;">
                        <?php foreach ($fans as $fan) {
    ?>
                            <div class="col-xs-6 col-md-3">
    							<div class="newtrend remix_items grid" >
                                    <a href="<?php echo  base_url() ?><?php echo $fan['home_page']; ?>">
                            		<figure class="effect-bubba">
                                        <img class="first-slide" src="<?php echo $this->M_user->get_avata($fan['id'])  ?>" alt="<?php echo $fan['artist_name']; ?>" />
                            								
                            			<figcaption>
                            				<h2><?php echo $fan['artist_name']; ?></h2>
                                            <p>MUSICIAN | <?php echo $fan['genre_name']; ?></p>
                            			</figcaption>
                            		</figure>
      		                        </a>
                                </div>
    						</div>
                        <?php 
} ?>
                        
					</div>
				</div>
			</div>
		</section>
    </main>
</div>
<section class="sponsors">
    <div class="container marketing2">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center oswaldregularh2">Visit Our Sponsors</h2>
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
    <?php 
} elseif (isset($user_data['id']) && $user_data['role'] == 2) {
    ?>
        <!--view login with account fans -->
    <?php 
} elseif (isset($user_data['id']) && $user_data['role'] == 3) {
    ?>
        <!--view login with account afflit-->
    <?php 
} ?>
<?php 
} else {
    ?>
    
<?php 
}?>

    
         
<script src="<?php echo base_url(); ?>assets/js/rvslider.min.js"></script>
<script>
	jQuery(function($){
		$('.rvs-container').rvslider();
	});
</script>
<script>

  // e-egg.
  jQuery('.css-chart').attr('tabindex', 0).on('wheel mousewheel keydown', function (e, delta) {
      var newval,
          num = $('div.css-chart p').css('padding-left');

      var delta = delta || e.originalEvent.deltaY * -1 || e.originalEvent.wheelDelta;

      if (delta > 0 || e.which == 38) {
          newval = parseFloat(num) + 10 * (e.shiftKey ? .1 : 1);
      } else if (delta < 0 || e.which == 40) {
          newval = parseFloat(num) - 10 * (e.shiftKey ? .1 : 1);
      } else {
          return true;
      }

      $('style.padleft').remove();
      $('<style class="padleft"> div.css-chart p { padding-left : '+newval+'px; } div.css-chart p i { width : '+2*newval+'px; } </style>').appendTo(document.body);

      e.preventDefault();
  });

  jQuery('h3 a').click(function () {
      $(this).siblings().andSelf().removeClass('selected').end().end().addClass('selected');
      $('#container').removeClass().addClass($(this).attr('class'));
      return false;
  }).last().click();

  var linkref = [
    null,
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
    '<?php echo base_url('gigs_events'); ?>',
  ];

  jQuery('#body a').click(function (e) {
    e.preventDefault();
    window.location = linkref[jQuery(this).attr('href').split('-')[1]];
  });

  jQuery('.css-chart').delegate('a', 'click', function () {
    var isTouch = 'ontouchstart' in document.documentElement;
    if (isTouch) return true;
    return false;
  });

  // ill mark the ghost browsers with (o) under them
  // these are here only to make it easier to compare year to year.

  var twenty13 = ['ie8','ie9','ie10','ff36','ff','op','sa','ch'].reverse();
  //                                  (o)
  var twenty12 = ['ie8','ie9','ie10','ff36','ff','op','sa','ch'].reverse();
  var twenty11 = ['ie7','ie8','ie9','ff36','ff','op','sa','ch'].reverse();
  var twenty10 = ['ie6','ie7','ie8','ff35','ff36','op','sa','ch'].reverse();
  var twenty09 = ['ie6','ie7','ie8','ff20','ff30','op96','sa32','ch2'].reverse();
  var twenty08 = ['ie5','ie6','ie7','ff1','ff20','op95','sa31','chX'].reverse();
  //               (o)               (o)                        (o)

  // thx to deepak jois for all the smarts of this.
  function syncPositions() {
    var rays = document.querySelectorAll('.css-chart > p em');
    for (var i = 0; i < rays.length; i++) {
      var ray = rays[i];
      for (var j = 0; j < window[ray.className].length; j++) {
        var curr = ray.children[j];
        if (curr && curr.className != window[ray.className][j]) {
          var b = document.createElement('b');
          b.className = 'ghostorunsupported';
          ray.insertBefore(b, curr);
        }
      }
    }

    $('input:checkbox').change(function () {
      $('.ghostorunsupported').toggle();
    });
  }

  jQuery(function(){
    $('<label><input type="checkbox">Fixed browser positions</label>')
      .one('change',syncPositions).wrap('<p>').parent().prependTo('#footer');
  });
  </script>

  <script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-15901079-1']);
    _gaq.push(['_trackPageview']);
    _gaq.push(['_setDomainName','none']);
    _gaq.push(['_setAllowLinker','true']);

    (function () {
      var ga = document.createElement('script'),
          elem = document.head || document.documentElement;   // FUCK YAH UNIMPLEMENTED HTML5 HAWTNESS
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
          'http://www') + '.google-analytics.com/ga.js';
      ga.setAttribute('async', 'true');
      setTimeout(function () { elem.insertBefore(ga, elem.firstChild); }, 100);
    })();
  </script>

?>