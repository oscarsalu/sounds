<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/crop-image/css/cropper.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/crop-image/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style/admin_artist.css">
<link href="<?php echo base_url(); ?>assets/artists/css/artist_admin_1.css" rel="stylesheet">
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/js/detail_pages/artists/managervideo.js"></script>
<script src="<?=base_url('assets/js/ckeditor/ckeditor.js')?>"></script>
<script type="text/javascript">
 


$(document).ready(function() {
$("#avatar1").draggable({ 

    containment: '#banner1',
    cursor: 'move',
    snap: '#banner1',
  
 stop: function(event, ui) {
      
      var pos_x = ui.position.left;
      var pos_y = ui.position.top;

      //Do the ajax call to the server
      $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>/artist/admin_profile/set_draggable_avatar",
          data: {x: pos_x, y: pos_y,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'}
        }).done(function( msg ) {
          alert( "Avatar Position Saved");
         window.location="<?php echo base_url();?>artist/profile";
        }); 
      
  }
 });
});
</script>
 


<style>
    .jwplayer {
            margin-bottom: -5px!important; 
    }
    .effect-bubba {
  position: relative
}

.effect-bubba span {
  display: none;
  position: absolute;
  bottom: 0;
  width:255px;
  padding: 10px;
  background: rgba(255,255,255,.8);
}

.effect-bubba:hover span {
  display: block
}
.btn-choose-layout {
        color: #ffffff;
    background-color: #222222;
    border-color: #222222; 
}
.btn-choose-layout:hover ,.btn-choose-layout:active,.btn-choose-layout:focus{
        color: #ffffff;
    background-color: #090909;
    border-color: #040404;
}
/* COMMON RADIO AND CHECKBOX STYLES  */
input[type=radio]
{
  /* Hide original inputs */
  visibility: hidden;
  position: absolute;
}
input[type=radio] + label:before
{
  height:12px;
  width:12px;
  margin-right: 2px;
  content: " ";
  display:inline-block;
  vertical-align: baseline;
  border:1px solid #777;
}
input[type=radio]:checked + label:before
{
  background:#5bc0de;
}

/* CUSTOM RADIO AND CHECKBOX STYLES */
input[type=radio] + label:before{
  border-radius:50%;
}

