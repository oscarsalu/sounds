$(document).ready(function() {
    $("#menu-action li a i").click(function(e){
		e.preventDefault();
        var uri = $(this).attr('href');
        $("#menu-action li").each(function(index, value) {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
        if(uri!= '#'){
            $.ajax({
                type: "POST",
                url: uri,
                dataType: "jsonp",
                beforeSend : function(response) {
                    $(this).parent().addClass('active');
                    $('.content-dashboard').toggleClass('lock');
                    window.history.pushState("string", "Title", uri);
                },
                success: function(response) {
                     $('.content-dashboard').empty();
                     $('.content-dashboard').html(response);
                     $('.content-dashboard').toggleClass('lock');
                     
                 }
            });    
        }
        
    });
    $(".image-banner .banner-input").css("display","none");
        $(".button_changebanner").click(function(){
            $(".image-banner .banner-input").click();
            return false;
        })
    // $(".button_changebanner").click(function(){
    //     $(".banner-input").click();
    //     return false;
    // });
    $('.banner-input').change(function(){
        $('#wrapper-banner').show();
        $('.banner-save').show();
        $(this).hide();
    });
});