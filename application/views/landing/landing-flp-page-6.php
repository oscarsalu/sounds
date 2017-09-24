<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/landing_page/landing_page12.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/landing_page/style06.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css" />
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<div class="wrap bg-landing">
  <div class="row">
    <div class="tpl-cover view view-third" >
      <?php if (!empty($users[0]->banner_image)) {
    	?>
      <img src="<?php echo base_url(); ?>uploads/<?php echo $users[0]->id; ?>/photo/banner/<?php echo $users[0]->banner_image; ?>" height="350px" width="100%"/>
      <?php 
		} else {
	    ?>
      <div style="height: 350px; width:100%;background-color: #848484;"></div>
      <?php 
		}?>
      <div class="mask"> <img class="UserPic" src="<?php echo $avata;?>"/>
        <h1 class="view_style_text text-center fixnameuser"><?php echo ucfirst($name); ?></h1>
        <p class="view_style_text text-center"><?php if(isset($genres[0]['name'])) echo ucfirst($genres[0]['name']); ?> <?php echo ucfirst($city); if (!empty($country_code[0]['countrycode'])) {
     	echo ', '.ucfirst($country_code[0]['countrycode']);
		}; ?></p>
      </div>
    </div>
      <div class="row cont_area">
        <div class="col-md-7 col-md-offset-1 centered ">
            <div class="row song_area">
               <h4 class="sub-title">AMP</h4>
               <hr/>
              <?php echo $this->M_audio_song->get_shortcode_AMP($id)?>
            </div>
                  
            <div class="row blog ">
            <h4 class="sub-title">RECENT BLOGS</h4>
               <hr/>
                <div class="Scroll6Style3">
                 <?php foreach ($blogs as $row) {
                        ?>
                 <div class="col-md-2 blog-date clearfix">
                    <div class="day"><?php echo date('d', $row['time'])?></div>
                    <div class="month"> <?php echo date('F', $row['time'])?></div>
                    <div class="year"><?php echo date('Y', $row['time'])?></div>
                 </div>
                 <div class="col-md-10 blog-title clearfix">
                     <a href="<?php echo base_url('artist/blogs').'/'.$user_data['id']?>"><h2><?php echo $row['title']?></h2></a>
                     <p>written by:<span><?php echo $this->M_user->get_name($row['user_id']);?></span></p>
                 </div>
                 <div class="col-md-12 blog-content">
                    <img style="height: 245px;
    width: 100%;" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>"  alt=""/>
                 
                    <p> <?php 
                            $text = strip_tags($row['introduction']);
                            $desLength = strlen($text);           
                            $stringMaxLength = 120;
                                if ($desLength > $stringMaxLength) {
                                    $des = substr($text, 0, $stringMaxLength);
                                    $text = $des.'...';
                                    echo $text;
                                } else {
                                    echo $row['introduction'];
                                } ?>
                        </p>
                        <hr/>
                 </div>
                   <?php } ?>
                </div>
             </div>
             <div class="row blog">
             <h4 class="sub-title">VIDEOS</h4>
               <hr/>
             <?php foreach ($videos as $video) {
                     if ($video['type'] == 'file') { $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];}
                 elseif($video['type'] == 'link') { $link_video = $video['link_video']; }
                elseif($video['type'] == 'link-vimeo') { 
                $video_vimeo=basename($video['link_video']);
                $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                 
                $hash = unserialize(file_get_contents($get_link));
                $url_id=$hash[0]['id'];
                $link_video = 'https://player.vimeo.com/video/'.$url_id.'?title=0&byline=0&portrait=0'; }?>
                 <div class="col-md-3" style="margin-bottom:10px;">
                     <img   style="padding:4px; height:120px;" class="img-responsive" src="<?=$this->M_video->get_image_video($video['id'])?>" alt="">
                      <div class="details">
                          <h4 style="padding-left:6px;"> <?php echo $video['name_video']; ?>
                          </h4>
                           <span class="actions">
                                                        <?php if(($video['type'] == 'file') || ($video['type'] == 'link')) { ?>
                                                         <button class="btn bnt-action" type="submit" href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos" >View </button>
                                                           <?php } else { ?>
                                                            <button class="btn bnt-action" type="submit" href="#vimeo_videos" onclick="javascript:play_vimeo_video(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#vimeo_videos" >View </button>
                                                           <?php } ?>
                                                    </span>
                      </div>
                 </div>
                 <?php }?>
                   
             </div>
             <div class="row blog">
             <h4 class="sub-title">Events</h4>
               <div class="blog" style=" height:300px; max-height: 300px;overflow-y: scroll;overflow-x: hidden;">
            <?php if (isset($events) && count($events) > 0){ ?>                      
                            <?php foreach ($events as $event) {?>
                            <div class="col-xs-12 col-md-12" style="padding:16px 0 4px 0;">
                                <div class="col-xs-4 col-md-4 text-center">
                                    <img src="<?php if (!empty($event['event_banner'])) { echo base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; } ?>"  alt="Image"
                                     class=" img-responsive" />
                                </div>
                                                    <div class="col-xs-8 col-md-8 section-box">
                                                        <h4>
                                                            <a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a>
                                                        </h4>
                                                        <p>
                                                            <?php  custom_echo_html($event['event_desc'], 400); ?></p>
                                                        </div>
                                                        <hr/>
                                                       </div> 
                                                       
                                                         <?php } }?>
                   </div>
             </div>

        </div>
        <div class="col-md-4 ">
          <div class="photo-box phovodieo-box">
           <h4 class="sub-title">PHOTOS</h4>
               <hr/>
            <div id = "myTabContent" class = "Scroll6Style1 ">
                <div class="row">
                  <?php 
                    $i = 0;
                    foreach ($photos as $pt) {
                        ?>
                    <div class="col-xs-4">
                       <img  width="100" height="100" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" alt="">
                    </div>
                        <?php ++$i;
                        }
                    ?>
                  </div> 
            </div>
          </div>
          <div clss="landboxs">
            <div class="qui-action-box">
           <h4 class="sub-titles">QUICK ACTIONS</h4>
           <hr/>
            <div class="row text-center">
                <ul class="list-inline list-unstyled">
                    <li>
                        <a class="quickcl href="#"><i class="fa fa-share"></i>Share</a>
                    </li>
                    <li>
                        <?php $home_page = $this->uri->segment(1);
                        if($home_page == 'amp')
                        {
                            $home_page = $this->uri->segment(2);
                        }
                        $results = $this->db->where('home_page', $home_page)->get('users')->result_array();
                        foreach ($results as $result) { $user_i = $result['id']; }
                        $isset = $this->db->where('user_id', $user_i)->where('fan_id', $user_id)->get('fans')->num_rows();
                        ?>
                        <a href="<?php if ($isset > 0) { echo '#'; } else { echo base_url().'artist/comefan/'.$user_id.'/'.$home_page; } ?>" class="quickcl" style="<?php if ($isset > 0) {
                                    echo 'cursor: no-drop;';
                                } ?>"><i class="fa fa-user"></i> Become A Fan</a>
                    </li>
                </ul>
                        <?php
                        if ($users[0]->id != $user_data['id']) {
                            ?>
                            <div class="text-center" >
                                <a class="btn btn-info clb5" data-toggle="modal" data-target="#invite-contact" style="color:#fff;">Add Contact Chat</a>
                            </div>
                            
                            <?php
                        }
                        ?>  
                </div> 
                              
            </div>
        </div>
          <div clss="landboxs">
            <div class="stats-boxs">
              <h4 class="sub-titles">STATS</h4>
                <div class="row">
                   <div class="stats_lstyle6 st_area">
                        <ul>
                        <li><a href="#"><i class="fa fa-music"></i> Song Plays<span>(<?php echo $num_songs;?>)</span></a></li>
                        <li><a href="#"><i class="fa fa-file-video-o"></i> Video Plays<span>(<?php echo $num_videos;?>)</span></a></li>
                        <li><a href="#"><i class="fa fa-users"></i> Total Fans<span>(<?php echo $num_fands; ?>)</span></a></li>
                        <li><a href="#"><i class="fa fa-hand-rock-o"></i> Total Events<span>(<?php echo $num_events; ?>)</span></a></li>
                        <li><a href="#"><i class="fa fa-bookmark"></i> Total Blogs<span>(<?php echo $num_blogs; ?>)</span></a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> Total Comments<span>(<?php echo $num_comments; ?>)</span></a></li>
                       
                        </ul>
                    </div> 
                </div>
              </div>
            </div>
          
          <div clss="landboxs">
            <div class="comment-box">
              <h4 class="sub-titles">COMMENTS</h4>
              <hr/>
              <div class="Scroll6Style2">
               <?php  foreach ($comments as $comment) { ?>
                                        <?php $role = $this->M_user->get_user_role($comment['client']);
                                        ?>
                <div class="row">
                   <div class="col-xs-4">
                       
                       <img class="img-responsive" src="<?php if($role == '1'){ echo $this->M_user->get_avata($comment['client']);} else {echo $this->M_user->get_avata_flp($comment['client']);}?>" alt="">
                   </div>
                   <div class="col-xs-8 details">
                      <h4><a href="<?php echo $this->M_user->get_home_page($comment['client']);?>"><?php echo $this->M_user->get_name($comment['client']);?></a></h4>
                      <?php echo ucfirst($comment['comment']); ?>
                      <p><i class="fa fa-clock-o"></i><?php echo date('d F, Y',$comment['time']);?></p>
                   </div>
                </div>
                 <?php } ?> 
                <div class="text-right" >
                    <a class="btn clb6" style="color:#fff;" data-toggle="modal" data-target="#addComment">Comment</a>
                </div>
                </div>  
            </div>
          </div>
           <div clss="landboxs">
            <div class=" col-md-12 comment-box">
              <h4 class="sub-titles">fan</h4>
              <hr/> 
              <article style=" height:162px; max-height: 162px;overflow-y: scroll;overflow-x: hidden;">
                   <?php if (isset($fans) && count($fans) > 0) { ?>                       
                        <?php $i = 0; foreach ($fans as $fan) { 
                            if($fan['role'] == 1)
                            {
                              $avata = $this->M_user->get_avata($fan['fan_id']);
                            }else{
                                $avata = $this->M_user->get_avata_flp($fan['fan_id']);
                            }
                            ?>
                     <div class="col-xs-12 col-md-12 fan-area ">
                          <div class="col-xs-4 col-md-4 text-center">
                             <img src="<?php echo $avata?>" alt="Image"
                                            class="img-rounded img-responsive" />
                           </div>
                                    <div class="col-xs-8 col-md-8 section-box">
                                        <h4>
                                            <a href="<?php echo base_url().$fan['home_page']; ?>"><?php echo $this->M_user->get_name($fan['fan_id']); ?></a>
                                        </h4>
                                        
                                    </div>
                                     <hr/>                 
                                    </div>
                         <?php } }?>  
                </article>      
            </div>
          </div>
            <div clss="landboxs">
            <div class=" col-md-12 comment-box">
              <h4 class="sub-titles">member</h4>
              <hr/> 
              <article style=" height:162px; max-height:162px;overflow-y: scroll;overflow-x: hidden;">
                   <?php if (isset($members) && count($members) > 0) { ?>
                      <?php foreach($members as $member){ 
                            
                            ?>
                       <div class="row">
                            <div class="col-xs-3 col-md-2">
                                <img src="<?php echo base_url(); ?>uploads/<?php echo $member['artist_id'];?>/image_member/<?php echo $member['member_image'];?>" class="img-circle img-responsive" alt="" />
                            </div>
                            <div class="col-xs-9 col-md-10">
                                <div>
                                    <a href="#"><?php echo $member['name_member']; ?></a>
                                </div>
                                <div class="comment-text">
                                    <?php echo $member['contribution'];?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php } }else { ?>
                           <span class="testimonials-name">No content have been added in this section yet.</span>
                           <?php } ?>
                                  </article>      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade new_modal_style" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'amper/membercomment'?>" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_flp" value="<?=$id?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add Comment</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">     
                        <label class="form-input col-md-2">Comment</label>
                        <div class="input-group col-md-9">
                        <textarea class="form-control" name="comment" rows="6" required="" ></textarea>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default Dnew" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default Dnew">Add</button>
                </div> 
            </form>      
        </div>       
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".header_new_style").hover(function(){
            $(this).find(".remove_part").css("display","block");
        },function(){
            $(this).find(".remove_part").css("display","none");
        });
        $(".header_new_style .remove_part").click(function(){
            $(this).parent().slideUp();
        })
        $(".image_fix_value").click(function(){
            $(this).parent().find(".img-responsive").click();
        });       
    }); 
