   $(document).ready(function() {           
      
        $('#read_event').on('click','#delete_comment_read', function (){
                var id = $(this).find('.id_delete').val();                
                $('#delete_id_read').val(id); 
        });
    }); 