</style>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/artist_admin_2.js"></script>
<script>
	function tick(){
		$('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
	}
	setInterval(function(){ tick () }, 5000);
        
        

</script>

<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/artist_admin_1.js"></script>
<div class="admin-profile" style="" id="crop-avatar">
    <!--main-->
	<main class="main" role="main" style="background-image: url('../assets/images/bg_fancapture.png');background-position: 50% 50%;background-attachment: fixed;">
		<!--wrap-->
		<div class="wrap clearfix_ad">
            <div class="cover-allsong" id="banner-modal">
                <form class="avatar-form" id="form_banner" action="<?php echo base_url(); ?>artist/crop_banner" enctype="multipart/form-data" method="post">                
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="image-banner avatar-upload"  id="banner1">                        
                        <?php if ($this->M_user->get_cover($user_data['id']) != '') {
    ?>
                        <img id="test_crp" src="<?php echo $this->M_user->get_cover($user_data['id']); ?>"/>
                        <?php 
} ?>
                        <input type="hidden" class="avatar-src" name="avatar_src">
                        <input type="hidden" class="avatar-data" name="avatar_data">                        
                        <input type="file" class="avatar-input banner-input" id="avatarInput" name="avatar_file">
                        <input type="hidden" value="<?php echo $user_data['id']; ?>" name="id_user">
                        
                    </div>
                    <div class="avatar-wrapper" id="wrapper-banner"></div>
                    
                    <div class="showbuttonbanner searchform">
                        
                        <a class="btn btn-maxwidth-big button_changebanner">Change Banner</a>
                        <button type="submit" class="btn btn-success avatar-save banner-save">Save banner</button>
                        
                    </div>                                                  
                </form>
              <?php if($avatar_position['avatar_position_x']!="" and $avatar_position['avatar_position_y']!="" ){?>
                <div id="avatar1" class="img-avarar" title="Change the avatar" style="right:auto;bottom:auto; left:<?php echo $avatar_position['avatar_position_x']."px;";?>top:<?php echo $avatar_position['avatar_position_y'] ."px;";?>"> 
 
                  
                    <img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" class="thumbnail" height="150" width="150" alt="Avatar"/>
                      <a class="avatar_change" href="#" data-toggle="modal" data-target="#avatar-modal">Change Avatar</a>
                </div>
              <?php } else { ?>
                
                 <div id="avatar1" class="img-avarar" title="Change the avatar"> 
 
                    <a class="avatar_change" href="#" data-toggle="modal" data-target="#avatar-modal">Change Avatar</a>
                    <img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" class="thumbnail" height="150" width="150" alt="Avatar"/>
                    
                </div>
                
              <?php }   ?>
                
            </div>    
			<!--content-->
			<section class="alp-section-content" style="background: none;float: none;">
				<!--row-->
				<div class="row">
				 	<!--profile left part-->
					<!-- TODO:<div class="my_account one-fourth wow fadeInLeft animated" >
						<figure>
							<img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" alt="">
						</figure>
                        <div class="container-ad"></div>
					</div>
					<!--//profile left part--> 
					<div class="three-fourth" >
						<nav class="tabs">
							<ul style=" padding: 0;">
								<li class="active"><a href="#about" title="About me">About me</a></li>
								<li><a href="#bio" title="Press Here to Edit Bio">My bio</a></li>
							</ul>
						</nav>
						<!--about-->
						<div class="tab-content" id="about" style="display: block;">
                                                    <div class="container_ad" style="min-height: 210px;">
							<dl class="basic">
								<dt>Name</dt>
								<dd><?php echo $this->M_user->get_name($user_data['id'])?></dd>
								
                                <dt>Genre</dt>
								<dd><?php if (!empty($genre)) {
    echo ucfirst($genre->name);
} ?></dd>
								<dt>City & State</dt>
								<dd><?php echo ucfirst($user_data['city'])?></dd>
								<dt>Country</dt>
                                                                <?php $countryname=$this->M_find_location->get_country_by_id($user_data['countries']);
                                                             
                                                                ?>
                                                               
								<dd><?php echo ucfirst($countryname['country']);?></dd>
								<dt>Fans</dt>
								<dd><?php if (!empty($num_fands)) {
    echo $num_fands;
} else {
    echo 0;
} ?></dd>
                                <dt>Featured / Premium</dt>
								<dd><?php if (!empty($pack)) {
    echo '<a href="'.base_url('subscriptions/featured').'">Featured/Premium Artist on Homepage</a>';
} else {
    echo '<a href="'.base_url('subscriptions/featured').'">Paid Featured/Premium Artist on Homepage</a>';
} ?></dd>
							</dl>
                                                        
                                                        <a href="#" class="btn btn-default" data-toggle="modal" data-target="#editabout" style="margin-bottom:10px;">Edit: About Me</a>
						</div>
                                                </div>
						<!--//about-->
						<!--my bio-->
						<div class="tab-content" id="bio" style="display: none;">
                            <div class="container_ad" style="min-height: 210px;">
                                <!--<div class=" row">
                                    <article class="searchform">-->
                    					<h5>Bio</h5>
                                        <?php if (!empty($user_data['bio'])) {
    $desLength = strlen($user_data['bio']);
                                            //var_dump($desLength);exit;            
                                            $stringMaxLength = 970;
    if ($desLength > $stringMaxLength) {
        $des = substr($user_data['bio'], 0, $stringMaxLength);
        $text = $des.'...'; ?><p><?php echo $text; ?></p><?php 
    } else {
        ?><p> <?php echo $user_data['bio'];
    } ?></p>
                                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#addbio" style="margin-bottom:10px;">Edit Bio</a>
                                            <?php

} else {
    ?><a href="#" class="btn btn-default" data-toggle="modal" data-target="#addbio" style="margin-bottom:10px;">Add Bio</a><?php

}
                                        ?>
                    				<!--</article>
                                </div>-->
							</div>
						</div>
						<!--//my bio-->
					</div>
                    <div class="one-fourth" >
                        <h4 class="text-center" style="color:#aaa;font-size:20px;">Dashboard Manager</h4>
						<ul class="boxed gold">
							<li class="light"><a href="<?php echo base_url(); ?>artist/managerphoto" title="Photo"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_photo.png" /><span>Photo</span></a></li>
                                                        <li class="medium"><a href="<?php echo base_url(); ?>artist/managersong" title="Playlist →Song"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_songs.png" /><span style="font-size:8px;">Playlist <i class="fa fa-arrow-right" aria-hidden="true"></i>Song / Video</span></a></li>
							<li class="dark"><a href="<?php echo base_url(); ?>artist/managervideo" title="Video"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_video.png" /><span>Video</span></a></li>
							
							<li class="medium"><a href="<?php echo base_url()?>artist/managerpress" title="Press"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_press.png" /><span>Press</span></a></li>
							<li class="dark"><a href="<?php echo base_url()?>artist/blogsmanager" title="Blog"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_blog.png" /><span>Blog</span></a></li>
							<li class="dark"><a href="<?php echo base_url()?>artist/biomanager" title="Bio"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_bios.png" /><span>Bio</span></a></li>
							<li class="dark"><a href="<?php echo base_url()?>artist/basic_info" title="Profile"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/profilemanager.png" /><span>Profile</span></a></li>
                                                        <li class="light"><a href="<?php echo base_url(); ?>artist/managerevent" title="Gigs & Event"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_git_event.png" /><span>Gigs & Events</span></a></li>
							<li class="medium"><a href="<?php echo base_url(); ?>artist/manager-comment/" title="Comment"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/manager_comment.png" /><span>Comment</span></a></li>
                                                        <li class="medium"><a href="<?php echo base_url(); ?>artist/lyricmanager" title="Lyrics"><img height="60px" src="<?php echo base_url() ?>assets/images/icon/lyric.png" /><span>Lyrics</span></a></li>
						</ul>
                    </div>
				</div>
				<!--//row-->
			</section>
			<!--//content-->
            
            
            <section class="content full-width" style="background: none;">
				<div class="icons dynamic-numbers">
					<!--row-->
					<div class="row" style="color: #356280;" >
						<!--item-->
						<div class="one-fifth add-new-on">
                            <a href="#" data-toggle="modal" data-target="#uploadphoto">
                                <div class="container_ad">
                                    <span class="subtitle"><br></span>
									<i class="fa fa-picture-o fa-3x"></i>
                                                                       
                                                                        <span class="subtitle">Add Photo<br><br></span>
								</div>
                            </a>
						</div>
						<!--//item-->
                       <!--item-->
						<div class="one-fifth add-new-on">
                            <a href="<?=base_url('artist/managersong')?>" >
								<div class="container_ad">
                                                                    <span class="subtitle">Earn Money!</span>
									<i class="fa fa-music fa-3x"></i>
									<span class="subtitle">Build Playlist→Add Artist Song or Video</span>
								</div>
                            </a>
						</div>
						<!--//item-->
						<!--item-->
						<div class="one-fifth add-new-on">
                            <a href="#" data-toggle="modal" data-target="#uploadvideo">
								<div class="container_ad">
                                                                    <span class="subtitle"></span>
                                                                    
									<i class="fa fa-film fa-3x"></i>
                                                                        
                                                                        <span class="subtitle">Add Video<br><br><br></span>
								</div>
                            </a>
						</div>
						<!--//item-->
						
						<!--item-->
						<div class="one-fifth add-new-on">
                            <a href="#" data-toggle="modal" data-target="#addmember">
								<div class="container_ad">
                                                                    <span class="subtitle"><br></span>
									<i class="fa fa-users fa-3x"></i>
                                                                   
									<span class="subtitle">Add Band Member<br><br></span>
								</div>
                            </a>
						</div>
						<!--//item-->
						
						<!--item-->
						<div class="one-fifth add-new-on">
                            <a href="#" data-toggle="modal" data-target="#chooseLayout">
								<div class="container_ad">
                                                                    <span class="subtitle"><br></span>
									<i class="fa fa-square-o fa-3x"></i>
									<span class="subtitle">Choose Layout<br><br></span>
								</div>
                            </a>
						</div>
						<!--//item-->
					
						<div class="cta">
							<a href="<?php echo base_url().$user_data['home_page']?>" class="button big">Preview As Fan</a>
						</div>
					</div>
					<!--//row-->
				</div>
			</section>
            
            
            <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px;">
                <h4 class="tt text_caplock">Photos</h4>
                <span class="liner"></span>
            <div class="carousel_wrapper">
                <div class="carousel"><!-- SLIDER CONTAINER -->
                    <div class="row">
                        <?php   for ($i = 0;$i < 3;++$i) {
      if (isset($photos[$i])) {
          $src = base_url().'uploads/'.$photos[$i]['user_id'].'/photo/'.$photos[$i]['filename']; ?>
                                <!--item-->
                                
                                <div class="col-md-3 col-xs-12 col-sm-6" style="min-height: 160px;padding-bottom: 5px;" >
                                    <figure class="effect-bubba">
										<img style="height: 150px;" class="border_profile" src="<?php echo $src?>" alt="">
							<span><?php if(strlen($photos[$i]['caption']) <= 50) {
                                                echo $photos[$i]['caption'];
                                            } else{
                                                    echo substr($photos[$i]['caption'], 0, 50).'...';
                                                } ?></span>		
                                    </figure>
                                </div>
								<!--item-->
                                <?php

      } else {
          $src = base_url().'assets/images/default-img.gif'; ?>
                                <!--item-->
								<div class="col-md-3 col-xs-12 col-sm-6" style="min-height: 160px; padding-bottom: 5px;">
									<figure >
										<img   src="<?php echo $src?>" alt="">
									</figure>
								</div>
								<!--item-->
                                <?php

      } ?>
                            
                            <?php 
  }?>	
                        
                        <div class="col-md-3 col-sm-12" >
                            <dl class="basic">
								<dt>Upload Photo</dt>
								<a href="#" data-toggle="modal" data-target="#uploadphoto" ><dd><i class="fa fa-plus-square"></i></dd></a>
							</dl>
                            <dl class="basic">
								<dt>All Photos</dt>
								<a href="<?php echo base_url().$users[0]['home_page']; ?>/photos"><dd><i class="fa fa-arrows-h"></i></dd></a>
						   </dl>
                            <dl class="basic">
								<dt>Edit Photos</dt>
								<a href="<?php echo base_url();?>artist/managerphoto"><dd><i class="fa fa-pencil-square-o"></i></dd></a>
						   </dl>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SLIDER -->
            </section>
			<!--content songs-->
            
			<section class="three-fourth style-admin-section" >
                
            	<!--recipe-->
					<div class="" >
						<div class="row" style="min-height:470px;border: 1px solid #454545; margin:0  -15px 15px; ">
                            <div class="header_new_style" style="margin: 15px 0px 0px 15px;">
                                <h4 class="tt text_caplock">Songs</h4>
                                <span class="liner"></span>
                            </div>
							<!--two-third-->
							<article class="two-third" >
                                <?php if (!empty($list_album)) {
    $album = '';
    foreach ($list_album as $row) {
        $album .= $row['id'];
        if (end($list_album) != $row) {
            $album .= ',';
        }
    }
}?>
								<?php echo $this->M_audio_song->get_shortcode_AMP($user_data['id'])?>.
							</article>
							<!--//two-third-->
							
							<!--one-third-->
							<article class="one-third" >
								<div class="song-player">
                                   <ul>
                                     <?php $i = 0; foreach ($songs as $row) {
    $array_avai = explode(',', $row['availability']); ?>
                                            <li class="icon" id="song_<?php echo $i; ?>">
                                                <a href="javascript:playTrailer(<?php echo $i;
    $i++?>)" class="pull-left icon" >
                                                </a>
                                                <span class="text-center" style="color: #aaa;"><?php echo $row['song_name']; ?></span>
                                                <div class="pull-right">
                                                    <div class="btn-group" >
                                                      <button class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown" style="  border-radius: 50%;">
                                                        ...
                                                      </button>
                                                      <ul class="dropdown-menu" style="background: none;border: 1px solid #454545; background: rgba(50, 50, 50, 0.8);">
                                                            <input type="hidden" class ="id" value="<?php echo $row['id']?>"/>
                                                            <input type="hidden" class ="lyrics" value="<?php echo html_entity_decode($row['lyrics']);?>"/>
                                                            <input type="hidden" class ="song_name" value="<?php echo $row['song_name']?>"/>
                                                            <?php
                                                            if (in_array(2, $array_avai)) {
                                                                ?><li><a href="<?php echo base_url()?>artist/downloadsong/<?php echo $row['id']?>"><i class="fa fa-download"></i> Download Song</a></li><?php

                                                            }
    if (empty($row['lyrics'])) {
        ?><li><a class="btn-addlyrics"  href="#" data-toggle="modal" data-target="#addlyrics"><i class="fa fa-eyedropper"></i> Add/Edit Lyrics</a></li><?php

    } else {
        ?><li><a class="btn-viewlyrics"href="#" data-toggle="modal" data-target="#viewlyrics"><i class="fa fa-eye-slash"></i> View Lyrics</a></li><?php

    } ?>
                                                      </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <hr class="hr-small"/>
                                        <?php

}?> 
                                    </ul>
                                </div>                               
                                <script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/artist_admin_3.js"></script>
                                <dl class="basic">
                                    <dt>Add Playlist</dt>
									<a href="<?=base_url('artist/managersong')?>" class=""><dd><i class="fa fa-upload"></i></dd></a> 
									</dl>
								<dl class="basic">
									<dt>All Songs</dt>
									<a href="<?php echo base_url(); ?>artist/allsong/<?php echo $user_data['id']?>" ><dd><i class="fa fa-ellipsis-h"></i></dd></a>
                                    
								</dl>
							</article>
							<!--//one-third-->
						</div>
					</div>
					<!--//recipe-->
                     <!--recipe-->
					<div class="recipe" >
						<div class="row" style="min-height: 480px;;border: 1px solid #454545; margin:0 -15px; 15px">
                            <div class="header_new_style" style="margin: 15px 0px 0px 15px;">
                                <h4 class="tt text_caplock">Videos</h4>
                                <span class="liner"></span>
                            </div>
							<!--two-third-->
							<article class="two-third" >
								<div class="intro">
                                    <ul>
                                    <?php
                                    if (!empty($videos)) {
                                        ?>
                                        <a href="#" data-toggle="modal" data-target="#layervideo">
                                        <img  class="img-responsive"src="<?=$this->M_video->get_image_video($videos[0]['id'])?>" /><br />
                                        </a>
                                       <?php 
                                    }?>
                                	</ul>
                               </div>
							</article>
							<!--//two-third-->
							<!--one-third-->
        					<article class="one-third" style=" margin: 30px 0;" >
        						
                                <dl class="basic">
        							<dt>Add New Video</dt>
        							<a href="#" data-toggle="modal" data-target="#uploadvideo" ><dd><i class="fa fa-plus-square"></i></dd></a>
        						</dl>
                                <dl class="user">
        							<dt>All Videos</dt>
                                   <a href="<?php echo base_url()?>artist/allvideos/<?php echo $user_data['id']?>" ><dd><i class="fa fa-external-link-square"></i></dd></a>
               
        						</dl>
        					</article>
        					<!--//one-third-->
						</div>
					</div>
					<!--//recipe-->
			</section>
			<!--//content-->
			
			<!--right sidebar-->
			<aside class="sidebar one-fourth" style="-webkit-animation-fill-mode: none;">
                <div class="widget share" style="padding-top: 5px;">
                    <div class="header_new_style">
                        <h4 class="tt text_caplock">Share</h4>
                        <span class="liner"></span>
                    </div>
					<ul class="boxed">
                        <div class="fb-share-button" data-href="<?php echo base_url().$user_data['home_page']?>" data-layout="button" style="float: left; padding: 0 5px;margin-top: -2px;"></div>
                        
                        <div class="g-plus" data-action="share" data-annotation="none" data-href="<?php echo base_url().$user_data['home_page']?>"></div>
                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo base_url().$user_data['home_page']?>" data-count="none">Tweet</a>                        
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
                        <a class="tumblr-share-button" href="<?php echo base_url().$user_data['home_page']?>"></a>
                        <script id="tumblr-js" async src="https://assets.tumblr.com/share-button.js"></script>
                        
					</ul>
				</div>
                <div class="widget share" style="padding-top: 5px;">
                    <div class="header_new_style">
                        <h4 class="tt text_caplock">Social</h4>
                        <span class="liner"></span>
                    </div>
					<ul class="boxed" style="padding-left: 20px !important;">
                        <div style="padding-left: 0px; top: -4px;" class="fb-like" data-href="<?php echo base_url().$user_data['home_page']?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                        <g:plusone data-size="standard " data-annotation="bubble"  ></g:plusone>
                        <a style="padding: 0 5px;" href="https://twitter.com/share" class="twitter-share-button" data-url="http://99project.webittsolution.com/">Tweet</a>
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
                        <span style="margin-right: 38px;"></span>
                        <a style="margin-left: 38px;" data-pin-do="buttonBookmark" href="//www.pinterest.com/pin/create/button/" >
                        <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
                        <!-- Please call pinit.js only once per page -->
                        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
                        
					</ul>
				</div>
                
				<div class="widget nutrition">
                    <div class="header_new_style" style="margin: 10px 0px 0px 0px;">
                        <h4 class="tt">Stats</h4>
                        <span class="liner"></span>
                    </div>
					<table>
						<tbody><tr>
							<td>Song Plays </td>
							<td><?php echo $num_songs;?></td>
						</tr>
                        <tr>
							<td>All Videos</td>
							<td><?php echo $num_videos;?></td>
						</tr>
						<tr>
							<td> Total Fans</td>
							<td><?php echo $num_fands; ?></td>
						</tr>
						
						
						<tr>
							<td> Total Events</td>
							<td><?php echo $num_events; ?></td>
						</tr>
						<tr>
							<td>Total Blogs</td>
							<td><?php echo $num_blogs; ?></td>
						</tr>
                        <tr>
							<td>Total Comments</td>
							<td><?php echo $num_comments; ?></td>
						</tr>
					</tbody></table>
				</div>
				
				<div class="widget members searchform">
                    <div class="header_new_style" style="margin: 10px 0px 0px 0px;">
                        <h4 class="tt">Fans</h4>
                        <span class="liner"></span>
                    </div>
                    
					<ul class="boxed">
                        <?php foreach ($fans as $fan) {
    ?>  
                            <li><div class="avatar"><a href=""><img src="<?php echo $this->M_user->get_avata($fan['user_id'])?>" alt=""><span><?php echo $this->M_user->get_name($fan['user_id']) ?></span></a></div></li>
						<?php 
}?>
					</ul>
                    <a class="btn btn-maxwidth-big" href="<?php echo base_url(); ?>artist/allfans/<?php echo $users[0]['id']; ?>" >All Fans</a>
				</div>
                <div class="widget members">
                    <div class="header_new_style" style="margin: 10px 0px 0px 0px;">
                        <h4 class="tt">Member</h4>
                        <span class="liner"></span>
                    </div>
					<ul class="boxed">
                        <?php foreach ($groups_member as $row) {
    ?>                          
                            <li><div class="avatar"><a href="<?php echo base_url($this->M_user->get_homepage($row['member_id'])); ?>"><img src="<?php echo $this->M_user->get_avata($row['member_id'])?>" alt=""><span><?php echo $this->M_user->get_name($row['member_id']) ?></span></a></div></li>
						<?php 
}?>
					</ul>
				</div>
			</aside>
			<!--//right sidebar-->
            <!--section press-->
            <section class="content  full-width" style="border: 1px solid #454545;">
                <div class="header_new_style">
                    <h4 class="tt text_caplock">Press</h4>
                    <span class="liner"></span>
                </div>
                <div class="comments" >
                    <!--recipe-->
					<div class="recipe" >
						<div class="row">
							<!--two-third-->
							<article class="two-third" >
								<div class="intro">
                                    <ul id="ticker">
                                        <?php
                                        foreach ($press as $row) {
                                            ?>
                                            <li>
                                                <div id="press_item" class="full-width" >
                                                    <?php if (!empty($row['link'])) {
    ?><a href="<?php echo $row['link']?>" target="_blank"> <?php

} ?>
                                                    	<p class="mb1">
                                                			<?php echo '“'.$row['quote'].'”'?>
                                                		</p>
                                                	<?php if (!empty($row['link'])) {
    ?></a> <?php

} ?>
                                                	<div class="attribution">
                                                        <?php if (!empty($row['link'])) {
    ?><a href="<?php echo $row['link']?>" target="_blank"> <?php

} ?>
                                                            <span style="color: #fff;">—&nbsp;<?php echo '“'.$row['author'].'”'?>,</span>
                                                            <span style="color: #fff;"><?php echo '“'.$row['name'].'”'?></span>
                                                    	<?php if (!empty($row['link'])) {
    ?></a> <?php

} ?>
                                                	</div>
                                                </div>
                                            </li>
                                            <?php

                                        }
                                        ?>
                            	   </ul>
                               </div>
								
							</article>
							<!--//two-third-->
							<!--one-third-->
        					<article class="one-third" >
        						
                                <dl class="basic">
        							<dt>Add Press Release</dt>
        							<a href="#" data-toggle="modal" data-target="#addpress" ><dd><i class="fa fa-plus-square"></i></dd></a>
        						</dl>
                                <dl class="user">
        							<dt>View All Press Releases</dt>
        						   <a href="<?php echo base_url()?>artist/allpress/<?php echo $user_data['id']?>" ><dd><i class="fa fa-external-link-square"></i></dd></a>
               
        						</dl>
        					</article>
        					<!--//one-third-->
						</div>
					</div>
					<!--//recipe-->
                </div>
            </section>
            <!--//section press-->
            <!--Content comment-->
			<section class="content one-half" style="padding-right: 5px;">
                <div class="comments  hafl-containner"  style="border: 1px solid #454545;">
                    <div class="header_new_style">
                        <h4 class="tt text_caplock">Comments</h4>
                        <span class="liner"></span>
                    </div>
                    <div class="row_coment" style="padding: 15px;">
                        <!--one-third-->
						<article class=" searchform"  style="padding: 5px;">
							<a href="#" class="btn" data-toggle="modal" data-target="#addComment">Add a Comment</a>
                    	</article>
						<!--//one-third-->
                        <div class="clearfix"></div>
						<ol class="comment-list">
                            <?php $i = 0; foreach ($comments as $comment) {
     ?>
                                <?php if (!empty($comment['comment'])) {
    ?> 
                                    <?php if (empty($comment['comment_id'])) {
    ?>
                                    <!--comment-->
        							<li class="comment depth-1">
        								<div style="float: left;max-width: 90px;width:20%"><a href="<?php echo $this->M_user->get_homepage($comment['user_id'])?>"><img src="<?php echo $this->M_user->get_avata($comment['user_id'])?>" alt=""></a></div>
        								<div class="comment-box">
        									<div class="comment-author meta"> 
                                                                                        <strong><?php echo $this->M_user->get_name($comment['user_id'])?></strong>  said <?php if(isset($comment['time'])){ echo time_calculation($comment['time']);}?> 
        									</div>
        									<div class="comment-text">
        										<p><?php echo ucfirst($comment['comment']); ?></p>
        									</div>
        								</div> 
        							</li>                                    
        							<!--//comment-->
                                    <?php 
} else {
    $cm = $this->db->select('*')
                                            ->from('comments')
                                            ->where('comments.comment_id', $comment['comment_id'])
                                            ->get()->result_array(); ?>
                                    <!--comment-->
        							<li class="comment depth-1">
        								<div class="avatar">
                                            <a href="<?php echo $this->M_user->get_homepage($cm[0]['user_id'])?>">
                                                <img src="<?php echo $this->M_user->get_avata($cm[0]['user_id'])?>" alt="">
                                            </a>
                                        </div>
        								<div class="comment-box">
        									<div class="comment-author meta"> 
        										<strong><?php echo $this->M_user->get_name($comment['user_id'])?></strong> said <?=time_calculation($comment['time'])?> 
        									</div>
        									<div class="comment-text">
        										<p><?php echo ucfirst($cm[0]['comment']); ?></p>
        									</div>
        								</div> 
        							</li>
        							<!--//comment-->
                                    <?php 
}
} else {
    ?>
                                    <span class="col-md-12" style="font-size: 16px;">No Comment.</span>
                                <?php 
}
 } ?>
							
						</ol>
                        <script>
                        $(document).ready(
                        	function() 
                        	{
                        		$("ol.comment-list").niceScroll({
                        			cursorcolor: "#2f2e2e",
                        			cursoropacitymax: 0.6,
                        			boxzoom: false,
                        			touchbehavior: false
                        		});
                        		
                        		$("ol.comment-list").scroll(function()
                        		{
                        		  $(this).getNiceScroll().resize();
                        		});
                        		
                        		$("ol.comment-list").animate({ scrollTop: 999999 }, 'fast');
                        	}
                        );
                        </script>
                        <article class=" searchform"  >
							<a href="<?php echo base_url(); ?>artist/allcomment/<?php echo $users[0]['id']; ?>" class="btn btn-maxwidth-big" target="_blank">View All Comments</a>
                    	</article>
                    </div>
				</div>           
			</section>
			<!--//content-->
            <!--Gigs & Event-->
			<section class="content one-half" style="padding-left: 5px;">
                
                <div class="comments hafl-containner" style="border: 1px solid #454545;" >
                    <div class="header_new_style">
                        <h4 class="tt text_caplock">Gigs & Event</h4>
                        <span class="liner"></span>
                    </div>
                    <div class="row_coment" style="padding: 15px;">
                        <!--one-third-->
						<article class=" searchform"  style="padding: 5px;">
                            <a href="#" class="btn" data-toggle="modal" data-target="#newEvent">Add Event</a>
                    	</article>
						<!--//one-third-->
                        <div class="row">
                         <?php foreach ($events as $event) {
    ?>
                                 <?php if (!empty($event['event_banner'])) {
    $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
} else {
    $url_image = base_url().'assets/images/icon/manager_git_event.png';
} ?>
                                    
                            <div class="text-center"><strong><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></strong></div>
                            <div>
                                
                                    
                                    <div class="col-md-2"> <img width="150px" src="<?php echo $url_image; ?>" /> </div>
                            </div>
                            <div>
                                
                                    <div><strong>Location:</strong><?php custom_echo_html($event['location'], 400); ?></div>
                                    <div><strong>Start:</strong> <?php custom_echo_html($event['event_start_date'], 400); ?> <strong>To:</strong><?php custom_echo_html($event['event_end_date'], 400); ?> </div>
                                    <div><strong>Capacity:</strong><?php custom_echo_html($event['capacity'], 400); ?><strong> Star:</strong><?php custom_echo_html($event['sum_star'], 400); ?> </div>
                                   
                            </div>
                            <?php 
} ?>
                        </div>
                        
						
                    </div>
					
				</div>
                                
			</section>
			<!--//Gigs & Event-->
            <div class="clearfix"></div>
            <!--Recent Blogs-->
			<section class="content one-half" style="padding-right: 5px;">
                
                 
                <div class="comments  hafl-containner" style="border: 1px solid #454545;">
                    <div class="header_new_style">
                        <h4 class="tt text_caplock">Recent Blogs</h4>
                        <span class="liner"></span>
                    </div>
                    <div class="row_coment" style="padding: 15px;">
                        <!--one-third-->
						<article class=" searchform"  style="padding: 5px;">
							<a href="#" class="btn" data-toggle="modal" data-target="#blogs">Add a Blog</a>
                    	</article>
						<!--//one-third-->
						<ol class="comment-list">
                            <?php foreach ($blogs as $row) {
    ?>
                                <div class="mb1"> 
                                    <div class="mb1-blog-img">                                   
                                        <img class="img-responsive" width="150" src="<?php echo base_url('uploads/'.$row['user_id'].'/photo/blogs/'.$row['image_rep']) ?>" />
                                    </div>
                                    <div class="mb1-blog-content">                                                                                                                                                                                                                                                                                                         
                                        <strong>
                                            <a href="<?php echo base_url('artist/blogs').'/'.$user_data['id']?>" class="blog_entry_header ellipsis  h6-size"><?php echo $row['title']?></a>
                                        </strong>
                                        <div class="" style="color: #fff;">
                                            <span style=" font-size: small;"><?php echo date('M d, Y', $row['time'])?></span>
                                        </div>
                                        <div style="color: #fff;">                                      
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
                            
							
						</ol>
                        <article class=" searchform"  >
                            <a href="<?php echo base_url('artist/allblogs').'/'.$user_data['id']?>" class="btn btn-maxwidth-big">View All Blogs</a>
                    	</article>
                    </div>
				</div>           
			</section>
			<!--//content-->
            <!--Content comment-->
			<section class="content one-half" style="padding-left: 5px; ">
                 
                <div class="comments hafl-containner" style="border: 1px solid #454545;" >
                    <div class="header_new_style">
                        <h4 class="tt text_caplock">Status</h4>
                        <span class="liner"></span>
                    </div>
                    <div class="row_coment" style="padding: 15px;">
                        <!--one-third-->
						<article class=" searchform"  style="padding: 5px;">
                            <a href="#" class="btn" data-toggle="modal" data-target="#newstatus">Add Status</a>
                    	</article>
						<!--//one-third-->
						<div class="instructions">
							<ol>
                                <span class="text-center" style="color:#fff;<?php if (empty($users[0]['status'])) {
    echo 'font-style:italic';
} ?>"><?php if (!empty($users[0]['status'])) {
    echo $users[0]['status'];
} else {
    echo 'This Artist has not yet set a status.';
} ?></span>  
							</ol>
						</div>
                    </div>
					
				</div>
                                
			</section>
			<!--//content-->
		</div>
		<!--//wrap-->
	</main>
	<!--//main-->
    <!-- Cropping modal -->
    <div class="modal fade new_modal_style" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form" action="<?php echo base_url(); ?>artist/change_avatar" enctype="multipart/form-data" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="tt">Change Avatar</h4>
              <span class="liner"></span>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input type="hidden" class="avatar-src" name="avatar_src">
                  <input type="hidden" class="avatar-data" name="avatar_data">
                  <label for="avatarInput">Local upload</label>
                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                  <input type="hidden" value="<?php echo $user_data['id']; ?>" name="id_user">
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg"></div>
                    <div class="avatar-preview preview-md"></div>
                    <div class="avatar-preview preview-sm"></div>
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-md-12">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>
                      
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>
                    </div>
                    
                  </div>
                  
                </div>
              </div>
            </div>
            
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default avatar-save">Cut and save</button>
            </div>
          </form>
        </div>
        
        
      </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div> 
    <script src="<?php echo base_url(); ?>assets/crop-image/js/jquery.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $('#wrapper-banner').hide();
        $('.banner-save').hide();        
        $('.banner-input').change(function(){
            $('#wrapper-banner').show();
            $('.banner-save').show();
        });
        
    });
    </script>    
