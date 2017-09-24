<script>var base_url="<?php echo base_url();?>"</script>


<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<!--<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/bootstrap-slider.min.css" rel="stylesheet" media="screen" type="text/css" />
<script src="<?php echo base_url()?>assets/js/bootstrap-slider.min.js"></script>-->
<script src="<?php echo base_url();?>assets/amp/js/jquery.min.js"></script>
<!--<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/amp/js/jquery.jplayer.min.js"></script>
<link href="<?=base_url('assets/amp/css/jplayer.pink.flag.css')?>" rel="stylesheet" type="text/css" />
<style>
.slider-selection {
	background: blue;
}
.span-avai{
    border: 1px solid #6B6B6B;
    margin: 2px;
    padding: 2px;
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
}
.play_track{
    border: 1px solid #6B6B6B;
    margin: 2px;
    padding: 2px;
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
}
.play_track_full{
    background: #bababa;
}
.slider.slider-horizontal{
	width: 100%;
}
</style>
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
						<a href="<?php echo base_url()?>artist/managersong">Playlist →Song Manager</a>
                        <a class="active" href="#">Playlist</a>
					</div>
				</div>
				<!-- tile -->
				<section class="tile" style="padding: 0px;">
                    
					<!-- tile header -->
					<div class="tile-header ">
						<h2> <?php echo $data_playlist['name']?></h2>
                        <div class="intro-playlist">
                            <img width="150" src="<?php echo $this->M_audio_song->get_cover_playlist($data_playlist['id'])?>" class="img-responsive " style="margin-right: 5px ;" />
                            <div class="description-playist" >
                                <p class="text-justify">
                                   <?php echo $data_playlist['decs'];?> 
                                </p>
                            </div>
                        </div> 
					</div>
                   
					<!-- /tile header -->
					<!-- tile body -->
                                        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="option_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong>Option Updated!
        </div>
					<div class="tile-body">
						<a style="font-size: 1.2em;" href="<?=base_url('artist/playlist/new_song/'.$data_playlist['id'])?>" class="link-effect link-effect-2"><span data-hover="Upload New Song & Video">Upload New Song & Video</span></a>
						
                                                <div class="table-responsive" id="songtable">
							<table class="table table-custom" id="editable-usage">
								<thead>
									<tr>
										<th class="col-md-2">TITLE</th>
										<th>Play Audio Demo</th>
                                                                                <th>Play Video Demo</th>
                                        <th>Price</th>
                                        <th>Availability</th>
										<th class="no-sort">Actions</th>
                                                                                <th>Options Demo</th>
									</tr>
								</thead>
								<tbody>
									<?php 
                                               $listsong=array_filter($listsong);    
                                               if(!empty($listsong)){
                                    foreach ($listsong as $row) {
                                        if($row['audio_file1']!=""){
                                        $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file1'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file1'];
                                        } else if($row['audio_file2']!=""){
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file2'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file2'];
                                        }
                                        else if($row['audio_file3']!=""){
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file3'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file3'];
                                        }
                                        else if($row['audio_file4']!=""){
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file4'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file4'];
                                        }
                                        else {
                                             $file_format=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file5'], PATHINFO_EXTENSION);
                                        $file_url= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['audio_file5'];
                                        }
                                        if($row['video_file1']!=""){
                                        $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file1'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file1'];
                                        } else if($row['video_file2']!=""){
                                             $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file2'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file2'];
                                        }
                                        else {
                                             $file_format_video=pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file3'], PATHINFO_EXTENSION);
                                        $file_url_video= 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file3'];
                                        } ?>
                                                                    
                                                                    <script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

	$("#jquery_jplayer_<?php echo $row['id'];?>").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				title: "<?php echo $row['song_name']."-".$data_playlist['name'];?>",
				<?php echo $file_format; ?>: "<?php echo $file_url;?>",
				
			});
		},
		swfPath: "<?php echo FCPATH."assets/amp";?>",
		supplied: "<?php echo $file_format; ?>",
                cssSelectorAncestor: "#jp_container_<?php echo $row['id'];?>",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		remainingDuration: true,
		toggleDuration: true
	});
});
//]]>
</script>
									<tr class="odd gradeX">
										<td>
											<?php echo $row['song_name']?>
										</td>
                  <td>                                                                 
              <?php if($row['audio_file1']!="" or $row['audio_file2']!="" or $row['audio_file3']!="" or $row['audio_file4']!="" or $row['audio_file5']!="") { ?>                                                                   
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_Audio<?php echo $row['id'];?>">
  Launch Audio Demo
</button>
              <?php } ?>
  <style>
    #myModal<?php echo $row['id'];?> .modal-content,#myModal_Audio<?php echo $row['id'];?> .modal-content {
    display: inline-block;
    text-align: center;   
}
 #myModal<?php echo $row['id'];?> .modal-body,#myModal_Audio<?php echo $row['id'];?> .modal-body{
    padding:0;
}
 #myModal<?php echo $row['id'];?> .close,#myModal_Audio<?php echo $row['id'];?> .close {
    opacity: 1;
    color: rgb(255, 255, 255);
    background-color: rgb(25, 25, 25);
    padding: 5px 8px;
    border-radius: 30px;
    border: 2px solid rgb(255, 255, 255);
    position: absolute;
    top: -15px;
    right: -55px;
    
    z-index:1032;
}
</style>
<!-- Modal -->
<div class="modal fade" id="myModal_Audio<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
    
      <div class="modal-body">
          
          <div id="jquery_jplayer_<?php echo $row['id'];?>" class="jp-jplayer" style="height:360px !important; "></div>
