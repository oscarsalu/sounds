     <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?=base_url('assets/js/ckeditor/ckeditor.js')?>"></script>

	<!--css added by sunil-->
	<style>
	 
 .row {
    margin-right:0px!important;
 }
.no-pad {
    padding-right: 0;
    padding-left: 0;
    padding-bottom: 0;
 }
 
 .control {
	font-size: 18px;
	position: relative;
	display: block;
	margin-bottom: 15px;
	/*padding-left: 30px;*/
 	cursor: pointer;
}

.control input {
	position: absolute;
	z-index: -1;
	opacity: 0;
}
.control__indicator {
	position: absolute;
	top: 2px;
	left: 0;
	width: 20px;
	height: 20px;
	background: red;
	border-radius:5px;
}

 

/* Checked state */
.control input:checked ~ .control__indicator {
	background:red;
}

/* Hover state whilst checked */
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
	background:red;

}

/* Disabled state */
.control input:disabled ~ .control__indicator {
	pointer-events: none;
	opacity: .6;
	background:red;
}

/* Check mark */
.control__indicator:after {
	position: absolute;
	display: none;
	content: '';
}

/* Show check mark */
.control input:checked ~ .control__indicator:after {
	display: block;
}

/* Checkbox tick */
.control--checkbox .control__indicator:after {
	top: 4px;
	left: 8px;
	width: 3px;
	height: 8px;
	transform: rotate(45deg);
	border: solid #fff;
	border-width: 0 2px 2px 0;
}

/* Disabled tick colour */
.control--checkbox input:disabled ~ .control__indicator:after {
	border-color: #7b7b7b;
}

.vertical_line
{
  border-right:1px solid gray;
 }
 
 /*button css*/
 
 
#pagegradient {
       		 color:#FFFFFF;

 /* background-image:
        -webkit-gradient(
            radial, 
            50% -50, 
            300, 
            50% 0, 
            0, 
            from(rgba(230, 237, 241, 0)), 
            to(rgba(230, 237, 241, 0.8)));*/
    
  height:100%;
  left:0px;
  position:absolute;
  top:0;
}

.button {
    color:#FFFFFF;
    position: absolute;
    top:100px;
    left:67px;
    display: inline-block;
    margin: 0 auto;
    
    -webkit-border-radius: 10px;
    
    -webkit-box-shadow: 
        0px 3px rgba(128,128,128,1), /* gradient effects */
        0px 4px rgba(118,118,118,1),
        0px 5px rgba(108,108,108,1),
        0px 6px rgba(98,98,98,1),
        0px 7px rgba(88,88,88,1),
        0px 8px rgba(78,78,78,1),
        0px 14px 6px -1px rgba(128,128,128,1); /* shadow */
    
    -webkit-transition: -webkit-box-shadow .1s ease-in-out;
} 

.button span {
    background-color: #EF1C1C;
          		 color:#FFFFFF;
 

    
    -webkit-background-size: 100%, 100%, 100%, 4px 4px;
    
    -webkit-border-radius: 10px;
    -webkit-transition: -webkit-transform .1s ease-in-out;
    
    display: inline-block;
    padding: 10px 40px 10px 40px;
    
    color:white;
    text-transform: uppercase;
    font-family: 'TradeGothicLTStd-BdCn20','PT Sans Narrow';
    font-weight: 700;
    font-size: 18px;
    
 }

        .button span:hover {
       		 color:#FFFFFF;
            text-shadow: 0px -1px #97A63A;
            cursor: pointer;
        }

        .button:active {
            -webkit-box-shadow: 
                0px 3px rgba(128,128,128,1),
                0px 4px rgba(118,118,118,1),
                0px 5px rgba(108,108,108,1),
                0px 6px rgba(98,98,98,1),
                0px 7px rgba(88,88,88,1),
                0px 8px rgba(78,78,78,1),
                0px 10px 2px 0px rgba(128,128,128,.6); /* shadow */
        }

        .button:active span{
            -webkit-transform: translate(0, 5px); /* depth of button press */
        }

    .button span:after {
        content: ">";
        display: block;
        width: 10px;
        height: 10px;
    
        position: absolute;
        right: 14px;
        top:13px;    
        
        font-family: 'Cabin';
        font-weight: 700;
        color:#FFFFFF;
        text-shadow: 0px 1px #fff, 0px -1px #97A63A;
        font-size: 12px;
		       		 color:#FFFFFF;

    }
	
	.mystyle
	{
	color: #fff;background:red; padding:5px; text-align:center;text-shadow: 0px 1px 1px #000;
	width:300px;
	}
 hr {
  display: block;
   position: relative;
   padding: 0;
   margin: 8px auto;
   height: 0;
   width: 80%;
   max-height: 0;
   font-size: 1px;
   line-height: 0;
   clear: both;
   border: none;
   border-top: 1px solid #aaaaaa;
   border-bottom: 1px solid #ffffff;
}

.btnhi
{
 height:180px;
}
@media only screen and (max-width :720px) {
/* Styles */
 .btnhi{ 
  height:180px!important;
  }
  
  
}
 .sbtn{

background:#EF1C1C;padding-top:0px; padding-bottom:0px; padding-left:0px;
}
.sbtn span
{
color:#FFFFFF;
}
.sbtn span span
{
color:#FFFFFF;
}

.titleCls {
    font-size: 11px;
    margin-bottom: 12px;
}
#img1 {
	display: inline-block;
	margin: 0 auto;
	width: 150px;
	height: 150px;
	position: relative;
	background-color: #eee;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
}
#img1 img {
	outline: medium none;
	vertical-align: middle;
	width: 100%;
}
#imgChange1 {
	background: url("<?php echo base_url();?>assets/images/overlay.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
	bottom: 0;
	color: #FFFFFF;
	display: block;
	height: 30px;
	left: 0;
	line-height: 32px;
	position: absolute;
	text-align: center;
	width: 100%;
}
#imgChange1 input[type="file"] {
	bottom: 0;
	cursor: pointer;
	height: 100%;
	left: 0;
	margin: 0;
	opacity: 0;
	padding: 0;
	position: absolute;
	width: 100%;
	z-index: 0;
}
/* Progressbar */
.progressBar {
	background: none repeat scroll 0 0 #E0E0E0;
	left: 0;
	padding: 3px 0;
	position: absolute;
	top: 50%;
	width: 100%;
	display: none;
}
.progressBar .bar {
	background-color: #FF6C67;
	width: 0%;
	height: 14px;
}
.progressBar .percent {
	display: inline-block;
	left: 0;
	position: absolute;
	text-align: center;
	top: 2px;
	width: 100%;
}
.progressBar1 {
	background: none repeat scroll 0 0 #E0E0E0;
	left: 0;
	padding: 3px 0;
	position: absolute;
	top: 50%;
	width: 100%;
	display: none;
}
.progressBar1 .bar1 {
	background-color: #FF6C67;
	width: 0%;
	height: 14px;
}
.progressBar1 .percent1 {
	display: inline-block;
	left: 0;
	position: absolute;
	text-align: center;
	top: 2px;
	width: 100%;
}

	</style>
	<script>
	$(document).ready(function() {
    var $btnSets = $('#responsive'),
    $btnLinks = $btnSets.find('a');
 
    $btnLinks.click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.user-menu>div.user-menu-content").removeClass("active");
        $("div.user-menu>div.user-menu-content").eq(index).addClass("active");
    });
});

