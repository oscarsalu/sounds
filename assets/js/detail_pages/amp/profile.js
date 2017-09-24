$(document).ready(function() {
    $("form.profile").submit(function(e){
		e.preventDefault();
        var uri = $(this).attr('action');
      $.ajax({
            type: "POST",
            url: uri,
            data: {
                'first_name':   $('input[name="first_name"]').val(),
                'last_name':    $('input[name="last_name"]').val(),
                'email_paypal': $('input[name="email_paypal"]').val(),
                'phone':        $('input[name="phone"]').val(),
                'address':      $('input[name="address"]').val(),
                'city':         $('input[name="city"]').val(),
                'web_url':      $('input[name="web_url"]').val(),
                'company':      $('input[name="company"]').val(),
                'city':         $('input[name="city"]').val(),
                'gender':      $('input[name="gender"]:checked').val(),
                'fav_place':      $('input[name="fav_place"]').val(),
                'best_friend_name':             $('input[name="best_friend_name"]').val(),
                'occupation':      $('input[name="occupation"]').val(),
                'favorite_artist':      $('#favorite_artist').val(),
                'age_range':      $('input[name="age_range"]').val(),
                'genre':      $('#genre').val(),
                'facebook_url':$('input[name="facebook_url"]').val(),
                'youtube_url':$('input[name="youtube_url"]').val(),
                'twitter_url':$('input[name="twitter_url"]').val(),
                'instagram_url':$('input[name="instagram_url"]').val(),
                'csrf_test_name':get_csrf_hash
            },
            dataType: "text",
            success: function(response) {
                 $('.alert_panel').html(response);
                 
             }
        });    
        
    });
     $(".action-back").click(function(e){
		e.preventDefault();
        $.ajax({
            type: "GET",
            url: amper_blog,
            dataType: "text",
            success: function(response) {
                 $('.content-dashboard').html(response);
            }
        });    
    });
    $("form.form-new-blog").submit(function(e){
		e.preventDefault();
        var uri = $(this).attr('action');
        var dataoj = $(this).serialize(); 
        $.ajax({
            type: "POST",
            url: uri,
            data: {
                'id': $('input[name="id"]').val(),
                'title':   $('input[name="title"]').val(),
                'introduction':   $('textarea[name="introduction"]').val(),
                'content':    CKEDITOR.instances.content.getData(),
                'csrf_test_name':get_csrf_hash 
            },
            dataType: "text",
            success: function(response) {
                 $('.content-dashboard').html(response);
                 
            }
        });    
    });
    
});