<div id="jp_container_<?php echo $row['id'];?>" class="jp-audio" role="application" aria-label="media player">
	<div class="jp-type-single">
		<div class="jp-gui jp-interface">
			<div class="jp-volume-controls">
				<button class="jp-mute" role="button" tabindex="0">mute</button>
				<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
			</div>
			<div class="jp-controls-holder">
				<div class="jp-controls">
					<button class="jp-play" role="button" tabindex="0">play</button>
					<button class="jp-stop" role="button" tabindex="0">stop</button>
				</div>
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-toggles">
					<button class="jp-repeat" role="button" tabindex="0">repeat</button>
				</div>
			</div>
		</div>
		<div class="jp-details">
			<div class="jp-title" aria-label="title">&nbsp;</div>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>
      </div>
     
      
    </div>
  </div>
</div>
                                                                                      
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                   
										</td>
                                                                                <td>
                                   <?php if($row['video_file1']!="" or $row['video_file2']!="" or $row['video_file3']!="") { ?>                                                       
                                                                                   <!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['id'];?>">
  Launch Video Demo
</button>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      <div class="modal-body">
          <iframe style="border-width:0px;" width="495" height="382" src="<?php echo base_url();?>artist/audio/get_video_song_by_id/<?php echo $row['id'];?>/<?php echo $row['album_id'];?>"></iframe>
      </div>
      
    </div>
  </div>
</div>
                                                                                   
                                                                             
                                                                                    
                                                                                  
</div>
                                                                             <?php } ?>
                                                                                
                                                                                </td>
                                        <td><?php echo $row['price'].$row['currency']?></td>
                                        <td><?php 
                                            $array_avai = explode(',', $row['availability']);
                                        foreach ($array_avai as $avai) {
                                            if ($avai == 1) {
                                                echo '<span class="span-avai">Artist Music Player</span>';
                                            } elseif ($avai == 2) {
                                                echo '<span class="span-avai">Download Only</span>';
                                            } elseif ($avai == 3) {
                                                echo '<span class="span-avai">Electronic Press kit</span>';
                                            } elseif ($avai == 4) {
                                                echo '<span class="span-avai">AMP/ALP Stream</span>';
                                            } elseif ($avai == 5) {
                                                echo '<span class="span-avai">99sound Stream</span>';
                                            } elseif ($avai == 6) {
                                                echo '<span class="span-avai">Hiden</span>';
                                            }
                                            if (end($array_avai) != $avai) {
                                                echo '-';
                                            }
                                        } ?>
                                        
                                        </td>
										<td class="actions">
											<a href="<?=base_url('artist/edit_song/'.$data_playlist['id'].'/'.$row['id'])?>" title="edit"  class="text-uppercase ">Edit</a>
											<a id="id_delete" href="#" data-song="<?=$row['id']?>" data-playlist="<?php echo $data_playlist['id'];?>" class="text-danger btn-del text-uppercase">Remove</a>
										</td>
                                                                                <td><select class="form-control option-type" id="option_type" name="option_type"  data-id="<?php echo $row['id'];?>">
                                                                                                <option value="">--Select--</option>
                                                                                                <option value="1" <?php if($row['option_type']==1){ echo "selected"; }?>>Audio</option>
                                                                                                <?php /*if($row['video_file1']!="" or $row['video_file2']!=""  or $row['video_file3']!="" or  $row['video_file4']!="" ) { */?>
                                                                                                <option value="2" <?php if($row['option_type']==2){ echo "selected"; }?>>Video</option>
                                                                                                <?php /* } */?>
                                                                                    </select>
                                                                                           </td>
									</tr>
									<?php 
                                    }
                                            } 
                                    
                                    ?>
								</tbody>
							</table>
                                                    <div id="mp3_play"></div>
                           
                    
                            <div id="video"></div>
                                                    <?php $listsong=array_filter($listsong); 
                                                 //   var_dump($listsong);
                                                
                                              /* if(!empty($listsong)){ if( $row['video_file1']!="" or $row['video_file2']!="" or $row['video_file3']!=""){ */ ?>
                            
                            
                             <script>
                               /* jwplayer("video").setup({
        							aspectratio: "16:9",
                                                                stretching: 'fill',
    								width: "100%",
    								autostart :false,
                                                                <?php if( $row['video_file1']!="" ) { ?>
                                    file: "<?='https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file1']?>"
                                                                <?php } else if( $row['video_file2']!="" ) {?>
                                                                    
                                                                    file: "<?='https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file2']?>"
                                                                <?php } else { ?>
                                                                    file: "<?='https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['video_file3']?>"
                                                                <?php } ?>
                                });*/
                                function playTrailer(file_format,file_url) { 
                                 
                                      $("#mp3_play").jPlayer( {
      ready: function() { // The $.jPlayer.event.ready event
          
        $(this).jPlayer("setMedia", { // Set the media
          
        file_format:file_url,
        }).jPlayer("play"); // Attempt to auto play the media
      },
      ended: function() { // The $.jPlayer.event.ended event
        $(this).jPlayer("play"); // Repeat the media
      },
      supplied: file_format
  });
     
   
   
                              
                          }

