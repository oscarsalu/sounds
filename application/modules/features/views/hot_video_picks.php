<link href="<?php echo base_url() ?>assets/css/rvslider.min.css" rel="stylesheet">

<section class="artist-crowd" style="z-index:998;<?php echo $this->M_user->background('home',8); ?>">
    <div class="container">
        
             <h1 class="text-center wow slideInUp oswaldregular" style="color:#fff;" about="/content_homes1_tittle_new2_22/">                                                
                    <span property= "content" id= "content_homes1_tittle_new2_22">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new2_22_s>',"Hot Picks Of The Week");
                        ?>
                    </span>                                
   	        </h1>                 
  
    
          <h4 class="text-center wow slideInUp opensans" style="color:#fff;"  about="/content_homes1_tittle_new2_23/">                                 
                  <span property= "content" id= "content_homes1_tittle_new2_23">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new2_23_s>',"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...");
                        ?>
                    </span>  
              
          </h4>
         
        <p>&nbsp;</p> 
    </div> 
<div class="rvs-container" style="z-index:998;">

	<div class="rvs-item-container">
		<div class="rvs-item-stage">
            <?php foreach($vids as $vid){?>
                <div class="rvs-item" style="background-image: url(https://i.ytimg.com/vi/<?php echo substr($vid['link_video'],32,11); ?>/maxresdefault.jpg)">
				    <p class="rvs-item-text"><?php echo $vid['name_video']; ?> - <a href="<?php echo  base_url() ?><?php echo $vid["home_page"]; ?>"><?php echo 'By '.ucfirst($vid['home_page']); ?></a></p>
				    <a href="<?php echo $vid['link_video']; ?>" class="rvs-play-video"></a>
			</div>
            <?php } ?>
		</div>
	</div>

	<div class="rvs-nav-container">
		<a class="rvs-nav-prev"></a>
		<div class="rvs-nav-stage">
            
			<!-- The below is the corresponding nav item for the single item, simply duplicate this layout for each item -->
            <?php foreach($vids as $vid){ ?>
                <a class="rvs-nav-item">
    				<div class="rvs-nav-item-thumb" style="background-image: url(https://i.ytimg.com/vi/<?php echo substr($vid['link_video'],32,11); ?>/default.jpg)"></div>
    				<!--small class="rvs-nav-item-credits"-->                        
                        <img src="<?php echo $this->M_user->get_avata($vid['u_id'])?>" class="thumb" height="70" width="70" alt="<?php echo ucfirst($vid['home_page']); ?>" />                        
                        <h4 class="rvs-nav-item-title"><?php echo ucwords($vid['name_video']); ?></h4>
                        <!--a class="artist-page" href="<?php //echo base_url().$vid['home_page']; ?>"-->
                        <h5 class="rvs-nav-item-by"><?php echo 'By '.ucfirst($vid['home_page']); ?></h5>                        
                    <!--/small-->
    			</a>
            <?php } ?>        
			
		</div>
		<a class="rvs-nav-next"></a>
	</div>

</div>
</section>

<script src="<?php echo base_url(); ?>assets/js/rvslider.min.js"></script>
<script>
	jQuery(function($){
		$('.rvs-container').rvslider();
	});
</script>