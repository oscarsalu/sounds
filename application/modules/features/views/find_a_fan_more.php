<?php foreach ($result_display as $value) { ?>
<div class="col-xs-6 col-sm-4 col-md-3">
	<div class="newtrend remix_items grid" >
        <a href="#">
		<figure class="effect-bubba">
            <img class="first-slide img-responsive" src="<?php echo  base_url() ?>uploads/<?php echo $value->usid; ?>/photo/<?php echo $value->avata; ?>" />
			<figcaption>
				<h2><?php echo $value->artist_name ?></h2>
                <p>MUSICIAN | <?php echo $value->genre ?></p>
			</figcaption>
		</figure>
        </a>
    </div>
</div>
<?php } ?>