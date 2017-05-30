<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.js"></script>
<script>
$(document).ready(function() {
    $(".watch_video").click(function(e){
       e.preventDefault(); 
       var file_link = $(this).attr('href');
       var playerInstance = jwplayer("video");
       jwplayer().load([{
            file: file_link
       }]);
       jwplayer().play();
    });
});
</script>
<style type="text/css">
    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    /* color: #555; */
    color: #fff;
    background-color: #0099CC;
}
.pagination li a{
    border-radius: 20px !important;
    margin-right: 5px;
    
}
.pagination li{
    margin-right: 5px;
}

.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus{
    background-color: #fff !important;
    color: blue;
    border-color: red;
    z-index: 2;
    cursor: default;
}
</style>
<div class="container-fluid profile_detail" style="min-height: 100vh;" id="allvideos">

    <div class="row">
        <div class="col-md-12 ">
            <!--
            <h2> All Videos</h2>
            <hr />
            -->
            <div class="cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($info_id)?>);">
                <div class="img-avarar">
                    <img src="<?php echo $this->M_user->get_avata($info_id)?>" class="thumbnail" height="150" width="150" />
                
                    <div class="decsript searchform">
                        <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($info_id)?></h3>
                        <h4 class="text_shara">Genre: <?= $this->M_user->get_name_genre($info_id)?></h4>
                        <!-- TODO: <a class="btn btn-default bt-sx ">Share</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container align-center">
            <ul class="nav navbar-nav">
                <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
                <li ><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
                <li class='active'><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
                <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
                <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
                <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
                <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </nav>
   <!--  <div class="col-md-12 menu_detailprofile">
        <div id='cssmenu' class="align-center">
            <ul>
               <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
               <li class='active'><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
               <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
               <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
               <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </div> -->
    <div class="row videos">
    <script type="text/javascript">
            $(document).ready(function ($) {
                // delegate calls to data-toggle="lightbox"
                $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
                    event.preventDefault();
                    return $(this).ekkoLightbox({
                        onShown: function() {
                            if (window.console) {
                                return console.log('Checking our the events huh?');
                            }
                        }
                    });
                });
            });
    </script>
        <div class="row">
            <div>
                <div class="allvideos">
                    <?php if (count($listvideo) == 0) {
    ?><h2 class="text-center">Don't have Video! </h2><?php

} ?>
                    
                </div>
            </div>
        </div>
        <div class="allvideo-playlist row" style="padding-bottom: 10px;">
            <h3 class="oswaldregularh3 text-center" style="color:#000">WEBSITE VIDEOS</h3><hr />
            <div id="photo" data-lightbox="gallery">              
            <ul class="docs-pictures clearfix">            
            <?php 
            foreach ($listvideo as $video) {
                if ($video['type'] == 'file') {
                    ?>
                    <li class="col-sm-4  col-md-4">
                        <div class="remix_items grid clearfix four_col effect_slide_wp" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');background-position: 50% 50%;background-size: cover;">
                            <a class="item effect_slide watch_video" href="<?= base_url('uploads/'.$video['user_id'].'/video/'.$video['name_file'])?>" data-toggle="modal" data-target="#layervideo"   title="<?php echo $video['name_video']?>" rel="bookmark">
            					<figure class="effect-bubba">
        							<figcaption>
        								<h2><?php echo $video['name_video']?> </h2>
        							</figcaption>
                                </figure>   
        				   </a>
                        </div>
                        
                    </li> 
                    <?php

                } else {
                    ?>
                    <li class="col-xs-6 col-sm-4 col-md-4">
                        <div class="remix_items grid clearfix four_col effect_slide_wp" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');background-position: 50% 50%;background-size: cover;">
                            <a class="item effect_slide watch_video" href="<?=$video['link_video']?>" data-toggle="modal" data-target="#layervideo"   title="<?php echo $video['name_video']?>" rel="bookmark">
            					<figure class="effect-bubba">
        							<figcaption>
        								<h2><?php echo $video['name_video']?> </h2>
        							</figcaption>
                                </figure>                
        				   </a>
                        </div>
                        
                    </li>   
                    <?php

                }
            }
            ?>
            </ul>
            <div class="text-center">
                 <?php echo $this->pagination->create_links(); ?>
             </div>
            </div>                        
        </div>
        <div class="modal fade bs-example-modal-lg" id="layervideo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="video" ></div>
                </div>
            </div>
        </div>
        <?php
        if (isset($listvideo[0])) {
            if ($listvideo[0]['type'] == 'file') {
                ?>
                <script>
                jwplayer("video").setup({
                    width: "100%",
                    aspectratio: "16:9",
                    stretching: 'fill',
                    file: "<?php echo base_url().'uploads/'.$info_id.'/video/'.$listvideo[0]['name_file']?>",
                    
                });
                function playTrailer(video) { 
                  jwplayer().load([{
                    file: video
                  }]);
                  jwplayer().play();
                }
                </script>
                <?php

            } else {
                ?>
                <script>
                jwplayer("video").setup({
                    width: "100%",
                    aspectratio: "16:9",
                    stretching: 'fill',
                    file: "<?php echo $listvideo[0]['link_video']?>",
                    
                });
                function playTrailer(video) { 
                  jwplayer().load([{
                    file: video
                  }]);
                  jwplayer().play();
                }
                </script>
                <?php

            }
        }
        ?>
    </div>
    
</div>

