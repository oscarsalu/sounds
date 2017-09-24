
	function fbPost()
	{				
			FB.login(function(){
				loginCheck();
			}, {scope: facebook_permissions});

			$.ajax({
				url: page_url+'social_media/shareFb',
				data: {"csrf_test_name":$records_per_page,'desc' : $('#description').val(),'link' : $('#share_link_url').val(),'caption' : $('#share_caption').val(),'msg' : $('#share_description').val(),'token':localStorage.getItem('authToken')},
				type: 'POST',
				dataType: 'json',
				success: function(response) {
				    console.log(response);
				}
			});
	}
    
    function fbPost_video()
	{
			FB.login(function(){
				loginCheck();
			}, {scope: facebook_permissions});
			
			$.ajax({
				url: page_url+'social_media/fbPost_video',
				data: {"csrf_test_name":$records_per_page,'imge_url' : $('#url_video_input').val(),'token':localStorage.getItem('authToken')},
				type: 'POST',
				dataType: 'json',
				success: function(response) {
				    if(response.id != ""){
				        $(".complete_alter").slideUp();
                        $(".complete_alter").css("display","block");
				    }else{
				        $(".not_complete_alert").slideUp();
                        $(".complete_alter").css("display","block");
				    }
				    console.log(response);
				}
			});
	}
    function fbpost_image()
	{
        var twitterCheck = $('#twitter').prop("checked");
        var fbCheck = $('#facebook').prop("checked");
        if(twitterCheck){
            twitterCheck1 = 1;
        }else{
            twitterCheck1 = 0;
        }
        if(fbCheck){
            fbCheck1 = 1;
        }else{
            fbCheck1 = 0;
        }
		FB.login(function(){
			loginCheck();
		}, {scope: facebook_permissions});
		
        $.ajax({
			url: page_url+'social_media/fbpost_photo',
			data: {"csrf_test_name":$records_per_page,'message' : $('#description').val(),'imge_url' : $('#url_post_photo_input').val(),'twitterCheck' : twitterCheck1,'fbCheck':fbCheck1,'token':localStorage.getItem('authToken')},
			type: 'POST',
			dataType: 'json',
			success: function(response) {
			    if(response.id != ""){
			        $(".complete_alter").slideUp();
                    $(".complete_alter").css("display","block");
			    }else{
			        $(".not_complete_alert").slideUp();
                    $(".complete_alter").css("display","block");
			    }
                var twitterCheck = $('#twitter').prop("checked");
			    console.log(response);
			}
		});			
	}
	function shareSong()
	{		
		console.log("share song");
		var song = $("input[name='songs']:checked"). val();
		//alert("song: "+song);
		var arr = song.split("-");
		//alert("arr: "+arr[0]+"arr: "+arr[1]);
		var twitterCheck = $('#twitter').prop("checked");
		var fbCheck = $('#facebook').prop("checked");
		var googleCheck = $('#google').prop("checked");
		var shareTxt = $("#description").val();
		var affId = $('#affId').val();
		console.log("googleCheck: "+googleCheck);
		if(fbCheck == true)
		{
			FB.login(function(){
				loginCheck();
			}, {scope: facebook_permissions});
			
			$.ajax({
				url: page_url+'social_media/shareFb',
				data: {"csrf_test_name":$records_per_page,'desc':"song",'link' :page_url+'amp/song_embed/'+affId+'/'+arr[0]+'/'+arr[1],'token':localStorage.getItem('authToken')},
				type: 'POST',
				dataType: 'json',
				success: function(response) {
				    console.log(response);
				}
			});	
		
		}
		if(googleCheck == true)
		{
			console.log("inside google plus");
			var shareTxt = $('#description').val();
			var options = {
			contenturl: page_url+'amp/song_embed/'+affId+'/'+arr[0]+'/'+arr[1],
			contentdeeplinkid: '/pages',
			clientid: client_id_googleplus,
			cookiepolicy: 'single_host_origin',
			prefilltext: shareTxt,
			calltoactionlabel: 'READ',
			calltoactionurl: page_url+'amp/embed/'+affId,
			calltoactiondeeplinkid: '/pages/create'
			};
			  // Call the render method when appropriate within your app to display
			  // the button.
			gapi.interactivepost.render('sharePost', options);
			
			setTimeout(function(){
				$('#btnGoogle').click();
			},600);
		}
		if(twitterCheck == true)
		{
			var txt = $("#description").val();
			var newTxt = txt + "\n "+page_url+'amp/song_embed/'+affId+'/'+arr[0]+'/'+arr[1];
			$("#description").val(newTxt);
			
			setTimeout(function(){
				$('.twitterShare').click();
			},600);
			
		}
	}
   $('#share').click(function(){
		$('#songTwitter').val("0");
		var twitterCheck = $('#twitter').prop("checked");
		var fbCheck = $('#facebook').prop("checked");
		var googleCheck = $('#google').prop("checked");
		var shareTxt = $("#description").val();
        if(fbCheck == true){
			console.log("1");
            type_value = $(".type_value:checked").val();
            if(type_value == 'video'){
                video_type = $(".video_post:checked").val();
                if(video_type == 'upload_video'){
                    $('.shareFrm').submit();
                }else if(video_type == 'url_video'){
                    if($('#url_video_input').val() != ""){
                       fbPost_video();
                    }else{
                        alert("Please enter url video to share");
                    }
                }
            }
        }
        type_value = $(".type_value:checked").val();
        if(type_value == 'image'){
            if(shareTxt != "")
            {
                if(fbCheck == true){
                    post_photo = $(".post_photo:checked").val();
                    if(post_photo == "url_photo"){
                        if($('#url_post_photo_input').val() != ""){
                            fbpost_image();
                        }else{
                            alert("Please enter url photo to share");
                        }
                    }else if(post_photo == "upload_photo"){
						$('.shareFrm').submit();
                        //setTimeout(function(){ $('.twitterShare').click(); }, 1500);
                    }
                    
                }
                if(twitterCheck == true){
                    post_photo = $(".post_photo:checked").val();
                    if(post_photo == "url_photo"){
                        if($('#url_post_photo_input').val() != ""){
                            setTimeout(function(){ $('.twitterShare').click(); }, 1500);
                        }
                    }else if(post_photo == "upload_photo"){
                            setTimeout(function(){ $('.twitterShare').click(); }, 1500);
                    }
                }
                if(fbCheck == true || twitterCheck == true){
                    if(post_photo == "url_photo"){
                        if(fbCheck){
                            fbCheck1 = 1;
                        }else{
                            fbCheck1 = 0;
                        }
                        if(twitterCheck){
                            twitterCheck1 = 1;
                        }else{
                            twitterCheck1 = 0;
                        }
                        $.ajax({
            				url: page_url+'social_media/insert_db',
            				data: {"records_per_page":$records_per_page,'message' : $('#description').val(),'twitterCheck' : twitterCheck1,'fbCheck' : fbCheck1,'googleCheck' : 0, image : $('#url_post_photo_input').val()},
            				type: 'POST',
            				dataType: 'json',
            				success: function(response) {
            					console.log(response);
            				}
            			});
                    }
                }
            }else{
                alert("Please enter text to share");
            }
        }else if(type_value == 'field'){
            if(shareTxt != "")
            {
				console.log("2");
                if(twitterCheck == true || fbCheck == true || googleCheck == true){
                    if(fbCheck){
                        fbCheck1 = 1;
                    }else{
                        fbCheck1 = 0;
                    }
                    if(twitterCheck){
                        twitterCheck1 = 1;
                    }else{
                        twitterCheck1 = 0;
                    }
                    if(googleCheck){
                        googleCheck1 = 1;
                    }else{
                        googleCheck1 = 0;
                    }
                    /*$.ajax({
        				url: page_url+'social_media/insert_db',
        				data: {"csrf_test_name":$records_per_page,'message' : $('#description').val(),'twitterCheck' : twitterCheck1,'fbCheck' : fbCheck1,'googleCheck' : googleCheck1},
        				type: 'POST',
        				dataType: 'json',
        				success: function(response) {
        					console.log(response);
        				}
        			});
                    */
                    if(fbCheck == true){
                     fbPost();  
                    }
    					//fbPost();
    				if(googleCheck == true){
						var shareTxt = $('#description').val();
						var options = {
						contenturl: "google.com",
						contentdeeplinkid: '/pages',
						clientid: client_id_googleplus,
						cookiepolicy: 'single_host_origin',
						prefilltext: shareTxt,
						calltoactionlabel: 'READ',
						calltoactionurl: "google.com",
						calltoactiondeeplinkid: '/pages/create'
						};
						  // Call the render method when appropriate within your app to display
						  // the button.
						gapi.interactivepost.render('sharePost', options);
						
						setTimeout(function(){
							$('#btnGoogle').click();
						},6000);
    				}
    					
    				//if(twitterCheck == true){
				    if(fbCheck == true || twitterCheck == true){
				        if(googleCheck != true){
        				    //setTimeout(function(){ $('.twitterShare').click(); }, 15);
        				}else{
        				    //setTimeout(function(){ $('.twitterShare').click(); }, 15000);
        				}
				        
				    }
                }
            }else
    		{
    			alert("Please enter text to share");
    		}
        }
	});

	window.fbAsyncInit = function() {
		FB.init({
			appId   : facebook_app_id, // Your app id
			cookie  : true,  // enable cookies to allow the server to access the session
			xfbml   : false,  // disable xfbml improves the page load time
			version : 'v2.5', // use version 2.4
			status  : true // Check for user login status right away
		});
		FB.getLoginStatus(function(response) {
			console.log('getLoginStatus', response);
			localStorage.setItem('authToken', response.authResponse.accessToken);
			console.log("item: "+localStorage.getItem('authToken'));
			loginCheck(response);
		});
	};
	// Check login status
	function statusCheck(response)
	{
		//console.log('statusCheck', response.status);
		if (response.status === 'connected')
		{
			$('.login').hide();
			$('.form').fadeIn();
						
		}
		else if (response.status === 'not_authorized')
		{
			// User logged into facebook, but not to our app.
		}
		else
		{
			// User not logged into Facebook.
		}
	}
	// Get login status
	function loginCheck()
	{
		console.log("hello");
		FB.getLoginStatus(function(response) {
			console.log('loginCheck', response);
			
			
			localStorage.setItem('authToken', response.authResponse.accessToken);
			console.log("item: "+localStorage.getItem('authToken'));
			statusCheck(response);
		});
		
	}
	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function getUser()
	{
		FB.api('/me', function(response) {
			//console.log('getUser', response);
		});
	}
	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
