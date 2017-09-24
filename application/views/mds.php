<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<!--<link href="<?php echo base_url(); ?>assets/css/mds/bootstrap-combined.no-icons.min.css" rel="stylesheet">-->
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet" />
<script>
    if($(window).width() <768){
        $document.ready(function(){
           // $('#myCarousel').hide(); 
        });
    }
</script>	
<div id="mds" class="main_mds">
    <div class="marketing ">
        <div class="featurette" style="margin-top: 0;">
            <div id="example">
                <div class="mightyslider_modern_skin">
                    <div class="frame" data-mightyslider="width: 1920, height: 540">
                        <div class="slide_element">
                            <div class="slide" data-mightyslider="cover: '<?php echo base_url()?>assets/images/adaptable.jpg', owner: 'Chris Arena', title: 'Train'"></div>
                            <div class="slide" data-mightyslider="cover: '<?php echo base_url(); ?>assets/images/Bono-Paul-David-Hewson.jpg', title: 'Monday Morning'"></div>
                            <div class="slide" data-mightyslider="cover: '<?php echo base_url(); ?>assets/images/Band.jpg', owner: 'Billy Thompson', title: 'A Better Man'"></div>
                            <div class="slide" data-mightyslider="cover: '<?php echo base_url(); ?>assets/images/diamond-rio.jpg', owner: 'Paul Moran', title: 'Broken'"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container con_pad">
        <!--section class="port-slider" style="background-image: url(<?php echo base_url(); ?>assets/images/img/microperche.jpg); background-position: 0 -80px;"-->
		<div class="port-slider" style="">
			<div class="page-big-title" style="" about="/content_plat/">
                <h1 class="header_h1">
                <span property="content" id="content_plat">
                    <?php echo $this->M_text->getdatavalue('<_scontent_plat_s>', 'Music Distribution Platform'); ?>
                </span>    
                </h1>
                <a class="btn btn-primary" target="_blank" href="http://soundhouse.musicxip.com/login"> Login Musicxip</a>
                <a class="btn btn-success" href="<?=base_url()?>subscriptions/upgrade"> Signup </a>
            </div>    
        </div><!-- port-slider -->
	       <div class="gallery help_main">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/1.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>7digital stores offer a simple-to-use download service with sophisticated developed features to elevate the user experience both online and on mobile. 7digital’s music services are available globally and optimised for Europe and North America with dedicated stores in 42 countries.   7digital is also the world’s leading digital music and content technology platform. The company has provided digital music services to hundreds of international partners, including record companies, artists, retailers, consumer electronics companies and many other organisations. Using 7digital’s API, partners can create new music websites, applications and devices, or integrate music into existing services.   7digital’s global partner network includes Samsung, BlackBerry, Toshiba, HP, Acer, HTC, T-Mobile US, Ubuntu, Shazam, Last.fm, Winamp, Songbird and more listed below.  </li>
                              </ul>
                        	</span>
                    	</a>                       
                        <div class="cent-title"> 7Digital </div>                        
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/2.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Amazon Music (Formerly known as AmazonMP3)  offers millions of songs in high quality MP3 format. In addition to your music being available on Amazon.com, your fans will be able to access your music using Amazon’s Cloud Player for Kindle Fire HD/HDX, iOS, Android, PC, and Mac, or any other phone or tablet running the Google Android operating system. Amazon’s Cloud Drive and the Amazon Cloud Player will make it easy for your fans to purchase and listen to your music everywhere they go. </li>
                                  <li>On June 12, 2014 Amazon launched Prime Music. Amazon Prime customers can now listen ad-free to over a million songs and hundreds of expert-programmed playlists. Customers have the ability to download their favorite songs and Prime Playlists for offline playback on mobile devices.</li>
                                  <li>Content only becomes available for streaming to Amazon Prime customers 90 days after the release date.</li>
                              </ul>
                        	</span>
                    	</a>
                          <div class="cent-title"> Amazon Music </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/3.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                <li>Boinc is a social music service that enables users unlimited, on-demand access to a legal library of millions of songs, without subscription fees, downloads charges or advertising. Boinc is embedded into devices like computers, tablets and smartphones, even cars and TV's – and will eventually be available as a download app.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Boinc </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/4.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                <li>Claro música is a digital music service from the America Móvil Group, the leading wireless services provider in Latin America. Claro música gets your music heard in Mexico, Argentina, Colombia, and 12 other Latin American countries. Your fans can access your music when and however they want via Claromúsica's multi-platform experience.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Claro músicas </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/5.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                <li>Deezer is the market leader in music streaming worldwide with 20 million active users, over 5M paying subscribers, 35M tracks, and over 30,000 radio channels.</li>
                                <li>Today Deezer is the first music streaming service that does not rely on software downloads. In September 2011, Deezer announced a partnership with Facebook, an important international step that allowed Deezer to integrate its services into the world’s largest social network.</li>
                                <li>The strength of Deezer is it´s wordlwide presence in niche market, realized trough partnerships with local partners (Mainly telco´s).</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Deezer </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/6.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Digital Tunes is a reference download store for underground dance music, based in Finland. With a strong focus on the electronic genre, Digital Tunes have developed an impressive database of music ranging from Dubstep and Drum & Bass to UK Funky and Garage, as well as the deeper sides of Techno and House, in order to appeal to their users’ eclectic tastes.</li>
                                  <li>The strength of Digital Tunes is it´s unique policy of providing a single price for every format: This means a DJ can download a track in any and every format they fancy, be it WAV, FLAC or MP3, for the same price.</li>
                                  
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title">Digital Tunes</div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/7.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Forj Digital is a juggernaut of the mobile industry. For 14 years, Forj has been supplying content for mobile carriers. Using this service you can send your music as Ringtones, Real tones or Full Tracks to their mobile carrier partners (see below).</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title">Forj Digital</div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/8.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Google Play Music allows users to discover new music, share it with friends on Google+, and buy MP3 tracks online from any computer or Android device.</li>
                                  <li>The service includes an online music store that offers à la carte digital downloads of albums and tracks and  a subscription service called “Google Play All Access”. The subscription service allows subscribers to access Google Play’s entire library of subscription content via streams and conditional downloads on up to 10 authorized devices per account.</li>
                                  <li>Once in the locker, the music can be streamed on the web and any device, and even stored for offline listening on a mobile device.</li>
                                  <li>Artists are able to create an “Artist Page” (more info below) which features the artist’s albums for sale, as well as additional information and media such as band photos and an artist bio</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Google Play Music </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/9.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Gracenote, formerly called CDDB (Compact Disc Data Base), maintains and licenses an Internet-accessible database containing information about the contents of music albums. It provides software and metadata to music channels in the mobile, automobile, portable, home, and PC markets. Several channels, such as iTunes, use Gracenote's CDDB technology to identify Cds and provide metadata.</li>
                                  <li>Now Gracenote has more than 3,000 content partners, including major and independent music publishers, labels and movie studios, that power the biggest names in all major markets. It is also the service that powers Apple´s iTunes Genius.</li>
                                  <li>Distribute your music to this channel if you want to help your fans enjoy your songs and albums they already own in iTunes, Spotify and a host of other services.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Gracenote </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/10.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Guvera</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Guvera </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/11.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>iTunes is a media player, media library, online radio broadcaster, and mobile device management application developed by Apple Inc. It is used to play, download, and organize digital audio and video on personal computers running the OS X and Microsoft Windows operating systems. The iTunes Store is also available on the iPod Touch, iPhone, and iPad.</li>
                                  <li>Through the iTunes Store, users can purchase and download music, music videos, television shows, audiobooks, podcasts, movies, and movie rentals in some countries, and ringtones, available on the iPhone and iPod Touch (fourth generation onward).</li>
                                  <li>Apple Music is Apple´s premium subscription service, accesible via the iTunes interface. After an initial 3 month free trial, which users will only be able to access after providing credit card information, Apple Music will be only be available to paying subscribers. The service has a strong focus on editorial and artist features, including “Artist Connect”, which will allow approved artists to post free content directly on the service and interact with fans.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Apple Music </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/12.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>KDigital Media provides the broadest possible access to the Korean Market via a network of partner services. It is the gateway to Asia</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> K Digital </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/13.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>	MixRadio, formerly Nokia MixRadio, Nokia Music Store and OVI Music Store, is an on-demand music streaming subscription service. MixRadio allows free streaming of playlists without any subscriptions or ads available in 31 countries, including the US, Brazil, India and China. It has a catalogue of over 30 million songs.[1] Users can upgrade to MixRadio+ for $3.99 a month, this allows users to view lyrics, skips songs and download playlists, but the service is not available in all countries. The music file format used by the store is MP3 without any DRM protection. Mixradio is included in all Lumina phones. Currently the service is owned by LINE (UK) Limited. </li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Nokia Mix Radio </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/14.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Developed in 2012, Pulselocker was founded by Alvaro Velilla, Joshua Goltz and Grammy award-winning artist, Ben Harris of Dirty Vegas.</li>
                                  <li>The patented Locker feature uses unique technology to bridge content to DJ software, online or off. DJs can browse, discover, and mix music from a 26+ million-track catalog directly within their application of choice. Additionally, Pulselocker gives artists and labels new ways to monetize their current and back catalog. All content deliveries for Pulselocker are made through MediaNet.</li>
                                  <li>The basic subscription plan allows access to the service  for $9.99 per month; alongside a web-based interface, apps are available for Android, iOS, and Windows Phone.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title">Pulselocker</div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/15.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Rdio is an online music service that offers ad-supported free streaming service and ad-free subscription services in 60 countries. It is available as a website and also has clients for the iPhone, iPod Touch & iPad, Android, BlackBerry, and Windows Phone mobile devices, which can play streaming music or cache songs for offline playback. There are also clients for the Roku and Sonos systems. The web-based service also offers a native desktop client application for Mac OS X and Windows. Rdio also offers social networking, allowing users to share playlists and follow others to see what music they listen to. Features focusing on personalization and music discovery make it even easier for Rdio users to listen to music any way they want</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title">Rdio</div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/16.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Rhapsody is an online music store subscription service and a media player combined into one easy-to-use software program. You can subscribe to its music services to play and download over a million songs on demand, stream music or just use the media player to play your own CDs and MP3s.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Rhapsody-Napster </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/17.png" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Rhapsody is an online music store subscription service and a media player combined into one easy-to-use software program. You can subscribe to its music services to play and download over a million songs on demand, stream music or just use the media player to play your own CDs and MP3s.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Shazam</div>
                    </div>
                </div>
                 <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/18.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Spotify is a commercial music streaming service providing digital rights management-restricted content. Music can be browsed or searched by artist, album, genre, playlist, or record label. Free subscriptions can listen to music, interrupted by targeted advertisements. Paid "Premium" subscriptions remove advertisements and allow users to download music to listen to offline.</li>
                                  <li>The service has also introduced social functions such as the ¨Follow¨feature which allows following friends or artists, and verified artist profiles.</li>
                                  <li>Spotify was launched in October 2008 by Swedish startup Spotify AB.  As January 2015, the service has approximately 60 million users with 15 million subscribers.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Spotify</div>
                    </div>
                </div>
            </div>
        </div> <!--end gallery-->  
        <div class="gallery" style="margin-bottom: 30px;">
            <div class="row">
                 <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/20.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Xbox Music is a digital music service developed by Microsoft that offers music through subscription streaming and purchase through the Xbox Music Store. It is available on Xbox 360, Xbox One, Windows 8, Windows RT, Windows Phone 8, iOS and Android. The Xbox Music catalog has over 38 million tracks.</li>
                                  <li>Xbox Music is the successor service of Microsoft's Zune products, because of Microsoft's decision to discontinue the "Zune" brand in favor of the more appealing "Xbox" brand. Microsoft plans to focus the Xbox Music service to compete more directly with Apple's iTunes Store, Amazon Music, Spotify, Deezer and other streaming services.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> XBox Music </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/21.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>
                                  Sending your music to Youtube Content ID allows identifying your sound recordings when they are used anywhere on YouTube and collect revenue for each reproduction.
                                      <ol>
                                          <li>You choose which albums you want to collect money on.</li>
                                          <li>You distribute these albums to YouTube content ID.</li>
                                          <li>YouTube Content ID system identifies your recordings & revenue</li>
                                          <li>This revenue is deposited in your account´s sales balance</li>
                                      </ol>
                                  </li>
                                  <li>YouTube will also automatically generate buy links in case the music has been distributed to iTunes and Google Play.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Youtube Content Id </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/22.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>
                                  	YouTube Music Key allows watching and listening to music videos. YouTube Music Key pairs your song with your album cover art (YouTube calls this an “Art Track”) and you earn money when those Art Tracks are streamed on YouTube.  With a reach of one billion unique users monthly, YouTube Music Key gives you the power to connect with more fans worldwide.
                                  </li>
                                  <li>The service offers ad-free, audio-only playback for background listening in addition to video viewing, as well as offline listening.  It will also include a subscription to Google Play Music, with 30+ million songs, expert-curated playlists, and in the coming days, the ability to watch many YouTube official music videos right from the app.</li>
                                  <li>When you deliver an album to this channel, it will be made available and monetized in the YouTube Music Key service. Even if you have your music videos already on YouTube, adding YouTube Music Key gives you broader distribution and access to an additional income stream.</li>  
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Youtube Music </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="brand">
                        <a class="tooltip_custome" href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_mds/23.jpg" alt="" />
                            <span class="custom help">
                        	  <img src="<?php echo base_url()?>assets/icon/help.png" alt="Help" height="48" width="48" />
                        	  <em>Help</em>
                              <ul>
                                  <li>Zvooq -- Russian for "sound" -- is the leading Digital Music Service in Russia, Ukraine, Baltics, and Central Asia. The service launched in beta in June 2013 with mobile apps rolling out in Oct 2013 and full feature in June 2014, becoming the most downloaded app in the Russian iTunes App store.It's a multi-platform streaming service that can be used on PCs, smartphones and tablets. The service retains a catalog of 15 million songs, representing 500,000 artists and 25,000 labels.</li>
                              </ul>
                        	</span>
                    	</a>
                        <div class="cent-title"> Zvooq </div>
                    </div>
                </div>
            </div>
        </div> <!--end gallery-->      

		<div class="push"></div>
    </div>
    
   
        <div class="brand-platform">
			<div class="container">
				<div class="row">
					<div class="">
						<h1 class="text-center oswaldregularh3 wow slideInDown"  data-wow-delay="1s" style="color:#000;font-weight: bold !important;" about="/content_brand/"><span property="content" id="content_brand"><?php echo $this->M_text->getdatavalue('<_scontent_brand_s>', 'Your brand. Our Platform'); ?></span></h1>
                        <div class="bottomheader wow zoomIn"  data-wow-delay="1s"></div>
						<h3 class="text-center opensans wow slideInUp" data-wow-delay="1.5s" about="/content_brand_h3/"><span property="content" id="content_brand_h3"><?php echo $this->M_text->getdatavalue('<_scontent_brand_h3_s>', 'Our white label solution allows you to set up a fully functioning, customized Digital Music Distribution service with Royalty Reporting on your own domain without any effort.'); ?></span></h3>
                                                
                                                
					</div>
                                     <div class="iframe-section">
             <video controls="controls" width="640" style="width:100%;" poster="<?php echo base_url();?>/assets/images/Tutorial_EN_WL_OK.PNG">
	<source src="<?php echo base_url();?>/assets/background-videos/Tutorial_EN_WL_OK.mov" type="video/mp4" />
	<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" width="640" height="360">
		<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
		<param name="allowFullScreen" value="true" />
		<param name="wmode" value="transparent" />
		<param name="flashVars" value="config={'playlist':[{'url':'<?php echo base_url();?>/assets/background-videos/Tutorial EN_WL_OK.mov','autoPlay':false}]}" />
		<span title="No video playback capabilities, please download the video below"></span>
	</object>
