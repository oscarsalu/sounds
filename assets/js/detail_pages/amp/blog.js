$(document).ready(function() {
    $(".action-del").click(function(e){
		e.preventDefault();
        var id = $(this).attr('data_blog');
        $.ajax({
            type: "GET",
            url: base_url+'amper/delete/blog/'+id,
            dataType: "text",
            success: function(response) {
                 $('.content-dashboard').html(response);
            }
        });    
    });
    $(".action-edt").click(function(e){
		e.preventDefault();
        var id = $(this).attr('data_blog');
        $.ajax({
            type: "GET",
            url: base_url+'amper/read/blog/'+id,
            dataType: "text",
            success: function(response) {
                 $('.content-dashboard').html(response);
            }
        });    
    });
    $("#post_btn").click(function(e){
        e.preventDefault();
        $('.post_new').toggleClass('hidden');  
    });
});