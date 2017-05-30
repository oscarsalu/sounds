<div class="wrap" style="">
    <div class="container" style="width: 100%;min-height: 100vh;" >
        
        <div class="row blogs">
            <?php
            if (isset($blog)) {
                ?>
                <h1 class="text-center text-capitalize"><?=$blog->title?></h1>
                    <i><?=date('M,d Y', $blog->time)?></i>
                    <hr />
                    
                    <div class=" col-sm-10 blogs-content" style="padding: 20px 25px;">
                        <img class="img-responsive" src="<?=base_url('uploads/'.$blog->user_id.'/photo/blogs/'.$blog->image_rep)?>" /><br />
                        <?=$blog->content?>
                        <br />
                        <a class="btn btn-danger" href="<?=base_url('blogs')?>">Previous</a>
                    </div>
                    <div class="sm_share">
                        <div style=" top: -4px;" class="fb-like" data-href="<?php echo base_url('blogs/'.$current_title)?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
            				<a style="padding: 0 5px;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo base_url('blogs/'.$current_title)?>">Tweet</a>
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
                <?php

            } else {
                ?>
                <h1 class="text-center text-capitalize">Not Found Data Blog </h1>
                <p class="text-center"><a class="btn btn-danger" href="<?=base_url('blogs')?>">Previous</a></p>
                <?php

            }
            ?>
        </div>
    </div>
</div>