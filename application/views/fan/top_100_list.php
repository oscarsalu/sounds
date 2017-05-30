<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/styletai.css" />

<div id="top100 home " style="min-height: 100vh;z-index:998;<?php echo $this->M_user->background('top_100_list',1); ?>" class="top100">
    <section class="s4" style="padding: 40px 0" >
			<div class="container">
		        <div class="text-center" style="color: #fff; margin: 15px 0;">
                    <h2 class="oswaldregularh3 wow zoomIn"  data-wow-delay="1s" about="/content_homes1_tittle_new1_61/">
                        <span property="content" id= "content_homes1_tittle_new1_61">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_61_s>', 'TOP 100 LIST');
                            ?>
                        </span>
                    </h2>
                   
                        
                  
        			<div class="line wow zoomIn"  data-wow-delay="1s" ></div>
                    <p class="opensans excerpt wow zoomIn"  data-wow-delay="1s" about="/content_homes1_tittle_new1_62/">
                    <span property="content" id= "content_homes1_tittle_new1_62">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_62_s>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.');
                            ?>
                        </span>
                    
                    </p>
                 </div>
                 
				<div class="row" id="load_result" style="padding: 10px 0;">
                    <?php foreach ($list_100 as $fan) {
    ?>
                        <div class="col-xs-6 col-sm-4 col-md-3">
							<div class="newtrend remix_items grid" >
                                <a href="<?=$this->M_user->get_url_alp($fan['user_id'])?>">
                        		<figure class="effect-bubba">
                        		    <img class="first-slide img-responsive" src="<?=$this->M_user->get_avata($fan['user_id'])?>" alt="<?=$this->M_user->get_name($fan['user_id'])?>" />
                        			<figcaption>
                        				<h2><?=$this->M_user->get_name($fan['user_id']) ?> </h2>  
                                        <p>
                                           Total: <?php echo $fan['total']; ?> $
                                        </p>                                      
                        			</figcaption>
                        		</figure>
  		                        </a>
                            </div>
						</div>
                    <?php 
} ?>
				</div>
			</div>
            <div id="load_image"><img src="<?php echo base_url().'assets/img/loader.gif'; ?>" /></div>
	</section>
</div>
<script type="text/javascript">
var find_a_fan_more = "<?php echo base_url('fan/fan_load_more') ?>";
var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script src="<?php base_url() ?>assets/js/detail_pages/fan/top_100_list.js"></script>
