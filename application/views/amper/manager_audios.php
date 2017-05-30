<script src="<?=base_url()?>assets/js/jstree/jstree.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/amp/js/manager_audios.js"></script>
<script>
$(document).ready(function() {
    //$(" .modal-body").mCustomScrollbar();
    
    $(".action_del").click(function(e){
        //Change the dialog box
        var playListName = $(this).attr("p-name");
        if(!confirm('Confirm You Want to Delete the Playlist,'+' '+'" '+playListName+'."')){
           e.preventDefault(); 
        }
    });
    $(".edit_click").click(function(e){
       e.preventDefault();
       var id_playlist = $(this).attr("data-playlist");
       $.ajax({
            type: "POST",
            url: '<?=base_url()?>amper/get_data_playlist',
            dataType: "json",
            data: {
                'id_playlist' :id_playlist,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'        
            },
            success: function(response) {
                $("#playlist_name_edit").val(response.name);
                $("#description_edit").val(response.decs);
                $("#img_form_edit").attr("src","<?=base_url()?>uploads/"+response.user_id+"/img_playlist/"+response.image_file);
                $("#form_edit_id").val(id_playlist);
                $('#tree_edit').jstree({
                    'core' : {
                        'check_callback' : true,
                        'data' : {
                            "url" : "<?=base_url()?>amper/tree_json_edit/"+id_playlist,
                            "dataType" : "json", // needed only if you do not supply JSON headers
                            "cache":false
                        }
                    },
                    "checkbox": {
                        'visible': true,
                        'keep_selected_style': false
                    },
                    "plugins" : [ "wholerow", "checkbox" ]
                 });
            }
       });  
       
          
    });
    $('#frmt').jstree({
        'core' : {
            'data' : [
                <?php
                foreach ($tree_artist as $artist) {
                    $list_albums = $this->M_audio_song->get_data_playlist($artist);
                    if (!empty($artist)) {
                        ?>
                        {
                            "text" : "<?=$this->M_user->get_name($artist)?>",
                            "state" : { "opened" : true },
                            "children" : [
                            <?php
                            foreach ($list_albums as $albums) {
                                $songs = $this->M_audio_song->get_data_songs($albums['id']); ?>
                                {
                                    "text" : "<?=$albums['name']?>",
                                    "state" : { "opened" : true },
                                    "children" : [
                                    <?php
                                    foreach ($songs as $song) {
                                        if ($song['listened'] == 0) {
                                            $rating = 0;
                                        } else {
                                            $rating = $song['sales'] * 100 / $song['listened'];
                                        } ?>
                                        {
                                            "text" : "<?=$song['song_name'].'- Rating ('.$rating.'%)'?>",
                                            "state" : { "selected" : false },
                                            "icon" : "jstree-file",
                                            "id": "<?=$song['id']?>",
                                        },
                                        <?php

                                    } ?>
                                    ]  
                                },  
                                <?php

                            } ?> 
                            ]
                        },
                        <?php 
                    }
                }
                ?>
            ]
        },
        "plugins" : [ "wholerow", "checkbox","search" ]
    });
    var to = false;
    $('#plugins4_q').keyup(function () {
        if(to) { clearTimeout(to); }
        to = setTimeout(function () {
          var v = $('#plugins4_q').val();
          $('#frmt').jstree(true).search(v);
        }, 250);
    });
    $('#frmt').on('changed.jstree', function (e, data) {
        var i, j, r = [];
        for(i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        $.ajax({
            type: "POST",
            url: '<?=base_url('amper/load_changed_songs')?>',
            data: {
                'songs':   r,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'        
            },
            dataType: "text",
            success: function(response) {
                 $('#new-create').html(response); 
            }
        });    
    });
    $('#tree_edit').on('changed.jstree', function (e, data) {
        var i, j, r = [];
        for(i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        $.ajax({
            type: "POST",
            url: '<?=base_url('amper/load_changed_songs')?>',
            data: {
                'songs':   r,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'        
            },
            dataType: "text",
            success: function(response) {
                 $('#edit-update').html(response); 
            }
        });    
    });
});
</script>

<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />
<div class="container-fluid">
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;overflow: hidden;">
        <h4 class="tt text_caplock">My Playlist</h4>
        <span class="liner"></span>
        <div class="col-md-4 col-sm-4 panel-heading">
            <button class="button_new"  data-toggle="modal" data-target="#create_albums"><i class="fa fa-plus"></i> Create Custom Playlist</button>
        </div>
        <div class="row col-md-12 col-sm-12">
        
            <?php
            foreach ($my_playlist as $row) {
                $data_songs = $this->M_audio_song->get_songs_by_playlist_amp($row->id); ?>
                <div class="panel panel-default">
            		<div class="panel-heading">
            			<div class="panel-title ">
                            <div class="row col-md-10 col-sm-10">
                				<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$row->id?>">
                				<img height="50px" src="<?=$this->M_audio_song->get_cover_playlist_amp($row->id)?>"/> <span class="text-capitalize"><?=$row->name?></span>
                				</a>
                            </div>
                			<div class=" col-md-2 col-sm-2">
                                <a  href="#" data-toggle="modal" data-target="#edit_albums" data-playlist="<?=$row->id?>" class="edit_click">Edit</a>&nbsp;&nbsp;
                                <a class="action_del" p-name="<?=$row->name?>" href="<?=base_url('amper/delete_my_playlist/'.$row->id)?>" data-playlist="<?=$row->id?>" class="edit_click">Delete</a>
                            </div>
                        </div>
                        
            		</div>
                    
            		<div id="collapse<?=$row->id?>" class="panel-collapse collapse new_style_color" style="clear: both;">
            			<div class="panel-body">
                             <p > Description: <?=$row->decs?></p>	
                             <h5>List Audio</h5>
                             <ol>
                                 <?php
                                 foreach ($data_songs as $song) {
                                     if ($song['listened'] == 0) {
                                         $rating = 0;
                                     } else {
                                         $rating = $song['sales'] * 100 / $song['listened'];
                                     } ?>
                                    <li data-song="<?=$song['ID']?>"><b class="text-capitalize"><?=$song['song_name']?> </b> <small> by <?= $this->M_user->get_name($song['user_id'])?></small>- rating: (<?=$rating?>%) </li>
                                    <?php

                                 } ?>
                             </ol>
            			</div>
            		</div>
            	</div>
                <?php

            }
            ?>
            <?php echo $this->pagination->create_links();?>  
        </div>
        <!-- END SLIDER -->
    </section>
</div>
<div class="container-fluid">
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;">
        <h4 class="tt text_caplock">List Artist Audio</h4>
        <span class="liner"></span>
        <div class="row">
            <table class="table table-striped">
    			<thead>
    				<tr>
    					<th> Artist name</th>
    					<th> Level</th>
    					<th>Status</th>
    					<th>commision</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
                    foreach ($list_artists as $row) {
                        if ($row['level'] != 0) {
                            ?>
        				<tr>
        					<td> 
                                <a href="<?=base_url($this->M_user->get_home_page($row['artist_id']))?>">
                                    <img width="70px" src="<?=$this->M_user->get_avata($row['artist_id'])?>" />
                                    <?=$this->M_user->get_name($row['artist_id'])?>
                                </a>
                            </td>
        					<td> <?=$row['level']?></td>
        					<td>
        						<?php 
                                if ($row['status'] == 0) {
                                    echo 'Waiting for artist approval';//change Waiting Artist Allow to Waiting for Artist Allow
                                } elseif ($row['status'] == 1) {
                                    echo 'Ready';
                                } elseif ($row['status'] == 2) {
                                    echo 'Artist Canceled';
                                } ?> 
        					</td>
        					<td> <?=$this->M_affiliate->get_commission_by_level($row['artist_id'], $row['level'])?>% </td>
        				</tr>
        				<?php 
                        }
                    }
                    ?>
    			</tbody>
    		</table>
        </div>
        <!-- END SLIDER -->
    </section>
</div>

<!-- Modal create albums -->
<div class="modal fade new_modal_style" id="create_albums" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<form class="MyUploadForm" onsubmit="return false" action="<?php echo base_url().'amper/create_album'?>" method="post">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="tt">Create Custom Playlist</h4>
					<span class="liner"></span>
				</div>
				<div class="modal-body mCustomScrollbar _mCS_1">
					<div class="form-group">
						<label class="form-input">Playlist Name </label>
						<div class="input-group" style="width: 100%;">
							<input type="text" class="name form-control" required="" name="playlist_name" placeholder="Enter the Name of the playlist"/>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input" title="Playlist image becomes your album cover on AMP, so it's important to load a great image">Image Playlist </label>
                        <span style="font-size: smaller;">(Max Image Size 3072 kb)</span> 
						<div class="input-group" style="width: 100%;">
							<input type="file" class="form-control imageInput" name="image" required="" />
						</div>
					</div>
					<div class="progressbox" style="display:none;">
						<div class="progressbar"></div>
						<div class="statustxt">0%</div>
					</div>
					<div class="output"></div>
					<div class="form-group">
						<label class="form-input">Description</label>
						<div class="input-group" style="width: 100%;">
							<textarea rows="4"   class="form-control" name="decs"></textarea>
						</div>
					</div>
					<div class="form-group">
                        <input class="form-control"  type="text" id="plugins4_q" value="" placeholder="Search Name Song"  style="margin:0em auto 1em auto; padding:4px; border-radius:4px; border:1px solid silver;">
						<ul id="tree_playlist" class="droptree" >
							<div id="frmt" class="demo"></div>
						</ul>
						<ul id="new-create" class="droptrue">
						</ul>
					</div>
				</div>
				<div class="modal-footer searchform "  style="clear: both;"  >
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn submit-btn" >Create</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal edit albums -->
<div class="modal fade new_modal_style" id="edit_albums" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<form class="MyPlaylistEdit" action="<?php echo base_url().'amper/edit_album'?>" method="post">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="tt">Edit My Playlist</h4>
					<span class="liner"></span>
				</div>
				<div class="modal-body">
                    <div class="form-group">
                        <img height="70px" id="img_form_edit" src=""/>
                    </div>
					<div class="form-group">
						<label class="form-input">Playlist Name </label>
						<div class="input-group" style="width: 100%;">
                            <input type="hidden" name="id_playlist" id="form_edit_id" />
							<input type="text"  id="playlist_name_edit" class="name form-control" required="" name="playlist_name" placeholder="Enter the Name of the playlist"/>
						</div>
					</div>
					<div class="progressbox" style="display:none;">
						<div class="progressbar"></div>
						<div class="statustxt">0%</div>
					</div>
					<div class="output"></div>
					<div class="form-group">
						<label class="form-input">Description</label>
						<div class="input-group" style="width: 100%;">
							<textarea rows="4" id="description_edit" class="form-control" name="description"></textarea>
						</div>
					</div>
					<div class="form-group">
                        
						<ul id="tree_playlist" class="droptree" >
							<div id="tree_edit" class="demo"></div>
						</ul>
						<ul id="edit-update" class="droptrue">
						</ul>
					</div>
				</div>
				<div class="modal-footer searchform "  style="clear: both;"  >
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn" >Update</button>
				</div>
			</form>
		</div>
	</div>
</div>