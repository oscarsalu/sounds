<div class="alert_gloabal">
    <?php if ($this->session->flashdata('message_msg')) {
    ?>
    <div class="alert alert-big alert-success alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4><strong>Success!</strong></h4>
        <p> <?php echo $this->session->flashdata('message_msg')?></p>
    </div>
    <?php

}
    if ($this->session->flashdata('message_error')) {
        ?>
        <div class="alert alert-big alert-lightred alert-dismissable fade in">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4><strong>Error!</strong></h4>
            <p> <?php echo $this->session->flashdata('message_error')?></p>
        </div>
        <?php

    }
    ?>
<?php if ($this->session->flashdata('popup_subscript')) {
    ?>
<script >
var base_url = <?php echo base_url(); ?>;
</script>  
<script src="<?php echo base_url(); ?>assets/js/detail_pages/include/footer_2.js"></script> 
<?php

}
    ?>
</div>

<!--<div class="clearfix" id="simple" style="display: none;">
    <ul class="mSPages"></ul>
    <div class="frame">
        <ul class="slide_element">
        </ul>
    </div>
</div>
<div class="main_footer" style="position: relative;">
    <div class="ac-icon">
        <a class="click-ft" href="#" style="">
            <img class="chevron_up " src="<?php echo base_url(); ?>assets/icon/up-arrow.png" alt="Help" height="32" width="32">
            <img class="chevron_down hiden" src="<?php echo base_url(); ?>assets/icon/down-arrow.png" alt="Help" height="32" width="32">
        </a>
    </div>-->
    <!-- Start footer  -->
<footer id="FooterGrid">
<div class="container">
<div class="row">
	<div class="col-md-2 col-sm-4 col-xs-12">
    	<div class="FooterData">
        	<h2>Marketing</h2>
            <ul>
            	<li><a href="<?=base_url('features/fan')?>" target="_blank"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> SoundHouse PR</a></li>
                <li><a href="<?=base_url('features/artist')?>" target="_blank"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Artist Email Campaign</a></li>
                <li><a href="<?=base_url('features/fan')?>" target="_blank"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Connect With Fan (SM)</a></li>
            </ul>
        </div>
    </div>
    
   <div class="col-md-2 col-sm-4 col-xs-12">
    <div class="FooterData">
       	  <h2>Tools</h2>
            <ul>
            	<li><a href="<?=base_url('mds')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Sell Your Music</a></li>
                <li><a href="<?=base_url('make_money')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Mobile App</a></li>
                <li><a href="<?=base_url('gigs_events')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Gigs & Events</a></li>
            </ul>
        </div>
    </div>
    
    <div class="col-md-2 col-sm-4 col-xs-12">
    <div class="FooterData">
       	  <h2>Support</h2>
            <ul>
                <li><a href="https://soundhelp.zendesk.com/hc/en-us/categories/204090247-FAQ" target="_blank"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Frequently Asked Questions</a></li>
               
                <li><a href="<?=base_url('social_media')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Social Sync</a></li>
            <li><a href="<?=base_url('pdfs/Copyright Infringement Form.pdf')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Copyright Infringement Form</a></li>
            <li><a href="<?=base_url('pdfs/Abuse Form.pdf')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Abuse Form</a></li>
            <li><a href="<?=base_url('pdfs/Counter NotIfication Form.pdf')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Counter NotIfication Form</a></li>
            
            </ul>
        </div>
    </div>
    
    <div class="col-md-2 col-sm-4 col-xs-12">
    <div class="FooterData">
       	  <h2>Policies</h2>
            <ul>
            	<li><a href="<?=base_url('footer/terms')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Terms & Conditions</a></li>
                <li><a href="<?=base_url('footer/privacy-policy')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Privacy Policy</a></li>
                 <li><a href="<?=base_url('footer/abuse-policy')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Abuse Policy</a></li>
                <li><a href="<?=base_url('footer/copyright')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Copyright</a></li>
                <li><a href="<?=base_url('footer/refun')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Refund</a></li>
            </ul>
        </div>
    </div>
    
    <div class="col-md-2 col-sm-4 col-xs-12">
    <div class="FooterData">
       	  <h2>Sound.com</h2>
            <ul>
            	<li><a href="<?=base_url('footer/our_team')?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Our Team</a></li>
                <li><a href="mailto:contact@admin.com?Subject=Contact" target="_top"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Contact Us</a></li>
            </ul>
        </div>
    </div>
    
    <div class="col-md-2 col-sm-4 col-xs-12">
    	<div class="FooterFBox">
        	<h2>Newsletter SignUp</h2>
                <div class="message"></div>
                
          <div class="form-group">
              <input type="text" class="NewsLetterInput" id="name" name="name" placeholder="Name">
            </div>
            
            <div class="form-group">
           	  <input type="email" class="NewsLetterInput" id="email" name="email" placeholder="Email">
            </div>
            
            <div class="form-group">
                <input type="button" class="NewsLetterBout" id="subscribe" value="SUbmit">
            </div>
               
        </div><!-- FooterFBox  -->
    </div>