$( document ).ready(function() {
    $("[rel='tooltip']").tooltip();    
 
    $('.view').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
});
	</script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <div id="presskit">
        <div class="container">
            <h1 class="oswaldregularh3" style="color:#000000;">ELECTRONIC PRESS KITS </h1>
            <div class="bottomheader wow zoomIn" data-wow-delay="0.5s"></div>
            <div class="user" style="margin: 20px 0;">
                <div class="row">
				<!--our code profile_design-->
					<div class="container">
    <div class="row user-menu-container square">
        <div class="col-md-6 user-details">
            <div class="row coralbg white">
                <div class="col-md-8 no-pad">
                    <div class="user-pad" style="padding-bottom:6px;">
                    <h4 class="tt" about="/content_homes1_tittle_new3_11/">
                                    <span property= "content" id= "content_homes1_tittle_new3_11">
                                        <?php
                                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'Info'); 
                                        ?>
                                    </span> 
                            </h4>
										
										
						<center>				
                        <h3 class="white" style="font-size:24px; margin-top:10px;">&nbsp;&nbsp;<?php echo $user_data['artist_name']?></h3>
                        <h4 class="white" style="font-size:24px; padding-bottom:16px;"> <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo $user_data['city']?></h4> </center>
					 
              <div class="row share text-center wow "  data-wow-delay="1s" style="margin:0px;">
			  
			  
                                <div class="col-md-6">
                               
							    
							 <button class="btn btn-labeled"  data-toggle="modal" data-target="#sendmail" style="background:rgba(0, 0, 0, 0.9); color:#FFFFFF; padding:0px;"> <span class="btn-label"><i class="fa fa-bell-o"></i></span><a  href="#" class="btn wow fadeInUp animated"  data-wow-delay="1s"><span style="color:#FFFFFF;">Send Your EPK</span></a></button>	 
                                  </div>
								
								
								
								
                                <div class="col-md-6">
                                 
								     <button class="btn btn-labeled"  data-toggle="modal" data-target="#share" style="background:rgba(0, 0, 0, 0.9); padding:0px;"> <span class="btn-label"><i class="fa fa-bell-o"></i></span><a  href="#" class="btn wow "  data-wow-delay="1s"><span style="color:#FFFFFF;">Share EPK</span></a></button>  
								   
                                </div>
                            </div>      
					
					
					</div>
                </div>
                <div class="col-md-4 no-pad">
                    <div class="user-image" >
                        <!--<img src="https://farm7.staticflickr.com/6163/6195546981_200e87ddaf_b.jpg" class="img-responsive thumbnail">--><img class="img-responsive" src="<?php echo $this->M_user->get_avata($user_data['id'])?>"/>
                    </div>

                </div>
            </div>
            <div class="row overview">
                <div class="recipients"><!--mydiv open-->
                    <h4 class="tt" about="/content_homes1_tittle_new3_11/"  style="margin-left:25px;">
                        <span property= "content" id= "content_homes1_tittle_new3_11">
                            <?php echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'RECIPIENT\'S');
                                                                    ?>
                        </span>   
                    </h4>
                </div>
  <!--mydiv close-->
                <div class="col-md-4 user-pad text-center">
				
				   <h3>Send Mail</h3>
                    <h4 ><?php if (empty($view_tats['send_email'])) {
    echo '0';} else {echo $view_tats['send_email'];} ?></h4>
                </div>
                <div class="col-md-4 user-pad text-center">
                    <h3>Share Facebook</h3>
                    <h4><?php if (empty($view_tats)) {
    echo '0';} else {echo $view_tats['share_fb'];} ?></h4>
                </div>
                <div class="col-md-4 user-pad text-center">
                    <h3>Share Twitter</h3>
                    <h4><?php if (empty($view_tats)) {
    echo '0';} else {echo $view_tats['share_tw'];} ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-1 user-menu-btns">
            <div class="btn-group-vertical square" id="responsive">
                <a href="#" class="btn btn-block btn-default active">
                  <i class="fa fa-info-circle fa-3x"></i>
                </a>
                <a href="#" class="btn btn-default">
                  <i class="fa fa-list fa-3x"></i>
                </a>
                <a href="#" class="btn btn-default">
                  <i class="fa fa-arrow-circle-o-down fa-3x"></i>
                </a>
               <!-- <a href="#" class="btn btn-default">
                  <i class="fa fa-cloud-upload fa-3x"></i>
                </a>-->
            </div>
        </div>
        <div class="col-md-5 user-menu user-pad">
            <div class="user-menu-content active">
                 <h4 class="tt" about="/content_homes1_tittle_new3_11/">
				 <span property= "content" id= "content_homes1_tittle_new3_11">
                  <?php echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'Detail'); ?></span>
                </h4>
                <ul class="user-menu-list">
                    <li>
                    <a href="<?php echo base_url().'artist/presskit/customize'?>" class="btn wow "  data-wow-delay="1s">
					   <button class="btn btn-labeled "  style="background:#EF1C1C;padding-top:0px; padding-bottom:0px; padding-left:0px;">
                            <span class="btn-label" style="color:#FFFFFF;"><i class="fa fa-bell-o"></i></span><span style="color:#FFFFFF;">Customize EPK</span>
							
						</button></a>
                     </li>
                    <li>
					
                         <button class="btn btn-labeled btn-success"  data-wow-delay="1s" data-toggle="modal" data-target="#choose-tpl" style="background:#EF1C1C;padding-top:0px; padding-bottom:0px;padding-left:0px;"> <span class="btn-label"><i class="fa fa-book"></i></span><a  href="#" class="btn wow "  data-wow-delay="1s"><span style="color:#FFFFFF;">Template EPK</span></a></button> 
                    </li>
                    <li>
                     
					 <button type="button" class="btn btn-labeled btn-success" href="#" style="background:#EF1C1C;padding-top:0px; padding-bottom:0px;padding-left:0px;"  onclick='displayEpk("<?php echo base_url().'epk/'.$user_data['home_page']?>")'>
                            <span class="btn-label"><i class="fa fa-book"></i></span><a target="_blank" href="<?php echo base_url().'epk/'.$user_data['home_page']?>" class="btn wow "  data-wow-delay="1s"><span style="color:#FFFFFF; padding-left:0px;padding-right:0px;">Preview</span></a></button>  
                    </li>
                    <li style="word-wrap:break-word;">
                                                  <h3><?php echo base_url('epk/'.$user_data['home_page'])?></h3>

                    </li>
                </ul>
            </div>
            <div class="user-menu-content">
                 <h4 class="tt" about="/content_homes1_tittle_new3_11/">
                                    <span property= "content" id= "content_homes1_tittle_new3_11"><?php echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'LIST VIEWS');
                                        ?>
                                    </span> 
				</h4>
                <ul class="user-menu-list">
                    <li>
