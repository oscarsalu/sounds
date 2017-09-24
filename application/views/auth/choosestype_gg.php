
<div class="" style="position: relative;">
    <div id="video-wrap">
        <video id="my-video" preload="metadata" autoplay="" loop muted>
            <source src="<?php echo base_url(); ?>assets/background-videos/bg_video_login.mp4" type="video/mp4">
        </video>
    </div>
    <div class="" style="position: absolute;z-index: 55;top: 0; width: 100%;padding-top:50px;">
       <div class="row">
          <div class="col-md-4 col-md-offset-4">
             <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.27);color: #fff;">
                <div class="panel-body">
                   <h3 class="text-center">
                        Choose Your Account Type
                   </h3>
                   <form id="formrole" class="form form-signup" role="form" action="<?php echo base_url().'account/register/gg/st2'?>" method="post">
                         <input type="hidden" id="role" name="role" />
                         <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                   </form>
                         <a class="btn btn-block "> <button onclick="artis()" id="artis" class="btn btn-default" style=" width: 100%;"> Artist ($<?=$this->M_setting->get_setting_99sound('artist_basic_fee')?>/month)</button></a>
                         <a class="btn btn-block "> <button onclick="fan()" id="fan" class="btn btn-default" style=" width: 100%;"> Fan (Free)</button></a>
                         <!-- TODO:   <a class="btn btn-block "> <button onclick="lable()" id="lable" class="btn btn-default" style=" width: 100%;"> Lable</button></a>
                         <a class="btn btn-block "> <button onclick="mannagement()" id="mannagement" class="btn btn-default" style=" width: 100%;"> Management</button></a>
                     --><div class="text-center"> <a href="<?php echo base_url().'account/signup'?>" ><< Edit Login Information</a></div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<script>
function artis(){
    $('#role').val('1');
    $('#formrole').submit();
}
function fan(){
    $('#role').val('2');
    $('#formrole').submit();
}
</script>