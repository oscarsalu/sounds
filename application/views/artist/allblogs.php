<style type="text/css">
    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    /* color: #555; */
    color: #fff;
    background-color: #0099CC;
}
</style>
<div class="container_fluid profile_detail" id="allblogs" style="min-height: 100vh; ">

    <div class="row">
        <div class="col-md-12">

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
                <li ><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
                <li ><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
                <li class='active'><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
                <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
                <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </nav>
    <!-- <div class="col-md-12 menu_detailprofile">
        <div id='cssmenu' class="align-center">
            <ul>
               <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
               <li><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
               <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
               <li class='active'><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
               <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </div> -->
   

    <div class="container">
        <div class="row">
             <h3 class="oswaldregularh3 text-center " style="color: #000;">All Blogs</h3> <hr />
        </div>
        <div class="row">
        	<div class="allblogs col-sm-12">   

        		<?php
                    foreach ($listblogs as $row) {
                        ?>
                        <div class="allblogs-container">
                        <div class="col-xs-6 col-sm-3 img-allblogs">                        
                            <a href="<?php echo base_url('artist/allblogs/'.$row['user_id'].'/'.$row['id']); ?>">
                                <img class="blog-img img-responsive img-thumbnail" width="250" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>" />
                            </a>
                        </div>
                    <div class="col-xs-6 col-sm-3 ctn-blogs">
                		<div class="title-blogs">
                			<div class="left-blog" >
                				<h2><a href="<?php echo base_url('artist/allblogs/'.$row['user_id'].'/'.$row['id']); ?>"><?php echo $row['title']?></a></h2>
                				<span><i><?php echo date('M d, l Y', $row['time'])?></i></span>
                			</div>
                			<!--div class="right-blog" >
                				<div style=" top: -4px;" class="fb-like" data-href="<?php echo base_url('artist/blog').'/'.$blog_id.'/'.$row['id']?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                				<a style="padding: 0 5px;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo base_url('artist/blog').'/'.$blog_id.'/'.$row['id']?>">Tweet</a>
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
                				<!--script async defer src="//assets.pinterest.com/js/pinit.js"></script>
                			</div-->
                		</div>
                		<div class="content-blogs" >
                            <p class="text-justify">
                                <?php
                                    $text = strip_tags($row['introduction']);
                        $desLength = strlen($text);
                                    //var_dump($desLength);exit;            
                                    $stringMaxLength = 315;
                        if ($desLength > $stringMaxLength) {
                            $des = substr($text, 0, $stringMaxLength);
                            $text = $des.'...'."<a href='".base_url('artist/allblogs/'.$row['user_id'].'/'.$row['id'])."'>Read more</a>";
                            echo $text;
                        } else {
                            echo $text."<a href='".base_url('artist/allblogs/'.$row['user_id'].'/'.$row['id'])."'>Read more</a>";
                        } ?>
                            </p>
                			
                		</div>
                		<!--div class="action-comment">
                			<input type="hidden" class ="id_hd" value="<?php echo $row['id']?>"/>
                			<a class="btn-cmt" href="#" data-toggle="modal" data-target="#blogs_comment">Reply</a>
                		</div-->
                        
                		<?php
                            $comment = $this->M_blog->getcomment_blog($row['id']);
                        if (count($comment) > 0) {
                            echo '<div class="comment_replies">';
                            foreach ($comment as $data_cmt) {
                                ?>
                        			<div class="comment_reply">
                        				<a href="#"><img alt="aaa" class="thumb_" height="48px" src="<?php echo $this->M_user->get_avata($data_cmt['user_id'])?>" title="aaa" width="64px"></a>
                        				<div class="comment_details">
                        					<a href="#" class="comment_author"><?php echo $this->M_user->get_name($data_cmt['user_id'])?></a>
                        					<span class="time_since" title="<?php echo date('l, M d Y H:i:S')?>">&nbsp;(about <?php echo $this->M_user->time_calculation($data_cmt['time'])?>)</span><br>
                        					<div class="comment_body">
                        						<p><?php echo $data_cmt['comment']?></p>
                        					</div>
                        				</div>
                        			</div>
                        			<?php
                                    if (end($comment) != $data_cmt) {
                                        echo '<hr/>';
                                    }
                            }
                            echo '</div>';
                        } ?>  
                    </div>      
                        </div>
                    <?php

                    }
                ?>
        	</div>
        </div>
    
    </div>
    
</div>
<script>
	$(document).ready(function() {
	     $('.allblogs').on('click','.btn-cmt', function (){
	         var id = $(this).parent().find('.id_hd').val();
	         $('#id-blog').val(id);
	     });
	 }) 
</script>
<!-- Modal blogs -->
<div class="modal fade" id="blogs_comment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="" action="<?php echo base_url().'artist/blogs/comment-blog'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalbg">Reply to Blogs</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="form-input col-md-3">Post Comment*</label>
						<div class="input-group col-md-8">
							<input type="hidden" id="id-blog" name="id" />
							<textarea class="form-control"  name="comment" rows="6" required=""></textarea>
							1000 characters remaining
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Post</button>
				</div>
			</form>
		</div>
	</div>
</div>