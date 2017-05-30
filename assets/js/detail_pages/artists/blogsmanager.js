jQuery(function($){
    $('.show-cmt').on('click', function(){
        var parent = $(this).parent();
        var div = parent.find('.comment_replies');
        div.toggle('show');
        $(this).removerClass('.show-cmt');
        $(this).addClass('.hidden-cmt');
    });
     
});
$(document).ready(function() {           
        $('#blogs_manager').on('click','.btn-edit', function (){
            var id = $(this).find('.id_hd').val();
            var title = $(this).find('.title_hd').val();
            var intro = $(this).find('.intro_dc').val();
            var content =  $(this).find('div').html();
            var user_id = $(this).find('.user_id_hd').val();
            CKEDITOR.instances.content.setData(content); 
            $('#id').val(id);
            $('#title').val(title);
            $('#intro').val(intro)
            $("#user_id").val(user_id);
        });
        $('#blogs_manager').on('click','.btn-del', function (){
            if(confirm("Are you sure you want to delete this record?")){
                var id = $(this).find('.id_hd').val();
                $('#delete_id').val(id); 
                $('#form_delete').submit();
            }
        });
    }); 