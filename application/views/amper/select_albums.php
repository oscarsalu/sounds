<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
<link rel="stylesheet" href="<?=base_url()?>assets/js/jstree/themes/default/style.min.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?=base_url()?>assets/js/jstree/jstree.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
    
	var progressbox     = $('.progressbox');
	var progressbar     = $('.progressbar');
	var statustxt       = $('.statustxt');
	var completed       = '0%';
	
	var options = { 
			target:   '.output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			uploadProgress: OnProgress,
			success:       afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('.MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// return false to prevent standard browser submit and page navigation 
			return false; 
		});
	
//when upload progresses	
function OnProgress(event, position, total, percentComplete)
{
    if(percentComplete>99){
        percentComplete =99;
    }
	//Progress bar
	progressbar.width(percentComplete + '%') //update progressbar percent complete
	statustxt.html(percentComplete + '%'); //update status text
	
}

//after succesful upload
function afterSuccess()
{
	$('.submit-btn').show(); //hide submit button
	$('.loading-img').hide(); //hide submit button
    location.reload();

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
        if($('.imageInput').val()){
	       var inputfile = $('.imageInput');
	    }
		if(inputfile.val()) //check empty input filed
		{ 
			var fsize = inputfile[0].files[0].size; //get file size
    		var ftype = inputfile[0].files[0].type; // get file type
    		
    		//allow only valid image file types 
    		switch(ftype)
            {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                    break;
                default:
                    $(".output").html("<b>"+ftype+"</b> Unsupported file type!");
    				return false
            }
    		
    		//Allowed file size is less than 2 MB (2 097 152 byte )
    		if(fsize>2097152 ) 
    		{
    			$(".output").html("<b>"+bytesToSize(fsize) +"</b> Too big video file! <br />Please reduce the size of your image using an image editor.");
    			return false
    		}
    		
    		//Progress bar
    		progressbox.show(); //show progressbar
    		progressbar.width(completed); //initial value 0% of progressbar
    		statustxt.html(completed); //set status text
    		statustxt.css('color','#000'); //initial color of status text
    
    				
    		$('.submit-btn').hide(); //hide submit button
    		$('.loading-img').show(); //hide submit button
    		$(".output").html(""); 
		}else{
		  return true;
		}
		
		 
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$(".output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 
</script>
<script>
  $(function() {
    $( "ul.droptrue" ).sortable({
      connectWith: "ul"
    });
    $( "ul.dropfalse" ).sortable({
      connectWith: "ul",
      dropOnEmpty: true,
      cancel: ".ui-state-disabled"
    });
    $( "#sortable1, #sortable2" ).disableSelection();
    $("#next_btn").click(function(e){
		e.preventDefault();  
        res_albums = [];
        $("#sortable2 li").each(function(index, value){
            id = $(value).attr('data-album');
            res_albums.push(id);
        });
        $("#input_list_albums").val(res_albums); 
        $("#form_alb").submit();
   });
    $('#frmt').jstree({
        'core' : {
            'data' : [
                <?php
                foreach ($list_artist as $artist) {
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
                                        ?>
                                        {
                                            "text" : "<?=$song['song_name']?>",
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
        "plugins" : [ "wholerow", "checkbox" ]
    });
    $('#frmt').on('changed.jstree', function (e, data) {
        var i, j, r = [];
        for(i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        load_changed_songs(r);
    });
});
function load_changed_songs(r){
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
}  
    
</script>
<link href="<?php echo base_url(); ?>assets/amp/css/select_albums.css" rel="stylesheet" />
<div class="container-fluid" style="min-height: 100vh;" >
    <div class="row">
       
        <div class="">
            <h2>Albums</h2>
            
            <ul id="sortable1" class="droptrue">
              <?php
              foreach ($list_artist as $artist) {
                  $list_albums = $this->M_audio_song->get_data_playlist($artist);
                  foreach ($list_albums as $album) {
                      ?>
                        <li class="ui-state-default " data-album="<?=$album['id']?>"> 
                            <img width="13%" src="<?=$this->M_audio_song->get_cover_playlist($album['id'])?>" />
                            <span class="text-capitalize"><?=$album['name']?> </span> 
                            <span class="text-info">by (<?=$this->M_user->get_name($album['user_id'])?>)</span> 
                        </li>
                        <?php

                  }
              }
              ?>
            </ul>
             
            <ul id="sortable2" class="dropfalse">
                <button class="btn btn-primary"  data-toggle="modal" data-target="#create_albums"><i class="fa fa-plus"></i> Create Custom Playlist</button>
                <?php
                foreach ($my_albums as $album) {
                    ?>
                    <li class="ui-state-default ui-state-disabled " data-album="<?=$album['id']?>" > 
                        <img width="13%" src="<?=$this->M_audio_song->get_cover_playlist_amp($album['id'])?>" />
                        <span class="text-capitalize"><?=$album['name']?> </span> 
                    </li>
                    <?php

                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div style="width: 50px; margin: 0 auto;">
        <form id="form_alb" action="<?=base_url('amper/create_album_finish')?>" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input id="input_list_albums" name="playlits" type="hidden" value="" />
            <input name="affiliateId" type="hidden" value="<?=$parent_affiliate->affiliate_id?>" />
        </form>
        <button class="btn btn-primary" id="next_btn" type="submit">Finish</button>
    </div>
    
    
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
                <div class="modal-body">
                    <div class="form-group">
						<label class="form-input">Playlist Name </label>
						<div class="input-group" style="width: 100%;">
							<input type="text" class="name form-control" required="" name="playlist_name" placeholder="Enter the Name of the playlist"/>
						</div>
					</div>
                    <div class="form-group">
						<label class="form-input">Playlist Image</label>
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
                            <textarea rows="4"  class="form-control" name="decs"></textarea>
						</div>
					</div>
                    <div class="form-group">
                        <ul id="tree_playlist" class="droptree" >
                             <div id="frmt" class="demo"></div>
                        </ul>
                        <ul id="new-create">
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