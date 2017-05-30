 <script>
   $(document).ready(function() {
        $('#login').on('click', function (){
            $('#form_register').hide();
            $('#form_login').show();
        });
        $('#register').on('click', function (){
            $('#form_register').show();
            $('#form_login').hide();
        })
    }) 
</script>
<div class="" style="position: relative;">
    <div id="video-wrap">
        <video id="my-video" preload="metadata" autoplay="" loop muted>
            <source src="<?php echo base_url(); ?>assets/background-videos/bg_video_login.mp4" type="video/mp4">
        </video>
    </div>
    <div class="" style="position: absolute;z-index: 55;top: 0; width: 100%;padding-top:50px;min-height: 100vh;">
       <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
             <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.27);color: #fff;" >
                <div class="panel-body">
                   <h3 class="text-center">
                    To Become An Affiliate Of <strong><?=$parent_affiliate->firstname?>  <?=$parent_affiliate->lastname?></strong>
                   </h3>
                   <p class="text-center">
                   <button class="btn btn-success" id="login"> Available Account 99sound </button>
                   <button class="btn btn-primary" id="register"> Register Account 99sound </button>
                   </p>
                   <form style="display: none;" id="form_register" class="form form-signup" role="form" action="<?php echo base_url().'account/register/post_aff'?>" method="post">
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                      <div class="form-group">
                         <div class="">
                            <input type="email" class="form-control" placeholder="Email *"  name="email" />
                         </div>
                         <?php echo form_error('email', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      <div class="form-group">
                         <div class="">
                            <input type="password" class="form-control" placeholder="Password *"  name="pass" />
                         </div>
                         <?php echo form_error('paypal', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      <div class="form-group">
                         <div class="">
                            <input type="password" class="form-control" placeholder="Confirm Password *"  name="cpass" />
                         </div>
                         <?php echo form_error('cpass', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      
                      <div class="form-group">
                         <div class="">
                            <input type="email" class="form-control" placeholder="Email Paypal *"  name="paypal" />
                         </div>
                         <?php echo form_error('paypal', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      <div class="form-group">
                         <div class="">
                            <input type="text" class="form-control" placeholder="First Name"  name="firstname" />
                         </div>
                         <?php echo form_error('firstname', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      <div class="form-group">
                         <div class="">
                            <input type="text" class="form-control" placeholder="Last Name"  name="lastname" />
                            <?php echo form_error('lastname', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		     </div>
                      </div>
                      <div class="form-group">
                         <div class="">
                            <input type="text" class="form-control" placeholder="City "  name="city" />
                         </div>
                         <?php echo form_error('city', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		 </div>
                     <input type="hidden" value="<?=$parent_affiliate->affiliate_id?>"  name="affiliateId" />
                     <div class="checkbox">
                        <label>
                            <input type="checkbox" required=""> You are agreeing to 99sound.com <a target="_blank" href="<?=base_url('footer/terms')?>">Terms and Conditions</a>
                         and <a target="_blank" href="<?=base_url('footer/privacy-policy')?>">Privacy Policy </a>
                        </label>
                     </div>
                     <input type="submit" class="btn btn-lg btn-primary btn-block" name="join" value="To Become An Afiliate"/>
                   </form>
                   <form style="display: none;" id="form_login" class="form form-signup" role="form" action="<?php echo base_url().'account/login_affiliate'?>" method="post">
                   <div class="form-group">
            			<div class="input-group">
            				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
            				</span>
            				<input type="text" class="form-control" placeholder="Email Address"  name="email"/>
            			</div>
            		</div>
            		<div class="form-group">
            			<div class="input-group">
            				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            				<input type="password" class="form-control" placeholder="Password" name="password" />
            			</div>
            		</div>
                    <input type="hidden" value="<?=$parent_affiliate->affiliate_id?>"  name="affiliateId" />
                    
                    <input type="submit" class="btn btn-lg btn-primary btn-block" name="signin" value="Login to 99sound.com" />
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