<h3><?php if (empty($view_tats)){echo '0';} else {echo $view_tats['view'];} ?></h3> 
  <h4 about="/content_homes1_tittle_new3_11/">
                                    <span property= "content" id= "content_homes1_tittle_new3_11">
                                        <?php
                                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'VIEWS');
                                        ?>
                                    </span> 
                                </h4>



                    </li>
					
                  
                </ul>
            </div>
            <div class="user-menu-content">
 <h4 class="tt" about="/content_homes1_tittle_new3_11/">
                                        <span property= "content" id= "content_homes1_tittle_new3_11"><?php echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'Downloads and Contacts'); ?>
                                        </span> 
</h4>                <div class="row">
                        <!--mycodeopen-->
						   <div class="col-md-6"><h2 class="m-0"> <?php if (empty($view_tats)) {echo '0';} else {echo $view_tats['interactions'];} ?></h2><h4>Download</h4></div>
                                <div class="col-md-6"><h2 class="m-0">
								<?php if (empty($view_tats)) {echo '0';} else {echo $view_tats['contact'];} ?></h2><h4>Contact</h4></div>
                        <!--mycode close-->
                     </div>
            </div>
            <div class="user-menu-content">
                <h2 class="text-center">
                   COMMING SOON
                </h2>
               <i class="fa fa-cloud-upload fa-4x"></i></center>
                <div class="share-links">
                    <center><button type="button" class="btn btn-lg btn-labeled btn-success" href="#" style="margin-bottom: 15px;">
                            <span class="btn-label"><i class="fa fa-bell-o"></i></span>NEW PROJECT
                    </button> 
                    
                </div>
            </div>
        </div>
    </div>
	<!----------------- customize page data------------------->
	<div class="row box-s" >
	<form id="form_edit" class="form-horizontal" action="<?php echo base_url()?>artist/presskit/postcustomize" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
		<div class="col-md-8 pad-20">
		<h3 class="tt mystyle" about="/content_homes1_tittle_new6_12/" style="border-bottom:1px solid #999999; margin-top:9px;">
                        <span property= "content" id= "content_homes1_tittle_new6_12">
                            <?php
        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_12_s>','Preview EPK page');
                            ?>
                        </span>
       	            </h3> 
<!--                    <span class="myliner"></span>
-->					<div class="tile-body text-center vertical_line" style="padding:30px;padding-top:0px;">
                        
                        <ul class="list-inline tbox m-0 text-left ">
                            <li class="b-r tcol">
                                <h2 class="m-0"></h2>                             
                                <p about="/content_homes1_tittle_new6_17/">
                                    <span property= "content" id= "content_homes1_tittle_new6_17">
                                        <?php
                                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_17_s>', 'Manage The Contents Of Your Press Kit Here. You Can Do Things Like:');
                                        ?>
                                    </span>
                   	            </p>
<div class="row" style="margin-left:0px;">
	<div class="col-md-6">
				<button type="button" class="edit_profile btn btn-labeled sbtn"><span class="btn-label"><i class="fa fa-download"></i></span><span> Send Your Best Photo</span></button>
				
	</div>

	<div class="col-md-6">

	<button type="button" class="edit_profile_song1 btn btn-labeled sbtn"  onclick="fetch_song();" ><span class="btn-label"><i class="fa fa-music"></i></span><span> Send Your Best Songs</span></button>
	</div>  </div><!--close row-->
	
<!--set primary video-->

<div class="row" style="margin-left:0px;margin-top:10px;">
	<div class="col-md-6">
				<button type="button" id="tests" class="set_primary_video btn btn-labeled sbtn" onclick="fetch_video();"><span class="btn-label"><i class="fa fa-download"></i></span><span> Send Your Best Video</span></button>
				
	</div>

	<div class="col-md-6">

	<button type="button" class="set_primary_bios btn btn-labeled sbtn"  onclick=""  data-toggle="modal" data-target="#SetBios" ><span class="btn-label"><i class="fa fa-music"></i></span><span> Set Your Bio</span></button>
	</div>  </div><!--close row-->
<!--set primary video clsoe-->	


<div class="row" style="margin-left:0px; margin-top:10px;">
	<div class="col-md-6">

<button type="button" class="btn btn-labeled sbtn" data-toggle="modal" data-target="#uploadNewMedia"><span class="btn-label"><i class="fa fa-plus"></i></span><span> Upload New Media</span></button>

</div>

	<div class="col-md-6">

<button type="button" class="btn btn-labeled sbtn" data-toggle="modal" data-target="#editMedia"><span class="btn-label"><i class="fa fa-edit"></i></span><span> Edit Media  </span></button>
 
</div>
</div>
<div class="row" style="margin-left:0px; margin-top:10px;">
    <div class="col-md-12">
        <button type="button" class="btn btn-labeled sbtn" data-toggle="modal" data-target="#setShow"><span class="btn-label"><i class="fa fa-edit"></i></span><span> Set Your shows</span></button>                        
    </div>                          
</div>
<div class="row" style="margin-left:0px; margin-top:10px;">
<div class="col-md-12">
							    <!--<pre>- Set your primary photo and song<br /></pre>-->
                                 <pre>- Re-order your assets with drag-and-drop<br /></pre>
                                Choose which content you will show and hide
	</div>							
