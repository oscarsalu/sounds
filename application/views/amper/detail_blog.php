<div class="wrap" style="">
    <div class="container" style="width: 100%;min-height: 100vh;" >
        <div class="row">
            <div class="col-md-12 profile-maxheight dis-n" style="min-height: 350px;max-height: 350px;background-color:#848484;">
                <?php if (!empty($users->banner_image)) {
    ?> 
                    <img src="<?php echo base_url(); ?>uploads/<?php echo $users->id; ?>/photo/banner/<?php echo $users->banner_image; ?>" class="n-ds" style="width:102.70%;margin-left:-15px;"/>
                <?php 
} else {
} ?>
                <div class="col-md-12 profile-landing">
                    <div class="col-md-2 col-xs-4 pro-img-1">                                                                                                                     
                        <img class="" style="background:whitesmoke;min-height:144px;max-height: 144px;" width="150" src="<?php echo $this->M_user->get_avata($users->id)?>"/>                                                 
                    </div>
                    <div class="col-md-7 col-xs-8 pro-img-2" style="margin-left: -10px;">
                        <h1 class="text-h1"><?php echo ucfirst($users->firstname.' '.$users->lastname); ?></h1>
                        <span><?=$users->city ?></span>
                        <span class="mg"><?php echo ucfirst($users->city); ?></span>                                             
                    </div>                    
                </div>
            </div>
        </div>
        <div class="row blogs">
            <h1 class="text-center text-capitalize"><?=$blog->title?></h1>
            <i><?=date('M,d Y', $blog->time)?></i>
            <hr />
            
            <div class=" col-sm-10 blogs-content"><?=$blog->content?></div>
            <div class="sm_share">
                <div style=" top: -4px;" class="fb-like" data-href="<?php echo base_url('amp/'.$users->home_page.'/detailsblogs?id_blog='.$blog->id)?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
    				<a style="padding: 0 5px;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?= base_url('amp/'.$users->home_page.'/detailsblogs?id_blog='.$blog->id)?>">Tweet</a>
    				<script>
    					!function(d,s,id){
    					    var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
    					    if(!d.getElementById(id)){
    					        js=d.createElement(s);
    					        js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
    					        fjs.parentNode.insertBefore(js,fjs);
    					    }
    					}(document, 'script', 'twitter-wjs');
    				</script>
    				<a data-pin-do="buttonBookmark" href="//www.pinterest.com/pin/create/button/" >
    				<img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
    				<g:plusone data-size="standard " data-annotation="bubble"  ></g:plusone>
    				<!-- Please call pinit.js only once per page -->
    				<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
            </div>
        </div>
    </div>
</div>