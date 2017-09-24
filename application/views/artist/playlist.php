 
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/artists/managersong.js"></script>  
<style>
    .img-thumb{
            border: 2px solid #000;
            padding:4px;
    }
    .padding-20{
        padding-top:20px;
        padding-bottom: 20px;
    }
</style>
<div  style=" min-height: 100vh;padding-top:10px">
    <div class="container-fluid fix-amp">
	<div class="row">
	<?php
          include('inc_side_menu/menu_artist.php')
        ?> 
		<!-- Main Content -->
		<div class="container-fluid">
			<div class="side-body">
                <h2>Playlist</h2>
                <hr />
				<div class="">
					<div class="breadcrumb flat" style="    width: 100%">
						<a href="<?php echo base_url()?>artist/profile">Profile</a>
						<a class="active" href="#">Playlist</a>
					</div>
				</div>
              <?php   if(!empty($playlist)){ } else {
                                echo "<div class='alert alert-danger'>You Must First Create a Playlist to Upload Songs.</div>";
                            } ?>
                <a style="font-size: 1.2em;" href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#addplaylist"><span data-hover="New Playlist">Create New Playlist</span></a>
						
				<section class="tile" style="padding-top: 30px;">
                                    
					<div class="list-item full-width list-item-canhan col-md-10">
                                           
                            
                            <?php
                            foreach ($playlist as $row) {
                                
                                ?>
                               <div class="col-md-4 padding-20">
                        			<div class="e-item">
                        				                                             
                                                    <img width="90" height="90" src="<?php $src_img =$this->M_audio_song->get_cover_playlist_new($row['id']);
echo $this->M_audio_song->get_cover_playlist_path_new($row['id']).thumb($src_img, 300, 200); // outputs image_thumb.jpg  ?>"
alt="<?php echo $row['name']?>" class="img-responsive img-thumb" />
                                                                            
                        				<h3 class="title-item"> 
                                            <?php echo $row['name']?>
                                        </h3>
                                                    <a href="<?php echo base_url('artist/playlist').'/'.$row['id']?>" class="btn btn-primary">Upload Songs & Video</a>
                        				<p class="title-sd-item">
                                            <span class="txt-info"></span>
                                        </p>
                                        <p class="title-sd-item">
                                            <span class="txt-info">Num Songs: <?php echo $this->M_audio_song->get_total_songs($row['user_id'],$row['id']);?></span>
                                        </p>
                        			</div>
                        			<!-- END .e-item -->                                     
                        			<div class="item-tool"> 
                                        <input type="hidden" class ="id" value="<?php echo $row['id']?>"/>
										<input type="hidden" class ="user_id" value="<?php echo $row['user_id']?>"/>
										<input type="hidden" class ="name" value="<?php echo $row['name']?>"/>
                                        <input type="hidden" class ="desc" value="<?php echo $row['decs']?>"/>
                                        <input type="hidden" class ="genre" value="<?php echo $row['genre']?>"/>
                                        <input type="hidden" class ="image" value="<?php echo $row['image_file']?>"/>
                                       <?php if($row['attribute']=="1"){ ?> <a title="Edit playlist" href="#" data-toggle="modal" data-target="#editplaylist" data-playlist="<?php echo $row['id']?>" class="btn-edit btn-edit-playlist fa fa-2x fa-pencil-square-o"></a>                                         
                                        <a title="Warning, deleting this Playlist will remove the Playlist and all of its Songs. Additionally, it will remove the same Playlist/Songs & their lyrics from Lyric Manager, along with your Artist Music Player capability to download and sell your songs" class="btn-del fa fa-2x  fa-trash-o" href="#" data-playlist="<?php echo $row['id']?>" data-toggle="tooltip" data-placement="top"  ></a>                                     
                                       <?php } ?>
                                                </div>
                               </div>
                                <?php

                            }
                            
                             
                             
                           
                            ?>
                                            
                    		 
                    <!-- END .list-item -->
                    </div>
                                    <div class="col-md-3 col-md-offset-3">
                   <?php echo $this->pagination->create_links(); ?>
                                    </div>
				</section>
                <script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/artists/managersong_next.js"></script>
                
				<form id="form_delete"action="<?php echo base_url().'artist/deleteplaylist'?>" method="post" >
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden"  name="delete_id" class="delete_id"/>
				</form>
			</div>
		</div>
	</div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addplaylist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Create New Playlist</h4>
			</div>
			<form class="form form-signup MyUploadForm" role="form" action="<?php echo base_url().'artist/newplaylist'?>" onsubmit="return false" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
					<div class="form-group">
						<label class="form-input col-xs-4">Playlist Image*</label>
						<div class="input-group col-xs-6">
							<input type="file" class="form-control imageInput" name="image" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-xs-4">Playlist Name* </label>
						<div class="input-group col-xs-6">
							<input type="text" class="form-control" required="" name="playlist_name" placeholder="Enter the Name of the playlist"/>
						</div>
						<?php echo form_error('playlist_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
					</div>
					<div class="form-group">
						<label class="form-input col-xs-4">Genre</label>
						<div class="input-group col-xs-6">
							<select class="form-control " name="genre" >
                                <?php
                                    foreach ($genres as $row) {
                                        ?>
                                        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                        <?php

                                    }
                                ?>
							</select>
						</div>
						<?php echo form_error('genre', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
					</div>
                    <div class="form-group">
						<label class="form-input col-xs-4">Description</label>
						<div class="input-group col-xs-6">
                            <textarea rows="5" class="form-control" name="desc"></textarea>
						</div>
					</div>
                    <div class="progressbox" style="display:none;">
                        <div class="progressbar"></div>
                        <div class="statustxt">0%</div>
                    </div>
                    <div class="output"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="submit-btn btn btn-primary">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="editplaylist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Playlist</h4>
			</div>
			<form class="form form-signup MyUploadForm" role="form" action="<?php echo base_url().'artist/editplaylist'?>" onsubmit="return false;" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
					<div class="form-group">
						<label class="form-input col-xs-4">Image Cover</label>
						<div class="input-group col-xs-6">
							<input type="file" class="form-control imageInput1" name="image"  />
                                                        <input type="hidden" class="id form-control" name="id" id="id">
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-xs-4">Playlist Name </label>
						<div class="input-group col-xs-6">
                                                    <input type="text" class="name form-control" value="" name="playlist_name" id="playlist_name" placeholder="Enter the Name of the playlist" required />
						</div>
						<?php echo form_error('playlist_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
					</div>
					<div class="form-group">
						<label class="form-input col-xs-4">Genre</label>
						<div class="input-group col-xs-6">
                                                    <select class="form-control genre" name= "genre" id="genre">
                                <?php
                                    foreach ($genres as $row) {
                                        ?>
                                        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                        <?php

                                    }
                                ?>
							</select>
						</div>
						<?php echo form_error('genre', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
					</div>
                    <div class="form-group">
						<label class="form-input col-xs-4">Description</label>
						<div class="input-group col-xs-6">
                                                    <textarea rows="5" class="desc form-control" name="desc" id="desc"></textarea>
						</div>
					</div>
                    <div class="progressbox" style="display:none;">
                        <div class="progressbar"></div>
                        <div class="statustxt">0%</div>
                    </div>
                    <div class="output"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="submit-btn btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
    
    /* Edit Playlist */
$('.btn-edit').click(function (){
    
         $url = "<?php echo base_url(); ?>";
        id = $(this).attr("data-playlist");
      
        $.ajax({
            url: $url+"artist/audio/get_playlist",
            type: "post",
            data: {
                "id":id, 
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
           success:function(response){  
          
                
                    $.each(response,function(index, element){
       $("#id").val(element.id);
        $("#playlist_name").val(element.name);
         $("#genre").val(element.genre);
          $("#desc").val(element.decs);
          
      
    });
                                        
                                                                               
            }
        });             
                                     
    });  
    
    /* Delete Playlist */
    
$('.btn-del').click(function (){
    
         $url = "<?php echo base_url(); ?>";
        id = $(this).attr("data-playlist");
      if(confirm("Are you sure you want to delete this playlist and all of its songs?")){
        $.ajax({
            url: $url+"artist/audio/deleteplaylist",
            type: "post",
            data: {
                "delete_id":id, 
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
           success:function(response){  
          
                 if(response=="success"){ 
      setTimeout(function(){
           location.reload(); 
      }, 1000); 
   }
                
                                        
            }
        }); 
        } else {
        return false;
        }
                                     
    }); 

</script>
    