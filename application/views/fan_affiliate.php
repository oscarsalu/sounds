<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/crop-image/css/cropper.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/crop-image/css/main.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style/admin_artist.css" />
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.mCustomScrollbar.css" />

<script src="<?php base_url() ?>assets/js/detail_pages/fan_affilate.js"></script>


<div id="fan-aff" style="background: #000;">
    <div class="container" style="background-image: url('<?php base_url(); ?>assets/images/bg_fancapture.png');background-position: 50% 50%;background-attachment: fixed;">
        <main class="main"  >
            <div class="top-bg cover-allsong">
                <div class="banner-bg image-banner avatar-upload">
                    <img class="img-responsive" src="<?php base_url(); ?>assets/images/affordable2.jpg" />
                                        <div class="showbuttonbanner searchform">
                        
                        <a class="btn btn-maxwidth-big button_changebanner">Change banner</a>
                        <button type="submit" class="btn btn-default avatar-save banner-save">Change banner</button>
                    </div>                       
                </div>
                <div class="banner-avt img-avarar">
                    <a class="avatar_change" href="#" data-toggle="modal" data-target="#avatar-modal">Change Avatar</a>
                    <img src="<?php base_url(); ?>assets/images/4.jpg" class="thumbnail" height="150" width="150"/>
                </div>
            </div>
            
            
             <div class="full-width header_new_style bio" style="border: 1px solid #454545;margin-bottom: 10px;">
                <h4 class="tt text_caplock">BIO</h4>
                <span class="liner"></span>
                <div class="carousel_wrapper">
                    
                    <p style="color: #FFF;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla 
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est 
                    laborum.</p>
                        
                </div>
            <!-- END BIO -->
            </div>
            
            
            
            <div class="full-width header_new_style photos" style="border: 1px solid #454545;margin-bottom: 10px;">
                <h4 class="tt text_caplock">Photos</h4>
                <span class="liner"></span>
                <div class="carousel_wrapper">
                    <div class="carousel"><!-- SLIDER CONTAINER -->
                        <div class="row">
                        <!--item-->
                            <div class="col-md-3 col-xs-12 col-sm-6" style="min-height: 160px;padding-bottom: 5px;">
                                <figure>
    								<img style="height: 150px;width: auto;" class="border_profile" src="http://localhost/99sound/uploads/55/photo/56d915dcbfe1a.jpg" alt="">
    							</figure>
                            </div>
    						<!--item-->
                                                        
                            <!--item-->
                            <div class="col-md-3 col-xs-12 col-sm-6" style="min-height: 160px;padding-bottom: 5px;">
                                <figure class="text-center">
    								<img style="height: 150px;width: auto;" class="border_profile " src="http://localhost/99sound/uploads/55/photo/56d915378f52f.jpg" alt="">
    							</figure>
                            </div>
    						<!--item-->
                                                        
                             <!--item-->
                            <div class="col-md-3 col-xs-12 col-sm-6" style="min-height: 160px;padding-bottom: 5px;">
                                <figure>
    								<img style="height: 150px;width: auto;" class="border_profile" src="http://localhost/99sound/uploads/55/photo/56d914db206bf.jpg" alt="">
    							</figure>
                            </div>
    						<!--item-->
                                                                
    
                            <div class="col-md-3 col-sm-12">
                                <dl class="basic">
    								<dt>Upload Photo</dt>
    								<a href="#" data-toggle="modal" data-target="#uploadphoto"><dd><i class="fa fa-plus-square"></i></dd></a>
    							</dl>
                                <dl class="basic">
    								<dt>All Photos</dt>
    								<a href="http://localhost/99sound/AndreaTuah/photos"><dd><i class="fa fa-arrows-h"></i></dd></a>
    						   </dl>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END SLIDER -->
            </div>

            
            <div class="ss">
            <div class="col-md-9 style-admin-section" >
                
            	<!--recipe-->
					<div class="" >
						<div class="row" style="min-height:470px;border: 1px solid #454545; margin:0  -15px 15px; ">
                            <div class="header_new_style" style="margin: 15px 0px 0px 15px;">
                                <h4 class="tt text_caplock">Songs</h4>
                                <span class="liner"></span>
                            </div>
							<!--two-third-->
							<article class="two-third" >
							<iframe id="iframe_amp" src="<?=base_url()?>amp/embed/09dfd1109a11827a0e9d33d805cec87c" frameborder="0" scrolling="no" width="100%" height="450px"></iframe>
							</article>
							<!--//two-third-->
							
							<!--one-third-->
							<article class="one-third" >
								<div class="song-player">
                                    <ul>
                                        <li class="icon" id="song_0">
                                                <a href="javascript:playTrailer('0')" class="pull-left icon" >
                                                </a>
                                                <span class="text-center" style="color: #aaa;">My Love</span>
                                                <div class="pull-right">
                                                    <div class="btn-group" >
                                                      <button class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown" style="  border-radius: 50%;">
                                                        ...
                                                      </button>
                                                      <ul class="dropdown-menu" style="background: none;border: 1px solid #454545; background: rgba(50, 50, 50, 0.8);">
                                                            <input type="hidden" class ="id" value="69"/>
                                                            <input type="hidden" class ="lyrics" value=""/>
                                                            <input type="hidden" class ="song_name" value="My Love"/>
                                                            <li><a class="btn-addlyrics"  href="#" data-toggle="modal" data-target="#addlyrics"><i class="fa fa-eyedropper"></i> Add Lyrics</a></li>                                                            <li><a href="#"><i class="fa fa-floppy-o"></i> Save</a></li>
                                                            <li><a href="#" id="save_song"><i class="fa fa-share"></i> Share</a></li>
                                                      </ul>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            
                                            <hr class="hr-small"/>
                                            <li class="icon" id="song_1">
                                                <a href="javascript:playTrailer('1')" class="pull-left icon" >
                                                </a>
                                                <span class="text-center" style="color: #aaa;">Sugar</span>
                                                <div class="pull-right">
                                                    <div class="btn-group" >
                                                      <button class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown" style="  border-radius: 50%;">
                                                        ...
                                                      </button>
                                                      <ul class="dropdown-menu" style="background: none;border: 1px solid #454545; background: rgba(50, 50, 50, 0.8);">
                                                            <input type="hidden" class ="id" value="68"/>
                                                            <input type="hidden" class ="lyrics" value=""/>
                                                            <input type="hidden" class ="song_name" value="Sugar"/>
                                                            <li><a class="btn-addlyrics"  href="#" data-toggle="modal" data-target="#addlyrics"><i class="fa fa-eyedropper"></i> Add Lyrics</a></li>                                                            <li><a href="#"><i class="fa fa-floppy-o"></i> Save</a></li>
                                                            <li><a href="#" id="save_song"><i class="fa fa-share"></i> Share</a></li>
                                                      </ul>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            
                                            <hr class="hr-small"/>
                                                                                    <li class="icon" id="song_2">
                                                <a href="javascript:playTrailer('2')" class="pull-left icon" >
                                                </a>
                                                <span class="text-center" style="color: #aaa;">Love Story</span>
                                                <div class="pull-right">
                                                    <div class="btn-group" >
                                                      <button class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown" style="  border-radius: 50%;">
                                                        ...
                                                      </button>
                                                      <ul class="dropdown-menu" style="background: none;border: 1px solid #454545; background: rgba(50, 50, 50, 0.8);">
                                                            <input type="hidden" class ="id" value="67"/>
                                                            <input type="hidden" class ="lyrics" value=""/>
                                                            <input type="hidden" class ="song_name" value="Love Story"/>
                                                            <li><a class="btn-addlyrics"  href="#" data-toggle="modal" data-target="#addlyrics"><i class="fa fa-eyedropper"></i> Add Lyrics</a></li>                                                            <li><a href="#"><i class="fa fa-floppy-o"></i> Save</a></li>
                                                            <li><a href="#" id="save_song"><i class="fa fa-share"></i> Share</a></li>
                                                      </ul>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            
                                            <hr class="hr-small"/>
                                            <li class="icon" id="song_3">
                                                <a href="javascript:playTrailer('3')" class="pull-left icon" >
                                                </a>
                                                <span class="text-center" style="color: #aaa;">Blank Space</span>
                                                <div class="pull-right">
                                                    <div class="btn-group" >
                                                      <button class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown" style="  border-radius: 50%;">
                                                        ...
                                                      </button>
                                                      <ul class="dropdown-menu" style="background: none;border: 1px solid #454545; background: rgba(50, 50, 50, 0.8);">
                                                            <input type="hidden" class ="id" value="66"/>
                                                            <input type="hidden" class ="lyrics" value=""/>
                                                            <input type="hidden" class ="song_name" value="Blank Space"/>
                                                            <li><a class="btn-addlyrics"  href="#" data-toggle="modal" data-target="#addlyrics"><i class="fa fa-eyedropper"></i> Add Lyrics</a></li>                                                            <li><a href="#"><i class="fa fa-floppy-o"></i> Save</a></li>
                                                            <li><a href="#" id="save_song"><i class="fa fa-share"></i> Share</a></li>
                                                      </ul>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            
                                            <hr class="hr-small"/>
                                                                                    <li class="icon" id="song_4">
                                                <a href="javascript:playTrailer('4')" class="pull-left icon" >
                                                </a>
                                                <span class="text-center" style="color: #aaa;">Stay with me</span>
                                                <div class="pull-right">
                                                    <div class="btn-group" >
                                                      <button class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown" style="  border-radius: 50%;">
                                                        ...
                                                      </button>
                                                      <ul class="dropdown-menu" style="background: none;border: 1px solid #454545; background: rgba(50, 50, 50, 0.8);">
                                                            <input type="hidden" class ="id" value="65"/>
                                                            <input type="hidden" class ="lyrics" value=""/>
                                                            <input type="hidden" class ="song_name" value="Stay with me"/>
                                                            <li><a class="btn-addlyrics"  href="#" data-toggle="modal" data-target="#addlyrics"><i class="fa fa-eyedropper"></i> Add Lyrics</a></li>                                                            <li><a href="#"><i class="fa fa-floppy-o"></i> Save</a></li>
                                                            <li><a href="#" id="save_song"><i class="fa fa-share"></i> Share</a></li>
                                                      </ul>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            
                                            <hr class="hr-small"/>
                                         
                                    </ul>
                                </div>                                 
                                <script src="<?php echo base_url(); ?>assets/js/index/fan_affiliate.js"></script>                          
                                <dl class="basic">
                                    <?php if (!empty($list_album)):?>
                                    <dt>Upload Song</dt>
									<a href="#" class="" data-toggle="modal" data-target="#uploadsong"><dd><i class="fa fa-upload"></i></dd></a>  
								    <?php else:?>
                                    <dt>Add Playlist</dt>
									<a href="#" class="" data-toggle="modal" data-target="#addplaylist"><dd><i class="fa fa-upload"></i></dd></a>  
								   <?php endif?>
									</dl>
								<dl class="basic">
									<dt>All Songs</dt>
									<a href="<?=base_url()?>artist/allsong/55" ><dd><i class="fa fa-ellipsis-h"></i></dd></a>
                                    
								</dl>
							</article>
							<!--//one-third-->
						</div>
					</div>
					<!--//recipe-->
                    
			</div><!--end SONGS-->
            
            
            <div class="col-md-3">
			 <!--right sidebar-->
    			<aside class="sidebar" style="-webkit-animation-fill-mode: none;">
                    <div class="widget nutrition">
                        <div class="header_new_style" style="margin: 10px 0px 0px 0px;">
                            <h4 class="tt">STATS</h4>
                            <span class="liner"></span>
                        </div>
    					<table>
    						<tbody><tr>
    							<td>AMP Samples  </td>
    							<td>2</td>
    						</tr>
    						<tr>
    							<td>AMP Sales</td>
    							<td>59</td>
    						</tr>
    						<tr>
    							<td>Primary Genre</td>
    							<td>Rock</td>
    						</tr>
    						<tr>
    							<td>Secondary Genre</td>
    							<td>Dance</td>
    						</tr>
    						<tr>
    							<td>Visited</td>
    							<td>1117</td>
    						</tr>
    						<tr>
    							<td>Friends</td>
    							<td>255</td>
    						</tr>
    					</tbody></table>
    				</div>
                    <div class="members add-friend">
                        <div class="header_new_style" style="margin: 10px 0px 0px 0px;">
                            <h4 class="tt" style="font-size: 16px;padding-left: 10px;">ADD FRIENDS</h4>
                            <button  type="button" class="btn btn-primary btn-af" href="#" >Add Friend</button>
                            <span class="liner" style="height: 0px;margin:0;"></span>
                            <div class="af-container mCustomScrollbar"  data-mcs-theme="minimal">
                                <div class="addfr-container"  style="padding: 0;">
                                    <div class="af-avatar" style="float: left;padding:0">
                                        <img src="<?php base_url(); ?>assets/images/4.jpg" height="50" width="50"/>
                                    </div>
                                    <div class="af-name" style="padding: 0;">
                                        <h6>MAROON ALIS</h6>
                                        <div class="af-noti">
                                            <button type="button" class="btn btn-primary">Accept</button>
                                            <button type="button" class="btn btn-primary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="addfr-container" style="padding: 0;">
                                    <div class="af-avatar" style="float: left;padding:0">
                                        <img src="<?php base_url(); ?>assets/images/3.jpg" height="50" width="50"/>
                                    </div>
                                    <div class="af-name" style="padding: 0;">
                                        <h6>CRISTIANO</h6>
                                        <div class="af-noti">
                                            <button type="button" class="btn btn-primary">Accept</button>
                                            <button type="button" class="btn btn-primary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="addfr-container" style="padding: 0;">
                                    <div class="af-avatar" style="float: left;padding:0">
                                        <img src="<?php base_url(); ?>assets/images/2.jpg" height="50" width="50"/>
                                    </div>
                                    <div class="af-name" style="padding: 0;">
                                        <h6>AKIRA</h6>
                                        <div class="af-noti">
                                            <button type="button" class="btn btn-primary">Accept</button>
                                            <button type="button" class="btn btn-primary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="addfr-container" style="padding: 0;">
                                    <div class="af-avatar" style="float: left;padding:0">
                                        <img src="<?php base_url(); ?>assets/images/1.jpg" height="50" width="50"/>
                                    </div>
                                    <div class="af-name" style="padding: 0;">
                                        <h6>KAMEHAMEHA OLAGAMBO CHACHA</h6>
                                        <div class="af-noti">
                                            <button type="button" class="btn btn-primary">Accept</button>
                                            <button type="button" class="btn btn-primary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    				</div>
    			</aside>
			</div>
			<!--//content-->
            </div>
            
            <div style="clear: both;"></div>
            
            <div class="video">
                <div class="header_new_style" style="margin: 15px 0px 0px 15px;">
                    <h4 class="tt text_caplock">Videos</h4>
                    <span class="liner"></span>
                </div>
                <div class="row">
                    <div class="col-md-8">
                    
                         <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#layervideo">
                                <img  class="img-responsive"src="http://img.youtube.com/vi/09R8_2nJtjg/hqdefault.jpg" /><br />
                            </a>
                         </div>     
                         
                         <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#layervideo">
                                <img  class="img-responsive"src="http://img.youtube.com/vi/09R8_2nJtjg/hqdefault.jpg" /><br />
                            </a>
                         </div>  
                         
                         <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#layervideo">
                                <img  class="img-responsive"src="http://img.youtube.com/vi/09R8_2nJtjg/hqdefault.jpg" /><br />
                            </a>
                         </div> 
                            
                    </div>
                    <div class="col-md-4">
                        <dl class="basic">
							<dt>Add New Video</dt>
							<a href="#" data-toggle="modal" data-target="#uploadvideo" ><dd><i class="fa fa-plus-square"></i></dd></a>
						</dl>
                        <dl class="basic">
							<dt>All Videos</dt>
                            <a href="#" ><dd><i class="fa fa-external-link-square"></i></dd></a>
						</dl>
                    </div>
                </div>
            </div><!-- end video-->
            
            
            
            
            <div class="blog">
                <div class="header_new_style" style="margin: 15px 0px 0px 15px;">
                    <h4 class="tt text_caplock">BLOGS</h4>
                    <span class="liner"></span>
                </div>
                <div class="row">
						<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#blogs">Add Blog</button>
						<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#blogs">All Blog</button>

						<!--//one-third-->
						<ol class="comment-list content mCustomScrollbar" data-mcs-theme="minimal" >
                        
                            <div class="mb1 blog-container"> 
                            
                                <div class="col-xs-5 col-md-2">                                   
                                    <img class="img-responsive" width="150" src="http://localhost/99sound/uploads/55/photo/blogs/56d95178da917.jpg" />
                                </div>
                                
                                <div class="col-xs-7 col-md-10">                                                                                                                                                                                                                                                                                                         
                                    <strong>
                                        <a href="#" class="blog_entry_header ellipsis  h6-size">Apple Plans $12 Billion Bond Sale for Buybacks and Dividends</a>
                                    </strong>
                                    <div class="fanf-date" style="color: #fff;">
                                        <span style=" font-size: small;">Mar 04, 2016</span>
                                    </div>
                                    <div class="hidden-xs" style="color: #fff;">                                      
                                        Apple announced plans on Tuesday to sell up to $12 billion in bonds to pay for share buybacks and dividends, as blue-chi...                                    
                                    </div>   
                                </div>                                                                   
                            </div>
                            <hr style="margin-bottom:0px;" />  
                                
                            <div class="mb1 blog-container"> 
                                <div class="col-xs-5 col-md-2">                                   
                                    <img class="img-responsive" width="150" src="http://localhost/99sound/uploads/55/photo/blogs/56d945535f244.jpg" />
                                </div>
                                <div class="col-xs-7 col-md-10">                                                                                                                                                                                                                                                                                                         
                                    <strong>
                                        <a href="http://localhost/99sound/artist/blogs/55" class="blog_entry_header ellipsis  h6-size">Edward Snowden defends Apple in fight against FBI</a>
                                    </strong>
                                    <div class="fanf-date" style="color: #fff;">
                                        <span style=" font-size: small;">Mar 04, 2016</span>
                                    </div>
                                    <div class="hidden-xs"  style="color: #fff;">                                      
                                        Edward Snowden � the ex-NSA contractor who started this whole privacy debate � has joined the ranks of Apple defende...                                    
                                    </div>   
                                </div>                                                                   
                            </div>
                            <hr style="margin-bottom:0px;" />
                            
                            <div class="mb1 blog-container"> 
                                <div class="col-xs-5 col-md-2">                                   
                                    <img class="img-responsive" width="150" src="http://localhost/99sound/uploads/55/photo/blogs/56d944722b545.jpg" />
                                </div>
                                <div class="col-xs-7 col-md-10">                                                                                                                                                                                                                                                                                                         
                                    <strong>
                                        <a href="http://localhost/99sound/artist/blogs/55" class="blog_entry_header ellipsis  h6-size">�Guardians of the Galaxy Vol. 2' starts production, casts Kurt Russell</a>
                                    </strong>
                                    <div class="fanf-date" style="color: #fff;">
                                        <span style=" font-size: small;">Mar 04, 2016</span>
                                    </div>
                                    <div class="hidden-xs"  style="color: #fff;">                                      
                                        The Guardians of the Galaxy are going to be a little bit more �hateful.� �Guardians of the Galaxy Vol. 2,� the s...                                    
                                    </div>   
                                </div>                                                                   
                            </div>
                            <hr style="margin-bottom:0px;" />
                

						</ol>
                        <!--
                        <article class=" searchform"  >
                            <a href="http://localhost/99sound/artist/allblogs/55" class="btn btn-maxwidth-big">All Blogs</a>
                    	</article>
                        -->
                    </div>
                </div>
            </div><!-- end blog-->  
            
            
        </main>
    </div>
    
  <div class="modal fade new_modal_style" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form" action="<?=base_url()?>artist/change_avatar" enctype="multipart/form-data" method="post">
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
                  <input type="hidden" value="55" name="id_user">
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
  
  
  
