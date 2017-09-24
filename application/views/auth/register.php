<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : <?=$this->config->item('facebook_app_id')?>,
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    FB.api('/me', function(response) {
    $.post('<?=base_url('account/check_login/fb')?>',
        {
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
            'email': response.email,
            'fb_ID': response.id,
            'first_name': response.first_name,
            'last_name': response.last_name,
            'gender': response.gender
        } ,
        function(data){
           window.location.replace("<?=base_url('account/register/fb/st1')?>");
    });  
    });
  }
</script>
<style type="text/css">
  a{
   color:#263ad5; 
  }

  a:hover, a:focus {
    color: #263ad5;
    text-decoration: underline;
}
.alert_gloabal{
    display:none;
}
</style>
<div class="" style="position: relative;">
    <div id="video-wrap" class="video-wrap_login">
        <video id="my-video" preload="metadata" autoplay="" loop muted>
            <source src="<?php echo base_url(); ?>assets/background-videos/bg_video_login.mp4" type="video/mp4">
        </video>
    </div>
    <div class="" style="position: absolute;z-index: 55;top: 0; width: 100%;padding-top:50px;min-height: 100vh;">
    <div class="description">
                <?php if($this->session->flashdata('message_msg')){
                ?>
                <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                     <?php echo $this->session->flashdata('message_msg')?>
                      <br>
                      <!-- data-toggle="modal" data-target="#resend-email" -->
                     <a href="" id="resendemail" emailaddress="<?php echo $this->session->tempdata('email');?>"><i class="fa fa-envelope-o"></i> Resend Email >></a>
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
       <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
             <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.29);background-color: rgba(8, 7, 7, 0.7);color: #fff;" >
                <div class="panel-body">
                   <h3 class="text-center">
                      Join sound.com
                   </h3>
                   <form class="form form-signup" role="form" action="<?php echo base_url().'auth/step1'?>" method="post"  autocomplete="off">
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                      <div class="form-group">
                         <a class="btn btn-block btn-social btn-facebook" href="#"  onclick="checkLoginState()">
                         <i class="fa fa-facebook"></i> Login with Facebook
                         </a>
                      </div>
                      <div class="form-group">
                         <a class="btn btn-block btn-social btn-google" href="<?=$authUrl?>">
                         <i class="fa fa-google"></i> Login with Google
                         </a>
                      </div>
                      <div class="text-center">
                        By clicking and signing up using one of the listed social authentication providers, you are agreeing to sound.com 
                        <br /><a target="_blank" href="<?=base_url('footer/terms')?>" style="color:#fff;text-decoration:underline;"> Terms and Conditions</a>
                         and <a target="_blank" href="<?=base_url('footer/privacy-policy')?>" style="color:#fff;text-decoration:underline;">Privacy Policy </a>
                      </div>
                      <div class="strike-heading"><span>Join with your email address</span></div>
                      <div class="hidden">
                        <input type="password"/>
                      </div>
                      
                      <div class="form-group">
                         <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input type="email" class="form-control" placeholder="Email Address"  name="email" value="<?php  echo empty($tmp_email) ? set_value('email') : $tmp_email?>"/>
                         </div>
                         <?php echo form_error('email', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                      </div>
                      <div class="form-group">
                         <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo empty($tmp_password) ? '' : $tmp_password?>"/>
                         </div>
                         <?php echo form_error('password', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                      </div>
                      <input type="submit" class="btn btn-lg btn-primary btn-block" name="join" value="Join sound.com" />
                      
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- Modal preview ChangeLayout -->

<script>
//Code to resend mail
  var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
  var link = "<?php echo base_url();?>";
  $(document).on('click',"#resendemail",function(e){
      var uri = link+'account/resend_verification_mail';
      var dataPass = {
                'email': $(this).attr('emailaddress'),
                'csrf_test_name':get_csrf_hash  
            };
        $.ajax({
            type: "POST",
            url: uri,
            data: dataPass,
            dataType: "JSON",
            success: function(response) {
            }
        });    
    });
  
</script>
</div>


