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
    
    <div class="row kk-row">
        <div class="col-md-3 wrapper_left">
            <div class="side-menu kk">
    			<nav class="navbar navbar-default" role="navigation">
    				<!-- Brand and toggle get grouped for better mobile display -->
    				<!--
                    <div class="navbar-header">
    					<div class="brand-wrapper">
    						// Hamburger 
    						<button type="button" class="navbar-toggle">
    						<span class="sr-only">Toggle navigation</span>
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>
    						</button>
    						 Brand 
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
        <div class="col-md-9" id="view_all">
            
            
			<div class="row">
                <h1 class="header_h1"> 
                    <?php if (count($name_genres) > 0) {
    ?>
    				
            				 <?php 
                                $i = 0;
    foreach ($name_genres as $u) {
        ?>
            					   <?php echo ucfirst($u['name']) ?>
                                    
                                <?php 
    } ?>
            			
    				<?php 
} ?>
                    
                </h1>
            <div id="content-1" class="content horizontal-images">
                <?php if (count($event) > 0) {
    $count = count($event);
                // print_r($just);
                ?>
				<ul>
				 <?php 
                    $i = 0;
    foreach ($event as $u) {
        ?>
					
                        <?php // if(($count > 4) &&  $i==10){echo "</ul><ul>"; $i=0;} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
                            <!---lam tiep tuc-->
                            
        						<a  class="item" data-gal="photo"  title="" rel="bookmark" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $u['event_title'])).'-'.$u['event_id'])?>">
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
        <?php if (count($event) <= 0) {
    $count = count($event);
                // print_r($just);
                ?>
				
            <div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new41/">
               <span property="content" id= "content_homes1_tittle_new41">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new41_s>', 'JUST ANNOUNCED'); ?>
            </span>  
           </h1>
            <div id="content-1" class="content horizontal-images">
            
			<?php if (count($just) > 0) {
    $count = count($just);
                // print_r($just);
                ?>
				<ul>
				 <?php 
                    $i = 0;
    foreach ($just as $just_event) {
        ?>
					
                        <?php // if(($count > 4) &&  $i==10){echo "</ul><ul>"; $i=0;} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a class="item" data-gal="photo"  href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $just_event['event_title'])).'-'.$just_event['event_id'])?>" title="" rel="bookmark">
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$just_event['user_id'].'/photo/banner_events/'.$just_event['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($just_event['event_title']); ?></h2>
            								<p>Singer</p>
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
            
            <?php if (count($events) > 0) {
    $count = ceil(count($events) / 2); ?>
			<div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new42/">
                  <span property="content" id= "content_homes1_tittle_new42">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new42_s>', ' EVENTS'); ?>
            </span> 
           </h1>
            <div id="content-event" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                
                <ul>
                    <?php 
                    $i = 0;
    foreach ($events as $event) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col" >
        						<a  class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>" title="" rel="bookmark">        							
        						
            						<figure class="effect-bubba">                                     
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($event['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
               
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($pops) > 0) {
    $count = ceil(count($pops) / 2); ?>
			<div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new43/">
                  <span property="content" id= "content_homes1_tittle_new43">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new43_s>', ' POP'); ?>
                 </span>
            </h1>
            <div id="content-pop" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($pops as $pop) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $pop['event_title'])).'-'.$pop['event_id'])?>" title="" rel="bookmark">
        						
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$pop['user_id'].'/photo/banner_events/'.$pop['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($pop['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($rocks) > 0) {
    $count = ceil(count($rocks) / 2); ?>
			<div>
            <h1 class="header_h1" about="/content_homes1_tittle_new44/">
                  <span property="content" id= "content_homes1_tittle_new44">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new44_s>', ' ROCK'); ?>
                 </span>
            </h1>
            <div id="content-rock" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($rocks as $rock) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a id="view_event" class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $rock['event_title'])).'-'.$rock['event_id'])?>" title="" rel="bookmark">
        							
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$rock['user_id'].'/photo/banner_events/'.$rock['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($rock['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($dances) > 0) {
    $count = ceil(count($dances) / 2); ?>
			<div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new45/">
                   <span property="content" id= "content_homes1_tittle_new45">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new45_s>', ' dance and hiphop'); ?>
                 </span>
            </h1>
            <div id="content-dance" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($dances as $dance) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $dance['event_title'])).'-'.$dance['event_id'])?>" title="" rel="bookmark">
        							
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$dance['user_id'].'/photo/banner_events/'.$dance['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($dance['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($rbs) > 0) {
    $count = ceil(count($rbs) / 2); ?>
			<div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new46/">
                   <span property="content" id= "content_homes1_tittle_new46">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new46_s>', 'r & b'); ?>
                 </span>
            </h1>
            <div id="content-rbs" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($rbs as $rb) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a id="view_event" class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $rb['event_title'])).'-'.$rb['event_id'])?>" title="" rel="bookmark">
        							
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$rb['user_id'].'/photo/banner_events/'.$rb['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($rb['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($djs) > 0) {
    $count = ceil(count($djs) / 2); ?>
			<div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new47/">
                <span property="content" id= "content_homes1_tittle_new47">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new47_s>', 'dj'); ?>
                 </span>
            </h1>
            <div id="content-dj" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($djs as $dj) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a  class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $dj['event_title'])).'-'.$dj['event_id'])?>" title="" rel="bookmark">
        						
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$dj['user_id'].'/photo/banner_events/'.$dj['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($dj['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($childens) > 0) {
    $count = ceil(count($childens) / 2); ?>
			<div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new48/">
               <span property="content" id= "content_homes1_tittle_new48">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new48_s>', 'CHILDREN'); ?>
                 </span>
            </h1>
            <div id="content-child" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($childens as $child) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a  class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $child['event_title'])).'-'.$child['event_id'])?>" title="" rel="bookmark">
        							
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$child['user_id'].'/photo/banner_events/'.$child['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($child['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($punks) > 0) {
    $count = ceil(count($punks) / 2); ?>
			<div class="row">
            <h1 class="header_h1" about="/content_homes1_tittle_new49/">
               <span property="content" id= "content_homes1_tittle_new49">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new49_s>', 'Punk and Hardcore'); ?>
                 </span>
            </h1>           
            <div id="content-punks" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($punks as $punk) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a  class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $punk['event_title'])).'-'.$punk['event_id'])?>" title="" rel="bookmark">
      								
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$punk['user_id'].'/photo/banner_events/'.$punk['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($punk['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($staffs) > 0) {
    $count = ceil(count($staffs) / 2); ?>
			<div class="row">
           
            <h1 class="header_h1" about="/content_homes1_tittle_new_1/">
               <span property="content" id= "content_homes1_tittle_new_1">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new_1_s>', 'Staff Picks'); ?>
                 </span>
            </h1>   
            <div id="content-staff" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($staffs as $staff) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a  class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $staff['event_title'])).'-'.$staff['event_id'])?>" title="" rel="bookmark">
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$staff['user_id'].'/photo/banner_events/'.$staff['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($staff['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div>
            </div>
            <?php 
} ?>
            <?php if (count($festivals) > 0) {
    $count = ceil(count($festivals) / 2); ?>
			<div class="row">
            
            <h1 class="header_h1" about="/content_homes1_tittle_new_10/">
               <span property="content" id= "content_homes1_tittle_new_10">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new_10_s>', 'Festivals'); ?>
                 </span>
            </h1> 
            <div id="content-festivals" <?php if ($count <= 4) {
    echo 'style="height: 250px;"';
} ?>  class="content horizontal-images">
                <ul>
                    <?php 
                    $i = 0;
    foreach ($festivals  as $festival) {
        ?>
                        <?php if (($count > 4) && $count == $i) {
    echo '</ul><ul>';
} ?>
                        <li>
                            <div class="remix_items grid clearfix four_col">
        						<a  class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $festival['event_title'])).'-'.$festival['event_id'])?>" title="" rel="bookmark">
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$festival['user_id'].'/photo/banner_events/'.$festival['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($festival['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                        </li>
                    <?php 
                    ++$i;
    } ?>
               </ul>
            </div><!-- end div--->
            </div>
            <?php 
} ?>
        </div>
    </div>
    
    <?php 
} ?>
    <div class="row col-md-12 coming" id="gigs-events">      
        <h2 class="header_h1 text-center" about="/content_homes1_tittle_new_10/">
            <span property="content" id= "content_homes1_tittle_new_10">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new_10_s>', ' Comming Soon');
                    ?>
            </span>
       </h2>
        <div class="px-grally fancy-grally ">
            <div class="gallery content horizontal-images" style="height: 250px;" id="content-coming">
            <ul>
              <?php 
              if (isset($commings)) {
                  foreach ($commings  as $c_s) {
                      echo ' <li>'; ?>
                            <div class="remix_items grid clearfix four_col">
        						<a  class="item" data-gal="photo" href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $c_s['event_title'])).'-'.$c_s['event_id'])?>" title="" rel="bookmark">
        						
            						<figure class="effect-bubba">
            							<img width="500" height="360" src="<?php echo base_url().'uploads/'.$c_s['user_id'].'/photo/banner_events/'.$c_s['event_banner']; ?>" class="attachment-type_cover wp-post-image" alt="" />							
                                        <figcaption>
            								<h2><?php echo ucfirst($c_s['event_title']); ?></h2>
            								<p>Singer</p>
            							</figcaption>
                                    </figure>
        					   </a>
                            </div>
                    <?php 
                     echo '</li>';
                  }
              }?>
            
            </ul>
            </div>
        </div>
    </div>
    
</div>

<!--modal_view_event-->
<div class="modal fade" id="modal_view_event">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">EVENTS</h3>
			</div>
			<div class="modal-body">
                <div class="row">
                     <div class="panel panel-primary" id="info_event_show">
                     
                     </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>				
			</div>
		</div>
	</div>
</div>

<!--end modal_view_event-->
<script src="<?php echo base_url(); ?>assets/js/detail_pages/gigs_events/gigs_events.js"></script>               
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/jquery-ui/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>assets/jquery-ui/external/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="<?php echo base_url(); ?>assets/js/bxslider/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url(); ?>assets/js/bxslider/jquery.bxslider.css" rel="stylesheet" />     
<script src="<?php echo base_url(); ?>assets/js/detail_pages/gigs_events/gigs_events_next.js"></script> 