</div>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
                                <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">
                                  <input type="checkbox" name="photo"<?php if ($data_customize->photo == 'on') {
    echo 'checked';
}?>/> Photos
		<div class="control__indicator"></div>

                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
 <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="video"<?php if ($data_customize->video == 'on') {
    echo 'checked';
}?>/><span class="check"></span> Videos
		<div class="control__indicator"></div>

                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
                    <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">
                                  <input type="checkbox" name="stats"<?php if ($data_customize->stats == 'on') {
    echo 'checked';
}?>/> Stats
<div class="control__indicator"></div>

                                </label>
                             </div>   
                             <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
<label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="song"<?php if ($data_customize->song == 'on') {
    echo 'checked';
}?>/> Songs &nbsp;

<div class="control__indicator"></div>
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
    <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="show"<?php if ($data_customize->show == 'on') {
    echo 'checked';
}?>/> Shows

<div class="control__indicator"></div>

                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
 <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                    <input type="checkbox" name="press"<?php if ($data_customize->press == 'on') {
    echo 'checked';
}?>/> Press
                               <div class="control__indicator"></div>

							   
							    </label>
                             </div>
                         </div>
                    </div>
		 <div class="col-md-8 col-md-offset-2 txtClr">PRESS PUBLISH CHANGES to Show or Hide.</div>
		</div>
 		
		<div class="col-md-4">
		   		<section class="tile tile-simple header_new_style wow " style="padding-top:19px; color:black;">
                    <!-- tile widget -->            
                     <h3 class="tt mystyle" about="/content_homes1_tittle_new6_13/"  style="border-bottom:1px solid #999999; margin-top:9px; width:300px;">
                        <span property= "content" id= "content_homes1_tittle_new6_13" >
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_13_s>', 'MEDIA Downloads Avail to Recipients');
                            ?>
                        </span>
       	            </h3> 
                     
                    <!-- /tile widget -->
                    <!-- tile body -->
                    <div class="tile-body text-center">
                        
                        <ul class="list-inline tbox m-0 text-left">
                            <li class="b-r tcol">
                                <h2 class="m-0"></h2>
                                <p about="/content_homes1_tittle_new6_18/">
                                    <span property= "content" id= "content_homes1_tittle_new6_18">
                                        <?php
                                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_18_s>', "Download Assets<br />
                                Sometimes people want a hardcopy. Select which assets you'd like to make available for download here.");
                                        ?>
                                    </span>
                   	            </p>                                
                            </li>
                        </ul>
                        <div class="row">
                            <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
<label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="dw_photo" <?php if ($data_customize->dw_photo == 'on') {
    echo 'checked';
}?>/> Photos
<div class="control__indicator"></div>

                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
            <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="dw_bios" <?php if ($data_customize->dw_bios == 'on') {
    echo 'checked';
}?>/> Bios
<div class="control__indicator"></div>


                                </label>
                             </div>
                            <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
           <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="dw_song" <?php if ($data_customize->dw_song == 'on') {
    echo 'checked';
}?>/> Songs

<div class="control__indicator"></div>
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
           <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="dw_video" <?php if ($data_customize->dw_video == 'on') {
    echo 'checked';
}?>/> Videos

<div class="control__indicator"></div>
                                </label>
                             </div>
                               <div class="checkbox col-xs-4 wow " data-wow-delay="1.2s">
           <label class="control control--checkbox" style="width:2px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="dw_pdf" <?php if ($data_customize->dw_pdf == 'on') {
    echo 'checked';
}?>/> .pdf

<div class="control__indicator"></div>
                                </label>
                             </div>
                        </div>
                            
                    </div>
                    <!-- /tile body -->
                </section>
 		 
		</div><!--col-md-4 close-->
		
		                <!--<span class="myliner"></span>-->
                        <hr>
		<!--contact replay added by sunil start-->
		
		<div class="col-md-8">
                <!-- tile -->
                <section class="tile tile-simple header_new_style wow" data-wow-delay="1.2s" style="padding-top:12px; color:black;">
                    <!-- tile widget -->                   
                     <h3 class="tt mystyle" about="/content_homes1_tittle_new6_14/" style="border-bottom:1px solid #999999; margin-top:9px;">
                        <span property= "content" id= "content_homes1_tittle_new6_14">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_14_s>', 'CONTACT FOR REPLY');
                            ?>
                        </span>
       	            </h3> 
<!--                    <span class="liner"></span>
-->                    
                    <!-- /tile widget -->
                    <!-- tile body -->
                    <div class="tile-body text-center vertical_line">
                        
                        <ul class="list-inline tbox m-0">
                            <li class="b-r tcol">
                                <h2 class="m-0"></h2>
                                 <p  about="/content_homes1_tittle_new6_16/">
                                        <span property= "content" id= "content_homes1_tittle_new6_16">
                                            <?php
                                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_16_s>', "
                                Decide where messages are sent when someone clicks 'Contact' in your Press Kit. 
                                You can set and select from your Artist, Booking, and/or Management email addresses.");
                                            ?>
                                        </span>
                   	            </p>                               
                            </li>
                        </ul>
						
						
                        
						
						 <button class="btn btn-labeled" style="background:rgba(0, 0, 0, 0.9); padding:0px; color:#FFFFFF;" data-target="#editemail" data-toggle="modal" type="button"> <span class="btn-label" ><i class="fa fa-pencil-square-o"></i></span><a class="btn  wow " data-wow-delay="1.0s" href="#" style="color:white">Artist Email Addresses</a></button>
						
                        <div class="row">
                            <div class="checkbox col-xs-4 wow" data-wow-delay="1.0s">
 <label class="control control--checkbox" style="width:129px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="email_artist" <?php if ($data_customize->email_artist == 'on') {
    echo 'checked';
} if (empty($email_contact['email_artist'])) {
    echo 'disabled';
}?>/> Artist email 
      <div class="control__indicator"></div>
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow" data-wow-delay="1.0s">
 <label class="control control--checkbox" style="width:152px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="email_booking" <?php if ($data_customize->email_booking == 'on') {
    echo 'checked';
} if (empty($email_contact['email_booking'])) {
    echo 'disabled';
}?>/> Booking email
      <div class="control__indicator"></div>
                                </label>
                             </div>
                            <div class="checkbox col-xs-4 wow" data-wow-delay="1.0s">
 <label class="control control--checkbox" style="width:190px; height:23px; padding-left:27px;">                                  <input type="checkbox" name="manager_email" <?php if ($data_customize->email_manager == 'on') {
    echo 'checked';
} if (empty($email_contact['email_manager'])) {
    echo 'disabled';
}?>/> Management email 
      <div class="control__indicator"></div>

                                </label>
                             </div>
                        </div>
                            
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
                
            </div>
		
		<!--contact replay close-->
	<!-- publish cange-->
	
	  
			<div class="col-md-4 btnhi">
					<span id="pagegradient"></span>
 					 <a class="button" href="#" class="link-effect-button" id="publish_save">
					<span>Publish Changes</span>
					</a>
	</div>
	<!--publish cange close-->	
		
	</form>	
	</div>
	<!--added by sunil for page refresh click on publish changs-->
	<script>