</div>

<?php
if (!empty($songs)) {
    ?><div class="player-song-jwplayer"><div class="container" style="padding: 0 70px;"><div id="mp3" ></div></div> </div>
<script>
    var playerInstance = jwplayer("mp3");
    jwplayer("mp3").setup({
    stretching: 'fill',
    playlist: [
        <?php foreach ($songs as $row) {
    ?>
        {
            sources: [{ 
                file: "<?php echo 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['filename'] ?>"                
            }]
        },
            <?php 
} ?>],                                        
    height: 35,
    width: "100%",
    events: {
        onPause: function(event){
            var index = jwplayer().getPlaylistIndex();
            $('#song_'+index).find('a').removeClass("selected");
        },
        onPlay: function(event){
            var index = jwplayer().getPlaylistIndex();
            $( ".song-player li" ).each(function() {
                $(this).find('a').removeClass("selected");
                $(this).find('a').addClass( "" );
            });
            $('#song_'+index).find('a').addClass("selected");
        }
        
    }
    });
</script>
<?php

}
    ?>
<!-- Modal Photo-->
<div class="modal fade new_modal_style" id="uploadphoto" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Upload Photo</h4>
                <span class="liner"></span>
            </div>
            <form class="form form-signup MyUploadForm" role="form" onsubmit="return false"  action="<?php echo base_url().'artist/newphoto'?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                   <div class="form-group">
                        <label class="form-input col-md-4">Choose a Photo File</label>
                        <div class="input-group col-md-6">
                            <input type="file" class="form-control imageInput" name="photo" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-4">Add Caption *</label>
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control " name="caption" placeholder="Enter the caption of the photo"/>
                        </div>
                        <?php echo form_error('caption', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>                    
                    <div class="form-group">
                        <input type="checkbox" class="form-input" name="check"/>
                        I own or have licensed all rights to use this photo.
                        <a href="#" data-toggle="tooltip" data-placement="right" title="about"></a>
                        <?php echo form_error('check', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>
                    <div class="progressbox" style="display:none;">
                        <div class="progressbar"></div>
                        <div class="statustxt">0%</div>
                    </div>
                    <div class="output"></div>
                </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal ADD BIO -->
<div class="modal fade new_modal_style" id="addbio" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/addbio'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add Bio</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                
                        
                      
                            <textarea class="form-control"  id="bios" name="bio" rows="6"><?php if (!empty($user_data['bio'])) {
    echo $user_data['bio'];
}?></textarea>
                     
                                  </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add Bio</button>
                </div> 
            </form>           
        </div>
    </div>
</div>
<script>                
    CKEDITOR.replace('bios');
</script>
<!-- Modal Edit About -->
<div class="modal fade new_modal_style" id="editabout" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/admin_profile/update_about'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Update About</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-2">Name</label>
                        <div class="input-group col-md-10">
                          <?php   $name = $user_data['artist_name'];

$parts = explode(' ', $name);


?>
                            <div class="col-md-5">
                            <input class="form-control" name="firstname" value="<?php if (!empty($user_data['artist_name'])) {
                                if(isset ($parts[0])) { $firstname=$parts[0]; echo trim($firstname); }}?>" placeholder="First">
                            </div>
                             <div class="col-md-5">
                            <input class="form-control" name="lastname" value="<?php if (!empty($user_data['artist_name'])) 
                                {
                           if(isset ($parts[1])) { $lastname=$parts[1]; echo trim($lastname); }
                            
                           }?>" placeholder="Last">
                             </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <label class="form-input col-md-2">Genre</label>
                        <div class="input-group col-md-9">
                         
                            <select class="form-control" name="genre">
                                <?php $get_genre=$this->M_genre->get_all_genres(); 
                                foreach($get_genre as $genre){
                                
                                ?>    
                                <option value="<?php echo $genre->id;?>" <?php  if($genre->id==$user_data['genre']){echo "selected";}?>><?php echo $genre->name;?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <label class="form-input col-md-2">City</label>
                        <div class="input-group col-md-9">
                         
                            <input class="form-control" name="city" value="<?php if (!empty($user_data['city'])) {
                            echo $user_data['city'];}?>">

                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-2">Country</label>
                        <div class="input-group col-md-9">
                         
                            <select class="form-control" name="country">
                                <?php $get_country=$this->M_find_location->get_all_countries();
                                foreach($get_country as $country){ ?>
                                
                                
                                <option value="<?php echo $country->id;?>" <?php  if($country->id==$user_data['countries']){echo "selected";}?>><?php echo $country->country;?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>  
                </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Update</button>
                </div> 
            </form>           
        </div>
    </div>
</div>
<!-- Modal ChangeLayout -->
<script>
	$(document).ready(function() {
        $('#chooseLayout').on('click','ul li', function (){
            $( "#chooseLayout ul li" ).each(function() {
                $(this).removeClass("selected");
                $(this).addClass( "" );
            });
            $(this).addClass( "selected landing-page" );
            var tpl_vl = $(this).find('.hidden-val').val();
            $( "#result-tpl" ).val(tpl_vl);
        });
        
        $('#chooseLayout').on('click','.btn-preview', function (){
            var parent = $(this).parent();
            var src = parent.find('.hidden-img').val();
            $("#alp-pre-img").attr("src",src);
	    });
        
	}) 
</script>
<div class="modal fade new_modal_style" id="chooseLayout" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/changelayout'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Change Layout</h4>
                <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group col-xs-12">
                        <p>Desired template change will be seen upon selecting Create Profile as Fan</p>
                    </div>
                    <div class="alp-template_box">
                        <ul class="sortable with_main_songs"> 
                         <?php
                         foreach ($landings as $landing) {
                             ?>
                                <li class="searchform <?php if ($user_data['template_landing'] == $landing['position']) {
    echo 'selected';
} ?>">
                                    <input type="hidden" class="hidden-val" value="<?= $landing['position'] ?>" />
                                    <input type="hidden" class="hidden-img" value="<?php echo base_url()?>uploads/templates/landing/<?php echo $landing['images'] ?>" />
                                    <img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>uploads/templates/landing/<?php echo $landing['images'] ?>"/>
                                    <span><?= strtoupper($landing['name'])?></span> 
                                    <a class="btn btn-default pull-right changeimages" data-toggle="modal" data-target="#preview-tpl">Preview</a>
                                </li>
                                <?php

                         }
                        ?>   
                        </ul>
                    </div>
                    <input id="result-tpl" type="hidden" name="template_landing" value=""/>
                </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default btn-choose-layout" >Change Layout</button>
                </div> 
            </form>           
        </div>
    </div>
</div>
<!-- Modal preview ChangeLayout -->
<div class="modal fade new_modal_style" id="preview-tpl" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Preview Template page</h4>
                <span class="liner"></span>
            </div>            
            <div class="modal-body">
                <img id="alp-pre-img" src="" width="100%" />
            </div>    
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>          
        </div>
    </div>
</div>
<!-- Modal upload video -->
<div class="modal fade new_modal_style" id="uploadvideo" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true"  >
    <div class="modal-dialog">
        <div class="modal-content"style="border-radius:45px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title btn btn-info btn-block disabled" id="myModalbg" style="width:50%;text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
             0px 8px 13px rgba(0,0,0,0.1),
             0px 18px 23px rgba(0,0,0,0.1);font-size:25px;" >Add A New Video</h2>
            </div>   
            <hr style="border-bottom: 1px solid #000;">
            <div class="router-type">
                <div class="input-group col-md-offset-4 col-md-7 ">
                    <div class="radio1">
                        <input type="radio" name="router-type" checked="" value="link" id="youtube"/><label class="radio-label" for="youtube"> Youtube </label>
                        <br> <input type="radio" name="router-type"  value="vimeo-link" id="vimeo"/><label class="radio-label" for="vimeo"> Vimeo </label>
                        <br> <input type="radio" name="router-type" value="file"  id="harddrive"/><label class="radio-label" for="harddrive"> Hard Drive </label>
                </div>
                </div>
            </div>
            <form class="form_video_link"  onsubmit="return false"  action="<?php echo base_url().'artist/addvideo'?>" method="post">           
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">YouTube Video Name </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" />
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Url </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="link_video" />
                        </div>
                        
                    </div>
                    <div class="input-group col-md-offset-4 col-md-7"> 
                        
                        
                        
                    </div>
                </div>
                 <hr style="border-bottom: 1px solid #000;">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div> 
            </form> 
              <form class="form_video_vimeo_link" style="display: none;" onsubmit="return false"  action="<?php echo base_url().'artist/addvideo'?>" method="post">           
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">Vimeo Video Name </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" />
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Url </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="link_video" />
                        </div>
                        
                    </div>
                    <div class="input-group col-md-offset-4 col-md-7"> 
                        
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div> 
            </form>
            <form id="MyUploadForm" class="form_video_file" style="display: none;" action="<?php echo base_url().'artist/upfile_video'?>" onsubmit="return false" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Name *</label> 
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" required />
                        </div>
                    </div>  
                    <div class="form-group">
						<label class="form-input col-xs-4">Choose a video file (Max_size: 150Mb)</label>
						<div class="input-group col-xs-6">
							<input type="file" class="form-control" name="image_file" id="imageInput"  />
						</div>
                    </div>
                    <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                    <div id="output"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-btn" class="btn btn-primary">Add</button>
                </div> 
            </form>         
        </div>
    </div>
</div>
<!-- Modal Status -->
<div class="modal fade new_modal_style" id="newstatus" tabindex="-1" role="dialog" aria-labelledby="myModalstatus" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/newstatus'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">New Status</h4>
                <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-2">Status</label>
                        <div class="input-group col-md-9">
                            <textarea class="form-control" name="status" rows="6" required ><?php if (!empty($users[0]['status'])) {
    echo $users[0]['status'];
}?></textarea>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add</button>
                </div>   
                </div>                
            </form>           
        </div>
    </div>
</div>
<!-- Modal upload video -->
<div class="modal fade bs-example-modal-lg" id="layervideo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div id="video"></div>
    <?php 
    if (!empty($videos)) {
        if ($videos[0]['type'] == 'file') {
            ?>
            <script>
            jwplayer("video").setup({
                width: "100%",
                aspectratio: "16:9",
                stretching: 'fill',
                file: "<?php echo base_url().'uploads/'.$user_data['id'].'/video/'.$videos[0]['name_file']?>",
                
            });
            function playTrailer(video) { 
              jwplayer().load([{
                file: video
              }]);
              jwplayer().play();
            }
            </script>
            <?php

        } else if($videos[0]['type'] == 'link-vimeo'){
            $video_vimeo=basename($videos[0]['link_video']);
                 
                  $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                 
                  $hash = unserialize(file_get_contents($get_link));
            $url_id=$hash[0]['id'];
            ?>
            <iframe src="https://player.vimeo.com/video/<?php echo $url_id; ?>?title=0&byline=0&portrait=0" width="640" height="337" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p></p>
       <?php } else {
            ?>
            <script>
            var playerInstance = jwplayer("video");
            jwplayer("video").setup({
            	stretching: 'fill',
            	file: "<?php echo $videos[0]['link_video']?>",
            	skin: "stormtrooper",
                width: "100%",
                aspectratio: "16:9"
            });
            </script>
            <?php

        }
    }
    ?>
    </div>
  </div>
</div>
<!-- Modal add member -->
<div class="modal fade new_modal_style" id="addmember" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           <?php echo form_open_multipart('artist/addmember');?>
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add Your Band Members</h4>
                <span class="liner"></span>
                </div>           
                 
                <div class="modal-body">
                  
                    <div class="form-group">
                        <label class="form-input col-md-4">Member Name</label>
                        <div class="input-group col-md-7">
                            <input type="text" name="name_member" class="form-control" required=""/>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Member Image</label>
                        <div title="Band Members photos will appear on Artist Landing Page by Pressing Photo to display PHOTO Capture page." data-toggle="tooltip" data-placement="top" >
                        <div class="input-group col-md-7">
                            <input type="file" name="member_image">
                        </div>
                            </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Member Email</label>
                        <div class="input-group col-md-7">
                            <input type="email" name="email_member" class="form-control" required=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-4">Instrument Played</label>
                        <div class="input-group col-md-7">
                            <select class="form-control" name="contribution">\
                                <option value="Vocal">Vocal</option>
                                <option value="Guitar">Guitar</option>
                                <option value="Bass">Bass</option>
                                <option value="Keyboards">Keyboards</option>
                                 <option value="Drums">Drums</option>
                                  <option value="Percussion">Percussion</option>
                                  <option value="Strings">Strings</option>
                            </select>
                        </div>
                    </div>
                   <!-- <div class="form-group">
                        <label class="form-input col-md-4">Your Name</label>
                        <div class="input-group col-md-7">
                            <input type="text" name="your_name" class="form-control" required=""/>
                        </div>
                    </div>-->
                    </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add</button>
                </div> 
            </form>           
        </div>
    </div>
</div>
<!-- Modal comment -->
<div class="modal fade new_modal_style" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
           
            <form class="" action="<?php echo base_url().'artist/comment'?>" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add a Comment</h4>
                    <span class="liner"></span>
                </div>           
                <div class="modal-body">
                    <div class="form-group">                        

                       
                        <label class="form-input col-md-2">Comment</label>

                        <div class="input-group col-md-9">
                            <textarea class="form-control" name="comment" rows="6" required ><?php //if(!empty($users[0]['status'])){echo $users[0]['status'];}?></textarea>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add</button>
                </div>   
                </div>                
            </form>           
        </div>
    </div>
</div>
<!-- Modal press -->
<div class="modal fade new_modal_style" id="addpress" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/addpress'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add Press Release</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Quote*</label>
                        <div class="input-group col-md-8">
                            <textarea class="form-control" name="quote" id="quote_remaining" rows="6" required ></textarea>
                            <div class="clearfix"></div>
                             <span  id="press_remaining">1000</span> characters remaining
                              <?php echo form_error('quote', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Publication Name*</label>
                        <div class="input-group col-md-8">
                            <input type="text"class="form-control" name="name" required />
                            <?php echo form_error('name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                        </div>
                        
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Author</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" name="author" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Published On</label>
                        <div class="input-group col-md-8">
                            <input type="date" class="form-control" name="date_on" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Web Link (URL)</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" name="link" />
                        </div>
                    </div>
                </div> 
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add</button>
                </div>                  
            </form>           
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<!-- Modal blogs -->
<div class="modal fade new_modal_style" id="blogs" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/addblogs'?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">New Blog Entry</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body" style="min-height: 800px;">
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Title*</label>
                        <div class="input-group col-md-12">
                            <input type="text"class="form-control" name="title" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Image represent*</label>
                        <div class="input-group col-md-12">
                            <input type="file"class="form-control imageInput" name="image_rep" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Introduction*</label>
                        <div class="input-group col-md-12">                            
                            <textarea class="form-control" name="introduction" rows="3" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Post Content*</label>
                        <div class="input-group col-md-12">
                            <textarea class="form-control" id="editor1" name="content" rows="6" required=""></textarea>                           
                        </div>
                    </div>
                </div> 
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add</button>
                </div>                  
            </form>           
        </div>
    </div>
</div>
<script>                
    CKEDITOR.replace( 'editor1' );
</script>
<!-- add lyrics modal -->
<div class="modal fade bs-example-modal-sm new_modal_style" id="addlyrics" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="tt">Add/Edit lyrics</h4>
            <span class="liner"></span>
        </div>
        <form action="<?php echo base_url()?>artist/addlyrics" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="modal-body">
                <div class="form-group">                    
                    
                    <div class="input-group col-xs-12 ">
                        <input type="hidden" class="form-control id_song" name="id_song" readonly="" /> 
                        <textarea class="form-control" name="lyrics" id="lyric" rows="5"></textarea>                      
                    </div>  
                </div> 
            </div>   
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- view lyrics modal -->
<div class="modal fade bs-example-modal-sm new_modal_style" id="viewlyrics" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="tt">View Lyrics: <span class="song_name"></span></h4>
            <span class="liner"></span>
        </div>
        <div class="modal-body">
            <h3>Viewing lyrics for <span class="song_name"></span> by <strong><?php echo $user_data['artist_name']?></strong>.</h3>
            <div class="lyrics-view text-center">
            
            </div>
        </div>   
        <div class="modal-footer searchform">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Modal new event -->
<div class="modal fade new_modal_style" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="myModalEvent" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
            <?php $attributes = array('name' => 'addEvents', 'id' => 'addEvents', 'method' => 'post', 'enctype' => 'multipart/form-data');?>
             <?php echo form_open('gigs_events/create', $attributes);?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add Events</h4>
                    <span class="liner"></span>
                </div>            
             <div class="modal-body">    
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_desc">Categories*</label>
                    <div class="input-group col-md-8">
                        <select class="form-control " id="categories" name="categories"  >
                            <option value="">-- Choose category --</option>
                            <option value="1">Rock</option>
                            <option value="2">Dance</option>
                            <option value="3">Pop</option>
                            <option value="4">R&B</option>
                            <option value="5">DJ</option>
                            <option value="6">Children</option>
                            <option value="7">Festivals</option>
                            <option value="8">Punk and Hardcore</option>
                            <option value="9">Staff Picks</option>                         
                        </select>                        
                    </div>
                </div>     
                
                <div class="form-group">                    
                    <label class="form-input col-md-3" for="event_banner">Choose a Banner File</label>
                    <div class="input-group col-md-8">
                        <input type="file" class="form-control" id="ev_banner" name="event_banner"  />                       
                    </div>
                </div>
                                                                                                      
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_title">Event Title*</label>
                    <div class="input-group col-md-8">
                        <input type="text" class="form-control" name="event_title" id="event_title" value="" required />                        
                    </div>
                </div>                                                               
                
                <div class="form-group">                        
                    <label class="form-input col-md-3">Event Description*</label>
                    <div class="input-group col-md-8">
                        <textarea class="form-control" rows="15" cols="60" id="event_desc" name="event_desc" required > </textarea>
                        <span id="er-des"></span>                                             
                    </div>
                </div>                                            
                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="posted_by">Post By*</label>
                    <div class="input-group col-md-8">
                        <input type="text" class="form-control" name="posted_by" id="posted_by" value="" required />  
                    </div>
                </div>
                                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_start_date">Event start date*</label>
                    <div class="input-group col-md-8">
                        <input type='text' class="form-control" name="event_start_date" id="event_start_date" required />
                    </div>
                </div>
                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_end_date">Event end date*</label>
                    <div class="input-group col-md-8">
                        <input type='text' class="form-control" name="event_end_date" id="event_end_date" required />  
                    </div>
                </div>                                                                                                                            
                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="location">Location*</label>
                    <div class="input-group col-md-8">
                        <input type="text" class="form-control" id="location" name="location" value="" required />  
                    </div>
                </div>                                                                                
                                 
                                
            <?php //echo form_close(); ?>      
            </div>
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default" id="" name="submit" value="create_event">Create Event</button>
            </div>  
        </div>
    </div>
</div>


<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/jquery-ui/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>assets/jquery-ui/external/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/editor/nicEdit.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript"> 
bkLib.onDomLoaded(function() {	
	new nicEditor({fullPanel : true,iconsPath : '<?php echo base_url(); ?>assets/js/editor/nicEditorIcons.gif'}).panelInstance('event_desc');
    $('.nicEdit-panelContain').parent().width('380px');
    $('.nicEdit-panelContain').parent().next().width('380px');	
    $('.nicEdit-main').parent().width('378px');
    $('.nicEdit-main').css('width','370px');        
});
</script>
<script type="text/javascript">
    $('#event_start_date').datepicker({
        format: "yyyy-mm-dd "+getHora()
    }); 
    $('#event_end_date').datepicker({
        format: "yyyy-mm-dd "+getHora()
    }); 
    function getHora() {
        date = new Date();
        return date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
    };    
</script>
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
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    (function($){
        $(window).load(function(){
            $("#chooseLayout .modal-body").mCustomScrollbar();
            $("#newEvent .modal-body").mCustomScrollbar();
            $("#preview-tpl .modal-body").mCustomScrollbar();
        });
        $(".changeimages").click(function(){
            var value = $(this).parent().find(".hidden-img").val();
            $("#preview-tpl").find("#alp-pre-img").attr("src",value);
        });
        $(".image-banner .banner-input").css("display","none");
        $(".button_changebanner").click(function(){
            $(".image-banner .banner-input").click();
            return false;
        })
    })(jQuery);
</script>
<script>                
    CKEDITOR.replace( 'lyric',{ height:200} );
</script>