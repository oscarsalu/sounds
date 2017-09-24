
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"/>

<link href="<?php echo base_url(); ?>assets/themes/page-4/css/business-casual.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/amper/template/landing-page-5.css" rel="stylesheet" />

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
    

<div class="wrap bg-landing">
    <div class="row remove_padding">
        <div class="box remove_padding">
            <div class="col-lg-12 text-center remove_padding">
                <div>
                    <div class="col-lg-12 remove_padding">
                        <?php if (!empty($users[0]->banner_image)) {
    ?>
                            <img class="hide-res img-responsive img-full" src="<?php echo base_url(); ?>uploads/<?php echo $users[0]->id; ?>/photo/banner/<?php echo $users[0]->banner_image; ?>" alt="">
                        <?php 
} else {
    ?>
                            <div class="hide-res nen1">
                                <h2>Not Have Background Profile!</h2>
                            </div>
                        <?php 
} ?>
                    </div>
                    <div class="col-lg-12 img-profiles remove_padding">                                                    
                            <img class="img-responsive" src="<?php echo $this->M_user->get_avata($users[0]->id)?>" />                 
                    </div>
                </div>                 
                <h1 class="brand-name"><?php echo ucfirst($name); ?></h1>
                <hr class="tagline-divider" />
                <h2>
                    <small>
                        <?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) {
     echo ', '.ucfirst($country_code[0]['countrycode']);
 }; ?>
                    </small>
                </h2>
            </div>
        </div>
    </div>
    <div class="row remove_padding">
        <div class="box add_session ">
            <div class="col-lg-12 remove_padding">
                <hr />
                <h2 class="intro-text text-center">
                    <strong>Photos</strong>
                </h2>
                <hr />
                <div class="col-md-12 remove_padding">
                    <div class="col-md-8 remove_padding new_style_add">
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
                             <li class="col-md-4 col-xs-12">
                                <div class="image_fix_value img-responsive" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                <img data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>"class="img-responsive"/>
                               
                            </li>
                        <?php ++$i;
                                 } ?>
                            <li class="col-md-4 col-xs-12">
                                <div class="image_fix_value img-responsive" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                <img data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                                
                            </li>
                                <?php 
                             } elseif ($count == 1) {
                                 foreach ($photos as $pt) {
                                     ?>
                             <li class="col-md-4 col-xs-12">
                                <div class="image_fix_value img-responsive" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>');"></div>
                                <img data-original="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" class="img-responsive"/>
                                
                            </li>
                            <?php 
                                 } ?>
                                <div class="col-md-4 col-xs-4">
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"  class="img-responsive"/>
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"class="img-responsive"/>
                                </div>
                            <?php 
                             } else {
                                 ?>
                            <div class="col-md-4 col-xs-4">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div> 
                        <?php 
                             } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row remove_padding">
        <div class="box add_session ">
            <div class="col-lg-8 new_style_add">
                <!-- AMP -->
                <div class="col-lg-6 remove_padding_new">
                    <hr />
                    <h2 class="intro-text text-center">
                        <strong>AMP</strong>
                    </h2>
                    <hr />
                    <div class="col-md-12 remove_padding">
                        <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
                    </div>
                </div>
                <!--END AMP -->
                
                <div class="col-lg-6 remove_padding_new">
                    <hr />
                    <h2 class="intro-text text-center">
                        <strong>About</strong>
                    </h2>
                    <hr />
                    <div class="col-md-12">
                        <div class="row">
                            <p class="text-center wp_content_list_fix"><?php if (!empty($users[0]->bio)) {
    echo $this->Member_model->short_Text_Bio($users[0]->bio);
} ?></p>
                            
                        </div>
                        <div class="wp_content_list_fix mxh">
                            <p class="text-justify text-center">
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
                        </div>
                        <!--STATS -->    
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
                        <!--END STATS -->
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row remove_padding">
        <div class="box add_session ">
            <div class="col-lg-9 new_style_add">
                <!--BLOG -->
                <div class="col-lg-6 remove_padding_new">
                    <hr />
                    <h2 class="intro-text text-center">
                       <a href="<?=base_url('amper/allblogs/'.$name)?>"> <strong>Recent Blogs</strong></a>
                    </h2>
                    <hr />
                    <div class="col-md-12 remove_padding">
                        <?php foreach ($blogs as $row) {
    ?>
                                <div class="mb1"> 
                                    <div class="mb1-blog-img">                                   
                                        <img class="img-responsive" width="150" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>" />
                                    </div>
                                    <div class="mb1-blog-content">                                                                                                                                                                                                                                                                                                         
                                        <strong>
                                            <a href="<?php echo base_url('amp').'/'.$name.'/detailsblogs?id_blog='.$row['id']?>" class="blog_entry_header ellipsis  h6-size"><?php echo $row['title']?></a>
                                        </strong>
                                        <div class="" style="color: #000;">
                                            <span style=" font-size: small;"><?php echo date('M d, Y', $row['time'])?></span>
                                        </div>
                                        <div style="color: #000;">                                      
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
                <!--END BLOG -->
                <!--COMMENT -->
                <div class="col-lg-6 remove_padding_new">
                    <hr />
                    <h2 class="intro-text text-center">
                        <strong> <a href="<?=base_url('amper/allcomment/'.$name)?>">Comments</a></strong>
                    </h2>
                    <hr />
                    <div class="col-md-12 remove_padding">
                        <?php
                        if (empty($comments)) {
                            ?>
                            <span class="col-md-12 cmt">No Comment.</span>
                            <?php

                        }
                        foreach ($comments as $comment) {
                            ?>
                                <span class="col-md-12 cmt">
                                    <a href="<?=$this->M_user->get_home_page($comment['client'])?>">
                                        <img  src="<?=$this->M_user->get_avata($comment['user_id'])?>" />
                                    </a>
                                    <a href="<?=$this->M_user->get_home_page($comment['client'])?>" class="posi_img" style="position:absolute;top:-7px;font-weight: bold;">
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
                <!--END COMMENT -->
            </div>
        </div>
    </div>
    <div class="row remove_padding">
        <div class="box add_session ">
            <!--VIDEOS -->
            <div class="col-lg-8 new_style_add">
                <div class="col-lg-12 remove_padding_new">
                    <hr />
                    <h2 class="intro-text text-center">
                        <strong>Videos</strong>
                    </h2>
                    <hr />
                    <div class="col-md-12 remove_padding">
                        <?php 
                        foreach ($videos as $video) {
                            if ($video['type'] == 'file') {
                                $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
                            } else {
                                $link_video = $video['link_video'];
                            } ?>
                        <div class="wp_content_list">
                            <div class="col-md-6 col-xs-6">
                                
                                <a href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos">
                                    <div class="image_fix_value_video_1 img-responsive" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');"></div>
                                </a>
                            </div>
                            <div class="col-xs-6 col-md-6 remove_padding">
                                <span class="col-xs-12 content_video_title"><?php echo $video['name_video']; ?></span>
                            </div>
                            <div class="clearfix_check"></div>
                        </div>          
                    <?php 
                        } ?>
                    </div>
                </div>
            </div>
            <!--END VIDEOS -->
        </div>
    </div>
    
</div>
<script src="<?php echo base_url(); ?>assets/themes/page-4/js/bootstrap.min.js"></script>
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

<!--MODAL video-->
    <div class="modal fade" id="videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <!--iframe id="cartoonVideo" width="640" height="480" src="//www.youtube.com/embed/rGedjDnQ9cw" frameborder="0" allowfullscreen></iframe-->
            <div id="video"></div>
            <!--<div id="myElement2" class="img-responsive">Loading the player...</div>
                <script type="text/javascript">
                var playerInstance = jwplayer("myElement2");
                playerInstance.setup({
                    file: "https://www.youtube.com/watch?v=rGedjDnQ9cw",
                    width: 640,
                    height: 480,
                    title: 'Basic Video Embed',
                    description: 'A video with a basic title and description!',
                    mediaid: '123456',
                    autostart: true,
                });
              </script>-->
            <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>      
        </div>
    </div>
    
    <div class="modal fade" id="photos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog text-center" role="document">
            <img src="<?php echo base_url(); ?>assets/images/adaptable.jpg" width="500" height="400"/>
        </div> 
    </div>
</div>    
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url()?>assets/js/detail_pages/amper/template/landing-page-5.js"></script> 
