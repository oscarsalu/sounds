<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/styletai.css" />

<div id="top100 home " class="top100">
    <section class="s4" style="padding: 40px 0" >
			<div class="container">
		        <div class="text-center" style="color: #fff; margin: 15px 0;">
                    <h2 class="oswaldregularh3 wow zoomIn"  data-wow-delay="1s">TOP 100 LIST</h2>
        			<div class="line wow zoomIn"  data-wow-delay="1s"></div>
                    <p class="opensans excerpt wow zoomIn"  data-wow-delay="1s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>
                 </div>
                 
				<div class="row" id="s4" style="padding: 10px 0;">
                    <?php foreach ($top_list_100 as $fan) {
    ?>
                        <div class="col-xs-6 col-sm-4 col-md-3">
							<div class="newtrend remix_items grid" >
                                <a href="<?php echo  base_url() ?>amp/<?php echo $fan->home_page; ?>">
                        		<figure class="effect-bubba">
                        			<img class="first-slide img-responsive" src="<?=$this->M_user->get_avata($fan->id)?>" alt="<?=$this->M_user->get_name($fan->id)?>" />
                                    <figcaption>
                        				<h2><?=$this->M_user->get_name($fan->id)?></h2>
                                        <p>MUSICIAN </p>
                        			</figcaption>
                        		</figure>
  		                        </a>
                            </div>
						</div>
                    <?php 
} ?>
				</div>
			</div>
	</section>
</div>