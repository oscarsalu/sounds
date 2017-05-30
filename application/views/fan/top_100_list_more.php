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