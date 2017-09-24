
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"/>

<link href="<?php echo base_url(); ?>assets/themes/page-4/css/business-casual.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/amper/template/landing-page-6.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css" />
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet" />


<!-- Fonts -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

<div class="bg-landing">
    <div class=" container">
        <div class="row col-lg-8 nopad-res" >
            <div class="box nopad-res">
                <div class=" text-center">
                    <div id="" class="">
                        <div class="col-lg-12 w-n-max remove_padding">
                            <?php if (!empty($users[0]->banner_image)) {
    ?>
                                <img class="hide-res" class="img-responsive img-full" src="<?php echo base_url(); ?>uploads/<?php echo $users[0]->id; ?>/photo/banner/<?php echo $users[0]->banner_image; ?>" alt="">
                            <?php 
} else {
    ?>
                                <div class="hide-res nen1">
                                    <h2>Not Have Background Profile!</h2>
                                </div>
                            <?php 
} ?>
                        </div>                        
                    </div>   
                                
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4 box avata text-center">          
                <img class="img-responsive avt" src="<?php echo $this->M_user->get_avata($users[0]->id)?>" />        
                            <h1 class="brand-name"><?php echo ucfirst($name); ?></h1>
                            <hr class="tagline-divider">
                            <h2>
                                <small>
                                    <?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) {
     echo ', '.ucfirst($country_code[0]['countrycode']);
 }; ?>
                                </small>
                            </h2>  
                            <div class="right-mar">
                            <ul class="docs-pictures clearfix">
                        <?php $count = count($photos);
                             if ($count == 3) {
                                 $i = 0;
                                 foreach ($photos as $pt) {
                                     ?>
                             <li class="col-md-4 col-xs-12">
                                <div class="image_fix_value img-responsive" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                <img data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/>
                                
                            </li>
                        <?php ++$i;
                                 }
                             } elseif ($count == 2) {
                                 $i = 0;
                                 foreach ($photos as $pt) {
                                     ?>
                             <li class="col-md-4 col-lg-4 col-xs-12">
                                <div class="image_fix_value img-responsive" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                <img  data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>"class="img-responsive"/>
                               
                            </li>
                        <?php ++$i;
                                 } ?>
                            <li class="col-md-4 col-lg-4 col-xs-12">
                                <div class="image_fix_value img-responsive" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                <img  data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                
                            </li>
                                <?php 
                             } elseif ($count == 1) {
                                 foreach ($photos as $pt) {
                                     ?>
                             <li class="col-md-4 col-lg-4 col-xs-12">
                                <div class="image_fix_value img-responsive" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                <img data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/>
                                
                            </li>
                            <?php 
                                 } ?>
                                <div class="col-md-4 col-lg-4 col-xs-12">
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"  class="img-responsive"/>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xs-12">
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"class="img-responsive"/>
                                </div>
                            <?php 
                             } else {
                                 ?>
                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xs-12">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div> 
                        <?php 
                             } ?>
                        </ul>
                        </div>                 
                    </div>  
        
        <div class="row none-dp">
            <div class="box box-hd">                
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 box title-padding blocks-3 remove_padding">
                <div class="col-lg-4 max-width nen2">               
                    <h2 class="intro-text text-center title-all">
                        <strong>About</strong>
                    </h2>
                    
                    <p><strong>Bio:</strong> <?php if (!empty($users[0]->bio)) {
    echo $this->Member_model->short_Text_Bio($users[0]->bio);
} else {
    echo 'Not Have Bio!';
} ?></p>
                   
                    <p class="text-justify">
                      <a href="#" target="_blank" title="Twitter">
                        <span class="relative inline">
                          <img alt="Icon_twitter" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_twitter.png?1445003519" style="z-index:1">
                        </span>
                      </a>
                      <a href="#" title="Instagram">
                        <span class="relative inline">
                          <img alt="Icon_instagram" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_instagram.png?1445003519" style="z-index:1">
                        </span>
                      </a>
                      <a href="#" target="_blank" title="YouTube">
                        <span class="relative inline">
                          <img alt="Icon_youtube" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_youtube.png?1445003519" style="z-index:1">
                        </span>
                      </a>
                      <a href="#" target="_blank" title="Facebook">
                        <span class="relative inline">
                          <img alt="Icon_facebook" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_facebook.png?1445003519" style="z-index:1">
                        </span>
                      </a>                          
                    </p>
                     <div class="col-lg-12">
                        <button class="btn btn-danger bt-res">More Info</button>
                    </div>
                    
                </div>
                <!-- BLOG -->
                <div class="col-lg-4 max-width blog">                    
                    <h2 class="intro-text text-center title-all">
                        <a href="<?=base_url('amper/allblogs/'.$name)?>"><strong>Recent Blogs</strong></a>
                    </h2>
                    <div class="col-md-12 col-xs-12">
                        <?php foreach ($blogs as $row) {
    ?>
                                <div class="mb1"> 
                                    <div class="mb1-blog-img">                                   
                                        <img class="img-responsive" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>" />
                                    </div>
                                    <div class="mb1-blog-content">                                                                                                                                                                                                                                                                                                         
                                        <strong>
                                            <a href="<?php echo base_url('amp').'/'.$name.'/detailsblogs?id_blog='.$row['id']?>" class="blog_entry_header ellipsis  h6-size"><?php echo $row['title']?></a>
                                        </strong>
                                        <div class="day" >
                                            <span><?php echo date('M d, Y', $row['time'])?></span>
                                        </div>
                                        <div class="day">                                      
                                            <?php 
                                                $text = strip_tags($row['introduction']);
    $desLength = strlen($text);
                                                //var_dump($desLength);exit;            
                                                $stringMaxLength = 120;
    if ($desLength > $stringMaxLength) {
        $des = substr($text, 0, $stringMaxLength);
        $text = $des.'...';
        echo $text;
    } else {
        echo $row['introduction'];
    } ?>                                    
                                        </div>   
                                    </div>                                                                   
                                </div>
                                <?php
                                if (end($blogs) != $row) {
                                    echo '<hr style="margin-bottom:0px;" />';
                                }
}?>
                    </div>
                </div>
                <!-- /BLOG -->
                <!-- COMMENT -->
                <div class="col-lg-4 max-width cmt"> 
                    <h2 class="intro-text text-center title-all">
                        <strong> <a href="<?=base_url('amper/allcomment/'.$name)?>">Comments</a></strong>
                    </h2>
                    <div class="cmt1">
                        <?php
                        if (empty($comments)) {
                            ?>
                            <span class="col-md-12">No Comment.</span>
                            <?php

                        }
                        foreach ($comments as $comment) {
                            ?>
                                <span class="col-md-12">
                                    <a href="<?=$this->M_user->get_home_page($comment['client'])?>">
                                        <img src="<?=$this->M_user->get_avata($comment['user_id'])?>" />
                                    </a>
                                    <a href="<?=$this->M_user->get_home_page($comment['client'])?>" class="posi_img" >
                                        <?=$this->M_user->get_name($comment['client'])?>
                                    </a>
                                    <span><?php echo ucfirst($comment['comment']); ?></span>
                                    <?php if (end($comments) != $comment) {
    echo '<hr class="hr-small" />';
} ?>
                                </span>
                                   
                            <?php 
                        }
                        ?>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn " data-toggle="modal" data-target="#addComment">Comment</a>
                    </div>
                      
                </div>
                <!-- /COMMENT -->
            </div>
        </div> 
        <!-- AMP -->
        <div class="box col-lg-4 mg-res stats">
            <div class="amp">
            
                <h2 class="intro-text text-center title-all">
                    <strong>AMP</strong>
                </h2>
                <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
                
                
            </div>
        </div>
        <!-- /AMP -->
        <!-- STATS -->
        <div class="box col-lg-4 mg-song-res songs">          
            <div class="">
                <h2 class="intro-text text-center title-all">
                    <strong>Stats</strong>
                </h2>
               <div class="col-md-12 view_style_text views">
                    <div class="wp_content_list">
                        <i class="fa fa-retweet"></i>
                        <span class="full-w">Total Samples</span>
                        <span class="full-w-tt"><span></span><?php echo $num_samples;?></span>
                    </div>
                    <div class="wp_content_list">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="full-w">Total Sales</span>
                        <span class="full-w-tt"><span></span><?php echo $num_sales;?></span>
                    </div>
                    <div class="wp_content_list">
                        <i class="fa fa-bookmark"></i>
                        <span class="full-w">Total Blogs</span>
                        <span class="full-w-tt"><span></span><?php echo $num_blogs; ?></span>
                    </div>
                    <div class="wp_content_list">
                        <i class="fa fa-comments"></i>
                        <span class="full-w">Total Comments</span>
                        <span class="full-w-tt"><span></span><?php echo $num_comments; ?></span>
                    </div>
                </div>                              
            </div>
        </div>   
        <!-- /STATS -->
        <!-- VIDEOs -->
        <div class="box col-lg-4 width-res comment videos">             
            <div class="">
                <h2 class="intro-text text-center title-all">
                    <strong>Videos</strong>
                </h2>
                <div class="col-lg-12">
                    <?php 
                    foreach ($videos as $video) {
                        if ($video['type'] == 'file') {
                            $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
                        } else {
                            $link_video = $video['link_video'];
                        } ?>
                             <div class="col-lg-6" style="margin: 0 auto;margin-bottom: 10px;padding: 0px;">
                                <a href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos">
                                <img class="video-landing img-responsive" src="<?=$this->M_video->get_image_video($video['id'])?>" />
                                <div class="play"><span class="button_play"></span></div></a>                                
                            </div>                        
                        <?php 
                    }?>                                                      
                </div>   
            </div>
        </div>
        <!-- /VIDEOs -->
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <!--script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/themes/page-4/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
<!-- Modal comment -->
<div class="modal fade new_modal_style" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url('amper/membercomment')?>" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add a Comment</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-2">Comment (max 1000 characters)</label>
                        <div class="input-group col-md-9">
                            <textarea class="form-control" name="comment" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_flp" value="<?=$id?>" />
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>   
            </form>
        </div>      
    </div>
