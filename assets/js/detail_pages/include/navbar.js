$(document).ready(function() {
    $('.slideRight').on('click','.notifications', function (){
        $('.notifications .bg-lightred').html('');
        $.post( page_url+'home/post_notify', { 
            user_id: $user_data,
            "csrf_test_name":     $records_per_page   
        } );
    });
    $('.slideLeft').on('click','.notifications', function (){
        $('.notifications .bg-lightred').html('');
        $.post( page_url+"home/post_notify", { 
            user_id: $user_data,
            "csrf_test_name":     $records_per_page   
        } );
    });
});