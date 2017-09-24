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
    		if(fsize >= 3097152 ) 
    		{

    			$(".output").html("<b>"+fsize + bytesToSize(fsize) +"</b> Too big video file! <br />Please reduce the size of your image using an image editor.");
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