</div>
<!--  row  -->
</div>
<!--  container  -->
<div id="CopyRightGrid">
<div class="container">
<div class="row">
	<div class="col-md-6">
    <p>©2017 By OSKProgrammers INC. All Rights Reserved</p>
    </div>
    <div class="col-md-6">
    	<ul class="social-network social-circle">
            <li>    <a href="#" data-toggle="tooltip" data-placement="left" title="Linkedin" class="icon_social"><i class="fa fa-linkedin"></i></a></li>
            
            <li>   <a href="https://instagram.com/soundhousepromotions" data-toggle="tooltip" data-placement="left" title="Instagram" class="icon_social"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.youtube.com/channel/UCbx21T0l7_ttr26tZ9d2_Zw" data-toggle="tooltip" data-placement="left" title="Youtube" class="icon_social"><i class="fa fa-youtube"></i></a></li>
            <li>  <a href="https://plus.google.com/104993070863948605840" data-toggle="tooltip" data-placement="left" title="Google plus" class="icon_social"><i class="fa fa-google"></i></a></li>
           <li>  <a href="https://twitter.com/SoundHouseInc" data-toggle="tooltip" data-placement="left" title="Twitter" class="icon_social"><i class="fa fa-twitter"></i><!--<img src="<?php echo base_url() ?>assets/icon/tw.png" />--></a></li>
        <li>   <a href="https://www.facebook.com/sounds" data-toggle="tooltip" data-placement="left" title="Facebook" class="icon_social"><i class="fa fa-facebook"></i><!--<img src="<?php echo base_url() ?>assets/icon/fb.png" />--></a></li>
        </ul>
    </div>
</div>
</div>	
</div>
</footer>
<!-- End footer  -->

<script>
$(document).ready(function(){
    $(".ButCO").click(function(){
        $(".CommentForm").slideToggle();
    });
});
</script>
</div>



<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Start of sound Zendesk Widget script -->

<!-- End of sound Zendesk Widget script -->

<script src="<?php echo base_url(); ?>home/combined_homepage_js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.easing-1.3.pack.js"></script>
<?php 
    $url = $this->uri->segment(1);
    //text_editor
 
    if (isset($user_data)) {
        $check_role_text_editor = $this->M_user->check_role(1, $user_data['id']);
        if ($check_role_text_editor==true && ($url == null || $url == 'blogs' || $url == 'gigs_events' || $url == 'social_media' || $url == 'find-a-musician' || $url == 'the_total_tour' || $url == 'chat' || $url == 'artist' || $url == 'fancapture' || $url == 'top-100-list' || $url == 'find-a-musician' || $url == 'features' || $url == 'make_money' || $url == 'mds' || $url == 'artists' || $url == 'subscriptions'|| $url=='footer' || $url=='world_wide_featured') ) {
             
            ?>        
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>         
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/underscore-min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/backbone-min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/vie-min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/jquery.tagsinput.min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/jquery.rdfquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/annotate-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/rangy-core-1.2.3.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/hallo-min.js"></script>    
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/aloha/lib/require.js"></script>     
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/aloha/lib/aloha-full.min.js" data-aloha-plugins="common/ui,common/format,common/link,common/image,common/align,extra/sourceview,extra/textcolor,common/list,extra/cite" ></script>
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/create-min.js"></script>
        <script type="text/javascript">
        var BASE_URL = "<?php echo base_url(); ?>";           
        </script>
        <script src="<?php echo base_url(); ?>assets/js/createjs/js/contentblocks.js"></script> 
        <link href="<?php echo base_url(); ?>assets/js/createjs/js/aloha/css/aloha.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/js/createjs/css/create-ui/css/create-ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/js/createjs/css/midgard-notifications/midgardnotif.css" rel="stylesheet" type="text/css"/>
        
        
        <script src="<?php echo base_url(); ?>assets/js/detail_pages/include/footer.js"></script> 
    
    <?php 
        }
    }
    if ($url == null || $this->uri->segment(2) == 'fan') {
        ?>
        <!--script data-three-location="http://images.apple.com/v/music/b/scripts/three.js"></script-->
        <script data-three-location="<?php echo base_url(); ?>assets/js/three.js"></script>
        <!--
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.built.js"></script>
        <script src="<?php echo base_url(); ?>assets/homepage/externals.built.js" type="text/javascript" charset="utf-8"></script> 
        -->
<?php 
    }
    if (($url == 'artist' && $this->uri->segment(2) == 'profile')) {
        ?>
    <script src="<?php echo base_url(); ?>assets/crop-image/js/cropper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/crop-image/js/main.js"></script>  
    <script src="<?php echo base_url(); ?>assets/crop-image/js/main_.js"></script>
    <?php 
    }

?>
<script src="<?php echo base_url()?>assets/js/simple-slider.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function() {
                   
		  $('#subscribe').on('click', function () {
name=$("#name").val();
email=$("#email").val();
		        if (!valid_email_address($("#email").val()))
		        {
		            $(".message").html('<div class="alert alert-danger">Please make sure you enter a valid email address.</div>');
		        }
		        else
		        {
		            
		            $(".message").html("<div class='alert alert-success'>Almost done, please check your email address to confirmation.</div>");
		            $.ajax({
		                url:'<?php echo base_url('mailchimp/add_subscriber');?>', 
		                data: {
                                    "email":email,"name":name,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
                        },
		                type: 'POST',
		                success: function(msg) {
		                    if(msg=="success")
		                    {
                                           
		                        $("#email").val("");
		                        $(".message").html('<div class="alert alert-success">You have successfully subscribed to our mailing list.</div>');
		                     
		                    }
		                    else
		                    {
                                         
		                      $(".message").html('<div class="alert alert-danger">Please make sure you enter a valid email address.</div>');  
		                    }
		                }
		            });
		        }
		 
		        return false;
		    });
		});

		function valid_email_address(email)
		{
		    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
		    return pattern.test(email);
		}
                </script>
</body>
</html>