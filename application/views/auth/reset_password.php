
<div class="" style="position: relative;">
    <div id="video-wrap">
        <video id="my-video" preload="metadata" autoplay="" loop muted>
            <source src="<?php echo base_url(); ?>assets/background-videos/bg_video_login.mp4" type="video/mp4">
        </video>
    </div>
    <div class="" style="position: absolute;z-index: 55;top: 0; width: 100%;padding-top:50px;min-height: 100vh;">
       <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 ">
             <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.27);color: #fff;">
                <div class="panel-body">
                   <h3 class="text-center">
                     Reseting Password
                   </h3>
                  	<form class="form form-signup" role="form" action="<?php echo base_url().'account/post_reset_password'?>" method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="strike-heading"><span>email address</span></div>
                		<div class="form-group">
                			<div class="input-group">
                				<span class="input-group-addon"><span class="fa fa-key"></span>
                				</span>
                				<input type="password" class="form-control" placeholder="New Password"  name="password"/>
                                <input type="hidden" value="<?=$user_id?>" class="form-control" placeholder="New Password"  name="user_id"/>
                                <input type="hidden" value="<?=$encrypted_string?>" class="form-control" placeholder="New Password"  name="encrypted_string"/>
                		        <?php echo form_error('password', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		    </div>
                		</div>
                        <div class="form-group">
                			<div class="input-group">
                				<span class="input-group-addon"><span class="fa fa-key"></span>
                				</span>
                				<input type="password" class="form-control" placeholder="Confirm Password"  name="cpassword"/>
                			</div>
                            <?php echo form_error('cpassword', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                		<input type="submit" class="btn btn-lg btn-primary btn-block" name="signin" value="Submit">
                     </form>
                </div>        
            </div>   
        </div>
     </div>
  </div>
</div>