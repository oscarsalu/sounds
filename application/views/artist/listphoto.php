
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
	if(percentComplete>50)
		{
			statustxt.css('color','#fff'); //change status text to white after 50%
		}
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
        if($('.imageInput1').val()){
           var inputfile = $('.imageInput1');
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
    		
    		//Allowed file size is less than 5 MB (5 242 880byte )
    		if(fsize>5242880 ) 
    		{
    			$(".output").html("<b>"+bytesToSize(fsize) +"</b> Too big photo file! <br />Please reduce the size of your image using an image editor.");
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
<div  style="min-height: 100vh;">
    <div class="container-fluid fix-amp">
    <div class="row" >
        <?php
          include('inc_side_menu/menu_artist.php')
        ?>
        <div class="side-body">
            <h2>Photo Manager</h2>
            <hr />
            <div class="breadcrumb flat" style="    width: 100%">
            	<a href="<?php echo base_url()?>artist/profile">Profile</a>
            	<a class="active" href="#">Photo Manager</a>
            </div>      
            <!-- tile -->
            <section class="tile" style="padding: 0px;">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h3 class="custom-font"><strong>Editable</strong> Photo</h3>
                    
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">
                    <a style="font-size: 1.2em;" href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#uploadphoto"><span data-hover="Upload New Photo">Upload New Photo</span></a>

                    <table class="table table-custom" id="editable-usage">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Caption</th>
                                <th style="width: 160px;" class="no-sort">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;
                                foreach ($listphoto as $row) {
                                    ?> 
                                <tr class="odd gradeX">
                                    <td>
                                        <img class="img-profile" height="70" src="<?php echo base_url(); ?>uploads/<?php echo $row->user_id; ?>/photo/<?php echo $row->filename; ?>" />
                                    </td>
                                    <td><?php echo $row->caption?></td>
                                    <td class="actions">
                                        <a href="#" title="edit" data-toggle="modal" data-target="#editphoto_md" data-id="<?php echo $row->id; ?>" class="edit editphoto text-primary text-uppercase text-strong text-sm mr-10 ">Edit</a>
                                        <a href="<?php echo base_url(); ?>artist/delete/<?php echo $row->id; ?>" class="delete text-danger text-uppercase text-strong text-sm delphoto">Remove</a>
                                    </td>
                                </tr>
                                <?php 
                            ++$i;
                                }
                                   
                            ?>
                            </tbody>
                        </table>
                    
                   <?php 
                   echo $this->pagination->create_links();?>

                </div>
                <!-- /tile body -->

            </section>                     
        </div>
    </div>
    </div>
</div>
<!-- Modal Photo-->
<div class="modal fade" id="uploadphoto" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Upload Photo</h4>
            </div>
            
<form class="form form-signup MyUploadForm" role="form" onsubmit="return false"  action="<?php echo base_url().'artist/newphoto'?>" method="post" enctype="multipart/form-data" id="photoUpload">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                   <div class="form-group">
                        <label class="form-input col-md-4">Choose a Photo File</label>
                        <div class="input-group col-md-6">
                            <input type="file" class="form-control imageInput" name="photo" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-4">Add Caption *</label>
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control " name="caption" placeholder="Enter the caption of the photo" required />
                        </div>
                        <?php echo form_error('caption', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>                    
                    <div class="form-group">
                        <input type="checkbox" class="form-input" name="check"  required/>
                        I own or have licensed all rights to use this photo.
                        <a href="#" data-toggle="tooltip" data-placement="right" title="about"></a>
                        <?php echo form_error('check', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>
                    <div class="progressbox" style="display:none;">
                        <div class="progressbar"></div>
                        <div class="statustxt">0%</div>
                    </div>
                    <div class="output"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="Upload" class="btn submit-btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editphoto_md" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Edit Photo</h4>
            </div>
            <form class="form form-signup" id="update_pt" role="form" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                  <div class="form-group">                       
                        <div class="col-md-12">
                            <img id="img_t" src="" width="535" height="250" class="img-profile-edit"/>
                        
                        
                        </div>
                      <div class="form-group">
                        <label class="form-input col-md-4">Choose a Photo File</label>
                        <div class="input-group col-md-6">
                            <input type="file" class="form-control imageInput" name="photo" id="imageInput" >
                            <input type="hidden" name="image" id="image" value="">
                        </div>
                    </div>
                      
                    </div>
                    <div class="form-group" style="margin-left:15px">
                        <label class="" style="margin-top: 20px;">Add Caption:</label>
                        <div class="input-save-modal">
                            <input type="text" class="form-control" id="cap_js" name="caption" value="" placeholder="Enter the caption of the photo"/>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-save-modal">Save</button>
                        </div>
                        <?php echo form_error('caption', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>                    
                    <input type="hidden" name="id_photo" value=""/>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function() {
        $('.editphoto').on('click', function (){
            var url = '<?php echo base_url()?>';
            var current = $(this);
            var id_photo = current.attr('data-id');
            var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
            $.ajax({             
                url: url+'artist/load_data_photo',
                type: "post",
                data: { 
                    'id_photo' : id_photo,
                    'csrf_test_name':get_csrf_hash
                },
                dataType: "json",               
                success:function(response){ 
                    $('#img_t').attr('src',url+'uploads/'+response.user_id+'/photo/'+response.filename);
                    $('#cap_js').val(response.caption);
                    $('#image').val(response.filename);
                    $('#update_pt').attr('action',url+'artist/updatephoto/'+response.id);
                },
            }); 
            
        });
        $('#photopanel').on('click','.delphoto', function (){
            if(confirm("Are you sure you want to delete this record?")){
                return true;
            }else{
                return false;
            }
            
        })
    })    
    
    function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#update_pt + img').remove();
            $("#img_t").attr("src", e.target.result);
          
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageInput").change(function () {
    filePreview(this);
});
</script>