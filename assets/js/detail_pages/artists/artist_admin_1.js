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
        //Progress bar
        if(percentComplete>99){
            percentComplete =99;
        }
    	//Progress bar
    	progressbar.width(percentComplete + '%') //update progressbar percent complete
    	statustxt.html(percentComplete + '%'); //update status text
    	if(percentComplete>50){
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
            if($('.playlistInput').val()){
               var inputfile = $('.playlistInput');
            }
            if($('.audioInput').val()){
               var inputfile = $('.audioInput');
               var fsize = inputfile[0].files[0].size; //get file size
        	   var ftype = inputfile[0].files[0].type; // get file type
               switch(ftype)
               {
                    case 'audio/mp3': 
                    case 'audio/x-m4a': 
                    case 'audio/wav':
                    case 'audio/m4a':
                    case 'video/mp4':
                    case 'video/3gpp':
                    case 'audio/vnd.dlna.adts':
                    case 'video/quicktime':
                        break;
                    default:
                        $(".output").html("<b>"+ftype+"</b> Unsupported file type!");
        				return false
                }
            }
            if($('.videoInput').val()){
               var inputfile = $('.videoInput');
            }
    		if(typeof inputfile !== 'undefined')  //check empty input filed
    		{ 
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
    	else{
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