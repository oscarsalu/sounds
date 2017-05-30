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
    appId      : '<?=$this->config->item('facebook_app_id')?>',
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
           window.location.replace("<?=base_url('account/login/fb/st1')?>");
    });  
    });
  }
</script>
<script >
$(document).ready(function(){
    if(localStorage.getItem("counter") == null || localStorage.getItem("counter") == 0){
        localStorage.setItem("counter", 0);
    }
}); 

</script>
<div class="" style="position: relative;">
    <div id="video-wrap" class="video-wrap_login">
        <video id="my-video" preload="metadata" autoplay="" loop muted>
            <source src="<?php echo base_url(); ?>assets/background-videos/bg_video_login.mp4" type="video/mp4">
        </video>
    </div>
    <div class="" style="position: absolute;z-index: 55;top: 0; width: 100%;padding-top:50px;min-height: 100vh;">

    <!-- Div show sucess or error flash messsage-->
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

       <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 ">
             <div class="panel panel-default signup-form" style=" border-color: rgba(36, 33, 33, 0.29);background-color: rgba(8, 7, 7, 0.27);color: #fff;">
                <div class="panel-body">
                   <h3 class="text-center">
                      Login
                   </h3>
                <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="true" data-auto-logout-link="false"></div>
                <a class="btn" href="<?=$authUrl?>"><img src="<?php  echo base_url();?>/assets/icon/imgpsh_fullsize.png" style="max-width: 120px;max-height: 53px;margin-left: -10px;"></a>


                    <div id="status">
                    </div>
                <form class="form form-signup" role="form" action="<?php echo base_url().'auth/login'?>" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <?php 
                        if (isset($login_false)) {
                            ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Error!</strong> <?php echo $login_false ?>
                            </div>
                            <?php

                        }

                    ?>
                        <div class="strike-heading"><span>Login with your email address</span></div>
            		<div class="form-group">
            			<div class="input-group">
            				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
            				</span>
            				<input type="text" class="form-control" placeholder="Email Address"  name="email"/>
            			</div><?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
            		</div>
            		<div class="form-group">
            			<div class="input-group">
            				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            				<input type="password" class="form-control" placeholder="Password" name="password" />
            			</div><?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
            		</div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox"/> Remember Me
                    </label>
                    </div>
                    
                    <!-- <div class="form-group" id="cap">
                        <label>Please enter the letters displayed:</label>
                        <div class="input-group">
                           
                            <input type="text" class="form-control"  id="defaultReal" name="defaultReal">
                            <p style="clear: both;"><label>&nbsp;</label>
                        </div>
                    </div> -->
                    
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
                                
                                
                      <div class="form-group" id="show_captcha" style="display: none">
                        <div id="captchaimage">
                            <span id="captImg">
                           <?php echo $captchaImg; ?>
                            </span>
                            <a href="javascript:void(0);" class="refreshCaptcha" title="refresh captcha" ><i class="fa fa-refresh" style="font-size:20px;"></i></a>
                        </div>
                           
                           
                            <input type="text" maxlength="6" name="captcha" id="captcha" autocomplete=off class="form-control" placeholder="Enter above code" />                                               
                           
                            <!-- <div align=center valign=top style="font-size: 10px;color: #dadada;" id="dumdiv">
                            <a href="//www.hscripts.com" id="dum" style="font-size: 10px;color: #dadada;text-decoration:none;color: #dadada;">&copy;h</a>
                             </div> -->
                     </div>
                      <!-- gaurav end -->
                    <p class="text-center"><a class="color_forgot" href="<?php echo base_url()?>account/forgotten_password"> Forgot Password?</a></p>
                    
            		<input type="submit" id="signin" val="1" class="btn btn-lg btn-primary btn-block" name="signin" value="Login to 99sound.com" />
                <input type="submit" id="signin_captcha" val="1" class="btn btn-lg btn-primary btn-block" name="signin" value="Login to sound.com" style="display: none" />
                    <!--<a class="btn btn-lg btn-default btn-block" href="<?php echo base_url().'account/signup'?>">Join 99sound.com</a>-->
                </form>
                
                </div>        
            </div>            
    	  
        </div>
     </div>
  </div>
</div><script type="text/javascript">
  
  $("#refreshimg").on('click',function(){

    $.post('includes/newsession.php');
    $("#captchaimage").load('includes/image_req.php?'+ new Date().getTime());
    return false;
                
  });
  $(document).ready(function(){
      if(localStorage.getItem("counter") == null || localStorage.getItem("counter") == 0)
        {       
          localStorage.setItem("counter", 0);  
        } 
        if(localStorage.getItem("counter")>=0)
        {            
          $("#show_captcha").show(); 
          $("#signin_captcha").show();
          $("#signin").hide()
        }
        else
        {            
          $("#show_captcha").hide();        
        }
        

        
      });
  $(document).on('click',"#signin",function(){
    var count = localStorage.getItem("counter");
    var val =  parseInt(count) + 1;        
    localStorage.setItem("counter", val);
    
  });
  /*$(document).on('submit',".form_singup",function(e){
            e.preventDefault();
            
            if($("#captcha").val()=="")
            {
              $('form').submit();
            }
            else
            {
              alert('captcha not match');
            }
          }); */
    
    $(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            $.get('<?php echo base_url().'auth/refresh_captcha'; ?>', function(data){
                $('#captImg').html(data);
          });
        });
    });
    
</script>