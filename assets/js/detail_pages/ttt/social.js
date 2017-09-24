	$(document).on('change', '.selectsocaillocation', function() {
	    location_id = $(this).val();
	    get_social_media_view_tour_location(tour_id, location_id);
	});
	$("#social_media_div").ready(function(){

	function fbPost(img, title, loc, desc, dt) {
	    FB.ui({
	        method: 'feed',
	        name: title,
	        link: ' http://www.99Sound.com/',
	        picture: img,
	        caption: '',
	        description: desc + '&#010;Location: ' + loc + '&#010;Date: ' + dt,
	        message: ''
	    });

	}

	function fbpost_image(twitterCheck, fbCheck, shareTxt, image, description_share, location_share) {
	    if (twitterCheck) {
	        twitterCheck1 = 1;
	    } else {
	        twitterCheck1 = 0;
	    }
	    if (fbCheck) {
	        fbCheck1 = 1;
	    } else {
	        fbCheck1 = 0;
	    }
	    FB.login(function() {
	        loginCheck();
	    }, { scope: facebook_permissions });

	    $.ajax({
	        url: page_url + 'the_total_tour/fbpost_photo',
	        data: { "csrf_test_name": $records_per_page, 'message': shareTxt, 'imge_url': image, 'twitterCheck': twitterCheck1, 'fbCheck': fbCheck1, 'description_share': description_share, 'location_share': location_share },
	        type: 'POST',
	        dataType: 'json',
	        success: function(response) {
	            if (response.id != "") {
	                $(".complete_alter").slideUp();
	                $(".complete_alter").css("display", "block");
	            } else {
	                $(".not_complete_alert").slideUp();
	                $(".complete_alter").css("display", "block");
	            }
	            var twitterCheck = $('#twitter').prop("checked");
	            console.log(response);
	        }
	    });

	}

	function getgoogle(shareTxt) {
	    var options = {
	        contenturl: page_url,
	        contentdeeplinkid: '/pages',
	        clientid: client_id_googleplus,
	        cookiepolicy: 'single_host_origin',
	        prefilltext: shareTxt,
	        calltoactionlabel: 'READ',
	        calltoactionurl: page_url,
	        calltoactiondeeplinkid: '/pages/create'
	    };
	    // Call the render method when appropriate within your app to display
	    // the button.
	    gapi.interactivepost.render('sharePost', options);
	}

	
	// Check login status
	function statusCheck(response) {
	    console.log('statusCheck', response.status);
	    if (response.status === 'connected') {
	        //$('.login').hide();
	        //$('.form').fadeIn();

	    } else if (response.status === 'not_authorized') {
	        // User logged into facebook, but not to our app.
	    } else {
	        // User not logged into Facebook.
	    }
	}
	// Get login status
	function loginCheck() {
	    FB.getLoginStatus(function(response) {
	        console.log('loginCheck', response);
	        statusCheck(response);
	    });
	}
	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function getUser() {
	    FB.api('/me', function(response) {
	        //console.log('getUser', response);
	    });
	}

	function shareSocial(img, title, loc, desc, dt, evId) {
	    var twitterCheck = $('#twiterChk_' + evId).prop("checked");
	    var fbCheck = $('#facebook_' + evId).prop("checked");
	    var googleCheck = $('#googleChk_' + evId).prop("checked");
	    if (twitterCheck == true || fbCheck == true || googleCheck == true) {
	        //alert("tw: "+twitterCheck+" fb: "+fbCheck+" googl: "+googleCheck);
	        if (fbCheck == true)
	            fbPost(img, title, loc, desc, dt);
	        if (googleCheck == true) {

	            var shareTxt = $('.twitterMsg_' + evId).val();
	            var options = {
	                contenturl: 'http://staging2.99sound.com/gigs_events/read/' + title + '-' + evId,
	                contentdeeplinkid: '/pages',
	                clientid: client_id_googleplus,
	                cookiepolicy: 'single_host_origin',
	                prefilltext: shareTxt,
	                calltoactionlabel: 'READ',
	                calltoactionurl: 'http://staging2.99sound.com/gigs_events/read/' + title + '-' + evId,
	                calltoactiondeeplinkid: '/pages/create'
	            };
	            // Call the render method when appropriate within your app to display
	            // the button.
	            gapi.interactivepost.render('sharePost', options);
	            setTimeout(function() {
	                $('#btnGoogle').click();
	            }, 1000);
	        }
	        if (twitterCheck == true) {
	            setTimeout(function() { $('#shareFrm_' + evId).submit(); }, 15000);
	        }
	    }
	    //});
	}
	(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) {
	        return; }
	    js = d.createElement(s);
	    js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

});