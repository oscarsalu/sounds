<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<div class="row fan-capture" id="fancapture gigs" >
    <!-- Filter-->
    <div class="filter" style="padding: 30px 0;">
        <h1 class="text-center oswaldregularh3">Gigs & Events</h1>
        <div class="bottomheader wow zoomIn" data-wow-delay="1s"></div>
            <div class="backgound_searchfan fix-gig">
                <div class="container opensans2">
                   <form action="<?php echo base_url('artist/event_search')?>" class="searchform" method="get">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type='text' class="form-control" name="search" id="search" placeholder="Artist, venue or location" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type='text' class="form-control" name="event_start_date" id="event_start_date" placeholder="Start Date" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type='text' class="form-control" name="event_end_date" id="event_end_date" placeholder="End Date" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <input type="submit" value="Search" id="search" style="width: 100%;" /> 
                            </div>
                        </div>
                   </form>  
                </div>        
            </div>   
    </div>
    <!--
        <div class="row filter" style="padding: 30px 0;">
        <h1 class="text-center oswaldregularh3">Gigs & Events</h1>
        <div class="bottomheader wow zoomIn" data-wow-delay="1s"></div>
        <form action="<?php echo base_url('fancapture/search_fcp')?>" class="searchform" method="get">
            <div class="backgound_searchfan col-xs-12 col-sm-12 col-md-12 fixg">
                <div class="col-xs-0 col-sm-0 col-md-2 "></div>
                <div class="col-xs-6 col-sm-6 col-md-2 ">
                    <input type='text' class="form-control" name="search" id="search" placeholder="Artist, venue or location" />
                </div>  
                <div class="col-xs-6 col-sm-6 col-md-2">  
                    <input type='text' class="form-control" name="event_start_date" id="event_start_date" placeholder="Start Date" />
                </div> 
                <div class="col-xs-6 col-sm-6 col-md-2 ">
                    <input type='text' class="form-control" name="event_end_date" id="event_end_date" placeholder="End Date" />
                </div> 
                 
                <div class="col-xs-6 col-sm-6 col-md-2 ">
                    <input type="submit" value="Search" id="search" /> 
                </div>        
            </div>
            
        </form>               
    </div>
    -->
    <div class="row kk-row">
        <div class="col-md-3 wrapper_left">
            <div class="side-menu kk">
    			<nav class="navbar navbar-default" role="navigation">
    				<!-- Brand and toggle get grouped for better mobile display -->
    				<div class="navbar-header">
    					<div class="brand-wrapper">
    						<!-- Hamburger -->
    						<button type="button" class="navbar-toggle">
    						<span class="sr-only">Toggle navigation</span>
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>
    						</button>
    						<!-- Brand -->
    						<div class="brand-name-wrapper">
    							<a class="navbar-brand" href="#">
    							List
    							</a>
    						</div>
    					</div>
    				</div>
    				<!-- Main Menu -->
    				
                    <div class="side-menu-container">
                        <?php if (count($genres) > 0) {
    $count = count($genres); ?>
            			
        					<ul class="nav navbar-nav fix-nav" style="margin: 0;">
                                <?php 
                                    $i = 0;
    foreach ($genres as $g) {
        ?>
            						<li><a href="<?php echo  base_url().'gigs_events/'.$g['id']; ?>"><span class="fa fa-gift"> <?php echo strtoupper($g['name']); ?> </span> </a></li>
                                <?php 
                                ++$i;
    } ?>
                            </ul>   
                                <?php 
} ?>
        						
        					
    				</div>
    				<!-- /.navbar-collapse -->
    			</nav>
    		</div>
        </div>
        <div class="col-md-9">
            
            <div class="row">
                <h1 class="header_h1">Results search event
                    
                </h1>
            <div id="content-1" class="content horizontal-images">
                <?php if (count($list_event) > 0) {
    $count = count($list_event);
                // print_r($just);
                ?>
				<ul>
				 <?php 
                    $i = 0;
    foreach ($list_event as $u) {
        ?>
					
                        <?php // if(($count > 4) &&  $i==10){echo "</ul><ul>"; $i=0;} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a class="item" data-gal="photo" href="#" title="" rel="bookmark">
        							
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$u['user_id'].'/photo/banner_events/'.$u['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($u['event_title']); ?></h2>
            								<p>
                                                User: <?php echo ucfirst($u['firstname']); ?><br />
                                                 <?php echo ucfirst($u['artist_name']); ?><br />                                                    
                                            </p>
                                            
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
				</ul>
				<?php 
} ?>
                
           </div>
            </div>
			<div class="row">
                
           </div>
            </div>
        
            
			
            
        </div>
    </div>
    <div class="row col-md-12 coming" id="gigs-events">
        <h2 class="header_h1 text-center">Comming Soon</h2>
        <div class="px-grally fancy-grally ">
            <div class="gallery content horizontal-images" style="height: 250px;" id="content-coming">
            <ul>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/img-profile.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/Heartattack.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/music-prince.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/ted-nugent.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/4.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/Statue - Ray Charles.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/piano.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
                <li>
                    <article class="fixedwidth col-md-2 col-sm-4 col-xs-6"> 
                        <figure class="effect-selena"> 
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url();  ?>assets/images/PaulMoran.jpg">
                            </a> 
                            <a href="#" > 
                                <div class="px-text"> 
                                    <i class="icon-camera5"></i> 
                                    <span>Marcus</span> 
                                    <em></em>
                                </div> 
                            </a> 
                        </figure> 
                    </article>
                </li>
            </ul>
            </div>
        </div>
    </div>
    
</div>

    <script src="<?php echo base_url(); ?>assets/artists/js/event_search.js"></script>           
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/jquery-ui/jquery-ui.min.css">
    <script src="<?php echo base_url(); ?>assets/jquery-ui/external/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script>
    <!-- bxSlider Javascript file -->
    <script src="<?php echo base_url(); ?>assets/js/bxslider/jquery.bxslider.min.js"></script>
    <!-- bxSlider CSS file -->
    <link href="<?php echo base_url(); ?>assets/js/bxslider/jquery.bxslider.css" rel="stylesheet" />    
     <script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/event_search_1.js"></script> 
     <script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/event_search_2.js"></script> 
  
