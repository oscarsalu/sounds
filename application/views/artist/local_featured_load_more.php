<?php foreach ($city as $var) {
    ?>
<div class="col-xs-6 col-md-4">
    <div class="local-container">
        <a href="<?php echo  base_url() ?><?php echo $var['home_page']; ?>"  class="dialogload"><img src="<?php echo base_url().'uploads/'.$var['usid'].'/photo/'.$var['avata'] ?>" class="img-responsive" /></a>
        <div class="local-artist">
            <div class="local-name">
                <div class="local-nt"><span class="local-artistname"><a href="#"><?php echo $var['artist_name'] ?></a></span> | <?php echo $var['genre_name'] ?>
                    <p><i class="fa fa-map-marker" style="padding: 0 5px;"></i><?php echo $var['city'] ?></p>
                </div>
            </div>
            <hr style="clear: both;" />
            <div class="local-bio mCustomScrollbar">
                <h5>BIO</h5>
                <p class=""><?php echo $var['bio']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php 
} ?>