function myFunction() {
    location.reload();
}
</script>
	<!-----------------End customize page data------------------->
	
	<div class="row">
		   
                          <div class="action text-center wow " style="border-radius:0px; box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);">
                            <div style="text-align: left;">                                
                                     <h4 class="tt" about="/content_homes1_tittle_new3_11/">
                                        <span property= "content" id= "content_homes1_tittle_new3_11">
                                            <?php
                                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new3_11_s>', 'ACTIONS');
                                            ?>
                                        </span> 
                                    </h4>
                                    <span class="liner"></span>
                                </div>
                            <div class="tile-body text-center p-0">
                                <ul class="events-action list-inline tbox m-0">
                                    <?php
                                        foreach ($statsrpk as $row) {
                                            ?>
                        			<li>
                        				<span  class="rect image_frame"><img width="50" height="50" alt="xgdfh" src="<?php echo $avata?>" title="xgdfh"></span>
                        				<div class="text" style="color:#000000;">
                        					<a href="<?php echo base_url().$user_data['home_page']?>">You</a> sent your epk to add [<?php echo $row['email_to']?>] <span> <?php echo $controller->time_calculation($row['time'])?></span>
                        				</div>
                        			</li>
                                    
                        			<?php
                                    //if(end($statsrpk)!=$row)
                                     //echo '<hr/>';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
	<!--myrow-->		
	</div>
	
</div>
				
				
				<!--out code profile_design close-->
				</div>
            </div>
        </div>
    
    
<!-- Modal -->
<style>
	
</style>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    (function($){
        $(window).load(function(){
            $("#sendmail .modal-body").mCustomScrollbar();
            $("#preview .modal-body").mCustomScrollbar();
            $("#choose-tpl .modal-body").mCustomScrollbar();
            $("#preview-tpl .modal-body").mCustomScrollbar();
        });
    })(jQuery);
</script>



    
    
  
<script>

    $(document).ready(function() {
        $('#sendmail').on('click','.epk-tpl_box_scroll ul li', function (){
            $( ".epk-tpl_box_scroll ul li" ).each(function() {
                $(this).removeClass("selected");
                $(this).addClass( "" );
            });
            $(this).addClass( "selected" );
            var tpl_vl = $(this).find('.hidden-val').val();
            $( "#tpl_email" ).val(tpl_vl);
        });
        
        $('#sendmail').on('click','.myButton', function (){
            var parent = $(this).parent().parent();
            var messager = $('#msg').val();
            var value_epk = parent.find('.hidden-val').val();
             $.ajax({
             type: "POST",
             url: '<?=base_url()?>' + "artist/managerrpk/load_tpl_email/"+value_epk ,
             dataType: "text",
             data: {'msg':messager},
             success: function(datatest) {
                    console.log(datatest);
                     $('#template1').html(datatest);
                     $('#template1').show();
                    $('#template2').hide();
                 }
             });
	    });
        
	}) 
</script>
<script>
$('.epk-tpl_box_scroll ul li a').click(function(e) {
  $('#preview img').attr('src', $(this).attr('data-img-url'));
});
</script>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/dashboard_epk.js"></script>
<!-- Modal -->
<div class="modal new_modal_style" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				 
                <h4 class="tt">Email EPK</h4>
                <span class="liner"></span>
			</div>
            <div class="modal-body" >
                <div id="template1">
                    <img class="img-responsive" src="#" />
                </div>
				<div class="modal-footer">  
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>                                
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Share -->
<div class="modal fade share new_modal_style" id="share" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Share EPK</h4>
                <span class="liner"></span>
    		</div>
    		<div class="modal-body share_btn">
    			<p>Use Twitter or Facebook to share your EPK.</p>
    			<p>
                    <a class="btn btn-block btn-social btn-twitter" href="https://twitter.com/intent/tweet?original_referer=<?php echo base_url().'epk/'.$user_data['home_page']?>&text=Sound%20House%20Promotions%20%7C%20Connect%20with%20Fans&tw_p=tweetbutton&url=<?php echo base_url().'epk/'.$user_data['home_page']?>"
        				onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
        			<i class="fa fa-twitter"></i> Share Twitter
        			</a>
                </p>
                <p>
        			<a class="btn btn-block btn-social btn-facebook" href="https://www.facebook.com/sharer/sharer.php?app_id=625925940949384&u=<?php echo base_url().'epk/'.$user_data['home_page']?>&display=popup&ref=plugin&src=share_button" 
        				onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
        			<i class="fa fa-facebook"></i> Share Facebook
        			</a>
                </p>
                
    			<script>
    				!function(d,s,id){
    				    var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
    				    if(!d.getElementById(id)){
    				        js=d.createElement(s);
    				        js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
    				        fjs.parentNode.insertBefore(js,fjs);
    				    }
    				}(document, 'script', 'twitter-wjs');
    			</script>   
    		</div>
            <div class="modal-footer searchform">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
    	</div>
    </div>
</div>
<!-- Modal choose -->
<div class="modal fade new_modal_style " id="choose-tpl" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Choose A Template-EPK</h4>
                <span class="liner"></span>
            </div>            
            <div class="modal-body searchform">
                <div class="alp-template_box">
                    <ul class="sortable with_main_songs"> 
                     <?php
                     foreach ($epks as $epk1) {
                         ?>
                            <li class="<?php if ($user_data['tpl_epk'] == $epk1['position']) {
    echo 'selected';
} ?>">
                                <input type="hidden" class="hidden-val" value="<?= $epk1['position']?>" />
                                <input type="hidden" class="hidden-img" value="<?php echo base_url()?>uploads/templates/epk/<?php echo $epk1['images'] ?>" />
                                <img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>uploads/templates/epk/<?php echo $epk1['images'] ?>"/>
                                <span>Template EPK <?= $epk1['position']?></span> 
                                <a class="btn btn-default pull-right btn-preview" data-toggle="modal" data-target="#preview-tpl">Preview</a>
                            </li>
                            <?php

                     }
                    ?>   
                    </ul>
                </div>
            </div>
            <div class="modal-footer searchform">
                <form action="<?php echo base_url()?>artist/update_tplepk" method="post" name="setTemplate">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" name="template_epk" id="template_epk" value="<?=$user_data['tpl_epk']?>" />
                    <input type="hidden" name="id_artist"  value="<?php echo $user_data['id']?>" />
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>
            </div>          
        </div>
    </div>