</script>
<div class="modal fade new_modal_style" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="" action="<?php echo base_url().'artist/membercomment'?>" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <input type="hidden" name="id_artist" value="<?=$id?>" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="tt">Add Comment</h4>
          <span class="liner"></span> </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="form-input col-md-2">Comment</label>
            <div class="input-group col-md-9">
              <textarea class="form-control" name="comment" rows="6" required="" ></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer searchform">
          <button type="button" class="btn btn-default MarNoneBtn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal showEvent -->
<div class="modal fade new_modal_style" id="showEvent" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="tt" id="myModalevent">Add Comment</h4>
        <span class="liner"></span> </div>
      <div class="modal-body">
        <div class="col-md-12"> <img id="event_banner" src="" width="535" /> </div>
        <div class="col-md-12 text-center" style="margin-top: 10px;"> <span id="cat" style="font-weight: bold; font-size: 18px;"></span> </div>
        <div class="col-md-12" style="padding:10px 30px  0px 15px;"> <span style="float: left;">Start Date: <span id="start" ></span></span> <span style="float: right;">End Date: <span id="end" style="color: red;"></span></span> </div>
        <div class="col-md-12" style="padding: 20px 30px"> <span id="des"></span> </div>
        <div class="col-md-12"> <span>Post By: <span id="post-b" style="font-weight: bold;"></span></span> </div>
        <div class="col-md-12"> <span>Location: <span id="lo" style="font-weight: bold;"></span></span> </div>
      </div>
      <div class="modal-footer searchform" style="border-top: none;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Invite Contact -->
