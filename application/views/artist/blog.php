<div class="container_fluid" style="min-height: 100vh;background: #fff;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 blog-ct">
            <div class="blog-ct-header">
                <h1><?php echo ucfirst($blog[0]['title']); ?></h1>
                <span><i><?php echo date('l, M d Y H:i:s', $blog[0]['time'])?></i></span>
                <hr/>
            </div>
            <div class="blog-ct-main" >
                <p class="text-justify">
                    <?php
                        echo $blog[0]['content'];
                    ?>
                </p>    
                <span class="post-by">Posted by <?php echo ucwords($this->M_user->get_name($blog[0]['user_id'])); ?></span>			
    		</div>
            <div class="blog-ct-footer">
                <div class="right-blog" >
    				<div style=" top: -4px;" class="fb-like" data-href="<?php echo base_url('artist/allblogs').'/'.$blog[0]['user_id'].'/'.$blog[0]['id']?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
    				<a style="padding: 0 5px;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo base_url('artist/blog').'/'.$blog[0]['user_id'].'/'.$blog[0]['id']?>">Tweet</a>
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
</div>