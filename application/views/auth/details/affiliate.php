<style>
    .strike-heading span .error{
        color: red;
    }
</style>
<div class="" style="position: relative;">
    <div id="video-wrap">
        <video id="my-video" preload="metadata" autoplay="" loop muted>
            <source src="<?php echo base_url(); ?>assets/background-videos/bg_video_login.mp4" type="video/mp4">
        </video>
    </div>
   <div class="" style="position: absolute;z-index: 55;top: 0; width: 100%;padding-top:50px;min-height: 100vh;">
   <div class="row">
      <div class="col-md-4 col-md-offset-4">
         <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.27);color: #fff;">
            <div class="panel-body">
               <h3 class="text-center">
                  Add Your Affiliate Details
               </h3>
               <form class="form form-signup" role="form" action="<?php echo base_url().'auth/step3'?>" method="post">
                  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                  <div class="form-group">
                     <div class="">
                        <input type="email"  value="<?php echo set_value('paypal'); ?>" class="form-control" placeholder="Email Paypal *"  name="paypal" />
                     </div>
                     <?php echo form_error('paypal', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		  </div>
                  <div class="form-group">
                     <div class="">
                        <input type="text" value="<?php echo set_value('firstname'); ?>" class="form-control" placeholder="First Name"  name="firstname" />
                     </div>
                     <?php echo form_error('firstname', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		  </div>
                  <div class="form-group">
                     <div class="">
                        <input type="text" value="<?php echo set_value('lastname'); ?>" class="form-control" placeholder="Last Name"  name="lastname" />
                        <?php echo form_error('lastname', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		     </div>
                  </div>
                  <div class="form-group">
                     <div class="">
                        <input type="text" value="<?php echo set_value('city'); ?>" class="form-control" placeholder="City "  name="city" />
                     </div>
                     <?php echo form_error('city', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		 </div>
                 <div class="checkbox">
                    <label>
                        <input type="checkbox" required=""> You are agreeing to 99sound.com <a target="_blank" href="<?=base_url('footer/terms')?>">Terms and Conditions</a>
                     and <a target="_blank" href="<?=base_url('footer/privacy-policy')?>">Privacy Policy </a>
                    </label>
                 </div>
                  <input type="submit" class="btn btn-lg btn-primary btn-block" name="join" value="Create Account">
               </form><br />
               <div class="text-center"> <a style="color: red;" href="<?php echo base_url().'auth/step1'?>" ><strong><< Change Account Type</strong></a></div>
            </div>
         </div>
      </div>
   </div>
</div>