<!-- Modal player video -->
<div class="modal fade bs-example-modal-lg" id="layervideo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div id="video"></div>
                <script>
            var playerInstance = jwplayer("video");
            jwplayer("video").setup({
            	stretching: 'fill',
            	file: "https://www.youtube.com/watch?v=09R8_2nJtjg",
            	skin: "stormtrooper",
                width: "100%",
                aspectratio: "16:9"
            });
            </script>
                </div>
  </div>
</div>

<!-- Modal upload video -->
<div class="modal fade new_modal_style" id="uploadvideo" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?=base_url()?>artist/uploadvideo" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Upload Video</h4>
                <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Name *</label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" />
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Url *</label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="link_video" />
                        </div>
                        
                    </div>
                    <div class="input-group col-md-offset-4 col-md-7 searchform"> 
                        <strong>Examples of Valid YouTube :</strong>
                        https://www.youtube.com/watch?v=MWIO6C4Bcn0<br /><br />
                        <strong>Have a YouTube account?</strong><br />
                        <button class="btn btn-primary">Import All</button> your YouTube videos at once.
                        
                    </div>
                </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Upload</button>
                </div> 
            </form>           
        </div>
    </div>
</div>


<!-- Modal Photo-->
<div class="modal fade new_modal_style" id="uploadphoto" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Upload Photo</h4>
                <span class="liner"></span>
            </div>
            <form class="form form-signup MyUploadForm" role="form" onsubmit="return false"  action="<?=base_url()?>artist/newphoto" method="post" enctype="multipart/form-data">
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
                                            </div>                    
                    <div class="form-group">
                        <input type="checkbox" class="form-input" name="check"/>
                        I own or have licensed all rights to use this photo.
                        <a href="#" data-toggle="tooltip" data-placement="right" title="about">??</a>
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

  
</div><!--end fan-aff-->

	<script src="<?php echo base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>