$(document). on('change','.option-type',function (){ 
  
     id=$(this).attr("data-id");
     option_type=$(this).val();
                                $.ajax({ url: '<?php echo base_url();?>artist/audio/change_option_type',
         data: {id:id,option_type:option_type,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
         type: 'post',
         success: function(output) {
                   $('#option_suc').css('display','block'); 
                  }
});
});                           
							</script>
                                               <?php // } 
                                               
                                              // } ?>
                                                        <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/amp/js/jquery.jplayer.js')?>"></script>
<script type="text/javascript">
                                 /*jwplayer("mp3_play").setup({
        							height: 30,
    								width: "100%",
    								autostart :false,
                                    file: "<?='https://d1oc632jh12ao7.cloudfront.net/uploads/'.$user_data['id'].'/audio/'.$row['filename']?>"
                                    
                                }); */
                               /* function playTrailer(file_url) { 
                                  jwplayer().load([{
                                    file: file_url
                                  }]);
                                  jwplayer().play();
                                } */
							</script>
                                        
						</div>
					</div>
					<!-- /tile body -->
				</section>
				<form id="form_delete" action="<?php echo base_url().'artist/deletesong'?>" method="post" >
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden"  name="delete_id" id="delete_id"/>
                    <input type="hidden"  name="playlist" value="<?php echo $data_playlist['id']?>"/>
					<input type="hidden"  name="filename" id="filename"/>
				</form>
				<script>
					$(document).ready(function() {
					   $(".btn-edit").click(function(){
					       var id_song = $(this).attr('data-song');
                           $.ajax({
                             type: "POST",
                             url:  "<?=base_url('artist/call_ajax_data_song')?>",
                             data: {
                                'id': id_song,
                                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'                    
                             },
                             dataType: "json",
                             success: function(data) {
                                put_input(data);
                                $('#editModal').modal('show')
                             },
                             error   : function(){
                                alert('Request failed!');
                             }
                             });    
					   });
                       $(".btn-del").click(function(){
					       var id_song = $(this).attr('data-song');
                                               var playlist=$(this).attr('data-playlist');
                                                if(confirm("Are you sure you want to delete this record?")){
    					               $.ajax({
                             type: "POST",
                             url:  "<?=base_url('artist/deletesong')?>",
                             data: {
                                'delete_id': id_song,
                                'playlist':playlist,
                                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'                    
                             },
                             dataType: "json",
                             success: function(data) {
                                
                               
                               location.reload();
                             },
                             error   : function(){
                                alert('Request failed!');
                             }
                             });  
    					        } else
                                                return false;
                          
					   });
					   function put_input (data){
					        $(".MyUploadForm").resetForm();
                            $(".slider ").remove();
                            var end = parseInt(data.time_duration) + parseInt(data.time_start);
                            new Slider("#ex5", { 
                                value: [parseInt(data.time_start), parseInt(end)],
                                max: parseInt(data.time_total)
                             });
                            $("#ex5").val(data.time_start+','+data.time_duration);
                            
                            $("#duration_time").show();
					        $('#id').val(data.id);
					        $('#song_name').val(data.song_name);
					        $('#link_youtube').val(data.youtube_link);
					        $('#lyrics').html(data.lyrics);
					        $('#file_name').val(data.filename);
                            $('#price').val(data.price);
                            $("#availability option:selected").prop("selected", false);
                            $.each(data.availability.split(","), function(i,e){
                                $("#availability option[value='" + e + "']").prop("selected", true);
                            });
                            $('#availability').trigger("chosen:updated");
					   }
                        $(".imageInput1").change(function(){ 
                            
                            if($(this).val()){
                                $("#duration_time").hide();
                            }else{
                                $("#duration_time").show();
                            }
                        });
					}) 
				</script>
			</div>
		</div>
	</div>
</div>

<div id="modal_">
<!-- Modal -->
<div class="modal fade" id="uploadsong" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload Song</h4>
			</div>  
			<form class="form form-signup MyUploadForm" onsubmit="return false" action="<?=base_url().'artist/uploadnew_song'?>" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">					
                     <div class="form-group">
						<label class="form-input col-xs-4">Choose a Song File</label>
						<div class="input-group col-xs-6">
							<input type="file" class="form-control imageInput" name="song" required=""/>
                            <input type="hidden" id="idplaylist" name="id_playlist" value="<?php echo $data_playlist['id']?>" />
						</div>
					</div>
                    
                    <div class="progressbox" style="display:none;">
                        <div class="progressbar"></div>
                        <div class="statustxt">0%</div>
                    </div>
                    <div class="output"></div>                  
                 
					<div class="form-group">
						<label class="form-input col-xs-4">Song Name *</label>
						<div class="input-group col-xs-6">
							<input type="text" class="form-control" id="song_n" name="song_name"  required="" placeholder="Enter the name of the song"/>
						</div>
						<?php echo form_error('song_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
					</div>
					<div class="form-group">
						<label class="form-input col-xs-4">Availability *</label>
						<div class="input-group col-xs-6"> 
							<select class="chosen-select form-control "  multiple="multiple"  id="editar-element-6" data-placeholder="Choose availability..." id="availa" name="availability[]" >
								<option value="1">Artist Music Player</option>
								<option value="2">Download Only</option>
								<option value="3">Electronic Press Kit</option>
								<option value="4" selected=""> AMP/ALP Streaming</option>
								<option value="5">99Sound Streaming</option>
								<option value="6">Hidden</option>
							</select>
						</div>
						<?php echo form_error('availability', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
					</div>
                    <div class="form-group">
						<label class="form-input col-xs-4">Price/Song</label>
						<div class="input-group col-xs-3 pull-left">
							<input type="number" class="form-control" id="price_" name="price" min="0.00" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                            title="This should be a number with up to 2 decimal places." value="0"/>
                            <span class="input-group-addon">$</span>
						</div>
					</div>
					<div class="form-group">
						<div class="checkbox" style="padding: 15px;">
							<label>
							<input type="checkbox" required=""/> I own or have licensed all rights to use this song. <a href="#" data-toggle="tooltip" data-placement="right" title="about">??</a>
							</label>
						</div>
						<?php echo form_error('check', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
					</div>                    
                    
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="submit-btn btn btn-primary" >Upload</button>
				</div>
			</form>  
		</div>
	</div>
</div>
<!--modal edit-->
<div display="none" class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> Edit Song</h4>
			</div>
			<div class="modal-body">                
				<form class="form form-signup " action="<?=base_url().'artist/editsong'?>" method="post" enctype="multipart/form-data">                    
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    
                    <div class="progressbox" style="display:none;">
                        <div class="progressbar"></div>
                        <div class="statustxt">0%</div>
                    </div>
                    <div class="output"></div>                  
                    <div class="form-group" >
						<label class="col-xs-4 control-input">MP3 File</label>
						<div class="col-xs-6 input-group">
							<input type="file" class="form-control imageInput1" name="song" />
						</div>
					</div>
                    <div class="form-group" id="duration_time">
                        <label class="col-xs-4 form-input">Duration Play</label>
                        <div class="input-group col-xs-6">
                            <input id="ex5" name="duration_play" type="text" class="form-control " value="" data-slider-handle="triangle" data-slider-max="1000" data-slider-step="1" data-slider-value="[120,780]"/>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-xs-4 control-input">Song name <i class="fa fa-asterisk" style="font-size:8px;vertical-align: super;"></i></label>
						<div class="col-xs-6 input-group">
							<input type="hidden" size="10" name="id" id="id" class="form-control">
							<input type="text" size="10" name="song_name" id="song_name" class="form-control">
						</div>
					</div>						
					<div class="form-group" >
						<label class="col-xs-4 control-input">Availability <i class="fa fa-asterisk" style="font-size:8px;vertical-align: super;"></i></label>
						<div class="col-xs-6 input-group">
						     <select class="chosen-select form-control "  multiple="multiple"  id="availability" data-placeholder="Choose availability..." name="availability[]" >
								<option value="1">Artist Music Player</option>
								<option value="2">Download Only</option>
								<option value="3">Electronic Press Kit</option>
								<option value="4" > AMP/ALP Streaming</option>
								<option value="5">99Sound Streaming</option>
								<option value="6">Hidden</option>
							</select>
						</div>
					</div>
                    <div class="form-group" >
						<label class="col-xs-4 control-input">Price/Song</label>
                        <div class=" col-xs-6 input-group">
                            <input type="number" class="form-control" name="price" id="price" min="0.00" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                            title="This should be a number with up to 2 decimal places." />
                            <span class="input-group-addon">$</span>
                        </div>
					</div>
                    <div class="form-group">
						<label class="col-xs-4 control-input">Lyrics</label>
						<div class="col-xs-6 input-group">
							<textarea class="form-control" id="lyrics" name="lyrics" id="lyric_" rows="5"> </textarea>
						</div>
					</div>
			     </div>
    			<div class="modal-footer">
        			<button type="button" class="btn btn-link ok-smt-btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        			<button type="submit" class="submit-btn btn btn btn-primary" id="update_song" >Save</button>
    			</div>
			</form>
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
    
              
</script>
</script> 