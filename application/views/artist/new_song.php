<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/bootstrap-slider.min.css" rel="stylesheet" media="screen" type="text/css" />
<script src="<?php echo base_url()?>assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url()?>assets/js/parsley.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>
<script src="<?=base_url('assets/js/ckeditor/ckeditor.js')?>"></script>
<script>
var a_load_duration     = '<?=base_url('artist/load_duration')?>';
var a_delete_file_video = '<?=base_url('artist/delete_file_video')?>';
var finish_upload_song  = '<?=base_url('artist/finish_upload_song')?>';
var get_csrf_hash       ='<?php echo $this->security->get_csrf_hash(); ?>';
var $playlist_id        ='<?=$playlist_id?>';


</script>

<style>
    .slider .tooltip-inner {
   font-size:20px;
}

@media (min-width: 768px){
.nav-tabs.nav-justified > li {
    display: table-cell;
    width: 194px;
}
}

.nav-tabs > li > a{
  border: medium none;
}
.tab-wizard .nav-tabs > li.active ~ li > a, .tab-wizard .nav-tabs > li.active ~ li > a:hover {
    background-color: #67A0DC;
    height: 63px;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.side-body .form-group {
    display: -webkit-box;
}

</style>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/new_song.js"></script>
<link href="<?php echo base_url(); ?>assets/artists/css/new_song.css" rel="stylesheet">
<div  style=" min-height: 100vh;padding-top:10px">
	<div class="row">
		<?php
          include('inc_side_menu/menu_artist.php')
        ?>
        <!-- Main Content -->
		<div class="container-fluid">
			<div class="side-body">
				<div class="">
					<div class="breadcrumb flat" style="    width: 100%">
						<a href="<?php echo base_url()?>artist/profile">Profile</a>
						<a href="<?php echo base_url()?>artist/managersong">Playlist->Song Manager</a>
                        <a  href="<?= base_url('artist/playlist/'.$playlist_id)?>">Playlist</a>
                         <a class="active" href="#">Upload Song</a>
					</div>
				</div>
				<!-- tile -->
				<section class="tile" style="padding: 0px;">
                    <div class="modal_loading"></div>
                    <div id="rootwizard" class="tab-container tab-wizard">
                        <ul class="nav nav-tabs nav-justified nav-custom">
                            <li><a href="#tab1" data-toggle="tab"><span style="visibility:hidden;">Artist Mus</span>Information <span class="badge badge-default pull-right wizard-step">1</span></a></li>
                            <li><a href="#tab2" data-toggle="tab"> Artist Music Player Audio<span class="badge badge-default pull-right wizard-step">2</span></a></li>
                            <li><a href="#tab3" data-toggle="tab">Artist Music Player Video<span class="badge badge-default pull-right wizard-step">3</span></a></li>
                            <li><a href="#tab4" data-toggle="tab">Set Start & End Times Samples<span class="badge badge-default pull-right wizard-step">4</span></a></li>
                            <li id="agreement"><a href="#tab5" data-toggle="tab"><span style="visibility:hidden;">Test1</span>User Agreement</span><span class="badge badge-default pull-right wizard-step">5</span></a></li>
                            
                        </ul>
                        <div class="tab-content" style="padding: 15px;">
                            <div class="tab-pane" id="tab1">
                                <div class="alert alert-danger  avail-popup" role="alert" style="display:none;">
  
  Your song will be moved to the Playlist named “HIDDEN" and will not be available to the Artist Music Player for retail. If you want to retail the song, UPLOADED again to a New Playlist, or one previously created, other than HIDDEN.
</div>
                               <form name="step1" class="form-horizontal"  role="form">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <div class="form-group">
                						<label class="col-xs-3 control-label">Song Name <i class="fa fa-asterisk" style="font-size:8px;vertical-align: super;"></i></label>
                						<div class="col-md-6 col-xs-9 input-group">
                							<input type="hidden" name="id_playlist" value="<?=$playlist_id?>"  class="form-control">
                                                                        <input type="text" size="10" name="song_name" id="song_name"  class="form-control" data-parsley-required data-parsley-songname data-parsley-required-message="Enter a Song Name">
                                                                        
                                                                </div>
                					</div>						
                					<div class="form-group" >
                						<label class="col-xs-3 control-label">Post Song to:  <i class="fa fa-asterisk" style="font-size:8px;vertical-align: super;"></i></label>
                						<div class="col-md-6 col-xs-9 input-group">
                                                                    <select class="chosen-select form-control "  data-parsley-required data-parsley-required-message="Choose Where You Would Like to Post Song"  id="availability" data-placeholder="Choose availability..." name="availability"  onchange="return do_disable();">
                                                                        <option value="">Choose Availability</option>
                								<!--<option value="1">Artist Music Player</option>
                								<option value="2">Download Only</option>
                								<option value="3">Electronic Press Kit</option>-->
                                                                                <?php if($attribute=="1"){ ?>
                								<option value="4" selected="" > AMP/ALP Streaming</option>
                                                                                <?php } ?>
                								<!--<option value="5">99Sound Streaming</option>-->
                								<option value="6">Hidden</option>
                							</select><br />
                						</div>
                					</div>
                                    <div class="form-group" >
                						<label class="col-xs-3 control-label">Price/Song</label>
                                        <div class=" col-md-6 col-xs-9 input-group">
                                            <input type="number" class="form-control" name="price" id="price" min="0.00" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                   title="This should be a number with up to 2 decimal places. eg:1.29" data-parsley-type="number" data-toggle="tooltip" data-placement="top" onkeyup="return currencyConverter();"/>
                                            
                                            <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
  
                                            <select class="form-control" name="currency" id="currency" onchange="return currencyConverter();">
                                                <option value="USD">  US Dollar </option>
                                                <option value="CAD">Canadian Dollar</option>  
                                                 <option value="EUR">Euro</option>   
                                               </select>
                                               
                                                
                                            
                                              
                                        </div>
                                                     
                					</div>
                                    <div class="form-group" >
                                        <label class="col-xs-3 control-label"></label>
                                                                                           
                                       <div class=" col-md-6 col-xs-9 input-group">
                                           <span id="loading" style="display:none;">Please wait getting converted amount..</span>
                                        <div id="conversion_output">
                                            
                                        </div>
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                						<label class="col-xs-3 control-label">Lyrics</label>
                						<div class="col-md-6 col-xs-9 input-group">
                							<textarea class="form-control" id="lyrics" name="lyrics" rows="5" 
                                                                                 > </textarea><br>
                                                                   
                						</div>
                					</div>
                                </form>

                            </div>
                            <div class="tab-pane" id="tab2">
                                
                                <p>Supported Audio Formats are not compatible across all Browsers listed below.
                                Please Upload the correct type <br>you wish to play your song.
                                Multiple formats for ONE SONG may be loaded.Note:Almost all Browsers play MP3,MP4</p>
                                <form class="form-horizontal form_upload_audio" enctype="multipart/form-data" name="step2" action="<?=base_url().'artist/upload_file_audio'?>" method="post" role="form" >
                                    <div class="col-md-6">
                                    <table class="table borderless">
                                        <tbody>
                                           <tr>
                                            
                                    <td>
                                       
       Firefox

                                      
                                        
                                    
                                    </td>
                                    
                                      <td>
                                         
                                          
                                          WEBMA, OGA
                                       
                                      </td>

                                    
                                        </tr>
                                        <tr>
                                    <td>Safari</td>  
                                  
                                      <td>MP3, M4A</td>
                                   
                                    
                                        </tr>
                                        <tr>
                                    <td>Mobile Safari</td>
                                   
                                    <td>MP3, M4A</td>
                                    
                                        </tr>
                                        <tr>
                                    <td>Opera</td>
                                           
                                                    <td>WEBMA, OGA</td>
                                                                                        
                                        </tr>
                                        <tr>
                                    <td>Chrome</td>
                                    
                                        <td>WEBMA, OGA, MP3, M4A</td>
                                       
                                        
                                        </tr>
                                        <tr>
                                    <td>IE9</td>   
                                 
                                          <td>MP3, M4A</td>
                              
                                    
                                        </tr>
                                          
</tbody>
                                    </table> 
                                    </div>
                                    <div class="col-md-6">
                                    <table class="table borderless">
                                    <div class="invalid-form-error-message"></div>
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <tbody>
                                        <tr>
                                            
                                   
                                     

                                    <td>Audio File .WAV
                                                    <input type="file" class="form-control" id="file_audio5" name="file_audio5" accept="audio/x-wav" required data-parsley-errors-messages-disabled />
                                                    </td>
                                        </tr>
                                        <tr>
                                    
                                    <td>Audio File .OGA,.OGG
                                    <input type="file" class="form-control"  id="file_audio2"  name="file_audio2" accept="audio/oga" required data-parsley-errors-messages-disabled />
                                    </td>
                                    
                                        </tr>
                                        <tr>
                                    
                                    <td>Audio File .MP3
                                    <input type="file" class="form-control" id="file_audio4" name="file_audio4" accept="audio/mpeg" required data-parsley-errors-messages-disabled />
                                    </td>
                                        </tr>
                                        <tr>
                                   
                                                                                          <td>Audio File .WEBMA,.WEBM
                                          <input type="file" class="form-control" id="file_audio1"  name="file_audio1" accept="audio/webm" required data-parsley-errors-messages-disabled /></td>
                                        </tr>
                                        <tr>
                                   
                                       
                                        <td>Audio File .M4A,.MP4
                                    <input type="file" class="form-control" id="file_audio3" name="file_audio3" accept="audio/mp4" required data-parsley-errors-messages-disabled  />
                                    </td>
                                        </tr>
                                      
                                        
                                    </tbody>
                                </table>
                                    </div>
                               
                                
                                
                                    
                                   
                           
                                    
                               
                                    
                                    
                                   
                                    
                                   <!-- <p>Notes:
                                        <br>Please provide second browser compatible format.".FLAC" will not play in playlist, it's only for download
                                        <br> There is no need to convert formats,simply change the extension .M4A to MP4 or versa,and it will still play
                                    </p>-->
                                    
                                    <div class="progressbox" style="display:none;">
                                        <div class="progressbar"></div>
                                        <div class="statustxt">0%</div>
                                    </div>
                                   
                                    <div class="output"></div> 
                                </form>

                            </div>
                            <div class="tab-pane" id="tab3">
                        <p>Some format are not compatible with all browsers, please upload your alternative format:</p>
                           <ul>
				<li>Firefox (OSX, Win): WEBMV, OGV</li>
				<li>Safari (OSX, Win): M4V</li>
				<li>Mobile Safari iOS4 (iPad, iPhone, iPod): M4V</li>
				<li>Opera (OSX, Win): WEBMA, OGV</li>
				<li>Chrome (OSX, Win): WEBMV, OGV, M4V. <span class="note">(Will drop support for M4V soon.)</span></li>
				<li>IE9 (Win): M4V <span class="note">(Can install the WebM codec.)</span></li>
			</ul>     
                        
                        <form class="form-horizontal form_upload_video" name="step3" action="<?=base_url().'artist/upload_file_video'?>" method="post" role="form" enctype="multipart/form-data">
                                                                       <div class="invalid-form-error-message"></div>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <div class="form-group" >
                						<label class="col-xs-3 control-label">Video File(MP4,M4V)</label>
                						<div class="col-md-6 col-xs-9 input-group">
                							<input type="file" class="form-control" accept="video/*" name="file_video1" required data-parsley-errors-messages-disabled />
                						</div>
                					</div>
                                     <div class="form-group" >
                						<label class="col-xs-3 control-label">Video File(WEBM,WEBMV)</label>
                						<div class="col-md-6 col-xs-9 input-group">
                							<input type="file" class="form-control" accept="video/*" name="file_video2"  required data-parsley-errors-messages-disabled />
                						</div>
                					</div>
                                    <div class="form-group" >
                						<label class="col-xs-3 control-label">Video File(OGG,OGV)</label>
                						<div class="col-md-6 col-xs-9 input-group">
                							<input type="file" class="form-control" accept="video/*" name="file_video3" required data-parsley-errors-messages-disabled />
                						</div>
                					</div>
                                    <div class="progressbox_video" style="display:none;">
                                        <div class="progressbar_video"></div>
                                        <div class="statustxt_video">0%</div>
                                    </div>
                                    <a href="#" class="btn btn-xs btn-danger del_video_file" style="display: none;" > Remove video</a>
                                    <div class="output_video">
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <form class="form-horizontal" name="step4" role="form" novalidate>
                                    <div class="form-group" >
                                        <label class="col-xs-3 control-label">Type Demo </label>
                                        <div class="input-group col-xs-8">
                                            <label class="radio-inline">
                                                <input type="radio" name="options_demo" checked="" id="radio_audio" value="1"> Audio
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="options_demo" id="radio_video" value="2"> Video
                                            </label>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="form-group" id="box_demo_audio" >
                                        <label class="col-xs-3 control-label">Set Sample Start & End times:Audio</label>
                                        <div class="input-group col-xs-8">
                                            <input id="duration_audio" name="duration_play_audio" type="text" class="form-control " value="" data-slider-handle="triangle" data-slider-max="1000" data-slider-step="1" data-slider-value="[0,30]"/>
                                        </div>
                                    </div>
                                    <div class="form-group" id="box_demo_video" style="display: none;">
                                        <label class="col-xs-3 control-label">Set Sample Start & End times: Video</label>
                                        <div class="input-group col-xs-8 ">
                                            <input id="duration_video" name="duration_play_video" type="text" class="form-control " value="" data-slider-handle="triangle" data-slider-max="1000" data-slider-step="1" data-slider-value="[0,30]"/>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane" id="tab5">

                                <div class="well" style="height: 250px; overflow-y: scroll;">
                                    <p>We respect the copyrights of others and expect our users to do the same. In compliance with the Digital Millennium Copyright Act of 1998 as embodied in 17 U.S.C. § 512 (the “DMCA”), a copy of which may be found on the United States Copyright Office website at http://www.copyright.gov/title17/92chap5.html#512, 99sound.com will respond expeditiously to remove or disable access to material that is claimed to infringe copyrighted material or to be the subject of activity that infringes copyrighted material and was posted online using the 99sound.com service.</p>
                                    <p>1.1 As a 99sound.com account holder you may submit media for upload.</p>
                                    <p>1.2 You agree that 99sound.com does not guarantee the confidentiality of the media that is, or is not published.</p>
                                    <p>1.3 You retain all intellectual property rights in your content, but you are required to grant limited rights to 99sound.com and other users of the Service. These rights are outlined in Annex 1 of Terms and Conditions (entitled "Grants of Rights").</p>
                                    <p>1.4 You acknowledge and agree that you are solely responsible for your own Content and the consequences of its release. 99sound.com does not endorse any Content or any opinion, recommendation, or advice expressed therein, and 99sound.com expressly disclaims any liability for such Content.</p>
                                    <p>1.5 You represent and warrant that you have (and continue to have during use of the Service) all the rights, licenses, consents and permissions to allow 99sound.com to use your Content in order to offer its service and more generally under the conditions envisaged by these Terms and Conditions.</p>
                                    <p>1.6 You agree that your conduct on the Website (and all of your Content) respects the rules of the 99sound.com and any regular updates.</p>
                                    <p>1.7 You agree not to upload or distribute any Content with elements that you are not legally allowed to hold in your country of residence or that 99sound.com could legally use or hold, for providing the Service.</p>
                                    <p>1.8 You agree not to submit content to the 99sound.com on which third parties hold rights (including the right to property, the right to respect for privacy and right of publicity) unless you have obtained the third party formal authorization, to disseminate data in question and to grant 99sound.com the rights specified in Annex 1 of Terms and Conditions (entitled "Grants of Rights").</p>
                                    <p>1.9 If it is informed of any breach of these Terms, 99sound.com reserves the right (but not obliged) to decide whether the content meets the requirements specified in these Terms and may remove any Content that violates these Terms and / or prohibit access of a user to the Service due to the submission of such Content at any time, without notice and at its sole discretion.</p>
                                    <p>1.10 You further acknowledge that by using our Service you may be exposed to Content inaccuracies, offensive, indecent or otherwise negative.</p>
                                    <p>1.11 You further agree that 99sound.com will not in any way be held responsible for broadcasting or distributing such content.</p></p>

                                </div>
                                <form name="step5" role="form" novalidate>
                                    <div class="checkbox">
                                        <label class="checkbox checkbox-custom">
                                            <input type="checkbox" name="agree" id="agree"
                                                   required><i></i> I agree to <a target="_blank" href="<?=base_url('footer/terms')?>" class="text-info">Terms & Conditions</a>
                                        </label>
                                    </div>
                                </form>

                            </div>
                            <ul class="pager wizard">
                    			<li class="previous"><a href="#">Previous</a></li>
                                        <li class="next" id="next" style="display:none;"><a class="disabled"  href="#">Next</a></li>
                                <li class="next finish" id="finish" style="display:none;"><a href="#">Finish</a></li>
                               
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
            
    </div>
</div>    
<script src="<?php echo base_url()?>assets/js/chosen.jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    } 
    
    function currencyConverter(){
          $url = "<?php echo base_url(); ?>";
     from = $('#currency').val();
      amount=$('#price').val();
      to='USD';
        $.ajax({
            url: $url+"artist/audio/convert_currency",
            type: "post",
            data: {
                "to":to, 
                "amount":amount,
                "from":from,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            beforeSend: function(){
     $("#loading").show();
     $("#conversion_output").hide();
   },
   complete: function(){
     $("#loading").hide();
       $("#conversion_output").show();
   },
           success:function(response){  
          
                
                    $("#conversion_output").html(response);
                                        
                                                                               
            }
        });             
            
            }
    
    
    
    
</script>   

<script>                
    CKEDITOR.replace('lyrics',{
    extraPlugins:'wordcount',
    wordcount: {
       showParagraphs: false,
       showWordCount: false,
        showCharCount: true,
        countSpacesAsChars: false,
        countHTML: false,
        maxWordCount: -1,
         maxCharCount:1000,
    }
    });
</script>
<script>
    function do_disable(){
        
var availability=$('#availability').val();

if(availability=="6"){
    $('#price').val('0');
    $('#price').attr('disabled', 'disabled');
    $('#currency').attr('disabled', 'disabled');
   $('.avail-popup').show();
}
else {
     $('#price').removeAttr('disabled');
    $('#currency').removeAttr('disabled');
      $('.avail-popup').hide();
}
    }
    
    $(document).ready(function() {
        window.ParsleyValidator
                .addValidator('songname', function (value, requirement) {
                    var response = false;

                    $.ajax({
                        url: "<?php echo base_url();?>artist/audio/checkSongName",
                        data: {song_name: value,csrf_test_name:get_csrf_hash,},
                        dataType: 'json',
                        type: 'post',
                        async: false,
                        success: function(data) {
                            response = true;
                        },
                        error: function() {
                            response = false;
                        }
                    });

                    return response;
                }, 32)
                .addMessage('en', 'songname', 'This Song Name already exists.');

        $("form[name=step1]").parsley();

        $("form[name=step1]").on('submit', function(e) {
            var f = $(this);
            f.parsley().validate();

            
            e.preventDefault();
        });
    });    
</script>