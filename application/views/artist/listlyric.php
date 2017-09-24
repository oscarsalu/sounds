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
                            <div class="description-playist pull-right" >
                                <p class="text-justify">
                                   <?php ///echo $data_playlist['decs'];?> 
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
						<a style="font-size: 1.2em;" href="<?=base_url('artist/playlist/new_song/'.$data_playlist['id'])?>" class="link-effect link-effect-2"><span data-hover="Upload New Song">Upload New Song</span></a>
						
                                                <div class="table-responsive" id="songtable">
							<table class="table table-custom" id="editable-usage">
								<thead>
									<tr>
										<th class="col-md-2">TITLE</th>
										
										<th class="no-sort">Actions</th>
                                                                                <th class="no-sort">Date Lyric Entered</th>
									</tr>
								</thead>
								<tbody>
									<?php 
                                               $listsong=array_filter($listsong);    
                                               if(!empty($listsong)){
                                    foreach ($listsong as $row) {
                                        ?>

									<tr class="odd gradeX">
										<td>
											<?php echo $row['song_name']?>
										</td>
                                                                             
                                                                                

                                                                                   <td class="actions">
											<a href="<?=base_url('artist/edit_lyric/'.$data_playlist['id'].'/'.$row['id'])?>" title="edit"  class="text-uppercase ">Add/Edit Lyrics</a>
											
										</td>
                                                                             
                                                                                <td><?php if($row['date_lyrics_add']!=""){ echo $row['date_lyrics_add'];} else { echo "N/A"; }?></td> 
                                                                                  
                                                                        </tr>                                                                          
                                                                             <?php }   } ?>
                                                                                
                                                                             
                                        
                                        
                                       
										
                                                                                
									
                                                                </tbody>
                                                        </table>
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