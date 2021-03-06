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
<style type="text/css">
  a{
   color:#263ad5; 
  }

  a:hover, a:focus {
    color: #263ad5;
    text-decoration: underline;
}
</style>
<script>
$(document).ready(function(){
    // var initialText = $('.editable').val();
    // $('.editOption').val(initialText);
    // $('#question').change(function(){
    //     var selected = $('option:selected', this).attr('class');
    //     var optionText = $('.editable').text();
    //     if(selected == "editable"){
    //       $('.editOption').show();
    //       $('.editOption').keyup(function(){
    //           var editText = $('.editOption').val();
    //           $('.editable').val(editText);
    //           $('.editable').html(editText);
    //       });
    //        $('.editOption').select();
    //     }else{
    //       $('.editOption').hide();
    //     }
    // });
    $('#question').change(function(){
      selection = $(this).val();
            if (selection == 'Other') {
                $('#myModal').modal('show');
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
             <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.7);color: #fff;">
                <div class="panel-body">
                   <h3 class="text-center">
                      Add Your Fan Details
                   </h3>
                   <form class="form form-signup" role="form" action="<?php echo base_url().'auth/step3'?>" method="post">
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                      <div class="form-group">
                         <div class="">
                            <input type="text" class="form-control" placeholder="Fan Name" value="<?php echo set_value('fan_name'); ?>" name="fan_name" />
                            
                         </div>
                         <?php echo form_error('fan_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      <div class="form-group ">
                         <div class="row">
                            <label class="form-input col-md-3" >Gender </label>
                            </label><input type="radio" name="gender" value="male" class=" form-input" checked="" /> Male 
                            </label><input type="radio" name="gender" value="female" class="form-input" /> Female 
                         </div> 
                         <?php echo form_error('gender', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                      </div>
                      <div class="form-group">
                         <div class="">
                            <input type="text" class="form-control birth_date" placeholder="Birth Date" value="<?php echo set_value('birth_date'); ?>" name="birth_date" data-date-format="mm-dd-yyyy"/>
                            
                         </div>
                         <?php echo form_error('birth_date', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		  </div>
                      <div class="strike-heading"><span>How did you hear about <strong>Sound</strong>?</span></div>
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
                            <input type="text" class="form-control" placeholder="City" value="<?php echo set_value('city'); ?>" name="city" />
                         </div>
                         <?php echo form_error('city', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		 </div>
                     <div class="checkbox">
                        <label>
                            <input type="checkbox" required="" name="agreeCheckbox" id="agreeCheckbox"> You are agreeing to All The <a target="_blank" href="<?=base_url('footer/terms')?>" style="color:#fff; text-decoration:underline;">Terms and Conditions</a>,
                                <a target="_blank" href="<?=base_url('footer/copyright')?>" style="color:#fff;text-decoration:underline;">Copyright</a>,
                              <a target="_blank" href="<?=base_url('footer/privacy-policy')?>" style="color:#fff;text-decoration:underline;">Privacy Policy </a> and <a target="_blank" href="<?=base_url('footer/abuse-policy')?>" style="color:#fff;text-decoration:underline;">Abuse</a> Policies of Sound.com
                        </label>
                         <?php echo form_error('agreeCheckbox', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                     </div>
                      <input type="submit" class="btn btn-lg btn-primary btn-block" name="join" value="Create Account">
                   </form><br />
                   <div class="text-center"> <a style="color: red;" href="<?php echo base_url().'auth/step1'?>" ><strong><< Change Account Type</strong></a></div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.min.css"/>
<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css" /> -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function(){
    $('.birth_date').datepicker({
        orientation: 'bottom auto'
    })
     // $('.datepicker datepicker-dropdown dropdown-menu datepicker-orient-left datepicker-orient-topxa').css({
     //      top: 150
          
     //  });
      
});      
</script>
    <div class="modal fade" id="myModal" role="dialog" style="background-color: rgba(8, 7, 7, 0.27);">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <label>Other</label>

        </div>
        <div class="modal-body">
          <input type="text" name="question" >
        </div>
       
      </div>
    </div>
    </div>