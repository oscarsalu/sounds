<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet">
<div class="wrap bg-landing" style="">
    <div class="container bg-lg-ct" style="width: 100%;padding: 0;">
        <div class="row">
            <div class=" profile-maxheight dis-n" style="min-height: 350px;max-height: 350px;background-color:#848484;position: relative;">
                <?php if (!empty($users->banner_image)) {
    ?> 
                    <img src="<?php echo base_url(); ?>uploads/<?php echo $users->id; ?>/photo/banner/<?php echo $users->banner_image; ?>" class="n-ds" style="width:100%;height: 350px;;"/>
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
            
            <div class="col-md-12">                
                <div class="col-md-4">
                    <h2>Photos</h2>
                    <hr/>
                    <div class="">
                        <?php $count = count($photos);
                             if ($count == 3) {
                                 $i = 0;
                                 foreach ($photos as $pt) {
                                     ?>
                                <div class="col-md-4 col-xs-4" <?php if ($i == 1 | $i == 2) {
    echo "style='margin-left:10px;'";
} else {
    echo "style='margin-left:-25px;'";
} ?>>
                                    <img width="100" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                </div> 
                        
                        <?php ++$i;
                                 }
                             } elseif ($count == 2) {
                                 $i = 0;
                                 foreach ($photos as $pt) {
                                     ?>
                                <div class="col-md-4 col-xs-4" <?php if ($i == 1) {
    echo "style='margin-left:10px;'";
} else {
    echo "style='margin-left:-25px;'";
} ?>>
                                    <img width="100" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                </div> 
                        
                        <?php ++$i;
                                 } ?>
                                <div class="col-md-4 col-xs-4" style="margin-left:10px;">
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" style="min-height: 82px;" class="img-responsive"/>
                                </div>
                                <?php 
                             } elseif ($count == 1) {
                                 foreach ($photos as $pt) {
                                     ?>
                                    <div class="col-md-4 col-xs-4" style='margin-left:-25px;'>
                                        <img width="100" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                    </div> 
                            
                                <?php 
                                 } ?>
                                    <div class="col-md-4 col-xs-4" style="margin-left:10px;">
                                        <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                    </div>
                                    <div class="col-md-4 col-xs-4" style="margin-left:10px;">
                                        <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                    </div>
                                <?php 
                             } else {
                                 ?>
                                <div class="col-md-4 col-xs-4" style='margin-left:-25px;' >
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                </div>
                                <div class="col-md-4 col-xs-4" style='margin-left:10px;' >
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                </div>
                                <div class="col-md-4 col-xs-4" style='margin-left:10px;' >
                                    <img width="100" src="<?php echo base_url(); ?>assets/images/default-img.gif" style="min-height: 82px;max-height: 82px;min-width: 65px;" class="img-responsive"/>
                                </div> 
                        <?php 
                             } ?>
                    </div>     
                    <h2>About</h2>
                    <hr/>
                    <p class="center "><strong>Bio:</strong> <?php if (!empty($users->bio)) {
    echo $this->Member_model->short_Text_Bio($users->bio);
} ?></p>
                    <div class="">
                        <p class="text-justify" style="margin-left: -15px;margin-top: 20px;margin-bottom: 20px;">
                          <a href="#" target="_blank" title="Twitter">
                            <span class="relative inline" style="height:24px;width:24px">
                              <img alt="Icon_twitter" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_twitter.png?1445003519" style="z-index:1">
                            </span>
                          </a>
                          <a href="#" title="Instagram">
                            <span class="relative inline" style="height:24px;width:24px">
                              <img alt="Icon_instagram" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_instagram.png?1445003519" style="z-index:1">
                            </span>
                          </a>
                          <a href="#" target="_blank" title="YouTube">
                            <span class="relative inline" style="height:24px;width:24px">
                              <img alt="Icon_youtube" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_youtube.png?1445003519" style="z-index:1">
                            </span>
                          </a>
                          <a href="#" target="_blank" title="Facebook">
                            <span class="relative inline" style="height:24px;width:24px">
                              <img alt="Icon_facebook" class="centerer--y" src="https://gp1.wac.edgecastcdn.net/802892/production_static/20151016092753/images/v4/standard_resources/social_icons/icon_facebook.png?1445003519" style="z-index:1">
                            </span>
                          </a>                          
                        </p>
                    </div>
                    <h2>Videos</h2>
                        <br/>                        
                        <div class="" style="padding: 0px;">
                            <?php 
                                foreach ($videos as $video) {
                                    if ($video['type'] == 'file') {
                                        $images_video = base_url('assets/images/img/play_videos.png');
                                        $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
                                    } else {
                                        $parse = parse_url($video['link_video']);
                                        if ($parse['host'] == 'www.youtube.com') {
                                            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video['link_video'], $matches);
                                            $id_link = $matches[0];
                                        } else {
                                            $id_link = 'MWIO6C4Bcn0';
                                        }
                                        $images_video = 'https://i.ytimg.com/vi/'.$id_link.'/sddefault.jpg';
                                        $link_video = $video['link_video'];
                                    } ?>
                                     <div class="col-md-6" style="">
                                        <a href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos">
                                        <img class="" style="height: 150px; padding: 4px 0px;"src="<?php echo $images_video; ?>"/>
                                        <div class="play"><span class="button_play"></span></div></a>                                
                                    </div>                        
                            <?php 
                                } ?>     
                        </div>  
                </div>
                <div class="col-md-4">
                    <div class="">                        
                        <h2>Songs
                        <span class="song_url" style="margin-top: 5px;">
                        </span>
                        </h2>                                                                                                                          
                        <hr/> 
                        <div class="">
                            <?=$this->M_audio_song->get_AMP_by_affiliate($users->id)?>                                                      
                        </div>  
                    </div>
                </div>
                
                <div class="col-md-4">                   
                    <div class="">
                        <button class="btn btn-primary col-xs-12" style="margin-top: 20px;margin-bottom: 20px;font-weight: bold;padding: 15px;">Share</button>
                    </div>   
                    <div class="blogs">
                        <h2>Blogs</h2>
                        <hr/>
                        <ul>
                            <?php
                            foreach ($blogs as $blog) {
                                ?>
                                <a href="<?=base_url('amp/'.$users->home_page.'/detailsblogs?id_blog='.$blog['id'])?>">
                                <li style="list-style-type: none;"><strong><?= $blog['title']?></strong><p class="blog-introduction"><?= $blog['introduction']?></p></li>
                                </a>
                                <?php

                            }
                            ?>
                        </ul>
                    </div>
                    <div class="stats">
                        <h2>Stats</h2>
                        <hr/>
                        <i class="fa fa-music"></i>
                        <span class="full-w" style="font-size: 16px;margin-left: 15px;">Song Plays</span>
                        <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;">+51</span>524</span>
                        <hr class="hr-small"/> 
                        <i class="fa fa-users"></i>
                        <span class="full-w" style="font-size: 16px;margin-left: 15px;">Total Fans</span>
                        14                       
                        <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span>5165</span>
                        <hr class="hr-small"/> 
                        <i class="fa fa-star"></i>
                        <span class="full-w" style="font-size: 16px;margin-left: 15px;">Webhiya Fans</span>
                        <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;">+21</span>388</span>
                        <hr class="hr-small"/> 
                        <i class="fa fa-facebook-square"></i>
                        <span class="full-w" style="font-size: 16px;margin-left: 15px;">Facebook Likes</span>
                        <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span>931</span>
                        <hr class="hr-small"/> 
                        <i class="fa fa-twitter"></i>
                        <span class="full-w" style="font-size: 16px;margin-left: 15px;">Twitter Followers</span>
                        <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;"></span>173</span>
                        <hr class="hr-small"/> 
                        <i class="fa fa-star"></i>
                        <span class="full-w" style="font-size: 16px;margin-left: 15px;">Widget Impressions</span>
                        <span class="full-w-tt" style="float: right;"><span style="color: #57ce57;font-size: 12px;margin-right: 20px;">+2</span>22</span>                        
                    </div>                       
                </div>
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
<script type="text/javascript">
    function playvideo(link_video,o){
        $link_vd = link_video;              
        var playerInstance = jwplayer("video");
        jwplayer("video").setup({
        	stretching: 'fill',
        	file: $link_vd,            	
            width: "100%",            
            aspectratio: "16:9"
        });   
        jwplayer("video").play();            
    }     
</script> 