</video>
  
        </div>
                                    
				</div>
			</div>
		</div><!--end brand-platform-->
        
        
    <div class="container">
		<div class="adp-biz" style="opacity: inherit;">
			<div class="">
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="db-wrapper">
							<div class="db-pricing-eight db-bk-color-one box-mds" >
								<ul>
									<li class="price" style="border:none;" about="/art_profile_li/">
									    <i class="fa fa-globe db-bk-color-one box-mds" style="background-color:#87CEFA !important; color:#fff;"></i>
                                        <span property="content" id="art_profile_li"><?php echo $this->M_text->getdatavalue('<_sart_profile_li_s>', 'Artist Profile'); ?></span>									   	
									</li>
                                    <p class="text-justify opensans2" style="padding: 8px;" about="/art_profile_li_/">
                                    
                                    <span property="content" id="art_profile_li_"><?php echo $this->M_text->getdatavalue('<_sart_profile_li__s>', 'Shoecase and share all your songs, videos and photos in one place. Track your song plays, profile view and total fans'); ?></span>
                                    </p>
									
								</ul>
								<!-- TODO: <div class="pricing-footer">
									  <a href="#" class="btn btn-custom ">REGISTER NOW <i class="glyphicon glyphicon-play-circle"></i></a>
								</div> -->
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="db-wrapper">
							<div class="db-pricing-eight db-bk-color-two box-mds" >
								<ul>
									<li class="price" style="border:none;" about="/sell_muc/">
                                        <i class="fa fa-money db-bk-color-one" style="background-color:#87CEFA; color:#fff;" ></i>
                                        <span property="content" id="sell_muc"><?php echo $this->M_text->getdatavalue('<_ssell_muc_s>', 'Sell Your Music'); ?></span>											
									</li>
									<p class="text-justify opensans2" style="padding: 8px;" about="/sell_muc_2/">
                                    <span property="content" id="sell_muc_2"><?php echo $this->M_text->getdatavalue('<_ssell_muc_2_s>', 'Set Your own prices for your songs and allbum and sell directly from your Artist Profile'); ?></span>
                                    </p>
								</ul>
								<!--<div class="pricing-footer">
									 <a href="#" class="btn btn-custom ">REGISTER NOW  <i class="glyphicon glyphicon-play-circle"></i></a>
								</div>-->
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="db-wrapper">
							<div class="db-pricing-eight db-bk-color-three box-mds" >
								<ul>
									<li class="price" style="border:none;" about="/email_soc/">
										<i class="fa fa-users db-bk-color-one" style="background-color:#87CEFA; color:#fff;"></i>
										
                                        <span property="content" id="email_soc"><?php echo $this->M_text->getdatavalue('<_semail_soc_s>', 'Email and Social Marketing'); ?></span>
									</li>
									<p class="text-justify opensans2" style="padding: 8px;" about="/add_te/"><span property="content" id="add_te"><?php echo $this->M_text->getdatavalue('<_sadd_te_s>', 'Add New fans to your email list. Sync your Artist Profile with your Facebook& Twtter account. Easily send updates to all your fans about your shows and releases'); ?></span></p>
								</ul>
								<!-- <div class="pricing-footer">
									<a href="#" class="btn btn-custom ">REGISTER NOW  <i class="glyphicon glyphicon-play-circle"></i></a>
								</div>-->
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="db-wrapper">
							<div class="db-pricing-eight db-bk-color-three box-mds">
								<ul>
									<li class="price" style="border:none;" about="/embed_/">
                                        <i class="fa fa-music db-bk-color-one" style="background-color:#87CEFA; color:#fff;"></i>										
                                         <span property="content" id="embed_"><?php echo $this->M_text->getdatavalue('<_sembed__s>', 'Embedded Players'); ?></span>
									</li>
									<p class="text-justify opensans2" style="padding: 8px;" about="/embed_p/"><span property="content" id="embed_p"><?php echo $this->M_text->getdatavalue('<_sembed_p_s>', 'Embed your songs on any site or soccial feed and tack the playr for each one. Customize Your color & branding to fit any site'); ?></span></p>
                                    
								</ul>
								<!-- <div class="pricing-footer">
									<a href="#" class="btn btn-custom ">REGISTER NOW  <i class="glyphicon glyphicon-play-circle"></i></a>
								</div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        
        
		<div class="digital-music" style="opacity: inherit;min-height: 525px;">
			<div class="row">
				<div class="col-md-12">
					<h1 class="header_h1" about="/dit_h1/"><span property="content" id="dit_h1"><?php echo $this->M_text->getdatavalue('<_sdit_h1_s>', 'Digital Music Distribution made easy'); ?></span></h1>
				</div>
				<div class="col-md-12" style="padding-top:15px ;">						
					<div class="col-xs-6 col-md-5 col-md-offset-2">
						<div class="db-pricing-eight db-bk-color-one" >
							<ul>
								<li class="price" about="/pric_/">
									<span property="content" id="pric_"><?php echo $this->M_text->getdatavalue('<_spric__s>', 'Pricing 4.95 monthly.'); ?></span>
                                    <br><span>COULD BE LESS – PICK YOUR DISTRO CHANNEL</span> 
								</li>
								<li about="/art_po/"><span property="content" id="art_po"><?php echo $this->M_text->getdatavalue('<_sart_po_s>', 'Artist Profile'); ?></span></li>
								<li about="/sel_mit/"><span property="content" id="sel_mit"><?php echo $this->M_text->getdatavalue('<_ssel_mit_s>', 'Sell Your Music'); ?></span></li>
								<li about="/em_soc/"><span property="content" id="em_soc"><?php echo $this->M_text->getdatavalue('<_sem_soc_s>', 'Email and Social Marketing'); ?></span></li>
                                <li about="/em_pay/"><span property="content" id="em_pay"><?php echo $this->M_text->getdatavalue('<_sem_pay_s>', 'Embedded Players'); ?></span></li>
							</ul>
							<!-- <div class="pricing-footer">
								<a href="<?php echo base_url(); ?>subscriptions/checkout/MDS" class="myButton">SIGN UP <i class="glyphicon glyphicon-play-circle"></i></a>
							</div> -->
						</div>
					</div>
                   <!--  <div class="col-xs-6 col-md-3">
						<ul class="text-center">
							<li about="/mds_too/"><i class="fa fa-check  icon-custom" ></i><span property="content" id="mds_too"><?php echo $this->M_text->getdatavalue('<_smds_too_s>', 'MDS to sell under the free plan for those artist not signing up for monthly subscriptions'); ?></span></li>
							<li about="/if_yoo/"><i class="fa fa-dollar  icon-custom"></i><span property="content" id="if_yoo"><?php echo $this->M_text->getdatavalue('<_sif_yoo_s>', 'If You cancel songs are taken down at $1.00 per song and your credit card is charged for the whole year owed.'); ?></span> </li>
                        </ul>
					</div> -->
				</div>
			</div>
		</div>		
		<div class="sponsors">         
            <h1 class="text-center" style="color:#fff; padding: 40px 0 5px 0;" about="/content_homes1_tittle_new1_88/">
                 <span property="content" id= "content_homes1_tittle_new1_88">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_88_s>', 'Visit Our Sponsors');
                    ?>
                </span>
           </h1>
            <div class="bottomheader wow zoomIn"  data-wow-delay="1s"></div>
			<div class="row">
				<div class="col-xs-4 col-md-2"><a href="http://dittytv.com"><img src="<?php echo base_url(); ?>assets/images/ditty-tv.png" class="img-responsive img-sponser"></a></div>
				<div class="col-xs-4 col-md-2"><a href="http://planetlarecords.com"><img src="<?php echo base_url(); ?>assets/images/Planet-LA-Records.jpg" class="img-responsive img-sponser"></a></div>
				<div class="col-xs-4 col-md-2"><a href="http://aktivatedmusic.com"><img src="<?php echo base_url(); ?>assets/images/1799088_693516810711011_1580074293_o-672x706.jpg" class="img-responsive img-sponser"></a></div>
				<div class="col-xs-4 col-md-2"><a href="http://www.universalmusic.com/"><img src="<?php echo base_url(); ?>assets/images/sponsor4.png" class="img-responsive img-sponser"></a></div>
				<div class="col-xs-4 col-md-2"><a href="http://www.universalmusic.com/"><img src="<?php echo base_url(); ?>assets/images/sponsor3.png" class="img-responsive img-sponser"></a></div>
				<div class="col-xs-4 col-md-2"><a href="http://www.livenation.com/"><img src="<?php echo base_url(); ?>assets/images/ticketmaster-ln.jpg" class="img-responsive img-sponser"></a></div>
			</div>
		</div>
    </div>
</div><!-- end mds-->        
<?php include 'includes/footer.php';?>