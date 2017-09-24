<link href="<?php echo base_url(); ?>assets/artists/artist.css" rel="stylesheet" />

<div class="wp-container">
    <div class="wrapper_slide wrapper--demo">
    	<div class="carousel">
    		<div class="carousel__content">
                <?php foreach($banner_artists as $banner_artist){ ?>
                    <div class="item">
                        <div class="title">
                            <a href="<?php echo  base_url() ?><?php echo $banner_artist["home_page"]; ?>">
                            <h2><?php echo $banner_artist["artist_name"]; ?></h2>
                            <h3><?php echo $banner_artist["genre_name"]; ?> Artist</h3>
                            <p><?php echo $banner_artist["bio"]; ?></p>
                            </a>
                        </div>
                        <img src="<?php echo base_url(); ?>uploads/<?php echo $banner_artist["id"] ;?>/photo/banner/<?php echo $banner_artist["banner_image"]; ?>" alt="" />
                    </div>
                <?php } ?>
    		</div>
    	</div>
    </div>
    <div class="wapper_search_main">
        <div class="col-md-6 wapper_search">
            <form class="form form-signup" role="form" action="<?php echo base_url().'auth/step3'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="col-md-6 col-sm-5 ">
                    <div class="form-group">
                         <div class="search ">
                             <select class="defaut_input form-control" id="change_genre" name="genre" >
                                <option value="0">All Genre</option>
                                <?php 
                                foreach($genres as $key){
                                    ?><option value="<?php echo $key['id'] ?>"><?php echo $key['name']?></option><?php 
                                }
                                ?>
                            </select>
                            <?php echo form_error('genre', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		
                         </div>
                      </div>
                </div>
                <div class="col-md-6 col-sm-5 ">
                <?php
                    function getDay($day)
                    {
                        $days = ['Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6, 'Sunday' => 7];
                        
                        $today = new \DateTime();
                        $today->setISODate((int)$today->format('o'), (int)$today->format('W'), $days[ucfirst($day)]);
                        return $today;
                    }
                ?>
                <p class="showdate"><?php echo getDay('Monday')->format('F dS, Y');?> - <?php echo getDay('Sunday')->format('F dS, Y');?></p>
                </div>
                
            </form>
        </div>
    </div>
    <div class="col-md-12" id="load_result">
        <?php foreach($worldwide_artists as $worldwide_artist){ ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="item_list">
                    <div class="view view-ninth">
                        <img class="first-slide" src="<?php echo $this->M_user->get_avata($worldwide_artist["id"])  ?>" alt="<?php echo $worldwide_artist["artist_name"]; ?>" />
                        
                        <p><?php echo $worldwide_artist["genre_name"]; ?> Artist</p>
                        <h2><a href="<?php echo  base_url() ?><?php echo $worldwide_artist["home_page"]; ?>"><?php echo $worldwide_artist["artist_name"]; ?></a></h2>
                        <div class="mask mask-1"></div>
                        <div class="mask mask-2"></div>
                        <div class="content">
                            <div class="button-wrapper">
            					<a href="<?php echo  base_url() ?><?php echo $worldwide_artist["home_page"]; ?>" class="a-btn">
            						<span class="a-btn-text"><?php echo $worldwide_artist["artist_name"]; ?></span> 
            						<span class="a-btn-slide-text">View Detail</span>
            						<span class="a-btn-icon-right"><i class="fa fa-chain-broken" style="margin-top: 11px;"></i></span>
            					</a>
            				</div>
                            <?php echo $this->M_audio_song->get_shortcode_AMP($worldwide_artist["id"])?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        
    </div>
    <div id="load_image"><img src="<?php echo base_url().'assets/img/loader.gif'; ?>" /></div>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        $("#change_genre").change(function(){
            var genre = $(this).val();
            page = 1;
            $("#load_image").css("display","block");
            $.get("<?php echo base_url('features/artist_premium_load') ?>/"+genre,{},
			function(data, status){
			     
				$("#load_result").html(data);
                $("#load_image").css("display","none");
			});
        });
        
        var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
        var page = 1;
        $(window).bind(mousewheelevt, function(e){
            var evt = window.event || e //equalize event object     
            evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
            var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF
        
            if(delta < 0){
                var aTop = $('html').height();
                var genre = $('#change_genre').val();
                $("#load_image").css("display","block");
                if($(this).scrollTop() >= (aTop - 730)){
                    page = page + 1;
                    $.post( "<?php echo base_url('features/artist_premium_load_more') ?>", { 
                            genre: genre,
                            page: (page-1),
                            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>' 
                        },function(data){
                            if(data == ""){
                                $("#load_image").remove();
                            }
                            $("#load_result").append(data);
                            $("#load_image").css("display","none");
                    });
                    
                    $("#load_image").css("display","none");
                }
            }   
        });
    });
</script>
<script src='<?php echo base_url(); ?>assets/artists/jquery.transit.min.js'></script>

<script src='<?php echo base_url(); ?>assets/artists/artist.js'></script>

