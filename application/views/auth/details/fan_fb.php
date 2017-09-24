<style>
    .strike-heading span .error{
        color: red;
    }
    .editOption{
        position: absolute;
        top:0;
        width: 90%;
        border-right: none;
    }
</style>

<script>
$(document).ready(function(){
    var initialText = $('.editable').val();
    $('.editOption').val(initialText);
    $('#question').change(function(){
        var selected = $('option:selected', this).attr('class');
        var optionText = $('.editable').text();
        if(selected == "editable"){
          $('.editOption').show();
          $('.editOption').keyup(function(){
              var editText = $('.editOption').val();
              $('.editable').val(editText);
              $('.editable').html(editText);
          });
           $('.editOption').select();
        }else{
          $('.editOption').hide();
        }
    });    
}); 
</script>
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
                      Add Your Fan Details
                   </h3>
                   <form class="form form-signup" role="form" action="<?php echo base_url().'account/register/fb/st3'?>" method="post">
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                      <div class="form-group">
                         <div class="">
                            <input type="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email"  name="email" />
                         </div>
                         <?php echo form_error('email', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      <div class="strike-heading"><span>How did you hear about <strong>99Sound</strong>?</span></div>
                      <div class="form-group">
                         <div style="position: relative;">
                             <select id="question" class="form-control" name="question" >
                                <option >How did you hear about us?</option>
                                <option value="Artist">Artist</option>
                                <option value="Friend">Friend</option>
                                <option value="Advertisment">Advertisment</option>
                                <option class="editable" value="Other">Other</option>
                             </select>
                             <input class="editOption form-control" style="display:none;" placeholder="Text"/>
                         </div>
                      </div>
                      <div class="form-group">
                         <div class="">
                            <input type="text" class="form-control" value="<?php echo set_value('city'); ?>" placeholder="City"  name="city" />
                         </div>
                         <?php echo form_error('city', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		 </div>
                     <div class="form-group">
                           <input type="password" class="form-control" placeholder="Password"  name="pass" required="" />
                           <?php echo form_error('pass', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		 
                      </div>
                      <div class="form-group">
                           <input type="password" class="form-control" placeholder="Confirm password"  name="cpass" required="" />
                           <?php echo form_error('cpass', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		 
                      </div>
                      <div class="checkbox">
                        <label>
                            <input type="checkbox" required="" name="agreeCheckbox" id="agreeCheckbox"> You are agreeing to All The <a target="_blank" href="<?=base_url('footer/terms')?>">Terms and Conditions</a>,
                                <a target="_blank" href="<?=base_url('footer/copyright')?>">Copyright</a>,
                              <a target="_blank" href="<?=base_url('footer/privacy-policy')?>">Privacy Policy </a> and <a target="_blank" href="<?=base_url('footer/abuse-policy')?>">Abuse</a> Policies of 99Sound.com
                        </label>
                          <?php echo form_error('agreeCheckbox', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                     </div>
                      <input type="submit" class="btn btn-lg btn-primary btn-block" name="join" value="Create Account">
                   </form><br />
                   <div class="text-center"> <a style="color: red;" href="<?php echo base_url().'account/register/fb/st1'?>" ><strong><< Change Account Type</strong></a></div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>