<div class="modal fade" id="invite-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Invite Contact (
          <?=$this->M_user->get_name($users['0']->id)?>
          )</h4>
      </div>
      <form class="form form-signup" action="<?php echo base_url()?>chat/invite_contact" method="post"  >
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
        <div class="modal-body">
          <div class="form-group">
            <label class="form-input col-md-3">Messages</label>
            <div class="input-group col-md-8">
              <input type="hidden" name ="user_invite" value="<?php echo $user_data['id']?>" />
              <input type="hidden" name ="user_to" id="user_id2" value="<?php echo $users['0']->id?>" />
              <textarea class="form-control" rows="5" name="messages_invite">Hi <?=$this->M_user->get_name($users['0']->id)?>, I'd like to add you as a contact.</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add to Contacts</button>
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
<div class="modal fade" id="vimeo_videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <iframe id="vimeo_video"  width="640" height="337" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        
        <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>
    </div>
</div>
<script type="text/javascript">
  var url = "<?php echo base_url(); ?>";
</script> 
<script src="<?php echo base_url(); ?>assets/landing-page/js/landing-page-4.js"></script>
<script type="text/javascript">
(function($){
        $(window).load(function(){
            $(".Scroll6Style1,.Scroll6Style2,.Scroll6Style3").mCustomScrollbar({theme:"minimal-dark"});
        });
    })(jQuery);
</script>
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
