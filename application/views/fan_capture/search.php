<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
<script>
 var base_url             = '<?php echo base_url() ?>'; 
 var get_csrf_hash         = '<?php echo $this->security->get_csrf_hash(); ?>';
 var get_search            = '<?=json_encode($_GET)?>';
</script>
<script src="<?php echo base_url()?>assets/js/detail_pages/fancapture/search.js"></script>
<div class="row fan-capture" id="fancapture" >
        <!-- Filter-->
        <div class="row filter" style="padding: 30px 0;">
            <h1 class="text-center oswaldregularh3">FAN CAPTURE</h1>
            <div class="bottomheader wow zoomIn" data-wow-delay="1s"></div>
            <form action="<?php echo base_url('fancapture/search_fcp')?>" class="searchform fix-fan" method="get">
                <div class="backgound_searchfan col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-6 col-md-2 ">
                        <input type="text" id="name" name="name" placeholder="Name" class="form-control bor-sr" value="<?php if (isset($_GET['name'])) {
    echo $_GET['name'];
}?>" />
                    </div>  
                    <div class="col-xs-6 col-sm-6 col-md-2">  
                        <select name="genre[]" class="chosen-select form-control" multiple="multiple" data-placeholder="Choose genre..." id="editar-element-6">
                        <?php
                        $i = 0;
                        foreach ($genres as $row) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"<?php  if (isset($_GET['genre'][$i]) && $_GET['genre'][$i] == $row['id']) {
     echo 'selected';
 } ?>  > <?php echo $row['name']?> </option>
                            <?php
                            ++$i;
                        }
                        ?>
                        </select>  
                    </div> 
                    
                    <div class="none"></div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-4 mg-search_fan">
                        <div class="col-xs-2 col-sm-2 col-md-2" style="top: 5px;left: 20px;">Pay%:</div>
                        <div class="col-xs-10 col-sm-10 col-md-10">
                            <input name="pay_percentages" type="text" value="20" data-slider-values="0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95,100" data-slider="true" data-slider-theme="volume" />
                        </div>
                    </div> 
                    <div class="col-xs-6 col-sm-6 col-md-2 ">
                        <input type="text" id="instrument" placeholder="Instrument" name="instrument" class="form-control bor-sr" />  
                    </div>  
                    <div class="col-xs-6 col-sm-6 col-md-2 ">
                        <input type="submit" value="Filter" id="search" />
                          
                    </div>        
                </div>
            </form>               
        </div>
        <div class="row col-md-12">
            <div class="col-md-3 wrapper_left">
                <div class="side-menu menu-fan">
        			<nav class="navbar navbar-default" role="navigation">
        				<!-- Brand and toggle get grouped for better mobile display -->
        				<div class="navbar-header">
        					<div class="brand-wrapper">
        						<!-- Hamburger -->
        						<button type="button" class="navbar-toggle">
        						<span class="sr-only">Toggle navigation</span>
        						<span class="icon-bar"></span>
        						<span class="icon-bar"></span>
        						<span class="icon-bar"></span>
        						</button>
        						<!-- Brand -->
        						<div class="brand-name-wrapper">
        							<a class="navbar-brand" href="#">
        							Genres 
        							</a>
        						</div>
        					</div>
        				</div>
        				<!-- Main Menu -->
        				<div class="side-menu-container">
        					<ul class="nav navbar-nav" style="margin: 0;">
                                <li><a href="<?=base_url('fancapture')?>"><span class="fa fa-music"></span> All Genres </a></li>
                                <?php
                                    foreach ($genres as $row) {
                                        ?>
                                    <li><a href="<?=base_url('fancapture/filter_genre/'.$row['id'])?>"><span class="fa fa-music"></span> <?=$row['name']?> </a></li>
                                    <?php 
                                    }
                                ?>
        					</ul>
        				</div>
        				<!-- /.navbar-collapse -->
        			</nav>
        		</div>
                
            </div>
            <div class="col-md-9">
                <div class="section-top">
                    <div class="row">
                            <div id="content-1" style="height: auto;" class="content horizontal-images ">
                                <ul class="tag_ul_1">
                                <?php
                                for ($i = 0;$i < count($list_artist);++$i) {
                                    if ($i % 2 == 0) {
                                        ?>
                                        <li>
                                            <div class="remix_items grid clearfix four_col">
                        						<a class="item" data-gal="photo" href="<?php echo base_url($list_artist[$i]['home_page'])?>" title="" rel="bookmark">
                                                
                            						<figure class="effect-bubba">
                            							<img width="500" height="360" src="<?php echo $this->M_user->get_avata($list_artist[$i]['id'])?>" class="attachment-type_cover wp-post-image" alt="" />							
                                                        <figcaption>
                            								<h2><?=$this->M_user->get_genre_name($list_artist[$i]['genre'])?></h2>
                                                            <?php echo $list_artist[$i]['artist_name']?>
                                                            </p>
                            							</figcaption>
                                                    </figure>
                        					   </a>
                                            </div>
                                            <div>
                                                <a class="fixedposion btn_view_shortcode myButton" href="#" data-toggle="modal" data-target="#viewshortcode">Short-Code</a><br />
                                                <?php
                                                if (!$this->M_affiliate->check_connect_affiliate($list_artist[$i]['id'], $user_data['id'])) {
                                                    ?>
                                                    <a class="fixedposion btn_view_shortcode myButton become_affiliate" data-affiliateId="<?=$this->M_audio_song->get_affiliate_id($list_artist[$i]['id'])?>" >To become an affiliate</a>
                                                    <?php

                                                } ?>
                                                <input class="hide_shortcode" type="hidden" value="<?php echo htmlentities($this->M_audio_song->get_shortcode_AMP($list_artist[$i]['id']))?>"/>
                                                <input class="hide_name_artist" type="hidden" value="<?php echo $list_artist[$i]['artist_name']?>"/>
                                                <input class="hide_affiliate_id" type="hidden" value="<?php echo $this->M_audio_song->get_affiliate_id($list_artist[$i]['id'])?>"/>
                                            </div>
                                       </li> 
                                        <?php

                                    }
                                }?>
                                </ul>
                                <ul class="tag_ul_2">
                                <?php
                                for ($i = 0;$i < count($list_artist);++$i) {
                                    if ($i % 2 == 1) {
                                        ?>
                                        <li>
                                            <div class="remix_items grid clearfix four_col">
                        						<a class="item" data-gal="photo" href="<?php echo base_url($list_artist[$i]['home_page'])?>" title="" rel="bookmark">
                                                
                            						<figure class="effect-bubba">
                            							<img width="500" height="360" src="<?php echo $this->M_user->get_avata($list_artist[$i]['id'])?>" class="attachment-type_cover wp-post-image" alt="" />							
                                                        <figcaption>
                            								<h2><?=$this->M_user->get_genre_name($list_artist[$i]['genre'])?></h2>
                                                            <?php echo $list_artist[$i]['artist_name']?>
                                                            </p>
                            							</figcaption>
                                                    </figure>
                        					   </a>
                                            </div>
                                            <div>
                                                <a class="fixedposion btn_view_shortcode myButton" href="#" data-toggle="modal" data-target="#viewshortcode">Short-Code</a><br />
                                                <a class="fixedposion btn_view_shortcode myButton become_affiliate" data-affiliateId="<?=$this->M_audio_song->get_affiliate_id($list_artist[$i]['id'])?>" >To become an affiliate</a>
                                                <input class="hide_shortcode" type="hidden" value="<?php echo htmlentities($this->M_audio_song->get_shortcode_AMP($list_artist[$i]['id']))?>"/>
                                                <input class="hide_name_artist" type="hidden" value="<?php echo $list_artist[$i]['artist_name']?>"/>
                                                <input class="hide_affiliate_id" type="hidden" value="<?php echo $this->M_audio_song->get_affiliate_id($list_artist[$i]['id'])?>"/>
                                            </div>
                                       </li> 
                                        <?php

                                    }
                                }?>
                                </ul>
                            </div>
                       </div>
                   </div>
            </div> 
        </div>
