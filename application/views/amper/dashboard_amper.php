<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/amp/css/dashboard_amper.css">
<script>var base_url="<?php echo base_url();?>";</script> 
<script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/amp/dashboard_amper.js"> </script> 
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/crop-image/css/cropper.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/crop-image/css/main.css">
<script type="text/javascript">
	var link = "<?php echo base_url();?>";
</script>
<div id="crop-avatar">
<!-- HEADER END-->
<div class="cover-allsong" id="banner-modal">
	<form class="avatar-form" id="form_banner" action="<?php echo base_url(); ?>amper/crop_banner" enctype="multipart/form-data" method="post">                
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
		<div class="image-banner avatar-upload">                        
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
		<div class="avatar-wrapper" style="display: none;" id="wrapper-banner"></div>
		
		<div class="showbuttonbanner searchform">
			<a class="btn btn-maxwidth-big button_changebanner">Change banner</a>
			<button type="submit" class="btn btn-default avatar-save banner-save" style="display: none;">Save Change</button>
		</div>                                                  
	</form>
	
	<div class="img-avarar" title="Change the avatar">
		<a class="avatar_change" href="#" data-toggle="modal" data-target="#avatar-modal">Change Avatar</a>
		<img src="<?php echo $this->M_user->get_avata_flp($user_data['id'])?>" class="thumbnail" height="150" width="150" alt="Avatar"/>
		
	</div>
	
</div>    
<!-- LOGO HEADER END-->
<section class="menu-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<ul id="menu-action" class="amp-menu">
					<?php
					$params1 = $this->uri->segment(1);
					$params2 = $this->uri->segment(2);
					?>
					<li class="<?php if ($params2 == 'dashboard') {
						echo 'active';
						} ?>"><a href="<?=base_url()?>amper/dashboard">Dashboard</a></li>
					<li class="<?php if ($params2 == 'manager_audios') {
						echo 'active';
						} ?>"><a href="<?=base_url()?>amper/manager_audios">Audio Manager</a></li>
					<li class="<?php if ($params2 == 'dashboard_setting_amp') {
						echo 'active';
						} ?>"><a href="<?=base_url()?>amper/dashboard_setting_amp">Setting Widget AMP</a></li>
					<?php 
					
					if ($user_data['role'] != 1) {
						?>

					<li class="<?php if ($params2 == 'profile') {
							echo 'active';
							} ?>"><a href="<?=base_url()?>amper/profile">Change Profile </a></li>
						<?php

							} else {
						?>
							<li class="<?php if ($params2 == 'dashboard_affiliates') {
							echo 'active';
							} ?>"><a href="<?=base_url()?>amper/dashboard_affiliates">Affiliates</a></li>
						<?php

					}
					?>
					<li class="<?php if ($params2 == 'stats') {
	echo 'active';
} ?>"><a href="<?=base_url()?>amper/stats">Stats</a></li>
					<li class="<?php if ($params2 == 'blog') {
	echo 'active';
} ?>"><a href="<?=base_url()?>amper/blog">Blog</a></li>
					<li class="<?php if ($params2 == 'chat') {
	echo 'active';
} ?>"><a href="<?=base_url()?>amper/chat">Chat</a></li>
					<li class="<?php if ($params2 == 'notifications') {
	echo 'active';
} ?>"><a href="<?=base_url()?>amper/notifications">Notifications</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- MENU SECTION END-->

<section class="content-dashboard"  style="background-image: url('../assets/images/bg_fancapture.png');background-position: 50% 30%;background-attachment: fixed;">
	
	<?php
	include $link_content;
	?>
</section>
	<!-- Cropping modal -->
	<div class="modal fade new_modal_style" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <form class="avatar-form" action="<?php echo base_url(); ?>amper/change_avatar" enctype="multipart/form-data" method="post">
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
</div>
<!-- include script dashoard home -->
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>

<!-- include script manager Audio -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
<link rel="stylesheet" href="<?=base_url()?>assets/js/jstree/themes/default/style.min.css"/>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- include script Setting widget -->
<link href="<?php echo base_url(); ?>assets/map/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
 <link href="<?=base_url()?>assets/amp/css/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>assets/amp/js/setting.playlist.js"> </script>
<script type="text/javascript" src="<?=base_url()?>assets/amp/js/jquery.jplayer.js"> </script>
<script type="text/javascript" src="<?=base_url()?>assets/amp/js/jplayer.playlist.js"> </script> 
<script type="text/javascript" src="<?=base_url()?>assets/amp/js/jquery.redirect.js"> </script> 

<!-- include script crop-image avata and banner -->
<script src="<?php echo base_url(); ?>assets/crop-image/js/cropper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/crop-image/js/main.js"></script>  
<script src="<?php echo base_url(); ?>assets/crop-image/js/main_.js"></script>

