
<div class="" style="position: relative;">
    <div id="video-wrap">
        <video id="my-video" preload="metadata" autoplay="" loop muted>
            <source src="<?php echo base_url(); ?>assets/background-videos/bg_video_login.mp4" type="video/mp4">
        </video>
    </div>
    <div class="" style="position: absolute;z-index: 55;top: 0; width: 100%;padding-top:50px;min-height: 100vh;">
       <div class="row">
            <div class="description">
                <?php if($this->session->flashdata('message_msg')){
                ?>
                <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                     <?php echo $this->session->flashdata('message_msg')?>
                </div>
                <?php
                }elseif($this->session->flashdata('message_error')){
                    ?>
                    <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('message_error')?>
                    </div>
                    <?php
                }?>
            </div>
          <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 ">

             <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.19);background-color: rgba(8, 7, 7, 0.27);color: #fff;">
                <div class="panel-body">
                  
                   <h3 class="text-center">
                     Forgotten Password
                   </h3>
                   <form class="form form-signup" role="form" action="<?php echo base_url().'auth/forgot_pass'?>" method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="form-group">
                			<div class="input-group">
                				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                				</span>
                				<input type="email" class="form-control" placeholder="Email Address"  name="email"/>
                			</div>
                		</div>
                		<input type="submit" class="btn btn-lg btn-primary btn-block" name="signin" value="Send"/>
                   </form>
                </div>        
            </div>   
        </div>
     </div>
  </div>
</div>