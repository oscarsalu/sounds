$(document).ready(function() {
	    $('#video-item').on('click','tr td .btn-edit', function (){
	        var parent = $(this).parent();
	        var id = parent.find('.id').val();
	        var user_id =  parent.find('.user_id').val();
	        var name_video= parent.find('.name_video').val();
	        var link_video = parent.find('.link_video').val();
            var id_link = parent.find('.id_link').val();
	         $('#id').val(id);
            $('#name_video').val(name_video);
            $('#link_video').html(link_video);
            $('#link_video').attr("href", link_video);
            $('#video_id').attr("src", 'http://img.youtube.com/vi/'+id_link+'/hqdefault.jpg');
	    });
         $('#video-item').on('click','tr td .btn-edit-file', function (){
	        var parent = $(this).parent();
	        var id = parent.find('.id').val(); 
	        var user_id =  parent.find('.user_id').val();
	        var name_video= parent.find('.name_video').val();
            var cover_image = parent.find('.cover_image').val();
	         $('#editvideo .id').val(id);
            $('#editvideo .name_video').val(name_video);
            
            $('#fileVideo').attr("src", link_base+'uploads/'+user_id+'/video/'+cover_image);
	    });
	    $('#video-item').on('click','tr td .btn-del', function (){
	        if(confirm("Are you sure you want to delete this record?")){
	            var parent = $(this).parent();
	            var id = parent.find('.id').val();
	            var filename = parent.find('.filename').val();
	            $('#form_delete .delete_id').val(id); 
                $('#form_delete').submit();
	        }
	        
	    });
        //videos upload new
        $(".router-type input[name=router-type]").click(function(e){
            var value =  $(this).val();
            if(value=='link'){
                $('.form_video_link').show();
                $('.form_video_file').hide();
                $('.form_video_vimeo_link').hide();
               // $('.form_video_file').resetForm();
            } else if(value=='vimeo-link'){
                $('.form_video_vimeo_link').show();
                $('.form_video_file').hide();
                 $('.form_video_link').hide();
               // $('.form_video_file').resetForm();
            }else{
                $('.form_video_link').hide();
                //$('.form_video_link').resetForm();
                $('.form_video_file').show();
                $('.form_video_vimeo_link').hide();
            }
        });
        $(".form_video_link").submit(function(e){
    		e.preventDefault();
            var dataoj = $(this).serialize(); 
            var uri = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: uri,
                data: dataoj,
                dataType: "text",
                success: function(response) {
                     $('.alert_panel').html(response); 
                     location.reload();
                }
            });    
        });
          $(".form_video_vimeo_link").submit(function(e){
    		e.preventDefault();
            var dataoj = $(this).serialize(); 
            var uri = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: uri,
                data: dataoj,
                dataType: "text",
                success: function(response) {
                     $('.alert_panel').html(response); 
                     location.reload();
                }
            });    
        });
	var progressbox     = $('#progressbox');
	var progressbar     = $('#progressbar');
	var statustxt       = $('#statustxt');
	var completed       = '0%';
	
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			uploadProgress: OnProgress,
			success:       afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// return false to prevent standard browser submit and page navigation 
			return false; 
		});
	
//when upload progresses	
function OnProgress(event, position, total, percentComplete)
{
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
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
    location.reload();

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{

		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		
		//allow only valid image file types 
		switch(ftype)
        {
            case 'video/mp4': 
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 200 MB (200 000 000)
		if(fsize>200000000 ) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big video file! <br />Please reduce the size of your video using an image editor.");
			return false
		}
		
		//Progress bar
		progressbox.show(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color','#000'); //initial color of status text

				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
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