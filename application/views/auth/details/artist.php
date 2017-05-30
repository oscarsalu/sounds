<style type="text/css">
  a{
   color:#263ad5; 
  }

  a:hover, a:focus {
    color: #263ad5;
    text-decoration: underline;
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
          <div class="col-md-10 col-md-offset-1">
            <div class="form-sigup col-md-6">
                <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.27);color: #fff;">
                    <div class="panel-body">
                       <h3 class="text-center">
                          Add Your Artist Details
                       </h3>
                       <form class="form form-signup" role="form" action="<?php echo base_url().'auth/step3'?>" method="post">
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                          <div class="form-group">
                             <div class="">
                                <input type="text" class="form-control" placeholder="Artist Or Band Name" value="<?php echo set_value('artist_name'); ?>" name="artist_name" />
                                
                             </div>
                             <?php echo form_error('artist_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		  </div>
                          <div class="form-group">
                             <div class="">
                                 <select class="form-control" name="genre" >
                                    <option value="">Genre</option>
                                    <?php 
                                    foreach ($genres as $key) {
                                        ($key['id'] == set_value(genre)) ? $select = 'selected' : $select = ''; ?><option <?=$select?> value="<?php echo $key['id'] ?>"><?php echo $key['name']?></option><?php 
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('genre', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		
                             </div>
                          </div>
                          <div class="form-group">
                             <div class="">
                                 <a class="btn btn-default" href="#" data-toggle="modal" data-target="#chose-tpl" style="width: 100%;" >Choose Template Background</a>   
                                 <input type="hidden" name="template_landing" id="template_landing" value="<?php echo $landings[0]['position']; ?>" />
                            </div>
                          </div>
                          <div class="form-group">
                               <input type="text" class="form-control" placeholder="City" value="<?php echo set_value('city'); ?>"  name="city" />
                               <?php echo form_error('city', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		 
                          </div>
                          <div class="form-group">
                               <input type="text" class="form-control" placeholder="Name" value="<?php echo set_value('name'); ?>" name="name" />
                               <?php echo form_error('name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		 
                          </div>
                          <div class="form-group">
                               <input type="text" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>"  name="last_name" />
                               <?php echo form_error('last_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		 
                          </div>
                          <div class="form-group">
                               <input type="text" class="form-control birth_date" placeholder="Birth Date" value="<?php echo set_value('birth_date'); ?>"  name="birth_date" data-date-format="mm-dd-yyyy"/>
                               <?php echo form_error('birth_date', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		 
                          </div>
                          
                          <div class="checkbox">
                            <label>
                                <input type="checkbox" required="" name="agreeCheckbox" id="agreeCheckbox"> I agree to All The <a target="_blank" href="<?=base_url('footer/terms')?>">Terms and Conditions</a>,
                                <a target="_blank" href="<?=base_url('footer/copyright')?>">Copyright</a>,
                              <a target="_blank" href="<?=base_url('footer/privacy-policy')?>">Privacy Policy </a> and <a target="_blank" href="<?=base_url('footer/abuse-policy')?>">Abuse</a> Policies of 99Sound.com
                            </label>
                            <?php echo form_error('agreeCheckbox', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                         </div>
                          <input type="submit" class="btn btn-lg btn-primary btn-block" name="join" value="Create Account">
                       </form><br />
                       <div class="text-center" > <a style="color: red;" href="<?php echo base_url().'auth/step1'?>" >
                       <strong><< Change Account Type</strong></a></div>
                    </div>
                 </div>    
            </div>
            <div class="prev-tpl col-md-6 hidden-sm hidden-xs" >
                <div class="panel panel-default" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.27);color: #fff;">
                    <div class="panel-header text-center"><h3>Template Preview</h3> </div>
                    <div class="preview_wapper_template">
                        <img id="preview-template" src="<?php echo base_url()?>uploads/templates/landing/<?php echo $landings[0]['images'] ?>" width="100%" style="padding: 5px;" />
                    </div>
                </div>
            </div> 
          </div>
       </div>
    </div>
    <!-- Modal choose -->
    <div class="modal fade new_modal_style" id="chose-tpl" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Choose Template Background</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <?php foreach ($landings as $landing) {
    ?>
                        <div class="type-landing col-md-6">
                            <div class="frame-ld center" >
                                <div class="text-center"><?php echo $landing['name']; ?></div>
                                <a href="#" >
                                    <input type="hidden" class="get_position" value="<?php echo $landing['position']; ?>" />
                                    <img class="secelted_img" title="<?php echo $landing['name']; ?>" id="img-<?php echo $landing['position']; ?>" height="100" width="100" src="<?php echo base_url()?>uploads/templates/landing/<?php echo $landing['images'] ?>"/>
                                </a>
                            </div>
                            <div class="action">
                                <a href="#" class="btn myButton btn-xs btn-preview1" data-toggle="modal" data-target="#preview">PreView</a>
                            </div>
                        </div>
                    <?php 
} ?>
                </div>
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>          
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.birth_date').datepicker();
	$(document).ready(function() {
	    $('#chose-tpl').on('click','.btn-preview1', function (){
	       var src = $(this).parent().parent().find('.secelted_img').attr("src");
            $("#pre-img").attr("src",src);
            $("#preview-template").attr("src",src);
	    });
        
        $('#chose-tpl').on('click','a .secelted_img', function (){
            var src = $(this).attr("src");
            var position = $(this).parent().find('.get_position').val();
            $(".secelted_img").each(function(){
                $(this).removeClass("secelted");
            });
            $(this).addClass("secelted");
	        $("#preview-template").attr("src",src);
            $( "#template_landing" ).val(position);
	    });
        
        
        /*
        $('#chose-tpl').on('click','.frame-ld a #img-1', function (){
            $(".prev-tpl .panel-header h3").html($(this).parent().parent().find(".caption").html());
	        $( "#img-1" ).addClass("secelted");
            $( "#img-2" ).removeClass("secelted");
            $( "#img-3" ).removeClass("secelted");
            $( "#img-4" ).removeClass("secelted");
            $( "#img-5" ).removeClass("secelted");
            $( "#img-6" ).removeClass("secelted");
            $( "#template_landing" ).val(1);
            var src = ($("#chose-tpl #img-1").attr("src"));
            $("#preview-template").attr("src",src);
        });
        $('#chose-tpl').on('click','.frame-ld a #img-2', function (){
            $(".prev-tpl .panel-header h3").html($(this).parent().parent().find(".caption").html());
	        $( "#img-2" ).addClass("secelted");
            $( "#img-1" ).removeClass("secelted");
            $( "#img-3" ).removeClass("secelted");
            $( "#img-4" ).removeClass("secelted");
            $( "#img-5" ).removeClass("secelted");
            $( "#img-6" ).removeClass("secelted");
            $( "#template_landing" ).val(2);
            var src = ($("#chose-tpl #img-2").attr("src"));
            $("#preview-template").attr("src",src);
        });
        $('#chose-tpl').on('click','.frame-ld a #img-3', function (){
            $(".prev-tpl .panel-header h3").html($(this).parent().parent().find(".caption").html());
	        $( "#img-3" ).addClass("secelted");
            $( "#img-1" ).removeClass("secelted");
            $( "#img-2" ).removeClass("secelted");
            $( "#img-4" ).removeClass("secelted");
            $( "#img-5" ).removeClass("secelted");
             $( "#img-6" ).removeClass("secelted");
            $( "#template_landing" ).val(3);
            var src = ($("#chose-tpl #img-3").attr("src"));
            $("#preview-template").attr("src",src);
        });
        $('#chose-tpl').on('click','.frame-ld a #img-4', function (){
            $(".prev-tpl .panel-header h3").html($(this).parent().parent().find(".caption").html());
	        $( "#img-4" ).addClass("secelted");
            $( "#img-1" ).removeClass("secelted");
            $( "#img-3" ).removeClass("secelted");
            $( "#img-2" ).removeClass("secelted");
            $( "#img-5" ).removeClass("secelted");
            $( "#img-6" ).removeClass("secelted");
            $( "#template_landing" ).val(4);
            var src = ($("#chose-tpl #img-4").attr("src"));
            $("#preview-template").attr("src",src);
        });
        $('#chose-tpl').on('click','.frame-ld a #img-5', function (){
            $(".prev-tpl .panel-header h3").html($(this).parent().parent().find(".caption").html());
	        $( "#img-5" ).addClass("secelted");
            $( "#img-4" ).removeClass("secelted");
            $( "#img-1" ).removeClass("secelted");
            $( "#img-3" ).removeClass("secelted");
            $( "#img-2" ).removeClass("secelted");
            $( "#img-6" ).removeClass("secelted");
            $( "#template_landing" ).val(5);
            var src = ($("#chose-tpl #img-5").attr("src"));
            $("#preview-template").attr("src",src);
        });
        $('#chose-tpl').on('click','.frame-ld a #img-6', function (){
            $(".prev-tpl .panel-header h3").html($(this).parent().parent().find(".caption").html());
	        $( "#img-6" ).addClass("secelted");
            $( "#img-5" ).removeClass("secelted");
            $( "#img-4" ).removeClass("secelted");
            $( "#img-1" ).removeClass("secelted");
            $( "#img-3" ).removeClass("secelted");
            $( "#img-2" ).removeClass("secelted");
            $( "#template_landing" ).val(6);
            var src = ($("#chose-tpl #img-6").attr("src"));
            $("#preview-template").attr("src",src);
        });
        $('#chose-tpl').on('click','.btn-preview2', function (){
	        var src = ($("#chose-tpl #img-2").attr("src"));
            $("#pre-img").attr("src",src);$("#preview-template").attr("src",src);
	    });
        $('#chose-tpl').on('click','.btn-preview3', function (){
	        var src = ($("#chose-tpl #img-3").attr("src"));
            $("#pre-img").attr("src",src);$("#preview-template").attr("src",src);
	    });
        $('#chose-tpl').on('click','.btn-preview4', function (){
	        var src = ($("#chose-tpl #img-4").attr("src"));
            $("#pre-img").attr("src",src);$("#preview-template").attr("src",src);
	    });
        $('#chose-tpl').on('click','.btn-preview5', function (){
	        var src = ($("#chose-tpl #img-5").attr("src"));
            $("#pre-img").attr("src",src);$("#preview-template").attr("src",src);
	    });
        $('#chose-tpl').on('click','.btn-preview6', function (){
	        var src = ($("#chose-tpl #img-6").attr("src"));
            $("#pre-img").attr("src",src);$("#preview-template").attr("src",src);
	    });*/
	}) 
</script>

<!-- Modal preview -->
<div class="modal fade new_modal_style" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Preview Template Background</h4>
                <span class="liner"></span>
            </div>            
            <div class="modal-body">
                <img id="pre-img" src="" width="100%" />
            </div>    
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>          
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    (function($){
        $(window).load(function(){
            $("#chose-tpl .modal-body").mCustomScrollbar();
            $("#preview .modal-body").mCustomScrollbar();
            $(".preview_wapper_template").mCustomScrollbar();
        });
    })(jQuery);
</script>