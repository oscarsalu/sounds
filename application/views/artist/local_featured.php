<link rel="stylesheet" href="<?php base_url() ?>assets/homepage/music.built.css"/>
<link rel="stylesheet" href="<?php base_url() ?>assets/css/jquery.mCustomScrollbar.css">
<div class="wp-container" id="localfa" style="z-index:998;<?php echo $this->M_user->background('local_featured',1); ?>">
    <div class="container">
        <div class="wrapper_slide wrapper--demo">
        	<h3 class="text-center" style="color: #FFF;" >Local-Featured Artist</h3>
    		<div class="opensans" >
                
                <p><span class="text-white">The</span> <span class="local-city"><?php echo $cityartist ?>, <?php echo $country ?></span> <!--<span class="text-white">Charts</span> <span class="local-all"><a href="#">Change Location</a></span>--></p>
                
            </div>
        </div>
        <div class="col-md-12" id="load_result">
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
                            <?php echo $var['home_page']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
} ?>
        </div>
        <div id="load_image"><img src="<?php echo base_url().'assets/img/loader.gif'; ?>" /></div>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
        var page = 1;
        $(window).bind(mousewheelevt, function(e){
            var evt = window.event || e //equalize event object     
            evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
            var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF
        
            if(delta < 0){
                var aTop = $('html').height();
                if($(this).scrollTop() >= (aTop - 730)){
                    $("#load_image").css("display","block");
                    page = page + 1;
                    $.post( "<?php echo base_url('features/local_featured_load_more') ?>", {page: (page-1),<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'  },
                    function(data){
                        if(data == ""){
                            $("#load_image").remove();
                        }
                        $("#load_result").append(data);
                        $("#load_image").css("display","none");
                    });
                    
                    
                }
            }   
        });
    });
</script>
<script src='<?php echo base_url(); ?>assets/artists/jquery.transit.min.js'></script>

<script src='<?php echo base_url(); ?>assets/artists/artist.js'></script>

