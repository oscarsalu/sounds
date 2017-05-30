  $(document).ready(function() {
         $('.slideRight').on('click','.notifications', function (){
            $('.notifications .bg-lightred').html('');
            $.post(base_url+'home/post_notify', { 
                user_id: $user_data,
                'csrf_test_name':get_csrf_hash  
            } );
        });
        $('.slideLeft').on('click','.notifications', function (){
            $('.notifications .bg-lightred').html('');
            $.post(base_url+'home/post_notify', { 
                user_id: $user_data,
                'csrf_test_name':get_csrf_hash    
            } );
        })
    }) 