</div>

<!--Modal to Add more assets-->
<div class="modal fade share new_modal_style" id="uploadNewMedia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalbg">Upload new Asset</h4>
            </div>   

            <div>
                <ul>
                    <a href="<?php echo base_url().'artist/managervideo'?>"><li>Upload New Video</li></a>
                    <a href="<?php echo base_url().'artist/managerphoto'?>"><li>Upload New Photo</li></a>
                    <a href="<?php echo base_url().'artist/managersong'?>"><li>Upload New Song</li></a>
                </ul>
            </div>         
              
        </div>
    </div>
</div>

<!--Modal to Add more assets-->
<div class="modal fade share new_modal_style" id="editMedia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalbg">Edit Assets</h4>
            </div>   

            <div>
                <ul>
                    <a href="<?php echo base_url().'artist/managervideo'?>"><li>Edit Video</li></a>
                    <a href="<?php echo base_url().'artist/managerphoto'?>"><li>Edit Photo</li></a>
                    <a href="<?php echo base_url().'artist/managersong'?>"><li>Edit Song</li></a>
                </ul>
            </div>         
              
        </div>
    </div>
</div>
<div class="modal fade share new_modal_style" id="setShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalbg">Set Your Best Shows</h4>
                <span class="liner"></span>
            </div>   
            <div class="modal-body">
                <div class="modal-body">
                    <div>
                        <?php
                            foreach ($events as $key => $event) {
                                
                         ?>
                    <form id="setShowForm" method="post" onsubmit="return false">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                   
                        <?php if (!empty($event['event_banner'])) { ?>
                            <?php
                                $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; ?>
                            
                            <?php
                        } else {
                            $url_image = base_url().'assets/images/icon/manager_git_event.png';
                        } ?>

                           <div class="col-sm-12">
                           
                                <div class="col-sm-12 text-center"><strong><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></strong>
                                </div>
                            
                                <div class="col-sm-2">
                                <a id="selectShow_<?=$event['event_id']?>"
                                 onclick="selectShowEvent('<?=$event['event_id']?>');" class="selectShow" href="#" value="<?=$event['event_id']?>">
                            
                                    <img width="150px" src="<?php echo $url_image; ?>" />
                                    </a>
                                </div>
                                <div class="col-sm-offset-4 col-sm-6">
                                    <div>
                                        <strong>Location:</strong><?php custom_echo_html($event['location'], 400); ?>
                                    </div>
                                    <div>
                                        <strong>Start:</strong> <?php custom_echo_html($event['event_start_date'], 400); ?> <strong>To:</strong><?php custom_echo_html($event['event_end_date'], 400); ?> 
                                    </div>
                                    <div>
                                        <strong>Capacity:</strong><?php custom_echo_html($event['capacity'], 400); ?><strong> Star:</strong><?php custom_echo_html($event['sum_star'], 400); ?> 
                                    </div>
                                </div>
                            </div>  
                        
                        <?php
                        }
                        ?>
                   
                    </form>     
                    </div>
                </div>  

            </div>        
             <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script >
    function selectShowEvent(event_id){
            console.log(event_id);
            data = {
                'event_id': $('.selectShow').attr('value')
            };
            console.log(data);
             $.ajax({
             type: "POST",
             url: base_url + 'artist/presskit/set_show' ,
             dataType: "text",
             data: {
                'event_id': event_id,
                '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
            },
             success: function(datatest) {
                    console.log(datatest);
                     
                 }
             });
        }
        // $('.selectShow').on('click', function (){
            
        // });
        
        // $('#selectShow').click(function(){
        //     console.log('function calls');
        //     $('#setShowForm').submit();
        // })
   
</script>
<script>
	$(document).ready(function() {
        $('#choose-tpl').on('click','ul li', function (){
            $( "#choose-tpl ul li" ).each(function() {
                $(this).removeClass("selected");
                $(this).addClass( "" );
            });
            $(this).addClass( "selected" );
            var tpl_vl = $(this).find('.hidden-val').val();
            $( "#template_epk" ).val(tpl_vl);
        });
        
        $('#choose-tpl').on('click','.btn-preview', function (){
            var parent = $(this).parent();
            var src = parent.find('.hidden-img').val();
            $("#pre-img").attr("src",src);
	    });
        
	}) 
</script>

<!-- Modal preview -->
<div class="modal fade new_modal_style" id="preview-tpl" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="tt">Preview EPK page</h4>
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

<div class="new_modal_style modal fade" id="sendmail" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			
                <h4 class="tt">Email EPK</h4>
                <span class="liner"></span>
			</div>
			<form class="form form-signup searchform" id="update_pt" role="form" action="<?php echo base_url()?>artist/presskit/sendmail" method="post">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
					<div class="intro">
						<p> When you email your EPK through 99Sound, we'll track when the email is opened along with
							interaction that each recipient takes on your EPK.
						</p>
					</div>
                    <div class="form-group">
						<label class="form-input col-md-3"> Choose Template Email:</label>
						<div class="input-group col-md-8">
                            <div class="epk-tpl_box_scroll">
                            
                                <ul>
                                <?php  for($i=1;$i<=6;$i++){ ?>
                                <li class="<?php if(1==$i) echo 'selected' ?>">
                                    <input type="hidden" class="hidden-val" value="<?= $i?>" />
                                    <a class="clearbg" href="#myModal" data-toggle="modal" data-target="#preview" data-img-url="<?php echo base_url()?>assets/images/email_tpl/tpl_email_epk<?=$i?>.png">
                                    <img style="width: 65px; height: 52px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>assets/images/email_tpl/tpl_email_epk<?=$i?>.png"/>
                                    </a>
                                    <span>Template <?= $i?></span>
                                </li>
                                <?php } ?>   
                                </ul> 
                            </div>
                            
				<input type="hidden" class="form-control" rows="6" name="tpl_email" id="tpl_email" value="1"/>
                          	<input type="hidden" class="form-control" rows="6" name="tpl_email" id="tpl_email" value="<?php echo $epk->tpl_epk ?>"/>
                        </div>
                        
					</div>
					<div class="form-group">
						<label class="form-input col-md-3">From:</label>
						<div class="input-group col-md-8">
							<input type="email" class="form-control" name="from" value="<?php echo $user_data['email']?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3">Subject:</label>
						<div class="input-group col-md-8">
							<input type="text"class="form-control" name="subject" value="<?php echo 'View press kit for '.$user_data['artist_name']?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3">Message:</label>
						<div class="input-group col-md-8">
							<textarea class="form-control" rows="6" name="msg" id="msg">Hi, thank you for your visiting our website. Let's click "view press kit" to listen to samples of new music, view photos and more interesting things. You may reply directly to this email or click the "contact" button from press kit if you would like to follow up. Thanks!
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3">Send to:</label>
						<div class="input-group col-md-8">
                            <div class="epk-sendto-email" >
                                <ul>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                  <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" name="emailto[]" placeholder="Email" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nameto[]" placeholder="Name (for tracking)"/>
                                        </div>
                                    </li>
                                </ul>
                                <button type="button" class="btn btn-primary" onclick='addExtraInput()'> Add Extra Email Field</button> 
                            </div>
						</div>
                        
					</div>
				</div>
                                
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" onclick='document.getElementById("update_pt").submit();'> Send</button> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
				</div>
			</form>
		</div>
	</div>
