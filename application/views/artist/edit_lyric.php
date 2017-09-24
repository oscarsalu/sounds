<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/bootstrap-slider.min.css" rel="stylesheet" media="screen" type="text/css" />
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script src="<?php echo base_url()?>assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url()?>assets/js/parsley.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<script>
var load_duration     ='<?=base_url('artist/load_duration')?>';
var get_csrf_hash     ='<?php echo $this->security->get_csrf_hash(); ?>';
var finish_edit_song  ='<?=base_url('artist/finish_edit_song')?>';
var delete_file_video ='<?=base_url('artist/delete_file_video')?>';
var $playlist_id      ='<?=$playlist_id?>';
var $data_song        ='<?=$data_song->id?>';
var playlist_id ="<?=base_url('artist/playlist/'.$playlist_id)?>";

</script>
<style>
    .slider .tooltip-inner {
   font-size:20px;
}
</style>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/edit_song.js"></script>
<link href="<?php echo base_url(); ?>assets/artists/css/edit_song.css" rel="stylesheet">

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
						<a href="<?php echo base_url()?>artist/managersong">Playlist->Song Manager</a>
						<a href="<?php echo base_url()?>artist/lyricmanager">Lyrics</a>
                        <a  href="<?= base_url('artist/lyriclist/'.$playlist_id)?>">List Lyrics</a>
                         <a class="active" href="#">Upload Lyrics: <?php echo $data_song->song_name;?></a>
					</div>
				</div>
				<!-- tile -->
				<section class="tile" style="padding: 0px;">
                                    
                                    <form class="form-horizontal" action="<?php echo base_url();?>artist/update_lyrics" method="post">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                        <input type="hidden" name="id_song" value="<?php echo $song_id;?>">
                                        <input type="hidden" name="playlist_id" value="<?php echo $playlist_id;?>">
                                        <div class="form-group">
                		<div class="col-sm-12  col-md-12">
                                        
                                            
                                    <textarea class="form-control" name="lyrics" rows="7" id="lyrics"><?php echo $data_song->lyrics;?></textarea>
                                        </div>
                                            </div>
                                        <div class="form-group">
                		<div class="col-md-offset-10 col-md-2">
                			<button type="submit" class="btn btn-primary">Save</button>
                		</div>
                	</div>
                                    </form>
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

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
<script>                
    CKEDITOR.replace('lyrics');
</script>