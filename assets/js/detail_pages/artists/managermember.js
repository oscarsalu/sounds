 $(document).ready(function() {
        $('#member_item').on('click','.btn-edit', function (){
            var text = $(this).text();
            var split_text = text.split(',');
            var id = split_text[0];
            var artist_id =  split_text[1];
            var contribution= split_text[2];
            var contribution2 = split_text[3];
            var startdate_m = split_text[4]; 
            var startdate_y = split_text[5];
            var er_member = split_text[6];
             
            $('#id').val(id);
            $('#contribution2').val(contribution2);
            $("#startdate_m").val(startdate_m);
            $("#startdate_y").val(startdate_y);
            $("#contribution").val(contribution);
            $("input[name=er_member][value=" + er_member + "]").attr('checked', 'checked');
        });
        $('#video-item').on('click','.btn-del', function (){
            if(confirm("Are you sure you want to delete this record?")){
                var text = $(this).text();
                var split_text = text.split(',');
                var id = split_text[0];
                
                $('#delete_id').val(id); 
                
                $('#form_delete').submit();
            }
        });
    });