</div>
<script>

    $(document).ready(function() {
        $('#sendmail').on('click','.epk-tpl_box_scroll ul li', function (){
            $( ".epk-tpl_box_scroll ul li" ).each(function() {
                $(this).removeClass("selected");
                $(this).addClass( "" );
            });
            $(this).addClass( "selected" );
            var tpl_vl = $(this).find('.hidden-val').val();
            $( "#tpl_email" ).val(tpl_vl);
        });
        
        $('#sendmail').on('click','.myButton', function (){
            var parent = $(this).parent().parent();
            var messager = $('#msg').val();
            var value_epk = parent.find('.hidden-val').val();
             $.ajax({
             type: "POST",
             url: '<?=base_url()?>' + "artist/managerrpk/load_tpl_email/"+value_epk ,
             dataType: "text",
             data: {'msg':messager},
             success: function(datatest) {
                    console.log(datatest);
                     $('#template1').html(datatest);
                     $('#template1').show();
                    $('#template2').hide();
                 }
             });
	    });
        
	}) 
</script>
<script>
$('.epk-tpl_box_scroll ul li a').click(function(e) {
  $('#preview img').attr('src', $(this).attr('data-img-url'));
});
</script>

<!--model css and js --> <!--added by sunil-->
 <style>
.modal:nth-of-type(even) {
    z-index: 1042 !important;
}
.modal-backdrop.in:nth-of-type(even) {
    z-index: 1041 !important;
}
    
</style> 
<div class="modal fade" id="myModal3" data-backdrop="static">
	<div class="modal-dialog">
      <div class="modal-content" style="width:85%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Send Your Best Song</h4>
        </div> 
        <div class="modal-body msong"   style="margin-left:30px; overflow:scroll;">
             <div id="song"></div>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <a href="#" class="btn btn-primary" id="songsave">Save changes</a>
        </div>
      </div>
    </div>
</div> 
<!--script for load primary songs-->

<script>
function fetch_song()
{
	 $.ajax({
			url :"<?php echo base_url();?>artist/audio/album_list",
   			success: function(data)
			{
				 $('#myModal3').modal('show');
 			    $('#song').html(data);
 	
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert(errorThrown);
			}
	 
});
   
 

}

function get_song_list(id)
{
	 
		$.ajax({
			url :"audio/test/"+id,
			
   			success: function(data)
			{
  			     $('#song').html(data);
				//alert(data);
 			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert(errorThrown);
			}
});
 
 
}

function get_song_choose(albumid)
{
  	$.ajax({
			url :"audio/update_primary_song_user/"+albumid,
			
   			success: function(data)
			{
  			     //$('#song').html(data);
				 alert(albumid);
				 alert("set successfully");
                 $('#myModal3').modal('hide');
  			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert(errorThrown);
			}
});

 }
 
 function get_song_select(id)
 {
 	$('.rmvsong').removeClass('songdesgin');
    $('#song'+id).addClass('songdesgin');
	$('#songsave').attr("onclick","get_song_choose(" + id + ")");
   
 }


 
</script>
 <!--end primary songs-->

 
<!--model css and js clsoe-->
<!--load popup on click img button --> <!--added by sunil-->

<script type="text/javascript">
$(document).ready(function(){

	$(".edit_profile").click(function(){
		$("#myModal1").modal('show');
	});
	
	
$('.edit_profile_song').click(function(){
	$('#myModal3').modal({show:true})
});


$('#tests').click(function(){
	$('#myModal4').modal('show');
});


});

<!--set video function -->

function videofun(id)
{
	$('.rmv').removeClass('imgdesgin');
    $('#ism'+id).addClass('imgdesgin');
	$('#videosave').attr("onclick","setvideo(" + id + ")");
 }
 
  function setvideo(nid){
	  
			$.ajax({
 		    url: "<?php echo base_url();?>artist/presskit/update_video/"+nid,
  			success: function(msg){
			alert("Profile Video Update succesfully");
			}, error: function (jqXHR, textStatus, errorThrown)
						 {
						   alert(errorThrown);
						 }
			});  
      
 }
 
 
<!--set video function clsoe-->






	

function imgfun(id)
{
	$('.rmv').removeClass('imgdesgin');
    $('#ism'+id).addClass('imgdesgin');
	$('#btnsave').attr("onclick","changeimg(" + id + ")");
 }
 
 function changeimg(nid){
	  
			$.ajax({
 		    url: "<?php echo base_url();?>artist/presskit/update_img/"+nid,
  			success: function(msg){
			alert("Profile Image Update succesfully");
			}, error: function (jqXHR, textStatus, errorThrown)
						 {
						   alert(errorThrown);
						 }
			});  
      
 }
</script>
<!--added by sunil -->
 
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
	.imgdesgin
	{
/*	 border:4px solid red!important;
*/	 padding:0px;
	}
	.rmv
	{
	 width:150px;
	 height:90px;
	 margin-top:20px;
	 margin-left:20px;
	}
	
	.songdesgin
	{
	     opacity: 0.5;
	  
	}
	
	
 	.rmvsong
	{
/*      background:none;
*/	}
	
	@media only screen and (min-width :1080px) {
/* Styles */
 .msong{ 
  height:220px!important;
  }
  
  
}
</style>

 <!--set video model -->
 <script>
 function fetch_video()
{
	 $.ajax({
			url :"<?php echo base_url();?>artist/Presskit/video_list",
   			success: function(data)
			{
 				$('#myModal4').modal('show');
				
 			    $('#video').html(data);
 	
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert(errorThrown);
			}
});

}
</script>
 
 
 
 <div class="bs-example">
