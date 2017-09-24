$(document).ready(function() {
        $('.slideRight').on('click','.notifications', function (){
            $('.notifications .bg-lightred').html('');
            $.post(base_url+'home/post_notify', { user_id: $U_map} );
        });
        $('.slideLeft').on('click','.notifications', function (){
            $('.notifications .bg-lightred').html('');
            $.post( base_url+'home/post_notify', { user_id: $U_map} );
        });
  }); 