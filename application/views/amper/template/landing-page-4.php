
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/amper/template/landing-page-4.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css" />
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>

<div class="wrap bg-landing">
    <div class="row">
        <div class="tpl-cover view view-third">
        <?php if (!empty($users[0]->banner_image)) {
    ?>         
            <img class="none-bg" src="<?php echo base_url(); ?>uploads/<?php echo $users[0]->id; ?>/photo/banner/<?php echo $users[0]->banner_image; ?>" height="350px" width="100%"/>
            <?php 
} else {
    ?>
            <div class="none-bg"></div>
            <?php 
}?>
            <div class="mask">
                <img class="img-circle" src="<?php echo $this->M_user->get_avata($users[0]->id)?>"/>
                <h1 class="view_style_text text-center fixnameuser"><?php echo ucfirst($name); ?></h1>
                <p class="view_style_text text-center"><?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) {
     echo ', '.ucfirst($country_code[0]['countrycode']);
 }; ?></p>
            </div>         
        </div>
        <div class="row remove_padding part_content">
            <div class="col-md-6 remove_padding">
                <div class="row header_new_style">
                    <div class="remove_part"></div>
                    <h2 class="tt text_caplock"><a href=""><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_bios.png" /> Bio</a></h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding view_style_text">
                        <p class="text-center wp_content_list_fix"><?php if (!empty($users[0]->bio)) {
    echo $this->Member_model->short_Text_Bio($users[0]->bio);
} ?></p>
                            
                            <div class="wp_content_list_fix">
                                <p class="text-justify text-center" >
                                  <a href="#" target="_blank" title="Twitter">
                                    <span class="relative inline">
                                      <img alt="Icon_twitter" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_twitter.png?1445003519">
                                    </span>
                                  </a>
                                  <a href="#" title="Instagram">
                                    <span class="relative inline">
                                      <img alt="Icon_instagram" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_instagram.png?1445003519">
                                    </span>
                                  </a>
                                  <a href="#" target="_blank" title="YouTube">
                                    <span class="relative inline">
                                      <img alt="Icon_youtube" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_youtube.png?1445003519">
                                    </span>
                                  </a>
                                  <a href="#" target="_blank" title="Facebook">
                                    <span class="relative inline">
                                      <img alt="Icon_facebook" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_facebook.png?1445003519">
                                    </span>
                                  </a>                          
                                </p>
                            </div>
                            <div class="ul_quick">   
                                <ul style="margin-left:0px;">
                                    <li><a href="#">Subscribe</a></li>
                                    <li><a href="#">Send Message</a></li>
                                    <li><a href="#">Book This Band</a></li>
                                    <li><a href="#">Get Widgets</a></li>
                                    <li><a href="#">Get Banners</a> </li>                            
                                </ul>
                            </div>
                    </div>
                </div>
                <div class="row header_new_style">
                    <div class="remove_part"></div>
                    <h2 class="tt text_caplock"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_photo.png" /> Photos</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
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
                                <div class="col-md-4 col-xs-12">
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"  class="img-responsive"/>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif"class="img-responsive"/>
                                </div>
                            <?php 
                             } else {
                                 ?>
                            <div class="col-md-4 col-xs-12">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" class="img-responsive"/>
                            </div> 
                        <?php 
                             } ?>
                        </ul>
                    </div>
                </div>
                <!--BLOG -->
                <?php if (isset($blogs) && count($blogs) > 0) {
    ?>
                <div class="row header_new_style">
                    <div class="remove_part"></div>
                    <h2 class="tt text_caplock"><a href="<?=base_url('amper/allblogs/'.$name)?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_blog.png" /> Recent Blogs</a></h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding view_style_text">
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
                                        <div class="day">
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
} ?>
                    </div>
                </div>
                <?php 
} ?>
                <!--END BLOG -->
            </div>
            <div class="col-md-6 remove_padding">
                <!--AMP -->
                <div class="row header_new_style">
                    <div class="remove_part"></div>
                    <h2 class="tt text_caplock"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_amp.png" /> AMP</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
                    </div>
                </div>
                <!--END AMP -->
                <!-- VIDEOS-->
                <?php if (isset($videos) && count($videos) > 0) {
    ?>
                 <div class="row header_new_style">
                    <div class="remove_part"></div>
                    <h2 class="tt text_caplock"><a href="<?php echo base_url('social_media'); ?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_video.png" /> Videos</a></h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 view_style_text">
                        <?php 
                        foreach ($videos as $video) {
                            if ($video['type'] == 'file') {
                                $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
                            } else {
                                $link_video = $video['link_video'];
                            } ?>
                            <div class="col-md-6 col-xs-6 remove_padding_new" style="margin-top: 15px;">
                                <a href="#" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos">
                                    <div class="image_fix_value_video img-responsive" style="background: url('<?=$this->M_video->get_image_video($video['id'])?>');"></div>
                                    <div class="play"><span class="button_play"></span></div>
                                </a>
                            </div>         
                            <?php 
                        } ?>
                    </div>
                </div>
                <?php 
} ?>
                <!-- END VIDEOS-->
                <!--COMMENT -->
                <div class="row header_new_style">
                    <div class="remove_part"></div>
                    <h2 class="tt text_caplock"><a href="<?=base_url('amper/allcomment/'.$name)?>"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_comment.png" /> Comments</a></h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <div class="wp_content_list">
                            <?php
                            if (empty($comments)) {
                                ?>
                                <span class="col-md-12" style="font-size: 16px;">No Comment.</span>
                                <?php

                            }
                            foreach ($comments as $comment) {
                                ?>
                                    <span class="col-md-12" style="font-size: 16px;">
                                        <a href="<?=$this->M_user->get_home_page($comment['client'])?>">
                                            <img width="60" style="min-height: 40px;margin-bottom: 5px;margin-right: 10px;" src="<?=$this->M_user->get_avata($comment['user_id'])?>" />
                                        </a>
                                        <a href="<?=$this->M_user->get_home_page($comment['client'])?>" class="posi_img" style="position:absolute;top:-7px;font-weight: bold;">
                                            <?=$this->M_user->get_name($comment['client'])?>
                                        </a>
                                        <span style="font-size: 12px;"><?php echo ucfirst($comment['comment']); ?></span>
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
                </div>
                <!--END COMMENT -->
                <!-- STATS -->
                <div class="row header_new_style">
                    <div class="remove_part"></div>
                    <h2 class="tt text_caplock"><img class="icon_part" src="<?php echo base_url(); ?>assets/images/icon/manager_status.png" /> Stats</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 view_style_text">
                        <div class="wp_content_list">
                            <i class="fa fa-retweet"></i>
                            <span class="full-w">Total Samples</span>
                            <span class="full-w-tt"><span ></span><?php echo $num_samples;?></span>
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
                <!--END STATS -->
            </div>
            
        </div>
        
    </div>
</div>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script> 

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
        <div id="video"></div>
        <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>      
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/landing-page/js/landing-page-4.js"></script>