<div class="modal fade" id="myModal4" data-backdrop="static">
	<div class="modal-dialog">
      <div class="modal-content" style="width:85%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Send Your Best Video</h4>
        </div> 
        <div class="modal-body"style="margin-left:30px; overflow:scroll;">
		  <div id="video"></div>
         </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <a href="#" class="btn btn-primary" id="videosave">Save Changes</a>
        </div>
      </div>
    </div>
</div>
</div>





<!--set video model close-->
<!--popup added by sunil set primary image -->

<div class="bs-example">

    <div id="myModal1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Send Your Best Photo</h4>
                </div>
                <div class="modal-body" style="overflow:scroll;">
                    
					
 	 
		<div class="row">
        <div class="col-md-4">
           <div class="titleCls">Upload the Image</div>
          
           <form enctype="multipart/form-data" class="" method="post"  action="<?php echo base_url();?>artist/presskit/upload_image" name="background_image_upload_form" id="background1"  style="margin-top: 12px;">
               <div id="img1"><img src="<?php echo base_url();?>assets/images/default-background.png">
									<div class="progressBar1">
										<div class="bar1"></div>
										<div class="percent1">0%</div>
									</div>
                   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div id="imgChange1"><span>Change Image</span>
										<input type="file" accept="image/*" name="image_upload" id="background_image_upload">
									</div>
								</div>
          </form>
        </div>
        <div class="col-md-8 customProfile">
        <div class="titleCls">SELECT A IMAGE </div>
        				
             
        <div id="backgrounds" class="row"></div>
        
  


        
 </div>
        </div>	
			 
					  
                 </div>
                <div class="modal-footer" style="margin-top:25px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnsave">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
 
  <!--second moadl for songs-->

  <!--Set Bios-->

<div class="modal fade" id="SetBios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Your Bios</h4>
      </div>
      <div class="modal-body">
          <div id="message"></div>
              <form class="form-horizontal" method="post">
                  <textarea class="form-control" cols="20" rows="20" name="bios" id="bios"><?php echo $epk_bio;?></textarea>                        
                  <input type="hidden" id="user_id" value="<?php echo $user_data['id'];?>" name="user_id">
              </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick=" return setBios();">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>                
    CKEDITOR.replace('bios');
</script>
  <script>
  
  function setBios() { 
  user_id=$('#user_id').val();
  bios= CKEDITOR.instances['bios'].getData();
  $.ajax({
 		   url:"<?php echo base_url();?>artist/presskit/update_bios",
            type: "POST",
            data: { user_id:user_id,bios:bios, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
              dataType:"json",
  			success: function(msg){
			    $('#message').html('<div class="alert alert-success">Bios Updated Successfully.</div>');
                $('#SetBios').modal('hide');
			}, error: function (jqXHR, textStatus, errorThrown)
				{
				   alert(errorThrown);
				}
			}); 
    }
    
</script>
<script src="<?php echo base_url();?>assets/js/jquery.form.js"></script>
<script>
$(document).on('change', '#background_image_upload', function () {
var progressBar1 = $('.progressBar1'), bar1 = $('.progressBar1 .bar1'), percent1 = $('.progressBar1 .percent1');
 
$('#background1').ajaxForm({
    
    beforeSend: function() {
		progressBar1.fadeIn();
        var percentVal = '0%';
        bar1.width(percentVal)
        percent1.html(percentVal);
      
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar1.width(percentVal)
        percent1.html(percentVal);
          
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);
             
		if(obj.status){		
               
			var percentVal = '100%';
			bar1.width(percentVal)
			percent1.html(percentVal);
			$("#img1>img").prop('src',obj.image_medium);	
                        $("#img2>img").prop('src',obj.image_medium);	
                        //$("#profilepic").prop('value',obj.image_medium);
                       
		}else{
			alert(obj.error);
                     
		}
    },
	complete: function(xhr) {
		progressBar1.fadeOut();			
	}	
}).submit();		

});
$(function() {
  
    update_image();
    
});
function update_image() {
      
    $.getJSON("<?php echo base_url();?>artist/presskit/get_image", function(data1) {
        
        $("div#backgrounds").empty();
    
        $.each(data1.json, function() {
          
            $("div#backgrounds").append('<div class="col-xs-2 rmv img-responsive" style="cursor:pointer; margin-top:20px;" onclick=imgfun("'+this['imgN']+'");> <img class="img-thumbnail" width="150" height="90"  style="border:4px solid black;" src="'+this['image']+'"></div>');
        
            //alert(this['3']);
           
             //$("div#backgrounds").append(this['image']);
       
 //$("div#backgrounds").append('<div class="comment-box"><div class="picture"><img src="http://graph.facebook.com/'+this['image']+'/picture"></div><div class="name"> <span><strong>'+this['fb_name']+'</strong></span> <p>'+this['comment']+'</p></div></div>');

          
           
         
        });
       setTimeout(function(){+
            update_image();
              
        }, 1000);
    });
}
      
function addExtraInput()
{
var ele = '<li> <div class="col-sm-6"><input type="email"class="form-control" name="emailto[]" placeholder="Email" /></div><div class="col-sm-6"><input type="text"class="form-control" name="nameto[]" placeholder="Name (for tracking)"/></div></li>';
$('.epk-sendto-email ul').append(ele);
}    
function displayEpk(url)
{
  var win = window.open(url, '_blank');
  win.focus();
}    

$(document).ready(function() {
	$('#form_edit').on('click','#publish_save', function (){
		$('#form_edit').submit();
	});
});

</script>
<!-- Modal preview -->
<div class="modal fade new_modal_style" id="editemail" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              
                <h4 class="tt" about="/content_homes1_tittle_new6_15/">
                        <span property= "content" id= "content_homes1_tittle_new6_15">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_15_s>', 'Artist Email Addresses');
                            ?>
                        </span>
   	            </h4> 
                <span class="liner"></span>
                
            </div>  
            <form class="form form-signup searchform" id="update_pt" role="form" action="<?php echo base_url()?>artist/presskit/email_contact" method="post">          
               <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                
    				<div class="modal-body">
    					<div class="form-group">
    						<label class="form-input col-md-5">Artist Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email"class="form-control" name="artist_email" value="<?php echo $email_contact['email_artist']?>"/>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="form-input col-md-5">Booking Info Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email"class="form-control" name="booking_email" value="<?php echo $email_contact['email_booking']?>"/>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="form-input col-md-5">Management Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email" class="form-control" name="manager_email" value="<?php echo $email_contact['email_manager']?>"/>
    						</div>
    					</div>
    				</div>
                </div> 
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary " >Save</button>    
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
    			</div>   
            </div>
        </form>
    </div>
</div>