</div>
<!-- Modal showEvent -->
<div class="modal fade" id="showEvent" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalevent"></h4>
            </div>            
            <div class="modal-body">                                                     
                 <div class="col-md-12">
                    <img id="event_banner" src="" width="535" />
                 </div>   
                 <div class="col-md-12 text-center" style="margin-top: 10px;">
                    <span id="cat" style="font-weight: bold; font-size: 18px;"></span>
                 </div>
                 <div class="col-md-12" style="padding:10px 30px  0px 15px;">
                    <span style="float: left;">Start Date: <span id="start" ></span></span>
                    <span style="float: right;">End Date: <span id="end" style="color: red;"></span></span>
                 </div>
                 <div class="col-md-12" style="padding: 20px 30px">
                    <span id="des"></span>
                 </div> 
                 <div class="col-md-12">
                    <span>Post By: <span id="post-b" style="font-weight: bold;"></span></span>
                 </div>
                 <div class="col-md-12">
                    <span>Location: <span id="lo" style="font-weight: bold;"></span></span>
                 </div>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>                                    
        </div>
    </div>
</div>
<!--MODAL video-->
    <div class="modal fade" id="videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div id="video"></div>
            
            <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>      
        </div>
    </div>
    
    <div class="modal fade" id="photos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog text-center" role="document">
            <img src="<?php echo base_url(); ?>assets/images/adaptable.jpg" width="500" height="400"/>
        </div> 
    </div>
</div>
</div>    
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url()?>assets/js/detail_pages/amper/template/landing-page-6.js"></script> 
