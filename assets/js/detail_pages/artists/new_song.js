$(window).load(function(){
    $("#duration_audio").slider();
    $("#duration_video").slider();
    $('#rootwizard').bootstrapWizard({
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#rootwizard').find('.pager .finish').show();
                $('#rootwizard').find('.pager .finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
            if($current == '4'){
                check_duration();
            }
        },
        onNext: function(tab, navigation, index) {
            var form = $('form[name="step'+ index +'"]');
            
            if(  index=='3'){
                
            if ($("input[name=file_audio1]").parsley().isValid() || 
            $("input[name=file_audio2]").parsley().isValid() || 
            $("input[name=file_audio3]").parsley().isValid() || 
            $("input[name=file_audio4]").parsley().isValid() || 
             $("input[name=file_audio5]").parsley().isValid() ||
             $("input[name=file_video1]").parsley().isValid() || 
            $("input[name=file_video2]").parsley().isValid() || 
             $("input[name=file_video3]").parsley().isValid()) {
                      
        $("input[name=file_audio1]").removeAttr('required').parsley().destroy();
            $("input[name=file_audio2]").removeAttr('required').parsley().destroy();
            $("input[name=file_audio3]").removeAttr('required').parsley().destroy();
            $("input[name=file_audio4]").removeAttr('required').parsley().destroy();
             $("input[name=file_audio5]").removeAttr('required').parsley().destroy();
              $("input[name=file_video1]").removeAttr('required').parsley().destroy();
               $("input[name=file_video2]").removeAttr('required').parsley().destroy();
                $("input[name=file_video3]").removeAttr('required').parsley().destroy();
      
        
            } else {
                 $("input[name=file_audio1]").attr('required', 'required').parsley();
        $("input[name=file_audio2]").attr('required', 'required').parsley();
        $("input[name=file_audio3]").attr('required', 'required').parsley();
        $("input[name=file_audio4]").attr('required', 'required').parsley();
          $("input[name=file_audio4]").attr('required', 'required').parsley();
            $("input[name=file_video1]").attr('required', 'required').parsley();
              $("input[name=file_video2]").attr('required', 'required').parsley();
            $("input[name=file_video3]").attr('required', 'required').parsley();
$('.invalid-form-error-message').html('<div class="alert alert-danger">You must upload any one audio or video </div>');
                return false;
            } 
        } else if(index=="1" ) {
            form.parsley().validate();
            if (!form.parsley().isValid()) {
                return false;
            } 
        }
        },
        onTabClick: function(tab, navigation, index) {
            var form = $('form[name="step'+ (index+1) +'"]');
            form.parsley().validate();
            if (!form.parsley().isValid()) {
                return false;
            } 
        }
    });
    function check_duration() {
        
        //Audio Extension
       if( $("#file_audio_ext1").val()!=null){
        var audio_ext = $("#file_audio_ext1").val();
        var audio_file="tmp_audio1";
       
    }
    else if($("#file_audio_ext2").val()!=null) {
        var audio_ext = $("#file_audio_ext2").val();
        var audio_file="tmp_audio2";
         
    }
    else if($("#file_audio_ext3").val()!=null){
        var audio_ext = $("#file_audio_ext3").val();
        var audio_file="tmp_audio3";
         
    }
    else if($("#file_audio_ext4").val()!=null) {
        var audio_ext = $("#file_audio_ext4").val();
        var audio_file="tmp_audio4";
         
    }
    else {
         var audio_ext = $("#file_audio_ext5").val();
         var audio_file="tmp_audio5";
    }

      
         
        //Video Extension
   if( $("#file_video_ext1").val()!=null){
    var video_ext = $("#file_video_ext1").val();
    var video_file="tmp_video1";
    }
    else if($("#file_video_ext2").val()!=null){
         var video_ext = $("#file_video_ext2").val();
         var video_file="tmp_video2";
    }
    else {
         var video_ext = $("#file_video_ext3").val();
         var video_file="tmp_video3";
    }
    
       
        if(!video_ext){
            $("#radio_video").attr('disabled',true);
        }else{
            $("#radio_video").removeAttr('disabled');
        }
        $.ajax({
             type: "POST",
             url:  a_load_duration,
             data: {
               'csrf_test_name':get_csrf_hash,
                'audio_ext':  audio_ext,
                'video_ext': video_ext,
                'audio_file':audio_file,
                'video_file':video_file
             },
             
             dataType: "json",
             beforeSend: function(){
                $("body").addClass("loading");
             },
             success: function(data) {
                console.log(data);
                $(".slider ").remove();
                var end = parseInt(data.audio);
                new Slider("#duration_audio", { 
                    max: parseInt(data.audio)
                });
                new Slider("#duration_video", { 
                    max: parseInt(data.video)
                });
                $("body").removeClass("loading");
             },
        });
    }
});
$(document).ready(function(){
    var progressbox     = $('.progressbox');
    var progressbar     = $('.progressbar');
    var statustxt       = $('.statustxt');	
    var completed       = '0%';
    var progressbox_video     = $('.progressbox_video');
    var progressbar_video     = $('.progressbar_video');
    var statustxt_video       = $('.statustxt_video');
    var completed_video       = '0%';
    $('input[name="file_audio1"]').change(function(){
        var form = $('.form_upload_audio');
        //form.parsley().validate();
        
            
        	var options = { 
        		target:   '.output',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit,  // pre-submit callback 
        		uploadProgress: OnProgress,
        		success:       afterSuccess,  // post-submit callback 
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
        
    });
     $('input[name="file_audio2"]').change(function(){
        var form = $('.form_upload_audio');
       // form.parsley().validate();
       
            
        	var options = { 
        		target:   '.output',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit,  // pre-submit callback 
        		uploadProgress: OnProgress,
        		success:       afterSuccess,  // post-submit callback 
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
        
    });
    $('input[name="file_audio3"]').change(function(){
        var form = $('.form_upload_audio');
       // form.parsley().validate();
    
            
        	var options = { 
        		target:   '.output',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit,  // pre-submit callback 
        		uploadProgress: OnProgress,
        		success:       afterSuccess,  // post-submit callback 
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
      
    });
     $('input[name="file_audio4"]').change(function(){
        var form = $('.form_upload_audio');
        //form.parsley().validate();
    
            
        	var options = { 
        		target:   '.output',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit,  // pre-submit callback 
        		uploadProgress: OnProgress,
        		success:       afterSuccess,  // post-submit callback 
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
     
    });
    $('input[name="file_audio5"]').change(function(){
        var form = $('.form_upload_audio');
        //form.parsley().validate();
    
            
        	var options = { 
        		target:   '.output',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit,  // pre-submit callback 
        		uploadProgress: OnProgress,
        		success:       afterSuccess,  // post-submit callback 
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
     
    });
    $('input[name="file_audio6"]').change(function(){
        var form = $('.form_upload_audio');
        //form.parsley().validate();
    
            
        	var options = { 
        		target:   '.output',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit,  // pre-submit callback 
        		uploadProgress: OnProgress,
        		success:       afterSuccess,  // post-submit callback 
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
     
    });
    $('input[name="file_video1"]').change(function(){
        var form = $('.form_upload_video');
        if ($(this).val()) {
        	var options = { 
        		target:   '.output_video',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit_video,  // pre-submit callback 
        		uploadProgress: OnProgress_video,
                success:       afterSuccess_video,
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
        }else{
            alert('failse');
            $("body").removeClass("loading");
        }
    });
     $('input[name="file_video2"]').change(function(){
        var form = $('.form_upload_video');
        if ($(this).val()) {
        	var options = { 
        		target:   '.output_video',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit_video,  // pre-submit callback 
        		uploadProgress: OnProgress_video,
                success:       afterSuccess_video,
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
        }else{
            alert('failse');
            $("body").removeClass("loading");
        }
    });
    $('input[name="file_video3"]').change(function(){
        var form = $('.form_upload_video');
        if ($(this).val()) {
        	var options = { 
        		target:   '.output_video',   // target element(s) to be updated with server response 
        		beforeSubmit:  beforeSubmit_video,  // pre-submit callback 
        		uploadProgress: OnProgress_video,
                success:       afterSuccess_video,
        		resetForm: false        // reset the form after successful submit 
        	}; 
        	form.ajaxSubmit(options);
        }else{
            alert('failse');
            $("body").removeClass("loading");
        }
    });
    
    $('input[name="options_demo"]').change(function(){
       

       if(this.value=='1'){
          
            $("#box_demo_video").hide();
            $("#box_demo_audio").show();
        }else{
            $("#box_demo_audio").hide();
            $("#box_demo_video").show();
        }
    });
    $('.del_video_file').click(function(e){
       e.preventDefault();
       $.ajax({
             type: "POST",
             url: a_delete_file_video,
             data: {
                'csrf_test_name':get_csrf_hash                    
             },
             dataType: "text",
             beforeSend: function(){
                $("body").addClass("loading");
             },
             success: function(data) {
                $('.form_upload_video').resetForm();
                $('.output_video').empty();
                progressbox_video.hide();
                $('.del_video_file').hide();
                $("body").removeClass("loading");
             },
             error   : function(){
                alert('Request failed!');
                $("body").removeClass("loading");
             }
        });     
    });
    $('#finish').click(function(e){
       e.preventDefault();
       $.ajax({
             type: "POST",
             url: finish_upload_song,
             data: {
                 'csrf_test_name':get_csrf_hash ,
                'id_paylist':$playlist_id,
                'name_song': $('#song_name').val(),
                'availability': $("#availability").val(),
                'price': $("#price").val(),
                'lyric': CKEDITOR.instances.lyrics.getData(),
                'currency':$('#currency').val(),
                'file_audio_ext1': $("#file_audio_ext1").val(),
                'file_audio_ext2':$("#file_audio_ext2").val(),
                'file_audio_ext3':$("#file_audio_ext3").val(),
                'file_audio_ext4':$("#file_audio_ext4").val(),
                'file_audio_ext5':$("#file_audio_ext5").val(),
                'file_audio_ext6':$("#file_audio_ext6").val(),
                'file_video_ext1': $("#file_video_ext1").val(),
                 'file_video_ext2': $("#file_video_ext2").val(),
                 'file_video_ext3': $("#file_video_ext3").val(),
                'options_demo': $('input[name="options_demo"]:checked').val(),
                'duration_audio': $("#duration_audio").val(),
                'duration_video': $("#duration_video").val(),                   
             },
             dataType: "json",
             beforeSend: function(){
                $("body").addClass("loading");
             },
             success: function(data) {
                location.reload();
                $("body").removeClass("loading");
                
             },
             error   : function(){
                $("body").removeClass("loading");
                alert('Request failed!');
                
             }
        });   
    });
    //when upload progresses audio	
    function OnProgress(event, position, total, percentComplete)
    {
    	progressbar.width(percentComplete + '%') //update progressbar percent complete
    	statustxt.html(percentComplete + '%'); //update status text
    }
    //when upload progresses video	
    function OnProgress_video(event, position, total, percentComplete)
    {
    	progressbar_video.width(percentComplete + '%') //update progressbar percent complete
    	statustxt_video.html(percentComplete + '%'); //update status text
    }
    function afterSuccess_video()
    {   
        $('.del_video_file').show();
    }
    function afterSuccess()
    {   
    }
    //function to check file size before uploading.
    function beforeSubmit(){
        //check whether browser fully supports all File API
       if (window.File && window.FileReader && window.FileList && window.Blob)
    	{
    	    var inputfile = $('#file_audio1').val();
            var inputfile2=$('input[name="file_audio2"]').val();
            var inputfile3=$('input[name="file_audio3"]').val();		
            var inputfile4=$('input[name="file_audio4"]').val();
            
            
            if(inputfile !== '') //check empty input filed
    		{   
        		//Progress bar
        		progressbox.show(); //show progressbar
        		progressbar.width(completed); //initial value 0% of progressbar
        		statustxt.html(completed); //set status text
        		statustxt.css('color','#000'); //initial color of status text
               	$(".output").html(""); 
    		}
    		  
                
                //inputfile2
                
                   
            
     
           else if(inputfile2 !== '') //check empty input filed
    		{ 
        		//Progress bar
        		progressbox.show(); //show progressbar
        		progressbar.width(completed); //initial value 0% of progressbar
        		statustxt.html(completed); //set status text
        		statustxt.css('color','#000'); //initial color of status text
               	$(".output").html(""); 
    		}else if(inputfile3 !== ''){
    		progressbox.show(); //show progressbar
        		progressbar.width(completed); //initial value 0% of progressbar
        		statustxt.html(completed); //set status text
        		statustxt.css('color','#000'); //initial color of status text
    		}
                else if(inputfile4 !== ''){
                    progressbox.show(); //show progressbar
        		progressbar.width(completed); //initial value 0% of progressbar
        		statustxt.html(completed); //set status text
        		statustxt.css('color','#000'); //initial color of status text
                }
                else {
                    return true;
                }
                
                
    	}
    	else{
    		//Output error to older unsupported browsers that doesn't support HTML5 File API
    		$(".output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
    		return false;
    	}
    }
    function beforeSubmit_video(){
        //check whether browser fully supports all File API
       if (window.File && window.FileReader && window.FileList && window.Blob)
    	{
    	   
    	    var inputfile = $('input[name="file_video1"]');
            var inputfile1 = $('input[name="file_video2"]');
            var inputfile2 = $('input[name="file_video3"]');
    		if($('input[name="file_video1"]').val() !== '') //check empty input filed
    		{ 
    		    var fsize = inputfile[0].files[0].size; //get file size
        		var ftype = inputfile[0].files[0].type; // get file type
             
        		//allow only valid audio file types 
        		switch(ftype)
                {
                    case 'video/mp4': 
                    
                    case 'video/x-m4a':
                   
                    case 'video/m4v':
                        break;
                    default:
                        $(".output_video").html("<b>"+ftype+"</b> Unsupported file type!");
        				return false
                }
        		//Allowed file size is less than 200MB 
        		if(fsize>200000000 ) 
        		{
        			$(".output_video").html("<b>"+bytesToSize(fsize) +"</b> Too big video file! <br />Please reduce the size of your file using an image editor.");
        			return false
        		}
        		//Progress bar
        		progressbox_video.show(); //show progressbar
        		progressbar_video.width(completed); //initial value 0% of progressbar
        		statustxt_video.html(completed); //set status text
        		statustxt_video.css('color','#000'); //initial color of status text
               
        		$(".output_video").html("");
                       
                      
    		}else  
    		if($('input[name="file_video2"]').val() !== '') //check empty input filed
            {
                var fsize = inputfile1[0].files[0].size; //get file size
        		var ftype = inputfile1[0].files[0].type; // get file type
                //allow only valid audio file types 
        		switch(ftype) {
    		 case 'video/webm':
                      case 'video/webmv':
                     break;
                    default:
                        $(".output_video").html("<b>"+ftype+"</b> Unsupported file type!");
        				return false 
                     
                }
                //Allowed file size is less than 40MB 
        		if(fsize>41943040 ) 
        		{
        			$(".output_video").html("<b>"+bytesToSize(fsize) +"</b> Too big video file! <br />Please reduce the size of your file using an image editor.");
        			return false
        		}
        		//Progress bar
        		progressbox_video.show(); //show progressbar
        		progressbar_video.width(completed); //initial value 0% of progressbar
        		statustxt_video.html(completed); //set status text
        		statustxt_video.css('color','#000'); //initial color of status text
               
        		$(".output_video").html("");
    		}
                else if($('input[name="file_video3"]').val() !== '') //check empty input filed
            {
                var fsize = inputfile2[0].files[0].size; //get file size
        		var ftype = inputfile2[0].files[0].type; // get file type
                //allow only valid audio file types 
        		switch(ftype) {
    		 case 'video/ogg':
                      case 'video/ogv':
                     break;
                    default:
                        $(".output_video").html("<b>"+ftype+"</b> Unsupported file type!");
        				return false 
                     
                }
                //Allowed file size is less than 40MB 
        		if(fsize>41943040 ) 
        		{
        			$(".output_video").html("<b>"+bytesToSize(fsize) +"</b> Too big video file! <br />Please reduce the size of your file using an image editor.");
        			return false
        		}
        		//Progress bar
        		progressbox_video.show(); //show progressbar
        		progressbar_video.width(completed); //initial value 0% of progressbar
        		statustxt_video.html(completed); //set status text
        		statustxt_video.css('color','#000'); //initial color of status text
               
        		$(".output_video").html("");
    		}
    	}
    	else{
    		//Output error to older unsupported browsers that doesn't support HTML5 File API
    		$(".output_video").html("Please upgrade your browser, because your current browser lacks some new features we need!");
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