</div>
<!-- view shortcode modal -->
<div class="modal fade bs-example-modal-sm" id="viewshortcode" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalbg">View shortcode: <span class="artist_name"></span></h4>
        </div>
        <div class="modal-body">
            <h3>Viewing Shortcode  by <span class="artist_name"></span> .</h3>
            <div align="center"  class="wcustomhtml" >
                <iframe id="iframe_amp" src="" frameborder="0" scrolling="no" width="100%" height="450px"></iframe>
            </div>
            <textarea id="shortcode-view" class="shortcode-view" rows="5" style="width:100%" ></textarea>
        </div>   
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="copyToClipboard('#shortcode-view')">Copy Shortcode</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()?>assets/js/chosen.jquery.min.js" type="text/javascript"></script> 

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    } 
</script>   
<script src="<?php echo base_url()?>assets/js/detail_pages/fancapture/search_2.js"></script>

<script type="text/javascript">
                    

$(document).ready(function(){
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        //$('#search').removeClass('in').addClass('collapse').slideUp(200);
    
        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').toggleClass('slide-in');
        
    });
    $(".horizontal-images .wp_fan_slide").hover(function(){
        $(this).find(".content_pan_cp").slideUp();
        //$(this).find(".content_pan_cp_hover").fadeIn();
        $(this).find(".content_pan_cp_hover").slideDown();
    },function(){
        $(this).find(".content_pan_cp_hover").slideUp();
        //$(this).find(".content_pan_cp_hover").fadeIn();
        $(this).find(".content_pan_cp").slideDown();
    })
    $(".become_affiliate").click(function(e){
        e.preventDefault();
        var Id = $(this).attr("data-affiliateId");
        window.location.replace("<?=base_url('amper/become_affiliate')?>/"+Id);
        
    })
})	

</script>